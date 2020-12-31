
<div class="product-inner equal-elem">
    <div class="thumb">
        <a href="{{url(site_url().'/category')}}/{{$service->id}}" class="thumb-link"><img src=" {{ ($service->icon) ? $service->icon: url('/assets/').'/no-product.jpg'}}" alt="" style="height: 220px; padding: 50px"></a>
    </div>
    <div class="info">
        <a href="{{url(site_url().'/category')}}/{{$service->id}}" class="product-name">{{$service->name}}</a>
    </div>
</div>

