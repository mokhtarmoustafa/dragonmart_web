<?php $__env->startSection('content'); ?>
<div class="container" dir="rtl">
    <div class="merchant-header bg-white p-5">
        <div class="d-flex">
            <div class="symbol symbol-success ml-2">
                <img alt="Pic" src="<?php echo e((isset($merchant->store_images[0]))?$merchant->store_images[0]->image : url('/').'/assets/site/no-product.jpg'); ?>" />
            </div>
            <div class="d-flex align-items-center px-3">
                <span class="font-weight-bold display-4"><?php echo e($merchant->username); ?></span>
            </div>
        </div>
    </div>

    <div class="container-fluid p-5">
        <div class="nav nav-pills row flex-row flex-nowrap" id="tab">
            <?php $counter = 0; ?>

            <?php $__currentLoopData = $merchant->Storecat; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $categorie): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <?php $counter += 1; ?>

            <a href="#cat_<?php echo e($categorie->id); ?>" class="btn btn-hover-primary font-weight-bold py-3 px-6 mb-2 mx-1 text-center <?php echo e($counter == 1 ? 'active' : ''); ?>" data-toggle="pill"><?php echo e($categorie->name_ar); ?></a>

            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </div>
    </div>
    <?php $counter = 0; ?>
    <div class="tab-content" id="tabContent">
        <?php $__currentLoopData = $merchant->Storecat; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $categorie): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
        <?php $counter += 1; $row_counter = 0; ?>
        <div class="tab-pane fade <?php echo e($counter == 1 ? 'active show' : ''); ?>" id="cat_<?php echo e($categorie->id); ?>">
            <?php if(isset($categorie['Products'])): ?>
            <div class="row">
                <?php $__currentLoopData = $categorie['Products']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $product): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <?php $row_counter += 1; ?>

                <div class="col-md-3 col-xxl-3 col-lg-12 mb-5">
                    <div class="card card-custom card-shadowless">
                        <div class="card-body p-0">
                            <div class="overlay">
                                <div class="overlay-wrapper rounded bg-white text-center h-200px mh-100 mw-100 w-100 ">
                                    <img src="<?php echo e(count($product->images) > 0  ? $product->images[0]['image300'] : url('/assets/img/logo_text.png')); ?>" class="w-100 w-200px h-200px">
                                </div>
                                <div class="separator separator-solid separator-border-2"></div>
                                <div class="mt-5 mb-md-0 mb-lg-5 mb-md-0 mb-lg-5 mb-lg-0 mb-5 d-flex flex-column PX-3">
                                    <div class="row px-5">
                                        <span class="font-size-h5 font-weight-bolder text-dark-75 mb-1"><?php echo e($product->name); ?></span>
                                    </div>
                                    <div class="row px-5">
                                        <span class="font-size-h5 font-weight-bolder text-dark-75 mb-1"><?php echo e(round($product->price, 2)); ?> ريال</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </div>
            <?php endif; ?>
        </div>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    </div>
</div>

<?php $__env->stopSection(); ?>

<style>
    .container-fluid>.row {
        overflow-x: auto;
        white-space: nowrap;
    }

    .container-fluid-group>.row>.btn {
        display: inline-block;
    }
</style>
<?php echo $__env->make(site_layout_vw().'.index', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\Dragon\resources\views/site/merchants/merchant-page.blade.php ENDPATH**/ ?>