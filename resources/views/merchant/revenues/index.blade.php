@extends(merchant_layout_vw().'.index')

@section('css')
    <!-- BEGIN PAGE LEVEL PLUGINS -->
    <link href="{{url('/')}}/assets/global/plugins/datatables/datatables.min.css" rel="stylesheet" type="text/css"/>
    <link href="{{url('/')}}/assets/global/plugins/datatables/plugins/bootstrap/datatables.bootstrap.css"
          rel="stylesheet" type="text/css"/>
    <!-- END PAGE LEVEL PLUGINS -->
    <link href="{{url('/')}}/assets/global/plugins/bootstrap-daterangepicker/daterangepicker.min.css" rel="stylesheet" type="text/css" />

    <link href="{{url('/')}}/assets/global/plugins/bootstrap-datepicker/css/bootstrap-datepicker3.min.css"
          rel="stylesheet" type="text/css"/>
    <!-- BEGIN THEME GLOBAL STYLES -->
    <link href="{{url('/')}}/assets/global/css/components-md.min.css" rel="stylesheet" id="style_components"
          type="text/css"/>
    <link href="{{url('/')}}/assets/global/css/plugins-md.min.css" rel="stylesheet" type="text/css"/>
    <!-- END THEME GLOBAL STYLES -->
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
                <div class="col-md-12">
                    <div class="portlet light ">
                        <div class="portlet-body">
                            <div class="row">
                                <div class="col-lg-4 col-md-4 col-sm-6 col-xs-12 pull-right">
                                    <a class="dashboard-stat dashboard-stat-v2 blue" href="#">
                                        <div class="visual">
                                            <i class="fa fa-bar-chart-o"></i>
                                        </div>
                                        <div class="details">
                                            <div class="number">
                                                <span data-counter="counterup" data-value="1349">1</span>
                                            </div>
                                            <div class="desc"> Profit</div>
                                        </div>
                                    </a>
                                </div>
                                <div class="col-lg-4 col-md-4 col-sm-6 col-xs-12 pull-right">
                                    <a class="dashboard-stat dashboard-stat-v2 green" href="#">
                                        <div class="visual">
                                            <i class="fa fa-globe"></i>
                                        </div>
                                        <div class="details">
                                            <div class="number">
                                                <span data-counter="counterup" data-value="1349">1</span>
                                            </div>
                                            <div class="desc"> Expenses</div>
                                        </div>
                                    </a>
                                </div>
                                <div class="col-lg-4 col-md-4 col-sm-6 col-xs-12 pull-right">
                                    <a class="dashboard-stat dashboard-stat-v2 purple" href="#">
                                        <div class="visual">
                                            <i class="fa fa-shopping-cart"></i>
                                        </div>
                                        <div class="details">
                                            <div class="number">
                                                <span data-counter="counterup" data-value="1349">1</span>
                                            </div>
                                            <div class="desc"> Revenue</div>
                                        </div>
                                    </a>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="portlet-body">
            <div class="row">
                <div class="col-md-12">
                    <div class="portlet light ">
                        <div class="portlet-body form">
                            <div class="row">

                                <div class="col-md-12">
                                    <!-- BEGIN EXAMPLE TABLE PORTLET-->
                                    <div class="portlet light">
                                        <div class="portlet-title">
                                            <div class="caption font-dark">
                                                <i class="fa fa-search font-dark"></i>
                                                <span class="caption-subject bold uppercase"> Filter </span>
                                            </div>

                                        </div>
                                        <div class="portlet-body">
                                            <div class="table-container">
                                                {!! Form::open(['method'=>'POST','url'=>url('/admin/export')]) !!}

                                                <table class="table table-striped table-bordered table-hover table-checkable"
                                                       id="datatable_products">
                                                    <thead>
                                                    <tr role="row" class="heading">
                                                        <th width="1%">
                                                        </th>
                                                        <th width="10%"> Order #</th>
                                                        <th width="10%"> Merchant name</th>
                                                        <th width="10%"> Order date</th>
                                                        <th width="10%"> Delivery/pickup date</th>
                                                        <th width="10%"> Driver method</th>
                                                        <th width="10%"> Driver name</th>
                                                        <th width="10%"> Action</th>
                                                    </tr>
                                                    <tr role="row" class="filter">
                                                        <td></td>
                                                        <td>
                                                            <input type="text"
                                                                   class="form-control form-filter input-md"
                                                                   name="order_no"
                                                                   placeholder="Order# ..." id="order_no">

                                                        </td>
                                                        <td>
                                                            <input type="text"
                                                                   class="form-control form-filter input-md"
                                                                   name="merchant_name"
                                                                   placeholder="Merchant name ..."
                                                                   id="merchant_name">

                                                        </td>
                                                        <td>
                                                            <input type="text"
                                                                   class="form-control form-filter input-md"
                                                                   name="send_from"
                                                                   placeholder="From ..."
                                                                   id="send_from">
                                                            <input type="text"
                                                                   class="form-control form-filter input-md"
                                                                   name="send_to"
                                                                   placeholder="To ..."
                                                                   id="send_to">

                                                        </td>
                                                        <td>
                                                            <input type="text"
                                                                   class="form-control form-filter input-md"
                                                                   name="receive_from"
                                                                   placeholder="From ..."
                                                                   id="receive_from">
                                                            <input type="text"
                                                                   class="form-control form-filter input-md"
                                                                   name="receive_to"
                                                                   placeholder="To ..."
                                                                   id="receive_to">

                                                        </td>
                                                        <td>
                                                            <select class="form-control input-md status select2"
                                                                    name="driver_type_id"
                                                                    id="driver_type_id"
                                                                    data-placeholder="Choose Driver Type">
                                                                <option value="">Choose driver type</option>
                                                                @foreach($driver_types as $type)
                                                                    <option value="{{$type->id}}">{{$type->name}}</option>
                                                                @endforeach
                                                            </select>
                                                        </td>
                                                        <td>
                                                            <input type="text"
                                                                   class="form-control form-filter input-md"
                                                                   name="driver_name"
                                                                   placeholder="Driver name ..."
                                                                   id="driver_name">

                                                        </td>

                                                        <td>
                                                            <div class="margin-bottom-5">
                                                                <a href="javascript:;"
                                                                   class="btn btn-sm btn-success btn-circle btn-icon-only filter-submit-u margin-bottom"
                                                                   title="Search">
                                                                    <i class="fa fa-search"></i>
                                                                </a>

                                                                <a href="javascript:;"
                                                                   class="btn btn-sm btn-danger btn-circle btn-icon-only filter-cancel-u"
                                                                   title="Empty">
                                                                    <i class="fa fa-times"></i>
                                                                </a>
                                                            </div>

                                                        </td>
                                                    </tr>
                                                    </thead>
                                                    <tbody></tbody>
                                                </table>
                                                {!! Form::close() !!}

                                            </div>
                                        </div>
                                    </div>
                                    <div class="portlet light ">
                                        <div class="portlet-title">
                                            <div class="caption font-dark">
                                                <i class="{{$icon}} font-dark"></i>
                                                <span class="caption-subject bold uppercase"> Revenues</span>
                                            </div>

                                        </div>


                                        <div class="portlet-body">

                                            <table class="table table-striped table-bordered table-hover table-checkable order-column"
                                                   id="new_requests">
                                                <thead>
                                                <tr>
                                                    <th>#</th>
                                                    <th> Order #</th>
                                                    <th> Merchant</th>
                                                    <th> Order date</th>
                                                    <th> Delivery/pickup date</th>
                                                    <th> Items #</th>
                                                    <th> Procurement method</th>
                                                    <th> Driver method</th>
                                                    <th> Order amount (SAR)</th>
                                                    <th> Commission (SAR)</th>
                                                    <th> Assign Driver</th>
                                                    <th> Action</th>
                                                </tr>
                                                </thead>
                                                <tbody>
                                                <tr>
                                                    <td>1</td>
                                                    <td>Order #123</td>
                                                    <td>Shipment1</td>
                                                    <td>13/02/1991 12:20</td>
                                                    <td>14/02/1991 12:20</td>
                                                    <td>4</td>
                                                    <td>delivery</td>
                                                    <td>Dragonmart delivery</td>
                                                    <td>120</td>
                                                    <td>12</td>
                                                    <td><a href="javascript:;">driver</a></td>
                                                    <td><a href="{{url(admin_vw().'/order/46')}}"
                                                           class="btn btn-primary btn-icon-only btn-circle"><i
                                                                    class="fa fa-eye"></i></a><a
                                                                href="javascript:;"
                                                                class="btn btn-success btn-icon-only btn-circle" title="invoice"><i
                                                                    class="fa fa-dollar"></i></a></td>
                                                </tr>
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                    <!-- END EXAMPLE TABLE PORTLET-->
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

    <script src="{{url('/')}}/assets/global/plugins/moment.min.js" type="text/javascript"></script>
    <script src="{{url('/')}}/assets/global/plugins/bootstrap-daterangepicker/daterangepicker.min.js"
            type="text/javascript"></script>
    <script src="{{url('/')}}/assets/global/plugins/bootstrap-datepicker/js/bootstrap-datepicker.min.js"
            type="text/javascript"></script>
    <!-- BEGIN THEME GLOBAL SCRIPTS -->
    <script src="{{url('/')}}/assets/global/scripts/app.min.js" type="text/javascript"></script>
    <!-- END THEME GLOBAL SCRIPTS -->
    {{--<script src="{{url('/')}}/assets/pages/scripts/maps-google.min.js" type="text/javascript"></script>--}}

    <script src="{{url('/')}}/assets/pages/scripts/ui-modals.min.js" type="text/javascript"></script>

    <!-- BEGIN PAGE LEVEL SCRIPTS -->
    <script src="{{url('/')}}/assets/pages/scripts/table-datatables-responsive.min.js" type="text/javascript"></script>
    <script src="{{url('/')}}/assets/pages/scripts/components-date-time-pickers.min.js" type="text/javascript"></script>

    {{--<script src="{{url('/')}}/assets/pages/scripts/table-datatables-managed.min.js" type="text/javascript"></script>--}}
    <!-- END PAGE LEVEL SCRIPTS -->
    <script src="{{url('/')}}/assets/js/users.js" type="text/javascript"></script>

@stop