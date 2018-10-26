<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Commodity;
class commodityController extends Controller
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

        return view('settings.commodity');
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
            $commodity = new Commodity;
            $commodity->name = $request->name;
            $commodity->price = $request->price;
            $commodity->suki_price = $request->suki_price;
            $commodity->save();
        }
        if($request->get('button_action') == 'update'){
            $commodity = Commodity::find($request->get('id'));
            $commodity->name = $request->get('name');
            $commodity->price = $request->get('price');
            $commodity->suki_price = $request->get('suki_price');
            $commodity->save();
        }

    }

    public function refresh()
    {
        $commodity = Commodity::all();
        return \DataTables::of(Commodity::query())
        ->addColumn('action', function($commodity){
            if(isAdmin()){
                return '<button class="btn btn-xs btn-warning update_commodity waves-effect" id="'.$commodity->id.'"><i class="material-icons">mode_edit</i></button>
                <button class="btn btn-xs btn-danger delete_commodity waves-effect" id="'.$commodity->id.'"><i class="material-icons">delete</i></button>';
            }
            else{
                return 'Admin';
            }
        })
        ->editColumn('price', function ($data) {
            return '₱'.number_format($data->price, 2, '.', ',');
        })
        ->editColumn('suki_price', function ($data) {
            return '₱'.number_format($data->suki_price, 2, '.', ',');
        })
        ->make(true);
    }

    function updatedata(Request $request){
        $id = $request->input('id');
        $commodity = Commodity::find($id);
        $output = array(
            'name' => $commodity->name,
            'price' => $commodity->price,
            'suki_price' => $commodity->suki_price
        );
        echo json_encode($output);
    }

    function deletedata(Request $request){
        $commodity = Commodity::find($request->input('id'));
        $commodity->delete();
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
