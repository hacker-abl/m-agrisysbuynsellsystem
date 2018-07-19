<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Roles extends Model
{
    protected $primaryKey = 'id';
    protected $table = 'roles';
    protected $fillable = array(
        'role',
        'rate'
    );

    public $timestamps = true;

}
