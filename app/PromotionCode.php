<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\User;

class PromotionCode extends Model
{
    //
    use SoftDeletes;

    protected $fillable = [
        'code', 'description', 'action', 'status'
    ];

    public function merchant()
    {
        return $this->belongsTo(User::class, 'merchant_id');
    }

    public function getActionAttribute()
    {
            return json_decode($this->attributes['action']);
    }

}
