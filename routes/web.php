<?php

/*
|--------------------------------------------------------------------------
| Web Routes @l_t{1c_~YQ3
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

use Damas\Paytabs\paytabs;

Route::get('opentime', function(){

    return App\Store::find(83);

});

Route::get('/paytabs_payment', function () {
    $pt = Paytabs::getInstance("m.sf2009@hotmail.com", "W5hnLejgVyQguQ083at4G88IHjoivQxsVOPH38XYHOecEfkHqOM6WVPEeeWK4uc0i1ImaFkStz48PpQfdDmazcONqLyvfKwyMeVX");
    $result = $pt->create_pay_page(array(
        "merchant_email" => "m.sf2009@hotmail.com",
        'secret_key' => "W5hnLejgVyQguQ083at4G88IHjoivQxsVOPH38XYHOecEfkHqOM6WVPEeeWK4uc0i1ImaFkStz48PpQfdDmazcONqLyvfKwyMeVX",
        'title' => "Tareq Doe",
        'cc_first_name' => "Tareq",
        'cc_last_name' => "Doe",
        'email' => "Tareq@email.com",
        'cc_phone_number' => "973",
        'phone_number' => "33333333",
        'billing_address' => "Juffair, Manama, USA",
        'city' => "Manama",
        'state' => "Capital",
        'postal_code' => "97300",
        'country' => "USA",
        'address_shipping' => "Juffair, Manama, USA",
        'city_shipping' => "Manama",
        'state_shipping' => "Capital",
        'postal_code_shipping' => "97300",
        'country_shipping' => "USA",
        "products_per_title" => "Mobile Phone",
        'currency' => "USD",
        "unit_price" => "120",
        'quantity' => "1",
        'other_charges' => "0",
        'amount' => "120.00",
        'discount' => "0",
        "msg_lang" => "english",
        "reference_no" => "1231231",
        "site_url" => url('/'),
        'return_url' => url('result'),
        "cms_with_version" => "API USING PHP"
    ));

    //    if ($result->response_code == 4012) {
    //        return redirect($result->payment_url);
    //    }

    if ($result->response_code == 4012)
        return response_api(true, 200, null, $result);
    return response_api(false, 422, null, $result);
});


Route::get('/', function () {
    return redirect('/site2/home');
});

Route::get('/admin', function () {
    return redirect('/admin/home');
});
Route::get('/404', function () {
    return view('404');
});
Route::get('/403', function () {
    return view('403');
});

Auth::routes();
Route::get('/reset-password', function () {
    return redirect('site2/home');
});


Route::post('/login/web', 'Auth\LoginController@webLogin');
Route::post('/register/web', 'Auth\RegisterController@createWebuser');
Route::get('site/logout/web', 'Auth\LoginController@logout')->name('web.logout');

Route::get('/upload-Alamer', function () {

    exit();

    $curl = curl_init();

    curl_setopt_array($curl, array(
        CURLOPT_URL => "https://shop.alamer-market.com/api/categories/structure",
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_ENCODING => "",
        CURLOPT_TIMEOUT => 30000,
        CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
        CURLOPT_CUSTOMREQUEST => "GET",
        CURLOPT_HTTPHEADER => array(
            // Set Here Your Requesred Headers
            'Content-Type: application/json',
        ),
    ));
    $response = curl_exec($curl);
    $err = curl_error($curl);
    curl_close($curl);

    if ($err) {
        echo "cURL Error #:" . $err;
    } else {

        $response = json_decode($response, true);

        foreach ($response as $data) {

            print_r($data);



            $add = DB::table('product_categories')->insert([
                'name' => $data['title_en'],
                'name_ar' => $data['title_ar'],
                'store_id' => '409',
                'parent_id' =>  $data['parent_id'],
                'description' => $data['id'],
            ]);

            if ($add)
                echo " <span style='color:green;'> Success</span>";
            else
                echo " <span style='color:red;'> Error</span>";

            echo "<br>";
        }
    }
});

Route::get('/upload-Alamer/products', function () {

    exit();

    $curl = curl_init();

    curl_setopt_array($curl, array(
        CURLOPT_URL => "https://shop.alamer-market.com/api/products",
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_ENCODING => "",
        CURLOPT_TIMEOUT => 30000,
        CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
        CURLOPT_CUSTOMREQUEST => "GET",
        CURLOPT_HTTPHEADER => array(
            // Set Here Your Requesred Headers
            'Content-Type: application/json',
        ),
    ));
    $response = curl_exec($curl);
    $err = curl_error($curl);
    curl_close($curl);

    if ($err) {
        echo "cURL Error #:" . $err;
    } else {

        $response = json_decode($response, true);

        foreach ($response as $data) {





            $getCat = DB::table('product_categories')->where('description', $data['category_id'])->get()->last();
            $getCat = json_decode(json_encode($getCat), true);

            $getPro = DB::table('products')->where('name', $data['title_ar'])->get()->last();
            $getPro = json_decode(json_encode($getPro), true);
            if (is_array($getPro))
                continue;
            print_r($data['title_ar']);
            try {

                $add = DB::table('products')->insertGetId([
                    'name' => $data['title_ar'],
                    'price' => $data['price'],
                    'original_quantity' => 1,
                    'available_quantity' => 1,
                    'is_offer' => 0,
                    'is_sponsor' => 0,
                    'admin_is_sponsor' => 0,
                    'has_custom' => 0,
                    'merchant_id' => '409',
                    'category_id' =>  $getCat['id'] == null ? 100 : $getCat['id'],
                    'store_id' => 89,
                    'description' => $data['desc_ar'],
                    'is_active' => 1,
                    'barcode' => $data['barcode'],
                ]);


                $path = $data['img'];
                $imagename = basename($path);


                $file = $path;
                $file_headers = @get_headers($file);
                if (!$file_headers || $file_headers[0] == 'HTTP/1.1 404 Not Found') {
                    $exists = false;
                    echo " <span style='color:blue;'> Success | No Image</span>";
                    echo "<br>";
                    continue;
                }

                $path = file_get_contents($path);

                $filename = base_path('storage/app/products/' . $add);
                $filename100 = base_path('storage/app/products/' . $add . '/100/');
                $filename300 = base_path('storage/app/products/' . $add . '/300/');

                $filename = strval(str_replace("\0", "", $filename));
                $filename100 = strval(str_replace("\0", "", $filename100));
                $filename300 = strval(str_replace("\0", "", $filename300));


                mkdir($filename, 0777, true);
                mkdir($filename100, 0777, true);
                mkdir($filename300, 0777, true);

                file_put_contents($filename . '/' . $imagename, $path);
                file_put_contents($filename100 . '/' . $imagename, $path);
                file_put_contents($filename300 . '/' . $imagename, $path);



                $addImage =  DB::table('product_images')->insert([
                    'product_id' => $add,
                    'image' => $imagename,
                ]);

                if ($add && $addImage)
                    echo " <span style='color:green;'> Success</span>";
                else
                    echo " <span style='color:red;'> Error</span>";
            } catch (Throwable $e) {
                echo " <span style='color:red;'> Error</span>";
            }
            echo "<br>";
            //   break;



        }
    }
});





Route::group(['prefix' => 'site', 'namespace' => 'Site'], function () {


    Route::get('lang/{lang}', function ($lang) {

        if (session()->has('lang'))
            session()->flash('lang');
        session()->put('lang', $lang);
        return redirect()->back();
    });

    Route::get('term', 'HomeController@term');
    Route::get('policy', 'HomeController@policy');

    Route::get('directorder', 'OrderController@directorderpage');
    Route::post('addtoservices', 'ServiceController@addService');
    Route::get('/cities', 'HomeController@cities');
    Route::get('/home', 'HomeController@index');
    Route::get('/about', 'HomeController@about');
    Route::get('/contact', 'HomeController@contact');
    Route::get('/login', 'UserController@login');
    Route::get('/myaccount', 'UserController@profile');
    Route::get('/services', 'ServiceController@list');
    Route::delete('/service/{id}', 'ServiceController@deleteService');
    Route::post('/editservice/{id}', 'ServiceController@editService');
    Route::get('/pay-order/{order_id}', 'OrderController@payOneOrder');

    Route::get('/service-profile', 'ServiceController@service_provider_profile');
    Route::get('/service-profile-view/{provider_id}/{service_id}', 'ServiceController@service_provider_profile_view');
    Route::get('/service-providers/{id}', 'ServiceController@service_providers_list');
    Route::get('/service-providers/{id}/{pagesize}/{currentpage}', 'ServiceController@service_providers_list');

    // Route::get('/merchants', 'MerchantController@list');


    Route::get('/merchants/{pagesize}/{currentpage}', 'MerchantController@list');
    Route::get('/store/{merchant_id}', 'MerchantController@merchantPage');
    Route::get('/merchant-page/{merchant_id}/{pagesize}/{currentpage}', 'MerchantController@merchantPage');
    Route::get('/search/{name}/{cat}/{pagesize}/{currentpage}', 'ProductController@list');
    Route::get('/search/{name}/{cat}', 'ProductController@list');

    Route::get('/products/{type}', 'ProductController@listProducts');
    Route::delete('cart/{cart_id}', 'CartController@deleteCart'); //

    // Route::get('/product-page', 'ProductController@productPage');
    Route::get('/shipping-cart', 'CartController@list');
    Route::get('/order', 'OrderController@list');
    Route::get('/order/{order_id}', 'OrderController@listCheckOut');
    Route::get('/orders-category/{status}', 'OrderController@ordersCategory');
    Route::get('/orders-category/{status}/{from}/{to}', 'OrderController@ordersCategory');

    Route::get('/category/{id}', 'MerchantController@getCategoryMerchant');
    Route::get('/category/{id}/{pagesize}/{currentpage}', 'MerchantController@getCategoryMerchant');
    Route::get('/cart', 'CartController@getAuthCart');
    Route::delete('/product_cart/{cart_product_id}', 'CartController@deleteProductCart');
    Route::post('/addtocart', 'CartController@postProductCart');
    Route::get('/product-page/{id}', 'ProductController@productPage');
    Route::post('/userupdate', 'UserController@userupdate');
    Route::post('/order', 'OrderController@addOrder');
    //  Route::get('/addorder/{id}', 'OrderController@addOrderOneProduct');
    Route::get('/categories', 'ProductController@getCat');

    Route::post('/directorder', 'OrderController@addOrderOneProduct');
    Route::post('/send_request', 'ServiceController@sendRequest');

    Route::post('rate', 'ProductController@sendRate');
    Route::post('sendemail', 'UserController@sendemail');
});


Route::group(['prefix' => 'site2', 'namespace' => 'Site'], function () {


    Route::get('lang/{lang}', function ($lang) {

        if (session()->has('lang'))
            session()->flash('lang');
        session()->put('lang', $lang);
        return redirect()->back();
    });

    Route::get('term', 'HomeController@term');
    Route::get('policy', 'HomeController@policy');

    Route::get('directorder', 'OrderController@directorderpage');
    Route::post('addtoservices', 'ServiceController@addService');
    Route::get('/cities', 'HomeController@cities');
    Route::get('/home', 'HomeController@index');
    Route::get('/about', 'HomeController@about');
    Route::get('/contact', 'HomeController@contact');
    Route::get('/login', 'UserController@login');
    Route::get('/myaccount', 'UserController@profile');
    Route::get('/services', 'ServiceController@list');
    Route::delete('/service/{id}', 'ServiceController@deleteService');
    Route::post('/editservice/{id}', 'ServiceController@editService');
    Route::get('/pay-order/{order_id}', 'OrderController@payOneOrder');

    Route::get('/service-profile', 'ServiceController@service_provider_profile');
    Route::get('/service-profile-view/{provider_id}/{service_id}', 'ServiceController@service_provider_profile_view');
    Route::get('/service-providers/{id}', 'ServiceController@service_providers_list');
    Route::get('/service-providers/{id}/{pagesize}/{currentpage}', 'ServiceController@service_providers_list');
    Route::get('/merchants', 'MerchantController@list');
    Route::get('/merchants/{pagesize}/{currentpage}', 'MerchantController@list');
    Route::get('/merchant-page/{merchant_id}', 'MerchantController@merchantPage');
    Route::get('/merchant-page/{merchant_id}/{pagesize}/{currentpage}', 'MerchantController@merchantPage');
    Route::get('/search/{name}/{cat}/{pagesize}/{currentpage}', 'ProductController@list');
    Route::get('/search/{name}/{cat}', 'ProductController@list');

    Route::get('/products/{type}', 'ProductController@listProducts');
    Route::delete('cart/{cart_id}', 'CartController@deleteCart'); //

    // Route::get('/product-page', 'ProductController@productPage');
    Route::get('/shipping-cart', 'CartController@list');
    Route::get('/order', 'OrderController@list');
    Route::get('/order/{order_id}', 'OrderController@listCheckOut');
    Route::get('/orders-category/{status}', 'OrderController@ordersCategory');
    Route::get('/orders-category/{status}/{from}/{to}', 'OrderController@ordersCategory');

    Route::get('/category/{id}', 'MerchantController@getCategoryMerchant');
    Route::get('/category/{id}/{pagesize}/{currentpage}', 'MerchantController@getCategoryMerchant');
    Route::get('/cart', 'CartController@getAuthCart');
    Route::delete('/product_cart/{cart_product_id}', 'CartController@deleteProductCart');
    Route::post('/addtocart', 'CartController@postProductCart');
    Route::get('/product-page/{id}', 'ProductController@productPage');
    Route::post('/userupdate', 'UserController@userupdate');
    Route::post('/order', 'OrderController@addOrder');
    //  Route::get('/addorder/{id}', 'OrderController@addOrderOneProduct');
    Route::get('/categories', 'ProductController@getCat');

    Route::post('/directorder', 'OrderController@addOrderOneProduct');
    Route::post('/send_request', 'ServiceController@sendRequest');

    Route::post('rate', 'ProductController@sendRate');
    Route::post('sendemail', 'UserController@sendemail');
});


Route::get('/home', 'HomeController@index')->name('home');




Route::group(['namespace' => 'Admin'], function () {

    Route::get('/user/verify/{token}', 'RegisterController@verifyUser');
    Route::get('/user/verify_page', 'RegisterController@verifyingPage');

    Route::prefix('admin')->group(function () {
        Route::get('/login', 'LoginController@showLoginForm')->name('admin.login');
        Route::get('/reset', 'ForgotPasswordController@reset')->name('admin.reset');
        Route::post('/sendCode', 'ForgotPasswordController@sendVerificationCode')->name('admin.sendCode');
        Route::post('/verify', 'ForgotPasswordController@verifyCode')->name('admin.verifyCode');
        Route::post('/resetpassword', 'ForgotPasswordController@resetpassword')->name('admin.resetpassword');
        Route::post('/login', 'LoginController@loginAdmin')->name('admin.login.submit');
        Route::post('/logout', 'LoginController@logout')->name('admin.logout');
        //admin password reset routes
        //https://academy.muva.tech/blog/part-viii-admin-password-reset-in-our-multiple-authentication-system-for-laravel-5-4/
        Route::post('/password/email', 'ForgotPasswordController@sendResetLinkEmail')->name('admin.password.email');
        Route::get('/password/reset', 'ForgotPasswordController@showLinkRequestForm')->name('admin.password.request');
        Route::post('/password/reset', 'ResetPasswordController@reset');
        Route::get('/password/reset/{token}', 'ResetPasswordController@showResetForm')->name('admin.password.reset');
    });
});

Route::get('admin/drivers-data/{merchant_id}', 'UserController@merchantDriverData');
//Route::get('merchant/store/products-data', 'ProductController@productData');
//Route::get('merchant/store/add-product-images/{id}', 'ProductController@getProductImages');
Route::delete('merchant/store/product/delete-image/{id}', 'ProductController@deleteProductImage');

// حذف صورة المنتج من خلال الإدارة
Route::delete('merchant/product/delete-image/{id}', 'ProductController@deleteProductImage');

Route::group(['prefix' => 'admin', 'middleware' => 'admin'], function () {

    Route::put('/adv-approve', 'AdvertisementController@approve');

    Route::get('invoice/{orderId}', 'OrderController@viewInvoice');
    Route::get('addPermission', 'PermissionController@addPermission');
    Route::post('addPermission', 'PermissionController@postAddPermission');
    Route::get('/home', 'HomeController@index');

    Route::post('/orders-cities', 'HomeController@ordersCities');
    Route::post('/new-products', 'HomeController@newProducts');
    Route::post('/latest-merchants', 'HomeController@latestMerchants');
    Route::post('/revenue-orders', 'HomeController@revenueOrder');

    Route::get('/admin-profile', 'AdminController@adminProfile');
    Route::put('/admin-profile', 'AdminController@editAdminProfile');
    Route::put('/admin-status', 'AdminController@adminActive');
    Route::post('/merchants', 'UserController@getMerchants');
    Route::post('merchantCat', 'UserController@getMerchantCat');
    Route::get('Products/{id?}', 'UserController@getProductByCat');



    foreach (\App\Permission::all() as $permission) {
        if ($permission->type == 'get')
            Route::get('/' . $permission->alias . '/' . $permission->name, ['middleware' => ['permission:' . $permission->name], 'uses' => $permission->controller_name . '@' . $permission->function_name]);
        if ($permission->type == 'post')
            Route::post($permission->alias . '/' . $permission->name, ['middleware' => ['permission:' . $permission->name], 'uses' => $permission->controller_name . '@' . $permission->function_name]);
        if ($permission->type == 'put')
            Route::put($permission->alias . '/' . $permission->name, ['middleware' => ['permission:' . $permission->name], 'uses' => $permission->controller_name . '@' . $permission->function_name]);
        if ($permission->type == 'delete')
            Route::delete($permission->alias . '/' . $permission->name, ['middleware' => ['permission:' . $permission->name], 'uses' => $permission->controller_name . '@' . $permission->function_name]);
    }

    //    Route::get('/role/roles', ['middleware' => 'permission:roles', 'uses' => 'RoleController@roles']);

    //    Route::group(['prefix' => 'role'], function () {
    //        //Roles
    //        Route::get('/roles', 'RoleController@roles');
    //        Route::get('/role-data', 'RoleController@roleData');
    ////        Route::get('/add-role', 'RoleController@addRole');
    ////        Route::post('/add-role', 'RoleController@postAddRole');
    ////        Route::get('/edit-role/{id}', 'RoleController@editRole');
    ////        Route::put('/edit-role/{id}', 'RoleController@putRole');
    ////        Route::delete('/delete-role/{id}', 'RoleController@delete');
    //        Route::get('/add-permission-role/{role_id}', 'PermissionController@addPermissionRole');
    //        Route::post('add-permission-role/{role_id}', 'PermissionController@postAddRolePermissions');
    //        Route::get('permission-role/{role_id}', 'PermissionController@getPermissionRole');
    //////
    ////
    //    });

    Route::get('/abouts', 'AboutController@index');
    Route::get('/about-data', 'AboutController@anyData');

    Route::get('/abouts/{id}/edit', 'AboutController@edit');
    Route::put('/abouts/{id}/edit', 'AboutController@update');
    Route::get('/abouts/create', 'AboutController@create');
    Route::post('/abouts/create', 'AboutController@store');
    Route::delete('/abouts/delete/{id}', 'AboutController@delete');

    Route::get('/term', 'TermController@term');
    Route::put('/term/edit', 'TermController@updateTerm');

    Route::get('/policy', 'TermController@policy');
    Route::put('/policy/edit', 'TermController@updatePolicy');

    Route::get('/advertisements', 'AdvertisementController@index');
    Route::get('/advertisement-data', 'AdvertisementController@anyData');
    Route::get('/advertisements/create', 'AdvertisementController@create');
    Route::post('/advertisements/create', 'AdvertisementController@store');
    Route::get('/advertisements/{id}/edit', 'AdvertisementController@edit');
    Route::post('/advertisements/{id}/edit', 'AdvertisementController@update');
    Route::delete('/advertisements/delete/{id}', 'AdvertisementController@delete');

    Route::get('/promotion-codes', 'PromotionCodesController@index');
    Route::get('/promotion-codes-data', 'PromotionCodesController@anyData');
    Route::get('/promotion_codes/create', 'PromotionCodesController@create');
    Route::post('/promotion_codes/create', 'PromotionCodesController@store');
    Route::get('/promotion_codes/{id}/edit', 'PromotionCodesController@edit');
    Route::post('/promotion_codes/{id}/edit', 'PromotionCodesController@update');
    Route::delete('/promotion_codes/delete/{id}', 'PromotionCodesController@delete');
    Route::put('/promotion_codes/approve', 'PromotionCodesController@approve');


    Route::get('/admins-data', 'AdminController@adminData');
    Route::get('/admin/create', 'AdminController@createAdmin');

    //    Route::post('/admin/store', 'AdminController@storeAdmin');
    Route::get('/admin/{id}/edit', 'AdminController@editAdmin');
    //    Route::put('/admin/{id}', 'AdminController@updateAdmin');
    Route::get('/admin/{id}', 'AdminController@adminDet');
    //    Route::get('/merchants-list', 'AdminController@merchantList'); //unused
    //    Route::get('/merchant-data', 'AdminController@merchantData'); //unused
    //    Route::get('/merchant-data', 'UserController@merchantData');
    //    Route::post('/merchant', 'AdminController@storeMerchant');
    //    Route::put('/merchant/{id}', 'AdminController@updateMerchant');

    //    Route::put('/merchant-activation', 'AdminController@merchantActive'); // unused
    Route::get('/merchant/{id}/edit', 'AdminController@editMerchant');
    Route::get('/merchant/{id}', 'AdminController@merchantDet');
    Route::get('/merchant-create', 'AdminController@createMerchant');


    //    Route::post('/add-merchant-category/{merchant_id}', 'AdminController@addMerchantCategory');
    //    Route::delete('/merchant-category/{category_id}', 'AdminController@deleteMerchantCategory');

    //    Route::post('/add-delivery-method', 'AdminController@merchantDeliveryMethod');


    //    Route::get('/users-list', 'UserController@userList');
    Route::get('/user-data', 'UserController@userData');

    Route::get('/merchant-shipment-data/{merchant_id}', 'UserController@merchantShipmentData');
    Route::get('/merchant-category-data/{merchant_id}', 'UserController@merchantCategoryData');

    //    Route::get('/driver-data', 'UserController@driverData');

    Route::get('/users/user/{id}', 'UserController@userDet');
    Route::get('/users/user-det/{id}', 'UserController@getUserDet');
    //    Route::put('/user-activation', 'UserController@userActive');
    Route::put('/user/verify-email', 'UserController@verifyEmail');

    Route::get('users/user-driver/create', 'UserController@addDriver');
    //    Route::post('/user-driver/create', 'UserController@createDriver');
    Route::get('users/user-driver/{id}/edit', 'UserController@editDriver');
    //    Route::put('/user-driver/{id}/edit', 'UserController@updateDriver');

    Route::get('/service-provider/create', 'UserController@addServiceProvider');

    //    Route::get('/provider-data', 'UserController@serviceProviderData');
    //    Route::post('/service_provider/create', 'UserController@createServiceProvider');

    Route::get('/car-types/{manufacture_id}', 'VehicleController@getCarTypes');

    //    Route::get('/revenues-list', 'OrderController@revenues');
    Route::get('/revenue-orders-data', 'OrderController@revenueOrdersData');

    //    Route::get('/expenses', 'ExpenseController@index');
    Route::get('/expenses-data', 'ExpenseController@expensesData');

    Route::get('/expense/create', 'ExpenseController@create');
    Route::get('/expense/{id}/edit', 'ExpenseController@edit');
    //    Route::post('/expense/{id?}', 'ExpenseController@saveExpense');
    //    Route::delete('/expense/{id}', 'ExpenseController@delete');

    Route::get('/order_product/customs/{id}', 'OrderController@viewProductCustomsMdl');
    Route::get('/order_product/cancel/{id}', 'OrderController@viewCancelProductMdl');
    Route::put('/order_product/cancel/{id}', 'OrderController@cancelProduct');
    //    Route::get('/orders-list', 'OrderController@orderList');
    Route::get('/orders-data/{status}', 'OrderController@ordersData');

    //    Route::get('/order/{id}', 'OrderController@orderDet');
    Route::get('/orders/{type}', 'OrderController@ordersByType');
    Route::get('/following_up', 'OrderController@orderFollowingUp');
    Route::get('/following_up_data', 'OrderController@orderFollowingUpData');

    Route::get('/report-orders-data/{status}', 'OrderController@reportOrdersData');
    Route::get('/client-orders-data/{client_id}', 'OrderController@clientOrdersData');
    Route::get('/merchant-orders-data/{merchant_id}', 'OrderController@merchantOrdersData');

    Route::post('/profile/{id?}', 'UserController@putProfile');

    //    Route::get('stores', 'StoreController@index');
    Route::get('stores-data', 'StoreController@storeData');
    Route::get('stores/create', 'StoreController@create');
    //    Route::post('stores', 'StoreController@store');
    Route::get('stores/{id}/edit', 'StoreController@edit');
    //    Route::put('stores/{id}', 'StoreController@update');
    //    Route::delete('stores/{id}', 'StoreController@delete');
    //    Route::delete('store-image/{id}', 'StoreController@deleteStoreImage'); // unused


    Route::get('/category/create', 'CategoryController@create');
    Route::get('/service-category/create', 'CategoryController@service_create');
    Route::get('/category/{id}/edit', 'CategoryController@edit');
    Route::get('/service-category/{id}/edit', 'CategoryController@service_edit');
    // Route::delete('/category/{id}', 'CategoryController@deleteCategory');
    //    Route::delete('/service-category/{id}', 'CategoryController@deleteServiceCategory');
    //    Route::get('/constant/categories', 'CategoryController@categories');
    Route::get('/categories-data', 'CategoryController@categoriesData');
    Route::get('/services-categories-data', 'CategoryController@anyProviderData');

    Route::get('/constant/category/{id}', 'CategoryController@getCategory');
    Route::post('/category/{id?}', 'CategoryController@saveCategory');
    Route::delete('/category/{id}', 'CategoryController@deleteCategory');
    Route::get('/category/restore/{id}', 'CategoryController@restoreCategory');


    Route::post('/service-category/{id?}', 'CategoryController@saveServiceCategory');
    Route::delete('/service-category/{id}', 'CategoryController@deleteServiceCategory');

    Route::get('/customization/create', 'CustomizationController@create');
    Route::get('/customization/{id}/edit', 'CustomizationController@edit');
    //    Route::delete('/constant/customization/{id}', 'CustomizationController@deleteCustomization');

    //    Route::get('/constant/customizations', 'CustomizationController@customizations');
    Route::get('/constant/customizations-data', 'CustomizationController@customizationsData');
    Route::get('/constant/customization/{id}', 'CustomizationController@getCustomization');
    //    Route::post('/constant/customization/{id?}', 'CustomizationController@saveCustomization');

    Route::get('/shipment/create', 'ShipmentController@create');
    Route::get('/shipment/{id}/edit', 'ShipmentController@edit');
    //    Route::delete('/shipment/{id}', 'ShipmentController@delete');
    //    Route::get('/constant/shipments', 'ShipmentController@index');
    Route::get('/constant/shipments-data', 'ShipmentController@shipmentsData');
    Route::get('/constant/shipment/{id}', 'ShipmentController@getShipment');
    //    Route::post('/shipment/{id?}', 'ShipmentController@saveShipment');


    Route::get('/contacts', 'ContactController@contacts'); // ??
    Route::post('/reply-contact/{id}', 'ContactController@reply'); // ??
    Route::get('/contacts-data', 'ContactController@anyData'); // ??

    //    Route::get('/constant/list', 'SettingController@index'); //
    //    Route::get('/constant/list-data', 'SettingController@anyData'); //

    Route::post('/general-notification/create', 'NotificationController@sendPublicNotification');
    Route::get('constant/explanations', 'SettingController@explanation');
    Route::put('constant/explanation/{id}', 'SettingController@update');


    Route::get('/store/products-data', 'ProductController@productData');
    Route::put('/change-product-status/{product_id}', 'ProductController@changeStatus');

    //    Route::get('/sponsor-requests', 'ProductController@sponsorRequests');
    Route::get('/sponsor-requests-data', 'ProductController@sponsorRequestsData');
    //    Route::put('/change-product-sponsor/{id}', 'ProductController@changeSponsorStatus');

    Route::get('/store/product-images/{id}', 'ProductController@productImagesEdit');
    Route::post('/store/add-product-images/{id}', 'ProductController@productImages');
    Route::get('/store/add-product-images/{id}', 'ProductController@getProductImages');

    Route::put('/cancel-order/{id}', 'OrderController@canceledOrder');
    //    Route::get('/user/{id}', 'UserController@userDet');


    Route::get('/assign-driver/{order_id}', 'OrderController@getAssignDriver');
    Route::put('/assign-driver', 'OrderController@assignDriver');

    //    Route::get('/notifications/list', 'NotificationController@index');
    Route::get('/notification-data', 'NotificationController@anyData');
    //    Route::delete('/notification/{id}', 'NotificationController@delete');

    Route::get('/product/{id}/edit', 'ProductController@edit');
    Route::put('/product/{id}', 'ProductController@update');
    Route::delete('/product/{id}', 'ProductController@delete');
    Route::put('/undo-delete-product/{product_id}', 'ProductController@undo_delete_product');
    Route::post('/{Mid?}/product', 'ProductController@store');

    Route::get('/{id?}/product/create', 'ProductController@create');

    Route::post('/add-product-images/{id}', 'ProductController@productImages');
    Route::get('/add-product-images/{id}', 'ProductController@getProductImages');

    Route::delete('/product/delete-image/{id}', 'ProductController@deleteProductImage');
});


// Route::group(['prefix' => 'merchant', 'middleware' => 'merchant'], function () {
// putenv('Version=aaaa');
//
//
// });



Route::group(['prefix' => 'merchant', 'middleware' => 'merchant'], function () {

    new Version();

    Route::get('/home', 'MerchantController@index');
    Route::get('/store', 'StoreController@merchantStore');
    Route::post('/store', 'StoreController@saveMerchantStore');

    Route::post('/store/new', 'StoreController@saveMerchantStore');
    Route::post('/store/{id}', 'StoreController@saveMerchantStore');
    Route::get('/store/{id}/delete', 'StoreController@delete');
    Route::get('/store/{id}/recover', 'StoreController@recover');
    Route::get('/Map/{id}', 'UserController@Map');



    Route::get('/store/images', 'StoreController@getStoreImages');
    Route::post('/store/images', 'StoreController@storeImages');
    Route::delete('/store/delete-image/{id}', 'StoreController@deleteStoreImage');

    Route::get('/store/products-data', 'ProductController@productMerchantData');
    Route::put('/undo-delete-product/{product_id}', 'ProductController@undo_delete_product');
    Route::get('/store/product-images/{id}', 'ProductController@productImagesEdit');

    Route::get('/car-types/{manufacture_id}', 'VehicleController@getCarTypes');

    Route::get('/products', 'ProductController@index');
    Route::get('/product/create', 'ProductController@create');
    Route::get('/product/{id}/edit', 'ProductController@editMerchantProduct');
    Route::post('/product/{id?}', 'ProductController@store');

    Route::put('/store/product-offer', 'ProductController@setOffer');
    Route::put('/store/product-sponsor', 'ProductController@setSponsor');

    Route::post('/add-product-images/{id}', 'ProductController@productImages');
    Route::get('/add-product-images/{id}', 'ProductController@getProductImages');

    Route::post('store/add-product-images/{id}', 'ProductController@productImages');
    Route::get('store/add-product-images/{id}', 'ProductController@getProductImages');

    Route::get('/product/{id}/edit', 'ProductController@edit');
    Route::put('/product/{id}', 'ProductController@update');
    Route::delete('/product/{id}', 'ProductController@delete');

    Route::get('/notifications', 'NotificationController@index');
    Route::get('/notification-data', 'NotificationController@anyData');
    Route::delete('/notification/{id}', 'NotificationController@delete');


    Route::get('/shipments', 'ShipmentController@index');
    Route::get('/shipment/create', 'ShipmentController@create');
    Route::get('/shipment/{id}/edit', 'ShipmentController@edit');
    Route::delete('/shipment/{id}', 'ShipmentController@delete');
    Route::get('/constant/shipments-data', 'ShipmentController@shipmentsData');
    Route::get('/constant/shipment/{id}', 'ShipmentController@getShipment');
    Route::post('/shipment/{id?}', 'ShipmentController@saveShipment');
    //    Route::get('/shipments', 'ShipmentController@index');
    //    Route::get('/shipment/shipments-data', 'ShipmentController@shipmentData');
    //    Route::get('/shipment/{id}/edit', 'ShipmentController@edit');
    //    Route::get('/shipment/create', 'ShipmentController@create');
    //    Route::post('/shipment', 'ShipmentController@store');
    //    Route::put('/shipment/{id}', 'ShipmentController@update');
    //    Route::delete('/shipment/{id}', 'ShipmentController@delete');
    //    Route::get('/user-det/{id}', 'UserController@getUserDet');

    Route::get('/user-data', 'UserController@userData');
    Route::put('/users/user-activation', 'UserController@userActive');
    Route::put('/user/verify-email', 'UserController@verifyEmail');
    Route::get('/user/{id}', 'UserController@userDet');
    Route::get('/user-det/{id}', 'UserController@getUserDet');


    Route::get('/drivers-list', 'UserController@driverMerchantList');
    Route::get('/driver-data', 'UserController@driverData');
    Route::get('/user-driver/create', 'UserController@addDriver');
    Route::post('/user-driver/create', 'UserController@createDriver');

    Route::get('/user-driver/{id}/edit', 'UserController@editDriver');
    Route::put('/user-driver/{id}/edit', 'UserController@updateDriver');

    Route::get('/profile', 'UserController@merchantProfile');
    Route::post('/profile', 'UserController@putProfile');

    Route::put('/cancel-order/{id}', 'OrderController@canceledOrder');

    Route::get('/accept-order/{id}', 'OrderController@viewOrderAcceptMdl');
    Route::put('/accept-order/{id}', 'OrderController@acceptOrder');
    Route::get('/ready-order/{id}', 'OrderController@viewOrderReadyMdl');
    Route::put('/ready-order/{id}', 'OrderController@readyOrder');
    Route::get('/handover-order/{id}', 'OrderController@viewOrderHandOverMdl');
    Route::put('/handover-order/{id}', 'OrderController@handOverOrder');
    Route::get('/order_product/customs/{id}', 'OrderController@viewProductCustomsMdl');
    Route::get('/order_product/cancel/{id}', 'OrderController@viewCancelProductMdl');
    Route::put('/order_product/cancel/{id}', 'OrderController@cancelProduct');
    Route::get('drivers/{is_my_driver?}', 'UserController@getDriversList'); //

    //    Route::get('/revenues-list', 'OrderController@revenuesMerchant');
    //    Route::get('/expenses-list', 'OrderController@expensesMerchant');

    Route::get('/orders-list', 'OrderController@orderListMerchant');
    Route::get('/order/{id}', 'OrderController@orderDetMerchant');
    Route::get('/orders', 'OrderController@ordersByTypeMerchant');

    Route::get('/notifications', 'NotificationController@index');
    Route::get('/notification-data', 'NotificationController@anyData');
    Route::delete('/notification/{id}', 'NotificationController@delete');


    Route::get('/category/private/create', 'CategoryController@addMerchantPrivateCategory');
    Route::post('/category/private', 'CategoryController@postMerchantPrivateCategory');

    Route::get('/category/create', 'CategoryController@addMerchantCategory');
    Route::get('/category/{id}/edit', 'CategoryController@edit');
    Route::delete('/category/{id}', 'CategoryController@deleteCategory');
    Route::get('/categories', 'CategoryController@categoriesMerchant');
    Route::get('/categories-data', 'CategoryController@categoriesMerchantData');
    Route::get('/category/{id}', 'CategoryController@getCategory');
    Route::post('/category', 'CategoryController@postMerchantCategory');


    Route::get('/report-orders-data/{status}', 'OrderController@reportOrdersData');

    // dashboard
    Route::post('/orders-cities', 'HomeController@ordersCities');
    Route::post('/top-selling', 'HomeController@topSellings');
    Route::post('/sale-products', 'HomeController@saleProducts');
    Route::get('invoice/{orderId}', 'OrderController@viewInvoice');



    Route::get('/advertisements', 'AdvertisementController@index');
    Route::get('/advertisement-data', 'AdvertisementController@anyData');
    Route::get('/advertisements/create', 'AdvertisementController@create');
    Route::post('/advertisements/create', 'AdvertisementController@store');
    Route::get('/advertisements/{id}/edit', 'AdvertisementController@edit');
    Route::put('/advertisements/{id}/edit', 'AdvertisementController@update');
    Route::delete('/advertisements/delete/{id}', 'AdvertisementController@delete');



    Route::group(['prefix' => 'V2', 'middleware' => 'merchant'], function () {

        new Version('V2');


        Route::get('home', 'MerchantController@index');
        Route::get('/store', 'StoreController@merchantStore');
        Route::post('/store', 'StoreController@saveMerchantStore');

        Route::post('/store/new', 'StoreController@saveMerchantStore');
        Route::post('/store/{id}', 'StoreController@saveMerchantStore');
        Route::get('/store/{id}/delete', 'StoreController@delete');
        Route::get('/store/{id}/recover', 'StoreController@recover');
        Route::get('/Map/{id}', 'UserController@Map');



        Route::get('/store/images', 'StoreController@getStoreImages');
        Route::post('/store/images', 'StoreController@storeImages');
        Route::delete('/store/delete-image/{id}', 'StoreController@deleteStoreImage');

        Route::get('/store/products-data', 'ProductController@productMerchantData');
        Route::put('/undo-delete-product/{product_id}', 'ProductController@undo_delete_product');
        Route::get('/store/product-images/{id}', 'ProductController@productImagesEdit');

        Route::get('/car-types/{manufacture_id}', 'VehicleController@getCarTypes');

        Route::get('/products', 'ProductController@index');
        Route::get('/product/create', 'ProductController@create');
        Route::get('/product/{id}/edit', 'ProductController@editMerchantProduct');
        Route::post('/product/{id?}', 'ProductController@store');

        Route::put('/store/product-offer', 'ProductController@setOffer');
        Route::put('/store/product-sponsor', 'ProductController@setSponsor');

        Route::post('/add-product-images/{id}', 'ProductController@productImages');
        Route::get('/add-product-images/{id}', 'ProductController@getProductImages');

        Route::post('store/add-product-images/{id}', 'ProductController@productImages');
        Route::get('store/add-product-images/{id}', 'ProductController@getProductImages');

        Route::get('/product/{id}/edit', 'ProductController@edit');
        Route::put('/product/{id}', 'ProductController@update');
        Route::delete('/product/{id}', 'ProductController@delete');

        Route::get('/notifications', 'NotificationController@index');
        Route::get('/notification-data', 'NotificationController@anyData');
        Route::delete('/notification/{id}', 'NotificationController@delete');


        Route::get('/shipments', 'ShipmentController@index');
        Route::get('/shipment/create', 'ShipmentController@create');
        Route::get('/shipment/{id}/edit', 'ShipmentController@edit');
        Route::delete('/shipment/{id}', 'ShipmentController@delete');
        Route::get('/constant/shipments-data', 'ShipmentController@shipmentsData');
        Route::get('/constant/shipment/{id}', 'ShipmentController@getShipment');
        Route::post('/shipment/{id?}', 'ShipmentController@saveShipment');
        //    Route::get('/shipments', 'ShipmentController@index');
        //    Route::get('/shipment/shipments-data', 'ShipmentController@shipmentData');
        //    Route::get('/shipment/{id}/edit', 'ShipmentController@edit');
        //    Route::get('/shipment/create', 'ShipmentController@create');
        //    Route::post('/shipment', 'ShipmentController@store');
        //    Route::put('/shipment/{id}', 'ShipmentController@update');
        //    Route::delete('/shipment/{id}', 'ShipmentController@delete');
        //    Route::get('/user-det/{id}', 'UserController@getUserDet');

        Route::get('/user-data', 'UserController@userData');
        Route::put('/users/user-activation', 'UserController@userActive');
        Route::put('/user/verify-email', 'UserController@verifyEmail');
        Route::get('/user/{id}', 'UserController@userDet');
        Route::get('/user-det/{id}', 'UserController@getUserDet');


        Route::get('/drivers-list', 'UserController@driverMerchantList');
        Route::get('/driver-data', 'UserController@driverData');
        Route::get('/user-driver/create', 'UserController@addDriver');
        Route::post('/user-driver/create', 'UserController@createDriver');

        Route::get('/user-driver/{id}/edit', 'UserController@editDriver');
        Route::put('/user-driver/{id}/edit', 'UserController@updateDriver');

        Route::get('/profile', 'UserController@merchantProfile');
        Route::post('/profile', 'UserController@putProfile');

        Route::put('/cancel-order/{id}', 'OrderController@canceledOrder');

        Route::get('/accept-order/{id}', 'OrderController@viewOrderAcceptMdl');
        Route::put('/accept-order/{id}', 'OrderController@acceptOrder');
        Route::get('/ready-order/{id}', 'OrderController@viewOrderReadyMdl');
        Route::put('/ready-order/{id}', 'OrderController@readyOrder');
        Route::get('/handover-order/{id}', 'OrderController@viewOrderHandOverMdl');
        Route::put('/handover-order/{id}', 'OrderController@handOverOrder');
        Route::get('/order_product/customs/{id}', 'OrderController@viewProductCustomsMdl');
        Route::get('/order_product/cancel/{id}', 'OrderController@viewCancelProductMdl');
        Route::put('/order_product/cancel/{id}', 'OrderController@cancelProduct');
        Route::get('drivers/{is_my_driver?}', 'UserController@getDriversList'); //

        //    Route::get('/revenues-list', 'OrderController@revenuesMerchant');
        //    Route::get('/expenses-list', 'OrderController@expensesMerchant');

        Route::get('/orders-list', 'OrderController@orderListMerchant');
        Route::get('/order/{id}', 'OrderController@orderDetMerchant');
        Route::get('//orders', 'OrderController@ordersByTypeMerchant');

        Route::get('/notifications', 'NotificationController@index');
        Route::get('/notification-data', 'NotificationController@anyData');
        Route::delete('/notification/{id}', 'NotificationController@delete');


        Route::get('/category/private/create', 'CategoryController@addMerchantPrivateCategory');
        Route::post('/category/private', 'CategoryController@postMerchantPrivateCategory');

        Route::get('/category/create', 'CategoryController@addMerchantCategory');
        Route::get('/category/{id}/edit', 'CategoryController@edit');
        Route::delete('/category/{id}', 'CategoryController@deleteCategory');
        Route::get('/categories', 'CategoryController@categoriesMerchant');
        Route::get('/categories-data', 'CategoryController@categoriesMerchantData');
        Route::get('/category/{id}', 'CategoryController@getCategory');
        Route::post('/category', 'CategoryController@postMerchantCategory');
        Route::post('/category/{id?}', 'CategoryController@saveCategory');

        Route::get('/report-orders-data/{status}', 'OrderController@reportOrdersData');

        // dashboard
        Route::post('/orders-cities', 'HomeController@ordersCities');
        Route::post('/top-selling', 'HomeController@topSellings');
        Route::post('/sale-products', 'HomeController@saleProducts');
        Route::get('invoice/{orderId}', 'OrderController@viewInvoice');



        Route::get('/advertisements', 'AdvertisementController@index');
        Route::get('/advertisement-data', 'AdvertisementController@anyData');
        Route::get('/advertisements/create', 'AdvertisementController@create');
        Route::post('/advertisements/create', 'AdvertisementController@store');
        Route::get('/advertisements/{id}/edit', 'AdvertisementController@edit');
        Route::put('/advertisements/{id}/edit', 'AdvertisementController@update');
        Route::delete('/advertisements/delete/{id}', 'AdvertisementController@delete');
    });
});





Route::get('user/{id}', 'DeepLinkController@redirectDeepLink');


Route::post('result-data', 'PaymentController@resultPayNow');
Route::get('result-data', function () {
    return $_GET['action'];
});
