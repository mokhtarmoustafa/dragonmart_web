$(document).ready(function () {

    repeatAjax();

    function repeatAjax() {
        jQuery.ajax({
            type: 'GET',
            url: baseURL + '/following_up_data',
            dataType: "json",
            error: function (msg) {
                alert(msg.statusText);
                console.log('msg');
                console.log(msg);
                return msg;
            },
            success: function (orders) {

                console.log(orders);
                var row = $('#orders_followup_row');

                row.empty();

                $.each(orders, function (index, order) {
                    if (order != null) {
                        var card = followupCard(order);
                        row.append(card);
                    }
                });

                // setTimeout(repeatAjax, 1000);
            }
        });
    }

    setInterval(function () {
        repeatAjax();
    }, 100000);


    // setInterval(function(){
    //     $('#orders_followup_row').load(baseURL + '/following_up_data');
    //  }, 2000) /* time in milliseconds (ie 2 seconds)*/


    function followupCard(order) {

        var store = storeStatus(order['merchant_status']);
        var driver = driverStatus(order['driver_status']);

        var cardColor = '';


        str = '<div class="col-md-3">';
        str += '<div class="card card-custom gutter-b rounded-xl">';
        str += '<div class="card-body d-flex flex-column ribbon ribbon-top">';
        str += '<div class="ribbon-target bg-danger" style="top: -2px; left: 20px;">' + order['duration'] + '</div>';
        str += '<div class="row">';
        str += '<div class="symbol symbol-60 mr-3 rounded-xl" style="border: 2px solid rgb(253, 198, 147);">';
        str += '<div class="symbol-label rounded-xl" style="background-image: url(\'' + order['merchant']['image'] + '\');">';
        str += '</div>';
        str += '</div>';
        str += '<div class="d-flex align-items-center justify-content-between flex-grow-1">';
        str += '<div class="mr-2">';
        str += '<h3 class="font-weight-bolder">' + order['merchant']['username'] + '</h3>';
        str += '<div class="text-dark-50 font-size-md mt-2">' + order['store']['name'] + '</div>';
        str += '</div>';
        str += '<div class="font-size-h1 text-warning">#' + order['id'] + '</div>';
        str += '</div>';
        str += '</div>';
        str += '<div class="pt-8">';
        str += '<div class="d-flex align-items-center justify-content-between mb-3">';
        str += '<div class="text-dark-50 font-weight-bold mr-2">';
        str += '<i class="fas fa-concierge-bell text-dark-50 mr-2"></i>';
        str += store['status'];
        str += '</div>';
        str += '<div class="text-dark-50 font-weight-bold">' + store['duration'] + '</div>';
        str += '</div>';
        str += '<div class="progress bg-light-warning progress-xs">';
        str += '<div class="progress-bar bg-' + store['color'] + '" role="progressbar" style="width: ' + store['percentage'] + '%;" aria-valuenow="' + store['percentage'] + '" aria-valuemin="0" aria-valuemax="100"></div>';
        str += '</div>';
        str += '</div>';
        str += '<div class="pt-8">';
        str += '<div class="d-flex align-items-center justify-content-between mb-3">';
        str += '<div class="text-dark-50 font-weight-bold mr-2">';
        str += '<i class="fas fa-car-side text-dark-50 mr-2"></i>';
        str += driver['status'];
        str += '</div>';
        str += '<div class="text-dark-50 font-weight-bold">' + driver['duration'] + '</div>';
        str += '</div>';
        str += '<div class="progress bg-light-warning progress-xs">';
        str += '<div class="progress-bar bg-warning" role="progressbar" style="width: ' + driver['percentage'] + '%;" aria-valuenow="' + driver['percentage'] + '" aria-valuemin="0" aria-valuemax="100"></div>';
        str += '</div>';
        str += '</div>';
        str += '</div>';
        str += '</div>';
        str += '</div>';

        card = $.parseHTML(str);
        return card;
    }

    function storeStatus(merchant_status) {

        var percentage = 0;
        var status = '';
        var color = 'warning'

        if (merchant_status == null) {
            return driver_status = {
                'status': 'New',
                'duration': '-',
                'percentage': percentage,
                'color': color
            };
        }

        if (merchant_status['status'] == 'new') {
            status = 'New';
            percentage = 0;
        }
        else if (merchant_status['status'] == 'accepted') {
            status = 'In Progress';
            percentage = 33;
        }
        else if (merchant_status['status'] == 'finished') {
            status = 'Completed';
            percentage = 66;
        }
        else if (merchant_status['status'] == 'pickup') {
            status = 'Pickd up';
            percentage = 100;
            color = 'success';
        }
        else {
            status = merchant_status['status'];
        }

        var store_status = {
            'status': status,
            'duration': merchant_status['duration'],
            'percentage': percentage,
            'color': color
        };

        return store_status;
    }

    function driverStatus(driver_status) {

        var percentage = 0;
        var status = '';
        var color = 'warning';

        if (driver_status == null) {
            return driver_status = {
                'status': 'No Driver',
                'duration': '-',
                'percentage': percentage,
                'color': color
            };
        }

        if (driver_status['status'] == 'pending') {
            status = 'No Driver';
            percentage = 0;
        }
        else if (driver_status['status'] == 'new') {
            status = 'New';
            percentage = 20;
        }
        else if (driver_status['status'] == 'accepted') {
            status = 'Accepted';
            percentage = 40;
        }
        else if (driver_status['status'] == 'store_arrival') {
            status = 'store_arrival';
            percentage = 60;
        }
        else if (driver_status['status'] == 'receive') {
            status = 'Received';
            percentage = 70;
        }
        else if (driver_status['status'] == 'client_arrival') {
            status = 'client_arrival';
            percentage = 95;
        }
        else {
            status = driver_status['status'];
        }

        var driver_status = {
            'status': status,
            'duration': driver_status['duration'],
            'percentage': percentage,
            'color': color
        };

        return driver_status;
    }

});