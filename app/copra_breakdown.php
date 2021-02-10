<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class copra_breakdown extends Model
{
    protected $primaryKey = 'id';
    protected $table = 'copra_breakdown';
    protected $fillable = array(
        'copra_id',
        'resicada',
        'price',
        'amount',
    );
    
    public $timestamps = true;
}
