@extends(admin_layout_vw().'.index')

@section('css')
<!-- BEGIN PAGE LEVEL PLUGINS -->

<!-- END THEME GLOBAL STYLES -->
@endsection
@section('content')

<div class="row">

    <div class="col-md-12">
        <!-- BEGIN EXAMPLE TABLE PORTLET-->
        <div class="card card-custom mb-5">
            <div class="card-header">
                <div class="card-title">
                    <i class="fa fa-search font-dark"></i>
                    &nbsp;
                    <span class="caption-subject bold uppercase"> {{trans(lang_app_site().'.CP.Filter')}} </span>
                </div>

            </div>
            <div class="card-body">
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

                                <th width="10%"> {{trans(lang_app_site().'.CP.Name')}}</th>
                                <th width="10%"> {{trans(lang_app_site().'.CP.Username')}}</th>
                                <th width="10%"> {{trans(lang_app_site().'.CP.Email')}}</th>
                                <th width="10%"> {{trans(lang_app_site().'.CP.Phone Number')}}</th>
                                <th width="10%"> {{trans(lang_app_site().'.CP.Status')}}</th>
                                <th width="10%"> {{trans(lang_app_site().'.CP.Action')}}</th>
                            </tr>
                            <tr role="row" class="filter">
                                <td></td>
                                <td>
                                    <input type="text" class="form-control form-filter input-md" name="name" placeholder="{{trans(lang_app_site().'.CP.Name')}}" id="name">

                                </td>
                                <td>
                                    <input type="text" class="form-control form-filter input-md" name="username" placeholder="{{trans(lang_app_site().'.CP.Username')}}" id="username">

                                </td>
                                <td>
                                    <input type="email" class="form-control form-filter input-md" name="email" placeholder="{{trans(lang_app_site().'.CP.Email')}}" id="email">
                                </td>
                                <td>
                                    <input type="text" class="form-control form-filter input-md" name="mobile" placeholder="{{trans(lang_app_site().'.CP.Phone Number')}}" id="mobile">
                                </td>
                                <td>
                                    <select class="form-control input-md level select2" name="status" id="status" data-placeholder="Choose Status">
                                        <option value="">{{trans(lang_app_site().'.CP.Status')}}</option>
                                        <option value="0">Disable</option>
                                        <option value="1">Active</option>
                                    </select>
                                </td>
                                <td>
                                    <div class="margin-bottom-5">
                                        <a href="javascript:;" class="btn btn-sm btn-success btn-circle btn-icon-only filter-submit margin-bottom" title="Search">
                                            <i class="fa fa-search"></i>
                                        </a>

                                        <a href="javascript:;" class="btn btn-sm btn-danger btn-circle btn-icon-only filter-cancel" title="Empty">
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
        <div class="card card-custom">
            <div class="card-header">
                <div class="card-title">
                    <i class="{{$icon}} font-dark"></i>
                    <span class="caption-subject bold uppercase"> {{trans(lang_app_site().'.CP.'.$sub_title)}}</span>
                </div>
                <div class="card-toolbar">
                    <a href="{{url(admin_vw().'/admin/create')}}" class="btn btn-circle btn-primary add-admin-mdl">
                        <i class="fa fa-plus"></i>
                        <span class="hidden-xs"> {{trans(lang_app_site().'.CP.Add New')}} </span>
                    </a>
                </div>

            </div>


            <div class="card-body">

                <table class="table table-striped table-hover table-checkable order-column" id="admins_tbl">
                    <thead>
                        <tr>
                            <th>#</th>
                            {{-- <th> {{trans(lang_app_site().'.CP.Logo')}}</th>--}}
                            <th> {{trans(lang_app_site().'.CP.Name')}}</th>
                            <th> {{trans(lang_app_site().'.CP.Username')}}</th>
                            <th> {{trans(lang_app_site().'.CP.Email')}}</th>
                            <th> {{trans(lang_app_site().'.CP.Phone')}}</th>
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

@endsection

@section('js')

<!-- BEGIN PAGE LEVEL PLUGINS -->
<script src="{{url('/')}}/assets/global/scripts/datatable.js" type="text/javascript"></script>
<script src="{{url('/')}}/assets/global/plugins/datatables/datatables.min.js" type="text/javascript"></script>
<script src="{{url('/')}}/assets/global/plugins/datatables/plugins/bootstrap/datatables.bootstrap.js" type="text/javascript"></script>
<!-- END PAGE LEVEL PLUGINS -->

<!-- BEGIN THEME GLOBAL SCRIPTS -->
<script src="{{url('/')}}/assets/global/scripts/app.min.js" type="text/javascript"></script>
<!-- END THEME GLOBAL SCRIPTS -->
<!-- BEGIN PAGE LEVEL SCRIPTS -->
<script src="{{url('/')}}/assets/pages/scripts/table-datatables-managed.min.js" type="text/javascript"></script>
<!-- END PAGE LEVEL SCRIPTS -->
<script src="{{url('/')}}/assets/js/admins.js" type="text/javascript"></script>

@stop