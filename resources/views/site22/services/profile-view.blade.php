@extends(site_layout_vw().'.index')

@section('content')
    <div class="main-content shop-page inner-page shoppingcart-content">
        <div class="container">
            <div class="breadcrumbs">
                <a href="{{url('site/home')}}">{{trans('app.site.home.home')}}</a> \ <span class="current">{{$provider->username}}</span>
            </div>
            <div class="row provider-info">
                <div class="col-sm-12 col-md-8">
                    <div class="profile-info-wrap">
                        <h4 class="main-title">{{$provider->username}}</h4>
                        <div class="product-rate">
                            @php $rate =  (int)$provider->service_rate ;
                             $neg_rate = (int) 5- $provider->service_rate ;
                            @endphp
                            @for($i=0 ; $i < $rate; ++$i)
                                <i class="fa fa-star active"></i>
                            @endfor
                            @for($i=0 ; $i <  $neg_rate; ++$i)
                                <i class="fa fa-star "></i>
                            @endfor
                        </div>
                        <div class="provider-text">
                            <p>{{$provider->bio}}</p>
                        </div>
                    </div>
                </div>
                <div class="col-sm-12 col-md-4 content-form">
                    <div class="information-form provider-contact">
                        <div class="row">
                            <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                                <ul class="list-info">
                                    <li>
                                        <div class="icon"><i class="fa fa-envelope" aria-hidden="true"></i></div>
                                        <div class="info">
                                            <h5 class="subtitle">{{trans('app.site.email_address')}}</h5>
                                            <a href="#" class="des">{{$provider->email}}</a>
                                        </div>
                                    </li>
                                    <li>
                                        <div class="icon"><i class="fa fa-phone" aria-hidden="true"></i></div>
                                        <div class="info">
                                            <h5 class="subtitle">{{trans('app.site.phone')}}</h5>
                                            <p class="des">{{$provider->mobile}}</p>
                                        </div>
                                    </li>
                                    <li>
                                        <div class="icon"><i class="fa fa-map-marker" aria-hidden="true"></i></div>
                                        <div class="info">
                                            <h5 class="subtitle">{{trans('app.site.address')}}</h5>
                                            <p class="des">{{$provider->address}}</p>
                                        </div>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="services-list-wrap content-form">
                <h3 class="services-list-title">{{trans('app.site.services_list')}}</h3>
                <div class="services-list scrollbar-inner">




                    @foreach($services as $s)

                    <div class="service-item" onclick="addServiceID({{$s->id}})">
                        <div class="service-title">{{$s->text}}</div>
                        <div class="service-price">{{trans('app.price')}}: <span>{{$s->price}} {{trans('app.site.home.sar')}}</span></div>
                        <div class="service-selection"><i class="fa fa-check-circle-o"></i></div>
                    </div>

                        @endforeach



                </div>

                <div class="checkout-cart group-button service-form" style="margin:25px 0 0;display: none;">
                    <div class="row">
                        <div class="col-xs-6 col-sm-5">

                            <input type="text" class="input-info" value="{{(isset($user->address))? $user->address: ''}}" id="address" onclick="openMap()">
                            <input id="latitude" type="hidden" name="latitude" value="{{(isset($user->latitude))? $user->latitude: ''}}">
                            <input id="longitude" type="hidden" name="longitude" value="{{(isset($user->longitude))? $user->longitude: ''}}">
                            <input id="url" type="hidden" name="url" value="{{request()->url()}}">

                        </div>
                        <div class="col-xs-6 col-sm-5"><input type="text" class="input-info datetimepicker"
                                                              placeholder="Service Time"/></div>
                        <div class="col-xs-12 col-sm-2"><a href="javascript:void(0)" class="continue-shopping apply-services submit" onclick="applyService()">{{trans('app.apply')}}</a>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>


    <div class="modal fade" id="exampleModalLong" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLongTitle">{{trans('app.site.add_location')}}</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">

                    <input id="autocomplete" class="form-control" placeholder="{{trans('app.site.add_location')}}" type="text" />

                    <div id="map" style="height: 300px; width:100%; margin-top: 10px"></div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">{{trans('app.site.close')}}</button>
                    <button type="button" class="btn btn-primary" onclick="AddPlace()">{{trans('app.site.set_location')}}</button>
                </div>
            </div>
        </div>
    </div>

    <style>

        .pac-container{
            z-index:9999999;
            display: block;
        }
    </style>


@stop


@section('javascript')

    <script>


        function applyService(){

            jQuery.ajax({
                url: "{{url(site_url().'/send_request')}}",
                type: 'POST',
                dataType: "json",
                data :{
                    address: $('#address').val(),
                    latitude:$('#latitude').val(),
                    longitude:$('#longitude').val(),
                    arrival_date:$('.datetimepicker').val(),
                    url: $('#url').val(),
                    service_ids:services_id

                },
                success: function (data) {
                    if(data.status){
                       window.location='{{url(site_url().'/orders-category/pending')}}';
                    }else{
                        window.location = data.redirect;
                    }


                }
            });
        }
        services_id = [];
       function addServiceID(id){
           isexist = false ;
           for (var i = 0; i < services_id.length; i++) {
               if (services_id[i] == id) {
                   services_id.splice(i, 1);
                   isexist = true;
               }
           }
           if(isexist == false){
               services_id.push(id);
           }


           console.log(' the ids is ' +services_id);
       }

    </script>

    <script src="https://cdn.klokantech.com/maptilerlayer/v1/index.js"></script>
    <script>
     $('.datetimepicker').datetimepicker(
         {format:'Y-MM-DD HH:mm:ss',}
     );





        function AddPlace(){
            $('#address').val($('#autocomplete').val());
            $('#exampleModalLong').modal('hide');
        }





        function geocodeLatLng(location ,first) {

            geocoder.geocode({'location': location}, function(results, status) {
                if (status === 'OK') {
                    if (results[0]) {

                        var address = results[0].formatted_address;
                        if(first=='1'){
                            $('#autocomplete').val(address);
                        }else{
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






        markersFrist=[];
        marker=[];
        nowto = 0;
        var map, places, infoWindow;
        markers = [];
        var autocomplete;
        var autocompleteEnd;
        var countryRestrict = {'country': 'tr'};
        var MARKER_PATH = 'https://developers.google.com/maps/documentation/javascript/images/marker_green';
        var hostnameRegexp = new RegExp('^https?://.+?/');


        function getPositionErrorMessage(code){
            console.log('error place code'+code);
        }

        function initMap() {
            @if(Auth::user())
            var lat = '{{$user->latitude}}';
            var lng = '{{$user->longitude}}';
            @else
            var lat = 38.92508148993897;
            var lng = 35.63450999999998;
            @endif
            console.log('lng bef'+ lng);
            lat = parseFloat(lat) ;
            lng = parseFloat(lng) ;
            if(! lat > 0){
                lat = 38.92508148993897 ;
                lng = 35.63450999999998;
            }

            const initialPosition = { lat:lat , lng:lng};



            directionsService = new google.maps.DirectionsService();
            directionsDisplay = new google.maps.DirectionsRenderer();
            geocoder = new google.maps.Geocoder;
            map = new google.maps.Map(document.getElementById('map'), {

                center: {lat:lat, lng:lng},
                mapTypeControl: true,
                panControl: true,
                zoomControl: true,
                streetViewControl: false ,
                zoom: 17
            });

            directionsDisplay.setMap(map);
            mapMaxZoom= 13;
            geoloccontrol = new klokantech.GeolocationControl(map, mapMaxZoom);
            infoWindow = new google.maps.InfoWindow({
                content: document.getElementById('info-content')
            });

            map.addListener('click', function(event) {

                placeMarker(map, event.latLng);

            });
            const marker = new google.maps.Marker({ map, position: initialPosition });




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
                map: map ,

            });

            markers.push(marker);



            setLongLatmyFunction(location);
            var infowindow = new google.maps.InfoWindow({
                content: 'Your Place'
            });

            infowindow.open(map,marker);
            geocodeLatLng(location,'1');


        }

        function setLongLatmyFunction(marker){

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

            places.nearbySearch(search, function(results, status) {
                if (status === google.maps.places.PlacesServiceStatus.OK) {
                    //clearResults();
                    deleteMarkers() ;
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

                    $('#latitude').val( mark[0].position.lat());
                    $('#longitude').val( mark[0].position.lng());

                    var marker = new google.maps.Marker({
                        position: mark[0].position,
                        map: map ,

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
            return function() {
                markers[i].setMap(map);
            };
        }

        function addResult(result, i) {
            var results = document.getElementById('results');
            var markerLetter = String.fromCharCode('A'.charCodeAt(0) + (i % 26));
            var markerIcon = MARKER_PATH + markerLetter + '.png';

            var tr = document.createElement('tr');
            tr.style.backgroundColor = (i % 2 === 0 ? '#F0F0F0' : '#FFFFFF');
            tr.onclick = function() {
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
                function(place, status) {
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
        function  openMap(){

            $('#exampleModalLong').modal('show');
        }

    </script>

@endsection
