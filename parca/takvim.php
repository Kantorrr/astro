<?php
/**
 * Aylık takvim — her günün kutusunda o günün faaliyet işaretleri.
 *
 * İşaretler ay evresinden türetiliyor. Prototipte kaba bir kural kümesi;
 * gerçek uygulamada Ay'ın burcu + evre tablosundan gelecek.
 */

/**
 * Bugünün işaretleri kaba kuraldan değil, o günün gerçek tavsiye
 * listesinden gelir.
 *
 * Önce ikisi ayrı kaynaktandı: şerit aşağıdaki kuraldan, maddeler veri
 * dosyasından. Sonuç: Rehber "konuşmanın ve yola çıkmanın günü" diyor,
 * yanındaki renkli etiket "para & iş" diyordu. Kullanıcı bunu ilk bakışta
 * yakalar. Gerçek uygulamada da aynı tuzak geçerli — kural motoru ile
 * metin ayrı kaynaklardan gelemez.
 */
function bugunun_kumeleri(?array $ayarla = null): array
{
    static $kumeler = [];
    if ($ayarla !== null) $kumeler = $ayarla;
    return $kumeler;
}

/** Tavsiye listesinden (yap + yapma) günün faaliyet kümelerini çıkarır. */
function kumeleri_topla(array $rehber): array
{
    return array_values(array_unique(array_merge(
        array_column($rehber['yap'],   'kume'),
        array_column($rehber['yapma'], 'kume')
    )));
}

function gun_isaretleri(int $zaman): array
{
    // Bugün için gerçek liste varsa kaba kural devreye girmez.
    if (date('Y-m-d', $zaman) === date('Y-m-d') && bugunun_kumeleri()) {
        return array_slice(bugunun_kumeleri(), 0, 3);
    }

    $evre = ay_evresi($zaman);
    $gun  = (int) date('z', $zaman);
    $i    = [];

    // Küçülen ayda kesme ve arındırma işleri öne çıkar
    if ($evre > 0.52 && $gun % 2 === 0) $i[] = 'beden';

    // Yeniay ve dolunay çevresi
    if ($evre < 0.10 || $evre > 0.93)   $i[] = 'ic';
    if (abs($evre - 0.5) < 0.07)        $i[] = 'iliski';

    if ($gun % 3 === 0) $i[] = 'para';
    if ($gun % 4 === 1) $i[] = 'yol';
    if ($gun % 5 === 2) $i[] = 'iliski';

    return array_slice(array_unique($i), 0, 3);
}

function takvim(int $simdi, array $kumeler = []): string
{
    $aylar = ['ocak', 'şubat', 'mart', 'nisan', 'mayıs', 'haziran',
              'temmuz', 'ağustos', 'eylül', 'ekim', 'kasım', 'aralık'];

    $yil   = (int) date('Y', $simdi);
    $ay    = (int) date('n', $simdi);
    $bugun = (int) date('j', $simdi);
    $ilk   = mktime(0, 0, 0, $ay, 1, $yil);
    $adet  = (int) date('t', $ilk);

    // Hafta pazartesiden başlar
    $bosluk = ((int) date('N', $ilk)) - 1;

    $h = '<div class="takvim">';

    foreach (['Pt', 'Sa', 'Ça', 'Pe', 'Cu', 'Ct', 'Pa'] as $g) {
        $h .= '<span class="tk-baslik">' . $g . '</span>';
    }

    for ($b = 0; $b < $bosluk; $b++) {
        $h .= '<span class="tk-bos"></span>';
    }

    for ($g = 1; $g <= $adet; $g++) {
        $zaman   = mktime(12, 0, 0, $ay, $g, $yil);
        $izler   = gun_isaretleri($zaman);
        $evre    = ay_evresi($zaman);

        $adlar = array_map(fn($k) => $kumeler[$k] ?? $k, $izler);

        $gunler = ['pazar', 'pazartesi', 'salı', 'çarşamba',
                   'perşembe', 'cuma', 'cumartesi'];

        $baslik = $g . ' ' . $aylar[$ay - 1] . ' · ' . $gunler[(int) date('w', $zaman)];
        $alt    = $adlar ? implode(' · ', $adlar) : 'öne çıkan bir alan yok';

        $h .= '<button type="button" class="tk-gun' . ($g === $bugun ? ' etkin' : '') . '"'
            . ' data-gun="' . $g . '"'
            . ' data-baslik="' . htmlspecialchars($baslik, ENT_QUOTES, 'UTF-8') . '"'
            . ' data-alt="' . htmlspecialchars($alt, ENT_QUOTES, 'UTF-8') . '"'
            . ' data-izler="' . implode(',', $izler) . '">'
            . '<b>' . $g . '</b><span class="tk-izler">';

        foreach ($izler as $k) {
            $h .= '<i class="iz iz-' . $k . '"></i>';
        }

        $h .= '</span></button>';
    }

    return $h . '</div>';
}

function takvim_basligi(int $simdi): string
{
    $aylar = ['ocak', 'şubat', 'mart', 'nisan', 'mayıs', 'haziran',
              'temmuz', 'ağustos', 'eylül', 'ekim', 'kasım', 'aralık'];

    return $aylar[(int) date('n', $simdi) - 1] . ' ' . date('Y', $simdi);
}
