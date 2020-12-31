<link href="<?php echo e(url('/')); ?>/assets/global/plugins/bootstrap-fileinput/bootstrap-fileinput.css" rel="stylesheet"
      type="text/css"/>
<link href="<?php echo e(url('/')); ?>/assets/global/plugins/select2/css/select2.min.css" rel="stylesheet" type="text/css"/>
<link href="<?php echo e(url('/')); ?>/assets/global/plugins/select2/css/select2-bootstrap.min.css" rel="stylesheet"
      type="text/css"/>
<div class="modal fade bs-modal-lg" id="add-service-provider" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
                <h4 class="modal-title"><i class="fa fa-user-plus"></i> Add New Service Provider<span
                            class="badge badge-primary name "
                            style="text-transform: inherit"></span></h4>
            </div>
            <div class="modal-body">
                <div class="portlet-body form">

                    <?php echo Form::open(['method'=>'POST','class'=>'form-horizontal form-bordered form-row-stripped','url'=>url(admin_user_tab_url().'/service_provider/create'),'files'=>true,'id'=>'formAddServiceProvider']); ?>

                    <div class="alert alert-danger" style="display: none">

                    </div>

                    <div class="form-body">


                        <div class="form-group ">
                            <label class="control-label col-md-2">Photo</label>
                            <div class="col-md-4">
                                <div class="fileinput fileinput-new" data-provides="fileinput">
                                    <div class="fileinput-preview thumbnail" data-trigger="fileinput"
                                         style="width: 200px; height: 150px;">
                                        <img src="http://www.placehold.it/200x150/EFEFEF/AAAAAA&amp;text=no+image"
                                             alt=""/>

                                    </div>
                                    <div>
                                                            <span class="btn red btn-outline btn-file">
                                                                <span class="fileinput-new"> Select </span>
                                                                <span class="fileinput-exists"> Change </span>
                                                                <input type="file" name="image"
                                                                       id="image"> </span>
                                        <a href="javascript:;" class="btn red fileinput-exists"
                                           data-dismiss="fileinput">
                                            Remove </a>
                                    </div>
                                </div>

                            </div>
                        </div>
                        <div class="form-group">
                            <div class="control-label col-md-2">
                                <label for="driver_types">Username</label>
                            </div>
                            <div class="col-md-4">
                                <input type="text" name="username" id="username" class="form-control"
                                       placeholder="user name ...">
                            </div>
                            <div class="control-label col-md-2">
                                <label for="driver_types">Email</label>
                            </div>
                            <div class="col-md-4">
                                <input type="email" name="email" id="email" class="form-control"
                                       placeholder="Email ...">
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="control-label col-md-2">
                                <label for="driver_types">Phone</label>
                            </div>
                            <div class="control-label col-md-4">
                                <input type="text" name="mobile" id="mobile" class="form-control"
                                       placeholder="Phone ...">
                            </div>
                            <div class="control-label col-md-2">
                                <label for="driver_types">City</label>
                            </div>
                            <div class="col-md-4">
                                <select class="form-control" name="city_id" id="city_id">
                                    <option>Select ...</option>
                                    <?php $__currentLoopData = $cities; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $city): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <option value="<?php echo e($city->id); ?>"><?php echo e($city->name_en); ?></option>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </select>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="control-label col-md-2">
                                <label for="driver_types">Address</label>
                            </div>
                            <div class="control-label col-md-4">
                                <input type="text" name="address" id="address" class="form-control"
                                       placeholder="Address ...">
                            </div>
                            <div class="control-label col-md-2">
                                <label for="driver_types">Categories</label>
                            </div>
                            <div class="control-label col-md-4">
                                <select class="form-control select2" data-placeholder="Choose Categories ..." multiple name="provider_categories[]" id="provider_categories">
                                    <option>Select ...</option>
                                    <?php $__currentLoopData = $provider_categories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $category): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <option value="<?php echo e($category->id); ?>"><?php echo e($category->name); ?></option>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </select>
                            </div>

                        </div>

                    </div>

                    <div class="form-body">

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
                    </div>

                    <?php echo Form::close(); ?>


                </div>
            </div>

        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>

<script src="<?php echo e(url('/')); ?>/assets/global/plugins/bootstrap-fileinput/bootstrap-fileinput.js"
        type="text/javascript"></script>

<script src="<?php echo e(url('/')); ?>/assets/global/plugins/select2/js/select2.full.min.js" type="text/javascript"></script>
<script src="<?php echo e(url('/')); ?>/assets/pages/scripts/components-select2.min.js" type="text/javascript"></script>
<?php /**PATH /home/saudidragonmart/public_html/resources/views/admin/modals/add_service_provider.blade.php ENDPATH**/ ?>