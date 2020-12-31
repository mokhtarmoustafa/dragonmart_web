<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class VerifyUser extends Model
{
    //
    protected $fillable = ['user_id', 'token', 'email'];
    protected $casts = ['user_id' => 'integer'];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }


}
