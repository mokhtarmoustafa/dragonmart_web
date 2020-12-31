<!-- BEGIN PAGE LEVEL PLUGINS -->
<link href="<?php echo e(url('/')); ?>/assets/global/plugins/fancybox/source/jquery.fancybox.css" rel="stylesheet"
      type="text/css"/>
<link href="<?php echo e(url('/')); ?>/assets/global/plugins/jquery-file-upload/blueimp-gallery/blueimp-gallery.min.css"
      rel="stylesheet" type="text/css"/>
<link href="<?php echo e(url('/')); ?>/assets/global/plugins/jquery-file-upload/css/jquery.fileupload.css" rel="stylesheet"
      type="text/css"/>
<link href="<?php echo e(url('/')); ?>/assets/global/plugins/jquery-file-upload/css/jquery.fileupload-ui.css" rel="stylesheet"
      type="text/css"/>
<!-- END PAGE LEVEL PLUGINS -->

<div class="row store_images">
    <div class="col-md-12">
        <div class="portlet box red ">
            <div class="portlet-title">
                <div class="caption">
                    <i class=" font-dark"></i>
                    <span class="caption-subject bold uppercase"> Product Images</span>
                </div>

            </div>
            <div class="portlet-body form">
                <div class="form-body">
                
                <?php echo Form::open(['method'=>'POST','url'=>url(getAuth()->type.'/store/add-product-images/'.$product->id),'id'=>'fileuploadProduct','files'=>true]); ?>

                <!-- The fileupload-buttonbar contains buttons to add/delete files and start/cancel the upload -->

                    <div class="row fileupload-buttonbar">

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

                    <div class="form-actions save_operations" style="display: block;">
                        <div class="row">
                            <div class="col-md-12 text-center">
                                <button type="button" class="btn red btn-circle" data-dismiss="modal"><i
                                            class="fa fa-close"></i> Close
                                </button>
                            </div>
                        </div>
                    </div>
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
                               
                            </tr> {% } %}













</script>


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


<!-- END PAGE LEVEL PLUGINS -->
<script src="<?php echo e(url('/')); ?>/assets/global/plugins/jquery-ui/jquery-ui.min.js" type="text/javascript"></script>

<!-- BEGIN THEME GLOBAL SCRIPTS -->
<script src="<?php echo e(url('/')); ?>/assets/global/scripts/app.min.js" type="text/javascript"></script>
<!-- END THEME GLOBAL SCRIPTS -->
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
<!-- BEGIN PAGE LEVEL SCRIPTS --><?php /**PATH /home/saudidragonmart/public_html/resources/views/merchant/partial/product-images-view.blade.php ENDPATH**/ ?>