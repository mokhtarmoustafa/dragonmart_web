<?php $__env->startSection('content'); ?>

<div class="row">
    <div class="col-xl-4">
        <div class="card card-custom card-stretch gutter-b">
            <div class="card-body d-flex flex-column p-0">
                <div class="d-flex align-items-center justify-content-between card-spacer flex-grow-1">
                    <div class="d-flex flex-column mr-2">
                        <a href="#" class="text-dark-75 text-hover-primary font-weight-bolder font-size-h5"><?php echo e(trans(lang_app_site().'.CP.New orders')); ?></a>
                        <span class="text-muted font-weight-bold mt-2">-</span>
                    </div>
                    <span class="symbol symbol-light-success symbol-45">
                        <span class="symbol-label font-weight-bolder font-size-h6"><?php echo e($new_orders); ?></span>
                    </span>
                </div>
                <div id="kt_stats_widget_7_chart" class="card-rounded-bottom" style="height: 150px"></div>
            </div>
        </div>
    </div>
    <div class="col-xl-4">
        <!--begin::Stats Widget 8-->
        <div class="card card-custom card-stretch gutter-b">
            <!--begin::Body-->
            <div class="card-body d-flex flex-column p-0">
                <div class="d-flex align-items-center justify-content-between card-spacer">
                    <div class="d-flex flex-column mr-2">
                        <a href="#" class="text-dark-75 text-hover-primary font-weight-bolder font-size-h5"><?php echo e(trans(lang_app_site().'.CP.Current orders')); ?></a>
                        <span class="text-muted font-weight-bold mt-2">-</span>
                    </div>
                    <span class="symbol symbol-light-danger symbol-45">
                        <span class="symbol-label font-weight-bolder font-size-h6"><?php echo e($current_orders); ?></span>
                    </span>
                </div>
                <div id="kt_stats_widget_8_chart" class="card-rounded-bottom" style="height: 150px"></div>
            </div>
            <!--end::Body-->
        </div>
        <!--end::Stats Widget 8-->
    </div>
    <div class="col-xl-4">
        <!--begin::Stats Widget 9-->
        <div class="card card-custom card-stretch gutter-b">
            <!--begin::Body-->
            <div class="card-body d-flex flex-column p-0">
                <div class="d-flex align-items-center justify-content-between card-spacer">
                    <div class="d-flex flex-column mr-2">
                        <a href="#" class="text-dark-75 text-hover-primary font-weight-bolder font-size-h5"><?php echo e(trans(lang_app_site().'.CP.Completed orders')); ?></a>
                        <span class="text-muted font-weight-bold mt-2">-</span>
                    </div>
                    <span class="symbol symbol-light-primary symbol-45">
                        <span class="symbol-label font-weight-bolder font-size-h6"><?php echo e($completed_orders); ?></span>
                    </span>
                </div>
                <div id="kt_stats_widget_9_chart" class="card-rounded-bottom" style="height: 150px"></div>
            </div>
            <!--end::Body-->
        </div>
    </div>
</div>


<?php $__env->stopSection(); ?>
<?php echo $__env->make('merchant.layout.index', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\Dragon\resources\views/merchant/home.blade.php ENDPATH**/ ?>