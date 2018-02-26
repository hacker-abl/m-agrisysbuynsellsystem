<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Company extends Model
{
    protected $primaryKey = 'id';
    protected $table = 'company';
    protected $fillable = array(
        'name'
    );

    public $timestamps = true;
}
