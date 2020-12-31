<style>
    .has_offer {
        display: none;
    }
</style>
<div class="row">
    <div class="col-md-12">
        <!-- BEGIN EXAMPLE TABLE PORTLET-->
        <div class="portlet box purple">
            <div class="portlet-title">
                <div class="caption">
                    <i class="fa fa-edit font-weight-light"></i>
                    <span class="caption-subject bold uppercase"> Edit product </span>
                </div>

            </div>
            <div class="portlet-body form">
                <div class="form-body">
                    
                    
                    <?php echo Form::open(['method'=>'PUT','class'=>'form-horizontal form-bordered form-row-stripped','url'=>url(merchant_store_url().'/product/'.$product->id),'id'=>'productEdit']); ?>

                    <div class="form-group">
                        <div class="control-label col-md-2">
                            <label>Product name</label>
                        </div>
                        <div class="col-md-2">
                            <input id="name" class="form-control" name="name" type="text"
                                   placeholder="Product name" value="<?php echo e($product->name ?? ''); ?>">
                        </div>
                        <div class="control-label col-md-2">
                            <label>Price</label>
                        </div>
                        <div class="col-md-2">
                            <input id="price" class="form-control" name="price" type="number"
                                   value="<?php echo e($product->price ?? ''); ?>"
                                   placeholder="Price">
                        </div>
                        <div class="control-label col-md-2">
                            <label>Quantity</label>
                        </div>
                        <div class="col-md-2">
                            <input id="original_quantity" class="form-control" name="original_quantity" type="number"
                                   value="<?php echo e($product->available_quantity ?? ''); ?>"
                                   placeholder="Quantity">
                        </div>


                    </div>


                    <div class="form-group">
                        <div class="control-label col-md-2">
                            <label>Categories</label>
                        </div>
                        <div class="col-md-2">
                            <select class="form-control" name="category_id">
                                <?php $__currentLoopData = $categories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $category): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <option value="<?php echo e($category->id); ?>"
                                            <?php if($category->id == $product->category_id): ?> selected <?php endif; ?>><?php echo e($category->name); ?></option>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </select>
                        </div>

                        <div class="control-label col-md-1">
                            <label>Is Offer</label>
                        </div>
                        <div class="col-md-1">
                            <div class="md-checkbox"><input type="checkbox" id="checkbox1" name="is_offer"
                                                            <?php if($product->is_offer): ?> checked <?php endif; ?>
                                                            class="md-check is_offer"
                                                            data-id=""><label for="checkbox1"><span></span><span
                                            class="check"></span><span class="box"></span> </label></div>
                        </div>

                        <div class="control-label col-md-2 <?php if(!$product->is_offer): ?> has_offer <?php endif; ?>">
                            <label>Offer %</label>
                        </div>
                        <div class="col-md-2 <?php if(!$product->is_offer): ?> has_offer <?php endif; ?>">
                            <input id="offer_percentage" class="form-control" name="offer_percentage" type="number"
                                   placeholder="Offer %" value="<?php echo e($product->offer_percentage ?? null); ?>">
                        </div>

                        <div class="control-label col-md-1">
                            <label>Is Sponsor</label>
                        </div>
                        <div class="col-md-1">
                            <div class="md-checkbox"><input type="checkbox" id="checkbox2" name="is_sponsor"
                                                            <?php if($product->is_sponsor): ?> checked <?php endif; ?>
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
                            <textarea class="form-control" rows="6" name="description"
                                      id="description"><?php echo e($product->description ?? ''); ?></textarea>
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
                                    <th width="10%">
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
                                            <?php $__currentLoopData = $customizations; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $custom): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                <option value="<?php echo e($custom->id); ?>"><?php echo e($custom->name); ?></option>
                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
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
                                <?php if(count($product->Customizations) > 0): ?>

                                    <?php $__currentLoopData = $product->Customizations; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $custom): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <?php $__currentLoopData = $custom->product_customizations; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $product_custom): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <tr>
                                                <td><?php echo e($loop->iteration); ?></td>
                                                <td><?php echo e($custom->name); ?><input type="hidden" name="custom_id[]"
                                                                            value="<?php echo e($custom->id); ?>"></td>
                                                <td><?php echo e($product_custom->price); ?><input type="hidden" name="custom_price[]"
                                                                                    value="<?php echo e($custom->pivot->price); ?>">
                                                </td>
                                                <td><?php echo e($product_custom->text); ?><input type="hidden" name="custom_text[]"
                                                                                     value="<?php echo e($custom->pivot->text); ?>">
                                                </td>
                                                <td><?php echo e($product_custom->description); ?><input type="hidden"
                                                                                          name="custom_description[]"
                                                                                          value="<?php echo e($product_custom->description); ?>">
                                                </td>
                                                <td>
                                                    <span class="default_text"><?php echo e(($product_custom->is_default)?'Yes':'No'); ?></span><input
                                                            type="hidden" name="is_default[]" class="default"
                                                            value="<?php echo e(($product_custom->is_default)); ?>"></td>
                                                <td><a href="javascript:;"
                                                       class="btn btn-danger btn-icon-only btn-circle remove-custom"><i
                                                                class="fa fa-times"></i></a></td>
                                            </tr>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                <?php else: ?>
                                    <tr class="no-custom">
                                        <td colspan="7">No customizations</td>
                                    </tr>
                                <?php endif; ?>
                                </tbody>
                            </table>
                        </div>
                    </div>


                    
                    <div class="form-actions save_operations" style="display: block;">
                        <div class="row">
                            <div class="col-md-12 text-center">
                                <button type="submit" class="btn btn-circle green save"><i class="fa fa-check"></i>
                                    Save
                                </button>
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
                
                <?php echo Form::open(['method'=>'POST','url'=>url(merchant_store_url().'/product/images'),'id'=>'fileupload','files'=>true]); ?>

                <!-- The fileupload-buttonbar contains buttons to add/delete files and start/cancel the upload -->

                    <div class="row fileupload-buttonbar">
                        <div class="col-lg-7">
                            <!-- The fileinput-button span is used to style the file input field as button -->
                            <span class="btn green fileinput-button">
                                                <i class="fa fa-plus"></i>
                                                <span> Add files... </span>
                                                <input type="file" name="files[]" multiple=""> </span>
                            
                            
                            
                            
                            <button type="reset" class="btn warning cancel">
                                <i class="fa fa-ban-circle"></i>
                                <span> Cancel upload </span>
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
<?php /**PATH /home/saudidragonmart/public_html/resources/views/merchant/partial/edit-product.blade.php ENDPATH**/ ?>