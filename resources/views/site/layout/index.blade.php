<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title> DragonMart</title>
    @include(site_layout_vw().'.css')
    <link href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/css/toastr.css" rel="stylesheet" type="text/css">

    <meta name="csrf-token" content="{{ csrf_token() }}"/>
    <link rel="stylesheet" href="{{ url('/jquery.timepicker.min.css') }}">


</head>
<body class="home home1">
<div class="special-container">
    <!--Header-->
@include(site_layout_vw().'.header')

<!-- LOADER -->
<div class="preloader">
    <div class="lds-ellipsis">
        <span></span>
        <span></span>
        <span></span>
    </div>
</div>
<!-- END LOADER -->

<!--/Header-->
    <!--Content-->
@yield('content')
<!--/Content-->
</div>
<!--Footer-->
{{-- @include(site_layout_vw().'.footer') --}}
<!--/Footer-->
<a class="back-to-top" href="#"></a>

@include(site_layout_vw().'.js')
<script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/js/toastr.min.js"></script>


</body>
</html>
