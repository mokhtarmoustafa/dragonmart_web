@extends(merchant_layout_vw().'.index')

@section('css')
    <!-- BEGIN PAGE LEVEL PLUGINS -->
    <link href="{{url('/')}}/assets/global/plugins/datatables/datatables.min.css" rel="stylesheet" type="text/css"/>
    <link href="{{url('/')}}/assets/global/plugins/datatables/plugins/bootstrap/datatables.bootstrap.css"
          rel="stylesheet" type="text/css"/>
    <!-- END PAGE LEVEL PLUGINS -->
    <!-- BEGIN THEME GLOBAL STYLES -->
    <link href="{{url('/')}}/assets/global/css/components-md.min.css" rel="stylesheet" id="style_components"
          type="text/css"/>
    <link href="{{url('/')}}/assets/global/css/plugins-md.min.css" rel="stylesheet" type="text/css"/>
    <!-- END THEME GLOBAL STYLES -->
    <style>
        .circle {
            height: 50px;
            width: 50px;
            background-color: #ffffff;
            border-width: 1px;
            border-style: solid;
            border-color: grey;
            border-radius: 50%;
        }
    </style>
@endsection
@section('content')

    <div class="portlet light ">
        <div class="portlet-title">
            <div class="caption font-dark">
                <i class="{{$icon}} font-dark"></i>
                <span class="caption-subject bold uppercase"> {{$main_title}}</span>
            </div>

        </div>

        <div class="portlet-body">
            <div class="row">
                <div class="col-md-12 col-sm-12">
                    <div class="portlet blue-hoki box">
                        <div class="portlet-title">
                            <div class="caption">
                                <i class="fa fa-cogs"></i>Order Info.
                            </div>
                            {{--                            <div class="actions">--}}
                            {{--                                <a href="javascript:;" class="btn btn-default btn-sm">--}}
                            {{--                                    <i class="fa fa-pencil"></i> Edit </a>--}}
                            {{--                            </div>--}}
                        </div>
                        <div class="portlet-body">
                            <div class="row static-info">
                                <div class="col-md-2 name"> Order #: <span class="value">{{$order->id}}</span></div>
                                {{--                                <div class="col-md-2 value"></div>--}}
                                <div class="col-md-3 name"> Merchant Name: <span
                                            class="value">{{$order->Merchant->username}}</span></div>
                                {{--                                <div class="col-md-2 value"> </div>--}}

                                {{--                                <div class="col-md-2 value"> {{$order->last_status}}</div>--}}

                                <div class="col-md-3 name"> Order Date: <span
                                            class="value">{{$order->created_at}}</span></div>
                                <div class="col-md-2 name"> Status: <span class="value">{{$order->last_status}}</span>
                                </div>
                                <div class="col-md-2 name"> Item#: <span
                                            class="value">{{$order->OrderProducts->count()}}</span></div>

                            </div>

                            <hr>

                            <div class="row static-info">
                                <div class="col-md-2 name"> Buyer Name: <span
                                            class="value">{{$order->order_user->client->username}}</span></div>
                                <div class="col-md-3 name"> Procurement method: <span
                                            class="value">{{$order->order_user->procurement_method}}</span></div>
                                <div class="col-md-3 name"> Received at: <span
                                            class="value">{{$order->order_user->received_datetime}}</span></div>
                                <div class="col-md-3 name"> Buyer Phone: <span
                                            class="value">{{$order->order_user->client->mobile}}</span></div>

                            </div>


                            <div class="row static-info">

                                <div class="col-md-2 name"> Buyer Location: <span class="value"><a
                                                href="{{url(getAuth()->type . '/user/' . $order->order_user->client->id)}}"
                                                class="btn btn-circle btn-icon-only blue user-det"
                                                title="Address">
                                        <i class="fa fa-map"></i>
                                    </a></span></div>
                                <div class="col-md-3 name"> Delivery method: <span
                                            class="value">{{$order->delivery_method}}</span></div>
                                <div class="col-md-3 name"> Order amount: <span class="value">{{$order->products_price}} SAR</span>
                                </div>
                                <div class="col-md-2 name"> Shipment rate: <span class="value">{{$order->shipment_price}} SAR</span>
                                </div>
                                <div class="col-md-2 name"> Total amount: <span class="value">{{$order->products_price + $order->shipment_price}} SAR</span>
                                </div>

                            </div>

                            <div class="row static-info">
                                <div class="col-md-3 name"> Shop Location: <span class="value"><a
                                                href="{{url(getAuth()->type . '/user/' . $order->merchant_id)}}"
                                                class="btn btn-circle btn-icon-only blue user-det"
                                                title="Address">
                                        <i class="fa fa-map"></i>
                                    </a></span></div>
                            </div>

                            {{--                            @if($order->last_status == 'finished')--}}
                            <div class="row static-info">
                                <div class="col-md-12 text-center">
                                    <div class="portlet-form">
                                        <form class="form-horizontal form">
                                            <div class="form-body">
                                                <div class="form-actions" style="background-color: #f5f5f5;">
                                                    <div class="row">
                                                        <div class="col-md-12 text-center">
                                                            <a href="{{url(getAuth()->type.'/invoice/'.$order->id)}}" target="_blank"
                                                               class="btn btn-circle green btn-md save">
                                                                <i
                                                                    class="fa fa-check"></i>
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
                            {{--                            @endif--}}
                            <div class="portlet box yellow">
                                <div class="portlet-title">
                                    <div class="caption">
                                        <i class="icon-grid"></i>Products
                                    </div>
                                    <div class="tools">
                                        <a href="javascript:;" class="collapse" data-original-title="" title=""> </a>
                                        <a href="#portlet-config" data-toggle="modal" class="config"
                                           data-original-title="" title=""> </a>
                                        <a href="javascript:;" class="reload" data-original-title="" title=""> </a>
                                        <a href="javascript:;" class="remove" data-original-title="" title=""> </a>
                                    </div>
                                </div>
                                <div class="portlet-body">
                                    @foreach($order->order_products as $order_product)
                                        <div class="panel-group accordion" id="accordion{{$order_product->id}}">
                                            <div class="panel panel-default">
                                                <div class="panel-heading">
                                                    <h4 class="panel-title">
                                                        <a class="accordion-toggle accordion-toggle-styled"
                                                           data-toggle="collapse"
                                                           data-parent="#accordion{{$order_product->id}}"
                                                           href="#collapse_{{$order_product->id}}_1"
                                                           aria-expanded="true">{{$order_product->product->name}} </a>
                                                    </h4>
                                                </div>
                                                <div id="collapse_{{$order_product->id}}_1"
                                                     class="panel-collapse collapse in"
                                                     aria-expanded="true">
                                                    <div class="panel-body">
                                                        <div class="row static-info">
                                                            <div class="col-md-1 name"><img
                                                                        src="{{$order_product->product->images[0]->image100 ?? url('assets/no-product.jpg')}}"
                                                                        style="width:100px;" class=""></div>
                                                            <div class="col-md-10 name">

                                                                <div class="row static-info">
                                                                    <div class="col-md-2 name"> Product name: <span
                                                                                class="value">{{$order_product->product->name}}</span>
                                                                    </div>
                                                                    <div class="col-md-2 name"> Quantity: <span
                                                                                class="value">{{$order_product->quantity}}</span>
                                                                    </div>
                                                                    <div class="col-md-2 name"> Category: <span
                                                                                class="value">{{$order_product->product->category->name}}</span>
                                                                    </div>
                                                                    <div class="col-md-2 "></div>
                                                                </div>
                                                                <div class="row static-info">
                                                                    <div class="col-md-2 name"> Price: <span
                                                                                class="value">{{$order_product->price}} SAR</span>
                                                                    </div>
                                                                    <div class="col-md-1 name"> Customization:</div>
                                                                    <div class="col-md-6 value">
                                                                        {{--                                                                        <ul>--}}
                                                                        @foreach($order_product->Customizations as $custom)
                                                                            @if($custom->custom_id == 3)
                                                                                <div class="col-md-1 circle"
                                                                                     style="background-color:{{$custom->text}};text-align: center;padding-top: 14px; margin-left: 4px;"></div>
                                                                            @else
                                                                                <div class="col-md-1 circle"
                                                                                     style="text-align: center;padding-top: 14px;margin-left: 4px;">
                                                                                    {{$custom->text}}
                                                                                </div>
                                                                            @endif
                                                                        @endforeach
                                                                        {{--                                                                        </ul>--}}
                                                                    </div>
                                                                </div>
                                                            </div>


                                                        </div>


                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    @endforeach
                                </div>


                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('js')

    <!-- BEGIN PAGE LEVEL PLUGINS -->
    <script src="{{url('/')}}/assets/global/scripts/datatable.js" type="text/javascript"></script>
    <script src="{{url('/')}}/assets/global/plugins/datatables/datatables.min.js" type="text/javascript"></script>
    <script src="{{url('/')}}/assets/global/plugins/datatables/plugins/bootstrap/datatables.bootstrap.js"
            type="text/javascript"></script>
    <!-- END PAGE LEVEL PLUGINS -->

    {{--<script type="text/javascript" src="javascripts/jquery.googlemap.js"></script>--}}
    <script src="{{url('/')}}/assets/global/plugins/jquery-ui/jquery-ui.min.js" type="text/javascript"></script>

    <!-- BEGIN THEME GLOBAL SCRIPTS -->
    <script src="{{url('/')}}/assets/global/scripts/app.min.js" type="text/javascript"></script>
    <!-- END THEME GLOBAL SCRIPTS -->
    {{--<script src="{{url('/')}}/assets/pages/scripts/maps-google.min.js" type="text/javascript"></script>--}}

    <script src="{{url('/')}}/assets/pages/scripts/ui-modals.min.js" type="text/javascript"></script>

    <!-- BEGIN PAGE LEVEL SCRIPTS -->
    <script src="{{url('/')}}/assets/pages/scripts/table-datatables-responsive.min.js" type="text/javascript"></script>

    {{--<script src="{{url('/')}}/assets/pages/scripts/table-datatables-managed.min.js" type="text/javascript"></script>--}}
    <!-- END PAGE LEVEL SCRIPTS -->
    <script src="{{url('/')}}/assets/js/users.js" type="text/javascript"></script>

@stop
