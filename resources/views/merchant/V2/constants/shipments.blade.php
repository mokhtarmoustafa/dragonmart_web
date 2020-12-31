@extends(merchant_layout_vw().'.index')

@section('css')
@endsection
@section('content')

<input type="hidden" name="constant" id="constant" value="{{$constant_name}}">
<input type="hidden" name="url_action" id="url_action" value="{{$url_action}}">
<div class="card card-custom">

  <div class="card-header">

    <div class="card-title">
      <h3 class="card-label">{{trans(lang_app_site().'.CP.'.$sub_title)}}
      </div>

      <div class="card-toolbar">
        <a href="{{url(merchant_url().'/shipment/create')}}"
           class="btn btn-circle btn-primary add-shipment-mdl">
            <i class="fa fa-plus"></i>
            <span class="hidden-xs"> {{trans(lang_app_site().'.CP.Add Shipping Rate')}} </span>
        </a>
      </div>
    </div>
    <div class="card-body">

      <table class="table datatable datatable-bordered datatable-head-custom kt_datatable"
             id="shipment_tbl">
          <thead>
          <tr>
              <th>#</th>
              <th> {{trans(lang_app_site().'.CP.From')}} - {{trans(lang_app_site().'.CP.To')}} (km)</th>
              <th> {{trans(lang_app_site().'.CP.Price')}} (SAR)</th>
              <th> {{trans(lang_app_site().'.CP.Min order amount')}}</th>
              <th> {{trans(lang_app_site().'.CP.Action')}}</th>
          </tr>
          </thead>
      </table>

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
    <script src="{{url('/')}}/assets/js/shipments.js" type="text/javascript"></script>

@stop
