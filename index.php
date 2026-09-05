<?php
require __DIR__ . '/ayar/tema.php';

$v     = require __DIR__ . '/icerik/veri.php';
$tema  = aktif_tema();
$simdi = time();
$evre  = ay_evresi($simdi);
$gunes = gunes_bilgisi($simdi);

$sekmeler = ['kesfet', 'astroloji', 'yolculuk', 'rehber', 'ben'];

// Sekme olmayan alt sayfalar — alt menüde kendi yerleri yok,
// hangi sekmeye ait olduklarını belirtirler.
$altSayfalar = ['takvim' => 'rehber', 'uyum' => 'ben', 'kisi' => 'ben'];

$sekme = $_GET['s'] ?? 'astroloji';
if (!in_array($sekme, $sekmeler, true) && !isset($altSayfalar[$sekme])) {
    $sekme = 'astroloji';
}

$etkinSekme = $altSayfalar[$sekme] ?? $sekme;

/* Gerçek cihaz genişlikleri. Prototipte her ölçü sabit piksel ve çerçeve
   tarayıcı penceresine göre ölçekleniyordu — yani ekranda gördüğümüz şey
   gerçek telefondakinin birebir aynısı değildi. Bu seçici ölçeklemeyi
   kapatıp gerçek genişliği veriyor.

   320 = iPhone SE / küçük Android — sıkışmanın görüleceği yer
   390 = yaygın boy (iPhone 14/15)
   430 = Pro Max sınıfı */
$enler = ['320' => 692, '390' => 844, '430' => 932];
$en    = $_GET['en'] ?? '';
$sabitEn = isset($enler[$en]) ? (int) $en : null;
$sabitBoy = $sabitEn ? $enler[$en] : null;

// Günün faaliyet kümeleri tek kaynaktan: Rehber'in tavsiye listesi.
// Takvim, hafta şeridi, Astroloji ve Yolculuk hepsi bunu kullanıyor.
require_once __DIR__ . '/parca/takvim.php';
bugunun_kumeleri(kumeleri_topla($v['rehber']));

function e(?string $s): string
{
    return htmlspecialchars((string) $s, ENT_QUOTES, 'UTF-8');
}

/** Sekme ve tema bağlantılarını üretirken mevcut seçimi korur. */
function bag(array $degis): string
{
    $p = array_merge([
        's'       => $_GET['s'] ?? null,
        'tema'    => $_GET['tema'] ?? null,
        'hareket' => $_GET['hareket'] ?? null,
        'en'      => $_GET['en'] ?? null,
    ], $degis);
    $p = array_filter($p, fn($x) => $x !== null && $x !== '');

    return '?' . http_build_query($p);
}
?>
<!DOCTYPE html>
<html lang="tr">
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1, viewport-fit=cover">
<title>MediAstro</title>
<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=EB+Garamond:ital,wght@0,400;0,500;1,400&family=DM+Sans:wght@400;500&display=swap&subset=latin,latin-ext" rel="stylesheet">
<?php /* Dosya değiştikçe adres de değişsin — tarayıcı eski biçimi
         gösterip "değişmedi" izlenimi vermesin. */ ?>
<link rel="stylesheet" href="varlik/stil.css?v=<?= filemtime(__DIR__ . '/varlik/stil.css') ?>">
</head>
<body class="<?= ($_GET['hareket'] ?? '') === 'kisitli' ? 'hareket-kisitli' : '' ?>">

<div class="telefon tema-<?= e($tema) ?><?= $sabitEn ? ' sabit' : '' ?>"
     <?php if ($sabitEn): ?>style="--en: <?= $sabitEn ?>px; --boy: <?= $sabitBoy ?>px"<?php endif; ?>>
  <div class="ekran ekran-<?= e($sekme) ?>">

    <?php /* Yapışkan şerit yalnızca Astroloji'de: işi kaydırınca beliren
             burç adını göstermek. Diğer sayfalarda görünmez bir yazı için
             ~40px'lik ölü bant açıyordu. */ ?>
    <?php if ($sekme === 'astroloji'): ?>
      <header class="serit">
        <span class="serit-orta"><?= e($v['kullanici']['gunes']) ?></span>
      </header>
    <?php endif; ?>

    <?php require __DIR__ . '/sayfa/' . $sekme . '.php'; ?>

    <div class="dolgu"></div>

    <nav class="alt-menu">
      <?php foreach ($sekmeler as $k): ?>
        <a href="<?= e(bag(['s' => $k])) ?>" class="<?= $k === $etkinSekme ? 'etkin' : '' ?>">
          <?= e($v['menu'][$k]) ?>
        </a>
      <?php endforeach; ?>
    </nav>

  </div>
</div>

<div class="denetim">
  <span class="baslik">tema</span>
  <a href="<?= e(bag(['tema' => null])) ?>" class="<?= empty($_GET['tema']) ? 'etkin' : '' ?>">otomatik</a>
  <?php /* ikindi2 ve gece2 aday: beğenilen tutulup öteki silinecek. */ ?>
  <?php foreach (['sabah', 'ikindi', 'ikindi2', 'ikindi3', 'gece'] as $t): ?>
    <a href="<?= e(bag(['tema' => $t])) ?>" class="<?= ($_GET['tema'] ?? '') === $t ? 'etkin' : '' ?>"><?= $t ?></a>
  <?php endforeach; ?>
  <span class="ayrac"></span>
  <span class="baslik">genişlik</span>
  <a href="<?= e(bag(['en' => null])) ?>" class="<?= $sabitEn ? '' : 'etkin' ?>">sığdır</a>
  <?php foreach (array_keys($enler) as $g): ?>
    <a href="<?= e(bag(['en' => $g])) ?>" class="<?= ($_GET['en'] ?? '') === $g ? 'etkin' : '' ?>"><?= $g ?></a>
  <?php endforeach; ?>
  <span class="ayrac"></span>
  <span class="baslik">hareket</span>
  <?php $kisitli = ($_GET['hareket'] ?? '') === 'kisitli'; ?>
  <a href="<?= e(bag(['hareket' => null])) ?>" class="<?= $kisitli ? '' : 'etkin' ?>">açık</a>
  <a href="<?= e(bag(['hareket' => 'kisitli'])) ?>" class="<?= $kisitli ? 'etkin' : '' ?>">kısıtlı</a>
  <span class="ayrac"></span>
  <span class="bilgi">
    doğuş <?= e(saat($gunes['dogus'])) ?><br>
    batış <?= e(saat($gunes['batis'])) ?><br>
    <?= e(ay_evresi_adi($evre)) ?>
  </span>
</div>

<script src="varlik/hareket.js?v=<?= filemtime(__DIR__ . '/varlik/hareket.js') ?>"></script>
</body>
</html>
