<?php
/**
 * Created by PhpStorm.
 * UserRequest: mohammedsobhei
 * Date: 9/5/19
 * Time: 2:50 AM
 */

use App\ProductCategory;
use App\ProviderCategory;
use App\User;
use App\City;

class Version{

  public static $xx = '';
  public static $ee = '.';
    public function __construct($opr = null , $ee = ".")
      {
        self::$xx = $opr != null ? $opr :   self::$xx ;
        self::$ee = $ee ;

        return self::$ee.  self::$xx;
      }

      public function getVer()
      {
        return self::$ee.  self::$xx;
      }

}

 function getVersion()
{
  return (new Version())->getVer();
}

function cities()
{
    return city::all();
}


function merchants()
{
    return User::where('type', 'merchant')->where('is_active', 1)->get();
}

function Categories()
{
    return ProductCategory::all();
}

function Services()
{
    return ProviderCategory::all();
}

function getAuth()
{
    return auth()->guard('admin')->user();
}

function current_view()
{
    $vw = admin_constants_vw();
//    $url = admin_constant_url();
    if (getAuth()->type == 'merchant') {
        $vw = merchant_constants_vw();
//        $url = merchant_constant_url();
    }

    return $vw;
}

function current_url()
{
//    $vw = admin_constants_vw();
    $url = admin_constant_url();
    if (getAuth()->type == 'merchant') {
//        $vw = merchant_constants_vw();
        $url = merchant_constant_url();
    }

    return $url;
}

//Our generate verification code function.
function generateVerificationCode($digits = 4)
{
    $i = 0; //counter
    $pin = ""; //our default pin is blank.
    while ($i < $digits) {
        //generate a random number between 0 and 9.
        $pin .= mt_rand(0, 9);
        $i++;
    }
    return $pin;
}

function dashboard()
{
    return 'Dashboard';
}

function admin_vw()
{
    return 'admin';
}

function modals($page)
{
    return 'admin.modals.' . $page;
}

function admin_dashboard_url()
{
    return '/admin/home';
}

function admin_login_url()
{
    return '/admin/login';
}

function admin_user_tab_url()
{
    return '/admin/users';
}

function admin_abouts_vw()
{
    return admin_vw() . '.abouts';
}

function admin_abouts_url()
{
    return admin_vw() . '/abouts';
}

function admin_terms_vw()
{
    return admin_vw() . '.terms';
}

function admin_terms_url()
{
    return admin_vw() . '/term';
}

function admin_polices_url()
{
    return admin_vw() . '/policy';
}

function admin_adv_tab_url()
{
    return getAuth()->type . '/advertisements';
}

function admin_promotion_tab_url()
{
    return getAuth()->type . '/promotion_codes';
}

function admin_report_tab_url()
{
    return '/admin/reports';
}

//function admin_report_tab_url()
//{
//    return '/admin/settings';
//}

function admin_sponsor_tab_url()
{
    return '/admin/sponsors';
}

function admin_notification_tab_url()
{
    return '/admin/notifications';
}

function merchant_dashboard_url()
{
    return '/merchant/home';
}

function admin_stores_url()
{
    return '/admin/stores';
}

function admin_stores_vw()
{
    return 'admin.stores';
}

function admin_manage_url()
{
    return 'admin/manage';
}

function admin_role_url()
{
    return 'admin/role';
}

function lang_app_site()
{
    return 'app.site';
}

function admin_users_vw()
{
    return 'admin.users';
}

function merchant_users_vw()
{
    return merchant_vw().'.users';
}

function merchant_vw()
{
    return 'merchant.V2';
    // return 'merchant'.(new Version())->getVer();
}

function merchant_vw_1()
{
    return 'merchant';
    // return 'merchant'.(new Version())->getVer();
}

function merchant_store_vw()
{
    return merchant_vw().'.store';
}

function merchant_store_url()
{
    return 'merchant/store';
}

function admin_order_vw()
{
    return 'admin.orders';
}

function admin_order_url()
{
    return 'admin/orders';
}

function merchant_order_vw()
{
    return merchant_vw().'.orders';
}

function merchant_order_url()
{
    return merchant_url().'/orders';
}

function admin_revenue_vw()
{
    return 'admin.revenues';
}

function admin_revenue_url()
{
    return 'admin/revenues';
}

function merchant_revenue_vw()
{
    return merchant_vw().'.revenues';
}

function merchant_revenue_url()
{
    return merchant_vw().'/revenues';
}

function merchant_expense_vw()
{
    return merchant_vw().'.expenses';
}

function merchant_expense_url()
{
    return merchant_url().'/expenses';
}

function merchant_url()
{
    return 'merchant'.(new Version(null , '/'))->getVer();
}

function admin_constants_vw()
{
    return 'admin.constants';
}

function admin_constant_url()
{
    return 'admin/settings/constant';
}

function merchant_constants_vw()
{
    return merchant_vw().'.constants';
}

function admin_notification_url()
{
    return 'admin/notification';
}

function admin_notification_vw()
{
    return 'admin.notifications';
}

function merchant_constant_url()
{
    return merchant_url().'/constant';
}

function admin_admins_vw()
{
    return 'admin.admins';
}

function admin_merchants_vw()
{
    return 'admin.merchants';
}

function admin_merchants_url()
{
    return 'admin/merchant';
}

function admin_setting_url()
{
    return 'admin/settings';
}

function admin_settings_vw()
{
    return 'admin.settings';
}

function site_url()
{
    return 'site';
}

function api_url()
{
    return 'api/v1';
}

function site_vw()
{
    return 'site';
}

function site_sub_view_vw()
{
    return 'site.sub_view';
}

function site_layout_vw()
{
    return 'site.layout';
}

function admin_role_vw()
{
    return admin_admins_vw() . '.role';
}

function admin_permission_vw()
{
    return admin_admins_vw() . '.permission';
}

function version_api()
{
    return '/v1';
}

function namespace_api()
{
    return 'Api\V1';
}

function google_api_key()
{
    return 'AIzaSyC7ax66Fm7Kpibq6p-e9yPil-9stOvndsc';

//    return 'AIzaSyBWvg7pVxiwybFKR89SiHPCIXGdgG808FU';
}

function public_url()
{
    return url('public/');
}

function upload_url()
{
    return base_path() . '/assets/upload';
}

function upload_assets()
{
    return url('/assets/upload');
}

function upload_storage()
{
    return storage_path('app');
}

function loader_icon()
{
    return url('assets/admin/layout/img/preloader.gif');
}

function user_vw()
{
    return 'user';
}

function max_pagination($record = 10.0)
{
    return $record;
}

function admin_layout_vw()
{
    return 'admin.layout';
}

function merchant_layout_vw()
{
    return merchant_vw().'.layout';
}

function admin_assets_vw()
{
    return 'assets/admin';
}

function notification_trans()
{
    return 'app.notification_message';
}


function message($status_code)
{
    switch ($status_code) {
        case 200:
            return trans('app.success');
        case 400:
            return trans('app.not_data_found');
        case 401:
            return trans('app.invalid_token');
        case 404:
            return trans('app.invalid_route');
        case 422:
            return trans('app.client_input_error');//'Client input error.';
        case 500:
            return trans('app.server_error');//'Something went wrong. Please try again later.';
    }
    return 'Sorry! You do not have permission.';
}

function getClientId()
{
    return 2;
}

function getClientSecret()
{
    return 'UHDoh3c3sD1shuQK4BHnWyC4PQ6J0sMT1FwyBbhe';
}

function page_count($num_object, $page_size)
{
    return ceil($num_object / (doubleval($page_size)));
}

function response_api($status, $statusCode, $message = null, $object = null, $page_count = null, $page = null, $errors = null, $another_data = null)
{

    $message = isset($message) ? $message : message($statusCode);
    $error = ['status' => false, 'statusCode' => $statusCode, 'message' => $message];
    $success = ['status' => true, 'statusCode' => $statusCode, 'message' => $message];

    if ($status && isset($object)) {
        if (isset($page_count) && isset($page))
            $success['items'] = ['data' => $object, 'total_pages' => $page_count, 'current_page' => $page + 1];
        else
            $success['items'] = $object;


    } else if (!$status && isset($errors))
        $error['errors'] = $errors;
    else if (isset($object) || (is_array($object) && empty($object)))
        $error['items'] = $object;

    if (isset($another_data))
        foreach ($another_data as $key => $value)
            $success [$key] = $value;

    $response = ($status) ? $success : $error;

    return response()->json($response);
}

function distance($point1_lat, $point1_long, $point2_lat, $point2_long, $unit = 'K', $decimals = 2)
{
    // Calculate the distance in degrees
    $degrees = rad2deg(acos((sin(deg2rad(floatval($point1_lat))) * sin(deg2rad(floatval($point2_lat)))) + (cos(deg2rad(floatval($point1_lat))) * cos(deg2rad(floatval($point2_lat))) * cos(deg2rad(floatval($point1_long) - floatval($point2_long))))));

    // Convert the distance in degrees to the chosen unit (kilometres, miles or nautical miles)
    switch ($unit) {
        case 'K':
            $distance = $degrees * 111.13384; // 1 degree = 111.13384 km, based on the average diameter of the Earth (12,735 km)
            break;
        case 'mi':
            $distance = $degrees * 69.05482; // 1 degree = 69.05482 miles, based on the average diameter of the Earth (7,913.1 miles)
            break;
        case 'nmi':
            $distance = $degrees * 59.97662; // 1 degree = 59.97662 nautic miles, based on the average diameter of the Earth (6,876.3 nautical miles)
    }
    return round($distance, $decimals);
}
