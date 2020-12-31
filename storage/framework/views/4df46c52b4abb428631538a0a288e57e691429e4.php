<?php $__env->startSection('content'); ?>
    <div class="main-content shop-page inner-page about-page">
        <div class="container">
            <div class="breadcrumbs">
                <a href="<?php echo e(url('site/home')); ?>"><?php echo e(__('app.site.home.home')); ?></a> \ <span
                    class="current"><?php echo e(__('app.site.home.about_us')); ?></span>
            </div>

            <?php $__currentLoopData = $abouts; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $about): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <?php if($loop->iteration%2 == 0): ?>
                    <div class="row about-info content-form">
                        <div class="col-xs-12 col-sm-5 col-md-6">
                            <?php if($about->media_type == 'image'): ?>
                                <img src="<?php echo e($about->media); ?>" alt="">
                            <?php else: ?>
                                <video src="<?php echo e($about->media); ?>#t=1" controls width="560" height="315"></video>

                                



                            <?php endif; ?>
                        </div>
                        <div class="col-xs-12 col-sm-7 col-md-6">
                            <div class="info">
                                <h3 class="main-title"><?php echo e($about->title); ?></h3>
                                <p class="des"><?php echo $about->content; ?></p>
                            </div>
                        </div>
                    </div>
                <?php else: ?>
                    <div class="row about-info content-form">
                        <div class="col-xs-12 col-sm-7 col-md-6">
                            <div class="info">
                                <h3 class="main-title"><?php echo e($about->title); ?></h3>
                                <p class="des"><?php echo $about->content; ?></p>
                            </div>
                        </div>
                        <div class="col-xs-12 col-sm-5 col-md-6">
                            <?php if($about->media_type == 'image'): ?>
                                <img src="<?php echo e($about->media); ?>" alt="">
                            <?php else: ?>




                                <video src="<?php echo e($about->media); ?>#t=1" controls width="560" height="315"></video>

                            <?php endif; ?>
                        </div>
                    </div>
                <?php endif; ?>

            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

        </div>
    </div>

<?php $__env->stopSection(); ?>

<?php echo $__env->make(site_layout_vw().'.index', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/saudidragonmart/public_html/resources/views/site/about.blade.php ENDPATH**/ ?>