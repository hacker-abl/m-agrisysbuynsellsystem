<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Commodity extends Model
{
    use SoftDeletes;

    protected $primaryKey = 'id';
    protected $table = 'commodity';
    protected $fillable = array(
        'name',
        'price',
        'suki_price'
    );

    public $timestamps = true;
    protected $dates = ['deleted_at'];
}
