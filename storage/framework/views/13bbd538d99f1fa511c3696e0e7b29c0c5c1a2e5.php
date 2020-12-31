<?php $__env->startSection('content'); ?>

        <div class="row">
            <div class="col-md-12 ">
                <!-- BEGIN SAMPLE FORM PORTLET-->
                <div class="card card-custom shadow">
                    <div class="card-header">
                        <div class="card-title">
                            <i class="<?php echo e($icon); ?> font-dark sbold"></i> <span
                                class="caption-subject font-dark sbold uppercase"><?php echo e(trans(lang_app_site().'.CP.'.$title)); ?></span>
                        </div>
                    </div>
                    <div class="card-body form">
                        <?php echo Form::open(['method'=>'PUT','url'=>url(admin_polices_url().'/edit'),'class'=>'form-horizontal','id'=>'formAdd']); ?>

                        <div class="form-group">

                            <div class="col-md-12">
                                <label><?php echo e(trans(lang_app_site().'.CP.Title')); ?> (English)...</label>
                                <input type="text" class="form-control" name="title_en"
                                       id="title_en"
                                       placeholder="<?php echo e(trans(lang_app_site().'.CP.Title')); ?> (English)..." value="<?php echo e($policy->title_en); ?>">
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-md-12">
                                <label><?php echo e(trans(lang_app_site().'.CP.Title')); ?> (Arabic)...</label>
                                <input type="text" class="form-control" name="title_ar"
                                       id="title_ar"
                                       placeholder="<?php echo e(trans(lang_app_site().'.CP.Title')); ?> (Arabic)..." value="<?php echo e($policy->title_ar); ?>">
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-md-12">
                                <label><?php echo e(trans(lang_app_site().'.CP.Description')); ?> (English)...</label>
                                <textarea type="text" class="form-control ckeditor" name="desc_en"
                                          id="desc_en"
                                          placeholder="<?php echo e(trans(lang_app_site().'.CP.Description')); ?> (English)..."><?php echo $policy->desc_en; ?></textarea>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-md-12">
                                <label><?php echo e(trans(lang_app_site().'.CP.Description')); ?> (Arabic)...</label>

                                <textarea type="text" class="form-control ckeditor" name="desc_ar"
                                          id="desc_ar"
                                          placeholder="<?php echo e(trans(lang_app_site().'.CP.Description')); ?> (Arabic)..."><?php echo $policy->desc_ar; ?></textarea>
                            </div>

                        </div>

                        <div class="form-group">
                            <div class="col-md-12 text-center">
                                <button type="submit" class="btn btn-circle btn-success save"><i class="fa fa-check"></i> <?php echo e(trans(lang_app_site().'.CP.Save')); ?></button>
                            </div>
                        </div>
                        <?php echo Form::close(); ?>

                    </div>
                </div>
                <!-- END SAMPLE FORM PORTLET-->
            </div>
        </div>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('js'); ?>
    
    <script src="<?php echo e(url('/')); ?>/assets/global/plugins/ckeditor/ckeditor.js" type="text/javascript"></script>
    <script src="<?php echo e(url('/')); ?>/assets/global/scripts/app.min.js" type="text/javascript"></script>
    
    <script src="<?php echo e(url('/')); ?>/assets/js/setting.js" type="text/javascript"></script>
    <script>
        CKEDITOR.replace('description_ar');
        CKEDITOR.replace('description_en');
    </script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make(admin_layout_vw().'.index', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/saudidragonmart/public_html/resources/views/admin/terms/policy.blade.php ENDPATH**/ ?>