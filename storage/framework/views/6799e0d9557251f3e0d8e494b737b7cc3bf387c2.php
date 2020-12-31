<div class="col-xs-12 col-sm-5 col-md-4 col-lg-3 sidebar">
    <form>
        <?php

            $parameters = \Request::query();
            $merchants =merchants();

        ?>

        <?php if(request()->segment(2)  != 'merchant-page'): ?>
            <div class="widget widget-categories">
                <h5 class="widgettitle"><?php echo e(trans(lang_app_site().'.services.categories')); ?></h5>
                <ul class="list-categories scrollable-area" style="max-height: 200px;">

                    <?php
                        $Services =Services();
                    ?>
                    <?php $__currentLoopData = $Services; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $m): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <li><input type="checkbox" name="services_filter[]" id="serv<?php echo e($m->id); ?>"
                                   value="<?php echo e($m->id); ?>" <?php echo e((isset($parameters['services_filter']) && in_array(  $m->id , $parameters['services_filter']) ) ? 'checked' : ''); ?>><label
                                    for="serv<?php echo e($m->id); ?>" class="label-text"><?php echo e($m->name); ?></label>
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
                    <option value="all"><?php echo e(trans(lang_app_site().'.filter.all_cities')); ?></option>
                <?php $__currentLoopData = $cities; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $city): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <option value="<?php echo e($city->id); ?>" <?php echo e((isset($parameters['city']) &&  $city->id  ==  $parameters['city'] ) ? 'selected' : ''); ?> ><?php echo e($city->name_en); ?></option>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </select>
            </ul>
        </div>

        <div class="widget widget_filter_price box-has-content mner">
            <h3 class="widgettitle"><?php echo e(trans(lang_app_site().'.filter.near_by')); ?></h3>
            <div class="near-by-filter">
                <div data-label-reasult="<?php echo e(trans(lang_app_site().'.filter.near_by')); ?>:" data-min="0" data-max="30"
                     data-unit="K" data-distance="<?php echo e(trans(lang_app_site().'.filter.distance')); ?>"
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

            <button class="button btn btn-success"
                    style="width:100%;text-align:center;"><?php echo e(trans(lang_app_site().'.filter.apply_filter')); ?></button>
    </form>
</div>
</div>


<?php


?>





<?php /**PATH /home/saudidragonmart/public_html/resources/views/site/sub_view/sideservices.blade.php ENDPATH**/ ?>