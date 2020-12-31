@extends(admin_layout_vw().'.index')

@section('css')
<!-- BEGIN THEME GLOBAL STYLES -->

<!-- END THEME GLOBAL STYLES -->

@endsection
@section('content')
<div class="row">
    <div class="col-md-12">
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
                    {!! Form::open(['method'=>'POST','url'=>url(admin_role_url().'/export')]) !!}

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
                                <th width="10%"> {{trans(lang_app_site().'.CP.Display Name')}}</th>
                                <th width="10%"> {{trans(lang_app_site().'.CP.Action')}}</th>
                            </tr>
                            <tr role="row" class="filter">
                                <td></td>
                                <td>
                                    <input type="text" class="form-control form-filter input-md" name="name" placeholder="{{trans(lang_app_site().'.CP.Name')}}" id="name">

                                </td>
                                <td>
                                    <input type="text" class="form-control form-filter input-md" name="display_name" placeholder="{{trans(lang_app_site().'.CP.Display Name')}}" id="display_name">
                                </td>

                                <td>
                                    <div class="margin-bottom-5">
                                        <a href="javascript:;" class="btn btn-sm btn-success btn-circle btn-icon-only filter-submit margin-bottom" title="Search">
                                            <i class="fa fa-search"></i>
                                        </a>

                                        <a href="javascript:;" class="btn btn-sm btn-danger btn-circle btn-icon-only filter-cancel" title="Empty">
                                            <i class="fa fa-rotate-left"></i>
                                        </a>
                                        {{-- <button type="submit"--}}
                                        {{-- class="btn btn-sm btn-default btn-circle btn-icon-only filter-export margin-bottom" title="Export">--}}
                                        {{-- <i class="fa fa-file-excel-o"></i>--}}
                                        {{-- </button>--}}
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
        <!-- BEGIN EXAMPLE TABLE PORTLET-->
        <div class="card card-custom">
            <div class="card-header">
                <div class="card-title">
                    <i class="icon-settings font-dark"></i>
                    <span class="caption-subject bold uppercase"> {{trans(lang_app_site().'.CP.'.$title)}}</span>
                </div>
                <div class="card-toolbar">
                    <a href="{{url(admin_role_url().'/add-role')}}" class="btn btn-circle btn-primary add-role-mdl">
                        <i class="fa fa-plus"></i>
                        <span class="hidden-xs"> {{trans(lang_app_site().'.CP.Add New')}} </span>
                    </a>

                </div>
            </div>
            <div class="card-body">

                <table class="table table-striped table-hover table-checkable order-column" id="roles_tbl">
                    <thead>
                        <tr>
                            <th> #</th>
                            <th> {{trans(lang_app_site().'.CP.Name')}}</th>
                            <th> {{trans(lang_app_site().'.CP.Display Name')}}</th>
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
<script src="{{url('/')}}/assets/js/role.js" type="text/javascript"></script>
<!-- END PAGE LEVEL SCRIPTS -->

@stop