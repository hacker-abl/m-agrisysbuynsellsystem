<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class od extends Model
{
	protected $primaryKey = 'id';
	protected $table = 'deliveries';
	protected $fillable = array(
		'outboundTicket',
		'commodity_id',
		'destination',
		'driver_id',
		'company_id',
		'plateno',
		'fuel_liters',
		'allowance',
	);

    public function commodity() {
        return $this->hasOne('App\commodity', 'id', 'commodity_id')->withTrashed();;
	}

    public function trucks() {
        return $this->hasOne('App\trucks', 'id', 'plateno');
    }
	
    public function driver() {
        return $this->hasOne('App\employee', 'id', 'driver_id');
    }

    public function company() {
        return $this->hasOne('App\company', 'id', 'company_id');
    }

    public function od_expense() {
        return $this->hasOne('App\od_expense', 'od_id', 'id');
    }
}
