/* Hareket bilgi taşır: kimlik alanı parmakla birlikte küçülüp
   üst şeritteki kelimeye dönüşür. Zamana değil kaydırmaya bağlı. */

(function () {
  const ekran  = document.querySelector('.ekran');
  const kimlik = document.querySelector('.kimlik');
  const serit  = document.querySelector('.serit');
  if (!ekran || !kimlik || !serit) return;

  const esik = 220;
  let bekleyen = false;

  function guncelle() {
    const oran = Math.min(ekran.scrollTop / esik, 1);

    kimlik.style.transform = 'scale(' + (1 - oran * 0.1) + ')';
    kimlik.style.opacity   = 1 - oran;
    serit.classList.toggle('kaydi', oran > 0.8);

    bekleyen = false;
  }

  ekran.addEventListener('scroll', function () {
    if (bekleyen) return;
    bekleyen = true;
    requestAnimationFrame(guncelle);
  }, { passive: true });
})();

/* Çark ile çizelge birbirine bağlı: birine dokununca ikisi birden vurgulanır.
   Sembolü tanımayan kullanıcı böylece karşılığını buluyor. */

(function () {
  const hepsi = document.querySelectorAll('[data-gz]');
  const okuma = document.getElementById('okuma');
  const carka = document.querySelector('.carka');
  if (!hepsi.length || !okuma) return;

  const ipucu = okuma.innerHTML;

  function sec(ad) {
    let secilen = null;

    hepsi.forEach(function (o) {
      const uyar = o.dataset.gz === ad;
      o.classList.toggle('secili', uyar);
      if (uyar && o.dataset.im) secilen = o;
    });

    if (carka) carka.classList.toggle('secim-var', !!ad);

    if (!secilen) {
      okuma.innerHTML = ipucu;
      return;
    }

    const d = secilen.dataset;
    okuma.innerHTML = '<b>' + d.im + '</b> ' + d.gz
      + ' · ' + d.burc + ' ' + d.derece + '°'
      + ' · ' + d.ev + '. ev'
      + (d.not ? ' · <i>' + d.not + '</i>' : '');
  }

  hepsi.forEach(function (o) {
    o.addEventListener('click', function () {
      sec(o.classList.contains('secili') ? null : o.dataset.gz);
    });
  });
})();

/* Takvimde bir güne dokununca o günün özeti altta güncellenir. */

(function () {
  const gunler = document.querySelectorAll('.tk-gun[data-gun]');
  const ozet   = document.getElementById('gun-ozeti');
  if (!gunler.length || !ozet) return;

  const alan = {
    baslik: ozet.querySelector('[data-alan="baslik"]'),
    olcum:  ozet.querySelector('[data-alan="olcum"]'),
    alt:    ozet.querySelector('[data-alan="alt"]')
  };

  gunler.forEach(function (g) {
    g.addEventListener('click', function () {
      gunler.forEach(function (o) { o.classList.remove('etkin'); });
      g.classList.add('etkin');

      Object.keys(alan).forEach(function (k) {
        if (alan[k] && g.dataset[k]) alan[k].textContent = g.dataset[k];
      });
    });
  });
})();

/* Keşfet — beğeni ve kaydetme. Prototipte sayı yerel olarak değişir.
   Kalp patlaması yok: abartılı bir kutlama dili burada tonu bozardı,
   tek değişen şey rengin bakıra dönmesi. */

document.querySelectorAll('[data-begen]').forEach(function (dugme) {
  const sayi = dugme.querySelector('b');
  const ilk  = parseInt(sayi.textContent, 10);

  dugme.addEventListener('click', function () {
    const secildi = !dugme.classList.contains('secili');
    dugme.classList.toggle('secili', secildi);
    sayi.textContent = secildi ? ilk + 1 : ilk;
  });
});

document.querySelectorAll('[data-kaydet]').forEach(function (dugme) {
  const ilk = dugme.textContent.trim();

  dugme.addEventListener('click', function () {
    const secildi = !dugme.classList.contains('secili');
    dugme.classList.toggle('secili', secildi);
    dugme.textContent = secildi ? dugme.dataset.kayitli : ilk;
  });
});

/* Hikâye görüntüleyici.
   Kareler kendiliğinden ilerliyor; üstteki çubuk dolarken ne kadar
   kaldığını gösteriyor. Son kare bitince sıradaki kişiye geçiyor —
   kullanıcı hiçbir yere basmadan bütün şeridi izleyebiliyor. */

(function () {
  const veriDugum = document.getElementById('hikaye-verisi');
  const katman    = document.getElementById('hikaye-katman');
  const telefon   = document.querySelector('.telefon');
  if (!veriDugum || !katman || !telefon) return;

  // Katman .ekran'ın içinde doğuyor ama orada kalırsa sayfayla kayar.
  telefon.appendChild(katman);

  const hikayeler = JSON.parse(veriDugum.textContent);
  const SURE = 4200;

  const cubuklar = document.getElementById('hk-cubuklar');
  const adAlan   = document.getElementById('hk-ad');
  const zamanAlan= document.getElementById('hk-zaman');
  const kareAlan = document.getElementById('hk-kare');

  let kisi = 0, kare = 0, sayac = null;

  function durdur() { clearTimeout(sayac); }

  function ciz() {
    const h = hikayeler[kisi];
    const k = h.kareler[kare];

    adAlan.innerHTML = h.ad + (h.imzali ? '<i class="imzali"></i>' : '');
    zamanAlan.textContent = h.zaman || '';

    cubuklar.innerHTML = '';
    h.kareler.forEach(function (_, i) {
      const c = document.createElement('span');
      c.className = 'hk-cubuk' + (i < kare ? ' gecti' : '');
      c.innerHTML = '<i></i>';
      cubuklar.appendChild(c);

      // Şu anki kare: çubuk süre boyunca soldan sağa dolar.
      // Geçiş süresi burada veriliyor, CSS'te keyframe yok.
      if (i === kare) {
        const dolgu = c.firstElementChild;
        dolgu.style.transitionDuration = SURE + 'ms';
        requestAnimationFrame(function () {
          requestAnimationFrame(function () { dolgu.style.transform = 'scaleX(1)'; });
        });
      }
    });

    kareAlan.className = 'hk-kare' + (k.tip === 'yazi' ? ' yalniz' : '');
    kareAlan.innerHTML =
      (k.tip === 'gorsel' ? '<div class="hk-gorsel">' + k.konu + '</div>' : '') +
      (k.metin ? '<p class="hk-metin">' + k.metin + '</p>' : '');

    durdur();
    sayac = setTimeout(ileri, SURE);
  }

  function ileri() {
    const h = hikayeler[kisi];
    if (kare + 1 < h.kareler.length) { kare++; return ciz(); }

    // Sıradaki hikâyesi olan kişi
    let s = kisi + 1;
    while (s < hikayeler.length && !hikayeler[s].kareler) s++;
    if (s >= hikayeler.length) return kapat();

    kisi = s; kare = 0;
    izlendi(kisi);
    ciz();
  }

  function geri() {
    if (kare > 0) { kare--; return ciz(); }

    let o = kisi - 1;
    while (o >= 0 && !hikayeler[o].kareler) o--;
    if (o < 0) return ciz();

    kisi = o; kare = hikayeler[o].kareler.length - 1;
    ciz();
  }

  function izlendi(i) {
    const d = document.querySelector('[data-hikaye="' + i + '"]');
    if (d) d.classList.remove('yeni');
  }

  function ac(i) {
    kisi = i; kare = 0;
    izlendi(i);
    katman.hidden = false;
    ciz();
  }

  function kapat() {
    durdur();
    katman.hidden = true;
  }

  document.querySelectorAll('[data-hikaye]').forEach(function (d) {
    d.addEventListener('click', function () { ac(parseInt(d.dataset.hikaye, 10)); });
  });

  document.getElementById('hk-ileri').addEventListener('click', ileri);
  document.getElementById('hk-geri').addEventListener('click', geri);
  document.getElementById('hk-kapat').addEventListener('click', kapat);

  document.addEventListener('keydown', function (o) {
    if (katman.hidden) return;
    if (o.key === 'Escape')     kapat();
    if (o.key === 'ArrowRight') ileri();
    if (o.key === 'ArrowLeft')  geri();
  });
})();

/* Açılır detaylar — yükseklik ölçülüp piksel olarak veriliyor,
   böylece geçiş her tarayıcıda gerçekten canlanıyor. */

document.querySelectorAll('[data-ac]').forEach(function (dugme) {
  const detay = document.getElementById(dugme.dataset.ac);
  if (!detay) return;

  const ic = detay.firstElementChild;

  dugme.addEventListener('click', function () {
    const acilacak = !detay.classList.contains('acik');

    // Aynı gruptaki diğerleri kapanır — liste taranabilir kalsın diye
    // aynı anda tek satır açık duruyor.
    if (acilacak && dugme.dataset.grup) {
      document.querySelectorAll('[data-grup="' + dugme.dataset.grup + '"].acik')
        .forEach(function (o) { if (o !== dugme) o.click(); });
    }

    // Nereden başladığını sabitle — yarıda kesilen bir geçiş varsa oradan devam eder.
    detay.style.height = detay.offsetHeight + 'px';
    detay.classList.toggle('acik', acilacak);

    requestAnimationFrame(function () {
      detay.style.height = acilacak ? ic.offsetHeight + 'px' : '0px';
    });

    dugme.classList.toggle('acik', acilacak);

    if (dugme.dataset.acmetin) {
      dugme.childNodes[0].nodeValue = acilacak
        ? dugme.dataset.kapat
        : dugme.dataset.acmetin;
    }
  });
});
