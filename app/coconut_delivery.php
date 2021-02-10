<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class coconut_delivery extends Model
{
    protected $primaryKey = 'id';
    protected $table = 'coconut_delivery';
    protected $fillable = array(
        'gross_weight',
        'moisture',
        'net_weight',
        'price',
        'amount',
        'tax',
        'unloading',
        'total_amount',
    );
 
    public function nuts_reject(){
        return $this->hasOne('App\nuts_reject', 'id', 'coconut_delivery_id');
    }
    
    public $timestamps = true;
}
