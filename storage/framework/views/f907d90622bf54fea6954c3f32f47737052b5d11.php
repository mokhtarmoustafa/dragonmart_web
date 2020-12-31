<?php $__env->startSection('content'); ?>
    <p align="center">
        <img
                src="<?php echo e(url('assets/apps/img/logo.png')); ?>" width="50%">
    </p>
    <?php echo $__env->make('beautymail::templates.sunny.heading' , [
        'heading' => 'Hello!',
        'level' => 'h1',
    ], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

    <?php echo $__env->make('beautymail::templates.sunny.contentStart', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

    <p style="text-align: center">Welcome to the site <?php echo e($user['name']); ?></p>
    <p style="text-align: center">Your registered email-id is <?php echo e($user['email']); ?> , Please click on the below link to
        verify your email account</p>

    <?php echo $__env->make('beautymail::templates.sunny.contentEnd', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

    <?php echo $__env->make('beautymail::templates.sunny.button', [
        	'title' => 'Verify Email',
        	'link' => url('user/verify', $user->verifyUser->token)
    ], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('beautymail::templates.sunny', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/saudidragonmart/public_html/resources/views/emails/verify_email.blade.php ENDPATH**/ ?>