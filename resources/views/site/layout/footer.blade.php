<!-- START FOOTER -->
<footer class="bg_gray">
	<div class="footer_top small_pt pb_20">
        <div class="container">
            <div class="row">
                <div class="col-lg-4 col-md-12 col-sm-12">
                	<div class="widget">
                        <div class="footer_logo">
                            <a href="#"><img src="{{url('/assets')}}/site/images/logo.png" alt="logo" height="80"/></a>
                        </div>
                        <!-- <p class="mb-3">If you are going to use of Lorem Ipsum need to be sure there isn't anything hidden of text</p> -->
                        <ul class="contact_info">
                            <li>
                                <i class="ti-location-pin"></i>
                                <p>{{$settings[1]->value}}</p>
                            </li>
                            <li>
                                <i class="ti-email"></i>
                                <a href="mailto:{{$settings[2]->value}}">{{$settings[2]->value}}</a>
                            </li>
                            <li>
                                <i class="ti-mobile"></i>
                                <p>{{$settings[0]->value}}</p>
                            </li>
                        </ul>
                    </div>
        		</div>
                <div class="col-lg-2 col-md-4 col-sm-6">
                	<div class="widget">
                        <h6 class="widget_title">Useful Links</h6>
                        <ul class="widget_links">
                            <li><a href="#">About Us</a></li>
                            <li><a href="#">FAQ</a></li>
                            <li><a href="#">Location</a></li>
                            <li><a href="#">Affiliates</a></li>
                            <li><a href="#">Contact</a></li>
                        </ul>
                    </div>
                </div>
                <div class="col-lg-2 col-md-4 col-sm-6">
                	<div class="widget">
                        <h6 class="widget_title">My Account</h6>
                        <ul class="widget_links">
                            <li><a href="#">My Account</a></li>
                            <li><a href="#">Discount</a></li>
                            <li><a href="#">Returns</a></li>
                            <li><a href="#">Orders History</a></li>
                            <li><a href="#">Order Tracking</a></li>
                        </ul>
                    </div>
                </div>
                <div class="col-lg-4 col-md-4 col-sm-12">
                	<div class="widget">
                    	<h6 class="widget_title">Download App</h6>
                        <ul class="app_list">
                            <li><a href="#"><img src="assets/images/f1.png" alt="f1"/></a></li>
                            <li><a href="#"><img src="assets/images/f2.png" alt="f2"/></a></li>
                        </ul>
                    </div>
                	<div class="widget">
                    	<h6 class="widget_title">Social</h6>
                        <ul class="social_icons">
                            <li><a href="#" class="sc_facebook"><i class="ion-social-facebook"></i></a></li>
                            <li><a href="#" class="sc_twitter"><i class="ion-social-twitter"></i></a></li>
                            <li><a href="#" class="sc_google"><i class="ion-social-googleplus"></i></a></li>
                            <li><a href="#" class="sc_youtube"><i class="ion-social-youtube-outline"></i></a></li>
                            <li><a href="#" class="sc_instagram"><i class="ion-social-instagram-outline"></i></a></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="middle_footer">
    	<div class="container">
        	<div class="row">
            	<div class="col-12">
                	<div class="shopping_info">
                        <div class="row justify-content-center">
                            <div class="col-md-4">
                                <div class="icon_box icon_box_style2">
                                    <div class="icon">
                                        <i class="flaticon-shipped"></i>
                                    </div>
                                    <div class="icon_box_content">
                                    	<h5>Free Delivery</h5>
                                        <p>Phasellus blandit massa enim elit of passage varius nunc.</p>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="icon_box icon_box_style2">
                                    <div class="icon">
                                        <i class="flaticon-money-back"></i>
                                    </div>
                                    <div class="icon_box_content">
                                    	<h5>30 Day Returns Guarantee</h5>
                                        <p>Phasellus blandit massa enim elit of passage varius nunc.</p>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="icon_box icon_box_style2">
                                    <div class="icon">
                                        <i class="flaticon-support"></i>
                                    </div>
                                    <div class="icon_box_content">
                                    	<h5>27/4 Online Support</h5>
                                        <p>Phasellus blandit massa enim elit of passage varius nunc.</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="bottom_footer border-top-tran">
        <div class="container">
            <div class="row">
                <div class="col-md-6">
                    <p class="text-center text-md-left mb-md-0">© 2020 All Rights Reserved by Bestwebcreator</p>
                </div>
                <div class="col-lg-6">
                    <ul class="footer_payment text-center text-md-right">
                        <li><a href="#"><img src="assets/images/visa.png" alt="visa"></a></li>
                        <li><a href="#"><img src="assets/images/discover.png" alt="discover"></a></li>
                        <li><a href="#"><img src="assets/images/master_card.png" alt="master_card"></a></li>
                        <li><a href="#"><img src="assets/images/paypal.png" alt="paypal"></a></li>
                        <li><a href="#"><img src="assets/images/amarican_express.png" alt="amarican_express"></a></li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</footer>
<!-- END FOOTER -->



<a href="#" class="scrollup" style="display: none;"><i class="ion-ios-arrow-up"></i></a>


@include(site_layout_vw().'.js')


</body>
</html>



<!--
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
</footer> -->
