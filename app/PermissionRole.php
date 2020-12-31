<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PermissionRole extends Model
{
    //
    protected $table = 'permission_role';

    protected $casts = ['permission_id' => 'integer','role_id' => 'integer'];

}
