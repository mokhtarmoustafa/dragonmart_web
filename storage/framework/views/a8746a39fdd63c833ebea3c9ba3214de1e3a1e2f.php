<?php $__env->startSection('css'); ?>
    <link href="<?php echo e(url('/')); ?>/assets/global/plugins/bootstrap-daterangepicker/daterangepicker.min.css" rel="stylesheet"
          type="text/css"/>
    <link href="<?php echo e(url('/')); ?>/assets/global/plugins/morris/morris.css" rel="stylesheet" type="text/css"/>
    <link href="<?php echo e(url('/')); ?>/assets/global/plugins/fullcalendar/fullcalendar.min.css" rel="stylesheet" type="text/css"/>
    <link href="<?php echo e(url('/')); ?>/assets/global/plugins/jqvmap/jqvmap/jqvmap.css" rel="stylesheet" type="text/css"/>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.3/Chart.min.css" rel="stylesheet" type="text/css"/>
    <!-- END PAGE LEVEL PLUGINS -->

    <style>
    </style>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('content'); ?>

    <div class="row">
        <div class="col-lg-4 col-md-4 col-sm-6 col-xs-12">
            <a class="dashboard-stat dashboard-stat-v2 blue" href="#">
                <div class="visual">
                    <i class="fa fa-comments"></i>
                </div>
                <div class="details">
                    <div class="number">
                        <span data-counter="counterup" data-value="<?php echo e($new_orders); ?>">0</span>
                    </div>
                    <div class="desc"><?php echo e(trans(lang_app_site().'.CP.New orders')); ?></div>
                </div>
            </a>
        </div>
        <div class="col-lg-4 col-md-4 col-sm-6 col-xs-12">
            <a class="dashboard-stat dashboard-stat-v2 red" href="#">
                <div class="visual">
                    <i class="fa fa-bar-chart-o"></i>
                </div>
                <div class="details">
                    <div class="number">
                        <span data-counter="counterup" data-value="<?php echo e($current_orders); ?>">0</span>
                    </div>
                    <div class="desc"><?php echo e(trans(lang_app_site().'.CP.Current orders')); ?></div>
                </div>
            </a>
        </div>
        <div class="col-lg-4 col-md-4 col-sm-6 col-xs-12">
            <a class="dashboard-stat dashboard-stat-v2 green" href="#">
                <div class="visual">
                    <i class="fa fa-shopping-cart"></i>
                </div>
                <div class="details">
                    <div class="number">
                        <span data-counter="counterup" data-value="<?php echo e($completed_orders); ?>">0</span>
                    </div>
                    <div class="desc"><?php echo e(trans(lang_app_site().'.CP.Completed orders')); ?></div>
                </div>
            </a>
        </div>
    </div>
    <div class="clearfix"></div>

    <!-- END DASHBOARD STATS 1-->
    <div class="row">
        <div class="col-md-12">
            <!-- BEGIN MARKERS PORTLET-->
            <div class="portlet light portlet-fit ">
                <div class="portlet-title">
                    <div class="caption">
                        <i class=" icon-layers font-blue"></i>
                        <span class="caption-subject font-blue bold uppercase"><?php echo e(trans(lang_app_site().'.CP.Shop Location')); ?></span>
                    </div>
                    
                    
                    
                    
                    
                    
                    
                    
                    
                    
                    
                </div>
                <div class="portlet-body">
                    <div id="gmap_marker" class="gmaps"></div>
                </div>
            </div>
            <!-- END MARKERS PORTLET-->
        </div>
    </div>
    <div class="row">
        <div class="col-lg-6 col-xs-12 col-sm-12">
            <!-- BEGIN PORTLET-->
            <div class="portlet light bordered">
                <div class="portlet-title">
                    <div class="caption">
                        <i class="icon-bar-chart font-dark hide"></i>
                        <span class="caption-subject font-dark bold uppercase"><?php echo e(trans(lang_app_site().'.CP.Top selling')); ?></span>
                    </div>

                </div>
                <div class="portlet-body">
                    <div id="site_top_selling_content">

                        <canvas id="site_top_selling" width="400" height="400"></canvas>
                    </div>
                </div>
            </div>
            <!-- END PORTLET-->
        </div>
        <div class="col-lg-6 col-xs-12 col-sm-12">
            <!-- BEGIN PORTLET-->
            <div class="portlet light ">
                <div class="portlet-title">
                    <div class="caption">
                        <i class="icon-bar-chart font-dark hide"></i>
                        <span class="caption-subject font-dark bold uppercase"><?php echo e(trans(lang_app_site().'.CP.Order per city')); ?> </span>
                        
                    </div>

                </div>
                <div class="portlet-body">
                    
                    
                    
                    
                    
                    <canvas id="site_orders_cities" width="400" height="400"></canvas>

                </div>
            </div>
            <!-- END PORTLET-->
        </div>

    </div>
    <div class="row">
        <div class="col-lg-6 col-xs-12 col-sm-12">
            <!-- BEGIN PORTLET-->
            <div class="portlet light bordered">
                <div class="portlet-title">
                    <div class="caption">
                        <i class="icon-bar-chart font-dark hide"></i>
                        <span class="caption-subject font-dark bold uppercase"><?php echo e(trans(lang_app_site().'.CP.Active drivers')); ?></span>
                    </div>

                </div>
                <div class="portlet-body">
                    <table class="table table-striped table-bordered table-hover table-checkable order-column"
                           id="active_drivers_tbl">
                        <thead>
                        <tr>
                            <th>#</th>
                            <th><?php echo e(trans(lang_app_site().'.CP.Driver name')); ?></th>
                            <th><?php echo e(trans(lang_app_site().'.CP.No. Of Orders')); ?></th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php $__currentLoopData = $active_drivers; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $driver): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <tr>
                                <td><?php echo e($loop->iteration); ?></td>
                                <td>
                                    <a href="<?php echo e(url(getAuth()->type.'/user-det/'.$driver->driver_id)); ?>"><?php echo e($driver->username); ?></a>
                                </td>
                                <td><?php echo e($driver->count); ?></td>
                            </tr>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </tbody>
                    </table>

                </div>
            </div>
            <!-- END PORTLET-->
        </div>
        <div class="col-lg-6 col-xs-12 col-sm-12">
            <!-- BEGIN PORTLET-->
            <div class="portlet light bordered">
                <div class="portlet-title">
                    <div class="caption">
                        <i class="icon-share font-red-sunglo hide"></i>
                        <span class="caption-subject font-dark bold uppercase"><?php echo e(trans(lang_app_site().'.CP.Sales per month')); ?></span>
                        
                    </div>
                </div>
                <div class="portlet-body">
                    <div id="site_sales_loading">
                        <img src="<?php echo e(url('/')); ?>/assets/global/img/loading.gif" alt="loading"/></div>
                    <div id="site_sales_content" class="display-none">
                        <div id="site_sales" style="height: 400px;"></div>
                    </div>

                </div>
            </div>
            <!-- END PORTLET-->
        </div>
    </div>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('js'); ?>
    <script src="<?php echo e(url('/')); ?>/assets/global/plugins/moment.min.js" type="text/javascript"></script>
    <script src="<?php echo e(url('/')); ?>/assets/global/plugins/bootstrap-daterangepicker/daterangepicker.min.js"
            type="text/javascript"></script>
    <script src="<?php echo e(url('/')); ?>/assets/global/plugins/morris/morris.min.js" type="text/javascript"></script>
    <script src="<?php echo e(url('/')); ?>/assets/global/plugins/morris/raphael-min.js" type="text/javascript"></script>
    <script src="<?php echo e(url('/')); ?>/assets/global/plugins/counterup/jquery.waypoints.min.js" type="text/javascript"></script>
    <script src="<?php echo e(url('/')); ?>/assets/global/plugins/counterup/jquery.counterup.min.js" type="text/javascript"></script>
    <script src="<?php echo e(url('/')); ?>/assets/global/plugins/amcharts/amcharts/amcharts.js" type="text/javascript"></script>
    <script src="<?php echo e(url('/')); ?>/assets/global/plugins/amcharts/amcharts/serial.js" type="text/javascript"></script>
    <script src="<?php echo e(url('/')); ?>/assets/global/plugins/amcharts/amcharts/pie.js" type="text/javascript"></script>
    <script src="<?php echo e(url('/')); ?>/assets/global/plugins/amcharts/amcharts/radar.js" type="text/javascript"></script>
    <script src="<?php echo e(url('/')); ?>/assets/global/plugins/amcharts/amcharts/themes/light.js" type="text/javascript"></script>
    <script src="<?php echo e(url('/')); ?>/assets/global/plugins/amcharts/amcharts/themes/patterns.js"
            type="text/javascript"></script>
    <script src="<?php echo e(url('/')); ?>/assets/global/plugins/amcharts/amcharts/themes/chalk.js" type="text/javascript"></script>
    <script src="<?php echo e(url('/')); ?>/assets/global/plugins/amcharts/ammap/ammap.js" type="text/javascript"></script>
    <script src="<?php echo e(url('/')); ?>/assets/global/plugins/amcharts/ammap/maps/js/worldLow.js" type="text/javascript"></script>
    <script src="<?php echo e(url('/')); ?>/assets/global/plugins/amcharts/amstockcharts/amstock.js" type="text/javascript"></script>
    <script src="<?php echo e(url('/')); ?>/assets/global/plugins/fullcalendar/fullcalendar.min.js" type="text/javascript"></script>
    <script src="<?php echo e(url('/')); ?>/assets/global/plugins/horizontal-timeline/horizontal-timeline.js"
            type="text/javascript"></script>
    <script src="<?php echo e(url('/')); ?>/assets/global/plugins/flot/jquery.flot.min.js" type="text/javascript"></script>
    <script src="<?php echo e(url('/')); ?>/assets/global/plugins/flot/jquery.flot.resize.min.js" type="text/javascript"></script>
    <script src="<?php echo e(url('/')); ?>/assets/global/plugins/flot/jquery.flot.categories.min.js" type="text/javascript"></script>
    <script src="<?php echo e(url('/')); ?>/assets/global/plugins/jquery-easypiechart/jquery.easypiechart.min.js"
            type="text/javascript"></script>
    <!-- END PAGE LEVEL PLUGINS -->
    <!-- BEGIN THEME GLOBAL SCRIPTS -->
    <script src="<?php echo e(url('/')); ?>/assets/global/scripts/app.min.js" type="text/javascript"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.3/Chart.min.js" type="text/javascript"></script>
    <!-- END THEME GLOBAL SCRIPTS -->
    <!-- BEGIN PAGE LEVEL SCRIPTS -->
    

    <script src="http://maps.google.com/maps/api/js?key=<?php echo e(google_api_key()); ?>"
            type="text/javascript"></script>
    <!-- END PAGE LEVEL SCRIPTS -->

    <script>
        $(function () {

            function mapLocation() {
                var directionsDisplay;
                // var directionsService = new google.maps.DirectionsService();
                var map;

                function initialize() {//,
                    directionsDisplay = new google.maps.DirectionsRenderer();
                    var latlong = new google.maps.LatLng('<?php echo e(auth()->guard('admin')->user()->Merchant->latitude ?? 24.5541554744); ?>', '<?php echo e(auth()->guard('admin')->user()->Merchant->longitude ?? 42.5585888888); ?>');
                    var mapOptions = {
                        zoom: 12,
                        center: latlong
                    };
                    map = new google.maps.Map(document.getElementById('gmap_marker'), mapOptions);
                    directionsDisplay.setMap(map);

                    var marker = new google.maps.Marker({
                        position: latlong,
                        title: 'new marker',
                        draggable: true,
                        map: map
                    });
                    //calcRoute()
                }

                
                
                
                
                
                
                
                
                
                
                
                
                
                
                
                
                

                google.maps.event.addDomListener(window, 'load', initialize);
            }

            mapLocation();


        });


    </script>
    <script>
        $(document).ready(function () {
            init();
            //     $(document).on('click', '.applyBtn,.ranges li', function () {
            //         init();
            //
            //     });
            //
        });

        function init() {
            // var DELIVERABLE_DATE_F = $("input[name='daterangepicker_start']").val();
            // var DELIVERABLE_DATE_T = $("input[name='daterangepicker_end']").val();
            var t1 = [];
            var t2 = [];
            var t3 = [];
            var t4 = [];
            $.ajax({
                url: baseURL + '/sale-products',
                type: 'POST',
                dataType: 'json',
                data: {
                    _token: csrf_token,
                    // DELIVERABLE_DATE_F: DELIVERABLE_DATE_F,
                    // DELIVERABLE_DATE_T: DELIVERABLE_DATE_T
                },
                success: function (data) {

                    $.each(data.items, function (i, v) {
                        t1.push([v.daily + '/' + v.year, v.count]);
                    });
                    $("#site_sales_loading").hide(), $("#site_sales_content").show();
                    var a = ($.plot($("#site_sales"), [{
                        data: t1,
                        lines: {fill: .6, lineWidth: 0},
                        color: ["#f89f9f"]
                    }, {
                        data: t1,
                        points: {show: !0, fill: !0, radius: 5, fillColor: "#f89f9f", lineWidth: 3},
                        color: "#fff",
                        shadowSize: 0
                    }], {
                        xaxis: {
                            tickLength: 0,
                            tickDecimals: 0,
                            mode: "categories",
                            min: 0,
                            font: {lineHeight: 14, style: "normal", variant: "small-caps", color: "#6F7B8A"}
                        },
                        yaxis: {
                            ticks: 5,
                            tickDecimals: 0,
                            tickColor: "#eee",
                            font: {lineHeight: 14, style: "normal", variant: "small-caps", color: "#6F7B8A"}
                        },
                        grid: {
                            hoverable: !0,
                            clickable: !0,
                            tickColor: "#eee",
                            borderColor: "#eee",
                            borderWidth: 1
                        }
                    }), null);
                    $("#site_sales").bind("plothover", function (t, i, l) {
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
                url: baseURL + '/top-selling',
                type: 'POST',
                dataType: 'json',
                data: {
                    _token: csrf_token,
                    // DELIVERABLE_DATE_F: DELIVERABLE_DATE_F,
                    // DELIVERABLE_DATE_T: DELIVERABLE_DATE_T
                },
                success: function (data) {
                    var l = [];
                    var d = [];
                    var c = [];
                    $.each(data.items, function (i, v) {
                        d.push(v.count);
                        l.push(v.product.name);
                        c.push('rgb(100,194,207)');
                    });
                    var ctx = document.getElementById('site_top_selling');
                    var myChart = new Chart(ctx, {
                        type: 'bar',
                        data: {
                            labels: l,
                            datasets: [{
                                label: 'Top Selling (Products)',
                                data: d,
                                backgroundColor: c,
                                borderWidth: 1
                            }]
                        },
                        options: {
                            scales: {
                                yAxes: [{
                                    ticks: {
                                        beginAtZero: true
                                    }
                                }]
                            }
                        }
                    });
                }
            });
            $.ajax({
                url: baseURL + '/orders-cities',
                type: 'POST',
                dataType: 'json',
                data: {
                    _token: csrf_token,
                    // DELIVERABLE_DATE_F: DELIVERABLE_DATE_F,
                    // DELIVERABLE_DATE_T: DELIVERABLE_DATE_T
                },
                success: function (data) {
                    var l = [];
                    var d = [];
                    var c = [];


                    $.each(data.items, function (i, v) {

                        if (v.name_en == null)
                            v.name_en = "unKnown cities";
                        d.push(v.count);
                        l.push(v.name_en);
                        c.push('rgb(207,141,48)');
                    });
                    var ctx = document.getElementById('site_orders_cities');
                    var myChart = new Chart(ctx, {
                        type: 'bar',
                        data: {
                            labels: l,
                            datasets: [{
                                label: 'Orders (City)',
                                data: d,
                                backgroundColor: c,
                                borderWidth: 1
                            }]
                        },
                        options: {
                            scales: {
                                yAxes: [{
                                    ticks: {
                                        beginAtZero: true
                                    }
                                }]
                            }
                        }
                    });
                }
            });
            // $.ajax({
            //     url: baseURL + '/latest-merchants',
            //     type: 'POST',
            //     dataType: 'json',
            //     data: {
            //         _token: csrf_token,
            //         // DELIVERABLE_DATE_F: DELIVERABLE_DATE_F,
            //         // DELIVERABLE_DATE_T: DELIVERABLE_DATE_T
            //     },
            //     success: function (data) {
            //
            //         $.each(data.items, function (i, v) {
            //             t3.push([v.d + '/' + v.year, v.count]);
            //         });
            //         $("#site_latest_merchant_loading").hide(), $("#site_latest_merchant_content").show();
            //         var a = ($.plot($("#site_latest_merchant"), [{
            //             data: t3,
            //             lines: {fill: .6, lineWidth: 0},
            //             color: ["#9ACAE6"]
            //         }, {
            //             data: t3,
            //             points: {show: !0, fill: !0, radius: 5, fillColor: "#9ACAE6", lineWidth: 3},
            //             color: "#fff",
            //             shadowSize: 0
            //         }], {
            //             xaxis: {
            //                 tickLength: 0,
            //                 tickDecimals: 0,
            //                 mode: "categories",
            //                 min: 0,
            //                 font: {lineHeight: 14, style: "normal", variant: "small-caps", color: "#6F7B8A"}
            //             },
            //             yaxis: {
            //                 ticks: 5,
            //                 tickDecimals: 0,
            //                 tickColor: "#eee",
            //                 font: {lineHeight: 14, style: "normal", variant: "small-caps", color: "#6F7B8A"}
            //             },
            //             grid: {
            //                 hoverable: !0,
            //                 clickable: !0,
            //                 tickColor: "#eee",
            //                 borderColor: "#eee",
            //                 borderWidth: 1
            //             }
            //         }), null);
            //         $("#site_latest_merchant").bind("plothover", function (t, i, l) {
            //             if ($("#x").text(i.x.toFixed(2)), $("#y").text(i.y.toFixed(2)), l) {
            //                 if (a != l.dataIndex) {
            //                     a = l.dataIndex, $("#tooltip").remove();
            //                     l.datapoint[0].toFixed(2), l.datapoint[1].toFixed(2);
            //                     e(l.pageX, l.pageY, l.datapoint[0], l.datapoint[1] + " counts")
            //                 }
            //             } else $("#tooltip").remove(), a = null
            //         })
            //     }
            // });
            // $.ajax({
            //     url: baseURL + '/revenue-orders',
            //     type: 'POST',
            //     dataType: 'json',
            //     data: {
            //         _token: csrf_token,
            //         // DELIVERABLE_DATE_F: DELIVERABLE_DATE_F,
            //         // DELIVERABLE_DATE_T: DELIVERABLE_DATE_T
            //     },
            //     success: function (data) {
            //
            //         $.each(data.items, function (i, v) {
            //             t2.push([v.d + '/' + v.year, v.revenue_]);
            //         });
            //         $("#site_revenue_loading").hide(), $("#site_revenue_content").show();
            //         var a = ($.plot($("#site_revenue"), [{
            //             data: t2,
            //             lines: {fill: .6, lineWidth: 0},
            //             color: ["#9ACAE6"]
            //         }, {
            //             data: t2,
            //             points: {show: !0, fill: !0, radius: 5, fillColor: "#9ACAE6", lineWidth: 3},
            //             color: "#fff",
            //             shadowSize: 0
            //         }], {
            //             xaxis: {
            //                 tickLength: 0,
            //                 tickDecimals: 0,
            //                 mode: "categories",
            //                 min: 0,
            //                 font: {lineHeight: 14, style: "normal", variant: "small-caps", color: "#6F7B8A"}
            //             },
            //             yaxis: {
            //                 ticks: 5,
            //                 tickDecimals: 0,
            //                 tickColor: "#eee",
            //                 font: {lineHeight: 14, style: "normal", variant: "small-caps", color: "#6F7B8A"}
            //             },
            //             grid: {
            //                 hoverable: !0,
            //                 clickable: !0,
            //                 tickColor: "#eee",
            //                 borderColor: "#eee",
            //                 borderWidth: 1
            //             }
            //         }), null);
            //         $("#site_revenue").bind("plothover", function (t, i, l) {
            //             if ($("#x").text(i.x.toFixed(2)), $("#y").text(i.y.toFixed(2)), l) {
            //                 if (a != l.dataIndex) {
            //                     a = l.dataIndex, $("#tooltip").remove();
            //                     l.datapoint[0].toFixed(2), l.datapoint[1].toFixed(2);
            //                     e(l.pageX, l.pageY, l.datapoint[0], l.datapoint[1] + " SAR")
            //                 }
            //             } else $("#tooltip").remove(), a = null
            //         })
            //     }
            // });
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

<?php $__env->stopSection(); ?>

<?php echo $__env->make('merchant.layout.index', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/saudidragonmart/public_html/resources/views/merchant/home.blade.php ENDPATH**/ ?>