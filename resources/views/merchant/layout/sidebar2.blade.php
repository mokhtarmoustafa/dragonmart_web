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
        <ul class="page-sidebar-menu  page-header-fixed " data-keep-expanded="false" data-auto-scroll="true"
            data-slide-speed="200" style="padding-top: 20px">
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
                <a href="{{url(merchant_vw().'/home')}}" class="nav-link nav-toggle">
                    <i class="icon-home"></i>
                    <span class="title">Dashboard</span>
                    <span class="selected"></span>
                </a>
            </li>
            <li class="nav-item @if(preg_match('/store/i',url()->current())) start active open @endif">
                <a href="{{url(merchant_vw().'/store')}}" class="nav-link nav-toggle">
                    <i class="fa fa-database"></i>
                    <span class="title">Store</span>
                    <span class="selected"></span>
                </a>
            </li>
            {{--            <li class="nav-item @if(preg_match('/shipment/i',url()->current())) start active open @endif">--}}
            {{--                <a href="{{url(merchant_vw().'/shipments')}}" class="nav-link nav-toggle">--}}
            {{--                    <i class="fa fa-ship"></i>--}}
            {{--                    <span class="title">Shipment cost</span>--}}
            {{--                    <span class="selected"></span>--}}
            {{--                </a>--}}
            {{--            </li>--}}
            <li class="nav-item">
                <a href="#" class="nav-link nav-toggle">
                    <i class="icon-grid"></i>
                    <span class="title">Products</span>
                    <span class="selected"></span>
                </a>
            </li>
            <li class="nav-item">
                <a href="#" class="nav-link nav-toggle">
                    <i class="icon-basket-loaded"></i>
                    <span class="title">Orders</span>
                    <span class="selected"></span>
                </a>
            </li>
            <li class="nav-item">
                <a href="#" class="nav-link nav-toggle">
                    <i class="fa fa-truck"></i>
                    <span class="title">Drivers</span>
                    <span class="selected"></span>
                </a>
            </li>
            <li class="nav-item">
                <a href="#" class="nav-link nav-toggle">
                    <i class="fa fa-user"></i>
                    <span class="title">Profile</span>
                    <span class="selected"></span>
                </a>
            </li>
            <li class="nav-item">
                <a href="#" class="nav-link nav-toggle">
                    <i class="icon-bar-chart"></i>
                    <span class="title">Reports</span>
                    <span class="selected"></span>
                </a>
            </li>


            <li class="nav-item">
                <a href="javascript:;" class="nav-link nav-toggle">
                    <i class="icon-settings"></i>
                    <span class="title">Settings</span>
                    <span class="selected"></span>
                    <span class="arrow"></span>

                </a>
                <ul class="sub-menu ">
                    <li class="nav-item @if(preg_match('/categories/i',url()->current())) start active open @endif">
                        <a href="{{url(admin_constant_url().'/categories')}}" class="nav-link ">
                            {{--<i class="icon-bar-chart"></i>--}}
                            <span class="title">Categories</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{url(merchant_vw().'/shipments')}}" class="nav-link ">
                            <span class="title">Shipping price</span>
                        </a>
                    </li>

                </ul>

            </li>
            <li class="nav-item">
                <a href="#" class="nav-link nav-toggle">
                    <i class="fa fa-bell"></i>
                    <span class="title">Notifications</span>
                    <span class="selected"></span>
                </a>
            </li>
        </ul>
        <!-- END SIDEBAR MENU -->
        <!-- END SIDEBAR MENU -->
    </div>
    <!-- END SIDEBAR -->
</div>
