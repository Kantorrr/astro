<?php
/**
 * Tema — gökyüzüyle birlikte değişen üç ruh hali.
 *
 * Geçiş ölçütü sabit saat değil, kullanıcının konumundaki gerçek
 * güneş doğuşu/batışı. Böylece uygulama mevsimle birlikte yaşar.
 *
 *   sabah   güneş doğuşu              → batıştan 2 saat öncesi
 *   ikindi  batıştan 2 saat önce      → batıştan yarım saat sonra
 *   gece    batıştan yarım saat sonra → güneş doğuşu
 */

const ENLEM  = 41.0082;   // İstanbul — gerçek uygulamada cihaz konumu
const BOYLAM = 28.9784;

// Saat dilimi açıkça kurulur; sunucu ayarına güvenilmez.
// (Gerçek uygulamada kullanıcının kendi dilimi kullanılacak — bkz. belge 12.4)
date_default_timezone_set('Europe/Istanbul');

function gunes_bilgisi(?int $zaman = null): array
{
    $zaman = $zaman ?? time();
    $b = date_sun_info($zaman, ENLEM, BOYLAM);

    return [
        'dogus' => is_int($b['sunrise']) ? $b['sunrise'] : strtotime('today 06:30', $zaman),
        'batis' => is_int($b['sunset'])  ? $b['sunset']  : strtotime('today 19:30', $zaman),
    ];
}

function aktif_tema(?int $zaman = null): string
{
    // Prototipte üç temayı da görebilmek için: ?tema=sabah|ikindi|gece
    $secim = $_GET['tema'] ?? '';
    // ikindi2/gece2 aday temalar — karşılaştırma bitince kaldırılacak.
    if (in_array($secim, ['sabah', 'ikindi', 'ikindi2', 'ikindi3', 'gece'], true)) {
        return $secim;
    }

    $zaman = $zaman ?? time();
    $g = gunes_bilgisi($zaman);

    if ($zaman < $g['dogus'] || $zaman >= $g['batis'] + 1800) return 'gece';
    if ($zaman >= $g['batis'] - 7200)                         return 'ikindi';

    return 'sabah';
}

/**
 * Ay evresi — 0 yeniay, 0.5 dolunay, 1 tekrar yeniay.
 *
 * Ortalama sinodik ay üzerinden yaklaşık hesap; gerçek evreden yarım güne
 * kadar sapabilir. Prototip için yeterli — gerçek uygulamada efemeris
 * kullanılacak (bkz. belge, park listesi).
 */
function ay_evresi(?int $zaman = null): float
{
    $zaman    = $zaman ?? time();
    $referans = 1704974220;                 // 11 Ocak 2024, 11:57 UTC — yeniay
    $sinodik  = 29.530588853 * 86400;

    $evre = fmod($zaman - $referans, $sinodik) / $sinodik;

    return $evre < 0 ? $evre + 1 : $evre;
}

/** Ay yüzeyinin yüzde kaçı aydınlık — gerçek gökbilim değeri. */
function ay_aydinlanma(float $evre): int
{
    return (int) round((1 - cos(2 * M_PI * $evre)) / 2 * 100);
}

/** Dolunaya kaç gün kaldı. */
function dolunaya_gun(float $evre): int
{
    $kalan = $evre < 0.5 ? 0.5 - $evre : 1.5 - $evre;

    return (int) round($kalan * 29.530588853);
}

function ay_evresi_adi(float $evre): string
{
    if ($evre < 0.03 || $evre >= 0.97) return 'yeniay';
    if ($evre < 0.22) return 'hilal';
    if ($evre < 0.28) return 'ilk dördün';
    if ($evre < 0.47) return 'büyüyen ay';
    if ($evre < 0.53) return 'dolunay';
    if ($evre < 0.72) return 'küçülen ay';
    if ($evre < 0.78) return 'son dördün';

    return 'balzamik ay';
}

/**
 * Ay evresinin çizimi — gravür mantığında.
 *
 * Gölge, yarım daire ile değişken genişlikte bir elips yayının
 * birleşiminden doğar; gerçek terminatör gibi.
 *
 * Denizler ve kraterler gölgeden ÖNCE çizilir, böylece karanlıkta
 * kalan taraf kendiliğinden kaybolur. Küçük boyutlarda doku çamura
 * döndüğü için çizilmez.
 */
function ay_cizimi(float $evre, int $boyut = 40): string
{
    $r  = 19;
    $c  = 20;
    $k  = cos(2 * M_PI * $evre);
    $rx = round(abs($k) * $r, 2);

    if ($evre < 0.5) {
        $yarim = "A $r,$r 0 0 0 $c," . ($c + $r);           // sol yarım
        $yay   = "A $rx,$r 0 0 " . ($k > 0 ? 0 : 1) . " $c," . ($c - $r);
    } else {
        $yarim = "A $r,$r 0 0 1 $c," . ($c + $r);           // sağ yarım
        $yay   = "A $rx,$r 0 0 " . ($k > 0 ? 1 : 0) . " $c," . ($c - $r);
    }

    $golge = "M $c," . ($c - $r) . " $yarim $yay Z";

    return <<<SVG
    <svg class="ay" width="$boyut" height="$boyut" viewBox="0 0 40 40" aria-hidden="true">
      <circle cx="20" cy="20" r="19" class="ay-isik"/>
      <path d="$golge" class="ay-golge"/>
      <circle cx="20" cy="20" r="19" class="ay-cember"/>
    </svg>
    SVG;
}

function turkce_tarih(?int $zaman = null): string
{
    $zaman = $zaman ?? time();

    $aylar = ['ocak', 'şubat', 'mart', 'nisan', 'mayıs', 'haziran',
              'temmuz', 'ağustos', 'eylül', 'ekim', 'kasım', 'aralık'];
    $gunler = ['pazar', 'pazartesi', 'salı', 'çarşamba',
               'perşembe', 'cuma', 'cumartesi'];

    return (int) date('j', $zaman) . ' '
         . $aylar[(int) date('n', $zaman) - 1] . ' · '
         . $gunler[(int) date('w', $zaman)];
}

function saat(int $zaman): string
{
    return date('H:i', $zaman);
}
