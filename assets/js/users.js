var users_tbl = $("#users_tbl");
var drivers_merchant_tbl = $("#drivers_merchant_tbl");
var drivers_tbl = $("#drivers_tbl");
var merchants_tbl = $("#merchants_tbl");
var service_providers_tbl = $("#service_providers_tbl");

var merchant_id = $('#merchant_id').val();
$(document).ready(function () {


    if ($("#users_tbl").length) {

        users_tbl.on('preXhr.dt', function (e, settings, data) {
            data.merchant_id = $('#merchant_id').val();
            data.username = $('#username_c').val();
            data.email = $('#email_c').val();
            data.type = $('#type').val();
            data.mobile = $('#mobile_c').val();
            data.is_active = $('#is_active_c').val();
        }).dataTable({
            "processing": true,
            "serverSide": true,
            "ajax": {
                url: baseURL + "/user-data",
                "dataSrc": function (json) {
                    //Make your callback here.
                    if (json.status !== undefined && !json.status) {
                        $('#users_tbl_processing').hide();
                        bootbox.alert(json.message);
                        //
                    } else
                        return json.data;
                }
                ,
                error: function (xhr, error, code) {
                    $('#users_tbl_processing').hide();
                    toastr.error('You do not have permissions to clients list')
                }
            },

            columns: [
                {data: 'DT_RowIndex', name: 'DT_RowIndex'},
                // {data: 'image', name: 'image'},
                {data: 'username', name: 'username'},
                {data: 'email', name: 'email'},
                // {data: 'email_verified_at', name: 'email_verified_at'},
                {data: 'mobile', name: 'mobile'},
                // {data: 'is_confirm_code', name: 'is_confirm_code'},
                // {data: 'type', name: 'type'},
                {data: 'address', name: 'address'},
                {data: 'is_active', name: 'is_active'},
                {data: 'action', name: 'action'}
            ],

            language: {
                "sProcessing": "<img src='" + baseAssets + "/apps/img/preloader_.gif'>",
            },

            "searching": false,
            "ordering": false,
            bStateSave: !0,
            lengthMenu: [[5, 10, 15, 20, -1], [5, 10, 15, 20, "All"]],
            pageLength: 10,
            pagingType: "bootstrap_full_number",
            columnDefs: [{orderable: !1, targets: [0]}, {searchable: !1, targets: [0]}, {className: "dt-right"}],
            order: [[1, "asc"]],

        });
    }
    if ($("#merchants_tbl").length) {

        merchants_tbl.on('preXhr.dt', function (e, settings, data) {
            data.merchant_id = $('#merchant_id').val();
            data.username = $('#username_m').val();
            data.email = $('#email_m').val();
            data.type = $('#type').val();
            data.mobile = $('#mobile_m').val();
            data.is_active = $('#is_active_m').val();
        }).dataTable({
            "processing": true,
            "serverSide": true,
            "ajax": {
                url: baseURL + "/users/merchant-data",
                "dataSrc": function (json) {
                    //Make your callback here.
                    if (json.status !== undefined && !json.status) {
                        $('#merchants_tbl_processing').hide();
                        bootbox.alert(json.message);
                        //
                    } else
                        return json.data;
                },
                error: function (xhr, error, code) {
                    $('#merchants_tbl_processing').hide();
                    toastr.error('You do not have permissions to merchants list')
                }
            },

            columns: [
                {data: 'DT_RowIndex', name: 'DT_RowIndex'},
                {data: 'image', name: 'image'},
                {data: 'username', name: 'username'},
                {data: 'email', name: 'email'},
                // {data: 'email_verified_at', name: 'email_verified_at'},
                {data: 'mobile', name: 'mobile'},
                // {data: 'is_confirm_code', name: 'is_confirm_code'},
                {data: 'city.name_en', name: 'city.name_en'},
                {data: 'address', name: 'address'},
                {data: 'is_active', name: 'is_active'},
                {data: 'action', name: 'action'}
            ],

            language: {
                "sProcessing": "<img src='" + baseAssets + "/apps/img/preloader_.gif'>",
            },

            "searching": false,
            "ordering": false,
            bStateSave: !0,
            lengthMenu: [[5, 10, 15, 20, -1], [5, 10, 15, 20, "All"]],
            pageLength: 10,
            pagingType: "bootstrap_full_number",
            columnDefs: [{orderable: !1, targets: [0]}, {searchable: !1, targets: [0]}, {className: "dt-right"}],
            order: [[1, "asc"]],

        });
    }
    if ($("#drivers_merchant_tbl").length) {

        drivers_merchant_tbl.on('preXhr.dt', function (e, settings, data) {
            data.merchant_id = $('#merchant_id').val();
            data.username = $('#username').val();
            data.email = $('#email').val();
            data.mobile = $('#mobile').val();
            data.is_active = $('#is_active').val();
        }).dataTable({
            "processing": true,
            "serverSide": true,
            "ajax": {
                url: baseURL + "/driver-data",
                "dataSrc": function (json) {
                    //Make your callback here.
                    if (json.status !== undefined && !json.status) {
                        $('#drivers_tbl_processing').hide();
                        bootbox.alert(json.message);
                        //
                    } else
                        return json.data;
                },
                error: function (xhr, error, code) {
                    $('#drivers_merchant_tbl_processing').hide();
                    toastr.error('You do not have permissions to drivers list')
                }
            },

            columns: [
                {data: 'DT_RowIndex', name: 'DT_RowIndex'},
                // {data: 'image', name: 'image'},
                // {data: 'username', name: 'username'},
                // {data: 'email', name: 'email'},
                // // {data: 'email_verified_at', name: 'email_verified_at'},
                // {data: 'mobile', name: 'mobile'},
                // // {data: 'is_confirm_code', name: 'is_confirm_code'},
                // // {data: 'type', name: 'type'},
                // {data: 'address', name: 'address'},
                // {data: 'city', name: 'city'},
                // {data: 'driver_type', name: 'driver_type'},
                // {data: 'is_active', name: 'is_active'},
                // {data: 'action', name: 'action'}
                {data: 'image', name: 'image'},
                {data: 'driver_name', name: 'driver_name'},
                {data: 'email', name: 'email'},
                // {data: 'email_verified_at', name: 'email_verified_at'},
                {data: 'address', name: 'address'},
                {data: 'mobile', name: 'mobile'},
                {data: 'driver_type', name: 'driver_type'},
                {data: 'car_type', name: 'car_type'},
                {data: 'vehicle_color', name: 'vehicle_color'},
                {data: 'vehicle_number', name: 'vehicle_number'},
                // {data: 'is_confirm_code', name: 'is_confirm_code'},
                {data: 'is_active', name: 'is_active'},
                {data: 'action', name: 'action'}
            ],

            language: {
                "sProcessing": "<img src='" + baseAssets + "/apps/img/preloader_.gif'>",
            },

            "searching": false,
            "ordering": false,
            bStateSave: !0,
            lengthMenu: [[5, 10, 15, 20, -1], [5, 10, 15, 20, "All"]],
            pageLength: 10,
            pagingType: "bootstrap_full_number",
            columnDefs: [{orderable: !1, targets: [0]}, {searchable: !1, targets: [0]}, {className: "dt-right"}],
            order: [[1, "asc"]],

        });
    }
    if ($("#drivers_tbl").length) {

        drivers_tbl.on('preXhr.dt', function (e, settings, data) {
            data.merchant_id = $('#merchant_id').val();
            data.username = $('#username_d').val();
            data.email = $('#email_d').val();
            data.type = $('#type').val();
            data.mobile = $('#mobile_d').val();
            data.is_active = $('#is_active_d').val();
            data.driver_type_id = $('#driver_type_id').val();
        }).dataTable({
            "processing": true,
            "serverSide": true,
            "ajax": {
                url: baseURL + "/users/driver-data",
                "dataSrc": function (json) {
                    //Make your callback here.
                    if (json.status !== undefined && !json.status) {
                        $('#drivers_tbl_processing').hide();
                        bootbox.alert(json.message);
                        //
                    } else
                        return json.data;
                },
                error: function (xhr, error, code) {
                    $('#drivers_tbl_processing').hide();
                    toastr.error('You do not have permissions to drivers list')
                }
            },

            columns: [
                // {data: 'DT_RowIndex', name: 'DT_RowIndex'},
                {data: 'job_id', name: 'job_id'},
                {data: 'image', name: 'image'},
                {data: 'driver_name', name: 'driver_name'},
                {data: 'mobile', name: 'mobile'},
                {data: 'address', name: 'address'},
                {data: 'driver_type', name: 'driver_type'},
                {data: 'is_active', name: 'is_active'},
                {data: 'action', name: 'action'}
            ],

            "createdRow": function( row, data, dataIndex){
                console.log(data);
                if(data['is_driver_available'] == 1 && data['is_active'] == 1){
                    $(row).addClass('bg-light-success');
                }
                else if(data['is_driver_available'] == 0){
                    $(row).addClass('bg-light-warning');
                }
                else if(data['is_active'] == 0){
                    $(row).addClass('bg-light-danger');
                }
            },

            language: {
                "sProcessing": "<img src='" + baseAssets + "/apps/img/preloader_.gif'>",
            },

            "searching": false,
            "ordering": false,
            bStateSave: !0,
            lengthMenu: [[5, 10, 15, 20, -1], [5, 10, 15, 20, "All"]],
            pageLength: 10,
            pagingType: "bootstrap_full_number",
            columnDefs: [{orderable: !1, targets: [0]}, {searchable: !1, targets: [0]}, {className: "dt-right"}],
            order: [[1, "asc"]],

        });
    }
    if ($("#service_providers_tbl").length) {


        service_providers_tbl.on('preXhr.dt', function (e, settings, data) {
            data.merchant_id = $('#merchant_id').val();
            data.username = $('#username_s').val();
            data.email = $('#email_s').val();
            data.mobile = $('#mobile_s').val();
            data.is_active = $('#is_active_s').val();
        }).dataTable({
            "processing": true,
            "serverSide": true,
            "ajax": {
                url: baseURL + "/users/provider-data",
                "dataSrc": function (json) {
                    //Make your callback here.
                    if (json.status !== undefined && !json.status) {
                        $('#service_providers_tbl_processing').hide();
                        bootbox.alert(json.message);
                        //
                    } else
                        return json.data;
                },
                error: function (xhr, error, code) {
                    $('#drivers_tbl_processing').hide();
                    toastr.error('You do not have permissions to service providers list')
                }
            },

            columns: [
                {data: 'DT_RowIndex', name: 'DT_RowIndex'},
                {data: 'image', name: 'image'},
                {data: 'username', name: 'username'},
                {data: 'email', name: 'email'},
                // {data: 'email_verified_at', name: 'email_verified_at'},
                {data: 'mobile', name: 'mobile'},
                // {data: 'is_confirm_code', name: 'is_confirm_code'},
                // {data: 'type', name: 'type'},
                {data: 'address', name: 'address'},
                {data: 'city', name: 'city'},
                // {data: 'driver_type', name: 'driver_type'},
                {data: 'is_active', name: 'is_active'},
                {data: 'action', name: 'action'}
            ],

            language: {
                "sProcessing": "<img src='" + baseAssets + "/apps/img/preloader_.gif'>",
            },

            "searching": false,
            "ordering": false,
            bStateSave: !0,
            lengthMenu: [[5, 10, 15, 20, -1], [5, 10, 15, 20, "All"]],
            pageLength: 10,
            pagingType: "bootstrap_full_number",
            columnDefs: [{orderable: !1, targets: [0]}, {searchable: !1, targets: [0]}, {className: "dt-right"}],
            order: [[1, "asc"]],

        });
    }

    $(document).on("click", ".filter-submit-u", function () {
        users_tbl.api().ajax.reload();
    });
    $(document).on('click', '.filter-cancel-u', function () {
        $(".select2").val('').trigger('change');
        $(this).closest('tr').find('input').val('');
        users_tbl.api().ajax.reload();
    });
    $(document).on("click", ".filter-submit-d", function () {
        drivers_tbl.api().ajax.reload();
    });
    $(document).on('click', '.filter-cancel-d', function () {
        $(".select2").val('').trigger('change');
        $(this).closest('tr').find('input').val('');
        drivers_tbl.api().ajax.reload();
    });
    $(document).on("click", ".filter-submit-driver", function () {
        drivers_merchant_tbl.api().ajax.reload();
    });
    $(document).on('click', '.filter-cancel-driver', function () {
        $(".select2").val('').trigger('change');
        $(this).closest('tr').find('input').val('');
        drivers_merchant_tbl.api().ajax.reload();
    });
    $(document).on("click", ".filter-submit-m", function () {
        merchants_tbl.api().ajax.reload();
    });
    $(document).on('click', '.filter-cancel-m', function () {
        $(".select2").val('').trigger('change');
        $(this).closest('tr').find('input').val('');
        merchants_tbl.api().ajax.reload();
    });
    $(document).on("click", ".filter-submit-s", function () {
        service_providers_tbl.api().ajax.reload();
    });
    $(document).on('click', '.filter-cancel-s', function () {
        $(".select2").val('').trigger('change');
        $(this).closest('tr').find('input').val('');
        service_providers_tbl.api().ajax.reload();
    });

    $(document).on('click', '.set_active', function (event) {

        var _this = $(this);
        var user_id = _this.data('id');
        event.preventDefault();
        $.ajax({
            url: baseURL + '/users/user-activation',
            type: 'PUT',
            dataType: 'json',
            data: {'_token': csrf_token, 'user_id': user_id},
            success: function (data) {

                if (data.status) {
                    $('.alert').hide();
                    toastr['success'](data.message, '');
                    if ($("#users_tbl").length)
                        users_tbl.api().ajax.reload();
                    if ($("#service_providers_tbl").length)
                        service_providers_tbl.api().ajax.reload();
                    if ($("#drivers_merchant_tbl").length)
                        drivers_merchant_tbl.api().ajax.reload();
                    if ($("#drivers_tbl").length)
                        drivers_tbl.api().ajax.reload();
                    if ($("#merchants_tbl").length)
                        merchants_tbl.api().ajax.reload();
                    if ($("#user-det-tbl").length || $("#driver-det-tbl").length || $("#merchant-det-tbl").length) {
                        if (data.items.is_active) {
                            _this.removeClass('green').addClass('red');
                            _this.attr('title', 'Suspend');
                            _this.find('i').removeClass('fa-check').addClass('fa-power-off');

                        } else {
                            _this.removeClass('red').addClass('green');
                            _this.attr('title', 'Activate');
                            _this.find('i').removeClass('fa-power-off').addClass('fa-check');


                        }
                    }

                } else {
                    toastr['error'](data.message);
                }

            }, error: function (xhr) {

                toastr.error('You do not have permissions')

            }
        });

    });
    $(document).on('change', '.status_', function (event) {

        var _this = $(this);
        var user_id = _this.data('id');
        event.preventDefault();
        $.ajax({
            url: baseURL + '/users/user-activation',
            type: 'PUT',
            dataType: 'json',
            data: {'_token': csrf_token, 'user_id': user_id},
            success: function (data) {

                if (data.status) {
                    $('.alert').hide();
                    toastr['success'](data.message, '');
                    users_tbl.api().ajax.reload();

                } else {
                    toastr['error'](data.message);
                }

            },
            error: function (xhr) {

                toastr['error']('You do not have permissions');
            }
        });

    });
    $(document).on('change', '.is_email_verified', function (event) {

        var _this = $(this);
        var user_id = _this.data('id');
        event.preventDefault();
        $.ajax({
            url: baseURL + '/user/verify-email',
            type: 'PUT',
            dataType: 'json',
            data: {'_token': csrf_token, 'user_id': user_id},
            success: function (data) {

                if (data.status) {
                    $('.alert').hide();
                    toastr['success'](data.message, '');
                    users_tbl.api().ajax.reload();

                } else {
                    toastr['error'](data.message);
                }

            }
        });

    });
    $(document).on('click', '.add-driver-mdl', function (event) {
        event.preventDefault();
        $('#addDriver').modal('show');
    });
    $(document).on('click', '.user-det', function (event) {
        event.preventDefault();

        var _this = $(this);
        var action = _this.attr('href');
        $.ajax({
            url: action,
            type: 'GET',
            dataType: 'json',
            data: {'_token': csrf_token},
            success: function (data) {

                if (data === null) return;

                myMap(data.address, data.latitude, data.longitude);

                $('#userDet').modal('show');


            }
        });

    });
    $(document).on('click', '#merchant-det', function (event) {
        event.preventDefault();

        var _this = $(this);
        var action = _this.attr('href');
        $.ajax({
            url: action,
            type: 'GET',
            dataType: 'json',
            data: {'_token': csrf_token},
            success: function (data) {

                if (data === null) return;
                initialize(data.address, data.latitude, data.longitude);
                $('#edit-merchant').modal('show');
                $('#edit-merchant').find('#address').val(data.address);
                $('#edit-merchant').find('#latitude').val(data.latitude);
                $('#edit-merchant').find('#longitude').val(data.longitude);

            }
        });

    });
    $(document).on('change', '#manufacturer_id', function (event) {
        event.preventDefault();

        var _this = $(this);
        var manufacturer_id = $(this).val();
        var action = _this.attr('href');
        $.ajax({
            url: baseURL + '/car-types/' + manufacturer_id,
            type: 'GET',
            dataType: 'json',
            data: {'_token': csrf_token},
            success: function (data) {

                var row = '';
                $.each(data.items, function (i, v) {

                    row += '<option value="' + v.id + '">' + v.title + '</option>'
                });

                $('#car_type_id').html(row);
            }
        });

    });

    $(document).on('click', '.add-driver-mdl', function (e) {
        e.preventDefault();
        $("#wait_msg,#overlay").show();
        var action = $(this).attr('href');

        $.ajax({
            url: action,
            type: 'GET',
            success: function (data) {
                $("#wait_msg,#overlay").hide();

                $('#results-modals').html(data);
                $('#add-driver').modal('show', {backdrop: 'static', keyboard: false});
            }, error: function (xhr) {

            }
        });
    });
    $(document).on('click', '.edit-driver-info-mdl', function (e) {
        e.preventDefault();
        $("#wait_msg,#overlay").show();
        var action = $(this).attr('href');

        $.ajax({
            url: action,
            type: 'GET',
            success: function (data) {
                $("#wait_msg,#overlay").hide();

                $('#results-modals').html(data);
                $('#editDriver').modal('show', {backdrop: 'static', keyboard: false});

                // $('#manufacturer_id').change();

            }, error: function (xhr) {

            }
        });
    });
    $(document).on('click', '.add-service-provider-mdl', function (e) {
        e.preventDefault();
        $("#wait_msg,#overlay").show();
        var action = $(this).attr('href');

        $.ajax({
            url: action,
            type: 'GET',
            success: function (data) {
                $("#wait_msg,#overlay").hide();

                $('#results-modals').html(data);
                $('#add-service-provider').modal('show', {backdrop: 'static', keyboard: false});
            }, error: function (xhr) {

            }
        });
    });
    $(document).on('click', '.add-merchant-mdl', function (e) {
        e.preventDefault();
        $("#wait_msg,#overlay").show();
        var action = $(this).attr('href');

        $.ajax({
            url: action,
            type: 'GET',
            success: function (data) {
                $("#wait_msg,#overlay").hide();

                $('#results-modals').html(data);
                $('#add-merchant').modal('show', {backdrop: 'static', keyboard: false});
            }, error: function (xhr) {

            }
        });
    });

    $(document).on('click', '.edit-merchant-mdl', function (e) {
        $("#wait_msg,#overlay").show();
        e.preventDefault();
        var action = $(this).attr('href');
        $.ajax({
            url: action,
            type: 'GET',
            success: function (data) {
                $("#wait_msg,#overlay").hide();

                $('#results-modals').html(data);
                $('#edit-merchant').modal('show', {backdrop: 'static', keyboard: false});
            }, error: function (xhr) {

            }
        });
    });

    $(document).on('submit', '#formAddMerchant,#formEditMerchant,#editProfile,#formAddDriver,#formEditDriver,#formAddServiceProvider,#formEditServiceProvider,#save_location', function (event) {
        console.log('editProfile');
        var _this = $(this);
        // var loader = '<i class="fa fa-spinner fa-spin"></i>';
        _this.find('.btn.save i').addClass('fa-spinner fa-spin');
        event.preventDefault(); // Totally stop stuff happening
        // START A LOADING SPINNER HERE
        // Create a formdata object and add the files

        var formData = new FormData($(this)[0]);

        var action = $(this).attr('action');
        var method = $(this).attr('method');

        $.ajax({
            url: action,
            type: method,
            data: formData,
            contentType: false,
            processData: false,
            success: function (data) {
                if (data.status) {
                    
                    $('.alert').hide();
                    if (event.target.id == 'save_location') {
                        $('#edit-merchant').modal('hide');
                        toastr['success']('Your location was saved successfully');

                        return;
                    }

                    if (event.target.id == 'formAddMerchant' || event.target.id == 'formEditMerchant') {
                        merchants_tbl.api().ajax.reload();
                        $('#add-merchant').modal('hide');
                        $('#edit-merchant').modal('hide');
                    }
                    if (event.target.id == 'formAddDriver' || event.target.id == 'formEditDriver') {
                        if ($("#drivers_tbl").length)
                            drivers_tbl.api().ajax.reload();
                        $('#add-driver').modal('hide');
                        $('#edit-driver').modal('hide');
                    }
                    if (event.target.id == 'formAddServiceProvider' || event.target.id == 'formEditServiceProvider') {
                        service_providers_tbl.api().ajax.reload();
                        $('#add-service-provider').modal('hide');
                        $('#edit-service-provider').modal('hide');
                    }
                    toastr['success'](data.message, '');

                } else {
                    var $errors = '<strong>' + data.message + '</strong>';
                    $errors += '<ul>';
                    $.each(data.errors, function (i, v) {
                        $errors += '<li>' + v.message + '</li>';
                    });
                    $errors += '</ul>';
                    $('.alert').show();
                    $('.alert').html($errors);
                    toastr['error'](data.message, '');

                }
                _this.find('.btn.save i').removeClass('fa-spinner fa-spin');
                // _this.find('.fa-spin').hide();

            }
        });
    });

});
