<?php $__env->startSection('css'); ?>
    <!-- BEGIN PAGE LEVEL PLUGINS -->
    <link href="<?php echo e(url('/')); ?>/assets/global/plugins/datatables/datatables.min.css" rel="stylesheet" type="text/css"/>
    <link href="<?php echo e(url('/')); ?>/assets/global/plugins/datatables/plugins/bootstrap/datatables.bootstrap.css"
          rel="stylesheet" type="text/css"/>
    <!-- END PAGE LEVEL PLUGINS -->
    <link href="<?php echo e(url('/')); ?>/assets/global/plugins/jquery-file-upload/blueimp-gallery/blueimp-gallery.min.css"
          rel="stylesheet" type="text/css"/>
    <link href="<?php echo e(url('/')); ?>/assets/global/plugins/jquery-file-upload/css/jquery.fileupload.css" rel="stylesheet"
          type="text/css"/>
    <link href="<?php echo e(url('/')); ?>/assets/global/plugins/jquery-file-upload/css/jquery.fileupload-ui.css" rel="stylesheet"
          type="text/css"/>
    <link href="<?php echo e(url('/')); ?>/assets/global/plugins/bootstrap-fileinput/bootstrap-fileinput.css" rel="stylesheet"
          type="text/css"/>
    <!-- BEGIN THEME GLOBAL STYLES -->
    <link href="<?php echo e(url('/')); ?>/assets/global/plugins/select2/css/select2.min.css" rel="stylesheet" type="text/css"/>
    <link href="<?php echo e(url('/')); ?>/assets/global/plugins/select2/css/select2-bootstrap.min.css" rel="stylesheet"
          type="text/css"/>
    <link href="<?php echo e(url('/')); ?>/assets/global/css/components-md.min.css" rel="stylesheet" id="style_components"
          type="text/css"/>
    <link href="<?php echo e(url('/')); ?>/assets/global/css/plugins-md.min.css" rel="stylesheet" type="text/css"/>
    <!-- END THEME GLOBAL STYLES -->

<?php $__env->stopSection(); ?>
<?php $__env->startSection('content'); ?>

    <div class="portlet light ">
        <div class="portlet-title">
            <div class="caption font-dark">
                <i class="<?php echo e($icon); ?> font-dark"></i>
                <span class="caption-subject bold uppercase"> <?php echo e($main_title); ?></span>
            </div>

        </div>

        <div class="portlet-body box form">
            <div class="row">
                <div class="col-md-12">
                    <?php echo Form::open(['method'=>'PUT','class'=>'form-horizontal form-bordered form-row-stripped','url'=>url(merchant_vw().'/profile'),'files'=>true,'id'=>'editProfile']); ?>

                    <div class="portlet light ">

                        <div class="portlet-body">
                            <ul class="nav nav-tabs">

                                <li class="active">
                                    <a href="#information" data-toggle="tab"> Shop information </a>
                                </li>
                                <li>
                                    <a href="#categories" data-toggle="tab"> Provided categories </a>
                                </li>
                                <li>
                                    <a href="#commission" data-toggle="tab"> Commission rate </a>
                                </li>
                                <li>
                                    <a href="#delivery_method" data-toggle="tab"> Delivery method</a>
                                </li>
                                <li>
                                    <a href="#bank_info" data-toggle="tab"> Bank Information</a>
                                </li>


                            </ul>
                            <div class="tab-content">

                                <div class="tab-pane fade  active in " id="information">

                                    <div class="portlet-body form">

                                        <div class="form-body form-bordered form-row-stripped">
                                            <div class="form-group">
                                                <div class="control-label col-md-2">
                                                    <label>Shop name</label>
                                                </div>
                                                <div class="col-md-2">
                                                    <input id="username" class="form-control"
                                                           name="username" type="text"
                                                           placeholder="Shop name"
                                                           value="<?php echo e(getAuth()->merchant->username); ?>">
                                                </div>

                                                <div class="control-label col-md-2">
                                                    <label>Shop city</label>
                                                </div>
                                                <div class="col-md-2">
                                                    <select class="form-control select2" name="city_id">
                                                        <?php $__currentLoopData = $cities; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $city): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                            <option value="<?php echo e($city->id); ?>"
                                                                    <?php if($city->id == getAuth()->merchant->city_id): ?> selected <?php endif; ?>><?php echo e($city->name_en); ?></option>
                                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                    </select>
                                                </div>

                                                <div class="control-label col-md-2">
                                                    <label>Email</label>
                                                </div>
                                                <div class="col-md-2">
                                                    <input id="email"
                                                           class="form-control" type="email" disabled
                                                           placeholder="E-mail" value="<?php echo e(getAuth()->merchant->email); ?>">
                                                </div>
                                                <div class="control-label col-md-2">
                                                    <label>Phone</label>
                                                </div>
                                                <div class="col-md-2">
                                                    <input class="form-control"
                                                           name="mobile" type="text"
                                                           id="mobile" placeholder="Phone"
                                                           value="<?php echo e(getAuth()->merchant->mobile); ?>">
                                                </div>


                                                <div class="form-group">
                                                    <div class="control-label col-md-2">
                                                        <label>Shop address</label>
                                                    </div>
                                                    <div class="col-md-2">
                                                        <a href="<?php echo e(url(getAuth()->type.'/user/'.getAuth()->user_id)); ?>"
                                                           class="btn btn-circle btn-icon-only blue" id="merchant-det"
                                                           title="Address">
                                                            <i class="fa fa-map"></i>
                                                        </a>
                                                    </div>
                                                    <div class="col-md-2">
                                                        <span class="address"></span>
                                                        
                                                        
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <div class="control-label col-md-2">
                                                        <label>Description</label>
                                                    </div>
                                                    <div class="col-md-10">
                                                        <textarea id="email"
                                                                  class="form-control" id="description"
                                                                  name="description"
                                                                  rows="5"></textarea>
                                                    </div>
                                                </div>
                                            </div>


                                        </div>
                                    </div>
                                </div>

                                <div class="tab-pane fade" id="commission">

                                    <div class="portlet-body form">
                                        <div class="form-body">
                                            <div class="form-group">
                                                <div class="control-label col-md-2">
                                                    <label for="commission_rate">Commission rate (%)</label>
                                                </div>
                                                <div class="col-md-6">
                                                    <input class="form-control" disabled
                                                           value="<?php echo e(getAuth()->merchant->commission_rate); ?>"
                                                           placeholder="20%">
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <div class="control-label col-md-2">
                                                    <label for="commission_rate">Refund commission rate (%)</label>
                                                </div>
                                                <div class="col-md-6">
                                                    <input class="form-control" name="refund_commission_rate"
                                                           value="<?php echo e(getAuth()->merchant->refund_commission_rate); ?>"
                                                           placeholder="20%">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="tab-pane fade" id="categories">

                                    <div class="portlet-body form">

                                        <div class="form-body">

                                            <div class="form-group">
                                                <div class="control-label col-md-2">
                                                    <label>Categories</label>
                                                </div>
                                                <div class="col-md-10">
                                                    <select class="form-control select2"
                                                            name="categories[]" multiple>
                                                        <?php $__currentLoopData = $categories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $category): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                            <option
                                                                <?php if(isset($store) && in_array($category->id,$store->Categories->pluck('id')->toArray())): ?> selected
                                                                <?php endif; ?> value="<?php echo e($category->id); ?>"><?php echo e($category->name); ?></option>
                                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                    </select>
                                                </div>
                                            </div>

                                        </div>
                                    </div>
                                </div>
                                <div class="tab-pane fade" id="delivery_method">

                                    <div class="portlet-body form">

                                        <div class="form-body">

                                            <div class="form-group">
                                                <div class="control-label col-md-2">
                                                    <label>Delivery method</label>
                                                </div>
                                                <div class="col-md-10">
                                                    <select class="form-control select2"
                                                            name="driver_methods[]" multiple>
                                                        <?php $__currentLoopData = $driver_methods; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $driver_method): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                            <option value="<?php echo e($driver_method->id); ?>"
                                                                    selected><?php echo e($driver_method->name); ?></option>
                                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                    </select>
                                                </div>
                                            </div>

                                        </div>
                                    </div>
                                </div>
                                <div class="tab-pane fade" id="bank_info">

                                    <div class="portlet-body form">

                                        <div class="form-body">

                                            <div class="form-group">
                                                <div class="control-label col-md-2">
                                                    <label>Bank name</label>
                                                </div>
                                                <div class="col-md-2">
                                                    <input id="bank_name" class="form-control"
                                                           name="bank_name" type="text"
                                                           placeholder="Bank name"
                                                           value="<?php echo e(getAuth()->bank->bank_name ?? ''); ?>">
                                                </div>
                                                <div class="control-label col-md-2">
                                                    <label>Branch name</label>
                                                </div>
                                                <div class="col-md-2">
                                                    <input id="branch_code" class="form-control"
                                                           name="branch_code" type="text"
                                                           placeholder="Branch code"
                                                           value="<?php echo e(getAuth()->bank->branch_code ?? ''); ?>">
                                                </div>
                                                <div class="control-label col-md-2">
                                                    <label>Account name</label>
                                                </div>
                                                <div class="col-md-2">
                                                    <input id="account_name" class="form-control"
                                                           name="account_name" type="text"
                                                           placeholder="Account name"
                                                           value="<?php echo e(getAuth()->bank->account_name ?? ''); ?>">
                                                </div>
                                                <div class="control-label col-md-2">
                                                    <label>Account number</label>
                                                </div>
                                                <div class="col-md-2">
                                                    <input id="account_number" class="form-control"
                                                           name="account_number" type="text"
                                                           placeholder="Account number"
                                                           value="<?php echo e(getAuth()->bank->account_number ?? ''); ?>">
                                                </div>
                                                <div class="control-label col-md-2">
                                                    <label>Bank address</label>
                                                </div>
                                                <div class="col-md-6">
                                                    <input id="bank_address" class="form-control"
                                                           name="bank_address" type="text"
                                                           placeholder="Account number"
                                                           value="<?php echo e(getAuth()->bank->bank_address ?? ''); ?>">
                                                </div>
                                            </div>

                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="clearfix margin-bottom-20"></div>
                        </div>
                    </div>
                    <div class="form-actions save_operations" style="display: block;">
                        <div class="row">
                            <div class="col-md-12 text-center">
                                <button type="submit" class="btn btn-circle green save"><i
                                        class="fa fa-check"></i>
                                    Save
                                </button>
                            </div>
                        </div>
                    </div>
                    <?php echo Form::close(); ?>

                    <div class="row store_images">
                        <div class="col-md-12">
                            <div class="portlet light ">
                                <div class="portlet-title">
                                    <div class="caption">
                                        <i class="fa fa-image font-dark"></i>
                                        <span class="caption-subject bold uppercase"> Shop Images</span>
                                    </div>

                                </div>
                                <div class="portlet-body form">

                                    <div class="form-body form-bordered form-row-stripped">
                                        <div class="form-body">
                                        
                                        <?php echo Form::open(['method'=>'POST','url'=>url(merchant_store_url().'/images'),'id'=>'fileuploadStore','files'=>true]); ?>

                                        <!-- The fileupload-buttonbar contains buttons to add/delete files and start/cancel the upload -->

                                            <div class="row fileupload-buttonbar">
                                                <div class="col-lg-7">
                                                    <!-- The fileinput-button span is used to style the file input field as button -->
                                                    <span class="btn green fileinput-button">
                                                <i class="fa fa-plus"></i>
                                                <span> Add files... </span>
                                                <input type="file" name="files[]" multiple=""> </span>
                                                    
                                                    
                                                    
                                                    
                                                    <button type="reset"
                                                            class="btn warning cancel">
                                                        <i class="fa fa-ban-circle"></i>
                                                        <span> Cancel upload </span>
                                                    </button>
                                                
                                                
                                                
                                                
                                                
                                                <!-- The global file processing state -->
                                                    <span class="fileupload-process"> </span>
                                                </div>
                                                <!-- The global progress information -->
                                                <div class="col-lg-5 fileupload-progress fade">
                                                    <!-- The global progress bar -->
                                                    <div class="progress progress-striped active"
                                                         role="progressbar"
                                                         aria-valuemin="0" aria-valuemax="100">
                                                        <div class="progress-bar progress-bar-success"
                                                             style="width:0%;"></div>
                                                    </div>
                                                    <!-- The extended global progress information -->
                                                    <div class="progress-extended"> &nbsp;</div>
                                                </div>
                                            </div>
                                            <!-- The table listing the files available for upload/download -->
                                            <table role="presentation"
                                                   class="table table-striped clearfix">
                                                <tbody class="files"></tbody>
                                            </table>

                                            <?php echo Form::close(); ?>



                                        </div>


                                        <!-- The blueimp Gallery widget -->
                                        <div id="blueimp-gallery"
                                             class="blueimp-gallery blueimp-gallery-controls"
                                             data-filter=":even">
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
                    </div>
                </div>
            </div>

        </div>
    </div>
    <?php echo $__env->make('admin.modals.edit_map', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

<?php $__env->stopSection(); ?>

<?php $__env->startSection('js'); ?>

    <!-- BEGIN PAGE LEVEL PLUGINS -->
    <script src="<?php echo e(url('/')); ?>/assets/global/scripts/datatable.js" type="text/javascript"></script>
    <script src="<?php echo e(url('/')); ?>/assets/global/plugins/datatables/datatables.min.js" type="text/javascript"></script>
    <script src="<?php echo e(url('/')); ?>/assets/global/plugins/datatables/plugins/bootstrap/datatables.bootstrap.js"
            type="text/javascript"></script>
    <!-- END PAGE LEVEL PLUGINS -->
    <script src="<?php echo e(url('/')); ?>/assets/global/plugins/select2/js/select2.full.min.js" type="text/javascript"></script>

    
    <script src="<?php echo e(url('/')); ?>/assets/global/plugins/jquery-ui/jquery-ui.min.js" type="text/javascript"></script>
    <script src="<?php echo e(url('/')); ?>/assets/global/plugins/bootstrap-fileinput/bootstrap-fileinput.js"
            type="text/javascript"></script>
    <!-- BEGIN THEME GLOBAL SCRIPTS -->


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

    <script src="<?php echo e(url('/')); ?>/assets/global/scripts/app.min.js" type="text/javascript"></script>
    <!-- END THEME GLOBAL SCRIPTS -->
    

    <script src="<?php echo e(url('/')); ?>/assets/pages/scripts/ui-modals.min.js" type="text/javascript"></script>

    <!-- BEGIN PAGE LEVEL SCRIPTS -->
    <script src="<?php echo e(url('/')); ?>/assets/pages/scripts/table-datatables-responsive.min.js" type="text/javascript"></script>
    <script src="<?php echo e(url('/')); ?>/assets/pages/scripts/components-select2.min.js" type="text/javascript"></script>

    
    <!-- END PAGE LEVEL SCRIPTS -->

    <script src="<?php echo e(url('/')); ?>/assets/js/users.js" type="text/javascript"></script>
    <script src="<?php echo e(url('/')); ?>/assets/js/stores.js" type="text/javascript"></script>
    <script>
        var FormFileUpload = function () {
            return {
                init: function () {
                    $("#fileuploadStore").fileupload({
                        disableImageResize: !1,
                        autoUpload: !1,
                        disableImageResize: /Android(?!.*Chrome)|Opera/.test(window.navigator.userAgent),
                        maxFileSize: 5e6,
                        acceptFileTypes: /(\.|\/)(gif|jpe?g|png)$/i
                    }), $("#fileuploadStore").fileupload("option", "redirect", window.location.href.replace(/\/[^\/]*$/, "/cors/result.html?%s")), $.support.cors && $.ajax({type: "HEAD"}).fail(function () {
                        $('<div class="alert alert-danger"/>').text("Upload server currently unavailable - " + new Date).appendTo("#fileuploadStore")
                    }), $("#fileuploadStore").addClass("fileupload-processing"),

                        $.ajax({
                            url: $("#fileuploadStore").attr("action"),
                            dataType: "json",
                            context: $("#fileuploadStore")[0],
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

    <script>

        // $('.select2').select2({
        //     placeholder: "Select...",
        //     allowClear: true
        // });
        $(".date-picker").datepicker({
            rtl: App.isRTL(),
            dateFormat: "mm/dd/yy",
            showOtherMonths: true,
            selectOtherMonths: true,
            autoclose: true,
            changeMonth: true,
            changeYear: true,
            orientation: "below"
        });
    </script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make(merchant_layout_vw().'.index', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/saudidragonmart/public_html/resources/views/merchant/profile.blade.php ENDPATH**/ ?>