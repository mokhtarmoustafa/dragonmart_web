<?php $__env->startSection('css'); ?>
<link href="<?php echo e(url('/')); ?>/assets/global/plugins/bootstrap-daterangepicker/daterangepicker.min.css" rel="stylesheet" type="text/css" />
<link href="<?php echo e(url('/')); ?>/assets/global/plugins/morris/morris.css" rel="stylesheet" type="text/css" />
<link href="<?php echo e(url('/')); ?>/assets/global/plugins/fullcalendar/fullcalendar.min.css" rel="stylesheet" type="text/css" />
<link href="<?php echo e(url('/')); ?>/assets/global/plugins/jqvmap/jqvmap/jqvmap.css" rel="stylesheet" type="text/css" />
<!-- END PAGE LEVEL PLUGINS -->

<link href="<?php echo e(url('/')); ?>/assets/global/plugins/datatables/datatables.min.css" rel="stylesheet" type="text/css" />
<link href="<?php echo e(url('/')); ?>/V2/assets/plugins/custom/datatables/datatables.bundle.rtl.css" rel="stylesheet" type="text/css">
<link href="<?php echo e(url('/')); ?>/assets/global/plugins/datatables/plugins/bootstrap/datatables.bootstrap.css" rel="stylesheet" type="text/css" />
<!-- END PAGE LEVEL PLUGINS -->
<!-- BEGIN THEME GLOBAL STYLES -->
<link href="<?php echo e(url('/')); ?>/assets/global/css/plugins-md.min.css" rel="stylesheet" type="text/css" />
<!-- END THEME GLOBAL STYLES -->
<?php $__env->stopSection(); ?>
<?php $__env->startSection('content'); ?>
<div class="row">
    <div class="col-xl-3 col-md-3 col-sm-6 col-xs-12">
        <!--begin::Stats Widget 30-->
        <div class="card card-custom bg-primary card-stretch gutter-b">
            <!--begin::Body-->
            <div class="card-body">
                <span class="svg-icon svg-icon-2x svg-icon-white">
                    <!--begin::Svg Icon | path:/metronic/theme/html/demo1/dist/assets/media/svg/icons/Communication/Group.svg-->
                    <?php $URL = url('/V2/assets/media/svg/icons/Communication/Group.svg');
                    echo file_get_contents($URL); ?>
                    <!--end::Svg Icon-->
                </span>
                <span class="card-title font-weight-bolder text-white font-size-h2 mb-0 mt-6 d-block count_users" data-count="<?php echo e($users_count); ?>"></span>
                
                <span class="font-weight-boldest text-white font-size-h4"><?php echo e(trans(lang_app_site().'.CP.Number of users')); ?></span>
            </div>
            <!--end::Body-->
        </div>
    </div>
    <div class="col-xl-3 col-md-3 col-sm-6 col-xs-12">
        <!--begin::Stats Widget 30-->
        <div class="card card-custom bg-danger card-stretch gutter-b">
            <!--begin::Body-->
            <div class="card-body">
                <span class="svg-icon svg-icon-2x svg-icon-white">
                    <!--begin::Svg Icon | path:/metronic/theme/html/demo1/dist/assets/media/svg/icons/Communication/Group.svg-->
                    <?php $URL = url('/V2/assets/media/svg/icons/Shopping/Cart2.svg');
                    echo file_get_contents($URL); ?>
                    <!--end::Svg Icon-->
                </span>
                <span class="card-title font-weight-bolder text-white font-size-h2 mb-0 mt-6 d-block count_stores" data-count="<?php echo e($merchants_count); ?>"></span>
                <span class="font-weight-bold text-white font-size-sm"><?php echo e(trans(lang_app_site().'.CP.Number of merchants')); ?></span>
            </div>
            <!--end::Body-->
        </div>
    </div>
    <div class="col-xl-3 col-md-3 col-sm-6 col-xs-12">
        <!--begin::Stats Widget 30-->
        <div class="card card-custom bg-success card-stretch gutter-b">
            <!--begin::Body-->
            <div class="card-body">
                <span class="svg-icon svg-icon-2x svg-icon-white">
                    <!--begin::Svg Icon | path:/metronic/theme/html/demo1/dist/assets/media/svg/icons/Communication/Group.svg-->
                    <?php $URL = url('/V2/assets/media/svg/icons/Shopping/Box3.svg');
                    echo file_get_contents($URL); ?>
                    <!--end::Svg Icon-->
                </span>
                <span class="card-title font-weight-bolder text-white font-size-h2 mb-0 mt-6 d-block count_products" data-count="<?php echo e($products_count); ?>"></span>
                <span class="font-weight-bold text-white font-size-sm"><?php echo e(trans(lang_app_site().'.CP.Number of products')); ?></span>
            </div>
            <!--end::Body-->
        </div>
    </div>
    <div class="col-xl-3 col-md-3 col-sm-6 col-xs-12">
        <!--begin::Stats Widget 30-->
        <div class="card card-custom bg-info card-stretch gutter-b">
            <!--begin::Body-->
            <div class="card-body">
                <span class="svg-icon svg-icon-2x svg-icon-white">
                    <!--begin::Svg Icon | path:/metronic/theme/html/demo1/dist/assets/media/svg/icons/Communication/Group.svg-->
                    <?php $URL = url('/V2/assets/media/svg/icons/Shopping/Cart1.svg');
                    echo file_get_contents($URL); ?>
                    <!--end::Svg Icon-->
                </span>
                <span class="card-title font-weight-bolder text-white font-size-h2 mb-0 mt-6 d-block count_orders" data-count="<?php echo e($orders_count); ?>"></span>
                <span class="font-weight-bold text-white font-size-sm"><?php echo e(trans(lang_app_site().'.CP.Number of orders')); ?></span>
            </div>
            <!--end::Body-->
        </div>
    </div>
</div>
<div class="clearfix"></div>
<div class="row">
    <div class="col-lg-12 col-xs-12 col-sm-12 mb-10">
        <div class="card card-custom">
            <div class="card-header">
                <div class="card-title">
                    <i class="icon-bar-chart font-dark hide"></i>
                    <span class="caption-subject font-dark bold uppercase"><?php echo e(trans(lang_app_site().'.CP.Orders')); ?></span>
                    
                </div>
                
                
                
                
                
                
                
                
                
                
                
            </div>
            <div class="card-body">
                <ul class="nav nav-tabs" id="myTab" role="tablist">
                    <li class="nav-item">
                        <a class="nav-link active" href="#tab_1_1" data-toggle="tab">
                            <i class="flaticon2-shopping-cart"></i>
                            &nbsp;
                            <span class="nav-text"><?php echo e(trans(lang_app_site().'.CP.New requests')); ?></span>
                            <span id="new_orders_qty" class="label label-md label-warning">0</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#tab_1_2" data-toggle="tab">
                            <i class="flaticon2-layers-1"></i>
                            &nbsp;
                            <span class="nav-text"><?php echo e(trans(lang_app_site().'.CP.Current Requests')); ?></span>
                            <span id="current_orders_qty" class="label label-md label-success">0</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#tab_1_3" data-toggle="tab">
                            <i class="flaticon2-layers-1"></i>
                            &nbsp;
                            <span class="nav-text"><?php echo e(trans(lang_app_site().'.CP.Completed Requests')); ?> </span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#tab_1_4" data-toggle="tab">
                            <i class="flaticon2-layers-1"></i>
                            &nbsp;
                            <span class="nav-text"><?php echo e(trans(lang_app_site().'.CP.Rejected Requests')); ?></span>
                            <span id="rejected_orders_qty" class="label label-md label-danger">0</span>
                        </a>
                    </li>
                </ul>
                <div class="tab-content p-5 bg-white">
                    <div class="tab-pane fade active show" id="tab_1_1">

                        <div class="portlet-body form table-responsive">
                            <table class="table table-striped table-hover table-checkable order-column" id="new_order_tbl">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th> <?php echo e(trans(lang_app_site().'.CP.Order #')); ?></th>
                                        <th> <?php echo e(trans(lang_app_site().'.CP.Merchant')); ?></th>
                                        <th> <?php echo e(trans(lang_app_site().'.CP.Order date')); ?></th>
                                        <th> <?php echo e(trans(lang_app_site().'.CP.Order time')); ?></th>
                                        <th> <?php echo e(trans(lang_app_site().'.CP.Delivery/pickup date')); ?></th>
                                        <th> <?php echo e(trans(lang_app_site().'.CP.Items #')); ?></th>
                                        <th> <?php echo e(trans(lang_app_site().'.CP.Procurement method')); ?></th>
                                        
                                        <th> <?php echo e(trans(lang_app_site().'.CP.Order amount (SAR)')); ?></th>
                                        
                                        
                                        <th> <?php echo e(trans(lang_app_site().'.CP.Action')); ?></th>
                                    </tr>

                                    
                                    
                                    
                                    
                                    
                                    
                                    
                                    
                                    
                                    
                                    
                                    
                                    

                                    
                                </thead>
                            </table>
                        </div>
                    </div>
                    <div class="tab-pane fade" id="tab_1_2">

                        <div class="portlet-body form table-responsive">
                            <table class="table table-striped table-bordered table-hover table-checkable order-column" id="current_order_tbl">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th> <?php echo e(trans(lang_app_site().'.CP.Order #')); ?></th>
                                        <th> <?php echo e(trans(lang_app_site().'.CP.Merchant')); ?></th>
                                        <th> <?php echo e(trans(lang_app_site().'.CP.Order date')); ?></th>
                                        <th> <?php echo e(trans(lang_app_site().'.CP.Delivery/pickup date')); ?></th>
                                        <th> <?php echo e(trans(lang_app_site().'.CP.Items #')); ?></th>
                                        <th> <?php echo e(trans(lang_app_site().'.CP.Procurement method')); ?></th>
                                        <th> <?php echo e(trans(lang_app_site().'.CP.Delivery method')); ?></th>
                                        <th> <?php echo e(trans(lang_app_site().'.CP.Driver name')); ?></th>
                                        <th> <?php echo e(trans(lang_app_site().'.CP.Order amount (SAR)')); ?></th>
                                        <th> <?php echo e(trans(lang_app_site().'.CP.Shipping rate (SAR)')); ?></th>
                                        <th> <?php echo e(trans(lang_app_site().'.CP.Action')); ?></th>
                                    </tr>
                                    
                                    
                                    
                                    
                                    
                                    
                                    
                                    
                                    
                                    
                                    
                                    
                                    
                                    
                                </thead>
                            </table>
                        </div>
                    </div>
                    <div class="tab-pane fade" id="tab_1_3">

                        <div class="portlet-body form table-responsive">
                            <table class="table table-striped table-bordered table-hover table-checkable order-column" id="finished_order_tbl">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th> <?php echo e(trans(lang_app_site().'.CP.Order #')); ?></th>
                                        <th> <?php echo e(trans(lang_app_site().'.CP.Merchant')); ?></th>
                                        <th> <?php echo e(trans(lang_app_site().'.CP.Order date')); ?></th>
                                        <th> <?php echo e(trans(lang_app_site().'.CP.Delivery/pickup date')); ?></th>
                                        <th> <?php echo e(trans(lang_app_site().'.CP.Actual receive date')); ?></th>
                                        <th> <?php echo e(trans(lang_app_site().'.CP.Items #')); ?></th>
                                        <th> <?php echo e(trans(lang_app_site().'.CP.Procurement method')); ?></th>
                                        <th> <?php echo e(trans(lang_app_site().'.CP.Delivery method')); ?></th>
                                        <th> <?php echo e(trans(lang_app_site().'.CP.Driver name')); ?></th>
                                        <th> <?php echo e(trans(lang_app_site().'.CP.Order amount (SAR)')); ?></th>
                                        <th> <?php echo e(trans(lang_app_site().'.CP.Shipping rate (SAR)')); ?></th>
                                        <th> <?php echo e(trans(lang_app_site().'.CP.Action')); ?></th>
                                    </tr>
                                    
                                    
                                    
                                    
                                    
                                    
                                    
                                    
                                    
                                    
                                    
                                    
                                    
                                    
                                </thead>
                            </table>
                        </div>
                    </div>
                    <div class="tab-pane fade" id="tab_1_4">

                        <div class="portlet-body form table-responsive">
                            <table class="table table-striped table-bordered table-hover table-checkable order-column" id="rejected_order_tbl">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th> <?php echo e(trans(lang_app_site().'.CP.Order #')); ?></th>
                                        <th> <?php echo e(trans(lang_app_site().'.CP.Merchant')); ?></th>
                                        <th> <?php echo e(trans(lang_app_site().'.CP.Order date')); ?></th>
                                        <th> <?php echo e(trans(lang_app_site().'.CP.Delivery/pickup date')); ?></th>
                                        <th> <?php echo e(trans(lang_app_site().'.CP.Actual receive date')); ?></th>
                                        <th> <?php echo e(trans(lang_app_site().'.CP.Items #')); ?></th>
                                        <th> <?php echo e(trans(lang_app_site().'.CP.Procurement method')); ?></th>
                                        <th> <?php echo e(trans(lang_app_site().'.CP.Delivery method')); ?></th>
                                        <th> <?php echo e(trans(lang_app_site().'.CP.Driver name')); ?></th>
                                        <th> <?php echo e(trans(lang_app_site().'.CP.Order amount (SAR)')); ?></th>
                                        <th> <?php echo e(trans(lang_app_site().'.CP.Shipping rate (SAR)')); ?></th>
                                        <th> <?php echo e(trans(lang_app_site().'.CP.Action')); ?></th>
                                    </tr>
                                </thead>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="clearfix"></div>
<!-- END DASHBOARD STATS 1-->
<!-- <div class="row">
    <div class="col-lg-6 col-xs-12 col-sm-12">

        <div class="portlet light bordered">
            <div class="portlet-title">
                <div class="caption">
                    <i class="icon-bar-chart font-dark hide"></i>
                    <span class="caption-subject font-dark bold uppercase"><?php echo e(trans(lang_app_site().'.CP.Orders per cities')); ?></span>
                </div>

            </div>
            <div class="portlet-body">
                <div id="site_orders_cities_loading">
                    <img src="<?php echo e(url('/')); ?>/assets/global/img/loading.gif" alt="loading" /></div>
                <div id="site_orders_cities_content" class="display-none">
                    <div id="site_orders_cities" class="chart"></div>
                </div>
            </div>
        </div>

    </div>
    <div class="col-lg-6 col-xs-12 col-sm-12">

        <div class="portlet light bordered">
            <div class="portlet-title">
                <div class="caption">
                    <i class="icon-share font-red-sunglo hide"></i>
                    <span class="caption-subject font-dark bold uppercase"><?php echo e(trans(lang_app_site().'.CP.Revenue')); ?></span>
                    
                </div>
            </div>
            <div class="portlet-body">
                <div id="site_revenue_loading">
                    <img src="<?php echo e(url('/')); ?>/assets/global/img/loading.gif" alt="loading" /></div>
                <div id="site_revenue_content" class="display-none">
                    <div id="site_revenue" style="height: 300px;"></div>
                </div>

            </div>
        </div>

    </div>
</div>
<div class="row">
    <div class="col-lg-6 col-xs-12 col-sm-12">

        <div class="portlet light bordered">
            <div class="portlet-title">
                <div class="caption">
                    <i class="icon-bar-chart font-dark hide"></i>
                    <span class="caption-subject font-dark bold uppercase"><?php echo e(trans(lang_app_site().'.CP.Latest merchants')); ?></span>
                </div>

            </div>
            <div class="portlet-body">
                <div id="site_latest_merchant_loading">
                    <img src="<?php echo e(url('/')); ?>/assets/global/img/loading.gif" alt="loading" /></div>
                <div id="site_latest_merchant_content" class="display-none">
                    <div id="site_latest_merchant" class="chart"></div>
                </div>
            </div>
        </div>

    </div>
    <div class="col-lg-6 col-xs-12 col-sm-12">

        <div class="portlet light ">
            <div class="portlet-title">
                <div class="caption">
                    <i class="icon-bar-chart font-dark hide"></i>
                    <span class="caption-subject font-dark bold uppercase"><?php echo e(trans(lang_app_site().'.CP.New product')); ?></span>
                    
                </div>

            </div>
            <div class="portlet-body">
                <div id="site_new_product_loading">
                    <img src="<?php echo e(url('/')); ?>/assets/global/img/loading.gif" alt="loading" /></div>
                <div id="site_new_product_content" class="display-none">
                    <div id="site_new_product" class="chart"></div>
                </div>
            </div>
        </div>

    </div>
</div> -->
<?php $__env->stopSection(); ?>
<?php $__env->startSection('js'); ?>
<script src="<?php echo e(url('/')); ?>/assets/global/plugins/moment.min.js" type="text/javascript"></script>
<script src="<?php echo e(url('/')); ?>/assets/global/plugins/bootstrap-daterangepicker/daterangepicker.min.js" type="text/javascript"></script>
<script src="<?php echo e(url('/')); ?>/assets/global/plugins/morris/morris.min.js" type="text/javascript"></script>
<script src="<?php echo e(url('/')); ?>/assets/global/plugins/morris/raphael-min.js" type="text/javascript"></script>
<script src="<?php echo e(url('/')); ?>/assets/global/plugins/counterup/jquery.waypoints.min.js" type="text/javascript"></script>
<script src="<?php echo e(url('/')); ?>/assets/global/plugins/counterup/jquery.counterup.min.js" type="text/javascript"></script>
<script src="<?php echo e(url('/')); ?>/assets/global/plugins/amcharts/amcharts/amcharts.js" type="text/javascript"></script>
<script src="<?php echo e(url('/')); ?>/assets/global/plugins/amcharts/amcharts/serial.js" type="text/javascript"></script>
<script src="<?php echo e(url('/')); ?>/assets/global/plugins/amcharts/amcharts/pie.js" type="text/javascript"></script>
<script src="<?php echo e(url('/')); ?>/assets/global/plugins/amcharts/amcharts/radar.js" type="text/javascript"></script>
<script src="<?php echo e(url('/')); ?>/assets/global/plugins/amcharts/amcharts/themes/light.js" type="text/javascript"></script>
<script src="<?php echo e(url('/')); ?>/assets/global/plugins/amcharts/amcharts/themes/patterns.js" type="text/javascript"></script>
<script src="<?php echo e(url('/')); ?>/assets/global/plugins/amcharts/amcharts/themes/chalk.js" type="text/javascript"></script>
<script src="<?php echo e(url('/')); ?>/assets/global/plugins/amcharts/ammap/ammap.js" type="text/javascript"></script>
<script src="<?php echo e(url('/')); ?>/assets/global/plugins/amcharts/ammap/maps/js/worldLow.js" type="text/javascript"></script>
<script src="<?php echo e(url('/')); ?>/assets/global/plugins/amcharts/amstockcharts/amstock.js" type="text/javascript"></script>
<script src="<?php echo e(url('/')); ?>/assets/global/plugins/fullcalendar/fullcalendar.min.js" type="text/javascript"></script>
<script src="<?php echo e(url('/')); ?>/assets/global/plugins/horizontal-timeline/horizontal-timeline.js" type="text/javascript"></script>
<script src="<?php echo e(url('/')); ?>/assets/global/plugins/flot/jquery.flot.min.js" type="text/javascript"></script>
<script src="<?php echo e(url('/')); ?>/assets/global/plugins/flot/jquery.flot.resize.min.js" type="text/javascript"></script>
<script src="<?php echo e(url('/')); ?>/assets/global/plugins/flot/jquery.flot.categories.min.js" type="text/javascript"></script>
<script src="<?php echo e(url('/')); ?>/assets/global/plugins/jquery-easypiechart/jquery.easypiechart.min.js" type="text/javascript"></script>
<!-- END PAGE LEVEL PLUGINS -->

<!-- <script src="<?php echo e(url('/')); ?>/assets/global/scripts/datatable.js" type="text/javascript"></script> -->
<!-- <script src="<?php echo e(url('/')); ?>/assets/global/plugins/datatables/datatables.min.js" type="text/javascript"></script> -->
<script src="url('/')}}/V2/assets/plugins/custom/datatables/datatables.bundle.js" type="text/javascript"></script>
<!-- <script src="<?php echo e(url('/')); ?>/assets/global/plugins/datatables/plugins/bootstrap/datatables.bootstrap.js" type="text/javascript"></script> -->
<!-- BEGIN THEME GLOBAL SCRIPTS -->
<script src="<?php echo e(url('/')); ?>/assets/global/scripts/app.min.js" type="text/javascript"></script>
<!-- END THEME GLOBAL SCRIPTS -->
<!-- <script src="<?php echo e(url('/')); ?>/assets/pages/scripts/table-datatables-responsive.min.js" type="text/javascript"></script> -->
<!-- BEGIN PAGE LEVEL SCRIPTS -->

<script src="<?php echo e(url('/')); ?>/assets/js/users.js" type="text/javascript"></script>
<script src="<?php echo e(url('/')); ?>/assets/js/orders.js" type="text/javascript"></script>
<script type="text/javascript">
  $(document).ready(function() {
        init();
        //     $(document).on('click', '.applyBtn,.ranges li', function () {
        //         init();
        //
        //     });
        //

    IncremtNumber(".count_users");
    IncremtNumber(".count_stores");
    IncremtNumber(".count_products");
    IncremtNumber(".count_orders");

    });
</script>

<script type="text/javascript" src="https://maps.googleapis.com/maps/api/js?key=<?php echo e(google_api_key()); ?>"></script>
<script>
    function myMap(address, lat, long) {

        var myLatLng = {
            lat: Number(lat),
            lng: Number(long)
        };


        var map = new google.maps.Map(document.getElementById("map"), {
            zoom: 4,
            center: myLatLng,

            gestureHandling: 'cooperative'
        });

        map.setOptions({
            scrollwheel: false
        });


        var marker = new google.maps.Marker({
            position: myLatLng,
            map: map,
            title: address
        });
    }
</script>
<script>
    $(document).ready(function() {
        init();
        //     $(document).on('click', '.applyBtn,.ranges li', function () {
        //         init();
        //
        //     });
        //

        IncremtNumber(".count_users");
    IncremtNumber(".count_stores");
    IncremtNumber(".count_products");
    IncremtNumber(".count_orders");

    });

    function init() {
        // var DELIVERABLE_DATE_F = $("input[name='daterangepicker_start']").val();
        // var DELIVERABLE_DATE_T = $("input[name='daterangepicker_end']").val();
        var t1 = [];
        var t2 = [];
        var t3 = [];
        var t4 = [];
        // if (0 != $("#site_orders_cities").size()) {

        $.ajax({
            url: baseURL + '/orders-cities',
            type: 'POST',
            dataType: 'json',
            data: {
                _token: csrf_token,
                // DELIVERABLE_DATE_F: DELIVERABLE_DATE_F,
                // DELIVERABLE_DATE_T: DELIVERABLE_DATE_T
            },
            success: function(data) {

                $.each(data.items, function(i, v) {
                    if (v.name_en == null)
                        v.name_en = "unKnown cities";
                    t1.push([v.name_en, v.count]);
                });
                $("#site_orders_cities_loading").hide(), $("#site_orders_cities_content").show();
                var a = ($.plot($("#site_orders_cities"), [{
                    data: t1,
                    lines: {
                        fill: .6,
                        lineWidth: 0
                    },
                    color: ["#f89f9f"]
                }, {
                    data: t1,
                    points: {
                        show: !0,
                        fill: !0,
                        radius: 5,
                        fillColor: "#f89f9f",
                        lineWidth: 3
                    },
                    color: "#fff",
                    shadowSize: 0
                }], {
                    xaxis: {
                        tickLength: 0,
                        tickDecimals: 0,
                        mode: "categories",
                        min: 0,
                        font: {
                            lineHeight: 14,
                            style: "normal",
                            variant: "small-caps",
                            color: "#6F7B8A"
                        }
                    },
                    yaxis: {
                        ticks: 5,
                        tickDecimals: 0,
                        tickColor: "#eee",
                        font: {
                            lineHeight: 14,
                            style: "normal",
                            variant: "small-caps",
                            color: "#6F7B8A"
                        }
                    },
                    grid: {
                        hoverable: !0,
                        clickable: !0,
                        tickColor: "#eee",
                        borderColor: "#eee",
                        borderWidth: 1
                    }
                }), null);
                $("#site_orders_cities").bind("plothover", function(t, i, l) {
                    if ($("#x").text(i.x.toFixed(2)), $("#y").text(i.y.toFixed(2)), l) {
                        if (a != l.dataIndex) {
                            a = l.dataIndex, $("#tooltip").remove();
                            l.datapoint[0].toFixed(2), l.datapoint[1].toFixed(2);
                            e(l.pageX, l.pageY, l.datapoint[0], l.datapoint[1] + " counts")
                        }
                    } else $("#tooltip").remove(), a = null
                })
            }
        });
        $.ajax({
            url: baseURL + '/new-products',
            type: 'POST',
            dataType: 'json',
            data: {
                _token: csrf_token,
                // DELIVERABLE_DATE_F: DELIVERABLE_DATE_F,
                // DELIVERABLE_DATE_T: DELIVERABLE_DATE_T
            },
            success: function(data) {

                $.each(data.items, function(i, v) {
                    t4.push([v.d + '/' + v.year, v.count]);
                });
                $("#site_new_product_loading").hide(), $("#site_new_product_content").show();
                var a = ($.plot($("#site_new_product"), [{
                    data: t4,
                    lines: {
                        fill: .6,
                        lineWidth: 0
                    },
                    color: ["#f89f9f"]
                }, {
                    data: t4,
                    points: {
                        show: !0,
                        fill: !0,
                        radius: 5,
                        fillColor: "#f89f9f",
                        lineWidth: 3
                    },
                    color: "#fff",
                    shadowSize: 0
                }], {
                    xaxis: {
                        tickLength: 0,
                        tickDecimals: 0,
                        mode: "categories",
                        min: 0,
                        font: {
                            lineHeight: 14,
                            style: "normal",
                            variant: "small-caps",
                            color: "#6F7B8A"
                        }
                    },
                    yaxis: {
                        ticks: 5,
                        tickDecimals: 0,
                        tickColor: "#eee",
                        font: {
                            lineHeight: 14,
                            style: "normal",
                            variant: "small-caps",
                            color: "#6F7B8A"
                        }
                    },
                    grid: {
                        hoverable: !0,
                        clickable: !0,
                        tickColor: "#eee",
                        borderColor: "#eee",
                        borderWidth: 1
                    }
                }), null);
                $("#site_new_product").bind("plothover", function(t, i, l) {
                    if ($("#x").text(i.x.toFixed(2)), $("#y").text(i.y.toFixed(2)), l) {
                        if (a != l.dataIndex) {
                            a = l.dataIndex, $("#tooltip").remove();
                            l.datapoint[0].toFixed(2), l.datapoint[1].toFixed(2);
                            e(l.pageX, l.pageY, l.datapoint[0], l.datapoint[1] + " counts")
                        }
                    } else $("#tooltip").remove(), a = null
                })
            }
        });
        $.ajax({
            url: baseURL + '/latest-merchants',
            type: 'POST',
            dataType: 'json',
            data: {
                _token: csrf_token,
                // DELIVERABLE_DATE_F: DELIVERABLE_DATE_F,
                // DELIVERABLE_DATE_T: DELIVERABLE_DATE_T
            },
            success: function(data) {

                $.each(data.items, function(i, v) {
                    t3.push([v.d + '/' + v.year, v.count]);
                });
                $("#site_latest_merchant_loading").hide(), $("#site_latest_merchant_content").show();
                var a = ($.plot($("#site_latest_merchant"), [{
                    data: t3,
                    lines: {
                        fill: .6,
                        lineWidth: 0
                    },
                    color: ["#9ACAE6"]
                }, {
                    data: t3,
                    points: {
                        show: !0,
                        fill: !0,
                        radius: 5,
                        fillColor: "#9ACAE6",
                        lineWidth: 3
                    },
                    color: "#fff",
                    shadowSize: 0
                }], {
                    xaxis: {
                        tickLength: 0,
                        tickDecimals: 0,
                        mode: "categories",
                        min: 0,
                        font: {
                            lineHeight: 14,
                            style: "normal",
                            variant: "small-caps",
                            color: "#6F7B8A"
                        }
                    },
                    yaxis: {
                        ticks: 5,
                        tickDecimals: 0,
                        tickColor: "#eee",
                        font: {
                            lineHeight: 14,
                            style: "normal",
                            variant: "small-caps",
                            color: "#6F7B8A"
                        }
                    },
                    grid: {
                        hoverable: !0,
                        clickable: !0,
                        tickColor: "#eee",
                        borderColor: "#eee",
                        borderWidth: 1
                    }
                }), null);
                $("#site_latest_merchant").bind("plothover", function(t, i, l) {
                    if ($("#x").text(i.x.toFixed(2)), $("#y").text(i.y.toFixed(2)), l) {
                        if (a != l.dataIndex) {
                            a = l.dataIndex, $("#tooltip").remove();
                            l.datapoint[0].toFixed(2), l.datapoint[1].toFixed(2);
                            e(l.pageX, l.pageY, l.datapoint[0], l.datapoint[1] + " counts")
                        }
                    } else $("#tooltip").remove(), a = null
                })
            }
        });
        $.ajax({
            url: baseURL + '/revenue-orders',
            type: 'POST',
            dataType: 'json',
            data: {
                _token: csrf_token,
                // DELIVERABLE_DATE_F: DELIVERABLE_DATE_F,
                // DELIVERABLE_DATE_T: DELIVERABLE_DATE_T
            },
            success: function(data) {

                $.each(data.items, function(i, v) {
                    t2.push([v.d + '/' + v.year, v.revenue_]);
                });
                $("#site_revenue_loading").hide(), $("#site_revenue_content").show();
                var a = ($.plot($("#site_revenue"), [{
                    data: t2,
                    lines: {
                        fill: .6,
                        lineWidth: 0
                    },
                    color: ["#9ACAE6"]
                }, {
                    data: t2,
                    points: {
                        show: !0,
                        fill: !0,
                        radius: 5,
                        fillColor: "#9ACAE6",
                        lineWidth: 3
                    },
                    color: "#fff",
                    shadowSize: 0
                }], {
                    xaxis: {
                        tickLength: 0,
                        tickDecimals: 0,
                        mode: "categories",
                        min: 0,
                        font: {
                            lineHeight: 14,
                            style: "normal",
                            variant: "small-caps",
                            color: "#6F7B8A"
                        }
                    },
                    yaxis: {
                        ticks: 5,
                        tickDecimals: 0,
                        tickColor: "#eee",
                        font: {
                            lineHeight: 14,
                            style: "normal",
                            variant: "small-caps",
                            color: "#6F7B8A"
                        }
                    },
                    grid: {
                        hoverable: !0,
                        clickable: !0,
                        tickColor: "#eee",
                        borderColor: "#eee",
                        borderWidth: 1
                    }
                }), null);
                $("#site_revenue").bind("plothover", function(t, i, l) {
                    if ($("#x").text(i.x.toFixed(2)), $("#y").text(i.y.toFixed(2)), l) {
                        if (a != l.dataIndex) {
                            a = l.dataIndex, $("#tooltip").remove();
                            l.datapoint[0].toFixed(2), l.datapoint[1].toFixed(2);
                            e(l.pageX, l.pageY, l.datapoint[0], l.datapoint[1] + " SAR")
                        }
                    } else $("#tooltip").remove(), a = null
                })
            }
        });
        // }
    }

    function e(e, t, a, i) {
        $('<div id="tooltip" class="chart-tooltip">' + i + "</div>").css({
            position: "absolute",
            display: "none",
            top: t - 40,
            left: e - 40,
            border: "0px solid #ccc",
            padding: "2px 6px",
            "background-color": "#fff"
        }).appendTo("body").fadeIn(200)
    }

    function TickGenerator(axis) {
        var res = [],
            i = Math.floor(axis.min);
        do {
            res.push([i, "some-large-string-value-" + i]);
            ++i;
        } while (i < axis.max);
        return res;
    }
    
</script>


<!-- END PAGE LEVEL SCRIPTS -->
<?php $__env->stopSection(); ?>
<?php echo $__env->make('admin.layout.index', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/saudidragonmart/public_html/resources/views/admin/home.blade.php ENDPATH**/ ?>