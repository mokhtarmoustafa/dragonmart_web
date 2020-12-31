@extends(merchant_layout_vw().'.index')

@section('css')
    <link href="{{url('/')}}/assets/global/plugins/datatables/datatables.min.css" rel="stylesheet" type="text/css"/>
    <link href="{{url('/')}}/assets/global/plugins/datatables/plugins/bootstrap/datatables.bootstrap.css"
          rel="stylesheet" type="text/css"/>

@endsection
@section('content')

    <div class="component">
        @include('merchant.partial.add-product')
    </div>
    <div class="row store_products" @if(!$currentUser->has_store) style="display: none" @endif>
        <div class="col-md-12">
            <div class="portlet box green">
                <div class="portlet-title">
                    <div class="caption">
                        <i class="{{$icon}} font-weight-light"></i>
                        <span class="caption-subject bold uppercase"> My Products </span>
                    </div>

                </div>
                <div class="portlet-body form">
                    <div class="form-body">
                        <!-- BEGIN EXAMPLE TABLE PORTLET-->
                        <div class="portlet light">
                            <div class="portlet-title">
                                <div class="caption font-weight-light">
                                    <i class="fa fa-search font-dark"></i>
                                    <span class="caption-subject bold uppercase"> Filter </span>
                                </div>

                            </div>
                            <div class="portlet-body">
                                <div class="table-container">
                                    {{--                        {!! Form::open(['method'=>'POST','url'=>url(admin_vw().'/user/export')]) !!}--}}
                                    <form method="POST" action="#">
                                        <table class="table table-striped table-bordered table-hover table-checkable"
                                               id="datatable_products">
                                            <thead>
                                            <tr role="row" class="heading">
                                                <th width="1%">
                                                </th>

                                                <th width="10%"> Name</th>
                                                <th width="10%"> Offer</th>
                                                <th width="10%"> Sponsor</th>
                                                <th width="10%"> Action</th>
                                            </tr>
                                            <tr role="row" class="filter">
                                                <td></td>
                                                <td>
                                                    <input type="text" class="form-control form-filter input-md"
                                                           name="name"
                                                           placeholder=" Name" id="product_name">
                                                </td>

                                                <td>
                                                    <select class="form-control input-md is_offer" name="is_offer"
                                                            id="is_offer"
                                                            data-placeholder="Choose Offer Status">
                                                        <option value="">Choose Offer Status</option>
                                                        <option value="0">No</option>
                                                        <option value="1">Yes</option>
                                                    </select>
                                                </td>
                                                <td>
                                                    <select class="form-control input-md is_sponsor" name="is_sponsor"
                                                            id="is_sponsor"
                                                            data-placeholder="Choose Sponsor Status">
                                                        <option value="">Choose Sponsor Status</option>
                                                        <option value="0">No</option>
                                                        <option value="1">Yes</option>
                                                    </select>
                                                </td>
                                                <td>
                                                    <div class="margin-bottom-5">
                                                        <a href="javascript:;"
                                                           class="btn btn-sm btn-success filter-submit-product btn-circle btn-icon-only margin-bottom"
                                                           title="filter">
                                                            <i class="fa fa-search"></i>
                                                        </a>

                                                        <a href="javascript:;"
                                                           class="btn btn-sm btn-danger btn-circle btn-icon-only filter-cancel-product"
                                                           title="Empty fields">
                                                            <i class="fa fa-rotate-left"></i>
                                                        </a>
                                                    </div>

                                                </td>
                                            </tr>
                                            </thead>
                                            <tbody></tbody>
                                        </table>
                                        {{--{!! Form::close() !!}--}}
                                    </form>
                                </div>
                            </div>
                        </div>
                        <div class="portlet light ">
                            <div class="portlet-title">
                                <div class="caption font-dark">
                                    <i class="{{$icon}} font-dark"></i>
                                    <span class="caption-subject bold uppercase"> Products</span>
                                </div>
                                <div class="actions">
                                    <a href="{{url(merchant_store_url().'/product/create')}}"
                                       class="btn btn-circle btn-success add-product-mdl2">
                                        <i class="fa fa-plus"></i>
                                        <span class="hidden-xs"> Add New </span>
                                    </a>
                                </div>
                            </div>

                            <div class="portlet-body">

                                <table class="table table-striped table-bordered table-hover table-checkable"
                                       id="products_tbl">
                                    <thead>
                                    <tr>
                                        <th>#</th>
                                        <th> Name</th>
                                        <th> Price</th>
                                        <th> Quantity</th>
                                        <th> Category</th>
                                        <th> IsOffer</th>
                                        <th> IsSponser</th>
                                        <th> Description</th>
                                        <th> Action</th>
                                    </tr>
                                    </thead>
                                </table>
                            </div>
                        </div>
                        <!-- END EXAMPLE TABLE PORTLET-->
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade bs-modal-lg" id="editProduct" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-lg" style="width: 1200px !important;">
            <div class="modal-content">
                <div class="modal-body" id="edit_product">

                </div>

            </div>
            <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
    </div>

    <div class="modal fade bs-modal-lg" id="imagesProduct" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-lg" style="width: 1200px !important;">
            <div class="modal-content">
                <div class="modal-body" id="images-product">

                </div>

            </div>
            <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
    </div>
@endsection
@section('js')

    <script src="{{url('/')}}/assets/global/scripts/datatable.js" type="text/javascript"></script>
    <script src="{{url('/')}}/assets/global/plugins/datatables/datatables.min.js" type="text/javascript"></script>
    <script src="{{url('/')}}/assets/global/plugins/datatables/plugins/bootstrap/datatables.bootstrap.js"
            type="text/javascript"></script>

    <script src="{{url('/')}}/assets/global/scripts/app.min.js" type="text/javascript"></script>

    {{--    <script src="{{url('/')}}/assets/global/plugins/ckeditor/ckeditor.js"></script>--}}
    <script src="{{url('/')}}/assets/js/products.js" type="text/javascript"></script>

    <!-- BEGIN PAGE LEVEL SCRIPTS -->

@stop