<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Customer;
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
            $customer->fname = $request->fname;
            $customer->mname = $request->mname;
            $customer->lname = $request->lname;
            $customer->suki_type = 0;
            $customer->save();
        }

        if($request->get('button_action') == 'update'){
            $customer = Customer::find($request->get('id'));
            $customer->fname = $request->get('fname');
            $customer->mname = $request->get('mname');
            $customer->lname = $request->get('lname');
            if($request->get('suki_type') == 'YES'){
                $customer->suki_type = 1;
            }
            else{
                $customer->suki_type = 0;
            }
            $customer->save();
        }
    }

    public function refresh()
    {
        $customer = Customer::all();
        return \DataTables::of(Customer::query())
        ->addColumn('action', function($customer){
            return '<button class="btn btn-xs btn-warning update_customer" id="'.$customer->id.'"><i class="material-icons">mode_edit</i></button>&nbsp
            <button class="btn btn-xs btn-danger delete_customer" id="'.$customer->id.'"><i class="material-icons">delete</i></button>';
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
            'suki_type' => $customer->suki_type
        );
        echo json_encode($output);
    }

    function deletedata(Request $request){
        $customer = Customer::find($request->input('id'));
        $customer->delete();
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
