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
<?php
// print_r($store);
 ?>

<div class="row">
  <?php foreach ($store as $store_id => $storeInfo): ?>
    <div class="col-md-6">
      <div class="portlet box dark">
                <div class="portlet-title">
                    <div class="caption">
                        <i class="icon-settings"></i>
                        <span class="caption-subject bold uppercase"> <?php echo e($storeInfo['name']); ?></span>
                    </div>
                    <div class="actions">


                      <?php if(is_null($storeInfo['deleted_at'])): ?>
                      <a href="<?php echo e(url('merchant/store/'.$storeInfo['id'].'/delete')); ?>" class="btn btn-circle btn-icon-only red" >
                        <i class="fa fa-trash"></i>
                      </a>


                        <button class="btn btn-circle btn-info add-category-mdl" form="store_<?php echo e($storeInfo['id']); ?>">
                            <i class="fa fa-check"></i>
                            <span class="hidden-xs"> <?php echo e(trans(lang_app_site().'.CP.save')); ?></span>
                        </button>
                        <?php else: ?>
                        <a href="<?php echo e(url('merchant/store/'.$storeInfo['id'].'/recover')); ?>" class="btn btn-circle btn-icon-only blue" >
                          <i class="fa fa-undo"></i>
                        </a>

                        <?php endif; ?>



                    </div>
                </div>
                <div class="portlet-body">
                      <form class="" action="<?php echo e(url('merchant/store/'.$storeInfo['id'])); ?>" method="post" id="store_<?php echo e($storeInfo['id']); ?>">

                        <?php echo csrf_field(); ?>
                        <div class="form-group">
                            <div class="control-label col-md-2">
                                <label>Store name</label>
                            </div>
                            <div class="col-md-4">
                                <input id="name" class="form-control" name="name" type="text"
                                       placeholder="Store Name" value="<?php echo e($storeInfo['name'] ?? ''); ?>" required>
                            </div>

                            <div class="control-label col-md-2">
                                <label>Store Phone</label>
                            </div>

                            <div class="col-md-4 input-group">
                                  <span class="input-group-addon" id="basic-addon1">+966</span>
                              <input id="phone" class="form-control" name="phone" type="number"
                                     placeholder="Store Phone" value="<?php echo e($storeInfo['phone'] ?? ''); ?>" min="500000000" max="5999999999" required>
                            </div>


                            <div class="clearfix margin-bottom-10"></div>
                              <div class="clearfix margin-bottom-10"></div>
                                <div class="control-label col-md-2">
                                      <label>Map</label>
                                </div>
                                <div class="col-md-10">
                                  <input type="hidden" name="lat" value="<?php echo e($storeInfo['lat']); ?>" id="latmap<?php echo e($storeInfo['id']); ?>">
                                  <input type="hidden" name="lng" value="<?php echo e($storeInfo['lng']); ?>" id="lngmap<?php echo e($storeInfo['id']); ?>">

                                  <div id="map<?php echo e($storeInfo['id']); ?>" style="height: 300px;"></div>
                                </div>
                        </div>
                      </form>
                          <div class="clearfix"></div>
                </div>
            </div>
    </div>

  <?php endforeach; ?>


  <div class="col-md-12">
    <div class="portlet box cyan">
              <div class="portlet-title">
                  <div class="caption">
                      <i class="icon-settings"></i>
                      <span class="caption-subject bold uppercase font-blue-dark"> New Store</span>
                  </div>
                  <div class="actions">

                      <button class="btn btn-circle btn-info add-category-mdl" form="NewStore">
                          <i class="fa fa-check"></i>
                          <span class="hidden-xs"> <?php echo e(trans(lang_app_site().'.CP.save')); ?></span>
                      </button>

                  </div>
              </div>
              <div class="portlet-body">
                    <form class="" action="<?php echo e(url('merchant/store/new')); ?>" method="post" id="NewStore">

                      <?php echo csrf_field(); ?>
                      <div class="form-group">
                          <div class="control-label col-md-2">
                              <label>Store name</label>
                          </div>
                          <div class="col-md-4">
                              <input id="name" class="form-control" name="name" type="text"
                                     placeholder="Store Name" value="" required>
                          </div>

                          <div class="control-label col-md-2">
                              <label>Store Phone</label>
                          </div>

                          <div class="col-md-4 input-group">
                                <span class="input-group-addon" id="basic-addon1">+966</span>
                            <input id="phone" class="form-control" name="phone" type="number"
                                   placeholder="Store Phone" value="" min="500000000" max="5999999999" required>
                          </div>


                          <div class="clearfix margin-bottom-10"></div>
                            <div class="clearfix margin-bottom-10"></div>
                              <div class="control-label col-md-2">
                                    <label>Map</label>
                              </div>
                              <div class="col-md-10">
                                <input type="hidden" name="lat" value="" id="latmapNew">
                                <input type="hidden" name="lng" value="" id="lngmapNew">

                                <div id="mapNew" style="height: 300px;"></div>
                              </div>

                      </div>
                    </form>
                        <div class="clearfix"></div>
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

    <script src="<?php echo e(url('/')); ?>/assets/js/users.js" type="text/javascript"></script>
    <script src="<?php echo e(url('/')); ?>/assets/js/stores.js" type="text/javascript"></script>
    <script src="<?php echo e(url('/')); ?>/assets/js/products.js" type="text/javascript"></script>

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

<?php $__env->startSection('js2'); ?>
<script>
<?php $__currentLoopData = $store; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $store_id => $storeInfo): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>

  var map_<?php echo e($storeInfo['id']); ?>;

<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    function myMap2(id , address, lat = "", long = "") {

      lat = lat != "" ? lat : 24.6555252855;
      long = long != "" ? long : 46.55855545555;


        var myLatLng = {lat: Number(lat), lng: Number(long)};
        var myMapID =   window["map_"+id] ;

        myMapID= new google.maps.Map(document.getElementById(id), {
            zoom: 4,
            center: myLatLng,

            gestureHandling: 'cooperative'
        });

        myMapID.setOptions({scrollwheel: false});


        var marker = new google.maps.Marker({
            position: myLatLng,
            map: myMapID,
            title: address,
            draggable:true,
        });

                myMapID.addListener('click', function(mapsMouseEvent) {
                    marker.setPosition(mapsMouseEvent.latLng);

                    $("#lat"+id).val(mapsMouseEvent.latLng.lat);
                    $("#lng"+id).val(mapsMouseEvent.latLng.lng);


                    });

    }




<?php $__currentLoopData = $store; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $store_id => $storeInfo): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
 myMap2("map<?php echo e($storeInfo['id']); ?>" , "ssss" <?php if($storeInfo['lat'] != ""): ?> <?php echo e(',' . $storeInfo['lat']); ?> <?php echo e(',' .$storeInfo['lng']); ?> <?php endif; ?> );
<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>


myMap2("mapNew" , "mapNew");

</script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make(merchant_layout_vw().'.index', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/saudidragonmart/public_html/resources/views/merchant/store/index.blade.php ENDPATH**/ ?>