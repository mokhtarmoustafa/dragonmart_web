
<div class="page-bar">
    <ul class="page-breadcrumb">
        <li>
            <i class="{{$icon ?? 'fa fa-circle'}}"></i>
            <a href="{{$back_url ?? ''}}">{{trans(lang_app_site().'.CP.'.($main_title ?? 'home')   )}} </a>
            @if(isset($sub_title))
                <i class="fa fa-angle-right"></i>
            @endif

        </li>
        @if(isset($sub_title))
            <li>
                <span>{!! trans(lang_app_site().'.CP.'.$sub_title) !!}  </span>
            </li>
        @endif
    </ul>
</div>