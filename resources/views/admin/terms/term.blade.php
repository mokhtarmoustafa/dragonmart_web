@extends(admin_layout_vw().'.index')

@section('content')

        <div class="row">
            <div class="col-md-12 ">
                <!-- BEGIN SAMPLE FORM PORTLET-->
                <div class="card card-custom shadow">
                    <div class="card-header">
                        <div class="card-title">
                            <i class="{{$icon}} font-dark sbold"></i> <span
                                class="caption-subject font-dark sbold uppercase">{{trans(lang_app_site().'.CP.'.$title)}}</span>
                        </div>
                    </div>
                    <div class="card-body form">
                        {!! Form::open(['method'=>'PUT','url'=>url(admin_terms_url().'/edit'),'class'=>'form-horizontal','id'=>'formAdd']) !!}
                        <div class="form-group">

                            <div class="col-md-12">
                                <label>{{trans(lang_app_site().'.CP.Title')}} (English)...</label>
                                <input type="text" class="form-control" name="title_en"
                                       id="title_en"
                                       placeholder="{{trans(lang_app_site().'.CP.Title')}} (English)..." value="{{$term->title_en}}">
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-md-12">
                                <label>{{trans(lang_app_site().'.CP.Title')}} (Arabic)...</label>
                                <input type="text" class="form-control" name="title_ar"
                                       id="title_ar"
                                       placeholder="{{trans(lang_app_site().'.CP.Title')}} (Arabic)..." value="{{$term->title_ar}}">
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-md-12">
                                <label>{{trans(lang_app_site().'.CP.Description')}} (English)...</label>
                                <textarea type="text" class="form-control ckeditor" name="desc_en"
                                          id="desc_en"
                                          placeholder="{{trans(lang_app_site().'.CP.Description')}} (English)...">{!! $term->desc_en !!}</textarea>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-md-12">
                                <label>{{trans(lang_app_site().'.CP.Description')}} (Arabic)...</label>

                                <textarea type="text" class="form-control ckeditor" name="desc_ar"
                                          id="desc_ar"
                                          placeholder="{{trans(lang_app_site().'.CP.Description')}} (Arabic)...">{!! $term->desc_ar !!}</textarea>
                            </div>

                        </div>

                        <div class="form-group">
                            <div class="col-md-12 text-center">
                                <button type="submit" class="btn btn-circle btn-success save"><i class="fa fa-check"></i> {{trans(lang_app_site().'.CP.Save')}}</button>
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
    {{--    <script src="{{url('/')}}/assets/global/plugins/select2/js/select2.full.min.js" type="text/javascript"></script>--}}
    <script src="{{url('/')}}/assets/global/plugins/ckeditor/ckeditor.js" type="text/javascript"></script>
    <script src="{{url('/')}}/assets/global/scripts/app.min.js" type="text/javascript"></script>
    {{--    <script src="{{url('/')}}/assets/pages/scripts/components-select2.min.js" type="text/javascript"></script>--}}
    <script src="{{url('/')}}/assets/js/setting.js" type="text/javascript"></script>
    <script>
        CKEDITOR.replace('desc_ar');
        CKEDITOR.replace('desc_en');
    </script>
@stop
