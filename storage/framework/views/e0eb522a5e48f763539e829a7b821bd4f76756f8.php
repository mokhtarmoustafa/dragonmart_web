

<?php $__env->startSection('css'); ?>

<!-- BEGIN PAGE LEVEL PLUGINS -->
<link href="<?php echo e(url('/')); ?>/assets/global/plugins/select2/css/select2.min.css" rel="stylesheet" type="text/css" />
<link href="<?php echo e(url('/')); ?>/assets/global/plugins/select2/css/select2-bootstrap.min.css" rel="stylesheet" type="text/css" />
<!-- END PAGE LEVEL PLUGINS -->
<!-- END PAGE LEVEL PLUGINS -->
<!-- BEGIN THEME GLOBAL STYLES -->

<link href="<?php echo e(url('/')); ?>/assets/global/css/plugins-md.min.css" rel="stylesheet" type="text/css" />
<!-- END THEME GLOBAL STYLES -->




<?php $__env->stopSection(); ?>
<?php $__env->startSection('content'); ?>
<?php
// print_r($store);
?>
<div class="accordion accordion-solid accordion-panel accordion-svg-toggle" id="stores">

  <?php foreach ($store as $store_id => $storeInfo) : ?>

    <div class="card">
      <div class="card-header" id="heading<?php echo e($storeInfo['id']); ?>">
        <div class="card-title collapsed" data-toggle="collapse" data-target="#store<?php echo e($storeInfo['id']); ?>">
          <div class="card-label"><?php echo e($storeInfo['name']); ?></div>
          <span class="svg-icon">
            <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
              <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                <polygon points="0 0 24 0 24 24 0 24"></polygon>
                <path d="M12.2928955,6.70710318 C11.9023712,6.31657888 11.9023712,5.68341391 12.2928955,5.29288961 C12.6834198,4.90236532 13.3165848,4.90236532 13.7071091,5.29288961 L19.7071091,11.2928896 C20.085688,11.6714686 20.0989336,12.281055 19.7371564,12.675721 L14.2371564,18.675721 C13.863964,19.08284 13.2313966,19.1103429 12.8242777,18.7371505 C12.4171587,18.3639581 12.3896557,17.7313908 12.7628481,17.3242718 L17.6158645,12.0300721 L12.2928955,6.70710318 Z" fill="#000000" fill-rule="nonzero"></path>
                <path d="M3.70710678,15.7071068 C3.31658249,16.0976311 2.68341751,16.0976311 2.29289322,15.7071068 C1.90236893,15.3165825 1.90236893,14.6834175 2.29289322,14.2928932 L8.29289322,8.29289322 C8.67147216,7.91431428 9.28105859,7.90106866 9.67572463,8.26284586 L15.6757246,13.7628459 C16.0828436,14.1360383 16.1103465,14.7686056 15.7371541,15.1757246 C15.3639617,15.5828436 14.7313944,15.6103465 14.3242754,15.2371541 L9.03007575,10.3841378 L3.70710678,15.7071068 Z" fill="#000000" fill-rule="nonzero" opacity="0.3" transform="translate(9.000003, 11.999999) rotate(-270.000000) translate(-9.000003, -11.999999) "></path>
              </g>
            </svg>
          </span>
        </div>
      </div>
      <div id="store<?php echo e($storeInfo['id']); ?>" class="collapse" data-parent="#stores">
        <div class="card-body">


            <div class="card-header card-header-tabs-line">
              <div class="card-toolbar">
                <ul class="nav nav-tabs nav-bold nav-tabs-line">
                  <li class="nav-item">
                    <a class="nav-link active" data-toggle="tab" href="#tab_general_<?php echo e($storeInfo['id']); ?>">
                      <span class="nav-icon"><i class="flaticon2-chat-1"></i></span>
                      <span class="nav-text">المعلومات الاساسية</span>
                    </a>
                  </li>
                  <li class="nav-item">
                    <a class="nav-link" data-toggle="tab" href="#tab_times_<?php echo e($storeInfo['id']); ?>">
                      <span class="nav-icon"><i class="flaticon2-drop"></i></span>
                      <span class="nav-text">أوقات العمل</span>
                    </a>
                  </li>

                </ul>
              </div>
            </div>
            <div class="card-body">
                  <form class="" action="<?php echo e(url('merchant/store/'.$storeInfo['id'])); ?>" method="post" id="store_<?php echo e($storeInfo['id']); ?>">
              <div class="tab-content">
                <div class="tab-pane fade show active" id="tab_general_<?php echo e($storeInfo['id']); ?>" role="tabpanel" aria-labelledby="tab_general_<?php echo e($storeInfo['id']); ?>">

                    <?php echo csrf_field(); ?>
                    <div class="form-group">
                      <div class="form-group row pt-3 pr-5 pl-5">
                        <div class="col-md-6">
                          <label><?php echo e(trans(lang_app_site().'.CP.Store name')); ?></label>
                          <input id="name" class="form-control" name="name" type="text" placeholder="<?php echo e(trans(lang_app_site().'.CP.Store name')); ?>" value="<?php echo e($storeInfo['name'] ?? ''); ?>" required>
                        </div>

                        <div class="col-md-6">
                          <label><?php echo e(trans(lang_app_site().'.CP.Store Phone')); ?></label>
                          <div class="input-group">
                            <span class="input-group-addon mt-auto mb-auto mr-2" id="basic-addon1">+966</span>
                            <input id="phone" class="form-control" name="phone" type="number" placeholder="<?php echo e(trans(lang_app_site().'.CP.Store Phone')); ?>" value="<?php echo e($storeInfo['phone'] ?? ''); ?>" min="500000000" max="5999999999" required>
                          </div>
                        </div>
                      </div>

                      <div class="clearfix margin-bottom-10"></div>
                      <div class="clearfix margin-bottom-10"></div>
                      <div class="control-label col-md-2">
                        <label><?php echo e(trans(lang_app_site().'.CP.Map')); ?></label>
                      </div>
                      <div class="col-md-12">
                        <input type="hidden" name="lat" value="<?php echo e($storeInfo['lat']); ?>" id="latmap<?php echo e($storeInfo['id']); ?>">
                        <input type="hidden" name="lng" value="<?php echo e($storeInfo['lng']); ?>" id="lngmap<?php echo e($storeInfo['id']); ?>">

                        <div id="map<?php echo e($storeInfo['id']); ?>" style="height: 300px;"></div>
                      </div>
                    </div>


                </div>
                <div class="tab-pane fade" id="tab_times_<?php echo e($storeInfo['id']); ?>" role="tabpanel" aria-labelledby="tab_times_<?php echo e($storeInfo['id']); ?>">
                  <table class="table table-bordered mt-5">
                    <thead>
                    <tr>
                    <th>
                          اليوم
                        </th>
                        <th>
                          بداية العمل
                        </th>
                        <th>
                          نهاية العمل
                        </th>
                        <th>
                          متاح للطلب
                        </th>
                      </tr>
                    </thead>
                    <tbody>
                      <?php 


                      $storeInfo['open_times'] = json_decode($storeInfo['open_times'] , true);
                      $storeInfo['close_times'] = json_decode($storeInfo['close_times'] , true);
                      $storeInfo['state_times'] = json_decode($storeInfo['state_times'] , true);

                      ?> 
                      <?php $__currentLoopData = config('app.days_names'); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $day): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>

                      <tr>
                        <td>
                          <?php echo e($day); ?>

                        </td>
                        <td>
                        <input type="time" name="time[open][<?php echo e($day); ?>]" class="form-control" value="<?php echo e($storeInfo['open_times'][$day]); ?>" />
                        </td>
                        <td>
                        <input type="time" name="time[close][<?php echo e($day); ?>]" class="form-control" value="<?php echo e($storeInfo['close_times'][$day]); ?>" />
                        </td>
                        <td>
                        <select class="form-control"  name="time[state][<?php echo e($day); ?>]">
                          <option value="1" <?php if($storeInfo['state_times'][$day] == 1): ?> selected <?php endif; ?>>تفعيل</option>
                          <option value="0" <?php if($storeInfo['state_times'][$day] == 0): ?> selected <?php endif; ?>>تعطيل</option>
                        </select>
                        </td>
                      </tr>

                      <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </tbody>


                  </table>
                </div>
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
              </form>

            </div>


        </div>
      </div>
    </div>

  <?php endforeach; ?>



</div>

<div class="row">
  <div class="col-md-12 mt-10">
    <div class="card card-custom">
      <div class="card-header">
        <div class="card-title">
          <i class="icon-settings"></i>
          <span class="caption-subject bold uppercase font-blue-dark"> <?php echo e(trans(lang_app_site().'.CP.New Store')); ?></span>
        </div>
        <div class="card-toolbar">

          <button class="btn btn-circle btn-primary add-category-mdl" form="NewStore">
            <i class="fa fa-check"></i>
            <span class="hidden-xs"> <?php echo e(trans(lang_app_site().'.CP.save')); ?></span>
          </button>

        </div>
      </div>
      <div class="portlet-body">
        <form class="" action="<?php echo e(url('merchant/store/new')); ?>" method="post" id="NewStore">

          <?php echo csrf_field(); ?>
          <div class="form-group">
            <div class="form-group row pt-3 pr-5 pl-5">
              <div class="col-md-6">
                <label><?php echo e(trans(lang_app_site().'.CP.Store name')); ?></label>
                <input id="name" class="form-control" name="name" type="text" placeholder="<?php echo e(trans(lang_app_site().'.CP.Store name')); ?>" value="" required>
              </div>

              <div class="col-md-6">
                <label><?php echo e(trans(lang_app_site().'.CP.Store Phone')); ?></label>
                <div class="input-group">
                  <span class="input-group-addon mt-auto mb-auto mr-2" id="basic-addon1">+966</span>
                  <input id="phone" class="form-control" name="phone" type="number" placeholder="<?php echo e(trans(lang_app_site().'.CP.Store Phone')); ?>" value="" min="500000000" max="5999999999" required>
                </div>
              </div>
            </div>

            <div class="clearfix margin-bottom-10"></div>
            <div class="clearfix margin-bottom-10"></div>
            <div class="control-label col-md-2">
              <label><?php echo e(trans(lang_app_site().'.CP.Map')); ?></label>
            </div>
            <div class="col-md-12">
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
<script src="<?php echo e(url('/')); ?>/assets/global/plugins/datatables/plugins/bootstrap/datatables.bootstrap.js" type="text/javascript"></script>


<script src="<?php echo e(url('/')); ?>/assets/global/plugins/bootstrap-datepicker/js/bootstrap-datepicker.min.js" type="text/javascript"></script>
<!-- END PAGE LEVEL PLUGINS -->
<script src="<?php echo e(url('/')); ?>/assets/global/plugins/select2/js/select2.full.min.js" type="text/javascript"></script>


<!-- BEGIN PAGE LEVEL PLUGINS -->
<script src="<?php echo e(url('/')); ?>/assets/global/plugins/fancybox/source/jquery.fancybox.pack.js" type="text/javascript"></script>
<script src="<?php echo e(url('/')); ?>/assets/global/plugins/jquery-file-upload/js/vendor/jquery.ui.widget.js" type="text/javascript"></script>
<script src="<?php echo e(url('/')); ?>/assets/global/plugins/jquery-file-upload/js/vendor/tmpl.min.js" type="text/javascript"></script>
<script src="<?php echo e(url('/')); ?>/assets/global/plugins/jquery-file-upload/js/vendor/load-image.min.js" type="text/javascript"></script>
<script src="<?php echo e(url('/')); ?>/assets/global/plugins/jquery-file-upload/js/vendor/canvas-to-blob.min.js" type="text/javascript"></script>
<script src="<?php echo e(url('/')); ?>/assets/global/plugins/jquery-file-upload/blueimp-gallery/jquery.blueimp-gallery.min.js" type="text/javascript"></script>
<script src="<?php echo e(url('/')); ?>/assets/global/plugins/jquery-file-upload/js/jquery.iframe-transport.js" type="text/javascript"></script>
<script src="<?php echo e(url('/')); ?>/assets/global/plugins/jquery-file-upload/js/jquery.fileupload.js" type="text/javascript"></script>
<script src="<?php echo e(url('/')); ?>/assets/global/plugins/jquery-file-upload/js/jquery.fileupload-process.js" type="text/javascript"></script>
<script src="<?php echo e(url('/')); ?>/assets/global/plugins/jquery-file-upload/js/jquery.fileupload-image.js" type="text/javascript"></script>
<script src="<?php echo e(url('/')); ?>/assets/global/plugins/jquery-file-upload/js/jquery.fileupload-audio.js" type="text/javascript"></script>
<script src="<?php echo e(url('/')); ?>/assets/global/plugins/jquery-file-upload/js/jquery.fileupload-video.js" type="text/javascript"></script>
<script src="<?php echo e(url('/')); ?>/assets/global/plugins/jquery-file-upload/js/jquery.fileupload-validate.js" type="text/javascript"></script>
<script src="<?php echo e(url('/')); ?>/assets/global/plugins/jquery-file-upload/js/jquery.fileupload-ui.js" type="text/javascript"></script>
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

<script type="text/javascript" src="https://maps.googleapis.com/maps/api/js?key=AIzaSyC7ax66Fm7Kpibq6p-e9yPil-9stOvndsc"></script>

<script src="https://cdn.klokantech.com/maptilerlayer/v1/index.js"></script>
<script>
  <?php $__currentLoopData = $store; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $store_id => $storeInfo): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
  var map_<?php echo e($storeInfo['id']); ?>;
  <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

  let myMapID, marker;

  function addYourLocationButton(map, marker) {
    var controlDiv = document.createElement('div');

    var firstChild = document.createElement('button');
    firstChild.type = "button";
    firstChild.style.backgroundColor = '#fff';
    firstChild.style.border = 'none';
    firstChild.style.outline = 'none';
    firstChild.style.width = '40px';
    firstChild.style.height = '40px';
    firstChild.style.borderRadius = '2px';
    firstChild.style.boxShadow = '0 1px 4px rgba(0,0,0,0.3)';
    firstChild.style.cursor = 'pointer';
    firstChild.style.marginRight = '10px';
    firstChild.style.padding = '0px';
    firstChild.title = 'Your Location';
    controlDiv.appendChild(firstChild);

    var secondChild = document.createElement('div');
    secondChild.style.margin = '11px';
    secondChild.style.width = '18px';
    secondChild.style.height = '18px';
    secondChild.style.backgroundImage = 'url(https://maps.gstatic.com/tactile/mylocation/mylocation-sprite-1x.png)';
    secondChild.style.backgroundSize = '180px 18px';
    secondChild.style.backgroundPosition = '0px 0px';
    secondChild.style.backgroundRepeat = 'no-repeat';
    secondChild.id = 'you_location_img';
    firstChild.appendChild(secondChild);

    google.maps.event.addListener(map, 'dragend', function() {
      $('#you_location_img').css('background-position', '0px 0px');
    });

    firstChild.addEventListener('click', function() {
      var imgX = '0';
      var animationInterval = setInterval(function() {
        if (imgX == '-18') imgX = '0';
        else imgX = '-18';
        $('#you_location_img').css('background-position', imgX + 'px 0px');
      }, 500);
      if (navigator.geolocation) {
        navigator.geolocation.getCurrentPosition(function(position) {
          var latlng = new google.maps.LatLng(position.coords.latitude, position.coords.longitude);
          marker.setPosition(latlng);
          map.setCenter(latlng);
          clearInterval(animationInterval);
          $('#you_location_img').css('background-position', '-144px 0px');
        });
      } else {
        clearInterval(animationInterval);
        $('#you_location_img').css('background-position', '0px 0px');
      }
    });

    controlDiv.index = 1;
    map.controls[google.maps.ControlPosition.RIGHT_BOTTOM].push(controlDiv);
  }

  function myMap2(id, address, lat = "", long = "") {
    lat = lat != "" ? lat : 24.6555252855;
    long = long != "" ? long : 46.55855545555;
    var myLatLng = {
      lat: Number(lat),
      lng: Number(long)
    };

    myMapID = window["map_" + id];
    myMapID = new google.maps.Map(document.getElementById(id), {
      zoom: 4,
      center: myLatLng,
      gestureHandling: 'cooperative'
    });

    myMapID.setOptions({
      scrollwheel: false
    });

    var marker = new google.maps.Marker({
      position: myLatLng,
      map: myMapID,
      title: address,
      draggable: true,
    });

    //--------------------------------------------------------
    addYourLocationButton(myMapID, marker);
    const locationButton = document.createElement("button");
    locationButton.textContent = "موقعي";
    locationButton.classList.add("custom-map-control-button", "btn", "btn-primary", "mt-5");
    locationButton.type = "button";
    myMapID.controls[google.maps.ControlPosition.TOP_CENTER].push(locationButton);

    locationButton.addEventListener("click", () => {
      // Try HTML5 geolocation.
      if (navigator.geolocation) {
        // get current location
        navigator.geolocation.getCurrentPosition(
          (position) => {
            const pos = {
              lat: position.coords.latitude,
              lng: position.coords.longitude,
            };
            marker.setPosition(pos);
            myMapID.setCenter(pos);
          },
          () => {
            handleLocationError(true, marker, myMapID.getCenter());
          }
        );
      } else {
        // Browser doesn't support Geolocation
        handleLocationError(false, marker, myMapID.getCenter());
      }
    });

    //--------------------------------------------------------

    myMapID.addListener('click', function(mapsMouseEvent) {
      marker.setPosition(mapsMouseEvent.latLng);
      $("#lat" + id).val(mapsMouseEvent.latLng.lat);
      $("#lng" + id).val(mapsMouseEvent.latLng.lng);
    });
  }

  function handleLocationError(browserHasGeolocation, marker, pos) {
    marker.setPosition(pos);
    marker.setContent(
      browserHasGeolocation ?
      "Error: The Geolocation service failed." :
      "Error: Your browser doesn't support geolocation."
    );
    marker.open(myMapID);
  }

  

  <?php $__currentLoopData = $store; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $store_id => $storeInfo): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
  myMap2("map<?php echo e($storeInfo['id']); ?>", "ssss" <?php if($storeInfo['lat'] != ""): ?> <?php echo e(','.$storeInfo['lat']); ?> <?php echo e(','.$storeInfo['lng']); ?> <?php endif; ?>);
  <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
   myMap2("mapNew", "mapNew");
</script>

<?php $__env->stopSection(); ?>
<?php echo $__env->make(merchant_layout_vw().'.index', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/saudidragonmart/public_html/resources/views/merchant/V2/store/index.blade.php ENDPATH**/ ?>