<?php $__env->startSection('css'); ?>
<!-- BEGIN PAGE LEVEL PLUGINS -->
<link href="<?php echo e(url('/')); ?>/assets/global/plugins/datatables/datatables.min.css" rel="stylesheet" type="text/css" />
<link href="<?php echo e(url('/')); ?>/assets/global/plugins/datatables/plugins/bootstrap/datatables.bootstrap.css" rel="stylesheet" type="text/css" />
<!-- END PAGE LEVEL PLUGINS -->
<link href="<?php echo e(url('/')); ?>/assets/global/plugins/select2/css/select2.min.css" rel="stylesheet" type="text/css" />
<link href="<?php echo e(url('/')); ?>/assets/global/plugins/select2/css/select2-bootstrap.min.css" rel="stylesheet" type="text/css" />
<!-- BEGIN THEME GLOBAL STYLES -->
<link href="<?php echo e(url('/')); ?>/assets/global/css/plugins-md.min.css" rel="stylesheet" type="text/css" />
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
<?php $__env->stopSection(); ?>
<?php $__env->startSection('content'); ?>

<input type="hidden" value="<?php echo e($user->id); ?>" name="merchant_id" id="merchant_id">
<div class="row">

    <div class="col-md-12">
        <!-- BEGIN EXAMPLE TABLE PORTLET-->
        <div class="card card-custom">
            <div class="card-header">
                <div class="card-title">
                    <i class="<?php echo e($icon); ?> font-dark"></i>
                    <span class="caption-subject bold uppercase"> <?php echo e($main_title); ?></span>
                </div>

            </div>

            <div class="card-body form">
                <div class="table-container">
                    <form class="form-horizontal" role="form">
                        <div class="form-body">
                            <div class="form-group ">

                                <table class="table table-striped table-bordered table-hover table-checkable order-column" id="merchant-det-tbl">
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
                                                        <img src="<?php echo e($user->store_images[0]->image100 ?? url('assets/apps/img/shop.png')); ?>" style="width:100px;height: 100px;">
                                                    </div>

                                                </div>
                                            </td>
                                            <td><?php echo e($user->username ?? ''); ?></td>

                                            <td> <?php echo e($user->email ?? ''); ?></td>
                                            <td> <?php echo e($user->mobile ?? ''); ?></td>
                                            <td style="    text-align: left !important;">
                                                <ul>
                                                    <?php if($user->has_merchant_driver): ?>
                                                    <li>Merchant driver</li>
                                                    <?php endif; ?>
                                                    <?php if($user->has_freelancer_driver): ?>
                                                    <li>Freelancer driver</li>
                                                    <?php endif; ?>
                                                    <?php if($user->has_dragonmart_driver): ?>
                                                    <li>Dragonmart driver</li>
                                                    <?php endif; ?>
                                                </ul>
                                            </td>
                                            <td><?php echo e(\Carbon\Carbon::parse($user->created_at)->format('Y-m-d') ?? ''); ?></td>
                                            <td><?php echo e($user->city->name_en ?? ''); ?></td>

                                            <td><a href="<?php echo e(url(admin_user_tab_url() . '/user/' . $user->id)); ?>" class="btn btn-circle btn-icon-only blue user-det" title="Address">
                                                    <i class="fa fa-map"></i>
                                                </a></td>
                                            <td><a href="javascript:;" class="btn btn-circle btn-icon-only <?php if($user->is_active): ?> red <?php else: ?> green <?php endif; ?> set_active" data-id="<?php echo e($user->id); ?>" title="<?php if($user->is_active): ?> Suspend <?php else: ?> Activate <?php endif; ?>">
                                                    <i class="<?php if($user->is_active): ?>fa fa-power-off <?php else: ?> fa fa-check <?php endif; ?>"></i>
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
            <div class="card-body">
                <ul class="nav nav-tabs mb-5">

                    
                    
                    
                    <li class="nav-item">
                        <a class="nav-link active" href="#bank_details" data-toggle="tab"> Bank Details </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#shipping" data-toggle="tab"> Shipping </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#commission" data-toggle="tab"> Commission Rate </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#categories" data-toggle="tab"> Categories </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#products" data-toggle="tab"> Products </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#orders" data-toggle="tab"> Orders </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#drivers" data-toggle="tab"> Drivers </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#commercial_info" data-toggle="tab"> <?php echo e(trans(lang_app_site().'.CP.Commercial Information')); ?> </a>
                    </li>


                </ul>
                <div class="tab-content">

                    <div class="tab-pane fade active show" id="bank_details">

                        <div class="portlet-body form">
                            <table class="table table-striped table-bordered table-hover table-checkable order-column" id="">
                                <thead>
                                    <tr>
                                        <th></th>
                                        <th> Bank name</th>
                                        <th> Branch code</th>
                                        <th> Bank address</th>
                                        <th> Account name</th>
                                        <th> Account number</th>
                                        
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td></td>
                                        <td><input type="text" value="<?php echo e($bank->bank_name ?? ''); ?>" name="" id="" class="form-control" placeholder="Bank name ..." disabled></td>
                                        <td><input type="text" value="<?php echo e($bank->branch_code ?? ''); ?>" name="" id="" class="form-control" placeholder="Branch code ..." disabled></td>
                                        <td><input type="text" value="<?php echo e($bank->bank_address ?? ''); ?>" name="" id="" class="form-control" placeholder="Bank address ..." disabled></td>
                                        <td><input type="text" value="<?php echo e($bank->account_name ?? ''); ?>" name="" id="" class="form-control" placeholder="Account name ..." disabled></td>
                                        <td><input type="text" value="<?php echo e($bank->account_number ?? ''); ?>" name="" id="" class="form-control" placeholder="Account number ..." disabled></td>
                                        
                                        

                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <div class="tab-pane fade" id="shipping">

                        <div class="portlet-body form">
                            <div class="form-body">
                                <?php echo Form::open(['method'=>'POST','class'=>'form-horizontal form-bordered form-row-stripped']); ?>

                                <div class="form-group">
                                    <div class="control-label col-md-2">
                                        <label for="driver_types">Delivery method provided</label>
                                    </div>
                                    <div class="col-md-8">
                                        <select class="form-control select2" name="driver_type_id[]" multiple id="driver_type_id">
                                            <?php $__currentLoopData = $driver_types; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $type): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <option value="<?php echo e($type->id); ?>" <?php if(in_array($type->id,$driver_type_ids)): ?> selected <?php endif; ?>><?php echo e($type->name); ?></option>
                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                        </select>
                                    </div>
                                    <div class="col-md-2">
                                        <button type="button" class="btn btn-circle green save add-delivery-method">
                                            <i class="fa fa-check"></i>
                                            Save
                                        </button>
                                    </div>
                                </div>
                                <?php echo Form::close(); ?>

                            </div>


                            
                            
                            
                            
                            
                            
                            
                            
                            
                            
                            
                            
                            
                            
                            
                            
                            <table class="table table-striped table-bordered table-hover table-checkable order-column" id="merchant-shipments-tbl">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th> Distance (Km)</th>
                                        <th> Price (SAR)</th>
                                        <th> Min. order amount (SAR)</th>
                                    </tr>
                                </thead>
                            </table>
                        </div>
                    </div>
                    <div class="tab-pane fade" id="commission">

                        <div class="portlet-body form">
                            <div class="form-body">
                                <?php echo Form::open(['method'=>'PUT','class'=>'form-horizontal form-bordered form-row-stripped','url'=>url(admin_user_tab_url().'/profile/'.$user->id),'id'=>'editProfile']); ?>

                                <div class="form-group">
                                    <div class="control-label col-md-2">
                                        <label for="commission_rate">Commission rate (%)</label>
                                    </div>
                                    <div class="col-md-6">
                                        <input class="form-control" value="<?php echo e($user->commission_rate); ?>" name="commission_rate" id="commission_rate" placeholder="20%">
                                    </div>
                                    <div class="col-md-2">
                                        <button type="submit" class="btn btn-circle green save">
                                            <i class="fa fa-check"></i>
                                            Save
                                        </button>
                                    </div>
                                </div>
                                <?php echo Form::close(); ?>

                            </div>
                        </div>
                    </div>
                    <div class="tab-pane fade" id="categories">
                        <div class="portlet-body form">

                            <div class="form-body">
                                <?php echo Form::open(['method'=>'POST','url'=>url(admin_user_tab_url().'/add-merchant-category/'.$user->id),'class'=>'form-horizontal form-bordered form-row-stripped','id'=>'addMerchantCategory']); ?>

                                <div class="form-group">
                                    <div class="control-label col-md-2">
                                        <label for="Category name">Category name</label>
                                    </div>
                                    <div class="col-md-6">
                                        <select class="form-control" name="category_id">
                                            <?php $__currentLoopData = $categories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $category): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <option value="<?php echo e($category->id); ?>"><?php echo e($category->name); ?></option>
                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                        </select>
                                    </div>
                                    <div class="col-md-2">
                                        <button type="submit" class="btn btn-circle green save"><i class="fa fa-check"></i>
                                            Add
                                        </button>
                                    </div>
                                </div>
                                <?php echo Form::close(); ?>

                            </div>
                        </div>
                        <div class="portlet-body form">
                            <table class="table table-striped table-bordered table-hover table-checkable order-column" id="merchant-categories-tbl">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th> Category name</th>
                                        <th> Action</th>
                                    </tr>
                                </thead>
                                
                                
                                
                                
                                
                                
                                
                                
                                
                                
                                
                                
                                
                                
                                
                                
                            </table>
                        </div>
                    </div>
                    <div class="tab-pane fade" id="products">

                        <div class="portlet-body form">
                            <div class="actions pull-right">
                                <a href="<?php echo e(url(admin_vw().'/'.$user->id.'/product/create')); ?>" class="btn btn-circle btn-success add-product-mdl2">
                                    <i class="fa fa-plus"></i>
                                    <span class="hidden-xs"> Add New </span>
                                </a>
                            </div>

                            <div class="portlet light">
                                <div class="portlet-title">
                                    <div class="caption font-dark">
                                        <i class="fa fa-search font-dark"></i>
                                        <span class="caption-subject bold uppercase"> Filter </span>
                                    </div>

                                </div>
                                <div class="portlet-body">
                                    <div class="table-container">
                                        
                                        <form method="POST" action="#">
                                            <table class="table table-striped table-bordered table-hover table-checkable" id="datatable_products">
                                                <thead>
                                                    <tr role="row" class="heading">
                                                        <th width="1%">
                                                        </th>

                                                        <th width="10%"> Name</th>
                                                        <th width="10%"> Offer</th>
                                                        <th width="10%"> Sponsor</th>
                                                        
                                                        
                                                        <th width="10%"> Category</th>
                                                        <th width="10%"> Action</th>
                                                    </tr>
                                                    <tr role="row" class="filter">
                                                        <td></td>
                                                        <td>
                                                            <input type="text" class="form-control form-filter input-md" name="name" placeholder=" Name" id="product_name">
                                                        </td>

                                                        <td>
                                                            <select class="form-control input-md is_offer" name="is_offer" id="is_offer" data-placeholder="Choose Offer Status">
                                                                <option value="">Choose Offer Status</option>
                                                                <option value="0">No</option>
                                                                <option value="1">Yes</option>
                                                            </select>
                                                        </td>

                                                        <td>
                                                            <select class="form-control input-md is_sponsor" name="is_sponsor" id="is_sponsor" data-placeholder="Choose Sponsor Status">
                                                                <option value="">Choose Sponsor Status</option>
                                                                <option value="0">No</option>
                                                                <option value="1">Yes</option>
                                                            </select>
                                                        </td>
                                                        <td>
                                                            <select class="form-control input-md category_id" name="category_id" id="category_id" data-placeholder="Choose Category">
                                                                <option value="">Choose Category</option>
                                                                <?php $__currentLoopData = $categories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $category): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                                <option value="<?php echo e($category->id); ?>"><?php echo e($category->name); ?></option>
                                                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                            </select>
                                                        </td>
                                                        <td>
                                                            <div class="margin-bottom-5">
                                                                <a href="javascript:;" class="btn btn-sm btn-success filter-submit-product btn-circle btn-icon-only margin-bottom" title="filter">
                                                                    <i class="fa fa-search"></i>
                                                                </a>

                                                                <a href="javascript:;" class="btn btn-sm btn-danger btn-circle btn-icon-only filter-cancel-product" title="Empty fields">
                                                                    <i class="fa fa-rotate-left"></i>
                                                                </a>
                                                            </div>

                                                        </td>
                                                    </tr>
                                                </thead>
                                                <tbody></tbody>
                                            </table>
                                            
                                        </form>
                                    </div>
                                </div>
                            </div>

                            <table class="table table-striped table-bordered table-hover table-checkable order-column" id="products_tbl" data-merchant-id="<?php echo e($user->id); ?>">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th> Product name</th>
                                        <th> Price</th>
                                        <th> Quantity</th>
                                        <th> Category</th>
                                        <th> Is sponsor</th>
                                        <th> Is offer</th>
                                        <th> Offer %</th>
                                        <th> Action</th>
                                    </tr>
                                </thead>
                            </table>
                        </div>
                    </div>
                    <div class="tab-pane fade" id="orders">

                        <div class="portlet-body form">
                            <table class="table table-striped table-bordered table-hover table-checkable order-column" id="merchant-orders-tbl">
                                <thead>
                                    
                                    
                                    
                                    
                                    
                                    
                                    
                                    
                                    
                                    
                                    
                                    
                                    
                                    
                                    <tr>
                                        <th>#</th>
                                        <th> Order #</th>
                                        <th> Merchant</th>
                                        <th> Order date</th>
                                        <th> Delivery/pickup date</th>
                                        <th> Actual receive date</th>
                                        <th> Items #</th>
                                        <th> Procurement method</th>
                                        <th> Delivery method</th>
                                        <th> Driver name</th>
                                        <th> Order amount (SAR)</th>
                                        <th> Shipping rate (SAR)</th>
                                        <th> Action</th>
                                    </tr>
                                </thead>
                            </table>
                        </div>
                    </div>
                    <div class="tab-pane fade" id="drivers">

                        <div class="portlet-body form">
                            <table class="table table-striped table-bordered table-hover table-checkable order-column" id="drivers_tbl">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th> Logo</th>
                                        <th> Username</th>
                                        <th> Email</th>
                                        <th> Address</th>
                                        <th> Mobile</th>
                                        <th> Driver Type</th>
                                        <th> Vehicle Type</th>
                                        <th> Vehicle Color</th>
                                        <th> Vehicle Number</th>
                                        <th> Status</th>
                                        <th> Action</th>
                                    </tr>
                                </thead>
                            </table>
                        </div>
                    </div>
                    <div class="tab-pane fade" id="commercial_info">

                        <div class="portlet-body form">
                            <div class="form-body">
                                <?php echo Form::open(['method'=>'PUT','class'=>'form-horizontal form-bordered form-row-stripped','url'=>url(admin_user_tab_url().'/profile/'.$user->id),'id'=>'editProfile']); ?>

                                <div class="form-group">
                                    <div class="form-group row">
                                        <div class="col-lg-12">
                                            <label><?php echo e(trans(lang_app_site().'.CP.Commercial name')); ?></label>
                                            <input id="commercial_name" class="form-control" name="commercial_name" type="text" placeholder="<?php echo e(trans(lang_app_site().'.CP.Commercial name')); ?>" value="<?php echo e($user->commercial_name ?? ''); ?>">
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <div class="col-lg-6">
                                            <label><?php echo e(trans(lang_app_site().'.CP.Commercial register')); ?></label>
                                            <input id="commercial_register" class="form-control" name="commercial_register" type="text" placeholder="<?php echo e(trans(lang_app_site().'.CP.Commercial register')); ?>" value="<?php echo e($user->commercial_register ?? ''); ?>">
                                        </div>
                                        <div class="col-lg-6">
                                            <label><?php echo e(trans(lang_app_site().'.CP.Tax number')); ?></label>
                                            <input id="tax_number" class="form-control" name="tax_number" type="text" placeholder="<?php echo e(trans(lang_app_site().'.CP.Tax number')); ?>" value="<?php echo e($user->tax_number ?? ''); ?>">
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <div class="col-md-12 text-center">
                                            <label class="checkbox">
                                                <input type="checkbox" name="is_commercial" value="1" <?php if($user->is_commercial == 1): ?> checked <?php endif; ?>/>
                                                <span></span>
                                                &nbsp;
                                                <?php echo e(trans(lang_app_site().'.CP.Is Confirmed?')); ?>

                                            </label>
                                            <button type="submit" class="btn btn-circle btn-info save">
                                                <i class="fa fa-check"></i>
                                                <?php echo e(trans(lang_app_site().'.CP.Save')); ?>

                                            </button>
                                        </div>
                                    </div>
                                </div>
                                <?php echo Form::close(); ?>

                            </div>
                        </div>
                    </div>

                </div>
                <div class="clearfix margin-bottom-20"></div>
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
<?php $__env->stopSection(); ?>

<?php $__env->startSection('js'); ?>

<!-- BEGIN PAGE LEVEL PLUGINS -->
<script src="<?php echo e(url('/')); ?>/assets/global/scripts/datatable.js" type="text/javascript"></script>
<script src="<?php echo e(url('/')); ?>/assets/global/plugins/datatables/datatables.min.js" type="text/javascript"></script>
<script src="<?php echo e(url('/')); ?>/assets/global/plugins/datatables/plugins/bootstrap/datatables.bootstrap.js" type="text/javascript"></script>
<!-- END PAGE LEVEL PLUGINS -->
<script src="<?php echo e(url('/')); ?>/assets/global/plugins/select2/js/select2.full.min.js" type="text/javascript"></script>

<script src="<?php echo e(url('/')); ?>/assets/global/plugins/jquery-ui/jquery-ui.min.js" type="text/javascript"></script>

<!-- BEGIN THEME GLOBAL SCRIPTS -->
<script src="<?php echo e(url('/')); ?>/assets/global/scripts/app.min.js" type="text/javascript"></script>
<!-- END THEME GLOBAL SCRIPTS -->
<script src="<?php echo e(url('/')); ?>/assets/pages/scripts/components-bootstrap-switch.min.js" type="text/javascript"></script>
<script src="<?php echo e(url('/')); ?>/assets/pages/scripts/ui-modals.min.js" type="text/javascript"></script>

<!-- BEGIN PAGE LEVEL SCRIPTS -->
<script src="<?php echo e(url('/')); ?>/assets/pages/scripts/table-datatables-responsive.min.js" type="text/javascript"></script>

<!-- END PAGE LEVEL SCRIPTS -->
<script src="<?php echo e(url('/')); ?>/assets/js/merchants.js" type="text/javascript"></script>
<script src="<?php echo e(url('/')); ?>/assets/js/products.js" type="text/javascript"></script>
<script src="<?php echo e(url('/')); ?>/assets/js/users.js" type="text/javascript"></script>
<script src="<?php echo e(url('/')); ?>/assets/js/stores.js" type="text/javascript"></script>
<script src="<?php echo e(url('/')); ?>/assets/js/orders.js" type="text/javascript"></script>
<script>
    $('.select2').select2({
        placeholder: "Select...",
        allowClear: true
    });
</script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make(admin_layout_vw().'.index', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/saudidragonmart/public_html/resources/views/admin/merchants/view.blade.php ENDPATH**/ ?>