@extends(admin_layout_vw().'.index')

@section('css')
    <!-- BEGIN PAGE LEVEL PLUGINS -->
    <link href="{{url('/')}}/assets/global/plugins/datatables/datatables.min.css" rel="stylesheet" type="text/css"/>
    <link href="{{url('/')}}/assets/global/plugins/datatables/plugins/bootstrap/datatables.bootstrap.css"
          rel="stylesheet" type="text/css"/>

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
                        {{--                        {!! Form::open(['method'=>'POST','url'=>url(admin_vw().'/user/export')]) !!}--}}
                        <form method="POST" action="#">
                            <table class="table table-striped table-bordered table-hover table-checkable"
                                   id="datatable_products">
                                <thead>
                                <tr role="row" class="heading">
                                    <th width="1%">
                                    </th>

                                    <th width="10%"> Name</th>
                                    {{--<th width="10%"> Price</th>--}}
                                    {{--<th width="10%"> Quantity</th>--}}
                                    <th width="10%"> Action</th>
                                </tr>
                                <tr role="row" class="filter">
                                    <td></td>
                                    <td>
                                        <input type="text" class="form-control form-filter input-md" name="name"
                                               placeholder=" Name" id="name">
                                    </td>
                                    {{--<td>--}}
                                    {{--<input type="text" class="form-control form-filter input-md" name="merchant"--}}
                                    {{--placeholder="merchant" id="merchant">--}}
                                    {{--</td>--}}


                                    <td>
                                        <div class="margin-bottom-5">
                                            <a href="javascript:;"
                                               class="btn btn-sm btn-success filter-submit btn-circle btn-icon-only margin-bottom"
                                               title="filter">
                                                <i class="fa fa-search"></i>
                                            </a>

                                            <a href="javascript:;"
                                               class="btn btn-sm btn-danger btn-circle btn-icon-only filter-cancel"
                                               title="Empty fields">
                                                <i class="fa fa-rotate-left"></i>
                                            </a>
                                        </div>

                                    </td>
                                </tr>
                                </thead>
                                <tbody></tbody>
                            </table>
                            {{--{!! Form::close() !!}--}}
                        </form>
                    </div>
                </div>
            </div>
            <div class="portlet light ">
                <div class="portlet-title">
                    <div class="caption font-dark">
                        <i class="{{$icon}} font-dark"></i>
                        <span class="caption-subject bold uppercase"> {{$main_title}}</span>
                    </div>
                    <div class="actions">
                        <a href="{{url(admin_stores_url().'/product/create')}}"
                           class="btn btn-circle btn-success add-product-mdl">
                            <i class="fa fa-plus"></i>
                            <span class="hidden-xs"> Add New </span>
                        </a>
                    </div>
                </div>

                <div class="portlet-body">

                    <table class="table table-striped table-bordered table-hover table-checkable order-column"
                           id="products_tbl">
                        <thead>
                        <tr>
                            <th>#</th>
                            <th> Name</th>
                            <th> Price</th>
                            <th> Quantity</th>
                            <th> Category</th>
                            <th> IsOffer</th>
                            <th> IsSponser</th>
                            <th>Action</th>
                        </tr>
                        </thead>
                    </table>
                </div>
            </div>
            <!-- END EXAMPLE TABLE PORTLET-->
        </div>
    </div>


@endsection

@section('js')
    <!-- BEGIN PAGE LEVEL PLUGINS -->
    <script src="{{url('/')}}/assets/global/scripts/datatable.js" type="text/javascript"></script>
    <script src="{{url('/')}}/assets/global/plugins/datatables/datatables.min.js" type="text/javascript"></script>
    <script src="{{url('/')}}/assets/global/plugins/datatables/plugins/bootstrap/datatables.bootstrap.js"
            type="text/javascript"></script>


    <script src="{{url('/')}}/assets/global/plugins/bootstrap-datepicker/js/bootstrap-datepicker.min.js"
            type="text/javascript"></script>
    <!-- END PAGE LEVEL PLUGINS -->
    <!-- BEGIN THEME GLOBAL SCRIPTS -->
    <script src="{{url('/')}}/assets/global/scripts/app.min.js" type="text/javascript"></script>
    <!-- END THEME GLOBAL SCRIPTS -->
    <!-- BEGIN PAGE LEVEL SCRIPTS -->
    <script src="{{url('/')}}/assets/pages/scripts/table-datatables-managed.min.js" type="text/javascript"></script>
    <!-- END PAGE LEVEL SCRIPTS -->
    <script src="{{url('/')}}/assets/js/products.js" type="text/javascript"></script>

    <script>
        $(".date-picker").datepicker({
            rtl: App.isRTL(),
            dateFormat: "mm/dd/yy",
            showOtherMonths: true,
            selectOtherMonths: true,
            autoclose: true,
            changeMonth: true,
            changeYear: true,
            orientation: "below"
        });
    </script>
@stop