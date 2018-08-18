<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Permission extends Model
{
    public function userpermission() {
        return $this->hasOne('App\UserPermission', 'permission_id');
    }
}
