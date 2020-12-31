@extends(merchant_layout_vw().'.index')

@section('css')
<style>
.table-container td {
  font-size: 20px;
  padding-top: 4px;
}

</style>
@endsection
@section('content')


</td>
<td></td>
<td> </td>
<td> </td>

<div class="card card-custom gutter-b">
  <div class="card-body">
    <!--begin::Details-->
    <div class="d-flex">
      <!--begin: Pic-->
      <div class="flex-shrink-0 mr-7 mt-lg-0 mt-3">
        <div class="symbol symbol-50 symbol-lg-70">
          <img src="{{$user->image100 ?? url('assets/apps/img/man.svg')}}" alt="image">
        </div>
        <div class="symbol symbol-50 symbol-lg-120 symbol-primary d-none">
          <span class="font-size-h3 symbol-label font-weight-boldest">JM</span>
        </div>
      </div>
      <!--end::Pic-->
      <!--begin::Info-->
      <div class="flex-grow-1">
        <!--begin::Title-->
        <div class="d-flex justify-content-between flex-wrap mt-1">
          <div class="d-flex mr-3">
            <a href="#" class="text-dark-75 text-hover-primary font-size-h5 font-weight-bold mr-3">{{$user->username ?? ''}}</a>
            <a href="#">
              <i class="flaticon2-correct text-success font-size-h5"></i>
            </a>
          </div>
        </div>
        <!--end::Title-->
        <!--begin::Content-->
        <div class="d-flex flex-wrap justify-content-between mt-1">
          <div class="d-flex flex-column flex-grow-1 pr-8">
            <div class="d-flex flex-wrap mb-4">
              <a href="#" class="text-dark-50 text-hover-primary font-weight-bold mr-lg-8 mr-5 mb-lg-0 mb-2">
                <i class="flaticon2-new-email mr-2 font-size-lg"></i>{{$user->email ?? ''}}</a>
                <a href="#" class="text-dark-50 text-hover-primary font-weight-bold mr-lg-8 mr-5 mb-lg-0 mb-2">
                  <i class="flaticon2-placeholder mr-2 font-size-lg"></i>{{$user->city->name_ar ?? ''}}</a>
                  <a href="#" class="text-dark-50 text-hover-primary font-weight-bold mr-lg-8 mr-5 mb-lg-0 mb-2">
                    <i class="flaticon2-phone mr-2 font-size-lg"></i>{{$user->mobile ?? ''}}</a>
                  </div>
                </div>
              </div>
              <!--end::Content-->
            </div>

            <div class="d-flex align-items-center mr-2">
              <!--begin::Symbol-->
              <div class="symbol symbol-45 symbol-light-success mr-4 flex-shrink-0">
                <div class="symbol-label">
                  <span class="svg-icon svg-icon-lg svg-icon-success">
                    <span class="svg-icon svg-icon-primary svg-icon-2x">
                      <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
                        <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                          <rect x="0" y="0" width="24" height="24"/>
                          <circle fill="#000000" opacity="0.3" cx="20.5" cy="12.5" r="1.5"/>
                          <rect fill="#000000" opacity="0.3" transform="translate(12.000000, 6.500000) rotate(-15.000000) translate(-12.000000, -6.500000) " x="3" y="3" width="18" height="7" rx="1"/>
                          <path d="M22,9.33681558 C21.5453723,9.12084552 21.0367986,9 20.5,9 C18.5670034,9 17,10.5670034 17,12.5 C17,14.4329966 18.5670034,16 20.5,16 C21.0367986,16 21.5453723,15.8791545 22,15.6631844 L22,18 C22,19.1045695 21.1045695,20 20,20 L4,20 C2.8954305,20 2,19.1045695 2,18 L2,6 C2,4.8954305 2.8954305,4 4,4 L20,4 C21.1045695,4 22,4.8954305 22,6 L22,9.33681558 Z" fill="#000000"/>
                        </g>
                      </svg>
                    </span>
                  </div>
                </div>
                <div>
                  <div class="font-size-h4 text-dark-75 font-weight-bolder">$706</div>
                  <div class="font-size-sm text-muted font-weight-bold mt-1">المحفظة</div>
                </div>
              </div>

            </div>

          </div>


          <ul class="nav nav-light-success nav-pills px-7" id="myTab3" role="tablist">
            <li class="nav-item">
              <a class="nav-link active" id="home-tab-3" data-toggle="tab" href="#home-3">
                <span class="nav-icon">
                  <i class="flaticon2-chat-1"></i>
                </span>
                <span class="nav-text">{{trans(lang_app_site().'.CP.General Information')}}</span>
              </a>
            </li>
            <li class="nav-item">
              <a class="nav-link" id="profile-tab-3" data-toggle="tab" href="#profile-3" aria-controls="profile">
                <span class="nav-icon">
                  <i class="flaticon2-layers-1"></i>
                </span>
                <span class="nav-text">Profile</span>
              </a>
            </li>
            <li class="nav-item">
              <a class="nav-link" id="contact-tab-3" data-toggle="tab" href="#contact-3" aria-controls="contact">
                <span class="nav-icon">
                  <i class="flaticon2-rocket-1"></i>
                </span>
                <span class="nav-text">Contact</span>
              </a>
            </li>
          </ul>
          <div class="tab-content mt-5 px-7" id="myTabContent3">
            <div class="tab-pane fade active show" id="home-3" role="tabpanel" aria-labelledby="home-tab-3">Tab content 1</div>
            <div class="tab-pane fade" id="profile-3" role="tabpanel" aria-labelledby="profile-tab-3">Tab content 2</div>
            <div class="tab-pane fade" id="contact-3" role="tabpanel" aria-labelledby="contact-tab-3">Tab content 3</div>
          </div>



        </div>




        <div class="row">

          <div class="col-md-12">
            <!-- BEGIN EXAMPLE TABLE PORTLET-->

            <div class="portlet light ">
              <div class="portlet-title">
                <div class="caption font-dark">
                  <i class="{{$icon}} font-dark"></i>
                  <span class="caption-subject bold uppercase"> Driver Information</span>
                </div>

              </div>


              <div class="portlet-body">
                <div class="row">
                  <div class="col-md-12">
                    <div class="portlet light ">
                      <div class="portlet-body">
                        <ul class="nav nav-tabs">

                          <li class="active">
                            <a href="#general_information" data-toggle="tab"> General Information </a>
                          </li>
                          <li>
                            <a href="#vehicle_info" data-toggle="tab"> Vehicle Info </a>
                          </li>
                          <li>
                            <a href="#docs" data-toggle="tab"> Documents </a>
                          </li>


                        </ul>
                        <div class="tab-content">

                          <div class="tab-pane fade  active in " id="general_information">

                            <div class="portlet-body form">

                              <table class="table table-striped table-bordered table-hover table-checkable order-column"
                              id="driver-det-tbl">
                              <thead>
                                <tr>
                                  <th width="20%"> Logo</th>
                                  <th> Username</th>
                                  <th> Email</th>
                                  <th> City</th>
                                  <th> Address</th>
                                  <th> Mobile</th>
                                  <th> Register Date</th>
                                  <th> Status</th>
                                </tr>
                              </thead>
                              <tbody>
                                <tr>
                                  <td>
                                    <div class="fileinput fileinput-new">
                                      <div class="">
                                        <img src="{{$user->image100 ?? url('assets/apps/img/man.svg')}}"
                                        style="width:50px;height: 50px;"
                                        class="img-circle">
                                      </div>

                                    </div>
                                  </td>
                                  <td>{{$user->username ?? ''}}</td>
                                  <td> {{$user->email ?? ''}}</td>
                                  <td> {{$user->city->name_ar ?? ''}}</td>

                                  <td><a
                                    href="{{url(getAuth()->type . '/user/' . $user->id)}}"
                                    class="btn btn-circle btn-icon-only blue user-det"
                                    title="Address">
                                    <i class="fa fa-map"></i>
                                  </a></td>
                                  <td> {{$user->mobile ?? ''}}</td>
                                  <td>{{\Carbon\Carbon::parse($user->created_at)->format('Y-m-d') ?? ''}}</td>
                                  <td>
                                    @if($user->is_active) <span class="label label-success">Activate</span> @else <span class="label label-warning">Suspend</span> @endif
                                  </td>

                                </tr>
                              </tbody>
                            </table>

                          </div>
                        </div>

                        <div class="tab-pane fade " id="vehicle_info">

                          <div class="portlet-body form">

                            <table class="table table-striped table-bordered table-hover table-checkable order-column">
                              <thead>
                                <tr>
                                  <th> Photo</th>
                                  <th width="20%"> Type</th>
                                  <th> Model</th>
                                  <th> Color</th>
                                  <th> Number</th>
                                </tr>
                              </thead>
                              <tbody>
                                <tr>
                                  <td>
                                    <div class="fileinput fileinput-new">
                                      <div class="">
                                        <img src="{{$user->vehicle->photo ?? url('assets/apps/img/man.svg')}}"
                                        style="width:50px;height: 50px;"
                                        class="img-circle">
                                      </div>

                                    </div>
                                  </td>
                                  <td> {{$user->vehicle->car_type->title ?? ''}}</td>
                                  <td> {{$user->vehicle->model ?? ''}}</td>
                                  <td> {{$user->vehicle->color ?? ''}}</td>
                                  <td> {{$user->vehicle->no ?? ''}}</td>
                                </tr>
                              </tbody>
                            </table>
                          </div>
                        </div>
                        <div class="tab-pane fade " id="docs">

                          <div class="portlet-body form">

                            <table class="table table-striped table-bordered table-hover table-checkable order-column">
                              <thead>
                                <tr>
                                  <th width="20%"> File name</th>
                                  <th> Action</th>
                                </tr>
                              </thead>
                              <tbody>
                                <tr>
                                  <td> Car License</td>
                                  <td><a href="{{$user->vehicle->document ?? ''}}"
                                    class="btn btn-primary btn-icon-only btn-circle"
                                    download="CarLicense.png"><i class="fa fa-download"></i></a>
                                  </td>
                                </tr>
                                <tr>
                                  <td> Driver Id</td>
                                  <td><a href="{{$user->vehicle->id_no ?? ''}}"
                                    class="btn btn-primary btn-icon-only btn-circle"
                                    download="DriverID.png"><i
                                    class="fa fa-download"></i></a></td>

                                  </tr>
                                  <tr>
                                    <td> License driving</td>
                                    <td><a href="{{$user->vehicle->license_driving ?? ''}}"
                                      class="btn btn-primary btn-icon-only btn-circle"
                                      download="LicenseDriving.png"><i
                                      class="fa fa-download"></i></a></td>

                                    </tr>
                                    {{--                                                    <tr>--}}
                                      {{--                                                        <td> Document</td>--}}
                                      {{--                                                        <td><a href="{{$user->vehicle->document ?? ''}}"--}}
                                        {{--                                                               class="btn btn-primary btn-icon-only btn-circle"--}}
                                        {{--                                                               download="document.png"><i--}}
                                        {{--                                                                        class="fa fa-download"></i></a></td>--}}

                                        {{--                                                    </tr>--}}
                                      </tbody>
                                    </table>
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
                  <!-- END EXAMPLE TABLE PORTLET-->
                </div>
              </div>
              @endsection

              @section('js')

              <!-- BEGIN PAGE LEVEL PLUGINS -->
              <script src="{{url('/')}}/assets/global/scripts/datatable.js" type="text/javascript"></script>
              <script src="{{url('/')}}/assets/global/plugins/datatables/datatables.min.js"
              type="text/javascript"></script>
              <script src="{{url('/')}}/assets/global/plugins/datatables/plugins/bootstrap/datatables.bootstrap.js"
              type="text/javascript"></script>
              <!-- END PAGE LEVEL PLUGINS -->

              {{--<script type="text/javascript" src="javascripts/jquery.googlemap.js"></script>--}}
              <script src="{{url('/')}}/assets/global/plugins/jquery-ui/jquery-ui.min.js" type="text/javascript"></script>

              <!-- BEGIN THEME GLOBAL SCRIPTS -->
              <script src="{{url('/')}}/assets/global/scripts/app.min.js" type="text/javascript"></script>
              <!-- END THEME GLOBAL SCRIPTS -->
              {{--<script src="{{url('/')}}/assets/pages/scripts/maps-google.min.js" type="text/javascript"></script>--}}
              <script src="{{url('/')}}/assets/pages/scripts/components-bootstrap-switch.min.js"
              type="text/javascript"></script>

              <script src="{{url('/')}}/assets/pages/scripts/ui-modals.min.js" type="text/javascript"></script>

              <!-- BEGIN PAGE LEVEL SCRIPTS -->
              <script src="{{url('/')}}/assets/pages/scripts/table-datatables-responsive.min.js"
              type="text/javascript"></script>

              {{--<script src="{{url('/')}}/assets/pages/scripts/table-datatables-managed.min.js" type="text/javascript"></script>--}}
              <!-- END PAGE LEVEL SCRIPTS -->
              <script src="{{url('/')}}/assets/js/users.js" type="text/javascript"></script>
              <script type="text/javascript">

              </script>




              @stop
