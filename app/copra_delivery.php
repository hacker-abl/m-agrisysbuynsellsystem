<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class copra_delivery extends Model
{
    protected $primaryKey = 'id';
    protected $table = 'copra_delivery';
    protected $fillable = array(
        'od_id',
        'wr',
        'net_weight',
        'dust',
        'moist',
        'resicada'
    );

    public function od() {
        return $this->hasOne('App\od', 'id', 'od_id');
    }

	public function breakdown() {
	    return $this->hasMany('App\copra_breakdown','copra_id','id');
	}
    
    public $timestamps = true;
}
