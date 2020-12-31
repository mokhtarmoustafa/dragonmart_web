
<!DOCTYPE html>

<html lang="ar" >
    <!--begin::Head-->
    <head>
  		<base href="">
  		<meta charset="utf-8" />
  		<title>Metronic Live preview | Keenthemes</title>
  		<meta name="description" content="Metronic admin dashboard live demo. Check out all the features of the admin panel. A large number of settings, additional services and widgets." />
  		<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
      <meta content="{{csrf_token()}}" name="csrf-token"/>
  		<!--begin::Fonts-->
  		<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Poppins:300,400,500,600,700" />
  		<link href="{{url('/V2')}}/assets/css/fonts/Expo.css" rel="stylesheet" type="text/css" />

  		<!--end::Fonts-->


  		<link href="{{url('/V2')}}/assets/plugins/custom/datatables/datatables.bundle.css?v=7.0.9" rel="stylesheet" type="text/css">


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
      <link rel="stylesheet" href="{{url('/assets')}}/site/css/rtl-style.css">
  		<!--end::Layout Themes-->
  		<link rel="shortcut icon" href="{{url('/V2')}}/assets/media/logos/favicon.ico" />
  	</head>
    <!--end::Head-->

    <!--begin::Body-->
    <body  id="kt_body"  class="header-fixed header-mobile-fixed subheader-enabled subheader-fixed aside-enabled aside-fixed aside-minimize-hoverable page-loading"  >

    	<!--begin::Main-->
	<div class="d-flex flex-column flex-root">
		<!--begin::Login-->
<div class="login login-4 wizard d-flex flex-column flex-lg-row flex-column-fluid">
    <!--begin::Content-->
    <div class="login-container order-2 order-lg-1 d-flex flex-center flex-row-fluid px-7 pt-lg-0 pb-lg-0 pt-4 pb-6 bg-white">
        <!--begin::Wrapper-->
        <div class="login-content w-50 d-flex flex-column pt-lg-0 pt-12">

            <!--begin::Signin-->
            <div class="login-form">
                <!--begin::Form-->
                <form class="form" id="kt_login_singin_form" action="{{route('admin.login.submit')}}" method="post">
                    {{csrf_field()}}
                    <!--begin::Title-->
                    <div class="pb-5 pb-lg-15">
                        <h3 class="font-weight-bolder text-dark font-size-h2 font-size-h1-lg">تسجيل الدخول</h3>
                    </div>
                    <!--begin::Title-->

                    <!--begin::Form group-->
                    <div class="form-group">
                        <label class="font-size-h6 font-weight-bolder text-dark">البريد الإلكتروني أو رقم الجوال</label>
                        <input class="form-control form-control-solid h-auto py-7 px-6 rounded-lg border-0" type="text" autocomplete="off" placeholder="Email or Phone Number"
                               name="email"/>
                    </div>
                    <!--end::Form group-->

                    <!--begin::Form group-->
                    <div class="form-group">
                        <div class="d-flex justify-content-between mt-n5">
                            <label class="font-size-h6 font-weight-bolder text-dark pt-5">كلمة المرور</label>

                            <a href="reset" class="text-primary font-size-h6 font-weight-bolder text-hover-primary pt-5">
        						نسيت كلمة المرور ؟
        					</a>
                        </div>
                        <input class="form-control form-control-solid h-auto py-7 px-6 rounded-lg border-0" type="password" autocomplete="off" placeholder="Password"
                               name="password"/>
                    </div>
                    <!--end::Form group-->

                    <!--begin::Action-->
                    <div class="pb-lg-0 pb-5">
                        <button type="submit" id="kt_login_singin_form_submit_button" class="btn btn-primary font-weight-bolder font-size-h6 px-8 py-4 my-3 mr-3">تسجيل الدخول</button>
                    </div>
                    <!--end::Action-->
                </form>
                <!--end::Form-->
            </div>
            <!--end::Signin-->
        </div>
        <!--end::Wrapper-->
    </div>
    <!--begin::Content-->

    <!--begin::Aside-->

    <div class="login-aside col-md-4 px-20 position-relative bg-login ">
        <img class="logo center_all" src="{{url('/')}}/assets/site/images/white_DragonMart.png">
    </div>
    <!--end::Aside-->
</div>
<!--end::Login-->
	</div>
<!--end::Main-->


    	<!--begin::Global Theme Bundle(used by all pages)-->
    	    	   <script src="assets/plugins/global/plugins.bundle.js"></script>
		    	   <script src="assets/plugins/custom/prismjs/prismjs.bundle.js"></script>
		    	   <script src="assets/js/scripts.bundle.js"></script>
				<!--end::Global Theme Bundle-->


                    <!--begin::Page Scripts(used by this page)-->
                            <script src="assets/js/pages/custom/login/login-4.js"></script>
                        <!--end::Page Scripts-->
            </body>
    <!--end::Body-->
</html>
