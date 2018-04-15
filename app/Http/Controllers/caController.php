<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Database\Query\Builder;
use App\ca;
use App\Customer;
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
    }

    public function refresh(){
        $cash_advance = DB::select('
            SELECT p1.*, p3.fname, p3.mname, p3.lname 
            FROM cash_advance p1
            INNER JOIN(
                SELECT MAX(created_at) maxdate, customer_id
                FROM cash_advance
                GROUP BY customer_id
            ) p2
            ON p1.customer_id = p2.customer_id
            AND p1.created_at = p2.maxdate
            LEFT JOIN customer as p3 ON p1.customer_id = p3.id
            ORDER BY p1.created_at desc
        ');
        return \DataTables::of($cash_advance)
        ->addColumn('action', function($cash_advance){
            return '<button class="btn btn-xs btn-info view_cash_advance" id="'.$cash_advance->customer_id.'"><i class="material-icons" style="width: 25px;">visibility</i></button>';//info/visibility
        })
        ->make(true);
    }

    public function refresh_view(Request $request){
        $id = $request->input('id');
        $cash_advance = DB::table('cash_advance')
            ->join('customer', 'customer.id', '=', 'cash_advance.customer_id')
            ->select('cash_advance.customer_id', 'customer.fname', 'customer.mname', 'customer.lname', 'cash_advance.reason', 'cash_advance.amount', 'cash_advance.created_at', 'cash_advance.balance')
            ->where('cash_advance.customer_id', $id)
            ->get();
        return \DataTables::of($cash_advance)
        ->make(true);
        echo json_encode($cash_advance);
    }

    public function check_balance(Request $request){
        $balance = ca::where('customer_id', $request->id)->orderBy('customer_id', 'desc')->latest()->get();
        echo json_encode($balance);
    }
}
