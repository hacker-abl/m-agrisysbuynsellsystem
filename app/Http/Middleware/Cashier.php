<?php

namespace App\Http\Middleware;

use Closure;
use Auth;
use App\User;
use App\UserPermission;

class Cashier
{
    private $middleware;
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @param  string  $permission7
     * @return mixed
     */
    public function handle($request, Closure $next, $middleware)
    {
        $id = Auth::user()->id;
        $user = User::find($id);
        $permission = UserPermission::select('user_id', 'middleware')->join('permissions', 'permissions.id', 'user_permissions.permission_id', 'right');

        if($user->role->name === "user") {
            if($middleware === 'notification') return $next($request);
            if($permission->where(['user_id' => $id, 'middleware' => $middleware, 'permit' => 1])->first()) return $next($request);
        } else {
            return $next($request);
        }

        return abort(404);
    }
}
