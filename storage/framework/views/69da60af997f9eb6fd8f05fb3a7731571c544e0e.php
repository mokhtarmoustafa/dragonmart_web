<li class="box-minicart">
    <div class="minicart">
        <div class="cart-block  box-has-content">
            <a href="<?php echo e(url(site_url().'/shipping-cart')); ?>" class="cart-icon"><i
                        class="fa fa-shopping-basket white" aria-hidden="true"></i><span
                        class="count"></span></a>
            <span class="total-price"><span class="text white"><?php echo e(trans(lang_app_site().'.home.cart')); ?>: </span> <span
                        class="coin white"><?php echo e(trans(lang_app_site().'.home.sar')); ?></span></span>
        </div>
        <div class="cart-inner">
            <h5 class="title"><?php echo e(trans(lang_app_site().'.product.have')); ?> <span
                        class="count-item">0</span> <?php echo e(trans(lang_app_site().'.product.items_cart')); ?></h5>
            <ul class="list-item mm" id="ContCartList">
                <?php echo e(trans('app.no_items')); ?>

            </ul>
            <div class="subtotal">
                <span class="text"><?php echo e(trans(lang_app_site().'.product.total')); ?> : </span>
                <span class="total-price"><span
                            class="text">0</span>    </span><span> <?php echo e(trans(lang_app_site().'.home.sar')); ?></span>
            </div>
            <div class="group-button-checkout">
                <a href="<?php echo e(url(site_url().'/shipping-cart')); ?>"><?php echo e(trans(lang_app_site().'.product.view_cart')); ?></a>
                <a href="<?php echo e(url(site_url().'/order')); ?>"><?php echo e(trans(lang_app_site().'.product.checkout')); ?></a>
            </div>
        </div>
    </div>
</li><?php /**PATH /home/saudidragonmart/public_html/resources/views/site/sub_view/cartheader.blade.php ENDPATH**/ ?>