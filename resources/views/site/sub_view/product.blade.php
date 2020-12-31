<div class="product_wrap">
    <div class="product_img">
        <a href="{{url(site_url().'/product-page')}}/{{$product->id}}">
            <img src="{{isset($product->images[0]->image300)? $product->images[0]->image : url('/assets/').'/no-product.jpg'}}" alt="el_img1">
            <img class="product_hover_img" src="{{isset($product->images[0]->image300)? $product->images[0]->image: url('/assets/').'/no-product.jpg'}}" alt="el_hover_img1">
        </a>
        <div class="product_action_box">
            <ul class="list_none pr_action_btn">
                <li class="add-to-cart"><a href="javascript:void(0)" onclick="addToCart({{$product->id}} , '{{$product->name}}' ,'{{isset($product->images[0])? $product->images[0]->image : url('/assets/').'/no-product.jpg' }}' , {{$product->price}} , {{($product->offer_percentage )?$product->offer_percentage: 0 }} ,1); return false;"
                id="addBtn{{$product->id}}"><i class="icon-basket-loaded"></i> Add To Cart</a></li>
                <li><a href="shop-compare.html" class="popup-ajax"><i class="icon-shuffle"></i></a></li>
                <li><a href="shop-quick-view.html" class="popup-ajax" onclick="openView({{$product}})"><i class="icon-magnifier-add"></i></a></li>
                <li><a href="#"><i class="icon-heart"></i></a></li>
            </ul>
        </div>
    </div>
    <div class="product_info">
        <h6 class="product_title"><a href="{{url(site_url().'/product-page')}}/{{$product->id}}">{{$product->name}}</a></h6>
        <div class="product_price">


            @if($product->is_offer)
                    <span class="del">{{$product->price}} {{trans(lang_app_site().'.home.sar')}}</span>
                    <div class="on_sale">
                        <span>{{$product->offer_price}}  {{trans(lang_app_site().'.home.sar')}}</span>
                    </div>

            @else

                <span class="price">{{$product->price}} {{trans(lang_app_site().'.home.sar')}}</span>
            @endif

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
        <a href="#" class="quickview-button" onclick="openView({{$product}})"><span class="icon"><i class="fa fa-eye"
                                                                                                    aria-hidden="true"></i></span>
            {{trans(lang_app_site().'.product.quick_view')}}</a>
        <a href="{{url(site_url().'/product-page')}}/{{$product->id}}" class="thumb-link">

            <img style="height: 250px"
                 src="{{isset($product->images[0]->image300)? $product->images[0]->image300 : url('/assets/').'/no-product.jpg'}}"
                 class="product-img" alt="">
        </a>
    </div>
    <div class="info">
        <a href="{{url(site_url().'/product-page')}}/{{$product->id}}" class="product-name">{{$product->name}}</a>

        @if($product->is_offer)
            <div class="price">
                <span class="del">{{$product->price}} {{trans(lang_app_site().'.home.sar')}}</span>
                <span class="ins">{{$product->offer_price}}  {{trans(lang_app_site().'.home.sar')}}</span>
            </div>
        @else

            <div class="price">
                <span>{{$product->price}} {{trans(lang_app_site().'.home.sar')}}</span>
            </div>
        @endif


        <div class="cat-rate row">
            <div class="col-xs-7">
                <div class="category">
                    <a href="#" class="button">{{($product->category) ? $product->category->name : ''}}</a>
                </div>
            </div>
            <div class="col-xs-5">
                <div class="product-rate">

                    @php $rate =  (int)$product->rate ;
                             $neg_rate = (int)5- $product->rate ;
                    @endphp
                    @for($i=0 ; $i < $rate; ++$i)
                        <i class="fa fa-star active"></i>
                    @endfor
                    @for($i=0 ; $i <  $neg_rate; ++$i)
                        <i class="fa fa-star "></i>
                    @endfor

                </div>
            </div>
        </div>
    </div>
    <div class="group-button">
        <div class="inner">
            <a href="javascript:void(0)" class="add-to-cart"
               onclick="addToCart({{$product->id}} , '{{$product->name}}' ,'{{isset($product->images[0])? $product->images[0]->image : url('/assets/').'/no-product.jpg' }}' , {{$product->price}} , {{($product->offer_percentage )?$product->offer_percentage: 0 }} ,1); return false;"
               id="addBtn{{$product->id}}"><span
                        class="text">{{trans(lang_app_site().'.product.add_to_cart')}}</span></a>
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



@section('javascript')
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


                HTMLVIEW += '  <span class="del">' + product.price + ' {{trans(lang_app_site().'.home.sar')}}</span>';
                HTMLVIEW += '<span > ' + product.offer_price + ' {{trans(lang_app_site().'.home.sar')}}</span>';
            } else {

                HTMLVIEW += '<span > ' + product.price + ' {{trans(lang_app_site().'.home.sar')}}</span>';
            }

            HTMLVIEW += '</div>' +
                '<div class="group-button"><div class="inner"><a href="#" id="quckaddcart" class="add-to-cart" onclick="addToCart(' + product.id + ' , \'' + product.name + ' \'  , \'' + product.images[0].image + '\',' + product.price + ',' + product.offer_percentage + ',1)">' +
                '<span class="text">{{trans(lang_app_site().'.product.add_to_cart')}}</span><span class="icon">' +
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
@endsection
