<!DOCTYPE html>
<html lang="ar" style="direction: rtl;" direction="rtl">

<!--begin::Head-->

<head>
	<base href="">
	<meta charset="utf-8" />
	<title>Dragon Mart | Dashboard</title>
	<meta name="description" content="Dragon Mart | Dashboard" />
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
	<meta content="<?php echo e(csrf_token()); ?>" name="csrf-token" />
	<!--begin::Fonts-->
	<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Poppins:300,400,500,600,700" />
	<link href="<?php echo e(url('/V2')); ?>/assets/css/fonts/Expo.css" rel="stylesheet" type="text/css" />

	<!--end::Fonts-->


	<!-- <link href="<?php echo e(url('/V2')); ?>/assets/plugins/custom/datatables/datatables.bundle.css" rel="stylesheet" type="text/css" /> -->
	<link href="<?php echo e(url('/')); ?>/V2/assets/plugins/custom/datatables/datatables.bundle.rtl.css" rel="stylesheet" type="text/css">


	<!--begin::Page Vendors Styles(used by this page)-->

	<?php echo $__env->yieldContent('css'); ?>

	<!--end::Page Vendors Styles-->

	<!--begin::Global Theme Styles(used by all pages)-->
	<link href="<?php echo e(url('/V2')); ?>/assets/plugins/global/plugins.bundle.css" rel="stylesheet" type="text/css" />
	<link href="<?php echo e(url('/V2')); ?>/assets/plugins/custom/prismjs/prismjs.bundle.css" rel="stylesheet" type="text/css" />
	<link href="<?php echo e(url('/V2')); ?>/assets/css/style.bundle.rtl.css" rel="stylesheet" type="text/css" />

	<!--end::Global Theme Styles-->

	<!--begin::Layout Themes(used by all pages)-->
	<link href="<?php echo e(url('/V2')); ?>/assets/css/themes/layout/header/base/light.css" rel="stylesheet" type="text/css" />
	<link href="<?php echo e(url('/V2')); ?>/assets/css/themes/layout/header/menu/light.css" rel="stylesheet" type="text/css" />
	<link href="<?php echo e(url('/V2')); ?>/assets/css/themes/layout/brand/dark.css" rel="stylesheet" type="text/css" />
	<link href="<?php echo e(url('/V2')); ?>/assets/css/themes/layout/aside/dark.css" rel="stylesheet" type="text/css" />

	<!--end::Layout Themes-->
	<link rel="shortcut icon" href="<?php echo e(url('/V2')); ?>/assets/media/logos/favicon.ico" />
</head>

<!--end::Head-->

<!--begin::Body-->

<body id="kt_body" class="page-loading-enabled page-loading header-fixed header-mobile-fixed  aside-enabled aside-fixed aside-minimize-hoverable page-loading">

	<?php echo $__env->make("partials._page-loader", \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

	<!--begin::Main-->

	<?php echo $__env->make("partials._header-mobile", \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
	<div class="d-flex flex-column flex-root">

		<!--begin::Page-->
		<div class="d-flex flex-row flex-column-fluid page">

			<?php echo $__env->make("partials._aside", \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

			<!--begin::Wrapper-->
			<div class="d-flex flex-column flex-row-fluid wrapper" id="kt_wrapper">

				<?php echo $__env->make("partials._header", \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

				<!--begin::Content-->
				<div class="content d-flex flex-column flex-column-fluid" id="kt_content">
					<div class="d-flex flex-column-fluid">

						<!--begin::Container-->
						<div class="container">
							<?php echo $__env->yieldContent('content'); ?>
						</div>
					</div>
				</div>

				<!--end::Content-->
			</div>

			<!--end::Wrapper-->
		</div>

		<!--end::Page-->
	</div>

	<!--end::Main-->


	<?php echo $__env->make("partials._extras.offcanvas.quick-user", \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

	<?php echo $__env->make("partials._extras.chat", \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

	<?php echo $__env->make("partials._extras.scrolltop", \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>



	
	<?php echo $__env->make('admin.modals.map', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

	<div id="results-modals"></div>


	<div id="main_modal" class="modal animated bounceInDown" role="dialog">
		<div class="alert alert-danger" style="display:none; margin: 15px;"></div>
		<div class="alert alert-success" style="display:none; margin: 15px;"></div>
		<div class="modal-dialog">
		</div>
	</div>


	<div id="wait_msg" style="display: none">
		Operation in progress ... Please wait
	</div>
	<div id="overlay">
	</div>


	<?php $__env->startSection('js'); ?>



	<script>
		function myMap(address, lat, long) {

			var myLatLng = {
				lat: Number(lat),
				lng: Number(long)
			};


			var map = new google.maps.Map(document.getElementById("map"), {
				zoom: 10,
				center: myLatLng,

				gestureHandling: 'cooperative'
			});

			map.setOptions({
				scrollwheel: false
			});


			var marker = new google.maps.Marker({
				position: myLatLng,
				map: map,
				title: address
			});
		}
	</script>

	<?php $__env->stopSection(); ?>
<?php echo $__env->make('admin.layout.footer', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\Dragon\resources\views/admin/layout/index.blade.php ENDPATH**/ ?>