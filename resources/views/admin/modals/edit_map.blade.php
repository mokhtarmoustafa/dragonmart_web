{!! Form::open(['method'=>'PUT','url'=>url(merchant_vw().'/profile'),'id'=>'save_location']) !!}
<div class="modal fade bs-modal-lg" id="edit-merchant" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
                <h4 class="modal-title">User location <span class="badge badge-primary name "
                                                            style="text-transform: inherit"></span></h4>
            </div>
            <div class="modal-body">

                <div class="row">
                    <div class="col-md-12">
                        <!-- BEGIN MARKERS PORTLET-->
                        <div class="portlet light portlet-fit ">
                            <div class="portlet-title">
                                <div class="caption">
                                    <i class=" icon-layers font-blue"></i>
                                    <span class="caption-subject font-blue bold uppercase">{{$sub_title ?? 'map'}}</span>
                                </div>

                            </div>
                            <div class="portlet-body">
                                <div id="map" style="width:100%;height:400px;"></div>
                            </div>

                            <input type="hidden" name="latitude" id="latitude" value="">
                            <input type="hidden" name="longitude" id="longitude" value="">
                            <input type="hidden" name="address" id="address" value="">
                        </div>
                        <!-- END MARKERS PORTLET-->
                    </div>
                </div>
                <div class="form-body">

                    <div class="form-actions">
                        <div class="row">
                            <div class="col-md-12 text-center">
                                <button type="submit" class="btn btn-circle green btn-md save"><i
                                            class="fa fa-check"></i>
                                    Save Location
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

            </div>

        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>
{!! Form::close() !!}