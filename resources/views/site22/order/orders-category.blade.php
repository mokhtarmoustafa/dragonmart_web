@extends(site_layout_vw().'.index')

@section('content')
    <div class="main-content shop-page inner-page shoppingcart-content">
        <div class="container">
            <div class="breadcrumbs">
                <a href="#">Home</a> \ <span class="current">Pending Orders</span>
            </div>
            <div class="content-form">
                <div class="row orders-filter">
                    <div class="col-xs-12 col-sm-4">
                        <h4 class="shop-title" style="margin:10px 0 30px;">Orders Number: {{count($orders)}}</h4>
                    </div>
                    <div class="col-xs-12 col-sm-3 filter-item">
                        <span class="label-text">From:</span>
                        <input class="input-info datepicker" type="text"
                               value="{{ ( request()->segment(4) != '' ) ?request()->segment(4)  : ''}}" name="to"
                               id="fromtime">
                    </div>
                    <div class="col-xs-12 col-sm-3 filter-item">
                        <span class="label-text">To:</span>
                        <input class="input-info datepicker" type="text"
                               value="{{ (request()->segment(5) != '') ?request()->segment(5)  : ''}}" name="to"
                               id="totime">
                    </div>
                    <div class="col-xs-12 col-sm-2">
                        <div class="checkout-cart group-button" style="margin:0; text-align:right">
                            <div class="right">
                                <a href="javascript:void(0)" class="continue-shopping submit"
                                   onclick="filterDateOrder()">Apply</a>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="orders-items-wrap">


                    @if(isset($orders))
                        @foreach($orders as $order)

                            @if( $order instanceof  \App\Order)
                                <div class="order-item-wrap">
                                    <div class="order-info">
                                        <div class="row">
                                            <div class="col-xs-6 col-sm-6 col-md-4">
                                                <div class="info-item">
                                                    <span><i class="fa fa-address-card-o"></i> Order #: </span>
                                                    <span>{{$order->id}}</span>
                                                </div>
                                                <div class="info-item">
                                                    <span><i class="fa fa-user-circle"></i> Merchant: </span>
                                                    <span>{{($order->merchant)?$order->merchant->username:''}}</span>
                                                </div>
                                            </div>
                                            <div class="col-xs-6 col-sm-6 col-md-4 col-md-offset-4">
                                                <div class="info-item">
                                                    <span><i class="fa fa-calendar"></i> Date: </span>
                                                    <span>{{$order->created_at}}</span>
                                                </div>
                                                <div class="info-item">
                                                    <span><i class="fa fa-list-ul"></i> Items: </span>
                                                    <span>{{count($order->order_products)}}</span>
                                                </div>
                                            </div>
                                        </div>
                                        <i class="fa fa-arrow-down"></i>
                                    </div>
                                    <div class="cart-content order-items-wrap" style="display: none;">

                                        <table class="shopping-cart-content">
                                            <tr class="title">
                                                <td width="80" class="product-thumb"></td>
                                                <td class="product-name">Product Name</td>
                                                <td class="price">Unit Price</td>
                                                <td class="quantity-item">Qty</td>
                                                <td class="total">SubTotal</td>
                                                @if(request()->segment(3) == 'finished')
                                                    <td class="total">Rating</td>
                                                @endif
                                            </tr>


                                            @foreach($order->order_products as $product)
                                                <tr class="each-item">
                                                    <td class="product-thumb"><a href="{{url(site_url().'/product-page/'.$product->product->id)}}"><img
                                                                    src="{{ (count($product->product->images) > 0 && $product->product->images[0]) ? $product->product->images[0]->image :  url('/assets').'/site/images/product2.jpg'}} "
                                                                    alt=""></a></td>
                                                    <td class="product-name" data-title="Product Name">
                                                        <a href="{{url(site_url().'/product-page/'.$product->product->id)}}"
                                                           class="product-name">{{$product->product->name}}</a>
                                                    </td>
                                                    <td class="price" data-title="Unit Price">{{$product->price}}SAR
                                                    </td>
                                                    <td class="quantity-item"
                                                        data-title="Qty">{{$product->quantity}}</td>
                                                    <td class="total" data-title="SubTotal">{{$product->total_price}}
                                                        SAR
                                                    </td>
                                                    @if(request()->segment(3) == 'finished')
                                                        <td class="rate" data-title="Rating"><a href="#"
                                                                                                class="rate-link modalopen"
                                                                                                data-toggle="modal"
                                                                                                data-target="#rate_modal"
                                                                                                data-idproduct="{{$product->product->id}}">Rate</a>
                                                        </td>
                                                    @endif
                                                </tr>
                                            @endforeach


                                        </table>
                                        <table class="shopping-cart-content">
                                            <tr class="checkout-cart group-button" style="margin:0">
                                                <td colspan="6" class="right">
                                                    <div class="right">
                                                        @if($order->last_status == 'finished')
                                                            <a href="#" class="submit update">Print</a>
                                                        @elseif(!isset($order->last_status))
                                                            <a href="{{url(site_url().'/order/'.$order->id)}}"
                                                               class="submit update">Set order</a>
                                                        @elseif($order->last_status == 'pending')
                                                            <a href="{{url(site_url().'/pay-order/'.$order->id)}}"
                                                               class="submit update">Pay now</a>

                                                        @endif

                                                    </div>
                                                </td>
                                            </tr>
                                        </table>
                                    </div>
                                </div>

                            @else


                                <div class="order-item-wrap">
                                    <div class="order-info">
                                        <div class="row">
                                            <div class="col-xs-6 col-sm-6 col-md-4">
                                                <div class="info-item">
                                                    <span><i class="fa fa-address-card-o"></i> Order #: </span>
                                                    <span>{{$order->id}}</span>
                                                </div>
                                                <div class="info-item">
                                                    <span><i class="fa fa-user-circle"></i> Service: </span>
                                                    <span> </span>
                                                </div>
                                            </div>
                                            <div class="col-xs-6 col-sm-6 col-md-4 col-md-offset-4">
                                                <div class="info-item">
                                                    <span><i class="fa fa-calendar"></i> Date: </span>
                                                    <span>{{$order->created_at}}</span>
                                                </div>
                                                <div class="info-item">
                                                    <span><i class="fa fa-list-ul"></i> Items: </span>
                                                    <span>{{count($order->services)}}</span>
                                                </div>
                                            </div>
                                        </div>
                                        <i class="fa fa-arrow-down"></i>
                                    </div>
                                    <div class="cart-content order-items-wrap" style="display: none;">

                                        <table class="shopping-cart-content">
                                            <tr class="title">

                                                <td class="product-name">Service</td>
                                                <td class="price">Unit Price</td>

                                            </tr>


                                            @foreach($order->services as $service)
                                                <tr class="each-item">

                                                    <td class="product-name" data-title="Product Name">
                                                        <a href="#" class="product-name">{{$service->text}}</a>
                                                    </td>
                                                    <td class="price" data-title="Unit Price">{{$service->price}}SAR
                                                    </td>


                                                </tr>
                                            @endforeach


                                        </table>
                                        <table class="shopping-cart-content">
                                            <tr class="checkout-cart group-button" style="margin:0">
                                                <td colspan="6" class="right">
                                                    <div class="right">
                                                        <a href="#" class="submit update">Print</a>
                                                    </div>
                                                </td>
                                            </tr>
                                        </table>
                                    </div>
                                </div>


                            @endif
                        @endforeach
                    @endif


                </div>
            </div>
        </div>
    </div>
@stop


<div class="modal fade" id="rate_modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle"
     aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLongTitle"> Rate Product </h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="rate_wrap">
                    <input type="hidden" id="rate_value"/>
                    <input type="hidden" id="action_id"/>
                    <div class="stars">
                        <i class="fa fa-star"></i>
                        <i class="fa fa-star"></i>
                        <i class="fa fa-star"></i>
                        <i class="fa fa-star"></i>
                        <i class="fa fa-star"></i>
                    </div>
                    <textarea placeholder="enter rate text" id="text_rate"></textarea>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary" onclick="sendRate()">Save</button>
            </div>
        </div>
    </div>
</div>
<style>
    .error {
        border: 1px solid #f00 !important;
    }
</style>
@section('javascript')




    <script src="https://cdn.klokantech.com/maptilerlayer/v1/index.js"></script>
    <script>


        $(".datepicker").datetimepicker({
            format: 'YYYY-MM-DD'
        });

        $(document).on("click", ".modalopen", function () {
            var product_id = $(this).data('idproduct');
            $("#action_id").val(product_id);

            // $('#addBookDialog').modal('show');
        });


        function filterDateOrder() {
            var fromtime = $('#fromtime').val();
            var totime = $('#totime').val();

            if (fromtime == '') {
                $('#fromtime').addClass('error');
                return;
            } else {
                $('#fromtime').removeClass('error');
            }
            if (totime == '') {
                $('#totime').addClass('error');
                return;
            } else {
                $('#totime').removeClass('error');
            }


            var url = '{{url(site_url()).'/orders-category/'.request()->segment(3) }}/' + fromtime + '/' + totime;
            //console.log('mm' + url);
            window.location = url;


        }

        function sendRate() {
            toastBody = 'Add Review Successfully';
            toastTitle = 'Add Review on Product';


            jQuery.ajax({
                url: "{{url(site_url().'/rate')}}",
                type: 'POST',
                dataType: "json",
                data: {

                    rate: $('#rate_value').val(),
                    action_id: $('#action_id').val(),
                    type: 'product',
                    comment: $('#text_rate').val(),

                },
                success: function (data) {
                    if (data.status) {
                        toastr.success(toastBody, toastTitle);
                        location.reload();
                    }
                }
            });

        }

    </script>

@endsection