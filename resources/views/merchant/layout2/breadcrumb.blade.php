<div class="page-bar">
    <ul class="page-breadcrumb">
        <li>
            <i class="{{$icon ?? 'fa fa-circle'}}"></i>
            <a href="{{$back_url ?? ''}}">{{$main_title ?? 'home'}}</a>
        @if(isset($sub_title))
                <i class="fa fa-circle"></i>
            @endif
        </li>
        @if(isset($sub_title))

            <li>
                <span>{!! $sub_title !!}</span>
            </li>
        @endif
    </ul>
</div>
