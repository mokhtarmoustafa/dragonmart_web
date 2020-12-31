<link href="{{url('/assets')}}/site/css/bootstrap.min.css" rel="stylesheet" type="text/css">
<link href="{{url('/assets')}}/site/css/owl.carousel.min.css" rel="stylesheet" type="text/css">
<link href="{{url('/assets')}}/site/css/font-awesome.min.css" rel="stylesheet" type="text/css">
<link href="{{url('/assets')}}/site/css/animate.min.css" rel="stylesheet">
<link href="{{url('/assets')}}/site/css/magnific-popup.min.css" rel="stylesheet">
<link href="{{url('/assets')}}/site/css/jquery-ui.min.css" rel="stylesheet">
<link href="{{url('/assets')}}/site/css/jquery.scrollbar.css" rel="stylesheet">
<link href="{{url('/assets')}}/site/css/chosen.min.css" rel="stylesheet">
<link href="{{url('/assets')}}/site/css/jquery.mCustomScrollbar.css" rel="stylesheet">
<link href="{{url('/assets')}}/site/css/ovic-mobile-menu.css" rel="stylesheet">
<link href="{{url('/assets')}}/site/css/jquery.datetimepicker.min.css" rel="stylesheet">
<link href="{{url('/assets')}}/site/css/style.css" rel="stylesheet">
<link href="{{url('/assets')}}/site/css/customs-css.css" rel="stylesheet">


@if(session()->has('lang') && session()->get('lang') == 'ar')

    <link href="https://fonts.googleapis.com/css?family=Cairo:200,300,400,600,700,900&display=swap&subset=arabic"
          rel="stylesheet">

@else
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i,800,800i"
          rel="stylesheet">
@endif
@if(session()->has('lang') && session()->get('lang') == 'ar')
    <link href="{{url('assets/site/css/rtl.css')}}" rel="stylesheet">
@endif

@stack('css')
