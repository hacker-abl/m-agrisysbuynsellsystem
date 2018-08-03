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
     * @param  string  $permission
     * @return mixed
     */
    public function handle($request, Closure $next, $permission)
    {
        $id = Auth::user()->id;
        $user = User::find($id);

        // dd($permission);

        if($user->role->name === "user") {
            return $next($request);
        }

        return back();
    }
}
