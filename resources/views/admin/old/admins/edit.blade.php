@extends(admin_layout_vw().'.index')

@section('css')
    <!-- BEGIN THEME GLOBAL STYLES -->
    <link href="{{url('/')}}/assets/global/css/components-md-rtl.min.css" rel="stylesheet" id="style_components"
          type="text/css"/>
    <link href="{{url('/')}}/assets/global/css/plugins-md-rtl.min.css" rel="stylesheet" type="text/css"/>
    <!-- END THEME GLOBAL STYLES -->
    <link href="{{url('/')}}/assets/global/plugins/select2/css/select2.min.css" rel="stylesheet" type="text/css"/>
    <link href="{{url('/')}}/assets/global/plugins/select2/css/select2-bootstrap.min.css" rel="stylesheet"
          type="text/css"/>
@endsection
@section('content')
    <div class="row">
        <div class="col-md-12 ">
            <!-- BEGIN SAMPLE FORM PORTLET-->
            <div class="portlet light ">
                <div class="portlet-title">
                    <div class="caption">
                        <i class="fa fa-edit font-dark sbold"></i> <span
                                class="caption-subject font-dark sbold uppercase">تعديل البيانات</span>
                    </div>
                </div>
                {{-- `name`, `email`, `password`, `mobile`,--}}
                <div class="portlet-body form">
                    {{--<form class="form-horizontal" role="form">--}}
                    {!! Form::open(['method'=>'PUT','url'=>url(admin_manage_url().'/admin/'.$admin->id.'/edit'),'class'=>'form-horizontal','id'=>'edit-admin']) !!}
                    <div class="form-group">
                        <label for="inputEmail1" class="col-md-2 control-label">اسم المدير</label>
                        <div class="col-md-6">
                            <input type="text" class="form-control" name="name" id="name" placeholder="الاسم" value="{{$admin->name ?? ''}}">
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="mobile" class="col-md-2 control-label">رقم الهاتف</label>
                        <div class="col-md-6">
                            <input type="text" class="form-control" name="mobile" id="mobile" placeholder="رقم الهاتف" value="{{$admin->mobile ?? ''}}" maxlength="15">
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="email" class="col-md-2 control-label">البريد الالكتروني</label>
                        <div class="col-md-6">
                            <input type="email" class="form-control" name="email" id="email" placeholder="البريد الالكتروني" value="{{$admin->email ?? ''}}">
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="password" class="col-md-2 control-label">كلمة المرور</label>
                        <div class="col-md-6">
                            <input type="password" class="form-control" name="password" id="password" placeholder="كلمة المرور">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-md-2 control-label">الصلاحيات</label>
                        <div class="col-md-6">
                            <select class="form-control input-md select2" data-placeholder="اختيار الصلاحية..."
                                    name="role[]"
                                    multiple>

                                @foreach($roles as $item)
                                    <option value="{{$item->id}}" @if(in_array($item->id,$user_roles)) selected @endif>{{$item->display_name}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-md-8 text-center">
                            <button type="submit" class="btn purple"> تعديل<i class="fa fa-edit"></i></button>
                        </div>
                    </div>
                    {!! Form::close() !!}
                </div>
            </div>
            <!-- END SAMPLE FORM PORTLET-->
        </div>
    </div>
@endsection
@section('js')
    <script src="{{url('/')}}/assets/global/plugins/select2/js/select2.full.min.js" type="text/javascript"></script>
    <script src="{{url('/')}}/assets/global/scripts/app.min.js" type="text/javascript"></script>
    <script src="{{url('/')}}/assets/pages/scripts/components-select2.min.js" type="text/javascript"></script>
    <script src="{{url('/')}}/assets/js/admins.js" type="text/javascript"></script>

    <script>
        document.addEventListener("DOMContentLoaded", function() {
            var elements = document.getElementsByTagName("INPUT");
            for (var i = 0; i < elements.length; i++) {
                elements[i].oninvalid = function(e) {
                    e.target.setCustomValidity("");
                    if (!e.target.validity.valid) {
                        e.target.setCustomValidity("يجب ادخال البريد الالكتروني بشكل صحيح.");
                    }
                };
                elements[i].oninput = function(e) {
                    e.target.setCustomValidity("");
                };
            }
        })
    </script>

@stop