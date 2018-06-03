<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use DB;
use App\Commodity;
use App\sales;
use App\Company;
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
            $sales->save();
          }

        if($request->get('button_action') == 'update'){
          $sales= new sales;
          $sales= sales::find($request->get('id'));
          $sales->commodity_id = $request->commodity;
          $sales->company_id = $request->company;
          $sales->kilos = $request->kilos;
          $sales->amount = $request->amount;
          $sales->save();
        }
    }

    function updatedata(Request $request){
        $id = $request->input('id');
        $sales = sales::find($id);
        $output = array(
            'commodity_id' => $sales->commodity_id,
            'company_id' => $sales->company_id,
            'kilos' => $sales->kilos,
            'amount' => $sales->amount,
        );
        echo json_encode($output);
    }

    function deletedata(Request $request){
        $sales = sales::find($request->input('id'));
        $sales->delete();
    }

    public function refresh()
    {
        //$user = User::all();
        $ultimatesickquery= DB::table('sales')
            ->join('commodity', 'commodity.id', '=', 'sales.commodity_id')
            ->join('company', 'company.id', '=', 'sales.company_id')
            ->select('sales.id','commodity.name AS commodity_name','sales.kilos','sales.amount','company.name')
            ->get();
        return \DataTables::of($ultimatesickquery)
        ->addColumn('action', function(  $ultimatesickquery){
            return '<button class="btn btn-xs btn-warning update_sales  waves-effect" id="'.$ultimatesickquery->id.'"><i class="material-icons">mode_edit</i></button>&nbsp
            <button class="btn btn-xs btn-danger delete_sales  waves-effect" id="'.$ultimatesickquery->id.'"><i class="material-icons">delete</i></button>';
        })
        ->make(true);
    }
}
