@extends(site_layout_vw().'.index')

@section('content')
    <?php

    $parameters = \Request::query();
    // dd( $parameters );

    ?>
    <link rel="stylesheet" href="{{url('assets/js/intlTelInput.css')}}">

    <div class="main-content shop-page inner-page login-page hidden">
        <div class="container">
            <div class="breadcrumbs">
                <a href="{{url('site/home')}}">{{trans('app.site.home.home')}}</a> \ <span
                    class="current"> {{trans('app.site.login_create')}}</span>
            </div>
            <div class="login-register-form content-form row">
                <div class="col-xs-12 col-sm-12 col-md-6 col-lg-6">
                    <div class="login-form">
                        <form class="form-horizontal"
                              role="form"
                              method="POST"
                              action="{{ url('login/web') }}">
                            <input type="hidden"
                                   name="_token"
                                   value="{{ csrf_token() }}">

                            @if(Session::has('message'))
                                <p class="alert {{ Session::get('alert-class', 'alert-info') }}">{{ Session::get('message') }}</p>
                            @endif

                            <h4 class="main-title">{{trans('app.site.login')}}</h4>
                            <h5 class="note-title">{{trans('app.site.welcome')}}</h5>
                            <span class="label-text">{{trans('app.site.email_address')}}</span>
                            <input type="text" class="input-info" name="email">
                            <span class="label-text">{{trans('app.site.password')}}</span>
                            <input type="password" class="input-info" name="password">


                            <div class="check-box">
                                <input type="checkbox" class="login-check" id="login-check">
                                <label class="text-label" for="login-check">{{trans('app.site.remember')}}</label>
                                <a href="#" class="forgot"> {{trans('app.site.forget')}}</a>
                            </div>

                            <input type="hidden" name="redirect_page"
                                   value="{{ (isset($parameters['redirectpage'])) ? $parameters['redirectpage'] :''}}">
                            <div class="group-button">
                                <button class="button submit">{{trans('app.site.login')}}</button>
                            </div>
                            <input type="hidden" id="crt_login" name="crt_login">
                        </form>
                    </div>
                </div>
                <div class="col-xs-12 col-sm-12 col-md-6 col-lg-6">
                    <div class="register-form">
                        <h4 class="main-title">{{trans('app.site.sign_up')}}</h4>

                        @if (count($errors) > 0)
                            <div class="alert alert-danger">

                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach

                            </div>
                        @endif
                        <form class="form-horizontal"
                              role="form"
                              method="POST"
                              action="{{ url('register/web') }}" id="formRegister">
                            <input type="hidden"
                                   name="_token"
                                   value="{{ csrf_token() }}">


                            <span class="label-text">{{trans('app.site.user_type')}} <span>*</span></span>
                            <select class="input-info" id="selectTypeUser" name="typeuser">
                                <option value="client">{{trans('app.site.client')}}</option>
                                <option value="merchant">{{trans('app.site.merchant')}}</option>
                                <option value="service_provider">{{trans('app.site.provider')}}</option>
                            </select>
                            <span class="label-text namename">{{trans('app.site.name')}} <span>*</span></span>
                            <input type="text" class="input-info" name="name" id="name">

                            <div>
                                <span class="label-text">{{trans('app.site.email_address')}} <span>*</span></span>
                                <input type="email" class="input-info" name="email" id="email">
                            </div>

                            <span class="label-text">{{trans('app.site.phone')}} <span>*</span></span>
                            <div>
                                <input type="text" class="input-info" name="phone" id="phone">
                            </div>

                            <div id="categ_section" style="display: none; margin: 10px 2px;">
                                <span class="label-text">{{trans('app.site.choose_category')}} <span>*</span></span>
                                <br>
                                <?php $cats = Categories()?>
                                <select class="input-info chosen-select" multiple
                                        data-placeholder="{{trans('app.site.choose_category')}}"
                                        id="cats" name="cat[]">
                                    @foreach($cats as $s)
                                        <option value="{{$s->id}}">{{$s->name}}</option>
                                    @endforeach
                                </select>
                            </div>

                            <div id="services_section" style="display: none; margin: 10px 2px;">
                                <span class="label-text">{{trans('app.site.choose_services')}} <span>*</span></span>
                                <br>
                                <?php $services = Services()?>
                                <select class="input-info chosen-select" multiple
                                        data-placeholder="{{trans('app.site.choose_services')}}"
                                        id="services" name="services[]">
                                    @foreach($services as $s)
                                        <option value="{{$s->id}}">{{$s->name}}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div id="city_section" style="display: none">
                                <span class="label-text">{{trans('app.site.choose_city')}} <span>*</span></span>
                                <select class="input-info" id="selectcity" name="city">

                                </select>
                            </div>
                            <div>
                                <input id="dialcode" type="hidden" name="dialcode">
                                <span class="label-text">{{trans('app.site.location')}} <span>*</span></span>
                                <input type="text" class="input-info" name="address" id="address" onclick="openMap()">
                                <input id="latitude" type="hidden" name="latitude">
                                <input id="longitude" type="hidden" name="longitude">
                            </div>

                            <input type="hidden" name="redirect_page"
                                   value="{{ (isset($parameters['redirectpage'])) ? $parameters['redirectpage'] :''}}">

                            <div class="row">
                                <div class="col-xs-12 col-sm-6 col-md-6 col-lg-6">
                                    <span class="label-text">{{trans('app.site.password')}} <span>*</span></span>
                                    <input type="password" class="input-info" name="password" id="password" required>
                                </div>
                                <div class="col-xs-12 col-sm-6 col-md-6 col-lg-6">
                                    <span
                                        class="label-text">{{trans('app.site.confirm_password')}} <span>*</span></span>
                                    <input type="password" class="input-info" name="password_confirmation"
                                           id="confirm_password">
                                </div>
                            </div>
                            <div class="group-button">
                                <button class="button submit" onclick="submitFn()">{{trans('app.site.submit')}}</button>
                            </div>
                            <input type="hidden" id="crt_reg" name="crt_reg">
                        </form>
                    </div>


                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="forget" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle"
         aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                {!! Form::open(['method'=>'POST','url'=>url('password/email'),'id'=>'forget-password']) !!}

                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLongTitle"> {{trans('app.site.forget')}} </h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="alert" style="display: none"></div>

                    <input class="form-control" name="email" placeholder="{{trans('app.site.profile.email')}}" type="text"/>
                </div>
                <div class="modal-footer">
                    <button type="submit"
                            class="btn btn-success reset-password" title="{{trans('app.site.send')}}">{{trans('app.site.send')}}</button>
                    <button type="button" class="btn btn-danger"
                            data-dismiss="modal">{{trans('app.site.close')}}</button>
                </div>
                {!! Form::close() !!}

            </div>
        </div>
    </div>
    <div class="modal fade" id="exampleModalLong" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle"
         aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLongTitle"> {{trans('app.site.choose_location')}} </h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">

                    <input id="autocomplete" class="form-control" placeholder="{{trans('app.site.add_location')}}"
                           type="text"/>

                    <div id="map" style="height: 300px; width:100%; margin-top: 10px"></div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary"
                            data-dismiss="modal">{{trans('app.site.close')}}</button>
                    <button type="button" class="btn btn-primary"
                            onclick="AddPlace()">{{trans('app.site.set_location')}}</button>
                </div>
            </div>
        </div>
    </div>

    <style>

        .pac-container {
            z-index: 9999999;
            display: block;
        }

        .login-register-form .input-info {
            margin-bottom: 7px;
        }

        input.error[type="email"] {
            border: 1px solid #FF0000;
        }

        input.error[type="text"] {
            border: 1px solid #FF0000;
        }

        label.error {
            color: #FF0000;
        }

        .err {
            border: 1px solid #f00 !important;
        }

    </style>



@stop

@section('javascript')






    <script src="https://cdn.klokantech.com/maptilerlayer/v1/index.js"></script>

    <script src="{{url('assets/js/intlTelInput.js')}}"></script>
    <script>


        var input = document.querySelector("#phone");


        var init = window.intlTelInput(input, {
            initialCountry: "sa",
            utilsScript: "{{url('assets/js/utils.js')}}",
            geoIpLookup: function (success, failure) {
                $.get("https://ipinfo.io", function () {
                }, "jsonp").always(function (resp) {
                    var countryCode = (resp && resp.country) ? resp.country : "";
                    success(countryCode);
                });
            },
        });


        countrydata = init.getSelectedCountryData().dialCode;
        $('#dialcode').val(countrydata);


        input.addEventListener("countrychange", function () {
            countrydata = init.getSelectedCountryData().dialCode;
            $('#dialcode').val(countrydata);
        });


        $('.forgot').click(function () {
            $('#forget').modal('show');
        });
        $('#selectTypeUser').change(function () {


            if ($('#selectTypeUser').val() == 'service_provider') {
                $('#services_section').css('display', 'block');
            } else {
                $('#services_section').css('display', 'none');
            }

            if ($('#selectTypeUser').val() == 'merchant') {
                $('#categ_section').css('display', 'block');
            } else {
                $('#categ_section').css('display', 'none');
            }

            if ($('#selectTypeUser').val() == 'merchant' || $('#selectTypeUser').val() == 'service_provider') {
                $('#city_section').css('display', 'block');
                jQuery.ajax({
                    url: "{{url(site_url().'/cities')}}",
                    type: 'get',
                    dataType: "json",
                    success: function (data) {
                        options = '';
                        $.each(data.items, function (index, value) {
                            options += '<option value="' + value.id + '">' + value.name_en + '</option>';
                        });
                        $('#selectcity').append(options);
                        $("#selectcity").chosen({disable_search_threshold: 10});

                    },
                    complete: function (data) {
                        $("#selectcity").chosen({disable_search_threshold: 10});
                    }
                });
            } else {
                $('#city_section').css('display', 'none');
            }
        });

        $(document).ready(function () {

            $(document).on('submit', '#forget-password', function (e) {
                e.preventDefault();
                var $url = $(this).attr('action');
                var $this = $(this);
                $this.find('.reset-password').attr('disabled', true);
                $this.find('.reset-password').html('{{__('app.waiting')}}');
                var $title = $this.find('.reset-password').attr('title');
                var $formData = new FormData($(this)[0]);
                $.ajax({
                    url: $url,
                    type: 'POST',
                    dataType: 'json',
                    data: $formData,
                    contentType: false,
                    processData: false,
                    success: function (data) {
                        if (data.status) {
                            $this.find('.alert').addClass('alert-success');
                            $this.find('.alert').removeClass('alert-danger');

                            setTimeout(function () {

                                $('#forget').modal('hide');

                            }, 3000)
                        } else {
                            $this.find('.alert').addClass('alert-danger');
                            $this.find('.alert').removeClass('alert-success');
                        }
                        $this.find('.alert').show().text(data.message);
                        $this.find('.reset-password').html($title);
                        $this.find('.reset-password').attr('disabled', false);

                    }
                });
            });


            $("#phone").on("keypress keyup blur", function (event) {
                $(this).val($(this).val().replace(/[^\d].+/, ""));
                if ((event.which < 48 || event.which > 57)) {
                    event.preventDefault();
                }
            });


            cartfromstorage = localStorage.getItem("cart");
            if (typeof (cartfromstorage) != "undefined" && cartfromstorage !== null) {
                var cart = JSON.parse(cartfromstorage);
                // console.log(cart.cart[0].name + ' heel');
                $('#crt_reg').val(cartfromstorage);
                $('#crt_login').val(cartfromstorage);
            }
        });

        function AddPlace() {
            $('#address').val($('#autocomplete').val());
            $('#exampleModalLong').modal('hide');
        }


        function geocodeLatLng(location, first) {

            geocoder.geocode({'location': location}, function (results, status) {
                if (status === 'OK') {
                    if (results[0]) {

                        var address = results[0].formatted_address;
                        if (first == '1') {
                            $('#autocomplete').val(address);
                        } else {
                            $('#autocompleteEnd').val(address);
                        }


                    } else {
                        window.alert('No Adress name found in this location');
                    }
                } else {
                    window.alert('Geocoder failed due to: ' + status);
                }
            });
        }


        function handleLocationError(browserHasGeolocation, infoWindow, pos) {
            infoWindow.setPosition(pos);
            infoWindow.setContent(browserHasGeolocation ?
                'Error: The Geolocation service failed.' :
                'Error: Your browser doesn\'t support geolocation.');
            infoWindow.open(map);
        }


        text_success = '<div class="alert alert-success" > Success </div>';
        markersFrist = [];
        marker = [];
        nowto = 0;
        var map, places, infoWindow;
        markers = [];
        var autocomplete;
        var autocompleteEnd;
        var countryRestrict = {'country': 'tr'};
        var MARKER_PATH = 'https://developers.google.com/maps/documentation/javascript/images/marker_green';
        var hostnameRegexp = new RegExp('^https?://.+?/');


        function getPositionErrorMessage(code) {
            console.log('error place code' + code);
        }

        function initMap() {
            const initialPosition = {lat: 24.68995489824611, lng: 46.68389121691894};

            firstlat = 24.68995489824611;
            firstlng = 46.68389121691894;


            directionsService = new google.maps.DirectionsService();
            directionsDisplay = new google.maps.DirectionsRenderer();
            geocoder = new google.maps.Geocoder;
            map = new google.maps.Map(document.getElementById('map'), {

                center: {lat: 24.68995489824611, lng: 46.68389121691894},
                mapTypeControl: true,
                panControl: true,
                zoomControl: true,
                streetViewControl: false,
                zoom: 17
            });

            directionsDisplay.setMap(map);
            mapMaxZoom = 13;
            geoloccontrol = new klokantech.GeolocationControl(map, mapMaxZoom);
            infoWindow = new google.maps.InfoWindow({
                content: document.getElementById('info-content')
            });

            map.addListener('click', function (event) {

                placeMarker(map, event.latLng);

            });
            const marker = new google.maps.Marker({map, position: initialPosition});


            markers.push(marker);

            // Create the autocomplete object and associate it with the UI input control.
            // Restrict the search to the default country, and to place type "cities".
            autocomplete = new google.maps.places.Autocomplete(
                /** @type {!HTMLInputElement} */ (
                    document.getElementById('autocomplete'))
            );

            places = new google.maps.places.PlacesService(map);
            autocomplete.addListener('place_changed', onPlaceChanged);


        }


        function deleteMarkers() {
            clearMarkers();
            marker = [];
        }

        function setMapOnAll(map) {
            for (var i = 0; i < markers.length; i++) {
                markers[i].setMap(map);
            }
        }


        function clearMarkers() {
            setMapOnAll(null);
        }


        function placeMarker(map, location) {

            deleteMarkers();
            var marker = new google.maps.Marker({
                position: location,
                map: map,

            });

            markers.push(marker);


            setLongLatmyFunction(location);
            var infowindow = new google.maps.InfoWindow({
                content: 'Your Place'
            });

            infowindow.open(map, marker);
            geocodeLatLng(location, '1');


        }

        function setLongLatmyFunction(marker) {

            $('#latitude').val(marker.lat());
            $('#longitude').val(marker.lng());


        }


        function onPlaceChanged() {
            var place = autocomplete.getPlace();
            if (place.geometry) {
                map.panTo(place.geometry.location);
                map.setZoom(15);
                search();
            } else {
                document.getElementById('autocomplete').placeholder = 'Enter a city';
            }
        }

        // Search for hotels in the selected city, within the viewport of the map.
        function search() {


            var mark = [];
            var search = {
                bounds: map.getBounds(),
                types: ['lodging']
            };

            places.nearbySearch(search, function (results, status) {
                if (status === google.maps.places.PlacesServiceStatus.OK) {
                    //clearResults();
                    deleteMarkers();
                    // Create a marker for each hotel found, and
                    // assign a letter of the alphabetic to each marker icon.
                    for (var i = 0; i < results.length; i++) {
                        var markerLetter = String.fromCharCode('A'.charCodeAt(0) + (i % 26));
                        var markerIcon = 'http://www.coffeecreamthemes.com/themes/taxigrabber/html/images/map-marker.png';
                        // Use marker animation to drop the icons incrementally on the map.
                        mark[i] = new google.maps.Marker({
                            position: results[i].geometry.location,
                            animation: google.maps.Animation.DROP,
                            icon: markerIcon
                        });


                    }

                    $('#latitude').val(mark[0].position.lat());
                    $('#longitude').val(mark[0].position.lng());

                    //  console.log('change now m '+  mark[0].position.lat());
                    // console.log('change now lng m'+  mark[0].position.lng());

                    var marker = new google.maps.Marker({
                        position: mark[0].position,
                        map: map,

                    });

                    markers.push(marker);


                    // If the user clicks a hotel marker, show the details of that hotel
                    // in an info window.
                    mark[i].placeResult = results[i];
                    google.maps.event.addListener(mark[i], 'click', showInfoWindow);
                    setTimeout(dropMarker(i), i * 100);
                    addResult(results[i], i);


                }

            });
        }

        // Set the country restriction based on user input.
        // Also center and zoom the map on the given country.
        function setAutocompleteCountry() {
            var country = document.getElementById('country').value;
            if (country == 'all') {
                autocomplete.setComponentRestrictions({'country': []});
                map.setCenter({lat: 15, lng: 0});
                map.setZoom(2);
            } else {
                autocomplete.setComponentRestrictions({'country': country});
                map.setCenter(countries[country].center);
                map.setZoom(countries[country].zoom);
            }
            // clearResults();
            clearMarkers();
        }

        function dropMarker(i) {
            return function () {
                markers[i].setMap(map);
            };
        }

        function addResult(result, i) {
            var results = document.getElementById('results');
            var markerLetter = String.fromCharCode('A'.charCodeAt(0) + (i % 26));
            var markerIcon = MARKER_PATH + markerLetter + '.png';

            var tr = document.createElement('tr');
            tr.style.backgroundColor = (i % 2 === 0 ? '#F0F0F0' : '#FFFFFF');
            tr.onclick = function () {
                google.maps.event.trigger(markers[i], 'click');
            };

            var iconTd = document.createElement('td');
            var nameTd = document.createElement('td');
            var icon = document.createElement('img');
            icon.src = markerIcon;
            icon.setAttribute('class', 'placeIcon');
            icon.setAttribute('className', 'placeIcon');
            var name = document.createTextNode(result.name);
            iconTd.appendChild(icon);
            nameTd.appendChild(name);
            tr.appendChild(iconTd);
            tr.appendChild(nameTd);
            results.appendChild(tr);
        }


        // Get the place details for a hotel. Show the information in an info window,
        // anchored on the marker for the hotel that the user selected.
        function showInfoWindow() {
            var marker = this;

            places.getDetails({placeId: marker.placeResult.place_id},
                function (place, status) {
                    if (status !== google.maps.places.PlacesServiceStatus.OK) {
                        return;
                    }
                    infoWindow.open(map, marker);

                });
        }


    </script>

    <script
        src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDviHB7G4RWAgQNwvjaVXLhC1j5DNTSPFE&libraries=places&callback=initMap"
        async defer></script>

    <script>
        function openMap() {

            $('#exampleModalLong').modal('show');
        }


        function submitFn() {


            $('#phone').removeClass('err');
            if ($('#phone').val() == '' | $('#phone').val().length < 10) {

                $('#phone').addClass('err');
                return;

            }


            //  e.preventDefault();
            var req = 'This field is required ';
            var req_password = 'password is required';
            var em = 'email address is required';
            var phone_val = 'enter phone value';
            var confirm_val = 'password an password confirm not equal ';
            var number = 'phone must be correct number ';

            console.log(' validate now ');


            $("#formRegister").validate({

                rules: {
                    password: "required",
                    password_confirmation: {
                        equalTo: "#password",
                        required: true,
                    },
                    email: {
                        required: true,
                        email: true
                    },


                    username: "required",
                    address: "required",


                },
                messages: {
                    'name': {
                        required: req,
                    },


                    'password': {
                        required: req_password
                    },

                    'email': {
                        required: req,
                        email: em
                    },

                    'confirm_password': {
                        equalTo: confirm_val,
                        required: req,

                    },
                    'phone': {
                        rangelength: phone_val,
                        number: number,
                        required: req,

                    },
                    'conditions': {
                        required: 'You must Approve to term conditions ',

                    },


                }
            });


        }

    </script>
@endsection
