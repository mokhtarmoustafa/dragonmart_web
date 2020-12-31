<div class="page-header navbar navbar-fixed-top">
    <!-- BEGIN HEADER INNER -->
    <div class="page-header-inner ">
        <!-- BEGIN LOGO -->
        
        
        
        
        
        
        
        

        <div class="page-logo">
            <a href="<?php echo e(url(admin_vw().'/home')); ?>" style="    margin: 0px;
    margin-top: 4px;
    text-align: center;
    width: 87%;">
                <img src="<?php echo e(url('assets/apps/img/logo.png')); ?>" alt="logo" class="logo-default img-circle"
                     style="width: 44%;margin: 0px;"/> </a>
            <div class="menu-toggler sidebar-toggler">
                <!-- DOC: Remove the above "hide" to enable the sidebar toggler button on header -->
            </div>
        </div>
        <!-- END LOGO -->
        <!-- BEGIN RESPONSIVE MENU TOGGLER -->
        <a href="javascript:;" class="menu-toggler responsive-toggler" data-toggle="collapse"
           data-target=".navbar-collapse">
            <span></span>
        </a>
        <!-- END RESPONSIVE MENU TOGGLER -->
        <div class="page-top">

            <!-- BEGIN TOP NAVIGATION MENU -->
            <div class="top-menu">
                <ul class="nav navbar-nav pull-right">
                    <!-- BEGIN USER LOGIN DROPDOWN -->
                    <!-- DOC: Apply "dropdown-dark" class after below "dropdown-extended" to change the dropdown styte -->
                    <li class="dropdown dropdown-user">
                        <a href="javascript:;" class="dropdown-toggle" data-toggle="dropdown" data-hover="dropdown"
                           data-close-others="true">


                            <span class="username username-hide-on-mobile"> <?php echo e($currentUser->username); ?> </span>
                            <i class="fa fa-angle-down"></i>
                        </a>
                        <ul class="dropdown-menu dropdown-menu-default">
                            <li>
                                <a href="<?php echo e(url(merchant_vw().'/profile')); ?>">
                                    <i class="icon-user"></i> My Profile </a>
                            </li>
                           <li>
                                 <?php if(session()->has('lang') && session()->get('lang') == 'ar'): ?>
                                     <a href="<?php echo e(url(site_url().'/lang/en')); ?>"><span class="flag"><img
                                                    src="<?php echo e(url('/assets')); ?>/site/images/en.png" alt=""></span>
                                        English</a>
                                  <?php else: ?> 
                                  <a href="<?php echo e(url(site_url().'/lang/ar')); ?>"><span class="flag"><img
                                                    src="<?php echo e(url('/assets')); ?>/site/images/ar.png" alt=""></span>
                                        <?php echo e(trans(lang_app_site().'.home.arabic')); ?></a>
                                  
                                  <?php endif; ?>
                                    
                            </li>
                            <li>
                                <a href="<?php echo e(route('admin.logout')); ?>"
                                   onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                    <i class="icon-key"></i>  <?php echo e(trans(lang_app_site().'.home.logout')); ?> </a>
                            </li>

                            <form id="logout-form" action="<?php echo e(route('admin.logout')); ?>" method="POST"
                                  style="display: none;">
                                <?php echo e(csrf_field()); ?>

                            </form>
                        </ul>
                    </li>
                    <!-- END USER LOGIN DROPDOWN -->
                </ul>
            </div>
            <!-- END TOP NAVIGATION MENU -->
        </div>
    </div>
    <!-- END HEADER INNER -->
</div>
<?php /**PATH C:\xampp\htdocs\Dragon\resources\views/merchant/layout/header.blade.php ENDPATH**/ ?>