<?php
/**
 * Yolculuk — Yeşim Hanım'ın eğitim kütüphanesi.
 *
 * Yatay raf kullanılmıyor. Ekranın cevapladığı soru "ne izlesem" değil,
 * "nerede kalmıştım". O yüzden düzen bir katalog değil, dikey bir yol:
 * duraklar alt alta, aralarında çizgi, geçtiklerin dolu.
 *
 * Her durak ve her yolculuk basılabilir: dokununca yerinde açılıyor.
 * Ayrı bir sayfaya gitmiyor — yol bozulmasın, kaydırma yeri kaybolmasın.
 *
 * Kapak görseli yok. Bu dilde fotoğraf çerçevelenemiyor (belge 6.9d);
 * ayırt edici olan ad ve süre — ikisi de tipografiyle söyleniyor.
 */

$et = $v['etiket'];
$yl = $v['yolculuk'];
$sr = $yl['suren'];
$s  = 0;
?>

<section class="suren gir" style="--sira: <?= $s++ ?>">
  <div class="etiket"><?= e($et['kaldigin_yer']) ?></div>
  <p class="suren-seri"><?= e($sr['seri']) ?></p>
  <p class="soz"><?= e($sr['baslik']) ?></p>
  <p class="dayanak"><?= (int) $sr['bolum'] ?>. <?= e($et['bolum']) ?> · <?= e($sr['sure']) ?></p>
  <span class="yesim-baglanti"><?= e($sr['buton']) ?></span>
</section>

<?php /* Yolculuk'u uygulamanın geri kalanına bağlayan tek satır.
         Bu sayfa boş hissettiriyorsa sebebi süssüzlük değil, gökyüzüyle
         arasında bağ olmamasıydı. Astroloji ve Rehber ne diyorsa,
         Yolculuk da ona bir karşılık veriyor. */ ?>
<section class="bolum gir denk" style="--sira: <?= $s++ ?>">
  <div class="etiket"><?= e($et['bugune']) ?></div>
  <div class="denk-satir">
    <span class="denk-ad"><?= e($yl['bugune']['ad']) ?></span>
    <span class="denk-sure"><?= e($yl['bugune']['sure']) ?></span>
  </div>
  <p class="yol-ozet"><?= e($yl['bugune']['ozet']) ?></p>
  <?php /* Öneri Rehber'in o günkü kümesinden geliyor — rengi de oradan. */ ?>
  <div class="kume-serit">
    <span class="kume-rozet"><i class="iz iz-<?= e($yl['bugune']['kume']) ?>"></i><?=
      e($v['rehber']['kumeler'][$yl['bugune']['kume']]) ?></span>
  </div>
  <p class="dayanak"><?= e($yl['bugune']['dayanak']) ?></p>
</section>

<?php /* Yolun kendisi. İlerlemeyi anlatan şey rozet ya da yüzde değil,
         kaç durak geride kaldığının görünmesi. */ ?>
<section class="bolum gir" style="--sira: <?= $s++ ?>">
  <div class="etiket"><?= e($et['bu_seride']) ?></div>
  <ol class="yol">
    <?php foreach ($yl['duraklar'] as $d): ?>
    <li class="durak durak-<?= e($d['durum']) ?>">
      <div class="durak-ust basmali" data-ac="dr-<?= (int) $d['no'] ?>">
        <i class="isaret"></i>
        <span class="durak-ad"><?= e($d['ad']) ?></span>
        <span class="durak-sure"><?= e($d['sure']) ?><i class="ok"></i></span>
      </div>
      <div class="detay girintili" id="dr-<?= (int) $d['no'] ?>"><div>
        <p class="govde"><?= e($d['detay']) ?></p>
        <span class="yesim-baglanti"><?=
          e($d['durum'] === 'bitti' ? $et['tekrar_dinle'] : $et['dinle'])
        ?></span>
      </div></div>
    </li>
    <?php endforeach; ?>
  </ol>
</section>

<section class="bolum gir" style="--sira: <?= $s++ ?>">
  <div class="etiket"><?= e($et['diger_yollar']) ?></div>
  <?php foreach ($yl['diger'] as $i => $y):
      $tam = $y['biten'] >= $y['bolum']; ?>
    <div class="yol-oge">
      <div class="yol-satir basmali" data-ac="yl-<?= $i ?>">
        <div>
          <p class="yol-ad"><?= e($y['ad']) ?></p>
          <p class="yol-ozet"><?= e($y['ozet']) ?></p>
        </div>
        <?php /* Durum tek satırda: ya bitmiş, ya kaçta kaç, ya hiç başlanmamış. */ ?>
        <span class="yol-durum <?= $tam ? 'tam' : '' ?>">
          <?php if ($tam): ?>
            <?= e($et['tamamlandi']) ?>
          <?php elseif ($y['biten'] > 0): ?>
            <?= (int) $y['biten'] ?>/<?= (int) $y['bolum'] ?>
          <?php else: ?>
            <?= (int) $y['bolum'] ?> <?= e($et['bolum']) ?>
          <?php endif; ?>
          <i class="ok"></i>
        </span>
      </div>
      <div class="detay" id="yl-<?= $i ?>"><div>
        <div class="etiket"><?= e($et['ilk_bolumler']) ?></div>
        <table class="cizelge">
          <?php foreach ($y['bolumler'] as $b): ?>
          <tr>
            <td class="isim koyu"><?= e($b['ad']) ?></td>
            <td class="sag"><?= e($b['sure']) ?></td>
          </tr>
          <?php endforeach; ?>
        </table>
        <span class="yesim-baglanti"><?= e($et['seriye_bak']) ?></span>
      </div></div>
    </div>
  <?php endforeach; ?>
</section>

<section class="bolum gir" style="--sira: <?= $s++ ?>">
  <div class="etiket"><?= e($et['tek_seferlik']) ?></div>
  <table class="cizelge">
    <?php foreach ($yl['tekli'] as $t): ?>
    <tr>
      <td class="isim koyu"><?= e($t['ad']) ?></td>
      <td class="sag"><?= e($t['sure']) ?></td>
    </tr>
    <?php endforeach; ?>
  </table>
</section>
