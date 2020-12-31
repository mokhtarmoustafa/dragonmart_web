@extends(site_layout_vw().'.index')

@section('content')

    <div class="main-content shop-page inner-page shoppingcart-content">
        <div class="container">
            <div class="breadcrumbs">
                <a href="{{url('site/home')}}">{{trans('app.site.home.home')}}</a> \ <span class="current">{{trans('app.order')}}</span>
            </div>
            <div class="row content-form">
                <div class="col-xs-12 col-sm-12 col-md-8 col-lg-9 content-offset">
                    <div class="cart-content">

                        <table class="shopping-cart-content">
                            <tr class="title">
                                <td width="80" class="product-thumb"></td>
                                <td class="product-name">{{ucfirst(trans('app.site.product.name'))}}</td>
                                <td class="price">{{ucfirst(trans('app.site.product.unit_price'))}}</td>
                                <td class="quantity-item">{{ucfirst(trans('app.site.product.quantity'))}}</td>
                                <td class="total">{{ucfirst(trans('app.site.product.cart_subtotal'))}}</td>
                            </tr>

                            <?php $countitems = 0;?>
                            <?php $totalprice = 0;?>
                            <?php $order_id = 0;?>

                            @foreach($orders as $order)
                                @if( $order->last_status == '' )

                                    <?php $order_id = $order->user_order_id ?>

                                    @if(isset($order->order_products))
                                        @foreach($order->order_products  as $prod )
                                            <?php $countitems = $countitems + 1;?>
                                            <?php $totalprice = $totalprice + $prod->total_price;

                                            $image = url('/') . '/assets/no-product.jpg';
                                            if (isset($prod->product->images[0]->image)) {
                                                $image = $prod->product->images[0]->image;
                                            }
                                            ?>


                                            <tr class="each-item">
                                                <td class="product-thumb"><a
                                                        href="{{url(site_url().'/product-page')}}/{{$prod->product->id}}"><img
                                                            src="{{$image}}"
                                                            alt=""></a>
                                                </td>
                                                <td class="product-name" data-title="Product Name"><a
                                                        href="{{url(site_url().'/product-page')}}/{{$prod->product->id}}"
                                                        class="product-name">{{$prod->product->name}}</a></td>
                                                <td class="price"
                                                    data-title="Unit Price">{{$prod->price}} {{trans(lang_app_site().'.home.sar')}}</td>
                                                <td class="quantity-item" data-title="Qty">{{$prod->quantity}}</td>
                                                <td class="total"
                                                    data-title="SubTotal">{{$prod->total_price}} {{trans(lang_app_site().'.home.sar')}}</td>
                                            </tr>

                                        @endforeach

                                    @endif
                                @endif

                            @endforeach
                        </table>

                    </div>
                </div>
                <div class="col-xs-12 col-sm-12 col-md-4 col-lg-3 ">
                    <div class="proceed-checkout">
                        <h4 class="main-title">{{trans(lang_app_site().'.product.proceed_checkout')}}</h4>
                        <div class="content">
                            <h5 class="title">{{trans(lang_app_site().'.product.total_price')}}</h5>
                            <div class="info-checkout">
                                <span class="text">{{trans(lang_app_site().'.product.quantity')}}: </span><span
                                    class="item">{{ $countitems }}</span>
                            </div>
                            <div class="info-checkout">
                                <span class="text">{{trans(lang_app_site().'.product.cart_subtotal')}}: </span><span
                                    class="item">{{ $totalprice }} {{trans(lang_app_site().'.home.sar')}}</span>
                            </div>
                            {{--                            <div class="info-checkout">--}}
                            {{--                                <span class="text">Deliver price: </span><span class="item">20 SAR</span>--}}
                            {{--                            </div>--}}
                            <div class="total-checkout">
                                <span class="text">{{trans(lang_app_site().'.product.total_price')}} </span><span
                                    class="price"> {{ $totalprice }} {{trans(lang_app_site().'.home.sar')}}</span>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-xs-12">
                    <div class="register-form">
                        <div class="row">
                            <div class="col-xs-12 col-sm-4">
                                <span class="label-text">{{trans('app.deliver_method')}}</span>
                                <select class="input-info" id="delMethod">
                                    <option value="delivery">{{trans('app.delivery')}}</option>
                                    <option value="pickup">{{trans('app.pick_up')}}</option>

                                </select>
                            </div>
                            <div class="col-xs-12 col-sm-4" id="ContLocation">
                                <?php $user = Auth::user(); ?>
                                <span class="label-text">{{trans('app.location')}}</span>
                                <input type="text" class="input-info" value="{{$user->address}}" id="address"
                                       onclick="openMap()">
                                <input id="latitude" type="hidden" name="latitude" value="{{$user->latitude}}">
                                <input id="longitude" type="hidden" name="longitude" value="{{$user->longitude}}">
                            </div>
                            <div class="col-xs-12 col-sm-4">
                                <span class="label-text">{{trans('app.schedule_delivery')}}</span>

                                <input type="text" class="input-info datetimepicker"
                                       placeholder="{{trans('app.timestamp')}}" id="dateOrder"/>
                            </div>
                        </div>
                    </div>
                    <table class="shopping-cart-content">
                        <tr class="checkout-cart group-button">
                            <td colspan="6" class="left">
                                <div class="left">
                                    <a href="javascript:void(0)" class="continue-shopping submit"
                                       onclick="submitOrder()">{{trans('app.apply')}}</a>
                                </div>
                            </td>
                        </tr>
                    </table>
                </div>
            </div>
        </div>

    </div>

    <div class="modal fade" id="exampleModalLong" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle"
         aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title"
                        id="exampleModalLongTitle"> {{trans(lang_app_site().'.choose_location')}} </h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">

                    <input id="autocomplete" class="form-control"
                           placeholder="{{trans(lang_app_site().'.add_location')}} " type="text"/>

                    <div id="map" style="height: 300px; width:100%; margin-top: 10px"></div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary"
                            data-dismiss="modal">{{trans(lang_app_site().'.close')}}</button>
                    <button type="button" class="btn btn-primary"
                            onclick="AddPlace()">{{trans(lang_app_site().'.set_location')}}</button>
                </div>
            </div>
        </div>
    </div>

    <style>

        .pac-container {
            z-index: 9999999;
            display: block;
        }

        .error {
            border: 1px solid #f00 !important;
        }
    </style>
@stop



@section('javascript')




    <script src="https://cdn.klokantech.com/maptilerlayer/v1/index.js"></script>
    <script>


        $('.datetimepicker').datetimepicker(

        );

        function submitOrder() {
            toastBody = 'Add Order ';
            toastTitle = 'add Order Successfully';
            $('#address').removeClass('error');
            $('#dateOrder').removeClass('error');
            if ($('#dateOrder').val() == '') {
                $('#dateOrder').addClass('error');
                return;
            }
            var m = $('#delMethod').val();
            if (m == 'delivery') {
                if ($('#address').val() == '') {
                    $('#address').addClass('error');
                    return;
                }
            }


            jQuery.ajax({
                url: "{{url(site_url().'/order')}}",
                type: 'POST',
                dataType: "json",
                data: {
                    user_order_id: '<?php echo $order_id ?>',
                    procurement_method: $('#delMethod').val(),
                    address: $('#address').val(),
                    latitude: $('#latitude').val(),
                    longitude: $('#longitude').val()

                },
                success: function (data) {
                    if (data.status) {
                        toastr.success(toastBody, toastTitle);
                        window.location = data.items.payment_url;//'
                        // window.open(data.items.payment_url);

                        {{--                        window.location = '{{url(site_url().'/orders-category/pending')}}';--}}
                    }
                }
            });


        }

        $('#delMethod').change(function () {
            var m = $('#delMethod').val();
            if (m == 'delivery') {
                $('#ContLocation').show();
            } else {
                $('#ContLocation').hide();
            }


        });

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

    <script
        src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDviHB7G4RWAgQNwvjaVXLhC1j5DNTSPFE&libraries=places&callback=initMap"
        async defer></script>

    <script>
        function openMap() {

            $('#exampleModalLong').modal('show');
        }

    </script>
@endsection
