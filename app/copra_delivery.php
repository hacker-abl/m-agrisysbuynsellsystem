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
    
    public $timestamps = true;
}
