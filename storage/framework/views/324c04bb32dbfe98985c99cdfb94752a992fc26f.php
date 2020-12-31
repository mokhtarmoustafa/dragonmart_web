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
                <a href="<?php echo e(url('admin/home')); ?>" class="nav-link nav-toggle">
                    <i class="icon-home"></i>
                    <span class="title"><?php echo e(trans(lang_app_site().'.CP.Dashboard')); ?></span>
                    <span class="selected"></span>
                </a>
            </li>

            <?php if(isset($permissions_sidebar)): ?>
                <?php $__currentLoopData = $permissions_sidebar; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $per): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <li class="<?php if(preg_match('/'.$per->alias.'/i',url()->current())): ?> start active open <?php endif; ?>">
                        <a <?php if(!isset($per->children) || count($per->children) == 0 /*|| count($per->children) == 1*/): ?>href="<?php echo e(url(admin_vw().'/'.$per->alias.'/'.$per->name)); ?>"
                           <?php else: ?> href="javascript:;" <?php endif; ?>>
                            <i class="<?php echo e($per->icon); ?>"></i>
                            <span class="title"><?php echo e(trans(lang_app_site().'.CP.'.$per->display_name)); ?></span>
                            <?php if(isset($per->children) && count($per->children) > 0): ?>
                                <span class="arrow"></span>
                            <?php endif; ?>
                            <span class="selected"></span>

                        </a>
                        <?php if(isset($per->children) && count($per->children) >= 1): ?>

                            <ul class="sub-menu">
                                <?php $__currentLoopData = $per->children; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $child): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    
                                    <li>
                                        <a href="<?php echo e(url(admin_vw().'/'.$child->alias.'/'.$child->name)); ?>">
                                            <i class="<?php echo e($child->icon); ?>"></i>
                                           <?php echo e(trans(lang_app_site().'.CP.'.$child->display_name)); ?>

                                        </a>
                                    </li>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </ul>

                        <?php endif; ?>
                    </li>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            <?php endif; ?>


            
            
            
            
            
            
            
            
            
            
            
            
            
            

            
            
            
            
            
            
            
            
            
            
            
            
            

            
            
            
            
            
            
            
            
            
            
            
            
            
            

            

            

            
            
            
            
            
            

            
            
            
            
            
            
            
            
            
            
            
            
            
            
            
            
            
            
            

            

            
            
            
            
            
            
            
            
            
            
            
            
            
            

            
            
            
            
            
            
            
            
            
            
            
            
            
            
            
            
            
            
            
            


            

            

            
            
            
            
            
            
            







            <li class="nav-item <?php if(preg_match('/contacts/i',url()->current())): ?> start active open <?php endif; ?>">
                <a href="<?php echo e(url('admin/contacts')); ?>" class="nav-link nav-toggle">
                    <i class="icon-call-in"></i>
                    <span class="title"><?php echo e(trans(lang_app_site().'.CP.contacts')); ?></span>
                    <span class="selected"></span>
                </a>
            </li>
            <li class="nav-item <?php if(preg_match('/advertisements/i',url()->current())): ?> start active open <?php endif; ?>">
                <a href="<?php echo e(url('admin/advertisements')); ?>" class="nav-link nav-toggle">
                    <i class="icon-feed"></i>
                    <span class="title"><?php echo e(trans(lang_app_site().'.CP.advertisements')); ?></span>
                    <span class="selected"></span>
                </a>
            </li>
            <li class="nav-item <?php if(preg_match('/term/i',url()->current())): ?> start active open <?php endif; ?>">
                <a href="<?php echo e(url('admin/term')); ?>" class="nav-link nav-toggle">
                    <i class="icon-layers"></i>
                    <span class="title"><?php echo e(trans(lang_app_site().'.CP.Term')); ?></span>
                    <span class="selected"></span>
                </a>
            </li>
            <li class="nav-item <?php if(preg_match('/policy/i',url()->current())): ?> start active open <?php endif; ?>">
                <a href="<?php echo e(url('admin/policy')); ?>" class="nav-link nav-toggle">
                    <i class="icon-frame"></i>
                    <span class="title"><?php echo e(trans(lang_app_site().'.CP.Privacy')); ?></span>
                    <span class="selected"></span>
                </a>
            </li>
            <li class="nav-item <?php if(preg_match('/abouts/i',url()->current())): ?> start active open <?php endif; ?>">
                <a href="<?php echo e(url('admin/abouts')); ?>" class="nav-link nav-toggle">
                    <i class="icon-info"></i>
                    <span class="title"><?php echo e(trans(lang_app_site().'.CP.About')); ?></span>
                    <span class="selected"></span>
                </a>
            </li>

        </ul>


        <!-- END SIDEBAR MENU -->
    </div>
    <!-- END SIDEBAR -->
</div>
<?php /**PATH /home/saudidragonmart/public_html/resources/views/admin/layout/sidebar.blade.php ENDPATH**/ ?>