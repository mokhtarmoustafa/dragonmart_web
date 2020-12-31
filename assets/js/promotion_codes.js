$(document).ready(function () {

    if ($("#promotion_code_tbl").length) {

        var promotion_code_tbl = $("#promotion_code_tbl");
        promotion_code_tbl.on('preXhr.dt', function (e, settings, data) {

        }).dataTable({
            "processing": true,
            "serverSide": true,

            "ajax": {
                url: baseURL + "/promotion-codes-data"
                , "dataSrc": function (json) {
                    //Make your callback here.
                    if (json.status != undefined && !json.status) {
                        $('#promotion_code_tbl_processing').hide();
                        bootbox.alert(json.message);
                        //
                    } else
                        return json.data;
                }

            },



            columns: [
                { data: 'DT_RowIndex', name: 'DT_RowIndex' },
                { data: 'code', name: 'code' },
                { data: 'description', name: 'description' },
                { data: 'status', name: 'status' },
                { data: 'created_by', name: 'created_by' },
                { data: 'action', name: 'action' }
            ],
            "fnDrawCallback": function () {
                //Initialize checkbos for enable/disable user
                $(".make-switch").bootstrapSwitch({ size: "mini", onColor: "success", offColor: "danger" });
            },

            language: {
                "sProcessing": "<img src='" + baseAssets + "/apps/img/preloader_.gif'>",
            },
            // "searching": false,
            // "ordering": false,

            bStateSave: !0,
            lengthMenu: [[5, 10, 15, 20, -1], [5, 10, 15, 20, "All"]],
            pageLength: 10,
            pagingType: "bootstrap_full_number",
            columnDefs: [{ orderable: !1, targets: [0] }, { searchable: !1, targets: [0] }, { className: "dt-right" }],
            order: [[2, "asc"]]
        });

        // Grab the datatables input box and alter how it is bound to events
        $(".dataTables_filter input")
            .unbind() // Unbind previous default bindings
            .bind("input", function (e) { // Bind our desired behavior
                // If the length is 3 or more characters, or the user pressed ENTER, search
                if (this.value.length >= 3 || e.keyCode == 13) {
                    // Call the API search function
                    adv_tbl.api().search(this.value).ajax.reload();

                }
                // Ensure we clear the search if they backspace far enough
                if (this.value == "") {
                    adv_tbl.api().search("").ajax.reload();
                }
            });
    }

    $('#promotion_code_tbl').on('switchChange.bootstrapSwitch', '.status', function (event, state) {
        // ... skipped ...
        var promotion_code_id = $(this).data('id');

        $.ajax({
            url: baseURL + '/promotion_codes/approve',
            type: 'PUT',
            dataType: 'json',
            data: { '_token': csrf_token, 'promotion_code_id': promotion_code_id },
            success: function (data) {

                if (data.status) {
                    toastr['success'](data.message, '');
                    talents_dashboard_tbl.api().ajax.reload();

                } else {
                    toastr['error'](data.message);
                }

            }
        });

    });

    $(document).on('click', '.delete', function (event) {

        var _this = $(this);
        var action = _this.attr('href');
        event.preventDefault();

        bootbox.dialog({
            message: "Are you sure to delete? <span class='label label-danger'> Can not return back...</span>",
            title: "Confirm deletion !",
            buttons: {

                main: {
                    label: 'Sure <i class="fa fa-check"></i> ',
                    className: "btn-primary",
                    callback: function () {
                        //do something else
                        $.ajax({
                            url: action,
                            type: 'DELETE',
                            dataType: 'json',
                            data: { _token: csrf_token },
                            success: function (data) {

                                if (data.status) {
                                    toastr['success'](data.message, '');
                                    adv_tbl.api().ajax.reload();
                                } else {
                                    toastr['error'](data.message);
                                }
                            }
                        });
                    }
                }, danger: {
                    label: 'Close <i class="fa fa-remove"></i>',
                    className: "btn-danger",
                    callback: function () {
                        //do something
                        bootbox.hideAll()
                    }
                }
            }
        });


    });

    $(document).on("click", ".filter-submit", function () {
        // if ($(this).val().length > 3)
        adv_tbl.api().ajax.reload();
    });
    $(document).on('click', '.filter-cancel', function () {

        $(".select2").val('').trigger('change');
        $(this).closest('tr').find('input,select').val('');
        // $('#is_admin_confirm,.status').val('').trigger('change');
        adv_tbl.api().ajax.reload();
    });

    //add-send-notification-mdl
    $(document).on('click', '.add-send-notification-mdl', function (e) {
        e.preventDefault();
        $('#general-notification').modal('show', { backdrop: 'static', keyboard: false });
    });

    $(document).on('submit', '#generalNotificationFrm', function (event) {

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
                } else {
                    var $errors = '<strong>' + data.message + '</strong>';
                    $errors += '<ul>';
                    $.each(data.errors, function (i, v) {
                        $errors += '<li>' + v.message + '</li>';
                    });
                    $errors += '</ul>';
                    $('.alert').show();
                    $('.alert').html($errors);
                }
                _this.find('.btn.save i').removeClass('fa-spinner fa-spin');
                // _this.find('.fa-spin').hide();

            }
        });
    });
    $(document).on('submit', 'form', function (event) {

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
                console.log('data');
                console.log(formData);
                console.log(data);
                if (data.status) {
                    $('.alert').hide();

                    promotion_code_tbl.api().ajax.reload();
                    toastr['success'](data.message, '');
                    $('#add-promotion-code').modal('hide');
                    $('#edit-ad').modal('hide');

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

    $(document).on('click', '.add-promotion-mdla', function (e) {
        e.preventDefault();
        $("#wait_msg,#overlay").show();
        var action = $(this).attr('href');

        $.ajax({
            url: action,
            type: 'GET',
            success: function (data) {
                $("#wait_msg,#overlay").hide();

                // $('#results-modals').html(data);
                $('#add_promotion_code').modal('show', { backdrop: 'static', keyboard: false });
            }, error: function (xhr) {
                console.log('Error');
            }
        });
    });
    $(document).on('click', '.edit-promotion-mdla', function (e) {
        e.preventDefault();
        $("#wait_msg,#overlay").show();
        var action = $(this).attr('href');
        console.log('action');
        console.log(action);
        $.ajax({
            url: action,
            type: 'GET',
            success: function (data) {
                
                $("#wait_msg,#overlay").hide();

                // $('#results-modals').html(data);
                $('#edit-promotion-codes').modal('show', { backdrop: 'static', keyboard: false });
            }, error: function (xhr) {

            }
        });
    });

});
