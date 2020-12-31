@extends(site_layout_vw().'.index')

@section('content')

    <div class="main-content shop-page inner-page about-page">
        <div class="container">
            <div class="breadcrumbs">
                <a href="{{url('site/home')}}">{{__('app.site.home.home')}}</a> \ <span
                    class="current">{{__('app.site.home.term')}}</span>
            </div>
            <div class="container">
                <div class="about-text">
                    {{--                <span class="wow fadeInDown">{{str_}} </span>--}}
                    <h4 class="wow fadeInDown">{{$term->title}}</h4>
                    <p class="wow fadeInDown">{!! $term->desc !!}</p>
                </div>
            </div>
        </div>
    </div>

@stop
