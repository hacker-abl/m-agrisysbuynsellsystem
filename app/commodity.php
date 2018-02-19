<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Commodity extends Model
{
    protected $primaryKey = 'id';
    protected $table = 'commodity';
    protected $fillable = array(
        'name',
        'price',
        'suki_price'
    );

    public $timestamps = true;
}
