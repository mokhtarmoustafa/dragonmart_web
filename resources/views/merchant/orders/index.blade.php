@extends(merchant_layout_vw().'.index')

@section('css')
    <!-- BEGIN PAGE LEVEL PLUGINS -->
    <link href="{{url('/')}}/assets/global/plugins/datatables/datatables.min.css" rel="stylesheet" type="text/css"/>
    <link href="{{url('/')}}/assets/global/plugins/datatables/plugins/bootstrap/datatables.bootstrap.css"
          rel="stylesheet" type="text/css"/>
    <!-- END PAGE LEVEL PLUGINS -->

    <link href="{{url('/')}}/assets/global/plugins/bootstrap-daterangepicker/daterangepicker.min.css" rel="stylesheet"
          type="text/css"/>

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
                                <div class="col-lg-4 col-md-4 col-sm-6 col-xs-12">
                                    <a class="dashboard-stat dashboard-stat-v2 blue"
                                       href="{{url(merchant_vw().'/orders')}}">
                                        <div class="visual">
                                            <i class="fa fa-comments"></i>
                                        </div>
                                        <div class="details">
                                            <div class="number">
                                                <span data-counter="counterup" data-value="{{$new}}">0</span>
                                            </div>
                                            <div class="desc"> New requests</div>
                                        </div>
                                    </a>
                                </div>
                                <div class="col-lg-4 col-md-4 col-sm-6 col-xs-12">
                                    <a class="dashboard-stat dashboard-stat-v2 red"
                                       href="{{url(merchant_vw().'/orders')}}">
                                        <div class="visual">
                                            <i class="fa fa-bar-chart-o"></i>
                                        </div>
                                        <div class="details">
                                            <div class="number">
                                                <span data-counter="counterup" data-value="{{$current}}">0</span>
                                            </div>
                                            <div class="desc"> Current orders</div>
                                        </div>
                                    </a>
                                </div>
                                <div class="col-lg-4 col-md-4 col-sm-6 col-xs-12">
                                    <a class="dashboard-stat dashboard-stat-v2 green"
                                       href="{{url(merchant_vw().'/orders')}}">
                                        <div class="visual">
                                            <i class="fa fa-shopping-cart"></i>
                                        </div>
                                        <div class="details">
                                            <div class="number">
                                                <span data-counter="counterup" data-value="{{$completed}}">0</span>
                                            </div>
                                            <div class="desc"> Finished orders</div>
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
                        <div class="portlet-body">
                            <ul class="nav nav-tabs">

                                <li class="active">
                                    <a href="#new_requests" data-toggle="tab"> New requests </a>
                                </li>
                                <li>
                                    <a href="#current_orders" data-toggle="tab"> Current orders </a>
                                </li>
                                <li>
                                    <a href="#finished_orders" data-toggle="tab"> Finished orders</a>
                                </li>


                            </ul>
                            <div class="tab-content">

                                <div class="tab-pane fade  active in " id="new_requests">

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
                                                                   id="new_report_orders">
                                                                <thead>
                                                                <tr role="row" class="heading">
                                                                    <th width="1%">
                                                                    </th>
                                                                    <th width="10%"> Order #</th>
                                                                    <th width="10%"> Merchant name</th>
                                                                    <th width="20%"> Order date</th>
                                                                    <th width="20%"> Delivery/pickup date</th>
                                                                    {{--                                                                    <th width="10%"> Delivery method</th>--}}
                                                                    {{--                                                                    <th width="10%"> Driver name</th>--}}
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
                                                                        <div class="input-group date-picker input-daterange text-center"
                                                                             data-date="2012/11/10"
                                                                             data-date-format="yyyy-mm-dd">
                                                                            <input type="text" class="form-control"
                                                                                   name="from" placeholder="From"
                                                                                   id="order_date_from">
                                                                            <span class="input-group-addon"> to </span>
                                                                            <input type="text" class="form-control"
                                                                                   id="order_date_to"
                                                                                   name="to" placeholder="To"></div>
                                                                    </td>
                                                                    <td>
                                                                        <div class="input-group date-picker input-daterange text-center"
                                                                             data-date="2012/11/10"
                                                                             data-date-format="yyyy-mm-dd">
                                                                            <input type="text" class="form-control"
                                                                                   name="from" placeholder="From"
                                                                                   id="received_date_from">
                                                                            <span class="input-group-addon"> to </span>
                                                                            <input type="text" class="form-control"
                                                                                   id="received_date_to"
                                                                                   name="to" placeholder="To"></div>

                                                                    </td>
                                                                    {{--                                                                    <td>--}}
                                                                    {{--                                                                        <select class="form-control input-md status select2"--}}
                                                                    {{--                                                                                name="driver_type_id"--}}
                                                                    {{--                                                                                id="driver_type_id"--}}
                                                                    {{--                                                                                data-placeholder="Choose Driver Type">--}}
                                                                    {{--                                                                            <option value="">Choose driver type</option>--}}
                                                                    {{--                                                                            @foreach($driver_types as $type)--}}
                                                                    {{--                                                                                <option value="{{$type->id}}">{{$type->name}}</option>--}}
                                                                    {{--                                                                            @endforeach--}}
                                                                    {{--                                                                        </select>--}}
                                                                    {{--                                                                    </td>--}}
                                                                    {{--                                                                    <td>--}}
                                                                    {{--                                                                        <input type="text"--}}
                                                                    {{--                                                                               class="form-control form-filter input-md"--}}
                                                                    {{--                                                                               name="driver_name"--}}
                                                                    {{--                                                                               placeholder="Driver name ..."--}}
                                                                    {{--                                                                               id="driver_name">--}}

                                                                    {{--                                                                    </td>--}}

                                                                    <td>
                                                                        <div class="margin-bottom-5">
                                                                            <a href="javascript:;"
                                                                               class="btn btn-sm btn-success btn-circle btn-icon-only filter-submit-report-n margin-bottom"
                                                                               title="Search">
                                                                                <i class="fa fa-search"></i>
                                                                            </a>

                                                                            <a href="javascript:;"
                                                                               class="btn btn-sm btn-danger btn-circle btn-icon-only filter-cancel-report-n"
                                                                               title="Empty">
                                                                                <i class="fa fa-rotate-left"></i>
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
                                                            <span class="caption-subject bold uppercase"> New Requests</span>
                                                        </div>
                                                        {{--                                                        <div class="actions">--}}
                                                        {{--                                                            <a href="{{url('admin/user-driver/create')}}"--}}
                                                        {{--                                                               class="btn btn-circle btn-info add-driver-mdl">--}}
                                                        {{--                                                                <i class="fa fa-user-plus"></i>--}}
                                                        {{--                                                                <span class="hidden-xs"> Add New Driver </span>--}}
                                                        {{--                                                            </a>--}}
                                                        {{--                                                        </div>--}}

                                                    </div>


                                                    <div class="portlet-body">
                                                        {{-- `username`, `email`, `email_verified_at`, `password`, `mobile`, `verification_code`, `is_confirm`, `address`, `latitude`, `longitude`, `image`, `type`, `is_active`--}}

                                                        <table class="table table-striped table-bordered table-hover table-checkable order-column"
                                                               id="new_report_orders_tbl">
                                                            <thead>
                                                            <tr>
                                                                {{--                                                                <th>#</th>--}}
                                                                {{--                                                                <th> Order #</th>--}}
                                                                {{--                                                                <th> Merchant</th>--}}
                                                                {{--                                                                <th> Order date</th>--}}
                                                                {{--                                                                <th> Delivery/pickup date</th>--}}
                                                                {{--                                                                <th> Items #</th>--}}
                                                                {{--                                                                <th> Procurement method</th>--}}
                                                                {{--                                                                <th> Delivery method</th>--}}
                                                                {{--                                                                <th> Order amount (SAR)</th>--}}
                                                                {{--                                                                <th> Commission (SAR)</th>--}}
                                                                {{--                                                                <th> Assign Driver</th>--}}
                                                                {{--                                                                <th> Action</th>--}}
                                                                <th>#</th>
                                                                <th> Order #</th>
                                                                <th> Merchant</th>
                                                                <th> Order date</th>
                                                                <th> Delivery/pickup date</th>
                                                                <th> Items #</th>
                                                                <th> Procurement method</th>
                                                                {{--                                                                <th> Delivery method</th>--}}
                                                                <th> Order amount (SAR)</th>
                                                                {{--                                                                <th> Commission (SAR)</th>--}}
                                                                {{--                                                                <th> Assign Driver</th>--}}
                                                                <th> Action</th>
                                                            </tr>
                                                            </thead>
                                                        </table>
                                                    </div>
                                                </div>
                                                <!-- END EXAMPLE TABLE PORTLET-->
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="tab-pane fade" id="current_orders">

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
                                                                   id="current_report_orders">
                                                                <thead>
                                                                <tr role="row" class="heading">
                                                                    <th width="1%">
                                                                        {{--<label class="mt-checkbox mt-checkbox-single mt-checkbox-outline">--}}
                                                                        {{--<input type="checkbox" class="group-checkable"--}}
                                                                        {{--data-set="#sample_2 .checkboxes"/>--}}
                                                                        {{--<span></span>--}}
                                                                        {{--</label>--}}
                                                                    </th>
                                                                    {{-- `username`, `email`, `email_verified_at`, `password`, `mobile`, `verification_code`, `is_confirm`, `address`, `latitude`, `longitude`, `image`, `type`, `is_active`--}}
                                                                    <th width="10%"> Order #</th>
                                                                    <th width="10%"> Merchant name</th>
                                                                    <th width="20%"> Order date</th>
                                                                    <th width="20%"> Delivery/pickup date</th>
                                                                    <th width="10%"> Delivery method</th>
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
                                                                        <div class="input-group date-picker input-daterange text-center"
                                                                             data-date="2012/11/10"
                                                                             data-date-format="yyyy-mm-dd">
                                                                            <input type="text" class="form-control"
                                                                                   name="from" placeholder="From"
                                                                                   id="order_date_from">
                                                                            <span class="input-group-addon"> to </span>
                                                                            <input type="text" class="form-control"
                                                                                   id="order_date_to"
                                                                                   name="to" placeholder="To"></div>
                                                                    </td>
                                                                    <td>
                                                                        <div class="input-group date-picker input-daterange text-center"
                                                                             data-date="2012/11/10"
                                                                             data-date-format="yyyy-mm-dd">
                                                                            <input type="text" class="form-control"
                                                                                   name="from" placeholder="From"
                                                                                   id="received_date_from">
                                                                            <span class="input-group-addon"> to </span>
                                                                            <input type="text" class="form-control"
                                                                                   id="received_date_to"
                                                                                   name="to" placeholder="To"></div>

                                                                    </td>
                                                                    <td>
                                                                        <select class="form-control input-md status select2"
                                                                                name="driver_type_id"
                                                                                id="driver_type_id"
                                                                                data-placeholder="Choose Driver Type">
                                                                            <option value="">Choose driver type</option>
                                                                            @foreach($driver_types as $type)
                                                                                <option value="{{$type->key}}">{{$type->name}}</option>
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
                                                                               class="btn btn-sm btn-success btn-circle btn-icon-only filter-submit-report-c margin-bottom"
                                                                               title="Search">
                                                                                <i class="fa fa-search"></i>
                                                                            </a>

                                                                            <a href="javascript:;"
                                                                               class="btn btn-sm btn-danger btn-circle btn-icon-only filter-cancel-report-c"
                                                                               title="Empty">
                                                                                <i class="fa fa-rotate-left"></i>
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
                                                            <span class="caption-subject bold uppercase"> Current orders</span>
                                                        </div>
                                                        {{--                                                        <div class="actions">--}}
                                                        {{--                                                            <a href="{{url('admin/user-driver/create')}}"--}}
                                                        {{--                                                               class="btn btn-circle btn-info add-driver-mdl">--}}
                                                        {{--                                                                <i class="fa fa-user-plus"></i>--}}
                                                        {{--                                                                <span class="hidden-xs"> Add New Driver </span>--}}
                                                        {{--                                                            </a>--}}
                                                        {{--                                                        </div>--}}

                                                    </div>


                                                    <div class="portlet-body">
                                                        {{-- `username`, `email`, `email_verified_at`, `password`, `mobile`, `verification_code`, `is_confirm`, `address`, `latitude`, `longitude`, `image`, `type`, `is_active`--}}

                                                        <table class="table table-striped table-bordered table-hover table-checkable order-column"
                                                               id="current_report_orders_tbl">
                                                            <thead>
                                                            <tr>
                                                                <th>#</th>
                                                                <th> Order #</th>
                                                                <th> Merchant</th>
                                                                <th> Order date</th>
                                                                <th> Delivery/pickup date</th>
                                                                <th> Items #</th>
                                                                <th> Procurement method</th>
                                                                <th> Delivery method</th>
                                                                <th> Driver name</th>
                                                                <th> Order amount (SAR)</th>
                                                                <th> Shipping rate (SAR)</th>
                                                                <th> Action</th>
                                                            </tr>
                                                            </thead>
                                                        </table>

                                                    </div>
                                                </div>
                                                <!-- END EXAMPLE TABLE PORTLET-->
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="tab-pane fade" id="finished_orders">

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
                                                                   id="finished_report_orders">
                                                                <thead>
                                                                <tr role="row" class="heading">
                                                                    <th width="1%">
                                                                        {{--<label class="mt-checkbox mt-checkbox-single mt-checkbox-outline">--}}
                                                                        {{--<input type="checkbox" class="group-checkable"--}}
                                                                        {{--data-set="#sample_2 .checkboxes"/>--}}
                                                                        {{--<span></span>--}}
                                                                        {{--</label>--}}
                                                                    </th>
                                                                    {{-- `username`, `email`, `email_verified_at`, `password`, `mobile`, `verification_code`, `is_confirm`, `address`, `latitude`, `longitude`, `image`, `type`, `is_active`--}}
                                                                    <th width="10%"> Order #</th>
                                                                    <th width="10%"> Merchant name</th>
                                                                    <th width="20%"> Order date</th>
                                                                    <th width="20%"> Delivery/pickup date</th>
                                                                    <th width="10%"> Delivery method</th>
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
                                                                        <div class="input-group date-picker input-daterange text-center"
                                                                             data-date="2012/11/10"
                                                                             data-date-format="yyyy-mm-dd">
                                                                            <input type="text" class="form-control"
                                                                                   name="from" placeholder="From"
                                                                                   id="order_date_from">
                                                                            <span class="input-group-addon"> to </span>
                                                                            <input type="text" class="form-control"
                                                                                   id="order_date_to"
                                                                                   name="to" placeholder="To"></div>
                                                                    </td>
                                                                    <td>
                                                                        <div class="input-group date-picker input-daterange text-center"
                                                                             data-date="2012/11/10"
                                                                             data-date-format="yyyy-mm-dd">
                                                                            <input type="text" class="form-control"
                                                                                   name="from" placeholder="From"
                                                                                   id="received_date_from">
                                                                            <span class="input-group-addon"> to </span>
                                                                            <input type="text" class="form-control"
                                                                                   id="received_date_to"
                                                                                   name="to" placeholder="To"></div>

                                                                    </td>
                                                                    <td>
                                                                        <select class="form-control input-md status select2"
                                                                                name="driver_type_id"
                                                                                id="driver_type_id"
                                                                                data-placeholder="Choose Driver Type">
                                                                            <option value="">Choose driver type</option>
                                                                            @foreach($driver_types as $type)
                                                                                <option value="{{$type->key}}">{{$type->name}}</option>
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
                                                                               class="btn btn-sm btn-success btn-circle btn-icon-only filter-submit-report-f margin-bottom"
                                                                               title="Search">
                                                                                <i class="fa fa-search"></i>
                                                                            </a>

                                                                            <a href="javascript:;"
                                                                               class="btn btn-sm btn-danger btn-circle btn-icon-only filter-cancel-report-f"
                                                                               title="Empty">
                                                                                <i class="fa fa-rotate-left"></i>
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
                                                            <span class="caption-subject bold uppercase"> Finished orders</span>
                                                        </div>

                                                    </div>


                                                    <div class="portlet-body">
                                                        <table class="table table-striped table-bordered table-hover table-checkable order-column"
                                                               id="finished_report_orders_tbl">
                                                            <thead>
                                                            <tr>
                                                                <th>#</th>
                                                                <th> Order #</th>
                                                                <th> Merchant</th>
                                                                <th> Order date</th>
                                                                <th> Delivery/pickup date</th>
                                                                <th> Actual receive date</th>
                                                                <th> Items #</th>
                                                                <th> Procurement method</th>
                                                                <th> Delivery method</th>
                                                                <th> Driver name</th>
                                                                <th> Order amount (SAR)</th>
                                                                <th> Shipping rate (SAR)</th>
                                                                <th> Action</th>
                                                            </tr>
                                                            </thead>
                                                        </table>

                                                    </div>
                                                </div>
                                                <!-- END EXAMPLE TABLE PORTLET-->
                                            </div>
                                        </div>
                                    </div>
                                </div>

                            </div>
                            <div class="clearfix margin-bottom-20"></div>
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

    <script src="{{url('/')}}/assets/global/plugins/moment.min.js" type="text/javascript"></script>
    <script src="{{url('/')}}/assets/global/plugins/bootstrap-daterangepicker/daterangepicker.min.js"
            type="text/javascript"></script>
    {{--    <script src="{{url('/')}}/assets/global/plugins/morris/morris.min.js" type="text/javascript"></script>--}}
    {{--    <script src="{{url('/')}}/assets/global/plugins/morris/raphael-min.js" type="text/javascript"></script>--}}
    <script src="{{url('/')}}/assets/global/plugins/counterup/jquery.waypoints.min.js" type="text/javascript"></script>
    <script src="{{url('/')}}/assets/global/plugins/counterup/jquery.counterup.min.js" type="text/javascript"></script>

    {{--<script type="text/javascript" src="javascripts/jquery.googlemap.js"></script>--}}
    {{--    <script src="{{url('/')}}/assets/global/plugins/jquery-ui/jquery-ui.min.js" type="text/javascript"></script>--}}
    {{--    <script src="{{url('/')}}/assets/global/plugins/moment.min.js" type="text/javascript"></script>--}}
    {{--    <script src="{{url('/')}}/assets/global/plugins/bootstrap-daterangepicker/daterangepicker.min.js" type="text/javascript"></script>--}}
    <script src="{{url('/')}}/assets/global/plugins/bootstrap-datepicker/js/bootstrap-datepicker.min.js"
            type="text/javascript"></script>
    <!-- BEGIN THEME GLOBAL SCRIPTS -->
    <script src="{{url('/')}}/assets/global/scripts/app.min.js" type="text/javascript"></script>
    <!-- END THEME GLOBAL SCRIPTS -->
    {{--<script src="{{url('/')}}/assets/pages/scripts/maps-google.min.js" type="text/javascript"></script>--}}

    {{--    <script src="{{url('/')}}/assets/pages/scripts/ui-modals.min.js" type="text/javascript"></script>--}}
    <script src="{{url('/')}}/assets/pages/scripts/components-date-time-pickers.min.js" type="text/javascript"></script>

    <!-- BEGIN PAGE LEVEL SCRIPTS -->
    <script src="{{url('/')}}/assets/pages/scripts/table-datatables-responsive.min.js" type="text/javascript"></script>

    {{--<script src="{{url('/')}}/assets/pages/scripts/table-datatables-managed.min.js" type="text/javascript"></script>--}}
    <!-- END PAGE LEVEL SCRIPTS -->
    <script src="{{url('/')}}/assets/js/users.js" type="text/javascript"></script>
    <script src="{{url('/')}}/assets/js/orders.js" type="text/javascript"></script>

@stop