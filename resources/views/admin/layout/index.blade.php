<!DOCTYPE html>
<html lang="ar" style="direction: rtl;" direction="rtl">

<!--begin::Head-->

<head>
	<base href="">
	<meta charset="utf-8" />
	<title>Dragon Mart | Dashboard</title>
	<meta name="description" content="Dragon Mart | Dashboard" />
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
	<meta content="{{csrf_token()}}" name="csrf-token" />
	<!--begin::Fonts-->
	<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Poppins:300,400,500,600,700" />
	<link href="{{url('/V2')}}/assets/css/fonts/Expo.css" rel="stylesheet" type="text/css" />

	<!--end::Fonts-->


	<!-- <link href="{{url('/V2')}}/assets/plugins/custom/datatables/datatables.bundle.css" rel="stylesheet" type="text/css" /> -->
	<link href="{{url('/')}}/V2/assets/plugins/custom/datatables/datatables.bundle.rtl.css" rel="stylesheet" type="text/css">


	<!--begin::Page Vendors Styles(used by this page)-->

	@yield('css')

	<!--end::Page Vendors Styles-->

	<!--begin::Global Theme Styles(used by all pages)-->
	<link href="{{url('/V2')}}/assets/plugins/global/plugins.bundle.css" rel="stylesheet" type="text/css" />
	<link href="{{url('/V2')}}/assets/plugins/custom/prismjs/prismjs.bundle.css" rel="stylesheet" type="text/css" />
	<link href="{{url('/V2')}}/assets/css/style.bundle.rtl.css" rel="stylesheet" type="text/css" />

	<!--end::Global Theme Styles-->

	<!--begin::Layout Themes(used by all pages)-->
	<link href="{{url('/V2')}}/assets/css/themes/layout/header/base/light.css" rel="stylesheet" type="text/css" />
	<link href="{{url('/V2')}}/assets/css/themes/layout/header/menu/light.css" rel="stylesheet" type="text/css" />
	<link href="{{url('/V2')}}/assets/css/themes/layout/brand/dark.css" rel="stylesheet" type="text/css" />
	<link href="{{url('/V2')}}/assets/css/themes/layout/aside/dark.css" rel="stylesheet" type="text/css" />

	<!--end::Layout Themes-->
	<link rel="shortcut icon" href="{{url('/V2')}}/assets/media/logos/favicon.ico" />
</head>

<!--end::Head-->

<!--begin::Body-->

<body id="kt_body" class="page-loading-enabled page-loading header-fixed header-mobile-fixed  aside-enabled aside-fixed aside-minimize-hoverable page-loading">

	@include("partials._page-loader")

	<!--begin::Main-->

	@include("partials._header-mobile")
	<div class="d-flex flex-column flex-root">

		<!--begin::Page-->
		<div class="d-flex flex-row flex-column-fluid page">

			@include("partials._aside")

			<!--begin::Wrapper-->
			<div class="d-flex flex-column flex-row-fluid wrapper" id="kt_wrapper">

				@include("partials._header")

				<!--begin::Content-->
				<div class="content d-flex flex-column flex-column-fluid" id="kt_content">
					<div class="d-flex flex-column-fluid">

						<!--begin::Container-->
						<div class="container">
							@yield('content')
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


	@include("partials._extras.offcanvas.quick-user")

	@include("partials._extras.chat")

	@include("partials._extras.scrolltop")



	@extends('admin.layout.footer')
	@include('admin.modals.map')

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


	@section('js')



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

	@endsection