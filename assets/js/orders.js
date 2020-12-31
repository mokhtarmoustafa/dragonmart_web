
$(document).ready(function () {

    var loadingTime = 10; // time in seconds

    if ($("#user-orders-tbl").length) {

        var client_id = $('#client_id').val();
        var user_orders_tbl = $("#user-orders-tbl");
        user_orders_tbl.on('preXhr.dt', function (e, settings, data) {

        }).dataTable({
            "processing": true,
            "serverSide": true,

            "ajax": {
                url: baseURL + "/client-orders-data/" + client_id
                , "dataSrc": function (json) {
                    //Make your callback here.
                    if (json.status != undefined && !json.status) {
                        $('#user-orders-tbl_processing').hide();
                        bootbox.alert(json.message);
                        //
                    } else
                        return json.data;
                }
            },

            columns: [
                { data: 'DT_RowIndex', name: 'DT_RowIndex' },
                { data: 'order_id', name: 'order_id' },
                { data: 'merchant_name', name: 'merchant_name' },
                { data: 'created_at', name: 'created_at' },
                { data: 'order_user.received_datetime', name: 'order_user.received_datetime' },
                { data: 'actual_received_date', name: 'actual_received_date' },
                { data: 'items_no', name: 'items_no' },
                { data: 'order_user.procurement_method', name: 'order_user.procurement_method' },
                { data: 'driver_source', name: 'driver_source' },

                { data: 'driver_name', name: 'driver_name' },
                { data: 'products_price', name: 'products_price' },
                // {data: 'location', name: 'location'},
                { data: 'order_user.total_shipment_price', name: 'order_user.total_shipment_price' },
                { data: 'action', name: 'action' }
            ],

            language: {
                "sProcessing": "<img src='" + baseAssets + "/apps/img/preloader_.gif'>",
            },
            "searching": false,
            // "ordering": false,

            bStateSave: !0,
            lengthMenu: [[5, 10, 15, 20, -1], [5, 10, 15, 20, "All"]],
            pageLength: 10,
            // pagingType: "bootstrap_full_number",
            columnDefs: [{ orderable: !1, targets: [0] }, { searchable: !1, targets: [0] }, { className: "dt-right" }],
            order: [[2, "asc"]]
        });

        // Grab the datatables input box and alter how it is bound to events
        $("#merchant-orders-tbl .dataTables_filter input")
            .unbind() // Unbind previous default bindings
            .bind("input", function (e) { // Bind our desired behavior
                // If the length is 3 or more characters, or the user pressed ENTER, search
                if (this.value.length >= 3 || e.keyCode == 13) {
                    // Call the API search function
                    order_tbl.api().search(this.value).ajax.reload();

                }
                // Ensure we clear the search if they backspace far enough
                if (this.value == "") {
                    order_tbl.api().search("").ajax.reload();
                }
            });
    }

    if ($("#merchant-orders-tbl").length) {

        var merchant_id = $('#merchant_id').val();
        var merchant_orders_tbl = $("#merchant-orders-tbl");
        merchant_orders_tbl.on('preXhr.dt', function (e, settings, data) {

        }).dataTable({
            "processing": true,
            "serverSide": true,

            "ajax": {
                url: baseURL + "/merchant-orders-data/" + merchant_id
                , "dataSrc": function (json) {
                    //Make your callback here.
                    if (json.status != undefined && !json.status) {
                        $('#merchant-orders-tbl_processing').hide();
                        bootbox.alert(json.message);
                        //
                    } else
                        return json.data;
                }
            },

            columns: [
                { data: 'DT_RowIndex', name: 'DT_RowIndex' },
                { data: 'order_id', name: 'order_id' },
                { data: 'merchant_name', name: 'merchant_name' },
                { data: 'created_at', name: 'created_at' },
                { data: 'order_user.received_datetime', name: 'order_user.received_datetime' },
                { data: 'actual_received_date', name: 'actual_received_date' },
                { data: 'items_no', name: 'items_no' },
                { data: 'order_user.procurement_method', name: 'order_user.procurement_method' },
                { data: 'driver_source', name: 'driver_source' },
                { data: 'driver_name', name: 'driver_name' },
                { data: 'products_price', name: 'products_price' },
                { data: 'order_user.total_shipment_price', name: 'order_user.total_shipment_price' },
                { data: 'action', name: 'action' }
            ],

            language: {
                "sProcessing": "<img src='" + baseAssets + "/apps/img/preloader_.gif'>",
            },
            "searching": false,
            // "ordering": false,

            bStateSave: !0,
            lengthMenu: [[5, 10, 15, 20, -1], [5, 10, 15, 20, "All"]],
            pageLength: 10,
            // pagingType: "bootstrap_full_number",
            columnDefs: [{ orderable: !1, targets: [0] }, { searchable: !1, targets: [0] }, { className: "dt-right" }],
            order: [[2, "asc"]]
        });

        // Grab the datatables input box and alter how it is bound to events
        $("#merchant-orders-tbl .dataTables_filter input")
            .unbind() // Unbind previous default bindings
            .bind("input", function (e) { // Bind our desired behavior
                // If the length is 3 or more characters, or the user pressed ENTER, search
                if (this.value.length >= 3 || e.keyCode == 13) {
                    // Call the API search function
                    order_tbl.api().search(this.value).ajax.reload();

                }
                // Ensure we clear the search if they backspace far enough
                if (this.value == "") {
                    order_tbl.api().search("").ajax.reload();
                }
            });
    }

    // auto reload
    if ($("#new_order_tbl").length) {

        var new_order_tbl = $("#new_order_tbl");
        new_order_tbl.on('preXhr.dt', function (e, settings, data) {

        }).dataTable({
            "processing": false,
            "serverSide": true,

            "ajax": {
                url: baseURL + "/orders-data/new"
                , "dataSrc": function (json) {

                    $("#new_orders_qty").text(json.data.length);

                    //Make your callback here.
                    if (json.status != undefined && !json.status) {
                        $('#new_order_tbl_processing').hide();
                        bootbox.alert(json.message);
                        //
                    } else
                        return json.data;
                }
            },

            columns: [
                { data: 'DT_RowIndex', name: 'DT_RowIndex' },
                { data: 'merchant_name', name: 'merchant_name' },
                { data: 'status_duration', name: 'status_duration' },
                { data: 'items_no', name: 'items_no' },
                { data: 'products_price', name: 'products_price' },
                { data: 'action', name: 'action' }

            ],

            language: {
                "sProcessing": "<img src='" + baseAssets + "/apps/img/preloader_.gif'>",
            },
            "searching": true,
            "ordering": false,
            "pagingType": "full_numbers",

            bStateSave: !0,
            lengthMenu: [[5, 10, 15, 20, -1], [5, 10, 15, 20, "All"]],
            pageLength: 10,
            // pagingType: "bootstrap_full_number",
            columnDefs: [{ orderable: !1, targets: [0] }, { searchable: !1, targets: [0] }, { className: "dt-right" }],
            order: [[2, "asc"]]
        });

        setInterval(function () {
            $('#new_order_tbl').DataTable().ajax.reload()
        }, loadingTime * 1000);

        // Grab the datatables input box and alter how it is bound to events
        $(".dataTables_filter input")
            .unbind() // Unbind previous default bindings
            .bind("input", function (e) { // Bind our desired behavior
                // If the length is 3 or more characters, or the user pressed ENTER, search
                if (this.value.length >= 3 || e.keyCode == 13) {
                    // Call the API search function
                    order_tbl.api().search(this.value).ajax.reload();

                }
                // Ensure we clear the search if they backspace far enough
                if (this.value == "") {
                    order_tbl.api().search("").ajax.reload();
                }
            });
    }

    // auto reload
    if ($("#current_order_tbl").length) {

        var current_order_tbl = $("#current_order_tbl");
        current_order_tbl.on('preXhr.dt', function (e, settings, data) {

        }).dataTable({
            "processing": false,
            "serverSide": true,

            "ajax": {
                url: baseURL + "/orders-data/current"
                , "dataSrc": function (json) {

                    $("#current_orders_qty").text(json.data.length);

                    //Make your callback here.
                    if (json.status != undefined && !json.status) {
                        $('#current_order_tbl_processing').hide();
                        bootbox.alert(json.message);
                        //
                    } else
                        return json.data;
                }
            },

            columns: [
                { data: 'id', name: 'id' },
                { data: 'current_status', name: 'current_status' },
                { data: 'duration', name: 'duration' },
                { data: 'merchant_name', name: 'merchant_name' },
                { data: 'store.phone', name: 'store.phone' },
                { data: 'job_id', name: 'job_id' },
                { data: 'driver_name', name: 'driver_name' },
                { data: 'products_price', name: 'products_price' },
                { data: 'action', name: 'action' }
            ],

            "createdRow": function (row, data, dataIndex) {
                if (
                    ((data['order_status'] == 'accepted' || data['order_status'] == 'progress') && data['status_duration'] < '00:30:00')
                    || (((data['order_status'] == 'finished' && data['driver_status'] == 'new') || (data['order_status'] == 'pickup' && data['driver_status'] == 'receive')) && data['status_duration'] < '00:25:00')
                    ) 
                {
                    $(row).addClass('bg-light-success');
                }
                else if (
                    ((data['order_status'] == 'accepted' || data['order_status'] == 'progress') && (data['status_duration'] > '00:30:00' && data['status_duration'] < '00:40:00'))
                    || (((data['order_status'] == 'finished' && data['driver_status'] == 'new') || (data['order_status'] == 'pickup' && data['driver_status'] == 'receive')) 
                    && (data['status_duration'] > '00:25:00' && data['status_duration'] < '00:30:00'))
                ) 
                {
                    $(row).addClass('bg-light-warning');
                }
                else
                {
                    $(row).addClass('bg-light-danger');
                }
            },

            language: {
                "sProcessing": "<img src='" + baseAssets + "/apps/img/preloader_.gif'>",
            },

            "searching": true,
            "ordering": false,
            "pagingType": "full_numbers",

            bStateSave: !0,
            lengthMenu: [[5, 10, 15, 20, -1], [5, 10, 15, 20, "All"]],
            pageLength: 10,
            columnDefs: [{ orderable: !1, targets: [0] }, { searchable: !1, targets: [0] }, { className: "dt-right" }],
            order: [[2, "asc"]]
        });

        setInterval(function () {
            $('#current_order_tbl').DataTable().ajax.reload()
        }, loadingTime * 1000);

        // Grab the datatables input box and alter how it is bound to events
        $(".dataTables_filter input")
            .unbind() // Unbind previous default bindings
            .bind("input", function (e) { // Bind our desired behavior
                // If the length is 3 or more characters, or the user pressed ENTER, search
                if (this.value.length >= 3 || e.keyCode == 13) {
                    // Call the API search function
                    order_tbl.api().search(this.value).ajax.reload();

                }
                // Ensure we clear the search if they backspace far enough
                if (this.value == "") {
                    order_tbl.api().search("").ajax.reload();
                }
            });
    }

    // auto reload
    if ($("#finished_order_tbl").length) {

        var finished_order_tbl = $("#finished_order_tbl");
        finished_order_tbl.on('preXhr.dt', function (e, settings, data) {

        }).dataTable({
            "processing": false,
            "serverSide": true,

            "ajax": {
                url: baseURL + "/orders-data/delivered"
                , "dataSrc": function (json) {
                    //Make your callback here.
                    if (json.status != undefined && !json.status) {
                        $('#finished_order_tbl_processing').hide();
                        bootbox.alert(json.message);
                        //
                    } else
                        return json.data;
                }
            },

            columns: [
                { data: 'DT_RowIndex', name: 'DT_RowIndex' },
                { data: 'order_id', name: 'order_id' },
                { data: 'created_at', name: 'created_at' },
                { data: 'duration', name: 'duration' },
                { data: 'client_name', name: 'client_name' },
                { data: 'merchant_name', name: 'merchant_name' },
                { data: 'job_id', name: 'job_id' },
                { data: 'driver_name', name: 'driver_name' },
                // { data: 'driver_source', name: 'driver_source' },
                { data: 'action', name: 'action' }
            ],

            "createdRow": function (row, data, dataIndex) {
                $(row).addClass('bg-light-success');
            },

            language: {
                "sProcessing": "<img src='" + baseAssets + "/apps/img/preloader_.gif'>",
            },
            "searching": false,
            "ordering": false,

            bStateSave: !0,
            lengthMenu: [[5, 10, 15, 20, -1], [5, 10, 15, 20, "All"]],
            pageLength: 10,
            // pagingType: "bootstrap_full_number",
            columnDefs: [{ orderable: !1, targets: [0] }, { searchable: !1, targets: [0] }, { className: "dt-right" }],
            order: [[2, "asc"]]
        });

        setInterval(function () {
            $('#finished_order_tbl').DataTable().ajax.reload()
        }, loadingTime * 1000);

        // Grab the datatables input box and alter how it is bound to events
        $(".dataTables_filter input")
            .unbind() // Unbind previous default bindings
            .bind("input", function (e) { // Bind our desired behavior
                // If the length is 3 or more characters, or the user pressed ENTER, search
                if (this.value.length >= 3 || e.keyCode == 13) {
                    // Call the API search function
                    order_tbl.api().search(this.value).ajax.reload();

                }
                // Ensure we clear the search if they backspace far enough
                if (this.value == "") {
                    order_tbl.api().search("").ajax.reload();
                }
            });
    }

    // auto reload
    if ($("#late_order_tbl").length) {

        var late_order_tbl = $("#late_order_tbl");
        var tableLen = 0;



        late_order_tbl.on('preXhr.dt', function (e, settings, data) {

        }).dataTable({
            "processing": false,
            "serverSide": true,


            "ajax": {
                url: baseURL + "/orders-data/late"
                , "dataSrc": function (json) {

                    $("#late_orders_qty").text(json.data.length);

                    if (tableLen < json.recordsTotal && tableLen != 0) {

                        createAlert('alert-light-warning');

                        $(".alert-text").text('لديك طلب متأخر');

                        $(document).ready(function () {
                            setTimeout(
                                function () {
                                    $('.alert').removeClass('show');
                                }, 3000);
                            setTimeout(
                                function () {
                                    $('.alert').closest('.row').remove();
                                }, 4000);
                        });
                    }
                    tableLen = json.recordsTotal;
                    //Make your callback here.
                    if (json.status != undefined && !json.status) {
                        $('#late_order_tbl_processing').hide();
                        bootbox.alert(json.message);
                        //
                    } else
                        return json.data;
                }
            },

            columns: [
                { data: 'DT_RowIndex', name: 'DT_RowIndex' },
                { data: 'order_status', name: 'order_status' },
                { data: 'status_duration', name: 'status_duration' },
                { data: 'merchant_name', name: 'merchant_name' },
                { data: 'driver_source', name: 'driver_source' },
                { data: 'driver_name', name: 'driver_name' },
                { data: 'client_name', name: 'client_name' },
                { data: 'action', name: 'action' }
            ],

            "createdRow": function (row, data, dataIndex) {
                $(row).addClass('bg-light-danger');
            },

            language: {
                "sProcessing": "<img src='" + baseAssets + "/apps/img/preloader_.gif'>",
            },
            "searching": false,
            "ordering": false,

            bStateSave: !0,
            lengthMenu: [[5, 10, 15, 20, -1], [5, 10, 15, 20, "All"]],
            pageLength: 10,
            // pagingType: "bootstrap_full_number",
            columnDefs: [{ orderable: !1, targets: [0] }, { searchable: !1, targets: [0] }, { className: "dt-right" }],
            order: [[2, "asc"]]
        });

        setInterval(function () {
            $('#late_order_tbl').DataTable().ajax.reload()
        }, loadingTime * 1000);

        // Grab the datatables input box and alter how it is bound to events
        $(".dataTables_filter input")
            .unbind() // Unbind previous default bindings
            .bind("input", function (e) { // Bind our desired behavior
                // If the length is 3 or more characters, or the user pressed ENTER, search
                if (this.value.length >= 3 || e.keyCode == 13) {
                    // Call the API search function
                    order_tbl.api().search(this.value).ajax.reload();

                }
                // Ensure we clear the search if they backspace far enough
                if (this.value == "") {
                    order_tbl.api().search("").ajax.reload();
                }
            });
    }

    // auto reload
    if ($("#rejected_order_tbl").length) {

        var rejected_order_tbl = $("#rejected_order_tbl");
        var tableLen = 0;



        rejected_order_tbl.on('preXhr.dt', function (e, settings, data) {

        }).dataTable({
            "processing": false,
            "serverSide": true,


            "ajax": {
                url: baseURL + "/orders-data/rejected"
                , "dataSrc": function (json) {

                    $("#rejected_orders_qty").text(json.data.length);

                    if (tableLen < json.recordsTotal && tableLen != 0) {

                        createAlert('alert-light-danger');

                        $(".alert-text").text('لديك طلب مرفوض');

                        $(document).ready(function () {
                            setTimeout(
                                function () {
                                    $('.alert').removeClass('show');
                                }, 3000);
                            setTimeout(
                                function () {
                                    $('.alert').closest('.row').remove();
                                }, 4000);
                        });
                    }
                    tableLen = json.recordsTotal;
                    //Make your callback here.
                    if (json.status != undefined && !json.status) {
                        $('#rejected_order_tbl_processing').hide();
                        bootbox.alert(json.message);
                        //
                    } else
                        return json.data;
                }
            },

            columns: [
                { data: 'DT_RowIndex', name: 'DT_RowIndex' },
                { data: 'order_id', name: 'order_id' },
                { data: 'created_at', name: 'created_at' },
                { data: 'merchant_name', name: 'merchant_name' },
                { data: 'reject_reason', name: 'reject_reason' },
                { data: 'order_user.procurement_method', name: 'order_user.procurement_method' },
                { data: 'products_price', name: 'products_price' },
                { data: 'action', name: 'action' }
            ],

            "createdRow": function (row, data, dataIndex) {
                $(row).addClass('bg-light-danger');
            },

            language: {
                "sProcessing": "<img src='" + baseAssets + "/apps/img/preloader_.gif'>",
            },
            "searching": false,
            "ordering": false,

            bStateSave: !0,
            lengthMenu: [[5, 10, 15, 20, -1], [5, 10, 15, 20, "All"]],
            pageLength: 10,
            // pagingType: "bootstrap_full_number",
            columnDefs: [{ orderable: !1, targets: [0] }, { searchable: !1, targets: [0] }, { className: "dt-right" }],
            order: [[2, "asc"]]
        });

        setInterval(function () {
            $('#rejected_order_tbl').DataTable().ajax.reload()
        }, loadingTime * 1000);

        // Grab the datatables input box and alter how it is bound to events
        $(".dataTables_filter input")
            .unbind() // Unbind previous default bindings
            .bind("input", function (e) { // Bind our desired behavior
                // If the length is 3 or more characters, or the user pressed ENTER, search
                if (this.value.length >= 3 || e.keyCode == 13) {
                    // Call the API search function
                    order_tbl.api().search(this.value).ajax.reload();

                }
                // Ensure we clear the search if they backspace far enough
                if (this.value == "") {
                    order_tbl.api().search("").ajax.reload();
                }
            });
    }

    if ($("#revenue_orders_tbl").length) { // revenue

        var revenue_orders_tbl = $("#revenue_orders_tbl");
        revenue_orders_tbl.on('preXhr.dt', function (e, settings, data) {
            data.order_no = $('#revenue_orders').find('#order_no').val();
            data.merchant_name = $('#revenue_orders').find('#merchant_name').val();
            data.order_date_from = $('#revenue_orders').find('#order_date_from').val();
            data.order_date_to = $('#revenue_orders').find('#order_date_to').val();
            data.driver_type_id = $('#revenue_orders').find('#driver_type_id').val();

        }).dataTable({
            "processing": true,
            "serverSide": true,

            "ajax": {
                url: baseURL + "/revenue-orders-data"
                , "dataSrc": function (json) {
                    //Make your callback here.
                    if (json.status != undefined && !json.status) {
                        $('#revenue_orders_tbl_processing').hide();
                        bootbox.alert(json.message);
                        //
                    } else
                        return json.data;
                }
            },

            columns: [
                { data: 'DT_RowIndex', name: 'DT_RowIndex' },
                { data: 'order_id', name: 'order_id' },
                { data: 'merchant_name', name: 'merchant_name' },
                { data: 'actual_received_date', name: 'actual_received_date' },
                // {data: 'order_user.received_datetime', name: 'order_user.received_datetime'},
                // {data: 'actual_received_date', name: 'actual_received_date'},
                // {data: 'items_no', name: 'items_no'},
                // {data: 'order_user.procurement_method', name: 'order_user.procurement_method'},
                { data: 'driver_source', name: 'driver_source' },

                // {data: 'driver_name', name: 'driver_name'},
                { data: 'products_price', name: 'products_price' },
                { data: 'commission_cost', name: 'commission_cost' },
                // {data: 'location', name: 'location'},
                { data: 'order_user.total_shipment_price', name: 'order_user.total_shipment_price' },
                { data: 'revenue', name: 'revenue' }
            ],

            language: {
                "sProcessing": "<img src='" + baseAssets + "/apps/img/preloader_.gif'>",
            },
            "searching": false,
            // "ordering": false,

            bStateSave: !0,
            lengthMenu: [[5, 10, 15, 20, -1], [5, 10, 15, 20, "All"]],
            pageLength: 10,
            // pagingType: "bootstrap_full_number",
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
                    order_tbl.api().search(this.value).ajax.reload();

                }
                // Ensure we clear the search if they backspace far enough
                if (this.value == "") {
                    order_tbl.api().search("").ajax.reload();
                }
            });
    }

    // auto reload
    if ($("#current_report_orders_tbl").length) { // revenue

        var current_report_orders_tbl = $("#current_report_orders_tbl");
        current_report_orders_tbl.on('preXhr.dt', function (e, settings, data) {
            data.order_no = $('#current_report_orders').find('#order_no').val();
            data.merchant_name = $('#current_report_orders').find('#merchant_name').val();
            data.order_date_from = $('#current_report_orders').find('#order_date_from').val();
            data.order_date_to = $('#current_report_orders').find('#order_date_to').val();
            data.received_date_from = $('#current_report_orders').find('#received_date_from').val();
            data.received_date_to = $('#current_report_orders').find('#received_date_to').val();
            data.driver_type_id = $('#current_report_orders').find('#driver_type_id').val();
            data.driver_name = $('#current_report_orders').find('#driver_name').val();
        }).dataTable({
            "processing": false,
            "serverSide": true,

            "ajax": {
                url: baseURL + "/report-orders-data/current"
                , "dataSrc": function (json) {

                    $("#current_orders_qty").text(json.recordsTotal);

                    //Make your callback here.
                    if (json.status != undefined && !json.status) {
                        $('#current_report_orders_tbl_processing').hide();
                        bootbox.alert(json.message);
                        //
                    } else
                        return json.data;
                }
            },

            columns: [
                { data: 'order_id', name: 'order_id' },
                { data: 'current_status', name: 'current_status' },
                { data: 'status_duration', name: 'status_duration' },
                { data: 'items_no', name: 'items_no' },
                { data: 'products_price', name: 'products_price' },
                { data: 'driver_source', name: 'driver_source' },
                { data: 'driver_name', name: 'driver_name' },
                { data: 'action', name: 'action' }
            ],

            language: {
                "sProcessing": "<img src='" + baseAssets + "/apps/img/preloader_.gif'>",
            },
            "searching": false,
            "ordering": false,

            bStateSave: !0,
            lengthMenu: [[5, 10, 15, 20, -1], [5, 10, 15, 20, "All"]],
            pageLength: 10,
            // // pagingType: "bootstrap_full_number",
            columnDefs: [{ orderable: !1, targets: [0] }, { searchable: !1, targets: [0] }, { className: "dt-right" }],
            order: [[2, "asc"]]
        });

        setInterval(function () {
            $('#current_report_orders_tbl').DataTable().ajax.reload()
        }, loadingTime * 1000);

        // Grab the datatables input box and alter how it is bound to events
        $(".dataTables_filter input")
            .unbind() // Unbind previous default bindings
            .bind("input", function (e) { // Bind our desired behavior
                // If the length is 3 or more characters, or the user pressed ENTER, search
                if (this.value.length >= 3 || e.keyCode == 13) {
                    // Call the API search function
                    order_tbl.api().search(this.value).ajax.reload();

                }
                // Ensure we clear the search if they backspace far enough
                if (this.value == "") {
                    order_tbl.api().search("").ajax.reload();
                }
            });
    }

    // auto reload
    if ($("#finished_report_orders_tbl").length) { // revenue

        var finished_report_orders_tbl = $("#finished_report_orders_tbl");
        finished_report_orders_tbl.on('preXhr.dt', function (e, settings, data) {
            data.order_no = $('#finished_report_orders').find('#order_no').val();
            data.merchant_name = $('#finished_report_orders').find('#merchant_name').val();
            data.order_date_from = $('#finished_report_orders').find('#order_date_from').val();
            data.order_date_to = $('#finished_report_orders').find('#order_date_to').val();
            data.received_date_from = $('#finished_report_orders').find('#received_date_from').val();
            data.received_date_to = $('#finished_report_orders').find('#received_date_to').val();
            data.driver_type_id = $('#finished_report_orders').find('#driver_type_id').val();
            data.driver_name = $('#finished_report_orders').find('#driver_name').val();
        }).dataTable({
            "processing": false,
            "serverSide": true,

            "ajax": {
                url: baseURL + "/report-orders-data/pickup"
                , "dataSrc": function (json) {

                    $("#finished_orders_qty").text(json.recordsTotal);

                    //Make your callback here.
                    if (json.status != undefined && !json.status) {
                        $('#finished_report_orders_tbl_processing').hide();
                        bootbox.alert(json.message);
                        //
                    } else
                        return json.data;
                }
            },

            columns: [
                { data: 'DT_RowIndex', name: 'DT_RowIndex' },
                { data: 'order_id', name: 'order_id' },
                { data: 'created_at', name: 'created_at' },
                { data: 'actual_received_date', name: 'actual_received_date' },
                { data: 'items_no', name: 'items_no' },
                { data: 'products_price', name: 'products_price' },
                { data: 'driver_source', name: 'driver_source' },
                { data: 'driver_name', name: 'driver_name' },
                { data: 'action', name: 'action' }
            ],

            language: {
                "sProcessing": "<img src='" + baseAssets + "/apps/img/preloader_.gif'>",
            },
            "searching": false,
            // "ordering": false,

            bStateSave: !0,
            lengthMenu: [[5, 10, 15, 20, -1], [5, 10, 15, 20, "All"]],
            pageLength: 10,
            // pagingType: "bootstrap_full_number",
            columnDefs: [{ orderable: !1, targets: [0] }, { searchable: !1, targets: [0] }, { className: "dt-right" }],
            order: [[2, "asc"]]
        });


        setInterval(function () {
            $('#finished_report_orders_tbl').DataTable().ajax.reload()
        }, loadingTime * 1000);

        // Grab the datatables input box and alter how it is bound to events
        $(".dataTables_filter input")
            .unbind() // Unbind previous default bindings
            .bind("input", function (e) { // Bind our desired behavior
                // If the length is 3 or more characters, or the user pressed ENTER, search
                if (this.value.length >= 3 || e.keyCode == 13) {
                    // Call the API search function
                    order_tbl.api().search(this.value).ajax.reload();

                }
                // Ensure we clear the search if they backspace far enough
                if (this.value == "") {
                    order_tbl.api().search("").ajax.reload();
                }
            });
    }

    // auto reload
    if ($("#rejected_report_orders_tbl").length) { // revenue

        var rejected_report_orders_tbl = $("#rejected_report_orders_tbl");
        rejected_report_orders_tbl.on('preXhr.dt', function (e, settings, data) {
            data.order_no = $('#rejected_report_orders').find('#order_no').val();
            data.merchant_name = $('#rejected_report_orders').find('#merchant_name').val();
            data.order_date_from = $('#rejected_report_orders').find('#order_date_from').val();
            data.order_date_to = $('#rejected_report_orders').find('#order_date_to').val();
            data.received_date_from = $('#rejected_report_orders').find('#received_date_from').val();
            data.received_date_to = $('#rejected_report_orders').find('#received_date_to').val();
            data.driver_type_id = $('#rejected_report_orders').find('#driver_type_id').val();
            data.driver_name = $('#rejected_report_orders').find('#driver_name').val();
        }).dataTable({
            "processing": false,
            "serverSide": true,

            "ajax": {
                url: baseURL + "/report-orders-data/rejected"
                , "dataSrc": function (json) {
                    $("#rejected_orders_qty").text(json.recordsTotal);
                    //Make your callback here.
                    if (json.status != undefined && !json.status) {
                        $('#rejected_report_orders_tbl').hide();
                        bootbox.alert(json.message);
                        //
                    } else
                        return json.data;
                }

            },

            columns: [
                { data: 'DT_RowIndex', name: 'DT_RowIndex' },
                { data: 'order_id', name: 'order_id' },
                { data: 'merchant_name', name: 'merchant_name' },
                { data: 'created_at', name: 'created_at' },
                { data: 'order_user.received_datetime', name: 'order_user.received_datetime' },
                { data: 'actual_received_date', name: 'actual_received_date' },
                { data: 'items_no', name: 'items_no' },
                { data: 'order_user.procurement_method', name: 'order_user.procurement_method' },
                { data: 'driver_source', name: 'driver_source' },

                { data: 'driver_name', name: 'driver_name' },
                { data: 'products_price', name: 'products_price' },
                // {data: 'location', name: 'location'},
                { data: 'order_user.total_shipment_price', name: 'order_user.total_shipment_price' },
                { data: 'action', name: 'action' }
            ],

            language: {
                "sProcessing": "<img src='" + baseAssets + "/apps/img/preloader_.gif'>",
            },
            "searching": false,
            // "ordering": false,

            bStateSave: !0,
            lengthMenu: [[5, 10, 15, 20, -1], [5, 10, 15, 20, "All"]],
            pageLength: 10,
            // pagingType: "bootstrap_full_number",
            columnDefs: [{ orderable: !1, targets: [0] }, { searchable: !1, targets: [0] }, { className: "dt-right" }],
            order: [[2, "asc"]]
        });


        setInterval(function () {
            $('#rejected_report_orders_tbl').DataTable().ajax.reload()
        }, loadingTime * 1000);

        // Grab the datatables input box and alter how it is bound to events
        $(".dataTables_filter input")
            .unbind() // Unbind previous default bindings
            .bind("input", function (e) { // Bind our desired behavior
                // If the length is 3 or more characters, or the user pressed ENTER, search
                if (this.value.length >= 3 || e.keyCode == 13) {
                    // Call the API search function
                    order_tbl.api().search(this.value).ajax.reload();

                }
                // Ensure we clear the search if they backspace far enough
                if (this.value == "") {
                    order_tbl.api().search("").ajax.reload();
                }
            });
    }


    $(document).on('change', '#delivery_method', function (e) {

        if ($(this).val() == 'any_driver') {
            $('.driver_name').show();
        } else {
            $('.driver_name').hide();

        }
    });
    $(document).on('click', '.admin-assigned-driver', function (e) {
        e.preventDefault();
        $("#wait_msg,#overlay").show();
        var action = $(this).attr('href');

        $.ajax({
            url: action,
            type: 'GET',
            success: function (data) {
                $("#wait_msg,#overlay").hide();

                $('#results-modals').html(data);
                $('#assign-driver').modal('show', { backdrop: 'static', keyboard: false });
            }, error: function (xhr) {

            }
        });
    });
    $(document).on('click', '.acceptOrder', function (e) {
        e.preventDefault();
        // var _this = $(this);
        var action = $(this).attr('href');

        $.ajax({
            url: action,
            type: 'GET',
            success: function (data) {
                $("#wait_msg,#overlay").hide();

                $('#results-modals').html(data);
                $('#accept-order').modal('show', { backdrop: 'static', keyboard: false });
            }, error: function (xhr) {

            }
        });
        /*bootbox.dialog({
            message: "Are you sure to accept order (" + constant_name + ")? <span class='label label-danger'> Can not return back...</span>",
            title: "Confirm acceptance !",
            buttons: {

                main: {
                    label: 'Sure <i class="fa fa-check"></i> ',
                    className: "btn-primary",
                    callback: function () {
                        //do something else
                        $.ajax({
                            url: action,
                            type: 'PUT',
                            dataType: 'json',
                            data: {_token: csrf_token},
                            success: function (data) {
                                if (data.status) {
                                    toastr['success'](data.message, '');
                                    new_report_orders_tbl.api().ajax.reload();
                                    current_report_orders_tbl.api().ajax.reload();
                                } else {
                                    toastr['error'](data.message, '');
                                }

                            }, error: function (xhr) {

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
        });*/

    });
    $(document).on('click', '.readyOrder', function (e) {
        e.preventDefault();
        // var _this = $(this);
        var action = $(this).attr('href');

        $.ajax({
            url: action,
            type: 'GET',
            success: function (data) {
                $("#wait_msg,#overlay").hide();

                $('#results-modals').html(data);
                $('#ready-order').modal('show', { backdrop: 'static', keyboard: false });
            }, error: function (xhr) {

            }
        });
        /*bootbox.dialog({
            message: "Are you sure to accept order (" + constant_name + ")? <span class='label label-danger'> Can not return back...</span>",
            title: "Confirm acceptance !",
            buttons: {

                main: {
                    label: 'Sure <i class="fa fa-check"></i> ',
                    className: "btn-primary",
                    callback: function () {
                        //do something else
                        $.ajax({
                            url: action,
                            type: 'PUT',
                            dataType: 'json',
                            data: {_token: csrf_token},
                            success: function (data) {
                                if (data.status) {
                                    toastr['success'](data.message, '');
                                    new_report_orders_tbl.api().ajax.reload();
                                    current_report_orders_tbl.api().ajax.reload();
                                } else {
                                    toastr['error'](data.message, '');
                                }

                            }, error: function (xhr) {

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
        });*/

    });
    $(document).on('click', '.handoverOrder', function (e) {
        e.preventDefault();
        // var _this = $(this);
        var action = $(this).attr('href');

        $.ajax({
            url: action,
            type: 'GET',
            success: function (data) {
                $("#wait_msg,#overlay").hide();

                $('#results-modals').html(data);
                $('#handover-order').modal('show', { backdrop: 'static', keyboard: false });
            }, error: function (xhr) {

            }
        });
    });
    $(document).on('change', '.delivery_method', function (e) {
        e.preventDefault();
        // var _this = $(this);
        if (this.value == 'my_driver') {
            $('.my_drivers').show();
            $.ajax({
                url: baseURL + '/drivers/1',
                type: 'GET',
                dataType: 'json',
                success: function (data) {

                    var options = '';
                    $.each(data.items, function (i, v) {
                        options += '<option value="' + v.id + '">' + v.username + '</option>';
                    });

                    $('#driver_id').html(options)
                }, error: function (xhr) {

                }
            });
            //
        } else
            $('.my_drivers').hide()

    });
    $(document).on('click', '.cancelOrder', function (e) {
        e.preventDefault();
        var _this = $(this);
        var action = $(this).attr('href');
        var constant_name = _this.closest('tr').find("td:eq(1)").text();

        bootbox.dialog({
            message: "Are you sure to cancel order (" + constant_name + ")? <span class='label label-danger'> Can not return back...</span>",
            title: "Confirm cancellation !",
            buttons: {

                main: {
                    label: 'Sure <i class="fa fa-check"></i> ',
                    className: "btn-primary",
                    callback: function () {
                        //do something else
                        $.ajax({
                            url: action,
                            type: 'PUT',
                            dataType: 'json',
                            data: { _token: csrf_token },
                            success: function (data) {
                                if (data.status) {
                                    toastr['success'](data.message, '');
                                    if (_this.find("#user-orders-tbl").length)
                                        user_orders_tbl.api().ajax.reload();
                                    if (_this.find("#merchant-orders-tbl").length)
                                        merchant_orders_tbl.api().ajax.reload();
                                    if (_this.find("#new_order_tbl").length)
                                        new_order_tbl.api().ajax.reload();
                                    if (_this.find("#current_order_tbl").length)
                                        current_order_tbl.api().ajax.reload();
                                    if (_this.find("#finished_order_tbl").length)
                                        finished_order_tbl.api().ajax.reload();
                                    if (_this.find("#revenue_orders_tbl").length)
                                        revenue_orders_tbl.api().ajax.reload();
                                    if (_this.find("#new_report_orders_tbl").length)
                                        new_report_orders_tbl.api().ajax.reload();
                                    if (_this.find("#current_report_orders_tbl").length)
                                        current_report_orders_tbl.api().ajax.reload();
                                    if (_this.find("#finished_report_orders_tbl").length)
                                        finished_report_orders_tbl.api().ajax.reload();

                                } else {
                                    toastr['error'](data.message, '');
                                }

                            }, error: function (xhr) {

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

    $(document).on("click", ".filter-submit-revenue", function () {
        //                if ($(this).val().length > 3)
        revenue_orders_tbl.api().ajax.reload();
    });
    $(document).on('click', '.filter-cancel-revenue', function () {

        $(".select2").val('').trigger('change');
        $(this).closest('tr').find('input,select').val('');
        // $('#is_admin_confirm,.status').val('').trigger('change');
        revenue_orders_tbl.api().ajax.reload();
    });
    $(document).on("click", ".filter-submit-report-n", function () {
        //                if ($(this).val().length > 3)
        new_report_orders_tbl.api().ajax.reload();
    });
    $(document).on('click', '.filter-cancel-report-n', function () {

        $(".select2").val('').trigger('change');
        $(this).closest('tr').find('input,select').val('');
        // $('#is_admin_confirm,.status').val('').trigger('change');
        new_report_orders_tbl.api().ajax.reload();
    });
    $(document).on("click", ".filter-submit-report-c", function () {
        //                if ($(this).val().length > 3)
        current_report_orders_tbl.api().ajax.reload();
    });
    $(document).on('click', '.filter-cancel-report-c', function () {

        $(".select2").val('').trigger('change');
        $(this).closest('tr').find('input,select').val('');
        // $('#is_admin_confirm,.status').val('').trigger('change');
        current_report_orders_tbl.api().ajax.reload();
    });

    $(document).on("click", ".filter-submit-report-f", function () {
        //                if ($(this).val().length > 3)
        finished_report_orders_tbl.api().ajax.reload();
    });
    $(document).on('click', '.filter-cancel-report-f', function () {

        $(".select2").val('').trigger('change');
        $(this).closest('tr').find('input,select').val('');
        // $('#is_admin_confirm,.status').val('').trigger('change');
        finished_report_orders_tbl.api().ajax.reload();
    });
    $(document).on("click", ".filter-submit", function () {
        //                if ($(this).val().length > 3)
        new_order_tbl.api().ajax.reload();
    });
    $(document).on('click', '.filter-cancel', function () {

        $(".select2").val('').trigger('change');
        $(this).closest('tr').find('input,select').val('');
        // $('#is_admin_confirm,.status').val('').trigger('change');
        new_order_tbl.api().ajax.reload();
    });

    $(document).on('submit', '#formAssignDriver', function (event) {

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
                    $('#assign-driver').modal('hide');


                    if ($("#current_order_tbl").length) {
                        current_order_tbl.api().ajax.reload();
                    }
                    if ($("#merchant-orders-tbl").length) {
                        merchant_orders_tbl.api().ajax.reload();
                    }
                    if ($("#current_report_orders_tbl").length) {
                        current_report_orders_tbl.api().ajax.reload();
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
    $(document).on('submit', '#acceptOrderFrm', function (event) {

        var _this = $(this);
        // var loader = '<i class="fa fa-spinner fa-spin"></i>';
        _this.find('.btn.save i').addClass('fa-spinner fa-spin');
        event.preventDefault(); 
        // Totally stop stuff happening
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
                    $('#accept-order').modal('hide')
                    $('.alert').hide();
                    toastr['success'](data.message, '');
                    current_report_orders_tbl.api().ajax.reload();
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
    $(document).on('submit', '#readyOrderFrm', function (event) {

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
                    $('#ready-order').modal('hide')
                    $('.alert').hide();
                    toastr['success'](data.message, '');
                    current_report_orders_tbl.api().ajax.reload();
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
    $(document).on('submit', '#handoverOrderFrm', function (event) {

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
                    $('#handover-order').modal('hide')
                    $('.alert').hide();
                    toastr['success'](data.message, '');
                    finished_report_orders_tbl.api().ajax.reload();
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

    function createAlert(color) {

        var closeIcon = document.createElement('span');
        closeIcon.setAttribute("aria-hidden", "true");
        var icon = document.createElement('i');
        icon.classList.add('ki', 'ki-close');
        closeIcon.appendChild(icon);

        var closeButton = document.createElement('button');
        closeButton.setAttribute('type', 'button');
        closeButton.classList.add('close');
        closeButton.setAttribute('data-dismiss', 'alert');
        closeButton.setAttribute('aria-label', 'Close');
        closeButton.appendChild(closeIcon);


        var warningIcon = document.createElement('div');
        warningIcon.classList.add('alert-icon');
        var icon = document.createElement('i');
        icon.classList.add('flaticon-warning');
        warningIcon.appendChild(icon);

        var textDiv = document.createElement('div');
        textDiv.classList.add('alert-text');

        var closeDiv = document.createElement('div');
        closeDiv.classList.add('alert-close');
        closeDiv.appendChild(closeButton);

        var alertDiv = document.createElement('div');
        alertDiv.classList.add('alert', 'alert-custom', 'alert-notice', color, 'shadow', 'fade', 'show', 'mx-5', 'col-3', 'position-absolute', 'zindex-5');
        alertDiv.setAttribute('role', 'alert');
        alertDiv.setAttribute('aria-live', 'assertive');
        alertDiv.setAttribute('aria-atomic', 'true');

        alertDiv.appendChild(warningIcon);
        alertDiv.appendChild(textDiv);
        alertDiv.appendChild(closeDiv);

        var row = document.createElement('div');
        row.classList.add('row', 'd-flex', 'flex-row-reverse');
        row.appendChild(alertDiv);

        $("#kt_content").prepend(row);
    }

});
