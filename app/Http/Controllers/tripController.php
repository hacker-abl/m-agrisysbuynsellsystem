<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Database\Query\Builder;
use App\trips;
use App\employee;
use App\trucks;
use App\Commodity;
use App\Roles;
use App\trip_expense;
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
        $details =  DB::table('trips')->orderBy('trip_ticket', 'desc')->first();

        echo json_encode($details);
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

    public function add_trip_expense(Request $request){
        $dtr = new trip_expense;
        $dtr->trip_id = $request->id;
        $dtr->description = "description";
        $dtr->type ="TRIP EXPENSE";
        $dtr->amount = $request->expense;
        $dtr->status = "On-Hand";
        $dtr->save();

        $details = trip_expense::all();

        echo json_encode($details);
    }

    public function refresh(){
        $trips = DB::table('trips')
            ->join('commodity', 'commodity.id', '=', 'trips.commodity_id')
            ->join('trucks', 'trucks.id', '=', 'trips.truck_id')
            ->join('employee', 'employee.id', '=', 'trips.driver_id')
            ->select('trips.id','trips.trip_ticket','commodity.name AS commodity_name','trucks.plate_no AS plateno','trips.destination', 'employee.fname','employee.mname','employee.lname', 'trips.num_liters','trucks.name AS name','trips.expense')
            ->get();
        return \DataTables::of($trips)
        ->addColumn('action', function($trips){
            return '<button class="btn btn-xs btn-warning update_pickup waves-effect" id="'.$trips->id.'"><i class="material-icons">mode_edit</i></button>&nbsp
            <button class="btn btn-xs btn-danger delete_pickup waves-effect" id="'.$trips->id.'"><i class="material-icons">delete</i></button>';
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
}
