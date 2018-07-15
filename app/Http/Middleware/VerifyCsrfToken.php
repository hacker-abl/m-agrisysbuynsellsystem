<?php

namespace App\Http\Middleware;

use Illuminate\Foundation\Http\Middleware\VerifyCsrfToken as Middleware;

class VerifyCsrfToken extends Middleware
{
    /**
     * The URIs that should be excluded from CSRF verification.
     *
     * @var array
     */
    protected $except = [
        //
    	'/print_expense',
    	'/print_trip',
    	'/print_dtr',
    	'/print_od',
    	'/print_ca',
    	'/print_purchase',
    	'/print_sales',
    	

    ];
}
