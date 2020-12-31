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
                        <i class="fa fa-edit font-dark sbold"></i> <span
                                class="caption-subject font-dark sbold uppercase">تعديل الصلاحية</span>
                    </div>
                </div>
                <div class="portlet-body form">
                    {!! Form::open(['method'=>'PUT','class'=>'form-horizontal','id'=>'edit-role']) !!}
                    {{--<div class="alert alert-danger" style="display: none;">--}}
                    {{--</div>--}}
                    <div class="form-body">
                        <div class="form-group">
                            <label class="col-md-3 control-label">اسم مخفي</label>
                            <div class="col-md-9">
                                <input type="text" class="form-control input-md" name="name" placeholder="اسم مخفي"
                                       value="{{$role->name ?? ''}}"></div>
                        </div>
                        <div class="form-group">
                            <label class="col-md-3 control-label">اسم عرض</label>
                            <div class="col-md-9">
                                <input type="text" class="form-control input-md" name="display_name"
                                       placeholder="اسم عرض" value="{{$role->display_name ?? ''}}"></div>
                        </div>
                        <div class="form-group">
                            <label class="col-md-3 control-label">تفاصيل</label>
                            <div class="col-md-9">
                                    <textarea class="form-control input-md" name="description"
                                              placeholder="تفاصيل" rows="5">{{$role->description ?? ''}}</textarea>
                            </div>
                        </div>

                    </div>
                    <div class="form-actions text-center">
                        <button type="submit" class="btn purple">تعديل <i class="fa fa-edit"></i></button>
                        {{--<a href="{{url(admin_vw().'/roles')}}" class="btn blue">List of roles</a>--}}
                    </div>
                    {!! Form::close() !!}
                </div>
            </div>
            <!-- END SAMPLE FORM PORTLET-->
        </div>
    </div>
@endsection
@section('js')
    <script src="{{url('/')}}/assets/global/scripts/app.min.js" type="text/javascript"></script>
    <script src="{{url('/')}}/assets/js/role.js" type="text/javascript"></script>

@stop