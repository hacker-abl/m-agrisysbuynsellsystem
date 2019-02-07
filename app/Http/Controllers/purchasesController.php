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
use App\paymentlogs;
use App\Notification;
use App\UserPermission;
use App\User;
use App\Cash_History;
use App\Roles;
use Carbon\Carbon;
use App\Events\PurchasesUpdated;
use App\Events\BalanceUpdated;
use App\Events\CashierCashUpdated;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Response;
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
            if($expense->status == 'Released'){
                return 2;
            }
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
            if ($request->cash != ""){
                $purchases->balance_id = $request->cash;
            }
            else if ($request->cash == ""){
                $purchases->balance_id = 0;
            }
            if ($request->partial != ""){
                $purchases->partial = $request->partial;
            }
            else if ($request->partial == ""){
                $purchases->partial = 0;
            }
            $purchases->kilo = $request->kilo;
            $purchases->price = $request->price;
            $purchases->type = $request->type1;
            $purchases->tare = $request->tare;
            $purchases->moist = $request->moist;
            $purchases->net = $request->net;
            $purchases->total = $request->total;
            $purchases->amtpay= $request->amount;
            $purchases->remarks= $request->remarks;
            $purchases->status = "On-Hand";
            $purchases->released_by='';
            $purchases->save();
            // if ($request->cash != ""){
            //     $balance = balance::where('customer_id', $request->customer)->increment('balance',$request->cash);
            // }
            // if ($request->partial != ""){
            //     $balance = balance::where('customer_id', $request->customer)->decrement('balance',$request->partial);
            // }
            if($request->cash > 0){    
                $ca = new ca;
                $ca->pid = $purchases->id;
                $ca->customer_id = $request->customer;
                $ca->reason = "FROM PURCHASE (Cash Advance)";
                $ca->amount =  $request->cash - $request->partial;
                $ca->balance = 0;
                $ca->status = "On-Hand";
                $ca->released_by = '';
                $ca->save();
            
            
                if($ca) {
                    $notification = new Notification;
                    $notification->notification_type = "Cash Advance";
                    $notification->message = "Cash Advance";
                    $notification->status = "Pending";
                    $notification->admin_id = Auth::id();
                    $notification->table_source = "cash_advance";
                    $notification->cash_advance_id = $ca->id;
                    $notification->save();
        
                    $datum = Notification::where('id', $notification->id)
                        ->with('admin', 'cash_advance', 'expense', 'dtr.dtrId.employee', 'trip.tripId.employee')
                        ->get()[0];
        
                    $notification = array();
        
                    $notification = array(
                        'notifications' => $datum,
                        'customer' => $datum->cash_advance->customer,
                        'time' => time_elapsed_string($datum->updated_at),
                    );

                    event(new \App\Events\NewNotification($notification));
                }
            }
            if( $request->partial > 0){
                $paymentlogs = new paymentlogs;
                $paymentlogs->logs_id = $request->customer;
                $paymentlogs->paymentmethod = 'FROM PURCHASE CA';
                $paymentlogs->checknumber = "Not Specified";
                $paymentlogs->paymentamount = $request->partial;
                $paymentlogs->save();
                event(new BalanceUpdated($paymentlogs));
            }
        }
        if($request->get('button_action1') == 'update'){
            $check_admin =Auth::user()->access_id;
            $purchases=  Purchases::find($request->get('id'));
            $ca =  ca::where('pid',$request->get('id'))->first();
            if($ca->status == 'Released'){
                $balance1 = balance::where('customer_id', $ca->customer_id)->first();   
                $balance1->balance =  $request->balance;
                $balance1->save();
              
                $user = User::find(Auth::user()->id);
                
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

                $previousCash = $user->cashOnHand;

                $user->cashOnHand = $user->cashOnHand  - $request->cash + $request->partial + $ca->amount;
                
                $cash_history->trans_no = $dateTime;
                $cash_history->previous_cash = $previousCash;
                $cash_history->cash_change = $previousCash - $user->cashOnHand;
                $cash_history->total_cash = $user->cashOnHand;
                $cash_history->type = "Adjustment - Purchases";
                $cash_history->save();
                
                $user->save();

                
            }
            $ca->amount = $request->cashLAST - $request->partialLAST + $request->cash - $request->partial;
            $ca->save();
        
            if($purchases->status=="Released"&&$check_admin==1){
            $purchases->trans_no = $request->ticket;
            $purchases->customer_id = $request->customerID;
            $purchases->commodity_id= $request->commodityID;
            $purchases->sacks = $request->sacks;
            $purchases->ca_id = $request->caID;
            if ($request->cash != ""){
                $purchases->balance_id = $request->cash;
            }
            else if ($request->cash == ""){
                $purchases->balance_id = 0;
            }
            if ($request->partial != ""){
                $purchases->partial = $request->partial;
            }
            else if ($request->partial == ""){
                $purchases->partial = 0;
            }
            $purchases->kilo = $request->kilo;
            $purchases->type = $request->type1;
            $purchases->tare = $request->tare;
            $purchases->moist = $request->moist;
            $purchases->net = $request->net;
            $purchases->price = $request->price;
            $purchases->total = $request->total;
            $purchases->amtpay= $request->amount;
            $purchases->remarks= $request->remarks;
            // $purchases->status = "On-Hand";
            $purchases->released_by='';
            $purchases->save();
           
            $user = User::find(Auth::user()->id);
            $output =  $user->cashOnHand;
            return  $output; 
            }else if($purchases->status=="On-Hand"){
            $purchases->trans_no = $request->ticket;
            $purchases->customer_id = $request->customerID;
            $purchases->commodity_id= $request->commodityID;
            $purchases->sacks = $request->sacks;
            $purchases->ca_id = $request->caID;
            $purchases->balance_id = $request->cash;
            $purchases->partial = $request->partial;
            $purchases->kilo = $request->kilo;
            $purchases->type = $request->type1;
            $purchases->tare = $request->tare;
            $purchases->moist = $request->moist;
            $purchases->net = $request->net;
            $purchases->price = $request->price;
            $purchases->total = $request->total;
            $purchases->amtpay= $request->amount;
            $purchases->remarks= $request->remarks;
            $purchases->status = "On-Hand";
            $purchases->released_by='';
            $purchases->save();

            // if($request->partial == 0){
            //     $balance = balance::where('customer_id', $request->customerID)->increment('balance',$request->partialLAST); 
            // }
            // if($request->cash == 0){
            //     $balance = balance::where('customer_id', $request->customerID)->decrement('balance',$request->cashLAST); 
            // }
            // $balance = balance::where('customer_id', $request->customerID)->decrement('balance',$request->partial); 
            // $balance = balance::where('customer_id', $request->customerID)->increment('balance',$request->cash);    
            }else if($purchases->status=="Released"&&$check_admin!=1){
                $user = User::find(Auth::user()->id);
                $output =  $user->cashOnHand;
                return  $output; 
            }
           
        }

        if( $request->get('stat') == 'new'){
            $customer = new Customer;
            $customer1 = $customer->where('fname', '=', $request->fname)
            ->where('mname', '=', $request->mname)
            ->where('lname', '=', $request->lname)
            ->count();
            $customer->fname = $request->fname;
            $customer->mname = $request->mname;
            $customer->lname = $request->lname;
             
            if($customer1 > 0){
                return response('Customer already exists!', 500);
            }
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
            if ($request->bal != ""){
                $purchases->balance_id = $request->bal;
            }
            else if ($request->bal == ""){
                $purchases->balance_id = 0;
            }
            if ($request->partialpayment != ""){
                $purchases->partial = $request->partialpayment;
            }
            else if ($request->partialpayment == ""){
                $purchases->partial = 0;
            }
            $purchases->kilo = $request->kilo1;
            $purchases->type = $request->type2;
            $purchases->tare = $request->tare2;
            $purchases->net = $request->net2;
            $purchases->moist = $request->moist2;
            $purchases->price = $request->price1;
            $purchases->total = $request->amount1;
            $purchases->amtpay= $request->amountpay1;
            $purchases->remarks= $request->remarks1;
            $purchases->status = "On-Hand";
            $purchases->released_by='';
            $purchases->save();
            
            if($request->bal > 0){
                $ca = new ca;
                $ca->pid = $purchases->id;
                $ca->customer_id = $request->customerid;
                $ca->reason = "FROM PURCHASE (Cash Advance)";
                if ($request->bal != ""){
                    $ca->amount =   $request->bal;
                }   
                else if ($request->bal == ""){
                    $ca->amount = 0;
                    $ca->balance = 0;
                }
                if ($request->partialpayment == ""){
                    $ca->amount = $request->bal;
                }
                if ($request->bal != "" && $request->partialpayment != ""){
                    $ca->amount = $request->bal - $request->partialpayment ;
                }
                $ca->status = "On-Hand";
                $ca->released_by = '';
                $ca->save();
            }
            if( $request->partialpayment > 0){
                $paymentlogs = new paymentlogs;
                $paymentlogs->logs_id = $request->customerid;
                $paymentlogs->paymentmethod = 'FROM PURCHASE CA';
                $paymentlogs->checknumber = "Not Specified";
                $paymentlogs->paymentamount = $request->partialpayment;
                $paymentlogs->save();
                event(new BalanceUpdated($paymentlogs));
            }
                
            if($request->cash > 0) {
                $notification = new Notification;
                $notification->notification_type = "Cash Advance";
                $notification->message = "Cash Advance";
                $notification->status = "Pending";
                $notification->admin_id = Auth::id();
                $notification->table_source = "cash_advance";
                $notification->cash_advance_id = $ca->id;
                $notification->save();
    
                $datum = Notification::where('id', $notification->id)
                    ->with('admin', 'cash_advance', 'expense', 'dtr.dtrId.employee', 'trip.tripId.employee')
                    ->get()[0];
    
                $notification = array();
    
                $notification = array(
                    'notifications' => $datum,
                    'customer' => $datum->cash_advance->customer,
                    'time' => time_elapsed_string($datum->updated_at),
                );
    
                event(new \App\Events\NewNotification($notification));
            }
            
        }
        $user = User::find(Auth::user()->id);
        $output =  $user->cashOnHand;
        return $output; 
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

            event(new PurchasesUpdated($released));
            event(new BalanceUpdated($released));
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

            event(new PurchasesUpdated($released));
            event(new BalanceUpdated($released));
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
       
        $output = array(
            'cashOnHand' => $user->cashOnHand,
            'cashHistory' => $dateTime
        );
        
        echo json_encode($output);
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
              ->select('purchases.created_at','purchases.id','purchases.trans_no','commodity.name AS commodity_name','purchases.sacks','purchases.net','purchases.tare','purchases.moist','purchases.type','purchases.balance_id','purchases.partial','purchases.kilo','purchases.price','purchases.total','purchases.amtpay','purchases.remarks','balance.balance','purchases.status','purchases.released_by','customer.fname','customer.mname','customer.lname')
              //->orderBy('purchases.id', 'desc')
              ->latest();
          }else{
              $ultimatesickquery= DB::table('purchases')
              ->join('customer', 'customer.id', '=', 'purchases.customer_id')
              ->join('commodity', 'commodity.id', '=', 'purchases.commodity_id')
              ->join('balance', 'balance.customer_id', '=', 'purchases.customer_id')
              ->select('purchases.created_at','purchases.id','purchases.trans_no','commodity.name AS commodity_name','purchases.sacks','purchases.net','purchases.tare','purchases.moist','purchases.type','purchases.balance_id','purchases.partial','purchases.kilo','purchases.price','purchases.total','purchases.amtpay','purchases.remarks','balance.balance','purchases.status','purchases.released_by', 'customer.fname','customer.mname','customer.lname')
              ->where('purchases.created_at', '>=', date('Y-m-d', strtotime($from))." 00:00:00")
              ->where('purchases.created_at','<=',date('Y-m-d', strtotime($to)) ." 23:59:59")
              //->orderBy('purchases.id', 'desc')
              ->latest();        
          }
       
        return \DataTables::of($ultimatesickquery)
        ->addColumn('action', function($ultimatesickquery){
            $userid= Auth::user()->id;
            if($userid != 1){
                $u = User::with('emp_name.cashier')->where('id', Auth::user()->id)->first();
                $userRole = $u->emp_name->cashier->role;
            }
            $permit = UserPermission::where('user_id',$userid)->where('permit',1)->where('permission_id',6)->get();
            if($userid!=1){
                 $delete=$permit[0]->permit_delete;  
                 $edit = $permit[0]->permit_edit;  
            }
            if($userid==1 && $ultimatesickquery->status=="On-Hand"){
                return '<button class="btn btn-xs btn-success release_purchase waves-effect" id="'.$ultimatesickquery->id.'"><i class="material-icons">eject</i></button>&nbsp;<button class="btn btn-xs btn-warning edit_purchase waves-effect" id="'.$ultimatesickquery->id.'"><i class="material-icons">mode_edit</i></button>&nbsp;<button class="btn btn-xs btn-danger delete_purchase waves-effect" id="'.$ultimatesickquery->id.'"><i class="material-icons">delete</i></button>';
            }
            if($userid != 1){
                if($userRole == 'PURCHASER' && $ultimatesickquery->status=='Released'){
                    return '<button class="btn btn-xs btn-danger released waves-effect" id="'.$ultimatesickquery->id.'"><i class="material-icons">done_all</i></button>';
                }
            }
            if($userid==1 && $ultimatesickquery->status=="Released"){
                return '<button class="btn btn-xs btn-danger released waves-effect" id="'.$ultimatesickquery->id.'"><i class="material-icons">done_all</i></button>&nbsp;<button class="btn btn-xs btn-warning edit_purchase waves-effect" id="'.$ultimatesickquery->id.'"><i class="material-icons">mode_edit</i></button>&nbsp;<button class="btn btn-xs btn-danger delete_purchase waves-effect" id="'.$ultimatesickquery->id.'"><i class="material-icons">delete</i></button>';
            }           
            if($userid!=1 && $ultimatesickquery->status=="On-Hand" && $delete==1 && $edit==1){
                return '<button class="btn btn-xs btn-success release_purchase waves-effect" id="'.$ultimatesickquery->id.'"><i class="material-icons">eject</i></button>&nbsp;<button class="btn btn-xs btn-warning edit_purchase waves-effect" id="'.$ultimatesickquery->id.'"><i class="material-icons">mode_edit</i></button>&nbsp;<button class="btn btn-xs btn-danger delete_purchase waves-effect" id="'.$ultimatesickquery->id.'"><i class="material-icons">delete</i></button>';
            }if($userid!=1 && $ultimatesickquery->status=="On-Hand" && $delete==0 && $edit==1){
                return '<button class="btn btn-xs btn-success release_purchase waves-effect" id="'.$ultimatesickquery->id.'"><i class="material-icons">eject</i></button>&nbsp;<button class="btn btn-xs btn-warning edit_purchase waves-effect" id="'.$ultimatesickquery->id.'"><i class="material-icons">mode_edit</i></button>';
            }if($userid!=1 && $ultimatesickquery->status=="On-Hand" && $delete==1 && $edit==0){
                return '<button class="btn btn-xs btn-success release_purchase waves-effect" id="'.$ultimatesickquery->id.'"><i class="material-icons">eject</i></button>&nbsp;<button class="btn btn-xs btn-danger delete_purchase waves-effect" id="'.$ultimatesickquery->id.'"><i class="material-icons">delete</i></button>';
            }if($userid!=1 && $ultimatesickquery->status=="On-Hand" && $delete==0 && $edit==0){
                return '<button class="btn btn-xs btn-success release_purchase waves-effect" id="'.$ultimatesickquery->id.'"><i class="material-icons">eject</i></button>';
            }else{
              return '<button class="btn btn-xs btn-danger released waves-effect" id="'.$ultimatesickquery->id.'"><i class="material-icons">done_all</i></button>';
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
        ->editColumn('moist', function ($data) {
            return $data->moist.'%';
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
        $ca =  ca::where('pid',$request->get('id'))->first();
        if($ca){
            if($ca->status == 'Released'){
                $balance = balance::where('customer_id', $ca->customer_id)->first();
                $balance->balance -= $ca->amount;
                $balance->save();
                $user = User::find(Auth::user()->id);
    
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
                $cash_history->cash_change = $ca->amount;
                $cash_history->total_cash = $user->cashOnHand + $ca->amount;
                $cash_history->type = "Released Purchase(CA) Deleted";
                $cash_history->save();
    
                $user->cashOnHand += $ca->amount;
                $user->save();
            }
            $ca->delete();
        }
        if($purchases->status=="Released"){
            $user = User::find(Auth::user()->id);
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
            $cash_history->cash_change = $purchases->amtpay;
            $cash_history->total_cash = $user->cashOnHand + $purchases->amtpay;
            $cash_history->type = "Released Purchase Deleted";
            $cash_history->save();

            $user->cashOnHand += $purchases->amtpay;
            $user->save();
            $output = $user->cashOnHand;
        
        $purchases->delete();
        
        return $output;
        }
       
        $purchases->delete();
        $user = User::find(Auth::user()->id);
        $output =  $user->cashOnHand;
        return $output;
    }

    function updatedata(Request $request){
        $id = $request->input('id');
        $commodity = Purchases::find($id);
        $customer = Customer::find($commodity->customer_id);
        $output = array(
            'customer_id' => $commodity->customer_id,
            'name' => $customer->lname .', '.$customer->fname.' '.$customer->mname,
            'trans_no' => $commodity->trans_no,
            'commodity_id' => $commodity->commodity_id,
            'sacks' => $commodity->sacks,
            'ca_id' => $commodity->ca_id,
            'balance_id' => $commodity->balance_id,
            'partial' => $commodity->partial,
            'kilo' => $commodity->kilo,
            'tare' => $commodity->tare,
            'type' => $commodity->type,
            'net' => $commodity->net,
            'moist' => $commodity->moist,
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
