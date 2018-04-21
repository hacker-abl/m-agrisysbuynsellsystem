<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class dtr_expense extends Model
{
    protected $primaryKey = 'id';
    protected $table = 'dtr_expense';
    protected $fillable = array(
		'dtr_id',
		'description',
		'type',
        'amount',
        'status',
    );
    public $timestamps = true;
}
