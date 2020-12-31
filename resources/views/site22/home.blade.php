@extends(site_layout_vw().'.index')

@section('content')
    <div class="main-content home-page main-content-home1">
        <div class="container">
            <div class="container-offset">
                <!--Slideshow-->
                <div class="main-slideshow slideshow1">
                    <div class="owl-carousel nav-style1" data-autoplay="true" data-nav="true" data-dots="false"
                         data-loop="true" data-slidespeed="800" data-margin="30"
                         data-responsive='{"0":{"items":1}, "640":{"items":1}, "768":{"items":1}, "1024":{"items":1}, "1200":{"items":1}}'>

                        @foreach( $offer_sponsor_products as $product )
                            <div class="slide-item item1">
                                <img
                                    src="{{isset($product->images[0]->image)? $product->images[0]->image : url('/assets/').'/no-product.jpg'}}"
                                    style="max-height: 420px; width: 100%; margin: 0 auto" alt="">
                                <div class="slide-content">
                                    @if($product->is_offer)
                                        <h5 class="subtitle"><span class="text-main-color">{{$product->offer_percentage}}% {{trans('app.off')}}</span>
                                        </h5>
                                    @endif
                                    <h3 class="title">{{$product->name}}</h3>
                                    <h5 class="smalltitle">{{trans('app.only')}}:
                                        <span> {{$product->price}} {{trans('app.site.home.sar')}}</span></h5>
                                    <a href="{{url(site_url().'/product-page')}}/{{$product->id}}"
                                       class="button">{{trans('app.shop_now')}}</a>
                                </div>
                            </div>

                        @endforeach
                        @foreach($ads as $ad)
                            <div class="slide-item item1">
                                <a href="{{$ad->url}}"  target="_blank"><img
                                        src="{{$ad->image}}"
                                        style="max-height: 420px; width: 100%; margin: 0 auto" alt=""></a>
                                {{--                                <div class="slide-content">--}}
                                {{--                                    <a href="{{$ad->url}}" class="button" target="_blank">{{trans('app.view_ad')}}</a>--}}
                                {{--                                </div>--}}
                            </div>
                        @endforeach

                    </div>
                </div>
                <!--/Slideshow-->
            </div>

            <!--List Products-->
            <div class="group-product layout1">
                <div class="kt-tab nav-tab-style1">
                    <div class="section-head box-has-content">
                        <h4 class="section-title">{{trans(lang_app_site().'.home.popular_products')}}</h4>
                        <a href="{{url(site_url().'/products/popular')}}"
                           class="view-all-btn">{{trans(lang_app_site().'.home.view_all')}}</a>
                    </div>
                    <div class="section-content">
                        <div class="other-product-show auto-clear box-has-content equal-container">

                            @foreach($popular_products as $popular)
                                <div class="product-item layout1 col-lg-3 col-md-3 col-sm-6 col-xs-6 col-ts-12">
                                    @include(site_sub_view_vw().'.product',['product'=>$popular])
                                </div>
                            @endforeach

                        </div>
                    </div>
                </div>
            </div>
            <!--/List Products-->
            <!--List Products-->
            <div class="group-product layout1">
                <div class="kt-tab nav-tab-style1">
                    <div class="section-head box-has-content">
                        <h4 class="section-title">{{trans(lang_app_site().'.home.new_products')}}</h4>
                        <a href="{{url(site_url().'/products/new_product')}}"
                           class="view-all-btn">{{trans(lang_app_site().'.home.view_all')}}</a>
                    </div>
                    <div class="section-content">
                        <div class="other-product-show auto-clear box-has-content equal-container">
                            @foreach($new_products as $product)
                                <div class="product-item layout1 col-lg-3 col-md-3 col-sm-6 col-xs-6 col-ts-12">
                                    @include(site_sub_view_vw().'.product',['product'=>$product])
                                </div>
                            @endforeach


                        </div>
                    </div>
                </div>
            </div>

            <!--/List Products-->
            <!--List Products-->
            <div class="group-product layout1">
                <div class="kt-tab nav-tab-style1">
                    <div class="section-head box-has-content">
                        <h4 class="section-title">{{trans(lang_app_site().'.home.top_selling')}}</h4>
                        <a href="{{url(site_url().'/products/top_selling')}}"
                           class="view-all-btn">{{trans(lang_app_site().'.home.view_all')}}</a>
                    </div>
                    <div class="section-content">
                        <div class="other-product-show auto-clear box-has-content equal-container">
                            @foreach($top_selling_products as $product)
                                <div class="product-item layout1 col-lg-3 col-md-3 col-sm-6 col-xs-6 col-ts-12">
                                    @include(site_sub_view_vw().'.product',['product'=>$product])
                                </div>
                            @endforeach

                        </div>
                    </div>
                </div>
            </div>
            <!--/List Products-->
        </div>
    </div>

@stop
