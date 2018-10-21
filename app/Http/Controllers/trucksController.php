<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Trucks;
class trucksController extends Controller
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

        return view('settings.trucks');
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
            $trucks = new Trucks;
            $trucks->name = $request->name;
            $trucks->plate_no = $request->plate_no;
            $trucks->save();
        }
        if($request->get('button_action') == 'update'){
            $trucks = Trucks::find($request->get('id'));
            $trucks->name = $request->get('name');
            $trucks->plate_no = $request->get('plate_no');
            $trucks->save();
        }
    }

    public function refresh()
    {
        $trucks = Trucks::all();
        return \DataTables::of(Trucks::query())
        ->addColumn('action', function($trucks){
            if(isAdmin()){
                return '<button class="btn btn-xs btn-warning update_trucks waves-effect" id="'.$trucks->id.'"><i class="material-icons">mode_edit</i></button>
                <button class="btn btn-xs btn-danger delete_trucks waves-effect" id="'.$trucks->id.'"><i class="material-icons">delete</i></button>';
            }
            else{
                return 'Admin';
            }
        })
        ->make(true);
    }

    function updatedata(Request $request){
        $id = $request->input('id');
        $trucks = Trucks::find($id);
        $output = array(
            'name' => $trucks->name,
            'plate_no' => $trucks->plate_no
        );
        echo json_encode($output);
    }

    function deletedata(Request $request){
        $trucks = Trucks::find($request->input('id'));
        $trucks->delete();
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
