@extends(admin_layout_vw().'.index')

@section('css')
    <!-- BEGIN THEME GLOBAL STYLES -->
    <link href="{{url('/')}}/assets/global/css/components-md-rtl.min.css" rel="stylesheet" id="style_components"
          type="text/css"/>
    <link href="{{url('/')}}/assets/global/css/plugins-md-rtl.min.css" rel="stylesheet" type="text/css"/>
    <!-- END THEME GLOBAL STYLES -->

@endsection
@section('content')
    <div class="row">
        <div class="col-md-12 ">
            <!-- BEGIN SAMPLE FORM PORTLET-->
            <div class="portlet light ">
                <div class="portlet-title">
                    <div class="caption">
                        <i class="fa fa-plus font-dark sbold"></i> <span
                                class="caption-subject font-dark sbold uppercase">Add new permission</span>
                    </div>
                </div>

                {{--`name`, `display_name`, `parent_id`, `controller_name`, `function_name`, `type`, `icon`, `is_sidebar`,--}}
                <div class="portlet-body form">
                    {{--<form class="form-horizontal" role="form">--}}
                    {!! Form::open(['method'=>'POST','class'=>'form-horizontal','url'=>url(admin_vw().'/addPermission'),'id'=>'add-permission']) !!}
                    <div class="form-body">
                        <div class="form-group">
                            <label class="col-md-3 control-label">Name</label>
                            <div class="col-md-9">
                                <input type="text" class="form-control input-md" name="name" placeholder="Name">
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-md-3 control-label">Alias</label>
                            <div class="col-md-9">
                                <input type="text" class="form-control input-md" name="alias" placeholder="Alias">
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-md-3 control-label">Display Name</label>
                            <div class="col-md-9">
                                <input type="text" class="form-control input-md" name="display_name"
                                       placeholder="Display Name"></div>
                        </div>
                        <div class="form-group">
                            <label class="col-md-3 control-label">Parent</label>
                            <div class="col-md-9">
                                <select class="form-control input-md" name="parent_id">
                                    <option value="">Select Parent...</option>
                                    @foreach($permission_master as $master)
                                    <option value="{{$master->id}}">{{$master->display_name}}</option>

                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-md-3 control-label">Controller</label>
                            <div class="col-md-9">
                                <input type="text" class="form-control input-md" name="controller_name"
                                       placeholder="Controller"></div>
                        </div>
                        <div class="form-group">
                            <label class="col-md-3 control-label">Function</label>
                            <div class="col-md-9">
                                <input type="text" class="form-control input-md" name="function_name"
                                       placeholder="Function"></div>
                        </div>
                        <div class="form-group">
                            <label class="col-md-3 control-label">Icon</label>
                            <div class="col-md-9">
                                <input type="text" class="form-control input-md" name="icon"
                                       placeholder="Icon"></div>
                        </div>

                        <div class="form-group">
                            <label class="col-md-3 control-label">Type</label>
                            <div class="col-md-9">
                                <select class="form-control input-md" name="type">
                                    <option value="">Select Type...</option>
                                    <option value="get">Get</option>
                                    <option value="post">Post</option>
                                    <option value="put">Put</option>
                                    <option value="delete">Delete</option>
                                </select>
                            </div>
                        </div>

                    </div>

                    <div class="form-group">
                        <label class="col-md-3 control-label">Is Sidebar</label>
                        <div class="col-md-9">
                            <div class="md-checkbox"><input type="checkbox" id="checkbox1" class="md-check"
                                                            name="is_sidebar">
                                <label for="checkbox1"><span></span><span class="check"></span><span
                                            class="box"></span> </label></div>
                        </div>
                    </div>
                    <div class="form-actions text-center">
                        <button type="submit" class="btn green">Save</button>
                        <a href="{{url(admin_vw().'/permissions')}}" class="btn blue">List of permissions</a>
                    </div>
                    {{--</form>--}}
                    {!! Form::close() !!}
                </div>
            </div>
            <!-- END SAMPLE FORM PORTLET-->
        </div>
    </div>
@endsection
@section('js')
    <script src="{{url('/')}}/assets/global/scripts/app.min.js" type="text/javascript"></script>
    <script src="{{url('/')}}/assets/js/permission.js" type="text/javascript"></script>

@stop