<header>
    <div class="header layout1 no-prepend-box-sticky">
        <div class="topbar layout1">
            <div class="container">
                <ul class="menu-topbar">
                    <li class="language menu-item-has-children">

                        @if(session()->has('lang') && session()->get('lang') == 'ar')
                            <a href="{{url(site_url().'/lang/ar')}}" class="toggle-sub-menu"><span class="flag"><img
                                            src="{{url('/assets')}}/site/images/ar.png" alt=""></span>
                                {{trans(lang_app_site().'.home.arabic')}}</a>
                            <ul class="list-language sub-menu">
                                <li>
                                    <a href="{{url(site_url().'/lang/en')}}"><span class="flag"><img
                                                    src="{{url('/assets')}}/site/images/en.png" alt=""></span>
                                        English</a>
                                </li>


                            </ul>

                        @else
                            <a href="{{url(site_url().'/lang/en')}}" class="toggle-sub-menu"><span class="flag"><img
                                            src="{{url('/assets')}}/site/images/en.png" alt=""></span> English</a>
                            <ul class="list-language sub-menu">
                                <li><a href="{{url(site_url().'/lang/ar')}}"><span class="flag"><img
                                                    src="{{url('/assets')}}/site/images/ar.png" alt=""></span>
                                        {{trans(lang_app_site().'.home.arabic')}}</a></li>
                            </ul>
                        @endif
                    </li>
                </ul>
                <ul class="list-socials">
                    <li><a href="#"><i class="fa fa-facebook" aria-hidden="true"></i></a></li>
                    <li><a href="#"><i class="fa fa-twitter" aria-hidden="true"></i></a></li>
                    <li><a href="#"><i class="fa fa-instagram" aria-hidden="true"></i></a></li>
                </ul>
                <div class="menu-topbar top-links">
                    <div class="notifications-wrapper">
                        <i class="fa fa-bell-o"><span class="notf-number" style="display: none">2</span></i>
                        <div class="notifications-dropdown" style="display: none">>
                            <h4 class="title">YOU HAVE <span>2</span> UN READ NOTIFICATIONS</h4>
                            <ul class="ntf-ul">
                                <li><a href="#">Lorem Ipsum is simply dummy text</a></li>
                                <li><a href="#">Lorem Ipsum is simply dummy text of the printing Lorem Ipsum</a></li>
                                <li><a href="#">Lorem Ipsum is simply dummy text of</a></li>
                            </ul>
                        </div>
                    </div>
                </div>
                <ul class="menu-topbar top-links">
                    @if(!Auth::guard('web')->user())
                        <li><a href="{{url(site_url().'/login')}}">{{trans(lang_app_site().'.home.register')}}
                                / {{trans(lang_app_site().'.home.login')}}</a></li>
                    @else
                        <li><a href="{{url(site_url().'/myaccount')}}">{{ Auth::guard('web')->user()->username }} </a> /
                            <a href="javascript:void(0)"
                               onclick="logout()"> {{trans(lang_app_site().'.home.logout')}}</a></li>
                    @endif
                </ul>
            </div>
        </div>
        <div class="main-header">
            <div class="top-header">
                <div class="container">
                    <div class="row">
                        <div class="col-lg-2 col-md-2 col-sm-12 col-xs-12  left-content">
                            <div class="logo" style="margin-top: -20px;">
                                <a href="{{url(site_url().'/home')}}"><img
                                            src="{{url('/assets')}}/site/images/logo.svg" alt=""></a>
                            </div>
                        </div>
                        <div class="col-lg-6 col-md-5 col-sm-6 col-xs-12 midle-content">
                            <div class="search-form layout1 box-has-content">
                                <div class="search-block">
                                    <div class="search-inner">

                                        <input type="text" class="search-info"
                                               placeholder="{{trans(lang_app_site().'.home.search')}}" id="textsearch"
                                               value="{{(request()->segment(2) == 'search') ? request()->segment(3): ''}}">

                                    </div>
                                    <div class="search-choice parent-content">
                                        <select data-placeholder="{{trans(lang_app_site().'.home.all_categories')}}"
                                                class="chosen-select" id="catSelect">
                                            <option value="all">{{trans(lang_app_site().'.home.all_categories')}}</option>


                                            @php
                                                $cats =Categories()->where("store_id" , null);
                                            @endphp

                                            @foreach($cats as $cat)
                                                <option value="{{$cat->id}}">{{$cat->name}}</option>

                                            @endforeach

                                        </select>
                                    </div>
                                    <a href="#" class="btn">
                                        <i class="fa fa-search" aria-hidden="true"></i>
                                    </a>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-4 col-md-5 col-sm-6 col-xs-12 right-content">
                            <ul class="header-control">
                                <li class="hotline">
                                    <div class="icon">
                                        <i class="fa fa-phone white" aria-hidden="true"></i>
                                    </div>
                                    <div class="content">
                                        <span class="text white">{{trans(lang_app_site().'.home.callus')}}</span>
                                        <span class="number white">{{$settings[0]->value}}</span>
                                    </div>
                                </li>

                                @include(site_sub_view_vw().'.cartheader')

                            </ul>
                        </div>
                    </div>
                </div>
            </div>
            <div class="header-nav-wapper ">
                <div class="container main-menu-wapper">
                    <div class="row">
                        <div class="col-lg-3 col-md-4 col-sm-12">
                            <div class="vertical-wapper parent-content">
                                <div class="block-title show-content">
											<span class="icon-bar">
												<span></span>
												<span></span>
												<span></span>
											</span>
                                    <span class="text">{{trans(lang_app_site().'.home.categories')}}</span>
                                </div>
                                <div class="vertical-content hidden-content {{$always_open ?? ''}}">
                                    <ul class="vertical-menu ovic-clone-mobile-menu">

                                        @php
                                            $cats =Categories();
                                            $cats = $cats->where("store_id" , null);
                                            $n = 1;
                                        @endphp
                                        @foreach($cats as $cat)
                                            <li><a href="{{url(site_url().'/category')}}/{{$cat->id}}"
                                                   class="ovic-menu-item-title" title="Cameras"><span class="icon"><img
                                                                src=" {{ $cat->icon != '' ? $cat->icon32 : url('/assets').'/site/images/icon1.png'}}"
                                                                style="padding:6px;"
                                                                alt=""></span> {{$cat->name}}</a></li>
                                        
                                        
                                            @if($n == 7)
                                             @php break;@endphp
                                            @endif
                                            @php $n++ @endphp
                                        @endforeach


                                    </ul>
                                    <div class="view-all-categori">
                                        <a href="javascript:void(0)" class="button"
                                           id="clickcat">{{trans(lang_app_site().'.home.all_cats')}}
                                            @if(session()->has('lang') && session()->get('lang') == 'en')
                                                <i class="fa fa-angle-double-right"
                                                    aria-hidden="true"></i></a>
                                        @else
                                            <i class="fa fa-angle-double-left"
                                                    aria-hidden="true"></i>
                                        @endif
                                    </div>
                                    <script type="text/javascript">
                                        document.getElementById("clickcat").onclick = function () {
                                            location.href = "{{url(site_url()).'/categories'}}";
                                        };
                                    </script>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-9 col-md-8 col-sm-12">
                            <div class="header-nav container-vertical-wapper ">
                                <div class="header-nav-inner">
                                    <div class="box-header-nav">
                                        <div class=" container-wapper">
                                            <a href="#" class="header-top-menu-mobile"><span class="fa fa-cog"
                                                                                             aria-hidden="true"></span></a>
                                            <a class="menu-bar mobile-navigation " href="#">
														<span class="icon">
															<span></span>
															<span></span>
															<span></span>
														</span>
                                                <span class="text">Main Menu</span>
                                            </a>
                                            <ul id="menu-main-menu"
                                                class="main-menu clone-main-menu ovic-clone-mobile-menu box-has-content">
                                                <li class="menu-item">
                                                    <a href="{{url(site_url().'/home')}}"
                                                       class="kt-item-title ovic-menu-item-title"
                                                       title="Home">{{trans(lang_app_site().'.home.home')}}</a>
                                                </li>
                                                <li class="menu-item"><a
                                                            href="{{url(site_url().'/merchants')}}">{{trans(lang_app_site().'.home.merchants')}}</a>
                                                </li>
                                                <li class="menu-item"><a
                                                            href="{{url(site_url().'/services')}}">{{trans(lang_app_site().'.home.services')}}</a>
                                                </li>
                                                <li class="menu-item"><a
                                                            href="{{url(site_url().'/about')}}">{{trans(lang_app_site().'.home.about_us')}}</a>
                                                </li>
                                                <li class="menu-item"><a
                                                            href="{{url(site_url().'/contact')}}">{{trans(lang_app_site().'.home.contact_us')}}</a>
                                                </li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</header>



@section('javascript')
    <script>


    </script>
@endsection
