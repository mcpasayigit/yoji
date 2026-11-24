<?php /* Yo-Ji · How It Works / Weigh & Pay — anasayfa ve products'ta kullanılır */ ?>
<section class="yj-hiw">
    <div class="wrapper">
        <h2 class="yj-hiw__title title-text"><span class="underlined" data-aos="line-text"><b><?= yj_h($yj_t(['tr' => 'Nasıl Çalışır?', 'en' => 'How It Works'])) ?></b></span></h2>
        <p class="yj-hiw__lead"><?= yj_h($yj_t(['tr' => 'Self-servis. Kendi kasen, senin tarzın.', 'en' => 'Self-serve. Your bowl, your way.'])) ?></p>
        <div class="yj-hiw__grid">
            <div class="yj-hiw__card">
                <div class="yj-hiw__icon" style="background-image:url(/wp-content/uploads/revize/hiw-1.png)"></div>
                <h3><?= yj_h($yj_t(['tr' => 'Bazını Seç', 'en' => 'Choose Your Base'])) ?></h3>
                <p><?= yj_h($yj_t(['tr' => 'Dondurulmuş Yoğurt’unu ya da Açaí’ni seç.', 'en' => 'Choose your Frozen Yogurt or Açaí.'])) ?></p>
            </div>
            <div class="yj-hiw__card">
                <div class="yj-hiw__icon" style="background-image:url(/wp-content/uploads/revize/hiw-2.png)"></div>
                <h3><?= yj_h($yj_t(['tr' => 'Kendine Göre Yap', 'en' => 'Make It Yours'])) ?></h3>
                <p><?= yj_h($yj_t(['tr' => 'En sevdiğin meyve, topping ve sosları ekle.', 'en' => 'Add your favourite fruit, toppings and sauces.'])) ?></p>
            </div>
            <div class="yj-hiw__card">
                <div class="yj-hiw__icon" style="background-image:url(/wp-content/uploads/revize/hiw-3.png)"></div>
                <h3><?= yj_h($yj_t(['tr' => 'Tart ve Öde', 'en' => 'Weigh & Pay'])) ?></h3>
                <p><?= yj_h($yj_t(['tr' => 'Kaseni tart, gramajına göre öde.', 'en' => 'Weigh your bowl and pay by weight.'])) ?></p>
            </div>
        </div>
    </div>
</section>
