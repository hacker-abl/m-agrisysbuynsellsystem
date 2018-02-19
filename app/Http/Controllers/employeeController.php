<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Employee;

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
        return view('settings.employee');
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
            $employee->type = $request->type;
            $employee->save();
        }
        
        if($request->get('button_action') == 'update'){
            $employee = Employee::find($request->get('id'));
            $employee->fname = $request->get('fname');
            $employee->mname = $request->get('mname');
            $employee->lname = $request->get('lname');
            $employee->type = $request->get('type');
            $employee->save();
        }
    }

    public function refresh()
    {
        $employee = Employee::all();
        return \DataTables::of(Employee::query())
        ->addColumn('action', function($employee){
            return '<button class="btn btn-xs btn-warning update_employee" id="'.$employee->id.'"><i class="material-icons">mode_edit</i></button>&nbsp
            <button class="btn btn-xs btn-danger delete_employee" id="'.$employee->id.'"><i class="material-icons">delete</i></button>';
        })
        ->make(true);
    }

    function updatedata(Request $request){
        $id = $request->input('id');
        $employee = Employee::find($id);
        $output = array(
            'fname' => $employee->fname,
            'mname' => $employee->mname,
            'lname' => $employee->lname,
            'type' => $employee->type
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
