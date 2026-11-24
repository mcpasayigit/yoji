<?php
include 'header.php';
?>

<section  class="page-header">
   <div  class="page-header-background" style="background: url(/wp-content/uploads/revize/contact-banner.jpg);"></div>
   <div  class="wrapper">
      <h2 class="page-title aos-no-animate" data-aos="flip-up" data-aos-delay="200" data-aos-duration="800" data-aos-once="true">
         <span class="underlined" data-aos="line-text">
            <b><?= yj_h($yj_t(['tr' => 'İletişim', 'en' => 'Contact us'])) ?></b>
         </span>
      </h2>
   </div>
   <div  class="wave inner"></div>
</section>

<section  class="contact-section">
   <div  class="wrapper">
      <div  class="grid-box link-box-chi-club row-2 story">

         <div class="row-list no-animate" data-aos="fade-up" data-aos-delay="600" data-aos-duration="600" data-aos-once="true">
            <a href="mailto:career@yoji.com.tr">
               <div class="row" style="background: url(/wp-content/uploads/revize/career.jpg);">
                  <span class="name-links"><span class="underlined" data-aos="line-text"><b><?= yj_h($yj_t(['tr' => 'Kariyer', 'en' => 'Careers'])) ?></b></span></span>
               </div>
            </a>
            <p style="text-align: center;"><?= yj_h($yj_t(['tr' => 'Bizimle çalışmak ister misin?', 'en' => 'Want to work with us?'])) ?></p>
            <a href="mailto:career@yoji.com.tr" class="read-more"><?= yj_h($yj_t(['tr' => 'BAŞVUR', 'en' => 'APPLY NOW'])) ?></a>
         </div>

         <div class="row-list no-animate" data-aos="fade-up" data-aos-delay="800" data-aos-duration="600" data-aos-once="true">
            <a href="mailto:franchise@yoji.com.tr">
               <div class="row" style="background: url(/wp-content/uploads/revize/franchise.jpg);">
                  <span class="name-links"><span class="underlined" data-aos="line-text"><b><?= yj_h($yj_t(['tr' => 'Bayilik', 'en' => 'Franchising'])) ?></b></span></span>
               </div>
            </a>
            <p style="text-align: center;"><?= yj_h($yj_t(["tr" => "Şubelerimiz bayilik usulü işletilmiyor ama ilgileniyorsan bize bir mesaj at!", "en" => "Our venues aren’t franchised but if you’re interested, shoot us a message!"])) ?></p>
            <a href="mailto:franchise@yoji.com.tr" class="read-more"><?= yj_h($yj_t(['tr' => 'BİLGİ AL', 'en' => 'ENQUIRE NOW'])) ?></a>
         </div>

      </div>
   </div>
</section>

<section  class="contact-form-section" id="contact-form-section">
   <div  class="wrapper">

      <div  class="contact-form-box">

<!-- WhatsApp formu: data-whatsapp = ülke kodu ile başlayan numara, + ve boşluk olmadan (örn. 905551112233) -->
<div class="wpcf7">
<form class="wpcf7-form" id="yj-wa-form" data-whatsapp="90XXXXXXXXXX" aria-label="Contact form" novalidate>
<p><b><?= yj_h($yj_t(['tr' => 'Merhaba!', 'en' => 'Hi there!'])) ?></b><br />
<?= yj_h($yj_t(['tr' => 'Adım', 'en' => 'My name is'])) ?> <span class="wpcf7-form-control-wrap"><input size="40" maxlength="80" class="wpcf7-form-control wpcf7-text your-name" aria-required="true" placeholder="<?= yj_h($yj_t(['tr' => 'Adın', 'en' => 'Your name'])) ?>" value="" type="text" name="name" autocomplete="name" /></span><br />
<?= yj_h($yj_t(['tr' => 've yo-ekibiyle şunun hakkında konuşmak istiyorum:', 'en' => 'and I want to chat to the yo-team about'])) ?> <span class="wpcf7-form-control-wrap"><select class="wpcf7-form-control wpcf7-select limit contact-subject" aria-required="true" name="subject">
<option value="Soru / Geri bildirim"><?= yj_h($yj_t(['tr' => 'Soru / Geri bildirim', 'en' => 'Question or Feedback'])) ?></option>
<option value="Şube ve çalışma saatleri"><?= yj_h($yj_t(['tr' => 'Şube ve çalışma saatleri', 'en' => 'Locations &amp; opening hours'])) ?></option>
<option value="İş birliği"><?= yj_h($yj_t(['tr' => 'İş birliği', 'en' => 'Collaboration'])) ?></option>
<option value="Diğer"><?= yj_h($yj_t(['tr' => 'Diğer', 'en' => 'Something else'])) ?></option>
</select></span>
</p>
<p><span class="wpcf7-form-control-wrap"><textarea cols="40" rows="10" maxlength="1000" class="wpcf7-form-control wpcf7-textarea your-message" aria-required="true" placeholder="<?= yj_h($yj_t(['tr' => 'Mesajım...', 'en' => 'My message is...'])) ?>" name="message"></textarea></span>
<span class="send-btn"><input class="wpcf7-form-control wpcf7-submit" type="submit" value="<?= yj_h($yj_t(['tr' => 'Gönder', 'en' => 'Send'])) ?>" /></span>
</p>
<p class="form-processing"><?= yj_h($yj_t(['tr' => 'WhatsApp açılıyor...', 'en' => 'Opening WhatsApp...'])) ?>
</p>
<p class="form-success" role="status" aria-live="polite"><?= yj_h($yj_t(['tr' => 'Teşekkürler! WhatsApp açılıyor, oradan göndere basman yeter.', 'en' => 'Thank you! WhatsApp is opening, just press send there.'])) ?>
</p>
</form>
</div>

      </div>
   </div>
</section>

<section  class="faq-section" id="yochi-faq">
   <div  class="wrapper">
      <h3 class="title-faq"><span class="underlined" data-aos="line-text"><b><?= yj_h($yj_t(['tr' => 'SSS', 'en' => 'FAQs'])) ?></b></span></h3>
      <div  class="grid-box row-2-1">
                     <div class="container">
                                 
                  <div class="panels">
                     <div class="relative">
                        <div class="panel-heading">
                           <span class="panel-title"><?= yj_h($yj_t(['tr' => 'Yoji nasıl çalışır?', 'en' => 'How does Yoji work?'])) ?></span>
                        </div>
                     </div>

                     <div class="panel-collapse">
                        <div class="panel-body">
                           <p><?= yj_h($yj_t(['tr' => 'En sevdiğin Dondurulmuş Yoğurt ya da Açaí ile başla; sonra meyve, topping ve sos ekleyerek tamamen kendine ait bir kase yarat.', 'en' => 'Start with your favourite Frozen Yogurt or Açaí, then add fruit, toppings and sauces to create a bowl entirely your own.'])) ?></p>
                        </div>
                     </div>
                  </div>

                  <div class="panels">
                     <div class="relative">
                        <div class="panel-heading">
                           <span class="panel-title"><?= yj_h($yj_t(['tr' => 'Vegan ya da süt içermeyen seçenekleriniz var mı?', 'en' => 'Do you offer vegan or dairy-free options?'])) ?></span>
                        </div>
                     </div>

                     <div class="panel-collapse">
                        <div class="panel-body">
                           <p><?= yj_h($yj_t(['tr' => 'Bazı ürünler vegan ya da süt içermeyen olabilir. Ürün yelpazemiz değişebildiği için sipariş öncesi mağazadaki ürün bilgilerine bakman ya da ekibimize sorman yeterli.', 'en' => 'Selected products may be vegan or dairy-free. Our range can vary, so please check the product information in store or ask our team before ordering.'])) ?></p>
                        </div>
                     </div>
                  </div>

                  <div class="panels">
                     <div class="relative">
                        <div class="panel-heading">
                           <span class="panel-title"><?= yj_h($yj_t(['tr' => 'Ürünleriniz glutensiz mi?', 'en' => 'Are your products gluten-free?'])) ?></span>
                        </div>
                     </div>

                     <div class="panel-collapse">
                        <div class="panel-body">
                           <p><?= yj_h($yj_t(['tr' => 'Bazı malzemelerimiz gluten içermeyebilir ama ürünlerimiz ortak bir alanda hazırlanıp servis ediliyor. Alerjin ya da intoleransın varsa kaseni hazırlamadan önce lütfen ekibimizle konuş.', 'en' => 'Some of our ingredients may not contain gluten, but our products are prepared and served in a shared environment. If you have an allergy or intolerance, please speak to our team before making your bowl.'])) ?></p>
                        </div>
                     </div>
                  </div>

                  <div class="panels">
                     <div class="relative">
                        <div class="panel-heading">
                           <span class="panel-title"><?= yj_h($yj_t(['tr' => 'Alerjen bilgisini nerede bulabilirim?', 'en' => 'Where can I find allergen information?'])) ?></span>
                        </div>
                     </div>

                     <div class="panel-collapse">
                        <div class="panel-body">
                           <p><?= yj_h($yj_t(['tr' => 'Alerjen bilgisi mağazada mevcut. Ekibimiz; bazların, toppinglerin ve sosların içerik ve alerjen detaylarını kontrol etmene yardımcı olabilir.', 'en' => 'Allergen information is available in store. Our team can help you check the ingredients and allergen details of our bases, toppings and sauces.'])) ?></p>
                        </div>
                     </div>
                  </div>

                  <div class="panels">
                     <div class="relative">
                        <div class="panel-heading">
                           <span class="panel-title"><?= yj_h($yj_t(['tr' => 'Aynı kasede Dondurulmuş Yoğurt ve Açaí’yi karıştırabilir miyim?', 'en' => 'Can I mix Frozen Yogurt and Açaí in the same bowl?'])) ?></span>
                        </div>
                     </div>

                     <div class="panel-collapse">
                        <div class="panel-body">
                           <p><?= yj_h($yj_t(['tr' => 'Kesinlikle. Yoji’de kural yok. Bazlarını karıştır, en sevdiklerini ekle ve tam istediğin gibi yap.', 'en' => 'Absolutely. There are no rules at Yoji. Mix your bases, add your favourites and make it exactly the way you like it.'])) ?></p>
                        </div>
                     </div>
                  </div>

                  <div class="panels">
                     <div class="relative">
                        <div class="panel-heading">
                           <span class="panel-title"><?= yj_h($yj_t(['tr' => 'Toppingleriniz ve soslarınız değişiyor mu?', 'en' => 'Do your toppings and sauces change?'])) ?></span>
                        </div>
                     </div>

                     <div class="panel-collapse">
                        <div class="panel-body">
                           <p><?= yj_h($yj_t(['tr' => 'Evet. Bazı lezzetler ve toppingler mevsime, stok durumuna ve Yoji menüsüne eklenen yeniliklere göre değişebilir.', 'en' => 'Yes. Some flavours and toppings may change depending on season, availability and new additions to the Yoji menu.'])) ?></p>
                        </div>
                     </div>
                  </div>

                  <div class="panels">
                     <div class="relative">
                        <div class="panel-heading">
                           <span class="panel-title"><?= yj_h($yj_t(['tr' => 'Taze meyve kullanıyor musunuz?', 'en' => 'Do you use fresh fruit?'])) ?></span>
                        </div>
                     </div>

                     <div class="panel-collapse">
                        <div class="panel-body">
                           <p><?= yj_h($yj_t(['tr' => 'Topping ve soslarımızın yanında taze meyve seçenekleri de sunuyoruz. Mevcut meyveler mevsime ve şubeye göre değişebilir.', 'en' => 'We offer fresh fruit selections alongside our toppings and sauces. Available fruits may change seasonally and by location.'])) ?></p>
                        </div>
                     </div>
                  </div>

                  <div class="panels">
                     <div class="relative">
                        <div class="panel-heading">
                           <span class="panel-title"><?= yj_h($yj_t(['tr' => 'Bana en yakın Yoji’yi nerede bulabilirim?', 'en' => 'Where can I find the nearest Yoji?'])) ?></span>
                        </div>
                     </div>

                     <div class="panel-collapse">
                        <div class="panel-body">
                           <p><?= yj_h($yj_t(['tr' => 'Güncel şubelerimizi, adreslerini ve çalışma saatlerini görmek için Şubeler sayfamıza göz at.', 'en' => 'Visit our Locations page to see our current stores, addresses and opening hours.'])) ?></p>
                        </div>
                     </div>
                  </div>

                  <div class="panels">
                     <div class="relative">
                        <div class="panel-heading">
                           <span class="panel-title"><?= yj_h($yj_t(['tr' => 'Gelmeden önce menüye bakabilir miyim?', 'en' => 'Can I check the menu before visiting?'])) ?></span>
                        </div>
                     </div>

                     <div class="panel-collapse">
                        <div class="panel-body">
                           <p><?= yj_h($yj_t(['tr' => 'Evet. Dondurulmuş Yoğurt, Açaí, topping ve soslarımızı web sitemizde inceleyebilirsin. Ürün mevcudiyeti şubeye göre değişebilir.', 'en' => 'Yes. You can explore our Frozen Yogurt, Açaí, toppings and sauces on our website. Product availability may vary by location.'])) ?></p>
                        </div>
                     </div>
                  </div>

                  <div class="panels">
                     <div class="relative">
                        <div class="panel-heading">
                           <span class="panel-title"><?= yj_h($yj_t(['tr' => 'Gıda alerjim varsa ne yapmalıyım?', 'en' => 'What if I have a food allergy?'])) ?></span>
                        </div>
                     </div>

                     <div class="panel-collapse">
                        <div class="panel-body">
                           <p><?= yj_h($yj_t(['tr' => 'Sipariş vermeden önce lütfen ekibimize haber ver. Malzemeler ortak bir hazırlık ve self-servis alanında kullanıldığı için alerjenler arasında çapraz temas olabilir.', 'en' => 'Please let our team know before ordering. Because ingredients are handled in a shared preparation and self-service environment, cross-contact between allergens may occur.'])) ?></p>
                        </div>
                     </div>
                  </div>
                     </div>
                  <div class="row">
            <img src="https://yoji.com.tr/wp-content/uploads/2022/04/favorites-image.png" alt="" class="faq-image yochi">
         </div>
      </div>
   </div>
</section>

<script>
/* ---- FAQ akordiyon: temanın birleştirilmiş JS paketinden bağımsız çalışır ---- */
(function () {
  function toggle(head) {
    var panel = head.closest('.panels');
    var body = panel && panel.querySelector('.panel-collapse');
    if (!body) return;
    var open = !body.classList.contains('collapse');
    body.classList.toggle('collapse', open);
    head.classList.toggle('change_icon', open);
    head.setAttribute('aria-expanded', open ? 'true' : 'false');
  }
  document.querySelectorAll('.panel-heading').forEach(function (h) {
    h.setAttribute('role', 'button');
    h.setAttribute('tabindex', '0');
    h.setAttribute('aria-expanded', 'false');
  });
  /* capture + stopPropagation: eski tema handler'ı da yüklenirse çift tetiklenip akordiyonu geri kapatmasın */
  document.addEventListener('click', function (e) {
    var head = e.target.closest('.panel-heading');
    if (!head) return;
    e.stopPropagation();
    toggle(head);
  }, true);
  document.addEventListener('keydown', function (e) {
    if (e.key !== 'Enter' && e.key !== ' ') return;
    var head = e.target.closest && e.target.closest('.panel-heading');
    if (!head) return;
    e.preventDefault();
    toggle(head);
  });
})();

/* ---- İletişim formu -> WhatsApp ---- */
(function () {
  var form = document.getElementById('yj-wa-form');
  if (!form) return;
  form.addEventListener('submit', function (e) {
    e.preventDefault();
    var f = form.elements, first = null;
    ['name', 'message'].forEach(function (n) {
      var bad = !f[n].value.trim();
      f[n].classList.toggle('wpcf7-not-valid', bad);
      if (bad && !first) first = f[n];
    });
    if (first) { first.focus(); return; }
    var num = (form.getAttribute('data-whatsapp') || '').replace(/\D/g, '');
    if (!/^\d{11,15}$/.test(num)) {
      alert('WhatsApp numarası tanımlı değil (form üzerindeki data-whatsapp).');
      return;
    }
    var text = 'Merhaba Yoji ekibi! 👋\n\n' +
      'Ad: ' + f.name.value.trim() + '\n' +
      'Konu: ' + f.subject.value + '\n\n' +
      f.message.value.trim();
    var url = 'https://wa.me/' + num + '?text=' + encodeURIComponent(text);
    form.classList.add('sent');
    var w = window.open(url, '_blank');
    if (w) { w.opener = null; } else { window.location.href = url; }
    setTimeout(function () { form.classList.remove('sent'); form.reset(); }, 6000);
  });
  form.addEventListener('input', function (e) { e.target.classList.remove('wpcf7-not-valid'); });
})();
</script>

<?php
include 'footer.php';
?>