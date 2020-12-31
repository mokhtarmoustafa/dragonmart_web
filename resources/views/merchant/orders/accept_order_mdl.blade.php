<link href="{{url('/')}}/assets/global/plugins/bootstrap-fileinput/bootstrap-fileinput.css" rel="stylesheet"
      type="text/css"/>

<link href="{{url('/')}}/assets/global/plugins/select2/css/select2.min.css" rel="stylesheet" type="text/css"/>
<link href="{{url('/')}}/assets/global/plugins/select2/css/select2-bootstrap.min.css" rel="stylesheet"
      type="text/css"/>
<link href="{{url('/')}}/assets/global/plugins/bootstrap-timepicker/css/bootstrap-timepicker.min.css" rel="stylesheet"
      type="text/css"/>


<div class="modal fade bs-modal-lg" id="{{$modal_id}}" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
                <h4 class="modal-title"> {!! $modal_title !!}</h4>
            </div>

            <div class="modal-body">
                <div class="row">
                    <div class="col-sm-12">
                        <div class="portlet-body form">

                            {!! Form::open(['method'=>'put','id'=>'acceptOrderFrm','class'=>'form-horizontal form','url'=>url(merchant_url().'/accept-order/'.$order->id) ,'files'=>true]) !!}

                            <div class="form-body">
                                <div class="form-group">
                                    <label class="col-md-3 control-label">Order #: <a
                                            href="{{url(merchant_url() . '/order/' . $order->id)}}"
                                            target="_blank"><span class="">{{$order->id}}</span></a></label>
                                    <label class="col-md-6 control-label">Order Date:{{$order->created_at}}</label>
                                    <label class="col-md-3 control-label">Status #:{{$order->last_status}}</label>
                                </div>

                                <div class="form-group">
                                    <label class="col-md-3 control-label">Delivery Team</label>
                                    <div class="col-md-9">
                                        <div class="input-icon">
                                            <select class="form-control select2 delivery_method"
                                                    name="delivery_method"
                                                    data-placeholder="Choose Delivery Team..."
                                                    id="delivery_method">
                                                <option></option>
                                                @if($order->merchant->has_dragonmart_driver)
                                                    <option value="any_driver">Dragon Mart Drivers</option>
                                                @endif
                                                @if($order->merchant->has_merchant_driver)
                                                    <option value="my_driver">My Drivers</option>
                                                @endif
                                                @if($order->merchant->has_freelancer_driver)
                                                    <option value="third_part">Freelancer Drivers</option>
                                                @endif

                                            </select>
                                        </div>
                                    </div>
                                </div>
                                @if($order->merchant->has_merchant_driver)
                                    <div class="form-group my_drivers" style="display: none;">
                                        <label class="col-md-3 control-label">Choose Driver</label>
                                        <div class="col-md-9">
                                            <div class="input-icon">
                                                <select class="form-control select2 driver_id" name="driver_id"
                                                        data-placeholder="Select Driver..."
                                                        id="driver_id">
                                                    <option></option>

                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                @endif

                                <div class="form-actions">
                                    <div class="row">
                                        <div class="col-md-12 text-center">
                                            <button type="submit" class="btn btn-circle green btn-md save accept"><i
                                                    class="fa fa-check"></i>
                                                Accept
                                            </button>
                                            <button type="button" class="btn btn-circle btn-md red"
                                                    data-dismiss="modal">
                                                <i class="fa fa-times"></i>
                                                Close
                                            </button>
                                        </div>
                                    </div>
                                </div>
                                {!! Form::close() !!}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
    </div>
</div>
<script src="{{url('/')}}/assets/global/plugins/select2/js/select2.full.min.js" type="text/javascript"></script>
<script src="{{url('/')}}/assets/pages/scripts/components-select2.min.js" type="text/javascript"></script>

<script src="{{url('/')}}/assets/global/plugins/bootstrap-fileinput/bootstrap-fileinput.js"
        type="text/javascript"></script>
<script src="{{url('/')}}/assets/global/plugins/moment.min.js" type="text/javascript"></script>
<script src="{{url('/')}}/assets/global/plugins/bootstrap-daterangepicker/daterangepicker.min.js"
        type="text/javascript"></script>

<script src="{{url('/')}}/assets/global/plugins/bootstrap-timepicker/js/bootstrap-timepicker.min.js"
        type="text/javascript"></script>
<!-- BEGIN THEME GLOBAL SCRIPTS -->
<script src="{{url('/')}}/assets/global/scripts/app.min.js" type="text/javascript"></script>
<!-- END THEME GLOBAL SCRIPTS -->
<!-- BEGIN PAGE LEVEL SCRIPTS -->
<script src="{{url('/')}}/assets/pages/scripts/components-date-time-pickers.min.js" type="text/javascript"></script>
<!-- END PAGE LEVEL SCRIPTS -->
