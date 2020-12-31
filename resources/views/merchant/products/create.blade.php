<?php
if(auth()->guard('admin')->user()->type == "admin" || auth()->guard('admin')->user()->type == "Superadmin"){
  $layoutView =admin_layout_vw();

}else {
  $layoutView = merchant_layout_vw();
}
?>

@extends($layoutView.'.index')

@section('css')
<link href="{{url('/')}}/assets/global/plugins/datatables/datatables.min.css" rel="stylesheet" type="text/css"/>
<link href="{{url('/')}}/assets/global/plugins/datatables/plugins/bootstrap/datatables.bootstrap.css"
rel="stylesheet" type="text/css"/>
<link href="{{url('/')}}/assets/global/plugins/fancybox/source/jquery.fancybox.css" rel="stylesheet"
type="text/css"/>
<link href="{{url('/')}}/assets/global/plugins/jquery-file-upload/blueimp-gallery/blueimp-gallery.min.css"
rel="stylesheet" type="text/css"/>
<link href="{{url('/')}}/assets/global/plugins/jquery-file-upload/css/jquery.fileupload.css" rel="stylesheet"
type="text/css"/>
<link href="{{url('/')}}/assets/global/plugins/jquery-file-upload/css/jquery.fileupload-ui.css" rel="stylesheet"
type="text/css"/>
<!-- BEGIN PAGE LEVEL PLUGINS -->
<link href="{{url('/')}}/assets/global/plugins/bootstrap-colorpicker/css/colorpicker.css" rel="stylesheet"
type="text/css"/>
<link href="{{url('/')}}/assets/global/plugins/jquery-minicolors/jquery.minicolors.css" rel="stylesheet"
type="text/css"/>
<!-- END PAGE LEVEL PLUGINS -->
<!-- BEGIN THEME GLOBAL STYLES -->
<link href="{{url('/')}}/assets/global/css/components-md.min.css" rel="stylesheet" id="style_components"
type="text/css"/>
<link href="{{url('/')}}/assets/global/css/plugins-md.min.css" rel="stylesheet" type="text/css"/>
<!-- END THEME GLOBAL STYLES -->
@endsection
@section('content')
<div class="row">
  <div class="col-md-12">
    <div class="portlet light ">
      <div class="portlet-title">
        <div class="caption">
          <i class="fa fa-plus font-purple-soft"></i>
          <span class="caption-subject font-purple-soft bold uppercase">{{trans(lang_app_site().'.CP.New Product')}}</span>

        </div>
        <div class="actions">
          <a href="{{url()->current()}}" class="btn btn-circle btn-info">
            <i class="fa fa-plus"></i>
            <span class="hidden-xs"> {{trans(lang_app_site().'.CP.New Product')}} </span>
          </a>
        </div>
      </div>

      @php

      if(auth()->guard('admin')->user()->type == "admin" || auth()->guard('admin')->user()->type == "Superadmin"){
        $EditView = admin_vw().'/'.$id.'/product/';
      }else{
        $EditView =  merchant_vw().'/product/';
      }

      @endphp


      {!! Form::open(['method'=>'POST','class'=>'form-horizontal form-bordered form-row-stripped','url'=>url($EditView),'id'=>'productAdd']) !!}

      <div class="alert alert-danger" style="display: none">

      </div>
      <div class="portlet-body">
        <ul class="nav nav-tabs">
          <li class="active">
            <a href="#general" data-toggle="tab"> {{trans(lang_app_site().'.CP.General')}} </a>
          </li>
          <li>
            <a href="#customizations" data-toggle="tab"> {{trans(lang_app_site().'.CP.Customizations')}}</a>
          </li>
        </ul>
        <div class="tab-content">
          <div class="tab-pane fade  active in " id="general">

            <div class="portlet-body form">
              <style>
              .has_offer, .has_sponsor {
                display: none;
                }
                </style>
                <div class="row">
                  <div class="col-md-12">
                    <!-- BEGIN EXAMPLE TABLE PORTLET-->
                    <div class="portlet box">

                      <div class="portlet-body form">
                        <div class="form-body">
                          {{--                        {!! Form::open(['method'=>'POST','url'=>url(admin_vw().'/user/export')]) !!}--}}
                          {{--<form method="POST" action="#" class="form-horizontal form-bordered form-row-stripped">--}}
                            <div class="form-group">
                              <div class="control-label col-md-2">
                                <label>{{trans(lang_app_site().'.CP.Product name')}}</label>
                              </div>
                              <div class="col-md-2">
                                <input id="name" class="form-control"
                                name="name" type="text"
                                placeholder="Product name">
                              </div>
                              <div class="control-label col-md-2">
                                <label>{{trans(lang_app_site().'.CP.Price')}}</label>
                              </div>
                              <div class="col-md-2">
                                <input id="price" class="form-control"
                                name="price" type="number"
                                placeholder="Price">
                              </div>
                              <div class="control-label col-md-2">
                                <label>{{trans(lang_app_site().'.CP.Quantity')}}</label>
                              </div>
                              <div class="col-md-2">
                                <input id="original_quantity"
                                class="form-control"
                                name="original_quantity" type="number"
                                placeholder="Quantity">
                              </div>


                            </div>


                            <div class="form-group">
                              <div class="control-label col-md-2">
                                <label>{{trans(lang_app_site().'.CP.Categories')}}</label>
                              </div>
                              <div class="col-md-2">
                                <select class="form-control" name="category_id">
                                  @foreach($categories as $category)
                                  <option value="{{$category->id}}">{{$category->name}}</option>
                                  @endforeach
                                </select>
                              </div>

                              <div class="control-label col-md-1">
                                <label>{{trans(lang_app_site().'.CP.Offer')}}</label>
                              </div>
                              <div class="col-md-1">
                                <div class="md-checkbox"><input type="checkbox"
                                  id="checkbox1"
                                  name="is_offer"
                                  data-value="0"
                                  class="md-check is_offer"
                                  data-id=""><label
                                  for="checkbox1"><span></span><span
                                  class="check"></span><span
                                  class="box"></span> </label>
                                </div>
                              </div>

                              <div class="control-label col-md-1 has_offer">
                                <label>{{trans(lang_app_site().'.CP.Offer')}} %</label>
                              </div>
                              <div class="col-md-1 has_offer">
                                <input id="offer_percentage"
                                class="form-control"
                                name="offer_percentage" type="number"
                                placeholder="Offer %">
                              </div>

                              <div class="control-label col-md-1">
                                <label>{{trans(lang_app_site().'.CP.Sponsor')}}</label>
                              </div>
                              <div class="col-md-1">
                                <div class="md-checkbox"><input type="checkbox"
                                  id="checkbox2"
                                  name="is_sponsor"

                                  data-value="0"
                                  class="md-check is_sponsor"
                                  data-id=""><label
                                  for="checkbox2"><span></span><span
                                  class="check"></span><span
                                  class="box"></span> </label>
                                </div>
                              </div>

                              <div class="has_sponsor">
                                <div class="control-label col-md-1">
                                  <label>{{trans(lang_app_site().'.CP.Duration (days)')}}</label>
                                </div>
                                <div class="col-md-1 has_sponsor">
                                  <input id="sponsor_duration"
                                  class="form-control"
                                  name="sponsor_duration" type="number"
                                  placeholder="Number of days">
                                </div>
                              </div>
                            </div>
                            <div class="form-group">
                              <div class="control-label col-md-2">
                                <label>{{trans(lang_app_site().'.CP.Description')}}</label>
                              </div>
                              <div class="col-md-10">
                                <textarea class="form-control" rows="6"
                                name="description"
                                id="description"></textarea>
                              </div>
                            </div>

                          </div>
                        </div>
                      </div>
                      <!-- END EXAMPLE TABLE PORTLET-->


                    </div>
                  </div>
                </div>
              </div>
              <div class="tab-pane fade" id="customizations">
                <div class="card card-custom">
                  <div class="card-header">
                    <div class="row">
                      <h3 class="card-title">
                        Form Repeater Example
                      </h3>
                    </div>
                  </div>
                  <!--begin::Form-->
                  <form class="form">
                    <div class="card-body">
                      <div class="form-group row">
                        <label class="col-lg-3 col-form-label text-right">Full Name:</label>
                        <div class="col-lg-6">
                          <input type="email" class="form-control" placeholder="Enter full name"/>
                          <span class="form-text text-muted">Please enter your full name</span>
                        </div>
                      </div>
                      <div class="form-group row">
                        <label class="col-lg-3 col-form-label text-right">Email address:</label>
                        <div class="col-lg-6">
                          <input type="email" class="form-control" placeholder="Enter email"/>
                          <span class="form-text text-muted">We'll never share your email with anyone else</span>
                        </div>
                      </div>
                      <div class="form-group row align-items-center">
                        <label class="col-lg-3 col-form-label text-right">Communication:</label>
                        <div class="col-lg-12 col-xl-8">
                          <div class="checkbox-inline">
                            <label class="checkbox">
                              <input type="checkbox"/> Email
                              <span></span>
                            </label>
                            <label class="checkbox">
                              <input type="checkbox"/> SMS
                              <span></span>
                            </label>
                            <label class="checkbox">
                              <input type="checkbox"/> Phone
                              <span></span>
                            </label>
                          </div>
                        </div>
                      </div>
                      <div class="form-group row">
                        <label class="col-form-label text-right col-lg-3 col-sm-12">Credit Card</label>
                        <div class="col-lg-6 ">
                          <div class="input-group">
                            <input type="text" class="form-control" name="creditcard" placeholder="Enter card number"/>
                            <div class="input-group-append"><span class="input-group-text"><i class="la la-credit-card"></i></span></div>
                          </div>
                        </div>
                      </div>
                      <div id="kt_repeater_3">
                        <div class="form-group row">
                          <label class="col-lg-3 col-form-label text-right">Contact:</label>
                          <div data-repeater-list="" class="col-lg-9">
                            <div data-repeater-item class="form-group row">
                              <div class="col-lg-5">
                                <div class="input-group">
                                  <div class="input-group-prepend">
                                    <span class="input-group-text">
                                      <i class="la la-phone"></i>
                                    </span>
                                  </div>
                                  <input type="text" class="form-control" placeholder="Phone"/>
                                </div>
                              </div>
                              <div class="col-lg-5">
                                <div class="input-group">
                                  <div class="input-group-prepend">
                                    <span class="input-group-text">
                                      <i class="la la-envelope"></i>
                                    </span>
                                  </div>
                                  <input type="text" class="form-control" placeholder="Email"/>
                                </div>
                              </div>
                              <div class="col-lg-2">
                                <a href="javascript:;" data-repeater-delete="" class="btn font-weight-bold btn-danger btn-icon">
                                  <i class="la la-remove"></i>
                                </a>
                              </div>
                            </div>
                          </div>
                        </div>
                        <div class="form-group row">
                          <div class="col-lg-3"></div>
                          <div class="col">
                            <div data-repeater-create="" class="btn font-weight-bold btn-primary">
                              <i class="la la-plus"></i>
                              Add
                            </div>
                          </div>
                        </div>
                      </div>
                    </div>
                    <div class="card-footer">
                      <div class="row">
                        <div class="col-lg-3"></div>
                        <div class="col-lg-6">
                          <button type="reset" class="btn font-weight-bold btn-primary btn-shadow mr-2">Submit</button>
                          <button type="reset" class="btn font-weight-bold btn-secondary btn-shadow">Cancel</button>
                        </div>
                      </div>
                    </div>
                  </form>
                  <!--end::Form-->
                </div>


                <div class="portlet-body form hidden">

                  <div class="row">
                    <div class="col-md-12">
                      <!-- BEGIN EXAMPLE TABLE PORTLET-->
                      <div class="portlet box">

                        <div class="portlet-body form">
                          <div class="form-body">

                            <div class="form-group">
                              <div class="control-label col-md-2">
                                <label>{{trans(lang_app_site().'.CP.Custom')}}</label>
                              </div>
                              <div class="col-md-2">
                                <select class="form-control" id="custom_id">
                                  @foreach($customizations as $custom)
                                  <option value="{{$custom->id}}">{{$custom->name}}</option>
                                  @endforeach
                                </select>
                              </div>
                              <div class="control-label col-md-2">
                                <label>{{trans(lang_app_site().'.CP.Extra-Cost')}}</label>
                              </div>
                              <div class="col-md-2">
                                <input class="form-control" type="number"
                                id="price">
                              </div>
                              <div class="custom_color" style="display: none;">
                                <div class="control-label col-md-2">
                                  <label>{{trans(lang_app_site().'.CP.Color')}}</label>
                                </div>
                                <div class="col-md-2">
                                  <input type="text" id="hue-demo"
                                  class="form-control demo"
                                  data-control="hue" name="text"
                                  placeholder="#ff6161"
                                  autocomplete="off">
                                </div>
                              </div>
                              <div class="custom_title">
                                <div class="control-label col-md-2">
                                  <label>{{trans(lang_app_site().'.CP.Title')}}</label>
                                </div>
                                <div class="col-md-2">
                                  <input type="text" class="form-control title"
                                  name="title">
                                </div>

                              </div>
                            </div>

                          </div>
                          <div class="form-group">
                            <div class="control-label col-md-2">
                              <label>{{trans(lang_app_site().'.CP.Description')}}</label>
                            </div>
                            <div class="col-md-2">
                              <input class="form-control" type="text"
                              id="description">
                            </div>
                            {{--                                                    <div class="control-label col-md-2">--}}
                              {{--                                                        <label>Default</label>--}}
                              {{--                                                    </div>--}}
                              {{--                                                    <div class="col-md-2">--}}
                                {{--                                                        <input class="form-control" type="checkbox"--}}
                                {{--                                                               id="is_default">--}}
                                {{--                                                    </div>--}}
                              </div>

                            </div>
                          </div>
                        </div>
                        <!-- END EXAMPLE TABLE PORTLET-->


                      </div>
                      <div class="form-actions" style="display: block;">
                        <div class="row">
                          <div class="col-md-12 text-center">
                            <button type="button" class="btn btn-circle default add-custom"><i
                              class="fa fa-plus"></i>
                              {{trans(lang_app_site().'.CP.Add custom')}}
                            </button>
                          </div>
                        </div>
                      </div>
                    </div>

                    <div class="row">
                      <div class="col-md-12">
                        <table class="table table-striped table-bordered table-hover table-checkable order-column">
                          <thead>
                            <tr>
                              <th>#</th>
                              {{--                                                                <th> Logo</th>--}}
                              <th>{{trans(lang_app_site().'.CP.Custom')}} </th>
                              <th>{{trans(lang_app_site().'.CP.Title')}} /Color</th>
                              <th>{{trans(lang_app_site().'.CP.Description')}} </th>
                              <th>{{trans(lang_app_site().'.CP.Extra-Cost')}} </th>
                              {{--                                            <th> Default</th>--}}
                              <th>{{trans(lang_app_site().'.CP.Action')}} </th>
                            </tr>
                          </thead>
                          <tbody class="custom-row">

                          </tbody>
                        </table>

                      </div>
                    </div>
                  </div>
                </div>


              </div>
              <div class="form-actions save_operations" style="display: block;">
                <div class="row">
                  <div class="col-md-12 text-center">
                    <button type="submit" class="btn btn-circle green save"><i
                      class="fa fa-check"></i>
                      {{trans(lang_app_site().'.CP.Save Product')}}
                    </button>
                  </div>
                </div>
              </div>
              {!! Form::close() !!}


              @endsection
              @section('js')

              <script src="{{url('/')}}/assets/global/scripts/datatable.js" type="text/javascript"></script>
              <script src="{{url('/')}}/assets/global/plugins/datatables/datatables.min.js" type="text/javascript"></script>
              <script src="{{url('/')}}/assets/global/plugins/datatables/plugins/bootstrap/datatables.bootstrap.js"
              type="text/javascript"></script>

              <!-- BEGIN PAGE LEVEL PLUGINS -->
              <script src="{{url('/')}}/assets/global/plugins/fancybox/source/jquery.fancybox.pack.js"
              type="text/javascript"></script>
              <script src="{{url('/')}}/assets/global/plugins/jquery-file-upload/js/vendor/jquery.ui.widget.js"
              type="text/javascript"></script>
              <script src="{{url('/')}}/assets/global/plugins/jquery-file-upload/js/vendor/tmpl.min.js"
              type="text/javascript"></script>
              <script src="{{url('/')}}/assets/global/plugins/jquery-file-upload/js/vendor/load-image.min.js"
              type="text/javascript"></script>
              <script src="{{url('/')}}/assets/global/plugins/jquery-file-upload/js/vendor/canvas-to-blob.min.js"
              type="text/javascript"></script>
              <script src="{{url('/')}}/assets/global/plugins/jquery-file-upload/blueimp-gallery/jquery.blueimp-gallery.min.js"
              type="text/javascript"></script>
              <script src="{{url('/')}}/assets/global/plugins/jquery-file-upload/js/jquery.iframe-transport.js"
              type="text/javascript"></script>
              <script src="{{url('/')}}/assets/global/plugins/jquery-file-upload/js/jquery.fileupload.js"
              type="text/javascript"></script>
              <script src="{{url('/')}}/assets/global/plugins/jquery-file-upload/js/jquery.fileupload-process.js"
              type="text/javascript"></script>
              <script src="{{url('/')}}/assets/global/plugins/jquery-file-upload/js/jquery.fileupload-image.js"
              type="text/javascript"></script>
              <script src="{{url('/')}}/assets/global/plugins/jquery-file-upload/js/jquery.fileupload-audio.js"
              type="text/javascript"></script>
              <script src="{{url('/')}}/assets/global/plugins/jquery-file-upload/js/jquery.fileupload-video.js"
              type="text/javascript"></script>
              <script src="{{url('/')}}/assets/global/plugins/jquery-file-upload/js/jquery.fileupload-validate.js"
              type="text/javascript"></script>
              <script src="{{url('/')}}/assets/global/plugins/jquery-file-upload/js/jquery.fileupload-ui.js"
              type="text/javascript"></script>

              <script src="{{url('/')}}/assets/global/plugins/bootstrap-colorpicker/js/bootstrap-colorpicker.js"
              type="text/javascript"></script>
              <script src="{{url('/')}}/assets/global/plugins/jquery-minicolors/jquery.minicolors.min.js"
              type="text/javascript"></script>

              <!-- END PAGE LEVEL PLUGINS -->
              <script src="{{url('/')}}/assets/global/plugins/jquery-ui/jquery-ui.min.js" type="text/javascript"></script>

              <!-- BEGIN THEME GLOBAL SCRIPTS -->
              <script src="{{url('/')}}/assets/global/scripts/app.min.js" type="text/javascript"></script>
              <!-- END THEME GLOBAL SCRIPTS -->
              <script src="{{url('/')}}/assets/pages/scripts/components-color-pickers.min.js" type="text/javascript"></script>

              <script src="{{url('/')}}/assets/pages/scripts/table-datatables-responsive.min.js" type="text/javascript"></script>

              <script>
              var FormFileUpload = function () {
                return {
                  init: function () {
                    $("#fileuploadProduct").fileupload({
                      disableImageResize: !1,
                      autoUpload: !1,
                      disableImageResize: /Android(?!.*Chrome)|Opera/.test(window.navigator.userAgent),
                      maxFileSize: 5e6,
                      acceptFileTypes: /(\.|\/)(gif|jpe?g|png)$/i
                    }), $("#fileuploadProduct").fileupload("option", "redirect", window.location.href.replace(/\/[^\/]*$/, "/cors/result.html?%s")), $.support.cors && $.ajax({type: "HEAD"}).fail(function () {
                      $('<div class="alert alert-danger"/>').text("Upload server currently unavailable - " + new Date).appendTo("#fileuploadProduct")
                    }), $("#fileuploadProduct").addClass("fileupload-processing"),

                    $.ajax({
                      url: $("#fileuploadProduct").attr("action"),
                      dataType: "json",
                      context: $("#fileuploadProduct")[0],
                      data: {_token: csrf_token}
                    }).always(function () {
                      $(this).removeClass("fileupload-processing")
                    }).done(function (e) {
                      $(this).fileupload("option", "done").call(this, $.Event("done"), {result: e})
                    })
                  }
                }
              }();
              jQuery(document).ready(function () {
                FormFileUpload.init()
              });
              </script>
              {{--    <script src="{{url('/')}}/assets/global/plugins/ckeditor/ckeditor.js"></script>--}}
              <script src="{{url('/')}}/assets/js/products.js" type="text/javascript"></script>

              <!-- BEGIN PAGE LEVEL SCRIPTS -->

              @stop
