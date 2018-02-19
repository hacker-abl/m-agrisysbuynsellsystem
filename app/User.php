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
        'name', 
        'username',  
        'email',
        'access_id'
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
}
