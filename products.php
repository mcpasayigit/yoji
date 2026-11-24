<?php
/*
 * Yo-Ji · BASES sayfası (Frozen Yogurt + Açaí + Toppings + Sauces tek sayfada)
 * Düz PHP ile çalışır (WordPress fonksiyonu kullanmaz). Mevcut bases.php'nin yerine geçer.
 * İçerik aşağıdaki DİZİLERDEN gelir; ürün eklemek/silmek için yalnızca dizileri düzenleyin.
 * Toppings etkileşimi ve ürün seçimi dosyanın en altındaki <script> bloğundadır; ayrı JS dosyası gerekmez.
 */
include 'header.php';

/* ---- Ayarlar -------------------------------------------------------------- */
$yj_up           = 'https://yoji.com.tr/wp-content/uploads/';   // ürün görselleri klasörü
$yj_theme        = '/wp-content/themes/yochi';                  // tema klasörü (Swiper yedeği için)
$yj_default_lang = 'tr';                                        // varsayılan dil: 'tr' veya 'en'

/* ---- HTML kaçış yardımcısı (WordPress gerekmez) --------------------------- */
if (!function_exists('yj_h')) {
    function yj_h($s) { return htmlspecialchars((string) $s, ENT_QUOTES, 'UTF-8'); }
}

/* ---- Dil tespiti: header.php/sayfadaki $lang > ?lang= > çerez > /en/ yolu > varsayılan */
$yj_langs = ['tr', 'en'];
$yj_lang  = $yj_default_lang;
if (isset($lang) && in_array($lang, $yj_langs, true)) {
    $yj_lang = $lang;
} elseif (isset($_GET['lang']) && in_array($_GET['lang'], $yj_langs, true)) {
    $yj_lang = $_GET['lang'];
} elseif (isset($_COOKIE['lang']) && in_array($_COOKIE['lang'], $yj_langs, true)) {
    $yj_lang = $_COOKIE['lang'];
} elseif (isset($_SERVER['REQUEST_URI']) && preg_match('#^/en(/|\?|$)#', $_SERVER['REQUEST_URI'])) {
    $yj_lang = 'en';
}
// ['tr' => '..', 'en' => '..'] biçimindeki metni aktif dile göre seçer; düz metinse aynen döner
$yj_t = function ($v) use ($yj_lang) {
    if (!is_array($v)) return $v;
    return isset($v[$yj_lang]) ? $v[$yj_lang] : (isset($v['tr']) ? $v['tr'] : reset($v));
};

/* ---------------------------------------------------------------------------
 * 1) FROZEN YOGURT / AÇAÍ  (eski "THE OG'S")      img: uploads klasörüne göre yol
 *    labels: tema CSS'indeki ikon sınıfı (string) ya da ['img' => 'yol'] (görsel ikon)
 * ------------------------------------------------------------------------- */
$yj_og = [
    ['name' => ['tr' => 'İmza Ekşi',      'en' => 'Signature Tart'],   'img' => 'urunler/yoji_f_signature.png',  'labels' => ['sig-tart-gf', 'sig-tart-the-og'], 'desc' => ['tr' => 'Taze, pürüzsüz ve tam kıvamında dengeli.', 'en' => 'Fresh, smooth and perfectly balanced.']],
    ['name' => ['tr' => 'Klasik Vanilya', 'en' => 'Classic Vanilla'],  'img' => 'urunler/yoji_f_vanilla.png',    'labels' => ['vanilla-gf'],                      'desc' => ['tr' => 'Hafif, pürüzsüz ve zamansız.', 'en' => 'Light, smooth and timeless.']],
    ['name' => ['tr' => 'Çikolata',       'en' => 'Choccy'],           'img' => 'urunler/yoji_f_choccy.png',     'labels' => ['chocolate-gf-vf'],                 'desc' => ['tr' => 'Yoğun çikolata aroması; iddialı ve doyurucu.', 'en' => 'Rich chocolate flavour, bold and indulgent.']],
    ['name' => ['tr' => 'Çilekli Krema',  'en' => 'Strawberry Cream'], 'img' => 'urunler/yoji_f_strawberry.png', 'labels' => ['strawberry-cream-gf'],             'desc' => ['tr' => 'Gerçek çileklerle hazırlanan kremamsı çilek aroması.', 'en' => 'Creamy strawberry flavour made with real strawberries.']],
    ['name' => ['tr' => 'Açaí',           'en' => 'Açaí'],             'img' => 'urunler/yoji_f_acai.png',       'labels' => ['acai-gf-vf', 'acai-organic-acai', 'acai-sustainably'], 'desc' => ['tr' => 'Premium organik açaí ile dolu, iddialı orman meyvesi aroması.', 'en' => 'Bold berry flavour with premium organic açaí.']],
];

/* 2) SEASONAL */
$yj_seasonal = [
    ['name' => 'Cookies and Cream', 'img' => '2025/06/yo-chi-cookies-and-cream.png', 'labels' => ['cookies-cream-contains-gluten'], 'desc' => 'Indulgent and scrumptious'],
    ['name' => 'Coconut',           'img' => '2025/06/yo-chi-coconut.png',           'labels' => ['coconut-gf-vf'],                  'desc' => 'Vegan, made with coconut cream'],
    ['name' => 'Matcha',            'img' => '2025/06/yo-chi-matcha.png',            'labels' => ['matcha-gf'],                      'desc' => 'A natural antioxidant, made with Japanese Matcha'],
    ['name' => 'Mango',             'img' => '2025/06/yo-chi-mango.png',             'labels' => ['mango-gf'],                       'desc' => 'Always sweet and always juicy, made with real mangoes'],
    ['name' => 'Cinnamon Banana',   'img' => '2025/06/yo-chi-cinnamon-banana.png',   'labels' => ['cinnamon-banana-gf-vf'],          'desc' => 'All the banana goodness you love, with a little cinnamon sparkle on top'],
];

/* 3) LIMITED TIME ONLY  (bölümü kaldırmak için diziyi boş bırakın: $yj_lto = [];) */
$yj_lto = [
    ['name' => 'Coconut Raspberry', 'img' => '2026/08/Coconut-Raspberry.png', 'labels' => [['img' => '2026/08/CR_2.png'], ['img' => '2026/08/CR_1.png']], 'desc' => 'Sweet raspberry meets creamy coconut. Combine with Choccy for our LTO Tokyo Lamington Swirl'],
];

/* ---------------------------------------------------------------------------
 * 4) TOPPINGS  ve  5) SAUCES   (Yo-Ji listesi)
 *    img: boş bırakılırsa renkli yer tutucu görünür. Fotoğrafı medya kitaplığına yükleyip
 *    'img' => '2026/10/cilek.png' gibi (uploads'a göre yol) yazmanız yeterli.
 * ------------------------------------------------------------------------- */
$yj_groups = [
    'fruit'  => ['label' => ['tr' => 'Meyve',  'en' => 'Fruit'],   'color' => '#edb7b4'],
    'crunch' => ['label' => ['tr' => 'Çıtır',  'en' => 'Crunchy'], 'color' => '#f2ce2f'],
    'sweet'  => ['label' => ['tr' => 'Tatlı',  'en' => 'Sweet'],   'color' => '#c1d56f'],
    'sauce'  => ['label' => ['tr' => 'Sos',    'en' => 'Sauce'],   'color' => '#a8735a'],
];
$yj_toppings = [
    // Çıtır
    ['g' => 'crunch', 'img' => 'urunler/topping_granola_keten.png', 'name' => ['tr' => 'Granola (Ballı Keten)', 'en' => 'Honey & Flaxseed Granola']],
    ['g' => 'crunch', 'img' => 'urunler/topping_granola_kakao.png', 'name' => ['tr' => 'Granola (Kakaolu)', 'en' => 'Cocoa Granola']],
    ['g' => 'crunch', 'img' => 'urunler/topping_ceviz.png', 'name' => ['tr' => 'Ceviz', 'en' => 'Walnuts']],
    ['g' => 'crunch', 'img' => 'urunler/topping_chia.png', 'name' => ['tr' => 'Chia Tohumu', 'en' => 'Chia Seeds']],
    ['g' => 'crunch', 'img' => 'urunler/topping_lotus.png', 'name' => ['tr' => 'Lotus Crumble', 'en' => 'Lotus Crumble']],
    ['g' => 'crunch', 'img' => 'urunler/topping_file_fistik.png', 'name' => ['tr' => 'File Yer Fıstığı', 'en' => 'Sliced Peanuts']],
    ['g' => 'crunch', 'img' => 'urunler/topping_krep.png', 'name' => ['tr' => 'Krep Kırığı', 'en' => 'Crepe Crunch']],
    ['g' => 'crunch', 'img' => 'urunler/topping_hcevizi.png', 'name' => ['tr' => 'Hindistan Cevizi', 'en' => 'Coconut']],
    ['g' => 'crunch', 'img' => 'urunler/topping_pirinc.png', 'name' => ['tr' => 'Pirinç Patlağı', 'en' => 'Puffed Rice']],
    // Tatlı
    ['g' => 'sweet', 'img' => 'urunler/topping_mini_mm.png', 'name' => ['tr' => 'Mini M&M', 'en' => 'Mini M&M\'s']],
    ['g' => 'sweet', 'img' => 'urunler/topping_damlacikolata.png', 'name' => ['tr' => 'Damla Çikolata', 'en' => 'Chocolate Chips']],
    ['g' => 'sweet', 'img' => 'urunler/topping_pastas.png', 'name' => ['tr' => 'Pasta Süsü', 'en' => 'Sprinkles']],
    ['g' => 'sweet', 'img' => 'urunler/topping_brownie.png', 'name' => ['tr' => 'Brownie', 'en' => 'Brownie']],
    ['g' => 'sweet', 'img' => 'urunler/topping_cookie.png', 'name' => ['tr' => 'Cookie Dough', 'en' => 'Cookie Dough']],
    ['g' => 'sweet', 'img' => 'urunler/topping_cicibebe.png', 'name' => ['tr' => 'Cici Bebe', 'en' => 'Cici Bebe']],
    ['g' => 'sweet', 'img' => 'urunler/topping_dubai.png', 'name' => ['tr' => 'Dubai Çikolata', 'en' => 'Dubai Chocolate']],
    ['g' => 'sweet', 'img' => 'urunler/topping_jelibon.png', 'name' => ['tr' => 'Jelibon', 'en' => 'Gummy Candy']],
    ['g' => 'sweet', 'img' => 'urunler/topping_rulokat.png', 'name' => ['tr' => 'Rulokat', 'en' => 'Rulokat']],
];

/* FRUITS segmenti */
$yj_fruits = [
    ['g' => 'fruit', 'img' => 'urunler/fruit_cilek.png', 'name' => ['tr' => 'Çilek', 'en' => 'Strawberry']],
    ['g' => 'fruit', 'img' => 'urunler/fruit_muz.png', 'name' => ['tr' => 'Muz', 'en' => 'Banana']],
    ['g' => 'fruit', 'img' => 'urunler/fruit_yabanmersini.png', 'name' => ['tr' => 'Yaban Mersini', 'en' => 'Blueberry']],
    ['g' => 'fruit', 'img' => 'urunler/fruit_ananas.png', 'name' => ['tr' => 'Ananas', 'en' => 'Pineapple']],
    ['g' => 'fruit', 'img' => 'urunler/fruit_mango.png', 'name' => ['tr' => 'Mango', 'en' => 'Mango']],
];
$yj_sauces = [
    ['g' => 'sauce', 'img' => 'urunler/sauce_nutella.png', 'color' => '#74391f', 'name' => ['tr' => 'Nutella',            'en' => 'Nutella']],
    ['g' => 'sauce', 'img' => 'urunler/sauce_yerfistigi.png', 'color' => '#d89b50', 'name' => ['tr' => 'Yer Fıstığı Ezmesi', 'en' => 'Peanut Butter']],
    ['g' => 'sauce', 'img' => 'urunler/sauce_sutluc.png', 'color' => '#71391f', 'name' => ['tr' => 'Sütlü Çikolata',     'en' => 'Milk Chocolate']],
    ['g' => 'sauce', 'img' => 'urunler/sauce_beyazc.png', 'color' => '#f3e3bd', 'name' => ['tr' => 'Beyaz Çikolata',     'en' => 'White Chocolate']],
    ['g' => 'sauce', 'img' => 'urunler/sauce_cilek.png', 'color' => '#d7192b', 'name' => ['tr' => 'Çilek Sos',          'en' => 'Strawberry']],
    ['g' => 'sauce', 'img' => 'urunler/sauce_karamel.png', 'color' => '#c66b18', 'name' => ['tr' => 'Karamel',            'en' => 'Caramel']],
    ['g' => 'sauce', 'img' => 'urunler/sauce_bueno.png', 'color' => '#b98268', 'name' => ['tr' => 'Bueno Çikolata',     'en' => 'Bueno Chocolate']],
    ['g' => 'sauce', 'img' => 'urunler/sauce_ruby.png', 'color' => '#e84f87', 'name' => ['tr' => 'Ruby Çikolata',      'en' => 'Ruby Chocolate']],
    ['g' => 'sauce', 'img' => 'urunler/sauce_frambuaz.png', 'color' => '#8c102b', 'name' => ['tr' => 'Frambuaz Çikolata',  'en' => 'Raspberry Chocolate']],
    ['g' => 'sauce', 'img' => 'urunler/sauce_antep.png', 'color' => '#a5a11b', 'name' => ['tr' => 'Antep Fıstıklı Sos', 'en' => 'Pistachio']],
];

/* ---- Görseli sunucuda bulunmayan ürünleri gizle (kırık görsel çıkmasın).
        Eksik görsel wp-content/uploads/urunler/ içine eklenince ürün kendiliğinden geri gelir. ---- */
$yj_has_img = function ($p) {
    return !empty($p['img']) && is_file(__DIR__ . '/wp-content/uploads/' . $p['img']);
};
foreach (['yj_og', 'yj_seasonal', 'yj_lto', 'yj_toppings', 'yj_fruits', 'yj_sauces'] as $yj_k) {
    if (isset($$yj_k) && is_array($$yj_k)) {
        $$yj_k = array_values(array_filter($$yj_k, $yj_has_img));
    }
}


/* Topping ve sos önizlemelerinde, seçili ürünün adı altında gösterilen kısa açıklamalar. */
$yj_item_descriptions = [
    'fruit:Honey & Flaxseed Granola' => ['tr' => '', 'en' => 'Crunchy oats and flaxseed providing fibre and plant-based omega-3s.'],
    'sauce:Honey & Flaxseed Granola' => ['tr' => '', 'en' => 'Crunchy oats and flaxseed providing fibre and plant-based omega-3s.'],
    'Cocoa Granola'        => ['tr' => '', 'en' => 'A crunchy cocoa granola combining whole grains with rich chocolate flavour.'],
    'Walnuts'        => ['tr' => '', 'en' => 'Naturally rich in plant-based omega-3s, healthy fats and antioxidants.'],
    'Mini M&M’s'        => ['tr' => '', 'en' => 'Colourful milk chocolate pieces adding a playful crunch and sweetness.'],
    'Chocolate Chips'        => ['tr' => '', 'en' => 'Rich chocolate pieces that add a smooth, cocoa-forward finish.'],
    'Chia Seeds'        => ['tr' => '', 'en' => 'Naturally rich in fibre, plant-based omega-3s and essential minerals.'],
    'Lotus Crumble'        => ['tr' => '', 'en' => 'Caramelised biscuit crumble bringing warm spice, sweetness and crunch.'],
    'Sprinkles'        => ['tr' => '', 'en' => 'A colourful finishing touch that adds sweetness, texture and a little fun.'],
    'Sliced Peanuts'        => ['tr' => '', 'en' => 'A crunchy source of plant-based protein, healthy fats and vitamin E.'],
    'Brownie'        => ['tr' => '', 'en' => 'Soft, rich chocolate brownie pieces for a deeper cocoa flavour and indulgent texture.'],
    'Cookie Dough'        => ['tr' => '', 'en' => 'Soft cookie dough bites with chocolate pieces for a creamy, chewy finish.'],
    'Crepe Crunch'        => ['tr' => '', 'en' => 'Light, crispy crepe pieces adding delicate crunch to every spoonful.'],
    'Cici Bebe Biscuit'        => ['tr' => '', 'en' => 'Classic biscuit pieces adding a familiar, lightly sweet and crunchy texture.'],
    'Dubai Chocolate'        => ['tr' => '', 'en' => 'Chocolate, pistachio and crispy pastry notes combined in one rich, crunchy topping.'],
    'Gummy Candy'        => ['tr' => '', 'en' => 'Fruity, chewy sweets that bring bright colour and playful texture.'],
    'Rulokat'        => ['tr' => '', 'en' => 'Crisp rolled wafer pieces with chocolate for a light, layered crunch.'],
    'Coconut'        => ['tr' => '', 'en' => 'Naturally rich in manganese and adds a light tropical flavour and texture.'],
    'Puffed Rice'        => ['tr' => '', 'en' => 'Light and crispy puffed rice that adds crunch without weighing down the bowl.'],
];

/* ---------------------------------------------------------------------------
 * Yardımcı fonksiyonlar (markup üreticiler) – normalde dokunmanız gerekmez
 * ------------------------------------------------------------------------- */
$yj_labels = function ($labels) use ($yj_up) {
    if (empty($labels)) return;
    echo '<div style="display: none;" class="labels-yogurt-info">';
    foreach ($labels as $l) {
        if (is_array($l)) {
            echo '<i class="labels-yogurt-info-icon" style="background-image:url(\'' . yj_h($yj_up . $l['img']) . '\');background-size:contain;"></i>';
        } else {
            echo '<i class="labels-yogurt-info-icon ' . yj_h($l) . '"></i>';
        }
    }
    echo '</div>';
};

// Frozen Yogurt / Seasonal / LTO için sol taraftaki ürün kartı
$yj_row = function ($p) use ($yj_up, $yj_labels, $yj_t) { ?>
    <div class="row-yogurt">
        <img src="<?= yj_h($yj_up . $p['img']) ?>" alt="<?= yj_h($yj_t($p['name'])) ?>">
        <span class="name-yogurt"><?= yj_h($yj_t($p['name'])) ?></span>
        <div class="hide-pc">
            <?php $yj_labels($p['labels']); ?>
            <p class="circle-yogurt-info-description"><?= yj_h($yj_t($p['desc'])) ?></p>
        </div>
    </div>
<?php };

// Büyük önizleme (masaüstü)
$yj_preview = function ($p) use ($yj_up, $yj_labels, $yj_t) { ?>
    <div class="yogurt-preview">
        <div class="image-yogurt-info" style="background:url(<?= yj_h($yj_up . $p['img']) ?>)"></div>
        <div class="circle-yogurt-info">
            <h4 class="circle-yogurt-info-name"><?= yj_h($yj_t($p['name'])) ?></h4>
            <?php $yj_labels($p['labels']); ?>
            <p class="circle-yogurt-info-description"><?= yj_h($yj_t($p['desc'])) ?></p>
        </div>
    </div>
<?php };

// Toppings: slider + sağdaki seçili ürün önizlemesi.
$yj_slider = function ($items, $section_class, $anchor, $title, $text) use ($yj_up, $yj_t, $yj_groups, $yj_item_descriptions) {
    ?>
    <section class="toppings-section intro" id="<?= yj_h($anchor) ?>">
        <div class="wrapper">
            <div class="row">
                <h4 class="title-text" data-aos="fade-up" data-aos-delay="200" data-aos-duration="800" data-aos-once="true">
                    <span class="underlined" data-aos="line-text"><b><?= yj_h($yj_t($title)) ?></b></span>
                </h4>
                <div class="description"><p><?= yj_h($yj_t($text)) ?></p></div>
            </div>
        </div>
    </section>

    <section class="yogurt-section toppings-section <?= yj_h($section_class) ?>">
        <div class="wrapper large-row">
            <div class="grid-box row-2">
                <div class="row">
                    <div class="swiper toppings-slider">
                        <div class="swiper-wrapper">
                            <?php foreach ($items as $it):
                                $g = $yj_groups[$it['g']]; $name = $yj_t($it['name']); ?>
                                <div class="row-yogurt swiper-slide" aria-label="<?= yj_h($name) ?>" title="<?= yj_h($name) ?>">
                                    <?php if ($it['img']): ?>
                                        <img src="<?= yj_h($yj_up . $it['img']) ?>" alt="<?= yj_h($name) ?>" loading="lazy">
                                    <?php else: ?>
                                        <span class="yj-ph" aria-hidden="true" style="--ph:<?= yj_h($g['color']) ?>"></span>
                                    <?php endif; ?>
                                </div>
                            <?php endforeach; ?>
                        </div>
                        <div class="swiper-pagination"></div>
                        <div class="toppings-next"><span class="underlined" data-aos="line-text"><b><?= yj_h($yj_t(['tr' => 'SONRAKİ', 'en' => 'NEXT'])) ?></b></span></div>
                        <div class="toppings-prev"><span class="underlined" data-aos="line-text"><b><?= yj_h($yj_t(['tr' => 'ÖNCEKİ', 'en' => 'PREV'])) ?></b></span></div>
                    </div>
                </div>
                <div class="row details-block yj-topping-details">
                    <?php foreach ($items as $it):
                        $g = $yj_groups[$it['g']];
                        $name = $yj_t($it['name']);
                        $descKey = isset($it['name']['en']) ? $it['name']['en'] : $name;
                        $groupDescKey = $it['g'] . ':' . $descKey;
                        $desc = isset($yj_item_descriptions[$groupDescKey]) ? $yj_t($yj_item_descriptions[$groupDescKey]) : (isset($yj_item_descriptions[$descKey]) ? $yj_t($yj_item_descriptions[$descKey]) : $yj_t($g['label'])); ?>
                        <div class="yogurt-preview yj-topping-preview">
                            <?php if ($it['img']): ?>
                                <div class="yj-topping-preview-image" role="img" aria-label="<?= yj_h($name) ?>" style="background-image:url('<?= yj_h($yj_up . $it['img']) ?>')"></div>
                            <?php else: ?>
                                <div class="yj-topping-preview-image yj-ph" role="img" aria-label="<?= yj_h($name) ?>" style="--ph:<?= yj_h($g['color']) ?>"></div>
                            <?php endif; ?>
                            <h4 class="circle-yogurt-info-name"><?= yj_h($name) ?></h4>
                            <?php if ($desc !== ''): ?><p class="circle-yogurt-info-description"><?= yj_h($desc) ?></p><?php endif; ?>
                        </div>
                    <?php endforeach; ?>
                </div>
            </div>
        </div>
    </section>
<?php };

// Sauces: referans tasarımındaki gibi tek yatay görsel şeridi ve alt ayırıcı çizgi.
$yj_sauce_strip = function ($items) use ($yj_up, $yj_t, $yj_lang) { ?>
    <section class="yj-sauces-strip-section" id="sauces">
        <div class="wrapper yj-sauces-strip-wrap">
            <header class="yj-sauces-heading">
                <h4 class="title-text yj-sauces-title" data-aos="fade-up" data-aos-delay="200" data-aos-duration="800" data-aos-once="true">
                    <?php if ($yj_lang === 'en'): ?>
                        OUR <span class="underlined" data-aos="line-text"><b>SAUCES</b></span>
                    <?php else: ?>
                        <span class="underlined" data-aos="line-text"><b>SOSLARIMIZ</b></span>
                    <?php endif; ?>
                </h4>
                <p class="yj-sauces-intro"><?= yj_h($yj_t(['tr' => 'Son dokunuş senin tarzın.', 'en' => 'Finish it your way.'])) ?></p>
            </header>

            <div class="yj-sauces-grid">
                <?php foreach ($items as $it):
                    $name = $yj_t($it['name']);
                    $sauceColor = isset($it['color']) ? $it['color'] : '#a8735a'; ?>
                    <div class="yj-sauce-item" aria-label="<?= yj_h($name) ?>">
                        <div class="yj-sauce-image-wrap">
                            <?php if (!empty($it['img'])): ?>
                                <img class="yj-sauce-photo" src="<?= yj_h($yj_up . $it['img']) ?>" alt="<?= yj_h($name) ?>" loading="lazy" onerror="this.style.display='none';this.nextElementSibling.style.display='block';">
                                <span style="display: none;" class="yj-sauce-visual yj-sauce-fallback" style="--sauce-color: <?= yj_h($sauceColor) ?>" aria-hidden="true"></span>
                            <?php else: ?>
                                <span class="yj-sauce-visual" style="--sauce-color: <?= yj_h($sauceColor) ?>" aria-hidden="true"></span>
                            <?php endif; ?>
                        </div>
                        <p class="yj-sauce-name"><?= yj_h($name) ?></p>
                    </div>
                <?php endforeach; ?>
            </div>
            <div class="yj-sauces-divider" aria-hidden="true"></div>
        </div>
    </section>
<?php };
?>
<style>
    /* Toppings: solda ürün görselleri, sağda seçili ürün detayı. */
    .yogurt-section.toppings-section .grid-box.row-2 {
        display: grid !important;
        grid-template-columns: minmax(0, 1fr) minmax(0, 1fr);
        align-items: start;
        column-gap: clamp(24px, 3.2vw, 48px);
        width: 100%;
    }
    .yogurt-section.toppings-section .grid-box.row-2 > .row {
        min-width: 0;
        width: 100%;
        margin: 0;
    }
    .yogurt-section.toppings-section .toppings-slider {
        width: 100%;
        min-width: 0;
        overflow: hidden;
        padding-bottom: 62px;
    }
    .yogurt-section.toppings-section .toppings-slider .swiper-wrapper {
        align-items: stretch;
    }
    .yogurt-section.toppings-section .toppings-slider .row-yogurt.swiper-slide {
        display: flex !important;
        flex-direction: column;
        align-items: center;
        justify-content: center;
        width: auto;
        height: auto;
        min-height: 0;
        margin: 0;
        padding: 8px 6px;
        text-align: center;
        cursor: pointer;
        box-sizing: border-box;
    }
    .yogurt-section.toppings-section .toppings-slider .row-yogurt.swiper-slide > img,
    .yogurt-section.toppings-section .toppings-slider .row-yogurt.swiper-slide > .yj-ph {
        display: block;
        width: 84%;
        max-width: 168px;
        aspect-ratio: 1 / 1;
        height: auto;
        margin: 0 auto;
        object-fit: contain;
        border-radius: 50%;
        flex: 0 0 auto;
    }
    .yogurt-section.toppings-section .toppings-slider .row-yogurt.swiper-slide > .yj-ph {
        background: var(--ph, #edb7b4);
    }
    .yogurt-section.toppings-section .yj-topping-details {
        position: relative;
        display: flex;
        align-items: flex-start;
        justify-content: center;
        min-width: 0;
        width: 100%;
        padding: 0;
    }
    .yogurt-section.toppings-section .yj-topping-preview {
        display: none !important;
        position: relative !important;
        inset: auto !important;
        width: 100%;
        max-width: 560px;
        margin: 0 auto;
        padding: 0;
        flex-direction: column;
        align-items: center;
        justify-content: flex-start;
        text-align: center;
        opacity: 0;
        visibility: hidden;
        transform: none !important;
        box-sizing: border-box;
    }
    .yogurt-section.toppings-section .yj-topping-preview.active-yogurt {
        display: flex !important;
        opacity: 1;
        visibility: visible;
    }
    .yj-topping-preview-image {
        position: relative;
        display: block;
        width: min(100%, 520px);
        aspect-ratio: 1 / 1;
        height: auto;
        flex: 0 0 auto;
        margin: 0 auto 18px;
        background-position: center center;
        background-repeat: no-repeat;
        background-size: contain;
    }
    .yj-topping-preview-image.yj-ph { background: none !important; }
    .yj-topping-preview-image.yj-ph::before {
        content: "";
        position: absolute;
        left: 50%;
        top: 50%;
        width: 72%;
        aspect-ratio: 1 / 1;
        border-radius: 50%;
        background: var(--ph, #edb7b4);
        transform: translate(-50%, -50%);
    }
    .yogurt-section.toppings-section .yj-topping-preview .circle-yogurt-info-name {
        position: static !important;
        display: block;
        width: 100%;
        margin: 0 0 16px;
        font-size: clamp(26px, 2.35vw, 34px);
        line-height: 1.2;
        text-align: center;
        transform: none !important;
    }
    .yogurt-section.toppings-section .yj-topping-preview .circle-yogurt-info-description {
        position: static !important;
        display: block;
        width: 100%;
        max-width: 500px;
        margin: 0 auto;
        font-size: clamp(17px, 1.5vw, 21px);
        line-height: 1.55;
        text-align: center;
        transform: none !important;
    }
    .yogurt-section.toppings-section .toppings-slider .row-yogurt.is-active > img,
    .yogurt-section.toppings-section .toppings-slider .row-yogurt.is-active > .yj-ph {
        outline: none;
    }
    .yogurt-section .row-yogurt.is-active .name-yogurt { text-decoration: underline; }
    .row-yogurt:focus-visible { outline: 3px solid #a50c8f; outline-offset: 4px; border-radius: 12px; }
    html { scroll-padding-top: 90px; }

    @media (max-width: 859px) {
        .yogurt-section.toppings-section .grid-box.row-2 {
            grid-template-columns: minmax(0, 1fr);
            row-gap: 28px;
        }
        .yogurt-section.toppings-section .toppings-slider { padding-bottom: 50px; }
        .yogurt-section.toppings-section .toppings-slider .row-yogurt.swiper-slide > img,
        .yogurt-section.toppings-section .toppings-slider .row-yogurt.swiper-slide > .yj-ph {
            width: 82%;
            max-width: 160px;
        }
        .yj-topping-preview-image { width: min(100%, 400px); margin-bottom: 16px; }
        .yogurt-section.toppings-section .yj-topping-preview { max-width: 100%; }
    }

    @media (max-width: 559px) {
        .yogurt-section.toppings-section .toppings-slider .row-yogurt.swiper-slide > img,
        .yogurt-section.toppings-section .toppings-slider .row-yogurt.swiper-slide > .yj-ph {
            width: 78%;
            max-width: 150px;
        }
        .yj-topping-preview-image { width: min(100%, 320px); }
        .yogurt-section.toppings-section .yj-topping-preview .circle-yogurt-info-name { margin-bottom: 10px; }
    }

    /* Sauces: title and short intro at top, all ten sauces in one desktop row. */
    .yj-sauces-strip-section {
        padding: clamp(72px, 9vw, 138px) 0 48px;
        background: #fff;
    }
    .yj-sauces-strip-wrap { width: 100%; }
    .yj-sauces-heading { margin: 0 0 clamp(30px, 3.4vw, 54px); }
    .yj-sauces-strip-section .yj-sauces-title {
        margin: 0;
        color: #37332f;
        font-size: clamp(35px, 3.45vw, 58px);
        font-weight: 400;
        line-height: 1.12;
        letter-spacing: -0.035em;
        text-align: left;
    }
    .yj-sauces-strip-section .yj-sauces-title .underlined { white-space: nowrap; }
    .yj-sauces-intro {
        margin: 12px 0 0;
        color: #37332f;
        font-size: clamp(17px, 1.55vw, 28px);
        line-height: 1.4;
        text-align: left;
    }
    .yj-sauces-grid {
        display: grid;
        grid-template-columns: repeat(10, minmax(0, 1fr));
        gap: clamp(8px, 1.2vw, 20px);
        align-items: start;
        width: 100%;
    }
    .yj-sauce-item { min-width: 0; margin: 0; text-align: center; }
    .yj-sauce-image-wrap {
        position: relative;
        width: 100%;
        max-width: 148px;
        aspect-ratio: 1 / 1;
        margin: 0 auto 16px;
        overflow: visible;
        border-radius: 50%;
    }
    .yj-sauce-photo {
        display: block;
        width: 100%;
        height: 100%;
        object-fit: contain;
        border-radius: 50%;
    }
    .yj-sauce-fallback { display: none; }
    /* CSS bowl stand-in is used only while a sauce photo path is empty. */
    .yj-sauce-visual {
        position: relative;
        display: block;
        width: 100%;
        height: 100%;
        box-sizing: border-box;
        border: 2px solid #f1e5d7;
        border-radius: 50%;
        background: radial-gradient(circle at 33% 24%, #fff 0, #fffaf3 34%, #ead7c0 78%, #f8eee1 100%);
        box-shadow: 0 5px 9px rgba(62, 43, 27, .13), inset 0 0 0 3px rgba(255,255,255,.9);
    }
    .yj-sauce-visual::before {
        content: "";
        position: absolute;
        inset: 8%;
        border: 3px solid rgba(255, 255, 255, .55);
        border-radius: 50%;
        background:
            radial-gradient(ellipse at 31% 25%, rgba(255,255,255,.62) 0 3%, transparent 19%),
            radial-gradient(ellipse at 68% 74%, rgba(35,18,10,.22) 0 2%, transparent 24%),
            repeating-radial-gradient(ellipse at 49% 47%, color-mix(in srgb, var(--sauce-color), white 18%) 0 5%, var(--sauce-color) 7% 12%, color-mix(in srgb, var(--sauce-color), black 16%) 14% 16%);
        box-shadow: inset 0 0 0 2px rgba(91, 57, 31, .13), inset 0 0 8px rgba(60, 33, 15, .2);
    }
    .yj-sauce-visual::after {
        content: "";
        position: absolute;
        inset: 31%;
        border: 2px solid rgba(255,255,255,.2);
        border-radius: 50%;
        transform: rotate(-23deg) scale(.8, 1.1);
        pointer-events: none;
    }
    .yj-sauce-name {
        margin: 0;
        color: #252321;
        font-size: clamp(12px, .98vw, 17px);
        font-weight: 400;
        line-height: 1.35;
        overflow-wrap: anywhere;
        text-align: center;
    }
    .yj-sauces-divider { height: 1px; margin-top: clamp(35px, 4vw, 66px); background: #d9d9d9; width: 100%; }
    @media (max-width: 1150px) {
        .yj-sauces-grid { grid-template-columns: repeat(5, minmax(0, 1fr)); row-gap: 28px; }
        .yj-sauce-image-wrap { max-width: 145px; }
        .yj-sauce-name { font-size: clamp(14px, 1.6vw, 17px); }
    }
    @media (max-width: 600px) {
        .yj-sauces-strip-section { padding: 56px 0 36px; }
        .yj-sauces-heading { margin-bottom: 28px; }
        .yj-sauces-grid { grid-template-columns: repeat(3, minmax(0, 1fr)); gap: 24px 12px; }
        .yj-sauce-image-wrap { width: 100%; max-width: 124px; margin-bottom: 11px; }
        .yj-sauce-name { font-size: 13px; }
        .yj-sauces-divider { margin-top: 34px; }
    }
    @media (max-width: 360px) { .yj-sauces-grid { grid-template-columns: repeat(2, minmax(0, 1fr)); } }
</style>

<section class="page-header">
    <div class="page-header-background" style="background:url(/wp-content/uploads/revize/products-banner.jpg);"></div>
    <div class="wrapper">
        <h2 class="page-title" data-aos="flip-up" data-aos-delay="200" data-aos-duration="800" data-aos-once="true">
            <?= yj_h($yj_t(['tr' => '', 'en' => 'Our'])) ?>
            <span class="underlined" data-aos="line-text"><b><?= yj_h($yj_t(['tr' => 'Ürünlerimiz', 'en' => 'Products'])) ?></b></span>
        </h2>
    </div>
    <div class="wave inner"></div>
</section>

<?php include 'partials/how-it-works.php'; ?>

<?php
$yj_info = [
    ['2022/04/product-info-icon-1.png', ['tr' => ['Her Yoji kasesi', 'her gün taze hazırlanır', 'keyifli bir mola için.'], 'en' => ['Every Yoji bowl', 'is made fresh daily', 'for a feel-good break.']]],
    ['2022/04/product-info-icon-2.png', ['tr' => ['Gerçek meyve ve', 'rengarenk toppingler', 'her kaseyi daha eğlenceli yapar.'], 'en' => ['Real fruit and', 'colorful toppings,', 'make every bowl more fun.']]],
    ['2022/04/product-info-icon-3.png', ['tr' => ['Çıtır toppinglerden', 'pürüzsüz soslara,', 'seçim senin.'], 'en' => ['From crunchy toppings to', 'smooth sauces,', 'the choice is yours.']]],
    ['2022/04/product-info-icon-4.png', ['tr' => ['Kaseni istediğin gibi karıştır,', 'ruh haline uyan kaseyi yarat.', ''], 'en' => ['Mix it your way and create a bowl', 'that fits your mood.', '']]],
];
?>
<section class="product-info-section">
    <div class="wrapper">
        <div class="grid-box row-4">
            <?php foreach ($yj_info as $n => $row):
                $t = $row[1][isset($row[1][$yj_lang]) ? $yj_lang : 'tr']; ?>
                <div class="row-icon-text no-animate" data-aos="fade-up" data-aos-delay="<?= 200 * ($n + 1) ?>" data-aos-duration="600" data-aos-once="true">
                    <i class="icon" style="background:url(<?= yj_h($yj_up . $row[0]) ?>);"></i>
                    <span>
                        <p><?= yj_h($t[0]) ?></p><br>
                        <h4><strong><?= yj_h($t[1]) ?></strong></h4>
                        <?php if ($t[2]): ?><br><p><?= yj_h($t[2]) ?></p><?php endif; ?>
                    </span>
                </div>
            <?php endforeach; ?>
        </div>
    </div>
</section>

<!-- ============ FROZEN YOGURT / AÇAÍ ============ -->
<section style="padding-bottom: 300px !important;" class="yogurt-section ogg-section" id="frozen-yogurt">
    <div class="wrapper">
        <div class="grid-box row-2">
            <div class="row">
                <h4 class="title-text" data-aos="fade-up" data-aos-delay="200" data-aos-duration="800" data-aos-once="true">
                    <?php if ($yj_lang === 'en'): ?>FROZEN <span class="underlined" data-aos="line-text"><b>YOGURTS</b></span>
                    <?php else: ?>DONDURULMUŞ <span class="underlined" data-aos="line-text"><b>YOĞURT</b></span><?php endif; ?>
                </h4>
                <div class="description"><p><?= $yj_t(['tr' => 'İmza yumuşak dondurulmuş yoğurtlarımız,<br>yıl boyunca hep burada.', 'en' => 'Our signature soft-serve frozen yogurts,<br>available all year round.']) ?></p></div>
                <div class="grid-box row-3 mobile-slider">
                    <?php foreach ($yj_og as $p) $yj_row($p); ?>
                </div>
            </div>
            <div class="row">
                <?php foreach ($yj_og as $p) $yj_preview($p); ?>
            </div>
        </div>
    </div>
</section>

<!-- ============ SEASONAL ============ -->
<section style="display: none;" class="yogurt-section seasonal-section" id="seasonal">
    <div class="wave flip"></div>
    <div class="wrapper">
        <div class="grid-box row-2">
            <div class="row">
                <?php foreach ($yj_seasonal as $p) $yj_preview($p); ?>
            </div>
            <div class="row">
                <h4 class="title-text" data-aos="fade-up" data-aos-delay="200" data-aos-duration="800" data-aos-once="true">
                    <span class="underlined" data-aos="line-text"><b>SEASONAL</b></span>
                </h4>
                <div class="description"><p>Our seasonal range changes with … yep you guessed it, the seasons, based on the availability of local produce at different times of the year.</p></div>
                <div class="grid-box row-3 mobile-slider">
                    <?php foreach ($yj_seasonal as $p) $yj_row($p); ?>
                </div>
            </div>
        </div>
    </div>
</section>

<?php if (!empty($yj_lto)): ?>
<!-- ============ LIMITED TIME ONLY ============ -->
<section style="display: none;" class="yogurt-section lt-section" id="limited">
    <div class="wrapper">
        <div class="grid-box row-2">
            <div class="row">
                <h4 class="title-text" data-aos="fade-up" data-aos-delay="200" data-aos-duration="800" data-aos-once="true">
                    Limited Time <span class="underlined" data-aos="line-text"><b>Only</b></span>
                </h4>
                <div class="description"><p>Our Limited Time Only flavours are crafted to keep your tastebuds excited! Because who doesn’t love a surprise swirl when you least expect it.</p></div>
                <div class="grid-box row-3 mobile-slider">
                    <?php foreach ($yj_lto as $p) $yj_row($p); ?>
                </div>
            </div>
            <div class="row">
                <?php foreach ($yj_lto as $p) $yj_preview($p); ?>
            </div>
        </div>
    </div>
</section>
<?php endif; ?>

<!-- ============ FRUITS (statik ızgara, swiper'a dokunmaz) ============ -->
<section class="yj-fruits-section" id="fruits">
    <div class="wrapper">
        <h4 class="title-text yj-fruits-title"><span class="underlined"><b><?= yj_h($yj_t(['tr' => 'MEYVELER', 'en' => 'FRUITS'])) ?></b></span></h4>
        <p class="yj-fruits-lead"><?= yj_h($yj_t(['tr' => 'Taze meyvelerle kaseni tazele.', 'en' => 'Top your bowl with fresh, juicy fruit.'])) ?></p>
        <div class="yj-fruits-grid">
            <?php foreach ($yj_fruits as $fr): ?>
                <div class="yj-fruit-card">
                    <div class="yj-fruit-img" role="img" aria-label="<?= yj_h($yj_t($fr['name'])) ?>" style="background-image:url('<?= yj_h($yj_up . $fr['img']) ?>')"></div>
                    <h5><?= yj_h($yj_t($fr['name'])) ?></h5>
                </div>
            <?php endforeach; ?>
        </div>
    </div>
</section>

<!-- ============ TOPPINGS ============ -->
<?php $yj_slider(
    $yj_toppings, 'toppings-block', 'toppings',
    ['tr' => 'TOPPING DÜNYASI', 'en' => 'OUR TOPPINGS'],
    ['tr' => 'Meyveden çıtıra, çikolatadan tatlıya: kendi kaseni istediğin gibi tamamla.', 'en' => 'Create what makes you happy with our wide range of fruity, crunchy and sweet toppings.']
); ?>

<!-- ============ SAUCES ============ -->
<?php $yj_sauce_strip($yj_sauces); ?>

<!-- ============ ETKİLEŞİMLER (yj-bases) ============ -->
<!-- Her .yogurt-section kendi içinde N. ürün kartını N. önizlemeyle eşler; ID'ye bağlı değildir. -->
<!-- WP Rocket 'JS'i geciktir' açıksa hariç tutma listesine: yj-bases -->
<script id="yj-bases-js">
/*!
 * Yo-Ji · bases sayfası (Frozen Yogurt / Açaí / Toppings / Sauces) etkileşimleri
 * ID'lere bağlı değildir: her .yogurt-section kendi içinde .row-yogurt[i] <-> .yogurt-preview[i] eşleşir.
 * Yeni ürün eklemek için sadece HTML'e satır + önizleme eklemeniz yeterli, JS'e dokunmayın.
 */
(function () {
  'use strict';
  var ACTIVE = 'active-yogurt';
  var SWIPER_SRC = '<?= yj_h($yj_theme . '/js/swiper-bundle.min.js') ?>'; /* footer paketinde Swiper yoksa yedek olarak yüklenir */
  var groups = [];

  function build() {
    groups = [];
    document.querySelectorAll('.yogurt-section').forEach(function (sec) {
      var rows = Array.prototype.slice.call(sec.querySelectorAll('.row-yogurt'));
      var previews = Array.prototype.slice.call(sec.querySelectorAll('.yogurt-preview'));
      if (!rows.length || !previews.length) return;
      var g = { sec: sec, rows: rows, previews: previews };
      groups.push(g);
      rows.forEach(function (r) {
        var n = r.querySelector('.name-yogurt, .circle-yogurt-info-name');
        r.setAttribute('role', 'button');
        r.setAttribute('tabindex', '0');
        r.setAttribute('aria-pressed', 'false');
        if (n && n.textContent.trim()) r.setAttribute('aria-label', n.textContent.trim());
      });
      activate(g, 0);
    });
  }

  function activate(g, i) {
    g.previews.forEach(function (p, k) { p.classList.toggle(ACTIVE, k === i); });
    g.rows.forEach(function (r, k) {
      r.classList.toggle('is-active', k === i);
      r.setAttribute('aria-pressed', k === i ? 'true' : 'false');
    });
  }

  function handle(e) {
    var row = e.target.closest && e.target.closest('.row-yogurt');
    if (!row) return false;
    for (var n = 0; n < groups.length; n++) {
      var i = groups[n].rows.indexOf(row);
      if (i > -1) { activate(groups[n], i); return true; }
    }
    return false;
  }

  /* capture + stopPropagation: temanın eski, ID'ye bağlı jQuery handler'ları sayfada kalmışsa da çakışmasın */
  document.addEventListener('click', function (e) {
    if (handle(e)) e.stopPropagation();
  }, true);
  document.addEventListener('keydown', function (e) {
    if (e.key !== 'Enter' && e.key !== ' ') return;
    if (handle(e)) { e.preventDefault(); e.stopPropagation(); }
  }, true);

  /* Swiper sayfada yoksa (footer paketi yüklenmediyse) temadaki swiper-bundle.min.js'i yükler */
  function withSwiper(cb) {
    if (window.Swiper) return cb();
    var s = document.createElement('script');
    s.src = SWIPER_SRC;
    s.onload = cb;
    document.head.appendChild(s);
  }

  function initSliders() {
    if (!window.Swiper) return;
    /* Toppings slider kendi sayfalama ve oklarıyla başlar; Sauces bölümü yatay bir ürün şerididir. */
    document.querySelectorAll('.toppings-slider').forEach(function (el) {
      if (el.swiper) return;
      new Swiper(el, {
        slidesPerView: 1.4,
        centeredSlides: true,
        spaceBetween: 0,
        grid: { rows: 1, fill: 'column' },
        a11y: { slideRole: 'button', slideLabelMessage: '' },  /* kartlar zaten button + kendi adıyla etiketli */
        observer: true,          /* gizliyken başlatılırsa boyutu yeniden hesaplar */
        observeParents: true,
        pagination: { el: el.querySelector('.swiper-pagination'), clickable: true },
        navigation: { nextEl: el.querySelector('.toppings-next'), prevEl: el.querySelector('.toppings-prev') },
        breakpoints: {
          560: { slidesPerView: 2.4, slidesPerGroup: 1, grid: { rows: 1, fill: 'column' } },
          860: { slidesPerView: 3.4, slidesPerGroup: 1, grid: { rows: 1, fill: 'column' } },
          1140: { centeredSlides: false, slidesPerView: 3, slidesPerGroup: 3, grid: { rows: 3, fill: 'column' } }
        }
      });
    });
  }

  function init() { build(); withSwiper(initSliders); }
  /* 'load': eski kod hâlâ varsa onun $(document).ready tetiklemesinden SONRA çalışıp durumu düzeltir */
  if (document.readyState === 'complete') init();
  else window.addEventListener('load', init);
})();
</script>

<?php
include 'footer.php';
?>