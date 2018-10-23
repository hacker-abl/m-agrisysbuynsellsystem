<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use App\Commodity;
use App\Customer;
use App\ca;
use App\balance;
use App\purchases;
use App\employee;
use Auth;
use App\User;
use App\Cash_History;
use Carbon\Carbon;
use App\Events\PurchasesUpdated;
use App\Events\BalanceUpdated;
use App\Events\CashierCashUpdated;

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

    public function check_balance3(Request $request){
        $user = User::find(Auth::user()->id);
        $expense = purchases::find($request->id);

        if($user->cashOnHand < $expense->amtpay){
            return 0;
        }
        else{
            return 1;
        }
    }


    public function store(Request $request){

        
        if($request->get('button_action1') == 'add' && $request->get('stat1') == 'old'){
            
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
                $purchases->status = "On-Hand";
                $purchases->released_by='';
                $purchases->save();
            
       
            event(new PurchasesUpdated($purchases));
            event(new BalanceUpdated($purchases));
        }

        else{
                $customer = new Customer;
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
                $purchases->status = "On-Hand";
                $purchases->released_by='';
                $purchases->save();
            

            event(new PurchasesUpdated($purchases));
            event(new BalanceUpdated($purchases));
        }
        if($request->get('button_action1') == 'update'){
            $purchases=  Purchases::find($request->get('id'));;
            $purchases->trans_no = $request->ticket;
            $purchases->customer_id = $request->customerID;
            $purchases->commodity_id= $request->commodityID;
            $purchases->sacks = $request->sacks;
            $purchases->ca_id = $request->caID;
            $purchases->balance_id = $request->balance;
            $purchases->partial = $request->partial;
            $purchases->kilo = $request->kilo;
            $purchases->price = $request->price;
            $purchases->total = $request->total;
            $purchases->amtpay= $request->amount;
            $purchases->remarks= $request->remarks;
            $purchases->status = "On-Hand";
            $purchases->released_by='';
            $purchases->save();
        }
    }

    public function release_purchase(Request $request){
        $check_admin =Auth::user()->access_id;
        if($check_admin==1){
            $logged_id = Auth::user()->name;
            $user = User::find(Auth::user()->id);
            $released = purchases::find($request->id);
            $released->status = "Released";
            $released->released_by = $logged_id;
            $released->save();

            $balance = balance::where('customer_id', '=',$request->customer)
            ->decrement('balance', $request->balance1 - $request->balance);
        }else{
            $logged_id = Auth::user()->emp_id;
            $name= employee::find($logged_id);
            $user = User::find(Auth::user()->id);

            $released = purchases::find($request->id);
            $released->status = "Released";
            $released->released_by = $name->fname." ".$name->mname." ".$name->lname;
            $released->save();

            $balance = balance::where('customer_id', '=',$request->customer)
            ->decrement('balance', $request->balance1 - $request->balance);
        }

        $userGet = User::where('id', '=', $user->id)->first();
        $cashLatest = Cash_History::orderBy('id', 'DESC')->first();
        $cash_history = new Cash_History;
        $cash_history->user_id = $userGet->id;

        $getDate = Carbon::now();
        
        if($cashLatest != null){
            $dateTime = $getDate->year.$getDate->month.$getDate->day.$cashLatest->id+1;
        }
        else{
            $dateTime = $getDate->year.$getDate->month.$getDate->day.'1';
        }

        $cash_history->trans_no = $dateTime;
        $cash_history->previous_cash = $user->cashOnHand;
        $cash_history->cash_change = $released->amtpay;
        $cash_history->total_cash = $user->cashOnHand - $released->amtpay;
        $cash_history->type = "Release Cash - Purchases";
        $cash_history->save();

        $user->cashOnHand -= $released->amtpay;
        $user->save();
         
        event(new CashierCashUpdated());
        return $user->cashOnHand;
    }

    function updateId(){
        $temp = DB::select('select MAX(id) as "temp" FROM purchases');
        echo json_encode($temp);
    }

    function updatecustomerId(){
       $temp = DB::select('select MAX(id) as "temp" FROM customer');
       echo json_encode($temp);
    }

    public function refresh(Request $request){   
        $from = $request->date_from;
        $to = $request->date_to;    

        if($to==""&&$from==""){
          $ultimatesickquery= DB::table('purchases')
            ->join('customer', 'customer.id', '=', 'purchases.customer_id')
            ->join('commodity', 'commodity.id', '=', 'purchases.commodity_id')
            ->join('balance', 'balance.customer_id', '=', 'purchases.customer_id')
            ->select('purchases.created_at','purchases.id','purchases.trans_no','commodity.name AS commodity_name','purchases.sacks','purchases.balance_id','purchases.partial','purchases.kilo','purchases.price','purchases.total','purchases.amtpay','purchases.remarks','balance.balance','purchases.status','purchases.released_by','customer.fname','customer.mname','customer.lname')
            //->orderBy('purchases.id', 'desc')
            ->latest();
        }else{
            $ultimatesickquery= DB::table('purchases')
            ->join('customer', 'customer.id', '=', 'purchases.customer_id')
            ->join('commodity', 'commodity.id', '=', 'purchases.commodity_id')
            ->join('balance', 'balance.customer_id', '=', 'purchases.customer_id')
            ->select('purchases.created_at','purchases.id','purchases.trans_no','commodity.name AS commodity_name','purchases.sacks','purchases.balance_id','purchases.partial','purchases.kilo','purchases.price','purchases.total','purchases.amtpay','purchases.remarks','balance.balance','purchases.status','purchases.released_by', 'customer.fname','customer.mname','customer.lname')
            ->where('purchases.created_at', '>=', date('Y-m-d', strtotime($from))." 00:00:00")
            ->where('purchases.created_at','<=',date('Y-m-d', strtotime($to)) ." 23:59:59")
            //->orderBy('purchases.id', 'desc')
            ->latest();        
        }
       
        return \DataTables::of($ultimatesickquery)
        ->addColumn('action', function($ultimatesickquery){
            if($ultimatesickquery->status=="On-Hand"){
                return '<button class="btn btn-xs btn-success release_purchase waves-effect" id="'.$ultimatesickquery->id.'"><i class="material-icons">eject</i></button><button class="btn btn-xs btn-warning edit_purchase waves-effect" id="'.$ultimatesickquery->id.'"><i class="material-icons">mode_edit</i></button><button class="btn btn-xs btn-danger delete_purchase waves-effect" id="'.$ultimatesickquery->id.'"><i class="material-icons">delete</i></button>';
            }else{
                return '<button class="btn btn-xs btn-danger released waves-effect" id="'.$ultimatesickquery->id.'"><i class="material-icons">done_all</i></button><button class="btn btn-xs btn-warning edit_purchase waves-effect" id="'.$ultimatesickquery->id.'"><i class="material-icons">mode_edit</i></button><button class="btn btn-xs btn-danger delete_purchase waves-effect" id="'.$ultimatesickquery->id.'"><i class="material-icons">delete</i></button>';
            }
        })
        ->addColumn('wholename', function ($data){
            return $data->fname." ".$data->mname." ".$data->lname;
        })
        ->addColumn('commname', function ($data){
            return $data->commodity_name;
        })
        ->addColumn('balance', function ($data){
            return $data->balance;
        })
       
        ->editColumn('released_by', function ($data) {
            if($data->released_by==""){
                return "None";
            }else{
                return $data->released_by;
            }
        })
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
        ->editColumn('created_at', function ($data) {
            return date('F d, Y g:i a', strtotime($data->created_at));
        })
 
        ->make(true);
    }

    function deletedata(Request $request){
        $purchases = Purchases::find($request->input('id'));
        $purchases->delete();
    }

    function updatedata(Request $request){
        $id = $request->input('id');
        $commodity = Purchases::find($id);
        $output = array(
            'customer_id' => $commodity->customer_id,
            'trans_no' => $commodity->trans_no,
            'commodity_id' => $commodity->commodity_id,
            'sacks' => $commodity->sacks,
            'ca_id' => $commodity->ca_id,
            'balance_id' => $commodity->balance_id,
            'partial' => $commodity->partial,
            'kilo' => $commodity->kilo,
            'price' => $commodity->price,
            'total' => $commodity->total,
            'amtpay' => $commodity->amtpay,
            'remarks' => $commodity->remarks,
            'status' => $commodity->status,
            //'released_by' => $commodity->suki_price,
        );
        echo json_encode($output);
    }
}
