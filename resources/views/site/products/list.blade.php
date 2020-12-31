@extends(site_layout_vw().'.index')

@section('content')
    <div class="main-content merchant-page main-content-grid inner-page">
        <div class="container">
            <div class="row">
                <div class="col-xs-12 col-sm-7 col-md-8 col-lg-9 content-offset" style="margin-top:0;">
                    <div class="breadcrumbs">
                        <a href="#">Home</a> \ <span class="current">Products</span>
                    </div>
                    <div class="categories-content">
                        <div class="top-control box-has-content">
                            <div class="control">

                                <div class="control-button">
                                    <a href="#" class="grid-button active"><span class="icon"><i class="fa fa-th-large"
                                                                                                 aria-hidden="true"></i> </span>Grid</a>
                                    <a href="#" class="list-button"><span class="icon"><i class="fa fa-th-list"
                                                                                          aria-hidden="true"></i></span>
                                        List</a>
                                </div>
                            </div>
                        </div>
                        <div class="product-container auto-clear grid-style equal-container box-has-content">



                              @foreach($products->items as $product)
                            <div class="product-item layout1 col-ts-12 col-xs-6 col-sm-6 col-md-4 col-lg-4 no-padding">
                                @include(site_sub_view_vw().'.product',['product'=>$product])
                            </div>
                                @endforeach

                        </div>

                        <div class="pagination">
                            <div class="pagination">
                                <ul class="list-page">
                                    <?php $route = request()->segment(2);?>


                                    @if($products->total_pages > 1 )
                                        @for ($i=1; $i <= $products->total_pages ; ++$i)


                                                <li><a href="{{url(site_url().'/'.$route)}}/{{ request()->segment(3)}}/{{ request()->segment(4)}}/{{ (request()->segment(5)) ? request()->segment(5) : 10}}/{{$i}}" class="page-number {{ ($i == $products->current_page)? 'current' : '' }}">{{$i}}</a></li>

                                        @endfor

                                        @if($products->current_page < $products->total_pages)


                                                <li><a href="{{url(site_url().'/'.$route)}}/{{ request()->segment(3)}}/{{ request()->segment(4)}}/{{ (request()->segment(5)) ? request()->segment(5) : 10}}/{{$i}}" class="nav-button">Next</a></li>


                                            @endif
                                    @endif

                                </ul>
                            </div>
                        </div>

                    </div>
                </div>


                @include(site_sub_view_vw().'.sidemerchant')
            </div>
        </div>
    </div>
@stop