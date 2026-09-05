<?php
/**
 * Kişi ekleme formu.
 *
 * Aynı ekran giriş akışında da kullanılacak (kendi doğum bilgin) —
 * alanlar ve düzen bir kere yazılıp iki yerde çalışacak.
 *
 * Kutulu giriş alanı yok: kutu kart demek, kart jenerik demek.
 * Alanlar cetvel çizgisinin üstünde duruyor, kâğıt forma benziyor.
 * Odaklanınca çizgi bakıra dönüyor — tek geri bildirim bu.
 */

$et = $v['etiket'];
$fr = $v['kisi_formu'];
$s  = 0;
?>

<a class="geri gir" style="--sira: <?= $s++ ?>" href="<?= e(bag(['s' => 'ben'])) ?>">
  <i class="ok sol"></i><?= e($et['bene_don']) ?>
</a>

<section class="gir form-ust" style="--sira: <?= $s++ ?>">
  <p class="kunye-ad"><?= e($fr['baslik']) ?></p>
  <?php /* Saatin neden istendiği gizlenmiyor. Kullanıcı sebebini
           bilmezse ya rastgele giriyor ya da vazgeçiyor. */ ?>
  <p class="yol-ozet"><?= e($fr['ozet']) ?></p>
</section>

<section class="gir form" style="--sira: <?= $s++ ?>">

  <?php foreach ($fr['alanlar'] as $a): ?>
  <label class="alan">
    <span class="alan-etiket"><?= e($a['etiket']) ?></span>
    <input class="alan-giris" type="text" placeholder="<?= e($a['ipucu']) ?>">
  </label>
  <?php endforeach; ?>

  <?php /* Tarih tek kutuda değil üç alanda: telefonda tarih seçici
           açmak akışı kesiyor, üç kısa alan daha hızlı doldurulıyor. */ ?>
  <div class="alan">
    <span class="alan-etiket"><?= e($fr['tarih']['etiket']) ?></span>
    <div class="alan-bolmeli">
      <input class="alan-giris kisa" inputmode="numeric" maxlength="2"
             placeholder="<?= e($fr['tarih']['gun']) ?>">
      <input class="alan-giris kisa" inputmode="numeric" maxlength="2"
             placeholder="<?= e($fr['tarih']['ay']) ?>">
      <input class="alan-giris orta" inputmode="numeric" maxlength="4"
             placeholder="<?= e($fr['tarih']['yil']) ?>">
    </div>
  </div>

  <div class="alan">
    <span class="alan-etiket"><?= e($fr['saat']['etiket']) ?></span>
    <div class="alan-bolmeli dar">
      <input class="alan-giris kisa" inputmode="numeric" maxlength="2"
             placeholder="<?= e($fr['saat']['sa']) ?>">
      <span class="alan-ayrac">:</span>
      <input class="alan-giris kisa" inputmode="numeric" maxlength="2"
             placeholder="<?= e($fr['saat']['dk']) ?>">
    </div>
  </div>

  <label class="alan">
    <span class="alan-etiket"><?= e($fr['yer']['etiket']) ?></span>
    <input class="alan-giris" type="text" placeholder="<?= e($fr['yer']['ipucu']) ?>">
  </label>

</section>

<?php /* KVKK'nın karşılığı tek cümle. Küçük punto ama gizli değil —
         en hassas veriyi isteyen ekran bunu söylemeden geçemez. */ ?>
<section class="gir" style="--sira: <?= $s++ ?>">
  <p class="gizlilik"><?= e($fr['gizlilik']) ?></p>

  <div class="form-eylem">
    <a class="yesim-baglanti" href="<?= e(bag(['s' => 'uyum'])) ?>"><?= e($fr['kaydet']) ?></a>
    <a class="ac-yalin sade" href="<?= e(bag(['s' => 'ben'])) ?>"><?= e($fr['vazgec']) ?></a>
  </div>
</section>
