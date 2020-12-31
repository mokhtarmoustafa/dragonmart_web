$(document).ready(function () {

    if ($("#sponsor_requests_tbl").length) {

        var sponsor_requests_tbl = $("#sponsor_requests_tbl");
        sponsor_requests_tbl.on('preXhr.dt', function (e, settings, data) {

        }).dataTable({
            "processing": true,
            "serverSide": true,

            "ajax": {
                url: baseURL + "/sponsor-requests-data"
                , "dataSrc": function (json) {
                    //Make your callback here.
                    if (json.status != undefined && !json.status) {
                        $('#sponsor_requests_tbl_processing').hide();
                        bootbox.alert(json.message);
                        //
                    } else
                        return json.data;
                }
            },

            columns: [
                {data: 'DT_RowIndex', name: 'DT_RowIndex'},
                {data: 'merchant_name', name: 'merchant_name'},
                {data: 'name', name: 'name'},
                {data: 'sponsor_duration', name: 'sponsor_duration'},
                {data: 'end_date_sponsor', name: 'end_date_sponsor'},
                {data: 'action', name: 'action'}
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
            columnDefs: [{orderable: !1, targets: [0]}, {searchable: !1, targets: [0]}, {className: "dt-right"}],
            order: [[2, "asc"]]
        });

        // Grab the datatables input box and alter how it is bound to events
        $(".dataTables_filter input")
            .unbind() // Unbind previous default bindings
            .bind("input", function (e) { // Bind our desired behavior
                // If the length is 3 or more characters, or the user pressed ENTER, search
                if (this.value.length >= 3 || e.keyCode == 13) {
                    // Call the API search function
                    sponsor_requests_tbl.api().search(this.value).ajax.reload();

                }
                // Ensure we clear the search if they backspace far enough
                if (this.value == "") {
                    sponsor_requests_tbl.api().search("").ajax.reload();
                }
            });
    }

    $(document).on('click', '.set_product_sponsor', function (event) {

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
                    sponsor_requests_tbl.api().ajax.reload();


                } else {
                    toastr['error'](data.message);
                }

            }
        });

    });

    $(document).on("click", ".filter-submit", function () {
//                if ($(this).val().length > 3)
        sponsor_requests_tbl.api().ajax.reload();
    });
    $(document).on('click', '.filter-cancel', function () {

        $(".select2").val('').trigger('change');
        $(this).closest('tr').find('input,select').val('');
        // $('#is_admin_confirm,.status').val('').trigger('change');
        sponsor_requests_tbl.api().ajax.reload();
    });

});