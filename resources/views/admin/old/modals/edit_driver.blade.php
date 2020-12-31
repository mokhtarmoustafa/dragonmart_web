<link href="{{url('/')}}/assets/global/plugins/bootstrap-fileinput/bootstrap-fileinput.css" rel="stylesheet"
      type="text/css"/>

<div class="modal fade bs-modal-lg" id="editDriver" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
                <h4 class="modal-title"><i class="fa fa-user-plus"></i> Edit Driver<span
                            class="badge badge-primary name "
                            style="text-transform: inherit"></span></h4>
            </div>
            <div class="modal-body">
                <div class="portlet-body form">

                    {!! Form::open(['method'=>'PUT','class'=>'form-horizontal form-bordered form-row-stripped','url'=>url(((getAuth()->type == 'admin') ? admin_user_tab_url() : getAuth()->type).'/user-driver/'.$user->id.'/edit'),'files'=>true,'id'=>'formEditDriver']) !!}
                    <div class="alert alert-danger" style="display: none">

                    </div>

                    <div class="form-body">

                        <div class="form-group">

                            <div class="control-label col-md-4">
                                <h3 class="form-section font-blue-madison" style="display: block;text-align: left">
                                    General Information</h3></div>
                        </div>
                        <div class="form-group ">
                            <label class="control-label col-md-2">Photo</label>
                            <div class="col-md-4">
                                <div class="fileinput fileinput-new" data-provides="fileinput">
                                    <div class="fileinput-preview thumbnail" data-trigger="fileinput"
                                         style="width: 200px; height: 150px;">
                                        <img src="{{$user->image ??'http://www.placehold.it/200x150/EFEFEF/AAAAAA&amp;text=no+image'}}"
                                             alt=""/>

                                    </div>
                                    <div>
                                                            <span class="btn red btn-outline btn-file">
                                                                <span class="fileinput-new"> Select </span>
                                                                <span class="fileinput-exists"> Change </span>
                                                                <input type="file" name="image"
                                                                       id="image"> </span>
                                        <a href="javascript:;" class="btn red fileinput-exists"
                                           data-dismiss="fileinput">
                                            Remove </a>
                                    </div>
                                </div>

                            </div>
                            <label class="control-label col-md-2">Vehicle Photo</label>
                            <div class="col-md-4">
                                <div class="fileinput fileinput-new" data-provides="fileinput">
                                    <div class="fileinput-preview thumbnail" data-trigger="fileinput"
                                         style="width: 200px; height: 150px;">
                                        <img src="{{$user->Vehicle->photo ??'http://www.placehold.it/200x150/EFEFEF/AAAAAA&amp;text=no+image'}}"
                                             alt=""/>

                                    </div>
                                    <div>
                                                            <span class="btn red btn-outline btn-file">
                                                                <span class="fileinput-new"> Select </span>
                                                                <span class="fileinput-exists"> Change </span>
                                                                <input type="file" name="vehicle_photo"
                                                                       id="vehicle_photo"> </span>
                                        <a href="javascript:;" class="btn red fileinput-exists"
                                           data-dismiss="fileinput">
                                            Remove </a>
                                    </div>
                                </div>

                            </div>
                        </div>
                        <div class="form-group">
                            <div class="control-label col-md-2">
                                <label for="driver_types">Driver name</label>
                            </div>
                            <div class="col-md-4">
                                <input type="text" name="username" id="username" class="form-control"
                                       placeholder="user name ..." value="{{$user->username}}">
                            </div>
                            <div class="control-label col-md-2">
                                <label for="driver_types">Email</label>
                            </div>
                            <div class="col-md-4">
                                <input type="email" name="email" id="email" class="form-control"
                                       placeholder="Email ..." value="{{$user->email}}">
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="control-label col-md-2">
                                <label for="driver_types">Phone</label>
                            </div>
                            <div class="control-label col-md-4">
                                <input type="text" name="mobile" id="mobile" class="form-control"
                                       placeholder="Phone ..." value="{{$user->mobile}}">
                            </div>
                            <div class="control-label col-md-2">
                                <label for="driver_types">City</label>
                            </div>
                            <div class="col-md-4">
                                <select class="form-control" name="city_id" id="city_id">
                                    <option>Select ...</option>
                                    @foreach($cities as $city)
                                        <option value="{{$city->id}}"
                                                @if($user->city_id == $city->id) selected @endif>{{$city->name_en}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="control-label col-md-2">
                                <label for="driver_types">Address</label>
                            </div>
                            <div class="control-label col-md-4">
                                <input type="text" name="address" id="address" class="form-control"
                                       placeholder="Address ..." value="{{$user->mobile ?? ''}}">
                            </div>
                            {{--                            <div class="control-label col-md-2">--}}
                            {{--                                <label for="driver_types">Driver type</label>--}}
                            {{--                            </div>--}}
                            {{--                            <div class="control-label col-md-4">--}}
                            {{--                                <select class="form-control" name="driver_type_id" id="driver_type_id">--}}
                            {{--                                    <option>Select ...</option>--}}
                            {{--                                    @foreach($driver_types as $type)--}}
                            {{--                                        <option value="{{$type->id}}">{{$type->name}}</option>--}}
                            {{--                                    @endforeach--}}
                            {{--                                </select>--}}
                            {{--                            </div>--}}

                        </div>

                        <div class="form-group">

                            <div class="control-label col-md-4">
                                <h3 class="form-section font-blue-madison" style="display: block;text-align: left">
                                    Vehicle Information</h3></div>
                        </div>
                        <div class="form-group">
                            <div class="control-label col-md-2">
                                <label for="driver_types">Manufacturer</label>
                            </div>
                            <div class="col-md-4">
                                <select class="form-control" name="manufacturer_id" id="manufacturer_id">
                                    <option>Select ...</option>
                                    @foreach($manufacturers as $manufacturer)
                                        <option value="{{$manufacturer->id}}"
                                                @if(isset($user->Vehicle) && $user->Vehicle->CarType->manufacturer_id == $manufacturer->id) selected @endif>{{$manufacturer->title}}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="control-label col-md-2">
                                <label for="driver_types">Type</label>
                            </div>
                            <div class="col-md-4">
                                <select class="form-control" name="vehicle_type_id" id="car_type_id">
                                    @foreach($car_types as $car_type)
                                        <option value="{{$car_type->id}}"
                                                @if(isset($user->Vehicle) && $user->Vehicle->CarType->id == $car_type->id) selected @endif>{{$car_type->title}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="form-group">

                            <div class="control-label col-md-2">
                                <label for="driver_types">Model</label>
                            </div>
                            <div class="control-label col-md-4">
                                <input type="text" name="vehicle_model" id="model" class="form-control"
                                       placeholder="Year ..." value="{{$user->Vehicle->model ?? ''}}">
                            </div>
                            <div class="control-label col-md-2">
                                <label for="driver_types">Color</label>
                            </div>
                            <div class="control-label col-md-4">
                                <input type="text" name="vehicle_color" id="color" class="form-control"
                                       placeholder="Color ..." value="{{$user->Vehicle->color ?? ''}}">
                            </div>
                        </div>
                        <div class="form-group">

                            <div class="control-label col-md-2">
                                <label for="driver_types">Vehicle No.</label>
                            </div>
                            <div class="control-label col-md-4">
                                <input type="text" name="vehicle_no" id="no" class="form-control"
                                       placeholder="Vehicle No ..." value="{{$user->Vehicle->no ?? ''}}">
                            </div>
                        </div>

                        <div class="form-group">

                            <div class="control-label col-md-4">
                                <h3 class="form-section font-blue-madison" style="display: block;text-align: left">
                                    Vehicle Document</h3></div>
                        </div>
                        <div class="form-group">

                            <div class="control-label col-md-2">
                                <label for="driver_types">Car licences</label>
                            </div>
                            <div class="control-label col-md-4">
                                <input type="file" name="document" id="document" class="form-control"
                                       placeholder="Car licences ...">
                            </div>
                            <div class="control-label col-md-2">
                                <label for="driver_types">License driving</label>
                            </div>
                            <div class="control-label col-md-4">
                                <input type="file" name="license_driving" id="license_driving" class="form-control"
                                       placeholder="License driving ...">
                            </div>
                        </div>
                        <div class="form-group">

                            {{--                            <div class="control-label col-md-2">--}}
                            {{--                                <label for="driver_types">Document</label>--}}
                            {{--                            </div>--}}
                            {{--                            <div class="control-label col-md-4">--}}
                            {{--                                <input type="file" name="document" id="document" class="form-control"--}}
                            {{--                                       placeholder="Document ...">--}}
                            {{--                            </div>--}}
                            <div class="control-label col-md-2">
                                <label for="driver_types">Driver ID</label>
                            </div>
                            <div class="control-label col-md-4">
                                <input type="file" name="vehicle_id_no" id="vehicle_id_no" class="form-control"
                                       placeholder="Driver ID ...">
                            </div>
                        </div>

                    </div>

                    <div class="form-body">

                        <div class="form-actions">
                            <div class="row">
                                <div class="col-md-12 text-center">
                                    <button type="submit" class="btn btn-circle green btn-md save"><i
                                                class="fa fa-check"></i>
                                        Save
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

<script src="{{url('/')}}/assets/global/plugins/bootstrap-fileinput/bootstrap-fileinput.js"
        type="text/javascript"></script>
