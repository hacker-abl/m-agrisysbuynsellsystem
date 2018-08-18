<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class UserPermission extends Model
{
    protected $fillable = array('user_id', 'permission_id', 'permit');
    public $timestamps = false;

    public function permission() {
        return $this->hasOne('App\Permission', 'id', 'permission_id');
    }

    public function user() {
        return $this->hasOne('App\User', 'id', 'user_id');
    }
}
