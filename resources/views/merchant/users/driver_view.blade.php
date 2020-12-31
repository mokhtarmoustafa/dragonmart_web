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
        .table-container td {
            font-size: 20px;
            padding-top: 4px;
        }

    </style>
@endsection
@section('content')

    <div class="row">

        <div class="col-md-12">
            <!-- BEGIN EXAMPLE TABLE PORTLET-->

            <div class="portlet light ">
                <div class="portlet-title">
                    <div class="caption font-dark">
                        <i class="{{$icon}} font-dark"></i>
                        <span class="caption-subject bold uppercase"> Driver Information</span>
                    </div>

                </div>


                <div class="portlet-body">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="portlet light ">
                                <div class="portlet-body">
                                    <ul class="nav nav-tabs">

                                        <li class="active">
                                            <a href="#general_information" data-toggle="tab"> General Information </a>
                                        </li>
                                        <li>
                                            <a href="#vehicle_info" data-toggle="tab"> Vehicle Info </a>
                                        </li>
                                        <li>
                                            <a href="#docs" data-toggle="tab"> Documents </a>
                                        </li>


                                    </ul>
                                    <div class="tab-content">

                                        <div class="tab-pane fade  active in " id="general_information">

                                            <div class="portlet-body form">

                                                <table class="table table-striped table-bordered table-hover table-checkable order-column"
                                                       id="driver-det-tbl">
                                                    <thead>
                                                    <tr>
                                                        <th width="20%"> Logo</th>
                                                        <th> Username</th>
                                                        <th> Email</th>
                                                        <th> City</th>
                                                        <th> Address</th>
                                                        <th> Mobile</th>
                                                        <th> Register Date</th>
                                                        <th> Status</th>
                                                    </tr>
                                                    </thead>
                                                    <tbody>
                                                    <tr>
                                                        <td>
                                                            <div class="fileinput fileinput-new">
                                                                <div class="">
                                                                    <img src="{{$user->image100 ?? url('assets/apps/img/man.svg')}}"
                                                                         style="width:50px;height: 50px;"
                                                                         class="img-circle">
                                                                </div>

                                                            </div>
                                                        </td>
                                                        <td>{{$user->username ?? ''}}</td>
                                                        <td> {{$user->email ?? ''}}</td>
                                                        <td> {{$user->city->name_ar ?? ''}}</td>

                                                        <td><a
                                                                    href="{{url(getAuth()->type . '/user/' . $user->id)}}"
                                                                    class="btn btn-circle btn-icon-only blue user-det"
                                                                    title="Address">
                                                                <i class="fa fa-map"></i>
                                                            </a></td>
                                                        <td> {{$user->mobile ?? ''}}</td>
                                                        <td>{{\Carbon\Carbon::parse($user->created_at)->format('Y-m-d') ?? ''}}</td>
                                                        <td>
                                                            @if($user->is_active) <span class="label label-success">Activate</span> @else <span class="label label-warning">Suspend</span> @endif
                                                        </td>

                                                    </tr>
                                                    </tbody>
                                                </table>

                                            </div>
                                        </div>

                                        <div class="tab-pane fade " id="vehicle_info">

                                            <div class="portlet-body form">

                                                <table class="table table-striped table-bordered table-hover table-checkable order-column">
                                                    <thead>
                                                    <tr>
                                                        <th> Photo</th>
                                                        <th width="20%"> Type</th>
                                                        <th> Model</th>
                                                        <th> Color</th>
                                                        <th> Number</th>
                                                    </tr>
                                                    </thead>
                                                    <tbody>
                                                    <tr>
                                                        <td>
                                                            <div class="fileinput fileinput-new">
                                                                <div class="">
                                                                    <img src="{{$user->vehicle->photo ?? url('assets/apps/img/man.svg')}}"
                                                                         style="width:50px;height: 50px;"
                                                                         class="img-circle">
                                                                </div>

                                                            </div>
                                                        </td>
                                                        <td> {{$user->vehicle->car_type->title ?? ''}}</td>
                                                        <td> {{$user->vehicle->model ?? ''}}</td>
                                                        <td> {{$user->vehicle->color ?? ''}}</td>
                                                        <td> {{$user->vehicle->no ?? ''}}</td>
                                                    </tr>
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                        <div class="tab-pane fade " id="docs">

                                            <div class="portlet-body form">

                                                <table class="table table-striped table-bordered table-hover table-checkable order-column">
                                                    <thead>
                                                    <tr>
                                                        <th width="20%"> File name</th>
                                                        <th> Action</th>
                                                    </tr>
                                                    </thead>
                                                    <tbody>
                                                    <tr>
                                                        <td> Car License</td>
                                                        <td><a href="{{$user->vehicle->document ?? ''}}"
                                                               class="btn btn-primary btn-icon-only btn-circle"
                                                               download="CarLicense.png"><i class="fa fa-download"></i></a>
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td> Driver Id</td>
                                                        <td><a href="{{$user->vehicle->id_no ?? ''}}"
                                                               class="btn btn-primary btn-icon-only btn-circle"
                                                               download="DriverID.png"><i
                                                                        class="fa fa-download"></i></a></td>

                                                    </tr>
                                                    <tr>
                                                        <td> License driving</td>
                                                        <td><a href="{{$user->vehicle->license_driving ?? ''}}"
                                                               class="btn btn-primary btn-icon-only btn-circle"
                                                               download="LicenseDriving.png"><i
                                                                        class="fa fa-download"></i></a></td>

                                                    </tr>
                                                    {{--                                                    <tr>--}}
                                                    {{--                                                        <td> Document</td>--}}
                                                    {{--                                                        <td><a href="{{$user->vehicle->document ?? ''}}"--}}
                                                    {{--                                                               class="btn btn-primary btn-icon-only btn-circle"--}}
                                                    {{--                                                               download="document.png"><i--}}
                                                    {{--                                                                        class="fa fa-download"></i></a></td>--}}

                                                    {{--                                                    </tr>--}}
                                                    </tbody>
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
    <script type="text/javascript">

    </script>




@stop