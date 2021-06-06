<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use App\Customer;
use App\balance;
use App\paymentlogs;
use App\Events\BalanceUpdated;
use App\User;
use Auth;
use App\Cash_History;
use Carbon\Carbon;

class balanceController extends Controller
{
	public function __construct()
	{
	    $this->middleware('auth');
	}



	public function refresh()
	{
		//$user = User::all();
		$join = DB::table('payment_logs')
            ->select(DB::raw('max(created_at) as maxdate'), 'logs_id','status')
            ->groupBy('logs_id');
        $sql = '(' . $join->toSql() . ') as ca2';
          $ultimatesickquery= DB::table('balance')
			  ->join('customer', 'customer.id', '=', 'balance.customer_id')
			  ->join(DB::raw($sql), function($join){
                $join->on('ca2.logs_id', '=', 'balance.customer_id');
            	})
			  ->select('balance.id','balance.customer_id','balance.balance','customer.fname','customer.mname','customer.lname','ca2.maxdate as maxdate')
			  ->whereExists(function ($query) {
				$query->select("payment_logs.logs_id")
					  ->from('payment_logs')
					  ->whereRaw('payment_logs.logs_id = balance.customer_id');
			})->get();
			//   ->where('balance.balance','!=','0')->get();
		    return \DataTables::of($ultimatesickquery)
		    ->addColumn('action', function($ultimatesickquery){
			return '<button class="btn btn-xs btn-info waves-effect view_balance" id="'.$ultimatesickquery->customer_id.'"><i class="material-icons" style="width: 25px;">visibility</i></button>';//info/visibility
		    })
		    ->editColumn('balance', function ($data) {
     		  return number_format($data->balance, 2, '.', ',');
     	    })
		     ->make(true);
	}
	public function hasbalance()
	{
		//$user = User::all();
		$join = DB::table('payment_logs')
            ->select(DB::raw('max(created_at) as maxdate'), 'logs_id','status')
            ->groupBy('logs_id');
        	$sql = '(' . $join->toSql() . ') as ca2';
          $ultimatesickquery= DB::table('balance')
			  ->join('customer', 'customer.id', '=', 'balance.customer_id')
			  ->join(DB::raw($sql), function($join){
                $join->on('ca2.logs_id', '=', 'balance.customer_id');
            	})
			  ->select('balance.id','balance.customer_id','balance.balance','customer.fname','customer.mname','customer.lname','ca2.maxdate as maxdate','ca2.status as status')
			  ->where('balance.balance','!=','0')
			  ->get();
		    return \DataTables::of($ultimatesickquery)
		    ->addColumn('action', function($ultimatesickquery){
				if($ultimatesickquery->status=="Not Received"){
					return '<button class="btn btn-xs btn-warning waves-effect view_balance" id="'.$ultimatesickquery->customer_id.'"><i class="material-icons" style="width: 25px;">visibility</i></button><span class="badge-notify-parent"><span class="badge badge-notify">!</span></span>';//info/visibility	
				}else{
					return '<button class="btn btn-xs btn-info waves-effect view_balance" id="'.$ultimatesickquery->customer_id.'"><i class="material-icons" style="width: 25px;">visibility</i></button>';//info/visibility
				}
			  
		    })
		    ->editColumn('balance', function ($data) {
     		  return number_format($data->balance, 2, '.', ',');
     	    })
		     ->make(true);
	}

	public function toReceive()
	{
		//$user = User::all();
		$join = DB::table('payment_logs')
            ->select(DB::raw('max(created_at) as maxdate'), 'logs_id')
            ->groupBy('logs_id');
			$sql = '(' . $join->toSql() . ') as ca2';
			$join2 = DB::table('payment_logs')
            ->select(DB::raw('max(created_at) as maxdate'), 'logs_id','status')
            ->groupBy('logs_id','status');
        	$sql2 = '(' . $join2->toSql() . ') as ca3';
          $ultimatesickquery= DB::table('balance')
			  ->join('customer', 'customer.id', '=', 'balance.customer_id')
			  ->join(DB::raw($sql), function($join){
                $join->on('ca2.logs_id', '=', 'balance.customer_id');
				})
			->join(DB::raw($sql2), function($join2){
				$join2->on('ca3.logs_id', '=', 'balance.customer_id');
			})
			  ->select('balance.id','balance.customer_id','balance.balance','customer.fname','customer.mname','customer.lname','ca2.maxdate as maxdate','ca3.status')
			  ->where('ca3.status','=','Not Received')
			  ->where('balance.balance','!=','0')
			  ->get();
		    return \DataTables::of($ultimatesickquery)
		    ->addColumn('action', function($ultimatesickquery){
				if($ultimatesickquery->status=="Not Received"){
					return '<button class="btn btn-xs btn-warning waves-effect view_balance" id="'.$ultimatesickquery->customer_id.'"><i class="material-icons" style="width: 25px;">visibility</i></button>';//info/visibility	
				}else{
					return '<button class="btn btn-xs btn-info waves-effect view_balance" id="'.$ultimatesickquery->customer_id.'"><i class="material-icons" style="width: 25px;">visibility</i></button>';//info/visibility
				}
			  
		    })
		    ->editColumn('balance', function ($data) {
     		  return number_format($data->balance, 2, '.', ',');
     	    })
		     ->make(true);
	}

	public function balance(Request $request){
		$id = $request->input('id');
		$balance = DB::table('payment_logs')
			->join('customer', 'customer.id', '=', 'payment_logs.logs_id')
			->select('customer.fname','customer.mname','customer.lname','payment_logs.id','payment_logs.logs_id','payment_logs.paymentmethod','payment_logs.checknumber','payment_logs.paymentamount','payment_logs.created_at','payment_logs.status','payment_logs.received_by' )
			->where('payment_logs.logs_id', $id)
			->orderBy('payment_logs.created_at', 'desc')
			->get();
			 
		return \DataTables::of($balance)
		->addColumn('action', function($balance){
			if($balance->status!="Received"&&$balance->status!=NUll){
				return '<button class="btn btn-xs btn-success receive_payment_customer waves-effect" id="'.$balance->id.'" ><i class="material-icons">eject</i></button>&nbsp&nbsp<button class="btn btn-xs btn-danger delete_customer_payment waves-effect" id="'.$balance->id.'" ><i class="material-icons">delete</i></button>';
			}if($balance->status==NUll){
				return 'Old Data';
			}
			else{
				return '<button class="btn btn-xs btn-danger released waves-effect" id="'.$balance->id.'"><i class="material-icons">done_all</i></button>&nbsp&nbsp<button class="btn btn-xs btn-danger delete_customer_payment waves-effect" id="'.$balance->id.'" ><i class="material-icons">delete</i></button>';
			}
		})
		->make(true);
		echo json_encode($balance);
	} 

	public function add_payment(Request $request){
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
		$paymentlogs->status="Not Received";
		$paymentlogs->received_by="NONE";
	    $paymentlogs->save();
        $output = array(
            'cashOnHand' => 0,
            'cashHistory'=> 0,
            'user'       => Auth::user()->id,
        );
        
        echo json_encode($output);    
			
			event(new BalanceUpdated($paymentlogs));
	}
	public function delete_payment(Request $request){
		 
		$ca = paymentlogs::find($request->input('id'));
		$balance=balance::find($ca->logs_id)->first();
		if($ca->status=="Received"){
			$user = User::find(Auth::user()->id);
			$user_current =  $user->cashOnHand;
			$user->cashOnHand -= $ca->paymentamount;
			$user->save();
			$balance = balance::where('customer_id', '=',$ca->logs_id)
				->increment('balance', $ca->paymentamount);
			$userGet = User::where('id', '=', Auth::user()->id)->first();
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
			$employeeName= Customer::where('id', '=', $ca->logs_id)->first();
			$cash_history->trans_no = $dateTime;
			$cash_history->previous_cash = $user_current;
			$cash_history->cash_change = $ca->paymentamount;
			$cash_history->total_cash = $user->cashOnHand;
			$cash_history->type = "Customer Balance Payment (".$employeeName->fname." ".$employeeName->lname.") Deleted";
			$cash_history->save();
			$ca->delete();  
			// $balance->balance=$balance->balance+$ca->paymentamount;
			// $balance->save();   

			$output = [
				'cashOnHand' => $user->cashOnHand,
				'cashHistory'=> $dateTime,
				'amount'=>$ca->paymentamount,
				'user'       => Auth::user()->id,
			];
		}else{
			$ca->delete();     
			$output = [
				'cashOnHand' => null,
				'cashHistory'=> null,
				'user'       => Auth::user()->id,
			];
		}
	    
        echo json_encode($output);    
	}
	public function receive(Request $request){
		$logged_user=Auth::user()->id;
	    $paymentlogs = paymentlogs::find($request->input('id'));
		
		$balance = balance::where('customer_id', '=',$paymentlogs->logs_id)
				->decrement('balance', $paymentlogs->paymentamount);
		$user = User::find($logged_user);
        $user_current =  $user->cashOnHand;
        $user->cashOnHand += $paymentlogs->paymentamount;
        $user->save();

        $userGet = User::where('id', '=', $logged_user)->first();
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
        $employeeName= Customer::where('id', '=', $paymentlogs->logs_id)->first();
        $cash_history->trans_no = $dateTime;
        $cash_history->previous_cash = $user_current;
        $cash_history->cash_change = $paymentlogs->paymentamount;
        $cash_history->total_cash = $user->cashOnHand;
        $cash_history->type = "Customer Balance Payment (".$employeeName->fname." ".$employeeName->lname.")";
		$cash_history->save();
		$paymentlogs->status="Received";
		$paymentlogs->received_by=$user->name;
		$paymentlogs->save();

        $output = [
            'cashOnHand' => $user->cashOnHand,
			'cashHistory'=> $dateTime,
			'amount'=>$paymentlogs->paymentamount,
            'user'       => Auth::user()->id,
		];
        
        echo json_encode($output);    
			
			event(new BalanceUpdated($paymentlogs));
	}
}
