<?php
/**
 * Astroloji — rulo. Kesintisiz tek şerit, cetvelle bölünmüş.
 *
 * Yer ekonomisi: ay bilgisi "bugün"e katıldı; çin ve numeroloji
 * ayrı bölümler değil, açılabilir çizelge satırları.
 */

$et = $v['etiket'];
$s  = 0;   // sıralı giriş sayacı

// Günün faaliyet işaretleri Rehber ile ortak motordan geliyor.
require_once __DIR__ . '/../parca/takvim.php';
require_once __DIR__ . '/../parca/carka.php';
?>

<?php /* Dönem uyarısı. Bir kez etiket + eylem + dipnot düzenine
         çevrildi, ağır durdu, geri alındı. Tek satırlık bir uyarı üç
         kademeli başlık düzenini kaldırmıyor. */ ?>
<?php if ($v['retro']['etkin']): ?>
<div class="retro gir" style="--sira: <?= $s++ ?>">
  <b><?= e($v['retro']['gezegen']) ?></b>
  <span><?= e($v['retro']['metin']) ?> <?= e($v['retro']['oneri']) ?></span>
</div>
<?php endif; ?>

<section class="kimlik gir" style="--sira: <?= $s++ ?>">
  <?= harita_carki($v['gokyuzu'], $v['acilar']) ?>

  <?php /* Açı renklerinin karşılığı — çarkın ortasındaki çizgiler. */ ?>
  <div class="lejant orta">
    <span class="lejant-oge"><em class="ac-iz ac-akici"></em><?= e($et['akici']) ?></span>
    <span class="lejant-oge"><em class="ac-iz ac-gergin"></em><?= e($et['gergin']) ?></span>
  </div>

  <p class="okuma" id="okuma"><span class="okuma-ipucu"><?= e($et['carka_ipucu']) ?></span></p>

  <div class="kimlik-etiket"><?= e($et['gunes_burcun']) ?></div>
  <div class="kimlik-burc"><?= e($v['kullanici']['gunes']) ?></div>

  <?php /* Üçlünün her biri kendi elementinin rengiyle işaretli —
           aynı renkler aşağıdaki gökyüzü çizelgesinde de var. */ ?>
  <p class="ikili">
    <span><i><?= e($et['ay']) ?></i><em class="el el-<?= e(burc_elementi($v['kullanici']['ay'])) ?>"></em><?= e($v['kullanici']['ay']) ?></span>
    <span><i><?= e($et['yukselen']) ?></i><em class="el el-<?= e(burc_elementi($v['kullanici']['yukselen'])) ?>"></em><?= e($v['kullanici']['yukselen']) ?></span>
  </p>
</section>

<?php /* 44px'lik ay çizimi kaldırıldı: metni sağa itip bölümü diğerleriyle
         hizasız bırakıyordu, üstelik bilgi tekrarıydı — "küçülen ay" zaten
         dayanak satırında duruyor. */ ?>
<section class="bolum gir" style="--sira: <?= $s++ ?>">
  <div class="etiket"><?= e($et['bugun']) ?></div>
  <p class="soz"><?= e($v['bugun']['baslik']) ?></p>
  <p class="govde"><?= e($v['bugun']['ozet']) ?></p>
  <?php /* Bugünün işaretleri Rehber'in tavsiye listesinden geliyor:
           tek kaynak, aynı renk, aynı gün. */ ?>
  <div class="kume-serit">
    <?php foreach (gun_isaretleri($simdi) as $k): ?>
      <span class="kume-rozet"><i class="iz iz-<?= e($k) ?>"></i><?= e($v['rehber']['kumeler'][$k]) ?></span>
    <?php endforeach; ?>
  </div>
  <p class="dayanak"><?= e($v['bugun']['dayanak']) ?> · <?= e(ay_evresi_adi($evre)) ?></p>
  <span class="ac" data-ac="d-bugun"
        data-acmetin="<?= e($et['daha_fazla']) ?>"
        data-kapat="<?= e($et['kapat']) ?>"><?= e($et['daha_fazla']) ?></span>
  <div class="detay" id="d-bugun"><div>
    <p class="govde"><?= e($v['bugun']['detay']) ?></p>
  </div></div>
</section>

<section class="bolum gir" style="--sira: <?= $s++ ?>">
  <div class="etiket"><?= e($et['gokyuzu']) ?></div>
  <table class="cizelge">
    <?php foreach ($v['gokyuzu'] as $g): ?>
    <tr data-gz="<?= e($g['ad']) ?>">
      <td class="im"><?= $g['im'] ?></td>
      <td class="ad"><?= e($g['ad']) ?></td>
      <td><em class="el el-<?= e(burc_elementi($g['burc'])) ?>"></em><?= e($g['burc']) ?><?php if (!empty($g['not'])): ?>
          <span class="isaret"> · <?= e($g['not']) ?></span><?php endif; ?></td>
      <td class="sag"><?= e($g['ev']) ?>. ev</td>
    </tr>
    <?php endforeach; ?>
  </table>

  <?php /* Renklerin karşılığı hemen altında. Kullanıcı astroloji bilmiyor;
           dört element en kolay öğrenilen sınıflandırma. */ ?>
  <div class="lejant">
    <?php foreach (['ates', 'toprak', 'hava', 'su'] as $el): ?>
      <span class="lejant-oge"><em class="el el-<?= $el ?>"></em><?= e($et[$el]) ?></span>
    <?php endforeach; ?>
  </div>
</section>

<section class="bolum gir" style="--sira: <?= $s++ ?>">
  <div class="satir" data-ac="d-cin">
    <div class="etiket"><?= e($et['cin']) ?><i class="ok"></i></div>
    <p class="satir-deger"><?= e($v['cin']['hayvan']) ?></p>
    <p class="satir-ozet"><?= e($v['cin']['ozet']) ?></p>
  </div>
  <div class="detay" id="d-cin"><div>
    <p class="govde"><?= e($v['cin']['detay']) ?></p>
  </div></div>

  <div class="satir" data-ac="d-num">
    <div class="etiket"><?= e($et['numeroloji']) ?><i class="ok"></i></div>
    <p class="satir-deger"><?= e($v['numeroloji']['baslik']) ?></p>
    <p class="satir-ozet"><?= e($v['numeroloji']['ozet']) ?></p>
  </div>
  <div class="detay" id="d-num"><div>
    <p class="govde"><?= e($v['numeroloji']['detay']) ?></p>
  </div></div>
</section>

<section class="bolum gir yesim" style="--sira: <?= $s++ ?>">
  <div class="etiket"><?= e($et['yesimden']) ?></div>
  <p class="soz"><?= e($v['yesim']['baslik']) ?></p>
  <span class="yesim-baglanti"><?= e($v['yesim']['buton']) ?></span>
  <span class="imza"><?= e($v['yesim']['alt']) ?></span>
</section>
