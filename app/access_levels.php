<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class access_levels extends Model
{
    protected $primaryKey = 'id';
    protected $table = 'access_levels';
    protected $fillable = array(
		'name',
    );
    public $timestamps = true;
}
