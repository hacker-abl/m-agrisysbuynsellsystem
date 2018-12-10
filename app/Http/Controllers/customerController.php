<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use App\Customer;
use App\balance;
use Auth;
use App\UserPermission;
class customerController extends Controller
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


        return view('settings.customer');
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
            $customer = new Customer;
            $customer->validation('create', $request->all());
            $customer->fname = $request->fname;
            $customer->mname = $request->mname;
            $customer->lname = $request->lname;

            if($request->contacts == ""){
                $customer->contacts ="Not Specified";
            }
            else{
                    $customer->contacts = $request->contacts;
            }
            if($request->address == ""){
                $customer->address ="Not Specified";
            }
            else{
                $customer->address = $request->address;
            }

            $customer->suki_type = 0;
            $customer->save();

            $balance = new balance;
            $balance->customer_id = $customer->id;
            $balance->balance = 0;
            $balance->logs_ID = $customer->id;
            $balance->save();

            return response()->json('success');
        }

        if($request->get('button_action') == 'update'){
            $customer = new Customer;
            $customer = $customer->validation('update', $request->all());
            $customer->fname = $request->get('fname');
            $customer->mname = $request->get('mname');
            $customer->lname = $request->get('lname');

            if($request->get('contacts') == ""){
                $customer->contacts ="Not Specified";
            }
            else{
                $customer->contacts = $request->get('contacts');
            }
            if($request->get('address') == ""){
                $customer->address ="Not Specified";
            }
            else{
                $customer->address = $request->get('address');
            }

            if($request->get('suki_type') == 'YES'){
                $customer->suki_type = 1;
            }
            else{
                $customer->suki_type = 0;
            }
            $customer->save();
            
            return response()->json('success');
        }
    }

    public function refresh()
    {
        $customer = Customer::all();
        return \DataTables::of(Customer::query())
        ->addColumn('action', function($customer){
            $userid= Auth::user()->id;
            $permit = UserPermission::where('user_id',$userid)->where('permit',1)->where('permission_id',10)->get();
            if($userid!=1){
                $delete=$permit[0]->permit_delete;  
                $edit = $permit[0]->permit_edit;
            } 
            if($userid==1){
                return '<button class="btn btn-xs btn-warning update_customer waves-effect" id="'.$customer->id.'"><i class="material-icons">mode_edit</i></button>&nbsp;
                <button class="btn btn-xs btn-danger delete_customer waves-effect" id="'.$customer->id.'"><i class="material-icons">delete</i></button>';
            }if($userid!=1 && $delete==1 && $edit==1){
                return '<button class="btn btn-xs btn-warning update_customer waves-effect" id="'.$customer->id.'"><i class="material-icons">mode_edit</i></button>&nbsp;
                <button class="btn btn-xs btn-danger delete_customer waves-effect" id="'.$customer->id.'"><i class="material-icons">delete</i></button>';
            }if($userid!=1 && $delete==0 && $edit==1){
                return '<button class="btn btn-xs btn-warning update_customer waves-effect" id="'.$customer->id.'"><i class="material-icons">mode_edit</i></button>';
            }if($userid!=1 && $delete==1 && $edit==0){
                return '<button class="btn btn-xs btn-danger delete_customer waves-effect" id="'.$customer->id.'"><i class="material-icons">delete</i></button>';
            }if($userid!=1 && $delete==0 && $edit==0){
                return 'No Action Permitted';
            }
        })
        ->addColumn('wholename', function ($data){
            return $data->fname." ".$data->mname." ".$data->lname;
        })
        ->make(true);
    }

    function updatedata(Request $request){

        $id = $request->input('id');
        $customer = Customer::find($id);
        $output = array(
            'fname' => $customer->fname,
            'mname' => $customer->mname,
            'lname' => $customer->lname,
            'address' => $customer->address,
            'contacts' => $customer->contacts,
            'suki_type' => $customer->suki_type
        );
        echo json_encode($output);
    }

    function updateId(){
       $temp = DB::select('select MAX(id) as "temp" FROM customer');
       echo json_encode($temp);
    }

    function deletedata(Request $request){
        $customer = Customer::find($request->input('id'));
      //  $balance = balance::find($request->input('id'));

        $customer->delete();
       DB::table('balance')->where('customer_id', $request->input('id'))->delete();
    }
    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
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
