<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use DB;
use App\Employee;
use App\Commodity;
use App\Company;
use App\od;
use App\Roles;
use App\trucks;
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
            $commodity->save();
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
          $commodity->save();
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
            ->select('deliveries.id','deliveries.outboundTicket','commodity.name AS commodity_name','trucks.plate_no AS plateno','deliveries.destination', 'employee.fname','employee.mname','employee.lname','company.name', 'deliveries.fuel_liters','deliveries.created_at')
            ->get();
        }else{
            $ultimatesickquery= DB::table('deliveries')
            ->join('commodity', 'commodity.id', '=', 'deliveries.commodity_id')
            ->join('trucks', 'trucks.id', '=', 'deliveries.plateno')
            ->join('employee', 'employee.id', '=', 'deliveries.driver_id')
            ->join('company', 'company.id', '=', 'deliveries.company_id')
            ->select('deliveries.id','deliveries.outboundTicket','commodity.name AS commodity_name','trucks.plate_no AS plateno','deliveries.destination', 'employee.fname','employee.mname','employee.lname','company.name', 'deliveries.fuel_liters','deliveries.created_at')
            ->where('deliveries.created_at', '>=', date('Y-m-d', strtotime($from))." 00:00:00")
            ->where('deliveries.created_at','<=',date('Y-m-d', strtotime($to)) ." 23:59:59")
            ->get();
        }
        //$user = User::all();
       
        return \DataTables::of($ultimatesickquery)
        ->addColumn('action', function(  $ultimatesickquery){
            return '<button class="btn btn-xs btn-warning update_delivery waves-effect" id="'.$ultimatesickquery->id.'"><i class="material-icons">mode_edit</i></button>&nbsp
            <button class="btn btn-xs btn-danger delete_delivery waves-effect" id="'.$ultimatesickquery->id.'"><i class="material-icons">delete</i></button>';
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



}
