<?php $__env->startSection('css'); ?>
    <!-- BEGIN PAGE LEVEL PLUGINS -->

    <!-- END THEME GLOBAL STYLES -->
<?php $__env->stopSection(); ?>
<?php $__env->startSection('content'); ?>

































    <input type="hidden" name="constant" id="constant" value="<?php echo e($constant_name); ?>">
    <input type="hidden" name="url_action" id="url_action" value="<?php echo e($url_action); ?>">
    <div class="row">
        <div class="col-md-12">
            <!-- BEGIN EXAMPLE TABLE PORTLET-->
            <div class="card card-custom shadow mb-5">
                <div class="card-header">
                    <div class="card-title">
                        <i class="icon-settings"></i>
                        &nbsp;
                        <span class="caption-subject bold uppercase"><?php echo e(trans(lang_app_site().'.CP.Stores '.$sub_title)); ?></span>
                    </div>
                    <div class="card-toolbar">
                        <a href="<?php echo e(url('admin/category/create')); ?>" class="btn btn-circle btn-primary add-category-mdl">
                            <i class="fa fa-plus"></i>
                            <span class="hidden-xs"> <?php echo e(trans(lang_app_site().'.CP.New Stroe Category')); ?> </span>
                        </a>
                    </div>

                </div>
                <div class="card-body">

                    <table class="table table-striped table-bordered table-hover table-checkable order-column"
                           id="category_tbl">
                        <thead>
                        <tr>
                            <th>#</th>
                            <th> <?php echo e(trans(lang_app_site().'.CP.Icon')); ?></th>
                            <th> <?php echo e(trans(lang_app_site().'.CP.Name')); ?> (English)</th>
                            <th> <?php echo e(trans(lang_app_site().'.CP.Name')); ?> (Arabic)</th>
                            <th> <?php echo e(trans(lang_app_site().'.CP.Action')); ?></th>
                        </tr>
                        </thead>
                    </table>
                </div>
            </div>
            <!-- END EXAMPLE TABLE PORTLET-->
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <!-- BEGIN EXAMPLE TABLE PORTLET-->
            <div class="card card-custom shadow">
                <div class="card-header">
                    <div class="card-title">
                        <i class="icon-settings"></i>
                        &nbsp;
                        <span class="caption-subject bold uppercase"> <?php echo e(trans(lang_app_site().'.CP.Services '.$sub_title)); ?> </span>
                    </div>
                    <div class="card-toolbar">
                        <a href="<?php echo e(url('admin/service-category/create')); ?>" class="btn btn-circle btn-primary add-category-mdl">
                            <i class="fa fa-plus"></i>
                            <span class="hidden-xs"> <?php echo e(trans(lang_app_site().'.CP.New Service Category')); ?> </span>
                        </a>
                    </div>

                </div>
                <div class="card-body">

                    <table class="table table-striped table-bordered table-hover table-checkable order-column"
                           id="service-category_tbl">
                        <thead>
                        <tr>
                            <th>#</th>
                            <th> <?php echo e(trans(lang_app_site().'.CP.Icon')); ?></th>
                            <th> <?php echo e(trans(lang_app_site().'.CP.Name')); ?> (English)</th>
                            <th> <?php echo e(trans(lang_app_site().'.CP.Name')); ?> (Arabic)</th>
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
    <script src="<?php echo e(url('/')); ?>/assets/js/categories.js" type="text/javascript"></script>

<?php $__env->stopSection(); ?>
<?php echo $__env->make(admin_layout_vw().'.index', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/saudidragonmart/public_html/resources/views/admin/constants/categories.blade.php ENDPATH**/ ?>