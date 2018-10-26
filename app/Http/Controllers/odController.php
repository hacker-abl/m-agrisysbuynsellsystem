<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use DB;
use App\Employee;
use App\Commodity;
use App\Company;
use App\od_expense;
use App\od;
use App\Roles;
use App\trucks;
use Auth;
use App\User;
use App\Events\ExpensesUpdated;
use App\Events\CashierCashUpdated; 
use App\Notification;

class odController extends Controller
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
        $driver= DB::table('employee')
            ->join('roles', 'roles.id', '=', 'employee.role_id')
            ->select('employee.*','employee.id AS emp_id',  'roles.id','roles.role')
            ->where('roles.role','LIKE','%driver%')
            ->get();

        $commodity = Commodity::all();
        $company = Company::all();
        $trucks = Trucks::all();
        return view('main.od')->with(compact('driver','commodity','company','trucks'));
    }

    public function store(Request $request)
    {
          if($request->get('button_action') == 'add'){
            $commodity= new od;
            $commodity->outboundTicket = $request->ticket;
            $commodity->commodity_id = $request->commodity;
            $commodity->destination = $request->destination;
            $commodity->driver_id = $request->driver_id;
            $commodity->company_id = $request->company;
            $commodity->plateno = $request->plateno;
            $commodity->fuel_liters = $request->liter;
            $commodity->allowance = $request->allowance;
            $commodity->save();
            $lastInsertedId = $commodity->id;
            $od_expenses = new od_expense;
            $od_expenses->od_id = $lastInsertedId;
            $od_expenses->description = $request->destination;
            $od_expenses->type ="Outbound Expense";
            $od_expenses->amount = $request->allowance;
            $od_expenses->status = "On-Hand";
            $od_expenses->released_by = '';
            $od_expenses->save();
            $details =  DB::table('deliveries')->orderBy('outboundTicket', 'desc')->first();

            echo json_encode($details);
          }

        if($request->get('button_action') == 'update'){
          $commodity= new od;
          $commodity= od::find($request->get('id'));
          $commodity->outboundTicket = $request->ticket;
          $commodity->commodity_id = $request->commodity;
          $commodity->destination = $request->destination;
          $commodity->driver_id = $request->driver_id;
          $commodity->company_id = $request->company;
          $commodity->plateno = $request->plateno;
          $commodity->fuel_liters = $request->liter;
          $commodity->allowance = $request->allowance;
          $commodity->save();
        }
    }

    public function release_update_od(Request $request){
        $check_admin =Auth::user()->access_id;
       if($check_admin==1){
           $logged_id = Auth::user()->name;
           $user = User::find(Auth::user()->id);
           $released = od_expense::find($request->id);
           $released->status = "Released";
           $released->released_by = $logged_id;
           $released->save();
           $cashOnHand = User::find(Auth::user()->id);
           $cashOnHand->cashOnHand -= $released->amount;
           $cashOnHand->save();
       }else{
           $logged_id = Auth::user()->emp_id;
           $name= Employee::find($logged_id);             
           $released=od_expense::find($request->id);
           $released->status = "Released";
           $released->released_by = $name->fname." ".$name->mname." ".$name->lname;;
           $released->save();
           $cashOnHand = User::find(Auth::user()->id);
           $cashOnHand->cashOnHand -= $released->amount;
           $cashOnHand->save();
       }

       event(new CashierCashUpdated());
       return $cashOnHand->cashOnHand;
   }

    public function check_balance_od(Request $request){
       $user = User::find(Auth::user()->id);
       $expense = od_expense::find($request->id);

       if($user->cashOnHand < $expense->amount){
           return 0;
       }
       else{
           return 1;
       }
   }

    public function refresh(Request $request)
    {
        $from = $request->date_from;
        $to = $request->date_to;

        if($to==""){
         $ultimatesickquery= DB::table('deliveries')
            ->join('commodity', 'commodity.id', '=', 'deliveries.commodity_id')
            ->join('trucks', 'trucks.id', '=', 'deliveries.plateno')
            ->join('employee', 'employee.id', '=', 'deliveries.driver_id')
            ->join('company', 'company.id', '=', 'deliveries.company_id')
            ->select('deliveries.id','deliveries.outboundTicket','commodity.name AS commodity_name','trucks.plate_no AS plateno','deliveries.destination', 'employee.fname','employee.mname','employee.lname','company.name', 'deliveries.fuel_liters','deliveries.allowance','deliveries.created_at')
            ->latest();
        }else{
            $ultimatesickquery= DB::table('deliveries')
            ->join('commodity', 'commodity.id', '=', 'deliveries.commodity_id')
            ->join('trucks', 'trucks.id', '=', 'deliveries.plateno')
            ->join('employee', 'employee.id', '=', 'deliveries.driver_id')
            ->join('company', 'company.id', '=', 'deliveries.company_id')
            ->select('deliveries.id','deliveries.outboundTicket','commodity.name AS commodity_name','trucks.plate_no AS plateno','deliveries.destination', 'employee.fname','employee.mname','employee.lname','company.name', 'deliveries.fuel_liters','deliveries.allowance','deliveries.created_at')
            ->where('deliveries.created_at', '>=', date('Y-m-d', strtotime($from))." 00:00:00")
            ->where('deliveries.created_at','<=',date('Y-m-d', strtotime($to)) ." 23:59:59")
            ->latest();
        }
        //$user = User::all();
       
        return \DataTables::of($ultimatesickquery)
        ->addColumn('action', function(  $ultimatesickquery){
            return '<div class="btn-group"><button class="btn btn-xs btn-warning update_delivery waves-effect" id="'.$ultimatesickquery->id.'"><i class="material-icons">mode_edit</i></button>
            <button class="btn btn-xs btn-danger delete_delivery waves-effect" id="'.$ultimatesickquery->id.'"><i class="material-icons">delete</i></button></div>';
        })
        ->editColumn('allowance', function ($data) {
            return '₱'.number_format($data->allowance, 2, '.', ',');
        })
         ->editColumn('created_at', function ($data) {
            return date('F d, Y g:i a', strtotime($data->created_at));
        })
        ->make(true);
    }

    function updatedata(Request $request){
        $id = $request->input('id');
        $od = od::find($id);
        $output = array(
            'outboundTicket' => $od->outboundTicket,
            'commodity_id' => $od->commodity_id,
            'destination' => $od->destination,
            'driver_id' => $od->driver_id,
            'company_id' => $od->company_id,
            'plateno' => $od->plateno,
            'fuel_liters' => $od->fuel_liters,
            'allowance' => $od->allowance,
        );
        echo json_encode($output);
    }

    function updateId(){
       $temp = DB::select('select MAX(id) as "temp" FROM deliveries');
        echo json_encode($temp);
    }

    function deletedata(Request $request){
        $od = od::find($request->input('id'));
        $od->delete();
    }

    public function od_expense_view(Request $request)
    {
       $from = $request->date_from;
       $to = $request->date_to;
       if($to==""||$from==""){
          $od_expense = DB::table('deliveries')
            ->join('od_expense', 'od_expense.od_id', '=', 'deliveries.id')
            ->select('od_expense.id','deliveries.outboundTicket AS od_id','od_expense.description AS description','od_expense.type AS type','od_expense.amount AS amount','od_expense.status AS status','od_expense.released_by as released_by','od_expense.created_at as created_at')
            ->get();
        }else{
           
             $od_expense = DB::table('deliveries')
            ->join('od_expense', 'od_expense.od_id', '=', 'deliveries.id')
            ->select('od_expense.id','deliveries.outboundTicket AS od_id','od_expense.description AS description','od_expense.type AS type','od_expense.amount AS amount','od_expense.status AS status','od_expense.released_by as released_by','od_expense.created_at as created_at')
                ->where('od_expense.created_at', '>=', date('Y-m-d', strtotime($from))." 00:00:00")
                ->where('od_expense.created_at','<=',date('Y-m-d', strtotime($to)) ." 23:59:59")
                ->get();
        }
      
        return \DataTables::of($od_expense)
        ->addColumn('action', function($od_expense){
            if($od_expense->status=="On-Hand"){
                 return '<button class="btn btn-xs btn-success release_expense_od waves-effect" id="'.$od_expense->id.'"><i class="material-icons">eject</i></button>';
            }else{
                 return '<button class="btn btn-xs btn-danger released waves-effect" id="'.$od_expense->id.'"><i class="material-icons">done_all</i></button>';
            }
           
        })
        ->editColumn('amount', function ($data) {
            return '₱'.number_format($data->amount, 2, '.', ',');
        })
         ->editColumn('created_at', function ($data) {
            return date('F d, Y g:i a', strtotime($data->created_at));
        })
        ->editColumn('released_by', function ($data) {
            if($data->released_by==""){
                return 'None';
            }else{
                return $data->released_by;
            }
            
        })
        ->make(true);
    }


}
