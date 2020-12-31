@extends(site_layout_vw().'.index')

@section('content')
    <div class="main-content merchant-page main-content-grid inner-page">
        <div class="container">
            <div class="row">
                <div class="col-xs-12 col-sm-7 col-md-8 col-lg-9 content-offset" style="margin-top:0;">
                    <div class="breadcrumbs">
                        <a href="#">{{trans(lang_app_site().'.home.home')}}</a> \ <span class="current">{{trans(lang_app_site().'.home.merchants')}}</span>
                    </div>
                    <div class="categories-content">
                        <h4 class="shop-title">{{ isset($category)?$category->name : trans(lang_app_site().'.home.merchants') }}</h4>
                        <div class="top-control box-has-content">
                            <div class="control">
                                <div class="select-item">
                                    <select data-placeholder="All Categories" class="form-control" id="pageSelect">

                                        <option value="10" >10 {{trans(lang_app_site().'.filter.per_page')}}</option>
                                        <option value="12" >12 {{trans(lang_app_site().'.filter.per_page')}}</option>
                                        <option value="15" >15 {{trans(lang_app_site().'.filter.per_page')}}</option>
                                        <option value="18" >18 {{trans(lang_app_site().'.filter.per_page')}}</option>
                                        <option value="21" >21 {{trans(lang_app_site().'.filter.per_page')}}</option>
                                    </select>
                                </div>
                                <div class="control-button">
                                    <a href="#" class="grid-button active"><span class="icon"><i class="fa fa-th-large"
                                                                                                 aria-hidden="true"></i> </span>{{trans(lang_app_site().'.filter.grid')}}</a>
                                    <a href="#" class="list-button"><span class="icon"><i class="fa fa-th-list"
                                                                                          aria-hidden="true"></i></span>
                                        {{trans(lang_app_site().'.filter.list')}}</a>
                                </div>
                            </div>
                        </div>


                        <div class="product-container auto-clear grid-style equal-container box-has-content">

                            @foreach($merchants->items as $m)
                            <div class="merchant-item product-item layout1 col-ts-12 col-xs-6 col-sm-6 col-md-4 col-lg-4 no-padding">
                                <div class="product-inner equal-elem">
                                    <div class="thumb">

                                        <a href="{{url(site_url().'/merchant-page')}}/{{$m->id}}" class="thumb-link">
                                            <img src=" {{ isset($m->store_images[0] ) ? $m->store_images[0]->image:url('/assets').'/no-product.jpg'}}"
                                                                                      alt="" style="height: 202px;">
                                        </a>
                                    </div>
                                    <div class="info">
                                        <a href="{{url(site_url().'/merchant-page')}}/{{$m->id}}" class="product-name">{{$m->username}}</a>

                                        <div class="price">
                                            <span>{{$m->city->name_en}}</span>
                                        </div>
                                    </div>
                                </div>
                            </div>

                             @endforeach

                        </div>


                        @include(site_sub_view_vw().'.paging',['current_page'=>$merchants->current_page , 'total_pages'=>$merchants->total_pages ])


                    </div>
                </div>

                     @include(site_sub_view_vw().'.sidemerchant')



               </div>
           </div>
       </div>
   @stop