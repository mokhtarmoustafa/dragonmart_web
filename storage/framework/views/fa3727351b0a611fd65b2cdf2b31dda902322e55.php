<div class="col-xs-12 col-sm-5 col-md-4 col-lg-3 sidebar">
    <form>
        <?php

            $parameters = \Request::query();
            $merchants =merchants();

        ?>

        <?php if(request()->segment(2)  != 'merchant-page'): ?>
            <div class="widget widget-categories">
                <h5 class="widgettitle"><?php echo e(trans(lang_app_site().'.home.merchants')); ?></h5>
                <ul class="list-categories scrollable-area" style="max-height: 200px;">


                    <?php $__currentLoopData = $merchants; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $m): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <li><input type="checkbox" name="merchan_filter[]" id="nc<?php echo e($m->id); ?>"
                                   value="<?php echo e($m->id); ?>" <?php echo e((isset($parameters['merchan_filter']) && in_array(  $m->id , $parameters['merchan_filter']) ) ? 'checked' : ''); ?>><label
                                    for="nc<?php echo e($m->id); ?>" class="label-text"><?php echo e($m->username); ?></label>
                        </li>

                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>


                </ul>
            </div>
        <?php endif; ?>


        <?php if(request()->segment(2)  != 'category'): ?>
            <div class="widget widget-brand">
                <h5 class="widgettitle"><?php echo e(trans(lang_app_site().'.home.categories')); ?></h5>
                <ul class="list-categories">
                    <?php
                        $cats =Categories();
                    ?>
                    <?php $__currentLoopData = $cats; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $cat): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <li>
                            <input type="checkbox" name="categories_filter[]" id="catf<?php echo e($cat->id); ?>"
                                   value="<?php echo e($cat->id); ?>" <?php echo e((isset($parameters['categories_filter']) && in_array(  $cat->id , $parameters['categories_filter']) ) ? 'checked' : ''); ?>>
                            <label for="catf<?php echo e($cat->id); ?>" class="label-text"><?php echo e($cat->name); ?></label>
                        </li>

                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </ul>
            </div>
        <?php endif; ?>
        <div class="widget widget-brand">
            <h5 class="widgettitle"><?php echo e(trans(lang_app_site().'.filter.cities')); ?></h5>
            <ul class="list-categories">
                <select class="input-info chosen-select" name="city">
                    <?php
                        $cities=cities();
                    ?>
                    <?php $__currentLoopData = $cities; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $city): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <option value="all"><?php echo e(trans(lang_app_site().'.filter.all_cities')); ?></option>
                        <option value="<?php echo e($city->id); ?>" <?php echo e((isset($parameters['city']) &&  $city->id  ==  $parameters['city'] ) ? 'selected' : ''); ?> ><?php echo e($city->name_en); ?></option>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </select>
            </ul>
        </div>
        <div class="widget widget_filter_price box-has-content">
            <h3 class="widgettitle"><?php echo e(trans(lang_app_site().'.filter.price')); ?></h3>
            <div class="price-filter">
                <div data-label-reasult="<?php echo e(trans(lang_app_site().'.filter.price')); ?>:" data-min="1" data-max="9000"
                     data-unit="<?php echo e(trans(lang_app_site().'.home.sar')); ?>"
                     class="slider-range-price "
                     data-value-min="<?php echo e((isset($parameters['min_price_filter'])  ) ? $parameters['min_price_filter'] : '1'); ?> "
                     data-value-max="<?php echo e((isset($parameters['max_price_filter'])  ) ? $parameters['max_price_filter'] : '9000'); ?>"></div>
                <div class="amount-range-price"><?php echo e(trans(lang_app_site().'.filter.price')); ?>: <span
                            class="from"><?php echo e((isset($parameters['min_price_filter'])  ) ? $parameters['min_price_filter'] : '1'); ?>  <?php echo e(trans(lang_app_site().'.home.sar')); ?></span>
                    -
                    <span class="to"><?php echo e((isset($parameters['max_price_filter'])  ) ? $parameters['max_price_filter'] : '9000'); ?> <?php echo e(trans(lang_app_site().'.home.sar')); ?></span>
                </div>
            </div>
        </div>
        <div class="widget widget_filter_price box-has-content mner">
            <h3 class="widgettitle"><?php echo e(trans(lang_app_site().'.filter.near_by')); ?></h3>
            <div class="near-by-filter">
                <div data-label-reasult="<?php echo e(trans(lang_app_site().'.filter.near_by')); ?>:" data-min="0" data-max="30"
                     data-unit="K"
                     data-distance="<?php echo e(trans(lang_app_site().'.filter.distance')); ?>"
                     class="slider-near-by"
                     data-value-min="<?php echo e((isset($parameters['min_near_filter'])  ) ? $parameters['min_near_filter'] : '0'); ?> "
                     data-value-max="<?php echo e((isset($parameters['max_near_filter'])  ) ? $parameters['max_near_filter'] : '30'); ?> "></div>


            </div>
            <div class="amount-range-nearby" style="margin-top: 10px;"><?php echo e(trans(lang_app_site().'.filter.distance')); ?>:
                <span class="from"><?php echo e((isset($parameters['min_near_filter'])  ) ? $parameters['min_near_filter'] : '0'); ?>  K</span>
                - <span class="to"><?php echo e((isset($parameters['max_near_filter'])  ) ? $parameters['max_near_filter'] : '30'); ?> K</span>
            </div>
        </div>

        <div class="group-button">

            <input type="hidden" name="min_price_filter" id="min_price_filter" value="0">
            <input type="hidden" name="max_price_filter" id="max_price_filter" value="9000">
            <input type="hidden" name="min_near_filter" id="min_near_filter" value="0">
            <input type="hidden" name="max_near_filter" id="max_near_filter" value="30">
            <input type="hidden" name="url_filter" value="<?php echo e(request()->segment(2)); ?>">

            <button class="button btn-success btn"
                    style="width:100%;text-align:center;"><?php echo e(trans(lang_app_site().'.filter.apply_filter')); ?></button>
    </form>
</div>
</div>


<?php


?>


<?php /**PATH /home/saudidragonmart/public_html/resources/views/site/sub_view/sidemerchant.blade.php ENDPATH**/ ?>