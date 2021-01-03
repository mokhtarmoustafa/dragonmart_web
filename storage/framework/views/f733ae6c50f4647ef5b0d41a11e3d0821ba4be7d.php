<!-- <link href="<?php echo e(url('/assets')); ?>/site/css/bootstrap.min.css" rel="stylesheet" type="text/css">
<link href="<?php echo e(url('/assets')); ?>/site/css/owl.carousel.min.css" rel="stylesheet" type="text/css">
<link href="<?php echo e(url('/assets')); ?>/site/css/font-awesome.min.css" rel="stylesheet" type="text/css">
<link href="<?php echo e(url('/assets')); ?>/site/css/animate.min.css" rel="stylesheet">
<link href="<?php echo e(url('/assets')); ?>/site/css/magnific-popup.min.css" rel="stylesheet">
<link href="<?php echo e(url('/assets')); ?>/site/css/jquery-ui.min.css" rel="stylesheet">
<link href="<?php echo e(url('/assets')); ?>/site/css/jquery.scrollbar.css" rel="stylesheet">
<link href="<?php echo e(url('/assets')); ?>/site/css/chosen.min.css" rel="stylesheet">
<link href="<?php echo e(url('/assets')); ?>/site/css/jquery.mCustomScrollbar.css" rel="stylesheet">
<link href="<?php echo e(url('/assets')); ?>/site/css/ovic-mobile-menu.css" rel="stylesheet">
<link href="<?php echo e(url('/assets')); ?>/site/css/jquery.datetimepicker.min.css" rel="stylesheet">
<link href="<?php echo e(url('/assets')); ?>/site/css/style.css" rel="stylesheet">
<link href="<?php echo e(url('/assets')); ?>/site/css/customs-css.css" rel="stylesheet"> -->


<!-- Favicon Icon -->
<link rel="shortcut icon" type="image/x-icon" href="assets/images/favicon.png">
<!-- Animation CSS -->
<link rel="stylesheet" href="<?php echo e(url('/assets')); ?>/site//css/animate.css">
<!-- Latest Bootstrap min CSS -->
<!-- <link rel="stylesheet" href="<?php echo e(url('/assets')); ?>/site//bootstrap/css/bootstrap.min.css"> -->


<!-- Google Font -->
<link href="https://fonts.googleapis.com/css?family=Roboto:100,300,400,500,700,900&display=swap" rel="stylesheet">
<link href="https://fonts.googleapis.com/css?family=Poppins:200,300,400,500,600,700,800,900&display=swap" rel="stylesheet">
<!-- Icon Font CSS -->
<link rel="stylesheet" href="<?php echo e(url('/assets')); ?>/site/css/all.min.css">
<link rel="stylesheet" href="<?php echo e(url('/assets')); ?>/site/css/ionicons.min.css">
<link rel="stylesheet" href="<?php echo e(url('/assets')); ?>/site/css/themify-icons.css">
<link rel="stylesheet" href="<?php echo e(url('/assets')); ?>/site/css/linearicons.css">
<link rel="stylesheet" href="<?php echo e(url('/assets')); ?>/site/css/flaticon.css">
<link rel="stylesheet" href="<?php echo e(url('/assets')); ?>/site/css/simple-line-icons.css">
<!--- owl carousel CSS-->
<link rel="stylesheet" href="<?php echo e(url('/assets')); ?>/site/owlcarousel/css/owl.carousel.min.css">
<link rel="stylesheet" href="<?php echo e(url('/assets')); ?>/site/owlcarousel/css/owl.theme.css">
<link rel="stylesheet" href="<?php echo e(url('/assets')); ?>/site/owlcarousel/css/owl.theme.default.min.css">
<!-- Magnific Popup CSS -->
<link rel="stylesheet" href="<?php echo e(url('/assets')); ?>/site/css/magnific-popup.css">
<!-- Slick CSS -->
<link rel="stylesheet" href="<?php echo e(url('/assets')); ?>/site/css/slick.css">
<link rel="stylesheet" href="<?php echo e(url('/assets')); ?>/site/css/slick-theme.css">
<!-- Style CSS -->
<link rel="stylesheet" href="<?php echo e(url('/assets')); ?>/site/css/style.css">
<link rel="stylesheet" href="<?php echo e(url('/assets')); ?>/site/css/responsive.css">
<!-- RTL CSS -->
<link rel="stylesheet" href="<?php echo e(url('/assets')); ?>/site/css/eva-icons.css">
<link href="<?php echo e(url('/')); ?>/V2/assets/css/style.bundle.rtl.css" rel="stylesheet" type="text/css">

<!-- Stylesheets
	============================================= -->
	<link href="https://fonts.googleapis.com/css?family=Poppins:300,400,400i,600,700|Montserrat:400,700|Merriweather&display=swap" rel="stylesheet" type="text/css" />
	<link rel="stylesheet" href="<?php echo e(url('/assets')); ?>/site/css/home/bootstrap-rtl.css" type="text/css" />
	<link rel="stylesheet" href="<?php echo e(url('/assets')); ?>/site/css/home/style.css" type="text/css" />
	<link rel="stylesheet" href="<?php echo e(url('/assets')); ?>/site/css/home/dark.css" type="text/css" />

	<!-- Media Agency Demo Specific Stylesheet -->
	<link rel="stylesheet" href="<?php echo e(url('/assets')); ?>/site/css/home/app-landing.css" type="text/css" />
	<!-- / -->

	<link rel="stylesheet" href="<?php echo e(url('/assets')); ?>/site/css/home/font-icons.css" type="text/css" />
	<link rel="stylesheet" href="<?php echo e(url('/assets')); ?>/site/css/home/css/et-line.css" type="text/css" />
	<link rel="stylesheet" href="<?php echo e(url('/assets')); ?>/site/css/home/animate.css" type="text/css" />
	<link rel="stylesheet" href="<?php echo e(url('/assets')); ?>/site/css/home/magnific-popup.css" type="text/css" />

	<link rel="stylesheet" href="<?php echo e(url('/assets')); ?>/site/css/home/fonts.css" type="text/css" />

	<!-- Bootstrap Switch CSS -->
	<link rel="stylesheet" href="<?php echo e(url('/assets')); ?>/site/css/home/bs-switches.css" type="text/css" />
	<link rel="stylesheet" href="<?php echo e(url('/assets')); ?>/site/css/home/colors.php?color=267DF4" type="text/css" />
	<link rel="stylesheet" href="<?php echo e(url('/assets')); ?>/site/css/home/custom.css" type="text/css" />


<?php if(session()->has('lang') && session()->get('lang') == 'ar'): ?>

    <link href="https://fonts.googleapis.com/css?family=Cairo:200,300,400,600,700,900&display=swap&subset=arabic"
          rel="stylesheet">

<?php else: ?>
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i,800,800i"
          rel="stylesheet">
<?php endif; ?>
<?php if(session()->has('lang') && session()->get('lang') == 'ar'): ?>
    <link href="<?php echo e(url('assets/site/css/rtl.css')); ?>" rel="stylesheet">
<?php endif; ?>

<?php echo $__env->yieldPushContent('css'); ?>
<?php /**PATH C:\xampp\htdocs\dragon_mart_web\resources\views/site/layout/css.blade.php ENDPATH**/ ?>