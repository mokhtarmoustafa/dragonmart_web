<div class="modal fade bs-modal-lg" id="userDet" tabindex="-1" role="dialog" aria-hidden="true">
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
                                    <span class="caption-subject font-blue bold uppercase"><?php echo e($sub_title ?? 'map'); ?></span>
                                </div>

                            </div>
                            <div class="portlet-body">
                                <div id="map" style="width:100%;height:400px;"></div>
                            </div>
                        </div>
                        <!-- END MARKERS PORTLET-->
                    </div>
                </div>
                <div class="form-body">

                    <div class="form-actions">
                        <div class="row">
                            <div class="col-md-12 text-center">
                                
                                
                                
                                
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
<?php /**PATH C:\xampp\htdocs\dragon_mart_web\resources\views/admin/modals/map.blade.php ENDPATH**/ ?>