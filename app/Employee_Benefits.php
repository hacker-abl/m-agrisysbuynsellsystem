<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Employee_Benefits extends Model
{
    protected $primaryKey = 'id';
    protected $table = 'employee_benefits';
    protected $fillable = array(
        'emp_id',
        'benefits_id',
        'id_number'
    );

    public $timestamps = true;

    public function benefits(){
        return $this->hasOne('App\Benefits', 'id', 'benefits_id');
    }

    public function employee(){
        return $this->hasOne('App\Employee', 'id', 'emp_id');
    }
}
