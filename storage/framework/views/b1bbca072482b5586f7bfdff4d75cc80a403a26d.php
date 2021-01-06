<?php $__env->startSection('css'); ?>
<!-- BEGIN PAGE LEVEL PLUGINS -->
<link href="<?php echo e(url('/')); ?>/assets/global/plugins/datatables/datatables.min.css" rel="stylesheet" type="text/css" />
<link href="<?php echo e(url('/')); ?>/assets/global/plugins/datatables/plugins/bootstrap/datatables.bootstrap.css" rel="stylesheet" type="text/css" />
<!-- END PAGE LEVEL PLUGINS -->

<link href="<?php echo e(url('/')); ?>/assets/global/plugins/bootstrap-datepicker/css/bootstrap-datepicker3.min.css" rel="stylesheet" type="text/css" />
<!-- BEGIN THEME GLOBAL STYLES -->
<link href="<?php echo e(url('/')); ?>/assets/global/css/components-md.min.css" rel="stylesheet" id="style_components" type="text/css" />
<link href="<?php echo e(url('/')); ?>/assets/global/css/plugins-md.min.css" rel="stylesheet" type="text/css" />
<!-- END THEME GLOBAL STYLES -->
<?php $__env->stopSection(); ?>
<?php $__env->startSection('content'); ?>

<div class="card card-custom">
    <div class="card-header">
        <div class="card-title">
            <i class="<?php echo e($icon); ?> font-dark"></i>
            <span class="caption-subject bold uppercase"> <?php echo e(trans(lang_app_site().'.CP.'.$main_title)); ?></span>
        </div>

    </div>

    <div class="card-body">
        <div class="row">
            <div class="col-md-12">
                <div class="portlet-body">
                    <div class="row">
                        <div class="col-lg-4 col-md-4 col-sm-6 col-xs-12 pull-right">
                            <a class="dashboard-stat dashboard-stat-v2 blue" href="#">
                                <div class="visual">
                                    <i class="fa fa-comments"></i>
                                </div>
                                <div class="details">
                                    <div class="number">
                                        <span data-counter="counterup"><?php echo e($total_revenue ?? 0); ?></span>
                                    </div>
                                    <div class="desc"> <?php echo e(trans(lang_app_site().'.CP.Profit')); ?></div>
                                </div>
                            </a>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
    <div class="card-body">
        <div class="row">
            <div class="col-md-12">
                    <div class="portlet-body form">
                        <div class="row">

                            <div class="col-md-12">
                                <!-- BEGIN EXAMPLE TABLE PORTLET-->
                                <div class="card card-custom shadow m-5">
                                    <div class="card-header">
                                        <div class="card-title">
                                            <i class="fa fa-search font-dark"></i>
                                            <span class="caption-subject bold uppercase"> <?php echo e(trans(lang_app_site().'.CP.Filter')); ?> </span>
                                        </div>

                                    </div>
                                    <div class="card-body">
                                        <div class="table-container">
                                            <?php echo Form::open(['method'=>'POST','url'=>url('/admin/export')]); ?>


                                            <table class="table table-striped table-bordered table-hover table-checkable" id="revenue_orders">
                                                <thead>
                                                    <tr role="row" class="heading">
                                                        <th width="1%">
                                                            
                                                            
                                                            
                                                            
                                                            
                                                        </th>
                                                        
                                                        <th width="10%"> <?php echo e(trans(lang_app_site().'.CP.Order #')); ?></th>
                                                        <th width="10%"> <?php echo e(trans(lang_app_site().'.CP.Merchant name')); ?></th>
                                                        <th width="20%"> <?php echo e(trans(lang_app_site().'.CP.Order closing date')); ?></th>
                                                        
                                                        <th width="10%"> <?php echo e(trans(lang_app_site().'.CP.Delivery method')); ?></th>
                                                        
                                                        <th width="10%"> <?php echo e(trans(lang_app_site().'.CP.Action')); ?></th>
                                                    </tr>
                                                    <tr role="row" class="filter">
                                                        <td></td>
                                                        <td>
                                                            <input type="text" class="form-control form-filter input-md" name="order_no" placeholder="<?php echo e(trans(lang_app_site().'.CP.Order #')); ?> ..." id="order_no">

                                                        </td>
                                                        <td>
                                                            <input type="text" class="form-control form-filter input-md" name="merchant_name" placeholder="<?php echo e(trans(lang_app_site().'.CP.Merchant name')); ?> ..." id="merchant_name">

                                                        </td>
                                                        <td>
                                                            <div class="input-group date-picker input-daterange text-center" data-date="2012/11/10" data-date-format="yyyy-mm-dd">
                                                                <input type="text" class="form-control" name="from" placeholder="<?php echo e(trans(lang_app_site().'.CP.From')); ?>" id="order_date_from">
                                                                <span class="input-group-addon"></span>
                                                                <input type="text" class="form-control" id="order_date_to" name="to" placeholder="<?php echo e(trans(lang_app_site().'.CP.To')); ?>"></div>
                                                        </td>
                                                        
                                                        
                                                        
                                                        
                                                        
                                                        
                                                        
                                                        
                                                        
                                                        
                                                        

                                                        
                                                        <td>
                                                            <select class="form-control input-md status select2" name="driver_type_id" id="driver_type_id" data-placeholder="Choose Driver Type">
                                                                <option value=""><?php echo e(trans(lang_app_site().'.CP.Choose driver type')); ?></option>
                                                                <?php $__currentLoopData = $driver_types; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $type): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                                <option value="<?php echo e($type->key); ?>"><?php echo e(trans(lang_app_site().'.CP.'.$type->name)); ?></option>
                                                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                            </select>
                                                        </td>
                                                        
                                                        
                                                        
                                                        
                                                        
                                                        

                                                        

                                                        <td>
                                                            <div class="margin-bottom-5">
                                                                <a href="javascript:;" class="btn btn-sm btn-success btn-circle btn-icon-only filter-submit-revenue margin-bottom" title="Search">
                                                                    <i class="fa fa-search"></i>
                                                                </a>

                                                                <a href="javascript:;" class="btn btn-sm btn-danger btn-circle btn-icon-only filter-cancel-revenue" title="Empty">
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
                                <div class="card card-custom shadow m-5">
                                    <div class="card-header">
                                        <div class="card-title">
                                            <i class="<?php echo e($icon); ?> font-dark"></i>
                                            <span class="caption-subject bold uppercase"> <?php echo e(trans(lang_app_site().'.CP.Revenues')); ?></span>
                                        </div>

                                    </div>
                                    <div class="card-body">

                                        <table class="table table-striped table-hover table-checkable order-column" id="revenue_orders_tbl">
                                            <thead>
                                                <tr>
                                                    <th>#</th>
                                                    <th> <?php echo e(trans(lang_app_site().'.CP.Order #')); ?></th>
                                                    <th> <?php echo e(trans(lang_app_site().'.CP.Merchant')); ?></th>
                                                    <th> <?php echo e(trans(lang_app_site().'.CP.Order closing date')); ?></th>
                                                    <th> <?php echo e(trans(lang_app_site().'.CP.Delivery method')); ?></th>
                                                    <th> <?php echo e(trans(lang_app_site().'.CP.Order amount (SAR)')); ?></th>
                                                    <th> <?php echo e(trans(lang_app_site().'.CP.Commission (SAR)')); ?></th>
                                                    <th> <?php echo e(trans(lang_app_site().'.CP.Shipping rate (SAR)')); ?></th>
                                                    <th> <?php echo e(trans(lang_app_site().'.CP.Revenue (SAR)')); ?></th>
                                                    
                                                </tr>
                                            </thead>
                                            
                                            
                                            
                                            
                                            
                                            
                                            
                                            
                                            
                                            
                                            
                                            
                                            
                                            
                                            
                                            
                                            
                                            
                                            
                                            
                                            
                                            
                                        </table>
                                    </div>
                                </div>
                                <!-- END EXAMPLE TABLE PORTLET-->
                            </div>
                        </div>
                    </div>

            </div>
        </div>

    </div>
</div>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('js'); ?>

<!-- BEGIN PAGE LEVEL PLUGINS -->
<script src="<?php echo e(url('/')); ?>/assets/global/scripts/datatable.js" type="text/javascript"></script>
<script src="<?php echo e(url('/')); ?>/assets/global/plugins/datatables/datatables.min.js" type="text/javascript"></script>
<script src="<?php echo e(url('/')); ?>/assets/global/plugins/datatables/plugins/bootstrap/datatables.bootstrap.js" type="text/javascript"></script>
<!-- END PAGE LEVEL PLUGINS -->

<script src="<?php echo e(url('/')); ?>/assets/global/plugins/jquery-ui/jquery-ui.min.js" type="text/javascript"></script>

<script src="<?php echo e(url('/')); ?>/assets/global/plugins/moment.min.js" type="text/javascript"></script>
<script src="<?php echo e(url('/')); ?>/assets/global/plugins/bootstrap-daterangepicker/daterangepicker.min.js" type="text/javascript"></script>
<script src="<?php echo e(url('/')); ?>/assets/global/plugins/bootstrap-datepicker/js/bootstrap-datepicker.min.js" type="text/javascript"></script>
<!-- BEGIN THEME GLOBAL SCRIPTS -->
<script src="<?php echo e(url('/')); ?>/assets/global/scripts/app.min.js" type="text/javascript"></script>
<!-- END THEME GLOBAL SCRIPTS -->


<script src="<?php echo e(url('/')); ?>/assets/pages/scripts/ui-modals.min.js" type="text/javascript"></script>

<!-- BEGIN PAGE LEVEL SCRIPTS -->
<script src="<?php echo e(url('/')); ?>/assets/pages/scripts/table-datatables-responsive.min.js" type="text/javascript"></script>
<script src="<?php echo e(url('/')); ?>/assets/pages/scripts/components-date-time-pickers.min.js" type="text/javascript"></script>


<!-- END PAGE LEVEL SCRIPTS -->
<script src="<?php echo e(url('/')); ?>/assets/js/users.js" type="text/javascript"></script>
<script src="<?php echo e(url('/')); ?>/assets/js/orders.js" type="text/javascript"></script>

<script>
    $(".date-picker").datepicker();
</script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make(admin_layout_vw().'.index', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\dragon_mart_web\resources\views/admin/revenues/index.blade.php ENDPATH**/ ?>