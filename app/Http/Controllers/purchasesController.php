<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use App\Commodity;
use App\Customer;
use App\ca;
class purchasesController extends Controller
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
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        $commodity = Commodity::all();
        $customer = Customer::all();
        $ca = ca::all();

        return view('main.purchases')->with(compact('commodity','customer','ca'));
    }

    function findAmount(Request $request){
         $id = $request->input('id');
         $ca = ca::where('customer_id', '=', $id)
               ->first();
         $customer = customer::where('id', '=', $id)
               ->first();

        $output = array(
               'amount' => $ca->amount,
               'balance' => $ca->balance,
               'suki_type'=> $customer->suki_type,
           );

         echo json_encode($output);
    }

    function findcomm(Request $request){
         $id = $request->input('id');

         $commodity = Commodity::where('id', '=', $id)
               ->first();

       $output = array(
               'price'=> $commodity->price,
               'suki_price'=> $commodity->suki_price,
           );

         echo json_encode($output);
    }

}
