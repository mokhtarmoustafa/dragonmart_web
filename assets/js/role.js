$(document).ready(function () {

    if ($("#roles_tbl").length) {

        var roles_tbl = $("#roles_tbl");
        roles_tbl.on('preXhr.dt', function (e, settings, data) {
            data.name = $('#name').val();
            data.display_name = $('#display_name').val();
        }).dataTable({
            "processing": true,
            "serverSide": true,

            "ajax": {
                url: baseURL + "/role/role-data"
                , "dataSrc": function (json) {
                    //Make your callback here.
                    if (json.status !== undefined && !json.status) {
                        $('#roles_tbl_processing').hide();
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
        var role_name = _this.closest('tr').find("td:eq(1)").text();
        bootbox.confirm({
            message: "Are you sure of the deletion role (" + role_name + ")?",
            buttons: {
                confirm: {
                    label: '<i class="fa fa-check"></i> Sure',
                    className: 'btn-success'
                },
                cancel: {
                    label: '<i class="fa fa-remove"></i> Cancel',
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
                                roles_tbl.api().ajax.reload();

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

    $(document).on('click', '.add-role-mdl', function (e) {
        e.preventDefault();
        $("#wait_msg,#overlay").show();
        var action = $(this).attr('href');

        $.ajax({
            url: action,
            type: 'GET',
            success: function (data) {
                $("#wait_msg,#overlay").hide();

                $('#results-modals').html(data);
                $('#add-role').modal('show', {backdrop: 'static', keyboard: false});
            }, error: function (xhr) {

            }
        });
    });

    $(document).on('click', '.edit-role-mdl', function (e) {
        $("#wait_msg,#overlay").show();
        e.preventDefault();
        var action = $(this).attr('href');
        $.ajax({
            url: action,
            type: 'GET',
            success: function (data) {
                $("#wait_msg,#overlay").hide();

                $('#results-modals').html(data);
                $('#edit-role').modal('show', {backdrop: 'static', keyboard: false});
            }, error: function (xhr) {

            }
        });
    });
    $(document).on('submit', '#formAdd,#formEdit', function (event) {

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
                    roles_tbl.api().ajax.reload();

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
                    // toastr['error'](data.message);
                }
                _this.find('.btn.save i').removeClass('fa-spinner fa-spin');
                // _this.find('.fa-spin').hide();

            }
        });
    });

    $(document).on("click", ".filter-submit", function () {
//                if ($(this).val().length > 3)
        roles_tbl.api().ajax.reload();
    });
    $(document).on('click', '.filter-cancel', function () {

        // $(this).closest('tr').find('#name').select('val','');
        $(".select2").val('').trigger('change');

        $(this).closest('tr').find('input').val('');
        // $('#is_admin_confirm,.status').val('').trigger('change');
        roles_tbl.api().ajax.reload();
    });

});