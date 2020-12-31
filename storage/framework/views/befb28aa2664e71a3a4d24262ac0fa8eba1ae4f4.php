<?php $__env->startSection('css'); ?>
    <!-- BEGIN PAGE LEVEL PLUGINS -->
    <link href="<?php echo e(url('/')); ?>/assets/global/plugins/datatables/datatables.min.css" rel="stylesheet" type="text/css"/>
    <link href="<?php echo e(url('/')); ?>/assets/global/plugins/datatables/plugins/bootstrap/datatables.bootstrap.css"
          rel="stylesheet" type="text/css"/>
    <!-- END PAGE LEVEL PLUGINS -->

    <link href="<?php echo e(url('/')); ?>/assets/global/plugins/bootstrap-daterangepicker/daterangepicker.min.css" rel="stylesheet"
          type="text/css"/>

    <link href="<?php echo e(url('/')); ?>/assets/global/plugins/bootstrap-datepicker/css/bootstrap-datepicker3.min.css"
          rel="stylesheet" type="text/css"/>
    <!-- BEGIN THEME GLOBAL STYLES -->
    <link href="<?php echo e(url('/')); ?>/assets/global/css/components-md.min.css" rel="stylesheet" id="style_components"
          type="text/css"/>
    <link href="<?php echo e(url('/')); ?>/assets/global/css/plugins-md.min.css" rel="stylesheet" type="text/css"/>
    <!-- END THEME GLOBAL STYLES -->
<?php $__env->stopSection(); ?>
<?php $__env->startSection('content'); ?>
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
                            <div class="row">
                                <div class="col-lg-4 col-md-4 col-sm-6 col-xs-12">
                                    <a class="dashboard-stat dashboard-stat-v2 blue"
                                       href="<?php echo e(url(merchant_vw().'/orders')); ?>">
                                        <div class="visual">
                                            <i class="fa fa-comments"></i>
                                        </div>
                                        <div class="details">
                                            <div class="number">
                                                <span data-counter="counterup" data-value="<?php echo e($new); ?>">0</span>
                                            </div>
                                            <div class="desc"><?php echo e(trans(lang_app_site().'.CP.New requests')); ?> </div>
                                        </div>
                                    </a>
                                </div>
                                <div class="col-lg-4 col-md-4 col-sm-6 col-xs-12">
                                    <a class="dashboard-stat dashboard-stat-v2 red"
                                       href="<?php echo e(url(merchant_vw().'/orders')); ?>">
                                        <div class="visual">
                                            <i class="fa fa-bar-chart-o"></i>
                                        </div>
                                        <div class="details">
                                            <div class="number">
                                                <span data-counter="counterup" data-value="<?php echo e($current); ?>">0</span>
                                            </div>
                                            <div class="desc"><?php echo e(trans(lang_app_site().'.CP.Current orders')); ?></div>
                                        </div>
                                    </a>
                                </div>
                                <div class="col-lg-4 col-md-4 col-sm-6 col-xs-12">
                                    <a class="dashboard-stat dashboard-stat-v2 green"
                                       href="<?php echo e(url(merchant_vw().'/orders')); ?>">
                                        <div class="visual">
                                            <i class="fa fa-shopping-cart"></i>
                                        </div>
                                        <div class="details">
                                            <div class="number">
                                                <span data-counter="counterup" data-value="<?php echo e($completed); ?>">0</span>
                                            </div>
                                            <div class="desc"><?php echo e(trans(lang_app_site().'.CP.Finished orders')); ?></div>
                                        </div>
                                    </a>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="portlet-body">
            <div class="row">
                <div class="col-md-12">
                    <div class="portlet light ">
                        <div class="portlet-body">
                            <ul class="nav nav-tabs">

                                <li class="active">
                                    <a href="#new_requests" data-toggle="tab"><?php echo e(trans(lang_app_site().'.CP.New requests')); ?></a>
                                </li>
                                <li>
                                    <a href="#current_orders" data-toggle="tab"><?php echo e(trans(lang_app_site().'.CP.Current orders')); ?></a>
                                </li>
                                <li>
                                    <a href="#finished_orders" data-toggle="tab"><?php echo e(trans(lang_app_site().'.CP.Finished orders')); ?></a>
                                </li>


                            </ul>
                            <div class="tab-content">

                                <div class="tab-pane fade  active in " id="new_requests">

                                    <div class="portlet-body form">
                                        <div class="row">

                                            <div class="col-md-12">
                                                <!-- BEGIN EXAMPLE TABLE PORTLET-->
                                                <div class="portlet light">
                                                    <div class="portlet-title">
                                                        <div class="caption font-dark">
                                                            <i class="fa fa-search font-dark"></i>
                                                            <span class="caption-subject bold uppercase"><?php echo e(trans(lang_app_site().'.CP.Filter')); ?></span>
                                                        </div>

                                                    </div>
                                                    <div class="portlet-body">
                                                        <div class="table-container">
                                                            <?php echo Form::open(['method'=>'POST','url'=>url('/admin/export')]); ?>

                                                            <table class="table table-striped table-bordered table-hover table-checkable"
                                                                   id="new_report_orders">
                                                                <thead>
                                                                <tr role="row" class="heading">
                                                                    <th width="1%">
                                                                    </th>
                                                                    <th width="10%"><?php echo e(trans(lang_app_site().'.CP.Order #')); ?></th>
                                                                    <th width="10%"><?php echo e(trans(lang_app_site().'.CP.Merchant name')); ?></th>
                                                                    <th width="20%"><?php echo e(trans(lang_app_site().'.CP.Order date')); ?></th>
                                                                    <th width="20%"><?php echo e(trans(lang_app_site().'.CP.Delivery/pickup date')); ?></th>
                                                                    
                                                                    
                                                                    <th width="10%"><?php echo e(trans(lang_app_site().'.CP.Action')); ?></th>
                                                                </tr>
                                                                <tr role="row" class="filter">
                                                                    <td></td>
                                                                    <td>
                                                                        <input type="text"
                                                                               class="form-control form-filter input-md"
                                                                               name="order_no"
                                                                               placeholder="Order# ..." id="order_no">

                                                                    </td>
                                                                    <td>
                                                                        <input type="text"
                                                                               class="form-control form-filter input-md"
                                                                               name="merchant_name"
                                                                               placeholder="Merchant name ..."
                                                                               id="merchant_name">

                                                                    </td>
                                                                    <td>
                                                                        <div class="input-group date-picker input-daterange text-center"
                                                                             data-date="2012/11/10"
                                                                             data-date-format="yyyy-mm-dd">
                                                                            <input type="text" class="form-control"
                                                                                   name="from" placeholder="From"
                                                                                   id="order_date_from">
                                                                            <span class="input-group-addon"><?php echo e(trans(lang_app_site().'.CP.to')); ?></span>
                                                                            <input type="text" class="form-control"
                                                                                   id="order_date_to"
                                                                                   name="to" placeholder="To"></div>
                                                                    </td>
                                                                    <td>
                                                                        <div class="input-group date-picker input-daterange text-center"
                                                                             data-date="2012/11/10"
                                                                             data-date-format="yyyy-mm-dd">
                                                                            <input type="text" class="form-control"
                                                                                   name="from" placeholder="From"
                                                                                   id="received_date_from">
                                                                            <span class="input-group-addon"> <?php echo e(trans(lang_app_site().'.CP.to')); ?></span>
                                                                            <input type="text" class="form-control"
                                                                                   id="received_date_to"
                                                                                   name="to" placeholder="To"></div>

                                                                    </td>
                                                                    
                                                                    
                                                                    
                                                                    
                                                                    
                                                                    
                                                                    
                                                                    
                                                                    
                                                                    
                                                                    
                                                                    
                                                                    
                                                                    
                                                                    
                                                                    
                                                                    

                                                                    

                                                                    <td>
                                                                        <div class="margin-bottom-5">
                                                                            <a href="javascript:;"
                                                                               class="btn btn-sm btn-success btn-circle btn-icon-only filter-submit-report-n margin-bottom"
                                                                               title="Search">
                                                                                <i class="fa fa-search"></i>
                                                                            </a>

                                                                            <a href="javascript:;"
                                                                               class="btn btn-sm btn-danger btn-circle btn-icon-only filter-cancel-report-n"
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
                                                <div class="portlet light ">
                                                    <div class="portlet-title">
                                                        <div class="caption font-dark">
                                                            <i class="<?php echo e($icon); ?> font-dark"></i>
                                                            <span class="caption-subject bold uppercase"><?php echo e(trans(lang_app_site().'.CP.New requests')); ?></span>
                                                        </div>
                                                        
                                                        
                                                        
                                                        
                                                        
                                                        
                                                        

                                                    </div>


                                                    <div class="portlet-body">
                                                        

                                                        <table class="table table-striped table-bordered table-hover table-checkable order-column"
                                                               id="new_report_orders_tbl">
                                                            <thead>
                                                            <tr>
                                                                
                                                                
                                                                
                                                                
                                                                
                                                                
                                                                
                                                                
                                                                
                                                                
                                                                
                                                                
                                                                <th>#</th>
                                                                <th> <?php echo e(trans(lang_app_site().'.CP.Order #')); ?></th>
                                                                <th><?php echo e(trans(lang_app_site().'.CP.Merchant')); ?></th>
                                                                <th><?php echo e(trans(lang_app_site().'.CP.Order date')); ?></th>
                                                                <th><?php echo e(trans(lang_app_site().'.CP.Delivery/pickup date')); ?></th>
                                                                <th><?php echo e(trans(lang_app_site().'.CP.Items #')); ?></th>
                                                                <th><?php echo e(trans(lang_app_site().'.CP.Procurement method')); ?></th>
                                                                
                                                                <th><?php echo e(trans(lang_app_site().'.CP.Order amount (SAR)')); ?></th>
                                                                
                                                                
                                                                <th><?php echo e(trans(lang_app_site().'.CP.Action')); ?></th>
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
                                <div class="tab-pane fade" id="current_orders">

                                    <div class="portlet-body form">
                                        <div class="row">

                                            <div class="col-md-12">
                                                <!-- BEGIN EXAMPLE TABLE PORTLET-->
                                                <div class="portlet light">
                                                    <div class="portlet-title">
                                                        <div class="caption font-dark">
                                                            <i class="fa fa-search font-dark"></i>
                                                            <span class="caption-subject bold uppercase"><?php echo e(trans(lang_app_site().'.CP.Filter')); ?></span>
                                                        </div>

                                                    </div>
                                                    <div class="portlet-body">
                                                        <div class="table-container">
                                                            <?php echo Form::open(['method'=>'POST','url'=>url('/admin/export')]); ?>

                                                            <table class="table table-striped table-bordered table-hover table-checkable"
                                                                   id="current_report_orders">
                                                                <thead>
                                                                <tr role="row" class="heading">
                                                                    <th width="1%">
                                                                        
                                                                        
                                                                        
                                                                        
                                                                        
                                                                    </th>
                                                                    
                                                                    <th width="10%"><?php echo e(trans(lang_app_site().'.CP.Order #')); ?></th>
                                                                    <th width="10%"><?php echo e(trans(lang_app_site().'.CP.Merchant name')); ?></th>
                                                                    <th width="20%"><?php echo e(trans(lang_app_site().'.CP.Order date')); ?></th>
                                                                    <th width="20%"><?php echo e(trans(lang_app_site().'.CP.Delivery/pickup date')); ?></th>
                                                                    <th width="10%"><?php echo e(trans(lang_app_site().'.CP.Delivery method')); ?></th>
                                                                    <th width="10%"><?php echo e(trans(lang_app_site().'.CP.Driver name')); ?></th>
                                                                    <th width="10%"><?php echo e(trans(lang_app_site().'.CP.Action')); ?></th>
                                                                </tr>
                                                                <tr role="row" class="filter">
                                                                    <td></td>
                                                                    <td>
                                                                        <input type="text"
                                                                               class="form-control form-filter input-md"
                                                                               name="order_no"
                                                                               placeholder="Order# ..." id="order_no">

                                                                    </td>
                                                                    <td>
                                                                        <input type="text"
                                                                               class="form-control form-filter input-md"
                                                                               name="merchant_name"
                                                                               placeholder="Merchant name ..."
                                                                               id="merchant_name">

                                                                    </td>
                                                                    <td>
                                                                        <div class="input-group date-picker input-daterange text-center"
                                                                             data-date="2012/11/10"
                                                                             data-date-format="yyyy-mm-dd">
                                                                            <input type="text" class="form-control"
                                                                                   name="from" placeholder="From"
                                                                                   id="order_date_from">
                                                                            <span class="input-group-addon"> to </span>
                                                                            <input type="text" class="form-control"
                                                                                   id="order_date_to"
                                                                                   name="to" placeholder="To"></div>
                                                                    </td>
                                                                    <td>
                                                                        <div class="input-group date-picker input-daterange text-center"
                                                                             data-date="2012/11/10"
                                                                             data-date-format="yyyy-mm-dd">
                                                                            <input type="text" class="form-control"
                                                                                   name="from" placeholder="From"
                                                                                   id="received_date_from">
                                                                            <span class="input-group-addon"><?php echo e(trans(lang_app_site().'.CP.to')); ?></span>
                                                                            <input type="text" class="form-control"
                                                                                   id="received_date_to"
                                                                                   name="to" placeholder="To"></div>

                                                                    </td>
                                                                    <td>
                                                                        <select class="form-control input-md status select2"
                                                                                name="driver_type_id"
                                                                                id="driver_type_id"
                                                                                data-placeholder="Choose Driver Type">
                                                                            <option value=""><?php echo e(trans(lang_app_site().'.CP.Choose driver type')); ?></option>
                                                                            <?php $__currentLoopData = $driver_types; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $type): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                                                <option value="<?php echo e($type->key); ?>"><?php echo e($type->name); ?></option>
                                                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                                        </select>
                                                                    </td>
                                                                    <td>
                                                                        <input type="text"
                                                                               class="form-control form-filter input-md"
                                                                               name="driver_name"
                                                                               placeholder="Driver name ..."
                                                                               id="driver_name">

                                                                    </td>

                                                                    <td>
                                                                        <div class="margin-bottom-5">
                                                                            <a href="javascript:;"
                                                                               class="btn btn-sm btn-success btn-circle btn-icon-only filter-submit-report-c margin-bottom"
                                                                               title="Search">
                                                                                <i class="fa fa-search"></i>
                                                                            </a>

                                                                            <a href="javascript:;"
                                                                               class="btn btn-sm btn-danger btn-circle btn-icon-only filter-cancel-report-c"
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
                                                <div class="portlet light ">
                                                    <div class="portlet-title">
                                                        <div class="caption font-dark">
                                                            <i class="<?php echo e($icon); ?> font-dark"></i>
                                                            <span class="caption-subject bold uppercase"><?php echo e(trans(lang_app_site().'.CP.Current orders')); ?></span>
                                                        </div>
                                                        
                                                        
                                                        
                                                        
                                                        
                                                        
                                                        

                                                    </div>


                                                    <div class="portlet-body">
                                                        

                                                        <table class="table table-striped table-bordered table-hover table-checkable order-column"
                                                               id="current_report_orders_tbl">
                                                            <thead>
                                                            <tr>
                                                                <th>#</th>
                                                                <th><?php echo e(trans(lang_app_site().'.CP.Order #')); ?></th>
                                                                <th> <?php echo e(trans(lang_app_site().'.CP.Merchant')); ?></th>
                                                                <th> <?php echo e(trans(lang_app_site().'.CP.Order date')); ?></th>
                                                                <th> <?php echo e(trans(lang_app_site().'.CP.Delivery/pickup date')); ?></th>
                                                                <th> <?php echo e(trans(lang_app_site().'.CP.Items #')); ?></th>
                                                                <th> <?php echo e(trans(lang_app_site().'.CP.Procurement method')); ?></th>
                                                                <th> <?php echo e(trans(lang_app_site().'.CP.Delivery method')); ?></th>
                                                                <th> <?php echo e(trans(lang_app_site().'.CP.Driver name')); ?></th>
                                                                <th> <?php echo e(trans(lang_app_site().'.CP.Order amount (SAR)')); ?></th>
                                                                <th> <?php echo e(trans(lang_app_site().'.CP.Shipping rate (SAR)')); ?></th>
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
                                <div class="tab-pane fade" id="finished_orders">

                                    <div class="portlet-body form">
                                        <div class="row">

                                            <div class="col-md-12">
                                                <!-- BEGIN EXAMPLE TABLE PORTLET-->
                                                <div class="portlet light">
                                                    <div class="portlet-title">
                                                        <div class="caption font-dark">
                                                            <i class="fa fa-search font-dark"></i>
                                                            <span class="caption-subject bold uppercase"><?php echo e(trans(lang_app_site().'.CP.Filter')); ?></span>
                                                        </div>

                                                    </div>
                                                    <div class="portlet-body">
                                                        <div class="table-container">
                                                            <?php echo Form::open(['method'=>'POST','url'=>url('/admin/export')]); ?>

                                                            <table class="table table-striped table-bordered table-hover table-checkable"
                                                                   id="finished_report_orders">
                                                                <thead>
                                                                <tr role="row" class="heading">
                                                                    <th width="1%">
                                                                        
                                                                        
                                                                        
                                                                        
                                                                        
                                                                    </th>
                                                                    
                                                                    <th width="10%"> <?php echo e(trans(lang_app_site().'.CP.Order #')); ?></th>
                                                                    <th width="10%"> <?php echo e(trans(lang_app_site().'.CP.Merchant name')); ?></th>
                                                                    <th width="20%"> <?php echo e(trans(lang_app_site().'.CP.Order date')); ?></th>
                                                                    <th width="20%"> <?php echo e(trans(lang_app_site().'.CP.Delivery/pickup date')); ?></th>
                                                                    <th width="10%"> <?php echo e(trans(lang_app_site().'.CP.Delivery method')); ?></th>
                                                                    <th width="10%"> <?php echo e(trans(lang_app_site().'.CP.Driver name')); ?></th>
                                                                    <th width="10%"> <?php echo e(trans(lang_app_site().'.CP.Action')); ?></th>
                                                                </tr>
                                                                <tr role="row" class="filter">
                                                                    <td></td>
                                                                    <td>
                                                                        <input type="text"
                                                                               class="form-control form-filter input-md"
                                                                               name="order_no"
                                                                               placeholder="Order# ..." id="order_no">

                                                                    </td>
                                                                    <td>
                                                                        <input type="text"
                                                                               class="form-control form-filter input-md"
                                                                               name="merchant_name"
                                                                               placeholder="Merchant name ..."
                                                                               id="merchant_name">

                                                                    </td>
                                                                    <td>
                                                                        <div class="input-group date-picker input-daterange text-center"
                                                                             data-date="2012/11/10"
                                                                             data-date-format="yyyy-mm-dd">
                                                                            <input type="text" class="form-control"
                                                                                   name="from" placeholder="From"
                                                                                   id="order_date_from">
                                                                            <span class="input-group-addon"><?php echo e(trans(lang_app_site().'.CP.to')); ?> </span>
                                                                            <input type="text" class="form-control"
                                                                                   id="order_date_to"
                                                                                   name="to" placeholder="To"></div>
                                                                    </td>
                                                                    <td>
                                                                        <div class="input-group date-picker input-daterange text-center"
                                                                             data-date="2012/11/10"
                                                                             data-date-format="yyyy-mm-dd">
                                                                            <input type="text" class="form-control"
                                                                                   name="from" placeholder="From"
                                                                                   id="received_date_from">
                                                                            <span class="input-group-addon"> <?php echo e(trans(lang_app_site().'.CP.to')); ?> </span>
                                                                            <input type="text" class="form-control"
                                                                                   id="received_date_to"
                                                                                   name="to" placeholder="To"></div>

                                                                    </td>
                                                                    <td>
                                                                        <select class="form-control input-md status select2"
                                                                                name="driver_type_id"
                                                                                id="driver_type_id"
                                                                                data-placeholder="Choose Driver Type">
                                                                            <option value=""><?php echo e(trans(lang_app_site().'.CP.Choose driver type')); ?></option>
                                                                            <?php $__currentLoopData = $driver_types; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $type): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                                                <option value="<?php echo e($type->key); ?>"><?php echo e($type->name); ?></option>
                                                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                                        </select>
                                                                    </td>
                                                                    <td>
                                                                        <input type="text"
                                                                               class="form-control form-filter input-md"
                                                                               name="driver_name"
                                                                               placeholder="Driver name ..."
                                                                               id="driver_name">

                                                                    </td>

                                                                    <td>
                                                                        <div class="margin-bottom-5">
                                                                            <a href="javascript:;"
                                                                               class="btn btn-sm btn-success btn-circle btn-icon-only filter-submit-report-f margin-bottom"
                                                                               title="Search">
                                                                                <i class="fa fa-search"></i>
                                                                            </a>

                                                                            <a href="javascript:;"
                                                                               class="btn btn-sm btn-danger btn-circle btn-icon-only filter-cancel-report-f"
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
                                                <div class="portlet light ">
                                                    <div class="portlet-title">
                                                        <div class="caption font-dark">
                                                            <i class="<?php echo e($icon); ?> font-dark"></i>
                                                            <span class="caption-subject bold uppercase"><?php echo e(trans(lang_app_site().'.CP.Finished orders')); ?></span>
                                                        </div>

                                                    </div>


                                                    <div class="portlet-body">
                                                        <table class="table table-striped table-bordered table-hover table-checkable order-column"
                                                               id="finished_report_orders_tbl">
                                                            <thead>
                                                            <tr>
                                                                <th>#</th>
                                                                <th> <?php echo e(trans(lang_app_site().'.CP.Order #')); ?></th>
                                                                <th> <?php echo e(trans(lang_app_site().'.CP.Merchant')); ?></th>
                                                                <th> <?php echo e(trans(lang_app_site().'.CP.Order date')); ?></th>
                                                                <th> <?php echo e(trans(lang_app_site().'.CP.Delivery/pickup date')); ?></th>
                                                                <th> <?php echo e(trans(lang_app_site().'.CP.Actual receive date')); ?></th>
                                                                <th> <?php echo e(trans(lang_app_site().'.CP.Items #')); ?></th>
                                                                <th> <?php echo e(trans(lang_app_site().'.CP.Procurement method')); ?></th>
                                                                <th> <?php echo e(trans(lang_app_site().'.CP.Delivery method')); ?></th>
                                                                <th> <?php echo e(trans(lang_app_site().'.CP.Driver name')); ?></th>
                                                                <th> <?php echo e(trans(lang_app_site().'.CP.Order amount (SAR)')); ?></th>
                                                                <th> <?php echo e(trans(lang_app_site().'.CP.Shipping rate (SAR)')); ?></th>
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
                            <div class="clearfix margin-bottom-20"></div>
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

    <script src="<?php echo e(url('/')); ?>/assets/global/plugins/moment.min.js" type="text/javascript"></script>
    <script src="<?php echo e(url('/')); ?>/assets/global/plugins/bootstrap-daterangepicker/daterangepicker.min.js"
            type="text/javascript"></script>
    
    
    <script src="<?php echo e(url('/')); ?>/assets/global/plugins/counterup/jquery.waypoints.min.js" type="text/javascript"></script>
    <script src="<?php echo e(url('/')); ?>/assets/global/plugins/counterup/jquery.counterup.min.js" type="text/javascript"></script>

    
    
    
    
    <script src="<?php echo e(url('/')); ?>/assets/global/plugins/bootstrap-datepicker/js/bootstrap-datepicker.min.js"
            type="text/javascript"></script>
    <!-- BEGIN THEME GLOBAL SCRIPTS -->
    <script src="<?php echo e(url('/')); ?>/assets/global/scripts/app.min.js" type="text/javascript"></script>
    <!-- END THEME GLOBAL SCRIPTS -->
    

    
    <script src="<?php echo e(url('/')); ?>/assets/pages/scripts/components-date-time-pickers.min.js" type="text/javascript"></script>

    <!-- BEGIN PAGE LEVEL SCRIPTS -->
    <script src="<?php echo e(url('/')); ?>/assets/pages/scripts/table-datatables-responsive.min.js" type="text/javascript"></script>

    
    <!-- END PAGE LEVEL SCRIPTS -->
    <script src="<?php echo e(url('/')); ?>/assets/js/users.js" type="text/javascript"></script>
    <script src="<?php echo e(url('/')); ?>/assets/js/orders.js" type="text/javascript"></script>

<?php $__env->stopSection(); ?>
<?php echo $__env->make(merchant_layout_vw().'.index', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/saudidragonmart/public_html/resources/views/merchant/orders/index.blade.php ENDPATH**/ ?>