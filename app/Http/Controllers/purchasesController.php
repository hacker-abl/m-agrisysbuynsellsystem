<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use App\Commodity;
use App\Customer;
use App\ca;
use App\balance;
use App\Purchases;
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
         $balance = balance::where('customer_id', '=', $id)
               ->first();
         $customer = customer::where('id', '=', $id)
               ->first();

        $output = array(
               'balance' => $balance->balance,
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


    public function store(Request $request)
    {
          if($request->get('stat1') == 'old'){
            $purchases= new Purchases;
            $purchases->trans_no = $request->ticket;
            $purchases->customer_id = $request->customer;
            $purchases->commodity_id= $request->commodity;
            $purchases->sacks = $request->sacks;
            $purchases->ca_id = $request->customer;
            $purchases->balance_id = $request->balance;
            $purchases->partial = $request->partial;
            $purchases->kilo = $request->kilo;
            $purchases->price = $request->price;
            $purchases->total = $request->total;
            $purchases->amtpay= $request->amount;
            $purchases->remarks= $request->remarks;
            $purchases->save();

          $balance = balance::where('customer_id', '=',$request->customer)
                   ->decrement('balance', $request->balance1 - $request->balance);
              }

              if($request->get('stat') == 'new'){


                  $customer = new Customer;
                  $customer->fname = $request->fname;
                  $customer->mname = $request->mname;
                  $customer->lname = $request->lname;
                  $customer->suki_type = 0;
                  $customer->save();

                  $balance = new balance;
                  $balance->customer_id = $request->customerid;
                  $balance->balance = 0;
                  $balance->save();



               $purchases= new Purchases;
               $purchases->trans_no = $request->ticket1;
               $purchases->customer_id = $request->customerid;
               $purchases->commodity_id= $request->commodity1;
               $purchases->sacks = $request->sacks1;
               $purchases->ca_id = $request->customerid;
               $purchases->balance_id = 0;
               $purchases->partial = 0;
               $purchases->kilo = $request->kilo1;
               $purchases->price = $request->price1;
               $purchases->total = $request->amount1;
               $purchases->amtpay= $request->amount1;
               $purchases->remarks= $request->remarks1;
               $purchases->save();


                 }


    }

    function updateId(){
       $temp = DB::select('select MAX(id) as "temp" FROM purchases');
       echo json_encode($temp);
    }

    function updatecustomerId(){
       $temp = DB::select('select MAX(id) as "temp" FROM customer');
       echo json_encode($temp);
    }

    public function refresh()
    {
        //$user = User::all();
        $ultimatesickquery= DB::table('purchases')
            ->join('customer', 'customer.id', '=', 'purchases.customer_id')
            ->join('commodity', 'commodity.id', '=', 'purchases.commodity_id')
            ->join('balance', 'balance.customer_id', '=', 'purchases.customer_id')
            ->select('purchases.id','purchases.trans_no','commodity.name AS commodity_name','purchases.sacks','purchases.balance_id','purchases.partial','purchases.kilo','purchases.price','purchases.total','purchases.amtpay','purchases.remarks','balance.balance', 'customer.fname','customer.mname','customer.lname')
            ->get();
        return \DataTables::of($ultimatesickquery)
        ->editColumn('amtpay', function ($data) {
            return '₱'.number_format($data->amtpay, 2, '.', ',');
        })

        ->editColumn('price', function ($data) {
            return '₱'.number_format($data->price, 2, '.', ',');
        })

        ->editColumn('balance_id', function ($data) {
            return '₱'.number_format($data->balance_id, 2, '.', ',');
        })

        ->editColumn('balance', function ($data) {
            return '₱'.number_format($data->balance, 2, '.', ',');
        })

        ->editColumn('partial', function ($data) {
            return '₱'.number_format($data->partial, 2, '.', ',');
        })

        ->editColumn('total', function ($data) {
            return '₱'.number_format($data->total, 2, '.', ',');
        })
        ->make(true);
    }

}
