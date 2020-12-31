$(document).ready(function () {
    if ($("#permissions_tbl").length) {

        var permissions_tbl = $("#permissions_tbl");
        permissions_tbl.dataTable({
            "processing": true,
            "serverSide": true,
            "ajax": {
                url: baseURL + "/permission-data"
                ,"dataSrc": function (json) {
                    //Make your callback here.
                    if (json.status !== undefined && !json.status) {
                        $('#permissions_tbl_processing').hide();
                        bootbox.alert(json.message);
                        //
                    } else
                        return json.data;
                }
            },

            columns: [
                {data: 'DT_RowIndex', name: 'DT_RowIndex'},
                {data: 'name', name: 'name'},
                {data: 'display_name', name: 'display_name'},
                {data: 'parent_id', name: 'parent_id'},
                {data: 'controller_name', name: 'controller_name'},
                {data: 'function_name', name: 'function_name'},
                {data: 'icon', name: 'icon'},
                {data: 'type', name: 'type'},
                {data: 'is_sidebar', name: 'is_sidebar'},
                {data: 'action', name: 'action'}
            ],

            language: {
                "sProcessing": "<img src='" + baseAssets + "/apps/img/preloader.svg'>",
            },
            "searching": false,
            "ordering": false,

            bStateSave: !0,
            lengthMenu: [[5, 10, 15, 20, -1], [5, 10, 15, 20, "All"]],
            pageLength: 10,
            pagingType: "bootstrap_full_number",
            columnDefs: [{orderable: !1, targets: [0]}, {searchable: !1, targets: [0]}, {className: "dt-right"}],
            order: [[2, "asc"]]
        });
    }

    $(document).on('click', '.delete', function (event) {

        var _this = $(this);

        event.preventDefault();
        var action = $(this).attr('href');
        var permission_name = _this.closest('tr').find("td:eq(1)").text() + ' - ' + _this.closest('tr').find("td:eq(2)").text();
        bootbox.confirm({
            message: "Are you sure for deleting permission name:(" + permission_name + ")?",
            buttons: {
                confirm: {
                    label: 'Yes',
                    className: 'btn-success'
                },
                cancel: {
                    label: 'No',
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
                                permissions_tbl.api().ajax.reload();

                            }
                            else {
                                toastr['error'](data.message);
                            }

                        }
                    });
                }
            }
        });


    });

    $(document).on('submit', '#add-permission,#edit-permission', function (event) {
        // toastr['error']("Gnome & Growl type non-blocking notifications", "Toastr Notifications")
        var _this = $(this);
        var loader = '<i class="fa fa-spinner fa-spin"></i>';
        _this.find('.btn.save').prepend(loader);
        // event.stopPropagation(); // Stop stuff happening
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
            async: false,
            cache: false,
            contentType: false,
            processData: false,
            success: function (data) {

                if (data.status) {
                    $('.alert').hide();
                    toastr['success'](data.message, '');
                }
                else {
                    var $errors = '<strong>' + data.message + '</strong>';
                    $errors += '<ul>';
                    $.each(data.errors, function (i, v) {
                        $errors += '<li>' + v.message + '</li>';
                    });
                    $errors += '</ul>';
                    $('.alert').show();
                    $('.alert').html($errors);
                    toastr['error'](data.message);
                }
                _this.find('.btn.save i').remove();

            },
            error: function (jqXHR, textStatus, errorThrown) {

                data = jqXHR.responseJSON;
                var $errors = '<ul>';
                $.each(data.errors, function (i, v) {
                    $errors += '<li>' + v.message + '</li>';
                });
                $errors += '</ul>';
                $('.alert').show();
                $('.alert').html($errors);
                toastr['error'](data.message, '');
                _this.find('.btn.save i').remove();
            }
        });
    });
    $(document).on('click', '.is_sidebar', function () {

        var permission_id = $(this).data('id');
        $.ajax({
            url: baseURL + '/permission-sidebar',
            type: 'POST',
            dataType: 'json',
            data: {'permission_id': permission_id, '_token': csrf_token},
            success: function (data) {

                if (data.status)
                    toastr['success'](data.message, '');
                else
                    toastr['error'](data.message, '');

            }
        })
    });


    $(".all_parent_public").click(function () {
        // $('.parent_chk').click();
        $('input[type="checkbox"]').prop('checked', $(this).prop('checked'));
    });
    $(".parent_chk").click(function () {
        $(this).closest('.panel').find('.panel-body .child_chk').prop('checked', $(this).prop('checked'));
    });
    $(".allcheck").click(function () {

        var parent_val = $(this).val();
        $('.parent_chk_p' + parent_val).prop('checked', $(this).prop('checked'));
        $('.parent_chk_p' + parent_val).closest('.panel').find('.panel-body .child_chk').prop('checked', $(this).prop('checked'));
    });


    var role_id = $('#role_id').val();
    $.ajax({
        url: baseURL + '/role/permission-role/' + role_id,
        type: 'GET',
        dataType: 'json',
        success: function (response) {

            $('.panel-body div').each(function (i, v) {
                if ($.inArray($(this).attr('data-id'), response.items) != -1) {


                    $(this).find('.child_chk').prop('checked', 'checked');
                    $(this).find('.child_chk').closest('.panel').find('.parent_chk').prop('checked', 'checked');
                }
            });
        }, error: function (xhr) {
            if (xhr.status === 403) {
                toastr["error"]('error');

            }
        }
    });

    $('#add-role-permissions').on('click', function (event) {
        event.preventDefault();
        var _this = $(this)
        var text = $(this).text();
        _this.html('<span class="fa fa-spinner fa-spin"></span>');


        var checkedItems = $('input[name=perms]:checked').map(function () {
            return $(this).val();
        }).get();


        $.ajax({
            url: baseURL + '/role/add-permission-role/' + role_id,
            type: 'POST',
            dataType: 'json',
            data: {_token: csrf_token, permissions_id: checkedItems},
            success: function (response) {
                if (response.status) {
                    toastr["success"](response.message);

                } else {
                    toastr["error"](response.message);
                }

                _this.html(text);
            }, error: function (xhr) {
                if (xhr.status === 403) {
                    toastr["error"]('error');

                }
            }
        });

    });
});
