<?php
/**
 * TÜM METİNLER BURADA.
 *
 * Ekran dosyalarının içine hiç metin yazılmaz. "Şu cümle şöyle olsun"
 * dendiğinde burada tek satır değişir, hiçbir tasarıma dokunulmaz.
 *
 * İLKE: Kullanıcı astroloji bilmiyor. Her teknik terimin yanında,
 * gizlenmeden, düz Türkçe bir karşılığı durur. 'gokbilim' alanları
 * işin gerçek astronomi tarafını anlatır — kimsenin yapmadığı şey bu.
 *
 * Bu metinler prototip için uydurulmuştur — gerçek içerik Yeşim Hanım'dan gelecek.
 */

return [

    'kullanici' => [
        'ad'       => 'Elif',
        'gunes'    => 'Başak',
        'ay'       => 'Yay',
        'yukselen' => 'İkizler',
    ],

    // Dönem uyarısı. Bir kez 6.9c düzenine (etiket + eylem + dipnot)
    // çevrildi, ekranda ağır durdu ve geri alındı: tek satırlık bir uyarı
    // üç kademeli başlık düzenini kaldırmıyor.
    // 🅿️ İleride bu bölüm tamamen kaldırılabilir — aynı bilgi Rehber'de
    //    "Sözleşme imzalama" maddesinde zaten duruyor.
    'retro' => [
        'etkin'   => true,
        'gezegen' => 'Merkür',
        'metin'   => 'Merkür 14 Eylül’e kadar geri hareketinde.',
        'oneri'   => 'Sözleşme ve imza işlerini mümkünse erteleyin.',
    ],

    // Önce ne, sonra neden. Astroloji terimi başlıkta değil, dipnotta.
    //
    // Bir kez açılır panel + çizelge düzenine çevrildi (dayanak, evre ve
    // etkilenen alanlar içeri alınmıştı), sonra geri alındı.
    'bugun' => [
        'baslik'  => 'Sözlerin bugün daha az yaralıyor.',
        'ozet'    => 'Uzun süredir ertelediğin o konuşmayı bugün açabilirsin.',
        'dayanak' => 'ay bu akşam yay’a geçiyor',
        'detay'  => 'Ay’ın Akrep’ten Yay’a geçişi, günlerdir üzerine kapandığın bir '
                  . 'meselenin basıncını düşürür. Akrep derinleştirir ama söyletmez; '
                  . 'Yay konuşturur. Bugün ağzından çıkan cümleler dün çıkacak '
                  . 'olanlardan daha affedici olacak.',
    ],

    // 'aci' = çarkta durduğu derece. Gerçek uygulamada efemeristen gelecek.
    'gokyuzu' => [
        ['im' => '☉', 'ad' => 'güneş',  'burc' => 'Başak',  'ev' => '6', 'aci' => 202],
        ['im' => '☽', 'ad' => 'ay',     'burc' => 'Yay',    'ev' => '10', 'aci' => 66],
        ['im' => '☿', 'ad' => 'merkür', 'burc' => 'Başak',  'ev' => '6', 'aci' => 214, 'not' => 'geri'],
        ['im' => '♀', 'ad' => 'venüs',  'burc' => 'Terazi', 'ev' => '7', 'aci' => 286],
        ['im' => '♂', 'ad' => 'mars',   'burc' => 'Akrep',  'ev' => '8', 'aci' => 128],
        ['im' => '♃', 'ad' => 'jüpiter','burc' => 'İkizler','ev' => '3', 'aci' => 340],
        ['im' => '♄', 'ad' => 'satürn', 'burc' => 'Balık',  'ev' => '12', 'aci' => 22],
    ],

    // [derece, derece, tip] — tip: akici (üçgen/altmışlık) | gergin (kare/karşıt)
    'acilar' => [
        [202, 66,  'akici'],    // güneş – ay
        [202, 22,  'gergin'],   // güneş – satürn, karşıt
        [66,  286, 'akici'],    // ay – venüs
        [128, 286, 'gergin'],   // mars – venüs, kare
    ],

    'cin' => [
        'hayvan'  => 'Ateş Tavşanı',
        'ozet'    => 'Sakin görünen ama içeride hızlı düşünen bir yapı.',
        'detay'   => 'Tavşan, Çin astrolojisinde ihtiyat ve zarafetin işaretidir. '
                   . 'Ateş unsuru buna aceleci bir kıvılcım katar. Bu ikisi çoğu zaman '
                   . 'çekişir: içinden gelen atılganlığı nezaketle bastırırsın, sonra da '
                   . 'neden kimsenin seni ciddiye almadığını sorarsın.',
    ],

    'numeroloji' => [
        'baslik'  => 'Yaşam yolu 7',
        'ozet'    => 'Anlamadığın hiçbir şeye teslim olmuyorsun.',
        'detay'   => 'Yedi sayısı, cevabı hazır alanların değil, soruyu sevenlerin '
                   . 'sayısıdır. Kalabalıkta yorulur, yalnızlıkta toparlanırsın. '
                   . 'Bu bir kusur değil, çalışma biçimin.',
    ],

    // ---------------------------------------------------------------
    // REHBER — tek takvim, üstünde o günün her şeyi.
    // Motor: Ay'ın burcu + ay evresi. Gerçek uygulamada kural tablosundan üretilecek.
    // ---------------------------------------------------------------
    'rehber' => [
        // ⚠️ AÇIK İŞ: buradaki 'yap' ve 'yapma' listeleri ELLE yazılmış,
        // ama artık gerçek bir kural motoru var (parca/faaliyet.php).
        // İkisi çelişiyor: Rehber bugün "Yola çık" derken motor aynı gün
        // için "farketmez" diyor. Tek kaynak olmalı — bu listeler de
        // faaliyet motorundan üretilmeli, maddelerin açıklama notları
        // faaliyet tanımına taşınmalı.
        //
        // Önce ne olduğu, sonra nedeni. Jargon başlıkta değil, altta durur.
        'baslik'    => 'Konuşmanın ve yola çıkmanın günü',
        'ozet'      => 'Başlatmaya değil, bitirmeye elverişli.',
        'dayanak'   => 'Ay Yay’da · küçülen ay',

        'yap' => [
            ['kume' => 'beden', 'baslik' => 'Saç kestir',
             'not'  => 'Küçülen ayda kesilen saç daha geç uzar.'],
            ['kume' => 'yol',   'baslik' => 'Yola çık',
             'not'  => 'Uzak mesafe ve yer değiştirme bugün akıyor.'],
            ['kume' => 'iliski','baslik' => 'Zor konuşmayı yap',
             'not'  => 'Sözler bugün daha az yaralıyor.'],
        ],

        'yapma' => [
            ['kume' => 'para',  'baslik' => 'Sözleşme imzalama',
             'not'  => 'Merkür geri hareketinde, ayrıntı gözden kaçıyor.'],
            ['kume' => 'para',  'baslik' => 'Pahalı alışveriş yapma',
             'not'  => 'Yay iyimserliği bütçeyi şişiriyor.'],
        ],

        'detay' => [
            ['ad' => 'şanslı renk',      'deger' => 'Lacivert', 'renk' => '#2C3E6B'],
            ['ad' => 'şanslı sayı',      'deger' => '3'],
            ['ad' => 'kaçınılacak saat', 'deger' => '14.00 – 16.30'],
        ],

        // Faaliyet kümeleri — takvimdeki renk kodunun karşılığı
        'kumeler' => [
            'beden' => 'beden & bakım',
            'para'  => 'para & iş',
            'iliski'=> 'ilişkiler',
            'yol'   => 'yolculuk',
            'ic'    => 'iç dünya',
        ],

        // "Tümünü gör" altında açılan çizelge
        'tumu' => [
            'beden' => [
                ['ad' => 'saç kesimi',      'durum' => 'uygun'],
                ['ad' => 'tırnak kesimi',   'durum' => 'uygun'],
                ['ad' => 'saç boyama',      'durum' => 'ertele'],
                ['ad' => 'diş tedavisi',    'durum' => 'uygun'],
                ['ad' => 'diyete başlama',  'durum' => 'farketmez'],
            ],
            'para' => [
                ['ad' => 'imza, sözleşme',  'durum' => 'ertele'],
                ['ad' => 'iş görüşmesi',    'durum' => 'uygun'],
                ['ad' => 'büyük alışveriş', 'durum' => 'ertele'],
                ['ad' => 'borç kapatma',    'durum' => 'uygun'],
            ],
            'iliski' => [
                ['ad' => 'zor konuşma',     'durum' => 'uygun'],
                ['ad' => 'barışma',         'durum' => 'uygun'],
                ['ad' => 'tanışma',         'durum' => 'farketmez'],
            ],
            'yol' => [
                ['ad' => 'uzun yol',        'durum' => 'uygun'],
                ['ad' => 'taşınma',         'durum' => 'ertele'],
                ['ad' => 'doğa yürüyüşü',   'durum' => 'uygun'],
            ],
            'ic' => [
                ['ad' => 'karar alma',      'durum' => 'ertele'],
                ['ad' => 'arınma, temizlik','durum' => 'uygun'],
                ['ad' => 'yeni başlangıç',  'durum' => 'ertele'],
            ],
        ],
    ],

    // ---------------------------------------------------------------
    // FAALİYET LİSTESİ — "bunu ne zaman yapmalıyım?"
    //
    // 22 faaliyet. 50 tane koyup yarısına "farketmez" demektense
    // 22'sini savunabilmek daha iyi. Yeşim Hanım zamanla ekleyecek —
    // liste sabit değil, gerçek uygulamada veritabanından gelecek.
    //
    // 'yon'     : buyuk = büyüyen ayı sever (başlatmak, büyütmek)
    //             kucuk = küçülen ayı sever (kesmek, bitirmek, arındırmak)
    // 'element' : ayın burcu bu elementteyken destekleniyor
    // 'retro'   : Merkür geri hareketinden olumsuz etkilenir
    //
    // ⚠️ Ameliyat, diş tedavisi, ilaç, yatırım, hamilelik LİSTEDE YOK.
    //    Gerekçesi parca/faaliyet.php başında yazıyor.
    //
    // 🅿️ "nişan ve düğün" bilerek çıkarıldı: en çok sorulan şeylerden
    //    biri ama insanlar düğün tarihini buna göre seçerse iş ciddileşiyor.
    // ---------------------------------------------------------------
    'faaliyetler' => [
        'beden' => [
            ['ad' => 'saç kestirme',   'yon' => 'kucuk', 'element' => ['toprak', 'su']],
            ['ad' => 'saç boyama',     'yon' => 'buyuk', 'element' => ['ates', 'hava']],
            ['ad' => 'tırnak kesme',   'yon' => 'kucuk', 'element' => ['toprak']],
            ['ad' => 'epilasyon',      'yon' => 'kucuk', 'element' => ['toprak', 'su']],
            ['ad' => 'diyete başlama', 'yon' => 'kucuk', 'element' => ['toprak']],
            ['ad' => 'spora başlama',  'yon' => 'buyuk', 'element' => ['ates']],
        ],
        'para' => [
            ['ad' => 'imza ve sözleşme', 'yon' => 'buyuk', 'element' => ['toprak'], 'retro' => true],
            ['ad' => 'iş görüşmesi',     'yon' => 'buyuk', 'element' => ['hava', 'ates']],
            ['ad' => 'büyük alışveriş',  'yon' => 'buyuk', 'element' => ['toprak'], 'retro' => true],
            ['ad' => 'borç kapatma',     'yon' => 'kucuk', 'element' => ['toprak']],
            ['ad' => 'zam isteme',       'yon' => 'buyuk', 'element' => ['ates', 'hava']],
            ['ad' => 'yeni işe başlama', 'yon' => 'buyuk', 'element' => ['ates', 'toprak']],
        ],
        'iliski' => [
            ['ad' => 'zor konuşma',     'yon' => 'notr',  'element' => ['ates', 'hava']],
            ['ad' => 'barışma',         'yon' => 'buyuk', 'element' => ['su', 'hava']],
            ['ad' => 'ilk buluşma',     'yon' => 'buyuk', 'element' => ['hava', 'ates']],
            ['ad' => 'aileyle görüşme', 'yon' => 'notr',  'element' => ['su', 'toprak']],
        ],
        'yol' => [
            ['ad' => 'uzun yol',   'yon' => 'notr',  'element' => ['ates', 'hava']],
            ['ad' => 'taşınma',    'yon' => 'buyuk', 'element' => ['toprak', 'su'], 'retro' => true],
            ['ad' => 'ev bakma',   'yon' => 'buyuk', 'element' => ['toprak']],
            ['ad' => 'araç alma',  'yon' => 'buyuk', 'element' => ['toprak', 'hava'], 'retro' => true],
        ],
        'ic' => [
            ['ad' => 'karar alma',            'yon' => 'notr',  'element' => ['toprak', 'hava'], 'retro' => true],
            ['ad' => 'arınma ve temizlik',    'yon' => 'kucuk', 'element' => ['su', 'toprak']],
            ['ad' => 'yeni başlangıç',        'yon' => 'buyuk', 'element' => ['ates']],
            ['ad' => 'eski defterleri kapatma','yon' => 'kucuk', 'element' => ['su']],
        ],
    ],

    // ---------------------------------------------------------------
    // YOLCULUK — Yeşim Hanım'ın eğitim kütüphanesi.
    //
    // KARAR: Yatay raf (Netflix düzeni) kullanılmıyor. Raf, kataloğu olan
    // ürünün çözümüdür; burada kullanıcı "ne izlesem" değil "nerede
    // kaldım" sorusuyla geliyor. Ekran bir katalog değil, bir yol.
    // Ayrıca yatay raf jenerik — kaçınmak istediğimiz tam olarak o.
    //
    // İlerleme hissi rozetten ya da seriden değil, yolun kendisinden
    // doğuyor: geçtiğin duraklar dolu, bulunduğun durak halka, önündeki
    // duraklar boş.
    // ---------------------------------------------------------------
    'yolculuk' => [
        'suren' => [
            'seri'   => 'Sabahın ilk yarım saati',
            'bolum'  => 3,
            'baslik' => 'Nefesin kendi ritmi',
            'sure'   => '11 dk',
            'buton'  => 'devam et',
        ],

        // Yolculuk'u uygulamanın geri kalanına bağlayan satır.
        // Gerçek uygulamada Rehber'in o günkü kümesinden seçilecek:
        // gün "konuşma ve yola çıkma" günüyse acele/karar bölümleri öne gelir.
        // Astroloji ve Rehber'le aynı düzen — önce ne, sonra neden.
        'bugune' => [
            'ad'      => 'Aceleyi fark etmek',
            'kume'    => 'ic',
            'sure'    => '13 dk',
            'ozet'    => 'Bugün karar acelesi gelirse buraya dön.',
            'dayanak' => 'ay yay’da · merkür geri',
        ],

        // durum: bitti | simdi | onde
        'duraklar' => [
            ['no' => 1, 'ad' => 'Uyanmak ile kalkmak arasında', 'sure' => '8 dk',  'durum' => 'bitti',
             'detay' => 'Gözünü açtığın an ile ayağa kalktığın an aynı an değil. '
                      . 'Aradaki o birkaç dakikayı kaybetmemek üzerine.'],
            ['no' => 2, 'ad' => 'Telefonsuz ilk on dakika',     'sure' => '10 dk', 'durum' => 'bitti',
             'detay' => 'Güne başkasının gündemiyle başlamamak. '
                      . 'En zoru ilk üç gün, sonrası kendiliğinden geliyor.'],
            ['no' => 3, 'ad' => 'Nefesin kendi ritmi',          'sure' => '11 dk', 'durum' => 'simdi',
             'detay' => 'Nefesi düzeltmeye çalışmıyoruz. Yalnızca hâlihazırda '
                      . 'nasıl aldığını fark ediyoruz — çoğu insan bunu hiç yapmamıştır.'],
            ['no' => 4, 'ad' => 'Gün başlamadan bir karar',     'sure' => '9 dk',  'durum' => 'onde',
             'detay' => 'Sabah verilen tek bir küçük karar, gün içindeki '
                      . 'onlarca kararın yükünü hafifletir.'],
            ['no' => 5, 'ad' => 'Aceleyi fark etmek',           'sure' => '13 dk', 'durum' => 'onde',
             'detay' => 'Acele bir duygu değil, bir alışkanlık. '
                      . 'Nereden başladığını bulmadan bırakılmıyor.'],
            ['no' => 6, 'ad' => 'Sabahı geri kazanmak',         'sure' => '15 dk', 'durum' => 'onde',
             'detay' => 'Serinin toparlanması. Beş bölümün hepsi tek bir '
                      . 'yarım saatlik düzene oturuyor.'],
        ],

        'diger' => [
            ['ad' => 'Ay evrelerine göre gevşeme', 'bolum' => 8, 'biten' => 0,
             'ozet' => 'Dolunayda uyuyamayanlar için.',
             'bolumler' => [
                 ['ad' => 'Yeni ay: boş sayfa',      'sure' => '9 dk'],
                 ['ad' => 'Büyüyen ay: hız',         'sure' => '11 dk'],
                 ['ad' => 'Dolunay: uykusuz geceler','sure' => '16 dk'],
             ]],
            ['ad' => 'Kendi haritanı okumak',      'bolum' => 12, 'biten' => 5,
             'ozet' => 'Sıfırdan, terim ezberlemeden.',
             'bolumler' => [
                 ['ad' => 'Harita neyi gösterir',    'sure' => '12 dk'],
                 ['ad' => 'Güneş, ay, yükselen',     'sure' => '18 dk'],
                 ['ad' => 'Evler ne anlatır',        'sure' => '15 dk'],
             ]],
            ['ad' => 'Akşam kapanışı',             'bolum' => 6,  'biten' => 6,
             'ozet' => 'Günü içeride bırakmamak üzerine.',
             'bolumler' => [
                 ['ad' => 'Günü bitirmek',           'sure' => '10 dk'],
                 ['ad' => 'Yarına devretmemek',      'sure' => '12 dk'],
                 ['ad' => 'Uykudan önceki saat',     'sure' => '14 dk'],
             ]],
            ['ad' => 'Kaygıyla oturmak',           'bolum' => 9,  'biten' => 0,
             'ozet' => 'Bastırmadan, kovmadan.',
             'bolumler' => [
                 ['ad' => 'Kaygı nerede duruyor',    'sure' => '8 dk'],
                 ['ad' => 'Kaçmadan beklemek',       'sure' => '13 dk'],
                 ['ad' => 'Geçtiğini fark etmek',    'sure' => '11 dk'],
             ]],
        ],

        'tekli' => [
            ['ad' => 'Uykuya geçiş',        'sure' => '18 dk'],
            ['ad' => 'Panik anında nefes',  'sure' => '5 dk'],
            ['ad' => 'Öğle molası',         'sure' => '7 dk'],
            ['ad' => 'Yeni ay niyeti',      'sure' => '14 dk'],
        ],
    ],

    // ---------------------------------------------------------------
    // KEŞFET — açılış ekranı, sosyal akış.
    //
    // KURALLAR:
    // 1) Fotoğraf çerçevesiz. Kart, gölge, yuvarlak köşe yok; görsel
    //    ekranın iki kenarına dayanıyor. Denendi: her çerçeve girişimi
    //    çizgiyi ucuzlattı (belge 6.9d).
    // 2) Akış tek düze fotoğraf duvarı değil — arada yazı ve alıntı
    //    gönderileri var. Bu ritim ekranı Instagram klonu olmaktan çıkarıyor.
    // 3) Punto küçük. Diğer ekranlarda serif iri kullanılıyor çünkü orada
    //    tek bir cümle var; akışta yedi gönderi alt alta, iri punto
    //    bağırıyor. Burada tipografi geri çekiliyor, fotoğraf konuşuyor.
    // 4) Her gönderi Rehber'in faaliyet kümelerinden birinin rengini
    //    taşıyor — akışı taranabilir yapıyor ve Keşfet'i uygulamanın
    //    geri kalanına bağlıyor.
    //
    // 'tip': gorsel | yazi | alinti     'oran': fotoğrafın en/boy oranı
    // 'konu': prototipte fotoğrafın yerini tutan tanım — gerçekte kalkacak.
    // ---------------------------------------------------------------
    'kesfet' => [
        'suzgec' => ['hepsi', 'yeşim’den', 'takip'],

        // 'yeni' = henüz izlenmemiş; halka bakır olur.
        // 'kareler' = hikâyenin sayfaları. Hepsi fotoğraf değil: yazı
        // kareleri de var, akıştaki gibi burada da ritmi onlar kuruyor.
        'hikayeler' => [
            ['ad' => 'sen', 'sen' => true],

            ['ad' => 'Yeşim', 'imzali' => true, 'yeni' => true, 'zaman' => '2 sa', 'kume' => 'beden',
             'kareler' => [
                 ['tip' => 'yazi', 'metin' => 'Bugün Ay Yay’a geçiyor. '
                                            . 'Konuşulacak neyiniz varsa bugün konuşun.'],
                 ['tip' => 'gorsel', 'konu' => 'sabah ışığında çalışma masası',
                  'metin' => 'Bu hafta üç canlı yayın var.'],
                 ['tip' => 'yazi', 'metin' => 'Soru sormak isteyenler '
                                            . 'kutuya yazsın, akşam cevaplıyorum.'],
             ]],

            ['ad' => 'Selin', 'yeni' => true, 'zaman' => '5 sa', 'kume' => 'iliski',
             'kareler' => [
                 ['tip' => 'gorsel', 'konu' => 'kafede iki fincan',
                  'metin' => 'Sonunda konuştuk.'],
                 ['tip' => 'gorsel', 'konu' => 'akşamüstü balkon',
                  'metin' => 'İyi ki de konuşmuşum.'],
             ]],

            ['ad' => 'Kerem', 'yeni' => true, 'zaman' => '9 sa', 'kume' => 'yol',
             'kareler' => [
                 ['tip' => 'gorsel', 'konu' => 'sabah erken sahil yolu',
                  'metin' => 'Otobüs iki saat rötarlı ama manzara bu.'],
                 ['tip' => 'yazi', 'metin' => 'Merkür geri, dedikleri buymuş.'],
             ]],

            ['ad' => 'Deniz', 'zaman' => 'dün', 'kume' => 'ic',
             'kareler' => [
                 ['tip' => 'yazi', 'metin' => 'Dördüncü gün. Telefona hâlâ bakmadım.'],
             ]],

            ['ad' => 'Burcu', 'zaman' => 'dün', 'kume' => 'para',
             'kareler' => [
                 ['tip' => 'gorsel', 'konu' => 'masada açık sözleşme dosyası',
                  'metin' => 'İmzayı erteledim, iyi ki.'],
             ]],

            ['ad' => 'Aslı', 'zaman' => '2 gün', 'kume' => 'ic',
             'kareler' => [
                 ['tip' => 'gorsel', 'konu' => 'gece penceresinden ay',
                  'metin' => 'Dolunaya üç gün.'],
             ]],
        ],

        'akis' => [
            [
                'tip'    => 'gorsel',
                'kisi'   => 'Yeşim',
                'imzali' => true,
                'zaman'  => '2 sa',
                'kume'   => 'beden',
                'oran'   => '4 / 5',
                'konu'   => 'sabah ışığında yatak odası',
                'metin'  => 'Dolunaydan önceki üç gece en zor üçlüdür. Uyku bölünür, '
                          . 'sabaha karşı uyanırsınız. Bu hafta kendinize erken '
                          . 'kalkma sözü vermeyin.',
                'begeni' => 214, 'yorum' => 31,
            ],
            [
                'tip'    => 'yazi',
                'kisi'   => 'Deniz',
                'zaman'  => '4 sa',
                'kume'   => 'ic',
                'metin'  => 'Üç gündür rehberin dediğini yapıyorum, sabah ilk yarım '
                          . 'saat telefona bakmıyorum. Kulağa saçma geliyor ama gün '
                          . 'gerçekten uzuyor.',
                'begeni' => 46, 'yorum' => 8,
            ],
            [
                'tip'    => 'gorsel',
                'kisi'   => 'Selin',
                'zaman'  => '6 sa',
                'kume'   => 'iliski',
                'oran'   => '1 / 1',
                'konu'   => 'kafede iki fincan',
                'metin'  => 'Üç yıl sonra konuştuk. Takvimde “zor konuşma günü” '
                          . 'yazıyordu, cesaretimi oradan aldım desem yalan olmaz.',
                'begeni' => 88, 'yorum' => 12,
            ],
            [
                'tip'    => 'alinti',
                'kisi'   => 'Yeşim',
                'imzali' => true,
                'zaman'  => 'dün',
                'metin'  => 'Gökyüzü kimseye ne yapacağını söylemez. '
                          . 'Yalnızca havanın nasıl olduğunu söyler.',
                'begeni' => 512, 'yorum' => 44,
            ],
            [
                'tip'    => 'gorsel',
                'kisi'   => 'Kerem',
                'zaman'  => 'dün',
                'kume'   => 'yol',
                'oran'   => '3 / 2',
                'konu'   => 'sabah erken sahil yolu',
                'metin'  => 'Merkür geri giderken yola çıkma dediler, çıktım. '
                          . 'Otobüs iki saat rötar yaptı. Şaka bir yana, manzara buydu.',
                'begeni' => 63, 'yorum' => 19,
            ],
            [
                'tip'    => 'yazi',
                'kisi'   => 'Burcu',
                'zaman'  => '2 gün',
                'kume'   => 'para',
                'metin'  => 'İmzayı iki hafta erteledim. Bu arada sözleşmede fark '
                          . 'etmediğim bir madde çıktı. Astrolojiye inanmam ama '
                          . 'bir daha okumaya vaktim oldu.',
                'begeni' => 137, 'yorum' => 26,
            ],
            [
                'tip'    => 'gorsel',
                'kisi'   => 'Yeşim',
                'imzali' => true,
                'zaman'  => '3 gün',
                'kume'   => 'ic',
                'oran'   => '4 / 5',
                'konu'   => 'elle çizilmiş harita defteri',
                'metin'  => 'Bir haritayı okurken önce neyin eksik olduğuna bakarım. '
                          . 'Boş evler, dolu evlerden daha çok şey anlatır.',
                'begeni' => 302, 'yorum' => 57,
            ],
        ],
    ],

    // ---------------------------------------------------------------
    // BEN — künye. Ayar listesi değil, kullanıcının kaydı.
    //
    // Ruzname'nin ilk yaprağı "bu takvim kimin için hazırlandı" der.
    // Bu sayfa da onu yapıyor: üstte girilen bilgi, altında ondan
    // hesaplanan. Ayarlar en altta, tek bir sessiz satırın içinde.
    //
    // İlerlemede seri (streak) yok. Streak insanı uygulamaya bağlar,
    // kendine değil; kaçırılan gün suçluluk üretir. Yalnızca gerçek
    // ölçüm gösteriliyor.
    // ---------------------------------------------------------------
    'ben' => [
        'girilen' => [
            ['ad' => 'doğum', 'deger' => '3 Mart 1994'],
            ['ad' => 'saat',  'deger' => '04.15'],
            ['ad' => 'yer',   'deger' => 'İstanbul'],
        ],
        'hesaplanan' => [
            ['ad' => 'güneş',    'deger' => 'Başak'],
            ['ad' => 'ay',       'deger' => 'Yay'],
            ['ad' => 'yükselen', 'deger' => 'İkizler'],
        ],

        'sayaclar' => [
            ['deger' => '45',   'ad' => 'gün'],
            ['deger' => '6.20', 'ad' => 'saat'],
            ['deger' => '2',    'ad' => 'seri'],
        ],

        // Doğum bilgisi hassas veri: yalnızca bu hesapta durur,
        // kimseye görünmez, silinince gerçekten silinir (Supabase RLS).
        'kisiler' => [
            ['ad' => 'Deniz',  'alt' => '12 Mayıs 1990 · Ankara'],
            ['ad' => 'Annem',  'alt' => '8 Ekim 1966 · İzmir'],
        ],

        'satinalim' => [
            'baslik' => 'Doğum haritası okuması',
            'alt'    => '14 Temmuz · Yeşim',
        ],

        'kayitli' => [
            ['ad' => 'gönderi', 'deger' => '12'],
            ['ad' => 'bölüm',   'deger' => '7'],
            ['ad' => 'gün',     'deger' => '3'],
        ],

        'ayarlar' => [
            'bildirimler', 'doğum bilgisini düzelt', 'hesap',
            'verilerimi indir', 'hesabımı sil', 'çıkış yap',
        ],
    ],

    // ---------------------------------------------------------------
    // KİŞİ EKLEME FORMU
    //
    // Bu ekran iki yerde kullanılacak: buradaki "kişi ekle" ve giriş
    // akışındaki kendi doğum bilgin. Aynı alanlar, aynı düzen — bir kere
    // yazılıp iki yerde kullanılıyor.
    //
    // Kutulu giriş alanı yok. Kutu = kart = jenerik. Alanlar cetvel
    // çizgisi üstünde duruyor; kâğıt forma benziyor, dile uyuyor.
    //
    // Saat zorunlu: yükselen ve evler saatsiz hesaplanamaz. Bunu
    // gizlemek yerine söylüyoruz — kullanıcı neden istendiğini bilsin.
    // ---------------------------------------------------------------
    'kisi_formu' => [
        'baslik' => 'Kişi ekle',
        'ozet'   => 'Doğum saati olmadan yükselen ve evler hesaplanamıyor. '
                  . 'Bu yüzden dakikası önemli.',

        'alanlar' => [
            ['ad' => 'ad',   'etiket' => 'nasıl anılsın',
             'ipucu' => 'Deniz, annem, patronum…'],
        ],

        'tarih' => [
            'etiket' => 'doğum tarihi',
            'gun' => 'gg', 'ay' => 'aa', 'yil' => 'yyyy',
        ],
        'saat' => [
            'etiket' => 'doğum saati',
            'sa' => 'ss', 'dk' => 'dd',
        ],
        'yer' => [
            'etiket' => 'doğum yeri',
            'ipucu'  => 'şehir',
        ],

        'gizlilik' => 'Bu bilgi yalnızca senin hesabında durur. '
                    . 'Kimseye görünmez, kimseyle paylaşılmaz, sildiğinde gerçekten silinir.',

        'kaydet' => 'kaydet ve uyuma bak',
        'vazgec' => 'vazgeç',
    ],

    // ---------------------------------------------------------------
    // UYUM (sinastri) — iki haritanın üst üste bindirilmesi.
    //
    // Yüzde verilmiyor. "%87 uyumlusunuz" bir hüküm, bir anlatım değil;
    // üstelik Co-Star klonu görüntüsünün ana kaynağı orası.
    // Bunun yerine kategori kategori, önce ne olduğu sonra dayanağı.
    //
    // durum: kolay | zor | karisik — iki mürekkep mantığı, zorlananlar bakır.
    // ---------------------------------------------------------------
    'uyum' => [
        'kisi' => [
            'ad'       => 'Deniz',
            'dogum'    => '12 Mayıs 1990 · 09.30 · Ankara',
            'gunes'    => 'Boğa',
            'ay'       => 'Balık',
            'yukselen' => 'Aslan',
        ],

        'ozet' => 'Kolay anlaşan ama zor karar veren bir ikili.',

        'kategoriler' => [
            [
                'ad'      => 'konuşma',
                'durum'   => 'kolay',
                'baslik'  => 'Aranızda sessizlik birikmiyor.',
                'metin'   => 'İkiniz de aklınızdan geçeni saklamayı beceremiyorsunuz. '
                           . 'Bu ilişkinin en büyük şansı bu: küskünlükler uzamıyor, '
                           . 'çünkü ikiniz de dayanamayıp konuşuyorsunuz. Kavga sık '
                           . 'olabilir ama sessiz kalınan hafta neredeyse hiç olmuyor.',
                'dayanak' => 'merkür – merkür üçgeni',
            ],
            [
                'ad'      => 'duygu',
                'durum'   => 'karisik',
                'baslik'  => 'Yakınlığı farklı hızlarda kuruyorsunuz.',
                'metin'   => 'Sen yakınlığı konuşarak kuruyorsun, o yanında durarak. '
                           . 'Senin için açılmamak mesafe demek; onun için açılmak '
                           . 'zorlanmak demek. İkiniz de karşı tarafın çabasını çoğu '
                           . 'zaman göremiyorsunuz — görünce de şaşırıyorsunuz.',
                'dayanak' => 'ay – venüs geniş açı',
            ],
            [
                'ad'      => 'çekim',
                'durum'   => 'kolay',
                'baslik'  => 'Aradan yıllar geçse de sönmüyor.',
                'metin'   => 'Bu ikilinin çekimi ilk günkü kadar hızlı değil ama '
                           . 'daha inatçı. Uzaklaşmak, küsmek, ayrılmak bile onu '
                           . 'bitirmiyor. Tekrar karşılaşınca aynı yerden devam '
                           . 'ediyorsunuz — bu bazen iyi, bazen sorun.',
                'dayanak' => 'venüs – mars kavuşumu',
            ],
            [
                'ad'      => 'gündelik hayat',
                'durum'   => 'zor',
                'baslik'  => 'Aynı evde farklı saatlerde yaşıyorsunuz.',
                'metin'   => 'Düzen fikriniz uyuşmuyor. Senin için plan güven veriyor, '
                           . 'onun için daraltıyor. Bu, büyük meselelerde değil, '
                           . 'günlük ayrıntılarda çıkıyor: kim ne zaman kalkıyor, '
                           . 'ne zaman yemek yeniyor, hafta sonu ne yapılıyor.',
                'dayanak' => 'satürn – ay karesi',
            ],
            [
                'ad'      => 'çatışma',
                'durum'   => 'zor',
                'baslik'  => 'İkiniz de aynı anda haklı hissediyorsunuz.',
                'metin'   => 'Sen karar vermeden konuşuyorsun, o konuşmadan karar '
                           . 'veriyor. Tartışma başladığında ikiniz de kendi usulünüzle '
                           . 'doğru davrandığınıza inanıyorsunuz — ve ikiniz de haklısınız. '
                           . 'Burada işe yarayan tek şey sırayı bilerek bozmak: '
                           . 'sen bir kere susup, o bir kere önce konuşacak.',
                'dayanak' => 'mars – merkür karesi',
            ],
            [
                'ad'      => 'uzun vade',
                'durum'   => 'kolay',
                'baslik'  => 'Zorlukları birlikte geçirdiğinizde sağlamlaşıyor.',
                'metin'   => 'Bu ikili iyi günde değil, kötü günde birbirine yaklaşıyor. '
                           . 'Kriz anında ikinizin de refleksi kaçmak değil kalmak. '
                           . 'Uzun vadede ilişkiyi ayakta tutan şey uyum değil, '
                           . 'bu ortak inat.',
                'dayanak' => 'satürn – güneş üçgeni',
            ],
        ],
    ],

    'yesim' => [
        'baslik' => 'Haritanı kendi elimle okuyup sana yazayım.',
        'alt'    => 'Yeşim',
        'buton'  => 'yorumumu iste',
    ],

    'menu' => [
        'kesfet'    => 'keşfet',
        'astroloji' => 'astroloji',
        'yolculuk'  => 'yolculuk',
        'rehber'    => 'rehber',
        'ben'       => 'ben',
    ],

    'etiket' => [
        'gunes_burcun' => 'güneş burcun',
        'bugun'        => 'bugün',
        'gokyuzu'      => 'gökyüzü',
        'ates'         => 'ateş',
        'toprak'       => 'toprak',
        'hava'         => 'hava',
        'su'           => 'su',
        'akici'        => 'akıcı',
        'gergin'       => 'gergin',
        'ay'           => 'ay',
        'cin'          => 'çin astrolojisi',
        'numeroloji'   => 'numeroloji',
        'yesimden'     => 'yeşim’den',
        'bakislar'     => 'başka bakışlar',
        'carka_ipucu'  => 'haritadaki bir işarete dokun',
        'yap'          => 'bugün yap',
        'yapma'        => 'bugün yapma',
        'gunun_detayi' => 'günün detayı',
        'tumunu_gor'   => 'tümünü gör',
        'ne_zaman'     => 'bunu ne zaman yapmalıyım',
        'hafta_yok'    => 'bu hafta uygun gün yok',
        'en_yakin'     => 'en yakın',
        'ay_gorunumu'  => 'bütün ayı gör',
        'rehbere_don'  => 'rehber',
        'one_cikan_yok'=> 'öne çıkan bir alan yok',
        'begen'        => 'beğen',
        'yorumla'      => 'yorum',
        'kaydet'       => 'kaydet',
        'kayitli'      => 'kaydedildi',
        'gunes'        => 'güneş',
        'kunye'        => 'künye',
        'duzenle'      => 'düzenle',
        'ilerleme'     => 'ilerleme',
        'kisiler'      => 'kişiler',
        'kisi_ekle'    => 'kişi ekle',
        'uyuma_bak'    => 'uyum',
        'aldiklarin'   => 'yeşim’den aldıkların',
        'yeni_yorum'   => 'yeni yorum iste',
        'kaydettiklerin' => 'kaydettiklerin',
        'takvimi_ac'   => 'takvimi aç',
        'ayarlar'      => 'ayarlar',
        'bene_don'     => 'ben',
        'kolay'        => 'kolay olan',
        'zor'          => 'zorlanacağınız',
        'karisik'      => 'ikisi birden',
        'kaldigin_yer' => 'kaldığın yer',
        'bugune'       => 'bugüne denk düşen',
        'bu_seride'    => 'bu seride',
        'diger_yollar' => 'diğer yolculuklar',
        'tek_seferlik' => 'tek seferlikler',
        'bolum'        => 'bölüm',
        'tamamlandi'   => 'tamamlandı',
        'dinle'        => 'dinle',
        'tekrar_dinle' => 'tekrar dinle',
        'seriye_bak'   => 'seriye başla',
        'ilk_bolumler' => 'ilk bölümler',
        'baslanmadi'   => 'başlanmadı',
        'daha_fazla'   => 'daha fazla',
        'kapat'        => 'kapat',
        'yukselen'     => 'yükselen',
        'aydinlik'     => 'aydınlık',
        'dolunaya'     => 'dolunaya',
        'gun'          => 'gün',
    ],

    'yakinda' => 'Bu bölüm henüz çizilmedi.',
];
