<link href="<?php echo e(url('/')); ?>/assets/global/plugins/bootstrap-fileinput/bootstrap-fileinput.css" rel="stylesheet" type="text/css" />

<div class="modal fade" id="editDriver" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
                <h4 class="modal-title"><i class="fa fa-user-plus"></i> <?php echo e(trans(lang_app_site().'.CP.Edit driver')); ?> <?php echo e($user->username); ?> <span class="badge badge-primary name" style="text-transform: inherit"></span></h4>
            </div>
            <div class="modal-body">
                <div class="portlet-body form">

                    <?php echo Form::open(['method'=>'PUT','class'=>'form-horizontal form-bordered form-row-stripped','url'=>url(((getAuth()->type == 'admin') ? admin_user_tab_url() : getAuth()->type).'/user-driver/'.$user->id.'/edit'),'files'=>true,'id'=>'formEditDriver']); ?>

                    <div class="alert alert-danger" style="display: none">

                    </div>

                    <div class="form-body">
                        <div class="row">
                            <div class="col-6">
                                <div class="form-group">
                                    <div class="control-label">
                                        <h3 class="form-section font-blue-madison">
                                            <?php echo e(trans(lang_app_site().'.CP.General Information')); ?></h3>
                                    </div>
                                </div>
                                <div class="form-group ">
                                    <label class="control-label col-md-2">Photo</label>
                                    <div class="col-md-4">
                                        <div class="fileinput fileinput-new" data-provides="fileinput">
                                            <div class="fileinput-preview thumbnail" data-trigger="fileinput" style="width: 200px; height: 150px;">
                                                <img src="<?php echo e($user->image ??'http://www.placehold.it/200x150/EFEFEF/AAAAAA&amp;text=no+image'); ?>" alt="" />

                                            </div>
                                            <div>
                                                <span class="btn red btn-outline btn-file">
                                                    <span class="fileinput-new"> Select </span>
                                                    <span class="fileinput-exists"> Change </span>
                                                    <input type="file" name="image" id="image"> 
                                                </span>
                                                <a href="javascript:;" class="btn red fileinput-exists" data-dismiss="fileinput">
                                                    Remove </a>
                                            </div>
                                        </div>

                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="control-label">
                                        <label for="driver_types"><?php echo e(trans(lang_app_site().'.CP.Job ID')); ?></label>
                                    </div>
                                    <div class="control-label">
                                        <input type="text" name="job_id" id="job_id" class="form-control" value="<?php echo e($user->job_id); ?>" placeholder="<?php echo e(trans(lang_app_site().'.CP.Job ID')); ?>">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="control-label">
                                        <label for="driver_types"><?php echo e(trans(lang_app_site().'.CP.Driver name')); ?></label>
                                    </div>
                                    <div class="control-label">
                                        <input type="text" name="username" id="username" class="form-control" placeholder="<?php echo e(trans(lang_app_site().'.CP.Driver name')); ?>" value="<?php echo e($user->username); ?>">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="control-label">
                                        <label for="driver_types"><?php echo e(trans(lang_app_site().'.CP.Phone')); ?></label>
                                    </div>
                                    <div class="control-label">
                                        <input type="text" name="mobile" id="mobile" class="form-control" placeholder="<?php echo e(trans(lang_app_site().'.CP.Phone')); ?>" value="<?php echo e($user->mobile); ?>">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="control-label">
                                        <label for="driver_types"><?php echo e(trans(lang_app_site().'.CP.City')); ?></label>
                                    </div>
                                    <div class="control-label">
                                        <select class="form-control" name="city_id" id="city_id">
                                            <option>Select ...</option>
                                            <?php $__currentLoopData = $cities; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $city): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <option value="<?php echo e($city->id); ?>" <?php if($user->city_id == $city->id): ?> selected <?php endif; ?>><?php echo e($city->name_en); ?></option>
                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="control-label">
                                        <label for="driver_types"><?php echo e(trans(lang_app_site().'.CP.Address')); ?></label>
                                    </div>
                                    <div class="control-label">
                                        <input type="text" name="address" id="address" class="form-control" placeholder="<?php echo e(trans(lang_app_site().'.CP.Address')); ?>" value="<?php echo e($user->address); ?>">
                                    </div>
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="form-group">

                                    <div class="control-label col">
                                        <h3 class="form-section font-blue-madison">
                                            Vehicle Information</h3>
                                    </div>
                                </div>
                                <div class="form-group ">
                                    <label class="control-label">Vehicle Photo</label>
                                    <div class="col-md-4">
                                        <div class="fileinput fileinput-new" data-provides="fileinput">
                                            <div class="fileinput-preview thumbnail" data-trigger="fileinput" style="width: 200px; height: 150px;">
                                                <img src="<?php echo e($user->Vehicle->photo ??'http://www.placehold.it/200x150/EFEFEF/AAAAAA&amp;text=no+image'); ?>" alt="" />

                                            </div>
                                            <div>
                                                <span class="btn red btn-outline btn-file">
                                                    <span class="fileinput-new"> Select </span>
                                                    <span class="fileinput-exists"> Change </span>
                                                    <input type="file" name="vehicle_photo" id="vehicle_photo"> </span>
                                                <a href="javascript:;" class="btn red fileinput-exists" data-dismiss="fileinput">
                                                    Remove </a>
                                            </div>
                                        </div>

                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="control-label">
                                        <label for="driver_types"><?php echo e(trans(lang_app_site().'.CP.Manufacturer')); ?></label>
                                    </div>
                                    <div class="control-label">
                                        <input type="text" name="manufacturer" id="manufacturer_id" class="form-control" placeholder="<?php echo e(trans(lang_app_site().'.CP.Manufacturer')); ?>" value="<?php echo e($user->Vehicle->manufacturer ?? ''); ?>">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="control-label">
                                        <label for="driver_types"><?php echo e(trans(lang_app_site().'.CP.Type')); ?></label>
                                    </div>
                                    <div class="control-label">
                                        <input type="text" name="vehicle_type" id="vehicle_type" class="form-control" placeholder="<?php echo e(trans(lang_app_site().'.CP.Type')); ?>" value="<?php echo e($user->Vehicle->vehicle_type ?? ''); ?>">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="control-label">
                                        <label for="driver_types"><?php echo e(trans(lang_app_site().'.CP.Model')); ?></label>
                                    </div>
                                    <div class="control-label">
                                        <input type="text" name="vehicle_model" id="model" class="form-control" placeholder="<?php echo e(trans(lang_app_site().'.CP.Model')); ?>" value="<?php echo e($user->Vehicle->model ?? ''); ?>">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="control-label">
                                        <label for="driver_types"><?php echo e(trans(lang_app_site().'.CP.Color')); ?></label>
                                    </div>
                                    <div class="control-label">
                                        <input type="text" name="vehicle_color" id="color" class="form-control" placeholder="<?php echo e(trans(lang_app_site().'.CP.Color')); ?>" value="<?php echo e($user->Vehicle->color ?? ''); ?>">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="control-label">
                                        <label for="driver_types"><?php echo e(trans(lang_app_site().'.CP.Vehicle plate Number')); ?></label>
                                    </div>
                                    <div class="control-label">
                                        <input type="text" name="vehicle_no" id="no" class="form-control" placeholder="<?php echo e(trans(lang_app_site().'.CP.Vehicle plate Number')); ?>" value="<?php echo e($user->Vehicle->no ?? ''); ?>">
                                    </div>
                                </div>

                            </div>
                        </div>
                        <div class="col">
                            <div class="form-group row">

                                <div class="control-label col">
                                    <h3 class="form-section font-blue-madison">
                                        <?php echo e(trans(lang_app_site().'.CP.Document')); ?></h3>
                                </div>
                            </div>
                            <div class="row">
                                <div class="form-group col-4">
                                    <div class="control-label">
                                        <label for="driver_types"><?php echo e(trans(lang_app_site().'.CP.Car licences')); ?></label>
                                    </div>
                                    <div class="control-label">
                                        <div class="fileinput fileinput-new" data-provides="fileinput">
                                            <div class="fileinput-preview thumbnail symbol symbol-150" data-trigger="fileinput">
                                                <img src="<?php echo e($user->Vehicle->document ??'http://www.placehold.it/200x150/EFEFEF/AAAAAA&amp;text=no+image'); ?>" alt="" />

                                            </div>
                                            <div>
                                                <span class="btn red btn-outline btn-file">
                                                    <span class="fileinput-new"> Select </span>
                                                    <span class="fileinput-exists"> Change </span>
                                                    <input type="file" name="document" id="document">
                                                </span>
                                                <a href="javascript:;" class="btn red fileinput-exists" data-dismiss="fileinput">
                                                    Remove </a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group col-4">
                                    <div class="control-label">
                                        <label for="driver_types"><?php echo e(trans(lang_app_site().'.CP.License driving')); ?></label>
                                    </div>
                                    <div class="control-label">
                                        <div class="fileinput fileinput-new" data-provides="fileinput">
                                            <div class="fileinput-preview thumbnail symbol symbol-150" data-trigger="fileinput">
                                                <img src="<?php echo e($user->Vehicle->license_driving ??'http://www.placehold.it/200x150/EFEFEF/AAAAAA&amp;text=no+image'); ?>" alt="" />

                                            </div>
                                            <div>
                                                <span class="btn red btn-outline btn-file">
                                                    <span class="fileinput-new"> Select </span>
                                                    <span class="fileinput-exists"> Change </span>
                                                    <input type="file" name="license_driving" id="license_driving">
                                                </span>
                                                <a href="javascript:;" class="btn red fileinput-exists" data-dismiss="fileinput">
                                                    Remove </a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group col-4">
                                    <div class="control-label">
                                        <label for="driver_types"><?php echo e(trans(lang_app_site().'.CP.Driver ID')); ?></label>
                                    </div>
                                    <div class="control-label">
                                        <div class="fileinput fileinput-new" data-provides="fileinput">
                                            <div class="fileinput-preview thumbnail symbol symbol-150" data-trigger="fileinput">
                                                <img src="<?php echo e($user->Vehicle->id_no ??'http://www.placehold.it/200x150/EFEFEF/AAAAAA&amp;text=no+image'); ?>" alt="" />

                                            </div>
                                            <div>
                                                <span class="btn red btn-outline btn-file">
                                                    <span class="fileinput-new"> Select </span>
                                                    <span class="fileinput-exists"> Change </span>
                                                    <input type="file" name="vehicle_id_no" id="vehicle_id_no">
                                                </span>
                                                <a href="javascript:;" class="btn red fileinput-exists" data-dismiss="fileinput">
                                                    Remove </a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="form-body">

                        <div class="form-actions">
                            <div class="row">
                                <div class="col-md-12 text-center">
                                    <button type="submit" class="btn btn-circle green btn-md save"><i class="fa fa-check"></i>
                                        <?php echo e(trans(lang_app_site().'.CP.Save')); ?>

                                    </button>
                                    <button type="button" class="btn btn-circle btn-md red" data-dismiss="modal">
                                        <i class="fa fa-times"></i>
                                        <?php echo e(trans(lang_app_site().'.CP.Close')); ?>

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

<script src="<?php echo e(url('/')); ?>/assets/global/plugins/bootstrap-fileinput/bootstrap-fileinput.js" type="text/javascript"></script><?php /**PATH C:\xampp\htdocs\Dragon\resources\views/admin/modals/edit_driver.blade.php ENDPATH**/ ?>