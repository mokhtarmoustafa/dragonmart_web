@extends(admin_layout_vw().'.index')

@section('css')
    <!-- BEGIN THEME GLOBAL STYLES -->
    <link href="{{url('/')}}/assets/global/css/components-md.min.css" rel="stylesheet" id="style_components"
          type="text/css"/>
    <link href="{{url('/')}}/assets/global/css/plugins-md.min.css" rel="stylesheet" type="text/css"/>
    <!-- END THEME GLOBAL STYLES -->

@endsection
@section('content')
    <div class="row">
        <div class="col-md-12 ">
            <!-- BEGIN SAMPLE FORM PORTLET-->
            <h3 class="text-center"> {{trans(lang_app_site().'.CP.Add permissions to role')}} <span class="label label-lg label-success">
            {{trans(lang_app_site().'.CP.'.$role->display_name)}}</span></h3>

            <input type="hidden" name="role_id" id="role_id" value="{{$role->id}}">
            <div style="overflow: auto;">
                <div class="col-md-12">
                    <div class="panel panel-info">
                        <div class="panel-heading">
                            <h3 class="panel-title">
                                <input name="allPermission"
                                       type="checkbox"
                                       class="allcheck parent_chk all_parent_public">
                                <label>
                                {{trans(lang_app_site().'.CP.General Permissions')}}
                                </label>
                            </h3>


                        </div>
                        <div class="panel-body">

                            @foreach($perms as $p)
                                @if(!isset($p->parent_id))
                                    <div class="col-md-3" data-id="{{$p->id}}">
                                        <input name="perms"
                                               type="checkbox"
                                               class="allcheck child_public_chk child_chk child_chk{{$p->id}}"
                                               {{--child_chk--}}
                                               value="{{$p->id}}">
                                        <label>
                                        {{trans(lang_app_site().'.CP.'.$p->display_name)}}
                                        </label>
                                    </div>
                                @endif
                            @endforeach
                        </div>
                    </div>
                </div>

                @foreach($perms as $perm)

                    @if(!isset($perm->parent_id) && count($perm->children) > 0)
                        <div class="col-md-12">
                            <div class="panel panel-info">
                                <div class="panel-heading">
                                    <h3 class="panel-title">
                                        <input name="allPermission"
                                               type="checkbox"
                                               class="allcheck parent_chk parent_chk_p{{$perm->id}}">
                                        <label>
                                        {{trans(lang_app_site().'.CP.'.$perm->display_name)}}
                                        </label>
                                    </h3>


                                </div>
                                <div class="panel-body">

                                    @foreach($perms as $p)
                                        @if($perm->id == $p->parent_id)

                                            <div class="col-md-3" data-id="{{$p->id}}">
                                                <input name="perms"
                                                       type="checkbox"
                                                       class="allcheck child_chk"
                                                       value="{{$p->id}}">
                                                <label>
                                                {{trans(lang_app_site().'.CP.'.$p->display_name)}}
                                                </label>
                                            </div>
                                        @endif
                                    @endforeach
                                </div>
                            </div>
                        </div>
                    @endif
                @endforeach
            </div>
            <div class="form-group">
                <button class="btn btn-primary col-xs-12" id="add-role-permissions"> <i class="fa fa-check"></i> {{trans(lang_app_site().'.CP.Save permissions')}}</button>
            </div>
            <!-- END SAMPLE FORM PORTLET-->
        </div>
    </div>
@endsection

@section('js')
    <script src="{{url('/')}}/assets/global/scripts/app.min.js" type="text/javascript"></script>
    <script src="{{url('/')}}/assets/js/permission.js" type="text/javascript"></script>
@stop
