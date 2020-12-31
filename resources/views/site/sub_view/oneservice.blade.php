


<div class="merchant-item product-item layout1 col-ts-12 col-xs-6 col-sm-6 col-md-4 col-lg-4 no-padding">
    <div class="product-inner equal-elem">
        <div class="thumb">

            <a href="{{url(site_url().'/service-profile-view')}}/{{$provider->id}}/{{$service->id}}" class="thumb-link"><img
                        src="{{isset($provider->image)? $provider->image: url('/assets/').'/no-product.jpg'}}" alt="" style="height: 220px"></a>
        </div>
        <div class="info">
            <a href="{{url(site_url().'/service-profile-view')}}/{{$provider->id}}/{{$service->id}}" class="product-name">{{$provider->username}}</a>
            <p class="description">{{$provider->bio}}</p>
            <div class="price">
                <span>{{$provider->city->name_en}}</span>
            </div>
            <div class="product-rate">
                @php $rate =  (int)$provider->service_rate ;
                             $neg_rate = (int) 5- $provider->service_rate ;
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


@section('javascript')
    <script>


    </script>
@endsection