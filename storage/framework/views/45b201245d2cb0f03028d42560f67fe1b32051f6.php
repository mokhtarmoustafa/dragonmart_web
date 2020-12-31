<?php $__env->startSection('content'); ?>
<div class="card card-custom">
  <div class="card-header">
    <div class="card-title">
      <i class="<?php echo e($icon); ?> font-dark ml-2"></i>
      <span class="caption-subject bold uppercase"><?php echo e(trans(lang_app_site().'.CP.'.$main_title)); ?> #<?php echo e($order->id); ?></span>
    </div>
    <div class="card-toolbar">
      <?php if($order->last_status == 'new'): ?>
      <span class="label label-inline label-xl label-rounded label-light-warning font-weight-bolder"><?php echo e(trans(lang_app_site().'.CP.Order status')); ?>: <?php echo e(trans(lang_app_site().'.CP.New')); ?></span>
      <?php elseif($order->last_status == 'accepted'): ?>
      <span class="label label-inline label-xl label-rounded label-light-success font-weight-bolder"><?php echo e(trans(lang_app_site().'.CP.Order status')); ?>: <?php echo e(trans(lang_app_site().'.CP.In Progress')); ?></span>
      <?php elseif($order->last_status == 'pickup'): ?>
      <span class="label label-inline label-xl label-rounded label-outline-success font-weight-bolder"><?php echo e(trans(lang_app_site().'.CP.Order status')); ?>: <?php echo e(trans(lang_app_site().'.CP.Completed')); ?></span>
      <?php elseif($order->last_status == 'rejected'): ?>
      <span class="label label-inline label-xl label-rounded label-light-danger font-weight-bolder"><?php echo e(trans(lang_app_site().'.CP.Order status')); ?>: <?php echo e(trans(lang_app_site().'.CP.Rejected')); ?></span>
      <?php endif; ?>
    </div>

  </div>
  <div class="card-body">
    <div class="row static-info">
      <div class="col-md-3 name"><?php echo e(trans(lang_app_site().'.CP.Merchant name')); ?>: <span class="value"><?php echo e($order->Merchant->username); ?></span></div>
      <div class="col-md-3 name"><?php echo e(trans(lang_app_site().'.CP.Order date')); ?>: <span class="value"><?php echo e($order->created_at); ?></span></div>
      <div class="col-md-3 name"><?php echo e(trans(lang_app_site().'.CP.Items #')); ?>: <span class="value"><?php echo e($order->OrderProducts->count()); ?></span></div>
      <?php if($order->order_time > '00:05:00'): ?>
      <div class="col-md-3 name label label-lg font-weight-bolder label-rounded label-danger label-inline"><?php echo e(trans(lang_app_site().'.CP.Order time')); ?>:&nbsp;<span class="value"> <?php echo e($order->order_time); ?></span></div>
      <?php else: ?>
      <div class="col-md-3 name label label-lg font-weight-bolder label-rounded label-success label-inline"><?php echo e(trans(lang_app_site().'.CP.Order time')); ?>:&nbsp;<span class="value"> <?php echo e($order->order_time); ?></span></div>
      <?php endif; ?>
    </div>
    <hr>
    <div class="row static-info">
      <div class="col-md-3 name"><?php echo e(trans(lang_app_site().'.CP.Client Name')); ?>: <span class="value"><?php echo e($order->order_user->client->username); ?></span></div>
      <div class="col-md-3 name"><?php echo e(trans(lang_app_site().'.CP.Procurement method')); ?>: <span class="value"><?php echo e($order->order_user->procurement_method); ?></span></div>
      <div class="col-md-3 name"><?php echo e(trans(lang_app_site().'.CP.Client Phone')); ?>: <span class="value"><?php echo e($order->order_user->client->mobile); ?></span></div>
      <div class="col-md-3 name"><?php echo e(trans(lang_app_site().'.CP.Received at')); ?>: <span class="value"><?php echo e($order->order_user->received_datetime); ?></span></div>
    </div>
    <hr>
    <div class="row static-info">
      <div class="col-md-3 name"><?php echo e(trans(lang_app_site().'.CP.Delivery method')); ?>: <span class="value"><?php echo e($order->delivery_method); ?></span></div>
      <div class="col-md-3 name"><?php echo e(trans(lang_app_site().'.CP.Order amount')); ?>: <span class="value"><?php echo e($order->products_price); ?> SAR</span></div>
      <div class="col-md-3 name"><?php echo e(trans(lang_app_site().'.CP.Shipment rate')); ?>: <span class="value"><?php echo e($order->shipment_price); ?> SAR</span></div>
      <div class="col-md-3 name"><?php echo e(trans(lang_app_site().'.CP.Total amount')); ?>: <span class="value"><?php echo e($order->products_price + $order->shipment_price); ?> SAR</span></div>
    </div>
    <hr>
    <div class="row static-info mb-5">
      <div class="col-md-3 name">
        <?php echo e(trans(lang_app_site().'.CP.Client Location')); ?>:
        <span class="value">
          <a href="<?php echo e(url(((getAuth()->type == 'admin')?admin_user_tab_url():getAuth()->type) . '/user/' . $order->order_user->client->id)); ?>" class="btn btn-circle btn-icon-only blue user-det" title="Address">
            <i class="fa fa-map"></i>
          </a>
        </span>
      </div>
      <div class="col-md-3 name">
        <?php echo e(trans(lang_app_site().'.CP.Store Location')); ?>:
        <span class="value">
          <a href="<?php echo e(url(((getAuth()->type == 'admin')?admin_user_tab_url():getAuth()->type) . '/user/' . $order->merchant_id)); ?>" class="btn btn-circle btn-icon-only blue user-det" title="Address">
            <i class="fa fa-map"></i>
          </a>
        </span>
      </div>
      <?php if($order->last_status == 'rejected'): ?>
      <div class="col-md-6 name bg-light-danger text-danger font-weight-bolder border border-danger rounded p-3">
        <?php echo e(trans(lang_app_site().'.CP.Rejecte reason')); ?>:
        <span class="value text-danger">
          <?php echo e($order->reject_reason); ?>

        </span>
      </div>
      <?php endif; ?>
    </div>

    <div class="row static-info">
      <div class="col-md-12 text-center">
        <div class="portlet-form">
          <form class="form-horizontal form">
            <div class="form-body">
              <div class="form-actions">
                <div class="row">
                  <div class="col-md-12 text-center">
                    <a href="<?php echo e(url(getAuth()->type.'/invoice/'.$order->id)); ?>" target="_blank" class="btn btn-circle bg-success text-white btn-md save">
                      <i class="fa fa-check text-white"></i>
                      Invoice
                    </a>
                  </div>
                </div>
              </div>
            </div>
          </form>
        </div>
      </div>

    </div>
  </div>


  <div class="card card-custom mt-5">
    <div class="card-header">
      <div class="card-title">
        <i class="<?php echo e($icon); ?> font-dark ml-2"></i>
        <span class="caption-subject bold uppercase">المنتجات</span>
      </div>
    </div>
    <div class="card-body">
      <table id="order_products_tbl" class="table table-striped table-bordered table-hover table-checkable order-column" style="width:100%">
        <thead>
          <tr>
            <th></th>
            <th><?php echo e(trans(lang_app_site().'.CP.Product name')); ?></th>
            <th><?php echo e(trans(lang_app_site().'.CP.Quantity')); ?></th>
            <th><?php echo e(trans(lang_app_site().'.CP.Category')); ?></th>
            <th><?php echo e(trans(lang_app_site().'.CP.Price')); ?></th>
            <th><?php echo e(trans(lang_app_site().'.CP.Action')); ?></th>
          </tr>
        </thead>
        <tbody>
        
      </tbody>

      </table>
    </div>

  </div>
  <?php $__env->stopSection(); ?>


  <?php $__env->startSection('js'); ?>
  <script>
    var products = <?php echo json_encode($order->order_products, JSON_HEX_TAG); ?>;
  </script>

  <script src="<?php echo e(url('/')); ?>/assets/js/products.js" type="text/javascript"></script>
  <?php $__env->stopSection(); ?>
<?php echo $__env->make(merchant_layout_vw().'.index', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\Dragon\resources\views/merchant/V2/orders/order_det.blade.php ENDPATH**/ ?>