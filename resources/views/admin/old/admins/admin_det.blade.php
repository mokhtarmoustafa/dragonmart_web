@section('css')

    <link href="{{url('/')}}/assets/global/plugins/bootstrap-fileinput/bootstrap-fileinput.css" rel="stylesheet"
          type="text/css"/>

    <link href="{{url('/')}}/assets/global/plugins/select2/css/select2.min.css" rel="stylesheet" type="text/css"/>
    <link href="{{url('/')}}/assets/global/plugins/select2/css/select2-bootstrap.min.css" rel="stylesheet"
          type="text/css"/>
    <!-- END PAGE LEVEL PLUGINS -->

    <link href="{{url('/')}}/assets/global/css/components-md.min.css" rel="stylesheet" id="style_components"
          type="text/css"/>
    <link href="{{url('/')}}/assets/global/css/plugins-md.min.css" rel="stylesheet" type="text/css"/>
    <!-- END THEME GLOBAL STYLES -->
@endsection
<div class="modal fade bs-modal-lg" id="admin_det" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
                <h4 class="modal-title"><i class="fa fa-users"></i> Admin details <span
                            class="badge badge-primary name "
                            style="text-transform: inherit"></span></h4>
            </div>
            <div class="modal-body">
                <div class="portlet-body form">

                    {!! Form::open(['method'=>'POST','url'=>url('/'),'class'=>'form-horizontal form-bordered form-row-stripped']) !!}

                    <div class="form-body">

                        <div class="form-group">
                            <div class="control-label col-md-2">
                                <label for="">Logo</label>
                            </div>
                            <div class="col-md-4">
                                <img src="{{$admin->logo ?? url('assets/apps/img/man.svg')}}" width="150px">
                            </div>
                            <label class="col-md-2 control-label">Roles</label>
                            <div class="col-md-4">
                                <div class="input-icon">
                                    <select class="form-control input-sm select2-multiple role_id"
                                            name="role_id[]"
                                            multiple data-placeholder="Choose Role ..."
                                            id="role_id"
                                            style="padding: 0;" disabled>
                                        <option></option>

                                        @foreach($roles as $item)
                                            <option value="{{$item->id}}"
                                                    @if(in_array($item->id,$admin_roles)) selected @endif>{{ucfirst($item->display_name)}}</option>
                                        @endforeach

                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="control-label col-md-2">
                                <label for="">Name</label>
                            </div>
                            <div class="col-md-4">
                                <input type="text" name="name" id="name" class="form-control"
                                       value="{{$admin->name}}" disabled>
                            </div>
                            <div class="control-label col-md-2">
                                <label for="">Username</label>
                            </div>
                            <div class="col-md-4">
                                <input type="text" name="username" id="username" class="form-control"
                                       value="{{$admin->username}}" disabled>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="control-label col-md-2">
                                <label for="">Email</label>
                            </div>
                            <div class="control-label col-md-4">
                                <input type="email" name="email" id="email" class="form-control"
                                       value="{{$admin->email}}" disabled>
                            </div>

                            <div class="control-label col-md-2">
                                <label for="">Mobile</label>
                            </div>
                            <div class="col-md-4">
                                <input type="text" name="mobile" id="mobile" class="form-control"
                                       value="{{$admin->mobile}}" disabled>
                            </div>

                        </div>


                    </div>

                    <div class="form-body">

                        <div class="form-actions">
                            <div class="row">
                                <div class="col-md-12 text-center">
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
@section('js')


    <script src="{{url('/')}}/assets/global/plugins/select2/js/select2.full.min.js" type="text/javascript"></script>

    <script src="{{url('/')}}/assets/global/plugins/bootstrap-fileinput/bootstrap-fileinput.js"
            type="text/javascript"></script>
    <!-- BEGIN THEME GLOBAL SCRIPTS -->
    <script src="{{url('/')}}/assets/global/scripts/app.min.js" type="text/javascript"></script>
    <!-- END THEME GLOBAL SCRIPTS -->
    <script src="{{url('/')}}/assets/pages/scripts/components-select2.min.js" type="text/javascript"></script>

    <!-- BEGIN PAGE LEVEL SCRIPTS -->
    <script src="{{url('/')}}/assets/js/admins.js" type="text/javascript"></script>
    {{--    <script>--}}
    {{--        $('.select2').select2();--}}
    {{--    </script>--}}
    <!-- END PAGE LEVEL SCRIPTS -->
@stop