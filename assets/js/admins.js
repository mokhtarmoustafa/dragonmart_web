$(document).ready(function () {

    if ($("#admins_tbl").length) {

        var admins_tbl = $("#admins_tbl");
        admins_tbl.on('preXhr.dt', function (e, settings, data) {
            // data.name = $('#name').val();
            // data.username = $('#username').val();
            // data.email = $('#email').val();
            // data.status = $('#status').val();
            // data.mobile = $('#mobile').val();
        }).dataTable({
            "processing": true,
            "serverSide": true,
            "ajax": {
                url: baseURL + "/admins-data",
                "dataSrc": function (json) {
                    //Make your callback here.
                    if (json.status !== undefined && !json.status) {
                        $('#admins_tbl_processing').hide();
                        bootbox.alert(json.message);
                        //
                    } else
                        return json.data;
                }
            },

            columns: [
                {data: 'DT_RowIndex', name: 'DT_RowIndex'},
                // {data: 'logo', name: 'logo'},
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

    $(document).on('click', '.set_active', function (event) {

        var _this = $(this);
        var user_id = _this.data('id');
        event.preventDefault();
        $.ajax({
            url: baseURL + '/users/admin-activation/' + user_id,
            type: 'PUT',
            dataType: 'json',
            data: {'_token': csrf_token},
            success: function (data) {

                if (data.status) {
                    $('.alert').hide();
                    toastr['success'](data.message, '');
                    admins_tbl.api().ajax.reload();


                } else {
                    toastr['error'](data.message);
                }

            }, error: function (xhr) {

                toastr.error('You do not have permissions')

            }
        });

    });


    $(document).on("click", ".filter-submit", function () {
        admins_tbl.api().ajax.reload();
    });
    $(document).on('click', '.filter-cancel', function () {
        $(".select2").val('').trigger('change');
        $(this).closest('tr').find('input').val('');
        admins_tbl.api().ajax.reload();
    });

    $(document).on('click', '.admin-det', function (e) {
        e.preventDefault();
        $("#wait_msg,#overlay").show();
        var action = $(this).attr('href');

        $.ajax({
            url: action,
            type: 'GET',
            success: function (data) {
                $("#wait_msg,#overlay").hide();

                $('#results-modals').html(data);
                $('#admin_det').modal('show', {backdrop: 'static', keyboard: false});
            }, error: function (xhr) {

            }
        });
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

                                if ($("#admins_tbl").length)
                                    admins_tbl.api().ajax.reload();

                            } else {
                                toastr['error'](data.message);
                            }

                        }
                    });
                }
            }
        });


    });

    $(document).on('click', '.add-admin-mdl', function (e) {
        e.preventDefault();
        $("#wait_msg,#overlay").show();
        var action = $(this).attr('href');

        $.ajax({
            url: action,
            type: 'GET',
            success: function (data) {
                $("#wait_msg,#overlay").hide();

                $('#results-modals').html(data);
                $('#add-admin').modal('show', {backdrop: 'static', keyboard: false});
            }, error: function (xhr) {

            }
        });
    });

    $(document).on('click', '.edit-admin-mdl', function (e) {
        $("#wait_msg,#overlay").show();
        e.preventDefault();
        var action = $(this).attr('href');
        $.ajax({
            url: action,
            type: 'GET',
            success: function (data) {
                $("#wait_msg,#overlay").hide();

                $('#results-modals').html(data);
                $('#edit-admin').modal('show', {backdrop: 'static', keyboard: false});
            }, error: function (xhr) {

            }
        });
    });


    $(document).on('submit', '#formAdd,#formEdit,#formProfileEdit', function (event) {

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
                    if (event.target.id != 'formProfileEdit')
                        admins_tbl.api().ajax.reload();

                } else {
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

});
