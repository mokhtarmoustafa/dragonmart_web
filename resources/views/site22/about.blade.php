@extends(site_layout_vw().'.index')

@section('content')
    <div class="main-content shop-page inner-page about-page">
        <div class="container">
            <div class="breadcrumbs">
                <a href="{{url('site/home')}}">{{__('app.site.home.home')}}</a> \ <span
                    class="current">{{__('app.site.home.about_us')}}</span>
            </div>

            @foreach($abouts as $about)
                @if($loop->iteration%2 == 0)
                    <div class="row about-info content-form">
                        <div class="col-xs-12 col-sm-5 col-md-6">
                            @if($about->media_type == 'image')
                                <img src="{{$about->media}}" alt="">
                            @else
                                <video src="{{$about->media}}#t=1" controls width="560" height="315"></video>

                                {{--                                <iframe width="560" height="315" src="{{$about->media}}"--}}
{{--                                        frameborder="0"--}}
{{--                                        allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture"--}}
{{--                                        allowfullscreen></iframe>--}}
                            @endif
                        </div>
                        <div class="col-xs-12 col-sm-7 col-md-6">
                            <div class="info">
                                <h3 class="main-title">{{$about->title}}</h3>
                                <p class="des">{!! $about->content !!}</p>
                            </div>
                        </div>
                    </div>
                @else
                    <div class="row about-info content-form">
                        <div class="col-xs-12 col-sm-7 col-md-6">
                            <div class="info">
                                <h3 class="main-title">{{$about->title}}</h3>
                                <p class="des">{!! $about->content !!}</p>
                            </div>
                        </div>
                        <div class="col-xs-12 col-sm-5 col-md-6">
                            @if($about->media_type == 'image')
                                <img src="{{$about->media}}" alt="">
                            @else
{{--                                <iframe width="560" height="315" src="{{$about->media}}"--}}
{{--                                        frameborder="0"--}}
{{--                                        allow="accelerometer; encrypted-media; gyroscope; picture-in-picture"--}}
{{--                                        allowfullscreen></iframe>--}}
                                <video src="{{$about->media}}#t=1" controls width="560" height="315"></video>

                            @endif
                        </div>
                    </div>
                @endif

            @endforeach

        </div>
    </div>

@stop
