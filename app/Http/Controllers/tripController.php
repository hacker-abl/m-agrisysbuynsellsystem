<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Database\Query\Builder;
use App\trips;
use App\User;
use App\employee;
use App\trucks;
use App\Commodity;
use App\Roles;
use App\trip_expense;
use Auth;
use App\Events\ExpensesUpdated;

class tripController extends Controller
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
        $driver= DB::table('employee')
            ->join('roles', 'roles.id', '=', 'employee.role_id')
            ->select('employee.*','employee.id AS emp_id',  'roles.id','roles.role')
            ->where('roles.role','LIKE','%driver%')
            ->get();

        $commodity = Commodity::all();
        $trucks = Trucks::all();
        return view('main.trip')->with(compact('driver','commodity','trucks'));
    }


    public function store(Request $request){
        
         
        $trip= new trips;
        $trip->trip_ticket = $request->ticket;
        $trip->expense = $request->expense;
        $trip->commodity_id = $request->commodity;
        $trip->destination = $request->destination;
        $trip->driver_id = $request->driver_id;
        $trip->truck_id = $request->plateno;
        $trip->num_liters = $request->num_liters;
        $trip->save();
        $lastInsertedId = $trip->id;
        $trip_expenses = new trip_expense;
        $trip_expenses->trip_id = $lastInsertedId;
        $trip_expenses->description = $request->destination;
        $trip_expenses->type ="TRIP EXPENSE";
        $trip_expenses->amount = $request->expense;
        $trip_expenses->status = "On-Hand";
        $trip_expenses->released_by = '';
        $trip_expenses->save();
        $details =  DB::table('trips')->orderBy('trip_ticket', 'desc')->first();

        echo json_encode($details);

        event(new ExpensesUpdated($trip_expenses));
    }

    public function update_trip(Request $request){
        $trip= trips::find($request->id);
        $trip->trip_ticket = $request->ticket;
        $trip->expense = $request->expense;
        $trip->commodity_id = $request->commodity;
        $trip->destination = $request->destination;
        $trip->driver_id = $request->driver_id;
        $trip->truck_id = $request->plateno;
        $trip->num_liters = $request->num_liters;
        $trip->save();
        echo json_encode("update");
    }
     public function release_update(Request $request){
         $check_admin =Auth::user()->access_id;
        if($check_admin==1){
            $logged_id = Auth::user()->name;
            $user = User::find(Auth::user()->id);
            $released = trip_expense::find($request->id);
            $released->status = "Released";
            $released->released_by = $logged_id;
            $released->save();
            $cashOnHand = User::find(Auth::user()->id);
            $cashOnHand->cashOnHand -= $released->amount;
            $cashOnHand->save();
        }else{
            $logged_id = Auth::user()->emp_id;
            $name= Employee::find($logged_id);             
            $released=trip_expense::find($request->id);
            $released->status = "Released";
            $released->released_by = $name->fname." ".$name->mname." ".$name->lname;;
            $released->save();
            $cashOnHand = User::find(Auth::user()->id);
            $cashOnHand->cashOnHand -= $released->amount;
            $cashOnHand->save();
        }

       


        return $cashOnHand->cashOnHand;
    }
    public function refresh(Request $request){
        $from = $request->date_from;
        $to = $request->date_to;

        if($to==""){
          $trips = DB::table('trips')
            ->join('commodity', 'commodity.id', '=', 'trips.commodity_id')
            ->join('trucks', 'trucks.id', '=', 'trips.truck_id')
            ->join('employee', 'employee.id', '=', 'trips.driver_id')
            ->select('trips.id','trips.trip_ticket','commodity.name AS commodity_name','trucks.plate_no AS plateno','trips.destination', 'employee.fname','employee.mname','employee.lname', 'trips.num_liters','trucks.name AS name','trips.expense AS expense' ,'trips.created_at AS created_at')
            ->get();
        }else{
           
              $trips = DB::table('trips')
            ->join('commodity', 'commodity.id', '=', 'trips.commodity_id')
            ->join('trucks', 'trucks.id', '=', 'trips.truck_id')
            ->join('employee', 'employee.id', '=', 'trips.driver_id')
            ->select('trips.id','trips.trip_ticket','commodity.name AS commodity_name','trucks.plate_no AS plateno','trips.destination', 'employee.fname','employee.mname','employee.lname', 'trips.num_liters','trucks.name AS name','trips.expense AS expense' ,'trips.created_at AS created_at')
             ->where('trips.created_at', '>=', date('Y-m-d', strtotime($from))." 00:00:00")
             ->where('trips.created_at','<=',date('Y-m-d', strtotime($to)) ." 23:59:59")
            ->get();
        }
       
        return \DataTables::of($trips)
        ->addColumn('action', function($trips){
            return '<div class="btn-group"><button class="btn btn-xs btn-warning update_pickup waves-effect" id="'.$trips->id.'"><i class="material-icons">mode_edit</i></button>
            <button class="btn btn-xs btn-danger delete_pickup waves-effect" id="'.$trips->id.'"><i class="material-icons">delete</i></button></div>';
        })
        ->editColumn('expense', function ($data) {
            return '₱ '.number_format($data->expense, 2, '.', ',');
        })
        ->editColumn('created_at', function ($data) {
            return date('F d, Y g:i a', strtotime($data->created_at));
        })

        ->make(true);
    }

    function updateId(){
        /*$temp = DB::table('trips')
            ->select(DB::raw('max(cast(trip_ticket as Int) as temp)'))
            ->get();*/
        $temp = DB::select('select MAX(Cast(trip_ticket as Int)) as "temp" FROM trips');
        echo json_encode($temp);
     }

     function updatedata(Request $request){
        $id = $request->input('id');
        $output = DB::table('trips')
            ->join('commodity', 'commodity.id', '=', 'trips.commodity_id')
            ->join('trucks', 'trucks.id', '=', 'trips.truck_id')
            ->join('employee', 'employee.id', '=', 'trips.driver_id')
            ->select('trips.id','trips.trip_ticket','commodity.id AS commodity_id','trucks.plate_no AS plateno', 'trips.destination', 'employee.id as driver_id', 'employee.fname','employee.mname','employee.lname', 'trips.num_liters', 'trucks.id as truck_id', 'trucks.name AS name','trips.expense')
            ->where('trips.id',$id)
            ->get();
        echo json_encode($output);
    }

    function deletedata(Request $request){
        $trips = trips::find($request->input('id'));
        $trips->delete();
    }
     public function trip_expense_view(Request $request)
    {
       $from = $request->date_from;
       $to = $request->date_to;
       if($to==""&&$from==""){
          $trip_expense = DB::table('trips')
            ->join('trip_expense', 'trip_expense.trip_id', '=', 'trips.id')
            ->select('trip_expense.id','trips.trip_ticket AS trip_id','trip_expense.description AS description','trip_expense.type AS type','trip_expense.amount AS amount','trip_expense.status AS status','trip_expense.released_by as released_by','trip_expense.created_at as created_at')
            ->get();
        }else{
           
             $trip_expense = DB::table('trips')
            ->join('trip_expense', 'trip_expense.trip_id', '=', 'trips.id')
            ->select('trip_expense.id','trips.trip_ticket AS trip_id','trip_expense.description AS description','trip_expense.type AS type','trip_expense.amount AS amount','trip_expense.status AS status','trip_expense.released_by as released_by','trip_expense.created_at as created_at')
                ->where('trip_expense.created_at', '>=', date('Y-m-d', strtotime($from))." 00:00:00")
                ->where('trip_expense.created_at','<=',date('Y-m-d', strtotime($to)) ." 23:59:59")
                      ->get();
        }
      
        return \DataTables::of($trip_expense)
        ->addColumn('action', function($trip_expense){
            if($trip_expense->status=="On-Hand"){
                 return '<button class="btn btn-xs btn-success release_expense waves-effect" id="'.$trip_expense->id.'"><i class="material-icons">eject</i></button>';
            }else{
                 return '<button class="btn btn-xs btn-danger released waves-effect" id="'.$trip_expense->id.'"><i class="material-icons">done_all</i></button>';
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
