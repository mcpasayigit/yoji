<?php
include 'header.php';
?>
<section  class="page-header bg-video-wrap">
	<!-- <video src="https://yoji.com.tr/wp-content/uploads/2022/06/banner_our_story.mp4" loop muted autoplay></video> -->
	<div  class="page-header-background" style="background: url(/wp-content/uploads/revize/story-banner.jpg); display: block !important;"></div>
	<div  class="wrapper">
		<h2 class="page-title" data-aos="flip-up" data-aos-delay="200" data-aos-duration="800" data-aos-once="true">
			<span class="underlined" data-aos="line-text">
				<b><?= yj_h($yj_t(['tr' => 'Hikayemiz', 'en' => 'Our story'])) ?></b>
			</span>
		</h2>
		<h3 class="sub-title"><?= $yj_t(['tr' => 'Sadece bir <b>kaseden</b> fazlası.', 'en' => 'More than just a <b>Bowl.</b>']) ?> </h3>
	</div>
	<div  class="wave inner"></div>
</section>


			<section  class="heart-section">
			<div  class="wrapper">
				<div  class="chi-bear-plain"></div>
				<div  class="heart-box">
					<h4 data-aos="fade-up" data-aos-delay="200" data-aos-duration="800" data-aos-once="true"><?= $yj_t(['tr' => 'Froyo’yu biz getiriyoruz.<br><span class="underlined" data-aos="line-text"><b>Neşeyi Yoji getiriyor.</b></span>', 'en' => 'We bring the froyo.<br><span class="underlined" data-aos="line-text"><b>Yoji brings the joy.</b></span>']) ?> </h4>
<?php if ($yj_lang === 'en'): ?>
<p>Life gives us enough things to take seriously.<br>
Plans. Deadlines. Decisions. Rules. All the things we should do, shouldn't do, should eat, shouldn't eat.<br>
Yoji is a little break from all that.<br>
Here, you start with a cup and a world of possibilities.<br>
Pick your froyo. Add something fruity. Something crunchy. Something chocolatey. Mix things that make perfect sense or absolutely no sense at all. Keep it simple or pile it high.<br>
There is no recipe for a Yoji.<br>
Because Yoji is more than what's in the cup. It's choosing exactly what you feel like. Trying something new. Going back for your favorite. Making it yours.<br>
We bring the ingredients.<br>
You bring your mood, your taste, your curiosity.<br>
And somewhere between the first swirl and the last topping, something simple happens:<br>
<b>Yoji brings the joy.</b></p>
<?php else: ?>
<p>Hayat zaten yeterince ciddiye alınacak şey veriyor.<br>
Planlar. Son teslim tarihleri. Kararlar. Kurallar. Yapman, yapmaman, yemen, yememen gereken her şey.<br>
Yoji, tüm bunlardan küçük bir mola.<br>
Burada bir kaseyle ve koca bir olasılıklar dünyasıyla başlıyorsun.<br>
Froyo’nu seç. Meyveli bir şey ekle. Çıtır bir şey. Çikolatalı bir şey. Birbirine tam uyan ya da hiç uymayan şeyleri karıştır. Sade bırak ya da tepeleme doldur.<br>
Yoji’nin bir tarifi yok.<br>
Çünkü Yoji, kasenin içindekinden fazlası. Tam da canının çektiğini seçmek. Yeni bir şey denemek. En sevdiğine geri dönmek. Onu seninki yapmak.<br>
Malzemeleri biz getiriyoruz.<br>
Ruh halini, damak zevkini, merakını sen getiriyorsun.<br>
Ve ilk karışımla son topping arasında bir yerde, basit bir şey oluyor:<br>
<b>Neşeyi Yoji getiriyor.</b></p>
<?php endif; ?>
				</div>
			</div>
		</section>
	
<section class="yj-story-note">
	<div  class="wrapper sub-intro">
		<?php if ($yj_lang === 'en'): ?>
<p>At Yoji, we believe a bowl can be more than just something you eat.
It can be a small pause in the day, a little mood boost, and a moment that
feels entirely yours.
That is why every Yoji starts with freedom to choose.
Pick your base, add the fruit, toppings and sauces you love, and create
something that fits exactly how you feel.
Simple, joyful and made your way.
Because sometimes the best part of the day is not the big plan.
It is a little break from all that.
Yoji. Taste of Life.</p>
<?php else: ?>
<p>Yoji’de bir kasenin, yediğin bir şeyden fazlası olabileceğine inanıyoruz.
Günün içinde küçük bir mola, minik bir keyif ve tamamen sana ait hissettiren
bir an olabilir.
İşte bu yüzden her Yoji, seçme özgürlüğüyle başlar.
Bazını seç; sevdiğin meyve, topping ve sosları ekle; tam da hissettiğin gibi
bir şey yarat.
Sade, keyifli ve senin tarzında.
Çünkü bazen günün en güzel yanı büyük planlar değildir.
Her şeyden küçük bir moladır.
Yoji. Hayatın Tadı.</p>
<?php endif; ?>
	</div>
</section>

<div  class="video-popup">
	<div  class="close-popup"></div>
	<iframe src="https://www.youtube.com/embed/xywwcOGeJUM" title="Yo-Chi" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
</div>

			
	

<?php
include 'footer.php';
?>