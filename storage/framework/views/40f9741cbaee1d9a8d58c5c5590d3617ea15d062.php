
<div class="page-bar">
    <ul class="page-breadcrumb">
        <li>
            <i class="<?php echo e($icon ?? 'fa fa-circle'); ?>"></i>
            <a href="<?php echo e($back_url ?? ''); ?>"><?php echo e(trans(lang_app_site().'.CP.'.($main_title ?? 'home')   )); ?> </a>
            <?php if(isset($sub_title)): ?>
                <i class="fa fa-angle-right"></i>
            <?php endif; ?>

        </li>
        <?php if(isset($sub_title)): ?>
            <li>
                <span><?php echo trans(lang_app_site().'.CP.'.$sub_title); ?>  </span>
            </li>
        <?php endif; ?>
    </ul>
</div><?php /**PATH C:\xampp\htdocs\Dragon\resources\views/merchant/layout/breadcrumb.blade.php ENDPATH**/ ?>