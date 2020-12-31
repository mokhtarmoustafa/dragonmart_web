<?php $__env->startSection('content'); ?>
    <div class="main-content merchant-page main-content-grid inner-page">
        <div class="container">
            <div class="row">
                <div class="col-xs-12 col-sm-7 col-md-8 col-lg-9 content-offset" style="margin-top:0;">
                    <div class="breadcrumbs">
                        <a href="#">Home</a> \ <span class="current">Products</span>
                    </div>
                    <div class="categories-content">
                        <div class="top-control box-has-content">
                            <div class="control">

                                <div class="control-button">
                                    <a href="#" class="grid-button active"><span class="icon"><i class="fa fa-th-large"
                                                                                                 aria-hidden="true"></i> </span>Grid</a>
                                    <a href="#" class="list-button"><span class="icon"><i class="fa fa-th-list"
                                                                                          aria-hidden="true"></i></span>
                                        List</a>
                                </div>
                            </div>
                        </div>
                        <div class="product-container auto-clear grid-style equal-container box-has-content">



                              <?php $__currentLoopData = $products->items; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $product): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <div class="product-item layout1 col-ts-12 col-xs-6 col-sm-6 col-md-4 col-lg-4 no-padding">
                                <?php echo $__env->make(site_sub_view_vw().'.product',['product'=>$product], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                            </div>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

                        </div>

                        <div class="pagination">
                            <div class="pagination">
                                <ul class="list-page">
                                    <?php $route = request()->segment(2);?>


                                    <?php if($products->total_pages > 1 ): ?>
                                        <?php for($i=1; $i <= $products->total_pages ; ++$i): ?>


                                                <li><a href="<?php echo e(url(site_url().'/'.$route)); ?>/<?php echo e(request()->segment(3)); ?>/<?php echo e(request()->segment(4)); ?>/<?php echo e((request()->segment(5)) ? request()->segment(5) : 10); ?>/<?php echo e($i); ?>" class="page-number <?php echo e(($i == $products->current_page)? 'current' : ''); ?>"><?php echo e($i); ?></a></li>

                                        <?php endfor; ?>

                                        <?php if($products->current_page < $products->total_pages): ?>


                                                <li><a href="<?php echo e(url(site_url().'/'.$route)); ?>/<?php echo e(request()->segment(3)); ?>/<?php echo e(request()->segment(4)); ?>/<?php echo e((request()->segment(5)) ? request()->segment(5) : 10); ?>/<?php echo e($i); ?>" class="nav-button">Next</a></li>


                                            <?php endif; ?>
                                    <?php endif; ?>

                                </ul>
                            </div>
                        </div>

                    </div>
                </div>


                <?php echo $__env->make(site_sub_view_vw().'.sidemerchant', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
            </div>
        </div>
    </div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make(site_layout_vw().'.index', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/saudidragonmart/public_html/resources/views/site/products/list.blade.php ENDPATH**/ ?>