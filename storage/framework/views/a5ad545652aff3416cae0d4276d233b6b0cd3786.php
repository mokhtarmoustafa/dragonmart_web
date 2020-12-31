<?php $__env->startSection('css'); ?>
<!-- BEGIN THEME GLOBAL STYLES -->

<!-- END THEME GLOBAL STYLES -->

<?php $__env->stopSection(); ?>
<?php $__env->startSection('content'); ?>
<div class="row">
    <div class="col-md-12">
        <div class="card card-custom mb-5">
            <div class="card-header">
                <div class="card-title">
                    <i class="fa fa-search font-dark"></i>
                    &nbsp;
                    <span class="caption-subject bold uppercase"> <?php echo e(trans(lang_app_site().'.CP.Filter')); ?> </span>
                </div>

            </div>
            <div class="card-body">
                <div class="table-container">
                    <?php echo Form::open(['method'=>'POST','url'=>url(admin_role_url().'/export')]); ?>


                    <table class="table table-striped table-bordered table-hover table-checkable" id="datatable_products">
                        <thead>
                            <tr role="row" class="heading">
                                <th width="1%">
                                    
                                    
                                    
                                    
                                    
                                </th>

                                <th width="10%"> <?php echo e(trans(lang_app_site().'.CP.Name')); ?></th>
                                <th width="10%"> <?php echo e(trans(lang_app_site().'.CP.Display Name')); ?></th>
                                <th width="10%"> <?php echo e(trans(lang_app_site().'.CP.Action')); ?></th>
                            </tr>
                            <tr role="row" class="filter">
                                <td></td>
                                <td>
                                    <input type="text" class="form-control form-filter input-md" name="name" placeholder="<?php echo e(trans(lang_app_site().'.CP.Name')); ?>" id="name">

                                </td>
                                <td>
                                    <input type="text" class="form-control form-filter input-md" name="display_name" placeholder="<?php echo e(trans(lang_app_site().'.CP.Display Name')); ?>" id="display_name">
                                </td>

                                <td>
                                    <div class="margin-bottom-5">
                                        <a href="javascript:;" class="btn btn-sm btn-success btn-circle btn-icon-only filter-submit margin-bottom" title="Search">
                                            <i class="fa fa-search"></i>
                                        </a>

                                        <a href="javascript:;" class="btn btn-sm btn-danger btn-circle btn-icon-only filter-cancel" title="Empty">
                                            <i class="fa fa-rotate-left"></i>
                                        </a>
                                        
                                        
                                        
                                        
                                    </div>

                                </td>
                            </tr>
                        </thead>
                        <tbody></tbody>
                    </table>
                    <?php echo Form::close(); ?>


                </div>
            </div>
        </div>
        <!-- BEGIN EXAMPLE TABLE PORTLET-->
        <div class="card card-custom">
            <div class="card-header">
                <div class="card-title">
                    <i class="icon-settings font-dark"></i>
                    <span class="caption-subject bold uppercase"> <?php echo e(trans(lang_app_site().'.CP.'.$title)); ?></span>
                </div>
                <div class="card-toolbar">
                    <a href="<?php echo e(url(admin_role_url().'/add-role')); ?>" class="btn btn-circle btn-primary add-role-mdl">
                        <i class="fa fa-plus"></i>
                        <span class="hidden-xs"> <?php echo e(trans(lang_app_site().'.CP.Add New')); ?> </span>
                    </a>

                </div>
            </div>
            <div class="card-body">

                <table class="table table-striped table-hover table-checkable order-column" id="roles_tbl">
                    <thead>
                        <tr>
                            <th> #</th>
                            <th> <?php echo e(trans(lang_app_site().'.CP.Name')); ?></th>
                            <th> <?php echo e(trans(lang_app_site().'.CP.Display Name')); ?></th>
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
<script src="<?php echo e(url('/')); ?>/assets/global/plugins/datatables/plugins/bootstrap/datatables.bootstrap.js" type="text/javascript"></script>
<!-- END PAGE LEVEL PLUGINS -->
<!-- BEGIN THEME GLOBAL SCRIPTS -->
<script src="<?php echo e(url('/')); ?>/assets/global/scripts/app.min.js" type="text/javascript"></script>
<!-- END THEME GLOBAL SCRIPTS -->
<!-- BEGIN PAGE LEVEL SCRIPTS -->
<script src="<?php echo e(url('/')); ?>/assets/pages/scripts/table-datatables-managed.min.js" type="text/javascript"></script>
<script src="<?php echo e(url('/')); ?>/assets/js/role.js" type="text/javascript"></script>
<!-- END PAGE LEVEL SCRIPTS -->

<?php $__env->stopSection(); ?>
<?php echo $__env->make(admin_layout_vw().'.index', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/saudidragonmart/public_html/resources/views/admin/admins/role/index.blade.php ENDPATH**/ ?>