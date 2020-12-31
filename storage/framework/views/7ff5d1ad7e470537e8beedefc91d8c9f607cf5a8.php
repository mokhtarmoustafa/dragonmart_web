<?php $__env->startSection('content'); ?>
    <div class="main-content merchant-page main-content-grid inner-page">
        <div class="container">
            <div class="row">
                <div class="col-xs-12 col-sm-7 col-md-8 col-lg-9 content-offset" style="margin-top:0;">
                    <div class="breadcrumbs">
                        <a href="#"><?php echo e(trans(lang_app_site().'.home.home')); ?></a> \ <span class="current"><?php echo e(trans(lang_app_site().'.services.services')); ?></span>
                    </div>
                    <div class="categories-content">
                        <h4 class="shop-title"><?php echo e(trans(lang_app_site().'.services.services')); ?></h4>
                        <div class="top-control box-has-content">
                            <div class="control">
                                
                                <div class="control-button">
                                    <a href="#" class="grid-button active"><span class="icon"><i class="fa fa-th-large" aria-hidden="true"></i> </span><?php echo e(trans(lang_app_site().'.filter.grid')); ?></a>
                                    <a href="#" class="list-button"><span class="icon"><i class="fa fa-th-list" aria-hidden="true"></i></span> <?php echo e(trans(lang_app_site().'.filter.list')); ?></a>
                                </div>
                            </div>
                        </div>
                        <div class="product-container auto-clear grid-style equal-container box-has-content">


                            <?php $__currentLoopData = $services; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $service): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <div class="merchant-item product-item layout1 col-ts-12 col-xs-6 col-sm-6 col-md-4 col-lg-4 no-padding">
                                <?php echo $__env->make(site_sub_view_vw().'.service',['service'=>$service], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                                </div>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>





                        </div>

                        <?php echo $__env->make(site_sub_view_vw().'.paging',['current_page'=>$service->current_page , 'total_pages'=>$service->total_pages ], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>



                    </div>
                </div>
                <?php echo $__env->make(site_sub_view_vw().'.sideservices', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

            </div>
        </div>
    </div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make(site_layout_vw().'.index', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/saudidragonmart/public_html/resources/views/site/services/list.blade.php ENDPATH**/ ?>