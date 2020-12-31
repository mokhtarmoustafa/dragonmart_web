$(document).ready(function () {

    if ($("#products_tbl").length) {

        var products_tbl = $("#products_tbl");
        products_tbl.on('preXhr.dt', function (e, settings, data) {
            //.name,.title,.server,.searcher.,.status
            // data.name = $('.name').val();
            data.merchant_id = $('#merchant_id').val();
            data.name = $('#product_name').val();
            data.category_id = $('#category_id').val();
            data.is_sponsor = $('#is_sponsor').val();
            data.is_offer = $('#is_offer').val();
        }).dataTable({
            "processing": true,
            "serverSide": true,

            "ajax": {
                url: baseURL + "/store/products-data"
                , "dataSrc": function (json) {
                    //Make your callback here.
                    if (json.status != undefined && !json.status) {
                        $('#products_tbl_processing').hide();
                        bootbox.alert(json.message);
                        //
                    } else
                        return json.data;
                }
            },

            columns: [
                {data: 'DT_RowIndex', name: 'DT_RowIndex'},
                {data: 'name', name: 'name'},
                {data: 'price', name: 'price'},
                {data: 'available_quantity', name: 'available_quantity'},
                {data: 'category_name', name: 'category_name'},
                {data: 'is_sponsor', name: 'is_sponsor'},
                {data: 'is_offer', name: 'is_offer'},
                {data: 'offer_percentage', name: 'offer_percentage'},
                // {data: 'description', name: 'description'},
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
            order: [[2, "asc"]]
        });
    }

    var index = 0;
    $(document).on('change', '#custom_id', function () {

        if ($(this).val() == 3) {
            $('.custom_color').show();
            $('.custom_title').hide();
        } else {
            $('.custom_color').hide();
            $('.custom_title').show();
        }
    });
    $(document).on('click', '.add-custom', function () {

        // $('.no-custom').remove();
        // var tr = $(this).closest('tr');
        var description = $('#customizations #description').val();
        var price = $('#customizations #price').val();
        var custom = $('#customizations').find('#custom_id').val();
        var text = '';

        if (custom == 3)
            text = $('#customizations #hue-demo').val();
        else
            text = $('#customizations .title').val();
        var custom_text = $("#customizations #custom_id option:selected").text();
        // if (custom == 0) {
        //     alert('Please select custom value');
        //     return;
        // }
        // if (price == undefined || price < 0) {
        //     alert('Price is required and greater than 0');
        //     return;
        // }
        //
        var custom_row = $('.custom-row');
        // var default_text = 'No';
        // is_default = 0;
        // if ($('#customizations #is_default').is(":checked")) {
        //     default_text = 'Yes';
        //     custom_row.find('.default').val(0);
        //     custom_row.find('.default_text').text('No');
        //     is_default = 1;
        //
        // }
        // <td><span class="default_text">' + default_text + '</span><input type="hidden" name="is_default[]" class="default" value="' + is_default + '"></td>
        custom_row.append('<tr><td>' + (++index) + '</td><td>' + custom_text + '<input type="hidden" name="custom_id[]" value="' + custom + '"></td><td>' + text + '<input type="hidden" name="custom_text[]" value="' + text + '"></td><td>' + description + '<input type="hidden" name="custom_description[]" value="' + description + '"></td><td>' + price + '<input type="hidden" name="custom_price[]" value="' + price + '"></td><td><a href="javascript:;" class="btn btn-danger btn-icon-only btn-circle remove-custom"><i class="fa fa-times"></i></a></td></tr>');
        $('#customizations input').not('input[type=hidden]').val('');
        $('#customizations select').val(0);
        $('#customizations textarea').val('');
        // $('#customizations #is_default').attr('checked', false);

    });
    $(document).on('click', '.remove-custom', function () {

        $(this).closest('tr').remove();
    });
    $(document).on('change', '.is_offer', function () {
        var value = $(this).attr('data-value');
        if (value == 0) {
            $('.has_offer').slideDown(1000);
            $(this).attr('data-value', 1)
        } else {
            $('.has_offer').slideUp(1000);
            $(this).attr('data-value', 0)
        }
    });
    $(document).on('change', '.is_sponsor', function () {
        var value = $(this).attr('data-value');
        if (value == 0) {
            $('.has_sponsor').slideDown(1000);
            $(this).attr('data-value', 1)
        } else {
            $('.has_sponsor').slideUp(1000);
            $(this).attr('data-value', 0)
        }
    });

    $(document).on('click', '.delete-product-image', function (event) {

        var _this = $(this);
        var action = _this.attr('data-url');
        event.preventDefault();
        var constant_name = _this.closest('tr').find("td:eq(1)").text();
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
                            data: {_token: csrf_token},
                            success: function (data) {

                                if (data.status) {
                                    toastr['success'](data.message, '');
                                    _this.closest('tr').remove();

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
    $(document).on('click', '.delete', function (event) {

        var _this = $(this);
        var action = _this.attr('href');
        event.preventDefault();
        var constant_name = _this.closest('tr').find("td:eq(1)").text();
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
                            data: {_token: csrf_token},
                            success: function (data) {

                                if (data.status) {
                                    toastr['success'](data.message, '');
                                    // _this.closest('tr').remove();
                                    products_tbl.api().ajax.reload();

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
    $(document).on('click', '.delete_product', function (event) {

        var _this = $(this);
        var action = _this.attr('href');
        event.preventDefault();
        var constant_name = _this.closest('tr').find("td:eq(1)").text();
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
                            data: {_token: csrf_token},
                            success: function (data) {

                                if (data.status) {
                                    toastr['success'](data.message, '');
                                    // _this.closest('tr').remove();
                                    products_tbl.api().ajax.reload();

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

    $(document).on('change', '.set-sponsor', function (event) {

        var _this = $(this);
        var product_id = _this.data('id');
        event.preventDefault();
        $.ajax({
            url: baseURL + '/store/product-sponsor',
            type: 'PUT',
            dataType: 'json',
            data: {'_token': csrf_token, 'product_id': product_id},
            success: function (data) {

                if (data.status) {
                    $('.alert').hide();
                    toastr['success'](data.message, '');
                    products_tbl.api().ajax.reload();

                } else {
                    toastr['error'](data.message);
                }

            }
        });

    });
    $(document).on('click', '.set_product_active', function (event) {

        var _this = $(this);
        var action = _this.attr('href');
        event.preventDefault();
        $.ajax({
            url: action,
            type: 'PUT',
            dataType: 'json',
            data: {'_token': csrf_token},
            success: function (data) {

                if (data.status) {
                    $('.alert').hide();
                    toastr['success'](data.message, '');
                    products_tbl.api().ajax.reload();

                } else {
                    toastr['error'](data.message);
                }

            }
        });

    });
    $(document).on('click', '.undo_delete_product', function (event) {

        var _this = $(this);
        var action = _this.attr('href');
        event.preventDefault();
        $.ajax({
            url: action,
            type: 'PUT',
            dataType: 'json',
            data: {'_token': csrf_token},
            success: function (data) {

                if (data.status) {
                    $('.alert').hide();
                    toastr['success'](data.message, '');
                    products_tbl.api().ajax.reload();

                } else {
                    toastr['error'](data.message);
                }

            }
        });

    });
    $(document).on('change', '.set-offer', function (event) {

        var _this = $(this);
        var product_id = _this.data('id');
        event.preventDefault();
        $.ajax({
            url: baseURL + '/store/product-offer',
            type: 'PUT',
            dataType: 'json',
            data: {'_token': csrf_token, 'product_id': product_id},
            success: function (data) {

                if (data.status) {
                    $('.alert').hide();
                    toastr['success'](data.message, '');
                    products_tbl.api().ajax.reload();

                } else {
                    toastr['error'](data.message);
                }

            }
        });

    });

    $(document).on("click", ".filter-submit-product", function () {
//                if ($(this).val().length > 3)
        products_tbl.api().ajax.reload();
    });
    $(document).on('click', '.filter-cancel-product', function () {

        $(".select2").val('').trigger('change');
        $(this).closest('tr').find('input,select').val('');
        // $('#is_admin_confirm,.status').val('').trigger('change');
        products_tbl.api().ajax.reload();
    });

    $(document).on('click', '.add-product-mdl', function (e) {
        e.preventDefault();
        $("#wait_msg,#overlay").show();
        var action = $(this).attr('href');

        $.ajax({
            url: action,
            type: 'GET',
            success: function (data) {
                $("#wait_msg,#overlay").hide();

                $('#results-modals').html(data);
                $('#add-product').modal('show', {backdrop: 'static', keyboard: false});
            }, error: function (xhr) {

            }
        });
    });

    $(document).on('click', '.edit-product-mdl', function (e) {
        // var addProductHtml = $('.component').html();
        // // $('.component').addClass('text-center').html('<i class="fa fa-spinner fa-spin text-center fa-5x"></i>');
        // // $(".component").animate({
        // //     top: '0px'
        // // }, 2000);
        e.preventDefault();
        var action = $(this).attr('href');
        $.ajax({
            url: action,
            type: 'GET',
            success: function (data) {
                // $("#wait_msg,#overlay").hide();
                // $('.component').removeClass('text-center').html(data);

                $('#edit_product').html(data);
                $('#editProduct').modal('show', {backdrop: 'static', keyboard: false});
            }, error: function (xhr) {
                // $('.component').html(addProductHtml);
            }
        });
    });
    $(document).on('click', '.edit-product-images-mdl', function (e) {
        // var addProductHtml = $('.component').html();
        // // $('.component').addClass('text-center').html('<i class="fa fa-spinner fa-spin text-center fa-5x"></i>');
        // // $(".component").animate({
        // //     top: '0px'
        // // }, 2000);
        e.preventDefault();
        var action = $(this).attr('href');
        $.ajax({
            url: action,
            type: 'GET',
            success: function (data) {
                // $("#wait_msg,#overlay").hide();
                // $('.component').removeClass('text-center').html(data);
                $('#images-product').html(data);
                $('#imagesProduct').modal('show', {backdrop: 'static', keyboard: false});
            }, error: function (xhr) {
                // $('.component').html(addProductHtml);
            }
        });
    });

    $(document).on('submit', '#productAdd,#productEdit', function (event) {

        var _this = $(this);
        // var loader = '<i class="fa fa-spinner fa-spin"></i>';
        _this.find('.btn.save i').addClass('fa-spinner fa-spin');
        event.preventDefault(); // Totally stop stuff happening
        // START A LOADING SPINNER HERE
        // Create a formdata object and add the files

        var formData = new FormData($(this)[0]);
        // var formData = new FormData($('#myForm')[0]);
        // if (filesArray != undefined)
        //     for (var i = 0, file; file = filesArray[i]; i++) {
        //         formData.append('files[]', file);
        //     }

        $image_url_action = $('.product-images').find('form').attr('action');
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
                    if (event.target.id == 'productAdd') {
                        _this.attr('action', baseURL + '/product/' + data.items.id);
                    }
                    $image_url_action += '/' + data.items.id;
                    $('.product-images').find('form').attr('action', $image_url_action);
                    $('.product-images').slideDown(1000);
                    // products_tbl.api().ajax.reload();
                    // $('.product_images').slideDown();
                } else {
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
                _this.find('.btn.save i').removeClass('fa-spinner fa-spin');
                // _this.find('.fa-spin').hide();

            }
        });
    });

});
