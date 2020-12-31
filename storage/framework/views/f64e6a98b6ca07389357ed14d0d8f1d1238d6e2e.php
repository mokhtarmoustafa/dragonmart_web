<?php $__env->startSection('content'); ?>
    <div class="main-content shop-page inner-page contact-page">
        <div class="container">
            <div class="breadcrumbs">
                <a href="<?php echo e(url('site/home')); ?>"><?php echo e(trans('app.site.home.home')); ?></a> \ <span class="current"><?php echo e(trans('app.contact.contact')); ?></span>
            </div>
            <div class="row content-form ">
                <div class="col-xs-12 col-sm-12 col-md-5 col-lg-5 map-content">
                    <div class="map" id="map" style="width:100%;height:300px;"></div>
                </div>
                <div class="col-xs-12 col-sm-12 col-md-7 col-lg-7 info-content">
                    <div class="contact-form">
                        <div class="row">
                            <div class="col-xs-12 col-sm-6 col-md-6 col-lg-6">
                                <span class="label-text"><?php echo e(ucfirst(trans('app.contact.name'))); ?> *</span>
                                <input type="text" class="input-info required" name="name" id="name">
                            </div>
                            <div class="col-xs-12 col-sm-6 col-md-6 col-lg-6">
                                <span class="label-text"><?php echo e(ucfirst(trans('app.contact.email'))); ?> *</span>
                                <input type="text" class="input-info" name="email" id="email">
                            </div>
                        </div>
                        <span class="label-text"><?php echo e(ucfirst(trans('app.contact.phone'))); ?></span>
                        <input type="text" class="input-info " name="phone" id="phone">
                        <span class="label-text"><?php echo e(ucfirst(trans('app.contact.message'))); ?> *</span>
                        <textarea rows="8"  class="input-info input-note required" name="message" id="message"></textarea>
                        <div class="group-button">
                            <button class="button submit" type="button" onclick="onSendEmail()"><?php echo e(ucfirst(trans('app.contact.send_message'))); ?></button>
                        </div>
                    </div>
                </div>

            </div>
        </div>

    </div>

    <style>
        .error{
            border:1px solid #f00!important;
        }
    </style>


    <?php $__env->startPush('js'); ?>
    <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyC37ZOdPlm3cYT3R0PXghW3nS56nZjd0So&callback=initMap"></script>


    <?php $__env->stopPush(); ?>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('javascript'); ?>






    <script src="https://cdn.klokantech.com/maptilerlayer/v1/index.js"></script>

    <script src="<?php echo e(url('assets/js/intlTelInput.js')); ?>"></script>
    <script>







    </script>

    <script>
        text_success = '<div class="alert alert-success" > Success Send Message</div>';
        function onSendEmail() {

            console.log('send' );

            required = false;

            var set = $('.required');
            var length = set.length;
            $('.required').each(function(index, element){

                if( $(this).val() == '')
                {


                    required = true;
                    $(this).parent('div').addClass('has-error');
                    $(this).addClass('error');
                }
                else
                {
                    $(this).parent('div').removeClass('has-error');
                    $(this).removeClass('error');
                }
            });


            if(!required){

                var toastTitle = 'Send Email' ;
                var toastBody =  'Send Email To Admin Successfully' ;

                data = {

                    'name' : $('#name').val(),
                    'email':$('#email').val(),
                    'message':$('#message').val(),
                    'phone':$('#phone').val()

                };


                jQuery.ajax({
                    url: "<?php echo e(url(site_url().'/sendemail')); ?>",
                    type: 'POST',
                    dataType: "json",
                    data:data,
                    success: function (data) {
                        toastr.success(toastBody, toastTitle);
                        $('#name').val('');
                        $('#email').val('');
                        $('#message').val('');
                        $('#phone').val('');
                    }
                });



            }
        }
    </script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make(site_layout_vw().'.index', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/saudidragonmart/public_html/resources/views/site/contact.blade.php ENDPATH**/ ?>