<?php $__env->startSection('css'); ?>
    <!-- BEGIN PAGE LEVEL PLUGINS -->
    <link href="<?php echo e(url('/')); ?>/assets/global/plugins/datatables/datatables.min.css" rel="stylesheet" type="text/css"/>
    <link href="<?php echo e(url('/')); ?>/assets/global/plugins/datatables/plugins/bootstrap/datatables.bootstrap.css"
          rel="stylesheet" type="text/css"/>

    <link href="<?php echo e(url('/')); ?>/assets/global/plugins/bootstrap-datepicker/css/bootstrap-datepicker3.min.css"
          rel="stylesheet" type="text/css"/>
    <!-- BEGIN PAGE LEVEL PLUGINS -->
    <link href="<?php echo e(url('/')); ?>/assets/global/plugins/fancybox/source/jquery.fancybox.css" rel="stylesheet"
          type="text/css"/>
    <link href="<?php echo e(url('/')); ?>/assets/global/plugins/jquery-file-upload/blueimp-gallery/blueimp-gallery.min.css"
          rel="stylesheet" type="text/css"/>
    <link href="<?php echo e(url('/')); ?>/assets/global/plugins/jquery-file-upload/css/jquery.fileupload.css" rel="stylesheet"
          type="text/css"/>
    <link href="<?php echo e(url('/')); ?>/assets/global/plugins/jquery-file-upload/css/jquery.fileupload-ui.css" rel="stylesheet"
          type="text/css"/>
    <!-- END PAGE LEVEL PLUGINS -->

    <!-- BEGIN PAGE LEVEL PLUGINS -->
    <link href="<?php echo e(url('/')); ?>/assets/global/plugins/select2/css/select2.min.css" rel="stylesheet" type="text/css"/>
    <link href="<?php echo e(url('/')); ?>/assets/global/plugins/select2/css/select2-bootstrap.min.css" rel="stylesheet"
          type="text/css"/>
    <!-- END PAGE LEVEL PLUGINS -->
    <!-- END PAGE LEVEL PLUGINS -->
    <!-- BEGIN THEME GLOBAL STYLES -->
    <link href="<?php echo e(url('/')); ?>/assets/global/css/components-md.min.css" rel="stylesheet" id="style_components"
          type="text/css"/>
    <link href="<?php echo e(url('/')); ?>/assets/global/css/plugins-md.min.css" rel="stylesheet" type="text/css"/>
    <!-- END THEME GLOBAL STYLES -->
<?php $__env->stopSection(); ?>
<?php $__env->startSection('content'); ?>

    <div class="row store_products" <?php if(!$currentUser->has_store): ?> style="display: none" <?php endif; ?>>
        <div class="col-md-12">
            <div class="portlet box green">
                <div class="portlet-title">
                    <div class="caption">
                        <i class="<?php echo e($icon); ?> font-weight-light"></i>
                        <span class="caption-subject bold uppercase"><?php echo e(trans(lang_app_site().'.CP.My Products')); ?></span>
                    </div>

                </div>
                <div class="portlet-body form">
                    <div class="form-body">
                        <!-- BEGIN EXAMPLE TABLE PORTLET-->
                        <div class="portlet light">
                            <div class="portlet-title">
                                <div class="caption font-dark">
                                    <i class="fa fa-search font-dark"></i>
                                    <span class="caption-subject bold uppercase"><?php echo e(trans(lang_app_site().'.CP.Filter')); ?></span>
                                </div>

                            </div>
                            <div class="portlet-body">
                                <div class="table-container">
                                    
                                    <form method="POST" action="#">
                                        <table class="table table-striped table-bordered table-hover table-checkable"
                                               id="datatable_products">
                                            <thead>
                                            <tr role="row" class="heading">
                                                <th width="1%">
                                                </th>

                                                <th width="10%"><?php echo e(trans(lang_app_site().'.CP.Name')); ?></th>
                                                <th width="10%"><?php echo e(trans(lang_app_site().'.CP.Offer')); ?> </th>
                                                <th width="10%"><?php echo e(trans(lang_app_site().'.CP.Sponsor')); ?> </th>
                                                
                                                
                                                <th width="10%"><?php echo e(trans(lang_app_site().'.CP.Category')); ?> </th>
                                                <th width="10%"><?php echo e(trans(lang_app_site().'.CP.Action')); ?> </th>
                                            </tr>
                                            <tr role="row" class="filter">
                                                <td></td>
                                                <td>
                                                    <input type="text" class="form-control form-filter input-md"
                                                           name="name"
                                                           placeholder=" Name" id="product_name">
                                                </td>

                                                <td>
                                                    <select class="form-control input-md is_offer" name="is_offer"
                                                            id="is_offer"
                                                            data-placeholder="Choose Offer Status">
                                                        <option value="">Choose Offer Status</option>
                                                        <option value="0">No</option>
                                                        <option value="1">Yes</option>
                                                    </select>
                                                </td>

                                                <td>
                                                    <select class="form-control input-md is_sponsor" name="is_sponsor"
                                                            id="is_sponsor"
                                                            data-placeholder="Choose Sponsor Status">
                                                        <option value="">Choose Sponsor Status</option>
                                                        <option value="0">No</option>
                                                        <option value="1">Yes</option>
                                                    </select>
                                                </td>
                                                <td>
                                                    <select class="form-control input-md category_id" name="category_id"
                                                            id="category_id"
                                                            data-placeholder="Choose Category">
                                                        <option value="">Choose Category</option>
                                                        <?php $__currentLoopData = $categories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $category): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                            <option value="<?php echo e($category->id); ?>"><?php echo e($category->name); ?></option>
                                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                    </select>
                                                </td>
                                                <td>
                                                    <div class="margin-bottom-5">
                                                        <a href="javascript:;"
                                                           class="btn btn-sm btn-success filter-submit-product btn-circle btn-icon-only margin-bottom"
                                                           title="filter">
                                                            <i class="fa fa-search"></i>
                                                        </a>

                                                        <a href="javascript:;"
                                                           class="btn btn-sm btn-danger btn-circle btn-icon-only filter-cancel-product"
                                                           title="Empty fields">
                                                            <i class="fa fa-rotate-left"></i>
                                                        </a>
                                                    </div>

                                                </td>
                                            </tr>
                                            </thead>
                                            <tbody></tbody>
                                        </table>
                                        
                                    </form>
                                </div>
                            </div>
                        </div>
                        <div class="portlet light ">
                            <div class="portlet-title">
                                <div class="caption font-dark">
                                    <i class="<?php echo e($icon); ?> font-dark"></i>
                                    <span class="caption-subject bold uppercase"><?php echo e(trans(lang_app_site().'.CP.Products')); ?></span>
                                </div>
                                <div class="actions">
                                    <a href="<?php echo e(url(merchant_vw().'/product/create')); ?>"
                                       class="btn btn-circle btn-success add-product-mdl2">
                                        <i class="fa fa-plus"></i>
                                        <span class="hidden-xs"><?php echo e(trans(lang_app_site().'.CP.Add New')); ?></span>
                                    </a>
                                </div>
                            </div>

                            <div class="portlet-body">

                                <table class="table table-striped table-bordered table-hover table-checkable order-column"
                                       id="products_tbl">
                                    <thead>
                                    <tr>
                                        <th>#</th>
                                        <th> <?php echo e(trans(lang_app_site().'.CP.Name')); ?></th>
                                        <th> <?php echo e(trans(lang_app_site().'.CP.Price')); ?></th>
                                        <th> <?php echo e(trans(lang_app_site().'.CP.Quantity')); ?></th>
                                        <th> <?php echo e(trans(lang_app_site().'.CP.Category')); ?></th>
                                        <th> <?php echo e(trans(lang_app_site().'.CP.Sponsor')); ?></th>
                                        <th> <?php echo e(trans(lang_app_site().'.CP.Offer')); ?></th>
                                        <th> <?php echo e(trans(lang_app_site().'.CP.Offer')); ?> %</th>
                                        
                                        <th><?php echo e(trans(lang_app_site().'.CP.Action')); ?></th>
                                    </tr>
                                    </thead>
                                </table>
                            </div>
                        </div>
                        <!-- END EXAMPLE TABLE PORTLET-->
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade bs-modal-lg" id="imagesProduct" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-lg" style="width: 1200px !important;">
            <div class="modal-content">
                <div class="modal-body" id="images-product">

                </div>

            </div>
            <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
    </div>
    <div class="modal fade bs-modal-lg" id="editProduct" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-lg" style="width: 1200px !important;">
            <div class="modal-content">
                <div class="modal-body" id="edit_product">

                </div>

            </div>
            <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
    </div>


<?php $__env->stopSection(); ?>

<?php $__env->startSection('js'); ?>
    <!-- BEGIN PAGE LEVEL PLUGINS -->
    <script src="<?php echo e(url('/')); ?>/assets/global/scripts/datatable.js" type="text/javascript"></script>
    <script src="<?php echo e(url('/')); ?>/assets/global/plugins/datatables/datatables.min.js" type="text/javascript"></script>
    <script src="<?php echo e(url('/')); ?>/assets/global/plugins/datatables/plugins/bootstrap/datatables.bootstrap.js"
            type="text/javascript"></script>


    <script src="<?php echo e(url('/')); ?>/assets/global/plugins/bootstrap-datepicker/js/bootstrap-datepicker.min.js"
            type="text/javascript"></script>
    <!-- END PAGE LEVEL PLUGINS -->
    <script src="<?php echo e(url('/')); ?>/assets/global/plugins/select2/js/select2.full.min.js" type="text/javascript"></script>


    <!-- BEGIN PAGE LEVEL PLUGINS -->
    <script src="<?php echo e(url('/')); ?>/assets/global/plugins/fancybox/source/jquery.fancybox.pack.js"
            type="text/javascript"></script>
    <script src="<?php echo e(url('/')); ?>/assets/global/plugins/jquery-file-upload/js/vendor/jquery.ui.widget.js"
            type="text/javascript"></script>
    <script src="<?php echo e(url('/')); ?>/assets/global/plugins/jquery-file-upload/js/vendor/tmpl.min.js"
            type="text/javascript"></script>
    <script src="<?php echo e(url('/')); ?>/assets/global/plugins/jquery-file-upload/js/vendor/load-image.min.js"
            type="text/javascript"></script>
    <script src="<?php echo e(url('/')); ?>/assets/global/plugins/jquery-file-upload/js/vendor/canvas-to-blob.min.js"
            type="text/javascript"></script>
    <script src="<?php echo e(url('/')); ?>/assets/global/plugins/jquery-file-upload/blueimp-gallery/jquery.blueimp-gallery.min.js"
            type="text/javascript"></script>
    <script src="<?php echo e(url('/')); ?>/assets/global/plugins/jquery-file-upload/js/jquery.iframe-transport.js"
            type="text/javascript"></script>
    <script src="<?php echo e(url('/')); ?>/assets/global/plugins/jquery-file-upload/js/jquery.fileupload.js"
            type="text/javascript"></script>
    <script src="<?php echo e(url('/')); ?>/assets/global/plugins/jquery-file-upload/js/jquery.fileupload-process.js"
            type="text/javascript"></script>
    <script src="<?php echo e(url('/')); ?>/assets/global/plugins/jquery-file-upload/js/jquery.fileupload-image.js"
            type="text/javascript"></script>
    <script src="<?php echo e(url('/')); ?>/assets/global/plugins/jquery-file-upload/js/jquery.fileupload-audio.js"
            type="text/javascript"></script>
    <script src="<?php echo e(url('/')); ?>/assets/global/plugins/jquery-file-upload/js/jquery.fileupload-video.js"
            type="text/javascript"></script>
    <script src="<?php echo e(url('/')); ?>/assets/global/plugins/jquery-file-upload/js/jquery.fileupload-validate.js"
            type="text/javascript"></script>
    <script src="<?php echo e(url('/')); ?>/assets/global/plugins/jquery-file-upload/js/jquery.fileupload-ui.js"
            type="text/javascript"></script>
    <!-- END PAGE LEVEL PLUGINS -->
    <script src="<?php echo e(url('/')); ?>/assets/global/plugins/jquery-ui/jquery-ui.min.js" type="text/javascript"></script>

    <!-- BEGIN THEME GLOBAL SCRIPTS -->
    <script src="<?php echo e(url('/')); ?>/assets/global/scripts/app.min.js" type="text/javascript"></script>
    <!-- END THEME GLOBAL SCRIPTS -->
    <script src="<?php echo e(url('/')); ?>/assets/pages/scripts/form-fileupload.min.js" type="text/javascript"></script>

    <!-- BEGIN PAGE LEVEL SCRIPTS -->
    <script src="<?php echo e(url('/')); ?>/assets/pages/scripts/table-datatables-managed.min.js" type="text/javascript"></script>
    <!-- END PAGE LEVEL SCRIPTS -->
    <script src="<?php echo e(url('/')); ?>/assets/pages/scripts/table-datatables-responsive.min.js" type="text/javascript"></script>

    
    
    <script src="<?php echo e(url('/')); ?>/assets/js/products.js" type="text/javascript"></script>
    <script type="text/javascript"
            src="https://maps.googleapis.com/maps/api/js?key=<?php echo e(google_api_key()); ?>"></script>
    <script>

        function myMap(address, lat, long) {

            var myLatLng = {lat: Number(lat), lng: Number(long)};


            var map = new google.maps.Map(document.getElementById("map"), {
                zoom: 4,
                center: myLatLng,

                gestureHandling: 'cooperative'
            });

            map.setOptions({scrollwheel: false});


            var marker = new google.maps.Marker({
                position: myLatLng,
                map: map,
                title: address
            });
        }
    </script>

    <script>

        $('.select2').select2({
            placeholder: "Select...",
            allowClear: true
        });
        $(".date-picker").datepicker({
            rtl: App.isRTL(),
            dateFormat: "mm/dd/yy",
            showOtherMonths: true,
            selectOtherMonths: true,
            autoclose: true,
            changeMonth: true,
            changeYear: true,
            orientation: "below"
        });
    </script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make(merchant_layout_vw().'.index', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\Dragon\resources\views/merchant/products/index.blade.php ENDPATH**/ ?>