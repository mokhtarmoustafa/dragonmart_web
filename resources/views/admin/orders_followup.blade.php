<!DOCTYPE html>
<html lang="ar" dir="rtl">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>{{$main_title}}</title>
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <meta content="{{csrf_token()}}" name="csrf-token" />
    <link href="{{url('/')}}/V2/assets/css/style.bundle.rtl.css" rel="stylesheet" type="text/css" />
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Poppins:300,400,500,600,700" />
    <link href="{{url('/V2')}}/assets/css/fonts/Expo.css" rel="stylesheet" type="text/css" />
    <link href="{{url('/V2')}}/assets/plugins/global/plugins.bundle.css" rel="stylesheet" type="text/css">
</head>

<body class="bg-primary-o-10 p-5">


    <div id="orders_followup_row" class="row">

        
    </div>



</body>
<script src="{{url('/V2')}}/assets/plugins/global/plugins.bundle.js"></script>
<script src="{{url('/')}}/assets/js/followup.js"></script>
<script>
    var baseURL = '{{url("admin")}}';
</script>

</html>