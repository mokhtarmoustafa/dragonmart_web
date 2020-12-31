<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title> DragonMart</title>
    <?php echo $__env->make(site_layout_vw().'.css', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/css/toastr.css" rel="stylesheet" type="text/css">

    <meta name="csrf-token" content="<?php echo e(csrf_token()); ?>"/>
    <link rel="stylesheet" href="<?php echo e(url('/jquery.timepicker.min.css')); ?>">


</head>
<body class="home home1">
<div class="special-container">
    <!--Header-->
<?php echo $__env->make(site_layout_vw().'.header', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

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
<?php echo $__env->yieldContent('content'); ?>
<!--/Content-->
</div>
<!--Footer-->

<!--/Footer-->
<a class="back-to-top" href="#"></a>

<?php echo $__env->make(site_layout_vw().'.js', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/js/toastr.min.js"></script>


</body>
</html>
<?php /**PATH /home/saudidragonmart/public_html/resources/views/site/layout/index.blade.php ENDPATH**/ ?>