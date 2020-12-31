$(document).ready(function () {

    if ($("#category_tbl").length) {

        // var constant = $('#constant').val();
        var category_tbl = $("#category_tbl");
        category_tbl.on('preXhr.dt', function (e, settings, data) {

        }).dataTable({
            "processing": true,
            "serverSide": true,

            "ajax": {
                url: baseURL + "/categories-data"
                , "dataSrc": function (json) {
                    //Make your callback here.
                    if (json.status != undefined && !json.status) {
                        $('#category_tbl_processing').hide();
                        bootbox.alert(json.message);
                        //
                    } else
                        return json.data;
                }
            },

            columns: [
                { data: 'DT_RowIndex', name: 'DT_RowIndex' },
                { data: 'icon', name: 'icon' },
                { data: 'name', name: 'name' },
                { data: 'name_ar', name: 'name_ar' },
                { data: 'action', name: 'action' }
            ],

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
        $("#category_tbl_filter input")
            .unbind() // Unbind previous default bindings
            .bind("input", function (e) { // Bind our desired behavior
                // If the length is 3 or more characters, or the user pressed ENTER, search
                if (this.value.length >= 3 || e.keyCode == 13) {
                    // Call the API search function
                    category_tbl.api().search(this.value).ajax.reload();

                }
                // Ensure we clear the search if they backspace far enough
                if (this.value == "") {
                    category_tbl.api().search("").ajax.reload();
                }
            });
    }
    if ($("#service-category_tbl").length) {

        // var constant = $('#constant').val();
        var service_category_tbl = $("#service-category_tbl");
        service_category_tbl.on('preXhr.dt', function (e, settings, data) {

        }).dataTable({
            "processing": true,
            "serverSide": true,

            "ajax": {
                url: baseURL + "/services-categories-data"
                , "dataSrc": function (json) {
                    //Make your callback here.
                    if (json.status != undefined && !json.status) {
                        $('#service-category_tbl_processing').hide();
                        bootbox.alert(json.message);
                        //
                    } else
                        return json.data;
                }
            },

            columns: [
                { data: 'DT_RowIndex', name: 'DT_RowIndex' },
                { data: 'icon', name: 'icon' },
                { data: 'name', name: 'name' },
                { data: 'name_ar', name: 'name_ar' },
                { data: 'action', name: 'action' }
            ],

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
        $("#service-category_tbl_filter input")
            .unbind() // Unbind previous default bindings
            .bind("input", function (e) { // Bind our desired behavior
                // If the length is 3 or more characters, or the user pressed ENTER, search
                if (this.value.length >= 3 || e.keyCode == 13) {
                    // Call the API search function
                    service_category_tbl.api().search(this.value).ajax.reload();

                }
                // Ensure we clear the search if they backspace far enough
                if (this.value == "") {
                    service_category_tbl.api().search("").ajax.reload();
                }
            });
    }

    $(document).on('click', '.add-category-mdl', function (e) {
        e.preventDefault();

        $("#wait_msg,#overlay").show();
        var action = $(this).attr('href');

        $.ajax({
            url: action,
            type: 'GET',
            success: function (data) {
                console.log("Asda");

                $("#wait_msg,#overlay").hide();

                $('#results-modals').html(data);
                $('#add-category').modal('show', { backdrop: 'static', keyboard: false });
            }, error: function (xhr) {

            }
        });
    });
    $(document).on('click', '.edit-category-mdl', function (e) {
        e.preventDefault();
        $("#wait_msg,#overlay").show();
        var action = $(this).attr('href');

        $.ajax({
            url: action,
            type: 'GET',
            success: function (data) {
                $("#wait_msg,#overlay").hide();

                $('#results-modals').html(data);
                $('#edit-category').modal('show', { backdrop: 'static', keyboard: false });
            }, error: function (xhr) {

            }
        });
    });
    $(document).on('click', '.edit', function (event) {

        var _this = $(this);
        var action = _this.attr('href');
        event.preventDefault();


        $.ajax({
            url: action,
            type: 'GET',
            dataType: 'json',
            success: function (data) {

                if (data.status) {
                    $('#category_name').val(data.items.name);
                    $('#save_category_frm').attr('action', action);

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
        // var target = $(event.target);
        var constant_name = _this.closest('tr').find("td:eq(2)").text();
        bootbox.dialog({
            message: "Are you sure to delete (" + constant_name + ")",
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
                                    // if (target.hasClass('service-delete'))
                                    // else
                                    category_tbl.api().ajax.reload();
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

    $(document).on('click', '.restore', function (event) {

        var _this = $(this);
        var action = _this.attr('href');
        event.preventDefault();
        // var target = $(event.target);
        var constant_name = _this.closest('tr').find("td:eq(2)").text();
        bootbox.dialog({
            message: "Are you sure to restore (" + constant_name + ")",
            title: "Confirm restoring !",
            buttons: {

                main: {
                    label: 'Sure <i class="fa fa-check"></i> ',
                    className: "btn-primary",
                    callback: function () {
                        //do something else
                        $.ajax({
                            url: action,
                            type: 'GET',
                            dataType: 'json',
                            data: { _token: csrf_token },
                            success: function (data) {

                                if (data.status) {
                                    toastr['success'](data.message, '');
                                    // if (target.hasClass('service-delete'))
                                    // else
                                    category_tbl.api().ajax.reload();
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

    $(document).on('click', '.service-delete', function (event) {

        var _this = $(this);
        var action = _this.attr('href');
        event.preventDefault();
        // var target = $(event.target);
        var constant_name = _this.closest('tr').find("td:eq(2)").text();
        bootbox.dialog({
            message: "Are you sure to delete (" + constant_name + ")? <span class='label label-danger'> Can not return back...</span>",
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
                                    // if (target.hasClass('service-delete'))
                                    service_category_tbl.api().ajax.reload();
                                    // else
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
        //                if ($(this).val().length > 3)
        category_tbl.api().ajax.reload();
    });
    $(document).on('click', '.filter-cancel', function () {

        $(".select2").val('').trigger('change');
        $(this).closest('tr').find('input,select').val('');
        // $('#is_admin_confirm,.status').val('').trigger('change');
        category_tbl.api().ajax.reload();
    });

    $(document).on('submit', '#save_category_frm,#save_service_category_frm', function (event) {

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

                    if (event.target.id == 'save_category_frm') {
                        $('#save_category_frm').attr('action', baseURL + '/settings/category');
                        category_tbl.api().ajax.reload();
                    } else {
                        $('#save_service_category_frm').attr('action', baseURL + '/settings/service-category');
                        service_category_tbl.api().ajax.reload();
                    }
                    $('#icon').val('');
                    $('#category_name').val('');

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

});
