<?php $__env->startSection('css'); ?>
    <!-- BEGIN PAGE LEVEL PLUGINS -->
    <!-- END THEME GLOBAL STYLES -->
<?php $__env->stopSection(); ?>
<?php $__env->startSection('content'); ?>
    <div class="row">
        <div class="col-md-12">
            <!-- BEGIN EXAMPLE TABLE PORTLET-->
            <div class="card card-custom shadow">
                <div class="card-header">
                    <div class="card-title">
                        <i class="<?php echo e($icon); ?>"></i>
                        &nbsp;
                        <span class="caption-subject bold uppercase"> <?php echo e(trans(lang_app_site().'.CP.'.$main_title)); ?></span>
                    </div>
                    <div class="card-toolbar">
                        <a href="javascript:;" class="btn btn-circle btn-primary add-send-notification-mdl">
                            <i class="fa fa-send"></i>
                            <span class="hidden-xs"> <?php echo e(trans(lang_app_site().'.CP.Send Public Notification')); ?> </span>
                        </a>
                    </div>

                </div>
                <div class="card-body">

                    <table class="table table-striped table-bordered table-hover table-checkable order-column"
                           id="notification_tbl">
                        <thead>
                        <tr>
                            <th>#</th>
                            <th> <?php echo e(trans(lang_app_site().'.CP.Sender')); ?></th>
                            <th> <?php echo e(trans(lang_app_site().'.CP.Notification')); ?></th>
                            <th> <?php echo e(trans(lang_app_site().'.CP.Date')); ?></th>
                            <th> <?php echo e(trans(lang_app_site().'.CP.Action')); ?></th>
                        </tr>
                        </thead>
                    </table>
                </div>
            </div>
            <!-- END EXAMPLE TABLE PORTLET-->
        </div>
    </div>

    <div class="modal fade bs-modal-lg" id="general-notification" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
                    <h4 class="modal-title"><i class="fa fa-send"></i> Send public notification<span
                            class="badge badge-primary name "
                            style="text-transform: inherit"></span></h4>
                </div>
                <div class="modal-body">
                    <div class="portlet-body form">

                        <?php echo Form::open(['method' => 'POST', 'class' => 'form-horizontal form-bordered form-row-stripped', 'url' => url(getAuth()->type . '/general-notification/create'), 'files' => true, 'id' => 'generalNotificationFrm']); ?>


                        <div class="alert alert-danger" style="display: none">

                        </div>
                        <div class="form-body">

                            <div class="form-group">
                                <div class="control-label col-md-2">
                                    <label for="message">Message</label>
                                </div>
                                <div class="control-label col-md-10">
                                <textarea name="message" id="message" class="form-control" rows="5"
                                          placeholder="Message ..."></textarea>
                                </div>

                            </div>
                        </div>

                        <div class="form-body">

                            <div class="form-actions">
                                <div class="row">
                                    <div class="col-md-12 text-center">
                                        <button type="submit" class="btn btn-circle green btn-md save"><i
                                                class="fa fa-check"></i>
                                            Send
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
<?php $__env->stopSection(); ?>

<?php $__env->startSection('js'); ?>
    <!-- BEGIN PAGE LEVEL PLUGINS -->
    <script src="<?php echo e(url('/')); ?>/assets/global/scripts/datatable.js" type="text/javascript"></script>
    <script src="<?php echo e(url('/')); ?>/assets/global/plugins/datatables/datatables.min.js" type="text/javascript"></script>
    <script src="<?php echo e(url('/')); ?>/assets/global/plugins/datatables/plugins/bootstrap/datatables.bootstrap.js"
            type="text/javascript"></script>
    <!-- END PAGE LEVEL PLUGINS -->
    <!-- BEGIN THEME GLOBAL SCRIPTS -->
    <script src="<?php echo e(url('/')); ?>/assets/global/scripts/app.min.js" type="text/javascript"></script>
    <!-- END THEME GLOBAL SCRIPTS -->
    <!-- BEGIN PAGE LEVEL SCRIPTS -->
    <script src="<?php echo e(url('/')); ?>/assets/pages/scripts/table-datatables-managed.min.js" type="text/javascript"></script>
    <!-- END PAGE LEVEL SCRIPTS -->
    <script src="<?php echo e(url('/')); ?>/assets/js/notifications.js" type="text/javascript"></script>

<?php $__env->stopSection(); ?>

<?php echo $__env->make(admin_layout_vw().'.index', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/saudidragonmart/public_html/resources/views/admin/constants/notifications.blade.php ENDPATH**/ ?>