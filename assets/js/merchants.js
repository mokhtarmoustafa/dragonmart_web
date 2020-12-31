$(document).ready(function () {
    var merchant_id = $('#merchant_id').val();
    if ($("#merchants_tbl").length) {

        var merchants_tbl = $("#merchants_tbl");
        merchants_tbl.on('preXhr.dt', function (e, settings, data) {
            data.name = $('#name').val();
            data.username = $('#username').val();
            data.email = $('#email').val();
            data.status = $('#status').val();
            data.mobile = $('#mobile').val();
        }).dataTable({
            "processing": true,
            "serverSide": true,
            "ajax": {
                url: baseURL + "/merchant-data",
                "dataSrc": function (json) {
                    //Make your callback here.
                    if (json.status !== undefined && !json.status) {
                        $('#merchants_tbl_processing').hide();
                        bootbox.alert(json.message);
                        //
                    } else
                        return json.data;
                }
            },

            columns: [
                {data: 'DT_RowIndex', name: 'DT_RowIndex'},
                {data: 'logo', name: 'logo'},
                {data: 'name', name: 'name'},
                {data: 'username', name: 'username'},
                {data: 'email', name: 'email'},
                {data: 'mobile', name: 'mobile'},
                {data: 'status', name: 'status'},
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
            order: [[1, "asc"]]
        });
    }
    if ($("#merchant-shipments-tbl").length) {

        var merchant_shipments_tbl = $("#merchant-shipments-tbl");
        merchant_shipments_tbl.on('preXhr.dt', function (e, settings, data) {
        }).dataTable({
            "processing": true,
            "serverSide": true,
            "ajax": {
                url: baseURL + "/merchant-shipment-data/" + merchant_id,
                "dataSrc": function (json) {
                    //Make your callback here.
                    if (json.status !== undefined && !json.status) {
                        $('#merchant-shipments-tbl_processing').hide();
                        bootbox.alert(json.message);
                        //
                    } else
                        return json.data;
                }
            },

            columns: [
                {data: 'DT_RowIndex', name: 'DT_RowIndex'},
                {data: 'from_to', name: 'from_to'},
                {data: 'price', name: 'price'},
                {data: 'min_order_amount', name: 'min_order_amount'}
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
            order: [[1, "asc"]]
        });
    }
    if ($("#merchant-categories-tbl").length) {

        var merchant_categories_tbl = $("#merchant-categories-tbl");
        merchant_categories_tbl.on('preXhr.dt', function (e, settings, data) {
        }).dataTable({
            "processing": true,
            "serverSide": true,
            "ajax": {
                url: baseURL + "/merchant-category-data/" + merchant_id,
                "dataSrc": function (json) {
                    //Make your callback here.
                    if (json.status !== undefined && !json.status) {
                        $('#merchant-categories-tbl_processing').hide();
                        bootbox.alert(json.message);
                        //
                    } else
                        return json.data;
                }
            },

            columns: [
                {data: 'DT_RowIndex', name: 'DT_RowIndex'},
                {data: 'category.name', name: 'category.name'},
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
            order: [[1, "asc"]]
        });
    }

    $(document).on("click", ".filter-submit", function () {
        merchants_tbl.api().ajax.reload();
    });
    $(document).on('click', '.filter-cancel', function () {
        $(".select2").val('').trigger('change');
        $(this).closest('tr').find('input').val('');
        merchants_tbl.api().ajax.reload();
    });
    $(document).on('click', '.delete', function (event) {

        var _this = $(this);
        event.preventDefault();

        var action = $(this).attr('href');
        var admin_name = _this.closest('tr').find("td:eq(2)").text();
        bootbox.confirm({
            message: "Are you sure of the deletion admin name (" + admin_name + ")?",
            buttons: {
                confirm: {
                    label: '<i class="fa fa-check"></i> Sure',
                    className: 'btn-success'
                },
                cancel: {
                    label: '<i class="fa fa-remove"></i> Close',
                    className: 'btn-danger'
                }
            },
            callback: function (result) {
                if (result) {
                    $.ajax({
                        url: action,
                        type: 'DELETE',
                        dataType: 'json',
                        data: {'_token': csrf_token},
                        success: function (data) {

                            if (data.status) {
                                $('.alert').hide();
                                toastr['success'](data.message, '');
                                merchants_tbl.api().ajax.reload();

                            } else {
                                toastr['error'](data.message);
                            }

                        }
                    });
                }
            }
        });


    });
    $(document).on('click', '.delete-merchant-category', function (event) {

        var _this = $(this);
        event.preventDefault();

        var action = $(this).attr('href');
        var title = _this.closest('tr').find("td:eq(1)").text();
        bootbox.confirm({
            message: "Are you sure of the deletion (" + title + ")?",
            buttons: {
                confirm: {
                    label: '<i class="fa fa-check"></i> Sure',
                    className: 'btn-success'
                },
                cancel: {
                    label: '<i class="fa fa-remove"></i> Close',
                    className: 'btn-danger'
                }
            },
            callback: function (result) {
                if (result) {
                    $.ajax({
                        url: action,
                        type: 'DELETE',
                        dataType: 'json',
                        data: {'_token': csrf_token},
                        success: function (data) {

                            if (data.status) {
                                $('.alert').hide();
                                toastr['success'](data.message, '');
                                merchant_categories_tbl.api().ajax.reload();

                            } else {
                                toastr['error'](data.message);
                            }

                        }
                    });
                }
            }
        });


    });
    // $(document).on('click', '.edit-merchant-category-mdl', function (e) {
    //     $("#wait_msg,#overlay").show();
    //     e.preventDefault();
    //     var action = $(this).attr('href');
    //     $.ajax({
    //         url: action,
    //         type: 'GET',
    //         success: function (data) {
    //             $("#wait_msg,#overlay").hide();
    //
    //             $('#results-modals').html(data);
    //             $('#edit-merchant-category').modal('show', {backdrop: 'static', keyboard: false});
    //         }, error: function (xhr) {
    //
    //         }
    //     });
    // });

    $(document).on('change', '.status', function (event) {

        var _this = $(this);
        var merchant_id = _this.data('id');
        event.preventDefault();
        $.ajax({
            url: baseURL + '/merchant-activation',
            type: 'PUT',
            dataType: 'json',
            data: {'_token': csrf_token, 'merchant_id': merchant_id},
            success: function (data) {

                if (data.status) {
                    $('.alert').hide();
                    toastr['success'](data.message, '');
                    merchants_tbl.api().ajax.reload();

                } else {
                    toastr['error'](data.message);
                }

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

    $(document).on('submit', '#formAdd,#formEdit,#addMerchantCategory', function (event) {

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
                    toastr['success'](data.message, '');
                    if (event.target.id == 'addMerchantCategory')
                        merchant_categories_tbl.api().ajax.reload();
                    else
                        merchants_tbl.api().ajax.reload();

                } else {

                    // else {
                    if (data.statusCode == 401) {
                        toastr['error'](data.message);
                        _this.find('.btn.save i').removeClass('fa-spinner fa-spin');
                        return;
                    }
                    // }
                    var $errors = '<strong>' + data.message + '</strong>';
                    $errors += '<ul>';
                    $.each(data.errors, function (i, v) {
                        $errors += '<li>' + v.message + '</li>';
                    });
                    $errors += '</ul>';
                    $('.alert').show();
                    $('.alert').html($errors);
                    // toastr['error'](data.message);
                }
                _this.find('.btn.save i').removeClass('fa-spinner fa-spin');
                // _this.find('.fa-spin').hide();

            }
        });
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
    // $(document).on('click', '.add-delivery-method', function (event) {
    //     event.preventDefault();
    //
    //     $.ajax({
    //         url: baseURL + '/add-delivery-method',
    //         type: 'POST',
    //         dataType: 'json',
    //         data: {
    //             _token: csrf_token,
    //             driver_type_id: $('#driver_type_id').val(),
    //             merchant_id: $('#merchant_id').val()
    //         },
    //         success: function (data) {
    //             toastr['success'](data.message, '');
    //         }
    //     });
    // });
    $(document).on('click', '.add-delivery-method', function (event) {
        event.preventDefault();

        $.ajax({
            url: baseURL + '/users/add-delivery-method',
            type: 'POST',
            dataType: 'json',
            data: {
                _token: csrf_token,
                driver_type_id: $('#driver_type_id').val(),
                merchant_id: $('#merchant_id').val()
            },
            success: function (data) {
                if (data.status) {
                    toastr['success'](data.message, '');

                    merchant_shipments_tbl.api().ajax.reload();
                } else {
                    toastr['error'](data.message, '');

                }
            }
        });
    });
});
