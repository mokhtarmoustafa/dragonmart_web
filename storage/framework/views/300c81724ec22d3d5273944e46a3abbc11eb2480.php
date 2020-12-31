<?php $__env->startSection('content'); ?>
    <p align="center">
        <img src="<?php echo e(url('assets/apps/img/logo.png')); ?>" width="50%">
    </p>
    <?php echo $__env->make('beautymail::templates.sunny.heading' , [
        'heading' => 'Replication!',
        'level' => 'h1',
    ], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

    <?php echo $__env->make('beautymail::templates.sunny.contentStart', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

    <h4 style="font-weight: bold"><?php echo e($contact['message']); ?></h4>
    <p>replying:<?php echo e($contact['reply'] ?? 'No reply'); ?></p>

    <?php echo $__env->make('beautymail::templates.sunny.contentEnd', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

    
    
    
    

<?php $__env->stopSection(); ?>
<?php echo $__env->make('beautymail::templates.sunny', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/saudidragonmart/public_html/resources/views/emails/reply_contact.blade.php ENDPATH**/ ?>