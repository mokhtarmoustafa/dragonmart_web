<?php $__env->startSection('content'); ?>



<div class="row">
  <div class="col-xl-3">
    <div class="card card-custom card-stretch gutter-b">
      <div class="card-body d-flex flex-column p-0">
        <div class="d-flex align-items-center justify-content-between card-spacer flex-grow-1">
          <div class="d-flex flex-column mr-2">
            <a href="#" class="text-dark-75 text-hover-primary font-weight-bolder font-size-h5"><?php echo e(trans(lang_app_site().'.CP.New orders')); ?></a>
            <span class="text-muted font-weight-bold mt-2">-</span>
          </div>
          <span class="symbol symbol-light-success symbol-45">
            <span class="symbol-label font-weight-bolder font-size-h6"><?php echo e($new); ?></span>
          </span>
        </div>
        <div id="kt_stats_widget_7_chart" class="card-rounded-bottom" style="height: 150px"></div>
      </div>
    </div>
  </div>
  <div class="col-xl-3">
    <div class="card card-custom card-stretch gutter-b">
      <div class="card-body d-flex flex-column p-0">
        <div class="d-flex align-items-center justify-content-between card-spacer flex-grow-1">
          <div class="d-flex flex-column mr-2">
            <a href="#" class="text-dark-75 text-hover-primary font-weight-bolder font-size-h5"><?php echo e(trans(lang_app_site().'.CP.Current orders')); ?></a>
            <span class="text-muted font-weight-bold mt-2">-</span>
          </div>
          <span class="symbol symbol-light-success symbol-45">
            <span class="symbol-label font-weight-bolder font-size-h6"><?php echo e($current); ?></span>
          </span>
        </div>
        <div id="kt_stats_widget_7_chart" class="card-rounded-bottom" style="height: 150px"></div>
      </div>
    </div>
  </div>
  <div class="col-xl-3">
    <div class="card card-custom card-stretch gutter-b">
      <div class="card-body d-flex flex-column p-0">
        <div class="d-flex align-items-center justify-content-between card-spacer flex-grow-1">
          <div class="d-flex flex-column mr-2">
            <a href="#" class="text-dark-75 text-hover-primary font-weight-bolder font-size-h5"><?php echo e(trans(lang_app_site().'.CP.Completed orders')); ?></a>
            <span class="text-muted font-weight-bold mt-2">-</span>
          </div>
          <span class="symbol symbol-light-success symbol-45">
            <span class="symbol-label font-weight-bolder font-size-h6"><?php echo e($completed); ?></span>
          </span>
        </div>
        <div id="kt_stats_widget_7_chart" class="card-rounded-bottom" style="height: 150px"></div>
      </div>
    </div>
  </div>
  <div class="col-xl-3">
    <div class="card card-custom card-stretch gutter-b">
      <div class="card-body d-flex flex-column p-0">
        <div class="d-flex align-items-center justify-content-between card-spacer flex-grow-1">
          <div class="d-flex flex-column mr-2">
            <a href="#" class="text-dark-75 text-hover-primary font-weight-bolder font-size-h5"><?php echo e(trans(lang_app_site().'.CP.Rejected Requests')); ?></a>
            <span class="text-muted font-weight-bold mt-2">-</span>
          </div>
          <span class="symbol symbol-light-success symbol-45">
            <span class="symbol-label font-weight-bolder font-size-h6"><?php echo e($rejected); ?></span>
          </span>
        </div>
        <div id="kt_stats_widget_7_chart" class="card-rounded-bottom" style="height: 150px"></div>
      </div>
    </div>
  </div>
</div>




<div class="example-preview">
  <ul class="nav nav-tabs" id="myTab" role="tablist">
    <li class="nav-item">
      <a class="nav-link active" id="new_orders-tab" data-toggle="tab" href="#new_orders">
        <span class="nav-icon">
          <i class="flaticon2-shopping-cart"></i>
        </span>
        <span class="nav-text"><?php echo e(trans(lang_app_site().'.CP.New orders')); ?></span>
      </a>
    </li>
    <li class="nav-item">
      <a class="nav-link" id="current_orders-tab" data-toggle="tab" href="#current_orders" aria-controls="profile">
        <span class="nav-icon">
          <i class="flaticon2-layers-1"></i>
        </span>
        <span class="nav-text"><?php echo e(trans(lang_app_site().'.CP.Current orders')); ?></span>
      </a>
    </li>
    <li class="nav-item">
      <a class="nav-link" id="finished_orders-tab" data-toggle="tab" href="#finished_orders" aria-controls="profile">
        <span class="nav-icon">
          <i class="flaticon2-layers-1"></i>
        </span>
        <span class="nav-text"><?php echo e(trans(lang_app_site().'.CP.Completed orders')); ?></span>
      </a>
    </li>
    <li class="nav-item">
      <a class="nav-link" id="rejected_orders-tab" href="#rejected_orders" data-toggle="tab" aria-controls="profile">
        <span class="nav-icon">
          <i class="flaticon2-layers-1"></i>
        </span>
        <span class="nav-text"><?php echo e(trans(lang_app_site().'.CP.Rejected Requests')); ?></span>
      </a>
    </li>
  </ul>
  <div class="tab-content p-5 bg-white" id="myTabContent">
    <div class="tab-pane fade active show" id="new_orders" role="tabpanel" aria-labelledby="home-tab">


      <div class="portlet light">
        <div class="portlet-title">
          <div class="caption font-dark">
            <i class="fa fa-search font-dark"></i>
            <span class="caption-subject bold uppercase"> Filter </span>
          </div>

        </div>
        <div class="portlet-body">
          <div class="table-container">
            <?php echo Form::open(['method'=>'POST','url'=>url('/admin/export')]); ?>

            <table class="table table-striped table-bordered table-hover table-checkable" id="new_report_orders">
              <thead>
                <tr role="row" class="heading">
                  <th width="1%">
                  </th>
                  <th width="10%"> <?php echo e(trans(lang_app_site().'.CP.Order #')); ?></th>
                  <th width="10%"> <?php echo e(trans(lang_app_site().'.CP.Merchant name')); ?></th>
                  <th width="20%"> <?php echo e(trans(lang_app_site().'.CP.Order date')); ?></th>
                  <th width="20%"> <?php echo e(trans(lang_app_site().'.CP.Delivery/pickup date')); ?></th>
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
                      <span class="input-group-addon"> to </span>
                      <input type="text" class="form-control" id="order_date_to" name="to" placeholder="<?php echo e(trans(lang_app_site().'.CP.To')); ?>"></div>
                  </td>
                  <td>
                    <div class="input-group date-picker input-daterange text-center" data-date="2012/11/10" data-date-format="yyyy-mm-dd">
                      <input type="text" class="form-control" name="from" placeholder="<?php echo e(trans(lang_app_site().'.CP.From')); ?>" id="received_date_from">
                      <span class="input-group-addon"> to </span>
                      <input type="text" class="form-control" id="received_date_to" name="to" placeholder="<?php echo e(trans(lang_app_site().'.CP.To')); ?>"></div>

                  </td>
                  <td>
                    <div class="margin-bottom-5">
                      <a href="javascript:;" class="btn btn-sm btn-success btn-circle btn-icon-only filter-submit-report-n margin-bottom" title="Search">
                        <i class="fa fa-search"></i>
                      </a>

                      <a href="javascript:;" class="btn btn-sm btn-danger btn-circle btn-icon-only filter-cancel-report-n" title="Empty">
                        <i class="fa fa-redo"></i>
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

      <table class="table table-striped table-bordered table-hover table-checkable order-column" id="new_report_orders_tbl">
        <thead>
          <tr>
            <th>#</th>
            <th> <?php echo e(trans(lang_app_site().'.CP.Order #')); ?></th>
            <th> <?php echo e(trans(lang_app_site().'.CP.Merchant')); ?></th>
            <th> <?php echo e(trans(lang_app_site().'.CP.Order date')); ?></th>
            <th> <?php echo e(trans(lang_app_site().'.CP.Delivery/pickup date')); ?></th>
            <th> <?php echo e(trans(lang_app_site().'.CP.Items #')); ?></th>
            <th> <?php echo e(trans(lang_app_site().'.CP.Procurement method')); ?></th>
            <th> <?php echo e(trans(lang_app_site().'.CP.Order amount (SAR)')); ?></th>
            <th> <?php echo e(trans(lang_app_site().'.CP.Action')); ?></th>
          </tr>
        </thead>
      </table>

    </div>
    <div class="tab-pane fade" id="current_orders" role="tabpanel" aria-labelledby="profile-tab">

      <div class="portlet-title">
        <div class="caption font-dark">
          <i class="fa fa-search font-dark"></i>
          <span class="caption-subject bold uppercase"> Filter </span>
        </div>

      </div>
      <div class="portlet-body">
        <div class="table-container">
          <?php echo Form::open(['method'=>'POST','url'=>url('/admin/export')]); ?>

          <table class="table table-striped table-bordered table-hover table-checkable" id="current_report_orders">
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
                  <input type="text" class="form-control form-filter input-md" name="order_no" placeholder="<?php echo e(trans(lang_app_site().'.CP.Order #')); ?> ..." id="order_no">

                </td>
                <td>
                  <input type="text" class="form-control form-filter input-md" name="merchant_name" placeholder="<?php echo e(trans(lang_app_site().'.CP.Merchant name')); ?> ..." id="merchant_name">

                </td>
                <td>
                  <div class="input-group date-picker input-daterange text-center" data-date="2012/11/10" data-date-format="yyyy-mm-dd">
                    <input type="text" class="form-control" name="from" placeholder="<?php echo e(trans(lang_app_site().'.CP.From')); ?>" id="order_date_from">
                    <span class="input-group-addon"> to </span>
                    <input type="text" class="form-control" id="order_date_to" name="to" placeholder="<?php echo e(trans(lang_app_site().'.CP.To')); ?>"></div>
                </td>
                <td>
                  <div class="input-group date-picker input-daterange text-center" data-date="2012/11/10" data-date-format="yyyy-mm-dd">
                    <input type="text" class="form-control" name="from" placeholder="<?php echo e(trans(lang_app_site().'.CP.From')); ?>" id="received_date_from">
                    <span class="input-group-addon"> to </span>
                    <input type="text" class="form-control" id="received_date_to" name="to" placeholder="<?php echo e(trans(lang_app_site().'.CP.To')); ?>"></div>

                </td>
                <td>
                  <select class="form-control input-md status" name="driver_type_id" id="driver_type_id" data-placeholder="Choose Driver Type">
                    <option value=""><?php echo e(trans(lang_app_site().'.CP.Choose driver type')); ?></option>
                    <?php $__currentLoopData = $driver_types; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $type): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <option value="<?php echo e($type->key); ?>"><?php echo e($type->name); ?></option>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                  </select>
                </td>
                <td>
                  <input type="text" class="form-control form-filter input-md" name="driver_name" placeholder="<?php echo e(trans(lang_app_site().'.CP.Driver name')); ?> ..." id="driver_name">

                </td>

                <td>
                  <div class="margin-bottom-5">
                    <a href="javascript:;" class="btn btn-sm btn-success btn-circle btn-icon-only filter-submit-report-c margin-bottom" title="Search">
                      <i class="fa fa-search"></i>
                    </a>

                    <a href="javascript:;" class="btn btn-sm btn-danger btn-circle btn-icon-only filter-cancel-report-c" title="Empty">
                      <i class="fa fa-redo"></i>
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


      <table class="table table-striped table-bordered table-hover table-checkable order-column" id="current_report_orders_tbl">
        <thead>
          <tr>
            <th>#</th>
            <th> <?php echo e(trans(lang_app_site().'.CP.Order #')); ?></th>
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
    <div class="tab-pane fade" id="finished_orders" role="tabpanel" aria-labelledby="contact-tab">


      <div class="portlet-title">
        <div class="caption font-dark">
          <i class="fa fa-search font-dark"></i>
          <span class="caption-subject bold uppercase"> Filter </span>
        </div>

      </div>
      <div class="portlet-body">
        <div class="table-container">
          <?php echo Form::open(['method'=>'POST','url'=>url('/admin/export')]); ?>

          <table class="table table-striped table-bordered table-hover table-checkable" id="finished_report_orders">
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
                  <input type="text" class="form-control form-filter input-md" name="order_no" placeholder="<?php echo e(trans(lang_app_site().'.CP.Order #')); ?> ..." id="order_no">

                </td>
                <td>
                  <input type="text" class="form-control form-filter input-md" name="merchant_name" placeholder="<?php echo e(trans(lang_app_site().'.CP.Merchant name')); ?> ..." id="merchant_name">

                </td>
                <td>
                  <div class="input-group date-picker input-daterange text-center" data-date="2012/11/10" data-date-format="yyyy-mm-dd">
                    <input type="text" class="form-control" name="from" placeholder="<?php echo e(trans(lang_app_site().'.CP.From')); ?>" id="order_date_from">
                    <span class="input-group-addon"> to </span>
                    <input type="text" class="form-control" id="order_date_to" name="to" placeholder="<?php echo e(trans(lang_app_site().'.CP.To')); ?>"></div>
                </td>
                <td>
                  <div class="input-group date-picker input-daterange text-center" data-date="2012/11/10" data-date-format="yyyy-mm-dd">
                    <input type="text" class="form-control" name="from" placeholder="<?php echo e(trans(lang_app_site().'.CP.From')); ?>" id="received_date_from">
                    <span class="input-group-addon"> to </span>
                    <input type="text" class="form-control" id="received_date_to" name="to" placeholder="<?php echo e(trans(lang_app_site().'.CP.To')); ?>"></div>

                </td>
                <td>
                  <select class="form-control input-md status" name="driver_type_id" id="driver_type_id" data-placeholder="Choose Driver Type">
                    <option value=""><?php echo e(trans(lang_app_site().'.CP.Choose driver type')); ?></option>
                    <?php $__currentLoopData = $driver_types; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $type): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <option value="<?php echo e($type->key); ?>"><?php echo e($type->name); ?></option>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                  </select>
                </td>
                <td>
                  <input type="text" class="form-control form-filter input-md" name="driver_name" placeholder="<?php echo e(trans(lang_app_site().'.CP.Driver name')); ?> ..." id="driver_name">

                </td>

                <td>
                  <div class="margin-bottom-5">
                    <a href="javascript:;" class="btn btn-sm btn-success btn-circle btn-icon-only filter-submit-report-f margin-bottom" title="Search">
                      <i class="fa fa-search"></i>
                    </a>

                    <a href="javascript:;" class="btn btn-sm btn-danger btn-circle btn-icon-only filter-cancel-report-f" title="Empty">
                      <i class="fa fa-redo"></i>
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



      <table class="table table-striped table-bordered table-hover table-checkable order-column" id="finished_report_orders_tbl">
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
    <div class="tab-pane fade" id="rejected_orders" role="tabpanel" aria-labelledby="rejected-tab">


      <div class="portlet-title">
        <div class="caption font-dark">
          <i class="fa fa-search font-dark"></i>
          <span class="caption-subject bold uppercase"> Filter </span>
        </div>

      </div>
      <div class="portlet-body">
        <div class="table-container">
          <?php echo Form::open(['method'=>'POST','url'=>url('/admin/export')]); ?>

          <table class="table table-striped table-bordered table-hover table-checkable" id="finished_report_orders">
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
                  <input type="text" class="form-control form-filter input-md" name="order_no" placeholder="<?php echo e(trans(lang_app_site().'.CP.Order #')); ?> ..." id="order_no">

                </td>
                <td>
                  <input type="text" class="form-control form-filter input-md" name="merchant_name" placeholder="<?php echo e(trans(lang_app_site().'.CP.Merchant name')); ?> ..." id="merchant_name">

                </td>
                <td>
                  <div class="input-group date-picker input-daterange text-center" data-date="2012/11/10" data-date-format="yyyy-mm-dd">
                    <input type="text" class="form-control" name="from" placeholder="<?php echo e(trans(lang_app_site().'.CP.From')); ?>" id="order_date_from">
                    <span class="input-group-addon"> to </span>
                    <input type="text" class="form-control" id="order_date_to" name="to" placeholder="<?php echo e(trans(lang_app_site().'.CP.To')); ?>"></div>
                </td>
                <td>
                  <div class="input-group date-picker input-daterange text-center" data-date="2012/11/10" data-date-format="yyyy-mm-dd">
                    <input type="text" class="form-control" name="from" placeholder="<?php echo e(trans(lang_app_site().'.CP.From')); ?>" id="received_date_from">
                    <span class="input-group-addon"> to </span>
                    <input type="text" class="form-control" id="received_date_to" name="to" placeholder="<?php echo e(trans(lang_app_site().'.CP.To')); ?>"></div>

                </td>
                <td>
                  <select class="form-control input-md status" name="driver_type_id" id="driver_type_id" data-placeholder="Choose Driver Type">
                    <option value=""><?php echo e(trans(lang_app_site().'.CP.Choose driver type')); ?></option>
                    <?php $__currentLoopData = $driver_types; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $type): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <option value="<?php echo e($type->key); ?>"><?php echo e($type->name); ?></option>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                  </select>
                </td>
                <td>
                  <input type="text" class="form-control form-filter input-md" name="driver_name" placeholder="<?php echo e(trans(lang_app_site().'.CP.Driver name')); ?> ..." id="driver_name">

                </td>

                <td>
                  <div class="margin-bottom-5">
                    <a href="javascript:;" class="btn btn-sm btn-success btn-circle btn-icon-only filter-submit-report-f margin-bottom" title="Search">
                      <i class="fa fa-search"></i>
                    </a>

                    <a href="javascript:;" class="btn btn-sm btn-danger btn-circle btn-icon-only filter-cancel-report-f" title="Empty">
                      <i class="fa fa-redo"></i>
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



      <table class="table table-striped table-bordered table-hover table-checkable order-column" id="rejected_report_orders_tbl">
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
</div>




<?php $__env->stopSection(); ?>

<?php $__env->startSection('js'); ?>
<!-- BEGIN PAGE LEVEL SCRIPTS -->
<script src="<?php echo e(url('/')); ?>/assets/pages/scripts/table-datatables-responsive.min.js" type="text/javascript"></script>


<!-- END PAGE LEVEL SCRIPTS -->
<script src="<?php echo e(url('/')); ?>/assets/js/users.js" type="text/javascript"></script>
<script src="<?php echo e(url('/')); ?>/assets/js/orders.js" type="text/javascript"></script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('merchant.V2.layout.index', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/saudidragonmart/public_html/resources/views/merchant/V2/orders/index.blade.php ENDPATH**/ ?>