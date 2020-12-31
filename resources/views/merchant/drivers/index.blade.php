@extends(merchant_layout_vw().'.index')

@section('css')
    <!-- BEGIN PAGE LEVEL PLUGINS -->
    <link href="{{url('/')}}/assets/global/plugins/datatables/datatables.min.css" rel="stylesheet" type="text/css"/>
    <link href="{{url('/')}}/assets/global/plugins/datatables/plugins/bootstrap/datatables.bootstrap.css"
          rel="stylesheet" type="text/css"/>

    <link href="{{url('/')}}/assets/global/plugins/bootstrap-datepicker/css/bootstrap-datepicker3.min.css"
          rel="stylesheet" type="text/css"/>

    <!-- BEGIN PAGE LEVEL PLUGINS -->
    <link href="{{url('/')}}/assets/global/plugins/select2/css/select2.min.css" rel="stylesheet" type="text/css"/>
    <link href="{{url('/')}}/assets/global/plugins/select2/css/select2-bootstrap.min.css" rel="stylesheet"
          type="text/css"/>
    <!-- END PAGE LEVEL PLUGINS -->
    <!-- END PAGE LEVEL PLUGINS -->
    <!-- BEGIN THEME GLOBAL STYLES -->
    <link href="{{url('/')}}/assets/global/css/components-md.min.css" rel="stylesheet" id="style_components"
          type="text/css"/>
    <link href="{{url('/')}}/assets/global/css/plugins-md.min.css" rel="stylesheet" type="text/css"/>
    <!-- END THEME GLOBAL STYLES -->
    <style>
        .form .form-section, .portlet-form .form-section {
            margin: 0 !important;
            padding: 0 !important;
        }
    </style>
@endsection
@section('content')

<div class="row store_drivers">
    <div class="col-md-12">
        <div class="portlet box green">
            <div class="portlet-title">
                <div class="caption">
                    <i class="{{$icon}} font-dark"></i>
                    <span class="caption-subject bold uppercase"> My Drivers </span>
                </div>

            </div>
            <div class="portlet-body form">
                <div class="form-body">
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
                                {!! Form::open(['method'=>'POST','url'=>url(admin_manage_url().'/admin/export')]) !!}

                                <table class="table table-striped table-bordered table-hover table-checkable"
                                       id="datatable_products">
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
                                        <th width="10%"> Username</th>
                                        <th width="10%"> Email</th>
                                        <th width="10%"> Mobile</th>
{{--                                        <th width="10%"> Type</th>--}}
                                        <th width="10%"> Status</th>
                                        <th width="10%"> Action</th>
                                    </tr>
                                    <tr role="row" class="filter">
                                        <td></td>
                                        <td>
                                            <input type="text" class="form-control form-filter input-md"
                                                   name="username"
                                                   placeholder="Username" id="username">

                                        </td>
                                        <td>
                                            <input type="email" class="form-control form-filter input-md"
                                                   name="email"
                                                   placeholder="Email" id="email">
                                        </td>
                                        <td>
                                            <input type="text" class="form-control form-filter input-md"
                                                   name="mobile"
                                                   placeholder="Mobile" id="mobile">
                                        </td>
{{--                                        <td>--}}
{{--                                            <select class="form-control input-md type" name="type" id="type"--}}
{{--                                                    data-placeholder="Choose Type">--}}
{{--                                                <option value="">Choose type</option>--}}
{{--                                                <option value="client">Client</option>--}}
{{--                                                <option value="driver">Driver</option>--}}
{{--                                            </select>--}}
{{--                                        </td>--}}
                                        <td>
                                            <select class="form-control input-md status" name="is_active"
                                                    id="is_active"
                                                    data-placeholder="Choose Status">
                                                <option value="">Choose status</option>
                                                <option value="0">Disable</option>
                                                <option value="1">Active</option>
                                            </select>
                                        </td>
                                        <td>
                                            <div class="margin-bottom-5">
                                                <a href="javascript:;"
                                                   class="btn btn-sm btn-success btn-circle btn-icon-only filter-submit-driver margin-bottom"
                                                   title="Search">
                                                    <i class="fa fa-search"></i>
                                                </a>

                                                <a href="javascript:;"
                                                   class="btn btn-sm btn-danger btn-circle btn-icon-only filter-cancel-driver"
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
                                <span class="caption-subject bold uppercase"> drivers</span>
                            </div>
                            <div class="actions">
                                <a href="{{url('merchant/user-driver/create')}}"
                                   class="btn btn-circle btn-info add-driver-mdl">
                                    <i class="fa fa-user-plus"></i>
                                    <span class="hidden-xs"> Add New Driver </span>
                                </a>
                            </div>
                        </div>


                        <div class="portlet-body">
                            {{-- `username`, `email`, `email_verified_at`, `password`, `mobile`, `verification_code`, `is_confirm`, `address`, `latitude`, `longitude`, `image`, `type`, `is_active`--}}

                            <table class="table table-striped table-bordered table-hover table-checkable order-column"
                                   id="drivers_merchant_tbl">
                                <thead>
                                <tr>
                                    <th>#</th>
                                    <th> Logo</th>
                                    <th> Username</th>
                                    <th> Email</th>
                                    <th> Address</th>
                                    <th> Mobile</th>
                                    <th> Driver Type</th>
                                    <th> Vehicle Type</th>
                                    <th> Vehicle Color</th>
                                    <th> Vehicle Number</th>
                                    <th> Status</th>
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
{{--<div class="modal fade bs-modal-lg" id="addDriver" tabindex="-1" role="dialog" aria-hidden="true">--}}
{{--    <div class="modal-dialog modal-lg">--}}
{{--        <div class="modal-content">--}}
{{--            <div class="modal-header">--}}
{{--                <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>--}}
{{--                <h4 class="modal-title"><i class="fa fa-user-plus"></i> Add New Driver<span--}}
{{--                            class="badge badge-primary name "--}}
{{--                            style="text-transform: inherit"></span></h4>--}}
{{--            </div>--}}
{{--            <div class="modal-body">--}}
{{--                <div class="portlet-body form">--}}

{{--                    {!! Form::open(['method'=>'POST','class'=>'form-horizontal form-bordered form-row-stripped']) !!}--}}


{{--                    <div class="form-body">--}}

{{--                        <div class="form-group">--}}

{{--                            <div class="control-label col-md-4">--}}
{{--                                <h3 class="form-section font-blue-madison" style="display: block;text-align: left">--}}
{{--                                    General Information</h3></div>--}}
{{--                        </div>--}}
{{--                        <div class="form-group">--}}
{{--                            <div class="control-label col-md-2">--}}
{{--                                <label for="driver_types">Driver name</label>--}}
{{--                            </div>--}}
{{--                            <div class="col-md-4">--}}
{{--                                <input type="text" name="driver_name" id="driver_name" class="form-control"--}}
{{--                                       placeholder="Driver name ...">--}}
{{--                            </div>--}}
{{--                            <div class="control-label col-md-2">--}}
{{--                                <label for="driver_types">Email</label>--}}
{{--                            </div>--}}
{{--                            <div class="col-md-4">--}}
{{--                                <input type="email" name="email" id="email" class="form-control"--}}
{{--                                       placeholder="Email ...">--}}
{{--                            </div>--}}
{{--                        </div>--}}
{{--                        <div class="form-group">--}}
{{--                            <div class="control-label col-md-2">--}}
{{--                                <label for="driver_types">Phone</label>--}}
{{--                            </div>--}}
{{--                            <div class="control-label col-md-4">--}}
{{--                                <input type="text" name="mobile" id="mobile" class="form-control"--}}
{{--                                       placeholder="Phone ...">--}}
{{--                            </div>--}}
{{--                            <div class="control-label col-md-2">--}}
{{--                                <label for="driver_types">City</label>--}}
{{--                            </div>--}}
{{--                            <div class="col-md-4">--}}
{{--                                <select class="form-control" name="city_id">--}}
{{--                                    <option>Select ...</option>--}}
{{--                                    @foreach($cities as $city)--}}
{{--                                        <option value="{{$city->id}}">{{$city->name_ar}}</option>--}}
{{--                                    @endforeach--}}
{{--                                </select>--}}
{{--                            </div>--}}
{{--                        </div>--}}
{{--                        <div class="form-group">--}}
{{--                            <div class="control-label col-md-2">--}}
{{--                                <label for="driver_types">Address</label>--}}
{{--                            </div>--}}
{{--                            <div class="control-label col-md-4">--}}
{{--                                <input type="text" name="address" id="address" class="form-control"--}}
{{--                                       placeholder="Address ...">--}}
{{--                            </div>--}}

{{--                        </div>--}}

{{--                        <div class="form-group">--}}

{{--                            <div class="control-label col-md-4">--}}
{{--                                <h3 class="form-section font-blue-madison" style="display: block;text-align: left">--}}
{{--                                    Vehicle Information</h3></div>--}}
{{--                        </div>--}}
{{--                        <div class="form-group">--}}
{{--                            <div class="control-label col-md-2">--}}
{{--                                <label for="driver_types">Manufacturer</label>--}}
{{--                            </div>--}}
{{--                            <div class="col-md-4">--}}
{{--                                <select class="form-control" name="manufacturer_id">--}}
{{--                                    <option>Select ...</option>--}}
{{--                                    @foreach($manufacturers as $manufacturer)--}}
{{--                                        <option value="{{$manufacturer->id}}">{{$manufacturer->title}}</option>--}}
{{--                                    @endforeach--}}
{{--                                </select>--}}
{{--                            </div>--}}
{{--                            <div class="control-label col-md-2">--}}
{{--                                <label for="driver_types">Type</label>--}}
{{--                            </div>--}}
{{--                            <div class="col-md-4">--}}
{{--                                <select class="form-control" name="car_type_id">--}}
{{--                                    <option>Select ...</option>--}}
{{--                                    --}}{{--                                        @foreach($cities as $city)--}}
{{--                                    --}}{{--                                            <option value="{{$city->id}}">{{$city->name_ar}}</option>--}}
{{--                                    --}}{{--                                        @endforeach--}}
{{--                                </select>--}}
{{--                            </div>--}}
{{--                        </div>--}}
{{--                        <div class="form-group">--}}

{{--                            <div class="control-label col-md-2">--}}
{{--                                <label for="driver_types">Model</label>--}}
{{--                            </div>--}}
{{--                            <div class="control-label col-md-4">--}}
{{--                                <input type="text" name="model" id="model" class="form-control"--}}
{{--                                       placeholder="Model ...">--}}
{{--                            </div>--}}
{{--                            <div class="control-label col-md-2">--}}
{{--                                <label for="driver_types">Color</label>--}}
{{--                            </div>--}}
{{--                            <div class="control-label col-md-4">--}}
{{--                                <input type="text" name="color" id="color" class="form-control"--}}
{{--                                       placeholder="Color ...">--}}
{{--                            </div>--}}
{{--                        </div>--}}
{{--                        <div class="form-group">--}}

{{--                            <div class="control-label col-md-2">--}}
{{--                                <label for="driver_types">Vehicle No.</label>--}}
{{--                            </div>--}}
{{--                            <div class="control-label col-md-4">--}}
{{--                                <input type="text" name="no" id="no" class="form-control"--}}
{{--                                       placeholder="Vehicle No ...">--}}
{{--                            </div>--}}
{{--                        </div>--}}

{{--                        <div class="form-group">--}}

{{--                            <div class="control-label col-md-4">--}}
{{--                                <h3 class="form-section font-blue-madison" style="display: block;text-align: left">--}}
{{--                                    Vehicle Document</h3></div>--}}
{{--                        </div>--}}
{{--                        <div class="form-group">--}}

{{--                            <div class="control-label col-md-2">--}}
{{--                                <label for="driver_types">Car licences</label>--}}
{{--                            </div>--}}
{{--                            <div class="control-label col-md-4">--}}
{{--                                <input type="file" name="vehicle_photo" id="vehicle_photo" class="form-control"--}}
{{--                                       placeholder="Car licences ...">--}}
{{--                            </div>--}}
{{--                            <div class="control-label col-md-2">--}}
{{--                                <label for="driver_types">License driving</label>--}}
{{--                            </div>--}}
{{--                            <div class="control-label col-md-4">--}}
{{--                                <input type="file" name="license_driving" id="license_driving" class="form-control"--}}
{{--                                       placeholder="License driving ...">--}}
{{--                            </div>--}}
{{--                        </div>--}}
{{--                        <div class="form-group">--}}

{{--                            <div class="control-label col-md-2">--}}
{{--                                <label for="driver_types">Document</label>--}}
{{--                            </div>--}}
{{--                            <div class="control-label col-md-4">--}}
{{--                                <input type="file" name="document" id="document" class="form-control"--}}
{{--                                       placeholder="Document ...">--}}
{{--                            </div>--}}
{{--                            <div class="control-label col-md-2">--}}
{{--                                <label for="driver_types">Driver ID</label>--}}
{{--                            </div>--}}
{{--                            <div class="control-label col-md-4">--}}
{{--                                <input type="file" name="vehicle_id_no" id="vehicle_id_no" class="form-control"--}}
{{--                                       placeholder="Driver ID ...">--}}
{{--                            </div>--}}
{{--                        </div>--}}

{{--                    </div>--}}

{{--                    <div class="form-body">--}}

{{--                        <div class="form-actions">--}}
{{--                            <div class="row">--}}
{{--                                <div class="col-md-12 text-center">--}}
{{--                                    <button type="submit" class="btn btn-circle green btn-md save"><i--}}
{{--                                                class="fa fa-check"></i>--}}
{{--                                        Save--}}
{{--                                    </button>--}}
{{--                                    <button type="button" class="btn btn-circle btn-md red"--}}
{{--                                            data-dismiss="modal">--}}
{{--                                        <i class="fa fa-times"></i>--}}
{{--                                        Close--}}
{{--                                    </button>--}}
{{--                                </div>--}}
{{--                            </div>--}}
{{--                        </div>--}}
{{--                    </div>--}}

{{--                    {!! Form::close() !!}--}}

{{--                </div>--}}
{{--            </div>--}}

{{--        </div>--}}
{{--        <!-- /.modal-content -->--}}
{{--    </div>--}}
{{--    <!-- /.modal-dialog -->--}}
{{--</div>--}}

<div class="modal fade bs-modal-lg" id="userDet" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
                <h4 class="modal-title">User location <span class="badge badge-primary name "
                                                            style="text-transform: inherit"></span></h4>
            </div>
            <div class="modal-body">

                <div class="row">
                    <div class="col-md-12">
                        <!-- BEGIN MARKERS PORTLET-->
                        <div class="portlet light portlet-fit ">
                            <div class="portlet-title">
                                <div class="caption">
                                    <i class=" icon-layers font-blue"></i>
                                    <span class="caption-subject font-blue bold uppercase">{{$sub_title ?? 'map'}}</span>
                                </div>

                            </div>
                            <div class="portlet-body">
                                <div id="map" style="width:100%;height:400px;"></div>
                            </div>
                        </div>
                        <!-- END MARKERS PORTLET-->
                    </div>
                </div>
                <div class="form-body">

                    <div class="form-actions">
                        <div class="row">
                            <div class="col-md-12 text-center">
                                {{--<button type="submit" class="btn btn-circle green btn-md save"><i--}}
                                {{--class="fa fa-check"></i>--}}
                                {{--Save--}}
                                {{--</button>--}}
                                <button type="button" class="btn btn-circle btn-md red"
                                        data-dismiss="modal">
                                    <i class="fa fa-times"></i>
                                    Close
                                </button>
                            </div>
                        </div>
                    </div>
                </div>

            </div>

        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>

@endsection

@section('js')
    <!-- BEGIN PAGE LEVEL PLUGINS -->
    <script src="{{url('/')}}/assets/global/scripts/datatable.js" type="text/javascript"></script>
    <script src="{{url('/')}}/assets/global/plugins/datatables/datatables.min.js" type="text/javascript"></script>
    <script src="{{url('/')}}/assets/global/plugins/datatables/plugins/bootstrap/datatables.bootstrap.js"
            type="text/javascript"></script>


    <script src="{{url('/')}}/assets/global/plugins/bootstrap-datepicker/js/bootstrap-datepicker.min.js"
            type="text/javascript"></script>
    <!-- END PAGE LEVEL PLUGINS -->
    <script src="{{url('/')}}/assets/global/plugins/select2/js/select2.full.min.js" type="text/javascript"></script>

    <script src="{{url('/')}}/assets/global/plugins/jquery-ui/jquery-ui.min.js" type="text/javascript"></script>

    <!-- BEGIN THEME GLOBAL SCRIPTS -->
    <script src="{{url('/')}}/assets/global/scripts/app.min.js" type="text/javascript"></script>
    <!-- END THEME GLOBAL SCRIPTS -->
    <!-- BEGIN PAGE LEVEL SCRIPTS -->
    <script src="{{url('/')}}/assets/pages/scripts/table-datatables-managed.min.js" type="text/javascript"></script>
    <!-- END PAGE LEVEL SCRIPTS -->
    <script src="{{url('/')}}/assets/pages/scripts/table-datatables-responsive.min.js" type="text/javascript"></script>

    <script src="{{url('/')}}/assets/js/users.js" type="text/javascript"></script>
   <script type="text/javascript"
            src="https://maps.googleapis.com/maps/api/js?key={{google_api_key()}}"></script>
    <script>

        function myMap(address, lat, long) {

            var myLatLng = {lat: Number(lat), lng: Number(long)};


            var map = new google.maps.Map(document.getElementById("map"), {
                zoom: 4,
                center: myLatLng,

                gestureHandling: 'cooperative'
            });

            map.setOptions({scrollwheel: false});


            var marker = new google.maps.Marker({
                position: myLatLng,
                map: map,
                title: address
            });
        }
    </script>

    <script>

        $('.select2').select2({
            placeholder: "Select...",
            allowClear: true
        });
        $(".date-picker").datepicker({
            rtl: App.isRTL(),
            dateFormat: "mm/dd/yy",
            showOtherMonths: true,
            selectOtherMonths: true,
            autoclose: true,
            changeMonth: true,
            changeYear: true,
            orientation: "below"
        });
    </script>
@stop
