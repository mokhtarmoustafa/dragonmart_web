<link href="{{url('/')}}/assets/global/plugins/select2/css/select2.min.css" rel="stylesheet" type="text/css"/>
<link href="{{url('/')}}/assets/global/plugins/select2/css/select2-bootstrap.min.css" rel="stylesheet"
      type="text/css"/>

<link href="{{url('/')}}/assets/global/css/components-md.min.css" rel="stylesheet" id="style_components"
      type="text/css"/>
<link href="{{url('/')}}/assets/global/css/plugins-md.min.css" rel="stylesheet" type="text/css"/>
<!-- END THEME GLOBAL STYLES -->
<div class="modal fade bs-modal-lg" id="assign-driver" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
                <h4 class="modal-title"><i class="fa fa-user-plus"></i> Assign Driver<span
                            class="badge badge-primary name "
                            style="text-transform: inherit"></span></h4>
            </div>
            <div class="modal-body">
                <div class="portlet-body form">

                    {!! Form::open(['method'=>'PUT','class'=>'form-horizontal form-bordered form-row-stripped','url'=>url(getAuth()->type.'/assign-driver'),'files'=>true,'id'=>'formAssignDriver']) !!}
                    <div class="alert alert-danger" style="display: none">

                    </div>

                    <div class="form-body">

                        <input type="hidden" name="order_id" value="{{$order_id}}">
                        <div class="form-group">
                            <div class="control-label col-md-2">
                                <label for="driver_types">Delivery method</label>
                            </div>
                            <div class="col-md-4">
                                <select class="form-control" name="delivery_method" id="delivery_method">
                                    <option>Select ...</option>
                                    @foreach($delivery_method as $method)
                                        <option value="{{$method->type}}"
                                                data-id="{{$method->id}}">{{$method->name}}</option>
                                    @endforeach

                                </select>
                            </div>
                        </div>
                        <div class="form-group driver_name" style="display: none;">
                            <div class="control-label col-md-2">
                                <label for="driver_name">Driver name</label>
                            </div>
                            <div class="col-md-4">
                                <select class="form-control select2" name="driver_id" id="driver_id">
                                    <option>Select ...</option>

                                    @foreach($driver_dragonmart as $driver)
                                        <option value="{{$driver->id}}">{{$driver->username}}</option>
                                    @endforeach

                                </select>
                            </div>
                        </div>
                    </div>

                    <div class="form-body">

                        <div class="form-actions">
                            <div class="row">
                                <div class="col-md-12 text-center">
                                    <button type="submit" class="btn btn-circle green btn-md save"><i
                                                class="fa fa-check"></i>
                                        Assign
                                    </button>
                                    <button type="button" class="btn btn-circle btn-md red"
                                            data-dismiss="modal">
                                        <i class="fa fa-times"></i>
                                        Close
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>

                    {!! Form::close() !!}

                </div>
            </div>

        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>

<script src="{{url('/')}}/assets/global/plugins/select2/js/select2.full.min.js" type="text/javascript"></script>
<script src="{{url('/')}}/assets/pages/scripts/components-select2.min.js" type="text/javascript"></script>


