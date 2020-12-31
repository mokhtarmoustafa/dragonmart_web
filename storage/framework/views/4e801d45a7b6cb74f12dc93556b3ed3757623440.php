<div class="product_wrap">
    <div class="product_img">
        <a href="<?php echo e(url(site_url().'/product-page')); ?>/<?php echo e($product->id); ?>">
            <img src="<?php echo e(isset($product->images[0]->image300)? $product->images[0]->image : url('/assets/').'/no-product.jpg'); ?>" alt="el_img1">
            <img class="product_hover_img" src="<?php echo e(isset($product->images[0]->image300)? $product->images[0]->image: url('/assets/').'/no-product.jpg'); ?>" alt="el_hover_img1">
        </a>
        <div class="product_action_box">
            <ul class="list_none pr_action_btn">
                <li class="add-to-cart"><a href="javascript:void(0)" onclick="addToCart(<?php echo e($product->id); ?> , '<?php echo e($product->name); ?>' ,'<?php echo e(isset($product->images[0])? $product->images[0]->image : url('/assets/').'/no-product.jpg'); ?>' , <?php echo e($product->price); ?> , <?php echo e(($product->offer_percentage )?$product->offer_percentage: 0); ?> ,1); return false;"
                id="addBtn<?php echo e($product->id); ?>"><i class="icon-basket-loaded"></i> Add To Cart</a></li>
                <li><a href="shop-compare.html" class="popup-ajax"><i class="icon-shuffle"></i></a></li>
                <li><a href="shop-quick-view.html" class="popup-ajax" onclick="openView(<?php echo e($product); ?>)"><i class="icon-magnifier-add"></i></a></li>
                <li><a href="#"><i class="icon-heart"></i></a></li>
            </ul>
        </div>
    </div>
    <div class="product_info">
        <h6 class="product_title"><a href="<?php echo e(url(site_url().'/product-page')); ?>/<?php echo e($product->id); ?>"><?php echo e($product->name); ?></a></h6>
        <div class="product_price">


            <?php if($product->is_offer): ?>
                    <span class="del"><?php echo e($product->price); ?> <?php echo e(trans(lang_app_site().'.home.sar')); ?></span>
                    <div class="on_sale">
                        <span><?php echo e($product->offer_price); ?>  <?php echo e(trans(lang_app_site().'.home.sar')); ?></span>
                    </div>

            <?php else: ?>

                <span class="price"><?php echo e($product->price); ?> <?php echo e(trans(lang_app_site().'.home.sar')); ?></span>
            <?php endif; ?>

        </div>
        <div class="rating_wrap">
            <div class="rating">
                <div class="product_rate" style="width:80%"></div>
            </div>
            <span class="rating_num">(21)</span>
        </div>
        <div class="pr_desc">
            <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Phasellus blandit massa enim. Nullam id varius nunc id varius nunc.</p>
        </div>
    </div>
</div>


<!--
<div class="product-inner equal-elem">
    <div class="thumb">
        <a href="#" class="quickview-button" onclick="openView(<?php echo e($product); ?>)"><span class="icon"><i class="fa fa-eye"
                                                                                                    aria-hidden="true"></i></span>
            <?php echo e(trans(lang_app_site().'.product.quick_view')); ?></a>
        <a href="<?php echo e(url(site_url().'/product-page')); ?>/<?php echo e($product->id); ?>" class="thumb-link">

            <img style="height: 250px"
                 src="<?php echo e(isset($product->images[0]->image300)? $product->images[0]->image300 : url('/assets/').'/no-product.jpg'); ?>"
                 class="product-img" alt="">
        </a>
    </div>
    <div class="info">
        <a href="<?php echo e(url(site_url().'/product-page')); ?>/<?php echo e($product->id); ?>" class="product-name"><?php echo e($product->name); ?></a>

        <?php if($product->is_offer): ?>
            <div class="price">
                <span class="del"><?php echo e($product->price); ?> <?php echo e(trans(lang_app_site().'.home.sar')); ?></span>
                <span class="ins"><?php echo e($product->offer_price); ?>  <?php echo e(trans(lang_app_site().'.home.sar')); ?></span>
            </div>
        <?php else: ?>

            <div class="price">
                <span><?php echo e($product->price); ?> <?php echo e(trans(lang_app_site().'.home.sar')); ?></span>
            </div>
        <?php endif; ?>


        <div class="cat-rate row">
            <div class="col-xs-7">
                <div class="category">
                    <a href="#" class="button"><?php echo e(($product->category) ? $product->category->name : ''); ?></a>
                </div>
            </div>
            <div class="col-xs-5">
                <div class="product-rate">

                    <?php $rate =  (int)$product->rate ;
                             $neg_rate = (int)5- $product->rate ;
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
    <div class="group-button">
        <div class="inner">
            <a href="javascript:void(0)" class="add-to-cart"
               onclick="addToCart(<?php echo e($product->id); ?> , '<?php echo e($product->name); ?>' ,'<?php echo e(isset($product->images[0])? $product->images[0]->image : url('/assets/').'/no-product.jpg'); ?>' , <?php echo e($product->price); ?> , <?php echo e(($product->offer_percentage )?$product->offer_percentage: 0); ?> ,1); return false;"
               id="addBtn<?php echo e($product->id); ?>"><span
                        class="text"><?php echo e(trans(lang_app_site().'.product.add_to_cart')); ?></span></a>
        </div>
    </div>
</div> -->

<style>
    .quicprice .del {
        font-size: 13px;
        color: #888;
        font-weight: 400;
        text-decoration: line-through;
    }
</style>



<?php $__env->startSection('javascript'); ?>
    <script>
        function openView(product) {
            var HTMLVIEW = '<div class="kt-popup-quickview ">' +
                '<div class="details-thumb col-xs-12 col-sm-6">' +
                '<div class="owl-carousel nav-style4 has-thumbs" data-autoplay="false" data-nav="true" data-dots="false" data-loop="false" data-slidespeed="800">';

            var Arr = product.images;

            $.each(product.images, function (index, value) {
                HTMLVIEW += '<div class="details-item">';
                HTMLVIEW += '<img src="' + value.image + '" alt="" style="max-height:350px; width: 100%; margin:0 auto"></div>';
            });


            HTMLVIEW += '</div></div>' +
                '<div class="details-info col-xs-12 col-sm-6">' +
                '<a href="detail.html" class="product-name">' + product.name + '</a>' +
                '<div class="rating"><ul class="list-star">';

            var rate = product.rate;
            var ngrate = 5 - rate;
            for (i = 0; i < rate; i++) {
                HTMLVIEW += '<li><a href="#"><i class="fa fa-star" aria-hidden="true"></i></a></li>';
            }
            for (i = 0; i < ngrate; i++) {
                HTMLVIEW += '<li><a href="#"><i class="fa fa-star-o" aria-hidden="true"></i></a></li>';
            }

            HTMLVIEW += '</ul><span class="count"></span>' +
                '</div>';
            if (product.description != null) {
                HTMLVIEW += '<p class="description">' + product.description + '</p>';
            }

            HTMLVIEW += '<div class="price quicprice">';
            // offer_price
            if (product.is_offer == 1) {


                HTMLVIEW += '  <span class="del">' + product.price + ' <?php echo e(trans(lang_app_site().'.home.sar')); ?></span>';
                HTMLVIEW += '<span > ' + product.offer_price + ' <?php echo e(trans(lang_app_site().'.home.sar')); ?></span>';
            } else {

                HTMLVIEW += '<span > ' + product.price + ' <?php echo e(trans(lang_app_site().'.home.sar')); ?></span>';
            }

            HTMLVIEW += '</div>' +
                '<div class="group-button"><div class="inner"><a href="#" id="quckaddcart" class="add-to-cart" onclick="addToCart(' + product.id + ' , \'' + product.name + ' \'  , \'' + product.images[0].image + '\',' + product.price + ',' + product.offer_percentage + ',1)">' +
                '<span class="text"><?php echo e(trans(lang_app_site().'.product.add_to_cart')); ?></span><span class="icon">' +
                '<i class="fa fa-cart-arrow-down" aria-hidden="true"></i></span>' +
                '</a></div></div></div></div>';
            $.magnificPopup.open({
                items: {
                    src: HTMLVIEW,
                    type: 'inline'
                }
            });
            // kt_innit_carousel();
            return false;
        }

    </script>
<?php $__env->stopSection(); ?>
<?php /**PATH /home/saudidragonmart/public_html/resources/views/site/sub_view/product.blade.php ENDPATH**/ ?>