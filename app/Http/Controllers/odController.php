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
use App\copra_delivery;
use App\copra_breakdown;
use App\coconut_delivery;
use App\nuts_reject;
use Auth;
use App\User;
use App\Events\ExpensesUpdated;
use App\Events\CashierCashUpdated; 
use App\Notification;
use App\Cash_History;
use Carbon\Carbon;
use App\UserPermission;

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
        $output; 
        if($request->get('button_action') == 'add'){
            $commodity= new od;
            $commodity->outboundTicket = $request->ticket;
            $commodity->commodity_id = $request->commodity;
            $commodity->destination = $request->destination;
            $commodity->driver_id = $request->driver_id;
            $commodity->company_id = $request->company;
            $commodity->plateno = $request->plateno;
            $commodity->fuel_liters = $request->liter;
            $commodity->kilos = $request->kilos;
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

            if($od_expenses) {
                $notification = new Notification;
                $notification->notification_type = "Outbound Expense";
                $notification->message = "Outbound Expense";
                $notification->status = "Pending";
                $notification->admin_id = Auth::id();
                $notification->table_source = "od_expense";
                $notification->od_expense_id = $od_expenses->id;
                $notification->save();

                $datum = Notification::where('id', $notification->id)
                    ->with('admin', 'cash_advance', 'expense', 'dtr.dtrId.employee', 'trip.tripId.employee', 'od.odId.driver')
                    ->get()[0];

                $notification = array();

                $notification = array(
                    'notifications' => $datum,
                    'customer' => $datum->od->odId->driver,
                    'time' => time_elapsed_string($datum->updated_at),
                );

                event(new \App\Events\NewNotification($notification));
            }
            $output="Add"; 

            return json_encode($output);
        }

        if($request->get('button_action') == 'update'){
          $commodity= new od; 
          $commodity= od::find($request->get('id'));
          $od_expenses =od_expense::find($request->get('id'));
          $user = User::find(Auth::user()->id); 
          if($commodity->allowance!=$request->allowance && $od_expenses->status=="Released"){
            $userGet = User::where('id', '=', Auth::user()->id)->first();
            $cashLatest = Cash_History::orderBy('id', 'DESC')->first();
            $cash_history = new Cash_History;
            $cash_history->user_id = $userGet->id;
    
            $getDate = Carbon::now();
            
            if($cashLatest != null){
                $dateTime = $getDate->year.$getDate->month.$getDate->day.($cashLatest->id+1);
            }
            else{
                $dateTime = $getDate->year.$getDate->month.$getDate->day.'1';
            }
    
            $cash_history->trans_no = $dateTime;
            $cash_history->previous_cash = $user->cashOnHand;
            $cash_history->cash_change = $od_expenses->amount;
            $cash_history->total_cash = $user->cashOnHand + $commodity->allowance;
            $cash_history->type = "Edit Data on - Outbound Deliveries";
            $cash_history->save();
            $user->cashOnHand += $commodity->allowance;
            $user->save();
            $od_expenses->status = "On-Hand";
            $od_expenses->released_by = '';
            $output = array(
                'cashOnHand' => $user->cashOnHand,
                'outbound_data' => $commodity
            );
            
        }else{
            $output="Success"; 
        }
          $commodity->outboundTicket = $request->ticket;
          $commodity->commodity_id = $request->commodity;
          $commodity->destination = $request->destination;
          $commodity->driver_id = $request->driver_id;
          $commodity->company_id = $request->company;
          $commodity->plateno = $request->plateno;
          $commodity->fuel_liters = $request->liter;
          $commodity->kilos = $request->kilos;
          $commodity->allowance = $request->allowance;
          $od_expenses->description = $request->destination;
          $od_expenses->type ="Outbound Expense";
          $od_expenses->amount = $request->allowance;
          $od_expenses->save();
          $commodity->save();
          return json_encode($output);
        }
    }

    public function release_update_od(Request $request){
        $check_admin =Auth::user()->id;
        if($check_admin==1){
            $logged_id = Auth::user()->name;
            $user = User::find(Auth::user()->id);
            $released = od_expense::find($request->id);
            $released->status = "Released";
            $released->released_by = $logged_id;
            $released->save();
        }else{
            $logged_id = Auth::user()->emp_id;
            $name= Employee::find($logged_id);       
            $user = User::find(Auth::user()->id);      
            $released=od_expense::find($request->id);
            $released->status = "Released";
            $released->released_by = $name->fname." ".$name->mname." ".$name->lname;;
            $released->save();
        }

        $userGet = User::where('id', '=', $user->id)->first();
        $cashLatest = Cash_History::orderBy('id', 'DESC')->first();
        $cash_history = new Cash_History;
        $cash_history->user_id = $userGet->id;

        $getDate = Carbon::now();
        
        if($cashLatest != null){
            $dateTime = $getDate->year.$getDate->month.$getDate->day.($cashLatest->id+1);
        }
        else{
            $dateTime = $getDate->year.$getDate->month.$getDate->day.'1';
        }

        $cash_history->trans_no = $dateTime;
        $cash_history->previous_cash = $user->cashOnHand;
        $cash_history->cash_change = $released->amount;
        $cash_history->total_cash = $user->cashOnHand - $released->amount;
        $cash_history->type = "Release Cash - Outbound Deliveries";
        $cash_history->save();
        
        event(new ExpensesUpdated($released));

        $user->cashOnHand -= $released->amount;
        $user->save();
         
        event(new CashierCashUpdated());
       
        $output = array(
            'cashOnHand' => $user->cashOnHand,
            'cashHistory' => $dateTime
        );
        
        echo json_encode($output);
   }

    public function check_balance_od(Request $request){
       $user = User::find(Auth::user()->id);
       $expense = od_expense::find($request->id);

       if($user->cashOnHand < $expense->amount){
           return 0;
       }
       else{
            if($expense->status == 'Released'){
                return 2;
            }
            return 1;
       }
   }

    public function refresh(Request $request)
    {
        $from = $request->date_from;
        $to = $request->date_to;

        $od = od::with('commodity', 'trucks', 'driver', 'company', 'od_expense')
            ->when($to == '', function($query){
                $query->whereBetween('created_at', [Carbon::now()->setTime(0,0)->format('Y-m-d H:i:s'), Carbon::now()->setTime(23,59,59)->format('Y-m-d H:i:s')]);
            })
            ->when($to != '', function($query) use($from, $to){
                $query->where('created_at', '>=', date('Y-m-d', strtotime($from))." 00:00:00")
                    ->where('created_at','<=',date('Y-m-d', strtotime($to)) ." 23:59:59");
            })->latest();
       
        return \DataTables::of($od)
        ->editColumn('outboundTicket', function($data){
            if($data->id == 1){
                return '<a href="javascript:void(0)" id="'.$data->id.'">'.$data->outboundTicket.'</a>>';
            }else{
                return $data->outboundTicket;
            }
        })
        ->editColumn('employee', function($data){
            return $data->driver->fname.' '.$data->driver->mname.' '.$data->driver->lname;
        })
        ->addColumn('action', function($data){
            $userid= Auth::user()->id;
            $permit = UserPermission::where('user_id',$userid)->where('permit',1)->where('permission_id',4)->get();
            if($userid!=1){
                $delete=$permit[0]->permit_delete;
                $edit = $permit[0]->permit_edit;
            } 

            $copra_coconut_html = '';


            $edit_html = '<button class="btn btn-xs btn-warning update_delivery waves-effect" id="'.$data->id.'"><i class="material-icons">mode_edit</i></button>&nbsp';
            
            if($data->commodity->name == 'COPRA'){
                $copra_coconut_html = '<button class="btn btn-xs btn-info copra_delivery waves-effect" id="'.$data->id.'"><i class="material-icons">bar_chart</i></button>&nbsp';
            }
            else if($data->commodity->name == 'COCONUT'){
                $copra_coconut_html = '<button class="btn btn-xs btn-info coconut_delivery waves-effect" id="'.$data->id.'"><i class="material-icons">bar_chart</i></button>&nbsp';
            }
            $delete_html = '<button class="btn btn-xs btn-danger delete_delivery waves-effect" id="'.$data->id.'"><i class="material-icons">delete</i></button>';
            
            if($userid==1){
                return $edit_html.$copra_coconut_html.$delete_html;
            }
            if($userid!=1 && $data->status=="On-Hand"){
                $html = '';
                $html .= ($edit==1) ? $edit_html : '';
                $html .= ($delete==1) ? $delete_html : '';
                return $html;
            }
            if($userid!=1 && $data->status=="Released"){
                return 'Released';
            }
            return 'No Action Permitted';
        })
        ->editColumn('allowance', function ($data) {
            return '₱'.number_format($data->allowance, 2, '.', ',');
        })
        ->editColumn('kilos', function ($data) {
            return number_format($data->kilos, 2, '.', ',');
        })
        ->editColumn('fuel_liters', function ($data) {
            return number_format($data->fuel_liters, 2, '.', ',');
        })
         ->editColumn('created_at', function ($data) {
            return date('F d Y, h:i:s A',strtotime($data->created_at));
        })
        ->make(true);
    }

    public function refresh_copra_delivery($od_id){
        $copra = copra_delivery::where('od_id', $od_id)->get();

        return \DataTables::of($copra)->make(true);
    }

    public function refresh_copra_breakdown(Request $request){
        $breakdown = copra_breakdown::where('copra_id', $request->copra_delivery_id)->get();
        
        return \DataTables::of($breakdown)
            ->addColumn('action', function($data){
                $html = '';

                $html .= '<button class="btn btn-xs btn-warning update_breakdown waves-effect" id="'.$data->id.'"><i class="material-icons">mode_edit</i></button>&nbsp';
                $html .= '<button class="btn btn-xs btn-danger delete_breakdown waves-effect" id="'.$data->id.'"><i class="material-icons">delete</i></button>';
                
                return $html;
            })->make(true);
    }

    function get_copra($od_id){
        $od = od::find($od_id);
        $copra = copra_delivery::where('od_id', $od_id)->first();
        
        return [
            'ticket' => $od->outboundTicket,
            'copra_delivery_id' => ($copra) ? $copra->id : ''
        ];
    }

    function get_copra_breakdown(copra_breakdown $breakdown){
        $copra = copra_delivery::find($breakdown->copra_id);
        $priced_weight = copra_breakdown::where('copra_id', $breakdown->copra_id)->sum('resicada');
        $breakdown->unpriced = $copra->resicada - ($priced_weight - $breakdown->resicada);
        $breakdown->wr = $copra->wr;
        return $breakdown;
    }

    function get_copra_delivery($od_id){
        return copra_delivery::where('od_id', $od_id)->first();
    }

    function get_copra_delivery_add(copra_delivery $copra_delivery){
        $resicada = copra_breakdown::where('copra_id', $copra_delivery->id)->sum('resicada');

        return [
            'wr' => $copra_delivery->wr,
            'unpriced' => $copra_delivery->resicada - $resicada
        ];
    }

    function get_od_payment_details(Request $request){
        $od_id = $request->od_id;
        $copra_id = $request->copra_delivery_id;

        $od = od::with('commodity:id,name')->select('outboundTicket', 'commodity_id')->find($od_id);
        $od->payment_amount = copra_breakdown::where('copra_id', $copra_id)->sum('amount');
        return $od;
    }

    function get_coconut($od_id){
        $od = od::find($od_id);
        $coconut = coconut_delivery::where('od_id', $od_id)->first();
        
        return [
            'ticket' => $od->outboundTicket,
            'coconut_delivery_id' => ($coconut) ? $coconut->id : ''
        ];
    }

    function save_copra(Request $request){
        $od_id = $request->copra_id;
        $add_edit = $request->copra_add_edit;

        $copra = ($add_edit == 'add') ? new copra_delivery : copra_delivery::where('od_id', $od_id)->first();
        $copra->od_id = $request->copra_id;
        $copra->wr = $request->cop_wr;
        $copra->net_weight = $request->cop_nw;
        $copra->dust = $request->cop_dust;
        $copra->moist = $request->cop_moist;
        $copra->resicada = $request->cop_rw;
        $copra->save();

        return $copra->id;
    }

    function save_copra_breakdown(Request $request){
        $id = $request->copra_breakdown_id;
        $add_edit = $request->copra_breakdown_add_edit;

        $breakdown = ($add_edit == 'add') ? new copra_breakdown : copra_breakdown::find($id);
        $breakdown->copra_id = $request->copra_delivery_id;
        $breakdown->resicada = $request->cop_bd_rw;
        $breakdown->price = $request->cop_bd_price;
        $breakdown->amount = $request->cop_bd_amount;
        $breakdown->save();
    }

    public function save_coconut(Request $request){
        $od_id = $request->coconut_id;
        $add_edit = $request->coconut_add_edit;

        $coconut = ($add_edit == 'add') ? new coconut_delivery : coconut_delivery::find($id);
        $coconut->od_id = $request->coconut_id;
        $coconut->gross_weight = $request->coco_gw;
        $coconut->moisture = $request->coco_moist;
        $coconut->net_weight = $request->coco_nw;
        $coconut->price = $request->coco_price;
        $coconut->amount = $request->coco_amount;
        $coconut->tax = $request->coco_tax;
        $coconut->total_amount = $request->coco_total_amount;
        $coconut->save();

        return $coconut->od_id;
    }

    function delete_breakdown(copra_breakdown $breakdown){
        $breakdown->delete();
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
            'kilos' => $od->kilos,
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
        $od_expenses =od_expense::find($request->id);
        $user = User::find(1);  
        $output="success";
        if($od_expenses->status=="Released"){
            $userGet = User::where('id', '=', 1)->first();
            $cashLatest = Cash_History::orderBy('id', 'DESC')->first();
            $cash_history = new Cash_History;
            $cash_history->user_id = $userGet->id;
    
            $getDate = Carbon::now();
            
            if($cashLatest != null){
                $dateTime = $getDate->year.$getDate->month.$getDate->day.($cashLatest->id+1);
            }
            else{
                $dateTime = $getDate->year.$getDate->month.$getDate->day.'1';
            }
    
            $cash_history->trans_no = $dateTime;
            $cash_history->previous_cash = $user->cashOnHand;
            $cash_history->cash_change = $od_expenses->amount;
            $cash_history->total_cash = $user->cashOnHand + $od_expenses->amount;
            $cash_history->type = "Delete Released Data on - Outbound Deliveries";
            $cash_history->save();
            $user->cashOnHand += $od_expenses->amount;
            $user->save();
            $output = array(
                'cashOnHand' => $user->cashOnHand,
                'trip_data' => $od
            );
            $od_expenses->delete();
            $od->delete();
        }else{
            $od_expenses->delete();
            $od->delete();
        }
        return json_encode($output);
    }

    public function od_expense_view(Request $request)
    {
       $from = $request->date_from;
       $to = $request->date_to;
       if($to==""||$from==""){
          $od_expense = DB::table('deliveries')
            ->join('od_expense', 'od_expense.od_id', '=', 'deliveries.id')
            ->select('od_expense.id','deliveries.outboundTicket AS od_id','od_expense.description AS description','od_expense.type AS type','od_expense.amount AS amount','od_expense.status AS status','od_expense.released_by as released_by','od_expense.created_at as created_at')
            ->whereBetween('deliveries.created_at', [Carbon::now()->setTime(0,0)->format('Y-m-d H:i:s'), Carbon::now()->setTime(23,59,59)->format('Y-m-d H:i:s')])
            ->get()->sortByDesc('created_at');
        }else{
           
             $od_expense = DB::table('deliveries')
            ->join('od_expense', 'od_expense.od_id', '=', 'deliveries.id')
            ->select('od_expense.id','deliveries.outboundTicket AS od_id','od_expense.description AS description','od_expense.type AS type','od_expense.amount AS amount','od_expense.status AS status','od_expense.released_by as released_by','od_expense.created_at as created_at')
                ->where('od_expense.created_at', '>=', date('Y-m-d', strtotime($from))." 00:00:00")
                ->where('od_expense.created_at','<=',date('Y-m-d', strtotime($to)) ." 23:59:59")
                ->get()->sortByDesc('created_at');
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
            return date('F d Y, h:i:s A',strtotime($data->created_at));
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
