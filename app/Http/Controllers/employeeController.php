<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Employee;
use App\Roles;
use App\Employee_Benefits;
Use App\UserPermission;
use Auth;
class employeeController extends Controller
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
        $roles = Roles::pluck('role','id')->toArray();

        return view('settings.employee')->with(compact('roles'));
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
            $employee = new Employee;
            $employee->fname = $request->fname;
            $employee->mname = $request->mname;
            $employee->lname = $request->lname;
            $employee->role_id = $request->role_id;
            $employee->save();

            $employee = Employee::orderBy('id', 'DESC')->first();
            
            for($x = 0; $x < 3; $x++){
                $employee_benefits = new Employee_Benefits;
                $employee_benefits->emp_id = $employee->id;
                if($x == 0){//SSS
                    $employee_benefits->benefits_id = 1;
                    $employee_benefits->id_number = $request->sss;
                }
                else if($x == 1){//Philhealth
                    $employee_benefits->benefits_id = 2;
                    $employee_benefits->id_number = $request->philhealth;
                }
                else if($x == 2){//Pag-ibig
                    $employee_benefits->benefits_id = 3;
                    $employee_benefits->id_number = $request->pagibig;
                }
                $employee_benefits->save();
            }
        }

        if($request->get('button_action') == 'update'){
            $employee = Employee::find($request->get('id'));
            $employee->fname = $request->get('fname');
            $employee->mname = $request->get('mname');
            $employee->lname = $request->get('lname');
            $employee->role_id = $request->get('role_id');
            $employee->save();

            $employee = Employee::orderBy('id', 'DESC')->first();

            for($x = 0; $x < 3; $x++){
                $employee_benefits = Employee_Benefits::where('emp_id', $employee->id)
                    ->where('benefits_id', $x+1)->first();
                if($x == 0){//SSS
                    $employee_benefits->benefits_id = 1;
                    $employee_benefits->id_number = $request->sss;
                }
                else if($x == 1){//Philhealth
                    $employee_benefits->benefits_id = 2;
                    $employee_benefits->id_number = $request->philhealth;
                }
                else if($x == 2){//Pag-ibig
                    $employee_benefits->benefits_id = 3;
                    $employee_benefits->id_number = $request->pagibig;
                }
                $employee_benefits->save();
            }
        }
    }

    public function refresh()
    {
        $employee = Employee::all();

        return \DataTables::of($employee)
        ->addColumn('action', function($employee){
            $userid= Auth::user()->id;
            $permit = UserPermission::where('user_id',$userid)->where('permit',1)->where('permission_id',9)->get();
            if($userid!=1){
                $delete=$permit[0]->permit_delete;  
                $edit = $permit[0]->permit_edit;
            }   
            
            if($userid==1){
                return '<button class="btn btn-xs btn-warning update_employee waves-effect" id="'.$employee->id.'"><i class="material-icons">mode_edit</i></button>&nbsp;
                <button class="btn btn-xs btn-danger delete_employee waves-effect" id="'.$employee->id.'"><i class="material-icons">delete</i></button>';
            }if($userid!=1 && $delete==1 && $edit==1){
                return '<button class="btn btn-xs btn-warning update_employee waves-effect" id="'.$employee->id.'"><i class="material-icons">mode_edit</i></button>&nbsp;
                <button class="btn btn-xs btn-danger delete_employee waves-effect" id="'.$employee->id.'"><i class="material-icons">delete</i></button>';
            }if($userid!=1 && $delete==0 && $edit==1){
                return '<button class="btn btn-xs btn-warning update_employee waves-effect" id="'.$employee->id.'"><i class="material-icons">mode_edit</i>';
            }if($userid!=1 && $delete==1 && $edit==0){
                return '<button class="btn btn-xs btn-danger delete_employee waves-effect" id="'.$employee->id.'"><i class="material-icons">delete</i></button>';
            }if($userid!=1 && $delete==0 && $edit==0){
                return 'No Action Permitted';
            }
        })
        ->addColumn('wholename', function ($data){
            return $data->fname." ".$data->mname." ".$data->lname;
        })
        ->editColumn('role_id', function ($data) {
            $role = Roles::all();
            foreach($role as $r){
                if($r->id == $data->role_id)
                    $role_name = $r->role;
            }

            return $role_name;
        })
        ->editColumn('sss', function ($data){
            $employee_benefits = Employee_Benefits::where('emp_id', $data->id)->where('benefits_id', 1)->first();

            return $employee_benefits->id_number;
        })
        ->editColumn('philhealth', function ($data){
            $employee_benefits = Employee_Benefits::where('emp_id', $data->id)->where('benefits_id', 2)->first();

            return $employee_benefits->id_number;
        })
        ->editColumn('pagibig', function ($data){
            $employee_benefits = Employee_Benefits::where('emp_id', $data->id)->where('benefits_id', 3)->first();

            return $employee_benefits->id_number;
        })
        ->make(true);
    }

    function updatedata(Request $request){
        $id = $request->input('id');
        $employee = Employee::find($id);
        $benefits = Employee_Benefits::where('emp_id', $id)->get();
        $output = array(
            'fname' => $employee->fname,
            'mname' => $employee->mname,
            'lname' => $employee->lname,
            'role_id' => $employee->role_id,
            'sss' => $benefits[0]->id_number,
            'philhealth' => $benefits[1]->id_number,
            'pagibig' => $benefits[2]->id_number
        );
        echo json_encode($output);
    }

    function deletedata(Request $request){
        $employee = Employee::find($request->input('id'));
        $employee->delete();
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
