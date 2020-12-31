
<div class="product-inner equal-elem">
    <div class="thumb">
        <a href="<?php echo e(url(site_url().'/service-providers')); ?>/<?php echo e($service->id); ?>" class="thumb-link"><img src=" <?php echo e(($service->icon) ? $service->icon: url('/assets/').'/no-product.jpg'); ?>" alt="" style="height: 220px; padding: 65px"></a>
    </div>
    <div class="info">
        <a href="<?php echo e(url(site_url().'/service-providers')); ?>/<?php echo e($service->id); ?>" class="product-name"><?php echo e($service->name); ?></a>
        <p class="description">Lorem Ipsum is simply dummy text of the printing and try. Lorem Ipsum has been the standard dummy text ever since the 1500s, when an unknown printer.</p>
    </div>
</div>


<?php $__env->startSection('javascript'); ?>
    <script>


    </script>
<?php $__env->stopSection(); ?><?php /**PATH /home/saudidragonmart/public_html/resources/views/site/sub_view/service.blade.php ENDPATH**/ ?>