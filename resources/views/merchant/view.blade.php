@extends(merchant_layout_vw().'.index')

@section('css')
    <!-- BEGIN PAGE LEVEL PLUGINS -->
    <link href="{{url('/')}}/assets/global/plugins/datatables/datatables.min.css" rel="stylesheet" type="text/css"/>
    <link href="{{url('/')}}/assets/global/plugins/datatables/plugins/bootstrap/datatables.bootstrap.css"
          rel="stylesheet" type="text/css"/>
    <!-- END PAGE LEVEL PLUGINS -->
    <link href="{{url('/')}}/assets/global/plugins/select2/css/select2.min.css" rel="stylesheet" type="text/css"/>
    <link href="{{url('/')}}/assets/global/plugins/select2/css/select2-bootstrap.min.css" rel="stylesheet"
          type="text/css"/>
    <!-- BEGIN THEME GLOBAL STYLES -->
    <link href="{{url('/')}}/assets/global/css/components-md.min.css" rel="stylesheet" id="style_components"
          type="text/css"/>
    <link href="{{url('/')}}/assets/global/css/plugins-md.min.css" rel="stylesheet" type="text/css"/>
    <!-- END THEME GLOBAL STYLES -->

    <style>
        .table-container td {
            font-size: 20px;
            padding-top: 4px;
        }

        .select2-container {
            width: 400px !important;
        }

    </style>
@endsection
@section('content')

    <input type="hidden" value="{{$user->id}}" name="merchant_id" id="merchant_id">
    <div class="row">

        <div class="col-md-12">
            <!-- BEGIN EXAMPLE TABLE PORTLET-->
            <div class="portlet light ">
                <div class="portlet-title">
                    <div class="caption font-dark">
                        <i class="{{$icon}} font-dark"></i>
                        <span class="caption-subject bold uppercase"> {{$main_title}}</span>
                    </div>

                </div>

                <div class="portlet-body form">
                    <div class="table-container">
                        <form class="form-horizontal" role="form">
                            <div class="form-body">
                                <div class="form-group ">

                                    <table class="table table-striped table-bordered table-hover table-checkable order-column"
                                           id="merchant-det-tbl">
                                        <thead>
                                        <tr>
                                            <th width="20%"> Logo</th>
                                            <th> Name</th>
                                            <th> Email</th>
                                            <th> Mobile</th>
                                            <th> Delivery method</th>
                                            <th> Register Date</th>
                                            <th> City</th>
                                            <th> Address</th>
                                            <th> Status</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        <tr>
                                            <td>
                                                <div class="fileinput fileinput-new">
                                                    <div class="">
                                                        <img src="{{$user->store_images[0]->image100 ?? url('assets/apps/img/shop.png')}}"
                                                             style="width:100px;height: 100px;">
                                                    </div>

                                                </div>
                                            </td>
                                            <td>{{$user->username ?? ''}}</td>

                                            <td> {{$user->email ?? ''}}</td>
                                            <td> {{$user->mobile ?? ''}}</td>
                                            <td style="    text-align: left !important;">
                                                <ul>
                                                    @if($user->has_merchant_driver)
                                                        <li>Merchant driver</li>
                                                    @endif
                                                    @if($user->has_freelancer_driver)
                                                        <li>Freelancer driver</li>
                                                    @endif
                                                    @if($user->has_dragonmart_driver)
                                                        <li>Dragonmart driver</li>
                                                    @endif
                                                </ul>
                                            </td>
                                            <td>{{\Carbon\Carbon::parse($user->created_at)->format('Y-m-d') ?? ''}}</td>
                                            <td>{{$user->city->name_en ?? ''}}</td>

                                            <td><a
                                                        href="{{url(admin_vw() . '/user/' . $user->id)}}"
                                                        class="btn btn-circle btn-icon-only blue user-det"
                                                        title="Address">
                                                    <i class="fa fa-map"></i>
                                                </a></td>
                                            <td><a href="javascript:;"
                                                   class="btn btn-circle btn-icon-only @if($user->is_active) red @else green @endif set_active"
                                                   data-id="{{$user->id}}"
                                                   title="@if($user->is_active) Suspend @else Activate @endif">
                                                    <i class="@if($user->is_active)fa fa-power-off @else fa fa-check @endif"></i>
                                                </a>
                                            </td>
                                        </tr>
                                        </tbody>
                                    </table>

                                </div>


                            </div>
                        </form>
                    </div>

                </div>

            </div>
            <!-- END EXAMPLE TABLE PORTLET-->
        </div>
    </div>

    <div class="modal fade bs-modal-lg" id="imagesProduct" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-lg" style="width: 1200px !important;">
            <div class="modal-content">
                <div class="modal-body" id="images-product">

                </div>

            </div>
            <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
    </div>
    <div class="modal fade bs-modal-lg" id="editProduct" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-lg" style="width: 1200px !important;">
            <div class="modal-content">
                <div class="modal-body" id="edit_product">

                </div>

            </div>
            <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
    </div>
@endsection

@section('js')

    <!-- BEGIN PAGE LEVEL PLUGINS -->
    <script src="{{url('/')}}/assets/global/scripts/datatable.js" type="text/javascript"></script>
    <script src="{{url('/')}}/assets/global/plugins/datatables/datatables.min.js"
            type="text/javascript"></script>
    <script src="{{url('/')}}/assets/global/plugins/datatables/plugins/bootstrap/datatables.bootstrap.js"
            type="text/javascript"></script>
    <!-- END PAGE LEVEL PLUGINS -->
    <script src="{{url('/')}}/assets/global/plugins/select2/js/select2.full.min.js" type="text/javascript"></script>

    <script src="{{url('/')}}/assets/global/plugins/jquery-ui/jquery-ui.min.js" type="text/javascript"></script>

    <!-- BEGIN THEME GLOBAL SCRIPTS -->
    <script src="{{url('/')}}/assets/global/scripts/app.min.js" type="text/javascript"></script>
    <!-- END THEME GLOBAL SCRIPTS -->
    <script src="{{url('/')}}/assets/pages/scripts/components-bootstrap-switch.min.js"
            type="text/javascript"></script>
    <script src="{{url('/')}}/assets/pages/scripts/ui-modals.min.js" type="text/javascript"></script>

    <!-- BEGIN PAGE LEVEL SCRIPTS -->
    <script src="{{url('/')}}/assets/pages/scripts/table-datatables-responsive.min.js"
            type="text/javascript"></script>

    <!-- END PAGE LEVEL SCRIPTS -->
    <script src="{{url('/')}}/assets/js/merchants.js" type="text/javascript"></script>
    <script src="{{url('/')}}/assets/js/products.js" type="text/javascript"></script>
    <script src="{{url('/')}}/assets/js/users.js" type="text/javascript"></script>
    <script src="{{url('/')}}/assets/js/stores.js" type="text/javascript"></script>
    <script src="{{url('/')}}/assets/js/orders.js" type="text/javascript"></script>
    <script>
        $('.select2').select2({
            placeholder: "Select...",
            allowClear: true
        });
    </script>
@stop
