<?php
include 'header.php';
?>



<div class="custom-banner custom-banner-hero yj-hero" id="yj-hero">
	<div class="yj-hero__slide is-active" style="background-image:url('/wp-content/uploads/revize/home-banner-1.jpg')"></div>
	<div class="yj-hero__slide" style="background-image:url('/wp-content/uploads/revize/home-banner-2.jpg')"></div>
	<div class="yj-hero__slide" style="background-image:url('/wp-content/uploads/revize/home-banner-3.jpg')"></div>
	<div class="yj-hero__dots" aria-hidden="true"><button class="is-active"></button><button></button><button></button></div>
</div>
<script>
(function(){var h=document.getElementById('yj-hero');if(!h)return;var s=h.querySelectorAll('.yj-hero__slide'),d=h.querySelectorAll('.yj-hero__dots button'),i=0,t;function go(n){s[i].classList.remove('is-active');d[i].classList.remove('is-active');i=(n+s.length)%s.length;s[i].classList.add('is-active');d[i].classList.add('is-active');}function loop(){t=setInterval(function(){go(i+1);},5000);}d.forEach(function(b,n){b.addEventListener('click',function(){clearInterval(t);go(n);loop();});});loop();})();
</script>
<div  class="wave banner"> </div>

<?php include 'partials/how-it-works.php'; ?>

			<section  class="home-menu-slider">
			<div  class="wrapper">
				<h4 class="title-text">
					<span class="underlined aos-init aos-animate" data-aos="line-text"><b>
						<?= yj_h($yj_t(['tr' => 'KASENDE NE VAR?', 'en' => "WHAT'S IN YOUR BOWL?"])) ?></b></span>
				</h4>
			</div>
							<div  class="swiper menu-slider">
					<div  class="swiper-wrapper">

						
							<div class="swiper-slide light" style="background: url(https://yoji.com.tr/img/anasayfa-image-01.jpg);">
								<a href="#">
									<div class="text-box">

										<h4 class="title-text">
											<span class="underlined aos-init aos-animate" data-aos="line-text"><b><?= yj_h($yj_t(['tr' => 'Dondurulmuş Yoğurt', 'en' => 'Frozen Yogurt'])) ?></b></span>
										</h4>
										<p><?= yj_h($yj_t(['tr' => 'Bazını seç', 'en' => 'Choose your base'])) ?>  </p>

									</div>
								</a>
							</div>
						
							<div class="swiper-slide dark" style="background: url(https://yoji.com.tr/img/anasayfa-image-02.jpg);">
								<a href="#">
									<div class="text-box">

										<h4 class="title-text">
											<span class="underlined aos-init aos-animate" data-aos="line-text"><b><?= yj_h($yj_t(['tr' => 'Açaí', 'en' => 'Açaí'])) ?></b></span>
										</h4>
										<p><?= yj_h($yj_t(['tr' => 'Meyveyle başla', 'en' => 'A fruit start'])) ?> </p>

									</div>
								</a>
							</div>
						
							<div class="swiper-slide dark" style="background: url(https://yoji.com.tr/img/anasayfa-image-03.jpg);">
								<a href="#">
									<div class="text-box">

										<h4 class="title-text">
											<span class="underlined aos-init aos-animate" data-aos="line-text"><b><?= yj_h($yj_t(['tr' => 'Toppingler', 'en' => 'Toppings'])) ?></b></span>
										</h4>
										<p><?= yj_h($yj_t(['tr' => 'Meyve, topping ve soslar', 'en' => 'Fruits, toppings and sauces'])) ?> </p>

									</div>
								</a>
							</div>
						
							<div class="swiper-slide dark" style="background: url(https://yoji.com.tr/img/anasayfa-image-04.jpg);">
								<a href="#">
									<div class="text-box">

										<h4 class="title-text">
											<span class="underlined aos-init aos-animate" data-aos="line-text"><b><?= yj_h($yj_t(['tr' => 'Soslar', 'en' => 'Sauces'])) ?></b></span>
										</h4>
										<p><?= yj_h($yj_t(['tr' => 'Son dokunuş senin tarzın', 'en' => 'Finish it your way'])) ?> </p>

									</div>
								</a>
							</div>
							
						
					</div>
				</div>
				
					</section>
					
			<div style="margin-bottom: 100px;"></div>
	
			<section style="display:none;"  class="share-the-chi">
			<div  class="wrapper">
				<div  class="grid-box row-2">
					<div class="row">
						<img src="https://yoji.com.tr/wp-content/themes/yochi/img/image01.png" alt="" class="share-thee-chi-img" data-aos="fade-up" data-aos-delay="600" data-aos-duration="800" data-aos-once="true">
					</div>
					<div class="row">
						<span class="content"><p><strong>Life gives us enough things to take seriously.</strong><br />
Plans. Deadlines. Decisions. Rules. All the things we should do, shouldn't do, should eat, shouldn't eat.<br><strong>Yoji is a little break from all that.</strong></p>
</span>
					</div>
				</div>
			</div>
		</section>
	
			<section  class="slider-info-home-section">
							<div  class="swiper info-home-slider">
					<div  class="swiper-wrapper">
													<div class="swiper-slide" style="background: url(https://yoji.com.tr/wp-content/uploads/2024/07/YochiSemaphore-v2.jpg);">
								<div class="content">
									<h4 class="title-text">
										<?= $yj_t(['tr' => 'Bazını <span class="underlined"><b>Seç</b></span>', 'en' => 'Pick Your <span class="underlined"><b>Base</b></span>']) ?>									</h4>
								</div>
							</div>
							</div>
											</div>
					<div  class="arrow-box">
						<div class="info-home-slider-prev"></div>
						<div class="info-home-slider-next"></div>
					</div>
				</div>
				
					</section>
	
			<section  class="wthats-section" style="background:#fff url(/wp-content/uploads/revize/favorites-bg.jpg) center/cover;">
			<div  class="wave flip-off-white"></div>
			<h3 class="wthats-title">
			<?= yj_h($yj_t(['tr' => 'FAVORİLERİMİZ', 'en' => 'OUR FAVORITES'])) ?></h3>
			<div  class="swiper whats-home-slider">
				<div  class="swiper-wrapper">
																		<div class="swiper-slide">
								<div class="yogurt-preview yogurt-id-1 active-yogurt">
									<div class="image-yogurt-info" style="background:url(https://yoji.com.tr/wp-content/uploads/2025/06/favori1.png)"></div>
									<div class="circle-yogurt-info">
										<h4 class="circle-yogurt-info-name"><?= yj_h($yj_t(['tr' => 'Klasik', 'en' => 'The Classic'])) ?></h4>
										<p class="circle-yogurt-info-description"><?= yj_h($yj_t(['tr' => 'Dondurulmuş Yoğurt, Çilek, Muz, Granola', 'en' => 'Frozen Yogurt, Strawberry, Banana, Granola'])) ?></p>
									</div>
								</div>
							</div>
													
													<div class="swiper-slide">
								<div class="yogurt-preview yogurt-id-3 ">
									<div class="image-yogurt-info" style="background:url(https://yoji.com.tr/wp-content/uploads/2025/06/favori3.png)"></div>
									<div class="circle-yogurt-info">
										<h4 class="circle-yogurt-info-name"><?= yj_h($yj_t(['tr' => 'Fazlası', 'en' => 'The Extra'])) ?></h4>
										<p class="circle-yogurt-info-description"><?= yj_h($yj_t(['tr' => 'Çikolatalı Dondurulmuş Yoğurt, Muz, Damla Çikolata, Kurabiye Kırığı, Granola, Fındık', 'en' => 'Chocolate Frozen Yogurt, Banana, Chocolate Chips, Cookie Crumble, Granola, Hazelnuts'])) ?></p>
									</div>
								</div>
							</div>
							
							<div class="swiper-slide">
								<div class="yogurt-preview yogurt-id-2 ">
									<div class="image-yogurt-info" style="background:url(https://yoji.com.tr/wp-content/uploads/2025/06/favori2.png)"></div>
									<div class="circle-yogurt-info">
										<h4 class="circle-yogurt-info-name"><?= yj_h($yj_t(['tr' => 'Açaí', 'en' => 'The Açaí'])) ?></h4>
										<p class="circle-yogurt-info-description"><?= yj_h($yj_t(['tr' => 'Açaí, Çilek, Yaban Mersini, Ahududu, Granola, Çilek Sosu', 'en' => 'Açaí, Strawberry, Blueberries, Raspberries, Granola, Strawberry Sauce'])) ?></p>
									</div>
								</div>
							</div>
															</div>
			</div>
			<div data-wpr-lazyrender="1" class="wave pink"></div>
			
		</section>
	
			<section  class="info-home-section">
							<div  class="wrapper">
					<div  class="grid-box row-2">
						<div class="row">
							<div class="grid-box row-3 indent">
																	<div class="row no-animate" data-aos="fade-up" data-aos-delay="200" data-aos-duration="600" data-aos-once="true">
										<i class="icon-info-home" style="background: url(https://yoji.com.tr/wp-content/uploads/2022/04/anasayfa-icon-01.png);"></i>
										<h4 class="text-info-home"><?= yj_h($yj_t(['tr' => 'Taze Meyve', 'en' => 'Fresh Fruit'])) ?></h4>
									</div>
																	<div class="row no-animate" data-aos="fade-up" data-aos-delay="400" data-aos-duration="600" data-aos-once="true">
										<i class="icon-info-home" style="background: url(https://yoji.com.tr/wp-content/uploads/2022/04/anasayfa-icon-02.png);"></i>
										<h4 class="text-info-home"><?= $yj_t(['tr' => 'Çıtır<br>Toppingler', 'en' => 'Crunchy<br>Toppings']) ?></h4>
									</div>
																	<div class="row no-animate" data-aos="fade-up" data-aos-delay="600" data-aos-duration="600" data-aos-once="true">
										<i class="icon-info-home" style="background: url(https://yoji.com.tr/wp-content/uploads/2022/04/anasayfa-icon-03.png);"></i>
										<h4 class="text-info-home"><?= $yj_t(['tr' => 'Leziz<br>Soslar', 'en' => 'Delicious<br>Sauces']) ?></h4>
									</div>
																	<div class="row no-animate" data-aos="fade-up" data-aos-delay="800" data-aos-duration="600" data-aos-once="true">
										<i class="icon-info-home" style="background: url(https://yoji.com.tr/wp-content/uploads/2022/04/anasayfa-icon-04.png);"></i>
										<h4 class="text-info-home"><?= yj_h($yj_t(['tr' => 'Kendine Göre Yap', 'en' => 'Make It Yours'])) ?></h4>
									</div>
																	<div class="row no-animate" data-aos="fade-up" data-aos-delay="1000" data-aos-duration="600" data-aos-once="true">
										<i class="icon-info-home" style="background: url(https://yoji.com.tr/wp-content/uploads/2022/04/anasayfa-icon-05.png);"></i>
										<h4 class="text-info-home"><?= $yj_t(['tr' => 'Her Seferinde<br>Farklı', 'en' => 'Different<br>Every Time']) ?></h4>
									</div>
																	<div class="row no-animate" data-aos="fade-up" data-aos-delay="1200" data-aos-duration="600" data-aos-once="true">
										<i class="icon-info-home" style="background: url(https://yoji.com.tr/wp-content/uploads/2022/04/anasayfa-icon-06.png);"></i>
										<h4 class="text-info-home"><?= $yj_t(['tr' => 'Yoji.<br>Hayatın Tadı.', 'en' => 'Yoji.<br>Taste of Life.']) ?></h4>
									</div>
															</div>
						</div>
						<div class="row no-pointer">
							<div class="yj-fav-product">
					<img src="/wp-content/uploads/revize/happier-days.png" alt="<?= yj_h($yj_t(['tr' => 'İyi Dondurulmuş Yoğurt, Mutlu Günler', 'en' => 'Good Frozen Yogurt, Happier Days'])) ?>" class="yj-happier-days">
					<img src="/wp-content/uploads/revize/fav-cup.png" alt="Yo-Ji" class="info-home-image">
				</div>
						</div>
					</div>
				</div>
					</section>
	



<?php
include 'footer.php';
?>