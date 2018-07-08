<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Notification extends Model
{    
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'notification_type', 'message', 'status', 'admin_id', 'cashier_id', 'cash_advance_id'
    ];

    public function cash_advance() {
        return $this->hasOne('App\ca', 'id', 'cash_advance_id');
    }

    public function admin() {
        return $this->hasOne('App\User', 'id', 'admin_id');
    }

    public function cashier() {
        return $this->hasOne('App\User', 'id', 'cashier_id');
    }
}
