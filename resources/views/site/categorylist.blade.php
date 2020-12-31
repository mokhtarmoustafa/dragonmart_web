@extends(site_layout_vw().'.index')

@section('content')
    <div class="main-content merchant-page main-content-grid inner-page">
        <div class="container">
            <div class="row">
                <div class="col-xs-12 col-sm-7 col-md-8 col-lg-9 content-offset" style="margin-top:0;">
                    <div class="breadcrumbs">
                        <a href="#">Home</a> \ <span class="current">Services</span>
                    </div>
                    <div class="categories-content">
                        <h4 class="shop-title">All Categories</h4>
                        <div class="top-control box-has-content">
                            <div class="control">
                                
                                <div class="control-button">
                                    <a href="#" class="grid-button active"><span class="icon"><i class="fa fa-th-large" aria-hidden="true"></i> </span>Grid</a>
                                    <a href="#" class="list-button"><span class="icon"><i class="fa fa-th-list" aria-hidden="true"></i></span> List</a>
                                </div>
                            </div>
                        </div>
                        <div class="product-container auto-clear grid-style equal-container box-has-content">


                            @php
                                $cats =Categories();
                            @endphp


                            @foreach(  $cats  as $cat)
                                <div class="merchant-item product-item layout1 col-ts-12 col-xs-6 col-sm-6 col-md-4 col-lg-4 no-padding">
                                @include(site_sub_view_vw().'.categoriy',['service'=>$cat])
                                </div>
                            @endforeach






                        </div>




                    </div>
                </div>
                @include(site_sub_view_vw().'.sidemerchant')
            </div>
        </div>
    </div>
@stop