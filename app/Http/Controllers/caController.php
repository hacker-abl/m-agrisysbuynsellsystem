<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Database\Query\Builder;
use App\ca;
use App\Customer;
use App\balance;
use App\Notification;
use Auth;

class caController extends Controller
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
    public function index(){
        $customer = Customer::all();

        return view('main.ca', compact('customer'));
    }

    public function store(Request $request){
        $ca = new ca;
        $ca->customer_id = $request->customer_id;
        $ca->reason = $request->reason;
        $ca->amount = $request->amount;
        $ca->balance = $request->balance + $request->amount;
        $ca->save();

        if($ca) {
            $notification = new Notification;
            $notification->notification_type = "Cash Advance";
            $notification->message = "Cash Advance";
            $notification->status = "Pending";
            $notification->admin_id = Auth::id();
            $notification->cash_advance_id = $ca->id;
            $notification->save();

            $datum = Notification::where('id', $notification->id)->with('admin', 'cash_advance')->get();

            // return $datum;
            $notification = array();

            $notification = array(
                'notifications' => $datum[0],
                'customer' => $datum[0]->cash_advance->customer,
                'time' => time_elapsed_string($datum[0]->updated_at),
            );

            event(new \App\Events\NewNotification($notification));
        }

        $balance = balance::where('customer_id', '=',$request->customer_id)
                 ->increment('balance',  $request->amount);
    }

    public function refresh(){
        $join = DB::table('cash_advance')
            ->select(DB::raw('max(created_at) as maxdate'), 'customer_id')
            ->groupBy('customer_id');
        $sql = '(' . $join->toSql() . ') as ca2';

        $cash_advance = DB::table('cash_advance as ca1')
            ->select('ca1.*', 'cus.fname', 'cus.mname', 'cus.lname','balance.balance')
            ->join(DB::raw($sql), function($join){
                $join->on('ca2.customer_id', '=', 'ca1.customer_id')
                    ->on('ca2.maxdate', '=', 'ca1.created_at');
            })
            ->leftJoin('customer as cus', 'ca1.customer_id', '=', 'cus.id')
             ->join('balance', 'balance.customer_id', '=', 'ca1.customer_id')
            ->orderBy('ca1.created_at', 'desc')
            ->get();
        return \DataTables::of($cash_advance)
        ->addColumn('action', function($cash_advance){
            return '<button class="btn btn-xs btn-info  waves-effect view_cash_advance" id="'.$cash_advance->customer_id.'"><i class="material-icons" style="width: 25px;">visibility</i></button>';//info/visibility
        })
        ->editColumn('balance', function ($data) {
            return '₱'.number_format($data->balance, 2, '.', ',');
        })
        ->editColumn('amount', function ($data) {
            return '₱'.number_format($data->amount, 2, '.', ',');
        })
        ->make(true);
    }

    public function refresh_view(Request $request){
        $id = $request->input('id');
        $cash_advance = DB::table('cash_advance')
            ->join('customer', 'customer.id', '=', 'cash_advance.customer_id')
            ->select('cash_advance.customer_id', 'customer.fname', 'customer.mname', 'customer.lname', 'cash_advance.reason', 'cash_advance.amount', 'cash_advance.created_at', 'cash_advance.balance')
            ->where('cash_advance.customer_id', $id)
            ->latest();
        return \DataTables::of($cash_advance)
        ->editColumn('balance', function ($data) {
           return '₱'.number_format($data->balance, 2, '.', ',');
        })
        ->editColumn('amount', function ($data) {
            return '₱'.number_format($data->amount, 2, '.', ',');
        })
        ->make(true);


        echo json_encode($cash_advance);
    }

    public function check_balance(Request $request){
        //$balance = ca::where('customer_id', $request->id)->orderBy('customer_id', 'desc')->latest()->get();
        $balance = balance::where('customer_id', '=', $request->id)
                   ->get();
        echo json_encode($balance);
    }
}
