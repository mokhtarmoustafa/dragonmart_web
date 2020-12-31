<?php $__env->startSection('css'); ?>
<!-- BEGIN PAGE LEVEL PLUGINS -->
<!-- END THEME GLOBAL STYLES -->
<style>
    .form .form-section,
    .portlet-form .form-section {
        margin: 0 !important;
        padding: 0 !important;
    }
</style>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('content'); ?>

<div class="card card-custom">
    <div class="card-header">
        <div class="card-title">
            <i class="<?php echo e($icon); ?> font-dark"></i>
            <span class="caption-subject bold uppercase"> <?php echo e(trans(lang_app_site().'.CP.'.$main_title)); ?></span>
        </div>

    </div>


    <div class="card-body">
        <div class="row">
            <div class="col-md-12">
                <div class="portlet light ">
                    <div class="portlet-body">
                        <ul class="nav nav-tabs">

                            <li class="nav-item">
                                <a class="nav-link active" href="#customers" data-toggle="tab">
                                    <span class="nav-text"> <?php echo e(trans(lang_app_site().'.CP.Clients')); ?> </span>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="#merchants" data-toggle="tab">
                                    <span class="nav-text"> <?php echo e(trans(lang_app_site().'.CP.Merchants')); ?></span>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="#drivers" data-toggle="tab">
                                    <span class="nav-text"> <?php echo e(trans(lang_app_site().'.CP.Drivers')); ?></span>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="#service_providers" data-toggle="tab">
                                    <span class="nav-text"> <?php echo e(trans(lang_app_site().'.CP.Service providers')); ?></span>
                                </a>
                            </li>


                        </ul>
                        <div class="tab-content">

                            <div class="tab-pane fade active show" id="customers">

                                <div class="portlet-body form">
                                    <div class="row">

                                        <div class="col-md-12">
                                            <!-- BEGIN EXAMPLE TABLE PORTLET-->
                                            <div class="card card-custom shadow m-5">
                                                <div class="card-header">
                                                    <div class="card-title">
                                                        <i class="fa fa-search font-dark"></i>
                                                        &nbsp;
                                                        <span class="caption-subject bold uppercase"> <?php echo e(trans(lang_app_site().'.CP.Filter')); ?> </span>
                                                    </div>

                                                </div>
                                                <div class="card-body">
                                                    <div class="table-container">
                                                        <?php echo Form::open(['method'=>'POST','url'=>url(admin_manage_url().'/admin/export')]); ?>


                                                        <table class="table table-striped table-bordered table-hover table-checkable" id="datatable_products">
                                                            <thead>
                                                                <tr role="row" class="heading">
                                                                    <th width="1%">
                                                                        
                                                                        
                                                                        
                                                                        
                                                                        
                                                                    </th>
                                                                    
                                                                    <th width="10%"> <?php echo e(trans(lang_app_site().'.CP.Username')); ?></th>
                                                                    <th width="10%"> <?php echo e(trans(lang_app_site().'.CP.Email')); ?></th>
                                                                    <th width="10%"> <?php echo e(trans(lang_app_site().'.CP.Phone')); ?></th>
                                                                    
                                                                    <th width="10%"> <?php echo e(trans(lang_app_site().'.CP.Status')); ?></th>
                                                                    <th width="10%"> <?php echo e(trans(lang_app_site().'.CP.Action')); ?></th>
                                                                </tr>
                                                                <tr role="row" class="filter">
                                                                    <td></td>
                                                                    <td>
                                                                        <input type="text" class="form-control form-filter input-md" name="username" placeholder="<?php echo e(trans(lang_app_site().'.CP.Username')); ?>" id="username_c">

                                                                    </td>
                                                                    <td>
                                                                        <input type="email" class="form-control form-filter input-md" name="email" placeholder="<?php echo e(trans(lang_app_site().'.CP.Email')); ?>" id="email_c">
                                                                    </td>
                                                                    <td>
                                                                        <input type="text" class="form-control form-filter input-md" name="mobile" placeholder="<?php echo e(trans(lang_app_site().'.CP.Phone')); ?>" id="mobile_c">
                                                                    </td>
                                                                    
                                                                    
                                                                    
                                                                    
                                                                    
                                                                    
                                                                    
                                                                    
                                                                    
                                                                    <td>
                                                                        <select class="form-control input-md" name="is_active" id="is_active_c" data-placeholder="Choose Status">
                                                                            <option value=""><?php echo e(trans(lang_app_site().'.CP.Choose Status')); ?></option>
                                                                            <option value="0"><?php echo e(trans(lang_app_site().'.CP.Disable')); ?></option>
                                                                            <option value="1"><?php echo e(trans(lang_app_site().'.CP.Active')); ?></option>
                                                                        </select>
                                                                    </td>
                                                                    <td>
                                                                        <div class="margin-bottom-5">
                                                                            <a href="javascript:;" class="btn btn-sm btn-success btn-circle btn-icon-only filter-submit-u margin-bottom" title="Search">
                                                                                <i class="fa fa-search"></i>
                                                                            </a>

                                                                            <a href="javascript:;" class="btn btn-sm btn-danger btn-circle btn-icon-only filter-cancel-u" title="Empty">
                                                                                <i class="fa fa-times"></i>
                                                                            </a>
                                                                        </div>

                                                                    </td>
                                                                </tr>
                                                            </thead>
                                                            <tbody></tbody>
                                                        </table>
                                                        <?php echo Form::close(); ?>


                                                    </div>
                                                </div>
                                            </div>
                                            <div class="card card-custom shadow m-5">
                                                <div class="card-header">
                                                    <div class="card-title">
                                                        <i class="<?php echo e($icon); ?> font-dark"></i>
                                                        <span class="caption-subject bold uppercase"> <?php echo e(trans(lang_app_site().'.CP.Clients')); ?></span>
                                                    </div>
                                                    
                                                    
                                                    
                                                    
                                                    
                                                    
                                                    

                                                </div>
                                                <div class="card-body">
                                                    

                                                    <table class="table table-striped table-hover table-checkable order-column" id="users_tbl">
                                                        <thead>
                                                            <tr>
                                                                <th>#</th>
                                                                
                                                                <th> <?php echo e(trans(lang_app_site().'.CP.Username')); ?></th>
                                                                <th> <?php echo e(trans(lang_app_site().'.CP.Email')); ?></th>
                                                                
                                                                <th> <?php echo e(trans(lang_app_site().'.CP.Phone')); ?></th>
                                                                
                                                                
                                                                <th> <?php echo e(trans(lang_app_site().'.CP.Address')); ?></th>
                                                                <th> <?php echo e(trans(lang_app_site().'.CP.Status')); ?></th>
                                                                <th> <?php echo e(trans(lang_app_site().'.CP.Action')); ?></th>
                                                            </tr>
                                                        </thead>
                                                    </table>
                                                </div>
                                            </div>
                                            <!-- END EXAMPLE TABLE PORTLET-->
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="tab-pane fade " id="merchants">

                                <div class="portlet-body form">
                                    <div class="row">

                                        <div class="col-md-12">
                                            <!-- BEGIN EXAMPLE TABLE PORTLET-->
                                            <div class="card card-custom shadow m-5">
                                                <div class="card-header">
                                                    <div class="card-title">
                                                        <i class="fa fa-search font-dark"></i>
                                                        &nbsp;
                                                        <span class="caption-subject bold uppercase"> <?php echo e(trans(lang_app_site().'.CP.Filter')); ?> </span>
                                                    </div>

                                                </div>
                                                <div class="card-body">
                                                    <div class="table-container">
                                                        <?php echo Form::open(['method'=>'POST','url'=>url('/admin/export')]); ?>


                                                        <table class="table table-striped table-bordered table-hover table-checkable" id="datatable_products">
                                                            <thead>
                                                                <tr role="row" class="heading">
                                                                    <th width="1%">
                                                                        
                                                                        
                                                                        
                                                                        
                                                                        
                                                                    </th>
                                                                    
                                                                    <th width="10%"> <?php echo e(trans(lang_app_site().'.CP.Username')); ?></th>
                                                                    <th width="10%"> <?php echo e(trans(lang_app_site().'.CP.Email')); ?></th>
                                                                    <th width="10%"> <?php echo e(trans(lang_app_site().'.CP.Phone')); ?></th>
                                                                    <th width="10%"> <?php echo e(trans(lang_app_site().'.CP.Status')); ?></th>
                                                                    <th width="10%"> <?php echo e(trans(lang_app_site().'.CP.Action')); ?></th>
                                                                </tr>
                                                                <tr role="row" class="filter">
                                                                    <td></td>
                                                                    <td>
                                                                        <input type="text" class="form-control form-filter input-md" name="username" placeholder="<?php echo e(trans(lang_app_site().'.CP.Username')); ?>" id="username_m">

                                                                    </td>
                                                                    <td>
                                                                        <input type="email" class="form-control form-filter input-md" name="email" placeholder="<?php echo e(trans(lang_app_site().'.CP.Email')); ?>" id="email_m">
                                                                    </td>
                                                                    <td>
                                                                        <input type="text" class="form-control form-filter input-md" name="mobile" placeholder="<?php echo e(trans(lang_app_site().'.CP.Phone')); ?>" id="mobile_m">
                                                                    </td>

                                                                    <td>
                                                                        <select class="form-control input-md" name="is_active" id="is_active_m" data-placeholder="Choose Status">
                                                                            <option value=""><?php echo e(trans(lang_app_site().'.CP.Choose Status')); ?></option>
                                                                            <option value="0"><?php echo e(trans(lang_app_site().'.CP.Disable')); ?></option>
                                                                            <option value="1"><?php echo e(trans(lang_app_site().'.CP.Active')); ?></option>
                                                                        </select>
                                                                    </td>
                                                                    <td>
                                                                        <div class="margin-bottom-5">
                                                                            <a href="javascript:;" class="btn btn-sm btn-success btn-circle btn-icon-only filter-submit-m margin-bottom" title="Search">
                                                                                <i class="fa fa-search"></i>
                                                                            </a>

                                                                            <a href="javascript:;" class="btn btn-sm btn-danger btn-circle btn-icon-only filter-cancel-m" title="Empty">
                                                                                <i class="fa fa-times"></i>
                                                                            </a>
                                                                        </div>

                                                                    </td>
                                                                </tr>
                                                            </thead>
                                                            <tbody></tbody>
                                                        </table>
                                                        <?php echo Form::close(); ?>


                                                    </div>
                                                </div>
                                            </div>
                                            <div class="card card-custom shadow m-5">
                                                <div class="card-header">
                                                    <div class="card-title">
                                                        <i class="<?php echo e($icon); ?> font-dark"></i>
                                                        <span class="caption-subject bold uppercase"> <?php echo e(trans(lang_app_site().'.CP.Merchants')); ?></span>
                                                    </div>
                                                    <div class="card-toolbar">
                                                        <a href="<?php echo e(url('admin/merchant-create')); ?>" class="btn btn-circle btn-primary add-merchant-mdl">
                                                            <i class="fa fa-user-plus"></i>
                                                            <span class="hidden-xs"> <?php echo e(trans(lang_app_site().'.CP.Add New Merchant')); ?> </span>
                                                        </a>
                                                    </div>

                                                </div>
                                                <div class="card-body">
                                                    

                                                    <table class="table table-striped table-hover table-checkable order-column" id="merchants_tbl">
                                                        <thead>
                                                            <tr>
                                                                <th>#</th>
                                                                <th> <?php echo e(trans(lang_app_site().'.CP.Logo')); ?></th>
                                                                <th> <?php echo e(trans(lang_app_site().'.CP.Username')); ?></th>
                                                                <th> <?php echo e(trans(lang_app_site().'.CP.Email')); ?></th>
                                                                
                                                                <th> <?php echo e(trans(lang_app_site().'.CP.Phone')); ?></th>
                                                                
                                                                
                                                                <th> <?php echo e(trans(lang_app_site().'.CP.City')); ?></th>
                                                                <th> <?php echo e(trans(lang_app_site().'.CP.Address')); ?></th>
                                                                <th> <?php echo e(trans(lang_app_site().'.CP.Status')); ?></th>
                                                                <th> <?php echo e(trans(lang_app_site().'.CP.Action')); ?></th>
                                                            </tr>
                                                        </thead>
                                                    </table>
                                                </div>
                                            </div>
                                            <!-- END EXAMPLE TABLE PORTLET-->
                                        </div>
                                    </div>

                                </div>
                            </div>
                            <div class="tab-pane fade " id="drivers">
                                <div class="portlet-body form">
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="row mt-5">
                                                <div class="col-xl-3">
                                                    <!--begin::Stats Widget 25-->
                                                    <div class="card card-custom bg-light-success card-stretch gutter-b shadow">
                                                        <!--begin::Body-->
                                                        <div class="card-body">
                                                            <span class="svg-icon svg-icon-2x svg-icon-success">
                                                                <!--begin::Svg Icon | path:/metronic/theme/html/demo1/dist/assets/media/svg/icons/Communication/Group.svg-->
                                                                <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
                                                                    <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                                                        <polygon points="0 0 24 0 24 24 0 24"></polygon>
                                                                        <path d="M18,14 C16.3431458,14 15,12.6568542 15,11 C15,9.34314575 16.3431458,8 18,8 C19.6568542,8 21,9.34314575 21,11 C21,12.6568542 19.6568542,14 18,14 Z M9,11 C6.790861,11 5,9.209139 5,7 C5,4.790861 6.790861,3 9,3 C11.209139,3 13,4.790861 13,7 C13,9.209139 11.209139,11 9,11 Z" fill="#000000" fill-rule="nonzero" opacity="0.3"></path>
                                                                        <path d="M17.6011961,15.0006174 C21.0077043,15.0378534 23.7891749,16.7601418 23.9984937,20.4 C24.0069246,20.5466056 23.9984937,21 23.4559499,21 L19.6,21 C19.6,18.7490654 18.8562935,16.6718327 17.6011961,15.0006174 Z M0.00065168429,20.1992055 C0.388258525,15.4265159 4.26191235,13 8.98334134,13 C13.7712164,13 17.7048837,15.2931929 17.9979143,20.2 C18.0095879,20.3954741 17.9979143,21 17.2466999,21 C13.541124,21 8.03472472,21 0.727502227,21 C0.476712155,21 -0.0204617505,20.45918 0.00065168429,20.1992055 Z" fill="#000000" fill-rule="nonzero"></path>
                                                                    </g>
                                                                </svg>
                                                                <!--end::Svg Icon-->
                                                            </span>
                                                            <span class="card-title font-weight-bolder text-dark-75 font-size-h2 mb-0 mt-6 d-block"><?php echo e(App\User::where('type', 'driver')->where('is_driver_available', 1)->where('is_active', 1)->count()); ?></span>
                                                            <span class="font-weight-bold text-muted font-size-sm"><?php echo e(trans(lang_app_site().'.CP.Online')); ?></span>
                                                        </div>
                                                        <!--end::Body-->
                                                    </div>
                                                    <!--end::Stats Widget 25-->
                                                </div>
                                                <div class="col-xl-3">
                                                    <!--begin::Stats Widget 28-->
                                                    <div class="card card-custom bg-light-warning card-stretch gutter-b shadow">
                                                        <!--begin::Body-->
                                                        <div class="card-body">
                                                            <span class="svg-icon svg-icon-2x svg-icon-warning">
                                                                <!--begin::Svg Icon | path:/metronic/theme/html/demo1/dist/assets/media/svg/icons/Communication/Group.svg-->
                                                                <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
                                                                    <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                                                        <polygon points="0 0 24 0 24 24 0 24"></polygon>
                                                                        <path d="M18,14 C16.3431458,14 15,12.6568542 15,11 C15,9.34314575 16.3431458,8 18,8 C19.6568542,8 21,9.34314575 21,11 C21,12.6568542 19.6568542,14 18,14 Z M9,11 C6.790861,11 5,9.209139 5,7 C5,4.790861 6.790861,3 9,3 C11.209139,3 13,4.790861 13,7 C13,9.209139 11.209139,11 9,11 Z" fill="#000000" fill-rule="nonzero" opacity="0.3"></path>
                                                                        <path d="M17.6011961,15.0006174 C21.0077043,15.0378534 23.7891749,16.7601418 23.9984937,20.4 C24.0069246,20.5466056 23.9984937,21 23.4559499,21 L19.6,21 C19.6,18.7490654 18.8562935,16.6718327 17.6011961,15.0006174 Z M0.00065168429,20.1992055 C0.388258525,15.4265159 4.26191235,13 8.98334134,13 C13.7712164,13 17.7048837,15.2931929 17.9979143,20.2 C18.0095879,20.3954741 17.9979143,21 17.2466999,21 C13.541124,21 8.03472472,21 0.727502227,21 C0.476712155,21 -0.0204617505,20.45918 0.00065168429,20.1992055 Z" fill="#000000" fill-rule="nonzero"></path>
                                                                    </g>
                                                                </svg>
                                                                <!--end::Svg Icon-->
                                                            </span>
                                                            <span class="card-title font-weight-bolder text-dark-75 font-size-h2 mb-0 mt-6 d-block"><?php echo e(App\User::where('type', 'driver')->where('is_driver_available', 0)->where('is_active', 1)->count()); ?></span>
                                                            <span class="font-weight-bold text-muted font-size-sm"><?php echo e(trans(lang_app_site().'.CP.Offline')); ?></span>
                                                        </div>
                                                        <!--end::Body-->
                                                    </div>
                                                    <!--end::Stat: Widget 28-->
                                                </div>
                                                <div class="col-xl-3">
                                                    <!--begin::Stats Widget 26-->
                                                    <div class="card card-custom bg-light-danger card-stretch gutter-b shadow">
                                                        <!--begin::ody-->
                                                        <div class="card-body">
                                                            <span class="svg-icon svg-icon-2x svg-icon-danger">
                                                                <!--begin::Svg Icon | path:/metronic/theme/html/demo1/dist/assets/media/svg/icons/Communication/Group.svg-->
                                                                <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
                                                                    <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                                                        <polygon points="0 0 24 0 24 24 0 24"></polygon>
                                                                        <path d="M18,14 C16.3431458,14 15,12.6568542 15,11 C15,9.34314575 16.3431458,8 18,8 C19.6568542,8 21,9.34314575 21,11 C21,12.6568542 19.6568542,14 18,14 Z M9,11 C6.790861,11 5,9.209139 5,7 C5,4.790861 6.790861,3 9,3 C11.209139,3 13,4.790861 13,7 C13,9.209139 11.209139,11 9,11 Z" fill="#000000" fill-rule="nonzero" opacity="0.3"></path>
                                                                        <path d="M17.6011961,15.0006174 C21.0077043,15.0378534 23.7891749,16.7601418 23.9984937,20.4 C24.0069246,20.5466056 23.9984937,21 23.4559499,21 L19.6,21 C19.6,18.7490654 18.8562935,16.6718327 17.6011961,15.0006174 Z M0.00065168429,20.1992055 C0.388258525,15.4265159 4.26191235,13 8.98334134,13 C13.7712164,13 17.7048837,15.2931929 17.9979143,20.2 C18.0095879,20.3954741 17.9979143,21 17.2466999,21 C13.541124,21 8.03472472,21 0.727502227,21 C0.476712155,21 -0.0204617505,20.45918 0.00065168429,20.1992055 Z" fill="#000000" fill-rule="nonzero"></path>
                                                                    </g>
                                                                </svg>
                                                                <!--end::Svg Icon-->
                                                            </span>
                                                            <span class="card-title font-weight-bolder text-dark-75 font-size-h2 mb-0 mt-6 d-block"><?php echo e(App\User::where('type', 'driver')->where('is_active', 0)->count()); ?></span>
                                                            <span class="font-weight-bold text-muted font-size-sm"><?php echo e(trans(lang_app_site().'.CP.disabled')); ?></span>
                                                        </div>
                                                        <!--end::Body-->
                                                    </div>
                                                    <!--end::Stats Widget 26-->
                                                </div>
                                                <div class="col-xl-3">
                                                    <!--begin::Stats Widget 26-->
                                                    <div class="card card-custom bg-white card-stretch gutter-b shadow">
                                                        <!--begin::ody-->
                                                        <div class="card-body">
                                                            <span class="svg-icon svg-icon-2x svg-icon-black">
                                                                <!--begin::Svg Icon | path:/metronic/theme/html/demo1/dist/assets/media/svg/icons/Communication/Group.svg-->
                                                                <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
                                                                    <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                                                        <polygon points="0 0 24 0 24 24 0 24"></polygon>
                                                                        <path d="M18,14 C16.3431458,14 15,12.6568542 15,11 C15,9.34314575 16.3431458,8 18,8 C19.6568542,8 21,9.34314575 21,11 C21,12.6568542 19.6568542,14 18,14 Z M9,11 C6.790861,11 5,9.209139 5,7 C5,4.790861 6.790861,3 9,3 C11.209139,3 13,4.790861 13,7 C13,9.209139 11.209139,11 9,11 Z" fill="#000000" fill-rule="nonzero" opacity="0.3"></path>
                                                                        <path d="M17.6011961,15.0006174 C21.0077043,15.0378534 23.7891749,16.7601418 23.9984937,20.4 C24.0069246,20.5466056 23.9984937,21 23.4559499,21 L19.6,21 C19.6,18.7490654 18.8562935,16.6718327 17.6011961,15.0006174 Z M0.00065168429,20.1992055 C0.388258525,15.4265159 4.26191235,13 8.98334134,13 C13.7712164,13 17.7048837,15.2931929 17.9979143,20.2 C18.0095879,20.3954741 17.9979143,21 17.2466999,21 C13.541124,21 8.03472472,21 0.727502227,21 C0.476712155,21 -0.0204617505,20.45918 0.00065168429,20.1992055 Z" fill="#000000" fill-rule="nonzero"></path>
                                                                    </g>
                                                                </svg>
                                                                <!--end::Svg Icon-->
                                                            </span>
                                                            <span class="card-title font-weight-bolder text-dark-75 font-size-h2 mb-0 mt-6 d-block"><?php echo e(App\User::where('type', 'driver')->count()); ?></span>
                                                            <span class="font-weight-bold text-muted font-size-sm"><?php echo e(trans(lang_app_site().'.CP.Total')); ?></span>
                                                        </div>
                                                        <!--end::Body-->
                                                    </div>
                                                    <!--end::Stats Widget 26-->
                                                </div>
                                            </div>
                                            <!-- BEGIN EXAMPLE TABLE PORTLET-->
                                            <div class="card card-custom shadow m-5">
                                                <div class="card-header">
                                                    <div class="card-title">
                                                        <i class="fa fa-search font-dark"></i>
                                                        &nbsp;
                                                        <span class="caption-subject bold uppercase"> <?php echo e(trans(lang_app_site().'.CP.Filter')); ?> </span>
                                                    </div>
                                                </div>
                                                <div class="card-body">
                                                    <div class="table-container">
                                                        <?php echo Form::open(['method'=>'POST','url'=>url('/admin/export')]); ?>


                                                        <table class="table table-striped table-bordered table-hover table-checkable" id="datatable_products">
                                                            <thead>
                                                                <tr role="row" class="heading">
                                                                    <th width="1%">
                                                                        
                                                                        
                                                                        
                                                                        
                                                                        
                                                                    </th>
                                                                    
                                                                    <th width="10%"> <?php echo e(trans(lang_app_site().'.CP.Username')); ?></th>
                                                                    <th width="10%"> <?php echo e(trans(lang_app_site().'.CP.Email')); ?></th>
                                                                    <th width="10%"> <?php echo e(trans(lang_app_site().'.CP.Phone')); ?></th>
                                                                    <th width="10%"> <?php echo e(trans(lang_app_site().'.CP.Delivery method')); ?></th>
                                                                    <th width="10%"> <?php echo e(trans(lang_app_site().'.CP.Status')); ?></th>
                                                                    <th width="10%"> <?php echo e(trans(lang_app_site().'.CP.Action')); ?></th>
                                                                </tr>
                                                                <tr role="row" class="filter">
                                                                    <td></td>
                                                                    <td>
                                                                        <input type="text" class="form-control form-filter input-md" name="username" placeholder="<?php echo e(trans(lang_app_site().'.CP.Username')); ?>" id="username_d">

                                                                    </td>
                                                                    <td>
                                                                        <input type="email" class="form-control form-filter input-md" name="email" placeholder="<?php echo e(trans(lang_app_site().'.CP.Email')); ?>" id="email_d">
                                                                    </td>
                                                                    <td>
                                                                        <input type="text" class="form-control form-filter input-md" name="mobile" placeholder="<?php echo e(trans(lang_app_site().'.CP.Phone')); ?>" id="mobile_d">
                                                                    </td>
                                                                    <td>
                                                                        <select class="form-control input-md status" name="driver_types" id="driver_types_d" data-placeholder="Choose Delivery method">
                                                                            <option value=""><?php echo e(trans(lang_app_site().'.CP.Choose delivery method')); ?></option>
                                                                            <?php $__currentLoopData = $driver_types; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $type): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                                            <option value="<?php echo e($type->id); ?>"><?php echo e(trans(lang_app_site().'.CP.'.$type->name)); ?></option>
                                                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                                        </select>
                                                                    </td>
                                                                    <td>
                                                                        <select class="form-control input-md" name="is_active" id="is_active_d" data-placeholder="Choose Status">
                                                                            <option value=""><?php echo e(trans(lang_app_site().'.CP.Choose Status')); ?></option>
                                                                            <option value="0"><?php echo e(trans(lang_app_site().'.CP.Disable')); ?></option>
                                                                            <option value="1"><?php echo e(trans(lang_app_site().'.CP.Active')); ?></option>
                                                                        </select>
                                                                    </td>
                                                                    <td>
                                                                        <div class="margin-bottom-5">
                                                                            <a href="javascript:;" class="btn btn-sm btn-success btn-circle btn-icon-only filter-submit-d margin-bottom" title="Search">
                                                                                <i class="fa fa-search"></i>
                                                                            </a>

                                                                            <a href="javascript:;" class="btn btn-sm btn-danger btn-circle btn-icon-only filter-cancel-d" title="Empty">
                                                                                <i class="fa fa-times"></i>
                                                                            </a>
                                                                        </div>

                                                                    </td>
                                                                </tr>
                                                            </thead>
                                                            <tbody></tbody>
                                                        </table>
                                                        <?php echo Form::close(); ?>


                                                    </div>
                                                </div>
                                            </div>
                                            <div class="card card-custom shadow m-5">
                                                <div class="card-header">
                                                    <div class="card-title">
                                                        <i class="<?php echo e($icon); ?> font-dark"></i>
                                                        <span class="caption-subject bold uppercase"> <?php echo e(trans(lang_app_site().'.CP.Drivers')); ?></span>
                                                    </div>
                                                    <div class="card-toolbar">
                                                        <a href="<?php echo e(url('admin/users/user-driver/create')); ?>" class="btn btn-circle btn-primary add-driver-mdl">
                                                            <i class="fa fa-user-plus"></i>
                                                            <span class="hidden-xs"> <?php echo e(trans(lang_app_site().'.CP.Add New Driver')); ?> </span>
                                                        </a>
                                                    </div>

                                                </div>
                                                <div class="card-body">
                                                    

                                                    <table class="table table-striped table-hover table-checkable order-column" id="drivers_tbl">
                                                        <thead>
                                                            <tr>
                                                                <!-- <th>#</th> -->
                                                                <th> <?php echo e(trans(lang_app_site().'.CP.Job ID')); ?></th>
                                                                <th></th>
                                                                <th> <?php echo e(trans(lang_app_site().'.CP.Username')); ?></th>
                                                                <th> <?php echo e(trans(lang_app_site().'.CP.Phone')); ?></th>
                                                                <th> <?php echo e(trans(lang_app_site().'.CP.Address')); ?></th>
                                                                <th> <?php echo e(trans(lang_app_site().'.CP.Delivery Method')); ?></th>
                                                                <th> <?php echo e(trans(lang_app_site().'.CP.Status')); ?></th>
                                                                <th> <?php echo e(trans(lang_app_site().'.CP.Action')); ?></th>
                                                            </tr>
                                                        </thead>
                                                    </table>
                                                </div>
                                            </div>
                                            <!-- END EXAMPLE TABLE PORTLET-->
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="tab-pane fade " id="service_providers">

                                <div class="portlet-body form">
                                    <div class="row">

                                        <div class="col-md-12">
                                            <!-- BEGIN EXAMPLE TABLE PORTLET-->
                                            <div class="card card-custom shadow m-5">
                                                <div class="card-header">
                                                    <div class="card-title">
                                                        <i class="fa fa-search font-dark"></i>
                                                        &nbsp;
                                                        <span class="caption-subject bold uppercase"> <?php echo e(trans(lang_app_site().'.CP.Filter')); ?> </span>
                                                    </div>
                                                </div>
                                                <div class="card-body">
                                                    <div class="table-container">
                                                        <?php echo Form::open(['method'=>'POST','url'=>url('/admin/export')]); ?>


                                                        <table class="table table-striped table-bordered table-hover table-checkable" id="datatable_products">
                                                            <thead>
                                                                <tr role="row" class="heading">
                                                                    <th width="1%">
                                                                        
                                                                        
                                                                        
                                                                        
                                                                        
                                                                    </th>
                                                                    
                                                                    <th width="10%"> <?php echo e(trans(lang_app_site().'.CP.Username')); ?></th>
                                                                    <th width="10%"> <?php echo e(trans(lang_app_site().'.CP.Email')); ?></th>
                                                                    <th width="10%"> <?php echo e(trans(lang_app_site().'.CP.Phone')); ?></th>
                                                                    <th width="10%"> <?php echo e(trans(lang_app_site().'.CP.Status')); ?></th>
                                                                    <th width="10%"> <?php echo e(trans(lang_app_site().'.CP.Action')); ?></th>
                                                                </tr>
                                                                <tr role="row" class="filter">
                                                                    <td></td>
                                                                    <td>
                                                                        <input type="text" class="form-control form-filter input-md" name="username" placeholder="<?php echo e(trans(lang_app_site().'.CP.Username')); ?>" id="username_s">

                                                                    </td>
                                                                    <td>
                                                                        <input type="email" class="form-control form-filter input-md" name="email" placeholder="<?php echo e(trans(lang_app_site().'.CP.Email')); ?>" id="email_s">
                                                                    </td>
                                                                    <td>
                                                                        <input type="text" class="form-control form-filter input-md" name="mobile" placeholder="<?php echo e(trans(lang_app_site().'.CP.Phone')); ?>" id="mobile_s">
                                                                    </td>

                                                                    <td>
                                                                        <select class="form-control input-md" name="is_active" id="is_active_s" data-placeholder="Choose Status">
                                                                            <option value=""><?php echo e(trans(lang_app_site().'.CP.Choose Status')); ?></option>
                                                                            <option value="0"><?php echo e(trans(lang_app_site().'.CP.Disable')); ?></option>
                                                                            <option value="1"><?php echo e(trans(lang_app_site().'.CP.Active')); ?></option>
                                                                        </select>
                                                                    </td>
                                                                    <td>
                                                                        <div class="margin-bottom-5">
                                                                            <a href="javascript:;" class="btn btn-sm btn-success btn-circle btn-icon-only filter-submit-s margin-bottom" title="Search">
                                                                                <i class="fa fa-search"></i>
                                                                            </a>

                                                                            <a href="javascript:;" class="btn btn-sm btn-danger btn-circle btn-icon-only filter-cancel-s" title="Empty">
                                                                                <i class="fa fa-times"></i>
                                                                            </a>
                                                                        </div>

                                                                    </td>
                                                                </tr>
                                                            </thead>
                                                            <tbody></tbody>
                                                        </table>
                                                        <?php echo Form::close(); ?>


                                                    </div>
                                                </div>
                                            </div>
                                            <div class="card card-custom shadow m-5">
                                                <div class="card-header">
                                                    <div class="card-title">
                                                        <i class="<?php echo e($icon); ?> font-dark"></i>
                                                        <span class="caption-subject bold uppercase"> <?php echo e(trans(lang_app_site().'.CP.Service Providers')); ?></span>
                                                    </div>
                                                    <div class="card-toolbar">
                                                        <a href="<?php echo e(url('admin/service-provider/create')); ?>" class="btn btn-circle btn-primary add-service-provider-mdl">
                                                            <i class="fa fa-user-plus"></i>
                                                            <span class="hidden-xs"> <?php echo e(trans(lang_app_site().'.CP.Add New Service Provider')); ?> </span>
                                                        </a>
                                                    </div>

                                                </div>
                                                <div class="card-body">
                                                    

                                                    <table class="table table-striped table-bordered table-hover table-checkable order-column" id="service_providers_tbl">
                                                        <thead>
                                                            <tr>
                                                                <th>#</th>
                                                                <th> <?php echo e(trans(lang_app_site().'.CP.Logo')); ?></th>
                                                                <th> <?php echo e(trans(lang_app_site().'.CP.Username')); ?></th>
                                                                <th> <?php echo e(trans(lang_app_site().'.CP.Email')); ?></th>
                                                                
                                                                <th> <?php echo e(trans(lang_app_site().'.CP.Phone')); ?></th>
                                                                
                                                                <th> <?php echo e(trans(lang_app_site().'.CP.City')); ?></th>
                                                                <th> <?php echo e(trans(lang_app_site().'.CP.Address')); ?></th>
                                                                
                                                                <th> <?php echo e(trans(lang_app_site().'.CP.Status')); ?></th>
                                                                <th> <?php echo e(trans(lang_app_site().'.CP.Action')); ?></th>
                                                            </tr>
                                                        </thead>
                                                    </table>
                                                </div>
                                            </div>
                                            <!-- END EXAMPLE TABLE PORTLET-->
                                        </div>
                                    </div>

                                </div>
                            </div>

                        </div>
                        <div class="clearfix margin-bottom-20"></div>
                    </div>
                </div>
            </div>
        </div>

    </div>
</div>

<!-- /.modal -->
<?php $__env->stopSection(); ?>

<?php $__env->startSection('js'); ?>

<!-- BEGIN PAGE LEVEL PLUGINS -->
<script src="<?php echo e(url('/')); ?>/assets/global/scripts/datatable.js" type="text/javascript"></script>
<script src="<?php echo e(url('/')); ?>/assets/global/plugins/datatables/datatables.min.js" type="text/javascript"></script>
<script src="<?php echo e(url('/')); ?>/assets/global/plugins/datatables/plugins/bootstrap/datatables.bootstrap.js" type="text/javascript"></script>
<!-- END PAGE LEVEL PLUGINS -->


<script src="<?php echo e(url('/')); ?>/assets/global/plugins/jquery-ui/jquery-ui.min.js" type="text/javascript"></script>

<!-- BEGIN THEME GLOBAL SCRIPTS -->
<script src="<?php echo e(url('/')); ?>/assets/global/scripts/app.min.js" type="text/javascript"></script>
<!-- END THEME GLOBAL SCRIPTS -->


<script src="<?php echo e(url('/')); ?>/assets/pages/scripts/ui-modals.min.js" type="text/javascript"></script>

<!-- BEGIN PAGE LEVEL SCRIPTS -->
<script src="<?php echo e(url('/')); ?>/assets/pages/scripts/table-datatables-responsive.min.js" type="text/javascript"></script>


<!-- END PAGE LEVEL SCRIPTS -->
<script src="<?php echo e(url('/')); ?>/assets/js/users.js" type="text/javascript"></script>
<script type="text/javascript">

</script>
<script type="text/javascript" src="https://maps.googleapis.com/maps/api/js?key=<?php echo e(google_api_key()); ?>"></script>
<script>
    function myMap(address, lat, long) {

        var myLatLng = {
            lat: Number(lat),
            lng: Number(long)
        };


        var map = new google.maps.Map(document.getElementById("map"), {
            zoom: 4,
            center: myLatLng,

            gestureHandling: 'cooperative'
        });

        map.setOptions({
            scrollwheel: false
        });


        var marker = new google.maps.Marker({
            position: myLatLng,
            map: map,
            title: address
        });
    }
</script>



<?php $__env->stopSection(); ?>
<?php echo $__env->make(admin_layout_vw().'.index', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\Dragon\resources\views/admin/users/index.blade.php ENDPATH**/ ?>