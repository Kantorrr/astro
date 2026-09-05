# MediAstro — Proje Belgesi

**Sürüm:** 1.2
**Tarih:** 1 Eylül 2026
**Durum:** PoC ilerliyor — sekiz ekran çizildi: Keşfet (hikâyeler dahil),
Astroloji, Yolculuk, Rehber, Takvim, Ben, Uyum, Kişi ekleme.
Tasarım sistemi oturdu: renkler, tipografi, boşluk ölçüleri, faaliyet renkleri.
**Sırada:** giriş akışı, premium teklif ekranı, admin paneli.

---

## Bu belge nedir

Bu belge, MediAstro projesinin tamamının kaydıdır. Ürün kararları, rekabet
analizi, görsel dil, sayfa sayfa içerik, teknik ilkeler, güvenlik, performans,
ödeme stratejisi ve yol haritası burada.

**Neden var:** Proje uzun sürecek ve birden fazla kişi/araçla çalışılacak.
Bu belge verildiğinde karşı taraf projeyi baştan öğrenir; hiçbir şeyin
yeniden anlatılmasına gerek kalmaz.

**Nasıl okunmalı:** Baştan sona okunabilir, ama bölüm bölüm de kullanılabilir.
Tasarımcıya "Görsel dil" bölümü, geliştiriciye "Teknik" bölümleri,
içerik üreticisine "Sayfa sayfa" bölümü yeter.

**Neyin girdiği, neyin girmediği:**

| girer | girmez |
|---|---|
| ne inşa edilecek, hangi ekranda ne var | piksel değerleri, boşluk ayarları |
| tartışılıp verilen kararlar ve **gerekçeleri** | denenip vazgeçilen küçük şeyler |
| güvenlik, ödeme, KVKK, veritabanı | uygulama sırasında çıkan teknik dersler |
| açık kalan sorular ve park edilenler | "şunu 18'den 16'ya indirdik" türü ayar |

Sağdaki sütun **kodun içinde yorum olarak** duruyor — dosyayı açan kişi hemen
yanında görüyor. İki yerde tutulan bilgi bir süre sonra çelişiyor.

**Karar durumları belgede şöyle işaretlenir:**

- ✅ **Karara bağlandı** — uygulanacak
- ⚠️ **Açık** — henüz karar verilmedi, PoC'yi engellemiyor
- 🅿️ **Park edildi** — bilinçli olarak sonraya bırakıldı

---

# 1. UYGULAMA NEDİR

MediAstro; **meditasyon, astroloji ve sosyal bir alanın** birleştiği mobil
uygulamadır.

Sahibi ve ana içerik üreticisi **Yeşim Hanım**'dır. Uygulamanın satış gücü
bir yazılım değil, gerçek bir insandır.

## 1.1 Konumlanma cümlesi

> **Gökyüzüne bağlı bir meditasyon uygulaması.**
> Yorumlar çeviri değil — gerçek bir astroloğun kaleminden.
> Abonelik tuzağı yok.

## 1.2 Üç rakibe karşı üç ayrı üstünlük

| Kime karşı | Neyle |
|---|---|
| MS Astro | Özgün içerik ve dürüst satış (onların içeriği çalıntı iddiası altında, ödeme sistemi güven kırıyor) |
| Meditopia | Astroloji ve gerçek bir insan (onlarda ikisi de yok) |
| Hepsine karşı | Sosyal alan, tasarım ve gökyüzüne bağlı tema |

## 1.3 Yol haritasının özeti

1. **PHP ile web üzerinde mobil görünümlü tıklanabilir prototip** ← şu an buradayız
2. Tasarım onayı ve iterasyon
3. Gerçek backend ve API
4. Flutter ile mobil uygulama
5. İçerik üretimi
6. Beta ve yayın

---

# 2. REKABET ANALİZİ

*Ağustos 2026 araştırması.*

## 2.1 MS Astro — astroloji tarafındaki ana rakip

**Büyüklük:** 507 bin indirme, ~27 bin yorum, 4.6 puan. Geliştirici: Astro Labs.

**Fiyat:** Aylık ₺169,99 / yıllık ₺1.119,99 — abonelik.

**Özellikler (bizimkiyle neredeyse birebir aynı):** doğum haritası analizi,
günlük yorumlar, sinastri, ruh ikizi, numeroloji, astroloji eğitimi, tarot,
meditasyon, nefes egzersizi, transit yorumları, ay fazları ve **altı ayrı takvim**
(ay / sağlık / güzellik / aktivite / resmi işler / maneviyat).

**Bunun anlamı:** "Faaliyet takvimi" bizim özgün fikrimiz değil. Onlarda zaten var.
Ama altı ayrı menü maddesine bölünmüş — kullanıcı saçını ne zaman kestireceğini
merak edince hangisine bakacağını bilmiyor. Bu, özellik listesi uzun görünsün
diye yapılmış bir menü şişkinliği.

**Zaafları — asıl fırsat burada:**

**a) İçerik çalıntı iddiası.** Ekşi Sözlük'te bir kullanıcı, sinastri metinlerinin
Co-Star'dan birebir çevrildiğini örnek göstererek teşhir etmiş. Doğruysa şu anlama
gelir: metinler Amerikalı bir ekibin, Amerikalı kullanıcılar için, o kültürün diliyle
yazdığı metinlerdir. Türkçeye çevrilince kulağa yabancı gelir. Kullanıcı bunu
adlandıramaz ama **hisseder**: "bir tuhaf, bana göre değil."

**b) Güven ihlali.** Şikayetvar ve Google Play kayıtlarında: abonelik iptal
edilemiyor, hesap silinse bile çekim devam ediyor, yıllık abonelik alanlardan
ayrıca aylık kesiliyor, müşteri desteği yok, Instagram mesajlarına dönülmüyor.

**c) Boş vaat.** Premium üye oldukları halde aylık ve haftalık yorum bölümlerinin
**bomboş** olduğunu söyleyen kullanıcılar var. Aylardır çalışmadığı, ödeme alındığı
halde hizmet verilmediği bildiriliyor.

**Sonuç:** MS Astro'nun zayıflığı özellik eksikliği değil, tam tersi — çok fazla
özellik vaat edip hiçbirini doldurmamak. Zayıflığı **güven**.

Astroloji, insanın en kırılgan yerine dokunan bir alandır. İnsanlar ilişkilerini,
kararlarını, kaygılarını emanet eder. Böyle bir alanda parayı alıp boş ekran
göstermek teknik bir hata değil, güven ihlalidir.

## 2.2 Meditopia — meditasyon tarafındaki ana rakip

**Büyüklük:** 35 milyondan fazla kullanıcı. İstanbul çıkışlı, dünyaya açılmış.

**İçerik:** 1000'den fazla rehberli meditasyon.

**Fiyat:** Yıllık liste ~₺900; kampanyalarda ₺99,99'a kadar iniyor.

**Güçlü yanı:** İçerikler çeviri değil, doğrudan Türkçe düşünülerek üretilmiş.
(Not: "özgün Türkçe içerik" iddiası MS Astro'ya karşı çalışır ama Meditopia'ya
karşı çalışmaz — o kaleyi çoktan almışlar.)

**Zaafı:** Astroloji yok. Ayrıca onlarda da abonelik iptali ve habersiz çekim
şikayetleri var.

**Kabul edilmesi gereken gerçek:** Yolculuk sekmesinde Meditopia'yı **sayıca
yenemeyiz.** 1000+ içerik, yıllara yayılmış prodüksiyon, 35 milyon kullanıcı
verisi. "Meditopia gibi ama bizim" konumlanması kaybettirir.

## 2.3 Yabancı rakipler — görsel dil dersleri

| Uygulama | Görsel dil | Güçlü yanı | Zayıf yanı |
|---|---|---|---|
| **Co-Star** | Siyah zemin, beyaz yazı, serif, ortalanmış, neredeyse boş ekranlar | Kalabalıkta anında tanınıyor, "el emeği" hissi | Soğuk ve sert, dili kaba |
| **CHANI** | Sıcak kırık beyaz, pudra/lavanta, kolaj-zine estetiği, dokular | Duygusal sıcaklık ve samimiyet | Kalabalık — kolaj, doku ve uzun metinler dikkat için yarışıyor |
| **The Pattern** | Temiz, düzenli kartlar | Okunabilirlik, erişilebilirlik | Karaktersiz, unutulur |
| **Calm / Headspace** | Yumuşak illüstrasyon, degrade doğa manzaraları | Rahatlatıcı | Artık herkesin yaptığı şey |

## 2.4 Pazardaki boşluk

| | Astroloji | Meditasyon | Sosyal | Gerçek bir insan |
|---|---|---|---|---|
| MS Astro | Güçlü ama çalıntı | Üstünkörü | Yok | Yok (isimsiz şirket) |
| Meditopia | **Yok** | Çok güçlü, özgün | Yok | Yok |
| Co-Star | Güçlü | Yok | Kısmen | Yok |
| **MediAstro** | Özgün, Yeşim Hanım'ın | Küçük ama **bağlantılı** | **Var** | **Var** |

**Görsel dil boşluğu:** Co-Star ferah ama soğuk. CHANI sıcak ama boğucu.
The Pattern ferah ve sıcak ama unutulur. **Sıcak + ferah + karakterli olanı yok.**

**Kritik ders:** Co-Star'ın başarısı bir şeyi **reddetmekten** doğmuş — herkes
pastel ve mistik yaparken o siyah-beyaz yapmış. Ayrışma eklemekle değil,
**çıkarmakla** oluyor.

---

# 3. STRATEJİK KARARLAR

## 3.1 Az vaat et, hepsini doldur ✅

MS Astro altı ayrı takvim vaat edip boş bırakmış. Bizim Rehber'de günde 3-5 madde
gösterme kararımız sadece tasarım tercihi değil, **stratejik üstünlük**.

**Kural:** Kullanıcı bir kere bile boş ekran görmesin.

## 3.2 Özellik yarışına girme ✅

507 bin indirmeli bir uygulamayla özellik sayısında yarışılmaz. Onlarda altı takvim
var, bizde bir tane olsun ama iyi olsun. Ayrışma **sadelikten, zevkten ve güvenden**
gelecek — listeden değil.

## 3.3 İnsanı gizleme, göster ✅

MS Astro'nun yüzü yok, Meditopia'nın yüzü yok. Bizim Yeşim Hanım'ımız var.

- Her yorumun altında imzası dursun
- Bazı yorumların yanında kendi sesinden kısa kayıt olsun
- Kullanıcı okuduğu şeyin bir yazılımdan değil **bir insandan** geldiğini
  sürekli hissetsin

Bu taklit edilemez.

## 3.4 Meditasyonlar gökyüzüne bağlansın ✅

Meditopia içeriği konuya göre dizer (kaygı, uyku, öz şefkat). Biz gökyüzüne bağlarız:

> *"Bugün Ay Akrep'te. Derine inmeye uygun bir gün — bu meditasyon tam onun için."*

Meditopia bunu **yapamaz** (astroloji yok). MS Astro **yapmaz** (meditasyon onlarda
özellik listesinde bir satır).

**Sonuç:** 1000 meditasyona gerek yok. Elli tane yeter, ama her biri bir gökyüzü
durumuna bağlansın ve uygulama her gün doğru olanı öne çıkarsın. Hem daha az
prodüksiyon, hem daha iyi deneyim — kullanıcı kütüphanede kaybolmaz.

## 3.5 Abonelik tuzağı yok — en görünür yere yaz ✅

Hem MS Astro'nun hem Meditopia'nın aynı şikayeti var: iptal edilemeyen abonelik,
habersiz çekim, ulaşılamayan destek. Bu tek bir şirketin ahlaksızlığı değil,
**kategorinin ortak yarası.** Türkiye'de abonelikli uygulamalardan yanmış koca bir
kitle var.

*"İptal tek tuşla, üç saniye"* yazması ve **gerçekten öyle olması** bu pazarda
duyulmamış bir şey.

---

# 4. KULLANICI VE GİRİŞ AKIŞI

## 4.1 Onboarding sırası ✅

```
1. Karşılama
2. Doğum tarihi
3. Doğum saati        ← zorunlu
4. Doğum yeri         ← koordinat gerekir (şehir seçici)
5. Sonuç önizlemesi   ← kullanıcı değeri burada görür
6. Kayıt
```

**Neden bu sıra:** Kullanıcı önce değeri görür, sonra kaydolur. Kapıda kayıt
istemek dönüşümü düşürür.

## 4.2 Doğum saati sorunu ⚠️

**Karar:** Doğum saati zorunlu.

**Bilinen risk:** Kitlenin yaklaşık %40'ı doğum saatini bilmez. Bu kullanıcılar
kapıda kaybedilir.

**Yapılmış öneri (kabul edilmedi, PoC'de görülünce tekrar konuşulacak):**
Saat ekranında iki seçenek — "Tam biliyorum" / "Yaklaşık biliyorum"
(sabah/öğle/akşam/gece dilimi). Yaklaşık seçen içeri girer, profilinde
"saatini kesinleştir" uyarısı durur, yükselen yorumunda "yaklaşık" etiketi görünür.

## 4.3 Roller ✅

Sistem **çok yazarlıdır.** Baştan üç rol gerekir:

| Rol | Yetki |
|---|---|
| **Kullanıcı** | Kendi verisi, sosyal paylaşım, içerik tüketimi |
| **Hoca** | Sadece kendi içeriğini yükler ve düzenler. Başkasının içeriğine, kullanıcı listesine, ödemelere dokunamaz |
| **Yönetici (Yeşim Hanım)** | Tam yetki |

Her içeriğin bir **sahibi** olmalı.

---

# 5. SAYFA SAYFA — NE NEREDE

## 5.1 Alt menü ✅

```
Keşfet · Astroloji · Yolculuk · Rehber · Ben
```

- **Açılış sekmesi:** Keşfet
- **Yolculuk ortada** — parmağın en rahat ulaştığı yer; günlük alışkanlık
  yaratacak sekme oraya konur

---

## 5.2 KEŞFET ✅ *(çizildi)*

Uygulamanın sosyal alanı ve açılış ekranı.
**Hikâye şeridi · süzgeç (hepsi / yeşim'den / takip) · gönderi akışı**

### Fotoğraf sorunu ve çözümü ⚠️

Projenin en riskli tasarım noktasıydı: **Keşfet fotoğraf ekranı, bu dilde
fotoğraf yok** (bkz. 6.9d).

**Çözüm: fotoğrafı süslemeye çalışmamak.** Kart, gölge, yuvarlak köşe yok.
Fotoğraf düz bir blok olarak duruyor, altında cetvel ve tipografi başlıyor.
Görsel ile tasarım yarışmıyor, sırayla konuşuyor.

⚠️ **Asıl test yapılmadı:** gerçek bir fotoğraf bu çizgilerin yanında durabiliyor
mu? Yeşim Hanım'ın çekimlerinden biri gelince görülecek. Duramazsa çözüm tasarımı
bozmak değil, **çekim brief'ine kural yazmak**.

### Akış tek düze fotoğraf duvarı değil ✅

| tip | ne | neden |
|---|---|---|
| görsel | fotoğraf + altında yazı | asıl içerik |
| yazı | fotoğrafsız, düz gövde | ritmi kırar |
| alıntı | serif, solunda bakır çizgi | Yeşim Hanım'ın sözü, kendi başına durur |

Fotoğraf oranları da farklı (4:5, 1:1, 3:2). **Bu ritim ekranı Instagram klonu
olmaktan çıkaran asıl şey.**

### Punto burada küçük ✅

Diğer ekranlarda serif iri kullanılıyor çünkü orada tek cümle var. Akışta yedi
gönderi alt alta geliyor ve iri punto bağırıyor. **Tipografi geri çekiliyor,
fotoğraf konuşuyor.**

### İkon yok ✅

Yalnızca kelime: `beğen 88 · yorum 12 · kaydet`. Kalp ve konuşma balonu ekranı
anında jenerik yapıyor. Beğeniye basınca kalp patlamıyor, yazı bakıra dönüyor.

Yeşim Hanım'ın gönderisinde adının yanında **tek bakır nokta**. Mavi doğrulama
tiki bu dile ait değil.

### Hikâyeler ✅

**Instagram'ın degrade halkası kullanılmadı.** Halka rengi anlam taşıyor:
kişinin o gün paylaştığı faaliyet kümesinin rengi. İzlenmemişte halka ve iç
dolgu renkli, izlenince ikisi de renkten çıkıyor — **renk "yeni" demek**.

Görüntüleyicide kareler kendiliğinden ilerliyor, kişi bitince sıradakine
geçiyor. Sol üçte bir geri, kalanı ileri. Katman her temada koyu açılıyor:
fotoğrafın etrafı açık renk olursa görsel zeminde eriyor.

Hikâye kareleri de tek düze değil — bir kısmı fotoğrafsız, cümle ekranın
ortasında tek başına duruyor.

### Renk katmanı ✅

Her gönderi Rehber'in faaliyet kümelerinden birine ait ve takvimdeki çizgiyle
aynı rengi taşıyor. Yan faydası: gönderiler uygulamanın geri kalanına bağlanıyor
("takvimde zor konuşma günü yazıyordu"). Keşfet kopuk bir sosyal duvar olmaktan
çıkıp uygulamanın **kanıt defterine** dönüşüyor.

**Kim paylaşır:** Herkes. Yeşim Hanım ve onaylanmış hocalar akışta öncelikli.
**PoC'de:** Sahte içerik, beğeni/kaydet tıklanır ama kaydedilmez.

**Ekranlar:** Akış · Gönderi detayı · Hikâye görüntüleyici

---

## 5.3 ASTROLOJİ

Tek akış, yukarıdan aşağı bağlı bir hikâye. Kullanıcı hiç düşünmeden kaydırır
ve sonunda ödeme teklifiyle karşılaşır — ama teklife gelene kadar bedavaya çok
şey almış olur.

**Sıra:**

1. **Retro uyarı şeridi** *(varsa)* — "Merkür retroda" gibi. Türkiye'de herkesin
   bildiği bir kavram, güçlü bir dikkat noktası.
2. **Kimlik alanı** — Güneş / Ay / Yükselen üçlüsü.
   Geleneksel harita çarkı yerine gösterişli bir kimlik kartı kararlaştırıldı
   (çark yavaş, pahalı ve yeni başlayanı korkutuyor). Ruzname diline uygun,
   ince çizgili usturlap benzeri bir çark taslak olarak denendi — ⚠️ nihai karar açık.
3. **Bugün** — gökyüzü ne yapıyor + senin haritanda neye değiyor. Tek paragraf.
4. **Geosentrik (Batı) astroloji** — gezegen gezegen açılan bloklar / çizelge
5. **Ay fazları** — o anki evre, dolunay/yeniay yaklaşıyorsa uyarı
6. **Çin astrolojisi** — hayvan + element
7. **Numeroloji** — yaşam yolu sayısı, isim sayısı
8. **Yeşim Hanım'dan kişisel yorum** — premium kapısı, akışın sonunda.
   Fotoğrafı, kısa tanıtım, "Haritanı Yeşim Hanım okusun" butonu.

Her blokta **"daha fazla"** → genişletilmiş özet ve detay.

**Terim notu:** "Geosentrik" = Dünya merkezli, klasik Batı astrolojisi. ✅ Doğrulandı.
Helyosentrik (Güneş merkezli) harita şu an kapsamda değil.

### Prototipte varılan son hal ✅

1. **Retro şeridi** — tek satır, gezegen adı bakır
2. **Harita çarkı** — usturlap mantığında, ekran genişliğinin %98'i
3. **Okuma satırı** — çarkın hemen altında
4. **Kimlik** — "güneş burcun" + `Başak` (32 px) + ortalanmış `ay Yay · yükselen İkizler`
5. **bugün** — bir cümle özet + "daha fazla"
6. **gökyüzü** — gezegen çizelgesi
7. **başka bakışlar** — çin ve numeroloji, açılır satırlar
8. **yeşim'den** — premium kapısı

**Çark — çalışan ayrıntılar:**
- Derece taksimatı (5°'de bir çentik, 15°'de uzun), çift dış hat, köşe evler (1/4/7/10)
  güçlendirilmiş ve merkeze kadar uzanıyor
- Dıştaki halkada **burç sembolü değil ev numarası** (bkz. 6.7)
- Gezegen sembolleri 21 px, altlarında derece okuması
- Birbirine 16 dereceden yakın gezegenler **iç halkaya kaydırılıyor** (üst üste binmesin diye)
- **Dokunmalı:** bir gezegene basınca sembol bakır dolguya döner, çarkın altındaki
  okuma satırı `☿ merkür · Başak 4° · 6. ev · geri` olur, aşağıdaki çizelgede
  o satır bakıra geçer. Tersi de çalışır.
- Seçim varken diğerlerini soluklaştırma **denendi ve kaldırıldı** — okunabilirliği düşürüyordu

**Yer ekonomisi:** Ay bölümü ayrı bir bölüm değil, "bugün"e katıldı.
Çin ve numeroloji ayrı bölümler değil, açılabilir satırlar — eskiden ~400 piksel
yer kaplıyorlardı, şimdi ~90.

**Üst şeritteki tarih kaldırıldı ✅** — gereksizdi. Şeritte yalnızca köşedeki ay ve
kaydırınca beliren burç adı var.

**Ay çizimi az kullanılır ✅** — "her yer ay oldu" geri bildirimi üzerine Rehber ve
Takvim'den tamamen kaldırıldı. Yalnızca üst köşedeki imza detay kaldı.

**⚠️ Açık:** "bugün" bölümü hâlâ jargonla başlıyor ("Ay bu akşam Yay'a geçiyor").
6.9c'deki düzene çevrilmeli.

---

## 5.4 YOLCULUK ✅ *(çizildi)*

Yeşim Hanım'ın **profesyonel çekilmiş büyük eğitim kütüphanesi** (video + görsel).
Birkaç nefes egzersizi değil, bir eğitim platformu.

### ⚠️ KARAR DEĞİŞTİ: Netflix rafları reddedildi

*Önceki karar "Netflix tarzı yatay raflar" idi. Ekranı çizerken vazgeçildi.*

1. **Yatay raf, kataloğu olan ürünün çözümüdür.** Netflix'te 4000 film var, seni
   gezdirmesi gerekiyor. Bu kütüphane büyük ama gezdirilecek kadar değil.
2. **Seçim yorgunluğu üretir.** Meditasyona gelen kullanıcı zaten dağınık; ona
   6 raf × 12 kapak göstermek işin tersi.
3. **Jenerik.** "Normal bir AI'ın yapacağı tasarım" tarifinin tam ortası.

**Ekranın cevapladığı soru "ne izlesem" değil, "nerede kalmıştım".**
Düzen bir katalog değil, dikey bir **yol**.

### Sayfanın yapısı

**1 — kaldığın yer.** Tek şey: seri, bölüm adı, süre, `devam et`.

**2 — bugüne denk düşen.** Yolculuk'u uygulamanın geri kalanına bağlayan satır;
Rehber'in o günkü kümesinden geliyor, rengini de oradan alıyor.
*Bu bölüm eklenmeden önce sayfa "boş" hissettiriyordu — sebebi süssüzlük değil,
gökyüzüyle arasında bağ olmamasıydı.*
**Sıra ile öneri çakıştığında öneri kazanır**, yoksa gökyüzü bağlantısının
anlamı kalmaz.

**3 — bu seride.** Duraklar alt alta, aralarından tek çizgi geçiyor: geçtiğin
duraklar dolu, bulunduğun bakır, önündekiler boş halka.
**Yüzde yok, ilerleme çubuğu yok, rozet yok** — ilerleme hissi çizginin
kendisinden geliyor.

**4 — diğer yolculuklar.** Dikey liste, sağda durum tek kelime:
`8 bölüm` / `5/12` / `tamamlandı`.

**5 — tek seferlikler.** Seriye bağlı olmayanlar; ad + süre.

### Her satır basılabilir, ayrı sayfaya gitmiyor ✅

Bir bölüme bakıp vazgeçtiğinde listede yerini kaybetmiyorsun. Bu ekranda
davranış "tara, birini seç" olduğu için önemli.

### Kapak görseli yok 🅿️

Ad ve süre tipografiyle söyleniyor. **Tartışmaya açık:** Yeşim Hanım profesyonel
çekim yaptırıyor, o kapakları hiç göstermemek israf olabilir.

**Ayırt edici ilke:** İçerik konuya göre değil **gökyüzüne göre** öne çıkar.

**Ekranlar:** Yolculuk · İçerik oynatıcı

---

## 5.5 REHBER

Uygulamanın imza özelliği. **Tek takvim, üstünde o günün her şeyi.**
(MS Astro'nun altı ayrı takvimine karşı bilinçli sadelik.)

**Kural motoru:** Ay'ın burcu + ay evresi ✅
Geleneksel astrolojide zaten var olan sistem. Otomatik hesaplanır, tutarlıdır,
her gün için içerik üretir, boş gün bırakmaz.

**Faaliyet kümeleri:**

| Küme | İçindekiler |
|---|---|
| Beden & bakım | Saç kesimi, tırnak, boya, diş, ameliyat, diyete başlama, spor |
| Para & iş | İmza, sözleşme, iş görüşmesi, yatırım, büyük alışveriş, borç |
| İlişkiler | Barışma, konuşma, tanışma, teklif, zor konuşmalar |
| Yolculuk | Seyahat, taşınma, tatil, doğa yürüyüşü |
| İç dünya | Karar alma, temizlik/arınma, niyet, başlangıç, bırakma |
| Günün detayı | Şanslı renk, şanslı sayı, kaçınılacak saat |

**Gösterim:** Ana ekranda günde **3-5 madde** — o gün için en güçlü olanlar.
Gerisi "tümünü gör" altında. Ekran boğulmamalı.

**Tavsiye dili:** ✅ Net bir başlık + **tek cümlelik açıklama.**

> **Bugün tırnak kesme**
> Ay Balık'ta, beden sıvı tutuyor.

Ne kuru bir emir, ne uzun bir ders — arada.

**Retro bağlantısı:** Merkür retrodaysa imza/sözleşme tavsiyeleri buna göre değişir.

**Takvim kararı ✅ — takvim ayrı bir sayfadır.**

Takvim önce Rehber ana ekranına konuldu ve **ekranı boğdu.** Sebep: Rehber
"bugün ne yapmalıyım", takvim "hangi gün ne var" sorusunu cevaplıyor — iki farklı soru.

Çözüm: **tek takvim sayfası, iki kapı.** Rehber'den ve Ben sekmesindeki
"takvimim"den aynı sayfaya gidilir. Alt menüde Rehber sekmesi vurgulu kalır.

**Rehber ana ekranı (son hali):**
1. **Hafta şeridi** — 7 gün, bugün bakır dairede, her günün altında o günün renkli işaretleri
2. **"bütün ayı gör →"** bağlantısı
3. **Günün başlığı** — *önce ne, sonra neden* düzeninde (bkz. 6.9c)
4. **bugün yap** — maddeler, solda küme rengi çubuk, siyah başlık
5. **bugün yapma** — aynı düzen, **bakır** başlık
6. **günün detayı** — şanslı renk / sayı / kaçınılacak saat, çizelge
7. **tümünü gör** — beş kümede tam liste; her faaliyetin karşısında
   *uygun* (siyah) / *ertele* (bakır) / *farketmez* (soluk)

**Takvim sayfası (son hali):** Aylık ızgara, günler tıklanabilir, her günün altında
en fazla üç renkli çizgi · lejant · seçilen günün özeti (tarih + öne çıkan alanlar).
**Tek ekrana sığar, kaydırma yoktur** — kaydırma bütünlüğü bozuyordu.

İşaretler ay evresinden türetiliyor (prototipte kaba kural kümesi).

**Ekranlar:** Bugün · Tümünü gör · Takvim

---

## 5.6 BEN ✅ *(çizildi)*

### Bu ekranın en büyük riski: ayar çöplüğü ⚠️

Bu tür sayfalar doğal olarak "bildirimler / hesap / gizlilik / çıkış" listesine
dönüşür ve uygulamanın en ruhsuz yeri olur.

**Direnme biçimi: künye.** Ruzname'lerin ilk yaprağı "bu takvim kimin için
hazırlandı" der. Ben sekmesi de o — ayar listesi değil, **kullanıcının kaydı**.

### Sayfanın yapısı

**1 — Künye.** Ad, altında çizelge: doğum / saat / yer — çizgi — güneş / ay /
yükselen. Ortadaki çizgi anlam taşıyor: **üstü kullanıcının girdiği, altı ondan
hesaplanan** (hesaplananlar bakır). Uygulamanın kullanıcıyı neye göre okuduğunun
tek dürüst beyanı. Düzenlenebilir.

**2 — İlerleme.** Üç gerçek sayı: `45 gün · 6.20 saat · 2 seri`.

⚠️ **Streak (üst üste gün) bilinçli olarak yok.** Streak insanı uygulamaya
bağlar, kendine değil. Meditasyon uygulamasında ters teper: kaçırılan gün
suçluluk üretir. *(Önceki taslakta "rozetler" yazıyordu — kaldırıldı.)*

**3 — Kişiler.** Sinastri kapısı, altında `kişi ekle`.

**4 — Yeşim'den aldıkların.** Premium yorumlar burada birikir; hiç yoksa
`yeni yorum iste` kapısı olur. **Ticari açıdan en kritik yer.**

**5 — Kaydettiklerin.** Keşfet'ten gönderi, Yolculuk'tan bölüm, Rehber'den gün —
hepsi tek yerde. Dağıtılırsa kullanıcı hiçbirini bulamaz.

**6 — Takvimi aç.** İkinci kapı, aynı sayfa.

**7 — Ayarlar.** Kapalı duruyor: bildirimler, doğum bilgisini düzelt, hesap,
verilerimi indir, hesabımı sil, çıkış. Öne çıkarılmıyor.

---

## 5.7 UYUM / SİNASTRİ ✅ *(çizildi)*

İki kişinin doğum haritasının üst üste bindirilip aralarındaki açıların
okunması. **Arkadaşlık özelliği değil** — sevgili için de bakılır, anne için de,
patron için de.

### ⚠️ KARAR DEĞİŞTİ: ikinci kişinin bilgisi elle giriliyor

| | A — kullanıcı girer | B — uygulamadaki biriyle eşleşir |
|---|---|---|
| karşı tarafın hesabı | gerekmez | gerekir |
| izin/onay sistemi | gerekmez | zorunlu |
| KVKK yükü | düşük | ağır (doğum saati hassas veri) |
| ek gereksinim | yok | takip, engelleme, şikâyet |

**A seçildi.** Gerçek kullanımın büyük kısmı zaten A: insanlar en çok
sevgilisine, eski sevgilisine ve annesine bakıyor — bunların çoğu uygulamaya hiç
girmeyecek. B'nin asıl tehlikesi: uygulama **flört uygulamasına** dönmeye başlar.

**Yeri: Ben sekmesi.** Orada kullanıcının kendi künyesi var; ikinci bir künye
eklemek oranın işi. *Sosyal hale getirilirse Keşfet'e ikinci kapı açılır.*

### ⚠️ Yüzde verilmiyor

"%87 uyumlusunuz" bir **hüküm**, bir anlatım değil. Kullanıcı düşük sayı görürse
ilişkisini sorgular, yüksek görürse hiçbir şey öğrenmez. Üstelik o ekran Co-Star
klonu görüntüsünün ana kaynağı.

### Sonuç ekranı: altı kategori

Üstte iki isim, karşı tarafın doğum bilgisi ve üçlüsü, tek cümle özet. Sonra
**konuşma · duygu · çekim · gündelik hayat · çatışma · uzun vade**.

Her kategoride **ne olduğu** (serif) → **paragraf anlatım** → **dayanak**
(dipnot: `mars – merkür karesi`). Yine "önce ne, sonra neden".

Her kategorinin bir durumu var: *kolay olan · ikisi birden · zorlanacağınız*.
Durum işareti renkli, yazı soluk. Zorlanılan kategorilerin başlığı bakır —
Rehber'in "yapma"sıyla aynı iki mürekkep mantığı.

### Kişi ekleme formu ✅ *(çizildi)*

**Aynı ekran giriş akışında da kullanılacak** (kendi doğum bilgin) — alanlar bir
kere yazıldı, iki yerde çalışacak.

- **Kutulu giriş alanı yok.** Kutu = kart = jenerik. Alanlar cetvel çizgisinin
  üstünde duruyor, kâğıt forma benziyor. Tek geri bildirim: odaklanınca çizgi
  bakıra dönüyor.
- **Tarih tek kutu değil, üç alan** (`gg · aa · yyyy`), saat iki alan.
  Telefonda tarih seçici açmak akışı kesiyor ve 1966'ya kaydırmak eziyet.
- **Saatin neden istendiği yazıyor.** Sebep söylenmezse kullanıcı ya rastgele
  giriyor ya vazgeçiyor.
- **Gizlilik cümlesi küçük ama saklı değil.** Uygulamanın en hassas verisini
  isteyen ekran bu.

**Güvenlik kuralı:** Hesap sunucuda yapılır, geriye sadece sonuç döner. Girilen
kişilerin ham doğum verisi yalnızca o kullanıcının hesabında durur (RLS),
kimseye görünmez, silinince gerçekten silinir.

**Ücretsiz** ✅ — insanların birbirini davet etmesini sağlayan büyüme motoru.

**Ekranlar:** Kişi ekle · Uyum sonucu

---

## 5.8 ADMİN PANELİ

Ayrı, **basit ve sade** bir web yönetim paneli. Yeşim Hanım ve hocalar girer,
tık tık içerik yükler.

**İlkeler:**
- Kullanıcı uygulamasından **ayrı** yaşar
- **Hoca ≠ yönetici** — hoca sadece kendi içeriğini görür ve düzenler
- Panelde yapılan **her işlem kaydedilir** (kim, ne zaman, neyi değiştirdi)

**Ekranlar:** Giriş · İçerik yükleme · İçerik listesi

---

## 5.9 Yorum türleri — özet tablo

| Tür | Durum | Nerede |
|---|---|---|
| Geosentrik (Batı) | ✅ Var | Astroloji |
| Çin astrolojisi | ✅ Var | Astroloji |
| Numeroloji | ✅ Var | Astroloji |
| Yeşim Hanım kişisel yorumu | ✅ Var — premium | Astroloji sonu |
| Bugün / transit | ✅ Var | Astroloji + Keşfet kartı |
| Retro takibi | ✅ Var | Astroloji şeridi + Rehber |
| Ay fazları | ✅ Var | Astroloji + Rehber motoru |
| Sinastri | ✅ Var — ücretsiz | Ayrı bölüm |
| Yıllık harita (solar return) | ⚠️ Önerildi, karar bekliyor | Astroloji |
| Tarot | 🅿️ Park — farklı disiplin, konumlanmayı sulandırabilir | — |
| Ruh ikizi | 🅿️ Park — sinastri zaten gerçek uyumu veriyor | — |
| Helyosentrik harita | 🅿️ Park | — |

---

# 6. GÖRSEL DİL

## 6.1 Hedef tek kelimeyle: FERAH

Sıcak ama kalabalık değil. Sade ama karaktersiz değil.

**Önemli kavrayış:** Kasvetli olan koyu renk değil, **kalabalıktır.** Ferahlık
renkten değil, **boşluktan** gelir.

## 6.2 "AI yapmış gibi" görünmenin sebebi

Tek bir sebep: **karar vermemek.**

Yapay zekâ her öğeye eşit davranır. Sekiz bilgi varsa sekiz kart yapar, hepsini
aynı boyutta, aynı köşe yuvarlaklığında, aynı boşlukla dizer. Hiçbir şey öne
çıkmaz çünkü hiçbir şey feda edilmemiştir.

İyi tasarım **acımasızdır.** Bir şeyi devasa yapar, diğerini minicik.

**Somut kalıplar (kaçınılacaklar):**
- Mor-mavi köşegen degrade arka plan
- Her şeyin buzlu cam efektli kartın içinde olması
- Her öğenin aynı köşe yuvarlaklığında olması
- Her öğenin aynı görsel ağırlıkta olması
- Yuvarlak ikon + başlık + iki satır açıklama üçlüsünün sonsuz tekrarı
- Emoji (✨🌙💫)
- Her şeyin ortalanması
- Karaktersiz tek tip yazı tipi

## 6.3 Kaynak: RUZNAME ✅

**Ruzname** ("Günler Kitabı"), 17. yüzyıldan itibaren Osmanlı'da üretilen takvim/
almanak geleneğidir. Araştırmadan çıkan özellikleri:

- **Rulo biçiminde** — ahşap makaraya sarılı, açılarak okunan uzun şerit
- **Cep boyutunda ve taşınabilir** — yanında gezdirilen kişisel nesne
- **Kırmızı ve siyah mürekkep**, altın yaldızla çizilmiş cetveller içinde
- Bol **tablo ve çizelge**
- İçeriği: namaz vakitleri, **gündüzün ve gecenin uzunluğu**, güneşin Kâbe yönüne
  geldiği an, ay takvimiyle güneş takviminin denkleştirilmesi

**Kavrayış:** *Rulo biçiminde, cep boyutunda, yanında taşıdığın, gökyüzünün günlük
programını sana söyleyen kişisel bir nesne* — bu bir telefon tarifidir. Dört yüz yıl
önce bu topraklarda insanlar tam da bizim yapmaya çalıştığımız şeyi cebinde taşıyormuş.

**Ve asıl hamle:** Bugün her uygulama ekranı dikey kaydırılıyor — yani zaten bir rulo.
Ama herkes ekranı "sayfa" sanıp üstüne kart diziyor. Biz ekranı **rulo olarak** kurarız:
kartlara bölünmüş liste değil, kesintisiz açılan tek şerit.

### Ne alıyoruz, ne almıyoruz

**Süsünü değil, mantığını alıyoruz.** Tezhip, arabesk desen, hat yazısı, sarı kâğıt
dokusu — bunlar yapılırsa müze vitrini olur, kostüm olur. **Alınmıyor.**

| Ruzname'de | Bizde |
|---|---|
| Rulo — kesintisiz dikey şerit | Kaydırılan tek akış, kart yok |
| İki mürekkep: siyah + kırmızı | Tek metin rengi + tek vurgu rengi, cimrice |
| İnce cetvel çizgileriyle bölünmüş alanlar | Saç teli inceliğinde ayırıcılar, çerçeve yok |
| Tablolar ve çizelgeler | Verileri **çizelge** olarak göster — kart olarak değil |
| Gündüz/gece uzunluğu | Üç temamızın ta kendisi |
| Cepte taşınan kişisel nesne | Telefon |
| Altın — sadece cetvellerde, az | Tek küçük vurgu, ekranda bir kez |

**Yaprak takvim geleneğinden:** Her güne bir yaprak, koparılıyor, kırmızı günler tatil.
Alınan: **"bugün" bir sayfadır.** Rehber ekranı bir yaprak olabilir.

**Sonuç — hikâye:**
> **Dijital ruzname.** Atalarımız cebinde gökyüzünün programını taşırdı —
> biz onu telefona taşıdık.

Bu hikâyeyi ne Co-Star anlatabilir, ne MS Astro, ne Meditopia.

**Uyarı:** Modern görünecek. Kimse bakınca "Osmanlı" demeyecek; sadece
"bu farklı, bu sakin, bu ciddi" diyecek. Ruzname **gizli kaynak**, görünen yüz değil.

## 6.4 Somut tasarım hamleleri ✅

**1. Kartları sil.**
Kart, boşluğa güvenmeyenin koltuk değneğidir. İki şeyin arasına 80 piksel koyarsan
ayrı olduklarını zaten anlarsın. Bölümler cetvel çizgisi ve boşlukla ayrılır.

**2. Ölçekte cesaret.**
`Başak` → 52 px ince serif. `güneş burcun` → 11 px, harf araları açılmış, soluk.
Beş kat oran. Bu tek başına ekranı pahalı gösterir.

**3. Ortalamayı sakla.**
Sol hizalı metin sakin durur. Ortalama **sadece kimlik alanı** için kullanılır —
orası ekranın kalbi, orada anlam taşır.

**4. Rengi cimrice kullan.**
Ekranda **tek renkli şey** olsun. Vurgu rengi ekranda **bir veya iki kez** görünür.
O zaman anlam kazanır. Her yere renk konursa renk susar.

**5. Boşlukta ritim.**
Sıçramalı ölçek: satır araları **8** · ilgili öğeler arası **24** · bölümler arası **96**.
O 96 piksel "ferahlık" dediğimiz şeyin kendisidir. Boş yer korkutucu gelecek —
doldurulmayacak.

**6. Her ekranda bir imza hamle.**
Astroloji'de bu, üst yarıyı kaplayan neredeyse boş kimlik alanı ve kaydırınca
küçülüp başlığa dönüşmesi.

**7. Alt menü ikonsuz.**
Küçük, harf aralı kelimeler; aktif olan koyu. Cesur ve dikkat çekici bir tercih.
⚠️ Kullanılabilirlik açısından PoC'de test edilecek.

## 6.5 Üç tema — gökyüzüyle birlikte değişen renk ✅

Uygulamanın **imza özelliği.** Süs değil kimlik: astroloji zaten gökyüzünün saate
göre değişmesi üzerine kurulu; uygulamanın da öyle olması **anlam** taşır.

| Tema | Ne zaman | Palet |
|---|---|---|
| **Sabah / Gündüz** | Güneş doğuşu → batıştan 2 saat öncesi | Kırık beyaz / açık kum zemin, sıcak gri metin |
| **İkindi** | Batıştan 2 saat önce → batıştan yarım saat sonra | Sıcak kum ve şeftali, soluk terrakota, bakır vurgu |
| **Gece** | Batıştan yarım saat sonra → güneş doğuşu | Derin lacivert (saf siyah değil), soluk gümüş metin, tek sıcak vurgu |

**Geçiş ölçütü:** Kullanıcının konumundaki **gerçek güneş doğuşu/batışı.**
Sabit saat değil. Uygulama mevsimle birlikte yaşar — kışın İstanbul'da güneş ~17:30'da
batar, uygulama 15:30'da ikindiye döner; yazın ~20:30'da batar, 18:30'da döner.

**Kurallar:**
- **Düzen hiç değişmez, sadece renk değişkenleri değişir.** Üç tema = üç kat iş değil,
  tek bir renk tablosu.
- Üç paletin metin/zemin kontrastı aynı seviyede tutulur
- Ayarlarda **"temayı sabitle"** seçeneği olur — kimse zorlanmaz
- İkindi kısa bir penceredir; kısalığı onu özel yapar

**Teknik:** PHP'nin yerleşik `date_sun_info` fonksiyonu yeterli, ek kütüphane
gerekmez. Flutter tarafında da hazır paketler var.
Konum: prototipte varsayılan İstanbul; tarayıcı izin verirse gerçek konum.

**⚠️ Açık nokta:** Sabah temasının vurgu rengi. İlk denemede soluk mavi kullanıldı,
diğer iki temadan kopuk durdu. Öneri: sabahın vurgusu da sıcak olsun (soluk kiremit /
kum-turuncu) — böylece üç tema aynı ailenin üç hali olur.

## 6.6 Tema geçiş animasyonu ✅

Meteor/titreme fikri değerlendirildi ve **reddedildi**: reddettiğimiz klişenin
ta kendisi, titreme "bozuldu" sinyali verir ve hareket hassasiyeti olanlar için
rahatsız edici, ayrıca meditasyonun sakinliğiyle çelişiyor.

**Kabul edilen: ışığın kayması.**

- **3-4 saniye** boyunca renkler üstten aşağı yavaşça yeni haline kayar
- Hiçbir nesne yok — hareket eden şey **rengin kendisi**
- Köşedeki ay evresi o an belirginleşir
- Altta tek satır belirip kaybolur: *"Güneş battı."*
- Telefonda "hareketi azalt" açıksa animasyon çalışmaz, renk doğrudan değişir
- Uygulama açıkken sınır geçilirse renkler yumuşakça kayar, **zıplamaz**

**Sorun:** Kullanıcıların çoğu o anda uygulamayı açık tutmuyor olacak.

**Çözüm — rastlantıyı randevuya çevir:**
Gün batımından 10 dakika önce bildirim:
> *"Güneş 10 dakika sonra batıyor. Uygulama akşama dönecek."*

Kullanıcı açar, bekler, izler. Ve akşam saatinde uygulama açılmış olur — ki bu
meditasyon için zaten en doğru saat. Estetik detay, geri dönüş mekanizmasına dönüşür.

**İkinci şans:** Ben sekmesinde "günün geçişleri" bölümü.

🅿️ **Park:** İleride daha güçlü bir geçiş (meteor vb.). Sade temelin üstüne efekt
eklemek kolaydır; efektli bir dünyayı sadeleştirmek her şeyi yıkmak demektir.

## 6.7 Tipografi ✅

**Karakterli serif başlık + sade sans gövde metni.**
Başlıklar ince, zarif, hafif edebi bir serif; gövde sakin ve okunaklı bir sans.
Dergi/kitap hissi verir, sıcak ve karakterli durur ama okumayı zorlaştırmaz.

**Kritik kısıt — Türkçe:** ş ğ ı İ ö ü ç harflerinin düzgün çizilmesi şart.
Birçok gösterişli başlık fontu bunları ya içermez ya da çirkin çizer — `ğ` kırpılır,
`İ` noktası kayar. Türkçe bir uygulamada affedilmez.

**Seçim yapıldı ✅** — prototipte kullanılan ve çalışan çift:

- **Başlık: EB Garamond** (latin-ext altkümesiyle yükleniyor, Türkçe karakterler sağlam)
- **Gövde: DM Sans** (latin-ext)

**Ölçek:** kimlik burcu 32 · bölüm başlığı 19–22 · gövde 13 · etiket 10.5 (harf aralı) ·
çizelge 12.5. Etiket ile başlık arasında en az **iki kat** fark bırakılır.

**Uyarı — yaşanmış hata:** Burç sembolleri (♈♉♊…) EB Garamond'da yok, kırık kare
olarak çıktı. Çarkta onların yerine **ev numaraları (1–12)** kullanıldı; hem font
sorunu bitti hem astroloji bilmeyen için daha anlaşılır oldu.
Gezegen sembolleri (☉☽☿♀♂♃♄) sorunsuz çiziliyor.

## 6.8 İmza detay: köşedeki ay evresi ✅

O anki **gerçek** ay evresi, her ekranın köşesinde küçük bir işaret olarak durur.
Süs değil **bilgi** — kullanıcı nereye giderse gitsin onunla birlikte.

Sessiz ama çok tanınır bir detay; tema değişimiyle birlikte uygulamanın
"gökyüzüne bağlı" hissini pekiştirir.

## 6.9a Kesin renk değerleri ✅

*Flutter'a geçerken bu tablo aynen kullanılacak.*

| | Sabah | İkindi | Gece |
|---|---|---|---|
| Zemin | `#F7F3EA` | `#F0E4D4` | `#171C2B` |
| Metin | `#201E1A` | `#29221E` | `#EFEBE3` |
| Soluk | `#4B4338` | `#4A3F35` | `#C3C9D8` |
| Vurgu | `#A5522C` | `#9B3F22` | `#E0A26F` |
| Cetvel | `#D5CBB8` | `#C9B394` | `#3A4358` |
| Ay dolgusu | `#C4B393` | `#C0A276` | `#B3BACE` |

⚠️ **Yardımcı metin kuralı: en az 8:1 kontrast.** WCAG'ın 4.5:1 eşiği *normal
punto* için. Bu renk 10–12px etiketlerde ve dipnotlarda kullanılıyor; AA eşiğini
geçse bile okunmuyor. Üç kez koyulaştırmak zorunda kalındı.

**Boşluk ölçeği:** 4 · 8 · 16 · 26 · **34** (bölümler arası)
**Süreler:** kısa 200 ms · orta 380 ms · uzun 520 ms · eğri `cubic-bezier(0.22,.8,.28,1)`

## 6.9b İkinci renk katmanı: faaliyet renkleri ✅

"Tek vurgu rengi" kuralı bilinçli olarak **bir istisnayla** esnetildi.
Bu renk **süs değil, anlam taşıyor**.

| Küme | Renk |
|---|---|
| beden & bakım | `#C2664A` kiremit |
| para & iş | `#B8942F` hardal |
| ilişkiler | `#B4678B` gül |
| yolculuk | `#6B9670` adaçayı |
| iç dünya | `#837AAE` mor |

Üç temada da okunacak orta tonlar; tema başına ayrı değer yok.

### Tek kaynak kuralı ⚠️

Bu renkler **bütün uygulamada** görünüyor: takvim kutuları ve lejant, Rehber'in
madde çubukları, Astroloji'nin "bugün"ü, Yolculuk'un günlük önerisi, Keşfet'in
gönderi ve hikâye halkaları, Uyum'un kategori durumları.

**Hepsi tek bir kaynaktan beslenmek zorunda.** Bir dönem şerit kural motorundan,
maddeler metin dosyasından geliyordu; sonuç: Rehber "konuşmanın günü" derken
yanındaki etiket "para & iş" diyordu. Kullanıcı bunu ilk bakışta yakalar.

### Renk kuralı: işaret renkli, yazı soluk

Küme etiketleri 10–11px. O boyutta metni renklendirmek kontrastı eşiğin altına
düşürüyor. Renk küçük işarette, yazı `--soluk`ta kalıyor.

### Bilerek renk konmayan yerler

Çin/numeroloji satırları · gökyüzü çizelgesi · kişi formu · künyenin girilen
kısmı · Yolculuk'un ders listesi. Oralarda renk anlam taşımaz, gürültü olur.

## 6.9c "Önce ne, sonra neden" ilkesi ✅

Kullanıcı astroloji bilmiyor. **Astrolojik terim hiçbir zaman başlık olmaz.**

Yanlış:
> **Ay Yay'da · küçülen ay**
> Hareket eden, konuşan bir gün.

Doğru:
> **Konuşmanın ve yola çıkmanın günü** ← 22 px serif
> Başlatmaya değil, bitirmeye elverişli. ← tek cümle
> *ay yay'da · küçülen ay* ← 11 px soluk, dipnot

Jargon dayanak olarak en alta iner. Bilmeyen atlar, merak eden okur.

**Not:** Uzun gökbilim açıklamaları da denendi ("Merkür aslında geri gitmiyor,
Dünya onu sollarken...") ve **reddedildi** — ekran metin denizine dönüştü.
Terimi açıklamak gerekiyorsa tek satırı geçmemeli.

## 6.9d Denenip reddedilenler — önemli ders ⚠️

**Gerçek ay fotoğrafı (NASA) denendi, reddedildi.**
**Gravür tarzı krater dokusu denendi, reddedildi.**

Çıkan ders: **bu tasarım dili gerçekçi görseli ve dokuyu kaldırmıyor.**
Çizgi ve tipografi üzerine kurulu; içine fotoğrafik bir nesne girince yamalı duruyor.

**Bu, Keşfet ve Yolculuk için ciddi bir uyarı.** İkisi de baştan aşağı fotoğraf olacak.
Ya tasarım dili fotoğrafa göre esnetilecek, ya fotoğrafları bu dile sokmanın bir yolu
bulunacak. Bu sorun oralara gelmeden çözülmeli.

## 6.9 Reddedilenler (kesin) ✅

- Degrade
- Buzlu cam / bulanıklık efekti
- Yıldız serpintisi
- Emoji
- Kart
- Hazır ikon setleri (mümkün olduğunca)
- Gölge

**Bonus kavrayış:** Bu estetik kararların çoğu aynı zamanda **performans kararı**.
Flutter'da buzlu cam (BackdropFilter) en pahalı işlemlerden biridir; degradeler
ve yarı saydamlıklar ekstra çizim katmanı açar; gölgeli yuvarlak kartlar kırpma
gerektirir. Düz renk zemin ve boşlukla ayrılmış bölümler, Flutter'ın en hızlı
çizdiği şeydir. **Sadelik ucuz çizilir.**

---

# 7. ANİMASYON İLKELERİ ✅

Akıcılık hissi rastgele animasyon eklemekten gelmez.

## 7.1 Hareket bilgi taşımalı

Her animasyon bir soruyu cevaplar: *bu nereden geldi, nereye gitti, neyle bağlantılı?*

Kimlik kartının küçülüp başlığa dönüşmesi "bu ikisi aynı şey" der. Bir bölümün
açılırken aşağıyı iterek yer açması "bu buradan çıktı" der.

Sebepsiz hareket — dönen simgeler, nabız gibi atan noktalar — **gürültüdür.**

## 7.2 Süre ve eğri

| Tür | Süre |
|---|---|
| Küçük tepkiler (basma, açılma) | 150–250 ms |
| Orta geçişler (ekran değişimi) | 300–400 ms |
| Tema geçişi | 3–4 sn *(bilinçli istisna — ortam animasyonu)* |

**Hiçbir animasyon doğrusal olmaz.** Doğrusal hareket mekanik hissettirir çünkü
doğada yoktur. Her şey hızlı başlar, yavaşlayarak durur. Bu tek ayar,
"ucuz" ile "pahalı" arasındaki farkın yarısıdır.

## 7.3 Sıralı giriş (stagger)

Listedeki öğeler aynı anda değil, aralarında **40 ms** farkla belirsin. Göz bunu
tek tek algılamaz ama his değişir — ekran "kurulmuş" gibi görünür.
En ucuz "pahalı görünme" yöntemi.

## 7.4 Kesilebilirlik

Kullanıcı bir animasyon sürerken kaydırmaya başlarsa, animasyon **anında ona teslim
olmalı.** "Bitmemi bekle" diyen animasyon uygulamayı ağır hissettirir.

## 7.5 Kaydırmaya bağlı hareket

Zamana bağlı animasyondan daha iyi hissettirir. Kimlik kartı "yarım saniyede
küçülsün" değil, **"parmağınla birlikte küçülsün".** Fiziksel his budur.

---

# 8. PoC — TIKLANABİLİR PROTOTİP

## 8.1 Kapsam ✅

**PHP ile web üzerinde, mobil görünümlü, tıklanabilir prototip.**

- Sahte veri
- Veritabanı yok veya çok basit
- Gerçek ödeme yok
- Gerçek gezegen hesabı yok (sabit/sahte veri)
- Amaç: tasarımı ve akışı görmek, sonra Flutter'a çevirmek

## 8.2 Sunum biçimi ✅

- Tarayıcıda **ortada**, gerçek telefon ölçüsünde (390×844 — iPhone boyu)
- Etrafı koyu, göz ekrana odaklansın
- Telefondan açıldığında çerçeve kaybolur, **tam ekran** olur
- Kaydırma, sekme geçişleri, animasyonlar çalışır

## 8.3 Ekran listesi (~24)

**Giriş akışı (5)**
Karşılama · Doğum tarihi · Doğum saati · Doğum yeri · Sonuç önizlemesi + Kayıt

**Keşfet (3)**
Akış · Gönderi detayı · Hikâye görüntüleyici

**Astroloji (3)**
Ana akış · Genişletilmiş detay · Premium teklif ekranı

**Yolculuk (3)**
Kütüphane · Kategori/raf detayı · İçerik oynatıcı

**Rehber (2)**
Bugün · Tümünü gör

**Ben (5)**
Profil · Doğum bilgilerim · Takvimim · Kaydettiklerim · İlerlemem

**Sinastri (2)**
Arkadaş ekle/seç · Uyum sonucu

**Admin paneli (3)**
Giriş · İçerik yükleme · İçerik listesi

**İlk yapılacak ekran:** Astroloji ana ekranı — görsel dilin bütün parçaları orada
aynı anda sınanır (büyük serif başlık, kimlik alanı, açılan bloklar, çizelge,
premium kartı, köşedeki ay evresi). Orası tutarsa gerisi kolay gelir.

## 8.4 Mimari ilkeler — "Yeşim Hanım'dan yüzlerce direktif gelecek" ✅

Değişikliklerin dakikalar sürmesi için üç ilke:

**1. İçerik ile tasarım ayrı dursun.**
Tüm metinler — yorumlar, tavsiyeler, gönderi yazıları, ders başlıkları — **tek bir
içerik dosyasında** toplanır. Ekran dosyalarının içine hiç metin yazılmaz.
"Şu cümle şöyle olsun" dendiğinde tek satır değişir.

**2. Ekran parçaları tek yerde tanımlansın.**
Kart, buton, raf, başlık, alt menü... her biri bir kez yazılır, her ekran onu çağırır.
"Tüm başlıklar biraz daha büyük olsun" dendiğinde bir yer değişir, 24 ekran birden
değişir. Kopyala-yapıştır yapılırsa 24 yer tek tek düzeltilir — asıl tuzak burası.

**3. Renk, yazı tipi, boşluk değerleri değişken olsun.**
"Bakır biraz daha koyu olsun" → tek değer. Yoksa 200 yerde renk kodu aranır.

**4. Ekran başına veri gruplaması baştan doğru olsun.**
Prototipteki ekran düzeni "bir ekran = bir istek" mantığına uygun kurulursa,
Flutter'a geçerken aynı yapı devam eder. Kurulmazsa orada baştan yazılır.

Yani prototipin görevi sadece "nasıl görünüyor" değil, aynı zamanda
**"veriler nasıl gruplanıyor"** sorusunu cevaplamak.

## 8.5 İçerik metinleri ✅

Prototipteki tüm metinler **uydurma ama gerçekçi** olacak. Türkçe, Yeşim Hanım'ın
olabileceği bir üslupta. Hepsi tek dosyada duracağı için sonra toptan değiştirmek
kolay.

## 8.6 PoC'de olmayacaklar

- Gerçek ödeme (sadece sahte premium teklif ekranı)
- Gerçek kullanıcı kaydı ve oturum
- Gerçek sosyal etkileşim (beğeni tıklanır ama kaydedilmez)
- Gerçek video yükleme/oynatma altyapısı
- Moderasyon
- Bildirimler

---

## 8.7 Prototipin dosya yapısı ✅

```
index.php            kabuk, sekme yönlendirme, tema/hareket denetimi
ayar/tema.php        güneş doğuş-batış, ay evresi, tarih
icerik/veri.php      TÜM metinler — ekran dosyalarında hiç metin yok
parca/carka.php      doğum haritası çarkı
parca/takvim.php     aylık takvim + gün işaretleri
parca/yakinda.php    çizilmemiş sekmeler için yer tutucu
varlik/stil.css      renkler ve ölçüler değişken olarak; üç tema tek tabloda
varlik/hareket.js    kaydırma, açılır paneller, çark bağlantısı, hikâyeler
sayfa/*.php          sekiz ekran
```

**Alt sayfa mantığı:** `$altSayfalar` haritası — `takvim → rehber`,
`uyum → ben`, `kisi → ben`. Alt sayfadayken alt menüde kendi sekmesi yok, ait
olduğu sekme vurgulu kalıyor.

**Prototip denetimleri (sağ kenarda, ekranın dışında):** tema (otomatik / sabah /
ikindi / gece), hareket (açık / kısıtlı), bilgi satırı (doğuş, batış, ay evresi).

⚠️ **Uygulamaya geçerken hatırlanacak iki şey:**
- Ay evresi hesabı ortalama sinodik ay üzerinden, yarım güne kadar sapabilir —
  gerçek uygulamada efemeris kullanılacak.
- Prototipte `prefers-reduced-motion` devre dışı (amaç hareketi
  değerlendirmek); **gerçek uygulamada işletim sistemi ayarına bağlanacak.**

*Uygulama sırasında çıkan teknik dersler koddaki yorumlarda duruyor —
burada tekrarlanmıyor.*

**Sunucu:** XAMPP altında `localhost/medi-astro/`

# 9. PoC SONRASI — YOL HARİTASI

## Faz 0 — PoC *(şu an)*
PHP tıklanabilir prototip. Astroloji ekranıyla başla, onay al, kalan 23 ekranı yap.

**Çıktı:** Gezilebilir prototip, onaylanmış görsel dil.

## Faz 1 — Tasarım iterasyonu
Yeşim Hanım'a gösterim. Direktifler. Ruzname yönü onaylanmazsa alternatif
(konvansiyonel veya karma) denenir.

**Çıktı:** Kesinleşmiş tasarım sistemi — renkler, fontlar, boşluklar, bileşenler.

## Faz 2 — Backend *(Supabase — bkz. Bölüm 12)*
- Supabase kurulumu, **Frankfurt bölgesi**
- Veri modeli (bkz. 12.5) — her tablo oluşturulurken erişim kuralı da yazılır
- Roller ve satır bazlı yetkilendirme
- **Doğum verisinin dört parçalı saklanması** (bkz. 12.4)
- Gerçek gezegen hesabı (Swiss Ephemeris veya eşdeğeri)
- Gece toplu yorum üretimi (zamanlanmış görev)
- Admin paneli
- Ödeme entegrasyonu
- Video servisi entegrasyonu

**Çıktı:** Çalışan backend + admin paneli.

**Önce yapılacak:** KVKK/veri yeri sorusu avukata sorulmalı — cevap Supabase
kararını değiştirebilir.

## Faz 3 — Flutter uygulaması
Prototipteki ekranlar ve veri gruplaması birebir taşınır.

**Çıktı:** iOS + Android uygulaması.

## Faz 4 — İçerik üretimi
- Meditasyon/eğitim videolarının çekimi ve **gökyüzü etiketlemesi**
- Yorum şablonlarının yazılması
- Rehber kural tablosunun doldurulması
- Yeşim Hanım'ın kişisel yorum iş akışının kurulması

**Kritik:** "Gökyüzüne bağlı meditasyon" fikri ancak içerikler o mantıkla üretilirse
çalışır. Çekim listesi buna göre kurulmalı — "Ay Akrep'te için bir meditasyon",
"Dolunay için bir tane".

## Faz 5 — Güvenlik ve performans denetimi
- **Bağımsız güvenlik testi** (baştan bütçeye konmalı)
- Orta seviye Android'de, zayıf 4G'de performans ölçümü
- KVKK uyum kontrolü (avukat)

## Faz 6 — Beta ve yayın
Sınırlı kitleyle beta, geri bildirim, mağaza yayını.

---

# 10. GÜVENLİK

## 10.1 Bu uygulamada asıl risk

İnsanlar güvenliği "hacker sunucuya girer" diye düşünür. Gerçekte en sık yaşanan şey
çok daha sıradan: **bir kullanıcı, başkasının verisini görür.**

Bu risk burada normalden yüksek:
- Doğum tarihi + saat + yer, banka güvenlik sorularının cevabıdır
- Sosyal katman var — kullanıcılar zaten birbirinin profiline bakabiliyor
- Yeşim Hanım'ın kişisel yorumları mahrem metinlerdir
- Sinastri iki kişinin verisini bir araya getiriyor

**Asıl savunma hattı: yetkilendirme.**

## 10.2 En kritik konu — "bu veri bu kişinin mi?"

Gerçek dünyadaki açıkların en yaygını, adres çubuğundaki numarayı değiştirmektir:

```
/yorum/1042   →   /yorum/1043
```

Sunucu "bu yorum isteyen kişiye mi ait?" diye sormuyorsa, kullanıcı başkasının
yorumunu okur. Bu kod hatası değil **eksikliktir**, ve fark edilmesi zordur çünkü
uygulama gayet düzgün çalışıyor görünür.

**Kural:** Hiçbir veri yalnızca kimliğiyle çağrılmaz, **her zaman sahibiyle birlikte**
çağrılır. "1043 numaralı yorumu getir" değil, "bu kullanıcının 1043 numaralı yorumunu
getir". Sahip eşleşmiyorsa hata bile verme — "bulunamadı" de.

**Uygulama:** Bunu her yerde hatırlamaya çalışmak hata davetiyesidir. Veriye erişim
**tek bir kapıdan** geçer; o kapı her seferinde sahiplik kontrolü yapar.
Unutmak imkânsız hale gelir.

## 10.3 Sunucunun fazla konuşması

Bir kullanıcı başkasının profiline bakıyor. Ekranda sadece isim ve fotoğraf var —
ama sunucu arka planda bütün kullanıcı kaydını göndermiş olabilir: doğum saati,
doğum yeri, e-posta, telefon. Ekranda görünmez ama oradadır.

Bu çok yaygın bir hatadır çünkü tasarımcı ekranı görür, kimse veriyi görmez.

**Kural:** Her ekran için sunucunun ne göndereceği ayrıca tanımlanır.
"Kullanıcıyı gönder" diye bir şey yoktur; "başkasına gösterilecek profil" ayrı bir
şeydir, "kendi profilim" ayrı bir şey.

**Doğum saati ve doğum yeri hiçbir zaman başka kullanıcıya gitmez.**

## 10.4 Sosyal katmanın riskleri

**Zararlı metin.** Birinin gönderisine yazdığı şey, başkasının ekranında kod olarak
çalışabilir. Kullanıcıdan gelen hiçbir metne güvenilmez, ekrana basılırken daima
zararsızlaştırılır.

**Zararlı dosya.** Profil fotoğrafı diye sunucuda çalışabilen dosya yüklenmesi.
Çözüm: uzantıya değil **gerçek içeriğe** bakmak, dosyaları yeniden işlemek
(yeniden boyutlandırmak çoğu zararlıyı temizler), ve yüklenen dosyaların durduğu
yerin **hiçbir şeyi çalıştıramaması.**

**İçerik güvenliği (operasyonel):** taciz, spam, sahte astrolog hesapları.
Şikayet, engelleme, gizleme mekanizmaları gerekir. PoC'de yok, gerçek uygulamada
birinci günden lazım.

## 10.5 Ödeme güvenliği

**Kart bilgisi bize hiç uğramaz.** Ne veritabanına, ne sunucu kaydına, ne geçici
olarak. Ödeme sağlayıcısı veya mağazanın satın alma sistemi kullanılır; bize sadece
"ödendi" bilgisi döner.

**Ödeme doğrulaması sunucuda yapılır.** Uygulama "ben premium'um" derse sunucu buna
inanmaz — sağlayıcıya sorar.

## 10.6 Admin paneli güvenliği

- Panel kullanıcı uygulamasından **ayrı** yaşar
- **Hoca ≠ yönetici** — hoca sadece kendi içeriğini görür ve düzenler
- Panelde yapılan **her işlem kaydedilir** (kim, ne zaman, neyi değiştirdi)

## 10.7 Flutter/mobil tarafı

**Uygulamanın içi herkese açıktır.** İsteyen indirir, açar, içine bakar.
**Hiçbir sır uygulamanın içine konmaz** — ödeme anahtarı, yönetici parolası,
veritabanı bilgisi. Bunlar yalnızca sunucuda yaşar.

**Oturum anahtarı** sıradan bir ayar dosyasında değil, işletim sisteminin güvenli
kasasında durur (iOS Keychain / Android Keystore). Kısa ömürlü olur, düzenli
yenilenir, çıkışta **sunucu tarafında da geçersiz kılınır.**

**Uygulamaya asla güvenme.** Premium olup olmadığına her zaman sunucu karar verir.
Kilitli içerik uygulamaya gönderilip orada gizlenmez — kullanıcı premium değilse
**o metin cihaza hiç gitmez.** "Görünmüyor" ile "yok" arasındaki fark, güvenliğin
tamamıdır.

**Kişisel yorumlar için özel koruma:**
1. **Ekran görüntüsü engeli** — o ekranlarda görüntü alınamaz
2. **Biyometrik kilit — ve bu aslında bir özellik.** Kullanıcı isterse kişisel
   yorumlarını parmak izi/yüz tanıma arkasına alır. Telefonunu birine uzattığında
   içi rahat olur. Satış argümanı: *"yorumların sadece senin."* Rakiplerde yok.
3. Cihazda **şifreli** tutulur

**İndirilen videolar** telefonun galerisinde bulunabilir bir yerde durmaz.
Uygulamanın özel alanında, mümkünse şifreli. Yoksa Yeşim Hanım'ın emeği çalınır.

**Kod karartma (obfuscation)** yayına çıkarken uygulanır. Tersine çevirmeyi
imkânsız yapmaz ama ciddi şekilde zorlaştırır. Tek satırlık derleme ayarı.

**Üçüncü parti paketler.** Her eklenen paket, koduna aldığın **başkasının kodudur.**
Bakımsız veya kötü niyetli bir paket veri sızdırabilir. Az paket kullan, seçerek
kullan (kaç kişi kullanıyor, ne zaman güncellenmiş, kim yazmış), sürümleri sabitle.

**Cihaz doğrulama.** Ödeme ve premium erişimi için isteğin gerçekten senin
uygulamandan geldiğini doğrulayan platform hizmetleri kullanılır.

## 10.8 KVKK ⚠️

**Bu bir hukuk konusudur, avukata danışılmalıdır.**

Toplanan veri basit değil. Doğum tarihi, saati, yeri kimlik verisidir. Daha hassas
bir nokta: **bir kişinin astroloji uygulaması kullanması, inançları hakkında bilgi
taşır.** Bazı kişisel veri türleri (inanç, felsefi görüş, sağlık) mevzuatta daha
korumalı kategoride sayılır. Meditasyon içeriklerinin bazıları (kaygı, uyku, travma)
sağlık verisine yaklaşabilir.

**Mimari baştan şuna göre kurulmalı:**
- Açık rıza metni
- Verinin ne için toplandığının net anlatımı
- **Hesabını silmek isteyen kullanıcının verisinin gerçekten silinmesi**

Bunlar sonradan eklenmesi zor şeylerdir.

## 10.9 Bağımsız denetim ⚠️

Gerçek uygulamaya geçmeden önce **bağımsız bir güvenlik testi** yaptırılmalı.
Kendi kodunu kendin denetleyemezsin — kör noktaların vardır.
Bu bir maliyet kalemidir, baştan bütçeye konmalı.

---

# 11. PERFORMANS — "ŞAK DİYE AÇILSIN"

Tek cümleye indirgenir:

> **Kullanıcı beklerken hiçbir şey hesaplanmamalı.**

Uygulamalar yavaş değildir; **yanlış anda çalışırlar.**

## 11.1 Her şeyi önceden hazırla ✅

**Doğum haritası bir kere hesaplanır.** Kullanıcı kaydolurken, bir kez. Sonuç
saklanır. Doğum bilgisi değişmedikçe bir daha asla hesaplanmaz — çünkü değişmez.

**Günlük yorumlar gece üretilir.** Sistem gece boyunca ertesi günün yorumlarını,
faaliyet tavsiyelerini ve önerilen meditasyonu hazırlar. Sabah kullanıcı açtığında
sunucu **hiçbir şey hesaplamaz**, hazır olanı verir.

Ek fayda: içerik önceden hazır olduğu için **kontrol edilebilir.** Yeşim Hanım
sabah bakıp "buradaki cümle iyi olmamış" diyebilir. Anlık üretimde bu şans yok.

## 11.2 Bekletme, eskisini göster ✅

Kullanıcı uygulamayı açtığında ekranda **dün gördüğü şey zaten durmalı** —
cihazda saklanmış olarak. Yeni veri arka planda gelir, sessizce yerine geçer.

Sonuç: kullanıcı hiçbir zaman boş ekrana bakmaz. Dönen çarklar, iskelet kutular yok.
Uygulama **her zaman doluymuş gibi** hissettirir. Yükleniyor animasyonu ancak
elimizde hiç veri yokken (ilk kurulum) görünür.

Aslında hızlı olmaktan çok **hızlı hissettirmek** meselesi — ve algı gerçeklikten
önemlidir.

## 11.3 Ekran başına tek istek ✅

Yaygın hata: bir ekran açılırken sekiz ayrı istek yapmak. Her isteğin kendi gecikmesi
var, mobil ağda toplanıp saniyelere çıkıyor.

**Bir ekran = bir istek.** Sunucu o ekranın ihtiyacı olan her şeyi tek pakette gönderir.
Mobilde bu tek başına en büyük hız kazancıdır.

## 11.4 Asıl yavaşlık görsellerde ✅

- Fotoğraflar **ekranda görünen boyutta** gönderilsin. 4000 pikselik bir fotoğrafı
  400 pikselik alana koymak kullanıcının internetini boşa harcamaktır.
- Video için **uyarlanabilir yayın**: video birkaç kalitede hazırlanır, oynatıcı
  kullanıcının hızına göre seçer. Zayıf bağlantıda düşük kaliteyle hemen başlar.
  Meditasyon videosunun ortasında donması deneyimi tamamen öldürür.
- Videolar sunucudan değil **dağıtım ağından (CDN)** verilsin
- Keşfet'te görünmeyen görseller yüklenmesin; **birazdan görünecekler** önceden
  yüklensin

## 11.5 Liste yönetimi ✅

Sonsuz akışlarda ekranda görünen ve az öncesi/sonrası tutulur, gerisi bırakılır.
Flutter bunu doğru kullanıldığında yapar, yanlış kurulursa yapmaz.
500 gönderiden sonra uygulama şişer, kasar, çöker.

## 11.6 Veritabanı ✅

Prototipte fark edilmez, on bin kullanıcıda her şey durur. Sebep hep aynıdır:
**eksik indeks** ve **döngü içinde sorgu.** Sonradan bulunması zor, baştan doğru
kurulması kolay.

## 11.7 Flutter tarafı

**Görsel çözümleme** en büyük takılma kaynağıdır. Sunucu doğru boyutta göndermeli,
uygulama da görseli **hafızaya küçültülmüş olarak** almalı. Tek satırlık bir ayar,
unutulduğunda akış kasar. Görseller diske önbelleklenir.

**Doğum haritası hesabı ana iş parçacığında yapılmaz** — ekran donar. Ayrı bir iş
parçacığına (isolate) atılır. Bizde bu sorun zaten doğmuyor çünkü hesap sunucuda
yapılıyor.

**Yeniden çizim disiplini.** En yaygın performans hatası: küçük bir değişiklik için
koca bir ekranın yeniden çizilmesi (beğeni sayısı değişince bütün akışın yenilenmesi).
Mimari mesele — baştan doğru kurulursa dert olmaz.

**Tema geçişi ucuzdur.** 3-4 saniyelik ışık kayması Flutter'ın en sevdiği animasyon
türü: sadece renk değişiyor, düzen değişmiyor. Hiçbir şey yeniden ölçülmüyor.
(Meteor animasyonu her karede yeni nesne çizmek olurdu — bir kararla hem estetik
hem performans kazanıldı.)

## 11.8 Ölçüm ✅

- Performans **asla geliştirme modunda ölçülmez** — profil modunda, gerçek cihazda
- Test cihazı **orta seviye bir Android** olmalı. Orada akıcıysa her yerde akıcıdır
- Gerçek koşul: zayıf 4G, kalabalık bir yer

**Hedefler:**
| Ölçüt | Hedef |
|---|---|
| Açılıştan ilk anlamlı içeriğe | 1 saniye |
| Sekme geçişi | Anında |
| Video başlama süresi | 2 saniyenin altında |

Hedef yoksa "yavaş mı hızlı mı" tartışması hep öznel kalır.

---

# 12. TEKNİK YIĞIN VE VERİTABANI

## 12.1 PoC'de veritabanı yok ✅

Prototipte tüm metinler **tek bir PHP dosyasında dizi olarak** durur.

**Neden:**
- Yeşim Hanım "şu cümle değişsin" dediğinde tek satır düzeltilir — sorgu yok, panel yok
- Kurulum derdi yok, klasörü kopyalayan çalıştırır
- Prototipin amacı görünüm ve akış; veri saklamak değil

**Önemli:** PHP prototip **atılacak bir şeydir.** Bir tasarım aracıdır — bakmak,
karar vermek, iterasyon yapmak için. "Madem yazdım, buradan backend'e çeviririm"
denmemeli. Gerçek sistem ayrı kurulacak, prototip görevini yapıp kenara çekilecek.

## 12.2 Gerçek uygulama: Supabase + Flutter ✅

**Geliştirme:** Proje tek kişi tarafından yürütülecek. Bu, teknoloji seçimini
doğrudan belirliyor — backend işini sırttan alan bir çözüm gerekiyor.

**Seçim: Supabase.**

### Neden oturuyor

**1. Zaten PostgreSQL.** Supabase, üstüne kabuk giydirilmiş gerçek bir Postgres.
Sıkışınca doğrudan SQL yazılır; kaçış yolu her zaman açık, kilitlenme riski düşük.

**2. En büyük güvenlik derdini mimari olarak çözüyor.**
Bölüm 10.2'deki *"bu veri bu kişinin mi?"* kontrolünü her yerde tek tek yapmak hata
davetiyesidir. Supabase'in **satır bazlı erişim kuralları (RLS)** ile kural bir kere
veritabanına yazılır: "kullanıcı sadece kendi satırlarını görebilir". Sonra hangi
ekrandan, hangi sorguyla gelinirse gelinsin veritabanı kendisi engeller.
Geliştirici unutsa bile o unutmaz. **Tek kişilik ekip için çok büyük bir güvenlik ağı.**

**3. Kimlik doğrulama hazır.** Telefon OTP, e-posta, Google/Apple girişi.
Sıfırdan yazmak haftalar alır ve yanlış yapılması çok kolaydır.

**4. Dosya depolama var** — profil fotoğrafı, gönderi görseli gibi küçük dosyalar için.

**5. Flutter kütüphanesi olgun.**

**6. Zamanlanmış görevler ve sunucu fonksiyonları var** — "gece yorumları üret"
işi orada kurulabilir.

### Neden Firebase değil

Verimiz ilişkisel: kullanıcı → doğum verisi → harita → yorumlar → ödemeler,
hepsi birbirine bağlı. Firestore burada işi zorlaştırır ve karmaşık sorgularda
tıkanılır. Supabase'in Postgres olması doğrudan avantaj.

## 12.3 Supabase kullanırken dört kural ✅

### 1. Videolar Supabase'de durmaz

Supabase Storage dosya saklar ama **uyarlanabilir video yayını yapmaz.**
Yolculuk kütüphanesi için ayrı bir video servisi gerekir (videoyu birkaç kaliteye
çevirip kullanıcının hızına göre veren türden).

Ayrıca veri çıkışı ücretlidir; video trafiği Supabase üzerinden akıtılırsa fatura
hızla büyür.

**Ayrım:** Küçük dosyalar (profil fotoğrafı, gönderi görseli) Supabase'de.
Videolar ayrı serviste; veritabanında sadece adresleri. ⚠️ Video servisi henüz seçilmedi.

### 2. Veri nerede duracak — KVKK açısından ciddi ⚠️

Supabase sunucuları yurt dışındadır. Türkiye'de faaliyet gösterilecek ve **hassas
kişisel veri** toplanacak (doğum saati/yeri, inanç göstergesi olabilecek kullanım,
mahrem yorumlar).

KVKK'da kişisel verinin yurt dışına aktarılmasının kendine özel kuralları vardır.
**Avukata sorulmalı.**

**Şimdiden yapılacak:** Bölge seçilirken **Frankfurt (Avrupa)** seçilmeli, ABD değil.
Aydınlatma metni buna göre hazırlanmalı.

**Bu, Supabase'i engelleyebilecek tek gerçek risktir. Erken öğrenilmeli.**

### 3. Yönetici anahtarı asla uygulamaya konmaz

Supabase'in iki anahtarı vardır: herkese açık olabilen (`anon`) ve **her şeyi
yapabilen yönetici anahtarı** (`service_role`).

İkincisi Flutter uygulamasının içine konursa **bütün veritabanı herkese açılır** —
uygulamanın içi tersine çevrilebilir (bkz. 10.7). Bu, Supabase kullananların yaptığı
bir numaralı felakettir.

**Kural:** `service_role` sadece sunucu tarafında, sadece arka plan işlerinde.

### 4. Erişim kuralları ilk günden açılır

Supabase'de bir tablo kural konmadan oluşturulabilir ve o tablo herkese açık olur.
"Sonra kapatırım" demek, unutmaya açık bir kapı bırakmaktır.

**Her tablo oluşturulduğu anda kuralı da yazılır. İstisnasız.**

## 12.4 En kritik veri konusu: saat dilimi ✅

**Astroloji uygulamalarının en klasik hata kaynağıdır.**

Kullanıcı "3 Mart 1985, saat 04:20, Trabzon" diyor. Bu bilgiyi doğru saklamak
göründüğünden zordur:

- Türkiye'nin saat dilimi kuralları **zaman içinde değişti** — 2016'da yaz saati
  uygulaması kaldırıldı ve kalıcı olarak +3'e geçildi. 1985'te doğan biri için
  o günün kuralları geçerliydi.
- O tarihte yaz saati uygulanıyor muydu, hangi tarihte başlıyordu?
- Yurt dışında doğanlar için daha da karmaşık

**Sadece "UTC'ye çevirip saklayalım" denirse, yıllar sonra bir hata bulunduğunda
geri dönüş olmaz** — orijinal bilgi kaybolmuştur.

**Doğru yaklaşım — dördü birden saklanır:**

1. Kullanıcının **girdiği haliyle** yerel tarih ve saat
2. Doğum yerinin **koordinatları**
3. Saat dilimi **kimliği** (`Europe/Istanbul` gibi)
4. Hesaplanmış **UTC karşılığı**

Dördüncüsü hesaplanmış bir değerdir; kural tablosu güncellenirse yeniden hesaplanır.
İlk üçü **asla değişmeyen gerçektir.**

**Not:** Saat dilimi kural veritabanı (IANA) yılda birkaç kez güncellenir.
Sunucunun bunu güncel tutması gerekir.

## 12.5 Kaba tablo yapısı

**Kimlik ve kişisel veri**
`kullanici` · `dogum_verisi` · `harita` (bir kere hesaplanır, JSON saklanır) · `rol`

**Günlük içerik — performansın kalbi**
`gunluk_icerik` (kullanıcı, tarih, hazır metinler) — gece üretilir, sabah okunur.

⚠️ **Ölçek uyarısı:** 100 bin kullanıcı × her gün = hızla büyür.
Çözüm: herkese değil, **son 30 günde uygulamayı açmış kullanıcılara** üretmek;
gerisini ilk açtıklarında oluşturmak. Eski kayıtları belli süre sonra silmek.

**Astroloji verisi**
`gezegen_konumu` (günlük) · `ay_evresi` · `retro_donemi` · `faaliyet_kurali`
(Ay'ın burcu + evre → hangi tavsiye)

Bunların çoğu **kişiye bağlı değildir** — bir kere hesaplanıp herkes için kullanılır.
Büyük performans kazancı.

**İçerik**
`ders` (video/eğitim) · `ders_etiketi` (gökyüzü bağlantısı) · `raf` · `ilerleme`

**Sosyal**
`gonderi` · `hikaye` · `takip` · `begeni` · `yorum` · `sikayet` · `engelleme`

**Premium**
`yorum_talebi` (durum: talep alındı → hazırlanıyor → teslim edildi) · `odeme` · `teslim`

**Sinastri**
`arkadaslik` · `sinastri_sonuc` (hesaplanmış sonuç saklanır, her seferinde yeniden
hesaplanmaz)

**Yönetim**
`denetim_kaydi` — panelde kim, ne zaman, neyi değiştirdi

## 12.6 Veritabanına girmeyecekler

**Videolar ve büyük görseller veritabanına konmaz.** Nesne depolamaya gider,
önüne dağıtım ağı konur. Veritabanında sadece **adresi** durur.

Video veritabanına konursa yedekleme imkânsızlaşır, sorgular yavaşlar,
maliyet patlar.

## 12.7 Veri güvenliği — üç not

**1. Kişisel yorumlar şifreli saklanır.** Veritabanına erişen biri (yedek dosyası
sızsa bile) Yeşim Hanım'ın yazdığı mahrem metinleri okuyamamalı.
Şifreleme anahtarı veritabanının içinde durmaz.

**2. Silme gerçek olmalı.** Yazılımda genelde "silindi" işareti konur, veri durur.
KVKK açısından bu yeterli değildir — kullanıcı hesabını silmek istediğinde verinin
**gerçekten** gitmesi gerekir. Baştan karar verilmeli, sonradan eklemek zordur.

**3. Yedek de hassas veridir.** Şifreli tutulmalı ve nerede durduğu bilinmeli.

## 12.8 Yanına gerekecek iki şey

**Önbellek.** Oturum bilgisi, o günün hazır içeriği, Keşfet akışı burada tutulur.
Veritabanına hiç gidilmeden cevap verilir. "Şak diye açılma" hedefinin büyük kısmı
buradan gelir.

**Arka plan iş sistemi.** Gece yorum üretimi, bildirim gönderimi, video işleme gibi
işler kullanıcı beklerken değil, kuyrukta çalışır.

## 12.9 Tek kişilik ekip için kapsam uyarısı ⚠️

Yapılacak iş listesi: astroloji hesap motoru + sosyal ağ + video kütüphanesi +
ödeme sistemi + admin paneli + Flutter uygulaması + içerik yönetimi.
**Bu, ekiplerin yıllarını alan bir kapsamdır.**

Supabase tam da bu yüzden doğru seçim — backend işinin büyük kısmını sırttan alıyor.
Ama yine de **sırayla gidilmeli.** Her şey aynı anda yapılmaya kalkılırsa hiçbiri bitmez.

**Önerilen sıra:**

| Sürüm | Kapsam | Gerekçe |
|---|---|---|
| **v1** | Astroloji + Rehber + Yeşim Hanım'ın kişisel yorumu | Uygulamanın kalbi ve tek başına değerli; gelir de burada |
| **v2** | Yolculuk (video kütüphanesi) | Prodüksiyon zaman alır |
| **v3** | Keşfet (sosyal katman) + Sinastri | En ağır operasyonel yük (moderasyon) |

---

# 13. ÖDEME VE TİCARET

## 13.1 Premium modeli ✅

**Tek kapı: Yeşim Hanım'dan kişisel yorum talebi.**

Açık kalan her şey ücretsizdir — sosyal paylaşımları, eğitim kütüphanesi,
takvim, sinastri, günlük yorumlar.

Sattığımız şey yazılım değil, **o.**

## 13.2 Temel çatal: mağaza mı, kendi altyapın mı?

| Yol | Kesinti |
|---|---|
| **Uygulama içi satın alma** (Apple/Google) | %30; küçük işletme programındaysa %15 |
| **Kendi ödeme altyapın** (iyzico, PayTR) | %2,3 – %2,75 |

iyzico: ~%2,49 + 0,25 TL · PayTR: %2,3–2,75 (hacme göre) · her ikisi TCMB lisanslı,
6493 sayılı kanun kapsamında ödeme kuruluşu.

**1.500 TL'lik bir yorum üzerinden:**

| Yol | Kesinti | Kalan |
|---|---|---|
| Mağaza %30 | 450 TL | 1.050 TL |
| Mağaza %15 | 225 TL | 1.275 TL |
| iyzico/PayTR ~%2,5 | 38 TL | **1.462 TL** |

**412 TL fark. 100 satışta 41 bin TL.** Bu teknik detay değil, iş modelinin kendisi.

## 13.3 Kural: seçemezsin, kategoriye bağlı

- **Uygulama içinde tüketilen dijital içerik** satıyorsan → mağaza kasası zorunlu.
  Kaçmaya çalışırsan uygulama mağazadan atılır.
- **Fiziksel ürün veya gerçek dünya hizmeti** satıyorsan → mağaza kasası kullanılamaz,
  kendi altyapın gerekir.

2025'te Apple ABD mağazasında kuralları gevşetti; uygulama içinden dış ödeme
bağlantısı verilebiliyor, komisyonsuz. **Ancak bu şimdilik yalnızca ABD mağazası
için.** Türkiye'de eski kural geçerli.

## 13.4 Can alıcı nokta — teslim biçimi komisyonu belirliyor ⚠️

**"Yeşim Hanım'dan kişisel yorum" hangi kategoriye giriyor?** Teslim biçimine bağlı:

| Teslim biçimi | Kategori | Kesinti |
|---|---|---|
| Yazılı rapor / ses kaydı / video (uygulamada teslim) | Dijital içerik | %15–30 |
| **Canlı, birebir görüşme** (planlanmış seans) | Gerçek zamanlı hizmet | ~%2,5 |

Yani "yorum sesli mi, yazılı mı, video mu, canlı görüşme mi?" sorusu bir tasarım
sorusu değil — **gelirin %30'unu belirleyen bir sorudur.**

**Uyarı:** Mağaza kuralları sık değişir ve yorum gerektirir. Karar vermeden önce
güncel kurallar mutlaka kontrol edilmeli.

## 13.5 Türkiye'ye özel iki etken

**Taksit.** Türkiye'de taksitli alışveriş alışkanlığı yaygındır. 1.500 TL'lik bir
yorumu 3 taksitle satmak dönüşümü ciddi artırır. **Mağaza kasasında taksit yok,
kendi altyapında var.**

**Para akışı.** Mağazalar ödemeyi aylık dönemlerle ve gecikmeli aktarır.
Yerel ödeme kuruluşları çok daha hızlı öder.

## 13.6 Üçüncü yol: web'den satış

Netflix ve Spotify'ın yaptığı. Satın alma uygulamanın dışında, kendi web sitende
gerçekleşir. Kullanıcı siteden alır, uygulamaya girer, içeriği görür. Komisyon yok.

**Ama** Türkiye mağazasında uygulama içinde "sitemizden ucuza alın" denemez,
bağlantı verilemez, ima bile edilemez.

Bu yüzden web satışı ancak **dışarıdan gelen bir kitle varsa** işe yarar.
⚠️ Yeşim Hanım'ın Instagram/sosyal medya kitlesinin büyüklüğü bilinmiyor — öğrenilmeli.

## 13.7 Önerilen karma model 🅿️

- **Küçük, hızlı satın almalar** → mağaza kasası (kolaylık komisyona değer)
- **Yeşim Hanım'ın kişisel yorumu** → mümkünse gerçek hizmet olarak kurgula,
  kendi altyapını kullan
- **Instagram'dan gelen kitle** → doğrudan web sitesinden satış

**Abonelik yerine tek seferlik satın alma** kararı burada da işe yarar:
aboneliklerde mağaza her ay komisyon alır, sonsuza kadar. Tek seferlik satışta
bir kere alır. Ayrıca pazardaki asıl acı olan "aboneliğim kesiliyor, iptal edemiyorum"
sorununu doğrudan çözer ve reklamı kendiliğinden olur:
*"abonelik yok, sadece istediğinde satın al."*

**Fiyat çıpaları:**
- MS Astro: ₺169,99/ay — Meditopia'dan bile pahalı
- Meditopia: yıllık ~₺900 liste, kampanyada ₺99,99'a kadar

## 13.8 Ölçek sorunu ⚠️

10.000 premium kullanıcı olsa Yeşim Hanım tek başına yetişemez.
İki seçenek: sınırlı kontenjan (ayda N kişi, sıraya gir) veya ekip modeli
(onun eğittiği astrologlar).

Şimdi karar verilmese de **veri modeli buna hazır kurulmalı.**

---

# 14. AÇIK KARARLAR VE PARK LİSTESİ

## 14.1 PoC'yi engellemeyen açık konular ⚠️

### Kapanmış olanlar ✅

| Konu | Nasıl çözüldü |
|---|---|
| Rehber takviminin görünümü | Tek takvim, ayrı sayfa, iki kapı (bkz. 5.5) |
| Astroloji'de "bugün" jargonu | 6.9c düzenine çevrildi |
| Fotoğrafın tasarım diliyle uyumu | Çerçevesiz blok + karışık akış (bkz. 5.2) |
| Sabah temasının vurgu rengi | `#A5522C` sıcak bakır |
| Font seçimi | EB Garamond + DM Sans (bkz. 6.7) |
| Yazıların silik durması | `--soluk` 7:1'e çıkarıldı (bkz. 6.9a) |
| Ekranların renksizliği | Faaliyet renkleri tüm ekranlara yayıldı (bkz. 6.9b) |
| Sinastri'nin yeri ve biçimi | Ben sekmesi, elle giriş, yüzde yok (bkz. 5.7) |
| Yolculuk'un düzeni | Yatay raf reddedildi, dikey yol (bkz. 5.4) |

### Hâlâ açık

| Konu | Durum |
|---|---|
| **Rehber'in listesi ile faaliyet motoru çelişiyor** | Rehber'in "yap / yapma" listesi elle yazılı, faaliyet motoru hesaplıyor; aynı gün için farklı şey söyleyebiliyorlar. **Tek kaynak olmalı** — liste motordan üretilecek |
| Doğum saatini bilmeyen kullanıcı | Şimdilik zorunlu; giriş akışı çizilince tekrar konuşulacak |
| Alt menünün ikonsuz olması | PoC'de kullanılabilirlik açısından test edilecek |
| Premium teklif ekranı | "yorumumu iste" hâlâ bir yere gitmiyor — sıradaki iş |
| Yolculuk'ta kapak görseli | Denenebilir, "diğer yolculuklar" satırlarında |
| Gerçek fotoğrafın çizgiyle sınavı | Yeşim Hanım'ın çekimi gelince |
| Yıllık harita (solar return) | Önerildi, karar bekliyor |
| **Supabase'in yurt dışı olması — KVKK** | **Avukata sorulacak. Projenin en gerçek riski. Bölge: Frankfurt** |
| Video servisi seçimi | Uyarlanabilir yayın yapan ayrı bir servis gerekiyor |
| Önbellek çözümü | Supabase içinde mi, ayrı mı |
| **İçeriği yapay zekânın üretmesi** | **Yeşim Hanım’la yüz yüze konuşulacak** — çerçeve 14.2’de |

## 14.2 Park listesi 🅿️

- **İçeriği yapay zekânın üretmesi** 🅿️ *(Yeşim Hanım'la yüz yüze konuşulacak)*
  Ortaya atılan model: çin astrolojisi, numeroloji ve günlük yorumları **yapay
  zekâ üretir**, Yeşim Hanım yalnızca ücretli birebir okumaları yapar.
  Konuşulan teknik çerçeve:
  - **Yapay zekâ çalışma anında çağrılmaz.** Her açılışta API çağrısı = gecikme
    ("şak diye açılsın" şartını çiğner), kullanıcı başına maliyet, çevrimdışı
    çalışmama ve **kimse okumadan yayına girme** riski.
  - **Kombinasyonlar sonlu:** çin 12×5 = 60 metin (ömür boyu sabit), numeroloji
    ~12, günlük yorum 12 ay burcu × 8 evre × 12 ev ≈ 1152. Toplam birkaç bin.
  - Hepsi **bir kere üretilir, okunur, veritabanına yazılır.** Uygulama çalışırken
    yaptığı iş tablodan satır çekmek: anında, bedava, çevrimdışı.
  - Gerekenler: **üslup kılavuzu** (Yeşim Hanım'ın kendi yazdığı 20–30 örnek
    metin referans alınarak) ve **güvenlik filtresi** (sağlık iddiası, ilaç,
    yatırım tavsiyesi, hamilelik, ölüm, ayrılık kehaneti yasak).
  - Yeşim Hanım herhangi bir metni admin panelinden düzeltebilmeli — **zorunlu
    adım değil, isteğe bağlı iyileştirme.** Böylece "her gün onun onayını bekleme"
    bağımlılığı doğmuyor.
  - Sonuç: **ücretsiz taraf otomatik ve ölçeklenir, ücretli taraf insan ve
    ölçeklenmez.** Yeşim Hanım'ın zamanı para kazandıran yere gidiyor.

- **Yeşim Hanım'ın kişisel yorumunun teslim biçimi** — sesli / yazılı / video /
  canlı görüşme *(komisyonu belirlediği için önemli)*
- **Premium satış modeli** — tek seferlik / abonelik / ikisi birden
- **Komisyon stratejisi** — mağaza kasası / kendi altyapı / web satışı karması
- **Yeşim Hanım'ın mevcut sosyal medya kitlesi** — web satışı buna bağlı
- **Ölçek planı** — kontenjan mı, ekip mi
- **"Bunu ne zaman yapmalıyım?" araması** — faaliyet seçip önümüzdeki en uygun
  günleri listeleme. İhtiyaç anında uygulamayı açtıran özellik
- **Bildirimler** — "bugünün enerjisi hazır", gün batımı bildirimi
- **Dil** — sadece Türkçe mi, ileride İngilizce de var mı
- **Gezegen konumları** — gerçek hesaplama (Swiss Ephemeris) ne zaman devreye girecek
- **Seri/streak mekaniği** — Yolculuk'ta alışkanlık kazandırma
- **Moderasyon** — şikayet, engelleme, içerik denetimi
- **Tarot** — konumlanmayı sulandırma riski nedeniyle ertelendi
- **Ruh ikizi** — sinastri zaten gerçek uyumu veriyor
- **Helyosentrik harita**
- **Daha güçlü tema geçişi** (meteor vb.)

## 14.3 Henüz hiç konuşulmamış konular ⚠️

Aşağıdakiler projede **gerekli** ama üzerinde hiç konuşulmadı. Belgede kayıt altına
alınıyor ki unutulmasın.

### Öncelikli üç tanesi

**1. Yasal metinler ve sorumluluk reddi** — *en acil*

Gerekenler: kullanım şartları, gizlilik politikası, çerez/veri aydınlatma metni ve
özellikle bir **sorumluluk reddi**.

Uygulama insanlara "bugün ameliyat olma", "bu kararı alma", "bugün imza atma" diyor.
Ayrıca meditasyon içerikleri kaygı ve uykuya değiyor. Bunun **tıbbi veya psikolojik
tavsiye olmadığının** açıkça yazılması gerekir. Uygulama mağazaları da bunu arar.

**2. Müşteri desteği**

Ayrışma noktalarımızdan biri *"destek gerçekten cevap veriyor"* — ama nasıl
yapılacağı konuşulmadı.

Kararlaştırılacaklar: kim cevaplayacak · hangi kanaldan (uygulama içi, e-posta,
WhatsApp, Instagram) · ne kadar sürede · tek kişilik ekipte bu yük nasıl taşınacak.

**3. Yeşim Hanım'a bağımlılık riski** — *ürünün en büyük yapısal riski*

Uygulamanın tüm değeri tek bir insana bağlı. Hastalanırsa, ara vermek isterse,
yollar ayrılırsa ne olur?

Kararlaştırılacaklar: aradaki iş ilişkisinin yapısı (ortaklık, sözleşme, telif) ·
içeriklerin kime ait olduğu · markanın kime ait olduğu · o olmadan uygulamanın
ayakta kalıp kalamayacağı (bkz. 13.8 Ölçek sorunu — ekip modeli bu riski de azaltır).

### Diğerleri

**4. Fiyat** — Yeşim Hanım'ın kişisel yorumunun fiyatı belirlenmedi.
Rakip çıpaları: MS Astro ₺169,99/ay · Meditopia yıllık ~₺900 liste.

**5. Ölçüm ve analitik** — Hangi sayılara bakılacak?
Ertesi gün geri dönüş oranı (D1) · 7 günlük tutunma (D7) · ücretli dönüşüm oranı ·
hangi ekranda kullanıcıların bıraktığı · onboarding tamamlama oranı
(özellikle doğum saati ekranı — %40 riski burada ölçülecek).
Ölçülmeyen şey iyileştirilemez.

**6. Marka** — "MediAstro" kesin isim mi? Logo, uygulama simgesi, mağaza görselleri,
mağaza açıklaması ve mağaza optimizasyonu (ASO) konuşulmadı.

**7. İçerik üslubu** — "Yeşim Hanım'ın sesi" nasıl bir ses?
Samimi mi, mesafeli mi, senli benli mi, siz mi? Yorum şablonlarını kim yazacak —
o mu, proje sahibi mi, yapay zekâ destekli mi? Bir **üslup kılavuzu** gerekir,
yoksa yüzlerce metin birbirini tutmaz.

**8. Bütçe ve takvim** — Video prodüksiyonu, tasarım, hukuk, güvenlik testi,
sunucu ve video servisi maliyetleri, mağaza geliştirici hesapları.
Süre tahmini yok.

**9. Renk değerlerinin kendisi** — Belgede paletler tarifle yazılı
("sıcak kum ve şeftali") ama kesin renk kodları yok.
Prototip yapılınca oradan alınıp belgeye işlenecek.

**10. Yedekleme ve felaket kurtarma** — Yedek sıklığı, nerede durduğu,
geri yükleme denemesinin yapılıp yapılmadığı.

**11. Test stratejisi** — Neyin otomatik test edileceği, neyin elle.
Özellikle astroloji hesaplarının doğruluğu (bilinen haritalarla karşılaştırma).

## 14.4 Yeşim Hanım'a sorulacaklar

- MS Astro hakkındaki görüşü — rakip olarak nasıl görüyor
- Kendi görsel dünyası — Instagram'ı, kullandığı renkler, paylaşım tarzı
  (uygulamanın ona benzemesi en doğrusu, çünkü satılan şey o)
- Ruzname fikri ona ne hissettiriyor
- Meditasyon içerikleri hazır mı, yoksa yeni mi çekilecek
  *(gökyüzüne bağlı meditasyon fikri ancak içerikler o mantıkla üretilirse çalışır)*
- Yaptığı ama belgede olmayan yorum türleri var mı
- Kişisel yorumu hangi biçimde vermek istiyor, ne kadar sürede
- Uygulamadan beklentisi ne

---

# 15. TASARIM ELEŞTİRİ DİLİ

Tasarımı değerlendirirken en işe yarayan tek soru:

> **"Bu ekranda en önemli şey ne? Bakınca onu görüyor muyum?"**

Cevap "hayır"sa tasarım kötüdür, ne kadar güzel olursa olsun.

Kullanılabilecek diğer geri bildirimler:
- "Bu boşluk fazla / az"
- "Başlık daha büyük olsun"
- "Burası hâlâ kart gibi duruyor"
- "Bu renk fazla çıkıyor"
- "Geçiş yavaş / hızlı"

---

# 16. ÇALIŞMA BİÇİMİ

- **Önce konuşulur, sonra yapılır.** Kod yazmaya geçmeden önce açıkça
  "başla" denmesi beklenir.
- **Tek ekranla başlanır.** Beğenilmezse tek ekran çöpe gider, 24 ekran değil.
  İkinci denemede çok daha yaklaşılır — "hayır"lar tariften fazlasını öğretir.
- **Tasarım konuşularak bitmez, bir yerde bakmak gerekir.**

---

## Ek: Kaynaklar

**Rekabet:**
- Ms Astro — App Store: https://apps.apple.com/tr/app/ms-astro-astroloji/id1660027550
- Ms Astro — Google Play: https://play.google.com/store/apps/details?id=co.msastro.app
- Ms.Astro Şikayetvar: https://www.sikayetvar.com/msastro
- Meditopia — App Store: https://apps.apple.com/tr/app/meditopia-meditasyon-uyku/id1190294015
- Ekşi Sözlük "ms astro": https://eksisozluk.com/ms-astro--7626863

**Tasarım referansları:**
- Co-Star tasarım incelemesi: https://ixd.prattsi.org/2022/02/design-critique-co-star-iphone-app-2/
- CHANI vaka çalışması: https://medium.com/@info_45537/tl-dr-14868841ed2c

**Ruzname:**
- RÛZNÂME — TDV İslâm Ansiklopedisi: https://islamansiklopedisi.org.tr/ruzname
- Bonhams ruzname örnekleri: https://www.bonhams.com/auction/29724/lot/30/
- Sotheby's Shakerine Koleksiyonu ruzname
- Osmanlı Takvimleri: https://osmanlitakvimleri.com/

---

*Belge sonu. Değişiklikler bu dosyaya işlenmeli; kararlar başka yerde tutulmamalı.*
