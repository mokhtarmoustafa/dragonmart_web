<?php $__env->startSection('css'); ?>
    <!-- BEGIN PAGE LEVEL PLUGINS -->
    <link href="<?php echo e(url('/')); ?>/assets/global/plugins/datatables/datatables.min.css" rel="stylesheet" type="text/css"/>
    <link href="<?php echo e(url('/')); ?>/assets/global/plugins/datatables/plugins/bootstrap/datatables.bootstrap.css"
          rel="stylesheet" type="text/css"/>
    <!-- END PAGE LEVEL PLUGINS -->
    <!-- BEGIN THEME GLOBAL STYLES -->
    <link href="<?php echo e(url('/')); ?>/assets/global/css/components-md.min.css" rel="stylesheet" id="style_components"
          type="text/css"/>
    <link href="<?php echo e(url('/')); ?>/assets/global/css/plugins-md.min.css" rel="stylesheet" type="text/css"/>
    <!-- END THEME GLOBAL STYLES -->
    <style>
        .circle {
            height: 50px;
            width: 50px;
            background-color: #ffffff;
            border-width: 1px;
            border-style: solid;
            border-color: grey;
            border-radius: 50%;
        }
    </style>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('content'); ?>

    <div class="portlet light ">
        <div class="portlet-title">
            <div class="caption font-dark">
                <i class="<?php echo e($icon); ?> font-dark"></i>
                <span class="caption-subject bold uppercase"> <?php echo e($main_title); ?></span>
            </div>

        </div>

        <div class="portlet-body">
            <div class="row">
                <div class="col-md-12 col-sm-12">
                    <div class="portlet blue-hoki box">
                        <div class="portlet-title">
                            <div class="caption">
                                <i class="fa fa-cogs"></i>Order Info.
                            </div>
                            
                            
                            
                            
                        </div>
                        <div class="portlet-body">
                            <div class="row static-info">
                                <div class="col-md-2 name"> Order #: <span class="value"><?php echo e($order->id); ?></span></div>
                                
                                <div class="col-md-3 name"> Merchant Name: <span
                                            class="value"><?php echo e($order->Merchant->username); ?></span></div>
                                

                                

                                <div class="col-md-3 name"> Order Date: <span
                                            class="value"><?php echo e($order->created_at); ?></span></div>
                                <div class="col-md-2 name"> Status: <span class="value"><?php echo e($order->last_status); ?></span>
                                </div>
                                <div class="col-md-2 name"> Item#: <span
                                            class="value"><?php echo e($order->OrderProducts->count()); ?></span></div>

                            </div>

                            <hr>

                            <div class="row static-info">
                                <div class="col-md-2 name"> Buyer Name: <span
                                            class="value"><?php echo e($order->order_user->client->username); ?></span></div>
                                <div class="col-md-3 name"> Procurement method: <span
                                            class="value"><?php echo e($order->order_user->procurement_method); ?></span></div>
                                <div class="col-md-3 name"> Received at: <span
                                            class="value"><?php echo e($order->order_user->received_datetime); ?></span></div>
                                <div class="col-md-3 name"> Buyer Phone: <span
                                            class="value"><?php echo e($order->order_user->client->mobile); ?></span></div>

                            </div>


                            <div class="row static-info">

                                <div class="col-md-2 name"> Buyer Location: <span class="value"><a
                                                href="<?php echo e(url(getAuth()->type . '/user/' . $order->order_user->client->id)); ?>"
                                                class="btn btn-circle btn-icon-only blue user-det"
                                                title="Address">
                                        <i class="fa fa-map"></i>
                                    </a></span></div>
                                <div class="col-md-3 name"> Delivery method: <span
                                            class="value"><?php echo e($order->delivery_method); ?></span></div>
                                <div class="col-md-3 name"> Order amount: <span class="value"><?php echo e($order->products_price); ?> SAR</span>
                                </div>
                                <div class="col-md-2 name"> Shipment rate: <span class="value"><?php echo e($order->shipment_price); ?> SAR</span>
                                </div>
                                <div class="col-md-2 name"> Total amount: <span class="value"><?php echo e($order->products_price + $order->shipment_price); ?> SAR</span>
                                </div>

                            </div>

                            <div class="row static-info">
                                <div class="col-md-3 name"> Shop Location: <span class="value"><a
                                                href="<?php echo e(url(getAuth()->type . '/user/' . $order->merchant_id)); ?>"
                                                class="btn btn-circle btn-icon-only blue user-det"
                                                title="Address">
                                        <i class="fa fa-map"></i>
                                    </a></span></div>
                            </div>

                            
                            <div class="row static-info">
                                <div class="col-md-12 text-center">
                                    <div class="portlet-form">
                                        <form class="form-horizontal form">
                                            <div class="form-body">
                                                <div class="form-actions" style="background-color: #f5f5f5;">
                                                    <div class="row">
                                                        <div class="col-md-12 text-center">
                                                            <a href="<?php echo e(url(getAuth()->type.'/invoice/'.$order->id)); ?>" target="_blank"
                                                               class="btn btn-circle green btn-md save">
                                                                <i
                                                                    class="fa fa-check"></i>
                                                                Invoice
                                                            </a>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                </div>

                            </div>
                            
                            <div class="portlet box yellow">
                                <div class="portlet-title">
                                    <div class="caption">
                                        <i class="icon-grid"></i>Products
                                    </div>
                                    <div class="tools">
                                        <a href="javascript:;" class="collapse" data-original-title="" title=""> </a>
                                        <a href="#portlet-config" data-toggle="modal" class="config"
                                           data-original-title="" title=""> </a>
                                        <a href="javascript:;" class="reload" data-original-title="" title=""> </a>
                                        <a href="javascript:;" class="remove" data-original-title="" title=""> </a>
                                    </div>
                                </div>
                                <div class="portlet-body">
                                    <?php $__currentLoopData = $order->order_products; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $order_product): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <div class="panel-group accordion" id="accordion<?php echo e($order_product->id); ?>">
                                            <div class="panel panel-default">
                                                <div class="panel-heading">
                                                    <h4 class="panel-title">
                                                        <a class="accordion-toggle accordion-toggle-styled"
                                                           data-toggle="collapse"
                                                           data-parent="#accordion<?php echo e($order_product->id); ?>"
                                                           href="#collapse_<?php echo e($order_product->id); ?>_1"
                                                           aria-expanded="true"><?php echo e($order_product->product->name); ?> </a>
                                                    </h4>
                                                </div>
                                                <div id="collapse_<?php echo e($order_product->id); ?>_1"
                                                     class="panel-collapse collapse in"
                                                     aria-expanded="true">
                                                    <div class="panel-body">
                                                        <div class="row static-info">
                                                            <div class="col-md-1 name"><img
                                                                        src="<?php echo e($order_product->product->images[0]->image100 ?? url('assets/no-product.jpg')); ?>"
                                                                        style="width:100px;" class=""></div>
                                                            <div class="col-md-10 name">

                                                                <div class="row static-info">
                                                                    <div class="col-md-2 name"> Product name: <span
                                                                                class="value"><?php echo e($order_product->product->name); ?></span>
                                                                    </div>
                                                                    <div class="col-md-2 name"> Quantity: <span
                                                                                class="value"><?php echo e($order_product->quantity); ?></span>
                                                                    </div>
                                                                    <div class="col-md-2 name"> Category: <span
                                                                                class="value"><?php echo e($order_product->product->category->name); ?></span>
                                                                    </div>
                                                                    <div class="col-md-2 "></div>
                                                                </div>
                                                                <div class="row static-info">
                                                                    <div class="col-md-2 name"> Price: <span
                                                                                class="value"><?php echo e($order_product->price); ?> SAR</span>
                                                                    </div>
                                                                    <div class="col-md-1 name"> Customization:</div>
                                                                    <div class="col-md-6 value">
                                                                        
                                                                        <?php $__currentLoopData = $order_product->Customizations; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $custom): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                                            <?php if($custom->custom_id == 3): ?>
                                                                                <div class="col-md-1 circle"
                                                                                     style="background-color:<?php echo e($custom->text); ?>;text-align: center;padding-top: 14px; margin-left: 4px;"></div>
                                                                            <?php else: ?>
                                                                                <div class="col-md-1 circle"
                                                                                     style="text-align: center;padding-top: 14px;margin-left: 4px;">
                                                                                    <?php echo e($custom->text); ?>

                                                                                </div>
                                                                            <?php endif; ?>
                                                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                                        
                                                                    </div>
                                                                </div>
                                                            </div>


                                                        </div>


                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </div>


                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('js'); ?>

    <!-- BEGIN PAGE LEVEL PLUGINS -->
    <script src="<?php echo e(url('/')); ?>/assets/global/scripts/datatable.js" type="text/javascript"></script>
    <script src="<?php echo e(url('/')); ?>/assets/global/plugins/datatables/datatables.min.js" type="text/javascript"></script>
    <script src="<?php echo e(url('/')); ?>/assets/global/plugins/datatables/plugins/bootstrap/datatables.bootstrap.js"
            type="text/javascript"></script>
    <!-- END PAGE LEVEL PLUGINS -->

    
    <script src="<?php echo e(url('/')); ?>/assets/global/plugins/jquery-ui/jquery-ui.min.js" type="text/javascript"></script>

    <!-- BEGIN THEME GLOBAL SCRIPTS -->
    <script src="<?php echo e(url('/')); ?>/assets/global/scripts/app.min.js" type="text/javascript"></script>
    <!-- END THEME GLOBAL SCRIPTS -->
    

    <script src="<?php echo e(url('/')); ?>/assets/pages/scripts/ui-modals.min.js" type="text/javascript"></script>

    <!-- BEGIN PAGE LEVEL SCRIPTS -->
    <script src="<?php echo e(url('/')); ?>/assets/pages/scripts/table-datatables-responsive.min.js" type="text/javascript"></script>

    
    <!-- END PAGE LEVEL SCRIPTS -->
    <script src="<?php echo e(url('/')); ?>/assets/js/users.js" type="text/javascript"></script>

<?php $__env->stopSection(); ?>

<?php echo $__env->make(merchant_layout_vw().'.index', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/saudidragonmart/public_html/resources/views/merchant/orders/order_det.blade.php ENDPATH**/ ?>