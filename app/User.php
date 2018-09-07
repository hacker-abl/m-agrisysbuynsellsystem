<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;

    protected $primaryKey = 'id';
    protected $table = 'users';

    protected $fillable = array(
        'cashOnHand', 
        'name', 
        'username',  
        'email',
        'access_id',
        'emp_id',
    );
    public $timestamps = true;
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
        

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token'
    ];

    public function role() {
        return $this->hasOne('App\access_levels', 'id', 'access_id');
    }

    public function userpermission() {
        return $this->hasMany('App\UserPermission', 'user_id');
    }

    public function emp_name() {
        return $this->belongsTo('App\Employee', 'emp_id', 'id');
    }
}