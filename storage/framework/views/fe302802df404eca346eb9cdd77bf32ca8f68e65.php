<?php $__env->startSection('content'); ?>
    <div class="main-content merchant-page main-content-grid inner-page">
        <div class="container">
            <div class="row">
                <div class="col-xs-12 col-sm-7 col-md-8 col-lg-9 content-offset" style="margin-top:0;">
                    <div class="breadcrumbs">
                        <a href="#"><?php echo e(trans(lang_app_site().'.home.home')); ?></a> \ <span class="current"><?php echo e(trans(lang_app_site().'.home.merchants')); ?></span>
                    </div>
                    <div class="categories-content">
                        <h4 class="shop-title"><?php echo e(isset($category)?$category->name : trans(lang_app_site().'.home.merchants')); ?></h4>
                        <div class="top-control box-has-content">
                            <div class="control">
                                <div class="select-item">
                                    <select data-placeholder="All Categories" class="form-control" id="pageSelect">

                                        <option value="10" >10 <?php echo e(trans(lang_app_site().'.filter.per_page')); ?></option>
                                        <option value="12" >12 <?php echo e(trans(lang_app_site().'.filter.per_page')); ?></option>
                                        <option value="15" >15 <?php echo e(trans(lang_app_site().'.filter.per_page')); ?></option>
                                        <option value="18" >18 <?php echo e(trans(lang_app_site().'.filter.per_page')); ?></option>
                                        <option value="21" >21 <?php echo e(trans(lang_app_site().'.filter.per_page')); ?></option>
                                    </select>
                                </div>
                                <div class="control-button">
                                    <a href="#" class="grid-button active"><span class="icon"><i class="fa fa-th-large"
                                                                                                 aria-hidden="true"></i> </span><?php echo e(trans(lang_app_site().'.filter.grid')); ?></a>
                                    <a href="#" class="list-button"><span class="icon"><i class="fa fa-th-list"
                                                                                          aria-hidden="true"></i></span>
                                        <?php echo e(trans(lang_app_site().'.filter.list')); ?></a>
                                </div>
                            </div>
                        </div>


                        <div class="product-container auto-clear grid-style equal-container box-has-content">

                            <?php $__currentLoopData = $merchants->items; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $m): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <div class="merchant-item product-item layout1 col-ts-12 col-xs-6 col-sm-6 col-md-4 col-lg-4 no-padding">
                                <div class="product-inner equal-elem">
                                    <div class="thumb">

                                        <a href="<?php echo e(url(site_url().'/merchant-page')); ?>/<?php echo e($m->id); ?>" class="thumb-link">
                                            <img src=" <?php echo e(isset($m->store_images[0] ) ? $m->store_images[0]->image:url('/assets').'/no-product.jpg'); ?>"
                                                                                      alt="" style="height: 202px;">
                                        </a>
                                    </div>
                                    <div class="info">
                                        <a href="<?php echo e(url(site_url().'/merchant-page')); ?>/<?php echo e($m->id); ?>" class="product-name"><?php echo e($m->username); ?></a>

                                        <div class="price">
                                            <span><?php echo e($m->city->name_en); ?></span>
                                        </div>
                                    </div>
                                </div>
                            </div>

                             <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

                        </div>


                        <?php echo $__env->make(site_sub_view_vw().'.paging',['current_page'=>$merchants->current_page , 'total_pages'=>$merchants->total_pages ], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>


                    </div>
                </div>

                     <?php echo $__env->make(site_sub_view_vw().'.sidemerchant', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>



               </div>
           </div>
       </div>
   <?php $__env->stopSection(); ?>
<?php echo $__env->make(site_layout_vw().'.index', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/saudidragonmart/public_html/resources/views/site/merchants/list.blade.php ENDPATH**/ ?>