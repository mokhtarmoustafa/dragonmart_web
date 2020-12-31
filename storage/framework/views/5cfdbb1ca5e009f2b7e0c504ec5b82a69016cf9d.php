<?php $__env->startSection('content'); ?>
    <div class="main-content merchant-page main-content-grid inner-page">
        <div class="container">
            <div class="row">
                <div class="col-xs-12 col-sm-7 col-md-8 col-lg-9 content-offset" style="margin-top:0;">
                    <div class="breadcrumbs">
                        <a href="<?php echo e(url('site/home')); ?>"><?php echo e(trans('app.site.home.home')); ?></a> \ <span
                                class="current"><?php echo e(trans('app.site.provider')); ?></span>
                    </div>
                    <div class="categories-content">
                        <h4 class="shop-title"><?php echo e($service->name); ?></h4>
                        <div class="top-control box-has-content">
                            <div class="control">
                                <div class="select-item">
                                    <select data-placeholder="All Categories" class="form-control" id="pageSelect">
                                        <option value="10">10 <?php echo e(trans('app.site.per_page')); ?></option>
                                        <option value="12">12 <?php echo e(trans('app.site.per_page')); ?></option>
                                        <option value="15">15 <?php echo e(trans('app.site.per_page')); ?></option>
                                        <option value="18">18 <?php echo e(trans('app.site.per_page')); ?></option>
                                        <option value="21">21 <?php echo e(trans('app.site.per_page')); ?></option>
                                    </select>
                                </div>
                                <div class="control-button">
                                    <a href="#" class="grid-button active"><span class="icon"><i class="fa fa-th-large"
                                                                                                 aria-hidden="true"></i> </span><?php echo e(trans('app.site.filter.grid')); ?>

                                    </a>
                                    <a href="#" class="list-button"><span class="icon"><i class="fa fa-th-list"
                                                                                          aria-hidden="true"></i></span>
                                        <?php echo e(trans('app.site.filter.list')); ?></a>
                                </div>
                            </div>
                        </div>
                        <div class="product-container auto-clear grid-style equal-container box-has-content">


                            <?php $__currentLoopData = $providers->items; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $s): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <?php echo $__env->make(site_sub_view_vw().'.oneservice',['provider'=>$s , 'service'], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

                        </div>
                        <?php echo $__env->make(site_sub_view_vw().'.paging',['current_page'=>$providers->current_page , 'total_pages'=>(int)$providers->total_pages ], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

                    </div>
                </div>

                <?php echo $__env->make(site_sub_view_vw().'.sideservices', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
            </div>
        </div>
    </div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make(site_layout_vw().'.index', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/saudidragonmart/public_html/resources/views/site/services/service-providers.blade.php ENDPATH**/ ?>