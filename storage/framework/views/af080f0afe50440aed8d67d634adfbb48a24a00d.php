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
                                <i class="fa fa-cogs"></i>Order# 1
                            </div>
                            
                            
                            
                            
                        </div>
                        <div class="portlet-body">
                            <div class="row static-info">
                                <div class="col-md-2 name"> Order #:</div>
                                <div class="col-md-4 value">1234</div>
                                <div class="col-md-2 name"> Merchant Name:</div>
                                <div class="col-md-4 value"> Jhon Doe</div>

                            </div>

                            <div class="row static-info">
                                <div class="col-md-2 name"> Item#:</div>
                                <div class="col-md-4 value"> 3</div>
                                <div class="col-md-2 name"> Order Date:</div>
                                <div class="col-md-4 value"> 13-08-2019</div>

                            </div>

                            <hr>

                            <div class="row static-info">
                                <div class="col-md-2 name"> Buyer Name:</div>
                                <div class="col-md-2 value"> Jhon Doe</div>
                                <div class="col-md-2 name"> Procurement method:</div>
                                <div class="col-md-2 value"> Delivery</div>
                                <div class="col-md-2 name"> Received at:</div>
                                <div class="col-md-2 value"> 13-08-2019</div>
                            </div>

                            <div class="row static-info">
                                <div class="col-md-2 name"> Buyer Phone:</div>
                                <div class="col-md-2 value"> +999999999</div>
                                <div class="col-md-2 name"> Delivery method:</div>
                                <div class="col-md-2 value"> Merchant driver</div>
                                <div class="col-md-2 name"> Buyer Location:</div>
                                <div class="col-md-2 value"><a href="http://localhost/dragonmart/admin/user/38"
                                                               class="btn btn-circle btn-icon-only blue user-det"
                                                               title="Address">
                                        <i class="fa fa-map"></i>
                                    </a></div>
                            </div>

                            <div class="row static-info">
                                <div class="col-md-2 name"> Order amount:</div>
                                <div class="col-md-2 value"> 18 SAR</div>
                                <div class="col-md-2 name"> Shipment price:</div>
                                <div class="col-md-2 value"> 10 SAR</div>
                                <div class="col-md-2 name"> Total amount:</div>
                                <div class="col-md-2 value"> 28 SAR</div>
                            </div>

                            <div class="row static-info">
                                <div class="col-md-12 text-center">
                                    <div class="portlet-form">
                                        <form class="form-horizontal form">
                                            <div class="form-body">
                                                <div class="form-actions" style="background-color: #f5f5f5;">
                                                    <div class="row">
                                                        <div class="col-md-12 text-center">
                                                            <button type="submit"
                                                                    class="btn btn-circle green btn-md save">
                                                                <i
                                                                        class="fa fa-check"></i>
                                                                Invoice
                                                            </button>
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
                                    <div class="panel-group accordion" id="accordion1">
                                        <div class="panel panel-default">
                                            <div class="panel-heading">
                                                <h4 class="panel-title">
                                                    <a class="accordion-toggle accordion-toggle-styled"
                                                       data-toggle="collapse" data-parent="#accordion1"
                                                       href="#collapse_1_1" aria-expanded="true">Item #1 </a>
                                                </h4>
                                            </div>
                                            <div id="collapse_1_1" class="panel-collapse collapse in"
                                                 aria-expanded="true">
                                                <div class="panel-body">
                                                    <div class="row static-info">
                                                        <div class="col-md-2 name"><img
                                                                    src="https://lorempixel.com/480/480/?25168"
                                                                    style="width:100px;" class="img-circle"></div>
                                                        <div class="col-md-10 name">

                                                            <div class="row static-info">
                                                                <div class="col-md-2 name"> Product name:</div>
                                                                <div class="col-md-2 value"> Iphone</div>
                                                                <div class="col-md-2 name"> Quantity:</div>
                                                                <div class="col-md-2 value"> 1</div>
                                                                <div class="col-md-2 name"> Category</div>
                                                                <div class="col-md-2 value"> Electronics</div>
                                                            </div>
                                                            <div class="row static-info">
                                                                <div class="col-md-2 name"> Price:</div>
                                                                <div class="col-md-2 value"> 100 SAR</div>
                                                                <div class="col-md-2 name"> Customization:</div>
                                                                <div class="col-md-2 value">
                                                                    <ul>
                                                                        <li>XL</li>
                                                                        <li>Red</li>
                                                                    </ul>
                                                                </div>
                                                            </div>
                                                        </div>


                                                    </div>


                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="panel-group accordion" id="accordion2">
                                        <div class="panel panel-default">
                                            <div class="panel-heading">
                                                <h4 class="panel-title">
                                                    <a class="accordion-toggle accordion-toggle-styled"
                                                       data-toggle="collapse" data-parent="#accordion2"
                                                       href="#collapse_2_1" aria-expanded="true">Item #2 </a>
                                                </h4>
                                            </div>
                                            <div id="collapse_2_1" class="panel-collapse collapse in"
                                                 aria-expanded="true">
                                                <div class="panel-body">
                                                    <div class="row static-info">
                                                        <div class="col-md-2 name"><img
                                                                    src="https://lorempixel.com/480/480/?81351"
                                                                    style="width:100px;" class="img-circle"></div>
                                                        <div class="col-md-10 name">

                                                            <div class="row static-info">
                                                                <div class="col-md-2 name"> Product name:</div>
                                                                <div class="col-md-2 value"> Iphone</div>
                                                                <div class="col-md-2 name"> Quantity:</div>
                                                                <div class="col-md-2 value"> 1</div>
                                                                <div class="col-md-2 name"> Category</div>
                                                                <div class="col-md-2 value"> Electronics</div>
                                                            </div>
                                                            <div class="row static-info">
                                                                <div class="col-md-2 name"> Price:</div>
                                                                <div class="col-md-2 value"> 100 SAR</div>
                                                                <div class="col-md-2 name"> Customization:</div>
                                                                <div class="col-md-2 value">
                                                                    <ul>
                                                                        <li>XL</li>
                                                                        <li>Red</li>
                                                                    </ul>
                                                                </div>
                                                            </div>
                                                        </div>


                                                    </div>


                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="panel-group accordion" id="accordion3">
                                        <div class="panel panel-default">
                                            <div class="panel-heading">
                                                <h4 class="panel-title">
                                                    <a class="accordion-toggle accordion-toggle-styled"
                                                       data-toggle="collapse" data-parent="#accordion3"
                                                       href="#collapse_3_1" aria-expanded="true">Item #3 </a>
                                                </h4>
                                            </div>
                                            <div id="collapse_3_1" class="panel-collapse collapse in"
                                                 aria-expanded="true">
                                                <div class="panel-body">
                                                    <div class="row static-info">
                                                        <div class="col-md-2 name"><img
                                                                    src="https://lorempixel.com/480/480/?76281"
                                                                    style="width:100px;" class="img-circle"></div>
                                                        <div class="col-md-10 name">

                                                            <div class="row static-info">
                                                                <div class="col-md-2 name"> Product name:</div>
                                                                <div class="col-md-2 value"> Iphone</div>
                                                                <div class="col-md-2 name"> Quantity:</div>
                                                                <div class="col-md-2 value"> 1</div>
                                                                <div class="col-md-2 name"> Category</div>
                                                                <div class="col-md-2 value"> Electronics</div>
                                                            </div>
                                                            <div class="row static-info">
                                                                <div class="col-md-2 name"> Price:</div>
                                                                <div class="col-md-2 value"> 100 SAR</div>
                                                                <div class="col-md-2 name"> Customization:</div>
                                                                <div class="col-md-2 value">
                                                                    <ul>
                                                                        <li>XL</li>
                                                                        <li>Red</li>
                                                                    </ul>
                                                                </div>
                                                            </div>
                                                        </div>


                                                    </div>


                                                </div>
                                            </div>
                                        </div>
                                    </div>








                                </div>


                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="portlet-body">
            <div class="row">
                <div class="col-md-12 col-sm-12">
                    <div class="portlet blue-hoki box">
                        <div class="portlet-title">
                            <div class="caption">
                                <i class="fa fa-cogs"></i>Order# 2
                            </div>
                            
                            
                            
                            
                        </div>
                        <div class="portlet-body">
                            <div class="row static-info">
                                <div class="col-md-2 name"> Order #:</div>
                                <div class="col-md-4 value">1234</div>
                                <div class="col-md-2 name"> Merchant Name:</div>
                                <div class="col-md-4 value"> Jhon Doe</div>

                            </div>

                            <div class="row static-info">
                                <div class="col-md-2 name"> Item#:</div>
                                <div class="col-md-4 value"> 3</div>
                                <div class="col-md-2 name"> Order Date:</div>
                                <div class="col-md-4 value"> 13-08-2019</div>

                            </div>

                            <hr>

                            <div class="row static-info">
                                <div class="col-md-2 name"> Buyer Name:</div>
                                <div class="col-md-2 value"> Jhon Doe</div>
                                <div class="col-md-2 name"> Procurement method:</div>
                                <div class="col-md-2 value"> Delivery</div>
                                <div class="col-md-2 name"> Received at:</div>
                                <div class="col-md-2 value"> 13-08-2019</div>
                            </div>

                            <div class="row static-info">
                                <div class="col-md-2 name"> Buyer Phone:</div>
                                <div class="col-md-2 value"> +999999999</div>
                                <div class="col-md-2 name"> Delivery method:</div>
                                <div class="col-md-2 value"> Merchant driver</div>
                                <div class="col-md-2 name"> Buyer Location:</div>
                                <div class="col-md-2 value"><a href="http://localhost/dragonmart/admin/user/38"
                                                               class="btn btn-circle btn-icon-only blue user-det"
                                                               title="Address">
                                        <i class="fa fa-map"></i>
                                    </a></div>
                            </div>

                            <div class="row static-info">
                                <div class="col-md-2 name"> Order amount:</div>
                                <div class="col-md-2 value"> 18 SAR</div>
                                <div class="col-md-2 name"> Shipment price:</div>
                                <div class="col-md-2 value"> 10 SAR</div>
                                <div class="col-md-2 name"> Total amount:</div>
                                <div class="col-md-2 value"> 28 SAR</div>
                            </div>

                            <div class="row static-info">
                                <div class="col-md-12 text-center">
                                    <div class="portlet-form">
                                        <form class="form-horizontal form">
                                            <div class="form-body">
                                                <div class="form-actions" style="background-color: #f5f5f5;">
                                                    <div class="row">
                                                        <div class="col-md-12 text-center">
                                                            <button type="submit"
                                                                    class="btn btn-circle green btn-md save">
                                                                <i
                                                                        class="fa fa-check"></i>
                                                                Invoice
                                                            </button>
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
                                    <div class="panel-group accordion" id="accordion1">
                                        <div class="panel panel-default">
                                            <div class="panel-heading">
                                                <h4 class="panel-title">
                                                    <a class="accordion-toggle accordion-toggle-styled"
                                                       data-toggle="collapse" data-parent="#accordion1"
                                                       href="#collapse_1_1" aria-expanded="true">Item #1 </a>
                                                </h4>
                                            </div>
                                            <div id="collapse_1_1" class="panel-collapse collapse in"
                                                 aria-expanded="true">
                                                <div class="panel-body">
                                                    <div class="row static-info">
                                                        <div class="col-md-2 name"><img
                                                                    src="https://lorempixel.com/480/480/?25168"
                                                                    style="width:100px;" class="img-circle"></div>
                                                        <div class="col-md-10 name">

                                                            <div class="row static-info">
                                                                <div class="col-md-2 name"> Product name:</div>
                                                                <div class="col-md-2 value"> Iphone</div>
                                                                <div class="col-md-2 name"> Quantity:</div>
                                                                <div class="col-md-2 value"> 1</div>
                                                                <div class="col-md-2 name"> Category</div>
                                                                <div class="col-md-2 value"> Electronics</div>
                                                            </div>
                                                            <div class="row static-info">
                                                                <div class="col-md-2 name"> Price:</div>
                                                                <div class="col-md-2 value"> 100 SAR</div>
                                                                <div class="col-md-2 name"> Customization:</div>
                                                                <div class="col-md-2 value">
                                                                    <ul>
                                                                        <li>XL</li>
                                                                        <li>Red</li>
                                                                    </ul>
                                                                </div>
                                                            </div>
                                                        </div>


                                                    </div>


                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="panel-group accordion" id="accordion2">
                                        <div class="panel panel-default">
                                            <div class="panel-heading">
                                                <h4 class="panel-title">
                                                    <a class="accordion-toggle accordion-toggle-styled"
                                                       data-toggle="collapse" data-parent="#accordion2"
                                                       href="#collapse_2_1" aria-expanded="true">Item #2 </a>
                                                </h4>
                                            </div>
                                            <div id="collapse_2_1" class="panel-collapse collapse in"
                                                 aria-expanded="true">
                                                <div class="panel-body">
                                                    <div class="row static-info">
                                                        <div class="col-md-2 name"><img
                                                                    src="https://lorempixel.com/480/480/?81351"
                                                                    style="width:100px;" class="img-circle"></div>
                                                        <div class="col-md-10 name">

                                                            <div class="row static-info">
                                                                <div class="col-md-2 name"> Product name:</div>
                                                                <div class="col-md-2 value"> Iphone</div>
                                                                <div class="col-md-2 name"> Quantity:</div>
                                                                <div class="col-md-2 value"> 1</div>
                                                                <div class="col-md-2 name"> Category</div>
                                                                <div class="col-md-2 value"> Electronics</div>
                                                            </div>
                                                            <div class="row static-info">
                                                                <div class="col-md-2 name"> Price:</div>
                                                                <div class="col-md-2 value"> 100 SAR</div>
                                                                <div class="col-md-2 name"> Customization:</div>
                                                                <div class="col-md-2 value">
                                                                    <ul>
                                                                        <li>XL</li>
                                                                        <li>Red</li>
                                                                    </ul>
                                                                </div>
                                                            </div>
                                                        </div>


                                                    </div>


                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="panel-group accordion" id="accordion3">
                                        <div class="panel panel-default">
                                            <div class="panel-heading">
                                                <h4 class="panel-title">
                                                    <a class="accordion-toggle accordion-toggle-styled"
                                                       data-toggle="collapse" data-parent="#accordion3"
                                                       href="#collapse_3_1" aria-expanded="true">Item #3 </a>
                                                </h4>
                                            </div>
                                            <div id="collapse_3_1" class="panel-collapse collapse in"
                                                 aria-expanded="true">
                                                <div class="panel-body">
                                                    <div class="row static-info">
                                                        <div class="col-md-2 name"><img
                                                                    src="https://lorempixel.com/480/480/?76281"
                                                                    style="width:100px;" class="img-circle"></div>
                                                        <div class="col-md-10 name">

                                                            <div class="row static-info">
                                                                <div class="col-md-2 name"> Product name:</div>
                                                                <div class="col-md-2 value"> Iphone</div>
                                                                <div class="col-md-2 name"> Quantity:</div>
                                                                <div class="col-md-2 value"> 1</div>
                                                                <div class="col-md-2 name"> Category</div>
                                                                <div class="col-md-2 value"> Electronics</div>
                                                            </div>
                                                            <div class="row static-info">
                                                                <div class="col-md-2 name"> Price:</div>
                                                                <div class="col-md-2 value"> 100 SAR</div>
                                                                <div class="col-md-2 name"> Customization:</div>
                                                                <div class="col-md-2 value">
                                                                    <ul>
                                                                        <li>XL</li>
                                                                        <li>Red</li>
                                                                    </ul>
                                                                </div>
                                                            </div>
                                                        </div>


                                                    </div>


                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    
                                    
                                    
                                    
                                    
                                    
                                    
                                    
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
<?php echo $__env->make(merchant_layout_vw().'.index', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/saudidragonmart/public_html/resources/views/merchant/orders/order_lists.blade.php ENDPATH**/ ?>