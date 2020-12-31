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

    <style>
        .table-container td {
            font-size: 20px;
            padding-top: 4px;
        }

    </style>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('content'); ?>

    <input type="hidden" name="client_id" id="client_id" value="<?php echo e($user->id); ?>">
    <div class="row">

        <div class="col-md-12">
            <!-- BEGIN EXAMPLE TABLE PORTLET-->
            <div class="portlet light">
                <div class="portlet-title">
                    <div class="caption font-dark">
                        <i class="fa fa-search font-dark"></i>
                        <span class="caption-subject bold uppercase"> Client Information </span>
                    </div>

                </div>
                <div class="portlet-body">
                    <div class="table-container">
                        <form class="form-horizontal" role="form">
                            <div class="form-body">
                                <div class="form-group ">

                                    <table
                                        class="table table-striped table-bordered table-hover table-checkable order-column"
                                        id="user-det-tbl">
                                        <thead>
                                        <tr>
                                            
                                            <th> Username</th>
                                            <th> Email</th>
                                            <th> Address</th>
                                            <th> Mobile</th>
                                            <th> Register Date</th>
                                            <th> Status</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        <tr>
                                            
                                            
                                            
                                            
                                            
                                            
                                            

                                            
                                            
                                            <td><?php echo e($user->username ?? ''); ?></td>
                                            <td> <?php echo e($user->email ?? ''); ?></td>

                                            <td><a
                                                    href="<?php echo e(url(admin_user_tab_url() . '/user/' . $user->id)); ?>"
                                                    class="btn btn-circle btn-icon-only blue user-det"
                                                    title="Address">
                                                    <i class="fa fa-map"></i>
                                                </a></td>
                                            <td> <?php echo e($user->mobile ?? ''); ?></td>
                                            <td><?php echo e(\Carbon\Carbon::parse($user->created_at)->format('Y-m-d') ?? ''); ?></td>
                                            <td><a href="javascript:;"
                                                   class="btn btn-circle btn-icon-only <?php if($user->is_active): ?> red <?php else: ?> green <?php endif; ?> set_active"
                                                   data-id="<?php echo e($user->id); ?>"
                                                   title="<?php if($user->is_active): ?> Suspend <?php else: ?> Activate <?php endif; ?>">
                                                    <i class="<?php if($user->is_active): ?>fa fa-power-off <?php else: ?> fa fa-check <?php endif; ?>"></i>
                                                </a>
                                                
                                                
                                                
                                            </td>
                                        </tr>
                                        </tbody>
                                    </table>

                                </div>


                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <div class="portlet light ">
                <div class="portlet-title">
                    <div class="caption font-dark">
                        <i class="<?php echo e($icon); ?> font-dark"></i>
                        <span class="caption-subject bold uppercase"> <?php echo e($main_title); ?></span>
                    </div>

                </div>


                <div class="portlet-body">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="portlet light ">
                                <div class="portlet-body">
                                    <ul class="nav nav-tabs mb-5">

                                        <li class="nav-item">
                                            <a class="nav-link active" href="#orders" data-toggle="tab"> Orders </a>
                                        </li>
                                        <li class="nav-item">
                                            <a class="nav-link" href="#invoices" data-toggle="tab"> Invoices </a>
                                        </li>


                                    </ul>
                                    <div class="tab-content">

                                        <div class="tab-pane fade  active show " id="orders">

                                            <div class="portlet-body form">
                                                <table
                                                    class="table table-striped table-bordered table-hover table-checkable order-column"
                                                    id="user-orders-tbl">
                                                    <thead>
                                                    <tr>
                                                        <th>#</th>
                                                        <th> Order #</th>
                                                        <th> Merchant</th>
                                                        <th> Order date</th>
                                                        <th> Delivery/pickup date</th>
                                                        <th> Actual receive date</th>
                                                        <th> Items #</th>
                                                        <th> Procurement method</th>
                                                        <th> Delivery method</th>
                                                        <th> Driver name</th>
                                                        <th> Order amount (SAR)</th>
                                                        <th> Shipping rate (SAR)</th>
                                                        <th> Action</th>
                                                    </tr>
                                                    </thead>
                                                </table>
                                            </div>
                                        </div>

                                        <div class="tab-pane fade " id="invoices">

                                            Waiting payment gateway
                                            <div class="portlet-body form">
                                                <table
                                                    class="table table-striped table-bordered table-hover table-checkable order-column"
                                                    id="">
                                                    <thead>
                                                    <tr>
                                                        <th>#</th>
                                                        <th> Invoice #</th>
                                                        <th> Order date</th>
                                                        <th> Merchant</th>
                                                        <th> Procurement method</th>
                                                        <th> Location</th>
                                                        <th> Items #</th>
                                                        <th> Order amount (SAR)</th>
                                                        <th> Status</th>
                                                        <th> Delivery/pickup date</th>
                                                    </tr>
                                                    </thead>
                                                </table>
                                            </div>
                                        </div>

                                    </div>
                                    <div class="clearfix margin-bottom-20"></div>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
            <!-- END EXAMPLE TABLE PORTLET-->
        </div>
    </div>
    <!-- /.modal -->
    <!-- /.modal -->
<?php $__env->stopSection(); ?>

<?php $__env->startSection('js'); ?>

    <!-- BEGIN PAGE LEVEL PLUGINS -->
    <script src="<?php echo e(url('/')); ?>/assets/global/scripts/datatable.js" type="text/javascript"></script>
    <script src="<?php echo e(url('/')); ?>/assets/global/plugins/datatables/datatables.min.js"
            type="text/javascript"></script>
    <script src="<?php echo e(url('/')); ?>/assets/global/plugins/datatables/plugins/bootstrap/datatables.bootstrap.js"
            type="text/javascript"></script>
    <!-- END PAGE LEVEL PLUGINS -->

    
    <script src="<?php echo e(url('/')); ?>/assets/global/plugins/jquery-ui/jquery-ui.min.js" type="text/javascript"></script>

    <!-- BEGIN THEME GLOBAL SCRIPTS -->
    <script src="<?php echo e(url('/')); ?>/assets/global/scripts/app.min.js" type="text/javascript"></script>
    <!-- END THEME GLOBAL SCRIPTS -->
    
    <script src="<?php echo e(url('/')); ?>/assets/pages/scripts/components-bootstrap-switch.min.js"
            type="text/javascript"></script>

    <script src="<?php echo e(url('/')); ?>/assets/pages/scripts/ui-modals.min.js" type="text/javascript"></script>

    <!-- BEGIN PAGE LEVEL SCRIPTS -->
    <script src="<?php echo e(url('/')); ?>/assets/pages/scripts/table-datatables-responsive.min.js"
            type="text/javascript"></script>

    
    <!-- END PAGE LEVEL SCRIPTS -->
    <script src="<?php echo e(url('/')); ?>/assets/js/users.js" type="text/javascript"></script>
    <script src="<?php echo e(url('/')); ?>/assets/js/orders.js" type="text/javascript"></script>
    <script type="text/javascript">

    </script>

<?php $__env->stopSection(); ?>

<?php echo $__env->make(admin_layout_vw().'.index', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/saudidragonmart/public_html/resources/views/admin/users/view.blade.php ENDPATH**/ ?>