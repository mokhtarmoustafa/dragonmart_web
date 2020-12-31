@extends(admin_layout_vw().'.index')

@section('content')
<div class="card card-custom">
  <div class="card-header">
    <div class="card-title">
      <i class="{{$icon}} font-dark ml-2"></i>
      <span class="caption-subject bold uppercase">{{trans(lang_app_site().'.CP.'.$main_title)}} #{{$order->id}}</span>
    </div>
    <div class="card-toolbar">
      @if($order->last_status == 'new')
      <span class="label label-inline label-xl label-rounded label-light-warning font-weight-bolder">{{trans(lang_app_site().'.CP.Order status')}}: {{trans(lang_app_site().'.CP.New')}}</span>
      @elseif($order->last_status == 'accepted')
      <span class="label label-inline label-xl label-rounded label-light-success font-weight-bolder">{{trans(lang_app_site().'.CP.Order status')}}: {{trans(lang_app_site().'.CP.In Progress')}}</span>
      @elseif($order->last_status == 'pickup')
      <span class="label label-inline label-xl label-rounded label-outline-success font-weight-bolder">{{trans(lang_app_site().'.CP.Order status')}}: {{trans(lang_app_site().'.CP.Completed')}}</span>
      @elseif($order->last_status == 'rejected')
      <span class="label label-inline label-xl label-rounded label-light-danger font-weight-bolder">{{trans(lang_app_site().'.CP.Order status')}}: {{trans(lang_app_site().'.CP.Rejected')}}</span>
      @endif
    </div>

  </div>
  <div class="card-body">
    <div class="row static-info">
      <div class="col-md-3 name">{{trans(lang_app_site().'.CP.Merchant name')}}: <span class="value">{{$order->Merchant->username}}</span></div>
      <div class="col-md-3 name">{{trans(lang_app_site().'.CP.Order date')}}: <span class="value">{{$order->created_at}}</span></div>
      <div class="col-md-3 name">{{trans(lang_app_site().'.CP.Items #')}}: <span class="value">{{$order->OrderProducts->count()}}</span></div>
      @if($order->order_time > '00:05:00')
      <div class="col-md-3 name label label-lg font-weight-bolder label-rounded label-danger label-inline">{{trans(lang_app_site().'.CP.Order time')}}:&nbsp;<span class="value"> {{$order->order_time}}</span></div>
      @else
      <div class="col-md-3 name label label-lg font-weight-bolder label-rounded label-success label-inline">{{trans(lang_app_site().'.CP.Order time')}}:&nbsp;<span class="value"> {{$order->order_time}}</span></div>
      @endif
    </div>
    <hr>
    <div class="row static-info">
      <div class="col-md-3 name">{{trans(lang_app_site().'.CP.Client Name')}}: <span class="value">{{$order->order_user->client->username}}</span></div>
      <div class="col-md-3 name">{{trans(lang_app_site().'.CP.Procurement method')}}: <span class="value">{{$order->order_user->procurement_method}}</span></div>
      <div class="col-md-3 name">{{trans(lang_app_site().'.CP.Client Phone')}}: <span class="value">{{$order->order_user->client->mobile}}</span></div>
      <div class="col-md-3 name">{{trans(lang_app_site().'.CP.Received at')}}: <span class="value">{{$order->order_user->received_datetime}}</span></div>
    </div>
    <hr>
    <div class="row static-info">
      <div class="col-md-3 name">{{trans(lang_app_site().'.CP.Delivery method')}}: <span class="value">{{$order->delivery_method}}</span></div>
      <div class="col-md-3 name">{{trans(lang_app_site().'.CP.Order amount')}}: <span class="value">{{$order->products_price}} SAR</span></div>
      <div class="col-md-3 name">{{trans(lang_app_site().'.CP.Shipment rate')}}: <span class="value">{{$order->shipment_price}} SAR</span></div>
      <div class="col-md-3 name">{{trans(lang_app_site().'.CP.Total amount')}}: <span class="value">{{$order->products_price + $order->shipment_price}} SAR</span></div>
    </div>
    <hr>
    <div class="row static-info mb-5">
      <div class="col-md-3 name">
        {{trans(lang_app_site().'.CP.Client Location')}}:
        <span class="value">
          <a href="{{url(((getAuth()->type == 'admin')?admin_user_tab_url():getAuth()->type) . '/user/' . $order->order_user->client->id)}}" class="btn btn-circle btn-icon-only blue user-det" title="Address">
            <i class="fa fa-map"></i>
          </a>
        </span>
      </div>
      <div class="col-md-3 name">
        {{trans(lang_app_site().'.CP.Store Location')}}:
        <span class="value">
          <a href="{{url(((getAuth()->type == 'admin')?admin_user_tab_url():getAuth()->type) . '/user/' . $order->merchant_id)}}" class="btn btn-circle btn-icon-only blue user-det" title="Address">
            <i class="fa fa-map"></i>
          </a>
        </span>
      </div>
      @if($order->last_status == 'rejected')
      <div class="col-md-6 name bg-light-danger text-danger font-weight-bolder border border-danger rounded p-3">
        {{trans(lang_app_site().'.CP.Rejecte reason')}}:
        <span class="value text-danger">
          {{$order->reject_reason}}
        </span>
      </div>
      @endif
    </div>

    <div class="row static-info">
      <div class="col-md-12 text-center">
        <div class="portlet-form">
          <form class="form-horizontal form">
            <div class="form-body">
              <div class="form-actions">
                <div class="row">
                  <div class="col-md-12 text-center">
                    <a href="{{url(getAuth()->type.'/invoice/'.$order->id)}}" target="_blank" class="btn btn-circle bg-success text-white btn-md save">
                      <i class="fa fa-check text-white"></i>
                      Invoice
                    </a>
                  </div>
                </div>
              </div>
            </div>
          </form>
        </div>
      </div>

    </div>

  </div>
</div>


<div class="card card-custom mt-5">
  <div class="card-header">
    <div class="card-title">
      <i class="{{$icon}} font-dark ml-2"></i>
      <span class="caption-subject bold uppercase">المنتجات</span>
    </div>
  </div>
  <div class="card-body">
    <table id="order_products_tbl" class="table table-striped table-bordered table-hover table-checkable order-column" style="width:100%">
      <thead>
        <tr>
          <th></th>
          <th>{{trans(lang_app_site().'.CP.Product name')}}</th>
          <th>{{trans(lang_app_site().'.CP.Quantity')}}</th>
          <th>{{trans(lang_app_site().'.CP.Category')}}</th>
          <th>{{trans(lang_app_site().'.CP.Price')}}</th>
          <th>{{trans(lang_app_site().'.CP.Action')}}</th>
        </tr>
      </thead>

    </table>
  </div>

</div>
@endsection

@section('js')

<script>
  var products = {!! json_encode($order->order_products, JSON_HEX_TAG) !!};
</script>

<script src="{{url('/')}}/assets/js/products.js" type="text/javascript"></script>
@endsection