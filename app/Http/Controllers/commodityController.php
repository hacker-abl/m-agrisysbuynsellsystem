<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Commodity;
use App\CommodityUpdate;

use Auth;
use App\UserPermission;
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
            $commodity->validation('create', $request->all());
            $commodity->name = $request->name;
            $commodity->price = $request->price;
            $commodity->suki_price = $request->suki_price;
            $commodity->save();
        }
        if($request->get('button_action') == 'update'){
            $commodity = new Commodity;
            $commodity = $commodity->validation('update', $request->all());
            $commodity->name = $request->get('name');
            $commodity->price = $request->get('price');
            $commodity->suki_price = $request->get('suki_price');
            $commodity->save();
            
            $commodityUpdate = CommodityUpdate::where('checked', '1')->get()->toArray();

            event(new \App\Events\CommodityUpdated($commodity->toArray()));
        }

        return response()->json('success');
    }

    public function refresh()
    {
        $commodity = Commodity::all();
        return \DataTables::of(Commodity::query())
        ->addColumn('action', function($commodity){

            $userid= Auth::user()->id;
            $permit = UserPermission::where('user_id',$userid)->where('permit',1)->where('permission_id',12)->get();
            if($userid!=1){
                $delete=$permit[0]->permit_delete;  
                $edit = $permit[0]->permit_edit;
            }   
            
            if(isAdmin()){
                return '<button class="btn btn-xs btn-warning update_commodity waves-effect" id="'.$commodity->id.'"><i class="material-icons">mode_edit</i></button>&nbsp;
                <button class="btn btn-xs btn-danger delete_commodity waves-effect" id="'.$commodity->id.'"><i class="material-icons">delete</i></button>';
            }
            if($userid!=1 && $delete==1 && $edit==1){
                return '<button class="btn btn-xs btn-warning update_commodity waves-effect" id="'.$commodity->id.'"><i class="material-icons">mode_edit</i></button>&nbsp;
                <button class="btn btn-xs btn-danger delete_commodity waves-effect" id="'.$commodity->id.'"><i class="material-icons">delete</i></button>';
            }if($userid!=1 && $delete==0 && $edit==1){
                return '<button class="btn btn-xs btn-warning update_commodity waves-effect" id="'.$commodity->id.'"><i class="material-icons">mode_edit</i></button>';
            }if($userid!=1 && $delete==1 && $edit==0){
                return '<button class="btn btn-xs btn-danger delete_commodity waves-effect" id="'.$commodity->id.'"><i class="material-icons">delete</i></button>';
            }if($userid!=1 && $delete==0 && $edit==0){
                return 'No Action Permitted';
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
    public function show($id = null)
    {
        if(!$id) {
            $commodity = CommodityUpdate::where('checked', '1')->count();

            if($commodity) {
                return json_encode(true);
            } else return json_encode(false);
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id = null)
    {
        if(!$id) {
            $commodity = CommodityUpdate::where('checked', '1')->update(['checked' => '0']);

            echo json_encode($commodity);
        }
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
