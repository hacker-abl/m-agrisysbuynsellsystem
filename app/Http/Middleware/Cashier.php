<?php

namespace App\Http\Middleware;

use Closure;
use Auth;
use App\User;

class Cashier
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        $id = Auth::user()->id;
        $user = User::find($id);

        if($user->role->name === "cashier") {
            return $next($request);
        }

        return back();
    }
}
