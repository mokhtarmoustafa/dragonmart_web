<!-- BEGIN GLOBAL MANDATORY STYLES -->


<link href="<?php echo e(url('/')); ?>/assets/global/plugins/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css"/>
<link href="<?php echo e(url('/')); ?>/assets/global/plugins/simple-line-icons/simple-line-icons.min.css" rel="stylesheet"
      type="text/css"/>
<link href="<?php echo e(url('/')); ?>/assets/global/plugins/bootstrap/css/bootstrap.min.css" rel="stylesheet" type="text/css"/>
<link href="<?php echo e(url('/')); ?>/assets/global/plugins/bootstrap-switch/css/bootstrap-switch.min.css" rel="stylesheet"
      type="text/css"/>
<!-- END GLOBAL MANDATORY STYLES -->

<!-- BEGIN PAGE LEVEL PLUGINS -->
<?php echo $__env->yieldContent('css'); ?>


<link href="<?php echo e(url('/')); ?>/assets/global/plugins/bootstrap-toastr/toastr.min.css" rel="stylesheet" id="style_components"
      type="text/css">
<!-- BEGIN THEME GLOBAL STYLES -->
<link href="<?php echo e(url('/')); ?>/assets/global/css/components-md.min.css" rel="stylesheet" id="style_components"
      type="text/css"/>
<link href="<?php echo e(url('/')); ?>/assets/global/css/plugins-md.min.css" rel="stylesheet" type="text/css"/>
<!-- END THEME GLOBAL STYLES -->
<!-- BEGIN THEME LAYOUT STYLES -->
<link href="<?php echo e(url('/')); ?>/assets/layouts/layout2/css/layout.min.css" rel="stylesheet" type="text/css"/>
<link href="<?php echo e(url('/')); ?>/assets/layouts/layout2/css/themes/blue.min.css" rel="stylesheet" type="text/css"
      id="style_color"/>
<link href="<?php echo e(url('/')); ?>/assets/layouts/layout2/css/custom.min.css" rel="stylesheet" type="text/css"/>
<!-- END THEME LAYOUT STYLES -->
<link rel="shortcut icon" href="favicon.ico"/>
<style>
    .dataTables_wrapper .dataTables_processing {
        border: none !important;
        background: none !important;
        -webkit-box-shadow: none !important;
        -moz-box-shadow: none !important;
        box-shadow: none !important;
    }

    .modal-footer button {
        float: right;
        margin-left: 10px;
    }

    /*.select2-container {*/
        /*width: 500px !important;*/
    /*}*/

    th, td {
        text-align: center !important;
    }
</style>
<?php echo $__env->yieldPushContent('css'); ?><?php /**PATH /home/saudidragonmart/public_html/resources/views/merchant/layout/css.blade.php ENDPATH**/ ?>