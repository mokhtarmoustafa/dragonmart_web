@extends('merchant.layout.index')

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
            <div class="portlet box grey-gallery ">
                <div class="portlet-title">
                    <div class="caption">
                        <i class="icon-settings"></i>
                        <span class="caption-subject bold uppercase"> {{ trans(lang_app_site().'.CP.'.$sub_title) }}</span>
                    </div>
                    <div class="actions">
                        <a href="{{url('merchant/category/create')}}" class="btn btn-circle btn-info add-category-mdl">
                            <i class="fa fa-plus"></i>
                            <span class="hidden-xs"> Add New Category </span>
                        </a>
                    </div>

                </div>
                <div class="portlet-body">

                    <table class="table table-striped table-bordered table-hover table-checkable order-column"
                           id="category_tbl">
                        <thead>
                        <tr>
                            <th>#</th>
                            <th> Icon</th>
                            <th> Name (English)</th>
                            <th> Name (Arabic)</th>
                            <th> Action</th>
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