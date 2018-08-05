<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use App\User;
use App\UserPermission;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $id = Auth::user()->id;
        $user = User::find($id);
        
        if($user->role->name === "admin") {
            return view('main.home');
        } else if($user->role->name === "user") {
            $permissions = UserPermission::with('permission')->get();

            return view('cashier.home', compact('permissions'));
        }
    }

}
