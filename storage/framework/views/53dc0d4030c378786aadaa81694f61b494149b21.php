<?php 
if(auth()->guard('admin')->user()->type == "admin" || auth()->guard('admin')->user()->type == "Superadmin"){
    $layoutView =admin_layout_vw();
    
}else {
    $layoutView = merchant_layout_vw();
}
?>



<?php $__env->startSection('css'); ?>
    <link href="<?php echo e(url('/')); ?>/assets/global/plugins/datatables/datatables.min.css" rel="stylesheet" type="text/css"/>
    <link href="<?php echo e(url('/')); ?>/assets/global/plugins/datatables/plugins/bootstrap/datatables.bootstrap.css"
          rel="stylesheet" type="text/css"/>
    <link href="<?php echo e(url('/')); ?>/assets/global/plugins/fancybox/source/jquery.fancybox.css" rel="stylesheet"
          type="text/css"/>
    <link href="<?php echo e(url('/')); ?>/assets/global/plugins/jquery-file-upload/blueimp-gallery/blueimp-gallery.min.css"
          rel="stylesheet" type="text/css"/>
    <link href="<?php echo e(url('/')); ?>/assets/global/plugins/jquery-file-upload/css/jquery.fileupload.css" rel="stylesheet"
          type="text/css"/>
    <link href="<?php echo e(url('/')); ?>/assets/global/plugins/jquery-file-upload/css/jquery.fileupload-ui.css" rel="stylesheet"
          type="text/css"/>
    <!-- BEGIN PAGE LEVEL PLUGINS -->
    <link href="<?php echo e(url('/')); ?>/assets/global/plugins/bootstrap-colorpicker/css/colorpicker.css" rel="stylesheet"
          type="text/css"/>
    <link href="<?php echo e(url('/')); ?>/assets/global/plugins/jquery-minicolors/jquery.minicolors.css" rel="stylesheet"
          type="text/css"/>
    <!-- END PAGE LEVEL PLUGINS -->
    <!-- BEGIN THEME GLOBAL STYLES -->
    <link href="<?php echo e(url('/')); ?>/assets/global/css/components-md.min.css" rel="stylesheet" id="style_components"
          type="text/css"/>
    <link href="<?php echo e(url('/')); ?>/assets/global/css/plugins-md.min.css" rel="stylesheet" type="text/css"/>
    <!-- END THEME GLOBAL STYLES -->
<?php $__env->stopSection(); ?>
<?php $__env->startSection('content'); ?>
    <div class="row">
        <div class="col-md-12">
            <div class="portlet light ">
                <div class="portlet-title">
                    <div class="caption">
                        <i class="fa fa-plus font-purple-soft"></i>
                        <span class="caption-subject font-purple-soft bold uppercase"><?php echo e(trans(lang_app_site().'.CP.New Product')); ?></span>

                    </div>
                    <div class="actions">
                        <a href="<?php echo e(url()->current()); ?>" class="btn btn-circle btn-info">
                            <i class="fa fa-plus"></i>
                            <span class="hidden-xs"> <?php echo e(trans(lang_app_site().'.CP.New Product')); ?> </span>
                        </a>
                    </div>
                </div>
                
                <?php
                
                if(auth()->guard('admin')->user()->type == "admin" || auth()->guard('admin')->user()->type == "Superadmin"){
                      $EditView = admin_vw().'/'.$id.'/product/';
                   }else{ 
                        $EditView =  merchant_vw().'/product/';
                      }
                
                ?>
                

                <?php echo Form::open(['method'=>'POST','class'=>'form-horizontal form-bordered form-row-stripped','url'=>url($EditView),'id'=>'productAdd']); ?>


                <div class="alert alert-danger" style="display: none">

                </div>
                <div class="portlet-body">
                    <ul class="nav nav-tabs">
                        <li class="active">
                            <a href="#general" data-toggle="tab"> <?php echo e(trans(lang_app_site().'.CP.General')); ?> </a>
                        </li>
                        <li>
                            <a href="#customizations" data-toggle="tab"> <?php echo e(trans(lang_app_site().'.CP.Customizations')); ?></a>
                        </li>
                    </ul>
                    <div class="tab-content">
                        <div class="tab-pane fade  active in " id="general">

                            <div class="portlet-body form">
                                <style>
                                    .has_offer, .has_sponsor {
                                        display: none;
                                    }
                                </style>
                                <div class="row">
                                    <div class="col-md-12">
                                        <!-- BEGIN EXAMPLE TABLE PORTLET-->
                                        <div class="portlet box">

                                            <div class="portlet-body form">
                                                <div class="form-body">
                                                    
                                                    
                                                    <div class="form-group">
                                                        <div class="control-label col-md-2">
                                                            <label><?php echo e(trans(lang_app_site().'.CP.Product name')); ?></label>
                                                        </div>
                                                        <div class="col-md-2">
                                                            <input id="name" class="form-control"
                                                                   name="name" type="text"
                                                                   placeholder="Product name">
                                                        </div>
                                                        <div class="control-label col-md-2">
                                                            <label><?php echo e(trans(lang_app_site().'.CP.Price')); ?></label>
                                                        </div>
                                                        <div class="col-md-2">
                                                            <input id="price" class="form-control"
                                                                   name="price" type="number"
                                                                   placeholder="Price">
                                                        </div>
                                                        <div class="control-label col-md-2">
                                                            <label><?php echo e(trans(lang_app_site().'.CP.Quantity')); ?></label>
                                                        </div>
                                                        <div class="col-md-2">
                                                            <input id="original_quantity"
                                                                   class="form-control"
                                                                   name="original_quantity" type="number"
                                                                   placeholder="Quantity">
                                                        </div>


                                                    </div>


                                                    <div class="form-group">
                                                        <div class="control-label col-md-2">
                                                            <label><?php echo e(trans(lang_app_site().'.CP.Categories')); ?></label>
                                                        </div>
                                                        <div class="col-md-2">
                                                            <select class="form-control" name="category_id">
                                                                <?php $__currentLoopData = $categories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $category): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                                    <option value="<?php echo e($category->id); ?>"><?php echo e($category->name); ?></option>
                                                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                            </select>
                                                        </div>

                                                        <div class="control-label col-md-1">
                                                            <label><?php echo e(trans(lang_app_site().'.CP.Offer')); ?></label>
                                                        </div>
                                                        <div class="col-md-1">
                                                            <div class="md-checkbox"><input type="checkbox"
                                                                                            id="checkbox1"
                                                                                            name="is_offer"
                                                                                            data-value="0"
                                                                                            class="md-check is_offer"
                                                                                            data-id=""><label
                                                                        for="checkbox1"><span></span><span
                                                                            class="check"></span><span
                                                                            class="box"></span> </label>
                                                            </div>
                                                        </div>

                                                        <div class="control-label col-md-1 has_offer">
                                                            <label><?php echo e(trans(lang_app_site().'.CP.Offer')); ?> %</label>
                                                        </div>
                                                        <div class="col-md-1 has_offer">
                                                            <input id="offer_percentage"
                                                                   class="form-control"
                                                                   name="offer_percentage" type="number"
                                                                   placeholder="Offer %">
                                                        </div>

                                                        <div class="control-label col-md-1">
                                                            <label><?php echo e(trans(lang_app_site().'.CP.Sponsor')); ?></label>
                                                        </div>
                                                        <div class="col-md-1">
                                                            <div class="md-checkbox"><input type="checkbox"
                                                                                            id="checkbox2"
                                                                                            name="is_sponsor"

                                                                                            data-value="0"
                                                                                            class="md-check is_sponsor"
                                                                                            data-id=""><label
                                                                        for="checkbox2"><span></span><span
                                                                            class="check"></span><span
                                                                            class="box"></span> </label>
                                                            </div>
                                                        </div>

                                                        <div class="has_sponsor">
                                                            <div class="control-label col-md-1">
                                                                <label><?php echo e(trans(lang_app_site().'.CP.Duration (days)')); ?></label>
                                                            </div>
                                                            <div class="col-md-1 has_sponsor">
                                                                <input id="sponsor_duration"
                                                                       class="form-control"
                                                                       name="sponsor_duration" type="number"
                                                                       placeholder="Number of days">
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="form-group">
                                                        <div class="control-label col-md-2">
                                                            <label><?php echo e(trans(lang_app_site().'.CP.Description')); ?></label>
                                                        </div>
                                                        <div class="col-md-10">
                                                                        <textarea class="form-control" rows="6"
                                                                                  name="description"
                                                                                  id="description"></textarea>
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
                                                            <label><?php echo e(trans(lang_app_site().'.CP.Custom')); ?></label>
                                                        </div>
                                                        <div class="col-md-2">
                                                            <select class="form-control" id="custom_id">
                                                                <?php $__currentLoopData = $customizations; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $custom): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                                    <option value="<?php echo e($custom->id); ?>"><?php echo e($custom->name); ?></option>
                                                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                            </select>
                                                        </div>
                                                        <div class="control-label col-md-2">
                                                            <label><?php echo e(trans(lang_app_site().'.CP.Extra-Cost')); ?></label>
                                                        </div>
                                                        <div class="col-md-2">
                                                            <input class="form-control" type="number"
                                                                   id="price">
                                                        </div>
                                                        <div class="custom_color" style="display: none;">
                                                            <div class="control-label col-md-2">
                                                                <label><?php echo e(trans(lang_app_site().'.CP.Color')); ?></label>
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
                                                                <label><?php echo e(trans(lang_app_site().'.CP.Title')); ?></label>
                                                            </div>
                                                            <div class="col-md-2">
                                                                <input type="text" class="form-control title"
                                                                       name="title">
                                                            </div>

                                                        </div>
                                                    </div>

                                                </div>
                                                <div class="form-group">
                                                    <div class="control-label col-md-2">
                                                        <label><?php echo e(trans(lang_app_site().'.CP.Description')); ?></label>
                                                    </div>
                                                    <div class="col-md-2">
                                                        <input class="form-control" type="text"
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
                                               <?php echo e(trans(lang_app_site().'.CP.Add custom')); ?> 
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-12">
                                    <table class="table table-striped table-bordered table-hover table-checkable order-column">
                                        <thead>
                                        <tr>
                                            <th>#</th>
                                            
                                            <th><?php echo e(trans(lang_app_site().'.CP.Custom')); ?> </th>
                                            <th><?php echo e(trans(lang_app_site().'.CP.Title')); ?> /Color</th>
                                            <th><?php echo e(trans(lang_app_site().'.CP.Description')); ?> </th>
                                            <th><?php echo e(trans(lang_app_site().'.CP.Extra-Cost')); ?> </th>
                                            
                                            <th><?php echo e(trans(lang_app_site().'.CP.Action')); ?> </th>
                                        </tr>
                                        </thead>
                                        <tbody class="custom-row">

                                        </tbody>
                                    </table>

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
                                <?php echo e(trans(lang_app_site().'.CP.Save Product')); ?>

                            </button>
                        </div>
                    </div>
                </div>
                <?php echo Form::close(); ?>


                <div class="product-images" style="display: none;">

                    <div class="row store_images">
                        <div class="col-md-12">
                            <div class="portlet light ">
                                <div class="portlet-title">
                                    <div class="caption">
                                        <i class="fa fa-image font-dark"></i>
                                        <span class="caption-subject bold uppercase"><?php echo e(trans(lang_app_site().'.CP.Product Images')); ?> </span>
                                    </div>

                                </div>
                                <div class="portlet-body form">
                                    <div class="form-body">
                                    
                                    <?php echo Form::open(['method'=>'POST','url'=>url(merchant_store_url().'/add-product-images'),'id'=>'fileuploadProduct','files'=>true]); ?>

                                    <!-- The fileupload-buttonbar contains buttons to add/delete files and start/cancel the upload -->

                                        <div class="row fileupload-buttonbar">
                                            <div class="col-lg-7">
                                                <!-- The fileinput-button span is used to style the file input field as button -->
                                                <span class="btn green fileinput-button">
                                                <i class="fa fa-plus"></i>
                                                <span><?php echo e(trans(lang_app_site().'.CP.Add files')); ?>... </span>
                                                <input type="file" name="files[]" multiple=""> </span>
                                                
                                                
                                                
                                                
                                                <button type="reset" class="btn warning cancel">
                                                    <i class="fa fa-ban-circle"></i>
                                                    <span><?php echo e(trans(lang_app_site().'.CP.Cancel upload')); ?>  </span>
                                                </button>
                                            
                                            
                                            
                                            
                                            
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

                                        <?php echo Form::close(); ?>



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
                                        <span><?php echo e(trans(lang_app_site().'.CP.Start')); ?></span>
                                    </button> {% } %} {% if (!i) { %}
                                    <button class="btn red cancel">
                                        <i class="fa fa-ban"></i>
                                        <span><?php echo e(trans(lang_app_site().'.CP.Cancel')); ?></span>
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
                                        <span><?php echo e(trans(lang_app_site().'.CP.Delete')); ?></span>
                                    </button>
                                     {% } else { %}
                                    <button class="btn yellow cancel btn-sm">
                                        <i class="fa fa-ban"></i>
                                        <span><?php echo e(trans(lang_app_site().'.CP.Cancel')); ?></span>
                                    </button> {% } %} </td>
                            </tr> {% } %}

 </script>


                </div>
            </div>


        </div>
    </div>

<?php $__env->stopSection(); ?>
<?php $__env->startSection('js'); ?>

    <script src="<?php echo e(url('/')); ?>/assets/global/scripts/datatable.js" type="text/javascript"></script>
    <script src="<?php echo e(url('/')); ?>/assets/global/plugins/datatables/datatables.min.js" type="text/javascript"></script>
    <script src="<?php echo e(url('/')); ?>/assets/global/plugins/datatables/plugins/bootstrap/datatables.bootstrap.js"
            type="text/javascript"></script>

    <!-- BEGIN PAGE LEVEL PLUGINS -->
    <script src="<?php echo e(url('/')); ?>/assets/global/plugins/fancybox/source/jquery.fancybox.pack.js"
            type="text/javascript"></script>
    <script src="<?php echo e(url('/')); ?>/assets/global/plugins/jquery-file-upload/js/vendor/jquery.ui.widget.js"
            type="text/javascript"></script>
    <script src="<?php echo e(url('/')); ?>/assets/global/plugins/jquery-file-upload/js/vendor/tmpl.min.js"
            type="text/javascript"></script>
    <script src="<?php echo e(url('/')); ?>/assets/global/plugins/jquery-file-upload/js/vendor/load-image.min.js"
            type="text/javascript"></script>
    <script src="<?php echo e(url('/')); ?>/assets/global/plugins/jquery-file-upload/js/vendor/canvas-to-blob.min.js"
            type="text/javascript"></script>
    <script src="<?php echo e(url('/')); ?>/assets/global/plugins/jquery-file-upload/blueimp-gallery/jquery.blueimp-gallery.min.js"
            type="text/javascript"></script>
    <script src="<?php echo e(url('/')); ?>/assets/global/plugins/jquery-file-upload/js/jquery.iframe-transport.js"
            type="text/javascript"></script>
    <script src="<?php echo e(url('/')); ?>/assets/global/plugins/jquery-file-upload/js/jquery.fileupload.js"
            type="text/javascript"></script>
    <script src="<?php echo e(url('/')); ?>/assets/global/plugins/jquery-file-upload/js/jquery.fileupload-process.js"
            type="text/javascript"></script>
    <script src="<?php echo e(url('/')); ?>/assets/global/plugins/jquery-file-upload/js/jquery.fileupload-image.js"
            type="text/javascript"></script>
    <script src="<?php echo e(url('/')); ?>/assets/global/plugins/jquery-file-upload/js/jquery.fileupload-audio.js"
            type="text/javascript"></script>
    <script src="<?php echo e(url('/')); ?>/assets/global/plugins/jquery-file-upload/js/jquery.fileupload-video.js"
            type="text/javascript"></script>
    <script src="<?php echo e(url('/')); ?>/assets/global/plugins/jquery-file-upload/js/jquery.fileupload-validate.js"
            type="text/javascript"></script>
    <script src="<?php echo e(url('/')); ?>/assets/global/plugins/jquery-file-upload/js/jquery.fileupload-ui.js"
            type="text/javascript"></script>

    <script src="<?php echo e(url('/')); ?>/assets/global/plugins/bootstrap-colorpicker/js/bootstrap-colorpicker.js"
            type="text/javascript"></script>
    <script src="<?php echo e(url('/')); ?>/assets/global/plugins/jquery-minicolors/jquery.minicolors.min.js"
            type="text/javascript"></script>

    <!-- END PAGE LEVEL PLUGINS -->
    <script src="<?php echo e(url('/')); ?>/assets/global/plugins/jquery-ui/jquery-ui.min.js" type="text/javascript"></script>

    <!-- BEGIN THEME GLOBAL SCRIPTS -->
    <script src="<?php echo e(url('/')); ?>/assets/global/scripts/app.min.js" type="text/javascript"></script>
    <!-- END THEME GLOBAL SCRIPTS -->
    <script src="<?php echo e(url('/')); ?>/assets/pages/scripts/components-color-pickers.min.js" type="text/javascript"></script>

    <script src="<?php echo e(url('/')); ?>/assets/pages/scripts/table-datatables-responsive.min.js" type="text/javascript"></script>

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
    
    <script src="<?php echo e(url('/')); ?>/assets/js/products.js" type="text/javascript"></script>

    <!-- BEGIN PAGE LEVEL SCRIPTS -->

<?php $__env->stopSection(); ?>
<?php echo $__env->make($layoutView.'.index', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/saudidragonmart/public_html/resources/views/merchant/products/create.blade.php ENDPATH**/ ?>