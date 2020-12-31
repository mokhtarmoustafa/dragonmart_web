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

    <div class="row">

        <div class="col-md-12">
            <!-- BEGIN EXAMPLE TABLE PORTLET-->

            <div class="portlet light ">
                <div class="portlet-title">
                    <div class="caption font-dark">
                        <i class="<?php echo e($icon); ?> font-dark"></i>
                        <span class="caption-subject bold uppercase"> Driver Information</span>
                    </div>

                </div>


                <div class="portlet-body">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="portlet light ">
                                <div class="portlet-body">
                                    <ul class="nav nav-tabs">

                                        <li class="active">
                                            <a href="#general_information" data-toggle="tab"> General Information </a>
                                        </li>
                                        <li>
                                            <a href="#vehicle_info" data-toggle="tab"> Vehicle Info </a>
                                        </li>
                                        <li>
                                            <a href="#docs" data-toggle="tab"> Documents </a>
                                        </li>


                                    </ul>
                                    <div class="tab-content">

                                        <div class="tab-pane fade  active in " id="general_information">

                                            <div class="portlet-body form">

                                                <table class="table table-striped table-bordered table-hover table-checkable order-column"
                                                       id="driver-det-tbl">
                                                    <thead>
                                                    <tr>
                                                        <th width="20%"> Logo</th>
                                                        <th> Username</th>
                                                        <th> Email</th>
                                                        <th> City</th>
                                                        <th> Address</th>
                                                        <th> Mobile</th>
                                                        <th> Register Date</th>
                                                        <th> Status</th>
                                                        <th> Action</th>
                                                    </tr>
                                                    </thead>
                                                    <tbody>
                                                    <tr>
                                                        <td>
                                                            <div class="fileinput fileinput-new">
                                                                <div class="">
                                                                    <img src="<?php echo e($user->image100 ?? url('assets/apps/img/man.svg')); ?>"
                                                                         style="width:50px;height: 50px;"
                                                                         class="img-circle">
                                                                </div>

                                                            </div>
                                                        </td>
                                                        <td><?php echo e($user->username ?? ''); ?></td>
                                                        <td> <?php echo e($user->email ?? ''); ?></td>
                                                        <td> <?php echo e($user->city->name_ar ?? ''); ?></td>

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
                                                            </a></td>
                                                        <td>
                                                            <a href="<?php echo e(url(((getAuth()->type == 'admin') ? admin_user_tab_url() : getAuth()->type).'/user-driver/'.$user->id.'/edit')); ?>"
                                                               class="btn btn-circle btn-icon-only blue edit-driver-info-mdl"
                                                               title="Edit driver">
                                                                <i class="fa fa-edit"></i></a></td>
                                                    </tr>
                                                    </tbody>
                                                </table>

                                            </div>
                                        </div>

                                        <div class="tab-pane fade " id="vehicle_info">

                                            <div class="portlet-body form">

                                                <table class="table table-striped table-bordered table-hover table-checkable order-column">
                                                    <thead>
                                                    <tr>
                                                        <th> Photo</th>
                                                        <th width="20%"> Type</th>
                                                        <th> Model</th>
                                                        <th> Color</th>
                                                        <th> Number</th>
                                                    </tr>
                                                    </thead>
                                                    <tbody>
                                                    <tr>
                                                        <td>
                                                            <div class="fileinput fileinput-new">
                                                                <div class="">
                                                                    <img src="<?php echo e($user->vehicle->photo ?? url('assets/apps/img/man.svg')); ?>"
                                                                         style="width:50px;height: 50px;"
                                                                         class="img-circle">
                                                                </div>

                                                            </div>
                                                        </td>
                                                        <td> <?php echo e($user->vehicle->car_type->title ?? ''); ?></td>
                                                        <td> <?php echo e($user->vehicle->model ?? ''); ?></td>
                                                        <td> <?php echo e($user->vehicle->color ?? ''); ?></td>
                                                        <td> <?php echo e($user->vehicle->no ?? ''); ?></td>
                                                    </tr>
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                        <div class="tab-pane fade " id="docs">

                                            <div class="portlet-body form">

                                                <table class="table table-striped table-bordered table-hover table-checkable order-column">
                                                    <thead>
                                                    <tr>
                                                        <th width="20%"> File name</th>
                                                        <th> Action</th>
                                                    </tr>
                                                    </thead>
                                                    <tbody>
                                                    <tr>
                                                        <td> Car License</td>
                                                        <td><a href="<?php echo e($user->vehicle->document ?? ''); ?>"
                                                               class="btn btn-primary btn-icon-only btn-circle"
                                                               download="CarLicense.png"><i class="fa fa-download"></i></a>
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td> Driver Id</td>
                                                        <td><a href="<?php echo e($user->vehicle->id_no ?? ''); ?>"
                                                               class="btn btn-primary btn-icon-only btn-circle"
                                                               download="DriverID.png"><i
                                                                        class="fa fa-download"></i></a></td>

                                                    </tr>
                                                    <tr>
                                                        <td> License driving</td>
                                                        <td><a href="<?php echo e($user->vehicle->license_driving ?? ''); ?>"
                                                               class="btn btn-primary btn-icon-only btn-circle"
                                                               download="LicenseDriving.png"><i
                                                                        class="fa fa-download"></i></a></td>

                                                    </tr>
                                                    
                                                    
                                                    
                                                    
                                                    
                                                    

                                                    
                                                    </tbody>
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
    <script type="text/javascript">

    </script>




<?php $__env->stopSection(); ?>

<?php echo $__env->make(admin_layout_vw().'.index', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\Dragon\resources\views/admin/users/driver_view.blade.php ENDPATH**/ ?>