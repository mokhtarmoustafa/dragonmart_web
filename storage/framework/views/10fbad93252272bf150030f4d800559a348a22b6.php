


<div class="merchant-item product-item layout1 col-ts-12 col-xs-6 col-sm-6 col-md-4 col-lg-4 no-padding">
    <div class="product-inner equal-elem">
        <div class="thumb">

            <a href="<?php echo e(url(site_url().'/service-profile-view')); ?>/<?php echo e($provider->id); ?>/<?php echo e($service->id); ?>" class="thumb-link"><img
                        src="<?php echo e(isset($provider->image)? $provider->image: url('/assets/').'/no-product.jpg'); ?>" alt="" style="height: 220px"></a>
        </div>
        <div class="info">
            <a href="<?php echo e(url(site_url().'/service-profile-view')); ?>/<?php echo e($provider->id); ?>/<?php echo e($service->id); ?>" class="product-name"><?php echo e($provider->username); ?></a>
            <p class="description"><?php echo e($provider->bio); ?></p>
            <div class="price">
                <span><?php echo e($provider->city->name_en); ?></span>
            </div>
            <div class="product-rate">
                <?php $rate =  (int)$provider->service_rate ;
                             $neg_rate = (int) 5- $provider->service_rate ;
                ?>
                <?php for($i=0 ; $i < $rate; ++$i): ?>
                    <i class="fa fa-star active"></i>
                <?php endfor; ?>
                <?php for($i=0 ; $i <  $neg_rate; ++$i): ?>
                    <i class="fa fa-star "></i>
                <?php endfor; ?>

            </div>
        </div>
    </div>
</div>


<?php $__env->startSection('javascript'); ?>
    <script>


    </script>
<?php $__env->stopSection(); ?><?php /**PATH /home/saudidragonmart/public_html/resources/views/site/sub_view/oneservice.blade.php ENDPATH**/ ?>