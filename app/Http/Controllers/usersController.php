<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Hash;
use App\User;
use App\Roles;
use App\Employee;
use App\access_levels;
use App\Permission;
use App\UserPermission;

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
        $permissions = Permission::all();
        $roles = Roles::where('role', 'cashier')->first();
        $employee = Employee::where('role_id', $roles->id)->get();

        return view('settings.users', compact('employee'), ['permissions' => $permissions]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function get($option = null, Request $request)
    {
        if($option === "permission") {
            $request->validate([
                'id' => 'required'
            ]);

            return User::with('userpermission.permission')->find($request->id);
            
        }
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
            $user->emp_id = $request->emp_id;
            $user->username = $request->username;
            $user->password = Hash::make($request->password);
            $user->cashOnHand = $request->cashOnHand;
            $user->access_id = 2;
            $user->save();
        }

        if($request->get('button_action') == 'update'){
            $user = User::find($request->get('id'));
            $user->emp_id = $request->emp_id;
            $user->username = $request->username;
            $user->cashOnHand = $request->cashOnHand;
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
        // $user = User::where('access_id', '!=', 1)->get();
        return \DataTables::of(User::where('access_id', '!=', 1)->get())
        ->addColumn('action', function($user){
            return '<button class="btn btn-xs btn-info update_user waves-effect" id="'.$user->id.'"><i class="material-icons">mode_edit</i></button>
            <button class="btn btn-xs btn-danger delete_user waves-effect" id="'.$user->id.'"><i class="material-icons">delete</i></button>
            <button type="button" class="btn btn-xs btn-warning waves-effect" data-id="'.$user->id.'" data-toggle="modal" data-target="#user-permission"><i class="material-icons">vpn_key</i></button>';
        })
        ->editColumn('access_id', function ($data){
            $level = access_levels::all();
            foreach($level as $l){
                if($l->id == $data->access_id)
                    $access_name = $l->name;
            }

            return $access_name;
        })
        ->editColumn('emp_id', function ($data){
            $employee = Employee::all();
            foreach($employee as $emp){
                if($emp->id == $data->emp_id)
                    $emp_name = $emp->lname.", ".$emp->fname." ".$emp->mname;
            }
            return $emp_name;
        })   
        ->make(true);
    }

    function updatedata(Request $request){
        $id = $request->input('id');
        $user = User::find($id);
        $output = array(
            'name' => $user->name,
            'username' => $user->username,
            'cashOnHand' => $user->cashOnHand,
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

    public function permission($option, Request $request) {
        if($option === 'update') {            
            $request->validate([
                'id' => 'required'
            ]);
            $authorized = ($request->permission)?$request->permission:array();
            $permission = array();

            if($authorized) {
                $permissions = Permission::select('id')->whereNotIn('id', $authorized)->get();

                foreach ($authorized as $key => $value) {
                    UserPermission::updateOrCreate(['permission_id'=>$authorized[$key], 'user_id'=>$request->id], ['permit' => 1]);
                }
            }

            if($permissions) {
                foreach ($permissions as $key => $value) {
                    UserPermission::updateOrCreate(['permission_id'=>$value->id, 'user_id'=>$request->id], ['permit' => 0]);
                }
            }

            return 'true';
        }
    }
}
