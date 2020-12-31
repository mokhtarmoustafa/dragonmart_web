@extends(site_layout_vw().'.index')

@section('content')
    <div class="main-content shop-page inner-page login-page">
        <div class="container">
            <div class="breadcrumbs">
                <a href="#">{{trans(lang_app_site().'.home.home')}}</a> \ <span
                        class="current"> {{trans(lang_app_site().'.profile.account')}}</span>
            </div>
            <div class="login-register-form content-form row">
                <div class="col-xs-12 col-sm-12 col-md-8 col-lg-8">
                    <div class="login-form">
                        <h4 class="main-title">{{trans(lang_app_site().'.profile.my_account')}}</h4>
                        <span class="label-text">{{trans(lang_app_site().'.profile.full_name')}}</span>
                        <input type="text" class="input-info" value="{{$user->username}}" id="username">
                        <span class="label-text">{{trans(lang_app_site().'.profile.email')}}</span>
                        <input type="email" class="input-info" value="{{$user->email}}" id="email">
                        <span class="label-text">{{trans(lang_app_site().'.profile.phone')}}</span>
                        <input type="text" class="input-info" value="{{$user->mobile}}" id="mobile">

                        <span class="label-text">{{trans(lang_app_site().'.profile.address')}}</span>
                        <input type="text" class="input-info" value="{{$user->address}}" id="address"
                               onclick="openMap()">
                        <input id="latitude" type="hidden" name="latitude" value="{{$user->latitude}}">
                        <input id="longitude" type="hidden" name="longitude" value="{{$user->longitude}}">
                        <div class="group-button">
                            <a href="javascript:void(0)" class="button submit"
                               onclick="updateProfile()">{{trans(lang_app_site().'.profile.save')}}</a>
                        </div>
                    </div>
                </div>
                <div class="col-xs-12 col-sm-12 col-md-4 col-lg-4">
                    <div class="proceed-checkout">
                        <h4 class="main-title">{{trans(lang_app_site().'.profile.order_history')}}</h4>
                        <div class="content orders-history">
                            <div class="info-checkout">
                                <a href="{{url(site_url().'/orders-category')}}/pending"><span
                                            class="text">{{trans(lang_app_site().'.profile.pending')}} : </span><span
                                            class="item">( {{ count($user->orders['pending'])}} )</span></a>
                            </div>
                            <div class="info-checkout">
                                <a href="{{url(site_url().'/orders-category')}}/finished"><span
                                            class="text">{{trans(lang_app_site().'.profile.closed')}}: </span>
                                    <span class="item">( {{ count($user->orders['finished'])}}  )</span></a>
                            </div>
                            <div class="info-checkout">
                                <a href="{{url(site_url().'/orders-category')}}/canceled"><span
                                            class="text">{{trans(lang_app_site().'.profile.cancelled')}} : </span>
                                    <span class="item">( {{ count($user->orders['canceled'])}}  )</span></a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="modal fade" id="exampleModalLong" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle"
         aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLongTitle"> {{trans(lang_app_site().'.choose_location')}} </h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">

                    <input id="autocomplete" class="form-control" placeholder="{{trans(lang_app_site().'.add_location')}} " type="text"/>

                    <div id="map" style="height: 300px; width:100%; margin-top: 10px"></div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">{{trans(lang_app_site().'.close')}}</button>
                    <button type="button" class="btn btn-primary" onclick="AddPlace()">{{trans(lang_app_site().'.set_location')}}</button>
                </div>
            </div>
        </div>
    </div>

    <style>

        .pac-container {
            z-index: 9999999;
            display: block;
        }
    </style>

@stop


@section('javascript')
    <script src="https://cdn.klokantech.com/maptilerlayer/v1/index.js"></script>
    <script>


        function updateProfile() {
            var toastTitle = 'Update Account';
            var toastBody = 'Update Your Account Successfully';

            jQuery.ajax({
                url: "{{url(site_url().'/userupdate')}}",
                type: 'POST',
                dataType: "json",
                data: {
                    username: $('#username').val(),
                    address: $('#address').val(),
                    mobile: $('#mobile').val(),
                    latitude: $('#latitude').val(),
                    longitude: $('#longitude').val()
                },
                success: function (data) {
                    if (data.status) {
                        toastr.success(toastBody, toastTitle);
                    }
                }
            });
        }


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
                        window.alert('{{trans(lang_app_site().'.no_address')}}');
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
            var lat = '{{$user->latitude}}';
            var lng = '{{$user->longitude}}';
            console.log('lng bef' + lng);
            lat = parseFloat(lat);
            lng = parseFloat(lng);
            if (!lat > 0) {
                lat = 38.92508148993897;
                lng = 35.63450999999998;
            }

            const initialPosition = {lat: lat, lng: lng};


            directionsService = new google.maps.DirectionsService();
            directionsDisplay = new google.maps.DirectionsRenderer();
            geocoder = new google.maps.Geocoder;
            map = new google.maps.Map(document.getElementById('map'), {

                center: {lat: lat, lng: lng},
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


        function doSend() {

            required = false;

            var set = $('.required');
            var length = set.length;
            $('.required').each(function (index, element) {

                if ($(this).val() == '') {


                    required = true;
                    $(this).parent('div').addClass('has-error');
                    $(this).addClass('error');


                } else {
                    $(this).parent('div').removeClass('has-error');
                    $(this).removeClass('error');

                }
            });


            if ($('#from_latitude').val() !== '') {
                $('#autocomplete').removeClass('error');
            }

            if ($('#to_latitude').val() !== '') {
                $('#autocomplete').removeClass('error');
            }


            if ($('#from_latitude').val() === '') {
                $('#autocomplete').addClass('error');
                required = true;
            }

            if ($('#to_latitude').val() === '') {
                console.log('Error mm ');
                $('#autocomplete').addClass('error');
                required = true;
            }


            if (!required) {


                data = {
                    'name': $('#name').val(),
                    'email': $('#email').val(),
                    'message': $('#message').val(),
                    'phone': $('#phone').val(),
                    'date': $('#date').val(),
                    'time': $('#time').val(),
                    'from_latitude': $('#from_latitude').val(),
                    'from_longitude': $('#from_longitude').val(),
                    'to_latitude': $('#to_latitude').val(),
                    'to_longitude': $('#to_longitude').val(),
                    'cartype': $('#cartype').val(),
                    'from_place': $('#autocomplete').val(),
                    'to_place': $('#autocompleteEnd').val(),
                };


                $.request('onSend', {
                    'data': data,
                    success: function (data) {

                        if (data.status) {
                            $('#sendBook').css('display', 'none');
                            $('#toMapModal').modal('show');
                            // $('#putData').html(text_success);
                        } else {
                            clearFncont(data.div);

                        }
                    }
                });
            }
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

    <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDviHB7G4RWAgQNwvjaVXLhC1j5DNTSPFE&libraries=places&callback=initMap"
            async defer></script>

    <script>
        function openMap() {

            $('#exampleModalLong').modal('show');
        }

    </script>
@endsection