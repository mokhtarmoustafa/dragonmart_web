<?php $__env->startSection('css'); ?>
<!-- BEGIN PAGE LEVEL PLUGINS -->
<link href="<?php echo e(url('/')); ?>/assets/global/plugins/datatables/datatables.min.css" rel="stylesheet" type="text/css" />
<link href="<?php echo e(url('/')); ?>/assets/global/plugins/datatables/plugins/bootstrap/datatables.bootstrap.css" rel="stylesheet" type="text/css" />
<!-- END PAGE LEVEL PLUGINS -->
<!-- BEGIN THEME GLOBAL STYLES -->
<link href="<?php echo e(url('/')); ?>/assets/global/css/plugins-md.min.css" rel="stylesheet" type="text/css" />
<!-- END THEME GLOBAL STYLES -->
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
        <div class="row static-info">
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
            <div class="col-md-6 name bg-danger text-white rounded p-3">
                <?php echo e(trans(lang_app_site().'.CP.Rejecte reason')); ?>:
                <span class="value">
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
                            <div class="form-actions" style="background-color: #f5f5f5;">
                                <div class="row">
                                    <div class="col-md-12 text-center">
                                        <a href="<?php echo e(url(getAuth()->type.'/invoice/'.$order->id)); ?>" target="_blank" class="btn btn-circle green btn-md save">
                                            <i class="fa fa-check"></i>
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
</div>
<?php $__currentLoopData = $order->order_products; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $order_product): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>

<?php $customs = json_decode($order_product->custom); ?>

<div class="card card-custom card-collapsed mt-5" data-card="true" id="accordion<?php echo e($order_product->id); ?>">
    <div class="card-header bg-dark">
        <div class="card-title">
            <h3 class="card-label text-white"><?php echo e($order_product->product->name); ?></h3>
        </div>
        <div class="card-toolbar">
            <a href="#" class="mr-1" data-card-tool="toggle" data-toggle="tooltip" data-placement="top" title="Toggle Card">
                <i class="ki ki-arrow-down icon-nm"></i>
            </a>
        </div>
    </div>
    <div class="card-body">

        <div class="row static-info mb-10">
            <?php $images = json_decode(json_encode($order_product->product->images), true); ?>
            <div class="col-md-2"><img src="<?php echo e(is_array($images) && isset($images[0]) ? $images[0]['image100']  : ''); ?>" /></div>
            <div class="col-md-4 name"><?php echo e(trans(lang_app_site().'.CP.Product name')); ?>: <span class="value"><?php echo e($order_product->product->name); ?></span></div>
            <div class="col-md-2 name"><?php echo e(trans(lang_app_site().'.CP.Quantity')); ?>: <span class="value"><?php echo e($order_product->qty); ?></span></div>
            <div class="col-md-2 name"><?php echo e(trans(lang_app_site().'.CP.Category')); ?>: <span class="value"><?php echo e($order_product->product->category->name_ar); ?></span></div>
            <div class="col-md-2 name"><?php echo e(trans(lang_app_site().'.CP.Price')); ?>: <span class="value"><?php echo e($order_product->price); ?> SAR</span></div>
        </div>
        <?php if($customs != null): ?>
        <div class="row">
            
            <?php $__currentLoopData = $customs; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $custom): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <!--begin::List Widget 19-->
            <div class="col-md-4 col-12 value">
                <div class="card card-custom card-stretch gutter-b border shadow-none">
                    <!--begin::Header-->
                    <div class="card-header border-0 pt-6 mb-2 bg-gray-300">
                        <h3 class="card-title align-items-start flex-column">
                            <span class="card-label font-weight-bold font-size-h4 mb-3"><?php echo e($custom->name); ?></span>
                        </h3>
                    </div>
                    <!--end::Header-->
                    <!--begin::Body-->
                    <div class="card-body pt-2">
                        <!--begin::Table-->
                        <div class="table-responsive">
                            <table class="table mb-0">
                                <tbody>
                                    <thead>
                                        <tr>
                                            <th class="pb-6"><?php echo e(trans(lang_app_site().'.CP.Title')); ?></th>
                                            <th class="text-right pb-6"><?php echo e(trans(lang_app_site().'.CP.Price')); ?></th>
                                        </tr>
                                    </thead>
                                    <!--begin::Item-->
                                    <?php $__currentLoopData = $custom->options; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $custom_det): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <tr>
                                        <td class="font-size-lg font-weight-bolder text-dark-75 align-middle w-150px pb-6"><?php echo e($custom_det->details_name); ?></td>
                                        <td class="font-weight-bolder font-size-lg text-dark-75 text-right align-middle pb-6"><?php echo e($custom_det->details_price); ?></td>
                                    </tr>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    <!--end::Item-->
                                </tbody>
                            </table>
                        </div>
                        <!--end::Table-->
                    </div>
                    <!--end::Body-->
                </div>
            </div>
            <!--end::List Widget 19-->
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </div>
        <?php endif; ?>
    </div>
</div>
<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('js'); ?>

<!-- BEGIN PAGE LEVEL PLUGINS -->
<script src="<?php echo e(url('/')); ?>/assets/global/scripts/datatable.js" type="text/javascript"></script>
<script src="<?php echo e(url('/')); ?>/assets/global/plugins/datatables/datatables.min.js" type="text/javascript"></script>
<script src="<?php echo e(url('/')); ?>/assets/global/plugins/datatables/plugins/bootstrap/datatables.bootstrap.js" type="text/javascript"></script>
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
<?php echo $__env->make(admin_layout_vw().'.index', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/saudidragonmart/public_html/resources/views/admin/orders/order_det.blade.php ENDPATH**/ ?>