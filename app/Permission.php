<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Zizaco\Entrust\EntrustPermission;

class Permission extends EntrustPermission
{
    //
    protected $table = 'permissions';

    protected $fillable = ['name','display_name','parent_id','controller_name','function_name','type','icon','is_sidebar','alias','sort_num'];


    public function Master()
    {
        return $this->belongsTo(Permission::class, 'parent_id')->orderBy('sort_num', 'ASC');
    }

    public function Children()
    {
        return $this->hasMany(Permission::class, 'parent_id', 'id')->orderBy('sort_num','ASC');
    }
}
