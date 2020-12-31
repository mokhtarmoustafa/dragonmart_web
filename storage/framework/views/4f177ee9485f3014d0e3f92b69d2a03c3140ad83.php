<script src="<?php echo e(url('/')); ?>/assets/global/plugins/respond.min.js"></script>
<script src="<?php echo e(url('/')); ?>/assets/global/plugins/excanvas.min.js"></script>
<script src="<?php echo e(url('/')); ?>/assets/global/plugins/ie8.fix.min.js"></script>

<!-- BEGIN CORE PLUGINS -->
<script src="<?php echo e(url('/')); ?>/assets/global/plugins/jquery.min.js" type="text/javascript"></script>
<script src="<?php echo e(url('/')); ?>/assets/global/plugins/bootstrap/js/bootstrap.min.js" type="text/javascript"></script>
<script src="<?php echo e(url('/')); ?>/assets/global/plugins/js.cookie.min.js" type="text/javascript"></script>
<script src="<?php echo e(url('/')); ?>/assets/global/plugins/jquery-slimscroll/jquery.slimscroll.min.js"
        type="text/javascript"></script>
<script src="<?php echo e(url('/')); ?>/assets/global/plugins/jquery.blockui.min.js" type="text/javascript"></script>
<script src="<?php echo e(url('/')); ?>/assets/global/plugins/bootstrap-switch/js/bootstrap-switch.min.js"
        type="text/javascript"></script>
<!-- END CORE PLUGINS -->
<!-- BEGIN PAGE LEVEL PLUGINS -->
<script src="<?php echo e(url('/')); ?>/assets/global/plugins/bootstrap-toastr/toastr.min.js" type="text/javascript"></script>

<script>
    var baseURL = '<?php echo e(url(merchant_vw())); ?>';
    var baseAssets = '<?php echo e(url('assets')); ?>';

    $(window).keydown(function (event) {
        if (event.keyCode == 13) {
            event.preventDefault();
            return false;
        }
    });
</script>

<?php echo $__env->yieldContent('js'); ?>

<script>
    var csrf_token = $('meta[name="csrf-token"]').attr('content');
</script>
<script src="<?php echo e(url('/')); ?>/assets/pages/scripts/ui-toastr.min.js" type="text/javascript"></script>

<!-- BEGIN THEME LAYOUT SCRIPTS -->
<script src="<?php echo e(url('/')); ?>/assets/layouts/layout2/scripts/layout.min.js" type="text/javascript"></script>
<script src="<?php echo e(url('/')); ?>/assets/layouts/layout2/scripts/demo.min.js" type="text/javascript"></script>
<script src="<?php echo e(url('/')); ?>/assets/layouts/global/scripts/quick-sidebar.min.js" type="text/javascript"></script>
<script src="<?php echo e(url('/')); ?>/assets/layouts/global/scripts/quick-nav.min.js" type="text/javascript"></script>
<!-- END THEME LAYOUT SCRIPTS -->
<script src="<?php echo e(url('/')); ?>/assets/global/plugins/bootbox/bootbox.min.js" type="text/javascript"></script>
<script>
    toastr.options = {
        "closeButton": true,
        "debug": false,
        "positionClass": "toast-top-right",
        "onclick": null,
        "showDuration": "1000",
        "hideDuration": "1000",
        "timeOut": "5000",
        "extendedTimeOut": "1000",
        "showEasing": "swing",
        "hideEasing": "linear",
        "showMethod": "fadeIn",
        "hideMethod": "fadeOut"
    }
</script>

<script type="text/javascript"
        src="https://maps.googleapis.com/maps/api/js?key=<?php echo e(google_api_key()); ?>"></script>
<script>


    function myMap(address, lat, long) {

        var myLatLng = {lat: Number(lat), lng: Number(long)};


        var map = new google.maps.Map(document.getElementById("map"), {
            zoom: 10,
            center: myLatLng,

            gestureHandling: 'cooperative'
        });

        map.setOptions({scrollwheel: false});


        //sets variable for lat and long

        var marker = new google.maps.Marker({
            position: myLatLng,
            map: map,
            title: address
        });

        google.maps.event.addListener(marker, 'click', function () {
            map.setZoom(9);
            map.setCenter(marker.getPosition());
        });

        google.maps.event.addListener(map, 'click', function (event) {
            marker.setPosition(event.latLng);
            // $('#lat').val(event.latitude);
            // $('#lng').val(event.longitude);
        });
    }


</script>

<script>
    var geocoder;
    var map;
    var marker;
    var marker2;

    function initialize(address, lat, long) {
        geocoder = new google.maps.Geocoder();
        var
            latlng = new google.maps.LatLng(lat, long);
        var mapOptions = {
            zoom: 10,
            center: latlng
        }
        map = new google.maps.Map(document.getElementById('map'), mapOptions);

        var marker = new google.maps.Marker({
            position: latlng,
            map: map,
            title: address,
        });

        google.maps.event.addListener(map, 'click', function (event) {
            //alert(event.latLng);
            geocoder.geocode({
                'latLng': event.latLng
            }, function (results, status) {
                if (status == google.maps.GeocoderStatus.OK) {
                    if (results[1]) {
                        // var marker = new google.maps.Marker({
                        //     position: event.latLng,
                        //     map: map,
                        //     title: results[1].formatted_address
                        // });
                        marker.setPosition(event.latLng);
                        // $('#lat').val(event.latitude);
                        // $('#lng').val(event.longitude);
                        marker.setTitle(results[1].formatted_address);
                        // google.maps.event.addListener(map, 'click', function (event) {
                        //
                        //
                        // });

                        $('#edit-merchant').find('#address').val(results[1].formatted_address);
                        $('#edit-merchant').find('#latitude').val(event.latLng.lat());
                        $('#edit-merchant').find('#longitude').val(event.latLng.lng());
                        // google.maps.event.addListener(marker, 'click', function () {
                        //     map.setZoom(9);
                        //     map.setCenter(marker.getPosition());
                        //     marker.setTitle = results[1].formatted_address;
                        // });

                        // google.maps.event.addListener(map, 'click', function (event) {
                        //     // $('#lat').val(event.latitude);
                        //     // $('#lng').val(event.longitude);
                        // });

                    } else {
                        alert('No results found');
                    }
                } else {
                    alert('Geocoder failed due to: ' + status);
                }
            });
        }); <!--click event-->
    }

    // google.maps.event.addDomListener(window, 'load', initialize);
</script>

<?php echo $__env->yieldPushContent('js'); ?>



<?php echo $__env->yieldContent('js2'); ?>


<?php echo $__env->yieldPushContent('js2'); ?>
<?php /**PATH /home/saudidragonmart/public_html/resources/views/merchant/layout/js.blade.php ENDPATH**/ ?>