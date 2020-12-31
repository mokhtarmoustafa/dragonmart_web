<?php

namespace App;

use App\Notifications\ResetPasswordNotification;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Laravel\Passport\HasApiTokens;
use DB;

class User extends Authenticatable implements MustVerifyEmail
{
    use Notifiable, HasApiTokens, SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    public $appends = [
        'service_rate',
        'count_pending_request',
        'count_accepted_request',
        'count_rejected_request',
        'count_finished_request',
        'services',
        'reviews',
        'city',
        'image100',
        'image300',
        'vehicle',
        'min_merchant_price',
        'count_order_sent',
        'count_product_sent',
        'total_revenue',
        'store_images',
        'merchant_products',
        'store',
        'merchant_categories',
        'order_bought',
        'order_pending',
        'order_canceled',
        'shipments',
        'has_merchant_driver',
        'has_dragonmart_driver',
        'has_freelancer_driver',
        'driver_follow_type',
        'driver_type',
        'unseen_notifications'
    ]; // 'app_shipments',


    protected $fillable = [
        'name', 'email', 'password', 'email_verified_at',
    ];


    public function findForPassport($identifier) {

        $identifier = preg_replace("/^0/" , "+966" ,$identifier);
        $identifier = preg_replace("/^966/" , "+966" ,$identifier);
        $identifier = preg_replace("/^00966/" , "+966" ,$identifier);


        return $this->orWhere('email', $identifier)->orWhere('mobile', $identifier)->first();
}


    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token', 'verification_code',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime', 'is_confirm_code' => 'integer', 'country_code_length' => 'integer', 'city_id' => 'integer', 'is_active' => 'integer', 'has_delivery' => 'integer', 'is_reset_password' => 'integer', 'is_driver_available' => 'integer', 'driver_type_id' => 'integer'
    ];

    public function verifyUser()
    {
        return $this->hasOne(VerifyUser::class, 'user_id', 'id')->orderByDesc('updated_at');
    }

    public function Merchant()
    {
        return $this->hasOne(Admin::class, 'user_id', 'id')->orderByDesc('updated_at');
    }

    public function DriverType()
    {
        return $this->belongsTo(DriverType::class, 'driver_type_id');
    }

    public function MerchantDriverType()
    {
        return $this->belongsToMany(DriverType::class, MerchantDeliveryMethod::class, 'merchant_id', 'driver_type_id', 'id', 'id');
    }

    public function Store()
    {
        return $this->hasOne(Store::class, 'merchant_id', 'id')->orderByDesc('updated_at');
    }

    public function Bank()
    {
        return $this->hasOne(MerchantBank::class, 'merchant_id', 'id');
    }

    public function StoreImages()
    {
        return $this->hasManyThrough(StoreImage::class, Store::class, 'merchant_id', 'store_id', 'id', 'id')->orderByDesc('updated_at');
    }

    public function Categories()
    {
        return $this->hasMany(StoreCategory::class, 'merchant_id', 'id')->orderByDesc('updated_at');
    }

    public function City()
    {
        return $this->belongsTo(City::class, 'city_id')->orderByDesc('updated_at');
    }

    public function Vehicle()
    {
        return $this->hasOne(Vehicle::class, 'driver_id', 'id')->withTrashed()->orderByDesc('updated_at');
    }

    public function MerchantProducts()
    {
        return $this->hasMany(Product::class, 'merchant_id', 'id')->orderByDesc('updated_at');
    }

    public function promotionCodes()
    {
        return $this->hasMany(PromotionCode::class, 'merchant_id');
    }

    public function Shipments()
    {
        return $this->hasMany(ShipmentCost::class, 'merchant_id', 'id');
    }

    public function Orders()
    {
        return $this->hasManyThrough(Order::class, OrderUser::class, 'user_id', 'user_order_id', 'id', 'id')->orderByDesc('updated_at');
    }

    public function Services()
    {
        return $this->hasMany(Service::class, 'user_id', 'id')->orderByDesc('updated_at');
    }

    public function Notifications()
    {
        return $this->belongsToMany(Notification::class, NotificationReceiver::class, 'receiver_id', 'notification_id', 'id', 'id')->orderByDesc('updated_at');
    }

    public function ServiceRates()
    {
        return $this->hasManyThrough(ServiceRate::class, Service::class, 'user_id', 'service_request_id', 'id', 'id');
    }

    public function DeliveryMethod()
    {
        return $this->belongsToMany(DriverType::class, MerchantDeliveryMethod::class, 'merchant_id', 'driver_type_id', 'id', 'id');
    }

    public function getImage100Attribute()
    {
        if (isset($this->image))
            return url('storage/app/users/' . $this->id) . '/100/' . $this->getOriginal('image');
        return null;
    }

    public function getImage300Attribute()
    {
        if (isset($this->image))
            return url('storage/app/users/' . $this->id) . '/300/' . $this->getOriginal('image');
        return null;
    }

    public function getImageAttribute($value)
    {
        if (isset($value))
            return url('storage/app/users/' . $this->id) . '/' . $value;
        return null;
    }

    public function getStoreAttribute()
    {
        if ($this->type == 'merchant') {
            return $this->Store()->first();
        }
        return null;
    }

    public function getMerchantCategoriesAttribute()
    {
        if ($this->type == 'merchant') {
            $store = $this->Store()->first();
            return isset($store) ? $store->categories : null;
        }
        return null;
    }

    public function getServiceRateAttribute()
    {
        if ($this->type == 'service_provider') {
//            return $this->ServiceRates()->avg('rate');

            $service_ids = $this->Services()->pluck('id')->toArray();
            $service_request_ids = ServiceRequest::whereIn('service_id', $service_ids)->pluck('service_client_id')->unique();
            return doubleval(ServiceRate::whereIn('service_request_id', $service_request_ids)->avg('rate'));
//
        }
        return null;
    }

    public function getServicesAttribute()
    {
        if ($this->type == 'service_provider' && request()->segment(3) != 'services' && request()->segment(3) != 'service' && request()->segment(3) != 'login') {
            if (request()->has('category_id'))
                return $this->Services()->where('category_id', request()->get('category_id'))->take(2)->orderByDesc('created_at')->get();
            return $this->Services()->take(2)->orderByDesc('created_at')->get();
        }
        return null;
    }

    public function getReviewsAttribute()
    {
        if ($this->type == 'service_provider' && request()->segment(3) != 'services') {
            $service_ids = $this->Services()->pluck('id')->toArray();
            $service_request_ids = ServiceRequest::whereIn('service_id', $service_ids)->pluck('service_client_id')->unique();
            return ServiceRate::whereIn('service_request_id', $service_request_ids)->orderByDesc('created_at')->get();
//            return $this->Services()->take(2)->orderByDesc('created_at')->get();
        }
        return null;
    }

    public function getCountPendingRequestAttribute()
    {
        if ($this->type == 'service_provider') {
            $service_ids = $this->Services()->pluck('id');

            return ServiceRequest::whereIn('service_id', $service_ids)->where('status', 'pending')->count();
        }
        return null;
    }

    public function getCountAcceptedRequestAttribute()
    {
        if ($this->type == 'service_provider') {
            $service_ids = $this->Services()->pluck('id');

            return ServiceRequest::whereIn('service_id', $service_ids)->where('status', 'accepted')->count();
        }
        return null;
    }

    public function getCountFinishedRequestAttribute()
    {
        if ($this->type == 'service_provider') {
            $service_ids = $this->Services()->pluck('id');

            return ServiceRequest::whereIn('service_id', $service_ids)->where('status', 'finished')->count();
        }
        return null;
    }

    public function getCountRejectedRequestAttribute()
    {
        if ($this->type == 'service_provider') {
            $service_ids = $this->Services()->pluck('id');

            return ServiceRequest::whereIn('service_id', $service_ids)->where('status', 'rejected')->count();
        }
        return null;
    }

    public function getUnseenNotificationsAttribute()
    {
        if ($this->type == 'merchant') {
            return $this->Notifications()->where('seen', 0)->count();
        }
        return null;
    }

    public function getCountOrderSentAttribute()
    {
        if ($this->type == 'merchant') {
            return Order::where('merchant_id', $this->id)->where('last_status', 'finished')->count();
        }
        return null;
    }

    public function getMinMerchantPriceAttribute()
    {
        if ($this->type == 'merchant') {
            return 200;
        }
        return 0;
    }

    public function getCountProductSentAttribute()
    {
        if ($this->type == 'merchant') {
            $orders = Order::where('merchant_id', $this->id)->where('last_status', 'finished')->pluck('id');
            return OrderProduct::whereIn('order_id', $orders)->count();
        }
        return null;
    }

    public function getTotalRevenueAttribute()
    {
        if ($this->type == 'merchant') {
            return Order::where('merchant_id', $this->id)->where('last_status', 'finished')->sum(DB::raw('products_price + shipment_price'));

        }
        return null;
    }

    public function getCityAttribute()
    {
        return $this->City()->first();

//        if ($this->type == 'merchant') {
//        }
//        return null;
    }

    public function getStoreImagesAttribute()
    {
        if ($this->type == 'merchant') {
            return $this->StoreImages()->get();
        }
        return null;
    }

    public function getOrderBoughtAttribute()
    {
        if ($this->type == 'client') {
            return $this->Orders()->where('last_status', 'finished')->take(2)->orderByDesc('created_at')->get();
        }
        return null;
    }

    public function getOrderPendingAttribute()
    {
        if ($this->type == 'client') {
            return $this->Orders()->where(function ($query) {
                $query->whereNull('last_status')->orWhere('last_status', 'new')->orWhere('last_status', 'accepted');
            })->take(2)->orderByDesc('created_at')->get();
        }
        return null;
    }

    public function getOrderCanceledAttribute()
    {
        if ($this->type == 'client') {
            return $this->Orders()->where('last_status', 'canceled')->take(2)->orderByDesc('created_at')->get();
        }
        return null;
    }

    public function getMerchantProductsAttribute()
    {
        if (request()->segment(1) == 'api' && request()->segment(3) == 'profile' && $this->type == 'merchant') {
            $product = $this->MerchantProducts()->take(2)->get();
            return $product;
        }
        return null;
    }

    public function getVehicleAttribute()
    {
        if ($this->type == 'driver')
            return $this->Vehicle()->first();
        return null;
    }

    public function getDriverTypeAttribute()
    {
        if ($this->type == 'driver')
            return $this->DriverType()->first();
        return null;
    }

    public function getShipmentsAttribute()
    {
        if ($this->type == 'merchant') {
            if ($this->has_merchant_driver)
                return $this->Shipments()->orderBy('from', 'ASC')->get();
            return ShipmentCost::where('type', 'admin')->orderBy('from', 'ASC')->get();
        }
        return null;
    }

//    public function getAppShipmentsAttribute()
//    {
//        if ($this->type == 'merchant')
//            return $this->Shipments()->orderBy('from', 'ASC')->get();
//        return null;
//    }

    public function getHasMerchantDriverAttribute()
    {
        if ($this->type == 'merchant')
            return ($this->DeliveryMethod()->where('driver_type_id', 3)->count() > 0) ? 1 : 0;
//        {
//            $has = $this->DeliveryMethod()->find(3);
//            dd($this->DeliveryMethod()->first());
//            return isset($has);
//        }
        return 0;
    }

    public function getHasDragonmartDriverAttribute()
    {
        if ($this->type == 'merchant')
            return ($this->DeliveryMethod()->where('driver_type_id', 1)->count() > 0) ? 1 : 0;

//        {
//            $has = $this->DeliveryMethod()->find(1);
//            return isset($has);
//        }
        return 0;
    }

    public function getHasFreelancerDriverAttribute()
    {
        if ($this->type == 'merchant')
            return ($this->DeliveryMethod()->where('driver_type_id', 2)->count() > 0) ? 1 : 0;

//        {
//            $has = $this->DeliveryMethod()->find(2);
//            return isset($has);
//        }
        return 0;
    }

    public function getDriverFollowTypeAttribute()
    {
        if ($this->type == 'driver') {
            $driver_type = $this->DriverType()->first();
            if (isset($driver_type)) {
                if ($driver_type->id == 1) return 'dragonmart_driver';
                if ($driver_type->id == 2) return 'freelancer_driver';
                if ($driver_type->id == 3) return 'merchant_driver';
//            $merchant_driver = StoreDriver::where('driver_id', $this->id)->first();
//            return isset($merchant_driver) ? 'merchant_driver' : 'freelancer_driver';
            }
        }
        return 0;
    }


    public function sendPasswordResetNotification($token)
    {
        return $this->notify(new ResetPasswordNotification($token));
    }

    protected static function boot()
    {
        parent::boot();
        static::deleting(function ($model) {
            $filename = storage_path('app/users/' . $model->id . '/' . $model->getOriginal('image'));
            $filename100 = storage_path('app/users/' . $model->id . '/100/' . $model->getOriginal('image'));
            $filename300 = storage_path('app/users/' . $model->id . '/300/' . $model->getOriginal('image'));
//
            if (file_exists($filename)) {
                unlink($filename);
                unlink($filename100);
                unlink($filename300);
                $model->delete();
            }
        });
    }

}
