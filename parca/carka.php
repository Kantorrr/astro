<?php
/**
 * Doğum haritası çarkı — usturlap mantığında.
 *
 * Zenginlik süsten değil, aletin kendi ayrıntılarından gelir:
 * derece taksimatı, güçlendirilmiş köşe evleri, çift dış hat,
 * gezegenlerin yanında derece okuması.
 */

/**
 * Burcun elementi. Astrolojinin en temel ve en kolay anlaşılan
 * sınıflandırması — kullanıcı farkında olmadan öğreniyor.
 */
function burc_elementi(string $burc): string
{
    static $tablo = [
        'Koç' => 'ates',   'Aslan'  => 'ates',   'Yay'    => 'ates',
        'Boğa' => 'toprak','Başak'  => 'toprak', 'Oğlak'  => 'toprak',
        'İkizler' => 'hava','Terazi' => 'hava',  'Kova'   => 'hava',
        'Yengeç' => 'su',  'Akrep'  => 'su',     'Balık'  => 'su',
    ];
    return $tablo[$burc] ?? 'hava';
}

function nokta(float $aci, float $r): array
{
    $rad = deg2rad($aci);

    return [round(150 + $r * cos($rad), 1), round(150 - $r * sin($rad), 1)];
}

function cizgi(float $aci, float $r1, float $r2, string $sinif): string
{
    [$x1, $y1] = nokta($aci, $r1);
    [$x2, $y2] = nokta($aci, $r2);

    return "<line x1=\"$x1\" y1=\"$y1\" x2=\"$x2\" y2=\"$y2\" class=\"$sinif\"/>";
}

function harita_carki(array $gezegenler, array $acilar = []): string
{
    $ac = 180;                      // yükselen solda — geleneksel yerleşim

    $svg = '<svg class="carka" viewBox="0 0 300 300">';

    // Çift dış hat, taksimat halkası, iç alan, göbek
    foreach ([[148, 'c-dis'], [143, 'c-dis'], [120, 'c-orta'], [78, 'c-orta'], [20, 'c-ince']] as [$r, $sinif]) {
        $svg .= '<circle cx="150" cy="150" r="' . $r . '" class="' . $sinif . '"/>';
    }

    // Derece taksimatı — beş derecede bir kısa çentik
    for ($d = 0; $d < 360; $d += 5) {
        if ($d % 30 === 0) continue;
        $svg .= cizgi($ac + $d, 120, $d % 15 === 0 ? 130 : 126, 'c-centik');
    }

    // Ev sınırları; köşe evler (1, 4, 7, 10) daha güçlü ve merkeze kadar uzanır
    for ($e = 0; $e < 12; $e++) {
        $kose = $e % 3 === 0;
        $svg .= cizgi($ac + $e * 30, $kose ? 20 : 78, $kose ? 143 : 130,
                      $kose ? 'c-kose' : 'c-orta');
    }

    // Ev numaraları
    for ($e = 1; $e <= 12; $e++) {
        [$x, $y] = nokta($ac + ($e - 1) * 30 + 15, 134);
        $svg .= '<text x="' . $x . '" y="' . ($y + 4) . '" class="c-ev">' . $e . '</text>';
    }

    // Açı çizgileri — iç alanda.
    // İki tür var ve bu ayrım astrolojide evrensel: üçgen/altmışlık akıcı,
    // kare/karşıt gergin. Hepsi tek renk olunca çarkın ortası anlamsız bir
    // ağ oluyordu; renk hem canlandırıyor hem okunabilir kılıyor.
    foreach ($acilar as $a) {
        [$x1, $y1] = nokta($a[0], 78);
        [$x2, $y2] = nokta($a[1], 78);
        $tip = $a[2] ?? 'notr';
        $svg .= "<line x1=\"$x1\" y1=\"$y1\" x2=\"$x2\" y2=\"$y2\" class=\"c-aci c-aci-$tip\"/>";
    }

    // Gezegenler: sembol + derece okuması + geniş dokunma alanı.
    // Birbirine yakın duranlar üst üste binmesin diye iç halkaya kaydırılır —
    // harita yazılımlarının da yaptığı şey.
    $sirali = $gezegenler;
    usort($sirali, fn($a, $b) => ($a['aci'] ?? 0) <=> ($b['aci'] ?? 0));

    $oncekiAci = null;
    $oncekiIc  = false;

    foreach ($sirali as $g) {
        if (!isset($g['aci'])) continue;

        $yakin = $oncekiAci !== null && abs($g['aci'] - $oncekiAci) < 16;
        $ic    = $yakin && !$oncekiIc;
        $r     = $ic ? 88 : 106;

        $oncekiAci = $g['aci'];
        $oncekiIc  = $ic;

        [$x, $y] = nokta((float) $g['aci'], $r);
        $derece  = (int) fmod((float) $g['aci'], 30);
        $ad      = htmlspecialchars($g['ad'], ENT_QUOTES, 'UTF-8');
        $burc    = htmlspecialchars($g['burc'], ENT_QUOTES, 'UTF-8');
        $not     = htmlspecialchars($g['not'] ?? '', ENT_QUOTES, 'UTF-8');
        $one     = $g['ad'] === 'güneş' ? ' c-one' : '';

        $svg .= '<g class="gz' . $one . '" data-gz="' . $ad . '" tabindex="0"'
              . ' data-im="' . $g['im'] . '" data-burc="' . $burc . '"'
              . ' data-ev="' . $g['ev'] . '" data-derece="' . $derece . '"'
              . ' data-not="' . $not . '">'
              . '<circle cx="' . $x . '" cy="' . $y . '" r="17" class="c-alan"/>'
              . '<circle cx="' . $x . '" cy="' . $y . '" r="14" class="c-halka"/>'
              . '<text x="' . $x . '" y="' . ($y + 7) . '" class="c-gezegen">' . $g['im'] . '</text>'
              . '<text x="' . $x . '" y="' . ($y + 22) . '" class="c-derece">' . $derece . '°</text>'
              . '</g>';
    }

    return $svg . '</svg>';
}
