<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Validator;

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
    protected $createRules = [
        'username' => 'required|unique:users',
        'emp_id' => 'required|unique:users|exists:employee,id'
    ];
    protected $updateRules = [
        'username' => 'required',
        'emp_id' => 'required|exists:employee,id',
        'id' => 'required|exists:users',
    ];

    public function validation($option, Array $request) {
        $request = preg_replace('!\s+!', ' ', $request);

        if($option === 'create') {
            $validation = Validator::make($request, $this->createRules, ['emp_id.unique' => 'The employee has already been registered.']);

            $validation->validate();
        } else if($option === 'update') {
            $validation = Validator::make($request, $this->updateRules);

            $validation->after(function ($validation) use ($request) {
                $isUsernameExists = $this->where('username', $request['username'])->where('id', '!=', $request['id'])->get()->count();

                if($isUsernameExists) {
                    $validation->errors()->add('username', 'The username has already been taken.');
                }
            });

            $validation->validate();
            return $this->find($request['id']);
        }
    }
    
    public function setUsernameAttribute($value)
    {
        $this->attributes['username'] = preg_replace('!\s+!', ' ', $value);
    }

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