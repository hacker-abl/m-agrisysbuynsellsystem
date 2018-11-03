<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use App\Customer;
use App\balance;
use App\paymentlogs;
use App\Events\BalanceUpdated;

class balanceController extends Controller
{
	public function __construct()
	{
	    $this->middleware('auth');
	}



	public function refresh()
	{
		//$user = User::all();
          $ultimatesickquery= DB::table('balance')
              ->join('customer', 'customer.id', '=', 'balance.customer_id')
			  ->select('balance.id','balance.customer_id','balance.balance','customer.fname','customer.mname','customer.lname')
			  ->where('balance.balance' ,'!=','0')
            //  ->orderBy('purchases.id', 'desc')
              ->get();
		    return \DataTables::of($ultimatesickquery)
		    ->addColumn('action', function($ultimatesickquery){
			   return '<button class="btn btn-xs btn-info waves-effect view_balance" id="'.$ultimatesickquery->customer_id.'"><i class="material-icons" style="width: 25px;">visibility</i></button>';//info/visibility
		    })
		    ->editColumn('balance', function ($data) {
     		  return '₱'.number_format($data->balance, 2, '.', ',');
     	    })
		     ->make(true);
	}

	public function balance(Request $request){
		$id = $request->input('id');
		$balance = DB::table('payment_logs')
			->join('customer', 'customer.id', '=', 'payment_logs.logs_id')
			->select('customer.fname','customer.mname','customer.lname','payment_logs.logs_id','payment_logs.paymentmethod','payment_logs.checknumber','payment_logs.paymentamount','payment_logs.created_at' )
			->where('payment_logs.logs_id', $id)
			->orderBy('payment_logs.created_at', 'desc')
			->get();
		return \DataTables::of($balance)

		->make(true);
		echo json_encode($balance);
	}

	public function store(Request $request){
	    $paymentlogs = new paymentlogs;
	    $paymentlogs->logs_id = $request->customer_id1;
	    $paymentlogs->paymentmethod = $request->paymentmethod;
	    if( $request->checknumber!=""){
			$paymentlogs->checknumber = $request->checknumber;
	    }
	    else{
			$paymentlogs->checknumber = "Not Specified";
	    }
	    $paymentlogs->paymentamount = $request->amount1;
	    $paymentlogs->save();
	    if($request->balance2 == $request->amount1){
			$balance = balance::find($request->customer_id1);
			$balance->balance = 0;
			$balance->save();
		}
	
	    else{
		    $balance = balance::where('customer_id', '=',$request->customer_id1)
				->decrement('balance', $request->amount1);
			}
			
			event(new BalanceUpdated($paymentlogs));
	}
}
