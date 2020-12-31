@extends(merchant_layout_vw().'.index')

@section('css')
<link href="{{url('/')}}/assets/global/plugins/select2/css/select2.min.css" rel="stylesheet" type="text/css" />
<link href="{{url('/')}}/assets/global/plugins/select2/css/select2-bootstrap.min.css" rel="stylesheet" type="text/css" />
<style>
    .form .form-section,
    .portlet-form .form-section {
        margin: 0 !important;
        padding: 0 !important;
    }
</style>
@endsection
@section('content')


<div class="card card-custom">

    <div class="card-header">

        <div class="card-title">
            <h3 class="card-label">{{trans(lang_app_site().'.CP.My Drivers')}}
        </div>

        <div class="card-toolbar">
            <a href="{{url('merchant/user-driver/create')}}" class="btn btn-circle btn-primary add-driver-mdl">
                <i class="fa fa-user-plus"></i>
                <span class="hidden-xs"> {{trans(lang_app_site().'.CP.New Driver')}} </span>
            </a>


        </div>
    </div>
    <div class="card-body">
        <div class="portlet light">
            <div class="portlet-title">
                <div class="caption font-dark">
                    <i class="fa fa-search font-dark"></i>
                    <span class="caption-subject bold uppercase"> {{trans(lang_app_site().'.CP.Filter')}} </span>
                </div>

            </div>
            <div class="portlet-body">
                <div class="table-container">
                    {!! Form::open(['method'=>'POST','url'=>url(admin_manage_url().'/admin/export')]) !!}

                    <table class="table table-striped table-bordered table-hover table-checkable" id="datatable_products">
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
                                <th width="10%"> {{trans(lang_app_site().'.CP.Username')}}</th>
                                <th width="10%"> {{trans(lang_app_site().'.CP.Email')}}</th>
                                <th width="10%"> {{trans(lang_app_site().'.CP.Mobile')}}</th>
                                {{-- <th width="10%"> {{trans(lang_app_site().'.CP.Type')}}</th>--}}
                                <th width="10%"> {{trans(lang_app_site().'.CP.Status')}}</th>
                                <th width="10%"> {{trans(lang_app_site().'.CP.Action')}}</th>
                            </tr>
                            <tr role="row" class="filter">
                                <td></td>
                                <td>
                                    <input type="text" class="form-control form-filter input-md" name="username" placeholder="{{trans(lang_app_site().'.CP.Username')}}" id="username">

                                </td>
                                <td>
                                    <input type="email" class="form-control form-filter input-md" name="email" placeholder="{{trans(lang_app_site().'.CP.Email')}}" id="email">
                                </td>
                                <td>
                                    <input type="text" class="form-control form-filter input-md" name="mobile" placeholder="{{trans(lang_app_site().'.CP.Mobile')}}" id="mobile">
                                </td>
                                {{-- <td>--}}
                                {{-- <select class="form-control input-md type" name="type" id="type"--}}
                                {{-- data-placeholder="Choose Type">--}}
                                {{-- <option value="">Choose type</option>--}}
                                {{-- <option value="client">Client</option>--}}
                                {{-- <option value="driver">Driver</option>--}}
                                {{-- </select>--}}
                                {{-- </td>--}}
                                <td>
                                    <select class="form-control input-md status" name="is_active" id="is_active" data-placeholder="{{trans(lang_app_site().'.CP.Choose Status')}}">
                                        <option value="">{{trans(lang_app_site().'.CP.Choose Status')}}</option>
                                        <option value="0">{{trans(lang_app_site().'.CP.Disable')}}</option>
                                        <option value="1">{{trans(lang_app_site().'.CP.Active')}}</option>
                                    </select>
                                </td>
                                <td>
                                    <div class="margin-bottom-5">
                                        <a href="javascript:;" class="btn btn-sm btn-success btn-circle btn-icon-only filter-submit-driver margin-bottom" title="Search">
                                            <i class="fa fa-search"></i>
                                        </a>

                                        <a href="javascript:;" class="btn btn-sm btn-danger btn-circle btn-icon-only filter-cancel-driver" title="Empty">
                                            <i class="fa fa-redo"></i>
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

        <table class="table table-striped table-bordered table-hover table-checkable order-column" id="drivers_merchant_tbl">
            <thead>
                <tr>
                    <th>#</th>
                    <th> {{trans(lang_app_site().'.CP.Logo')}}</th>
                    <th> {{trans(lang_app_site().'.CP.Username')}}</th>
                    <th> {{trans(lang_app_site().'.CP.Email')}}</th>
                    <th> {{trans(lang_app_site().'.CP.Address')}}</th>
                    <th> {{trans(lang_app_site().'.CP.Mobile')}}</th>
                    <th> {{trans(lang_app_site().'.CP.Driver Type')}}</th>
                    <th> {{trans(lang_app_site().'.CP.Vehicle Type')}}</th>
                    <th> {{trans(lang_app_site().'.CP.Vehicle Color')}}</th>
                    <th> {{trans(lang_app_site().'.CP.Vehicle Number')}}</th>
                    <th> {{trans(lang_app_site().'.CP.Status')}}</th>
                    <th> {{trans(lang_app_site().'.CP.Action')}}</th>
                </tr>
            </thead>
        </table>

    </div>
</div>

<div class="modal fade bs-modal-lg" id="userDet" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
                <h4 class="modal-title">User location <span class="badge badge-primary name " style="text-transform: inherit"></span></h4>
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
                                <button type="button" class="btn btn-circle btn-md red" data-dismiss="modal">
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
<script src="{{url('/')}}/assets/global/plugins/datatables/plugins/bootstrap/datatables.bootstrap.js" type="text/javascript"></script>


<script src="{{url('/')}}/assets/global/plugins/bootstrap-datepicker/js/bootstrap-datepicker.min.js" type="text/javascript"></script>
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
<script type="text/javascript" src="https://maps.googleapis.com/maps/api/js?key={{google_api_key()}}"></script>
<script>
    function myMap(address, lat, long) {

        var myLatLng = {
            lat: Number(lat),
            lng: Number(long)
        };


        var map = new google.maps.Map(document.getElementById("map"), {
            zoom: 4,
            center: myLatLng,

            gestureHandling: 'cooperative'
        });

        map.setOptions({
            scrollwheel: false
        });


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