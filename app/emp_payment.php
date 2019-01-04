<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class emp_payment extends Model
{
    protected $primaryKey = 'id';
	protected $table = 'emp_payments';
	protected $fillable = array(
		'logs_id',
		'paymentmethod',
		'checknumber',
		'paymentamount',
	);
	public $timestamps = true;

	public function customerName(){
	    return $this->hasMany('App\employee','id','logs_id');
	}
}
