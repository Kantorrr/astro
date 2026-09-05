<?php
/**
 * Faaliyet kural motoru — "bunu ne zaman yapmalıyım?"
 *
 * Üç girdiye bakar: ay evresi, ayın burcu, Merkür geri hareketi.
 * Dördüncü bir girdi (gezegen açıları) eklemek kombinasyonu binlere
 * çıkarır ve kimse dolduramaz; üçte duruluyor.
 *
 * Sonuç üç durumdan biri: uygun · ertele · farketmez.
 * Çoğu gün "farketmez" çıkmalı — her güne hüküm veren uygulama sahte
 * kesinlik üretir ve güvenilirliğini kaybeder.
 *
 * ⚠️ AÇIK İŞ: Rehber'in "bugün yap / bugün yapma" listesi hâlâ elle
 * yazılı (icerik/veri.php → rehber). O liste de bu motordan üretilmeli,
 * yoksa iki kaynak çelişiyor.
 *
 * ⚠️ Listede ameliyat, diş çektirme, tedavi, ilaç, yatırım ve hamilelik
 * YOK. Geleneksel ruznamelerde vardır ama bir uygulamanın "bugün ameliyat
 * olma" demesi başka bir şey: kullanıcı gerçekten ertelerse doğacak zarar
 * uygulamanın kazanacağı hiçbir şeyle karşılanmaz.
 */

/**
 * Ayın burcu — ortalama boylam üzerinden yaklaşık hesap.
 * Ay günde ~13.18° ilerler, yani 2.2 günde bir burç değiştirir.
 * Gerçek uygulamada efemeristen gelecek.
 */
function ay_burcu(int $zaman): string
{
    $gun = ($zaman - 946728000) / 86400.0;          // J2000'den beri geçen gün
    $boylam = fmod(218.316 + 13.176396 * $gun, 360);
    if ($boylam < 0) $boylam += 360;

    $burclar = ['Koç', 'Boğa', 'İkizler', 'Yengeç', 'Aslan', 'Başak',
                'Terazi', 'Akrep', 'Yay', 'Oğlak', 'Kova', 'Balık'];

    return $burclar[(int) ($boylam / 30)];
}

/**
 * Bir faaliyetin o gündeki durumu.
 *
 * Puan mantığı: ay evresi yönü tutuyorsa +1, tersse -1; ayın burcunun
 * elementi faaliyete uygunsa +1; Merkür geri ve faaliyet ondan
 * etkileniyorsa -2. Eşikler dar tutuldu ki çoğu gün "farketmez" kalsın.
 */
function faaliyet_durumu(array $f, int $zaman): string
{
    require_once __DIR__ . '/carka.php';

    $evre = ay_evresi($zaman);
    $puan = 0;

    // Büyüyen ay: başlatmak, büyütmek. Küçülen ay: kesmek, bitirmek, arındırmak.
    $buyuyen = $evre > 0.08 && $evre < 0.45;
    $kuculen = $evre > 0.55 && $evre < 0.95;

    if ($f['yon'] === 'buyuk') $puan += $buyuyen ? 1 : ($kuculen ? -1 : 0);
    if ($f['yon'] === 'kucuk') $puan += $kuculen ? 1 : ($buyuyen ? -1 : 0);

    // Ay evresinin etkilemediği işlerde (konuşma, yolculuk, karar) burcun
    // elementi tek belirleyici kalıyor; o yüzden orada daha ağır sayılıyor.
    // Yoksa 'notr' faaliyetler hiçbir zaman eşiğe ulaşmıyor ve o kümeler
    // takvimde bomboş görünüyordu.
    if (!empty($f['element'])
        && in_array(burc_elementi(ay_burcu($zaman)), $f['element'], true)) {
        $puan += $f['yon'] === 'notr' ? 2 : 1;
    }

    if (!empty($f['retro'])) $puan -= 1;   // prototipte Merkür sürekli geri

    // Eşikler dar: "ertele" demek için iki olumsuz koşul birden gerekiyor.
    // Tek koşulla ertele denince bir haftanın tamamı kırmızıya dönüyor ve
    // uygulama sürekli "yapma" diyen bir şeye benziyor.
    if ($puan >= 2)  return 'uygun';
    if ($puan <= -2) return 'ertele';
    return 'farketmez';
}

/** Bugünden başlayan yedi gün. Pazartesiden değil — karar penceresi bugün. */
function faaliyet_haftasi(array $f, int $simdi): array
{
    $gunler = [];
    for ($i = 0; $i < 7; $i++) {
        $z = strtotime("+$i day", $simdi);
        $gunler[] = [
            'gun'   => (int) date('j', $z),
            'harf'  => ['Pa','Pt','Sa','Ça','Pe','Cu','Ct'][(int) date('w', $z)],
            'durum' => faaliyet_durumu($f, $z),
        ];
    }
    return $gunler;
}

/**
 * Hafta boyunca uygun gün yoksa kullanıcı çıkmaza giriyor.
 * İki ay ileriye kadar bakıp ilk uygun günü söylüyoruz.
 */
function ilk_uygun_gun(array $f, int $simdi): ?string
{
    $aylar = ['ocak','şubat','mart','nisan','mayıs','haziran',
              'temmuz','ağustos','eylül','ekim','kasım','aralık'];

    for ($i = 7; $i < 67; $i++) {
        $z = strtotime("+$i day", $simdi);
        if (faaliyet_durumu($f, $z) === 'uygun') {
            return (int) date('j', $z) . ' ' . $aylar[(int) date('n', $z) - 1];
        }
    }
    return null;
}
