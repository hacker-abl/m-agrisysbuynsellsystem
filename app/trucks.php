<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Trucks extends Model
{
    protected $primaryKey = 'id';
    protected $table = 'trucks';
    protected $fillable = array(
        'name',
        'plate_no'
    );

    public $timestamps = true;
}
