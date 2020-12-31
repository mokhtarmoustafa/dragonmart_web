@extends(admin_layout_vw().'.index')

@section('css')

    <link href="{{url('/')}}/assets/global/plugins/bootstrap-daterangepicker/daterangepicker.min.css" rel="stylesheet"
          type="text/css"/>
    <link href="{{url('/')}}/assets/global/plugins/bootstrap-datepicker/css/bootstrap-datepicker3.min.css"
          rel="stylesheet" type="text/css"/>
    <link href="{{url('/')}}/assets/global/plugins/bootstrap-fileinput/bootstrap-fileinput.css" rel="stylesheet"
          type="text/css"/>

    <!-- BEGIN THEME GLOBAL STYLES -->
    <link href="{{url('/')}}/assets/global/css/components-md.min.css" rel="stylesheet" id="style_components"
          type="text/css"/>
    <link href="{{url('/')}}/assets/global/css/plugins-md.min.css" rel="stylesheet" type="text/css"/>
    <!-- END THEME GLOBAL STYLES -->
    <link href="{{url('/')}}/assets/global/plugins/select2/css/select2.min.css" rel="stylesheet" type="text/css"/>
    <link href="{{url('/')}}/assets/global/plugins/select2/css/select2-bootstrap.min.css" rel="stylesheet"
          type="text/css"/>
@endsection
@section('content')
    <div class="row">
        <div class="col-md-12 ">
            <!-- BEGIN SAMPLE FORM PORTLET-->
            <div class="portlet light ">
                <div class="portlet-title">
                    <div class="caption">
                        <i class="fa fa-plus font-dark sbold"></i> <span
                            class="caption-subject font-dark sbold uppercase">Edit About.</span>
                    </div>
                </div>
                <div class="portlet-body form">
                    {!! Form::open(['method'=>'PUT','class'=>'form-horizontal','id'=>'edit-post','files'=>true]) !!}
                    <div class="alert alert-danger" style="display: none"></div>

                    <div class="form-group last">
                        <label class="control-label col-md-2">Upload Image/Video</label>
                        <div class="col-md-9">
                            <div class="fileinput fileinput-new" data-provides="fileinput">
                                <div class="input-group input-large">
                                    <div class="form-control uneditable-input input-fixed input-medium"
                                         data-trigger="fileinput">
                                        <i class="fa fa-file fileinput-exists"></i>&nbsp;
                                        <span class="fileinput-filename"> </span>
                                    </div>
                                    <span class="input-group-addon btn default btn-file">
                                                                <span class="fileinput-new"> Select file </span>
                                                                <span class="fileinput-exists"> Change </span>
                                                                <input type="file" name="media"> </span>
                                    <a href="javascript:;" class="input-group-addon btn red fileinput-exists"
                                       data-dismiss="fileinput"> Remove </a>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="title" class="col-md-2 control-label">Title En </label>
                        <div class="col-md-6">
                            <input type="text" class="form-control" name="title_en" id="title_en"
                                   value="{{$about->title_en}}"
                                   placeholder="Title En">
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="title" class="col-md-2 control-label">Title Ar </label>
                        <div class="col-md-6">
                            <input type="text" class="form-control" name="title_ar" id="title_ar"
                                   value="{{$about->title_ar}}"
                                   placeholder="Title Ar">
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="detail" class="col-md-2 control-label">Content En </label>
                        <div class="col-md-6">
                            <textarea class="form-control ckeditor" name="content_en" id="content_en"
                                      placeholder="Content En " rows="5">{{$about->content_en}}</textarea>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="detail" class="col-md-2 control-label">Content Ar </label>
                        <div class="col-md-6">
                            <textarea class="form-control ckeditor" name="content_ar" id="content_ar"
                                      placeholder="Content Ar " rows="5">{{$about->content_ar}}</textarea>
                        </div>
                    </div>

                    <div class="form-body">

                        <div class="form-actions">
                            <div class="row">
                                <div class="col-md-12 text-center">
                                    <button type="submit" class="btn btn-circle green btn-md save"><i
                                            class="fa fa-check"></i>
                                        Save
                                    </button>
                                    <a href="{{url(admin_abouts_url())}}" class="btn btn-circle btn-md red">
                                        <i class="fa fa-times"></i>
                                        Close
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                    {!! Form::close() !!}
                </div>
            </div>
            <!-- END SAMPLE FORM PORTLET-->
        </div>
    </div>
@endsection
@section('js')

    <script src="{{url('/')}}/assets/global/plugins/moment.min.js" type="text/javascript"></script>
    <script src="{{url('/')}}/assets/global/plugins/bootstrap-daterangepicker/daterangepicker.min.js"
            type="text/javascript"></script>
    <script src="{{url('/')}}/assets/global/plugins/bootstrap-datepicker/js/bootstrap-datepicker.min.js"
            type="text/javascript"></script>
    <script src="{{url('/')}}/assets/global/plugins/select2/js/select2.full.min.js" type="text/javascript"></script>
    <script src="{{url('/')}}/assets/global/plugins/bootstrap-fileinput/bootstrap-fileinput.js"
            type="text/javascript"></script>

    <script src="{{url('/')}}/assets/global/scripts/app.min.js" type="text/javascript"></script>
    <script src="{{url('/')}}/assets/pages/scripts/components-select2.min.js" type="text/javascript"></script>
    <script src="{{url('/')}}/assets/pages/scripts/components-date-time-pickers.min.js" type="text/javascript"></script>
    <script src="{{url('/')}}/assets/js/about.js" type="text/javascript"></script>


@stop
