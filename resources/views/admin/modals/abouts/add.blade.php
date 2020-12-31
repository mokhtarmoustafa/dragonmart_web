<link href="{{url('/')}}/assets/global/plugins/bootstrap-fileinput/bootstrap-fileinput.css" rel="stylesheet"
      type="text/css"/>

<link href="{{url('/')}}/assets/global/plugins/select2/css/select2.min.css" rel="stylesheet" type="text/css"/>
<link href="{{url('/')}}/assets/global/plugins/select2/css/select2-bootstrap.min.css" rel="stylesheet"
      type="text/css"/>
<link href="{{url('/')}}/assets/global/plugins/bootstrap-timepicker/css/bootstrap-timepicker.min.css" rel="stylesheet"
      type="text/css"/>



<div class="modal fade bs-modal-lg" id="add-about" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
                <h4 class="modal-title"> Add new Section</h4>
            </div>

            <div class="modal-body">
                <div class="row">
                    <div class="col-sm-12">
                        <div class="portlet-body form">
                            {!! Form::open(['method'=>'POST','id'=>'addAbout','class'=>'form-horizontal form','url'=>url(admin_abouts_url() . '/create'),'files'=>true]) !!}
                            <div class="alert alert-danger" role="alert" style="display: none"></div>

                            <div class="form-body">

                                <div class="form-group">
                                    <label class="control-label col-md-3">Upload</label>

                                    <div class="col-md-9">

                                        <div class="fileinput fileinput-new" data-provides="fileinput">
                                            <div class="input-group input-large">
                                                <div class="form-control uneditable-input input-fixed input-medium" data-trigger="fileinput">
                                                    <i class="fa fa-file fileinput-exists"></i>&nbsp;
                                                    <span class="fileinput-filename"> </span>
                                                </div>
                                                <span class="input-group-addon btn default btn-file">
                                                                <span class="fileinput-new"> Select file </span>
                                                                <span class="fileinput-exists"> Change </span>
                                                                <input type="file" name="media"> </span>
                                                <a href="javascript:;" class="input-group-addon btn red fileinput-exists" data-dismiss="fileinput"> Remove </a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-md-3 control-label">Title EN</label>
                                    <div class="col-md-9">
                                        <input type="text" name="title_en" id="title_en" class="form-control"
                                               placeholder="Title EN">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-md-3 control-label">Title AR</label>
                                    <div class="col-md-9">
                                        <input type="text" name="title_ar" id="title_ar" class="form-control"
                                               placeholder="Title AR">
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="col-md-3 control-label">Content EN</label>

                                    <div class="col-md-9">
                                                <textarea name="content_en" id="content_en" rows="5"
                                                          placeholder="Content EN"
                                                          class="form-control"></textarea>
                                    </div>

                                    <script>
                                                CKEDITOR.replace('content_en');
                                            </script>
                                </div>
                                <div class="form-group">
                                    <label class="col-md-3 control-label">Content AR</label>

                                    <div class="col-md-9">
                                                <textarea name="content_ar" id="content_ar" rows="5"
                                                          placeholder="Content AR"
                                                          class="form-control"></textarea>
                                    </div>

                                    <script>
                                                CKEDITOR.replace('content_ar');
                                            </script>
                                </div>

                                <div class="form-actions">
                                    <div class="row">
                                        <div class="col-md-12 text-center">
                                            <button type="submit" class="btn btn-circle green btn-md save"><i
                                                    class="fa fa-check"></i>
                                                Save
                                            </button>
                                            <button type="button" class="btn btn-circle btn-md red"
                                                    data-dismiss="modal">
                                                <i class="fa fa-times"></i>
                                                Close
                                            </button>
                                        </div>
                                    </div>
                                </div>
                                {!! Form::close() !!}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
    </div>
</div>

<script src="{{url('/')}}/assets/global/plugins/select2/js/select2.full.min.js" type="text/javascript"></script>
<script src="{{url('/')}}/assets/pages/scripts/components-select2.min.js" type="text/javascript"></script>

<script src="{{url('/')}}/assets/global/plugins/bootstrap-fileinput/bootstrap-fileinput.js"
        type="text/javascript"></script>
<script src="{{url('/')}}/assets/global/plugins/moment.min.js" type="text/javascript"></script>
<script src="{{url('/')}}/assets/global/plugins/bootstrap-daterangepicker/daterangepicker.min.js"
        type="text/javascript"></script>

<script src="{{url('/')}}/assets/global/plugins/bootstrap-timepicker/js/bootstrap-timepicker.min.js"
        type="text/javascript"></script>
<!-- BEGIN THEME GLOBAL SCRIPTS -->
<script src="{{url('/')}}/assets/global/scripts/app.min.js" type="text/javascript"></script>
<!-- END THEME GLOBAL SCRIPTS -->
<!-- BEGIN PAGE LEVEL SCRIPTS -->
<script src="{{url('/')}}/assets/pages/scripts/components-date-time-pickers.min.js" type="text/javascript"></script>
<!-- END PAGE LEVEL SCRIPTS -->
