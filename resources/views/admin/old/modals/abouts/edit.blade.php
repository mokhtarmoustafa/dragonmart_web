<div class="modal fade" id="edit-about" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle">
    <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
        <div class="modal-content">
            {!! Form::open(['method'=>'PUT','url'=>url(admin_abouts_url() . '/'.$about->id.'/edit'),'files'=>true]) !!}
            <input type="hidden" name="type" value="about_us">

            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLongTitle">Edit Section</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <div class="modal-body scroll">
                <div class="form-group m-form__group input-group">
                    <div class="input-group">
                        <div class="input-group-prepend">
                            <span class="input-group-text" id="inputGroupFileAddon01">Upload</span>
                        </div>
                        <div class="custom-file">
                            <input type="file" name="media" class="custom-file-input" id="inputGroupFile01"
                                   aria-describedby="inputGroupFileAddon01" value="filename.path">
                            <label class="custom-file-label" for="inputGroupFile01">filename.path</label>
                        </div>
                    </div>
                </div>
                <div class="form-group m-form__group input-group">
                    <input type="text" class="form-control m-input" placeholder="Title EN"
                           value="{{$about->title_en}}" name="title_en">
                </div>
                <div class="form-group m-form__group input-group">
                    <input type="text" class="form-control m-input" placeholder="Title AR"
                           value="{{$about->title_ar}}" name="title_ar">
                </div>
                <div class="form-group m-form__group input-group">
                    <div class="summernote en" id="m_summernote_1">{!! $about->content_en !!}</div>
                </div>
                <div class="form-group m-form__group input-group">
                    <div class="summernote ar" id="m_summernote_2">{!! $about->content_ar !!}</div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                <button type="submit" class="btn btn-primary">Save</button>
            </div>
            {!! Form::close() !!}
        </div>
    </div>
</div>



{{--<script src="{{url('/')}}/assets/admin/demo/default/custom/crud/forms/widgets/bootstrap-select.js"--}}
{{--        type="text/javascript"></script>--}}
{{--<script src="{{url('/')}}/assets/admin/demo/default/custom/crud/forms/widgets/bootstrap-datepicker.js"--}}
{{--        type="text/javascript"></script>--}}
{{--<script src="{{url('/')}}/assets/admin/demo/default/custom/crud/forms/widgets/bootstrap-datetimepicker.js"--}}
{{--        type="text/javascript"></script>--}}
{{--<script src="{{url('/')}}/assets/admin/demo/default/custom/crud/forms/widgets/summernote.js"--}}
{{--        type="text/javascript"></script>--}}
