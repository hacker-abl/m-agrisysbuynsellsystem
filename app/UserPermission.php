<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class UserPermission extends Model
{
    public function permission() {
        return $this->hasOne('App\Permission', 'id', 'permission_id');
    }
}
