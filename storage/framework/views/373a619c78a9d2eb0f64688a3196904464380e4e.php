<link href="<?php echo e(url('/')); ?>/assets/global/plugins/bootstrap-fileinput/bootstrap-fileinput.css" rel="stylesheet"
      type="text/css"/>

<div class="modal fade bs-modal-lg" id="editDriver" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
                <h4 class="modal-title"><i class="fa fa-user-plus"></i> Edit Driver<span
                            class="badge badge-primary name "
                            style="text-transform: inherit"></span></h4>
            </div>
            <div class="modal-body">
                <div class="portlet-body form">

                    <?php echo Form::open(['method'=>'PUT','class'=>'form-horizontal form-bordered form-row-stripped','url'=>url(((getAuth()->type == 'admin') ? admin_user_tab_url() : getAuth()->type).'/user-driver/'.$user->id.'/edit'),'files'=>true,'id'=>'formEditDriver']); ?>

                    <div class="alert alert-danger" style="display: none">

                    </div>

                    <div class="form-body">

                        <div class="form-group">

                            <div class="control-label col-md-4">
                                <h3 class="form-section font-blue-madison" style="display: block;text-align: left">
                                    General Information</h3></div>
                        </div>
                        <div class="form-group ">
                            <label class="control-label col-md-2">Photo</label>
                            <div class="col-md-4">
                                <div class="fileinput fileinput-new" data-provides="fileinput">
                                    <div class="fileinput-preview thumbnail" data-trigger="fileinput"
                                         style="width: 200px; height: 150px;">
                                        <img src="<?php echo e($user->image ??'http://www.placehold.it/200x150/EFEFEF/AAAAAA&amp;text=no+image'); ?>"
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
                            <label class="control-label col-md-2">Vehicle Photo</label>
                            <div class="col-md-4">
                                <div class="fileinput fileinput-new" data-provides="fileinput">
                                    <div class="fileinput-preview thumbnail" data-trigger="fileinput"
                                         style="width: 200px; height: 150px;">
                                        <img src="<?php echo e($user->Vehicle->photo ??'http://www.placehold.it/200x150/EFEFEF/AAAAAA&amp;text=no+image'); ?>"
                                             alt=""/>

                                    </div>
                                    <div>
                                                            <span class="btn red btn-outline btn-file">
                                                                <span class="fileinput-new"> Select </span>
                                                                <span class="fileinput-exists"> Change </span>
                                                                <input type="file" name="vehicle_photo"
                                                                       id="vehicle_photo"> </span>
                                        <a href="javascript:;" class="btn red fileinput-exists"
                                           data-dismiss="fileinput">
                                            Remove </a>
                                    </div>
                                </div>

                            </div>
                        </div>
                        <div class="form-group">
                            <div class="control-label col-md-2">
                                <label for="driver_types">Driver name</label>
                            </div>
                            <div class="col-md-4">
                                <input type="text" name="username" id="username" class="form-control"
                                       placeholder="user name ..." value="<?php echo e($user->username); ?>">
                            </div>
                            <div class="control-label col-md-2">
                                <label for="driver_types">Email</label>
                            </div>
                            <div class="col-md-4">
                                <input type="email" name="email" id="email" class="form-control"
                                       placeholder="Email ..." value="<?php echo e($user->email); ?>">
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="control-label col-md-2">
                                <label for="driver_types">Phone</label>
                            </div>
                            <div class="control-label col-md-4">
                                <input type="text" name="mobile" id="mobile" class="form-control"
                                       placeholder="Phone ..." value="<?php echo e($user->mobile); ?>">
                            </div>
                            <div class="control-label col-md-2">
                                <label for="driver_types">City</label>
                            </div>
                            <div class="col-md-4">
                                <select class="form-control" name="city_id" id="city_id">
                                    <option>Select ...</option>
                                    <?php $__currentLoopData = $cities; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $city): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <option value="<?php echo e($city->id); ?>"
                                                <?php if($user->city_id == $city->id): ?> selected <?php endif; ?>><?php echo e($city->name_en); ?></option>
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
                                       placeholder="Address ..." value="<?php echo e($user->mobile ?? ''); ?>">
                            </div>
                            
                            
                            
                            
                            
                            
                            
                            
                            
                            
                            

                        </div>

                        <div class="form-group">

                            <div class="control-label col-md-4">
                                <h3 class="form-section font-blue-madison" style="display: block;text-align: left">
                                    Vehicle Information</h3></div>
                        </div>
                        <div class="form-group">
                            <div class="control-label col-md-2">
                                <label for="driver_types">Manufacturer</label>
                            </div>
                            <div class="col-md-4">
                                <select class="form-control" name="manufacturer_id" id="manufacturer_id">
                                    <option>Select ...</option>
                                    <?php $__currentLoopData = $manufacturers; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $manufacturer): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <option value="<?php echo e($manufacturer->id); ?>"
                                                <?php if(isset($user->Vehicle) && $user->Vehicle->CarType->manufacturer_id == $manufacturer->id): ?> selected <?php endif; ?>><?php echo e($manufacturer->title); ?></option>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </select>
                            </div>
                            <div class="control-label col-md-2">
                                <label for="driver_types">Type</label>
                            </div>
                            <div class="col-md-4">
                                <select class="form-control" name="vehicle_type_id" id="car_type_id">
                                    <?php $__currentLoopData = $car_types; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $car_type): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <option value="<?php echo e($car_type->id); ?>"
                                                <?php if(isset($user->Vehicle) && $user->Vehicle->CarType->id == $car_type->id): ?> selected <?php endif; ?>><?php echo e($car_type->title); ?></option>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </select>
                            </div>
                        </div>
                        <div class="form-group">

                            <div class="control-label col-md-2">
                                <label for="driver_types">Model</label>
                            </div>
                            <div class="control-label col-md-4">
                                <input type="text" name="vehicle_model" id="model" class="form-control"
                                       placeholder="Year ..." value="<?php echo e($user->Vehicle->model ?? ''); ?>">
                            </div>
                            <div class="control-label col-md-2">
                                <label for="driver_types">Color</label>
                            </div>
                            <div class="control-label col-md-4">
                                <input type="text" name="vehicle_color" id="color" class="form-control"
                                       placeholder="Color ..." value="<?php echo e($user->Vehicle->color ?? ''); ?>">
                            </div>
                        </div>
                        <div class="form-group">

                            <div class="control-label col-md-2">
                                <label for="driver_types">Vehicle No.</label>
                            </div>
                            <div class="control-label col-md-4">
                                <input type="text" name="vehicle_no" id="no" class="form-control"
                                       placeholder="Vehicle No ..." value="<?php echo e($user->Vehicle->no ?? ''); ?>">
                            </div>
                        </div>

                        <div class="form-group">

                            <div class="control-label col-md-4">
                                <h3 class="form-section font-blue-madison" style="display: block;text-align: left">
                                    Vehicle Document</h3></div>
                        </div>
                        <div class="form-group">

                            <div class="control-label col-md-2">
                                <label for="driver_types">Car licences</label>
                            </div>
                            <div class="control-label col-md-4">
                                <input type="file" name="document" id="document" class="form-control"
                                       placeholder="Car licences ...">
                            </div>
                            <div class="control-label col-md-2">
                                <label for="driver_types">License driving</label>
                            </div>
                            <div class="control-label col-md-4">
                                <input type="file" name="license_driving" id="license_driving" class="form-control"
                                       placeholder="License driving ...">
                            </div>
                        </div>
                        <div class="form-group">

                            
                            
                            
                            
                            
                            
                            
                            <div class="control-label col-md-2">
                                <label for="driver_types">Driver ID</label>
                            </div>
                            <div class="control-label col-md-4">
                                <input type="file" name="vehicle_id_no" id="vehicle_id_no" class="form-control"
                                       placeholder="Driver ID ...">
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
<?php /**PATH /home/saudidragonmart/public_html/resources/views/admin/modals/edit_driver.blade.php ENDPATH**/ ?>