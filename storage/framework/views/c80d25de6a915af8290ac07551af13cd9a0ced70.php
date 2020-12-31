<!-- Modal-->
<div class="modal fade bs-modal-lg" id="<?php echo e($modal_id); ?>" data-backdrop="static" tabindex="-1" role="dialog" aria-labelledby="staticBackdrop" aria-hidden="true">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title"><?php echo $modal_title; ?></h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <i aria-hidden="true" class="ki ki-close"></i>
                </button>
            </div>
            <div class="modal-body">

                <?php
                $customs = json_decode(json_decode($customs));
                ?>

                <?php if($customs != null && count($customs) > 0): ?>
                <div class="row">

                    <?php $__currentLoopData = $customs; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $custom): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <?php if(count($custom->options) > 0): ?>
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
                    <?php endif; ?>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </div>
                <?php endif; ?>

            </div>
        </div>
    </div>
</div><?php /**PATH C:\xampp\htdocs\Dragon\resources\views/merchant/V2/orders/product_custom_mdl.blade.php ENDPATH**/ ?>