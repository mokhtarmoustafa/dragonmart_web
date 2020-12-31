<?php $__env->startSection('css'); ?>
<style>
.circle {
  height: 50px;
  width: 50px;
  background-color: #ffffff;
  border-width: 1px;
  border-style: solid;
  border-color: grey;
  border-radius: 50%;
}
</style>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('content'); ?>

<div class="card card-custom mb-2">
  <div class="card-header flex-wrap border-0 pt-6 pb-0">
    <h3 class="card-title align-items-start flex-column">
      <span class="card-label font-weight-bolder font-size-h3 text-dark">
        <?php echo e($order->Merchant->username); ?>

        <a href="<?php echo e(url(getAuth()->type . '/user/' . $order->merchant_id)); ?>" class="btn btn-icon btn-primary btn-circle btn-sm mr-2">
          <i class="flaticon2-map"></i>
        </a>
      </span>
            <span class="text-muted mt-1 font-weight-bold font-size-sm">#<?php echo e($order->id); ?></span>
    </h3>

    <div class="card-toolbar">
      <a href="<?php echo e(url(getAuth()->type.'/invoice/'.$order->id)); ?>" target="_blank" class="btn btn-outline-success font-weight-bold">
        <i class="flaticon2-print"></i><?php echo e(trans(lang_app_site().'.CP.Invoice')); ?></a>
      </div>


  </div>

  <div class="card-body">

    <div class="d-flex justify-content-between pt-6">
      <div class="d-flex flex-column flex-root">
        <span class="font-weight-bolder mb-2"><?php echo e(trans(lang_app_site().'.CP.item#')); ?></span>
        <span class="opacity-70"><?php echo e($order->OrderProducts->count()); ?></span>
      </div>
      <div class="d-flex flex-column flex-root">
        <span class="font-weight-bolder mb-2"><?php echo e(trans(lang_app_site().'.CP.Order date')); ?></span>
        <span class="opacity-70"><?php echo e($order->created_at); ?></span>
      </div>
      <div class="d-flex flex-column flex-root">
        <span class="font-weight-bolder mb-2"><?php echo e(trans(lang_app_site().'.CP.State')); ?></span>
        <span class="opacity-70"><?php echo e($order->last_status); ?></span>
      </div>
      <div class="d-flex flex-column flex-root">
        <span class="font-weight-bolder mb-2"><?php echo e(trans(lang_app_site().'.CP.Delivery method')); ?></span>
        <span class="opacity-70"><?php echo e($order->delivery_method); ?></span>
      </div>
    </div>


    <div class="d-flex justify-content-between pt-6">
      <div class="d-flex flex-column flex-root">
        <span class="font-weight-bolder mb-2">
          <?php echo e(trans(lang_app_site().'.CP.Buyer Name')); ?>


          <a href="<?php echo e(url(getAuth()->type . '/user/' . $order->order_user->client->id)); ?>" class="btn btn-icon btn-primary btn-circle btn-sm mr-2">
            <i class="flaticon2-map"></i>
          </a>


        </span>
        <span class="opacity-70"><?php echo e($order->order_user->client->username); ?></span>
      </div>
      <div class="d-flex flex-column flex-root">
        <span class="font-weight-bolder mb-2"><?php echo e(trans(lang_app_site().'.CP.Procurement method')); ?></span>
        <span class="opacity-70"><?php echo e($order->order_user->procurement_method); ?></span>
      </div>
      <div class="d-flex flex-column flex-root">
        <span class="font-weight-bolder mb-2"><?php echo e(trans(lang_app_site().'.CP.Received at')); ?></span>
        <span class="opacity-70"><?php echo e($order->order_user->received_datetime); ?></span>
      </div>
      <div class="d-flex flex-column flex-root">
        <span class="font-weight-bolder mb-2"><?php echo e(trans(lang_app_site().'.CP.Buyer Phone')); ?></span>
        <span class="opacity-70"><?php echo e($order->order_user->client->mobile); ?></span>
      </div>
    </div>

  </div>

</div>


<div class="card card-custom mb-1">
  <div class="card-header">
    <h3 class="card-title align-items-start flex-column">
      <span class="card-label font-weight-bolder font-size-h3 text-dark"><?php echo e(trans(lang_app_site().'.CP.Products')); ?></span>
      <span class="text-muted mt-1 font-weight-bold font-size-sm">#<?php echo e($order->id); ?></span>
    </h3>
  </div>

  <div class="card-body">

    <table class="table">
      <thead>
        <tr>
          <th scope="col">#</th>
          <th scope="col"><?php echo e(trans(lang_app_site().'.CP.Product name')); ?></th>
          <th scope="col"><?php echo e(trans(lang_app_site().'.CP.Quantity')); ?></th>
          <th scope="col"><?php echo e(trans(lang_app_site().'.CP.Price')); ?></th>
          <th scope="col"><?php echo e(trans(lang_app_site().'.CP.Customizations')); ?></th>
        </tr>
      </thead>
      <tbody>

        <?php $__currentLoopData = $order->order_products; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $order_product): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>

        <tr>
          <th scope="row">1</th>
          <td>
            <div class="d-flex align-items-center">
              <div class="symbol symbol-40 symbol-sm flex-shrink-0">
                <img class="" src="<?php echo e($order_product->product->images[0]->image100 ?? url('assets/no-product.jpg')); ?>" alt="photo">
              </div>
              <div class="ml-4">
                <div class="text-dark-75 font-weight-bolder font-size-lg mb-0"><?php echo e($order_product->product->name); ?></div>
                <a href="#" class="text-muted font-weight-bold text-hover-primary"><?php echo e($order_product->product->category->name); ?></a>
              </div>
            </div>
          </td>
          <td><?php echo e($order_product->quantity); ?></td>
          <td><?php echo e($order_product->product->price); ?> SAR</td>
          <td>
            <?php $__currentLoopData = $order_product->Customizations; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $custom): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <?php if($custom->custom_id == 3): ?>
            <div class="col-md-1 circle"
            style="background-color:<?php echo e($custom->text); ?>;text-align: center;padding-top: 14px; margin-left: 4px;"></div>
            <?php else: ?>
            <div class="col-md-1 circle"
            style="text-align: center;padding-top: 14px;margin-left: 4px;">
            <?php echo e($custom->text); ?>

            </div>
            <?php endif; ?>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
          </td>
        </tr>

        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        <tr>
          <td colspan="2"></td>
          <td class="font-weight-bolder"><?php echo e(trans(lang_app_site().'.CP.shipment rate')); ?></td>
          <td class="font-weight-bolder"><?php echo e($order->shipment_price); ?> SAR</td>
          <td></td>
        </tr>
        <tr>
          <td colspan="2"></td>
          <td class="font-weight-bolder font-size-h4">الإجمالي</td>
          <td class="font-weight-bolder font-size-h4"><?php echo e($order->products_price + $order->shipment_price); ?> SAR</td>
          <td></td>
        </tr>

      </tbody>
    </table>
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

    <!-- BEGIN THEME GLOBAL SCRIPTS -->
    <script src="<?php echo e(url('/')); ?>/assets/global/scripts/app.min.js" type="text/javascript"></script>
    <!-- END THEME GLOBAL SCRIPTS -->
    

    <script src="<?php echo e(url('/')); ?>/assets/pages/scripts/ui-modals.min.js" type="text/javascript"></script>

    <!-- BEGIN PAGE LEVEL SCRIPTS -->
    <script src="<?php echo e(url('/')); ?>/assets/pages/scripts/table-datatables-responsive.min.js" type="text/javascript"></script>

    
    <!-- END PAGE LEVEL SCRIPTS -->
    <script src="<?php echo e(url('/')); ?>/assets/js/users.js" type="text/javascript"></script>

    <?php $__env->stopSection(); ?>

<?php echo $__env->make(merchant_layout_vw().'.index', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/saudidragonmart/public_html/resources/views/merchant/V2/orders/order_det.blade.php ENDPATH**/ ?>