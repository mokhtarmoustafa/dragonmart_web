<!-- Modal-->
<div class="modal fade" id="#custom_<?php echo e(app('request')->input('a')); ?>" data-backdrop="static" tabindex="-1" role="dialog" aria-labelledby="staticBackdrop" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Modal Title</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <i aria-hidden="true" class="ki ki-close"></i>
                </button>
            </div>
            <div class="modal-body">
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

                        <?php $customs = json_decode($customs); ?>
                        <?php if($customs != null && count($customs) > 0): ?>
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
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-light-primary font-weight-bold" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary font-weight-bold">Save changes</button>
            </div>
        </div>
    </div>
</div><?php /**PATH C:\xampp\htdocs\Dragon\resources\views/admin/orders/costom.blade.php ENDPATH**/ ?>