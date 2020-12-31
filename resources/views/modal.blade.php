<link href="{{url('/')}}/assets/global/plugins/bootstrap-fileinput/bootstrap-fileinput.css" rel="stylesheet"
      type="text/css"/>

<link href="{{url('/')}}/assets/global/plugins/select2/css/select2.min.css" rel="stylesheet" type="text/css"/>
<link href="{{url('/')}}/assets/global/plugins/select2/css/select2-bootstrap.min.css" rel="stylesheet"
      type="text/css"/>
<link href="{{url('/')}}/assets/global/plugins/bootstrap-timepicker/css/bootstrap-timepicker.min.css" rel="stylesheet"
      type="text/css"/>


<div class="modal fade bs-modal-lg" id="{{$modal_id}}" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
                <h4 class="modal-title"> {{$modal_title}}</h4>
            </div>

            <div class="modal-body">
                <div class="row">
                    <div class="col-sm-12">
                        <div class="portlet-body form">
                            {!! Form::open(['method'=>$form['method'],'id'=>$form['form_id'],'class'=>'form-horizontal form','url'=>$form['url'] ,'files'=>true]) !!}
                            <div class="alert alert-danger" role="alert" style="display: none"></div>

                            <div class="form-body">
                                @foreach($form['fields'] as $key => $fields)
                                    @if($fields == 'image' || $fields == 'video')
                                        <div class="form-group ">
                                            <label class="control-label col-md-3">{{$form['fields_name'][$key]}}</label>
                                            <div class="col-md-9">
                                                <div class="fileinput fileinput-new" data-provides="fileinput">
                                                    <div class="fileinput-preview thumbnail" data-trigger="fileinput"
                                                         style="width: 200px; height: 150px;">
                                                        @if(isset($form['values']))
                                                            @if($fields == 'video')
                                                                <video src="{{$form['values'][$key]}}" controls
                                                                       width="200"></video>
                                                            @else
                                                                <img src="{{$form['values'][$key]}}">

                                                            @endif
                                                        @else
                                                            <img src="http://www.placehold.it/200x150/EFEFEF/AAAAAA&amp;text=no+image"
                                                                 alt=""/>

                                                        @endif
                                                    </div>
                                                    <div>
                                                            <span class="btn red btn-outline btn-file">
                                                                <span class="fileinput-new"> Select </span>
                                                                <span class="fileinput-exists"> Change </span>
                                                                <input type="file" name="{{$key}}"
                                                                       id="{{$key}}"> </span>
                                                        <a href="javascript:;" class="btn red fileinput-exists"
                                                           data-dismiss="fileinput">
                                                            Remove </a>
                                                    </div>
                                                </div>

                                            </div>
                                        </div>

                                    @endif

                                    @if($fields == 'file')
                                        <div class="form-group">
                                            <label class="col-md-3 control-label">{{$form['fields_name'][$key]}}</label>
                                            <div class="col-md-9">
                                                <input type="file" name="{{$key}}" id="{{$key}}" class="form-control"
                                                       placeholder="{{$form['fields_name'][$key]}}">
                                            </div>
                                        </div>
                                    @endif

                                    @if($fields == 'file_multiple')
                                        <div class="form-group">
                                            <label class="col-md-3 control-label">{{$form['fields_name'][$key]}}</label>
                                            <div class="col-md-9">
                                                <input type="file" id="upload_file" name="upload_file[]"
                                                       onchange="preview_image();" multiple/>

                                                <style>
                                                    .img-wrap {
                                                        position: relative;
                                                        display: inline-block;
                                                        border: 1px white solid;
                                                        font-size: 0;
                                                    }

                                                    .img-wrap .close {
                                                        position: absolute;
                                                        top: 2px;
                                                        right: 2px;
                                                        z-index: 100;
                                                        background-color: #FFF;
                                                        padding: 5px 2px 2px;
                                                        color: #000;
                                                        font-weight: bold;
                                                        cursor: pointer;
                                                        opacity: 0.7;
                                                        text-align: center;
                                                        font-size: 22px;
                                                        line-height: 10px;
                                                        border-radius: 50%;
                                                    }

                                                    .img-wrap:hover .close {
                                                        opacity: 1;
                                                    }
                                                </style>

                                                <div id="image_preview" style="margin-top: 45px;">

                                                    @if(isset($form['values']))
                                                        @foreach($form['values']['images'] as $image)
                                                            <div class="img-wrap">
                                                                <span class="close delete-image"
                                                                      data-id="{{$image->id}}">&times;</span>
                                                                <img src='{{$image->image}}' width='100px'
                                                                     height="100px">
                                                            </div>
                                                        @endforeach
                                                    @endif

                                                    <span class="view">

                                                    </span>
                                                </div>

                                            </div>
                                        </div>
                                    @endif

                                    @if($fields == 'text')
                                        <div class="form-group">
                                            <label class="col-md-3 control-label">{{$form['fields_name'][$key]}}</label>
                                            <div class="col-md-9">
                                                <input type="text" name="{{$key}}" id="{{$key}}" class="form-control"
                                                       placeholder="{{$form['fields_name'][$key]}}"
                                                       @if(isset($form['values'])) value="{{$form['values'][$key]}}" @endif>
                                            </div>
                                        </div>
                                    @endif
                                    @if($fields == 'number')
                                        <div class="form-group">
                                            <label class="col-md-3 control-label">{{$form['fields_name'][$key]}}</label>
                                            <div class="col-md-9">
                                                <input type="number" name="{{$key}}" id="{{$key}}"
                                                       class="form-control"
                                                       placeholder="{{$form['fields_name'][$key]}}"
                                                       @if(isset($form['values'])) value="{{$form['values'][$key]}}" @endif>
                                            </div>
                                        </div>
                                    @endif
                                    @if($fields == 'text_dis')
                                        <div class="form-group">
                                            <label class="col-md-3 control-label">{{$form['fields_name'][$key]}}</label>
                                            <div class="col-md-9">
                                                <input type="text" name="{{$key}}" id="{{$key}}" class="form-control"
                                                       placeholder="{{$form['fields_name'][$key]}}" disabled
                                                       @if(isset($form['values'])) value="{{$form['values'][$key]}}" @endif>
                                            </div>
                                        </div>
                                    @endif
                                    @if($fields == 'time')
                                        <div class="form-group">
                                            <label class="control-label col-md-3">{{$form['fields_name'][$key]}}</label>
                                            <div class="col-md-3">
                                                <div class="input-icon">
                                                    <i class="fa fa-clock-o"></i>
                                                    <input type="text" name="{{$key}}" id="{{$key}}"
                                                           class="form-control timepicker timepicker-24"
                                                           @if(isset($form['values'])) value="{{$form['values'][$key]}}" @endif>
                                                </div>
                                            </div>
                                        </div>
                                    @endif
                                    @if($fields == 'email')
                                        <div class="form-group">
                                            <label class="col-md-3 control-label">{{$form['fields_name'][$key]}}</label>
                                            <div class="col-md-9">
                                                <input type="email" name="{{$key}}" id="{{$key}}"
                                                       class="form-control"
                                                       placeholder="{{$form['fields_name'][$key]}}"
                                                       @if(isset($form['values'])) value="{{$form['values'][$key]}}" @endif>
                                            </div>
                                        </div>
                                    @endif
                                    @if($fields == 'checkbox')
                                        <div class="form-group">
                                            <label class="col-md-3 control-label">{{$form['fields_name'][$key]}}</label>
                                            <div class="col-md-9">

                                                <div class="md-checkbox"><input type="checkbox" name="{{$key}}"
                                                                                id="checkbox1"
                                                                                class="md-check is_correct"
                                                                                @if(isset($form['values']) && $form['values'][$key]) checked @endif><label
                                                            for="checkbox1"><span></span><span
                                                                class="check"></span><span class="box"></span> </label>
                                                </div>
                                            </div>
                                        </div>
                                    @endif
                                    @if($fields == 'password')
                                        <div class="form-group">
                                            <label class="col-md-3 control-label">{{$form['fields_name'][$key]}}</label>
                                            <div class="col-md-9">
                                                <input type="password" name="{{$key}}" id="{{$key}}"
                                                       class="form-control"
                                                       placeholder="{{$form['fields_name'][$key]}}">
                                            </div>
                                        </div>
                                    @endif
                                        @if($fields == 'date')

                                            <div class="form-group">
                                                <label class="control-label col-md-3">{{$form['fields_name'][$key]}}</label>
                                                <div class="col-md-3">
                                                    <div class="input-group input-medium date date-picker"  data-date-format="yyyy-mm-dd" data-date-viewmode="years">
                                                        <input type="text" class="form-control" readonly name="{{$key}}" id="{{$key}}" @if(isset($form['values'])) value="{{$form['values'][$key]}}" @endif>
                                                        <span class="input-group-btn">
                                                            <button class="btn default" type="button">
                                                                <i class="fa fa-calendar"></i>
                                                            </button>
                                                        </span>
                                                    </div>
                                                    <!-- /input-group -->
                                                </div>
                                            </div>
                                        @endif
                                    @if($fields == 'textarea')
                                        <div class="form-group">

                                            @if($modal_id == 'add-expense' || $modal_id == 'edit-expense' || $modal_id == 'add-product' || $modal_id == 'edit-product' || $modal_id == 'add-category' || $modal_id == 'edit-category'|| $modal_id == 'add-role' || $modal_id == 'edit-role')
                                                <label class="col-md-3 control-label">{{$form['fields_name'][$key]}}</label>

                                                <div class="col-md-9">
                                                <textarea name="{{$key}}" id="{{$key}}" rows="5"
                                                          placeholder="{{$form['fields_name'][$key]}}"
                                                          class="form-control">@if(isset($form['values'])){{$form['values'][$key]}}@endif</textarea>
                                                </div>
                                            @else
                                                <div class="col-md-12">
                                                <textarea name="{{$key}}" id="{{$key}}" rows="5"
                                                          placeholder="{{$form['fields_name'][$key]}}"
                                                          class="form-control">@if(isset($form['values'])){{$form['values'][$key]}}@endif</textarea>
                                                </div>
                                            @endif
                                        </div>
                                    @endif
                                    @if($fields == 'ckeditor')
                                        <div class="form-group">
                                            <label class="col-md-3 control-label">{{$form['fields_name'][$key]}}</label>

                                            <div class="col-md-9">
                                                <textarea name="{{$key}}" id="{{$key}}" rows="5"
                                                          placeholder="{{$form['fields_name'][$key]}}"
                                                          class="form-control {{$fields}}">@if(isset($form['values'])){{$form['values'][$key]}}@endif</textarea>
                                            </div>

                                            <script>
                                                CKEDITOR.replace('{{$key}}');
                                            </script>
                                        </div>
                                    @endif

                                    @if(is_array($fields))
                                        <div class="form-group">
                                            <label class="col-md-3 control-label">{{$form['fields_name'][$key]}}</label>
                                            <div class="col-md-9">
                                                <div class="input-icon">
                                                    <select class="form-control select2 {{$key}}" name="{{$key}}"
                                                            @if(strpos($key,'[]') !== false && ($modal_id == 'add-admin' || $modal_id == 'edit-admin'))
                                                            multiple
                                                            @endif
                                                            data-placeholder="Choose {{$form['fields_name'][$key]}}..."
                                                            id="{{$key}}">
                                                        @foreach($fields as $k=> $field)
                                                            <option value="{{$k}}"
                                                                    @if(isset($form['values']) && $form['values'][$key] == $k) selected @endif>{{ucfirst($field)}}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                    @endif
                                    @if(is_object($fields) && strpos($key,'[]') !== false)
                                        <div class="form-group">
                                            <label class="col-md-3 control-label">{{$form['fields_name'][$key]}}</label>
                                            <div class="col-md-9">
                                                <div class="input-icon">
                                                    <select class="form-control select2 {{$key}}" name="{{$key}}"
                                                            @if(strpos($key,'[]') !== false) multiple
                                                            @endif data-placeholder="Choose {{$form['fields_name'][$key]}} ..."
                                                            id="{{$key}}"
                                                            style="padding: 0;">
                                                        <option></option>

                                                        @if(strpos($key,'[]') !== false && isset($form['values'][$key]))
                                                            @foreach($form['values'][$key] as $item)
                                                                <option value="{{$item->id}}"
                                                                        @if(in_array($item->id,$roles_id)) selected @endif>{{ucfirst($item->display_name)}}</option>

                                                            @endforeach
                                                            @foreach($fields as  $k => $field)

                                                                @if(in_array($field->id,$form['values']['role_res[]'])) @continue @endif
                                                                <option value="{{$field->id}}">{{ucfirst($field->display_name)}}</option>
                                                            @endforeach
                                                        @else
                                                            @foreach($fields as $field)
                                                                <option value="{{$field->id}}"
                                                                        @if(isset($form['values']) && $form['values'][$key] == $field->id) selected @endif>{{ucfirst($field->display_name)}}</option>
                                                            @endforeach
                                                        @endif
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                    @endif

                                    @if(is_object($fields) && strpos($key,'[]') === false)
                                        <div class="form-group">
                                            <label class="col-md-3 control-label">{{$form['fields_name'][$key]}}</label>
                                            <div class="col-md-9">
                                                <div class="input-icon">
                                                    <select class="form-control {{$key}}" name="{{$key}}"
                                                            @if(strpos($key,'[]') !== false) multiple
                                                            @endif data-placeholder="Choose {{$form['fields_name'][$key]}} ..."
                                                            id="{{$key}}"
                                                            style="    padding: 0;">
                                                        <option></option>

                                                        @foreach($fields as $k =>$field)
                                                            @if($key == 'category_id')
                                                                <option value="{{$field->id}}"
                                                                        @if(isset($form['values']) && $form['values'][$key] == $field->id) selected @endif>{{ucfirst($field->name)}}</option>
                                                            @endif
                                                            @if($key == 'city')
                                                                <option value="{{$field->id}}"
                                                                        @if(isset($form['values']) && $form['values'][$key] == $field->id) selected @endif>{{ucfirst($field->name_en)}}</option>
                                                            @endif
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                    @endif
                                @endforeach
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

<script>
    var filesArray = [];

    function preview_image() {
        $('#image_preview .view').html('');
        var total_file = document.getElementById("upload_file").files.length;
        for (var i = 0; i < total_file; i++) {
            filesArray.push(event.target.files[i]);
            $('#image_preview .view').append('<div class="img-wrap">' +
                '                <span class="close close_thumb">&times;</span>' +
                '            <img src="' + URL.createObjectURL(event.target.files[i]) + '" width="100px"  height="100px">' +
                '                </div>');

        }
    }

    function removeFile(index) {
        filesArray.splice(index, 1);
    }

    $(document).ready(function () {


        $(document).on('click', '.close_thumb', function () {
            var image = $(this).closest('.img-wrap');

            console.log(image.index());
//            $(this).closest('.img-wrap').remove();

            removeFile(image.index());

            image.fadeOut(function () {
                $(this).remove();
            });
        });
        $(document).on('click', '.delete-image', function () {

            var _this = $(this);
            var image_id = _this.data('id');
            $.ajax({
                url: '{{url('admin/store-image/')}}/' + image_id,
                dataType: 'json',
                type: 'DELETE',
                data: {_token: csrf_token},
                success: function (data) {

                    if (data.status)
                        _this.closest('.img-wrap').remove();
                }
            })
        });
    });
</script>