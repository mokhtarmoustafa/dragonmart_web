<header class="header_wrap bg-dark p-5 d-flex justify-content-center" dir="rtl">

    <div class="middle-header dark_skin container">
        <div class="d-flex justify-content-center">
            <a href="index.html">
                <img class="logo_light" src="<?php echo e(url('/assets')); ?>/img/logo_text.png" alt="logo">
                <img class="logo_dark" src="<?php echo e(url('/assets')); ?>/img/logo_text.png" alt="logo">
            </a>

            <!-- <div class="product_search_form radius_input search_form_btn">
                    <form>
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <div class="custom_select">
                                    <select class="first_null not_chosen">
                                        <option value="">All Category</option>
                                        <option value="Dresses">Dresses</option>
                                        <option value="Shirt-Tops">Shirt &amp; Tops</option>
                                        <option value="T-Shirt">T-Shirt</option>
                                        <option value="Pents">Pents</option>
                                        <option value="Jeans">Jeans</option>
                                    </select>
                                </div>
                            </div>
                            <input class="form-control" placeholder="Search Product..." required="" type="text">
                            <button type="submit" class="search_btn3"><?php echo e(trans(lang_app_site().'.home.search')); ?></button>
                        </div>
                    </form>
                </div> -->
            <!-- <ul class="navbar-nav attr-nav align-items-center">
                    <li><a href="#" class="nav-link"><i class="linearicons-user"></i></a></li>
                    <li><a href="#" class="nav-link"><i class="linearicons-heart"></i><span class="wishlist_count">0</span></a></li>
                    <li class="dropdown cart_dropdown"><a class="nav-link cart_trigger" href="#" data-toggle="dropdown"><i class="linearicons-bag2"></i><span class="cart_count">2</span><span class="amount"><span class="currency_symbol">$</span>159.00</span></a>
                        <div class="cart_box cart_right dropdown-menu dropdown-menu-right">
                            <ul class="cart_list">
                                <li>
                                    <a href="#" class="item_remove"><i class="ion-close"></i></a>
                                    <a href="#"><img src="assets/images/cart_thamb1.jpg" alt="cart_thumb1">Variable product 001</a>
                                    <span class="cart_quantity"> 1 x <span class="cart_amount"> <span class="price_symbole">$</span></span>78.00</span>
                                </li>
                                <li>
                                    <a href="#" class="item_remove"><i class="ion-close"></i></a>
                                    <a href="#"><img src="assets/images/cart_thamb2.jpg" alt="cart_thumb2">Ornare sed consequat</a>
                                    <span class="cart_quantity"> 1 x <span class="cart_amount"> <span class="price_symbole">$</span></span>81.00</span>
                                </li>
                            </ul>
                            <div class="cart_footer">
                                <p class="cart_total"><strong>Subtotal:</strong> <span class="cart_price"> <span class="price_symbole">$</span></span>159.00</p>
                                <p class="cart_buttons"><a href="#" class="btn btn-fill-line view-cart">View Cart</a><a href="#" class="btn btn-fill-out checkout">Checkout</a></p>
                            </div>
                        </div>
                    </li>
                </ul> -->
        </div>
        <div class="Download d-flex justify-content-center mt-5">
            <div class="">
                <a href="https://apps.apple.com/us/app/dragon-mart/id1523014369" target="_blank"><img src="<?php echo e(url('assets/site/images/IOS.png')); ?>" alt=""></a>
                <a href="https://play.google.com/store/apps/details?id=com.saudidragonmart.app" target="_blank"><img src="<?php echo e(url('assets/site/images/Android.png')); ?>" alt=""></a>
            </div>
        </div>
    </div>
    <!-- <div class="bottom_header dark_skin main_menu_uppercase border-top">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-lg-3 col-md-4 col-sm-6 col-3">
                    <div class="categories_wrap">
                        <button type="button" data-toggle="collapse" data-target="#navCatContent" aria-expanded="false" class="categories_btn categories_menu">
                            <span><?php echo e(trans(lang_app_site().'.home.all_categories')); ?> </span><i class="linearicons-menu"></i>
                        </button>
                        <div id="navCatContent" class="navbar collapse">
                            <ul>

                                <?php
                                $cats =Categories();
                                $cats = $cats->where("store_id" , null);
                                $n = 1;
                                ?>
                                <?php $__currentLoopData = $cats; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $cat): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>

                                <li>
                                    <a class="dropdown-item nav-link nav_item" href="<?php echo e(url(site_url().'/category')); ?>/<?php echo e($cat->id); ?>">
                                        <img src=" <?php echo e($cat->icon != '' ? $cat->icon32 : url('/assets').'/site/images/icon1.png'); ?>" style="padding:6px;" alt="">
                                        <span><?php echo e($cat->name); ?></span>
                                    </a>
                                </li>

                                <?php if($n == 7): ?>
                                <?php break;?>
                                <?php endif; ?>
                                <?php $n++ ?>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>



                            </ul>
                            <div class="more_categories">More Categories</div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-9 col-md-8 col-sm-6 col-9">
                    <nav class="navbar navbar-expand-lg">
                        <button class="navbar-toggler side_navbar_toggler" type="button" data-toggle="collapse" data-target="#navbarSidetoggle" aria-expanded="false">
                            <span class="ion-android-menu"></span>
                        </button>
                        <div class="pr_search_icon">
                            <a href="javascript:void(0);" class="nav-link pr_search_trigger"><i class="linearicons-magnifier"></i></a>
                        </div>
                        <div class="collapse navbar-collapse mobile_side_menu" id="navbarSidetoggle">
                            <ul class="navbar-nav">
                                <li class="dropdown">
                                    <a data-toggle="dropdown" class="nav-link dropdown-toggle active" href="#">Home</a>
                                    <div class="dropdown-menu">
                                        <ul>
                                            <li><a class="dropdown-item nav-link nav_item" href="index.html">Fashion 1</a></li>
                                            <li><a class="dropdown-item nav-link nav_item" href="index-2.html">Fashion 2</a></li>
                                            <li><a class="dropdown-item nav-link nav_item" href="index-3.html">Furniture 1</a></li>
                                            <li><a class="dropdown-item nav-link nav_item" href="index-4.html">Furniture 2</a></li>
                                            <li><a class="dropdown-item nav-link nav_item" href="index-5.html">Electronics 1</a></li>
                                            <li><a class="dropdown-item nav-link nav_item active" href="index-6.html">Electronics 2</a></li>
                                        </ul>
                                    </div>
                                </li>
                                <li class="dropdown">
                                    <a class="dropdown-toggle nav-link" href="#" data-toggle="dropdown">Pages</a>
                                    <div class="dropdown-menu">
                                        <ul>
                                            <li><a class="dropdown-item nav-link nav_item" href="about.html">About Us</a></li>
                                            <li><a class="dropdown-item nav-link nav_item" href="contact.html">Contact Us</a></li>
                                            <li><a class="dropdown-item nav-link nav_item" href="faq.html">Faq</a></li>
                                            <li><a class="dropdown-item nav-link nav_item" href="404.html">404 Error Page</a></li>
                                            <li><a class="dropdown-item nav-link nav_item" href="login.html">Login</a></li>
                                            <li><a class="dropdown-item nav-link nav_item" href="signup.html">Register</a></li>
                                            <li><a class="dropdown-item nav-link nav_item" href="term-condition.html">Terms and Conditions</a></li>
                                        </ul>
                                    </div>
                                </li>
                                <li class="dropdown dropdown-mega-menu">
                                    <a class="dropdown-toggle nav-link" href="#" data-toggle="dropdown">Products</a>
                                    <div class="dropdown-menu">
                                        <ul class="mega-menu d-lg-flex">
                                            <li class="mega-menu-col col-lg-3">
                                                <ul>
                                                    <li class="dropdown-header">Woman's</li>
                                                    <li><a class="dropdown-item nav-link nav_item" href="shop-list-left-sidebar.html">Vestibulum sed</a></li>
                                                    <li><a class="dropdown-item nav-link nav_item" href="shop-left-sidebar.html">Donec porttitor</a></li>
                                                    <li><a class="dropdown-item nav-link nav_item" href="shop-right-sidebar.html">Donec vitae facilisis</a></li>
                                                    <li><a class="dropdown-item nav-link nav_item" href="shop-list.html">Curabitur tempus</a></li>
                                                    <li><a class="dropdown-item nav-link nav_item" href="shop-load-more.html">Vivamus in tortor</a></li>
                                                </ul>
                                            </li>
                                            <li class="mega-menu-col col-lg-3">
                                                <ul>
                                                    <li class="dropdown-header">Men's</li>
                                                    <li><a class="dropdown-item nav-link nav_item" href="shop-cart.html">Donec vitae ante ante</a></li>
                                                    <li><a class="dropdown-item nav-link nav_item" href="checkout.html">Etiam ac rutrum</a></li>
                                                    <li><a class="dropdown-item nav-link nav_item" href="wishlist.html">Quisque condimentum</a></li>
                                                    <li><a class="dropdown-item nav-link nav_item" href="compare.html">Curabitur laoreet</a></li>
                                                    <li><a class="dropdown-item nav-link nav_item" href="order-completed.html">Vivamus in tortor</a></li>
                                                </ul>
                                            </li>
                                            <li class="mega-menu-col col-lg-3">
                                                <ul>
                                                    <li class="dropdown-header">Kid's</li>
                                                    <li><a class="dropdown-item nav-link nav_item" href="shop-product-detail.html">Donec vitae facilisis</a></li>
                                                    <li><a class="dropdown-item nav-link nav_item" href="shop-product-detail-left-sidebar.html">Quisque condimentum</a></li>
                                                    <li><a class="dropdown-item nav-link nav_item" href="shop-product-detail-right-sidebar.html">Etiam ac rutrum</a></li>
                                                    <li><a class="dropdown-item nav-link nav_item" href="shop-product-detail-thumbnails-left.html">Donec vitae ante ante</a></li>
                                                    <li><a class="dropdown-item nav-link nav_item" href="shop-product-detail-thumbnails-left.html">Donec porttitor</a></li>
                                                </ul>
                                            </li>
                                            <li class="mega-menu-col col-lg-3">
                                                <ul>
                                                    <li class="dropdown-header">Accessories</li>
                                                    <li><a class="dropdown-item nav-link nav_item" href="shop-product-detail.html">Donec vitae facilisis</a></li>
                                                    <li><a class="dropdown-item nav-link nav_item" href="shop-product-detail-left-sidebar.html">Quisque condimentum</a></li>
                                                    <li><a class="dropdown-item nav-link nav_item" href="shop-product-detail-right-sidebar.html">Etiam ac rutrum</a></li>
                                                    <li><a class="dropdown-item nav-link nav_item" href="shop-product-detail-thumbnails-left.html">Donec vitae ante ante</a></li>
                                                    <li><a class="dropdown-item nav-link nav_item" href="shop-product-detail-thumbnails-left.html">Donec porttitor</a></li>
                                                </ul>
                                            </li>
                                        </ul>
                                        <div class="d-lg-flex menu_banners">
                                            <div class="col-lg-6">
                                                <div class="header-banner">
                                                    <div class="sale-banner">
                                                        <a class="hover_effect1" href="#">
                                                            <img src="assets/images/shop_banner_img7.jpg" alt="shop_banner_img7">
                                                        </a>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-lg-6">
                                                <div class="header-banner">
                                                    <div class="sale-banner">
                                                        <a class="hover_effect1" href="#">
                                                            <img src="assets/images/shop_banner_img8.jpg" alt="shop_banner_img8">
                                                        </a>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </li>
                                <li class="dropdown">
                                    <a class="dropdown-toggle nav-link" href="#" data-toggle="dropdown">Blog</a>
                                    <div class="dropdown-menu dropdown-reverse">
                                        <ul>
                                            <li>
                                                <a class="dropdown-item menu-link dropdown-toggler" href="#">Grids</a>
                                                <div class="dropdown-menu">
                                                    <ul>
                                                        <li><a class="dropdown-item nav-link nav_item" href="blog-three-columns.html">3 columns</a></li>
                                                        <li><a class="dropdown-item nav-link nav_item" href="blog-four-columns.html">4 columns</a></li>
                                                        <li><a class="dropdown-item nav-link nav_item" href="blog-left-sidebar.html">Left Sidebar</a></li>
                                                        <li><a class="dropdown-item nav-link nav_item" href="blog-right-sidebar.html">right Sidebar</a></li>
                                                        <li><a class="dropdown-item nav-link nav_item" href="blog-standard-left-sidebar.html">Standard Left Sidebar</a></li>
                                                        <li><a class="dropdown-item nav-link nav_item" href="blog-standard-right-sidebar.html">Standard right Sidebar</a></li>
                                                    </ul>
                                                </div>
                                            </li>
                                            <li>
                                                <a class="dropdown-item menu-link dropdown-toggler" href="#">Masonry</a>
                                                <div class="dropdown-menu">
                                                    <ul>
                                                        <li><a class="dropdown-item nav-link nav_item" href="blog-masonry-three-columns.html">3 columns</a></li>
                                                        <li><a class="dropdown-item nav-link nav_item" href="blog-masonry-four-columns.html">4 columns</a></li>
                                                        <li><a class="dropdown-item nav-link nav_item" href="blog-masonry-left-sidebar.html">Left Sidebar</a></li>
                                                        <li><a class="dropdown-item nav-link nav_item" href="blog-masonry-right-sidebar.html">right Sidebar</a></li>
                                                    </ul>
                                                </div>
                                            </li>
                                            <li>
                                                <a class="dropdown-item menu-link dropdown-toggler" href="#">Single Post</a>
                                                <div class="dropdown-menu">
                                                    <ul>
                                                        <li><a class="dropdown-item nav-link nav_item" href="blog-single.html">Default</a></li>
                                                        <li><a class="dropdown-item nav-link nav_item" href="blog-single-left-sidebar.html">left sidebar</a></li>
                                                        <li><a class="dropdown-item nav-link nav_item" href="blog-single-slider.html">slider post</a></li>
                                                        <li><a class="dropdown-item nav-link nav_item" href="blog-single-video.html">video post</a></li>
                                                        <li><a class="dropdown-item nav-link nav_item" href="blog-single-audio.html">audio post</a></li>
                                                    </ul>
                                                </div>
                                            </li>
                                            <li>
                                                <a class="dropdown-item menu-link dropdown-toggler" href="#">List</a>
                                                <div class="dropdown-menu">
                                                    <ul>
                                                        <li><a class="dropdown-item nav-link nav_item" href="blog-list-left-sidebar.html">left sidebar</a></li>
                                                        <li><a class="dropdown-item nav-link nav_item" href="blog-list-right-sidebar.html">right sidebar</a></li>
                                                    </ul>
                                                </div>
                                            </li>
                                        </ul>
                                    </div>
                                </li>
                                <li class="dropdown dropdown-mega-menu">
                                    <a class="dropdown-toggle nav-link" href="#" data-toggle="dropdown">Shop</a>
                                    <div class="dropdown-menu">
                                        <ul class="mega-menu d-lg-flex">
                                            <li class="mega-menu-col col-lg-9">
                                                <ul class="d-lg-flex">
                                                    <li class="mega-menu-col col-lg-4">
                                                        <ul>
                                                            <li class="dropdown-header">Shop Page Layout</li>
                                                            <li><a class="dropdown-item nav-link nav_item" href="shop-list.html">shop List view</a></li>
                                                            <li><a class="dropdown-item nav-link nav_item" href="shop-list-left-sidebar.html">shop List Left Sidebar</a></li>
                                                            <li><a class="dropdown-item nav-link nav_item" href="shop-list-right-sidebar.html">shop List Right Sidebar</a></li>
                                                            <li><a class="dropdown-item nav-link nav_item" href="shop-left-sidebar.html">Left Sidebar</a></li>
                                                            <li><a class="dropdown-item nav-link nav_item" href="shop-right-sidebar.html">Right Sidebar</a></li>
                                                            <li><a class="dropdown-item nav-link nav_item" href="shop-load-more.html">Shop Load More</a></li>
                                                        </ul>
                                                    </li>
                                                    <li class="mega-menu-col col-lg-4">
                                                        <ul>
                                                            <li class="dropdown-header">Other Pages</li>
                                                            <li><a class="dropdown-item nav-link nav_item" href="shop-cart.html">Cart</a></li>
                                                            <li><a class="dropdown-item nav-link nav_item" href="checkout.html">Checkout</a></li>
                                                            <li><a class="dropdown-item nav-link nav_item" href="my-account.html">My Account</a></li>
                                                            <li><a class="dropdown-item nav-link nav_item" href="wishlist.html">Wishlist</a></li>
                                                            <li><a class="dropdown-item nav-link nav_item" href="compare.html">compare</a></li>
                                                            <li><a class="dropdown-item nav-link nav_item" href="order-completed.html">Order Completed</a></li>
                                                        </ul>
                                                    </li>
                                                    <li class="mega-menu-col col-lg-4">
                                                        <ul>
                                                            <li class="dropdown-header">Product Pages</li>
                                                            <li><a class="dropdown-item nav-link nav_item" href="shop-product-detail.html">Default</a></li>
                                                            <li><a class="dropdown-item nav-link nav_item" href="shop-product-detail-left-sidebar.html">Left Sidebar</a></li>
                                                            <li><a class="dropdown-item nav-link nav_item" href="shop-product-detail-right-sidebar.html">Right Sidebar</a></li>
                                                            <li><a class="dropdown-item nav-link nav_item" href="shop-product-detail-thumbnails-left.html">Thumbnails Left</a></li>
                                                        </ul>
                                                    </li>
                                                </ul>
                                            </li>
                                            <li class="mega-menu-col col-lg-3">
                                                <div class="header_banner">
                                                    <div class="header_banner_content">
                                                        <div class="shop_banner">
                                                            <div class="banner_img overlay_bg_40">
                                                                <img src="assets/images/shop_banner4.jpg" alt="shop_banner2" />
                                                            </div>
                                                            <div class="shop_bn_content">
                                                                <h6 class="text-uppercase shop_subtitle">New Collection</h6>
                                                                <h5 class="text-uppercase shop_title">Sale 30% Off</h5>
                                                                <a href="#" class="btn btn-white rounded-0 btn-xs text-uppercase">Shop Now</a>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </li>
                                        </ul>
                                    </div>
                                </li>
                                <li><a class="nav-link nav_item" href="contact.html">Contact Us</a></li>
                            </ul>
                        </div>
                        <div class="contact_phone contact_support">
                            <i class="linearicons-phone-wave"></i>
                            <span><?php echo e($settings[0]->value); ?></span>
                        </div>
                    </nav>
                </div>
            </div>
        </div>
    </div> -->
</header>


<!-- <header>
    <div class="header layout1 no-prepend-box-sticky">
        <div class="topbar layout1">
            <div class="container">
                <ul class="menu-topbar">
                    <li class="language menu-item-has-children">

                        <?php if(session()->has('lang') && session()->get('lang') == 'ar'): ?>
                            <a href="<?php echo e(url(site_url().'/lang/ar')); ?>" class="toggle-sub-menu"><span class="flag"><img
                                            src="<?php echo e(url('/assets')); ?>/site/images/ar.png" alt=""></span>
                                <?php echo e(trans(lang_app_site().'.home.arabic')); ?></a>
                            <ul class="list-language sub-menu">
                                <li>
                                    <a href="<?php echo e(url(site_url().'/lang/en')); ?>"><span class="flag"><img
                                                    src="<?php echo e(url('/assets')); ?>/site/images/en.png" alt=""></span>
                                        English</a>
                                </li>


                            </ul>

                        <?php else: ?>
                            <a href="<?php echo e(url(site_url().'/lang/en')); ?>" class="toggle-sub-menu"><span class="flag"><img
                                            src="<?php echo e(url('/assets')); ?>/site/images/en.png" alt=""></span> English</a>
                            <ul class="list-language sub-menu">
                                <li><a href="<?php echo e(url(site_url().'/lang/ar')); ?>"><span class="flag"><img
                                                    src="<?php echo e(url('/assets')); ?>/site/images/ar.png" alt=""></span>
                                        <?php echo e(trans(lang_app_site().'.home.arabic')); ?></a></li>
                            </ul>
                        <?php endif; ?>
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
                    <?php if(!Auth::guard('web')->user()): ?>
                        <li><a href="<?php echo e(url(site_url().'/login')); ?>"><?php echo e(trans(lang_app_site().'.home.register')); ?>

                                / <?php echo e(trans(lang_app_site().'.home.login')); ?></a></li>
                    <?php else: ?>
                        <li><a href="<?php echo e(url(site_url().'/myaccount')); ?>"><?php echo e(Auth::guard('web')->user()->username); ?> </a> /
                            <a href="javascript:void(0)"
                               onclick="logout()"> <?php echo e(trans(lang_app_site().'.home.logout')); ?></a></li>
                    <?php endif; ?>
                </ul>
            </div>
        </div>
        <div class="main-header">
            <div class="top-header">
                <div class="container">
                    <div class="row">
                        <div class="col-lg-2 col-md-2 col-sm-12 col-xs-12  left-content">
                            <div class="logo" style="margin-top: -20px;">
                                <a href="<?php echo e(url(site_url().'/home')); ?>"><img
                                            src="<?php echo e(url('/assets')); ?>/site/images/logo.svg" alt=""></a>
                            </div>
                        </div>
                        <div class="col-lg-6 col-md-5 col-sm-6 col-xs-12 midle-content">
                            <div class="search-form layout1 box-has-content">
                                <div class="search-block">
                                    <div class="search-inner">

                                        <input type="text" class="search-info"
                                               placeholder="<?php echo e(trans(lang_app_site().'.home.search')); ?>" id="textsearch"
                                               value="<?php echo e((request()->segment(2) == 'search') ? request()->segment(3): ''); ?>">

                                    </div>
                                    <div class="search-choice parent-content">
                                        <select data-placeholder="<?php echo e(trans(lang_app_site().'.home.all_categories')); ?>"
                                                class="chosen-select" id="catSelect">
                                            <option value="all"><?php echo e(trans(lang_app_site().'.home.all_categories')); ?></option>


                                            <?php
                                                $cats =Categories()->where("store_id" , null);
                                            ?>

                                            <?php $__currentLoopData = $cats; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $cat): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                <option value="<?php echo e($cat->id); ?>"><?php echo e($cat->name); ?></option>

                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

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
                                        <span class="text white"><?php echo e(trans(lang_app_site().'.home.callus')); ?></span>
                                        <span class="number white"><?php echo e($settings[0]->value); ?></span>
                                    </div>
                                </li>

                                @ include(site_sub_view_vw().'.cartheader')

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
                                    <span class="text"><?php echo e(trans(lang_app_site().'.home.categories')); ?></span>
                                </div>
                                <div class="vertical-content hidden-content <?php echo e($always_open ?? ''); ?>">
                                    <ul class="vertical-menu ovic-clone-mobile-menu">

                                        <?php
                                            $cats =Categories();
                                            $cats = $cats->where("store_id" , null);
                                            $n = 1;
                                        ?>
                                        <?php $__currentLoopData = $cats; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $cat): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <li><a href="<?php echo e(url(site_url().'/category')); ?>/<?php echo e($cat->id); ?>"
                                                   class="ovic-menu-item-title" title="Cameras"><span class="icon"><img
                                                                src=" <?php echo e($cat->icon != '' ? $cat->icon32 : url('/assets').'/site/images/icon1.png'); ?>"
                                                                style="padding:6px;"
                                                                alt=""></span> <?php echo e($cat->name); ?></a></li>


                                            <?php if($n == 7): ?>
                                             <?php break;?>
                                            <?php endif; ?>
                                            <?php $n++ ?>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>


                                    </ul>
                                    <div class="view-all-categori">
                                        <a href="javascript:void(0)" class="button"
                                           id="clickcat"><?php echo e(trans(lang_app_site().'.home.all_cats')); ?>

                                            <?php if(session()->has('lang') && session()->get('lang') == 'en'): ?>
                                                <i class="fa fa-angle-double-right"
                                                    aria-hidden="true"></i></a>
                                        <?php else: ?>
                                            <i class="fa fa-angle-double-left"
                                                    aria-hidden="true"></i>
                                        <?php endif; ?>
                                    </div>
                                    <script type="text/javascript">
                                        document.getElementById("clickcat").onclick = function () {
                                            location.href = "<?php echo e(url(site_url()).'/categories'); ?>";
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
                                                    <a href="<?php echo e(url(site_url().'/home')); ?>"
                                                       class="kt-item-title ovic-menu-item-title"
                                                       title="Home"><?php echo e(trans(lang_app_site().'.home.home')); ?></a>
                                                </li>
                                                <li class="menu-item"><a
                                                            href="<?php echo e(url(site_url().'/merchants')); ?>"><?php echo e(trans(lang_app_site().'.home.merchants')); ?></a>
                                                </li>
                                                <li class="menu-item"><a
                                                            href="<?php echo e(url(site_url().'/services')); ?>"><?php echo e(trans(lang_app_site().'.home.services')); ?></a>
                                                </li>
                                                <li class="menu-item"><a
                                                            href="<?php echo e(url(site_url().'/about')); ?>"><?php echo e(trans(lang_app_site().'.home.about_us')); ?></a>
                                                </li>
                                                <li class="menu-item"><a
                                                            href="<?php echo e(url(site_url().'/contact')); ?>"><?php echo e(trans(lang_app_site().'.home.contact_us')); ?></a>
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
</header> -->



<?php $__env->startSection('javascript'); ?>
<script>


</script>
<?php $__env->stopSection(); ?><?php /**PATH /home/saudidragonmart/public_html/resources/views/site/layout/header.blade.php ENDPATH**/ ?>