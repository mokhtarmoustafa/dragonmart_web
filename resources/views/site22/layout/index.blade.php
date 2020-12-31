<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title> DragonMart</title>
    @include(site_layout_vw().'.css')
    <link href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/css/toastr.css" rel="stylesheet" type="text/css">

    <meta name="csrf-token" content="{{ csrf_token() }}"/>
    <link rel="stylesheet" href="{{ url('/jquery.timepicker.min.css') }}">

    <link rel="stylesheet"
          href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datetimepicker/4.17.47/css/bootstrap-datetimepicker.css">
    <link rel="stylesheet"
          href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datetimepicker/4.17.47/css/bootstrap-datetimepicker-standalone.min.css">
    <link rel="stylesheet"
          href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.5.0/css/bootstrap-datepicker.standalone.min.css"/>

    <link href="{{ asset('assets/site/datetimepicker/bootstrap-datetimepicker.min.css') }}" rel="stylesheet">


</head>
<body class="home home1">
<div class="special-container">
    <!--Header-->
@include(site_layout_vw().'.header')

<!--/Header-->
    <!--Content-->
@yield('content')
<!--/Content-->
</div>
<!--Footer-->
@include(site_layout_vw().'.footer')
<!--/Footer-->
<a class="back-to-top" href="#"></a>

@include(site_layout_vw().'.js')
<script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/js/toastr.min.js"></script>
<script>
    toastr.options = {
        "debug": false,
        "positionClass": "toast-bottom-right",
        "onclick": null,
        "fadeIn": 300,
        "fadeOut": 1000,
        "timeOut": 5000,
        "extendedTimeOut": 1000
    }

    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    var baseURL = '{{url('/')}}';
</script>
<script src="{{url('assets/site/js/jquery.validate.js')}}"></script>
<script src="{{url('assets/site/datetimepicker/moment-with-locales.min.js')}}"></script>

<script src="{{url('assets/site/datetimepicker/bootstrap-datetimepicker.min.js')}}"></script>


@yield('javascript')

<script>
    quant = 1;
    var toastTitle = '{{trans(lang_app_site().'.product.add_to_cart')}}';
    var toastBody = '{{trans(lang_app_site().'.product.add_cart_successfully')}}';
    @if( auth()->user() )

        authuser = '{{auth()->user()->id}}';
    @else
        authuser = 0;

    @endif



    function logout() {
        cartfromstorage = localStorage.getItem("cart");
        var cart = JSON.parse(cartfromstorage);
        if (typeof (cart) != "undefined" && cart !== null) {


            localStorage.removeItem('cart');

        }
        window.location = '{{url(site_url().'/logout/web')}}';
    }

    $(document).ready(function () {


        $('#textsearch').keypress(function (e) {
            var key = e.which;
            if (key == 13)  // the enter key code
            {
                var txt = $('#textsearch').val();
                var cat = $('#catSelect').val();

                if (txt != '') {

                    window.location = '{{url(site_url().'/search')}}/' + txt + '/' + cat;
                } else {

                }
                return false;
            }
        });


        $(".search-button").on("click", function () {
            var txt = $('#textsearch').val();
            var cat = $('#catSelect').val();

            if (txt != '') {

                window.location = '{{url(site_url().'/search')}}/' + txt + '/' + cat;
            } else {

            }

        });

        getCart();

            <?php
            $parameters = \Request::query();
            $m = http_build_query($parameters);
            ?>
        var checklastseg = '<?php echo $m ?>';
        var parts = checklastseg.split('=');
        // checklastseg = $.parseJSON(checklastseg);
        var urlParams = new URLSearchParams(window.location.search);
        page_num = urlParams.get('page_size');
        if (page_num > 1) {
            $('#pageSelect').val(page_num);
        } else {
            $('#pageSelect').val(10);
        }


    });


    function addToOrder(id) {

        extra_ids = addExtraIDs();


        if (typeof (extra_price) != "undefined" && extra_price !== null && extra_price > 0) {

            var data = {product_id: id, quantity: quant, custom_id: extra_ids};
        } else {
            var data = {product_id: id, quantity: quant};
        }


        jQuery.ajax({
            url: "{{url(site_url().'/directorder')}}",
            type: 'POST',
            dataType: "json",
            data: data,
            success: function (data) {
                if (data.status) {
                    window.location = '{{url(site_url().'/directorder')}}';
                } else {
                    window.location = data.redirect;
                }

            }
        });


    }


    function addToCart(id, name, image, price, precentage, quantity) {
        // toastTitle = 'Add To Cart';
        // toastBody = 'Add This Product to Cart Successfully';
        toastTitle = '{{trans(lang_app_site().'.product.add_to_cart')}}';
        toastBody = '{{trans(lang_app_site().'.product.add_cart_successfully')}}';


        var newprice = price;
        if (typeof (extra_price) != "undefined" && extra_price !== null) {
            if (extra_price > 0) {
                newprice = newprice + extra_price;
            }
        }


        newprice = newprice * quant;

        minus = newprice * precentage;
        minus = minus / 100;

        newprice = newprice - minus;
        newprice = newprice.toFixed(1);
        newprice = parseFloat(newprice);


        extra_ids = addExtraIDs();


        if (authuser > 0) {


            if (typeof (extra_price) != "undefined" && extra_price !== null && extra_price > 0) {

                var data = {product_id: id, quantity: quant, custom_id: extra_ids};
            } else {
                var data = {product_id: id, quantity: quant};
            }


            jQuery.ajax({
                url: "{{url(site_url().'/addtocart')}}",
                type: 'POST',
                dataType: "json",
                data: data,
                success: function (data) {
                    if (data.success) {
                        getCart();
                    }
                }
            });


        } else {
            //  itemarray = { id: product.id , name :product.name ,imahe:product.images[0].image , quantity:quantity  };


            var itemarray =
                {
                    cart: [
                        {
                            id: id,
                            name: name,
                            image: image,
                            price: price,
                            totalprice: newprice,
                            quantity: quant,
                            extra_id: extra_ids
                        },
                    ]
                };


            cartfromstorage = localStorage.getItem("cart");
            if (typeof (cartfromstorage) != "undefined" && cartfromstorage !== null) {
                var cart = JSON.parse(cartfromstorage);
            }


            if (typeof (cart) != "undefined" && cart !== null) {

                for (var i = 0; i < cart.cart.length; i++) {
                    if (cart.cart[i].id == id) {
                        //cart.cart.splice(i, 1);
                        cart.cart[i].id = 600;
                        console.log(' yaa is same');

                    }
                }


                cart.cart.push(
                    {
                        id: id,
                        name: name,
                        image: image,
                        price: price,
                        totalprice: newprice,
                        quantity: quant,
                        extra_id: extra_ids
                    }
                );

                localStorage.setItem('cart', JSON.stringify(cart));


            } else {
                localStorage.setItem('cart', JSON.stringify(itemarray));
            }

        }

        $('#addBtn' + id).replaceWith('<a href="javascript:void(0)"  class="add-to-cart" id="addBtn' + id + '" onclick="removeCart(' + id + ' , \'' + name + ' \'  , \'' + image + '\',' + price + ',' + precentage + ',' + quant + ')"> <span class="text"> Remove </span></a>');
        $('#quckaddcart').replaceWith('<a href="javascript:void(0)"  class="add-to-cart" id="addBtn' + id + '" onclick="removeCart(' + id + ' , \'' + name + ' \'  , \'' + image + '\',' + price + ',' + precentage + ',' + quant + ')"> <span class="text"> Remove </span></a>');
        toastr.success(toastBody, toastTitle);
        quant = 1;
        getCart();

    }


    function removeCart(id, name, image, price, precentage, quantity) {
        // toastBody = 'Successfully reomve item from Cart';
        // toastTitle = 'Remove Item';

        toastTitle = '{{trans(lang_app_site().'.product.remove_from_cart')}}';
        toastBody = '{{trans(lang_app_site().'.product.remove_cart_successfully')}}';

        if (authuser > 0) {

            jQuery.ajax({
                url: "{{url('/site/product_cart')}}" + '/' + id,
                type: 'DELETE',
                dataType: "json",
                data: {
                    id: id
                },
                success: function (data) {
                    if (data.success) {
                        getCart();
                    }


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

        }


        $('#addBtn' + id).replaceWith('<a href="javascript:void(0)"  class="add-to-cart" id="addBtn' + id + '" onclick="addToCart(' + id + ' , \'' + name + ' \'  , \'' + image + '\',' + price + ',' + precentage + ',' + quantity + ')"> <span class="text"> {{trans(lang_app_site().'.product.add_to_cart')}} </span></a>');
        toastr.success(toastBody, toastTitle);
        getCart();
    }


    function getCart() {

        if (authuser > 0) {

            jQuery.ajax({
                url: "{{url(site_url().'/cart')}}",
                type: 'get',
                dataType: "json",
                success: function (data) {
                    proccessCartTable(data);

                    // console.log(data)
                    // proccessDataCart(data);
                }
            });


        } else {

            cartfromstorage = localStorage.getItem("cart");
            if (typeof (cartfromstorage) != "undefined" && cartfromstorage !== null) {
                var cart = JSON.parse(cartfromstorage);

                if (typeof (cart) != "undefined" && cart !== null && typeof (cart.cart) != "undefined") {


                    var itemcart = '';
                    var totalprice = 0;


                    for (var i = 0; i < cart.cart.length; i++) {
                        totalprice = totalprice + cart.cart[i].totalprice;


                        if (typeof (cart.cart[i].image) != "undefined" && cart.cart[i].image !== null) {
                            valimage = cart.cart[i].image;
                        } else {
                            valimage = baseURL + '/assets/no-product.jpg';
                        }

                        itemcart += ' <li class="product-item">';


                        itemcart += '  <a href="{{url(site_url().'/product-page')}}/' + cart.cart[i].id + '" class="thumb">';
                        itemcart += '   <img src="' + valimage + '"';
                        itemcart += '   alt="" width="90"></a>';
                        itemcart += '     <div class="info">';
                        itemcart += '     <a href="{{url(site_url().'/product-page')}}/' + cart.cart[i].id + '" class="product-name">' + cart.cart[i].name + '';
                        itemcart += '   </a>';
                        itemcart += '   <div class="product-item-qty">';
                        itemcart += '      <span class="number price">';
                        itemcart += '      <span class="qty">' + cart.cart[i].quantity + '</span> x <span>' + cart.cart[i].totalprice + ' {{trans(lang_app_site().'.home.sar')}}</span>';
                        itemcart += '   </span>';
                        itemcart += '  </div>';
                        itemcart += '  </div>';
                        itemcart += '  </li>';
                    }

                    $('.mm').empty();
                    $('.mm').append(itemcart);
                    $('.count').html(cart.cart.length);
                    $('.count-item').html(cart.cart.length);
                    $('.total-price .text').html(totalprice);

                    // $('#ContCartList').empty();
                    // $('#ContCartList').html(itemcart);
                    // $('.count-item').html(cart.cart.length);
                    // $('.total-price').html(totalprice);

                    if (cart.cart.length == 0) {
                        $('.count').hide();
                        $('.count-item').hide();
                        $('.total-price').hide();
                        $('.cart-inner').hide();
                        $('.box-minicart .minicart').toggleClass('changed');

                    } else {
                        $('.count').show();
                        $('.count-item').show();
                        $('.total-price').show();
                        $('.cart-inner').show();
                        $('.box-minicart .minicart').removeClass('changed');
                    }

                }

            } else {
                $('.count').hide();
                $('.count-item').hide();
                $('.total-price').hide();
                $('.cart-inner').hide();
                $('.box-minicart .minicart').toggleClass('changed');
            }
        }
    }


    function proccessDataCart(data) {

        if (data.status && data.items.length > 0) {

            var itemcart = '';
            var totalprice = 0;
            var countitems = 0;
            var items = data.items;
            for (var j = 0; j < items.length; j++) {

                itemcart += ' <li class="product-item">' + items[j].username + '</li>';

                var cart = items[j].products_cart;
                console.log('cart is ' + cart.length);
                for (var i = 0; i < cart.length; i++) {
                    itemcart += ' <li class="product-item" style="padding-left: 20px">';

                    itemcart += '  <a href="#" class="thumb"><img';
                    if (typeof (cart[i].product.images[0]) != "undefined" && cart[i].product.images[0] !== null) {
                        valimage = cart[i].product.images[0].image;
                    } else {
                        valimage = baseURL + '/assets/no-product.jpg';
                    }

                    itemcart += '   <img src="' + valimage + '" alt="" width="90"></a>';
                    itemcart += '     <div class="info"><a href="{{url(site_url().'/product-page/')}}/' + cart[i].product.id + '" class="product-name">' + cart[i].product.name + '';
                    itemcart += '   </a>';
                    itemcart += '   <div class="product-item-qty">';
                    itemcart += '      <span class="number price">';
                    itemcart += '      <span class="qty">' + cart[i].quantity + '</span> x <span>' + cart[i].price + '  {{trans(lang_app_site().'.home.sar')}}</span>';
                    itemcart += '   </span>';
                    itemcart += '  </div>';
                    itemcart += '  </div>';

                    totalprice = totalprice + cart[i].total_price;
                    countitems = countitems + 1;
                    itemcart += '  </li>';

                }


            }

            console.log(itemcart)
            $('.mm').empty();
            $('.mm').append(itemcart);
            $('.count').html(countitems);
            $('.count-item').html(countitems);
            // $('.total-price').html(totalprice);
            $('.total-price .text').html(totalprice);
            //

            {{--$('#carttab').empty();--}}
                    {{--$('#carttab').html(itemcart);--}}
                    {{--$('#countitemds').html(countitems);--}}
                    {{--$('.totalprice').html(totalprice.toFixed(1) + ' {{trans('app.site.home.sar')}}');--}}


            if (data.items.length == 0) {
                $('.count').hide();
                $('.count-item').hide();
                $('.total-price').hide();
                $('.cart-inner').hide();
                $('.box-minicart .minicart').toggleClass('changed');

            } else {
                $('.count').show();
                $('.count-item').show();
                $('.total-price').show();
                $('.cart-inner').show();
                $('.box-minicart .minicart').removeClass('changed');
            }


        } else {

            $('.count').hide();
            $('.count-item').hide();
            $('.total-price').hide();
            $('.cart-inner').hide();
            $('.box-minicart .minicart').toggleClass('changed');
        }
    }


    $('#pageSelect').change(function () {


        var urlParams = new URLSearchParams(window.location.search);
        page_num = urlParams.get('page_size');

        urlParams.set('page_size', $('#pageSelect').val());

        console.log('new iss ' + urlParams);

        var segment = '{{count(request()->segments())}}';
        if (segment == 3) {
            var url = '{{url(site_url())}}' + '/' + '{{request()->segment(2) }}/{{request()->segment(3) }}?' + urlParams;

        } else {
            var url = '{{url(site_url())}}' + '/' + '{{request()->segment(2) }}?' + urlParams;

        }
        console.log('the seg is' + segment);


        console.log('url is ' + url);

        window.location = url;

    });


    function addExtraIDs() {
        extra_ids = [];
        if (typeof (extra_id1) != "undefined" && extra_id1 !== null && extra_id1 > 0) {
            extra_ids.push(extra_id1);
        }
        if (typeof (extra_id2) != "undefined" && extra_id1 !== null && extra_id2 > 0) {
            extra_ids.push(extra_id2);
        }
        if (typeof (extra_id3) != "undefined" && extra_id3 !== null && extra_id3 > 0) {
            extra_ids.push(extra_id3);
        }
        if (typeof (extra_id4) != "undefined" && extra_id4 !== null && extra_id4 > 0) {
            extra_ids.push(extra_id4);
        }
        if (typeof (extra_id5) != "undefined" && extra_id5 !== null && extra_id5 > 0) {
            extra_ids.push(extra_id5);
        }


        return extra_ids;

    }


</script>

<style>

    .box-minicart .minicart.changed:after {
        /* this selector is more specific, so it takes precedence over the other :after */
        display: none;
    }

</style>

</body>
</html>
