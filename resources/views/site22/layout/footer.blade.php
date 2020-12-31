<footer>
    <div class="footer layout1 home1">
        <div class="special-container">
            <div class="container">
                <div class="main-footer">
                    <div class="row">
                        <div class="col-xs-12 col-sm-4 col-md-4 col-lg-4 col-ss-12">
                            <div class="widget widget-text">
                                <h3 class="widgettitle">{{trans(lang_app_site().'.footer.contact_info')}}</h3>
                                <div class="content">
                                    <h5 class="subtitle">{{trans(lang_app_site().'.footer.address')}}</h5>
                                    <p class="des">{{$settings[1]->value}}</p>
                                    <h5 class="subtitle">{{trans(lang_app_site().'.footer.phone')}}</h5>
                                    <p class="des">{{$settings[0]->value}}</p>
                                    <h5 class="subtitle">{{trans(lang_app_site().'.footer.email')}}</h5>
                                    <p class="des">{{$settings[2]->value}}</p>
                                </div>
                            </div>
                        </div>
                        <div class="col-xs-12 col-sm-8 col-md-8 col-lg-8 col-ss-12">
                            <div class="row auto-clear">
                                <div class="col-lg-4 col-md-4 col-sm-6 col-xs-6 col-ts-12 ">
                                    <div class="widget widget-custom-menu">
                                        <h3 class="widgettitle">{{trans(lang_app_site().'.footer.my_account')}}</h3>
                                        <ul>
                                            <li>
                                                <a href="{{url(site_url().'/login')}}">{{trans(lang_app_site().'.home.login')}}</a>
                                            </li>
                                            <li>
                                                <a href="{{url(site_url().'/shipping-cart')}}">{{trans(lang_app_site().'.product.view_cart')}}</a>
                                            </li>
                                            {{--                                            <li><a href="#">My Wishlist</a></li>--}}
                                            <li>
                                                <a href="{{url(site_url().'/myaccount')}}">{{trans(lang_app_site().'.home.my_orders')}}</a>
                                            </li>
                                            <li>
                                                <a href="{{url(site_url().'/contact')}}">{{trans(lang_app_site().'.home.contact_us')}}</a>
                                            </li>
                                            <li>
                                                <a href="{{url(site_url().'/term')}}">{{trans(lang_app_site().'.home.term')}}</a>
                                            </li>
                                            <li>
                                                <a href="{{url(site_url().'/policy')}}">{{trans(lang_app_site().'.home.policy')}}</a>
                                            </li>

{{--                                            <li><a href="#">Privacy Policy</a></li>--}}
{{--                                            <li><a href="#">Terms & Conditions</a></li>--}}
                                        </ul>
                                    </div>
                                </div>
                                <div class="col-lg-4 col-md-4 col-sm-6 col-xs-6 col-ts-12 ">
                                    <div class="widget widget-custom-menu hidden">
                                        <h3 class="widgettitle">{{trans(lang_app_site().'.footer.info')}}</h3>
                                        <ul>
                                            <li><a href="#">Delivery information</a></li>
                                            <li><a href="#">Privacy Policy</a></li>
                                            <li><a href="#">Terms & Conditions</a></li>
                                            <li><a href="{{url(site_url().'/contact')}}">Contact us</a></li>
                                            <li><a href="#">Sitemap</a></li>
                                        </ul>
                                    </div>
                                </div>
                                <div class="col-lg-4 col-md-4 col-sm-6 col-xs-6 col-ts-12">
                                    <div class="widget widget-custom-menu hidden">
                                        <h3 class="widgettitle">{{trans(lang_app_site().'.footer.customer_services')}}</h3>
                                        <ul>
                                            <li><a href="#">Shipping & Returns</a></li>
                                            <li><a href="#">Secure Shopping</a></li>
                                            <li><a href="#"> International Shipping</a></li>
                                            <li><a href="#">Affiliates</a></li>
                                            <li><a href="{{url(site_url().'/contact')}}">Contact</a></li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="footer-note">
                    <div class="coppy-right text-center">
                        <h3 class="content"> {{trans(lang_app_site().'.footer.reserve_rights')}} © {{Carbon\Carbon::now()->format('Y')}} <span
                                    class="site-name"> DragonMart</span> <span
                                    class="text"></span></h3>
                    </div>
                    
                    <img src="{{url('/assets')}}/site/images/payments.jpeg" height="40" style="height: 100px;margin-top: 10px;" class="center-block">

                </div>
            </div>
        </div>
    </div>
</footer>
