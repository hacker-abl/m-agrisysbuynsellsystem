<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use DB;
use App\Commodity;
use App\sales;
use App\Company;
use Carbon\Carbon;
use App\Events\SalesUpdated;
use Auth;
class salesController extends Controller
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

        // $driver= DB::table('employee')
          //  ->join('roles', 'roles.id', '=', 'employee.role_id')
          //  ->select('employee.*','employee.id AS emp_id',  'roles.id','roles.role')
          //  ->where('roles.role','LIKE','%driver%')
          //  ->get();

        $commodity = Commodity::all();
        $company = Company::all();

        return view('main.sales')->with(compact('commodity','company'));
    }

    public function store(Request $request)
    {
          if($request->get('button_action') == 'add'){
            $sales= new sales;
            $sales->commodity_id = $request->commodity;
            $sales->company_id = $request->company;
            $sales->kilos = $request->kilos;
            $sales->amount = $request->amount;
            $sales->receiver_id = Auth::user()->id;
            if( $request->checknumber!=""){
                $sales->check_number = $request->checknumber;
            }
            else{
                $sales->check_number = "Not Specified";
            }
            $sales->save();
          }

        if($request->get('button_action') == 'update'){
          $sales= new sales;
          $sales= sales::find($request->get('id'));
          $sales->commodity_id = $request->commodity;
          $sales->company_id = $request->company;
          $sales->kilos = $request->kilos;
          $sales->amount = $request->amount;
          $sales->receiver_id = Auth::user()->id;
            if( $request->checknumber!=""){
                $sales->check_number = $request->checknumber;
            }
            if( $request->checknumber==""){
                $sales->check_number = "Not Specified";
            }
          $sales->save();
        }

        //$totalSalesToday = sales::whereDate('created_at', Carbon::today())->get([DB::raw('SUM(amount) AS total_sales')]);
        
        event(new SalesUpdated($sales));
    }

    function updatedata(Request $request){
        $id = $request->input('id');
        $sales = sales::find($id);
        $output = array(
            'commodity_id' => $sales->commodity_id,
            'company_id' => $sales->company_id,
            'kilos' => $sales->kilos,
            'amount' => $sales->amount,
            'check_number' => $sales->check_number ,
        );
        echo json_encode($output);
    }

    function deletedata(Request $request){
        $sales = sales::find($request->input('id'));
        $sales->delete();
    }

    public function refresh(Request $request)
    {
        $from = $request->date_from;
        $to = $request->date_to; 

        if($to==""){
         $ultimatesickquery= DB::table('sales')
            ->join('commodity', 'commodity.id', '=', 'sales.commodity_id')
            ->join('company', 'company.id', '=', 'sales.company_id')
            ->join('users', 'users.id', '=', 'sales.receiver_id')
            ->select('sales.id','sales.created_at','commodity.name AS commodity_name','sales.kilos','sales.amount','company.name','users.name as uname','sales.check_number')
            ->latest();
        }else{
           $ultimatesickquery= DB::table('sales')
            ->join('commodity', 'commodity.id', '=', 'sales.commodity_id')
            ->join('company', 'company.id', '=', 'sales.company_id')
            ->join('users', 'users.id', '=', 'sales.receiver_id')
            ->select('sales.id','sales.created_at','commodity.name AS commodity_name','sales.kilos','sales.amount','company.name','users.name as uname','sales.check_number')
            ->where('sales.created_at', '>=', date('Y-m-d', strtotime($from))." 00:00:00")
            ->where('sales.created_at','<=',date('Y-m-d', strtotime($to)) ." 23:59:59")
            ->latest();
               
                      
        }   
        
        return \DataTables::of($ultimatesickquery)
        ->addColumn('action', function(  $ultimatesickquery){
            return '<div class="btn-group"><button class="btn btn-xs btn-warning update_sales  waves-effect" id="'.$ultimatesickquery->id.'"><i class="material-icons">mode_edit</i></button>
            <button class="btn btn-xs btn-danger delete_sales  waves-effect" id="'.$ultimatesickquery->id.'"><i class="material-icons">delete</i></button></div>';
        })
        ->editColumn('amount', function ($data) {
            return '₱'.number_format($data->amount, 2, '.', ',');
        })
        ->editColumn('amount', function ($data) {
            return '₱ '.number_format($data->amount, 2, '.', ',');
        })
         ->editColumn('created_at', function ($data) {
            return date('F d, Y g:i a', strtotime($data->created_at));
        })
        ->make(true);
    }
}
