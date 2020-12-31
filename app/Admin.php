<?php

namespace App;


use App\Notifications\AdminResetPasswordNotification;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Zizaco\Entrust\Traits\EntrustUserTrait;

use Mail;

class Admin extends Authenticatable
{
    use Notifiable;
    use EntrustUserTrait;

    protected $appends = ['logo100', 'logo300', 'has_store', 'store', 'store_images', 'merchant'];


    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */

    protected $fillable = [
        'name', 'email', 'password',
    ];


    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */

    protected $hidden = [
        'password', 'remember_token',
    ];

    protected $casts = ['user_id' => 'integer', 'status' => 'integer'];

    //Send password reset notification
    public function sendPasswordResetNotification($token)
    {
        $this->notify(new AdminResetPasswordNotification($token));
    }
//
//    public static function sendWelcomeEmail($user)
//    {
//        // Generate a new reset password token
//        $token = app('auth.password.broker')->createToken($user);
//
//        // Send email
////        Mail::send('auth.passwords.admin-email', ['user' => $user, 'token' => $token], function ($m) use ($user) {
////            $m->from('info@macrotop.website', 'Dragonmart');
////            $m->to($user->email, $user->name)->subject('Admin Reset password');
////        });
//
//        $user->notify(new AdminResetPasswordNotification($token));
//
//    }

    public function Store()
    {
        return $this->hasOne(Store::class, 'merchant_id', 'user_id');
    }

    public function Bank()
    {
        return $this->hasOne(MerchantBank::class, 'merchant_id', 'user_id');
    }

    public function Merchant()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function StoreImages()
    {
        return $this->hasManyThrough(StoreImage::class, Store::class, 'merchant_id', 'store_id', 'user_id', 'id')->orderByDesc('updated_at');
    }

    public function getLogo100Attribute()
    {
        return url('storage/app/admins/' . $this->id) . '/100/' . $this->getOriginal('logo');
    }

    public function getLogo300Attribute()
    {
        return url('storage/app/admins/' . $this->id) . '/300/' . $this->getOriginal('logo');
    }

    public function getLogoAttribute($value)
    {
        if (isset($value))
            return url('storage/app/admins/' . $this->id) . '/' . $value;
        return null;
    }


    public function getStoreImagesAttribute()
    {
        return $this->StoreImages()->get();
    }

    public function getMerchantAttribute()
    {
        return $this->Merchant()->first(); // user
    }

    public function getHasStoreAttribute()
    {
        $store = $this->Store()->first();
        return isset($store);
    }

    public function getStoreAttribute()
    {
        if ($this->type == 'merchant') {
            $store = $this->Store()->first();
            return $store;
        }
        return null;
    }


    protected static function boot()
    {
        parent::boot();
        static::deleting(function ($model) {
            $filename = storage_path('app/admins/' . $model->id . '/' . $model->getOriginal('logo'));
            $filename100 = storage_path('app/admins/' . $model->id . '/100/' . $model->getOriginal('logo'));
            $filename300 = storage_path('app/admins/' . $model->id . '/300/' . $model->getOriginal('logo'));
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
