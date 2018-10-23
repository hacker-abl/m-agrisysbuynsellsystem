<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Benefits extends Model
{
    protected $primaryKey = 'id';
    protected $table = 'benefits';
    protected $fillable = array(
        'name'
    );

    public $timestamps = true;
}
