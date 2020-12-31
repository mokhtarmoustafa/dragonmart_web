<div class="modal fade bs-modal-lg" id="<?php echo e($modal_id); ?>" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
                <h4 class="modal-title"> <?php echo $modal_title; ?></h4>
            </div>

            <div class="modal-body">
                <div class="row">
                    <div class="col-sm-12">
                        <div class="portlet-body form">

                            <?php echo Form::open(['method'=>'put','id'=>'readyOrderFrm','class'=>'form-horizontal form','url'=>url(merchant_url().'/ready-order/'.$order->id) ,'files'=>true]); ?>

                            <div class="form-body">
                                <div class="form-group">
                                    <span class="h2">هل أنت متأكد من تجهيز الطلب؟</span>
                                </div>
                                <div class="form-actions">
                                    <div class="row">
                                        <div class="col-md-12 text-center">
                                            <button type="submit" class="btn btn-circle green btn-md save ready"><i
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
                                <?php echo Form::close(); ?>

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
<?php /**PATH C:\xampp\htdocs\Dragon\resources\views/merchant/V2/orders/ready_order_mdl.blade.php ENDPATH**/ ?>