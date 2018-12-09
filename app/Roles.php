<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Validator;

class Roles extends Model
{
    protected $primaryKey = 'id';
    protected $table = 'roles';
    protected $fillable = array(
        'role',
        'rate'
    );
    protected $createRules = [
        'role' => 'required|unique:roles',
        'rate' => 'required|numeric'
    ];
    protected $updateRules = [
        'role' => 'required',
        'rate' => 'required|numeric',
        'id' => 'required|exists:roles'
    ];
    public $timestamps = true;

    public function validation($option, Array $request) {
        $request = preg_replace('!\s+!', ' ', $request);

        if($option === 'create') {
            $validation = Validator::make($request, $this->createRules, ['role.unique' => 'The role has already been added.']);

            $validation->validate();
        } else if($option === 'update') {
            $validation = Validator::make($request, $this->updateRules);

            $validation->after(function ($validation) use ($request) {
                $isRoleExists = $this->where('role', $request['role'])->where('id', '!=', $request['id'])->get()->count();

                if($isRoleExists) {
                    $validation->errors()->add('role', 'The role has already been added.');
                }
            });

            $validation->validate();
            return $this->find($request['id']);
        }
    }

    public function getRoleAttribute($value)
    {
        return strtoupper($value);
    }
    
    public function setRoleAttribute($value)
    {
        $this->attributes['role'] = preg_replace('!\s+!', ' ', strtoupper($value));
    }

    public function cashier_role(){
        return $this->belongsTo('App\Employee');
    }
}
