<?php
/**
 * Takvim — kendi sayfası, tek ekrana sığar.
 * Rehber ve Ben sekmelerinden aynı yere gelinir.
 */

require_once __DIR__ . '/../parca/takvim.php';
require_once __DIR__ . '/../parca/faaliyet.php';

$et    = $v['etiket'];
$rh    = $v['rehber'];
$s     = 0;
$izler = gun_isaretleri($simdi);
$adlar = array_map(fn($k) => $rh['kumeler'][$k], $izler);
?>

<a class="geri gir" style="--sira: <?= $s++ ?>" href="<?= e(bag(['s' => 'rehber'])) ?>">
  <i class="ok sol"></i><?= e($et['rehbere_don']) ?>
</a>

<h1 class="takvim-ay gir" style="--sira: <?= $s++ ?>"><?= e(takvim_basligi($simdi)) ?></h1>

<div class="gir" style="--sira: <?= $s++ ?>">
  <?= takvim($simdi, $rh['kumeler']) ?>
</div>

<div class="lejant gir" style="--sira: <?= $s++ ?>">
  <?php foreach ($rh['kumeler'] as $k => $ad): ?>
    <span class="lejant-oge"><i class="iz iz-<?= e($k) ?>"></i><?= e($ad) ?></span>
  <?php endforeach; ?>
</div>

<section class="bolum gir" id="gun-ozeti" style="--sira: <?= $s++ ?>">
  <p class="soz" data-alan="baslik"><?= e(turkce_tarih($simdi)) ?></p>
  <p class="madde-not" data-alan="alt">
    <?= $adlar ? e(implode(' · ', $adlar)) : e($et['one_cikan_yok']) ?>
  </p>
</section>

<?php /* "Bunu ne zaman yapmalıyım?" — takvimin asıl aracı olduğu yer.
         Ay ızgarası "bu ay neler var" sorusuna cevap veriyor; burası tek
         bir soruya. Beş rengi aynı anda gösteren takvim güzel duruyor ama
         kimse ondan karar üretmiyor; faaliyet seçilince işe yarıyor.

         Bütün ay yeniden boyanmıyor — yedi gün yetiyor. "Bu hafta ne
         zaman" sorusunun cevabı yedi kutuya sığıyor, ay ızgarasını
         yeniden boyamak gösterişli ama gereksiz.

         Aynı anda tek satır açık kalıyor: liste taranabilir kalsın diye. */ ?>
<section class="bolum gir" style="--sira: <?= $s++ ?>">
  <div class="etiket"><?= e($et['ne_zaman']) ?></div>

  <?php foreach ($v['faaliyetler'] as $kume => $liste): ?>
    <div class="kume-baslik">
      <i class="iz iz-<?= e($kume) ?>"></i><?= e($rh['kumeler'][$kume]) ?>
    </div>

    <?php foreach ($liste as $i => $f):
        $kimlik  = 'f-' . $kume . '-' . $i;
        $hafta   = faaliyet_haftasi($f, $simdi);
        $uygunMu = in_array('uygun', array_column($hafta, 'durum'), true); ?>

      <div class="fa-satir basmali" data-ac="<?= $kimlik ?>" data-grup="faaliyet">
        <span class="fa-ad"><?= e($f['ad']) ?></span><i class="ok"></i>
      </div>

      <div class="detay" id="<?= $kimlik ?>"><div>
        <div class="fa-hafta">
          <?php foreach ($hafta as $j => $g): ?>
            <span class="fa-gun <?= $j === 0 ? 'bugun' : '' ?>">
              <i><?= e($g['harf']) ?></i>
              <b><?= $g['gun'] ?></b>
              <em class="fa-im fa-<?= e($g['durum']) ?>"></em>
            </span>
          <?php endforeach; ?>
        </div>

        <?php /* Hafta boyunca uygun gün yoksa kullanıcı çıkmaza giriyor. */ ?>
        <?php if (!$uygunMu): ?>
          <p class="fa-yok">
            <?= e($et['hafta_yok']) ?>
            <?php if ($yakin = ilk_uygun_gun($f, $simdi)): ?>
              · <?= e($et['en_yakin']) ?> <b><?= e($yakin) ?></b>
            <?php endif; ?>
          </p>
        <?php endif; ?>
      </div></div>

    <?php endforeach; ?>
  <?php endforeach; ?>

  <div class="lejant fa-lejant">
    <span class="lejant-oge"><em class="fa-im fa-uygun"></em><?= e($et['uygun'] ?? 'uygun') ?></span>
    <span class="lejant-oge"><em class="fa-im fa-ertele"></em>ertele</span>
    <span class="lejant-oge"><em class="fa-im fa-farketmez"></em>farketmez</span>
  </div>
</section>
