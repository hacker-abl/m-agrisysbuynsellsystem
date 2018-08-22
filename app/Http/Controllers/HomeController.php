<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use App\User;
use App\UserPermission;
use App\paymentlogs;
use App\customer;
use App\commodity;
use App\trucks;
use App\purchases;
use App\sales;
use App\balance;
use App\expense;
use App\trip_expense;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Database\Query\Builder;
use Response;
use View;
use Carbon\Carbon;


class HomeController extends Controller
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
    public function index(Request $request)
    {
        $id = Auth::user()->id;
        $user = User::find($id);

        $paymentLogs = paymentlogs::orderBy('id', 'desc')->paginate(5);
        $commodityList = commodity::orderBy('id', 'desc')->paginate(6);
        $truckList = trucks::orderBy('id', 'desc')->paginate(6);
        $latestPurchases = purchases::orderBy('id', 'desc')->paginate(15);
        $topCommodities = purchases::groupBy('commodity_id')
            ->orderBy(DB::raw('SUM(total)'), 'desc')
            ->limit(4)
            ->get(['commodity_id', DB::raw('SUM(total) AS total')]);
        $latestCustomer = customer::latest()->first();

        $totalSales = sales::whereYear('created_at', Carbon::today()->year)->get([DB::raw('SUM(amount) AS total_sales')]);
        $totalPurchases = purchases::whereYear('created_at', Carbon::today()->year)->get([DB::raw('SUM(total) AS total_purchases')]);
        $totalBalance = balance::whereYear('created_at', Carbon::today()->year)->get([DB::raw('SUM(balance) AS total_balance')]);
        $totalExpense = expense::whereYear('created_at', Carbon::today()->year)->get([DB::raw('SUM(amount) AS total_expense')]);
        $totalTripExpense = trip_expense::whereDate('created_at', Carbon::today())->get([DB::raw('SUM(amount) AS total_trip_expense')]);

        $finalTotalExpense = $totalExpense[0]->total_expense + $totalTripExpense[0]->total_trip_expense;

        $totalSalesToday = sales::whereDate('created_at', Carbon::today())->get([DB::raw('SUM(amount) AS total_sales')]);
        $totalPurchasesToday = purchases::whereDate('created_at', Carbon::today())->get([DB::raw('SUM(total) AS total_purchases')]);
        $totalBalanceToday = balance::whereDate('created_at', Carbon::today())->get([DB::raw('SUM(balance) AS total_balance')]);
        $totalExpenseToday = expense::whereDate('created_at', Carbon::today())->get([DB::raw('SUM(amount) AS total_expense')]);
        $totalTripExpenseToday = trip_expense::whereDate('created_at', Carbon::today())->get([DB::raw('SUM(amount) AS total_trip_expense')]);

        $finalTotalExpenseToday = $totalExpenseToday[0]->total_expense + $totalTripExpenseToday[0]->total_trip_expense;

        $totalSalesMonth = sales::whereMonth('created_at', Carbon::today()->month)->get([DB::raw('SUM(amount) AS total_sales')]);
        $totalPurchasesMonth = purchases::whereMonth('created_at', Carbon::today()->month)->get([DB::raw('SUM(total) AS total_purchases')]);
        $totalBalanceMonth = balance::whereMonth('created_at', Carbon::today()->month)->get([DB::raw('SUM(balance) AS total_balance')]);
        $totalExpenseMonth = expense::whereMonth('created_at', Carbon::today()->month)->get([DB::raw('SUM(amount) AS total_expense')]);
        $totalTripExpenseMonth = trip_expense::whereMonth('created_at', Carbon::today()->month)->get([DB::raw('SUM(amount) AS total_trip_expense')]);

        $finalTotalExpenseMonth = $totalExpenseMonth[0]->total_expense + $totalTripExpenseMonth[0]->total_trip_expense;

        if($user->role->name === "admin") {
            return view('main.home', compact('paymentLogs', 'commodityList', 'truckList', 'latestPurchases', 'topCommodities', 'latestCustomer', 'totalSales', 'totalPurchases', 'totalBalance', 'finalTotalExpense', 'totalSalesToday', 'totalPurchasesToday', 'totalBalanceToday', 'finalTotalExpenseToday', 'totalSalesMonth', 'totalPurchasesMonth', 'totalBalanceMonth', 'finalTotalExpenseMonth'));
        } else if($user->role->name === "user") {
            $permissions = UserPermission::with('permission')->where('user_id', $id)->orderBy('permission_id')->get();
            
            return view('cashier.home', compact('permissions'));
        }
    }

    public function sales_today(){
        $totalSalesToday = sales::whereDate('created_at', Carbon::today())->get([DB::raw('SUM(amount) AS amount')]);
        
        return $totalSalesToday;
    }

    public function purchases_today(){
        $totalPurchasesToday = purchases::whereDate('created_at', Carbon::today())->get([DB::raw('SUM(total) AS total')]);
        
        return $totalPurchasesToday;
    }

    public function balance_today(){
        $totalBalanceToday = balance::whereDate('updated_at', Carbon::today())->get([DB::raw('SUM(balance) AS amount')]);
        
        return $totalBalanceToday;
    }

    public function expenses_today(){
        $totalExpenseToday = expense::whereDate('created_at', Carbon::today())->get([DB::raw('SUM(amount) AS total_expense')]);
        $totalTripExpenseToday = trip_expense::whereDate('created_at', Carbon::today())->get([DB::raw('SUM(amount) AS total_trip_expense')]);

        // $finalTotalExpenseToday = new \stdClass();
        $finalTotalExpenseToday = $totalExpenseToday[0]->total_expense + $totalTripExpenseToday[0]->total_trip_expense;
        $arr = array('amount' => $finalTotalExpenseToday);
        return response()->json([
            $arr
        ]);
    }


}
