@extends(site_layout_vw().'.index')

@section('content')
    <div class="main-content shop-page inner-page contact-page">
        <div class="container">
            <div class="breadcrumbs">
                <a href="{{url('site/home')}}">{{trans('app.site.home.home')}}</a> \ <span class="current">{{trans('app.contact.contact')}}</span>
            </div>
            <div class="row content-form ">
                <div class="col-xs-12 col-sm-12 col-md-5 col-lg-5 map-content">
                    <div class="map" id="map" style="width:100%;height:300px;"></div>
                </div>
                <div class="col-xs-12 col-sm-12 col-md-7 col-lg-7 info-content">
                    <div class="contact-form">
                        <div class="row">
                            <div class="col-xs-12 col-sm-6 col-md-6 col-lg-6">
                                <span class="label-text">{{ucfirst(trans('app.contact.name'))}} *</span>
                                <input type="text" class="input-info required" name="name" id="name">
                            </div>
                            <div class="col-xs-12 col-sm-6 col-md-6 col-lg-6">
                                <span class="label-text">{{ucfirst(trans('app.contact.email'))}} *</span>
                                <input type="text" class="input-info" name="email" id="email">
                            </div>
                        </div>
                        <span class="label-text">{{ucfirst(trans('app.contact.phone'))}}</span>
                        <input type="text" class="input-info " name="phone" id="phone">
                        <span class="label-text">{{ucfirst(trans('app.contact.message'))}} *</span>
                        <textarea rows="8"  class="input-info input-note required" name="message" id="message"></textarea>
                        <div class="group-button">
                            <button class="button submit" type="button" onclick="onSendEmail()">{{ucfirst(trans('app.contact.send_message'))}}</button>
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


    @push('js')
    <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyC37ZOdPlm3cYT3R0PXghW3nS56nZjd0So&callback=initMap"></script>


    @endpush
@stop

@section('javascript')






    <script src="https://cdn.klokantech.com/maptilerlayer/v1/index.js"></script>

    <script src="{{url('assets/js/intlTelInput.js')}}"></script>
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
                    url: "{{url(site_url().'/sendemail')}}",
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
@endsection
