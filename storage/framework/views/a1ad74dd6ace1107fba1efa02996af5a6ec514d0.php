<!-- Modal-->
<div class="modal fade bs-modal-lg" id="<?php echo e($modal_id); ?>" data-backdrop="static" tabindex="-1" role="dialog" aria-labelledby="staticBackdrop" aria-hidden="true">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">حذف <?php echo $modal_title; ?></h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <i aria-hidden="true" class="ki ki-close"></i>
                </button>
            </div>
            <div class="modal-body">
                <h1>هل أنت متأكد من حذف <?php echo $modal_title; ?>؟</h1>
                <?php echo Form::open(['method'=>'put','id'=>'cancelProductFrm','class'=>'form-horizontal form','url'=>url(merchant_url().'/order_product/cancel/'.$product->id) ,'files'=>true]); ?>

                <div class="form-actions">
                    <div class="row">
                        <div class="col-md-12 text-center">
                            <button type="submit" class="btn btn-circle green btn-md save cancel_product_btn"><i class="fa fa-check"></i>
                                Delete
                            </button>
                            <button type="button" class="btn btn-circle btn-md red" data-dismiss="modal">
                                <i class="fa fa-times"></i>
                                Cancel
                            </button>
                        </div>
                    </div>
                </div>
                <?php echo Form::close(); ?>

            </div>
        </div>
    </div>
</div><?php /**PATH C:\xampp\htdocs\Dragon\resources\views/merchant/V2/orders/cancel_product_mdl.blade.php ENDPATH**/ ?>