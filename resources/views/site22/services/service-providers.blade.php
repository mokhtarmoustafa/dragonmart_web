@extends(site_layout_vw().'.index')

@section('content')
    <div class="main-content merchant-page main-content-grid inner-page">
        <div class="container">
            <div class="row">
                <div class="col-xs-12 col-sm-7 col-md-8 col-lg-9 content-offset" style="margin-top:0;">
                    <div class="breadcrumbs">
                        <a href="{{url('site/home')}}">{{trans('app.site.home.home')}}</a> \ <span
                                class="current">{{trans('app.site.provider')}}</span>
                    </div>
                    <div class="categories-content">
                        <h4 class="shop-title">{{$service->name}}</h4>
                        <div class="top-control box-has-content">
                            <div class="control">
                                <div class="select-item">
                                    <select data-placeholder="All Categories" class="form-control" id="pageSelect">
                                        <option value="10">10 {{trans('app.site.per_page')}}</option>
                                        <option value="12">12 {{trans('app.site.per_page')}}</option>
                                        <option value="15">15 {{trans('app.site.per_page')}}</option>
                                        <option value="18">18 {{trans('app.site.per_page')}}</option>
                                        <option value="21">21 {{trans('app.site.per_page')}}</option>
                                    </select>
                                </div>
                                <div class="control-button">
                                    <a href="#" class="grid-button active"><span class="icon"><i class="fa fa-th-large"
                                                                                                 aria-hidden="true"></i> </span>{{trans('app.site.filter.grid')}}
                                    </a>
                                    <a href="#" class="list-button"><span class="icon"><i class="fa fa-th-list"
                                                                                          aria-hidden="true"></i></span>
                                        {{trans('app.site.filter.list')}}</a>
                                </div>
                            </div>
                        </div>
                        <div class="product-container auto-clear grid-style equal-container box-has-content">


                            @foreach($providers->items as $s)
                                @include(site_sub_view_vw().'.oneservice',['provider'=>$s , 'service'])
                            @endforeach

                        </div>
                        @include(site_sub_view_vw().'.paging',['current_page'=>$providers->current_page , 'total_pages'=>(int)$providers->total_pages ])

                    </div>
                </div>

                @include(site_sub_view_vw().'.sideservices')
            </div>
        </div>
    </div>
@stop
