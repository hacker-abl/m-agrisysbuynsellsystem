<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class balanceModel extends Model
{
	protected $primaryKey = 'id';
    protected $table = 'balance';
    protected $fillable = array(
        'customer_id',
        'balance',
        'logID',
    );

    public $timestamps = true;
}
