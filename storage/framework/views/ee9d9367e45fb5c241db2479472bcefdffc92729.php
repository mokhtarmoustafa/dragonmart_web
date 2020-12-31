<?php $__env->startSection('css'); ?>
    <!-- BEGIN PAGE LEVEL PLUGINS -->
    <link href="<?php echo e(url('/')); ?>/assets/global/plugins/datatables/datatables.min.css" rel="stylesheet" type="text/css"/>
    <link href="<?php echo e(url('/')); ?>/assets/global/plugins/datatables/plugins/bootstrap/datatables.bootstrap.css" rel="stylesheet" type="text/css"/>
    <!-- END PAGE LEVEL PLUGINS -->

    <link href="<?php echo e(url('/')); ?>/assets/global/plugins/bootstrap-datepicker/css/bootstrap-datepicker3.min.css" rel="stylesheet" type="text/css"/>
    <!-- BEGIN THEME GLOBAL STYLES -->
    <link href="<?php echo e(url('/')); ?>/assets/global/css/components-md.min.css" rel="stylesheet" id="style_components" type="text/css"/>
    <link href="<?php echo e(url('/')); ?>/assets/global/css/plugins-md.min.css" rel="stylesheet" type="text/css"/>
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
                    <div class="portlet light ">
                        <div class="portlet-body">
                            <div class="row">
                                <div class="col-lg-4 col-md-4 col-sm-6 col-xs-12 pull-right">
                                    <a class="dashboard-stat dashboard-stat-v2 blue" href="#">
                                        <div class="visual">
                                            <i class="fa fa-comments"></i>
                                        </div>
                                        <div class="details">
                                            <div class="number">
                                                <span data-counter="counterup" id="total_expenses" data-value="<?php echo e($total_expense ?? 0); ?>"><?php echo e($total_expense); ?></span>
                                            </div>
                                            <div class="desc"> <?php echo e(trans(lang_app_site().'.CP.Expenses')); ?></div>
                                        </div>
                                    </a>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col-md-12">
                    <div class="portlet light ">
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


                                                <table class="table table-striped table-bordered table-hover table-checkable"
                                                       id="expenses">
                                                    <thead>
                                                    <tr role="row" class="heading">
                                                        <th width="1%">
                                                        </th>
                                                        <th width="10%"> <?php echo e(trans(lang_app_site().'.CP.Date')); ?></th>
                                                        <th width="10%"> <?php echo e(trans(lang_app_site().'.CP.Action')); ?></th>
                                                    </tr>
                                                    <tr role="row" class="filter">
                                                        <td></td>
                                                        <td>
                                                            <div class="input-group date-picker input-daterange text-center"
                                                                 data-date="2012/11/10"
                                                                 data-date-format="yyyy-mm-dd">
                                                                <input type="text" class="form-control"
                                                                       name="from" placeholder="<?php echo e(trans(lang_app_site().'.CP.From')); ?>"
                                                                       id="date_from">
                                                                <span class="input-group-addon"> </span>
                                                                <input type="text" class="form-control"
                                                                       id="date_to"
                                                                       name="to" placeholder="<?php echo e(trans(lang_app_site().'.CP.To')); ?>"></div>
                                                        </td>
                                                        <td>
                                                            <div class="margin-bottom-5">
                                                                <a href="javascript:;"
                                                                   class="btn btn-sm btn-success btn-circle btn-icon-only filter-submit margin-bottom"
                                                                   title="Search">
                                                                    <i class="fa fa-search"></i>
                                                                </a>

                                                                <a href="javascript:;"
                                                                   class="btn btn-sm btn-danger btn-circle btn-icon-only filter-cancel"
                                                                   title="Empty">
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
                                                &nbsp;
                                                <span class="caption-subject bold uppercase"> <?php echo e(trans(lang_app_site().'.CP.Expenses')); ?></span> 
                                            </div>
                                            <div class="card-toolbar">
                                                <a href="<?php echo e(url(admin_report_tab_url().'/expense/create')); ?>" class="btn btn-circle btn-primary add-category-mdl">
                                                    <i class="fa fa-plus"></i>
                                                    <span class="hidden-xs"> <?php echo e(trans(lang_app_site().'.CP.Add Expense')); ?> </span>
                                                </a>
                                            </div>
                                        </div>
                                        <div class="card-body">

                                            <table class="table table-striped table-bordered table-hover table-checkable order-column"
                                                   id="expenses_tbl">
                                                <thead>
                                                <tr>
                                                    <th>#</th>
                                                    <th> <?php echo e(trans(lang_app_site().'.CP.Amount (SAR)')); ?></th>
                                                    <th> <?php echo e(trans(lang_app_site().'.CP.Date')); ?></th>
                                                    <th> <?php echo e(trans(lang_app_site().'.CP.Details')); ?></th>
                                                    <th> <?php echo e(trans(lang_app_site().'.CP.Action')); ?></th>
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
    </div>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('js'); ?>

    <!-- BEGIN PAGE LEVEL PLUGINS -->
    <script src="<?php echo e(url('/')); ?>/assets/global/scripts/datatable.js" type="text/javascript"></script>
    <script src="<?php echo e(url('/')); ?>/assets/global/plugins/datatables/datatables.min.js" type="text/javascript"></script>
    <script src="<?php echo e(url('/')); ?>/assets/global/plugins/datatables/plugins/bootstrap/datatables.bootstrap.js"
            type="text/javascript"></script>
    <!-- END PAGE LEVEL PLUGINS -->

    <script src="<?php echo e(url('/')); ?>/assets/global/plugins/jquery-ui/jquery-ui.min.js" type="text/javascript"></script>

    <script src="<?php echo e(url('/')); ?>/assets/global/plugins/moment.min.js" type="text/javascript"></script>
    <script src="<?php echo e(url('/')); ?>/assets/global/plugins/bootstrap-daterangepicker/daterangepicker.min.js"
            type="text/javascript"></script>
    <script src="<?php echo e(url('/')); ?>/assets/global/plugins/bootstrap-datepicker/js/bootstrap-datepicker.min.js"
            type="text/javascript"></script>
    <!-- BEGIN THEME GLOBAL SCRIPTS -->
    <script src="<?php echo e(url('/')); ?>/assets/global/scripts/app.min.js" type="text/javascript"></script>
    <!-- END THEME GLOBAL SCRIPTS -->
    

    <script src="<?php echo e(url('/')); ?>/assets/pages/scripts/ui-modals.min.js" type="text/javascript"></script>

    <!-- BEGIN PAGE LEVEL SCRIPTS -->
    <script src="<?php echo e(url('/')); ?>/assets/pages/scripts/table-datatables-responsive.min.js" type="text/javascript"></script>
    <script src="<?php echo e(url('/')); ?>/assets/pages/scripts/components-date-time-pickers.min.js" type="text/javascript"></script>

    <script src="<?php echo e(url('/')); ?>/assets/js/expenses.js" type="text/javascript"></script>

    <script>
        $(".date-picker").datepicker();
    </script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make(admin_layout_vw().'.index', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/saudidragonmart/public_html/resources/views/admin/expenses/index.blade.php ENDPATH**/ ?>