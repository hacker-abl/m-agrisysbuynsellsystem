<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class nuts_reject extends Model
{
    protected $primaryKey = 'id';
    protected $table = 'nuts_reject';
    protected $fillable = array(
        'reject',
        'copra',
    );
}
