@extends(site_layout_vw().'.index')

@section('content')
    <div class="main-content merchant-page main-content-grid inner-page">
        <div class="container">
            <div class="row">
                <div class="col-xs-12 col-sm-7 col-md-8 col-lg-9 content-offset" style="margin-top:0;">
                    <div class="breadcrumbs">
                        <a href="#">{{trans(lang_app_site().'.home.home')}}</a> \ <span class="current">{{trans(lang_app_site().'.services.services')}}</span>
                    </div>
                    <div class="categories-content">
                        <h4 class="shop-title">{{trans(lang_app_site().'.services.services')}}</h4>
                        <div class="top-control box-has-content">
                            <div class="control">
                                
                                <div class="control-button">
                                    <a href="#" class="grid-button active"><span class="icon"><i class="fa fa-th-large" aria-hidden="true"></i> </span>{{trans(lang_app_site().'.filter.grid')}}</a>
                                    <a href="#" class="list-button"><span class="icon"><i class="fa fa-th-list" aria-hidden="true"></i></span> {{trans(lang_app_site().'.filter.list')}}</a>
                                </div>
                            </div>
                        </div>
                        <div class="product-container auto-clear grid-style equal-container box-has-content">


                            @foreach($services as $service)
                                <div class="merchant-item product-item layout1 col-ts-12 col-xs-6 col-sm-6 col-md-4 col-lg-4 no-padding">
                                @include(site_sub_view_vw().'.service',['service'=>$service])
                                </div>
                            @endforeach





                        </div>

                        @include(site_sub_view_vw().'.paging',['current_page'=>$service->current_page , 'total_pages'=>$service->total_pages ])



                    </div>
                </div>
                @include(site_sub_view_vw().'.sideservices')

            </div>
        </div>
    </div>
@stop