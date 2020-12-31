@extends(site_layout_vw().'.index')

@section('content')
    <div class="main-content shop-page inner-page main-content-detail">
        <div class="container">
            <div class="breadcrumbs">
                <a href="#">{{trans(lang_app_site().'.home.home')}}</a> \ <span
                        class="current">{{trans(lang_app_site().'.product.detail')}}</span>
            </div>
            <div class="row">
                <div class="col-xs-12 col-sm-7 col-md-8 col-lg-9 content-offset">
                    <div class="about-product row">
                        <div class="details-thumb col-xs-12 col-sm-12 col-md-6 col-lg-6">
                            <div class="owl-carousel nav-style3 has-thumbs" data-autoplay="false" data-nav="true"
                                 data-dots="false" data-loop="false" data-slidespeed="800" data-margin="0"
                                 data-responsive='{"0":{"items":1}, "480":{"items":2}, "768":{"items":1}, "1024":{"items":1}, "1200":{"items":1}}'>
                                @if(count($product->images) > 0)
                                    @foreach($product->images as $image )
                                        <div class="details-item"><img
                                                    src="{{isset($image->image300)? $image->image300 : url('/assets/').'/no-product.jpg'}}"
                                                    alt="">
                                        </div>
                                    @endforeach
                                @else
                                    <img src="{{url('/assets/').'/no-product.jpg'}}"
                                         alt="">
                                @endif

                            </div>
                        </div>
                        <div class="details-info col-xs-12 col-sm-12 col-md-6 col-lg-6">
                            <a href="{{url(site_url().'/product-page')}}" class="product-name">{{$product->name}}</a>
                            <h4 class="product-name orders-no">{{$product->order_count}} {{trans(lang_app_site().'.product.order')}}</h4>
                            <div class="rating">
                                <div class="product-rate">
                                    @php
                                        $rate =  (int)$product->rate ;
                                        $neg_rate = (int)5- $product->rate ;
                                    @endphp
                                    @for($i=0 ; $i < $rate; ++$i)
                                        <i class="fa fa-star active"></i>
                                    @endfor
                                    @for($i=0 ; $i <  $neg_rate; ++$i)
                                        <i class="fa fa-star "></i>
                                    @endfor
                                </div>
                                <span class="count">5 Review(s)</span>
                            </div>
                            <p class="description">{{$product->description}}</p>
                            <div class="price">
                                <span>{{$product->price }}  {{trans(lang_app_site().'.home.sar')}}</span>
                            </div>


                            @if($product->has_custom)
                                <h3 class=""
                                    style="margin-top:25px;">{{trans(lang_app_site().'.product.customization')}}</h3>
                                <?php $counter = 0;?>
                                @foreach($product->customizations as $arrCustome)
                                    <h5 style="margin-top:25px;">Select {{$arrCustome->name}}: </h5>
                                    <ul class="list-size select-size-list  selectcustom{{++$counter}}">
                                        @foreach($arrCustome->product_customizations as $custom)
                                            @if($arrCustome->name == 'Color')
                                                <li><a href="#"
                                                       onclick="addExtra{{$counter}}({{$custom->id}} , {{$custom->price}})"
                                                       style="background-color: {{$custom->text}}"
                                                       id="clickcustom{{$custom->id}}"> </a></li>

                                            @else
                                                <li><a href="#"
                                                       onclick="addExtra{{$counter}}({{$custom->id}} , {{$custom->price}})"
                                                       id="clickcustom{{$custom->id}}">{{$custom->text}}</a></li>
                                            @endif
                                        @endforeach
                                    </ul>
                                @endforeach

                            @endif


                            <div class="product-inner-actions">
                                <div class="quantity">
                                    <div class="group-quantity-button">
                                        <a class="minus" href="#"><i class="fa fa-minus" aria-hidden="true"></i></a>
                                        <input class="input-text qty text" type="text" size="4" title="Qty" value="1"
                                               name="quantity" id="quantityPrice" onchange="onC()">
                                        <a class="plus" href="#"><i class="fa fa-plus" aria-hidden="true"></i></a>
                                    </div>
                                </div>


                                <div class="group-button">
                                    <div class="inner">
                                        <a href="javascript:void(0)" class="add-to-cart"
                                           onclick="addToCart({{$product->id}} , '{{$product->name}}' ,'{{isset($product->images[0])? $product->images[0]->image : url('/assets/').'/no-product.jpg' }}' , {{($product->price)? $product->price :$product->price}} , {{($product->offer_percentage )?$product->offer_percentage: 0 }},1); return false;"
                                           id="addBtn{{$product->id}}" class="add-to-cart"><span
                                                    class="text">{{trans(lang_app_site().'.product.add_to_cart')}}</span></a>
                                        <a href="javascript:void(0)" class="add-to-cart"
                                           onclick="addToOrder({{$product->id}})"><span
                                                    class="text">{{trans(lang_app_site().'.product.checkout')}}</span></a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-xs-12 col-sm-5 col-md-4 col-lg-3 sidebar">
                    <div class="equal-container widget-featrue-box">
                        <div class="proceed-checkout">
                            <div class="content">
                                <div class="info-checkout">
                                    <span class="text">{{trans(lang_app_site().'.product.cart_subtotal')}}: </span><span
                                            class="item">{{$product->price}} {{trans(lang_app_site().'.home.sar')}}</span>

                                </div>
                                @if($product->is_offer == 1)
                                    <div class="info-checkout">
                                        <span class="text">{{trans(lang_app_site().'.product.offer')}}: </span><span
                                                class="item">{{$product->offer_percentage}}%</span>
                                    </div>
                                @endif
                                <div id="extraprice" class="info-checkout" style="display: none">
                                    <span class="text">{{trans(lang_app_site().'.product.extra_price')}} : </span><span
                                            class="item itemextra"></span>
                                </div>

                                <div id="quantPrice" class="info-checkout">
                                    <span class="text">{{trans(lang_app_site().'.product.quantity')}} : </span><span
                                            class="item qPrice">1</span>
                                </div>

                                <div class="total-checkout">
                                    @php
                                        $minus =  $product->offer_percentage / 100 ;
                                        $minus = $minus * $product->price ;
                                        $price = $product->price - $minus ;

                                    @endphp
                                    <span class="text">{{trans(lang_app_site().'.product.total_price')}}: </span><span
                                            class="price pricetotalall"> <span>{{round($price,1)}}</span> {{trans(lang_app_site().'.home.sar')}}</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@stop

@section('javascript')
    <script>
        price_page = parseInt('{{$product->price}}');
        precentage_page = parseInt('{{($product->offer_percentage)? $product->offer_percentage : 0}}');


        extra_price1 = 0;
        extra_price2 = 0;
        extra_price3 = 0;
        extra_price4 = 0;
        extra_price5 = 0;
        extra_price = 0;

        extra_id1 = 0;
        extra_id2 = 0;
        extra_id3 = 0;
        extra_id4 = 0;
        extra_id5 = 0;

        extra_id = [];

        function addExtra1(id, price) {


            extra_id1 = id;


            if ($('#clickcustom' + id).hasClass('active')) {
                extra_price = extra_price - extra_price1;
                extra_price1 = 0;
                calclPrice();


            } else {
                extra_price = extra_price - extra_price1;
                extra_price = extra_price + price;
                extra_price1 = price;
                console.log('noe we are here' + price + ' maaan');
            }


            if (extra_price > 0) {

                console.log(' now we put extra all ' + extra_price);
                ;
                $('#extraprice').css('display', 'block');
                $('.itemextra').html(extra_price);
                quant = parseInt($('#quantityPrice').val());
                calclPrice();
            } else {
                $('#extraprice').css('display', 'none');
            }


        }


        function addExtra2(id, price) {


            extra_id2 = id;

            if ($('#clickcustom' + id).hasClass('active')) {
                extra_price = extra_price - extra_price2;
                extra_price2 = 0;
                calclPrice();

            } else {
                extra_price = extra_price - extra_price2;
                extra_price = extra_price + price;
                extra_price2 = price;
            }

            if (extra_price > 0) {
                $('#extraprice').css('display', 'block');
                $('.itemextra').html(extra_price);
                quant = parseInt($('#quantityPrice').val());
                calclPrice();
            } else {
                $('#extraprice').css('display', 'none');
            }

        }

        function addExtra3(id, price) {

            extra_id3 = id;


            if ($('#clickcustom' + id).hasClass('active')) {
                extra_price = extra_price - extra_price3;
                extra_price3 = 0;
                calclPrice();

            } else {
                extra_price = extra_price - extra_price3;
                extra_price = extra_price + price;
                extra_price3 = price;
            }

            if (extra_price > 0) {
                $('#extraprice').css('display', 'block');
                $('.itemextra').html(extra_price);
                quant = parseInt($('#quantityPrice').val());
                calclPrice();
            } else {
                $('#extraprice').css('display', 'none');
            }

        }

        function addExtra4(id, price) {

            extra_id4 = id;

            if ($('#clickcustom' + id).hasClass('active')) {
                extra_price = extra_price - extra_price4;
                extra_price4 = 0;
                calclPrice();

            } else {
                extra_price = extra_price - extra_price4;
                extra_price = extra_price + price;
                extra_price4 = price;
            }


            if (extra_price > 0) {
                $('#extraprice').css('display', 'block');
                $('.itemextra').html(extra_price);
                quant = parseInt($('#quantityPrice').val());
                calclPrice();
            } else {
                $('#extraprice').css('display', 'none');
            }

        }

        function addExtra5(id, price) {

            extra_id5 = id;

            if ($('#clickcustom' + id).hasClass('active')) {
                extra_price = extra_price - extra_price5;
                extra_price5 = 0;
                calclPrice();

            } else {
                extra_price = extra_price - extra_price5;
                extra_price = extra_price + price;
                extra_price5 = price;
            }

            if (extra_price > 0) {
                $('#extraprice').css('display', 'block');
                $('.itemextra').html(extra_price);
                quant = parseInt($('#quantityPrice').val());
                calclPrice();
            } else {
                $('#extraprice').css('display', 'none');
            }

        }


        function onC() {
            quant = parseInt($('#quantityPrice').val());
            $('.qPrice').html(quant);

            calclPrice();

        }

        function calclPrice() {

            console.log(' the extra parice' + extra_price + ' quant ' + quant);
            var newprice = price_page;

            if (extra_price > 0) {
                newprice = newprice + extra_price;
                console.log(' the new price is ' + newprice);
            }

            var newprice = newprice * quant;

            minus = newprice * precentage_page;
            minus = minus / 100;

            newprice = newprice - minus;
            newprice = newprice.toFixed(1);
            newprice = parseFloat(newprice);

            $('.pricetotalall').find('span').text(newprice);
            $('.itemextra').html(extra_price);

            console.log(' the orher second new price is ' + newprice);
        }

    </script>

@endsection