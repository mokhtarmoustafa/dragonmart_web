<?php $__env->startSection('content'); ?>
    <div class="main-content shop-page inner-page shoppingcart-content">
        <div class="container">
            <div class="breadcrumbs">
                <a href="<?php echo e(url('site/home')); ?>"><?php echo e(trans('app.site.home.home')); ?></a> \ <span
                        class="current"><?php echo e(trans('app.shopping_cart')); ?></span>
            </div>
            <div class="row content-form">
                <div class="col-xs-12 col-sm-12 col-md-8 col-lg-9 content-offset">
                    <div class="cart-content" id="carttab">


                    </div>

                    <table class="shopping-cart-content">
                        <tr class="checkout-cart group-button">
                            <td colspan="6" class="left">
                                <div class="left">
                                    <a href="<?php echo e(url(site_url().'/home')); ?>"
                                       class="continue-shopping submit"><?php echo e(trans('app.continue_shopping')); ?></a>
                                </div>
                                <div class="right">
                                    <a href="javascript:;" onclick="removeAllFromCat()"
                                       class="submit update clear_cart"><?php echo e(trans('app.site.product.clear_cart')); ?></a>
                                    <a href="<?php echo e(url(site_url().'/shipping-cart')); ?>"
                                       class="submit update"><?php echo e(trans('app.update_shopping_cart')); ?></a>
                                </div>
                            </td>
                        </tr>
                    </table>

                </div>
                <div class="col-xs-12 col-sm-12 col-md-4 col-lg-3 ">
                    <div class="proceed-checkout">
                        <h4 class="main-title"><?php echo e(trans('app.continue_checkout')); ?></h4>
                        <div class="content">
                            <h5 class="title"><?php echo e(trans('app.site.product.total_price')); ?></h5>
                            <div class="info-checkout">
                                <span class="text"><?php echo e(trans('app.cart_items')); ?>: </span><span class="item"
                                                                                             id="countitemds">0</span>
                            </div>
                            <div class="info-checkout">
                                <span class="text"><?php echo e(trans('app.site.product.cart_subtotal')); ?>: </span><span
                                        class="item totalprice">0 <?php echo e(trans('app.site.home.sar')); ?></span>
                            </div>
                            <div class="total-checkout">
                                <span class="text"><?php echo e(trans('app.site.product.total_price')); ?> </span><span
                                        class="price totalprice"> 0 <?php echo e(trans('app.site.home.sar')); ?></span>
                            </div>
                            <div class="group-button">
                                <a href="<?php echo e(url(site_url().'/order')); ?>"
                                   class="button submit"><?php echo e(trans('app.site.product.checkout')); ?></a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>


        </div>
    </div>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('javascript'); ?>
    <script>
        var cartId;
        $(document).ready(function () {
            <?php if( Auth::user() ): ?>

                authuser = '<?php echo e(Auth::user()->id); ?>';
            cartId = '<?php echo e($cart->id); ?>';
            <?php else: ?>
                authuser = 0;
            cartId = '';

            <?php endif; ?>

            if (authuser > 0) {

                jQuery.ajax({
                    url: "<?php echo e(url(site_url().'/cart')); ?>",
                    type: 'get',
                    dataType: "json",
                    success: function (data) {
                        if (data.items.length > 0) {
                            proccessCartTable(data);
                        } else {
                            window.location = '<?php echo e(url(site_url()).'/home'); ?>';
                        }
                    }
                });


            } else {
                getCartToTable();
            }


        });


        function onC(id) {
            quant = parseInt($('#quant_product_' + id).val());

            if (authuser > 0) {


                jQuery.ajax({
                    url: "<?php echo e(url(site_url().'/addtocart')); ?>",
                    type: 'POST',
                    dataType: "json",
                    data: {
                        product_id: id, quantity: quant
                    },
                    success: function (data) {

                        if (data.status) {
                            getCart();
                        }
                    }
                });


            } else {

                cartfromstorage = localStorage.getItem("cart");
                var cart = JSON.parse(cartfromstorage);
                if (typeof (cart) != "undefined" && cart !== null) {
                    var totalnew = 0;
                    for (var i = 0; i < cart.cart.length; i++) {
                        if (cart.cart[i].id == id) {
                            cart.cart[i].id = id;
                            cart.cart[i].quantity = quant;

                            var priceone = cart.cart[i].price;
                            totalnew = priceone * quant;
                            cart.cart[i].totalprice = totalnew;


                        }
                    }
                    localStorage.setItem('cart', JSON.stringify(cart));
                    getCartToTable();

                }


            }


        }


        function getCartToTable() {
            //console.log(' get table dat');
            cartfromstorage = localStorage.getItem("cart");

            console.log(cartfromstorage)
            if (typeof (cartfromstorage) != "undefined" && cartfromstorage !== null) {
                var cart = JSON.parse(cartfromstorage);

                if (typeof (cart) != "undefined" && cart !== null) {


                    var item = '';
                    // var totalprice = 0;
                    var totalprice_ = 0;

                    item += ' <h4 class="shop-title"><?php echo e(trans('app.cart_shipping')); ?></h4>';
                    item += ' <table class="shopping-cart-content" >';
                    item += '<tr class="title">';
                    item += '  <td width="80" class="product-thumb"></td>';
                    item += '  <td class="product-name"><?php echo e(ucfirst(trans(lang_app_site().'.product.name'))); ?></td>';
                    item += '<td class="price"><?php echo e(ucfirst(trans(lang_app_site().'.product.unit_price'))); ?></td>';
                    item += ' <td class="quantity-item"><?php echo e(ucfirst(trans(lang_app_site().'.product.quantity'))); ?></td>';
                    item += '  <td class="total"><?php echo e(ucfirst(trans(lang_app_site().'.product.cart_subtotal'))); ?></td>';
                    item += '   <td class="delete-item"></td>';
                    item += '</tr>';


                    for (var i = 0; i < cart.cart.length; i++) {

                        if (typeof (cart.cart[i].image) != "undefined" && cart.cart[i].image !== null) {
                            valimage = cart.cart[i].image;
                        } else {
                            valimage = baseURL + '/assets/no-product.jpg';
                        }

                        item += ' <tr class="each-item">';
                        item += ' <td class="product-thumb"><a href="<?php echo e(url(site_url().'/product-page')); ?>/' + cart.cart[i].id + '"> ';
                        item += '<img src="' + valimage + '" alt=""></a></td>';
                        item += '<td class="product-name" data-title="Product Name"><a href="<?php echo e(url(site_url().'/product-page')); ?>/' + cart.cart[i].id + '" class="product-name">Until ';
                        item += cart.cart[i].name + '</a></td>';
                        item += '<td class="price" data-title="Unit Price">' + cart.cart[i].price + '</td>';
                        item += ' <td class="quantity-item" data-title="Qty">';
                        item += '   <div class="quantity"> ';
                        item += '   <div class="group-quantity-button"> ';
                        item += '    <a class="minus" href="javascript:void(0)"><i class="fa fa-minus" aria-hidden="true"></i></a>';
                        item += '  <input class="input-text qty text" type="text" size="4" title="Qty" min="1"';
                        item += ' value="' + cart.cart[i].quantity + '" name="quantity" onchange="onC(' + cart.cart[i].id + ')" id="quant_product_' + cart.cart[i].id + '"> ';
                        item += '     <a class="plus" href="javascript:void(0)"><i class="fa fa-plus" aria-hidden="true"></i></a>';
                        item += '   </div>';
                        item += ' </div>';
                        item += '   </td> ';
                        item += '<td class="total" data-title="SubTotal">' + cart.cart[i].totalprice + ' <?php echo e(trans(lang_app_site().'.home.sar')); ?></td>';
                        item += '<td class="delete-item"><a href="javascript:void(0)" onclick="removeFromCat(' + cart.cart[i].id + ')"><i class="fa fa-times" aria-hidden="true"></i></a>';
                        item += '</td>';
                        item += ' </tr>';
                        totalprice_ += cart.cart[i].totalprice;
                    }

                    item += '</table>';

                    $('#carttab').empty();
                    $('#carttab').append(item);
                    $('#countitemds').html(cart.cart.length);
                    $('.totalprice').html(totalprice_ + ' <?php echo e(trans(lang_app_site().'.home.sar')); ?>');


                    if (cart.cart.length == 0) {
                        window.location = '<?php echo e(url(site_url()).'/home'); ?>';
                    }

                    return;

                } else {

                    window.location = '<?php echo e(url(site_url()).'/home'); ?>';
                }

            } else {

                window.location = '<?php echo e(url(site_url()).'/home'); ?>';
            }


        }


        function removeFromCat(id) {
            toastBody = '<?php echo e(trans(lang_app_site().'.product.remove_cart_successfully')); ?>';
            toastTitle = '<?php echo e(trans(lang_app_site().'.product.remove_item')); ?>';

            if (authuser > 0) {


                jQuery.ajax({
                    url: "<?php echo e(url('/site/product_cart')); ?>" + '/' + id,
                    type: 'DELETE',
                    dataType: "json",
                    data: {
                        id: id
                    },
                    success: function (data) {
                        location.reload();

                    }
                });

            } else {

                cartfromstorage = localStorage.getItem("cart");
                var cart = JSON.parse(cartfromstorage);
                if (typeof (cart) != "undefined" && cart !== null) {

                    for (var i = 0; i < cart.cart.length; i++) {
                        if (cart.cart[i].id == id) {
                            cart.cart.splice(i, 1);
                        }
                    }
                    localStorage.setItem('cart', JSON.stringify(cart));

                }


                toastr.success(toastBody, toastTitle);
                getCartToTable();
                getCart();


            }
        }

        function removeAllFromCat() {
            toastBody = '<?php echo e(trans(lang_app_site().'.product.remove_cart_successfully')); ?>';
            toastTitle = '<?php echo e(trans(lang_app_site().'.product.remove_item')); ?>';

            if (authuser > 0) {


                jQuery.ajax({
                    url: "<?php echo e(url(site_url().'/cart/')); ?>/" + cartId,
                    type: 'DELETE',
                    dataType: "json",
                    success: function (data) {
                        location.reload();

                    }
                });

            } else {

                localStorage.removeItem('cart');
                toastr.success(toastBody, toastTitle);
                getCartToTable();
                getCart();


            }
        }


        function proccessCartTable(data) {

            var item = '';
            var totalprice = 0;
            var countitems = 0;
            var newcart = data.items; //products_cart ;
            var total = 0;
            for (var j = 0; j < newcart.length; j++) {
                item += ' <h4 class="shop-title">' + newcart[j].username + '</h4>';
                item += ' <table class="shopping-cart-content" >';
                item += '<tr class="title">';
                item += '  <td width="80" class="product-thumb"></td>';
                item += '  <td class="product-name"><?php echo e(ucfirst(trans('app.site.product.name'))); ?></td>';
                item += '<td class="price"><?php echo e(ucfirst(trans('app.site.product.unit_price'))); ?></td>';
                item += ' <td class="quantity-item"><?php echo e(ucfirst(trans('app.site.product.quantity'))); ?></td>';
                item += '  <td class="total"><?php echo e(ucfirst(trans('app.site.product.cart_subtotal'))); ?> <?php echo e(trans(lang_app_site().'.home.sar')); ?></td>';
                item += '   <td class="delete-item"></td>';
                item += '</tr>';

                cart = newcart[j].products_cart;
                var totalprice_prod = 0;


                for (var i = 0; i < cart.length; i++) {
                    totalprice = totalprice + cart[i].total_price;
                    countitems = countitems + 1;

                    item += ' <tr class="each-item">';
                    item += ' <td class="product-thumb"><a href="<?php echo e(url(site_url().'/product-page')); ?>/' + cart[i].product.id + '"> ';
                    if (typeof (cart[i].product.images[0]) != "undefined" && cart[i].product.images[0] !== null) {
                        valimage = cart[i].product.images[0].image;
                    } else {
                        valimage = baseURL + '/assets/no-product.jpg';
                    }

                    item += '<img src="' + valimage + '" alt=""></a></td>';
                    item += '<td class="product-name" data-title="Product Name"><a href="<?php echo e(url(site_url().'/product-page')); ?>/' + cart[i].product.id + '" class="product-name">Until ';
                    item += cart[i].product.name + '</a></td>';
                    item += '<td class="price unit_price" data-title="Unit Price">' + cart[i].price + '</td>';
                    item += ' <td class="quantity-item" data-title="Qty">';
                    item += '   <div class="quantity"> ';
                    item += '   <div class="group-quantity-button"> ';
                    item += '    <a class="minus" href="#"><i class="fa fa-minus" aria-hidden="true"></i></a>';
                    item += '  <input class="input-text qty text" type="text" size="4" title="Qty" min="1"';
                    item += ' value="' + cart[i].quantity + '" name="quantity" onchange="onC(' + cart[i].product.id + ')" id="quant_product_' + cart[i].product.id + '"> ';
                    item += '     <a class="plus" href="#"><i class="fa fa-plus" aria-hidden="true"></i></a>';
                    item += '   </div>';
                    item += ' </div>';
                    item += '   </td> ';
                    totalprice_prod = Number(cart[i].total_price.toFixed(1));
                    totalprice_prod = parseFloat(totalprice_prod);

                    item += '<td class="total" data-title="SubTotal">' + totalprice_prod + ' <?php echo e(trans('app.site.home.sar')); ?></td>';
                    item += '<td class="delete-item"><a href="javascript:void(0)" onclick="removeFromCat(' + cart[i].id + ')"><i class="fa fa-times" aria-hidden="true"></i></a>';
                    item += '</td>';
                    item += ' </tr>';

                    total += cart[i].total_price;

                }

                item += '</table>';
            }

            $('#carttab').empty();
            $('#carttab').append(item);
            $('#countitemds').html(countitems);
            $('.totalprice').html(total + ' <?php echo e(trans('app.site.home.sar')); ?>');

            if (cart.length == 0) {
                window.location = '<?php echo e(url(site_url()).'/home'); ?>';
            }


            // console.log('go thank ');
        }


    </script>

<?php $__env->stopSection(); ?>

<?php echo $__env->make(site_layout_vw().'.index', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/saudidragonmart/public_html/resources/views/site/cart/list.blade.php ENDPATH**/ ?>