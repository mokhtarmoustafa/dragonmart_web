<link href="<?php echo e(url('/')); ?>/assets/global/plugins/select2/css/select2.min.css" rel="stylesheet" type="text/css"/>
<link href="<?php echo e(url('/')); ?>/assets/global/plugins/select2/css/select2-bootstrap.min.css" rel="stylesheet"
      type="text/css"/>

<link href="<?php echo e(url('/')); ?>/assets/global/css/components-md.min.css" rel="stylesheet" id="style_components"
      type="text/css"/>
<link href="<?php echo e(url('/')); ?>/assets/global/css/plugins-md.min.css" rel="stylesheet" type="text/css"/>
<!-- END THEME GLOBAL STYLES -->
<div class="modal fade bs-modal-lg" id="assign-driver" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
                <h4 class="modal-title"><i class="fa fa-user-plus"></i> Assign Driver<span
                            class="badge badge-primary name "
                            style="text-transform: inherit"></span></h4>
            </div>
            <div class="modal-body">
                <div class="portlet-body form">

                    <?php echo Form::open(['method'=>'PUT','class'=>'form-horizontal form-bordered form-row-stripped','url'=>url(getAuth()->type.'/assign-driver'),'files'=>true,'id'=>'formAssignDriver']); ?>

                    <div class="alert alert-danger" style="display: none">

                    </div>

                    <div class="form-body">

                        <input type="hidden" name="order_id" value="<?php echo e($order_id); ?>">
                        <div class="form-group">
                            <div class="control-label col-md-2">
                                <label for="driver_types">Delivery method</label>
                            </div>
                            <div class="col-md-4">
                                <select class="form-control" name="delivery_method" id="delivery_method">
                                    <option>Select ...</option>
                                    <?php $__currentLoopData = $delivery_method; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $method): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <option value="<?php echo e($method->type); ?>"
                                                data-id="<?php echo e($method->id); ?>"><?php echo e($method->name); ?></option>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

                                </select>
                            </div>
                        </div>
                        <div class="form-group driver_name" style="display: none;">
                            <div class="control-label col-md-2">
                                <label for="driver_name">Driver name</label>
                            </div>
                            <div class="col-md-4">
                                <select class="form-control select2" name="driver_id" id="driver_id">
                                    <option>Select ...</option>

                                    <?php $__currentLoopData = $driver_dragonmart; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $driver): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <option value="<?php echo e($driver->id); ?>"><?php echo e($driver->username); ?></option>
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
                                        Assign
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

<script src="<?php echo e(url('/')); ?>/assets/global/plugins/select2/js/select2.full.min.js" type="text/javascript"></script>
<script src="<?php echo e(url('/')); ?>/assets/pages/scripts/components-select2.min.js" type="text/javascript"></script>


<?php /**PATH /home/saudidragonmart/public_html/resources/views/admin/modals/assigned-driver.blade.php ENDPATH**/ ?>