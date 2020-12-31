<?php $__env->startSection('content'); ?>

<div class="card card-custom">

  <div class="card-header">

    <div class="card-title">
      <h3 class="card-label"><?php echo e(trans(lang_app_site().'.CP.'.$main_title)); ?>

    </div>

  </div>
  <div class="card-body">
    <div class="table-container">
      <table class="table  table-hover table-checkable order-column"
             id="notification_tbl">
          <thead>
          <tr>
              <th>#</th>
              <th><?php echo e(trans(lang_app_site().'.CP.Sender')); ?> </th>
              <th> <?php echo e(trans(lang_app_site().'.CP.Notification')); ?></th>
              <th> <?php echo e(trans(lang_app_site().'.CP.Date')); ?></th>
              <th> <?php echo e(trans(lang_app_site().'.CP.Action')); ?></th>
          </tr>
          </thead>
      </table>

    </div>

  </div>
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

<?php echo $__env->make(merchant_layout_vw().'.index', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/saudidragonmart/public_html/resources/views/merchant/V2/constants/notifications.blade.php ENDPATH**/ ?>