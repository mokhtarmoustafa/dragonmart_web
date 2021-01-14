<!DOCTYPE html>
<html dir="ltr" lang="en-US">

<head>

	<meta http-equiv="content-type" content="text/html; charset=utf-8" />
	<meta name="author" content="SemiColonWeb" />



	<meta name="viewport" content="width=device-width, initial-scale=1" />



	<!-- Document Title
	============================================= -->

	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0" />
	<?php echo $__env->make(site_layout_vw().'.css', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>


	<title>Dragon Mart</title>
	<script src="https://unpkg.com/eva-icons"></script>

</head>

<body class="stretched">

	<!-- Document Wrapper
	============================================= -->
	<div id="wrapper" class="clearfix">

		<!-- Header
		============================================= -->
		<header id="header" class="transparent-header dark" data-sticky-class="not-dark"
			data-responsive-class="not-dark" data-sticky-logo-height="55" data-sticky-menu-padding="29">
			<div id="header-wrap">
				<div class="container">
					<div class="header-row justify-content-lg-between">

						<!-- Logo ============================================= -->
						<div id="logo" class="col-auto order-lg-2 mr-lg-0 px-0">
							<a href="home" class="standard-logo"
								data-dark-logo="<?php echo e(url('/assets')); ?>/site/app-landing/images/logo-dark.png"><img
									src="<?php echo e(url('/assets')); ?>/site/app-landing/images/logo.png" alt="Canvas Logo"></a>
						</div>
						<!-- #logo end -->

						<!-- Primary Navigation
						============================================= -->
						<nav class="primary-menu with-arrows not-dark col-lg-5 order-lg-1 px-0">

							<ul class="menu-container one-page-menu" data-easing="easeInOutExpo" data-speed="1250"
								data-offset="160">
								<li class="menu-item">
									<a href="#" class="social-icon si-borderless si-twitter" title="Twitter">
										<i class="icon-twitter icon-2x"></i>
										<i class="icon-twitter icon-2x"></i>
									</a>
								</li>
								<li class="menu-item">
									<a href="#" class="social-icon si-borderless si-snapchat" title="Snapchat">
										<i class="icon-snapchat-ghost icon-2x"></i>
										<i class="icon-snapchat-ghost icon-2x"></i>
									</a>
								</li>
								<li class="menu-item">
									<a href="#" class="social-icon si-borderless si-instagram" title="Instagram">
										<i class="icon-instagram icon-2x"></i>
										<i class="icon-instagram icon-2x"></i>
									</a>
								</li>
							</ul>

						</nav>
					</div>
				</div>
			</div>
			<div class="header-wrap-clone"></div>
		</header><!-- #header end -->

		<section id="slider" class="slider-element slider-parallax min-vh-60 min-vh-md-100 include-header vh-100">
			<div class="slider-inner"
				style="background: url('<?php echo e(url('/assets')); ?>/site/css/home/02@3x.jpg') center center no-repeat; background-size: cover;">

				<div class="vertical-middle slider-element-fade">
					<div class="container dark py-5 py-md-0">
						<div class="d-flex justify-content-center">
							<div class="col-md-auto">
								<div class="row justify-content-md-center"><img class="image-logo"
										src="<?php echo e(url('/assets')); ?>/site/app-landing/images/dm-logo.png" alt="DM Logo">
								</div>
								<div class="col-sm-12 text-center">
									<h1 class="name">دراغون مارت</h1>
									<p class="sub_title">تطبيق الكتروني متخصص لتسويق و توصيل المنتجات و الخدمات</p>
								</div>

							</div>
						</div>
						<div class="d-flex justify-content-center">
							<div class="col-md-auto">
								<div class="arrow_container">
									<span class="circle">
										<i class="fa fa-arrow-down"></i>
									</span>
									
								</div>
							</div>
						</div>

					</div>
				</div>

			</div>
		</section>

		<!-- Content
		============================================= -->
		<section id="content">
			<div class="content-wrap" style="padding: 0;">

				<div class="page-section section p-0 topmargin-sm app_download" style="margin-top: 0 !important;"
					data-height-xl="600" data-height-lg="600">
					<div class="container clearfix">
						<div class="row clearfix">

							<div class="col-lg-7" style="margin-top: 100px;">

								<div class="emphasis-title bottommargin-sm">
									<h2 class="font-body ls1 font-weight-normal"><strong>تطبيق الجوال</strong></h2>
								</div>
								<p>حمل تطبيق دراغون مارت وطلباتك واصلة لبيتك</p>

								<div class="row">
									<div class="col-lg-6 center">
										<a href="https://play.google.com/store/apps/details?id=com.saudidragonmart.app" target="_blank"><img
												src="<?php echo e(url('/assets')); ?>/site/app-landing/images/app_download/group-1.png"
												alt="NextGen Framework" data-animate="fadeInRight"></a>
									</div>
									<div class="col-lg-6 center">
										<a href="https://apps.apple.com/sa/app/dragon-mart/id1523014369" target="_blank"><img
												src="<?php echo e(url('/assets')); ?>/site/app-landing/images/app_download/group-2.png"
												alt="NextGen Framework" data-animate="fadeInRight"></a>
									</div>
								</div>
							</div>
							<div class="col-lg-5 row screenshot_container">
								<div class="screenshot2">
									<img src="<?php echo e(url('/assets')); ?>/site/app-landing/images/app_download/layer-3.png"
										alt="NextGen Framework">
								</div>
								<div class="screenshot1">
									<img src="<?php echo e(url('/assets')); ?>/site/app-landing/images/app_download/layer-2.png"
										alt="NextGen Framework">
								</div>
							</div>

						</div>
					</div>
				</div>



				<div class="container clearfix">

					<div id="section-nextgen" class="page-section bottommargin-lg">
						<div class="row clearfix">

							<div class="col-lg-7 about-us">
								<div class="topmargin-lg d-none d-lg-block"></div>
								<div class="title">
									<img src="<?php echo e(url('/assets')); ?>/site/app-landing/images/about_us/about_us.png"
										alt="NextGen Framework">
								</div>
								<p>دراغون مارت هو تطبيق إلكتروني لتسويق و
									توصيل المنتجات و الخدمات من السوق المحلي (المتاجر المشاركة) إلى المستهلك
									المحلي ( تكون هذه المتاجر في نفس المنطقة الجغرافية للمستهلك ) كما يشمل
									تسويق و توصيل المنتجات من المتاجر مفتوحة التوصيل إلى أي مكان و يكون
									برسوم محددة.</p>
							</div>

							<div class="col-lg-5 center">
								<img src="<?php echo e(url('/assets')); ?>/site/app-landing/images/section/iphone-watch.png"
									alt="NextGen Framework" data-animate="fadeInLeft">
							</div>

						</div>
					</div>

					<div class="line"></div>

					<div id="section-stunning-graphics" class="page-section topmargin bottommargin-lg">
						<div class="row clearfix">

							<div class="col-lg-5 about-us">
								<div class="topmargin-lg d-none d-lg-block"></div>
								<div class="emphasis-title bottommargin-sm">
									<h2 class="font-body ls1 font-weight-normal"><strong>المميزات</strong></h2>
								</div>
								<p style="color: #777;" class="lead">Lorem ipsum dolor sit amet, consectetur adipisicing
									elit. Praesentium, vel! Eius pariatur nemo expedita.</p>
								<a href="#" class="section-more-link">Learn More <i class="icon-angle-right"></i></a>
							</div>

							<div class="col-lg-7 center">
								<img src="<?php echo e(url('/assets')); ?>/site/app-landing/images/section/iphone-nexus.png"
									alt="Stunning Graphics" data-animate="fadeInLeft">
							</div>

						</div>
					</div>

					<div class="line"></div>
					<div class="clear"></div>

				</div>

				<div class="clear bottommargin"></div>

				<div class="container clearfix">

					<div class="section-signup p-0 m-0">
						<div class="row col-mb-30 mb-5">
							<div class="col-lg-4 col-md-6 text-center signup-box driver">
								<img src="<?php echo e(url('/assets')); ?>/site/app-landing/images/signup/driver.png" alt="">
								<div class="line"></div>
								<a href="#modal-get-started" class="btn btn-danger">التسجيل كسائق</a>
							</div>

							<div class="col-lg-4 col-md-6 text-center signup-box store">
								<img src="<?php echo e(url('/assets')); ?>/site/app-landing/images/signup/store.png" alt="">
								<div class="line"></div>
								<a href="#modal-get-started" class="btn btn-warning">التسجيل كتاجر</a>
							</div>

							<div class="col-lg-4 col-md-6 text-center signup-box client">
								<img src="<?php echo e(url('/assets')); ?>/site/app-landing/images/signup/client.png" alt="">
								<div class="line"></div>
								<a href="#modal-get-started" class="btn">التسجيل كعميل</a>
							</div>
						</div>

					</div>

					<div class="clear"></div>

					<div id="section-faqs" class="page-section p-0 m-0">

						<h2 class="center font-body bottommargin-lg">Frequently Asked Questions</h2>

						<div class="row topmargin-sm clearfix">

							<div class="col-lg-5 offset-lg-1 col-md-6 bottommargin-sm">
								<h4 class="font-body" style="margin-bottom:15px;">How do I become an author?</h4>
								<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Assumenda, dolorum, vero
									ipsum molestiae minima odio quo voluptate illum excepturi quam cum voluptates
									doloribus quae nisi.</p>
							</div>
							<div class="col-lg-5 col-md-6 bottommargin-sm">
								<h4 class="font-body" style="margin-bottom:15px;">Helpful Resources for Authors</h4>
								<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Explicabo, placeat,
									architecto rem dolorem dignissimos repellat veritatis in et eos doloribus magnam
									aliquam ipsa alias assumenda officiis quasi sapiente suscipit.</p>
							</div>
							<div class="col-lg-5 offset-lg-1 col-md-6 bottommargin-sm">
								<h4 class="font-body" style="margin-bottom:15px;">How much money can I make?</h4>
								<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Possimus, fugiat iste nisi
									tempore nesciunt nemo fuga? Nesciunt, delectus laboriosam nisi repudiandae nam fuga
									saepe animi recusandae.</p>
							</div>
							<div class="col-lg-5 col-md-6 bottommargin-sm">
								<h4 class="font-body" style="margin-bottom:15px;">Can I offer my items for free on a
									promotional basis?</h4>
								<p>Laboriosam iusto quia nulla ad voluptatibus iste beatae voluptas corrupti facilis
									accusamus recusandae sequi debitis reprehenderit quibusdam. Facilis eligendi a
									exercitationem nisi et placeat excepturi velit!</p>
							</div>
							<div class="col-lg-5 offset-lg-1 col-md-6 bottommargin-sm">
								<h4 class="font-body" style="margin-bottom:15px;">An Introduction to the Marketplaces
									for Authors</h4>
								<p>Quisquam atque vero delectus corrupti! Quo, maiores, dolorem, hic commodi nulla
									ratione accusamus doloribus fuga magnam id temporibus dignissimos deleniti quidem
									ipsam corporis sapiente nam expedita saepe quas ab? Vero, assumenda.</p>
							</div>
							<div class="col-lg-5 col-md-6">
								<h4 class="font-body" style="margin-bottom:15px;">How does the Tuts+ Premium affiliate
									program work?</h4>
								<p class="mb-0">Reprehenderit similique nemo voluptate ullam natus illum magnam alias
									nobis doloremque delectus ipsa dicta repellat maxime dignissimos eveniet quae
									debitis ratione assumenda tempore officiis fugiat dolor.</p>
							</div>

						</div>

					</div>

				</div>

				<div class="section bottommargin-lg"
					style="background-color: #F8FAFB; border-top: 1px solid #E5E5E5; border-bottom: 1px solid #E5E5E5;">

					<div class="fslider testimonial testimonial-full bg-transparent border-0 shadow-none"
						data-animation="fade" style="max-width: none;">
						<div class="flexslider">
							<div class="slider-wrap mx-auto" style="max-width: 650px;">
								<div class="slide">
									<div class="testi-image">
										<a href="#"><img src="images/testimonials/3.jpg"
												alt="Customer Testimonails"></a>
									</div>
									<div class="testi-content">
										<p>Similique fugit repellendus expedita excepturi iure provident quia eaque.
											Repellendus, vero numquam?</p>
										<div class="testi-meta">
											Steve Jobs
											<span>Apple Inc.</span>
										</div>
									</div>
								</div>
								<div class="slide">
									<div class="testi-image">
										<a href="#"><img src="images/testimonials/2.jpg"
												alt="Customer Testimonails"></a>
									</div>
									<div class="testi-content">
										<p>Natus voluptatum enim quod necessitatibus quis expedita harum provident eos
											obcaecati id culpa corporis molestias.</p>
										<div class="testi-meta">
											Collis Ta'eed
											<span>Envato Inc.</span>
										</div>
									</div>
								</div>
								<div class="slide">
									<div class="testi-image">
										<a href="#"><img src="images/testimonials/1.jpg"
												alt="Customer Testimonails"></a>
									</div>
									<div class="testi-content">
										<p>Incidunt deleniti blanditiis quas aperiam recusandae consequatur ullam
											quibusdam cum libero illo rerum!</p>
										<div class="testi-meta">
											John Doe
											<span>XYZ Inc.</span>
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>

				</div>

				<div class="clear"></div>

				<div id="section-gallery" class="page-section p-0 m-0">

					<div class="container topmargin bottommargin-lg center clearfix">

						<h3 class="ls1 font-weight-normal" style="font-size: 32px; margin-bottom: 10px;">App Screenshots
						</h3>
						<p class="lead mx-auto" style="max-width: 600px">Lorem ipsum dolor sit amet, consectetur
							adipisicing elit. Id, repellendus quae fuga ad, beatae odit.</p>
						<a href="#" class="button button-circle text-capitalize">Check All</a>

					</div>

					<div class="owl-carousel owl-carousel-full image-carousel carousel-widget bottommargin"
						data-margin="20" data-center="true" data-loop="true" data-nav="false" data-pagi="true"
						data-items-xs="2" data-items-sm="2" data-items-md="4" data-items-lg="4" data-items-xl="6"
						data-stage-padding="30" data-lightbox="gallery">

						<div class="oc-item">
							<a data-lightbox="gallery-item" href="app-landing/images/gallery/img-1.jpg"><img
									src="app-landing/images/gallery/img-1.jpg" alt="Image 1"></a>
						</div>
						<div class="oc-item">
							<a data-lightbox="gallery-item" href="app-landing/images/gallery/img-2.jpg"><img
									src="app-landing/images/gallery/img-2.jpg" alt="Image 2"></a>
						</div>
						<div class="oc-item">
							<a data-lightbox="gallery-item" href="app-landing/images/gallery/img-3.jpg"><img
									src="app-landing/images/gallery/img-3.jpg" alt="Image 3"></a>
						</div>
						<div class="oc-item">
							<a data-lightbox="gallery-item" href="app-landing/images/gallery/img-4.jpg"><img
									src="app-landing/images/gallery/img-4.jpg" alt="Image 4"></a>
						</div>
						<div class="oc-item">
							<a data-lightbox="gallery-item" href="app-landing/images/gallery/img-5.jpg"><img
									src="app-landing/images/gallery/img-5.jpg" alt="Image 5"></a>
						</div>
						<div class="oc-item">
							<a data-lightbox="gallery-item" href="app-landing/images/gallery/img-6.jpg"><img
									src="app-landing/images/gallery/img-6.jpg" alt="Image 5"></a>
						</div>
						<div class="oc-item">
							<a data-lightbox="gallery-item" href="app-landing/images/gallery/img-7.jpg"><img
									src="app-landing/images/gallery/img-7.jpg" alt="Image 5"></a>
						</div>

					</div>

				</div>

				<div class="clear"></div>

				<!-- <div class="section m-0">
					<div class="container clearfix">

						<h2></h2>

					</div>
				</div> -->

				<div class="section"
					style="padding: 30px 0; color: #999; background-color: #F8FAFB; border-top: 1px solid #E5E5E5; border-bottom: 1px solid #E5E5E5;">
					<div class="container clearfix">
						<div class="row topmargin-lg clearfix">

							<div class="col-lg-4 bottommargin">
								<i class="i-plain i-large icon-et-browser inline-block"
									style="margin-bottom: 30px; color: #999;"></i>
								<div class="heading-block border-bottom-0" style="margin-bottom: 15px;">
									<h4 style="font-size: 16px;">Cross Browser</h4>
								</div>
								<p style="line-height: 26px;">Canvas 4 Loads Faster &amp; Smoother than the Previous
									Versions providing an Optimal Experience for your Users.</p>
							</div>

							<div class="col-lg-4 bottommargin">
								<i class="i-plain i-large icon-et-adjustments inline-block"
									style="margin-bottom: 30px; color: #999;"></i>
								<div class="heading-block border-bottom-0" style="margin-bottom: 15px;">
									<h4 style="font-size: 16px;">Flexible Options</h4>
								</div>
								<p style="line-height: 26px;">Unleash the Power of Mega Menus by adding Widgets &amp;
									Mixed Columns powered by the Bootstrap Grid.</p>
							</div>

							<div class="col-lg-4 bottommargin">
								<i class="i-plain i-large icon-et-calendar inline-block"
									style="margin-bottom: 30px; color: #999;"></i>
								<div class="heading-block border-bottom-0" style="margin-bottom: 15px;">
									<h4 style="font-size: 16px;">Scheduled Backups</h4>
								</div>
								<p style="line-height: 26px;">Amazing set of New Components giving you Opportunity to
									Create an Interactive Website for your Business.</p>
							</div>

							<div class="col-lg-4 bottommargin">
								<i class="i-plain i-large icon-et-desktop inline-block"
									style="margin-bottom: 30px; color: #999;"></i>
								<div class="heading-block border-bottom-0" style="margin-bottom: 15px;">
									<h4 style="font-size: 16px;">Responsive Ready</h4>
								</div>
								<p style="line-height: 26px;">Convert any Grid to an Isotope Grid easily with Filterable
									Options making it extremely flexible and powerful.</p>
							</div>

							<div class="col-lg-4 bottommargin">
								<i class="i-plain i-large icon-et-bargraph inline-block"
									style="margin-bottom: 30px; color: #999;"></i>
								<div class="heading-block border-bottom-0" style="margin-bottom: 15px;">
									<h4 style="font-size: 16px;">Increased Conversions</h4>
								</div>
								<p style="line-height: 26px;">Display an Alternate Lighter Menu on Responsive Devices
									with the same Markup Code as before. Awesomely Useful.</p>
							</div>

							<div class="col-lg-4 bottommargin">
								<i class="i-plain i-large icon-et-cloud inline-block"
									style="margin-bottom: 30px; color: #999;"></i>
								<div class="heading-block border-bottom-0" style="margin-bottom: 15px;">
									<h4 style="font-size: 16px;">Cloud Sharing</h4>
								</div>
								<p style="line-height: 26px;">Added SPAM Protection for your Precious Forms so that you
									receive Emails only from Authentic Real Users.</p>
							</div>

						</div>
					</div>
				</div>

				<div class="section center mb-0 bg-transparent">
					<div class="container clearfix">

						<h3 class="ls1 font-weight-normal" style="font-size: 32px;">Experienced &amp; Trusted by
							<span>50,000+</span> People worldwide</h3>
						<a href="#modal-login" data-lightbox="inline"
							class="button button-large button-black text-capitalize" style="border-radius: 23px;">Login
							Now</a>
						<a href="#" data-scrollto="#section-pricing" data-easing="easeInOutExpo" data-speed="1250"
							data-offset="160" class="button button-large text-capitalize"
							style="border-radius: 23px;">Try it Free</a>

						<div class="clear bottommargin"></div>

					</div>
				</div>

				<div class="section mt-0 footer-stick"
					style="padding: 10px 0; background-color: #F8FAFB; border-top: 1px solid #E5E5E5;">
					<div class="container clearfix">

						<div class="row clearfix">
							<div class="col-lg-4">
								<div class="app-footer-features"><i class="icon-line2-globe-alt"></i>
									<h5 class="font-body"><a href="#">Free Training</a><span> &amp; 24-hour
											coverage</span></h5>
								</div>
							</div>
							<div class="col-lg-4">
								<div class="app-footer-features"><i class="icon-line2-notebook"></i>
									<h5 class="font-body"><a href="#">99.99% Uptime</a><span> the last 12 months</span>
									</h5>
								</div>
							</div>
							<div class="col-lg-4">
								<div class="app-footer-features"><i class="icon-line2-lock"></i>
									<h5 class="font-body"><span>Serious about</span> <a href="#">Security</a>
										<span>&amp;</span> <a href="#">Privacy</a></h5>
								</div>
							</div>
						</div>

					</div>
				</div>
			</div>
		</section><!-- #content end -->

		<!-- Footer
		============================================= -->
		<footer id="footer" style="background-color: #FFF;">

			<div class="container">

				<!-- Footer Widgets
				============================================= -->
				<div class="footer-widgets-wrap">
					<div class="row clearfix">

						<div class="col-lg-5">

							<div class="widget clearfix">
								<div class="row clearfix">
									<div class="col-lg-8 bottommargin-sm clearfix" style="color:#888;">
										<img src="app-landing/images/footer-logo.png" alt="Canvas Logo"
											style="display: block;" class="bottommargin-sm">
										<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Odio, consequatur
											facere molestiae iusto atque.</p>

										<a href="#"
											class="social-icon si-small si-borderless si-colored si-rounded si-facebook">
											<i class="icon-facebook"></i>
											<i class="icon-facebook"></i>
										</a>

										<a href="#"
											class="social-icon si-small si-borderless si-colored si-rounded si-twitter">
											<i class="icon-twitter"></i>
											<i class="icon-twitter"></i>
										</a>

										<a href="#"
											class="social-icon si-small si-borderless si-colored si-rounded si-gplus">
											<i class="icon-gplus"></i>
											<i class="icon-gplus"></i>
										</a>

										<a href="#"
											class="social-icon si-small si-borderless si-colored si-rounded si-pinterest">
											<i class="icon-pinterest"></i>
											<i class="icon-pinterest"></i>
										</a>

										<a href="#"
											class="social-icon si-small si-borderless si-colored si-rounded si-vimeo">
											<i class="icon-vimeo"></i>
											<i class="icon-vimeo"></i>
										</a>

									</div>
								</div>
							</div>

						</div>

						<div class="col-lg-7">
							<div class="row col-mb-30">

								<div class="col-lg-4">
									<div class="widget widget_links widget-li-noicon app_landing_widget_link clearfix">
										<h4>In News</h4>

										<ul>
											<li><a href="https://codex.wordpress.org/">Documentation</a></li>
											<li><a
													href="https://wordpress.org/support/forum/requests-and-feedback">Feedback</a>
											</li>
											<li><a href="https://wordpress.org/extend/plugins/">Plugins</a></li>
											<li><a href="https://wordpress.org/support/">Support Forums</a></li>
											<li><a href="https://wordpress.org/extend/themes/">Themes</a></li>
										</ul>
									</div>
								</div>
								<div class="col-lg-4">
									<div class="widget widget_links widget-li-noicon app_landing_widget_link clearfix">
										<h4>About Us</h4>

										<ul>
											<li><a href="https://codex.wordpress.org/">Documentation</a></li>
											<li><a
													href="https://wordpress.org/support/forum/requests-and-feedback">Feedback</a>
											</li>
											<li><a href="https://wordpress.org/extend/plugins/">Plugins</a></li>
											<li><a href="https://wordpress.org/support/">Support Forums</a></li>
											<li><a href="https://wordpress.org/extend/themes/">Themes</a></li>
										</ul>
									</div>
								</div>
								<div class="col-lg-4">
									<div class="widget widget_links widget-li-noicon app_landing_widget_link clearfix">
										<h4>Support</h4>

										<ul>
											<li><a href="https://codex.wordpress.org/">Documentation</a></li>
											<li><a
													href="https://wordpress.org/support/forum/requests-and-feedback">Feedback</a>
											</li>
											<li><a href="https://wordpress.org/extend/plugins/">Plugins</a></li>
											<li><a href="https://wordpress.org/support/">Support Forums</a></li>
											<li><a href="https://wordpress.org/extend/themes/">Themes</a></li>
										</ul>
									</div>
								</div>

							</div>
						</div>

					</div>
				</div>

			</div>

			<!-- Copyrights
			============================================= -->
			<div id="copyrights" class="bg-transparent pt-0">
				<div class="container clearfix">

					<div class="w-100 text-center text-md-left">
						Copyrights &copy; 2020 All Rights Reserved by Canvas Inc.<br>
						<div class="copyright-links"><a href="#">Terms of Use</a> / <a href="#">Privacy Policy</a></div>
					</div>

				</div>
			</div><!-- #copyrights end -->

		</footer><!-- #footer end -->

	</div><!-- #wrapper end -->

	<!-- Go To Top
	============================================= -->
	<div id="gotoTop" class="icon-angle-up"></div>

	<!-- JavaScripts
	============================================= -->
	<script src="<?php echo e(url('/assets')); ?>/site/js/home/jquery.js"></script>
	<script src="<?php echo e(url('/assets')); ?>/site/js/home/plugins.min.js"></script>

	<!-- Footer Scripts
	============================================= -->
	<script src="<?php echo e(url('/assets')); ?>/site/js/home/functions.js"></script>

	<script>
		jQuery(document).ready(function($) {
			$('[data-pricing-plan]').click(function() {
				$('#get-started-form').find('#get-started-form-package').val($(this).attr('data-pricing-plan'));
				$('#get-started-form').find('#modal-get-started-package').html($(this).attr('data-pricing-plan'));
			});
		});
	</script>

</body>

</html><?php /**PATH C:\xampp\htdocs\dragon_mart_web\resources\views/site/home.blade.php ENDPATH**/ ?>