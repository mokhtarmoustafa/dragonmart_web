@extends(merchant_layout_vw().'.index')

@section('css')

<!-- BEGIN THEME GLOBAL STYLES -->
<link href="{{url('/')}}/assets/global/plugins/select2/css/select2.min.css" rel="stylesheet" type="text/css" />
<link href="{{url('/')}}/assets/global/plugins/select2/css/select2-bootstrap.min.css" rel="stylesheet" type="text/css" />
@endsection
@section('content')

<div class="portlet light bg-whit">
    <div class="row">
        <div class="card card-custom col-md-12">
            <div class="card-header">
                <div class="card-title">
                    <i class="{{$icon}} font-dark"></i>
                    <span class="caption-subject bold uppercase"> {{trans(lang_app_site().'.CP.'.$main_title)}}</span>
                </div>

            </div>
            <div class="card-body">
                {!! Form::open(['method'=>'POST','class'=>'form-horizontal form-bordered form-row-stripped','url'=>url(merchant_url().'/profile'),'files'=>true,'id'=>'editProfile']) !!}
                <ul class="nav nav-tabs" id="myTab" role="tablist">

                    <li class="nav-item">
                        <a class="nav-link active" id="information-tab" href="#information" data-toggle="tab">{{trans(lang_app_site().'.CP.Shop Information')}}</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" id="categories-tab" href="#categories" data-toggle="tab">{{trans(lang_app_site().'.CP.Provided Categories')}}</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" id="commission-tab" href="#commission" data-toggle="tab">{{trans(lang_app_site().'.CP.Commission Rate')}}</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" id="delivery_method-tab" href="#delivery_method" data-toggle="tab">{{trans(lang_app_site().'.CP.Delivery method')}}</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" id="bank_info-tab" href="#bank_info" data-toggle="tab">{{trans(lang_app_site().'.CP.Bank Information')}}</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" id="commercial_info-tab" href="#commercial_info" data-toggle="tab">{{trans(lang_app_site().'.CP.Commercial Information')}}</a>
                    </li>


                </ul>
                <div class="tab-content p-5 bg-white" id="myTabContent">

                    <div class="tab-pane fade active show" id="information">

                        <div class="form-body">
                            <div class="form-group row">
                                <div class="col-6 text-center">
                                    <div class="image-input image-input-outline image-input-circle center mb-5" id="UploadImage">
                                        <div class="image-input-wrapper" style="background-image: url({{getAuth()->merchant->image}})"></div>

                                        <label class="btn btn-xs btn-icon btn-circle btn-white btn-hover-text-primary btn-shadow" data-action="change" data-toggle="tooltip" title="" data-original-title="Change avatar">
                                            <i class="fa fa-pen icon-sm text-muted"></i>
                                            <input type="file" name="image" accept=".png, .jpg, .jpeg" />
                                            <input type="hidden" name="profile_avatar_remove" />
                                        </label>

                                        <span class="btn btn-xs btn-icon btn-circle btn-white btn-hover-text-primary btn-shadow" data-action="cancel" data-toggle="tooltip" title="Cancel avatar">
                                            <i class="ki ki-bold-close icon-xs text-muted"></i>
                                        </span>
                                    </div>
                                </div>

                                <div class="form-group col-6">
                                    <div class="form-group row">
                                        <label>{{trans(lang_app_site().'.CP.Shop name')}}</label>
                                        <input id="username" class="form-control" name="username" type="text" placeholder="{{trans(lang_app_site().'.CP.Shop name')}}" value="{{getAuth()->merchant->username}}">
                                    </div>
                                    <div class="form-group row">
                                        <label>{{trans(lang_app_site().'.CP.City')}}</label>
                                        <select class="form-control w-100" name="city_id">
                                            @foreach($cities as $city)
                                            <option value="{{$city->id}}" @if($city->id == getAuth()->merchant->city_id) selected @endif>{{$city->name_en}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>

                            </div>
                            <div class="form-group row">
                                <div class="col-lg-6">
                                    <label>{{trans(lang_app_site().'.CP.Email')}}</label>
                                    <input id="email" class="form-control" type="email" disabled placeholder="{{trans(lang_app_site().'.CP.Email')}}" value="{{getAuth()->merchant->email}}">
                                </div>
                                <div class="col-lg-6">
                                    <label>{{trans(lang_app_site().'.CP.Phone')}}</label>
                                    <input class="form-control" name="mobile" type="text" id="mobile" placeholder="{{trans(lang_app_site().'.CP.Phone')}}" value="{{getAuth()->merchant->mobile}}">
                                </div>
                            </div>
                            <div class="form-group row">
                                <div class="col-lg-12">
                                    <label>{{trans(lang_app_site().'.CP.Description')}}</label>
                                    <textarea id="email" class="form-control" id="description" name="description" rows="5">{{getAuth()->merchant->store->description ?? ''}}</textarea>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="tab-pane fade" id="commission">
                        <div class="portlet-body form">
                            <div class="form-body">
                                <div class="form-group">
                                    <div class="form-group row">
                                        <div class="col-lg-6">
                                            <label for="commission_rate">{{trans(lang_app_site().'.CP.Commission rate')}} (%)</label>
                                            <input class="form-control" disabled value="{{getAuth()->merchant->commission_rate}}" placeholder="20%">
                                        </div>
                                        <div class="col-lg-6">
                                            <label for="commission_rate">{{trans(lang_app_site().'.CP.Refund commission rate')}} (%)</label>
                                            <input class="form-control" name="refund_commission_rate" value="{{getAuth()->merchant->refund_commission_rate}}" placeholder="20%">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="tab-pane fade" id="categories">
                        <div class="portlet-body form">
                            <div class="form-body">
                                <div class="form-group row">
                                    <div class="col-md-12">
                                        <label>{{trans(lang_app_site().'.CP.Categories')}} </label>
                                        <select class="form-control select2" name="categories[]" multiple>
                                            @foreach($categories as $category)
                                            <option @if(isset($store) && in_array($category->id,$store->Categories->pluck('id')->toArray())) selected
                                                @endif value="{{$category->id}}">{{$category->name}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="tab-pane fade" id="delivery_method">
                        <div class="portlet-body form">
                            <div class="form-body">
                                <div class="form-group">
                                    <div class="control-label col-md-2">
                                        <label>{{trans(lang_app_site().'.CP.Delivery method')}}</label>
                                    </div>
                                    <div class="col-md-10">
                                        <select class="form-control select2" name="driver_methods[]" multiple>
                                            @foreach($driver_methods as $driver_method)
                                            <option value="{{$driver_method->id}}" selected>{{$driver_method->name}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>

                            </div>
                        </div>
                    </div>

                    <div class="tab-pane fade" id="bank_info">

                        <div class="portlet-body form">

                            <div class="form-body">

                                <div class="form-group">
                                    <div class="form-group row">
                                        <div class="col-lg-6">
                                            <label>{{trans(lang_app_site().'.CP.Bank name')}}</label>
                                            <input id="bank_name" class="form-control" name="bank_name" type="text" placeholder="{{trans(lang_app_site().'.CP.Bank name')}}" value="{{getAuth()->bank->bank_name ?? ''}}">
                                        </div>
                                        <div class="col-lg-6">
                                            <label>{{trans(lang_app_site().'.CP.Branch name')}}</label>
                                            <input id="branch_code" class="form-control" name="branch_code" type="text" placeholder="{{trans(lang_app_site().'.CP.Branch code')}}" value="{{getAuth()->bank->branch_code ?? ''}}">
                                        </div>

                                    </div>
                                    <div class="form-group row">
                                        <div class="col-lg-6">
                                            <label>{{trans(lang_app_site().'.CP.Account name')}}</label>
                                            <input id="account_name" class="form-control" name="account_name" type="text" placeholder="{{trans(lang_app_site().'.CP.Account name')}}" value="{{getAuth()->bank->account_name ?? ''}}">
                                        </div>
                                        <div class="col-lg-6">
                                            <label>{{trans(lang_app_site().'.CP.Account number')}}</label>
                                            <input id="account_number" class="form-control" name="account_number" type="text" placeholder="{{trans(lang_app_site().'.CP.Account number')}}" value="{{getAuth()->bank->account_number ?? ''}}">
                                        </div>

                                    </div>
                                    <div class="form-group row">
                                        <div class="col-lg-12">
                                            <label>{{trans(lang_app_site().'.CP.Bank address')}}</label>
                                            <input id="bank_address" class="form-control" name="bank_address" type="text" placeholder="{{trans(lang_app_site().'.CP.Bank address')}}" value="{{getAuth()->bank->bank_address ?? ''}}">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="tab-pane fade" id="commercial_info"> 
                        <div class="portlet-body form">

                            <div class="form-body">

                                <div class="form-group">
                                    <div class="form-group row">
                                        <div class="col-lg-12">
                                            <label>{{trans(lang_app_site().'.CP.Commercial name')}}</label>
                                            <input id="commercial_name" class="form-control" name="commercial_name" type="text" placeholder="{{trans(lang_app_site().'.CP.Commercial name')}}" value="{{getAuth()->merchant->commercial_name ?? ''}}" @if(getAuth()->merchant->is_commercial == 1) disabled @endif>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <div class="col-lg-6">
                                            <label>{{trans(lang_app_site().'.CP.Commercial register')}}</label>
                                            <input id="commercial_register" class="form-control" name="commercial_register" type="text" placeholder="{{trans(lang_app_site().'.CP.Commercial register')}}" value="{{getAuth()->merchant->commercial_register ?? ''}}" @if(getAuth()->merchant->is_commercial == 1) disabled @endif>
                                        </div>
                                        <div class="col-lg-6">
                                            <label>{{trans(lang_app_site().'.CP.Tax number')}}</label>
                                            <input id="tax_number" class="form-control" name="tax_number" type="text" placeholder="{{trans(lang_app_site().'.CP.Tax number')}}" value="{{getAuth()->merchant->tax_number ?? ''}}" @if(getAuth()->merchant->is_commercial == 1) disabled @endif>
                                        </div>
                                        @if(getAuth()->merchant->is_commercial == 1)
                                        <div class="form-group row">
                                            <div class="col-lg-12 mt-10">
                                                <p class="text-dark-50">{{trans(lang_app_site().'.CP.Please contact the Adminstrater to change the commercial information')}}</p>
                                            </div>
                                        </div>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="clearfix margin-bottom-20"></div>
                <div class="form-actions save_operations" style="display: block;">
                    <div class="row">
                        <div class="col-md-12 text-center">
                            <button type="submit" class="btn btn-circle btn-info save"><i class="fa fa-check"></i>
                            {{trans(lang_app_site().'.CP.Save')}}
                            </button>
                        </div>
                    </div>
                </div>
                {!! Form::close() !!}
            </div>
        </div>
    </div>
</div>
@include('admin.modals.edit_map')

@endsection

@section('js')

<!-- BEGIN PAGE LEVEL PLUGINS -->
<script src="{{url('/')}}/assets/global/scripts/datatable.js" type="text/javascript"></script>
<script src="{{url('/')}}/assets/global/plugins/datatables/datatables.min.js" type="text/javascript"></script>
<script src="{{url('/')}}/assets/global/plugins/datatables/plugins/bootstrap/datatables.bootstrap.js" type="text/javascript"></script>
<!-- END PAGE LEVEL PLUGINS -->
<script src="{{url('/')}}/assets/global/plugins/select2/js/select2.full.min.js" type="text/javascript"></script>

{{--<script type="text/javascript" src="javascripts/jquery.googlemap.js"></script>--}}
<script src="{{url('/')}}/assets/global/plugins/jquery-ui/jquery-ui.min.js" type="text/javascript"></script>
<script src="{{url('/')}}/assets/global/plugins/bootstrap-fileinput/bootstrap-fileinput.js" type="text/javascript"></script>
<!-- BEGIN THEME GLOBAL SCRIPTS -->


<!-- BEGIN PAGE LEVEL PLUGINS -->
<script src="{{url('/')}}/assets/global/plugins/fancybox/source/jquery.fancybox.pack.js" type="text/javascript"></script>
<script src="{{url('/')}}/assets/global/plugins/jquery-file-upload/js/vendor/jquery.ui.widget.js" type="text/javascript"></script>
<script src="{{url('/')}}/assets/global/plugins/jquery-file-upload/js/vendor/tmpl.min.js" type="text/javascript"></script>
<script src="{{url('/')}}/assets/global/plugins/jquery-file-upload/js/vendor/load-image.min.js" type="text/javascript"></script>
<script src="{{url('/')}}/assets/global/plugins/jquery-file-upload/js/vendor/canvas-to-blob.min.js" type="text/javascript"></script>
<script src="{{url('/')}}/assets/global/plugins/jquery-file-upload/blueimp-gallery/jquery.blueimp-gallery.min.js" type="text/javascript"></script>
<script src="{{url('/')}}/assets/global/plugins/jquery-file-upload/js/jquery.iframe-transport.js" type="text/javascript"></script>
<script src="{{url('/')}}/assets/global/plugins/jquery-file-upload/js/jquery.fileupload.js" type="text/javascript"></script>
<script src="{{url('/')}}/assets/global/plugins/jquery-file-upload/js/jquery.fileupload-process.js" type="text/javascript"></script>
<script src="{{url('/')}}/assets/global/plugins/jquery-file-upload/js/jquery.fileupload-image.js" type="text/javascript"></script>
<script src="{{url('/')}}/assets/global/plugins/jquery-file-upload/js/jquery.fileupload-audio.js" type="text/javascript"></script>
<script src="{{url('/')}}/assets/global/plugins/jquery-file-upload/js/jquery.fileupload-video.js" type="text/javascript"></script>
<script src="{{url('/')}}/assets/global/plugins/jquery-file-upload/js/jquery.fileupload-validate.js" type="text/javascript"></script>
<script src="{{url('/')}}/assets/global/plugins/jquery-file-upload/js/jquery.fileupload-ui.js" type="text/javascript"></script>

<script src="{{url('/')}}/assets/global/scripts/app.min.js" type="text/javascript"></script>
<!-- END THEME GLOBAL SCRIPTS -->
{{--<script src="{{url('/')}}/assets/pages/scripts/maps-google.min.js" type="text/javascript"></script>--}}

<script src="{{url('/')}}/assets/pages/scripts/ui-modals.min.js" type="text/javascript"></script>

<!-- BEGIN PAGE LEVEL SCRIPTS -->
<script src="{{url('/')}}/assets/pages/scripts/table-datatables-responsive.min.js" type="text/javascript"></script>
<script src="{{url('/')}}/assets/pages/scripts/components-select2.min.js" type="text/javascript"></script>

{{--<script src="{{url('/')}}/assets/pages/scripts/table-datatables-managed.min.js" type="text/javascript"></script>--}}
<!-- END PAGE LEVEL SCRIPTS -->

<script src="{{url('/')}}/assets/js/users.js" type="text/javascript"></script>
<script src="{{url('/')}}/assets/js/stores.js" type="text/javascript"></script>
<script>
    // $('.select2').select2({
    //     placeholder: "Select...",
    //     allowClear: true
    // });
    $(".date-picker").datepicker({
        rtl: App.isRTL(),
        dateFormat: "mm/dd/yy",
        showOtherMonths: true,
        selectOtherMonths: true,
        autoclose: true,
        changeMonth: true,
        changeYear: true,
        orientation: "below"
    });
</script>
@stop