<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class dtr extends Model
{
    protected $primaryKey = 'id';
    protected $table = 'dtr';
    protected $fillable = array(
      'role',
      'employee_id',
      'rate',
      'salary',
      'deductions'
    );
    public $timestamps = true;

    public function employee() {
        return $this->hasOne('App\employee', 'id', 'employee_id');
    }
}
