<?php $__env->startSection('css'); ?>
    <link href="<?php echo e(url('/')); ?>/assets/global/plugins/bootstrap-fileinput/bootstrap-fileinput.css" rel="stylesheet"
          type="text/css"/>

    <link href="<?php echo e(url('/')); ?>/assets/global/plugins/select2/css/select2.min.css" rel="stylesheet" type="text/css"/>
    <link href="<?php echo e(url('/')); ?>/assets/global/plugins/select2/css/select2-bootstrap.min.css" rel="stylesheet"
          type="text/css"/>
    <!-- END PAGE LEVEL PLUGINS -->

    <link href="<?php echo e(url('/')); ?>/assets/global/css/components-md.min.css" rel="stylesheet" id="style_components"
          type="text/css"/>
    <link href="<?php echo e(url('/')); ?>/assets/global/css/plugins-md.min.css" rel="stylesheet" type="text/css"/>
    <!-- END THEME GLOBAL STYLES -->
<?php $__env->stopSection(); ?>
<?php $__env->startSection('content'); ?>
    <div class="row">
        <div class="col-md-12">
            <div class="portlet box green">
                <div class="portlet-title">
                    <div class="caption">
                        <i class="fa fa-user"></i> Profile
                    </div>
                </div>
                <div class="portlet-body form">
                    <div class="form-body">
                        <?php echo Form::open(['method'=>'PUT','class'=>'form-horizontal form-bordered form-row-stripped','files'=>true,'id'=>'formProfileEdit']); ?>


                        <div class="alert alert-danger" style="display: none;">
                            
                        </div>
                        <div class="form-body">
                            <div class="form-group ">
                                <label class="control-label col-md-2">Logo</label>
                                <div class="col-md-4">
                                    <div class="fileinput fileinput-new" data-provides="fileinput">
                                        <div class="fileinput-preview thumbnail" data-trigger="fileinput"
                                             style="width: 200px; height: 150px;">
                                            <img src="<?php echo e(auth()->guard('admin')->user()->logo ?? url('assets/apps/img/logo.png')); ?>"
                                                 alt=""/>

                                        </div>
                                        <div>
                                                            <span class="btn red btn-outline btn-file">
                                                                <span class="fileinput-new"> Select </span>
                                                                <span class="fileinput-exists"> Change </span>
                                                                <input type="file" name="logo"
                                                                       id="logo"> </span>
                                            <a href="javascript:;" class="btn red fileinput-exists"
                                               data-dismiss="fileinput">
                                                Remove </a>
                                        </div>
                                    </div>

                                </div>
                            </div>

                            <div class="form-group">
                                <div class="control-label col-md-2">
                                    <label for="driver_types">Name</label>
                                </div>
                                <div class="col-md-4">
                                    <input type="text" name="name" id="name" class="form-control"
                                           value="<?php echo e(auth()->guard('admin')->user()->name); ?>" placeholder="Name ...">
                                </div>
                                <div class="control-label col-md-2">
                                    <label for="driver_types">Username</label>
                                </div>
                                <div class="col-md-4">
                                    <input type="text" name="username" id="username" class="form-control"
                                           value="<?php echo e(auth()->guard('admin')->user()->username); ?>"
                                           placeholder="Username ...">
                                </div>
                                <div class="control-label col-md-2">
                                    <label for="email">Mobile</label>
                                </div>
                                <div class="col-md-4">
                                    <input type="text" name="mobile" id="mobile" class="form-control"
                                           value="<?php echo e(auth()->guard('admin')->user()->mobile); ?>" placeholder="Mobile ...">
                                </div>
                                <div class="control-label col-md-2">
                                    <label for="email">Email</label>
                                </div>
                                <div class="col-md-4">
                                    <input type="email" name="email" id="email" class="form-control"
                                           value="<?php echo e(auth()->guard('admin')->user()->email); ?>" placeholder="Email ...">
                                </div>
                                <div class="control-label col-md-2">
                                    <label for="email">Password</label>
                                </div>
                                <div class="col-md-4">
                                    <input type="password" name="password" id="password" class="form-control"
                                           placeholder="Password ...">
                                </div>
                                <div class="control-label col-md-2">
                                    <label for="email">Password confirmation</label>
                                </div>
                                <div class="col-md-4">
                                    <input type="password" name="password_confirmation" id="password_confirmation"
                                           class="form-control"
                                           placeholder="Password confirmation...">
                                </div>


                                
                                
                                
                                
                                
                                
                                
                                
                                

                                
                                
                                

                                
                                
                                
                                
                            </div>


                        </div>

                        <div class="form-actions">
                            <div class="row">
                                <div class="col-md-12 text-center">
                                    <button type="submit" class="btn btn-circle btn-md save green">
                                        <i class="fa fa-check"></i>
                                        Save
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
<?php $__env->stopSection(); ?>
<?php $__env->startSection('js'); ?>


    <script src="<?php echo e(url('/')); ?>/assets/global/plugins/select2/js/select2.full.min.js" type="text/javascript"></script>

    <script src="<?php echo e(url('/')); ?>/assets/global/plugins/bootstrap-fileinput/bootstrap-fileinput.js"
            type="text/javascript"></script>
    <!-- BEGIN THEME GLOBAL SCRIPTS -->
    <script src="<?php echo e(url('/')); ?>/assets/global/scripts/app.min.js" type="text/javascript"></script>
    <!-- END THEME GLOBAL SCRIPTS -->
    <script src="<?php echo e(url('/')); ?>/assets/pages/scripts/components-select2.min.js" type="text/javascript"></script>

    <!-- BEGIN PAGE LEVEL SCRIPTS -->
    <script src="<?php echo e(url('/')); ?>/assets/js/admins.js" type="text/javascript"></script>
    
    
    
    <!-- END PAGE LEVEL SCRIPTS -->
<?php $__env->stopSection(); ?>
<?php echo $__env->make('admin.layout.index', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/saudidragonmart/public_html/resources/views/admin/profile.blade.php ENDPATH**/ ?>