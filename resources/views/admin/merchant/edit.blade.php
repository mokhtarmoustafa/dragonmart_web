@extends(merchant_layout_vw().'.index')

@section('css')
    <link href="{{url('/')}}/assets/global/plugins/datatables/datatables.min.css" rel="stylesheet" type="text/css"/>
    <link href="{{url('/')}}/assets/global/plugins/datatables/plugins/bootstrap/datatables.bootstrap.css"
          rel="stylesheet" type="text/css"/>
    <link href="{{url('/')}}/assets/global/plugins/fancybox/source/jquery.fancybox.css" rel="stylesheet"
          type="text/css"/>
    <link href="{{url('/')}}/assets/global/plugins/jquery-file-upload/blueimp-gallery/blueimp-gallery.min.css"
          rel="stylesheet" type="text/css"/>
    <link href="{{url('/')}}/assets/global/plugins/jquery-file-upload/css/jquery.fileupload.css" rel="stylesheet"
          type="text/css"/>
    <link href="{{url('/')}}/assets/global/plugins/jquery-file-upload/css/jquery.fileupload-ui.css" rel="stylesheet"
          type="text/css"/>


    <link href="{{url('/')}}/assets/global/plugins/bootstrap-colorpicker/css/colorpicker.css" rel="stylesheet"
          type="text/css"/>
    <link href="{{url('/')}}/assets/global/plugins/jquery-minicolors/jquery.minicolors.css" rel="stylesheet"
          type="text/css"/>
    <!-- BEGIN THEME GLOBAL STYLES -->
    <link href="{{url('/')}}/assets/global/css/components-md.min.css" rel="stylesheet" id="style_components"
          type="text/css"/>
    <link href="{{url('/')}}/assets/global/css/plugins-md.min.css" rel="stylesheet" type="text/css"/>
    <!-- END THEME GLOBAL STYLES -->
@endsection
@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="portlet light ">
                <div class="portlet-title">
                    <div class="caption">
                        <i class="fa fa-edit font-purple-soft"></i>
                        <span class="caption-subject font-purple-soft bold uppercase">Edit product</span> <span
                            class="label label-primary">{{$product->name}}</span>
                    </div>
                    <div class="actions">
                        <a href="{{url(merchant_vw().'/product/create')}}" class="btn btn-circle btn-info">
                            <i class="fa fa-plus"></i>
                            <span class="hidden-xs"> New product </span>
                        </a>
                    </div>
                </div>
                {!! Form::open(['method'=>'PUT','class'=>'form-horizontal form-bordered form-row-stripped','url'=>url(merchant_vw().'/product/'.$product->id),'id'=>'productEdit']) !!}

                <div class="portlet-body">
                    <ul class="nav nav-tabs">
                        <li class="active">
                            <a href="#general" data-toggle="tab"> General </a>
                        </li>
                        <li>
                            <a href="#customizations" data-toggle="tab"> Customizations</a>
                        </li>
                    </ul>
                    <div class="tab-content">
                        <div class="tab-pane fade  active in " id="general">

                            <div class="portlet-body form">
                                <style>
                                    .has_offer {
                                        display: none;
                                    }
                                </style>
                                <div class="row">
                                    <div class="col-md-12">
                                        <!-- BEGIN EXAMPLE TABLE PORTLET-->
                                        <div class="portlet box">

                                            <div class="portlet-body form">
                                                <div class="form-body">
                                                    {{--                        {!! Form::open(['method'=>'POST','url'=>url(admin_vw().'/user/export')]) !!}--}}
                                                    {{--<form method="POST" action="#" class="form-horizontal form-bordered form-row-stripped">--}}
                                                    <div class="form-group">
                                                        <div class="control-label col-md-2">
                                                            <label>Product name</label>
                                                        </div>
                                                        <div class="col-md-2">
                                                            <input id="name" class="form-control"
                                                                   name="name" type="text"
                                                                   placeholder="Product name"
                                                                   value="{{$product->name ?? ''}}">
                                                        </div>
                                                        <div class="control-label col-md-2">
                                                            <label>Price</label>
                                                        </div>
                                                        <div class="col-md-2">
                                                            <input id="price" class="form-control"
                                                                   name="price" type="number"
                                                                   value="{{$product->price ?? ''}}"
                                                                   placeholder="Price">
                                                        </div>
                                                        <div class="control-label col-md-2">
                                                            <label>Quantity</label>
                                                        </div>
                                                        <div class="col-md-2">
                                                            <input id="original_quantity"
                                                                   class="form-control"
                                                                   name="original_quantity" type="number"
                                                                   value="{{$product->original_quantity ?? ''}}"
                                                                   placeholder="Quantity">
                                                        </div>


                                                    </div>


                                                    <div class="form-group">
                                                        <div class="control-label col-md-2">
                                                            <label>Categories</label>
                                                        </div>
                                                        <div class="col-md-2">
                                                            <select class="form-control" name="category_id">
                                                                @foreach($categories as $category)
                                                                    <option value="{{$category->id}}"
                                                                            @if($product->category_id == $category->id) selected @endif>{{$category->name}}</option>
                                                                @endforeach
                                                            </select>
                                                        </div>

                                                        <div class="control-label col-md-1">
                                                            <label>Offer</label>
                                                        </div>
                                                        <div class="col-md-1">
                                                            <div class="md-checkbox"><input type="checkbox"
                                                                                            id="checkbox1"
                                                                                            name="is_offer"
                                                                                            data-value="0"
                                                                                            class="md-check is_offer"
                                                                                            @if($product->is_offer) checked
                                                                                            @endif
                                                                                            data-id=""><label
                                                                    for="checkbox1"><span></span><span
                                                                        class="check"></span><span
                                                                        class="box"></span> </label>
                                                            </div>
                                                        </div>

                                                        <div class="control-label col-md-1 has_offer"
                                                             @if($product->is_offer) style="display: block" @endif>
                                                            <label>Offer %</label>
                                                        </div>
                                                        <div class="col-md-1 has_offer"
                                                             @if($product->is_offer) style="display: block" @endif>
                                                            <input id="offer_percentage"
                                                                   class="form-control"
                                                                   name="offer_percentage" type="number"
                                                                   value="{{$product->offer_percentage}}"
                                                                   placeholder="Offer %">
                                                        </div>
                                                        {{--                                                        <div class="control-label col-md-1">--}}
                                                        {{--                                                            <label>Sponsor</label>--}}
                                                        {{--                                                        </div>--}}
                                                        {{--                                                        <div class="col-md-1">--}}
                                                        {{--                                                            <div class="md-checkbox"><input type="checkbox"--}}
                                                        {{--                                                                                            id="checkbox2"--}}
                                                        {{--                                                                                            name="is_sponsor"--}}
                                                        {{--                                                                                            class="md-check is_sponsor"--}}
                                                        {{--                                                                                            @if($product->is_sponsor) checked--}}
                                                        {{--                                                                                            @endif--}}
                                                        {{--                                                                                            data-id=""><label--}}
                                                        {{--                                                                        for="checkbox2"><span></span><span--}}
                                                        {{--                                                                            class="check"></span><span--}}
                                                        {{--                                                                            class="box"></span> </label>--}}
                                                        {{--                                                            </div>--}}
                                                        {{--                                                        </div>--}}

                                                        <div class="control-label col-md-1">
                                                            <label>Sponsor</label>
                                                        </div>
                                                        <div class="col-md-1">
                                                            <div class="md-checkbox"><input type="checkbox"
                                                                                            id="checkbox2"
                                                                                            name="is_sponsor"


                                                                                            class="md-check is_sponsor"
                                                                                            @if($product->is_sponsor) checked
                                                                                            data-value="1"
                                                                                            @else
                                                                                            data-value="0"
                                                                                            @endif
                                                                                            data-id=""><label
                                                                    for="checkbox2"><span></span><span
                                                                        class="check"></span><span
                                                                        class="box"></span> </label>
                                                            </div>
                                                        </div>
                                                        <div class="has_sponsor"
                                                             @if($product->is_sponsor) style="display: block;"
                                                             @else style="display: none;"
                                                            @endif>
                                                            <div class="control-label col-md-1">
                                                                <label>Duration (days)</label>
                                                            </div>
                                                            <div class="col-md-1">
                                                                <input id="sponsor_duration"
                                                                       class="form-control"
                                                                       name="sponsor_duration" type="number"
                                                                       placeholder="Number of days">
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="form-group">
                                                        <div class="control-label col-md-2">
                                                            <label>Description</label>
                                                        </div>
                                                        <div class="col-md-10">
                                                                        <textarea class="form-control" rows="6"
                                                                                  name="description"
                                                                                  id="description">{{$product->description}}</textarea>
                                                        </div>
                                                    </div>

                                                </div>
                                            </div>
                                        </div>
                                        <!-- END EXAMPLE TABLE PORTLET-->


                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="tab-pane fade" id="customizations">

                            <div class="portlet-body form">

                                <div class="row">
                                    <div class="col-md-12">
                                        <!-- BEGIN EXAMPLE TABLE PORTLET-->
                                        <div class="portlet box">

                                            <div class="portlet-body form">
                                                <div class="form-body">

                                                    <div class="form-group">
                                                        <div class="control-label col-md-2">
                                                            <label>Custom</label>
                                                        </div>
                                                        <div class="col-md-2">
                                                            <select class="form-control"
                                                                    id="custom_id">
                                                                @foreach($customizations as $custom)
                                                                    <option
                                                                        value="{{$custom->id}}">{{$custom->name}}</option>
                                                                @endforeach
                                                            </select>
                                                        </div>
                                                        <div class="control-label col-md-2">
                                                            <label>Extra-Cost</label>
                                                        </div>
                                                        <div class="col-md-2">
                                                            <input class="form-control" type="number"
                                                                   id="price">
                                                        </div>
                                                        <div class="custom_color" style="display: none;">
                                                            <div class="control-label col-md-2">
                                                                <label>Color</label>
                                                            </div>
                                                            <div class="col-md-2">
                                                                <input type="text" id="hue-demo"
                                                                       class="form-control demo"
                                                                       data-control="hue" name="text"
                                                                       placeholder="#ff6161"
                                                                       autocomplete="off">
                                                            </div>
                                                        </div>
                                                        <div class="custom_title">
                                                            <div class="control-label col-md-2">
                                                                <label>Title</label>
                                                            </div>
                                                            <div class="col-md-2">
                                                                <input type="text" class="form-control title"
                                                                       name="title">
                                                            </div>

                                                        </div>

                                                    </div>
                                                    <div class="form-group">
                                                        <div class="control-label col-md-2">
                                                            <label>Description</label>
                                                        </div>
                                                        <div class="col-md-2">
                                                            <input class="form-control" type="text"
                                                                   name="description"
                                                                   id="description">
                                                        </div>

                                                    </div>

                                                </div>
                                            </div>
                                        </div>
                                        <!-- END EXAMPLE TABLE PORTLET-->


                                    </div>
                                    <div class="form-actions" style="display: block;">
                                        <div class="row">
                                            <div class="col-md-12 text-center">
                                                <button type="button" class="btn btn-circle default add-custom"><i
                                                        class="fa fa-plus"></i>
                                                    Add custom
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-12">
                                        <table
                                            class="table table-striped table-bordered table-hover table-checkable order-column">
                                            <thead>
                                            <tr>
                                                <th>#</th>
                                                {{--                                                                <th> Logo</th>--}}
                                                <th> Custom</th>
                                                <th> Title/Color</th>
                                                <th> Description</th>
                                                <th> Extra-cost</th>
                                                {{--                                                <th> Default</th>--}}
                                                <th> Action</th>
                                            </tr>
                                            </thead>
                                            <tbody class="custom-row">
                                            @foreach($product->customizations as $custom)
                                                @foreach($custom->product_customizations as $c)
                                                    <tr>
                                                        <td>{{$loop->iteration}}</td>
                                                        <td>{{$custom->name}}<input type="hidden" name="custom_id[]"
                                                                                    value="{{$custom->id}}"></td>
                                                        <td>{{$c->text}}<input
                                                                type="hidden"
                                                                name="custom_text[]"
                                                                value="{{$c->text}}">
                                                        </td>
                                                        <td>{{$c->description}}<input
                                                                type="hidden"
                                                                name="custom_description[]"
                                                                value="{{$c->description}}">
                                                        </td>
                                                        <td>{{$c->price}}<input
                                                                type="hidden" name="custom_price[]"
                                                                value="{{$c->price}}">
                                                        </td>
                                                        {{--                                                    <td>--}}
                                                        {{--                                                        <span class="default_text">{{$custom->product_customizations[0]->is_default}}</span><input--}}
                                                        {{--                                                                type="hidden" name="is_default[]" class="default"--}}
                                                        {{--                                                                value="{{$custom->product_customizations[0]->is_default}}">--}}
                                                        {{--                                                    </td>--}}
                                                        <td><a href="javascript:;"
                                                               class="btn btn-danger btn-icon-only btn-circle remove-custom"><i
                                                                    class="fa fa-times"></i></a></td>
                                                    </tr>
                                                @endforeach
                                            @endforeach
                                            </tbody>
                                        </table>

                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
                <div class="form-actions save_operations" style="display: block;">
                    <div class="row">
                        <div class="col-md-12 text-center">
                            <button type="submit" class="btn btn-circle green save"><i
                                    class="fa fa-check"></i>
                                Save Product
                            </button>
                        </div>
                    </div>
                </div>
                {!! Form::close() !!}
                <div class="product-images">

                    <div class="row store_images">
                        <div class="col-md-12">
                            <div class="portlet light ">
                                <div class="portlet-title">
                                    <div class="caption">
                                        <i class="fa fa-image font-dark"></i>
                                        <span class="caption-subject bold uppercase"> Product Images</span>
                                    </div>

                                </div>
                                <div class="portlet-body form">
                                    <div class="form-body">
                                    {{--<form id="fileupload" action="" method="POST" enctype="multipart/form-data">--}}
                                    {!! Form::open(['method'=>'POST','url'=>url(merchant_store_url().'/add-product-images/'.$product->id),'id'=>'fileuploadProduct','files'=>true]) !!}
                                    <!-- The fileupload-buttonbar contains buttons to add/delete files and start/cancel the upload -->

                                        <div class="row fileupload-buttonbar">
                                            <div class="col-lg-7">
                                                <!-- The fileinput-button span is used to style the file input field as button -->
                                                <span class="btn green fileinput-button">
                                                <i class="fa fa-plus"></i>
                                                <span> Add files... </span>
                                                <input type="file" name="files[]" multiple=""> </span>
                                                {{--<button type="submit" class="btn blue start">--}}
                                                {{--<i class="fa fa-upload"></i>--}}
                                                {{--<span> Start upload </span>--}}
                                                {{--</button>--}}
                                                <button type="reset" class="btn warning cancel">
                                                    <i class="fa fa-ban-circle"></i>
                                                    <span> Cancel upload </span>
                                                </button>
                                            {{--<button type="button" class="btn red delete">--}}
                                            {{--<i class="fa fa-trash"></i>--}}
                                            {{--<span> Delete </span>--}}
                                            {{--</button>--}}
                                            {{--<input type="checkbox" class="toggle">--}}
                                            <!-- The global file processing state -->
                                                <span class="fileupload-process"> </span>
                                            </div>
                                            <!-- The global progress information -->
                                            <div class="col-lg-5 fileupload-progress fade">
                                                <!-- The global progress bar -->
                                                <div class="progress progress-striped active" role="progressbar"
                                                     aria-valuemin="0" aria-valuemax="100">
                                                    <div class="progress-bar progress-bar-success"
                                                         style="width:0%;"></div>
                                                </div>
                                                <!-- The extended global progress information -->
                                                <div class="progress-extended"> &nbsp;</div>
                                            </div>
                                        </div>
                                        <!-- The table listing the files available for upload/download -->
                                        <table role="presentation" class="table table-striped clearfix">
                                            <tbody class="files"></tbody>
                                        </table>

                                        {!! Form::close() !!}


                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>


                    <!-- The blueimp Gallery widget -->
                    <div id="blueimp-gallery" class="blueimp-gallery blueimp-gallery-controls" data-filter=":even">
                        <div class="slides"></div>
                        <h3 class="title"></h3>
                        <a class="prev"> ‹ </a>
                        <a class="next"> › </a>
                        <a class="close white"> </a>
                        <a class="play-pause"> </a>
                        <ol class="indicator"></ol>
                    </div>
                    <!-- BEGIN JAVASCRIPTS(Load javascripts at bottom, this will reduce page load time) -->
                    <script id="template-upload" type="text/x-tmpl"> {% for (var i=0, file; file=o.files[i]; i++) { %}
                            <tr class="template-upload fade">
                                <td>
                                    <span class="preview"></span>
                                </td>
                                <td>
                                    <p class="name">{%=file.name%}</p>
                                    <strong class="error text-danger label label-danger"></strong>
                                </td>
                                <td>
                                    <p class="size">Processing...</p>
                                    <div class="progress progress-striped active" role="progressbar" aria-valuemin="0" aria-valuemax="100" aria-valuenow="0">
                                        <div class="progress-bar progress-bar-success" style="width:0%;"></div>
                                    </div>
                                </td>
                                <td> {% if (!i && !o.options.autoUpload) { %}
                                    <button class="btn blue start" disabled>
                                        <i class="fa fa-upload"></i>
                                        <span>Start</span>
                                    </button> {% } %} {% if (!i) { %}
                                    <button class="btn red cancel">
                                        <i class="fa fa-ban"></i>
                                        <span>Cancel</span>
                                    </button> {% } %} </td>
                            </tr> {% } %}



































                    </script>
                    <!-- The template to display files available for download -->
                    <script id="template-download" type="text/x-tmpl"> {% for (var i=0, file; file=o.files[i]; i++) { %}
                            <tr class="template-download fade">
                                <td>
                                    <span class="preview"> {% if (file.thumbnailUrl) { %}
                                        <a href="{%=file.url%}" title="{%=file.name%}" download="{%=file.name%}" data-gallery>
                                            <img src="{%=file.thumbnailUrl%}" style="width:50px;height:50px">
                                        </a> {% } %} </span>
                                </td>
                                <td>
                                    <p class="name"> {% if (file.url) { %}
                                        <a href="{%=file.url%}" title="{%=file.name%}" download="{%=file.name%}" {%=file.thumbnailUrl? 'data-gallery': ''%}>{%=file.name%}</a> {% } else { %}
                                        <span>{%=file.name%}</span> {% } %} </p> {% if (file.error) { %}
                                    <div>
                                        <span class="label label-danger">Error</span> {%=file.error%}</div> {% } %} </td>
                                <td>
                                    <span class="size">{%=o.formatFileSize(file.size)%}</span>
                                </td>
                                <td> {% if (file.deleteUrl) { %}
                                    <button class="btn red {%=file.deleteClass%} btn-sm" data-type="{%=file.deleteType%}" data-url="{%=file.deleteUrl%}" {% if (file.deleteWithCredentials) { %} data-xhr-fields='{"withCredentials":true}' {% } %}>
                                        <i class="fa fa-trash-o"></i>
                                        <span>Delete</span>
                                    </button>
                                     {% } else { %}
                                    <button class="btn yellow cancel btn-sm">
                                        <i class="fa fa-ban"></i>
                                        <span>Cancel</span>
                                    </button> {% } %} </td>
                            </tr> {% } %}



































                    </script>


                </div>
            </div>
        </div>
    </div>

@endsection
@section('js')

    <script src="{{url('/')}}/assets/global/scripts/datatable.js" type="text/javascript"></script>
    <script src="{{url('/')}}/assets/global/plugins/datatables/datatables.min.js" type="text/javascript"></script>
    <script src="{{url('/')}}/assets/global/plugins/datatables/plugins/bootstrap/datatables.bootstrap.js"
            type="text/javascript"></script>

    <!-- BEGIN PAGE LEVEL PLUGINS -->
    <script src="{{url('/')}}/assets/global/plugins/fancybox/source/jquery.fancybox.pack.js"
            type="text/javascript"></script>
    <script src="{{url('/')}}/assets/global/plugins/jquery-file-upload/js/vendor/jquery.ui.widget.js"
            type="text/javascript"></script>
    <script src="{{url('/')}}/assets/global/plugins/jquery-file-upload/js/vendor/tmpl.min.js"
            type="text/javascript"></script>
    <script src="{{url('/')}}/assets/global/plugins/jquery-file-upload/js/vendor/load-image.min.js"
            type="text/javascript"></script>
    <script src="{{url('/')}}/assets/global/plugins/jquery-file-upload/js/vendor/canvas-to-blob.min.js"
            type="text/javascript"></script>
    <script src="{{url('/')}}/assets/global/plugins/jquery-file-upload/blueimp-gallery/jquery.blueimp-gallery.min.js"
            type="text/javascript"></script>
    <script src="{{url('/')}}/assets/global/plugins/jquery-file-upload/js/jquery.iframe-transport.js"
            type="text/javascript"></script>
    <script src="{{url('/')}}/assets/global/plugins/jquery-file-upload/js/jquery.fileupload.js"
            type="text/javascript"></script>
    <script src="{{url('/')}}/assets/global/plugins/jquery-file-upload/js/jquery.fileupload-process.js"
            type="text/javascript"></script>
    <script src="{{url('/')}}/assets/global/plugins/jquery-file-upload/js/jquery.fileupload-image.js"
            type="text/javascript"></script>
    <script src="{{url('/')}}/assets/global/plugins/jquery-file-upload/js/jquery.fileupload-audio.js"
            type="text/javascript"></script>
    <script src="{{url('/')}}/assets/global/plugins/jquery-file-upload/js/jquery.fileupload-video.js"
            type="text/javascript"></script>
    <script src="{{url('/')}}/assets/global/plugins/jquery-file-upload/js/jquery.fileupload-validate.js"
            type="text/javascript"></script>
    <script src="{{url('/')}}/assets/global/plugins/jquery-file-upload/js/jquery.fileupload-ui.js"
            type="text/javascript"></script>

    <script src="{{url('/')}}/assets/global/plugins/bootstrap-colorpicker/js/bootstrap-colorpicker.js"
            type="text/javascript"></script>
    <script src="{{url('/')}}/assets/global/plugins/jquery-minicolors/jquery.minicolors.min.js"
            type="text/javascript"></script>
    <!-- END PAGE LEVEL PLUGINS -->
    <script src="{{url('/')}}/assets/global/plugins/jquery-ui/jquery-ui.min.js" type="text/javascript"></script>

    <!-- BEGIN THEME GLOBAL SCRIPTS -->
    <script src="{{url('/')}}/assets/global/scripts/app.min.js" type="text/javascript"></script>
    <!-- END THEME GLOBAL SCRIPTS -->
    <script src="{{url('/')}}/assets/pages/scripts/components-color-pickers.min.js" type="text/javascript"></script>

    <script src="{{url('/')}}/assets/pages/scripts/table-datatables-responsive.min.js" type="text/javascript"></script>

    <script>
        var FormFileUpload = function () {
            return {
                init: function () {
                    $("#fileuploadProduct").fileupload({
                        disableImageResize: !1,
                        autoUpload: !1,
                        disableImageResize: /Android(?!.*Chrome)|Opera/.test(window.navigator.userAgent),
                        maxFileSize: 5e6,
                        acceptFileTypes: /(\.|\/)(gif|jpe?g|png)$/i
                    }), $("#fileuploadProduct").fileupload("option", "redirect", window.location.href.replace(/\/[^\/]*$/, "/cors/result.html?%s")), $.support.cors && $.ajax({type: "HEAD"}).fail(function () {
                        $('<div class="alert alert-danger"/>').text("Upload server currently unavailable - " + new Date).appendTo("#fileuploadProduct")
                    }), $("#fileuploadProduct").addClass("fileupload-processing"),

                        $.ajax({
                            url: $("#fileuploadProduct").attr("action"),
                            dataType: "json",
                            context: $("#fileuploadProduct")[0],
                            data: {_token: csrf_token}
                        }).always(function () {
                            $(this).removeClass("fileupload-processing")
                        }).done(function (e) {
                            $(this).fileupload("option", "done").call(this, $.Event("done"), {result: e})
                        })
                }
            }
        }();
        jQuery(document).ready(function () {
            FormFileUpload.init()
        });
    </script>
    {{--    <script src="{{url('/')}}/assets/global/plugins/ckeditor/ckeditor.js"></script>--}}
    <script src="{{url('/')}}/assets/js/products.js" type="text/javascript"></script>

    <!-- BEGIN PAGE LEVEL SCRIPTS -->

@stop
