<?php
/**
 * Uyum (sinastri) — iki haritanın üst üste bindirilmesi.
 *
 * Yüzde yok. "%87 uyumlusunuz" bir hüküm veriyor, bir şey anlatmıyor;
 * kullanıcı düşük sayı görürse ilişkisini sorguluyor, yüksek görürse
 * hiçbir şey öğrenmiyor. Üstelik o ekran Co-Star klonu görüntüsünün
 * ana kaynağı. Onun yerine kategori kategori anlatım.
 *
 * İki mürekkep: zorlanılan alanların başlığı bakır, kolay olanlar siyah.
 */

$et = $v['etiket'];
$uy = $v['uyum'];
$k  = $uy['kisi'];
$s  = 0;
?>

<a class="geri gir" style="--sira: <?= $s++ ?>" href="<?= e(bag(['s' => 'ben'])) ?>">
  <i class="ok sol"></i><?= e($et['bene_don']) ?>
</a>

<section class="gir uyum-ust" style="--sira: <?= $s++ ?>">
  <p class="kunye-ad"><?= e($v['kullanici']['ad']) ?> <i>&</i> <?= e($k['ad']) ?></p>
  <p class="yol-ozet"><?= e($k['dogum']) ?></p>

  <p class="ikili uclu">
    <span><i><?= e($et['gunes']) ?></i> <?= e($k['gunes']) ?></span>
    <span><i><?= e($et['ay']) ?></i> <?= e($k['ay']) ?></span>
    <span><i><?= e($et['yukselen']) ?></i> <?= e($k['yukselen']) ?></span>
  </p>

  <p class="soz uyum-ozet"><?= e($uy['ozet']) ?></p>
</section>

<?php foreach ($uy['kategoriler'] as $c): ?>
<section class="bolum gir" style="--sira: <?= $s++ ?>">
  <div class="etiket kat-ust">
    <span><?= e($c['ad']) ?></span>
    <span class="kat-durum kat-<?= e($c['durum']) ?>"><?= e($et[$c['durum']]) ?></span>
  </div>
  <p class="soz kat-<?= e($c['durum']) ?>"><?= e($c['baslik']) ?></p>
  <p class="govde"><?= e($c['metin']) ?></p>
  <p class="dayanak"><?= e($c['dayanak']) ?></p>
</section>
<?php endforeach; ?>
