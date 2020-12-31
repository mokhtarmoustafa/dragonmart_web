<?php $__env->startSection('css'); ?>
    <!-- BEGIN THEME GLOBAL STYLES -->
    <link href="<?php echo e(url('/')); ?>/assets/global/css/components-md.min.css" rel="stylesheet" id="style_components"
          type="text/css"/>
    <link href="<?php echo e(url('/')); ?>/assets/global/css/plugins-md.min.css" rel="stylesheet" type="text/css"/>
    <!-- END THEME GLOBAL STYLES -->

<?php $__env->stopSection(); ?>
<?php $__env->startSection('content'); ?>
    <div class="row">
        <div class="col-md-12 card card-custom">
            <!-- BEGIN SAMPLE FORM PORTLET-->
            <div class="card-header pt-5">
            <h3 class="text-center"> <?php echo e(trans(lang_app_site().'.CP.Add permissions to role')); ?> <span class="font-red font-size-base">
            <?php echo e(trans(lang_app_site().'.CP.'.$role->display_name)); ?></span></h3>
            </div>

            <input type="hidden" name="role_id" id="role_id" value="<?php echo e($role->id); ?>">
            <div style="overflow: auto;" class="card-body">
                <div class="">
                    <div class="panel panel-info">
                        <div class="panel-heading pl-3 pt-3">
                            <h3 class="panel-title">
                                <input name="allPermission"
                                       type="checkbox"
                                       class="allcheck parent_chk all_parent_public">
                                <label>
                                <?php echo e(trans(lang_app_site().'.CP.General Permissions')); ?>

                                </label>
                            </h3>


                        </div>
                        <div class="panel-body row pl-3">

                            <?php $__currentLoopData = $perms; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $p): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <?php if(!isset($p->parent_id)): ?>
                                    <div class="col-md-3" data-id="<?php echo e($p->id); ?>">
                                        <input name="perms"
                                               type="checkbox"
                                               class="allcheck child_public_chk child_chk child_chk<?php echo e($p->id); ?>"
                                               
                                               value="<?php echo e($p->id); ?>">
                                        <label>
                                        <?php echo e(trans(lang_app_site().'.CP.'.$p->display_name)); ?>

                                        </label>
                                    </div>
                                <?php endif; ?>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </div>
                    </div>
                </div>

                <?php $__currentLoopData = $perms; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $perm): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>

                    <?php if(!isset($perm->parent_id) && count($perm->children) > 0): ?>
                        <div class="">
                            <div class="panel panel-info">
                                <div class="panel-heading pl-3 pt-3">
                                    <h3 class="panel-title">
                                        <input name="allPermission"
                                               type="checkbox"
                                               class="allcheck parent_chk parent_chk_p<?php echo e($perm->id); ?>">
                                        <label>
                                        <?php echo e(trans(lang_app_site().'.CP.'.$perm->display_name)); ?>

                                        </label>
                                    </h3>


                                </div>
                                <div class="panel-body row pl-3">

                                    <?php $__currentLoopData = $perms; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $p): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <?php if($perm->id == $p->parent_id): ?>

                                            <div class="col-md-3" data-id="<?php echo e($p->id); ?>">
                                                <input name="perms"
                                                       type="checkbox"
                                                       class="allcheck child_chk"
                                                       value="<?php echo e($p->id); ?>">
                                                <label>
                                                <?php echo e(trans(lang_app_site().'.CP.'.$p->display_name)); ?>

                                                </label>
                                            </div>
                                        <?php endif; ?>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </div>
                            </div>
                        </div>
                    <?php endif; ?>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </div>
            <div class="form-group">
                <button class="btn btn-primary col-xs-12" id="add-role-permissions"> <i class="fa fa-check"></i> <?php echo e(trans(lang_app_site().'.CP.Save permissions')); ?></button>
            </div>
            <!-- END SAMPLE FORM PORTLET-->
        </div>
    </div>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('js'); ?>
    <script src="<?php echo e(url('/')); ?>/assets/global/scripts/app.min.js" type="text/javascript"></script>
    <script src="<?php echo e(url('/')); ?>/assets/js/permission.js" type="text/javascript"></script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make(admin_layout_vw().'.index', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/saudidragonmart/public_html/resources/views/admin/admins/role/add-permissions.blade.php ENDPATH**/ ?>