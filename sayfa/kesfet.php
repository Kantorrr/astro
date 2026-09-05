<?php
/**
 * Keşfet — açılış ekranı, sosyal akış.
 *
 * Fotoğraf çerçevelenmiyor: kart, gölge, yuvarlak köşe yok. Görsel
 * ekranın iki kenarına dayanıyor, altında ince cetvel ve tipografi
 * başlıyor. Denendi, her çerçeve girişimi çizgiyi ucuzlattı (belge 6.9d).
 *
 * Punto burada bilerek küçük. Diğer ekranlarda serif iri kullanılıyor
 * çünkü orada tek bir cümle var; akışta yedi gönderi alt alta geliyor
 * ve iri punto bağırıyor. Burada tipografi geri çekiliyor, fotoğraf konuşuyor.
 *
 * Her gönderi Rehber'in faaliyet kümelerinden birinin rengini taşıyor —
 * takvimdeki çizgiyle aynı renk.
 */

$et = $v['etiket'];
$kf = $v['kesfet'];
$km = $v['rehber']['kumeler'];
$s  = 0;
?>

<?php /* Hikâyeler. Halka bakırsa izlenmemiş, cetvel rengindeyse izlenmiş —
         Instagram'ın renkli degrade halkası bu dile hiç uymuyor.
         Şerit ekranın kenarlarına taşıyor, kaydırılacağı böyle belli oluyor. */ ?>
<nav class="hikayeler gir" style="--sira: <?= $s++ ?>">
  <?php foreach ($kf['hikayeler'] as $i => $h): ?>
    <button class="hikaye <?= !empty($h['yeni']) ? 'yeni' : '' ?> <?= !empty($h['sen']) ? 'sen' : '' ?>"
            <?php if (!empty($h['kume'])): ?>style="--k: var(--f-<?= e($h['kume']) ?>)"<?php endif; ?>
            <?php if (!empty($h['kareler'])): ?>data-hikaye="<?= $i ?>"<?php endif; ?>>
      <span class="hikaye-halka">
        <span class="hikaye-ic"><?php if (!empty($h['sen'])): ?><i class="arti"></i><?php endif; ?></span>
      </span>
      <span class="hikaye-ad"><?= e($h['ad']) ?></span>
    </button>
  <?php endforeach; ?>
</nav>

<?php /* Hikâye verisi ekrandan ayrı duruyor; katmanı JS kuruyor.
         Metinlerin hepsi yine veri.php'de — burada tek satır bile yok. */ ?>
<script type="application/json" id="hikaye-verisi">
<?= json_encode($kf['hikayeler'], JSON_UNESCAPED_UNICODE | JSON_HEX_TAG | JSON_HEX_AMP) ?>
</script>

<?php /* Katman .telefon'un içine taşınıyor (JS), yoksa .ekran ile
         birlikte kayardı. Kapalıyken DOM'da duruyor ama gizli. */ ?>
<div class="hikaye-katman" id="hikaye-katman" hidden>
  <div class="hk-cubuklar" id="hk-cubuklar"></div>

  <header class="hk-ust">
    <span class="hk-ad" id="hk-ad"></span>
    <span class="hk-zaman" id="hk-zaman"></span>
    <button class="hk-kapat" id="hk-kapat" aria-label="kapat"><i class="capraz"></i></button>
  </header>

  <div class="hk-kare" id="hk-kare"></div>

  <button class="hk-yarim sol" id="hk-geri" aria-label="önceki"></button>
  <button class="hk-yarim sag" id="hk-ileri" aria-label="sonraki"></button>
</div>

<nav class="suzgec gir" style="--sira: <?= $s++ ?>">
  <?php foreach ($kf['suzgec'] as $i => $ad): ?>
    <span class="suzgec-oge <?= $i === 0 ? 'etkin' : '' ?>"><?= e($ad) ?></span>
  <?php endforeach; ?>
</nav>

<?php foreach ($kf['akis'] as $n => $g): ?>
<article class="gonderi gonderi-<?= e($g['tip']) ?> gir" style="--sira: <?= $s++ ?>">

  <?php /* Küme rozeti başlıkta: en görünür yer burası. Aşağıda,
           eylemlerin yanında dururken kimse fark etmiyordu. */ ?>
  <header class="gonderi-ust">
    <span class="gonderi-kisi"><?= e($g['kisi']) ?></span>
    <?php /* Yeşim Hanım'ı ayıran işaret: rozet değil, tek nokta.
             Mavi doğrulama tiki bu dile ait değil. */ ?>
    <?php if (!empty($g['imzali'])): ?>
      <i class="imzali" title="Yeşim Hanım"></i>
    <?php endif; ?>
    <?php if (!empty($g['kume'])): ?>
      <span class="kume-rozet"><i class="iz iz-<?= e($g['kume']) ?>"></i><?= e($km[$g['kume']]) ?></span>
    <?php endif; ?>
    <span class="gonderi-zaman"><?= e($g['zaman']) ?></span>
  </header>

  <?php if ($g['tip'] === 'gorsel'): ?>
    <?php /* Prototipte fotoğrafın yerini tutan alan. Gerçek görsel gelince
             yalnızca bu div bir <img> olacak — düzen değişmeyecek.
             Renk gönderinin kümesinden geliyor, prototipe özel. */ ?>
    <div class="gorsel renkli" style="aspect-ratio: <?= e($g['oran']) ?>;
         --k: var(--f-<?= e($g['kume']) ?>)">
      <span><?= e($g['konu']) ?></span>
    </div>
  <?php endif; ?>

  <div class="gonderi-govde">
    <?php if ($g['tip'] === 'alinti'): ?>
      <p class="alinti"><?= e($g['metin']) ?></p>
    <?php else: ?>
      <p class="gonderi-metin"><?= e($g['metin']) ?></p>
    <?php endif; ?>

    <?php /* İkon seti yok — alt menüde olduğu gibi burada da yalnızca kelime.
             Kalp ve konuşma balonu ekranı anında jenerik yapıyor. */ ?>
    <div class="eylem">
      <button class="eylem-oge" data-begen>
        <?= e($et['begen']) ?> <b><?= (int) $g['begeni'] ?></b>
      </button>
      <button class="eylem-oge">
        <?= e($et['yorumla']) ?> <b><?= (int) $g['yorum'] ?></b>
      </button>
      <button class="eylem-oge sag" data-kaydet
              data-kayitli="<?= e($et['kayitli']) ?>"><?= e($et['kaydet']) ?></button>
    </div>
  </div>

</article>
<?php endforeach; ?>
