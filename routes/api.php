<?php

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

//use App\User;
//use Mobily;

use Damas\Paytabs\paytabs;

if (request()->hasHeader('lang'))
app()->setLocale(request()->header('lang'));

Route::get('test', function(){

  

  // return App\User::with(array('store'=>function($query){
  //   $query->select('id');
  // }))->select('id','username')->where('id', 387)->get();
  // // return App\User::with('store')->where('id', 387)->get('id', 'username');
  // return App\User::where('id', 387)->pluck('username', 'id')->all();
  // // return App\Store::find(83);

});

Route::group(['prefix' => version_api(), 'namespace' => namespace_api()], function () {

  Route::get('/down', function () {
    return response_api(false, 200, null, []);
  });
  Route::get('/tareq-down', function () {
    return response_api(false, 200, null, []);
  });

  //    Route::post('send-sms', function () {
  //        return Mobily::send(request()->get('mobile'), 'Your Message Here');
  //
  //    });
  //    Route::get('balance', function () {
  //      return  Mobily::Balance();
  //
  //    });


  //    Route::get('/paytabs_payment', function () {
  //        $pt = Paytabs::getInstance("m.sf2009@hotmail.com", "W5hnLejgVyQguQ083at4G88IHjoivQxsVOPH38XYHOecEfkHqOM6WVPEeeWK4uc0i1ImaFkStz48PpQfdDmazcONqLyvfKwyMeVX");
  //        $result = $pt->create_pay_page(array(
  //            "merchant_email" => "m.sf2009@hotmail.com",
  //            'secret_key' => "W5hnLejgVyQguQ083at4G88IHjoivQxsVOPH38XYHOecEfkHqOM6WVPEeeWK4uc0i1ImaFkStz48PpQfdDmazcONqLyvfKwyMeVX",
  //            'title' => "Tareq Doe",
  //            'cc_first_name' => "Tareq",
  //            'cc_last_name' => "Doe",
  //            'email' => "Tareq@email.com",
  //            'cc_phone_number' => "973",
  //            'phone_number' => "33333333",
  //            'billing_address' => "Juffair, Manama, Saudi Arabia",
  //            'city' => "Manama",
  //            'state' => "Capital",
  //            'postal_code' => "97300",
  //            'country' => "SAU",
  //            'address_shipping' => "Juffair, Manama, Saudi Arabia",
  //            'city_shipping' => "Manama",
  //            'state_shipping' => "Capital",
  //            'postal_code_shipping' => "97300",
  //            'country_shipping' => "USA",
  //            "products_per_title" => "Mobile Phone",
  //            'currency' => "SAR", // SAR
  //            "unit_price" => "130",
  //            'quantity' => "1",
  //            'other_charges' => "0",
  //            'amount' => "130.00",
  //            'discount' => "0",
  //            "msg_lang" => "english",
  //            "reference_no" => "1231231",
  //            "site_url" => url('/'),
  //            'return_url' => url('/result-data'),
  //            "cms_with_version" => "API USING PHP"
  //        ));
  //
  ////    if ($result->response_code == 4012) {
  ////        return redirect($result->payment_url);
  ////    }
  //
  //        if ($result->response_code == 4012)
  //            return response_api(true, 200, null, $result);
  //        return response_api(false, 422, null, $result);
  //    });
  //
  //    Route::post('/paytabs_response', function (\Illuminate\Http\Request $request) {
  //        $pt = Paytabs::getInstance("m.sf2009@hotmail.com", "W5hnLejgVyQguQ083at4G88IHjoivQxsVOPH38XYHOecEfkHqOM6WVPEeeWK4uc0i1ImaFkStz48PpQfdDmazcONqLyvfKwyMeVX");
  //        $result = $pt->verify_payment($request->payment_reference);
  //        if ($result->response_code == 100) {
  //            // Payment Success
  //        }
  //        return $result;
  //    });
  //    Route::post('/refund_process', function (\Illuminate\Http\Request $request) {
  //        $pt = Paytabs::getInstance("m.sf2009@hotmail.com", "W5hnLejgVyQguQ083at4G88IHjoivQxsVOPH38XYHOecEfkHqOM6WVPEeeWK4uc0i1ImaFkStz48PpQfdDmazcONqLyvfKwyMeVX");
  //        $result = $pt->refund_payment([
  //            'refund_amount' => $request->get('refund_amount'),
  //            'refund_reason' => $request->get('refund_reason'),
  //            'transaction_id' => $request->get('transaction_id'),
  //            'order_id' => $request->get('order_id'),
  //        ]);
  //
  //        return response_api(true, 200, null, $result);
  //    });

  Route::put('user/{id}', 'UserController@resetPasswordDeepLink');


  Route::post('login', 'UserController@access_token');
  Route::post('refresh_token', 'UserController@refresh_token');
  Route::post('user', 'UserController@postUser'); //sign up 
  Route::post('confirm_code', 'UserController@postConfirmCode');
  Route::post('resend_confirm_code', 'UserController@resendConfirmCode');
  Route::post('forget', 'UserController@forget');
  Route::get('categories', 'CategoryController@getCategories');
  Route::get('provider_categories', 'CategoryController@getProviderCategories');
  Route::post('cities', 'CityController@getCities');
  Route::post('contact', 'ContactController@create');
  Route::get('settings/{key}', 'SettingController@getSetting');

  Route::post('/sendCode', 'UserController@sendFPVerificationCode');
  Route::post('/verify', 'UserController@verifyCode');
  Route::post('/resetpassword', 'UserController@resetpassword');


  Route::get('manufacturers', 'VehicleController@getManufacturers');
  Route::get('car_types/{manufacturer_id}', 'VehicleController@getCarTypes');

  //    Route::group(['middleware' => ['auth:api']], function () {
  //        Route::get('profile/{id?}', 'UserController@getProfile');
  //    });
  Route::group(['middleware' => ['auth:api']], function () { //, 'verified'


    Route::post('logout', 'UserController@logout');
    Route::post('userupdate', 'UserController@putUser'); //edit profile
    // Route::post('NewAddress', 'UserController@NewAddress');





    Route::group(['middleware' => ['check-activate']], function () { //, 'verified'

      Route::post('order_status', 'OrderController@changeStatus'); //
      Route::post('request_status', 'ServiceController@changeStatus'); //
      Route::get('order/{id}', 'OrderController@getOrder'); //

    });

    Route::post('notifications', 'NotificationController@getNotifications');
    Route::post('refresh_fcm_token', 'NotificationController@refreshFcmToken');
    Route::delete('notification', 'NotificationController@delete');
    Route::post('chat-notify', 'NotificationController@postChatNotification');
    Route::get('unseen-notification', 'NotificationController@getUnseenNotification');

    Route::post('send_verification_code', 'UserController@sendVerificationCode');
    Route::post('check_change_mobile', 'UserController@checkChangeMobile');


    Route::group(['middleware' => ['client-app']], function () {

      Route::post('product_cart', 'CartController@postProductCart'); //
      Route::get('user_order/{id}', 'OrderController@getUserOrder'); //
      Route::get('cart', 'CartController@getAuthCart'); //
      Route::post('rate', 'RateController@postRate'); //
      Route::post('user_orders', 'OrderController@getOrderClient'); //
      Route::delete('cart/{cart_id}', 'CartController@deleteCart'); //
      Route::delete('product_cart/{product_cart_id}', 'CartController@deleteProductCart'); //
      Route::post('re_add_product_cart', 'CartController@undoProductCartDelete'); //

      Route::group(['middleware' => ['check-activate']], function () { //, 'verified'
        Route::post('direct_order', 'OrderController@addDirectOrder'); //
        Route::post('send_request', 'ServiceController@sendRequest'); //
        Route::post('checkout_cart', 'OrderController@checkoutCart'); //
        Route::post('order', 'OrderController@postOrder'); //
        Route::post('pay_order', 'OrderController@payOneOrder'); //

      });
    });
    Route::group(['middleware' => ['merchant-app']], function () {

      Route::get('drivers/{is_my_driver?}', 'UserController@getDriversList'); //
      Route::post('store_images', 'StoreController@storeImages'); //
      Route::delete('store_image/{id}', 'StoreController@deleteStoreImage'); //

      Route::post('category', 'CategoryController@saveMerchantCategory'); //

    });
    Route::post('requests', 'OrderController@getOrders'); //
    Route::group(['middleware' => ['check-activate']], function () { //, 'verified'
      Route::get('service_request/{id}', 'ServiceController@getServiceRequest'); //
      Route::post('confirm_request', 'OrderController@confirmOrder'); //
    });
    //        Route::group(['middleware' => ['driver-app', 'merchant-app']], function () {
    //
    //        });

    Route::group(['middleware' => ['driver-app']], function () {
      //            dropOff
      Route::post('drop-off', 'OrderController@dropOff'); //

    });
    Route::group(['middleware' => ['service-app']], function () {
      //
      //            addServices
      Route::post('service', 'ServiceController@addService'); //
      Route::put('service/{id}', 'ServiceController@editService'); //
      Route::delete('service/{id}', 'ServiceController@deleteService'); //
      Route::post('service_requests', 'ServiceController@getServiceRequests'); //
      Route::get('service_provider_categories', 'ServiceController@getProviderCategory'); //

    });
  });

  Route::group(['middleware' => 'authGuest:api'], function () {

    // API KEY 425BB3336356AA17EBB1C54BF143F
    // Route::post('POS/category/new' , 'POSController@CategoryNew');
    // Route::post('POS/category/update' , 'POSController@CategoryUpdate');
    Route::post('POS/category/{action}' , 'POSController@CategoryAction');

    // Route::post('POS/product/new' , 'POSController@ProductNew');
    // Route::post('POS/product/update' , 'POSController@ProductUpdate');
    Route::post('POS/product/{action}' , 'POSController@ProductAction');


    Route::get('POS/docs' , 'POSController@docs');

    Route::get('POS/orders' , 'POSController@getorders');

    Route::post('NewAddress', 'UserController@NewAddress');



    Route::get('profile/{id?}', 'UserController@getProfile');
    Route::post('home', 'HomeController@getUserHome'); //
    Route::post('products', 'ProductController@getProducts'); //get products list
    Route::post('merchants', 'UserController@getMerchants'); //get merchants list
    Route::post('merchantCat', 'UserController@getMerchantCat'); //get merchants list
    Route::get('product/{id}', 'ProductController@getProduct'); //product detail
    Route::get('service/{id}', 'ServiceController@getService'); //service detail
    Route::get('merchants', 'UserController@getMerchantsList'); //

    Route::get('Chats/{id}', 'ChatController@getChats'); //Get Chats
    Route::get('Chat/{id}', 'ChatController@getChat'); //Get Chat

    Route::post('Chat/new/{id}', 'ChatController@newChat'); //New Chat
    Route::post('Chat/{id}', 'ChatController@SendMsg'); //New Chat



    Route::post('service_providers', 'UserController@getServiceProviders'); //
    Route::post('services', 'ServiceController@getServices'); //get services list
    Route::post('reviews', 'ServiceController@getReviews'); //get reviews services list



    Route::post('payment' , 'POSController@payment');
    Route::get('payment/success' , 'POSController@payment_success');
    Route::get('payment/cancel' , 'POSController@payment_cancel');
    Route::get('payment/declined' , 'POSController@payment_declined');


    Route::post('order/{action}' , 'POSController@orderAction');
    Route::post('order/{action}' , 'POSController@orderAction');


    Route::post('CheckPromotionCode' , 'POSController@CheckPromotionCode');



  });
});
