<?php $__env->startSection('css'); ?>
    <!-- BEGIN PAGE LEVEL PLUGINS -->
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
                        <span class="caption-subject bold uppercase"> <?php echo e(trans(lang_app_site().'.CP.'.$main_title)); ?></span>
                    </div>
                    <div class="card-toolbar">
                        <a href="<?php echo e(url(admin_promotion_tab_url().'/create')); ?>" class="btn btn-circle btn-primary add-promotion-mdla ajax-modal" data-size="modal-xl">
                            <i class="fa fa-plus"></i>
                            <span class="hidden-xs"> <?php echo e(trans(lang_app_site().'.CP.New Promotion Code')); ?> </span>
                        </a>
                    </div>
                </div>
                <div class="card-body">

                    <table class="table table-striped table-bordered table-hover table-checkable order-column"
                           id="promotion_code_tbl">
                        <thead>
                        <tr>
                            <th>#</th>
                            <th> <?php echo e(trans(lang_app_site().'.CP.Code')); ?></th>
                            <th> <?php echo e(trans(lang_app_site().'.CP.Description')); ?></th>
                            <th> <?php echo e(trans(lang_app_site().'.CP.Status')); ?></th>
                            <th> <?php echo e(trans(lang_app_site().'.CP.Request by')); ?></th>
                            <th> <?php echo e(trans(lang_app_site().'.CP.Action')); ?></th>
                        </tr>
                        </thead>
                    </table>
                </div>
            </div>
            <!-- END EXAMPLE TABLE PORTLET-->
        </div>
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
    <script src="<?php echo e(url('/')); ?>/assets/js/promotion_codes.js" type="text/javascript"></script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make(admin_layout_vw().'.index', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\Dragon\resources\views/admin/promotion_codes/index.blade.php ENDPATH**/ ?>