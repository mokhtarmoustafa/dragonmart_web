<?php $__env->startSection('content'); ?>

    <div class="main-content shop-page inner-page about-page">
        <div class="container">
            <div class="breadcrumbs">
                <a href="<?php echo e(url('site/home')); ?>"><?php echo e(__('app.site.home.home')); ?></a> \ <span
                    class="current"><?php echo e(__('app.site.home.term')); ?></span>
            </div>
            <div class="container">
                <div class="about-text">
                    
                    <h4 class="wow fadeInDown"><?php echo e($term->title); ?></h4>
                    <p class="wow fadeInDown"><?php echo $term->desc; ?></p>
                </div>
            </div>
        </div>
    </div>

<?php $__env->stopSection(); ?>

<?php echo $__env->make(site_layout_vw().'.index', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/saudidragonmart/public_html/resources/views/site/term.blade.php ENDPATH**/ ?>