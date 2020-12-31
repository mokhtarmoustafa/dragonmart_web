@extends(merchant_layout_vw().'.index')


@section('content')

<div class="card card-custom">

  <div class="card-header">

    <div class="card-title">
      <h3 class="card-label">{{trans(lang_app_site().'.CP.'.$sub_title)}}
    </div>

    <div class="card-toolbar">
      <a href="{{url('merchant/category/private/create')}}" class="btn btn-circle btn-primary add-category-mdl" >
        <i class="fa fa-plus"></i>
        <span class="hidden-xs"> {{trans(lang_app_site().'.CP.New Store Category')}} </span>
      </a>
    </div>
  </div>
  <div class="card-body">
    <div class="table-container">
      <table class="table  table-hover table-checkable order-column" id="category_tbl">
          <thead>
          <tr>
              <th>#</th>
              <th> {{trans(lang_app_site().'.CP.Icon')}}</th>
              <th> {{trans(lang_app_site().'.CP.Name')}} (English)</th>
              <th> {{trans(lang_app_site().'.CP.Name')}} (Arabic)</th>
              <th> {{trans(lang_app_site().'.CP.Action')}}</th>
          </tr>
          </thead>
      </table>


    </div>

  </div>
</div>





@endsection

@section('js')
<script src="{{url('/')}}/assets/global/scripts/datatable.js" type="text/javascript"></script>
<script src="{{url('/')}}/assets/global/plugins/datatables/datatables.min.js" type="text/javascript"></script>
<script src="{{url('/')}}/assets/global/plugins/datatables/plugins/bootstrap/datatables.bootstrap.js"
        type="text/javascript"></script>


    <script src="{{url('/')}}/assets/pages/scripts/table-datatables-managed.min.js" type="text/javascript"></script>
    <!-- END PAGE LEVEL SCRIPTS -->
    <script src="{{url('/')}}/assets/js/categories.js" type="text/javascript"></script>

@stop
