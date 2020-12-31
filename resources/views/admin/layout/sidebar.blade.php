<div class="page-sidebar-wrapper">
    <!-- BEGIN SIDEBAR -->
    <!-- DOC: Set data-auto-scroll="false" to disable the sidebar from auto scrolling/focusing -->
    <!-- DOC: Change data-auto-speed="200" to adjust the sub menu slide up/down speed -->
    <div class="page-sidebar navbar-collapse collapse">
        <!-- BEGIN SIDEBAR MENU -->
        <!-- DOC: Apply "page-sidebar-menu-light" class right after "page-sidebar-menu" to enable light sidebar menu style(without borders) -->
        <!-- DOC: Apply "page-sidebar-menu-hover-submenu" class right after "page-sidebar-menu" to enable hoverable(hover vs accordion) sub menu mode -->
        <!-- DOC: Apply "page-sidebar-menu-closed" class right after "page-sidebar-menu" to collapse("page-sidebar-closed" class must be applied to the body element) the sidebar sub menu mode -->
        <!-- DOC: Set data-auto-scroll="false" to disable the sidebar from auto scrolling/focusing -->
        <!-- DOC: Set data-keep-expand="true" to keep the submenues expanded -->
        <!-- DOC: Set data-auto-speed="200" to adjust the sub menu slide up/down speed -->
        <ul class="page-sidebar-menu  page-header-fixed page-sidebar-menu-hover-submenu  " data-keep-expanded="false"
            data-auto-scroll="true"
            data-slide-speed="200">
            <!-- DOC: To remove the sidebar toggler from the sidebar you just need to completely remove the below "sidebar-toggler-wrapper" LI element -->
            <!-- BEGIN SIDEBAR TOGGLER BUTTON -->
            <li class="sidebar-toggler-wrapper hide">
                <div class="sidebar-toggler">
                    <span></span>
                </div>
            </li>
            <!-- END SIDEBAR TOGGLER BUTTON -->
            <!-- DOC: To remove the search box from the sidebar you just need to completely remove the below "sidebar-search-wrapper" LI element -->
            <li class="nav-item @if(preg_match('/home/i',url()->current())) start active open @endif">
                <a href="{{url('admin/home')}}" class="nav-link nav-toggle">
                    <i class="icon-home"></i>
                    <span class="title">{{trans(lang_app_site().'.CP.Dashboard')}}</span>
                    <span class="selected"></span>
                </a>
            </li>

            @if(isset($permissions_sidebar))
                @foreach($permissions_sidebar as $per)
                    <li class="@if(preg_match('/'.$per->alias.'/i',url()->current())) start active open @endif">
                        <a @if(!isset($per->children) || count($per->children) == 0 /*|| count($per->children) == 1*/)href="{{url(admin_vw().'/'.$per->alias.'/'.$per->name)}}"
                           @else href="javascript:;" @endif>
                            <i class="{{$per->icon}}"></i>
                            <span class="title">{{trans(lang_app_site().'.CP.'.$per->display_name)}}</span>
                            @if(isset($per->children) && count($per->children) > 0)
                                <span class="arrow"></span>
                            @endif
                            <span class="selected"></span>

                        </a>
                        @if(isset($per->children) && count($per->children) >= 1)

                            <ul class="sub-menu">
                                @foreach($per->children as $child)
                                    {{--class="@if(preg_match('/'.$child->alias.'/i',url()->current())) start active open @endif"--}}
                                    <li>
                                        <a href="{{url(admin_vw().'/'.$child->alias.'/'.$child->name)}}">
                                            <i class="{{$child->icon}}"></i>
                                           {{trans(lang_app_site().'.CP.'.$child->display_name)}}
                                        </a>
                                    </li>
                                @endforeach
                            </ul>

                        @endif
                    </li>
                @endforeach
            @endif


            {{--            <li class="nav-item @if(preg_match('/merchants-list/i',url()->current())) start active open @endif">--}}
            {{--                <a href="{{url(admin_vw().'/merchants-list')}}" class="nav-link ">--}}
            {{--                    <i class="icon-users"></i>--}}
            {{--                    <span class="title">Merchants</span>--}}
            {{--                    <span class="selected"></span>--}}
            {{--                </a>--}}
            {{--            </li>--}}
            {{--            <li class="nav-item @if(preg_match('/users-list/i',url()->current())) start active open @endif">--}}
            {{--                <a href="{{url(admin_vw().'/users-list')}}" class="nav-link nav-toggle">--}}
            {{--                    <i class="glyphicon glyphicon-phone"></i>--}}
            {{--                    <span class="title">Users</span>--}}
            {{--                    <span class="selected"></span>--}}
            {{--                </a>--}}
            {{--            </li>--}}

            {{--            <li class="nav-item @if(preg_match('/role/i',url()->current())) start active open @endif">--}}
            {{--                <a href="{{url(admin_vw().'/role/roles')}}" class="nav-link nav-toggle">--}}
            {{--                    <i class="fa fa-user-secret"></i>--}}
            {{--                    <span class="title">Roles</span>--}}
            {{--                    <span class="selected"></span>--}}
            {{--                </a>--}}
            {{--            </li>--}}
            {{--            <li class="nav-item @if(preg_match('/admins-list|users-list|user/i',url()->current())) start active open @endif">--}}
            {{--                <a href="javascript:;" class="nav-link nav-toggle">--}}
            {{--                    <i class="fa fa-users"></i>--}}
            {{--                    <span class="title">Users</span>--}}
            {{--                    <span class="selected"></span>--}}
            {{--                    <span class="arrow"></span>--}}

            {{--                </a>--}}
            {{--                <ul class="sub-menu ">--}}
            {{--                    <li class="nav-item">--}}
            {{--                        <a href="{{url(admin_vw().'/admins-list')}}" class="nav-link ">--}}
            {{--                            --}}{{--<i class="icon-bar-chart"></i>--}}
            {{--                            <span class="title">Admins</span>--}}
            {{--                        </a>--}}
            {{--                    </li>--}}
            {{--                    <li class="nav-item">--}}
            {{--                        <a href="{{url(admin_vw().'/users-list')}}" class="nav-link ">--}}
            {{--                            --}}{{--<i class="icon-bulb"></i>--}}
            {{--                            <span class="title">App users</span>--}}
            {{--                        </a>--}}
            {{--                    </li>--}}

            {{--                </ul>--}}

            {{--            </li>--}}

            {{--            <li class="nav-item @if(preg_match('/revenue|order/i',url()->current())) start active open @endif">--}}
            {{--                <a href="javascript:;" class="nav-link nav-toggle">--}}
            {{--                    <i class="icon-bar-chart"></i>--}}
            {{--                    <span class="title">Reports</span>--}}
            {{--                    <span class="selected"></span>--}}
            {{--                    <span class="arrow"></span>--}}

            {{--                </a>--}}
            {{--                <ul class="sub-menu ">--}}
            {{--                    <li class="nav-item">--}}
            {{--                        <a href="{{url(admin_vw().'/revenues-list')}}" class="nav-link ">--}}
            {{--                            --}}{{--<i class="icon-bar-chart"></i>--}}
            {{--                            <span class="title">Revenues</span>--}}
            {{--                        </a>--}}
            {{--                    </li>--}}
            {{--                    <li class="nav-item">--}}
            {{--                        <a href="{{url(admin_vw().'/expenses')}}" class="nav-link ">--}}
            {{--                            --}}{{--<i class="icon-bulb"></i>--}}
            {{--                            <span class="title">Expenses</span>--}}
            {{--                        </a>--}}
            {{--                    </li><li class="nav-item">--}}
            {{--                        <a href="{{url(admin_vw().'/orders-list')}}" class="nav-link ">--}}
            {{--                            --}}{{--<i class="icon-bulb"></i>--}}
            {{--                            <span class="title">Orders</span>--}}
            {{--                        </a>--}}
            {{--                    </li>--}}

            {{--                </ul>--}}

            {{--            </li>--}}
            {{--<li class="nav-item @if(preg_match('/stores/i',url()->current())) start active open @endif">--}}
            {{--<a href="{{url(admin_vw().'/stores')}}" class="nav-link nav-toggle">--}}
            {{--<i class="fa fa-database"></i>--}}
            {{--<span class="title">Stores</span>--}}
            {{--<span class="selected"></span>--}}
            {{--</a>--}}
            {{--</li>--}}
            {{--            <li class="nav-item @if(preg_match('/constant/i',url()->current())) start active open @endif">--}}
            {{--                <a href="javascript:;" class="nav-link nav-toggle">--}}
            {{--                    <i class="icon-settings"></i>--}}
            {{--                    <span class="title">Settings</span>--}}
            {{--                    <span class="selected"></span>--}}
            {{--                    <span class="arrow"></span>--}}

            {{--                </a>--}}
            {{--                <ul class="sub-menu ">--}}
            {{--                    <li class="nav-item @if(preg_match('/categories/i',url()->current())) start active open @endif">--}}
            {{--                        <a href="{{url(admin_constant_url().'/categories')}}" class="nav-link ">--}}
            {{--                            --}}{{--<i class="icon-bar-chart"></i>--}}
            {{--                            <span class="title">Categories</span>--}}
            {{--                        </a>--}}
            {{--                    </li>--}}
            {{--                    <li class="nav-item @if(preg_match('/customizations/i',url()->current())) start active open @endif ">--}}
            {{--                        <a href="{{url(admin_constant_url().'/customizations')}}" class="nav-link ">--}}
            {{--                            --}}{{--<i class="icon-bulb"></i>--}}
            {{--                            <span class="title">Customizations</span>--}}
            {{--                        </a>--}}
            {{--                    </li>--}}
            {{--                    <li class="nav-item @if(preg_match('/shipment/i',url()->current())) start active open @endif ">--}}
            {{--                        <a href="{{url(admin_constant_url().'/shipments')}}" class="nav-link ">--}}
            {{--                            --}}{{--<i class="icon-bulb"></i>--}}
            {{--                            <span class="title">Shipping rate</span>--}}
            {{--                        </a>--}}
            {{--                    </li>--}}


            {{--                </ul>--}}

            {{--            </li>--}}

            {{--            <li class="nav-item @if(preg_match('/sponsor-requests/i',url()->current())) start active open @endif">--}}
            {{--                <a href="{{url('admin/sponsor-requests')}}" class="nav-link nav-toggle">--}}
            {{--                    <i class="fa fa-certificate"></i>--}}
            {{--                    <span class="title">Sponsor requests</span>--}}
            {{--                    <span class="selected"></span>--}}
            {{--                </a>--}}
            {{--            </li>--}}
{{--            <li class="nav-item @if(preg_match('/notifications/i',url()->current())) start active open @endif">--}}
{{--                <a href="{{url('admin/notifications')}}" class="nav-link nav-toggle">--}}
{{--                    <i class="fa fa-bell"></i>--}}
{{--                    <span class="title">Notifications</span>--}}
{{--                    <span class="selected"></span>--}}
{{--                </a>--}}
{{--            </li>--}}
            <li class="nav-item @if(preg_match('/contacts/i',url()->current())) start active open @endif">
                <a href="{{url('admin/contacts')}}" class="nav-link nav-toggle">
                    <i class="icon-call-in"></i>
                    <span class="title">{{trans(lang_app_site().'.CP.contacts')}}</span>
                    <span class="selected"></span>
                </a>
            </li>
            <li class="nav-item @if(preg_match('/advertisements/i',url()->current())) start active open @endif">
                <a href="{{url('admin/advertisements')}}" class="nav-link nav-toggle">
                    <i class="icon-feed"></i>
                    <span class="title">{{trans(lang_app_site().'.CP.advertisements')}}</span>
                    <span class="selected"></span>
                </a>
            </li>
            <li class="nav-item @if(preg_match('/term/i',url()->current())) start active open @endif">
                <a href="{{url('admin/term')}}" class="nav-link nav-toggle">
                    <i class="icon-layers"></i>
                    <span class="title">{{trans(lang_app_site().'.CP.Term')}}</span>
                    <span class="selected"></span>
                </a>
            </li>
            <li class="nav-item @if(preg_match('/policy/i',url()->current())) start active open @endif">
                <a href="{{url('admin/policy')}}" class="nav-link nav-toggle">
                    <i class="icon-frame"></i>
                    <span class="title">{{trans(lang_app_site().'.CP.Privacy')}}</span>
                    <span class="selected"></span>
                </a>
            </li>
            <li class="nav-item @if(preg_match('/abouts/i',url()->current())) start active open @endif">
                <a href="{{url('admin/abouts')}}" class="nav-link nav-toggle">
                    <i class="icon-info"></i>
                    <span class="title">{{trans(lang_app_site().'.CP.About')}}</span>
                    <span class="selected"></span>
                </a>
            </li>

        </ul>


        <!-- END SIDEBAR MENU -->
    </div>
    <!-- END SIDEBAR -->
</div>
