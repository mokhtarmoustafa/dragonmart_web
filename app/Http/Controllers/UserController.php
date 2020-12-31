<?php

namespace App\Http\Controllers;

use App\CarType;
use App\DriverType;
use App\Http\Requests\User\CreateDriverRequest;
use App\Http\Requests\User\CreateServiceProviderRequest;
use App\Http\Requests\User\EditDriverRequest;
use App\Http\Requests\User\EditProfileRequest;
use App\Manufacturer;
use App\ProductCategory;
use App\ProviderCategory;
use App\Repositories\Eloquents\UserEloquent;
use App\Store;
use App\User;
use Illuminate\Http\Request;

//use Intervention\Image\Gd\Driver;
//use function MongoDB\BSON\toJSON;

class UserController extends Controller
{
    //
    private $user;

    public function __construct(UserEloquent $userEloquent)
    {
        parent::__construct();
        $this->user = $userEloquent;
    }

    //
    public function putProfile(EditProfileRequest $request, $id = null)
    {
        $id = (isset($id)) ? $id : getAuth()->user_id;
        return $this->user->update($request->all(), $id);
    }

    // user management
    public function userList()
    {
        $driver_types = DriverType::all();

        $data = [
            'main_title' => 'users',
            'icon' => 'glyphicon glyphicon-phone',
            'driver_types' => $driver_types
        ];
        return view(admin_users_vw() . '.index', $data);
    }

    // driverMerchantList management
    public function driverMerchantList()
    {
        $manufacturers = Manufacturer::all();
        $driver_types = DriverType::all();
        $data = [
            'main_title' => 'drivers',
            'icon' => 'fa fa-truck',
            'manufacturers' => $manufacturers,
            'driver_types' => $driver_types,
        ];
        return view(merchant_vw() . '.drivers.index', $data);
    }

    // merchant profile management
    public function merchantProfile() 
    {
        $categories = ProductCategory::all();
        $driver_methods = getAuth()->Merchant->MerchantDriverType;

        $store = Store::where('merchant_id', auth()->guard('admin')->user()->user_id)->first();
        $data = [
            'main_title' => 'profile',
            'icon' => 'fa fa-user',
            'driver_methods' => $driver_methods,
            'categories' => $categories,
            'store' => $store
        ];

        return view(merchant_vw() . '.profile', $data);
    }

    public function merchantDriverData($id)
    {
        return $this->user->merchantDriverData($id);
    }

    public function userData()
    {
        return $this->user->userData();
    }

    public function merchantData()
    {
        return $this->user->merchantData();
    }

    public function merchantShipmentData($merchant_id)
    {
        return $this->user->merchantShipmentData($merchant_id);
    }

    public function merchantCategoryData($merchant_id)
    {
        return $this->user->merchantCategoryData($merchant_id);
    }

    public function driverData()
    {
        return $this->user->driverData();
    }

    public function serviceProviderData()
    {

        return $this->user->serviceProviderData();
    }

    public function userActive(Request $request)
    {
        return $this->user->userActive($request->only('user_id'));
    }

    public function verifyEmail(Request $request)
    {
        return $this->user->verifyEmail($request->only('user_id'));
    }

    public function userDet($id)
    {
        return $this->user->getById($id);
    }


    public function Map($id)
    {
        return $this->user->getById($id);
    }


    public function addDriver()
    {

        $manufacturers = Manufacturer::all();
        $car_types = CarType::all();
        $driver_types = DriverType::all();
        $data = ['manufacturers' => $manufacturers, 'driver_types' => $driver_types, 'car_types' => $car_types];
        return view()->make('admin.modals.add_driver', $data);
    }

    public function createDriver(CreateDriverRequest $request)
    {
        return $this->user->createDriver($request->all());
    }

// get drivers list
    public function getDriversList($is_my_drivers = true)
    {
        return $this->user->getDriversList($is_my_drivers);
    }

    public function editDriver($id)
    {
        $driver = User::where('type', 'driver')->find($id);

        $manufacturers = Manufacturer::all();
        $driver_types = DriverType::all();
        $car_types = [];

        // if (isset($driver->Vehicle))
        //     $car_types = CarType::where('manufacturer_id', $driver->Vehicle->CarType->manufacturer_id)->get();

        $data = [
            'manufacturers' => $manufacturers,
            'driver_types' => $driver_types,
            'user' => $driver,
            'car_types' => $car_types,
        ];

        return view()->make('admin.modals.edit_driver', $data);
    }

    public function updateDriver(EditDriverRequest $request, $id)
    {
        return $this->user->updateDriver($request->all(), $id);
    }

    public function addServiceProvider()
    {
        $provider_categories = ProviderCategory::all();
        $data = ['provider_categories' => $provider_categories];
        return view()->make('admin.modals.add_service_provider', $data);
    }

    public function createServiceProvider(CreateServiceProviderRequest $request)
    {
        return $this->user->createServiceProvider($request->all());
    }

    public function getUserDet($id)
    {
        $user = $this->user->getById($id);

        $driver_types = DriverType::all();
        $categories = ProductCategory::whereNull('store_id')->get();


        $driver_type_ids = $user->MerchantDriverType()->pluck('driver_type_id')->toArray();

        $data = [
            'main_title' => $user->type,
            'icon' => 'glyphicon glyphicon-phone',
            'user' => $user,
            'driver_types' => $driver_types,
            'driver_type_ids' => $driver_type_ids,
            'categories' => $categories,
            'bank' => $user->Bank()->first()
        ];


        if ($user->type == 'client') {
            if (getAuth()->type == 'merchant')
                return view(merchant_users_vw() . '.view', $data);
            return view(admin_users_vw() . '.view', $data);
        } else if ($user->type == 'merchant') {
            if (getAuth()->type == 'merchant')
                return view(merchant_vw() . '.view', $data);
            return view(admin_merchants_vw() . '.view', $data);

        }
        if (getAuth()->type == 'merchant')
            return view(merchant_users_vw() . '.driver_view', $data);
        return view(admin_users_vw() . '.driver_view', $data);
    }

    public function getMerchants(Request $request)
    {
        return $this->user->getMerchants($request->all());
        
    }

    public function getMerchantCat(Request $request)
    {
        return $this->user->getMerchantCat($request->all());
    }

    // get User by id
    public function getProductByCat($id = null)
    {
        return $this->user->getProductByCat($id);
    }



}
