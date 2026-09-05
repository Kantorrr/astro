<?php
/**
 * Rehber — tek takvim, üstünde o günün her şeyi.
 *
 * Ruzname mantığı burada en açık haliyle: bir gün, bir yaprak,
 * yapılacaklar ve yapılmayacaklar çizelgesi.
 * İki mürekkep kuralı: ertelenecek işler bakır, uygun olanlar siyah.
 */

$et = $v['etiket'];
$rh = $v['rehber'];
$s  = 0;

// Tek harf yetmiyor: Pazar, Pazartesi ve Perşembe hepsi "P" olurdu.
require_once __DIR__ . '/../parca/takvim.php';
?>

<nav class="hafta gir" style="--sira: <?= $s++ ?>">
  <?php for ($i = -3; $i <= 3; $i++):
      $g = strtotime("$i day", $simdi); ?>
    <span class="hafta-gun <?= $i === 0 ? 'etkin' : '' ?>">
      <i><?= ['Pa','Pt','Sa','Ça','Pe','Cu','Ct'][(int) date('w', $g)] ?></i>
      <b><?= (int) date('j', $g) ?></b>
      <span class="tk-izler">
        <?php foreach (gun_isaretleri($g) as $k): ?><em class="iz iz-<?= $k ?>"></em><?php endforeach; ?>
      </span>
    </span>
  <?php endfor; ?>
</nav>

<a class="ay-baglanti gir" style="--sira: <?= $s++ ?>" href="<?= e(bag(['s' => 'takvim'])) ?>">
  <?= e($et['ay_gorunumu']) ?><i class="ok sag"></i>
</a>

<?php /* Günün hangi alanlara dokunduğu, takvimdeki renklerin kelimeyle
         karşılığı. Lejantı ayrı bir yerde aramaya gerek kalmıyor:
         bugünün işaretleri bugünün başlığının altında duruyor. */ ?>
<section class="gir yaprak-ust" style="--sira: <?= $s++ ?>">
  <p class="soz"><?= e($rh['baslik']) ?></p>
  <p class="govde"><?= e($rh['ozet']) ?></p>
  <div class="kume-serit">
    <?php foreach (gun_isaretleri($simdi) as $k): ?>
      <span class="kume-rozet"><i class="iz iz-<?= e($k) ?>"></i><?= e($rh['kumeler'][$k]) ?></span>
    <?php endforeach; ?>
  </div>
  <p class="dayanak"><?= e($rh['dayanak']) ?></p>
</section>

<section class="bolum gir" style="--sira: <?= $s++ ?>">
  <div class="etiket"><?= e($et['yap']) ?></div>
  <?php foreach ($rh['yap'] as $m): ?>
    <div class="madde">
      <i class="cubuk cubuk-<?= e($m['kume']) ?>"></i>
      <div>
        <p class="madde-baslik"><?= e($m['baslik']) ?></p>
        <p class="madde-not"><?= e($m['not']) ?></p>
      </div>
    </div>
  <?php endforeach; ?>
</section>

<section class="bolum gir" style="--sira: <?= $s++ ?>">
  <div class="etiket"><?= e($et['yapma']) ?></div>
  <?php foreach ($rh['yapma'] as $m): ?>
    <div class="madde ters">
      <i class="cubuk cubuk-<?= e($m['kume']) ?>"></i>
      <div>
        <p class="madde-baslik"><?= e($m['baslik']) ?></p>
        <p class="madde-not"><?= e($m['not']) ?></p>
      </div>
    </div>
  <?php endforeach; ?>
</section>

<section class="bolum gir" style="--sira: <?= $s++ ?>">
  <div class="etiket"><?= e($et['gunun_detayi']) ?></div>
  <table class="cizelge">
    <?php foreach ($rh['detay'] as $d): ?>
    <tr>
      <td class="ad"><?= e($d['ad']) ?></td>
      <td class="sag koyu">
        <?php /* Rengin adını yazıp rengini göstermemek tuhaftı. */ ?>
        <?php if (!empty($d['renk'])): ?>
          <i class="renk-ornek" style="background: <?= e($d['renk']) ?>"></i>
        <?php endif; ?><?= e($d['deger']) ?>
      </td>
    </tr>
    <?php endforeach; ?>
  </table>

  <span class="ac" data-ac="d-tumu"
        data-acmetin="<?= e($et['tumunu_gor']) ?>"
        data-kapat="<?= e($et['kapat']) ?>"><?= e($et['tumunu_gor']) ?></span>
  <div class="detay" id="d-tumu"><div>
    <?php foreach ($rh['tumu'] as $k => $satirlar): ?>
      <div class="kume-baslik">
        <i class="iz iz-<?= e($k) ?>"></i><?= e($rh['kumeler'][$k]) ?>
      </div>
      <table class="cizelge liste">
        <?php foreach ($satirlar as $f): ?>
        <tr>
          <td class="isim"><?= e($f['ad']) ?></td>
          <td class="durum durum-<?= e($f['durum']) ?>"><?= e($f['durum']) ?></td>
        </tr>
        <?php endforeach; ?>
      </table>
    <?php endforeach; ?>
  </div></div>
</section>
