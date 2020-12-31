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
            <li class="nav-item <?php if(preg_match('/home/i',url()->current())): ?> start active open <?php endif; ?>">
                <a href="<?php echo e(url(merchant_vw().'/home')); ?>" class="nav-link nav-toggle">
                    <i class="icon-home"></i>
                    <span class="title"><?php echo e(trans(lang_app_site().'.CP.Dashboard')); ?></span>
                    <span class="selected"></span>
                </a>
            </li>
            <li class="nav-item <?php if(preg_match('/categories/i',url()->current())): ?> start active open <?php endif; ?>">
                <a href="<?php echo e(url(merchant_vw().'/categories')); ?>" class="nav-link nav-toggle">
                    <i class="fa fa-list"></i>
                    <span class="title" ><?php echo e(trans(lang_app_site().'.CP.My Categories')); ?></span>
                    <span class="selected"></span>
                </a>
            </li>
            <li class="nav-item <?php if(preg_match('/store/i',url()->current())): ?> start active open <?php endif; ?>">
                <a href="<?php echo e(url(merchant_vw().'/store')); ?>" class="nav-link nav-toggle">
                    <i class="fa fa-database"></i>
                    <span class="title"><?php echo e(trans(lang_app_site().'.CP.Stores')); ?></span>
                    <span class="selected"></span>
                </a>
            </li>
            <li class="nav-item <?php if(preg_match('/product/i',url()->current())): ?> start active open <?php endif; ?>">
                <a href="<?php echo e(url(merchant_vw().'/products')); ?>" class="nav-link nav-toggle">
                    <i class="icon-grid"></i>
                    <span class="title"><?php echo e(trans(lang_app_site().'.CP.Products')); ?></span>
                    <span class="selected"></span>
                    <span class="arrow"></span>

                </a>

                <ul class="sub-menu ">
                    <li class="nav-item <?php if(preg_match('/products/i',url()->current())): ?> start active open <?php endif; ?>">
                        <a href="<?php echo e(url(merchant_vw().'/products')); ?>" class="nav-link ">
                            
                            <span class="title"><?php echo e(trans(lang_app_site().'.CP.Products')); ?></span>
                        </a>
                    </li>
                    <li class="nav-item <?php if(preg_match('/create/i',url()->current())): ?> start active open <?php endif; ?>">
                        <a href="<?php echo e(url(merchant_vw().'/product/create')); ?>" class="nav-link ">
                            <span class="title"><?php echo e(trans(lang_app_site().'.CP.New Product')); ?></span>
                        </a>
                    </li>

                </ul>

            </li>
            <li class="nav-item <?php if(preg_match('/order/i',url()->current())): ?> start active open <?php endif; ?>">
                <a href="<?php echo e(url(merchant_vw().'/orders-list')); ?>" class="nav-link nav-toggle">
                    <i class="icon-basket-loaded"></i>
                    <span class="title"><?php echo e(trans(lang_app_site().'.CP.Order list')); ?></span>
                    <span class="selected"></span>
                </a>
            </li>
            <li class="nav-item <?php if(preg_match('/driver/i',url()->current())): ?> start active open <?php endif; ?>">
                <a href="<?php echo e(url(merchant_vw().'/drivers-list')); ?>" class="nav-link nav-toggle">
                    <i class="fa fa-truck"></i>
                    <span class="title"><?php echo e(trans(lang_app_site().'.CP.Drivers')); ?></span>
                    <span class="selected"></span>
                </a>
            </li>
            <li class="nav-item <?php if(preg_match('/profile/i',url()->current())): ?> start active open <?php endif; ?>">
                <a href="<?php echo e(url(merchant_vw().'/profile')); ?>" class="nav-link nav-toggle">
                    <i class="fa fa-user"></i>
                    <span class="title"><?php echo e(trans(lang_app_site().'.CP.Profile')); ?></span>
                    <span class="selected"></span>
                </a>
            </li>
            
            
            
            
            
            

            

            
            
            
            
            
            
            
            
            
            
            
            
            

            
            


            <li class="nav-item <?php if(preg_match('/shipments/i',url()->current())): ?> start active open <?php endif; ?>">
                <a href="javascript:;" class="nav-link nav-toggle">
                    <i class="icon-settings"></i>
                    <span class="title"><?php echo e(trans(lang_app_site().'.CP.Settings')); ?></span>
                    <span class="selected"></span>
                    <span class="arrow"></span>

                </a>
                <ul class="sub-menu ">
                    
                    
                    
                    
                    
                    
                    <li class="nav-item <?php if(preg_match('/shipments/i',url()->current())): ?> start active open <?php endif; ?>">
                        <a href="<?php echo e(url(merchant_vw().'/shipments')); ?>" class="nav-link ">
                            <span class="title"><?php echo e(trans(lang_app_site().'.CP.Shipping rate')); ?></span>
                        </a>
                    </li>

                </ul>

            </li>
            <li class="nav-item <?php if(preg_match('/notifications/i',url()->current())): ?> start active open <?php endif; ?>">
                <a href="<?php echo e(url(merchant_vw().'/notifications')); ?>" class="nav-link nav-toggle">
                    <i class="fa fa-bell"></i>
                    <span class="title"><?php echo e(trans(lang_app_site().'.CP.Notifications')); ?></span>
                    <span class="selected"></span>
                </a>
            </li>

            <li class="nav-item <?php if(preg_match('/advertisements/i',url()->current())): ?> start active open <?php endif; ?>">
                <a href="<?php echo e(url(merchant_vw().'/advertisements')); ?>" class="nav-link nav-toggle">
                    <i class="icon-feed"></i>
                    <span class="title"><?php echo e(trans(lang_app_site().'.CP.advertisements')); ?></span>
                    <span class="selected"></span>
                </a>
            </li>

        </ul>


        <!-- END SIDEBAR MENU -->
    </div>
    <!-- END SIDEBAR -->
</div>
<?php /**PATH C:\xampp\htdocs\Dragon\resources\views/merchant/layout/sidebar.blade.php ENDPATH**/ ?>