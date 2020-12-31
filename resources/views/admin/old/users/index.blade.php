@extends(admin_layout_vw().'.index')

@section('css')
<!-- BEGIN PAGE LEVEL PLUGINS -->
<link href="{{url('/')}}/assets/global/plugins/datatables/datatables.min.css" rel="stylesheet" type="text/css" />
<link href="{{url('/')}}/assets/global/plugins/datatables/plugins/bootstrap/datatables.bootstrap.css" rel="stylesheet" type="text/css" />
<!-- END PAGE LEVEL PLUGINS -->
<!-- BEGIN THEME GLOBAL STYLES -->
<link href="{{url('/')}}/assets/global/css/components-md.min.css" rel="stylesheet" id="style_components" type="text/css" />
<link href="{{url('/')}}/assets/global/css/plugins-md.min.css" rel="stylesheet" type="text/css" />
<!-- END THEME GLOBAL STYLES -->
<style>
    .form .form-section,
    .portlet-form .form-section {
        margin: 0 !important;
        padding: 0 !important;
    }
</style>
@endsection
@section('content')

<div class="portlet light ">
    <div class="portlet-title">
        <div class="caption font-dark">
            <i class="{{$icon}} font-dark"></i>
            <span class="caption-subject bold uppercase"> {{trans(lang_app_site().'.CP.'.$main_title)}}</span>
        </div>

    </div>


    <div class="portlet-body">
        <div class="row">
            <div class="col-md-12">
                <div class="portlet light ">
                    <div class="portlet-body">
                        <ul class="nav nav-tabs">

                            <li class="active">
                                <a href="#customers" data-toggle="tab"> {{trans(lang_app_site().'.CP.Clients')}} </a>
                            </li>
                            <li>
                                <a href="#merchants" data-toggle="tab"> {{trans(lang_app_site().'.CP.Merchants')}} </a>
                            </li>
                            <li>
                                <a href="#drivers" data-toggle="tab"> {{trans(lang_app_site().'.CP.Drivers')}} </a>
                            </li>
                            <li>
                                <a href="#service_providers" data-toggle="tab"> {{trans(lang_app_site().'.CP.Service providers')}} </a>
                            </li>


                        </ul>
                        <div class="tab-content">

                            <div class="tab-pane fade  active in " id="customers">

                                <div class="portlet-body form">
                                    <div class="row">

                                        <div class="col-md-12">
                                            <!-- BEGIN EXAMPLE TABLE PORTLET-->
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
                                                                    <th width="10%"> {{trans(lang_app_site().'.CP.Phone')}}</th>
                                                                    {{-- <th width="10%"> Type</th>--}}
                                                                    <th width="10%"> {{trans(lang_app_site().'.CP.Status')}}</th>
                                                                    <th width="10%"> {{trans(lang_app_site().'.CP.Action')}}</th>
                                                                </tr>
                                                                <tr role="row" class="filter">
                                                                    <td></td>
                                                                    <td>
                                                                        <input type="text" class="form-control form-filter input-md" name="username" placeholder="{{trans(lang_app_site().'.CP.Username')}}" id="username_c">

                                                                    </td>
                                                                    <td>
                                                                        <input type="email" class="form-control form-filter input-md" name="email" placeholder="{{trans(lang_app_site().'.CP.Email')}}" id="email_c">
                                                                    </td>
                                                                    <td>
                                                                        <input type="text" class="form-control form-filter input-md" name="mobile" placeholder="{{trans(lang_app_site().'.CP.Phone')}}" id="mobile_c">
                                                                    </td>
                                                                    {{-- <td>--}}
                                                                    {{-- <select class="form-control input-md type select2"--}}
                                                                    {{-- name="type" id="type"--}}
                                                                    {{-- data-placeholder="Choose Type">--}}
                                                                    {{-- <option value="">{{trans(lang_app_site().'.CP.Choose type')}}</option>--}}
                                                                    {{-- <option value="client">Client</option>--}}
                                                                    {{-- <option value="driver">Driver</option>--}}
                                                                    {{-- </select>--}}
                                                                    {{-- </td>--}}
                                                                    <td>
                                                                        <select class="form-control input-md select2" name="is_active" id="is_active_c" data-placeholder="Choose Status">
                                                                            <option value="">{{trans(lang_app_site().'.CP.Choose Status')}}</option>
                                                                            <option value="0">{{trans(lang_app_site().'.CP.Disable')}}</option>
                                                                            <option value="1">{{trans(lang_app_site().'.CP.Active')}}</option>
                                                                        </select>
                                                                    </td>
                                                                    <td>
                                                                        <div class="margin-bottom-5">
                                                                            <a href="javascript:;" class="btn btn-sm btn-success btn-circle btn-icon-only filter-submit-u margin-bottom" title="Search">
                                                                                <i class="fa fa-search"></i>
                                                                            </a>

                                                                            <a href="javascript:;" class="btn btn-sm btn-danger btn-circle btn-icon-only filter-cancel-u" title="Empty">
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
                                                        <span class="caption-subject bold uppercase"> {{trans(lang_app_site().'.CP.Clients')}}</span>
                                                    </div>
                                                    {{-- <div class="actions">--}}
                                                    {{-- <a href="{{url('admin/user-driver/create')}}"--}}
                                                    {{-- class="btn btn-circle btn-info add-driver-mdl">--}}
                                                    {{-- <i class="fa fa-user-plus"></i>--}}
                                                    {{-- <span class="hidden-xs"> Add New Driver </span>--}}
                                                    {{-- </a>--}}
                                                    {{-- </div>--}}

                                                </div>


                                                <div class="portlet-body">
                                                    {{-- `username`, `email`, `email_verified_at`, `password`, `mobile`, `verification_code`, `is_confirm`, `address`, `latitude`, `longitude`, `image`, `type`, `is_active`--}}

                                                    <table class="table table-striped table-bordered table-hover table-checkable order-column" id="users_tbl">
                                                        <thead>
                                                            <tr>
                                                                <th>#</th>
                                                                {{-- <th> Logo</th>--}}
                                                                <th> {{trans(lang_app_site().'.CP.Username')}}</th>
                                                                <th> {{trans(lang_app_site().'.CP.Email')}}</th>
                                                                {{-- <th> Email Verify</th>--}}
                                                                <th> {{trans(lang_app_site().'.CP.Phone')}}</th>
                                                                {{-- <th> Mobile Confirm</th>--}}
                                                                {{-- <th> Type</th>--}}
                                                                <th> {{trans(lang_app_site().'.CP.Address')}}</th>
                                                                <th> {{trans(lang_app_site().'.CP.Status')}}</th>
                                                                <th> {{trans(lang_app_site().'.CP.Action')}}</th>
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

                            <div class="tab-pane fade " id="merchants">

                                <div class="portlet-body form">
                                    <div class="row">

                                        <div class="col-md-12">
                                            <!-- BEGIN EXAMPLE TABLE PORTLET-->
                                            <div class="portlet light">
                                                <div class="portlet-title">
                                                    <div class="caption font-dark">
                                                        <i class="fa fa-search font-dark"></i>
                                                        <span class="caption-subject bold uppercase"> {{trans(lang_app_site().'.CP.Filter')}} </span>
                                                    </div>

                                                </div>
                                                <div class="portlet-body">
                                                    <div class="table-container">
                                                        {!! Form::open(['method'=>'POST','url'=>url('/admin/export')]) !!}

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
                                                                    <th width="10%"> {{trans(lang_app_site().'.CP.Phone')}}</th>
                                                                    <th width="10%"> {{trans(lang_app_site().'.CP.Status')}}</th>
                                                                    <th width="10%"> {{trans(lang_app_site().'.CP.Action')}}</th>
                                                                </tr>
                                                                <tr role="row" class="filter">
                                                                    <td></td>
                                                                    <td>
                                                                        <input type="text" class="form-control form-filter input-md" name="username" placeholder="{{trans(lang_app_site().'.CP.Username')}}" id="username_m">

                                                                    </td>
                                                                    <td>
                                                                        <input type="email" class="form-control form-filter input-md" name="email" placeholder="{{trans(lang_app_site().'.CP.Email')}}" id="email_m">
                                                                    </td>
                                                                    <td>
                                                                        <input type="text" class="form-control form-filter input-md" name="mobile" placeholder="{{trans(lang_app_site().'.CP.Phone')}}" id="mobile_m">
                                                                    </td>

                                                                    <td>
                                                                        <select class="form-control input-md select2" name="is_active" id="is_active_m" data-placeholder="Choose Status">
                                                                            <option value="">{{trans(lang_app_site().'.CP.Choose Status')}}</option>
                                                                            <option value="0">{{trans(lang_app_site().'.CP.Disable')}}</option>
                                                                            <option value="1">{{trans(lang_app_site().'.CP.Active')}}</option>
                                                                        </select>
                                                                    </td>
                                                                    <td>
                                                                        <div class="margin-bottom-5">
                                                                            <a href="javascript:;" class="btn btn-sm btn-success btn-circle btn-icon-only filter-submit-m margin-bottom" title="Search">
                                                                                <i class="fa fa-search"></i>
                                                                            </a>

                                                                            <a href="javascript:;" class="btn btn-sm btn-danger btn-circle btn-icon-only filter-cancel-m" title="Empty">
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
                                                        <span class="caption-subject bold uppercase"> {{trans(lang_app_site().'.CP.Merchants')}}</span>
                                                    </div>
                                                    <div class="actions">
                                                        <a href="{{url('admin/merchant-create')}}" class="btn btn-circle btn-info add-merchant-mdl">
                                                            <i class="fa fa-user-plus"></i>
                                                            <span class="hidden-xs"> {{trans(lang_app_site().'.CP.Add New Merchant')}} </span>
                                                        </a>
                                                    </div>

                                                </div>


                                                <div class="portlet-body">
                                                    {{-- `username`, `email`, `email_verified_at`, `password`, `mobile`, `verification_code`, `is_confirm`, `address`, `latitude`, `longitude`, `image`, `type`, `is_active`--}}

                                                    <table class="table table-striped table-bordered table-hover table-checkable order-column" id="merchants_tbl">
                                                        <thead>
                                                            <tr>
                                                                <th>#</th>
                                                                <th> {{trans(lang_app_site().'.CP.Logo')}}</th>
                                                                <th> {{trans(lang_app_site().'.CP.Username')}}</th>
                                                                <th> {{trans(lang_app_site().'.CP.Email')}}</th>
                                                                {{-- <th> Email Verify</th>--}}
                                                                <th> {{trans(lang_app_site().'.CP.Phone')}}</th>
                                                                {{-- <th> Mobile Confirm</th>--}}
                                                                {{-- <th> Type</th>--}}
                                                                <th> {{trans(lang_app_site().'.CP.City')}}</th>
                                                                <th> {{trans(lang_app_site().'.CP.Address')}}</th>
                                                                <th> {{trans(lang_app_site().'.CP.Status')}}</th>
                                                                <th> {{trans(lang_app_site().'.CP.Action')}}</th>
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
                            <div class="tab-pane fade " id="drivers">

                                <div class="portlet-body form">
                                    <div class="row">

                                        <div class="col-md-12">
                                            <!-- BEGIN EXAMPLE TABLE PORTLET-->
                                            <div class="portlet light">
                                                <div class="portlet-title">
                                                    <div class="caption font-dark">
                                                        <i class="fa fa-search font-dark"></i>
                                                        <span class="caption-subject bold uppercase"> {{trans(lang_app_site().'.CP.Filter')}} </span>
                                                    </div>

                                                </div>
                                                <div class="portlet-body">
                                                    <div class="table-container">
                                                        {!! Form::open(['method'=>'POST','url'=>url('/admin/export')]) !!}

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
                                                                    <th width="10%"> {{trans(lang_app_site().'.CP.Phone')}}</th>
                                                                    <th width="10%"> {{trans(lang_app_site().'.CP.Delivery method')}}</th>
                                                                    <th width="10%"> {{trans(lang_app_site().'.CP.Status')}}</th>
                                                                    <th width="10%"> {{trans(lang_app_site().'.CP.Action')}}</th>
                                                                </tr>
                                                                <tr role="row" class="filter">
                                                                    <td></td>
                                                                    <td>
                                                                        <input type="text" class="form-control form-filter input-md" name="username" placeholder="{{trans(lang_app_site().'.CP.Username')}}" id="username_d">

                                                                    </td>
                                                                    <td>
                                                                        <input type="email" class="form-control form-filter input-md" name="email" placeholder="{{trans(lang_app_site().'.CP.Email')}}" id="email_d">
                                                                    </td>
                                                                    <td>
                                                                        <input type="text" class="form-control form-filter input-md" name="mobile" placeholder="{{trans(lang_app_site().'.CP.Phone')}}" id="mobile_d">
                                                                    </td>
                                                                    <td>
                                                                        <select class="form-control input-md status select2" name="driver_types" id="driver_types_d" data-placeholder="Choose Delivery method">
                                                                            <option value="">{{trans(lang_app_site().'.CP.Choose delivery method')}}</option>
                                                                            @foreach($driver_types as $type)
                                                                            <option value="{{$type->id}}">{{trans(lang_app_site().'.CP.'.$type->name)}}</option>
                                                                            @endforeach
                                                                        </select>
                                                                    </td>
                                                                    <td>
                                                                        <select class="form-control input-md select2" name="is_active" id="is_active_d" data-placeholder="Choose Status">
                                                                            <option value="">{{trans(lang_app_site().'.CP.Choose Status')}}</option>
                                                                            <option value="0">{{trans(lang_app_site().'.CP.Disable')}}</option>
                                                                            <option value="1">{{trans(lang_app_site().'.CP.Active')}}</option>
                                                                        </select>
                                                                    </td>
                                                                    <td>
                                                                        <div class="margin-bottom-5">
                                                                            <a href="javascript:;" class="btn btn-sm btn-success btn-circle btn-icon-only filter-submit-d margin-bottom" title="Search">
                                                                                <i class="fa fa-search"></i>
                                                                            </a>

                                                                            <a href="javascript:;" class="btn btn-sm btn-danger btn-circle btn-icon-only filter-cancel-d" title="Empty">
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
                                                        <span class="caption-subject bold uppercase"> {{trans(lang_app_site().'.CP.Drivers')}}</span>
                                                    </div>
                                                    <div class="actions">
                                                        <a href="{{url('admin/users/user-driver/create')}}" class="btn btn-circle btn-info add-driver-mdl">
                                                            <i class="fa fa-user-plus"></i>
                                                            <span class="hidden-xs"> {{trans(lang_app_site().'.CP.Add New Driver')}} </span>
                                                        </a>
                                                    </div>

                                                </div>


                                                <div class="portlet-body">
                                                    {{-- `username`, `email`, `email_verified_at`, `password`, `mobile`, `verification_code`, `is_confirm`, `address`, `latitude`, `longitude`, `image`, `type`, `is_active`--}}

                                                    <table class="table table-striped table-bordered table-hover table-checkable order-column" id="drivers_tbl">
                                                        <thead>
                                                            <tr>
                                                                <th>#</th>
                                                                <th> {{trans(lang_app_site().'.CP.Personal Picture')}}</th>
                                                                <th> {{trans(lang_app_site().'.CP.Username')}}</th>
                                                                <th> {{trans(lang_app_site().'.CP.Email')}}</th>
                                                                <th> {{trans(lang_app_site().'.CP.Address')}}</th>
                                                                <th> {{trans(lang_app_site().'.CP.Phone')}}</th>
                                                                <th> {{trans(lang_app_site().'.CP.Delivery Method')}}</th>
                                                                <th> {{trans(lang_app_site().'.CP.Vehicle Type')}}</th>
                                                                <th> {{trans(lang_app_site().'.CP.Vehicle Color')}}</th>
                                                                <th> {{trans(lang_app_site().'.CP.Vehicle Number')}}</th>
                                                                <th> {{trans(lang_app_site().'.CP.Status')}}</th>
                                                                <th> {{trans(lang_app_site().'.CP.Action')}}/th>
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
                            <div class="tab-pane fade " id="service_providers">

                                <div class="portlet-body form">
                                    <div class="row">

                                        <div class="col-md-12">
                                            <!-- BEGIN EXAMPLE TABLE PORTLET-->
                                            <div class="portlet light">
                                                <div class="portlet-title">
                                                    <div class="caption font-dark">
                                                        <i class="fa fa-search font-dark"></i>
                                                        <span class="caption-subject bold uppercase"> {{trans(lang_app_site().'.CP.Filter')}} </span>
                                                    </div>

                                                </div>
                                                <div class="portlet-body">
                                                    <div class="table-container">
                                                        {!! Form::open(['method'=>'POST','url'=>url('/admin/export')]) !!}

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
                                                                    <th width="10%"> {{trans(lang_app_site().'.CP.Phone')}}</th>
                                                                    <th width="10%"> {{trans(lang_app_site().'.CP.Status')}}</th>
                                                                    <th width="10%"> {{trans(lang_app_site().'.CP.Action')}}</th>
                                                                </tr>
                                                                <tr role="row" class="filter">
                                                                    <td></td>
                                                                    <td>
                                                                        <input type="text" class="form-control form-filter input-md" name="username" placeholder="{{trans(lang_app_site().'.CP.Username')}}" id="username_s">

                                                                    </td>
                                                                    <td>
                                                                        <input type="email" class="form-control form-filter input-md" name="email" placeholder="{{trans(lang_app_site().'.CP.Email')}}" id="email_s">
                                                                    </td>
                                                                    <td>
                                                                        <input type="text" class="form-control form-filter input-md" name="mobile" placeholder="{{trans(lang_app_site().'.CP.Phone')}}" id="mobile_s">
                                                                    </td>

                                                                    <td>
                                                                        <select class="form-control input-md select2" name="is_active" id="is_active_s" data-placeholder="Choose Status">
                                                                            <option value="">{{trans(lang_app_site().'.CP.Choose Status')}}</option>
                                                                            <option value="0">{{trans(lang_app_site().'.CP.Disable')}}</option>
                                                                            <option value="1">{{trans(lang_app_site().'.CP.Active')}}</option>
                                                                        </select>
                                                                    </td>
                                                                    <td>
                                                                        <div class="margin-bottom-5">
                                                                            <a href="javascript:;" class="btn btn-sm btn-success btn-circle btn-icon-only filter-submit-s margin-bottom" title="Search">
                                                                                <i class="fa fa-search"></i>
                                                                            </a>

                                                                            <a href="javascript:;" class="btn btn-sm btn-danger btn-circle btn-icon-only filter-cancel-s" title="Empty">
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
                                                        <span class="caption-subject bold uppercase"> {{trans(lang_app_site().'.CP.Service Providers')}}</span>
                                                    </div>
                                                    <div class="actions">
                                                        <a href="{{url('admin/service-provider/create')}}" class="btn btn-circle btn-info add-service-provider-mdl">
                                                            <i class="fa fa-user-plus"></i>
                                                            <span class="hidden-xs"> {{trans(lang_app_site().'.CP.Add New Service Provider')}} </span>
                                                        </a>
                                                    </div>

                                                </div>


                                                <div class="portlet-body">
                                                    {{-- `username`, `email`, `email_verified_at`, `password`, `mobile`, `verification_code`, `is_confirm`, `address`, `latitude`, `longitude`, `image`, `type`, `is_active`--}}

                                                    <table class="table table-striped table-bordered table-hover table-checkable order-column" id="service_providers_tbl">
                                                        <thead>
                                                            <tr>
                                                                <th>#</th>
                                                                <th> {{trans(lang_app_site().'.CP.Logo')}}</th>
                                                                <th> {{trans(lang_app_site().'.CP.Username')}}</th>
                                                                <th> {{trans(lang_app_site().'.CP.Email')}}</th>
                                                                {{-- <th> Email Verify</th>--}}
                                                                <th> {{trans(lang_app_site().'.CP.Phone')}}</th>
                                                                {{-- <th> Mobile Confirm</th>--}}
                                                                <th> {{trans(lang_app_site().'.CP.City')}}</th>
                                                                <th> {{trans(lang_app_site().'.CP.Address')}}</th>
                                                                {{-- <th> Type</th>--}}
                                                                <th> {{trans(lang_app_site().'.CP.Status')}}</th>
                                                                <th> {{trans(lang_app_site().'.CP.Action')}}</th>
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

<!-- /.modal -->
@endsection

@section('js')

<!-- BEGIN PAGE LEVEL PLUGINS -->
<script src="{{url('/')}}/assets/global/scripts/datatable.js" type="text/javascript"></script>
<script src="{{url('/')}}/assets/global/plugins/datatables/datatables.min.js" type="text/javascript"></script>
<script src="{{url('/')}}/assets/global/plugins/datatables/plugins/bootstrap/datatables.bootstrap.js" type="text/javascript"></script>
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
<script type="text/javascript">

</script>
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



@stop