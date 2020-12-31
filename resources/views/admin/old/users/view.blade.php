@extends(admin_layout_vw().'.index')

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
        .table-container td {
            font-size: 20px;
            padding-top: 4px;
        }

    </style>
@endsection
@section('content')

    <input type="hidden" name="client_id" id="client_id" value="{{$user->id}}">
    <div class="row">

        <div class="col-md-12">
            <!-- BEGIN EXAMPLE TABLE PORTLET-->
            <div class="portlet light">
                <div class="portlet-title">
                    <div class="caption font-dark">
                        <i class="fa fa-search font-dark"></i>
                        <span class="caption-subject bold uppercase"> Client Information </span>
                    </div>

                </div>
                <div class="portlet-body">
                    <div class="table-container">
                        <form class="form-horizontal" role="form">
                            <div class="form-body">
                                <div class="form-group ">

                                    <table
                                        class="table table-striped table-bordered table-hover table-checkable order-column"
                                        id="user-det-tbl">
                                        <thead>
                                        <tr>
                                            {{--                                            <th width="20%"> Logo</th>--}}
                                            <th> Username</th>
                                            <th> Email</th>
                                            <th> Address</th>
                                            <th> Mobile</th>
                                            <th> Register Date</th>
                                            <th> Status</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        <tr>
                                            {{--                                            <td>--}}
                                            {{--                                                <div class="fileinput fileinput-new">--}}
                                            {{--                                                    <div class="">--}}
                                            {{--                                                        <img src="{{$user->image100 ?? url('assets/apps/img/man.svg')}}"--}}
                                            {{--                                                             style="width:100px;height: 100px;"--}}
                                            {{--                                                             class="img-circle">--}}
                                            {{--                                                    </div>--}}

                                            {{--                                                </div>--}}
                                            {{--                                            </td>--}}
                                            <td>{{$user->username ?? ''}}</td>
                                            <td> {{$user->email ?? ''}}</td>

                                            <td><a
                                                    href="{{url(admin_user_tab_url() . '/user/' . $user->id)}}"
                                                    class="btn btn-circle btn-icon-only blue user-det"
                                                    title="Address">
                                                    <i class="fa fa-map"></i>
                                                </a></td>
                                            <td> {{$user->mobile ?? ''}}</td>
                                            <td>{{\Carbon\Carbon::parse($user->created_at)->format('Y-m-d') ?? ''}}</td>
                                            <td><a href="javascript:;"
                                                   class="btn btn-circle btn-icon-only @if($user->is_active) red @else green @endif set_active"
                                                   data-id="{{$user->id}}"
                                                   title="@if($user->is_active) Suspend @else Activate @endif">
                                                    <i class="@if($user->is_active)fa fa-power-off @else fa fa-check @endif"></i>
                                                </a>
                                                {{--                                                <input type="checkbox" class="make-switch make-switch-activate" @if($user->is_active) checked @endif data-id="{{$user->id}}"--}}
                                                {{--                                                       data-on-text="<i class='fa fa-check'></i>"--}}
                                                {{--                                                       data-off-text="<i class='fa fa-times'></i>">--}}
                                            </td>
                                        </tr>
                                        </tbody>
                                    </table>

                                </div>


                            </div>
                        </form>
                    </div>
                </div>
            </div>
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
                                    <ul class="nav nav-tabs">

                                        <li class="active">
                                            <a href="#orders" data-toggle="tab"> Orders </a>
                                        </li>
                                        <li>
                                            <a href="#invoices" data-toggle="tab"> Invoices </a>
                                        </li>


                                    </ul>
                                    <div class="tab-content">

                                        <div class="tab-pane fade  active in " id="orders">

                                            <div class="portlet-body form">
                                                <table
                                                    class="table table-striped table-bordered table-hover table-checkable order-column"
                                                    id="user-orders-tbl">
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

                                        <div class="tab-pane fade " id="invoices">

                                            Waiting payment gateway
                                            <div class="portlet-body form">
                                                <table
                                                    class="table table-striped table-bordered table-hover table-checkable order-column"
                                                    id="">
                                                    <thead>
                                                    <tr>
                                                        <th>#</th>
                                                        <th> Invoice #</th>
                                                        <th> Order date</th>
                                                        <th> Merchant</th>
                                                        <th> Procurement method</th>
                                                        <th> Location</th>
                                                        <th> Items #</th>
                                                        <th> Order amount (SAR)</th>
                                                        <th> Status</th>
                                                        <th> Delivery/pickup date</th>
                                                    </tr>
                                                    </thead>
                                                </table>
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
            <!-- END EXAMPLE TABLE PORTLET-->
        </div>
    </div>
    <!-- /.modal -->
    <!-- /.modal -->
@endsection

@section('js')

    <!-- BEGIN PAGE LEVEL PLUGINS -->
    <script src="{{url('/')}}/assets/global/scripts/datatable.js" type="text/javascript"></script>
    <script src="{{url('/')}}/assets/global/plugins/datatables/datatables.min.js"
            type="text/javascript"></script>
    <script src="{{url('/')}}/assets/global/plugins/datatables/plugins/bootstrap/datatables.bootstrap.js"
            type="text/javascript"></script>
    <!-- END PAGE LEVEL PLUGINS -->

    {{--<script type="text/javascript" src="javascripts/jquery.googlemap.js"></script>--}}
    <script src="{{url('/')}}/assets/global/plugins/jquery-ui/jquery-ui.min.js" type="text/javascript"></script>

    <!-- BEGIN THEME GLOBAL SCRIPTS -->
    <script src="{{url('/')}}/assets/global/scripts/app.min.js" type="text/javascript"></script>
    <!-- END THEME GLOBAL SCRIPTS -->
    {{--<script src="{{url('/')}}/assets/pages/scripts/maps-google.min.js" type="text/javascript"></script>--}}
    <script src="{{url('/')}}/assets/pages/scripts/components-bootstrap-switch.min.js"
            type="text/javascript"></script>

    <script src="{{url('/')}}/assets/pages/scripts/ui-modals.min.js" type="text/javascript"></script>

    <!-- BEGIN PAGE LEVEL SCRIPTS -->
    <script src="{{url('/')}}/assets/pages/scripts/table-datatables-responsive.min.js"
            type="text/javascript"></script>

    {{--<script src="{{url('/')}}/assets/pages/scripts/table-datatables-managed.min.js" type="text/javascript"></script>--}}
    <!-- END PAGE LEVEL SCRIPTS -->
    <script src="{{url('/')}}/assets/js/users.js" type="text/javascript"></script>
    <script src="{{url('/')}}/assets/js/orders.js" type="text/javascript"></script>
    <script type="text/javascript">

    </script>

@stop
