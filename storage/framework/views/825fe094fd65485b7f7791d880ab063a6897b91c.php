<?php $__env->startSection('content'); ?>

<div class="card card-custom">

  <div class="card-header">

    <div class="card-title">
      <h3 class="card-label"><?php echo e(trans(lang_app_site().'.CP.'.$sub_title)); ?>

    </div>

    <div class="card-toolbar">
      <a href="<?php echo e(url('merchant/category/private/create')); ?>" class="btn btn-circle btn-primary add-category-mdl" >
        <i class="fa fa-plus"></i>
        <span class="hidden-xs"> <?php echo e(trans(lang_app_site().'.CP.New Store Category')); ?> </span>
      </a>
    </div>
  </div>
  <div class="card-body">
    <div class="table-container">
      <table class="table  table-hover table-checkable order-column" id="category_tbl">
          <thead>
          <tr>
              <th>#</th>
              <th> <?php echo e(trans(lang_app_site().'.CP.Icon')); ?></th>
              <th> <?php echo e(trans(lang_app_site().'.CP.Name')); ?> (English)</th>
              <th> <?php echo e(trans(lang_app_site().'.CP.Name')); ?> (Arabic)</th>
              <th> <?php echo e(trans(lang_app_site().'.CP.Action')); ?></th>
          </tr>
          </thead>
      </table>


    </div>

  </div>
</div>





<?php $__env->stopSection(); ?>

<?php $__env->startSection('js'); ?>
<script src="<?php echo e(url('/')); ?>/assets/global/scripts/datatable.js" type="text/javascript"></script>
<script src="<?php echo e(url('/')); ?>/assets/global/plugins/datatables/datatables.min.js" type="text/javascript"></script>
<script src="<?php echo e(url('/')); ?>/assets/global/plugins/datatables/plugins/bootstrap/datatables.bootstrap.js"
        type="text/javascript"></script>


    <script src="<?php echo e(url('/')); ?>/assets/pages/scripts/table-datatables-managed.min.js" type="text/javascript"></script>
    <!-- END PAGE LEVEL SCRIPTS -->
    <script src="<?php echo e(url('/')); ?>/assets/js/categories.js" type="text/javascript"></script>

<?php $__env->stopSection(); ?>

<?php echo $__env->make(merchant_layout_vw().'.index', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/saudidragonmart/public_html/resources/views/merchant/V2/constants/categories-merchant.blade.php ENDPATH**/ ?>