
<div class="product-inner equal-elem">
    <div class="thumb">
        <a href="<?php echo e(url(site_url().'/category')); ?>/<?php echo e($service->id); ?>" class="thumb-link"><img src=" <?php echo e(($service->icon) ? $service->icon: url('/assets/').'/no-product.jpg'); ?>" alt="" style="height: 220px; padding: 50px"></a>
    </div>
    <div class="info">
        <a href="<?php echo e(url(site_url().'/category')); ?>/<?php echo e($service->id); ?>" class="product-name"><?php echo e($service->name); ?></a>
    </div>
</div>

<?php /**PATH /home/saudidragonmart/public_html/resources/views/site/sub_view/categoriy.blade.php ENDPATH**/ ?>