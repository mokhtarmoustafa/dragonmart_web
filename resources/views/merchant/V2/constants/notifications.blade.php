@extends(merchant_layout_vw().'.index')

@section('content')

<div class="card card-custom">

  <div class="card-header">

    <div class="card-title">
      <h3 class="card-label">{{trans(lang_app_site().'.CP.'.$main_title)}}
    </div>

  </div>
  <div class="card-body">
    <div class="table-container">
      <table class="table  table-hover table-checkable order-column"
             id="notification_tbl">
          <thead>
          <tr>
              <th>#</th>
              <th>{{trans(lang_app_site().'.CP.Sender')}} </th>
              <th> {{trans(lang_app_site().'.CP.Notification')}}</th>
              <th> {{trans(lang_app_site().'.CP.Date')}}</th>
              <th> {{trans(lang_app_site().'.CP.Action')}}</th>
          </tr>
          </thead>
      </table>

    </div>

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
    <script src="{{url('/')}}/assets/js/notifications.js" type="text/javascript"></script>

@stop
