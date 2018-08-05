<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Customer extends Model
{
    protected $primaryKey = 'id';
    protected $table = 'customer';
    protected $fillable = array(
        'fname',
        'mname',
        'lname',
        'suki_type'
    );

    public $timestamps = true;
}
