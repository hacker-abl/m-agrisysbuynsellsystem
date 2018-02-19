<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Hash;
use App\User;

class usersController extends Controller
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
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('settings.users');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if($request->get('button_action') == 'add'){
            $user = new User;
            $user->name = $request->name;
            $user->username = $request->username;
            $user->password = Hash::make($request->password);
            $user->access_id = 1;
            $user->save();
        }
        
        if($request->get('button_action') == 'update'){
            $user = User::find($request->get('id'));
            $user->name = $request->name;
            $user->username = $request->username;
            $user->save();
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    public function refresh()
    {
        $user = User::all();
        return \DataTables::of(User::query())
        ->addColumn('action', function($user){
            return '<button class="btn btn-xs btn-warning update_user" id="'.$user->id.'"><i class="material-icons">mode_edit</i></button>&nbsp
            <button class="btn btn-xs btn-danger delete_user" id="'.$user->id.'"><i class="material-icons">delete</i></button>';
        })
        ->make(true);
    }

    function updatedata(Request $request){
        $id = $request->input('id');
        $user = User::find($id);
        $output = array(
            'name' => $user->name,
            'username' => $user->username,
        );
        echo json_encode($output);
    }

    function deletedata(Request $request){
        $user = User::find($request->input('id'));
        $user->delete();
    }
    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
