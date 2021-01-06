<!DOCTYPE html>
<html lang="ar" dir="rtl">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title><?php echo e($main_title); ?></title>
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <meta content="<?php echo e(csrf_token()); ?>" name="csrf-token" />
    <link href="<?php echo e(url('/')); ?>/V2/assets/css/style.bundle.rtl.css" rel="stylesheet" type="text/css" />
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Poppins:300,400,500,600,700" />
    <link href="<?php echo e(url('/V2')); ?>/assets/css/fonts/Expo.css" rel="stylesheet" type="text/css" />
    <link href="<?php echo e(url('/V2')); ?>/assets/plugins/global/plugins.bundle.css" rel="stylesheet" type="text/css">
</head>

<body class="bg-primary-o-10 p-5">


    <div id="orders_followup_row" class="row">

        
    </div>



</body>
<script src="<?php echo e(url('/V2')); ?>/assets/plugins/global/plugins.bundle.js"></script>
<script src="<?php echo e(url('/')); ?>/assets/js/followup.js"></script>
<script>
    var baseURL = '<?php echo e(url("admin")); ?>';
</script>

</html><?php /**PATH C:\xampp\htdocs\dragon_mart_web\resources\views/admin/orders_followup.blade.php ENDPATH**/ ?>