@extends(merchant_layout_vw().'.index')

@section('css')
    <!-- BEGIN PAGE LEVEL PLUGINS -->
    <link href="{{url('/')}}/assets/global/plugins/datatables/datatables.min.css" rel="stylesheet" type="text/css"/>
    <link href="{{url('/')}}/assets/global/plugins/datatables/plugins/bootstrap/datatables.bootstrap.css"
          rel="stylesheet" type="text/css"/>
    <link href="{{url('/')}}/assets/global/plugins/bootstrap-daterangepicker/daterangepicker.min.css" rel="stylesheet" type="text/css" />

    <link href="{{url('/')}}/assets/global/plugins/bootstrap-datepicker/css/bootstrap-datepicker3.min.css"
          rel="stylesheet" type="text/css"/>
    <!-- END PAGE LEVEL PLUGINS -->
    <!-- BEGIN THEME GLOBAL STYLES -->
    <link href="{{url('/')}}/assets/global/css/components-md.min.css" rel="stylesheet" id="style_components"
          type="text/css"/>
    <link href="{{url('/')}}/assets/global/css/plugins-md.min.css" rel="stylesheet" type="text/css"/>
    <!-- END THEME GLOBAL STYLES -->
@endsection
@section('content')

    <div class="portlet light ">
        <div class="portlet-title">
            <div class="caption font-dark">
                <i class="{{$icon}} font-dark"></i>
                <span class="caption-subject bold uppercase"> {{$main_title}}</span>
            </div>

        </div>
        <div class="portlet-body">
            <div class="row">
                <div class="col-md-12">
                    <div class="portlet light ">
                        <div class="portlet-body form">
                            <div class="row">

                                <div class="col-md-12">
                                    <!-- BEGIN EXAMPLE TABLE PORTLET-->
                                    <div class="portlet light">
                                        <div class="portlet-title">
                                            <div class="caption font-dark">
                                                <i class="fa fa-search font-dark"></i>
                                                <span class="caption-subject bold uppercase"> Filter </span>
                                            </div>

                                        </div>
                                        <div class="portlet-body">
                                            <div class="table-container">
                                                {!! Form::open(['method'=>'POST','url'=>url('/admin/export')]) !!}

                                                <table class="table table-striped table-bordered table-hover table-checkable"
                                                       id="datatable_products">
                                                    <thead>
                                                    <tr role="row" class="heading">
                                                        <th width="1%">
                                                        </th>
                                                        <th width="10%"> Date range</th>
                                                        <th width="10%"> Action</th>
                                                    </tr>
                                                    <tr role="row" class="filter">
                                                        <td></td>
                                                        <td>
                                                            <div class="input-group date-picker input-daterange text-center" data-date="10/11/2012" data-date-format="mm/dd/yyyy">
                                                                <input type="text" class="form-control" name="from" placeholder="From">
                                                                <span class="input-group-addon"> to </span>
                                                                <input type="text" class="form-control" name="to" placeholder="To"> </div>

                                                        </td>
                                                        <td>
                                                            <div class="margin-bottom-5">
                                                                <a href="javascript:;"
                                                                   class="btn btn-sm btn-success btn-circle btn-icon-only filter-submit-u margin-bottom"
                                                                   title="Search">
                                                                    <i class="fa fa-search"></i>
                                                                </a>

                                                                <a href="javascript:;"
                                                                   class="btn btn-sm btn-danger btn-circle btn-icon-only filter-cancel-u"
                                                                   title="Empty">
                                                                    <i class="fa fa-times"></i>
                                                                </a>
                                                            </div>

                                                        </td>
                                                    </tr>
                                                    </thead>
                                                    <tbody></tbody>
                                                </table>
                                                {!! Form::close() !!}

                                            </div>
                                        </div>
                                    </div>
                                    <div class="portlet light ">
                                        <div class="portlet-title">
                                            <div class="caption font-dark">
                                                <i class="{{$icon}} font-dark"></i>
                                                <span class="caption-subject bold uppercase"> Expenses</span>
                                            </div>
                                            <div class="actions">
                                                <a href="{{url(merchant_expense_url().'/create')}}"
                                                   class="btn btn-circle btn-success add-expense-mdl">
                                                    <i class="fa fa-plus"></i>
                                                    <span class="hidden-xs"> Add New </span>
                                                </a>
                                            </div>
                                        </div>


                                        <div class="portlet-body">

                                            <table class="table table-striped table-bordered table-hover table-checkable order-column"
                                                   id="new_requests">
                                                <thead>
                                                <tr>
                                                    <th>#</th>
                                                    <th> Date</th>
                                                    <th> Amount (SAR)</th>
                                                    <th> Details</th>
                                                    <th> Action</th>
                                                </tr>
                                                </thead>
                                                <tbody>
                                                <tr>
                                                    <td>1</td>
                                                    <td>13/02/1991</td>
                                                    <td>13</td>
                                                    <td>Shipment1</td>

                                                    <td><a href="{{url(admin_vw().'/order/46')}}"
                                                           class="btn btn-primary purple btn-icon-only btn-circle"><i
                                                                    class="fa fa-edit"></i></a><a
                                                                href="javascript:;"
                                                                class="btn btn-danger btn-icon-only btn-circle delete"
                                                                title="delete"><i
                                                                    class="fa fa-trash"></i></a></td>
                                                </tr>
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                    <!-- END EXAMPLE TABLE PORTLET-->
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
@endsection

@section('js')

    <!-- BEGIN PAGE LEVEL PLUGINS -->
    <script src="{{url('/')}}/assets/global/scripts/datatable.js" type="text/javascript"></script>
    <script src="{{url('/')}}/assets/global/plugins/datatables/datatables.min.js" type="text/javascript"></script>
    <script src="{{url('/')}}/assets/global/plugins/datatables/plugins/bootstrap/datatables.bootstrap.js"
            type="text/javascript"></script>
    <!-- END PAGE LEVEL PLUGINS -->
    <script src="{{url('/')}}/assets/global/plugins/moment.min.js" type="text/javascript"></script>
    <script src="{{url('/')}}/assets/global/plugins/bootstrap-daterangepicker/daterangepicker.min.js" type="text/javascript"></script>
    <script src="{{url('/')}}/assets/global/plugins/bootstrap-datepicker/js/bootstrap-datepicker.min.js"
            type="text/javascript"></script>
    {{--<script type="text/javascript" src="javascripts/jquery.googlemap.js"></script>--}}
    {{--    <script src="{{url('/')}}/assets/global/plugins/jquery-ui/jquery-ui.min.js" type="text/javascript"></script>--}}

    <!-- BEGIN THEME GLOBAL SCRIPTS -->
    <script src="{{url('/')}}/assets/global/scripts/app.min.js" type="text/javascript"></script>
    <!-- END THEME GLOBAL SCRIPTS -->

    <script src="{{url('/')}}/assets/pages/scripts/components-date-time-pickers.min.js" type="text/javascript"></script>

    {{--    <script src="{{url('/')}}/assets/pages/scripts/ui-modals.min.js" type="text/javascript"></script>--}}

    <!-- BEGIN PAGE LEVEL SCRIPTS -->
    <script src="{{url('/')}}/assets/pages/scripts/table-datatables-responsive.min.js" type="text/javascript"></script>

    {{--<script src="{{url('/')}}/assets/pages/scripts/table-datatables-managed.min.js" type="text/javascript"></script>--}}
    <!-- END PAGE LEVEL SCRIPTS -->
    {{--    <script src="{{url('/')}}/assets/js/users.js" type="text/javascript"></script>--}}

{{--    <script>--}}
{{--        $(".date-picker").datepicker({--}}
{{--            rtl: App.isRTL(),--}}
{{--            dateFormat: "mm/dd/yy",--}}
{{--            showOtherMonths: true,--}}
{{--            selectOtherMonths: true,--}}
{{--            autoclose: true,--}}
{{--            changeMonth: true,--}}
{{--            changeYear: true,--}}
{{--            orientation: "below"--}}
{{--        });--}}
{{--    </script>--}}
@stop