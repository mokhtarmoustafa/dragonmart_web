@extends(admin_layout_vw().'.index')

@section('css')
    <!-- BEGIN PAGE LEVEL PLUGINS -->

    <!-- END THEME GLOBAL STYLES -->
@endsection
@section('content')
{{--    <div class="row">--}}
{{--        <div class="col-md-12">--}}
{{--            <div class="portlet box red">--}}
{{--                <div class="portlet-title">--}}
{{--                    <div class="caption">--}}
{{--                        <i class="icon-settings"></i> {{$label}}--}}
{{--                    </div>--}}
{{--                </div>--}}
{{--                <div class="portlet-body">--}}
{{--                    {!! Form::open(['method'=>'POST','url'=>url(admin_vw().'/constant/category'),'class'=>'form-inline','files'=>true,'id'=>'save_category_frm']) !!}--}}
{{--                    <div class="form-body">--}}
{{--                        <div class="form-group">--}}
{{--                            <label>Icon</label>--}}
{{--                            <div class="input-group">--}}
{{--                                <input type="file" class="form-control" placeholder="Icon" name="icon" id="icon">--}}
{{--                            </div>--}}
{{--                        </div>--}}
{{--                        <div class="form-group">--}}
{{--                            <label>Category name</label>--}}
{{--                            <div class="input-group">--}}
{{--                                <input type="text" class="form-control" placeholder="Category name" name="category_name"--}}
{{--                                       id="category_name"></div>--}}
{{--                        </div>--}}
{{--                        <button type="submit" class="btn blue"><i class="fa fa-check"></i> Save</button>--}}

{{--                    </div>--}}

{{--                    {!! Form::close() !!}--}}

{{--                </div>--}}
{{--            </div>--}}
{{--        </div>--}}
{{--    </div>--}}
    <input type="hidden" name="constant" id="constant" value="{{$constant_name}}">
    <input type="hidden" name="url_action" id="url_action" value="{{$url_action}}">
    <div class="row">
        <div class="col-md-12">
            <!-- BEGIN EXAMPLE TABLE PORTLET-->
            <div class="card card-custom shadow mb-5">
                <div class="card-header">
                    <div class="card-title">
                        <i class="icon-settings"></i>
                        &nbsp;
                        <span class="caption-subject bold uppercase">{{trans(lang_app_site().'.CP.Stores '.$sub_title)}}</span>
                    </div>
                    <div class="card-toolbar">
                        <a href="{{url('admin/category/create')}}" class="btn btn-circle btn-primary add-category-mdl">
                            <i class="fa fa-plus"></i>
                            <span class="hidden-xs"> {{trans(lang_app_site().'.CP.New Stroe Category')}} </span>
                        </a>
                    </div>

                </div>
                <div class="card-body">

                    <table class="table table-striped table-bordered table-hover table-checkable order-column"
                           id="category_tbl">
                        <thead>
                        <tr>
                            <th>#</th>
                            <th> {{trans(lang_app_site().'.CP.Icon')}}</th>
                            <th> {{trans(lang_app_site().'.CP.Name')}} (English)</th>
                            <th> {{trans(lang_app_site().'.CP.Name')}} (Arabic)</th>
                            <th> {{trans(lang_app_site().'.CP.Action')}}</th>
                        </tr>
                        </thead>
                    </table>
                </div>
            </div>
            <!-- END EXAMPLE TABLE PORTLET-->
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <!-- BEGIN EXAMPLE TABLE PORTLET-->
            <div class="card card-custom shadow">
                <div class="card-header">
                    <div class="card-title">
                        <i class="icon-settings"></i>
                        &nbsp;
                        <span class="caption-subject bold uppercase"> {{trans(lang_app_site().'.CP.Services '.$sub_title)}} </span>
                    </div>
                    <div class="card-toolbar">
                        <a href="{{url('admin/service-category/create')}}" class="btn btn-circle btn-primary add-category-mdl">
                            <i class="fa fa-plus"></i>
                            <span class="hidden-xs"> {{trans(lang_app_site().'.CP.New Service Category')}} </span>
                        </a>
                    </div>

                </div>
                <div class="card-body">

                    <table class="table table-striped table-bordered table-hover table-checkable order-column"
                           id="service-category_tbl">
                        <thead>
                        <tr>
                            <th>#</th>
                            <th> {{trans(lang_app_site().'.CP.Icon')}}</th>
                            <th> {{trans(lang_app_site().'.CP.Name')}} (English)</th>
                            <th> {{trans(lang_app_site().'.CP.Name')}} (Arabic)</th>
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
    <script src="{{url('/')}}/assets/global/plugins/datatables/plugins/bootstrap/datatables.bootstrap.js"
            type="text/javascript"></script>
    <!-- END PAGE LEVEL PLUGINS -->
    <!-- BEGIN THEME GLOBAL SCRIPTS -->
    <script src="{{url('/')}}/assets/global/scripts/app.min.js" type="text/javascript"></script>
    <!-- END THEME GLOBAL SCRIPTS -->
    <!-- BEGIN PAGE LEVEL SCRIPTS -->
    <script src="{{url('/')}}/assets/pages/scripts/table-datatables-managed.min.js" type="text/javascript"></script>
    <!-- END PAGE LEVEL SCRIPTS -->
    <script src="{{url('/')}}/assets/js/categories.js" type="text/javascript"></script>

@stop