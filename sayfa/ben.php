<?php
/**
 * Ben — künye.
 *
 * Bu tür ekranların doğal eğilimi ayar çöplüğüne dönüşmek. Direniyoruz:
 * sayfa bir ayar listesi değil, ruzname'nin ilk yaprağı — "bu takvim
 * kimin için hazırlandı". Ayarlar en altta, tek satırın içinde duruyor.
 */

$et = $v['etiket'];
$bn = $v['ben'];
$s  = 0;
?>

<section class="kunye gir" style="--sira: <?= $s++ ?>">
  <div class="etiket"><?= e($et['kunye']) ?></div>
  <p class="kunye-ad"><?= e($v['kullanici']['ad']) ?></p>

  <?php /* Üstteki üç satır kullanıcının girdiği, alttaki üçü ondan
           hesaplanan. Aradaki çizgi tam olarak bunu söylüyor. */ ?>
  <table class="cizelge kunye-tablo">
    <?php foreach ($bn['girilen'] as $g): ?>
    <tr><td class="ad"><?= e($g['ad']) ?></td>
        <td class="sag koyu"><?= e($g['deger']) ?></td></tr>
    <?php endforeach; ?>
    <?php /* Hesaplananlar bakır: girilen ile çıkarılanı ayıran şey
             yalnızca çizgi değil, renk de. */ ?>
    <?php foreach ($bn['hesaplanan'] as $i => $h): ?>
    <tr class="<?= $i === 0 ? 'ayrilan' : '' ?>">
        <td class="ad"><?= e($h['ad']) ?></td>
        <td class="sag hesap"><?= e($h['deger']) ?></td></tr>
    <?php endforeach; ?>
  </table>

  <span class="ac-yalin"><?= e($et['duzenle']) ?></span>
</section>

<?php /* Seri (streak) yok — bilerek. Yalnızca gerçekten ölçülen üç sayı. */ ?>
<section class="bolum gir" style="--sira: <?= $s++ ?>">
  <div class="etiket"><?= e($et['ilerleme']) ?></div>
  <div class="sayaclar">
    <?php foreach ($bn['sayaclar'] as $c): ?>
      <div class="sayac">
        <span class="sayac-deger"><?= e($c['deger']) ?></span>
        <span class="sayac-ad"><?= e($c['ad']) ?></span>
      </div>
    <?php endforeach; ?>
  </div>
</section>

<?php /* Sinastri kapısı. Karşı tarafın uygulamada olmasına gerek yok —
         bilgiyi kullanıcı giriyor, kayıt yalnızca kendi hesabında duruyor. */ ?>
<section class="bolum gir" style="--sira: <?= $s++ ?>">
  <div class="etiket"><?= e($et['kisiler']) ?></div>
  <?php foreach ($bn['kisiler'] as $k): ?>
    <a class="yol-satir kisi" href="<?= e(bag(['s' => 'uyum'])) ?>">
      <div>
        <p class="yol-ad"><?= e($k['ad']) ?></p>
        <p class="yol-ozet"><?= e($k['alt']) ?></p>
      </div>
      <span class="yol-durum"><?= e($et['uyuma_bak']) ?><i class="ok sag"></i></span>
    </a>
  <?php endforeach; ?>
  <a class="ac-yalin ekle" href="<?= e(bag(['s' => 'kisi'])) ?>"><?= e($et['kisi_ekle']) ?></a>
</section>

<section class="bolum gir" style="--sira: <?= $s++ ?>">
  <div class="etiket"><?= e($et['aldiklarin']) ?></div>
  <div class="yol-satir">
    <div>
      <p class="yol-ad"><?= e($bn['satinalim']['baslik']) ?></p>
      <p class="yol-ozet"><?= e($bn['satinalim']['alt']) ?></p>
    </div>
    <span class="yol-durum"><i class="ok sag"></i></span>
  </div>
  <span class="yesim-baglanti"><?= e($et['yeni_yorum']) ?></span>
</section>

<?php /* Keşfet, Yolculuk ve Rehber'den kaydedilenler tek yerde.
         Dağıtırsak kullanıcı hiçbirini bir daha bulamıyor. */ ?>
<section class="bolum gir" style="--sira: <?= $s++ ?>">
  <div class="etiket"><?= e($et['kaydettiklerin']) ?></div>
  <table class="cizelge">
    <?php foreach ($bn['kayitli'] as $k): ?>
    <tr><td class="isim koyu"><?= e($k['ad']) ?></td>
        <td class="sag sayi"><?= e($k['deger']) ?></td></tr>
    <?php endforeach; ?>
  </table>
</section>

<?php /* Takvim kapısı ve ayarlar tek bölümde. Her biri ayrı bölüm
         olduğunda tek satır için 50px'lik çerçeve harcanıyordu.
         İkisi de sayfanın en sessiz işleri — yan yana dursunlar. */ ?>
<section class="bolum gir kuyruk" style="--sira: <?= $s++ ?>">
  <a class="ay-baglanti" href="<?= e(bag(['s' => 'takvim'])) ?>">
    <?= e($et['takvimi_ac']) ?><i class="ok sag"></i>
  </a>

  <span class="ac" data-ac="d-ayar"
        data-acmetin="<?= e($et['ayarlar']) ?>"
        data-kapat="<?= e($et['kapat']) ?>"><?= e($et['ayarlar']) ?></span>
  <div class="detay" id="d-ayar"><div>
    <?php foreach ($bn['ayarlar'] as $a): ?>
      <p class="ayar-satir"><?= e($a) ?></p>
    <?php endforeach; ?>
  </div></div>
</section>
