
<div class="product-inner equal-elem">
    <div class="thumb">
        <a href="{{url(site_url().'/service-providers')}}/{{$service->id}}" class="thumb-link"><img src=" {{ ($service->icon) ? $service->icon: url('/assets/').'/no-product.jpg'}}" alt="" style="height: 220px; padding: 65px"></a>
    </div>
    <div class="info">
        <a href="{{url(site_url().'/service-providers')}}/{{$service->id}}" class="product-name">{{$service->name}}</a>
        <p class="description">Lorem Ipsum is simply dummy text of the printing and try. Lorem Ipsum has been the standard dummy text ever since the 1500s, when an unknown printer.</p>
    </div>
</div>


@section('javascript')
    <script>


    </script>
@endsection