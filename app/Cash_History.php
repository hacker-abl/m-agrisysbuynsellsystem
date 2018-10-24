<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Cash_History extends Model
{
    protected $primaryKey = 'id';
    protected $table = 'cash_histories';
    protected $fillable = array(
        'user_id',
        'trans_no',
        'previous_cash',
        'cash_change',
        'total_cash',
        'type'
    );
    public $timestamps = true;

    public function user(){
        return $this->hasOne('App\User', 'id', 'user_id');
    }
}
