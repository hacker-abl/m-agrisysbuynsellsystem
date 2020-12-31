<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class od_payment extends Model
{
    protected $primaryKey = 'id';
    protected $table = 'od_payment';
    protected $fillable = array(
		'od_id',
		'date',
		'amount',
		'bank',
    );
    public $timestamps = true;
}
