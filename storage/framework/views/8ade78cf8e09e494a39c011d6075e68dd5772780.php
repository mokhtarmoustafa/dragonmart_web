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


    <link href="<?php echo e(url('/')); ?>/assets/global/plugins/bootstrap-colorpicker/css/colorpicker.css" rel="stylesheet"
          type="text/css"/>
    <link href="<?php echo e(url('/')); ?>/assets/global/plugins/jquery-minicolors/jquery.minicolors.css" rel="stylesheet"
          type="text/css"/>
    <link href="<?php echo e(url('/')); ?>/assets/global/css/plugins-md.min.css" rel="stylesheet" type="text/css"/>
    <!-- END THEME GLOBAL STYLES -->
<?php $__env->stopSection(); ?>
<?php $__env->startSection('content'); ?>


<div class="card card-custom">

  <div class="card-header">

    <div class="card-title">
      <h3 class="card-label"><?php echo e(trans(lang_app_site().'.CP.Edit product')); ?>

      </div>

      <div class="card-toolbar">
        <a href="<?php echo e(url('merchant/product/create')); ?>" class="btn btn-circle btn-primary add-category-mdl" >
          <i class="fa fa-plus"></i>
          <span class="hidden-xs"> <?php echo e(trans(lang_app_site().'.CP.New Product')); ?>  </span>
        </a>
      </div>
    </div>
    <div class="card-body">
      <?php

      if(auth()->guard('admin')->user()->type == "admin" || auth()->guard('admin')->user()->type == "Superadmin"){
            $EditView = admin_vw().'/product/'.$product->id;
         }else{
              $EditView =  merchant_url().'/product/'.$product->id;
            }

      ?>

      <?php echo Form::open(['method'=>'PUT','class'=>'form-horizontal form-bordered form-row-stripped', 'url'=>url($EditView),'id'=>'productEdit']); ?>

      <ul class="nav nav-tabs" id="myTab" role="tablist">
        <li class="nav-item">
          <a class="nav-link active" id="general-tab" data-toggle="tab" href="#general">
            <span class="nav-icon">
              <i class="flaticon2-shopping-cart"></i>
            </span>
            <span class="nav-text"><?php echo e(trans(lang_app_site().'.CP.General')); ?></span>
          </a>
        </li>
        <li class="nav-item">
          <a class="nav-link" id="customizations-tab" data-toggle="tab" href="#customizations" aria-controls="profile">
            <span class="nav-icon">
              <i class="flaticon2-layers-1"></i>
            </span>
            <span class="nav-text"><?php echo e(trans(lang_app_site().'.CP.Customizations')); ?></span>
          </a>
        </li>
      </ul>
      <div class="tab-content p-5 bg-white" id="myTabContent">

        <div class="tab-pane show active" id="general">

          <div class="form-body">
            
            

              <div class="form-group row">
                <div class="col-lg-4">
                  <label><?php echo e(trans(lang_app_site().'.CP.Product name')); ?></label>
                  <input id="name" class="form-control" name="name" type="text" placeholder="Product name" value="<?php echo e($product->name); ?>">
                </div>
                <div class="col-lg-4">
                  <label><?php echo e(trans(lang_app_site().'.CP.Price')); ?></label>
                  <input id="price" class="form-control" name="price" type="number" step=".01" placeholder="Price" value="<?php echo e($product->price); ?>">
                </div>
                <div class="col-lg-4">
                  <label><?php echo e(trans(lang_app_site().'.CP.Quantity')); ?></label>
                  <input id="original_quantity" class="form-control" name="original_quantity" type="number" placeholder="Quantity" value="<?php echo e($product->original_quantity); ?>">
                </div>
              </div>

              <div class="form-group row">
                <div class="col-lg-4">
                  <label><?php echo e(trans(lang_app_site().'.CP.Categories')); ?></label>
                  <select class="form-control" name="category_id">
                    <?php $__currentLoopData = $categories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $category): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <option value="<?php echo e($category->id); ?>" <?php if($product->category_id == $category->id): ?> selected <?php endif; ?> ><?php echo e($category->name); ?></option>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                  </select>
                </div>
                <div class="col-lg-4">
                  <label><?php echo e(trans(lang_app_site().'.CP.Offer')); ?></label>
                  <div class="input-group">
                    <div class="input-group-prepend">
                      <span class="input-group-text">
                        <label class="checkbox checkbox-inline checkbox-success">
                          <input type="checkbox" id="checkbox1" class="is_offer">
                          <span></span>
                        </label>
                      </span>
                    </div>
                    <input id="offer_percentage" class="form-control" name="offer_percentage" type="number" placeholder="Offer %" disabled>
                    <div class="input-group-append">
                      <span class="input-group-text">%</span>
                    </div>
                  </div>

                </div>
                <div class="col-lg-4">
                  <label><?php echo e(trans(lang_app_site().'.CP.Sponsor')); ?></label>
                  <div class="input-group">
                    <div class="input-group-prepend">
                      <span class="input-group-text">
                        <label class="checkbox checkbox-inline checkbox-success">
                          <input class="is_sponsor" <?php if($product->is_sponsor): ?> checked data-value="1" <?php else: ?> data-value="0" <?php endif; ?> type="checkbox" id="checkbox2">
                          <span></span>
                        </label>
                      </span>
                    </div>
                    <input id="sponsor_duration" class="form-control" name="sponsor_duration" type="number" placeholder="Number of days" <?php if($product->is_sponsor): ?> value="Number of days"  <?php else: ?> disabled <?php endif; ?> >
                    <div class="input-group-append">
                      <span class="input-group-text"><?php echo e(trans(lang_app_site().'.CP.Days')); ?></span>
                    </div>
                  </div>

                </div>

              </div>
              <div class="form-group row">
                <div class="col-lg-12">
                  <label><?php echo e(trans(lang_app_site().'.CP.Description')); ?></label>
                  <textarea class="form-control" rows="6" name="description" id="description"><?php echo e($product->description); ?></textarea>
                </div>
              </div>

            </div>
          </div>

          <div class="tab-pane fade" id="customizations">

            <div class="product-tab2" id="product_options_tab2">
              <div class="alert alert-info no-border mb-10">
                <div class="align-justify">
                  <i class="bx bx-warning"></i> <strong>ملاحظة هامة</strong><br>السعر الإضافي للخيار هو المبلغ الذي سيضاف للسعر الأساسي للمنتج عند اختيار العميل لهذا الخيار. على سبيل المثال: إذا كان سعر المنتج 10ر.س والسعر الإضافي للخيار 5ر.س سيصبح السعر النهائي 15ر.س<br>علماً أن السعر والكمية اختيارية إن وجدت
                </div>
              </div>
              <div id="options_list" class="rec-options-list">
                <?php
$n = 0 ;
if($product->custom){
foreach($product->custom as $opt){
                ?>
                <div class="option-section w-100" id="option_section_0">
                  <div class="row padding-sm">
                    <div class="col-md-3">
                      <div class="form-group">
                        <div class="input-group">
                          <span class="input-group-addon input-group-addon-small"><i class="sicon-type-square"></i></span>
                          <select id="option_group_type_" type="text" class="form-control option_group_type product_price_ option_group_cls" onchange="ChangeType(null , this)" name="custom[<?php echo e($n); ?>][type]">
                            <option value="text"  <?php if($opt['type'] == 'text'): ?> selected <?php endif; ?> >text</option>
                            <option value="color" <?php if($opt['type'] == 'color'): ?> selected <?php endif; ?> >color</option>
                          </select>

                        </div>
                      </div>
                    </div>
                    <div class="col-md-3">
                      <div class="form-group">
                        <div class="input-group">
                          <span class="input-group-addon input-group-addon-small"><i class="sicon-type-square"></i></span>
                          <input id="option_group_name_" type="text" class="form-control option_group_name product_price_ option_group_cls" placeholder="مسمى الخيار (مثل اللون، المقاس، ..)" value="<?php echo e($opt['name']); ?>" name="custom[<?php echo e($n); ?>][name]">
                        </div>
                      </div>
                    </div>
                    <div class="col-md-2">
                      <div class="form-group">
                        <div class="input-group">
                          <span class="input-group-addon input-group-addon-small"><i class="sicon-type-square"></i></span>
                          <input id="option_group_min_" type="number" class="form-control option_group_min product_price_ option_group_cls" placeholder="الحد الأدني للإختيار" value="<?php echo e($opt['min']); ?>" name="custom[<?php echo e($n); ?>][min]" min="0">
                        </div>
                      </div>
                    </div>
                    <div class="col-md-2">
                      <div class="form-group">
                        <div class="input-group">
                          <span class="input-group-addon input-group-addon-small"><i class="sicon-type-square"></i></span>
                          <input id="option_group_max_" type="number" class="form-control option_group_max product_price_ option_group_cls" placeholder="الحد الأعلى للإختيار" value="<?php echo e($opt['max']); ?>" name="custom[<?php echo e($n); ?>][max]" min="1">
                        </div>
                      </div>
                    </div>
                    <input type="hidden" id="option_group_feature_type_" value="text">
                    <div class="col-md-2 col-xs-3">
                      <div class="form-group">
                        <button class="btn btn-danger btn-wide btn-block" type="button" id="remove_option" onclick="delOptions(0,0)"> حذف</button>
                      </div>
                    </div>
                  </div>

                  <div class="option-options w-100" id="option-options_<?php echo e($n); ?>">
                    <?php
                                  $i = 0 ;
                                  $options = json_decode($opt['options'], true);
                                  foreach($options as $option){
                    ?>

                    <div class="row">
                      <div class="col-md-6">
                        <div class="form-group">
                          <div class="input-group">
                            <input id="product_name_0" type="<?php echo e($opt['type']); ?>" class="form-control option_details_name product_name_0 option_values_cls" placeholder="خيار <?php echo e($n); ?>" value="<?php echo e($option['details_name']); ?>" name="custom[<?php echo e($n); ?>][option][<?php echo e($i); ?>][details_name]">
                          </div>
                        </div>
                      </div>
                      <div class="col-md-6">
                        <div class="form-group">
                          <div class="input-group">
                            <div class="input-group-prepend">
                              <span class="input-group-text" id="basic-addon2">
                              <i class="las la-dollar-sign"></i>
                              </span>
                            </div>
                            <input id="product_price_0" type="text" class="form-control product_price_0  _parseArabicNumbers" placeholder="السعر الإضافي" value="<?php echo e($option['details_price']); ?>" name="custom[<?php echo e($n); ?>][option][<?php echo e($i); ?>][details_price]">
                          </div>
                        </div>
                      </div>
                    </div>
                      <?php $i++; } ?>
                  </div>
                  <button type="button" id="add_option" class="btn btn-info mt-1" onclick="addOption(<?php echo e($n); ?>)"> إضافة خيار </button>
                </div>
                <?php $n++; } } ?>
              </div>
                <div class="row mt-1 ">
                  <div class="px-1 w-100">
                    <button type="button" id="add_option_group" onclick="addOptionGroup()" class="btn btn-dark btn-block text-center white" >
                      <i class="fa fa-plus"></i>
                    </button>
                  </div>
                </div>
              <div class="option-section w-100 clone_option_group hidden">
                <div class="row padding-sm">
                  <div class="col-md-3">
                    <div class="form-group">
                      <div class="input-group">
                        <span class="input-group-addon input-group-addon-small"><i class="sicon-type-square"></i></span>
                        <select id="option_group_type_" type="text" class="form-control option_group_type product_price_ option_group_cls" onchange="ChangeType(null , this)">
                          <option value="text">text</option>
                          <option value="color">color</option>
                        </select>

                      </div>
                    </div>
                  </div>
                  <div class="col-md-3">
                    <div class="form-group">
                      <div class="input-group">
                        <span class="input-group-addon input-group-addon-small"><i class="sicon-type-square"></i></span>
                        <input id="option_group_name_" type="text" class="form-control option_group_name product_price_ option_group_cls" placeholder="مسمى الخيار (مثل اللون، المقاس، ..)" value="">
                      </div>
                    </div>
                  </div>
                  <div class="col-md-2">
                    <div class="form-group">
                      <div class="input-group">
                        <span class="input-group-addon input-group-addon-small"><i class="sicon-type-square"></i></span>
                        <input id="option_group_min_" type="number" class="form-control option_group_min product_price_ option_group_cls" placeholder="الحد الأدني للإختيار" value="" min="1">
                      </div>
                    </div>
                  </div>
                  <div class="col-md-2">
                    <div class="form-group">
                      <div class="input-group">
                        <span class="input-group-addon input-group-addon-small"><i class="sicon-type-square"></i></span>
                        <input id="option_group_max_" type="number" class="form-control option_group_max product_price_ option_group_cls" placeholder="الحد الأعلى للإختيار" value="" min="1">
                      </div>
                    </div>
                  </div>
                  <input type="hidden" id="option_group_feature_type_" value="text">
                  <div class="col-md-2 col-xs-3">
                    <div class="form-group">
                      <button class="btn btn-danger btn-wide btn-block" type="button" id="remove_option"> حذف</button>
                    </div>
                  </div>
                </div>
                <div class="option-options w-100" id="option-options_">
                  <div class="row">
                    <div class="col-md-6">
                      <div class="form-group">
                        <div class="input-group">
                          <input id="product_name_0" type="text" class="form-control option_details_name product_name_0 option_values_cls" placeholder="خيار 1" value="">
                        </div>
                      </div>
                    </div>
                    <div class="col-md-6">
                      <div class="form-group">
                        <div class="input-group">
                          <div class="input-group-prepend">
                            <span class="input-group-text" id="basic-addon2">
                            <i class="las la-dollar-sign"></i>
                            </span>
                          </div>
                          <input id="product_price_0" type="text" class="form-control product_price_0  _parseArabicNumbers" placeholder="السعر الإضافي" value="" style="background: ">
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
                <button type="button" id="add_option" class="btn btn-info mt-1"> إضافة خيار </button>
              </div>
              <div class="clone_option hidden option-container row">
                <div class="col-md-6">
                  <div class="form-group">
                    <div class="input-group">
                      <input id="product_name_" type="text" class="form-control option_details_name product_name_ option_values_cls" placeholder="خيار 1" value="">
                    </div>
                  </div>
                </div>
                <div class="col-md-6">
                  <div class="form-group">
                    <div class="input-group">
                      <div class="input-group-prepend">
                        <span class="input-group-text" id="basic-addon2">
                          <i class="las la-dollar-sign"></i>
                        </span>
                      </div>
                      <input id="product_price_" type="text" class="form-control product_price_  _parseArabicNumbers" placeholder="السعر الإضافي" value="" style="background: ">
                    </div>
                  </div>
                </div>
              </div>


            </div>
          </div>

        </div>

        <div class="form-actions save_operations" style="display: block;">
          <div class="row">
            <div class="col-md-12 text-center">
              <button type="submit" class="btn btn-circle btn-info save">
                <i class="fa fa-check"></i>
                <?php echo e(trans(lang_app_site().'.CP.Save Product')); ?>

              </button>
            </div>
          </div>
        </div>
        <?php echo Form::close(); ?>




      </div>
    </div>

    <div class="card card-custom mt-10">

<div class="card-header">

  <div class="card-title">
    <h3 class="card-label"><?php echo e(trans(lang_app_site().'.CP.Product Images')); ?></h3>



  </div>

</div>
        <div class="card-body">
          <div class="product-images">

              <div class="row store_images">
                  <div class="col-md-12">
                      <div class="portlet light ">
                          <div class="portlet-title">

                          <div class="portlet-body form">
                              <div class="form-body">
                                    <?php
                                    if(auth()->guard('admin')->user()->type == "admin" || auth()->guard('admin')->user()->type == "Superadmin"){
                                      $EditView = admin_vw().'/add-product-images/'.$product->id;
                                    }else{
                                      $EditView =  merchant_url().'/add-product-images/'.$product->id;
                                    }
                                    ?>

                              
                              <?php echo Form::open(['method'=>'POST','url'=>url($EditView),'id'=>'fileuploadProduct','files'=>true]); ?>

                              <!-- The fileupload-buttonbar contains buttons to add/delete files and start/cancel the upload -->

                                  <div class="fileupload-buttonbar">

                                    <span class="btn btn-circle btn-primary fileinput-button">
                                      <i class="fa fa-plus"></i>
                                      <span><?php echo e(trans(lang_app_site().'.CP.Add files')); ?></span>
                                      <input type="file" name="files[]" multiple="">
                                    </span>
                                    <button type="reset" class="btn btn-circle btn-danger cancel">
                                        <i class="fa fa-ban-circle"></i>
                                        <span><?php echo e(trans(lang_app_site().'.CP.Cancel upload')); ?></span>
                                    </button>
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

    <!-- BEGIN JAVASCRIPTS(Load javascripts at bottom, this will reduce page load time) -->
    <script id="template-upload" type="text/x-tmpl"> {% for (var i=0, file; file=o.files[i]; i++) { %}
            <tr class="template-upload ">
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
                    <button class="btn btn-info start" disabled>
                        <i class="fa fa-upload"></i>
                        <span><?php echo e(trans(lang_app_site().'.CP.Start')); ?></span>
                    </button> {% } %} {% if (!i) { %}
                    <button class="btn btn-danger cancel">
                        <i class="fa fa-ban"></i>
                        <span><?php echo e(trans(lang_app_site().'.CP.Cancel')); ?></span>
                    </button> {% } %} </td>
            </tr> {% } %}
</script>
    <!-- The template to display files available for download -->
    <script id="template-download" type="text/x-tmpl"> {% for (var i=0, file; file=o.files[i]; i++) { %}
            <tr class="template-download">
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
                    <button class="btn btn-danger {%=file.deleteClass%} btn-sm" data-type="{%=file.deleteType%}" data-url="{%=file.deleteUrl%}" {% if (file.deleteWithCredentials) { %} data-xhr-fields='{"withCredentials":true}' {% } %}>
                        <i class="fa fa-trash-o"></i>
                        <span><?php echo e(trans(lang_app_site().'.CP.Delete')); ?></span>
                    </button>
                     {% } else { %}
                    <button class="btn btn-warning cancel btn-sm">
                        <i class="fa fa-ban"></i>
                        <span><?php echo e(trans(lang_app_site().'.CP.Cancel')); ?></span>
                    </button> {% } %} </td>
            </tr> {% } %}
</script>


    <script>

    function addOptionGroup(Optn = "" ,Opti = ""){
      var div_num = $('#options_list .option-section').length ;
      var $option_group_row = $('.clone_option_group').clone();
      $option_group_row.removeClass('hidden clone_option_group').attr("id",'option_section_'+div_num);
      $option_group_row.find("#option_group_type_").attr("id",'option_group_type_'+div_num).attr("name",(Optn != "" && Opti != "") ? 'custom['+Optn+'][details]['+Opti+'][details][type]' : 'custom['+div_num+'][type]');
      $option_group_row.find("#option_group_name_").attr("id",'option_group_name_'+div_num).attr("name",(Optn != "" && Opti != "") ? 'custom['+Optn+'][details]['+Opti+'][details][name]' : 'custom['+div_num+'][name]');
      $option_group_row.find("#option_group_min_").attr("id",'option_group_min_'+div_num).attr("name",(Optn != "" && Opti != "") ? 'custom['+Optn+'][details]['+Opti+'][details][min]' : 'custom['+div_num+'][min]');
      $option_group_row.find("#option_group_max_").attr("id",'option_group_max_'+div_num).attr("name",(Optn != "" && Opti != "") ? 'custom['+Optn+'][details]['+Opti+'][details][max]' : 'custom['+div_num+'][max]');

      $option_group_row.find("#option-options_").attr("id",'option-options_'+div_num)


      var name = (Optn != "" && Opti != "") ? 'custom['+Optn+'][details]['+Opti+'][details][%d]' : 'custom['+div_num+'][option][%d]' ;



      $option_group_row.find("#remove_option").attr("onClick",'delOptions(0,'+div_num+')')
      $option_group_row.find("#option_group_feature_type_").attr("id",'option_group_feature_type_'+div_num).attr("name",(Optn != "" && Opti != "") ? 'option_group['+Optn+'][details]['+Opti+'][details][feature_type]' : 'custom['+div_num+'][feature_type]');

      for(var i=0;i<1;i++){
        var addOption = (Optn != "" && Opti != "") ? "addOption("+div_num+",'"+Optn+"','"+Opti+"')" : 'addOption('+div_num+')' ;
        var addOptionText = (Optn != "" && Opti != "") ? "إضافة خيار فرعي" : 'إضافة خيار' ;

        name = name.replace("%d" , i);

        $option_group_row.find(".opt-img").attr("id",'image_option_details_file_'+[div_num]+'_'+i);

        $option_group_row.find("#product_file_"+i).attr("id",'option_details_file_'+[div_num]+'_'+i).attr("name",name+'[details_file]');


        $option_group_row.find("#product_name_"+i).attr("id",'option_details_name_'+[div_num]+'_'+i).attr("name",name+'[details_name]').attr('placeholder'," خيار "+(i+1) );

        $option_group_row.find("#product_price_"+i).attr("id",'option_details_price_'+[div_num]+'_'+i).attr("name",name+'[details_price]');

        $option_group_row.find("#product_price_point_"+i).attr("id",'option_details_price_point_'+[div_num]+'_'+i).attr("name",name+'[details_price_point]');
        $option_group_row.find("#product_quantity_"+i).attr("id",'option_details_quantity_'+[div_num]+'_'+i).attr("name",name+'[details_quantity]');
      }

      $option_group_row.find("#add_option").attr('onClick',addOption);
      $option_group_row.find("#add_option").text(addOptionText);

      if(Optn != "" && Opti != ""){
        $option_group_row.addClass('inner');
        $('#option-row_'+Optn+'_'+Opti).append($option_group_row)

      }else {
        $('#options_list').append($option_group_row);
      }



      //															$('.bootstrap-select').selectpicker();
    }
    function addOption(div_num , Opt_num = "" , Opti = ""){

      var i = (div_num != "" && Opt_num != "") ? $('#option-options_'+div_num+'_'+Opt_num+'  .row').length : $('#option-options_'+div_num+'  .row').length;

      i++;

      var $option_row = $('.clone_option').clone();
      $option_row.removeClass('hidden clone_option');



      var name = (div_num != "" && Opt_num != "") ? 'custom['+div_num+'][details]['+Opt_num+'][details]['+i+']' : 'custom['+div_num+'][option]['+i+']' ;

      $option_row.find("#product_file_").attr("id",'option_details_file_'+[div_num]+'_'+i).attr("name",name+'[details_file]');

      $option_row.find(".opt-img").attr("id",'image_option_details_file_'+[div_num]+'_'+i);

      $option_row.find("#product_name_").attr("id",'option_details_name_'+[div_num]+'_'+i).attr("name",name+'[details_name]').attr('placeholder'," خيار "+i );

      $option_row.find("#product_price_").attr("id",'option_details_price_'+[div_num]+'_'+i).attr("name",name+'[details_price]');

      $option_row.find("#product_price_point_").attr("id",'option_details_price_point_'+[div_num]+'_'+i).attr("name",name+'[details_price_point]');

      $option_row.find("#product_quantity_").attr("id",'option_details_quantity_'+[div_num]+'_'+i).attr("name",name+'[details_quantity]');

      if(div_num != "" && Opt_num != ""){
        if(Opti == ""){
          $('#option-options_'+div_num+'_'+Opt_num).append($option_row);
        }else {
          $('#option-options_'+div_num).append($option_row);
        }

      }else {
        $('#option-options_'+div_num).append($option_row);
      }


    ChangeType(div_num);
    // var type = $('#option_group_type_'+div_num+' option:selected').val();
    // $("#option-options_"+div_num+" .option_details_name").each(function() {
    //     $(this).attr('type' , type);
    // });

    }


    //
    // $(".option_group_type").on("change", function(){
    //
    // var div_num = $(this).attr("id").split("_");
    // div_num = div_num[div_num.length -1];
    //
    //   ChangeType(div_num);
    // });


    function ChangeType(div_num = null , inthis = null){

      if(div_num == null){
        console.log("Sdfsdfsd");
        var divNum = $(inthis).attr("id").split("_");
        div_num = divNum[divNum.length -1];
      }
      var type = $('#option_group_type_'+div_num+' option:selected').val();
      $("#option-options_"+div_num+" .option_details_name").each(function() {
          $(this).attr('type' , type);
      });
    }

    function chekOptions(){
      var _parent_0 = $('#option_group_name_0');
      var _child_0_0 = $('#option_details_name_0_0');
      if( _parent_0.length > 0 )
      {
        if ( $.trim( _parent_0.val() ) != "" )
        {
          if ( $.trim( _child_0_0.val() ) == "" )
          {
            swal('',   _parent_0.val()   + ' من فضلك أدخل خيار واحد على الاقل  ' ,'error');
            return false;
          }
        }
      }
      if ( $.trim( _child_0_0.val() ) != "" )
      {
        if ( $.trim( _parent_0.val() ) == "" )
        {
          swal('',  'مسمى الخيار مطلوب'  ,'error');
          return false;
        }
      }
      var notHaveOptionDetail = false;
      var notHaveOptionName = '';
      $('.option-section:visible').each(function () {
        var haveValue = false;
        notHaveOptionName = $(this).find('.option_group_name').val();
        $(this).find('.option_details_name').each(function(){
          if($(this).val() && $(this).val().length > 0) {
            haveValue = true;
            return false;
          }
        });
        if(!haveValue) {
          notHaveOptionDetail = true;
          return false;
        }
      });
      if(notHaveOptionDetail){
        swal('',   notHaveOptionName   + ' من فضلك أدخل خيار واحد على الاقل  ' ,'error');
        return false;
      }

    }
    function delOptions(id,div_num){
      $('#option_section_'+div_num).remove();
    }
    </script>
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

<?php echo $__env->make($layoutView.'.index', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/saudidragonmart/public_html/resources/views/merchant/V2/products/edit.blade.php ENDPATH**/ ?>