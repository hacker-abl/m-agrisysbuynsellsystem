<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Company;
use App\UserPermission;
use Auth;
class companyController extends Controller
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


        return view('settings.company');
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
    {;
        if($request->get('button_action') == 'add'){
            $company = new Company;
            $company->name = $request->name;
            $company->save();
        }
        if($request->get('button_action') == 'update'){
            $company = Company::find($request->get('id'));
            $company->name = $request->get('name');
            $company->save();
        }
    }

    public function refresh()
    {
        $company = Company::all();
        return \DataTables::of(Company::query())
        ->addColumn('action', function($company){
            $userid= Auth::user()->access_id;
            $permit = UserPermission::where('user_id',$userid)->where('permit',1)->where('permission_id',8)->get(); 
            if($userid!=1){
                $delete=$permit[0]->permit_delete;  
                $edit = $permit[0]->permit_edit;
            }  
            if($userid===1){
                return '<button class="btn btn-xs btn-warning update_company waves-effect" id="'.$company->id.'"><i class="material-icons">mode_edit</i></button>&nbsp;
                <button class="btn btn-xs btn-danger delete_company waves-effect" id="'.$company->id.'"><i class="material-icons">delete</i></button>';
            }if($userid!=1 && $delete===1 && $edit===1){
                return '<button class="btn btn-xs btn-warning update_company waves-effect" id="'.$company->id.'"><i class="material-icons">mode_edit</i></button>&nbsp;
                <button class="btn btn-xs btn-danger delete_company waves-effect" id="'.$company->id.'"><i class="material-icons">delete</i></button>';
            }if($userid!=1 && $delete===0 && $edit===1){
                return '<button class="btn btn-xs btn-warning update_company waves-effect" id="'.$company->id.'"><i class="material-icons">mode_edit</i></button>';
            }if($userid!=1 && $delete===1 && $edit===0){
                return '<button class="btn btn-xs btn-danger delete_company waves-effect" id="'.$company->id.'"><i class="material-icons">delete</i></button>';
            }if($userid!=1 && $delete===0 && $edit===0){
                return 'No Action Permitted';
            }
        })
        ->make(true);
    }

    function updatedata(Request $request){
        $id = $request->input('id');
        $company = Company::find($id);
        $output = array(
            'name' => $company->name
        );
        echo json_encode($output); 
    }

    function deletedata(Request $request){
        $company = Company::find($request->input('id'));
        $company->delete();
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
    }
}
