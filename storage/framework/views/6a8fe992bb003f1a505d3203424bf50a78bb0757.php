<link href="<?php echo e(url('/')); ?>/assets/global/plugins/bootstrap-fileinput/bootstrap-fileinput.css" rel="stylesheet"
      type="text/css"/>

<link href="<?php echo e(url('/')); ?>/assets/global/plugins/select2/css/select2.min.css" rel="stylesheet" type="text/css"/>
<link href="<?php echo e(url('/')); ?>/assets/global/plugins/select2/css/select2-bootstrap.min.css" rel="stylesheet"
      type="text/css"/>
<link href="<?php echo e(url('/')); ?>/assets/global/plugins/bootstrap-timepicker/css/bootstrap-timepicker.min.css" rel="stylesheet"
      type="text/css"/>


<div class="modal fade bs-modal-lg" id="<?php echo e($modal_id); ?>" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
                <h4 class="modal-title"> <?php echo e($modal_title); ?></h4>
            </div>

            <div class="modal-body">
                <div class="row">
                    <div class="col-sm-12">
                        <div class="portlet-body form">
                            <?php echo Form::open(['method'=>$form['method'],'id'=>$form['form_id'],'class'=>'form-horizontal form','url'=>$form['url'] ,'files'=>true]); ?>

                            <div class="alert alert-danger" role="alert" style="display: none"></div>

                            <div class="form-body">
                                <?php $__currentLoopData = $form['fields']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $fields): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <?php if($fields == 'image' || $fields == 'video'): ?>
                                        <div class="form-group ">
                                            <label class="control-label col-md-3"><?php echo e($form['fields_name'][$key]); ?></label>
                                            <div class="col-md-9">
                                                <div class="fileinput fileinput-new" data-provides="fileinput">
                                                    <div class="fileinput-preview thumbnail" data-trigger="fileinput"
                                                         style="width: 200px; height: 150px;">
                                                        <?php if(isset($form['values'])): ?>
                                                            <?php if($fields == 'video'): ?>
                                                                <video src="<?php echo e($form['values'][$key]); ?>" controls
                                                                       width="200"></video>
                                                            <?php else: ?>
                                                                <img src="<?php echo e($form['values'][$key]); ?>">

                                                            <?php endif; ?>
                                                        <?php else: ?>
                                                            <img src="http://www.placehold.it/200x150/EFEFEF/AAAAAA&amp;text=no+image"
                                                                 alt=""/>

                                                        <?php endif; ?>
                                                    </div>
                                                    <div>
                                                            <span class="btn red btn-outline btn-file">
                                                                <span class="fileinput-new"> Select </span>
                                                                <span class="fileinput-exists"> Change </span>
                                                                <input type="file" name="<?php echo e($key); ?>"
                                                                       id="<?php echo e($key); ?>"> </span>
                                                        <a href="javascript:;" class="btn red fileinput-exists"
                                                           data-dismiss="fileinput">
                                                            Remove </a>
                                                    </div>
                                                </div>

                                            </div>
                                        </div>

                                    <?php endif; ?>

                                    <?php if($fields == 'file'): ?>
                                        <div class="form-group">
                                            <label class="col-md-3 control-label"><?php echo e($form['fields_name'][$key]); ?></label>
                                            <div class="col-md-9">
                                                <input type="file" name="<?php echo e($key); ?>" id="<?php echo e($key); ?>" class="form-control"
                                                       placeholder="<?php echo e($form['fields_name'][$key]); ?>">
                                            </div>
                                        </div>
                                    <?php endif; ?>

                                    <?php if($fields == 'file_multiple'): ?>
                                        <div class="form-group">
                                            <label class="col-md-3 control-label"><?php echo e($form['fields_name'][$key]); ?></label>
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

                                                    <?php if(isset($form['values'])): ?>
                                                        <?php $__currentLoopData = $form['values']['images']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $image): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                            <div class="img-wrap">
                                                                <span class="close delete-image"
                                                                      data-id="<?php echo e($image->id); ?>">&times;</span>
                                                                <img src='<?php echo e($image->image); ?>' width='100px'
                                                                     height="100px">
                                                            </div>
                                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                    <?php endif; ?>

                                                    <span class="view">

                                                    </span>
                                                </div>

                                            </div>
                                        </div>
                                    <?php endif; ?>

                                    <?php if($fields == 'text'): ?>
                                        <div class="form-group">
                                            <label class="col-md-3 control-label"><?php echo e($form['fields_name'][$key]); ?></label>
                                            <div class="col-md-9">
                                                <input type="text" name="<?php echo e($key); ?>" id="<?php echo e($key); ?>" class="form-control"
                                                       placeholder="<?php echo e($form['fields_name'][$key]); ?>"
                                                       <?php if(isset($form['values'])): ?> value="<?php echo e($form['values'][$key]); ?>" <?php endif; ?>>
                                            </div>
                                        </div>
                                    <?php endif; ?>
                                    <?php if($fields == 'number'): ?>
                                        <div class="form-group">
                                            <label class="col-md-3 control-label"><?php echo e($form['fields_name'][$key]); ?></label>
                                            <div class="col-md-9">
                                                <input type="number" name="<?php echo e($key); ?>" id="<?php echo e($key); ?>"
                                                       class="form-control"
                                                       placeholder="<?php echo e($form['fields_name'][$key]); ?>"
                                                       <?php if(isset($form['values'])): ?> value="<?php echo e($form['values'][$key]); ?>" <?php endif; ?>>
                                            </div>
                                        </div>
                                    <?php endif; ?>
                                    <?php if($fields == 'text_dis'): ?>
                                        <div class="form-group">
                                            <label class="col-md-3 control-label"><?php echo e($form['fields_name'][$key]); ?></label>
                                            <div class="col-md-9">
                                                <input type="text" name="<?php echo e($key); ?>" id="<?php echo e($key); ?>" class="form-control"
                                                       placeholder="<?php echo e($form['fields_name'][$key]); ?>" disabled
                                                       <?php if(isset($form['values'])): ?> value="<?php echo e($form['values'][$key]); ?>" <?php endif; ?>>
                                            </div>
                                        </div>
                                    <?php endif; ?>
                                    <?php if($fields == 'time'): ?>
                                        <div class="form-group">
                                            <label class="control-label col-md-3"><?php echo e($form['fields_name'][$key]); ?></label>
                                            <div class="col-md-3">
                                                <div class="input-icon">
                                                    <i class="fa fa-clock-o"></i>
                                                    <input type="text" name="<?php echo e($key); ?>" id="<?php echo e($key); ?>"
                                                           class="form-control timepicker timepicker-24"
                                                           <?php if(isset($form['values'])): ?> value="<?php echo e($form['values'][$key]); ?>" <?php endif; ?>>
                                                </div>
                                            </div>
                                        </div>
                                    <?php endif; ?>
                                    <?php if($fields == 'email'): ?>
                                        <div class="form-group">
                                            <label class="col-md-3 control-label"><?php echo e($form['fields_name'][$key]); ?></label>
                                            <div class="col-md-9">
                                                <input type="email" name="<?php echo e($key); ?>" id="<?php echo e($key); ?>"
                                                       class="form-control"
                                                       placeholder="<?php echo e($form['fields_name'][$key]); ?>"
                                                       <?php if(isset($form['values'])): ?> value="<?php echo e($form['values'][$key]); ?>" <?php endif; ?>>
                                            </div>
                                        </div>
                                    <?php endif; ?>
                                    <?php if($fields == 'checkbox'): ?>
                                        <div class="form-group">
                                            <label class="col-md-3 control-label"><?php echo e($form['fields_name'][$key]); ?></label>
                                            <div class="col-md-9">

                                                <div class="md-checkbox"><input type="checkbox" name="<?php echo e($key); ?>"
                                                                                id="checkbox1"
                                                                                class="md-check is_correct"
                                                                                <?php if(isset($form['values']) && $form['values'][$key]): ?> checked <?php endif; ?>><label
                                                            for="checkbox1"><span></span><span
                                                                class="check"></span><span class="box"></span> </label>
                                                </div>
                                            </div>
                                        </div>
                                    <?php endif; ?>
                                    <?php if($fields == 'password'): ?>
                                        <div class="form-group">
                                            <label class="col-md-3 control-label"><?php echo e($form['fields_name'][$key]); ?></label>
                                            <div class="col-md-9">
                                                <input type="password" name="<?php echo e($key); ?>" id="<?php echo e($key); ?>"
                                                       class="form-control"
                                                       placeholder="<?php echo e($form['fields_name'][$key]); ?>">
                                            </div>
                                        </div>
                                    <?php endif; ?>
                                        <?php if($fields == 'date'): ?>

                                            <div class="form-group">
                                                <label class="control-label col-md-3"><?php echo e($form['fields_name'][$key]); ?></label>
                                                <div class="col-md-3">
                                                    <div class="input-group input-medium date date-picker"  data-date-format="yyyy-mm-dd" data-date-viewmode="years">
                                                        <input type="text" class="form-control" readonly name="<?php echo e($key); ?>" id="<?php echo e($key); ?>" <?php if(isset($form['values'])): ?> value="<?php echo e($form['values'][$key]); ?>" <?php endif; ?>>
                                                        <span class="input-group-btn">
                                                            <button class="btn default" type="button">
                                                                <i class="fa fa-calendar"></i>
                                                            </button>
                                                        </span>
                                                    </div>
                                                    <!-- /input-group -->
                                                </div>
                                            </div>
                                        <?php endif; ?>
                                    <?php if($fields == 'textarea'): ?>
                                        <div class="form-group">

                                            <?php if($modal_id == 'add-expense' || $modal_id == 'edit-expense' || $modal_id == 'add-product' || $modal_id == 'edit-product' || $modal_id == 'add-category' || $modal_id == 'edit-category'|| $modal_id == 'add-role' || $modal_id == 'edit-role'): ?>
                                                <label class="col-md-3 control-label"><?php echo e($form['fields_name'][$key]); ?></label>

                                                <div class="col-md-9">
                                                <textarea name="<?php echo e($key); ?>" id="<?php echo e($key); ?>" rows="5"
                                                          placeholder="<?php echo e($form['fields_name'][$key]); ?>"
                                                          class="form-control"><?php if(isset($form['values'])): ?><?php echo e($form['values'][$key]); ?><?php endif; ?></textarea>
                                                </div>
                                            <?php else: ?>
                                                <div class="col-md-12">
                                                <textarea name="<?php echo e($key); ?>" id="<?php echo e($key); ?>" rows="5"
                                                          placeholder="<?php echo e($form['fields_name'][$key]); ?>"
                                                          class="form-control"><?php if(isset($form['values'])): ?><?php echo e($form['values'][$key]); ?><?php endif; ?></textarea>
                                                </div>
                                            <?php endif; ?>
                                        </div>
                                    <?php endif; ?>
                                    <?php if($fields == 'ckeditor'): ?>
                                        <div class="form-group">
                                            <label class="col-md-3 control-label"><?php echo e($form['fields_name'][$key]); ?></label>

                                            <div class="col-md-9">
                                                <textarea name="<?php echo e($key); ?>" id="<?php echo e($key); ?>" rows="5"
                                                          placeholder="<?php echo e($form['fields_name'][$key]); ?>"
                                                          class="form-control <?php echo e($fields); ?>"><?php if(isset($form['values'])): ?><?php echo e($form['values'][$key]); ?><?php endif; ?></textarea>
                                            </div>

                                            <script>
                                                CKEDITOR.replace('<?php echo e($key); ?>');
                                            </script>
                                        </div>
                                    <?php endif; ?>

                                    <?php if(is_array($fields)): ?>
                                        <div class="form-group">
                                            <label class="col-md-3 control-label"><?php echo e($form['fields_name'][$key]); ?></label>
                                            <div class="col-md-9">
                                                <div class="input-icon">
                                                    <select class="form-control select2 <?php echo e($key); ?>" name="<?php echo e($key); ?>"
                                                            <?php if(strpos($key,'[]') !== false && ($modal_id == 'add-admin' || $modal_id == 'edit-admin')): ?>
                                                            multiple
                                                            <?php endif; ?>
                                                            data-placeholder="Choose <?php echo e($form['fields_name'][$key]); ?>..."
                                                            id="<?php echo e($key); ?>">
                                                        <?php $__currentLoopData = $fields; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $k=> $field): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                            <option value="<?php echo e($k); ?>"
                                                                    <?php if(isset($form['values']) && $form['values'][$key] == $k): ?> selected <?php endif; ?>><?php echo e(ucfirst($field)); ?></option>
                                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                    <?php endif; ?>
                                    <?php if(is_object($fields) && strpos($key,'[]') !== false): ?>
                                        <div class="form-group">
                                            <label class="col-md-3 control-label"><?php echo e($form['fields_name'][$key]); ?></label>
                                            <div class="col-md-9">
                                                <div class="input-icon">
                                                    <select class="form-control select2 <?php echo e($key); ?>" name="<?php echo e($key); ?>"
                                                            <?php if(strpos($key,'[]') !== false): ?> multiple
                                                            <?php endif; ?> data-placeholder="Choose <?php echo e($form['fields_name'][$key]); ?> ..."
                                                            id="<?php echo e($key); ?>"
                                                            style="padding: 0;">
                                                        <option></option>

                                                        <?php if(strpos($key,'[]') !== false && isset($form['values'][$key])): ?>
                                                            <?php $__currentLoopData = $form['values'][$key]; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                                <option value="<?php echo e($item->id); ?>"
                                                                        <?php if(in_array($item->id,$roles_id)): ?> selected <?php endif; ?>><?php echo e(ucfirst($item->display_name)); ?></option>

                                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                            <?php $__currentLoopData = $fields; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $k => $field): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>

                                                                <?php if(in_array($field->id,$form['values']['role_res[]'])): ?> <?php continue; ?> <?php endif; ?>
                                                                <option value="<?php echo e($field->id); ?>"><?php echo e(ucfirst($field->display_name)); ?></option>
                                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                        <?php else: ?>
                                                            <?php $__currentLoopData = $fields; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $field): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                                <option value="<?php echo e($field->id); ?>"
                                                                        <?php if(isset($form['values']) && $form['values'][$key] == $field->id): ?> selected <?php endif; ?>><?php echo e(ucfirst($field->display_name)); ?></option>
                                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                        <?php endif; ?>
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                    <?php endif; ?>

                                    <?php if(is_object($fields) && strpos($key,'[]') === false): ?>
                                        <div class="form-group">
                                            <label class="col-md-3 control-label"><?php echo e($form['fields_name'][$key]); ?></label>
                                            <div class="col-md-9">
                                                <div class="input-icon">
                                                    <select class="form-control <?php echo e($key); ?>" name="<?php echo e($key); ?>"
                                                            <?php if(strpos($key,'[]') !== false): ?> multiple
                                                            <?php endif; ?> data-placeholder="Choose <?php echo e($form['fields_name'][$key]); ?> ..."
                                                            id="<?php echo e($key); ?>"
                                                            style="    padding: 0;">
                                                        <option></option>

                                                        <?php $__currentLoopData = $fields; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $k =>$field): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                            <?php if($key == 'category_id'): ?>
                                                                <option value="<?php echo e($field->id); ?>"
                                                                        <?php if(isset($form['values']) && $form['values'][$key] == $field->id): ?> selected <?php endif; ?>><?php echo e(ucfirst($field->name)); ?></option>
                                                            <?php endif; ?>
                                                            <?php if($key == 'city'): ?>
                                                                <option value="<?php echo e($field->id); ?>"
                                                                        <?php if(isset($form['values']) && $form['values'][$key] == $field->id): ?> selected <?php endif; ?>><?php echo e(ucfirst($field->name_en)); ?></option>
                                                            <?php endif; ?>
                                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                    <?php endif; ?>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
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
                                <?php echo Form::close(); ?>

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
<script src="<?php echo e(url('/')); ?>/assets/global/plugins/select2/js/select2.full.min.js" type="text/javascript"></script>
<script src="<?php echo e(url('/')); ?>/assets/pages/scripts/components-select2.min.js" type="text/javascript"></script>

<script src="<?php echo e(url('/')); ?>/assets/global/plugins/bootstrap-fileinput/bootstrap-fileinput.js"
        type="text/javascript"></script>
<script src="<?php echo e(url('/')); ?>/assets/global/plugins/moment.min.js" type="text/javascript"></script>
<script src="<?php echo e(url('/')); ?>/assets/global/plugins/bootstrap-daterangepicker/daterangepicker.min.js"
        type="text/javascript"></script>

<script src="<?php echo e(url('/')); ?>/assets/global/plugins/bootstrap-timepicker/js/bootstrap-timepicker.min.js"
        type="text/javascript"></script>
<!-- BEGIN THEME GLOBAL SCRIPTS -->
<script src="<?php echo e(url('/')); ?>/assets/global/scripts/app.min.js" type="text/javascript"></script>
<!-- END THEME GLOBAL SCRIPTS -->
<!-- BEGIN PAGE LEVEL SCRIPTS -->
<script src="<?php echo e(url('/')); ?>/assets/pages/scripts/components-date-time-pickers.min.js" type="text/javascript"></script>
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
                url: '<?php echo e(url('admin/store-image/')); ?>/' + image_id,
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
</script><?php /**PATH /home/saudidragonmart/public_html/resources/views/modal.blade.php ENDPATH**/ ?>