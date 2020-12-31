<style>
    .has_offer {
        display: none;
    }
</style>
<div class="row">
    <div class="col-md-12">
        <!-- BEGIN EXAMPLE TABLE PORTLET-->
        <div class="portlet box green">
            <div class="portlet-title">
                <div class="caption">
                    <i class="fa fa-plus font-weight-light"></i>
                    <span class="caption-subject bold uppercase"> Add new product </span>
                </div>

            </div>
            <div class="portlet-body form">
                <div class="form-body">
                    {{--                        {!! Form::open(['method'=>'POST','url'=>url(admin_vw().'/user/export')]) !!}--}}
                    {{--<form method="POST" action="#" class="form-horizontal form-bordered form-row-stripped">--}}
                    {!! Form::open(['method'=>'POST','class'=>'form-horizontal form-bordered form-row-stripped','url'=>url(merchant_store_url().'/product'),'id'=>'productAdd']) !!}
                    <div class="form-group">
                        <div class="control-label col-md-2">
                            <label>Product name</label>
                        </div>
                        <div class="col-md-2">
                            <input id="name" class="form-control" name="name" type="text"
                                   placeholder="Product name">
                        </div>
                        <div class="control-label col-md-2">
                            <label>Price</label>
                        </div>
                        <div class="col-md-2">
                            <input id="price" class="form-control" name="price" type="number"
                                   placeholder="Price">
                        </div>
                        <div class="control-label col-md-2">
                            <label>Quantity</label>
                        </div>
                        <div class="col-md-2">
                            <input id="original_quantity" class="form-control" name="original_quantity" type="number"
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
                                    <option value="{{$category->id}}">{{$category->name}}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="control-label col-md-1">
                            <label>Is Offer</label>
                        </div>
                        <div class="col-md-1">
                            <div class="md-checkbox"><input type="checkbox" id="checkbox1" name="is_offer" data-value="0"
                                                            class="md-check is_offer"
                                                            data-id=""><label for="checkbox1"><span></span><span
                                            class="check"></span><span class="box"></span> </label>
                            </div>
                        </div>

                        <div class="control-label col-md-2 has_offer">
                            <label>Offer %</label>
                        </div>
                        <div class="col-md-2 has_offer">
                            <input id="offer_percentage" class="form-control" name="offer_percentage" type="number"
                                   placeholder="Offer %">
                        </div>
                        <div class="control-label col-md-1">
                            <label>Is Sponsor</label>
                        </div>
                        <div class="col-md-1">
                            <div class="md-checkbox"><input type="checkbox" id="checkbox2" name="is_sponsor"
                                                            class="md-check is_sponsor" data-id=""><label
                                        for="checkbox2"><span></span><span class="check"></span><span
                                            class="box"></span> </label></div>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="control-label col-md-2">
                            <label>Description</label>
                        </div>
                        <div class="col-md-10">
                            <textarea class="form-control" rows="6" name="description" id="description"></textarea>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="control-label col-md-2">
                            <label>Customizations</label>
                        </div>
                        <div class="col-md-10">
                            <table class="table table-striped table-bordered table-hover table-checkable">
                                <thead>
                                <tr role="row" class="heading text-center">
                                    <th width="5%">&nbsp;#</th>
                                    <th width="10%">
                                        Custom
                                    </th>
                                    <th width="10 %">
                                        Price
                                    </th>
                                    <th width="20%">
                                        Text
                                    </th>
                                    <th width="25%">
                                        Description
                                    </th>
                                    <th width="10%">
                                        Set Default
                                    </th>
                                    <th width="20%">Action</th>
                                </tr>
                                <tr role="row" class="filter custom-form">
                                    <td></td>
                                    <td>

                                        <select class="form-control form-filter input-sm select2"
                                                id="custom_id">
                                            <option value="0">Select...</option>
                                            @foreach($customizations as $custom)
                                                <option value="{{$custom->id}}">{{$custom->name}}</option>
                                            @endforeach
                                        </select>

                                    </td>
                                    <td>

                                        <input id="price" class="form-control form-filter input-sm"
                                               type="number"
                                               placeholder="Price">
                                    </td>
                                    <td>

                                        <input id="text" class="form-control form-filter input-sm"
                                               type="text"
                                               placeholder="Text">
                                    </td>
                                    <td>

                                                <textarea class="form-control form-filter input-sm" rows="3"
                                                          id="custom_description"></textarea>
                                    </td>
                                    <td>
                                        <div class="md-checkbox"><input type="checkbox" id="checkbox3"
                                                                        class="md-check is_default form-filter input-sm"><label
                                                    for="checkbox3"><span></span><span
                                                        class="check"></span><span class="box"></span> </label>
                                        </div>
                                    </td>
                                    <td><a href="javascript:;"
                                           class="btn btn-info btn-icon-only btn-circle add-custom"><i
                                                    class="fa fa-plus"></i></a></td>
                                </tr>
                                </thead>
                                <tbody class="customization_bdy">
                                <tr class="no-custom">
                                    <td colspan="7">No customizations</td>
                                </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>


                    {{--{!! Form::close() !!}--}}
                    <div class="form-actions save_operations" style="display: block;">
                        <div class="row">
                            <div class="col-md-12 text-center">
                                <button type="submit" class="btn btn-circle green save"><i class="fa fa-check"></i>
                                    Save
                                </button>
                            </div>
                        </div>
                    </div>
                    {!! Form::close() !!}


                </div>
            </div>
        </div>
        <!-- END EXAMPLE TABLE PORTLET-->


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
                                    <button class="btn red delete btn-sm" data-type="{%=file.deleteType%}" data-url="{%=file.deleteUrl%}" {% if (file.deleteWithCredentials) { %} data-xhr-fields='{"withCredentials":true}' {% } %}>
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
<div class="row store_images" style="display: none">
    <div class="col-md-12">
        <div class="portlet box red ">
            <div class="portlet-title">
                <div class="caption">
                    <i class=" font-dark"></i>
                    <span class="caption-subject bold uppercase"> Product Images </span>
                </div>

            </div>
            <div class="portlet-body form">
                <div class="form-body">
                {{--<form id="fileupload" action="" method="POST" enctype="multipart/form-data">--}}
                {!! Form::open(['method'=>'POST','url'=>url(merchant_store_url().'/product/images'),'id'=>'fileupload','files'=>true]) !!}
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
