@extends(admin_layout_vw().'.index')

@section('css')
    <!-- BEGIN PAGE LEVEL PLUGINS -->
    <!-- END THEME GLOBAL STYLES -->
@endsection
@section('content')
    <div class="row">
        <div class="col-md-12">
            <!-- BEGIN EXAMPLE TABLE PORTLET-->
            <div class="card card-custom shadow">
                <div class="card-header">
                    <div class="card-title">
                        <i class="{{$icon}}"></i>
                        <span class="caption-subject bold uppercase"> {{trans(lang_app_site().'.CP.'.$main_title)}}</span>
                    </div>
                    <div class="card-toolbar">
                        <a href="{{url(admin_adv_tab_url().'/create')}}" class="btn btn-circle btn-primary add-ad-mdla ajax-modal">
                            <i class="fa fa-plus"></i>
                            <span class="hidden-xs"> {{trans(lang_app_site().'.CP.New Ad')}} </span>
                        </a>
                    </div>
                </div>
                <div class="card-body">

                    <table class="table table-striped table-bordered table-hover table-checkable order-column"
                           id="adv_tbl">
                        <thead>
                        <tr>
                            <th>#</th>
                            <th> {{trans(lang_app_site().'.CP.Ad Image')}}</th>
                            <th> {{trans(lang_app_site().'.CP.Ad URL')}}</th>
                            <th> {{trans(lang_app_site().'.CP.Status')}}</th>
                            <th> {{trans(lang_app_site().'.CP.Request by')}}</th>
                            <th> {{trans(lang_app_site().'.CP.Action')}}</th>
                        </tr>
                        </thead>
                    </table>
                </div>
            </div>
            <!-- END EXAMPLE TABLE PORTLET-->
        </div>
    </div>


@endsection

@section('js')
    <!-- BEGIN PAGE LEVEL PLUGINS -->
    <script src="{{url('/')}}/assets/global/scripts/datatable.js" type="text/javascript"></script>
    <script src="{{url('/')}}/assets/global/plugins/datatables/datatables.min.js" type="text/javascript"></script>
    <script src="{{url('/')}}/assets/global/plugins/datatables/plugins/bootstrap/datatables.bootstrap.js"
            type="text/javascript"></script>
    <!-- END PAGE LEVEL PLUGINS -->
    <!-- BEGIN THEME GLOBAL SCRIPTS -->
    <script src="{{url('/')}}/assets/global/scripts/app.min.js" type="text/javascript"></script>
    <!-- END THEME GLOBAL SCRIPTS -->
    <!-- BEGIN PAGE LEVEL SCRIPTS -->
    <script src="{{url('/')}}/assets/pages/scripts/table-datatables-managed.min.js" type="text/javascript"></script>
    <!-- END PAGE LEVEL SCRIPTS -->
    <script src="{{url('/')}}/assets/js/advs.js" type="text/javascript"></script>

@stop
