@extends(site_layout_vw().'.index')

@section('content')
<div class="merchant-header">
    <div class="header-bg">
        <img src="{{url('/assets').'/site/images/Hero.svg'}}">
    </div>
    <div class="header-info container">
        
          <div class="header-logo">
              <img class="merchant-logo" src="{{ (isset($merchant->store_images[0]))?$merchant->store_images[0]->image : url('/assets').'/site/images/avata2.png'}}" width="70" height="70"/>
          </div>
          
          <div class="header-det">
            <h4 class="shop-title text-uppercase">{{$merchant->username}}</h4>
            <div class="merchant-info">
                <div class="info-item">
                    <i class="fa fa-map-marker"></i>
                    <span> {{$merchant->city->name_en}}</span>
                </div>
                <!--<div class="info-item">-->
                <!--    <i class="fa fa-phone"></i>-->
                <!--    <span>{{$merchant->mobile}}</span>-->
                <!--</div>-->
            </div>
            <ul id="menu-main-menu" class="main-menu clone-main-menu ovic-clone-mobile-menu box-has-content">
                 @php
                     $cats =Categories();
                     $cats = $cats->where("store_id" , $merchant->id);
                 @endphp
                 @foreach($cats as $cat)
                 <li class="menu-item">
                     <a href="{{url(site_url().'/category')}}/{{$cat->id}}">{{$cat->name}}</a>
                </li>

                 @endforeach
            </ul>
            
            
            <div class="info-item">
                <p>{{$merchant->bio}}</p>
            </div>
          </div>

    </div>
          

</div>
    <div class="main-content merchant-page main-content-grid inner-page">
        
       
        
        <div class="container">
            <div class="row">
                <div class="col-xs-12 col-sm-7 col-md-8 col-lg-9 content-offset" style="margin-top:0;">
                    <div class="breadcrumbs">
                        <a href="{{url('site/home')}}">{{trans('app.site.home.home')}}</a> \ <span class="current">{{trans('app.site.merchant_name')}}</span>
                    </div>
                    <div class="categories-content">
                        
                        <div class="top-control box-has-content">
                            <div class="control">
                                <div class="select-item">
                                    <select data-placeholder="All Categories" class="form-control" id="pageSelect" >
                                        <option value="10">10 {{trans('app.site.per_page')}}</option>

                                        <option value="12">12 {{trans('app.site.per_page')}}</option>
                                        <option value="15">15 {{trans('app.site.per_page')}}</option>
                                        <option value="18">18 {{trans('app.site.per_page')}}</option>
                                        <option value="21">21 {{trans('app.site.per_page')}}</option>
                                    </select>
                                </div>
                                <div class="control-button">
                                    <a href="#" class="grid-button active"><span class="icon"><i class="fa fa-th-large"
                                                                                                 aria-hidden="true"></i> </span>{{trans('app.site.filter.grid')}}</a>
                                    <a href="#" class="list-button"><span class="icon"><i class="fa fa-th-list"
                                                                                          aria-hidden="true"></i></span>
                                        {{trans('app.site.filter.list')}}</a>
                                </div>
                            </div>
                        </div>
                        <div class="product-container auto-clear grid-style equal-container box-has-content">

                            @foreach($merchant->products->items as $product)
                                <div class="product-item layout1 col-ts-12 col-xs-6 col-sm-6 col-md-4 col-lg-4 no-padding">

                                @include(site_sub_view_vw().'.product',['product'=>$product])

                                </div>
                            @endforeach





                        </div>

                        @include(site_sub_view_vw().'.paging',['current_page'=>$merchant->products->current_page , 'total_pages'=>$merchant->products->total_pages ])

                    </div>
                </div>
                @include(site_sub_view_vw().'.sidemerchant')
            </div>
        </div>
    </div>
@stop
