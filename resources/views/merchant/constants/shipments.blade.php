@extends(merchant_layout_vw().'.index')

@section('css')
    <!-- BEGIN PAGE LEVEL PLUGINS -->
    <link href="{{url('/')}}/assets/global/plugins/datatables/datatables.min.css" rel="stylesheet" type="text/css"/>
    <link href="{{url('/')}}/assets/global/plugins/datatables/plugins/bootstrap/datatables.bootstrap.css"
          rel="stylesheet" type="text/css"/>
    <!-- END PAGE LEVEL PLUGINS -->
    <!-- BEGIN THEME GLOBAL STYLES -->
    <link href="{{url('/')}}/assets/global/css/components-md.min.css" rel="stylesheet" id="style_components"
          type="text/css"/>
    <link href="{{url('/')}}/assets/global/css/plugins-md.min.css" rel="stylesheet" type="text/css"/>
    <!-- END THEME GLOBAL STYLES -->
@endsection
@section('content')
    <input type="hidden" name="constant" id="constant" value="{{$constant_name}}">
    <input type="hidden" name="url_action" id="url_action" value="{{$url_action}}">
    <div class="row">
        <div class="col-md-12">
            <!-- BEGIN EXAMPLE TABLE PORTLET-->
            <div class="portlet box grey-gallery ">
                <div class="portlet-title">
                    <div class="caption">
                        <i class="icon-settings"></i>
                        <span class="caption-subject bold uppercase"> {{$sub_title}}</span>
                    </div>
                    <div class="actions">
                        <a href="{{url(merchant_vw().'/shipment/create')}}"
                           class="btn btn-circle btn-info add-shipment-mdl">
                            <i class="fa fa-plus"></i>
                            <span class="hidden-xs"> Add Shipping Rate </span>
                        </a>
                    </div>

                </div>
                <div class="portlet-body">
                    {{--                    <div class="form-body">--}}
                    {{--                        <div class="form-group">--}}
                    {{--                            {!! Form::open(['method'=>'put','url'=>url(merchant_vw().'/profile'),'id'=>'editProfile']) !!}--}}
                    {{--                            <div class="row">--}}
                    {{--                                <div class="col-md-4">--}}
                    {{--                                    <label>Min. order amount (SAR)</label>--}}
                    {{--                                    <div class="input-group">--}}
                    {{--                                        <div class="input-icon">--}}
                    {{--                                            --}}{{--                                        <i class="fa fa-lock fa-fw"></i>--}}
                    {{--                                            <input type="text" class="form-control" placeholder="Min. order amount (SAR)"--}}
                    {{--                                                   name="min_order_amount"--}}
                    {{--                                                   value="{{$currentUser->Merchant->min_order_amount ?? ''}}"--}}
                    {{--                                                   id="min_order_amount" style="text-align: center">--}}
                    {{--                                        </div>--}}
                    {{--                                        <span class="input-group-btn">--}}
                    {{--                                                            <button class="btn btn-success save"--}}
                    {{--                                                                    type="submit">--}}
                    {{--                                                                <i class="fa fa-arrow-left fa-fw"></i> Save</button>--}}
                    {{--                                                        </span>--}}
                    {{--                                    </div>--}}
                    {{--                                </div>--}}
                    {{--                            </div>--}}
                    {{--                            {!! Form::close() !!}--}}
                    {{--                        </div>--}}
                    {{--                    </div>--}}

                    <hr>
                    <table class="table table-striped table-bordered table-hover table-checkable order-column"
                           id="shipment_tbl">
                        <thead>
                        <tr>
                            <th>#</th>
                            <th> From - To (km)</th>
                            <th> Price (SAR)</th>
                            <th> Min order amount</th>
                            <th> Action</th>
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
    <!-- END PAGE LEVEL PLUGINS -->
    <!-- BEGIN THEME GLOBAL SCRIPTS -->
    <script src="{{url('/')}}/assets/global/scripts/app.min.js" type="text/javascript"></script>
    <!-- END THEME GLOBAL SCRIPTS -->
    <!-- BEGIN PAGE LEVEL SCRIPTS -->
    <script src="{{url('/')}}/assets/pages/scripts/table-datatables-managed.min.js" type="text/javascript"></script>
    <!-- END PAGE LEVEL SCRIPTS -->
    <script src="{{url('/')}}/assets/js/shipments.js" type="text/javascript"></script>

@stop