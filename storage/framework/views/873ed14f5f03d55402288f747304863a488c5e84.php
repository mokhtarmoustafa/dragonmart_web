<?php $__env->startSection('css'); ?>
    <!-- BEGIN PAGE LEVEL PLUGINS -->
    <link href="<?php echo e(url('/')); ?>/assets/global/plugins/datatables/datatables.min.css" rel="stylesheet" type="text/css"/>
    <link href="<?php echo e(url('/')); ?>/assets/global/plugins/datatables/plugins/bootstrap/datatables.bootstrap.css"
          rel="stylesheet" type="text/css"/>
    <!-- END PAGE LEVEL PLUGINS -->

    <!-- BEGIN THEME GLOBAL STYLES -->
    <link href="<?php echo e(url('/')); ?>/assets/global/css/components-md.min.css" rel="stylesheet" id="style_components"
          type="text/css"/>
    <link href="<?php echo e(url('/')); ?>/assets/global/css/plugins-md.min.css" rel="stylesheet" type="text/css"/>
    <!-- END THEME GLOBAL STYLES -->
<?php $__env->stopSection(); ?>
<?php $__env->startSection('content'); ?>
    <div class="row">
        <div class="col-md-12">
            <!-- BEGIN EXAMPLE TABLE PORTLET-->
            <div class="card card-custom shadow">
                <div class="card-header">
                    <div class="card-title">
                        <i class="<?php echo e($icon); ?>"></i>
                        &nbsp;
                        <span class="caption-subject bold uppercase"> <?php echo e(trans(lang_app_site().'.CP.'.$main_title)); ?></span>
                    </div>

                </div>
                <div class="card-body">

                    <table class="table table-striped table-bordered table-hover table-checkable order-column"
                           id="sponsor_requests_tbl">
                        <thead>
                        <tr>
                            <th>#</th>
                            <th> <?php echo e(trans(lang_app_site().'.CP.Merchant')); ?></th>
                            <th> <?php echo e(trans(lang_app_site().'.CP.Product')); ?></th>
                            <th> <?php echo e(trans(lang_app_site().'.CP.Duration')); ?></th>
                            <th> <?php echo e(trans(lang_app_site().'.CP.End date')); ?></th>
                            <th> <?php echo e(trans(lang_app_site().'.CP.Action')); ?></th>
                        </tr>
                        </thead>
                    </table>
                </div>
            </div>
            <!-- END EXAMPLE TABLE PORTLET-->
        </div>
    </div>

    <div class="modal fade bs-modal-lg" id="imagesProduct" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-lg" style="width: 1200px !important;">
            <div class="modal-content">
                <div class="modal-body" id="images-product">

                </div>

            </div>
            <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
    </div>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('js'); ?>


    <!-- BEGIN PAGE LEVEL PLUGINS -->
    <script src="<?php echo e(url('/')); ?>/assets/global/scripts/datatable.js" type="text/javascript"></script>
    <script src="<?php echo e(url('/')); ?>/assets/global/plugins/datatables/datatables.min.js" type="text/javascript"></script>
    <script src="<?php echo e(url('/')); ?>/assets/global/plugins/datatables/plugins/bootstrap/datatables.bootstrap.js"
            type="text/javascript"></script>
    <!-- END PAGE LEVEL PLUGINS -->


    <!-- BEGIN THEME GLOBAL SCRIPTS -->
    <script src="<?php echo e(url('/')); ?>/assets/global/scripts/app.min.js" type="text/javascript"></script>
    <!-- END THEME GLOBAL SCRIPTS -->
    <!-- BEGIN PAGE LEVEL SCRIPTS -->
    <script src="<?php echo e(url('/')); ?>/assets/pages/scripts/table-datatables-managed.min.js" type="text/javascript"></script>
    <!-- END PAGE LEVEL SCRIPTS -->
    <script src="<?php echo e(url('/')); ?>/assets/js/sponsors.js" type="text/javascript"></script>
    <script src="<?php echo e(url('/')); ?>/assets/js/products.js" type="text/javascript"></script>


<?php $__env->stopSection(); ?>
<?php echo $__env->make(admin_layout_vw().'.index', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/saudidragonmart/public_html/resources/views/admin/sponsor_requests/index.blade.php ENDPATH**/ ?>