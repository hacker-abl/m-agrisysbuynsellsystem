<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Database\Query\Builder;
use App\dtr;
use App\dtr_expense;
use App\expense;
use App\employee;
use App\User;
use App\Notification;
use App\Cash_History;
use App\employee_ca;
use Carbon\Carbon;
use Auth;
use App\UserPermission;
use App\Events\CashierCashUpdated;

class dtrController extends Controller
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
    public function isAdmin(){
    return Auth::user()->id;
    }
    public function index(){
        $employee = employee::all();

        return view('main.dtr', compact('employee'));
    }

    public function store(Request $request){
        if($request->get('button_action') == ''){
        $dtr = new dtr;
        $dtr->employee_id = $request->employee_id;
        $dtr->role = $request->role;
        $dtr->overtime = $request->overtime;
        $dtr->num_hours = $request->num_hours;
        $dtr->rate = $request->rate;
        $dtr->bonus = $request->bonus;
        $dtr->salary = $request->salary;
        $dtr->status = "On-Hand";
        $dtr->save();
        $details = dtr::where('employee_id', $request->employee_id)->orderBy('employee_id', 'desc')->latest()->get();
        echo json_encode($details);
        }
        if($request->get('button_action') == 'update'){
        $dtr = dtr::find($request->get('id'));
        $dtr->role = $request->role;
        $dtr->overtime = $request->overtime;
        $dtr->num_hours = $request->num_hours;
        $dtr->rate = $request->rate;
        $dtr->bonus = $request->bonus;
        $dtr->salary = $request->salary;   
        $dtr->save(); 
        $updated = array(
            'updated' => "updated",
            'details' => dtr::where('employee_id', $request->employee_id)->orderBy('employee_id', 'desc')->latest()->get()
                        );  

        return json_encode($updated);
        }


        
    }

    public function add_dtr_expense(Request $request){
        $dtr = new dtr_expense;
        $dtr->dtr_id = $request->id;
        $dtr->description = "description";
        $dtr->type ="DTR EXPENSE";
        $dtr->amount = $request->salary;
        $dtr->status = "On-Hand";
        $dtr->released_by = '';
        $dtr->save();

        if($dtr) {
            $notification = new Notification;
            $notification->notification_type = "Daily Time Record";
            $notification->message = "Daily Time Record Release";
            $notification->status = "Pending";
            $notification->admin_id = Auth::id();
            $notification->table_source = "dtr_expense";
            $notification->dtr_expense_id = $dtr->id;
            $notification->save();

            $datum = Notification::where('id', $notification->id)->with('admin', 'dtr.dtrId.employee')->get()[0];

            $notification = array();

            if(!empty($datum->dtr)) {
                $notification = array(
                    'notifications' => $datum,
                    'customer' => $datum->dtr->dtrId->employee,
                    'time' => time_elapsed_string($datum->updated_at), 
                );
            }

            event(new \App\Events\NewNotification($notification));
        }

        $details = dtr_expense::all();

        echo json_encode($details);
    }
     public function release_update_dtr(Request $request){
        $check_admin =Auth::user()->id;
        if($check_admin==1){
            $logged_id = Auth::user()->name;
            $user = User::find(Auth::user()->id);
            $released = dtr::find($request->id);
            $released->status = "Released";
            $released->released_by = $logged_id;
            $released->save();
        }else{
            $logged_id = Auth::user()->emp_id;
            $user = User::find(Auth::user()->id);
            $name= Employee::find($logged_id);
            $released=dtr::find($request->id);
            $released->status = "Released";
            $released->released_by = $name->fname." ".$name->mname." ".$name->lname;
            $released->save();
        }

        $userGet = User::where('id', '=', $user->id)->first();
        $cashLatest = Cash_History::orderBy('id', 'DESC')->first();
        $cash_history = new Cash_History;
        $cash_history->user_id = $userGet->id;

        $getDate = Carbon::now();
        
        if($cashLatest != null){
            $dateTime = $getDate->year.$getDate->month.$getDate->day.$cashLatest->id+1;
        }
        else{
            $dateTime = $getDate->year.$getDate->month.$getDate->day.'1';
        }

        $cash_history->trans_no = $dateTime;
        $cash_history->previous_cash = $user->cashOnHand;
        $cash_history->cash_change = $released->salary;
        $cash_history->total_cash = $user->cashOnHand - $released->salary;
        $cash_history->type = "Release Cash - DTR";
        $cash_history->save();

        $user->cashOnHand -= $released->salary;
        $user->save();

        event(new CashierCashUpdated());

        $output = array(
            'cashOnHand' => $user->cashOnHand,
            'cashHistory' => $dateTime
        );
        
        echo json_encode($output);
    }

    public function check_balance5(Request $request){
        $user = User::find(Auth::user()->id);
        $expense = dtr::find($request->id);

        if($user->cashOnHand < $expense->salary){
            return 0;
        }
        else{
            return 1;
        }
    }
    public function check_emp_balance(Request $request){
        $balance = employee_ca::where('employee_id', '=', $request->id)->latest()->first();
        return json_encode($balance);
    }

    public function add_emp_ca(Request $request){
            $ca = new employee_ca;
            $ca->employee_id = $request->employee_id;
            $ca->reason = $request->reason;
            $ca->amount = $request->amount;
            $ca->balance = $request->balance + $request->amount;
            $ca->status = "On-Hand";
            $ca->released_by = '';
            $ca->save();

        return json_encode("maoni");
    }
    function updatedata(Request $request){
         $id = $request->input('id');
        $dtr_view = DB::table('dtr')
            ->join('employee', 'employee.id', '=', 'dtr.employee_id')
            ->select('dtr.*', 'employee.fname', 'employee.mname', 'employee.lname')
            ->where('dtr.id', $id)
            ->get();
            
        $output = array(
            'employee_id' => $dtr_view[0]->employee_id,
            'role' => $dtr_view[0]->role,
            'overtime' => $dtr_view[0]->overtime,
            'rate' => $dtr_view[0]->rate,
            'bonus' => $dtr_view[0]->bonus,
            'num_hours' => $dtr_view[0]->num_hours,
            'salary' => $dtr_view[0]->salary,
        );
        echo json_encode($output);
    }

    function deletedata(Request $request){
        $dtr = dtr::find($request->input('id'));
        if($dtr->status=="Released"){
            $user = User::find(Auth::user()->id);
            $userGet = User::where('id', '=', $user->id)->first();
            $cashLatest = Cash_History::orderBy('id', 'DESC')->first();
            $cash_history = new Cash_History;
            $cash_history->user_id = $userGet->id;

            $getDate = Carbon::now();
            
            if($cashLatest != null){
                $dateTime = $getDate->year.$getDate->month.$getDate->day.$cashLatest->id+1;
            }
            else{
                $dateTime = $getDate->year.$getDate->month.$getDate->day.'1';
            }

            $cash_history->trans_no = $dateTime;
            $cash_history->previous_cash = $user->cashOnHand;
            $cash_history->cash_change = $dtr->salary;
            $cash_history->total_cash = $user->cashOnHand + $dtr->salary;
            $cash_history->type = "Released DTR Deleted";
            $cash_history->save();

            $user->cashOnHand += $dtr->salary;
            $user->save();
             $output = array(
                'cashOnHand' => $user->cashOnHand,
                'cashHistory' => $dateTime
            );
            $dtr->delete();
            return  json_encode($output);
        }
         $dtr->delete();
         return  json_encode($output);
    }
    public function refresh(){
        $join = DB::table('dtr')
            ->select(DB::raw('max(created_at) as maxdate'), 'employee_id')
            ->groupBy('employee_id');
        $sql = '(' . $join->toSql() . ') as dtr2';

        $dtr = DB::table('dtr as dtr1')
            ->select('dtr1.*', 'emp.fname', 'emp.mname', 'emp.lname')
            ->join(DB::raw($sql), function($join){
                $join->on('dtr2.employee_id', '=', 'dtr1.employee_id')
                    ->on('dtr2.maxdate', '=', 'dtr1.created_at');
            })
            ->leftJoin('employee as emp', 'dtr1.employee_id', '=', 'emp.id')
            ->orderBy('dtr1.created_at', 'desc')
            ->get();
        return \DataTables::of($dtr)
        ->addColumn('action', function($dtr){
            return '<button class="btn btn-xs btn-info view_dtr waves-effect" id="'.$dtr->employee_id.'"><i class="material-icons" style="width: 25px;">visibility</i></button>&nbsp<button class="btn btn-xs btn-warning view_ca waves-effect" id="'.$dtr->employee_id.'"><i class="material-icons" style="width: 25px;">ballot</i></button>';//info/visibility
        })
        ->addColumn('wholename', function ($data){
            return $data->fname." ".$data->mname." ".$data->lname;
        })
        ->editColumn('bonus', function ($data) {
            return '₱ '.number_format($data->bonus, 2, '.', ',');
        })
        ->editColumn('salary', function ($data) {
            return '₱ '.number_format($data->salary, 2, '.', ',');
        })
        ->make(true);
    }

    public function refresh_view(Request $request){
        $id = $request->input('id');
        $dtr_view = DB::table('dtr')
            ->join('employee', 'employee.id', '=', 'dtr.employee_id')
            ->select('dtr.*', 'employee.fname', 'employee.mname', 'employee.lname','employee_cas.balance')
            ->leftJoin('employee_cas', function($query) {
                     $query->on('employee.id','=','employee_cas.employee_id')
                        ->whereRaw('employee_cas.id IN (select MAX(a2.id) from employee_cas as a2 join employee as u2 on u2.id = a2.employee_id group by u2.id)');
            })
            ->where('dtr.employee_id', $id)
            ->latest();
        return \DataTables::of($dtr_view)
        ->addColumn('action', function($dtr_view){
            if($dtr_view->status=="On-Hand" && isAdmin()==1){
                 return '<button class="btn btn-xs btn-success release_expense_dtr waves-effect" id="'.$dtr_view->id.'" ><i class="material-icons">eject</i></button>&nbsp&nbsp<button class="btn btn-xs btn-warning update_dtr waves-effect" id="'.$dtr_view->id.'" ><i class="material-icons">mode_edit</i></button>&nbsp&nbsp<button class="btn btn-xs btn-danger delete_dtr waves-effect" id="'.$dtr_view->id.'" ><i class="material-icons">delete</i></button>';
            }else if($dtr_view->status=="On-Hand" && isAdmin()!=1){
                return '<button class="btn btn-xs btn-success release_expense_dtr waves-effect" id="'.$dtr_view->id.'" ><i class="material-icons">eject</i></button>';    
            }
            else if($dtr_view->status=="Released" && isAdmin()==1){
                 return '<button class="btn btn-xs btn-danger released waves-effect" id="'.$dtr_view->id.'"><i class="material-icons">done_all</i></button>&nbsp&nbsp<button class="btn btn-xs btn-danger delete_dtr waves-effect" id="'.$dtr_view->id.'" ><i class="material-icons">delete</i></button>';
            }else{
                return '<button class="btn btn-xs btn-danger released waves-effect" id="'.$dtr_view->id.'"><i class="material-icons">done_all</i></button>';
            }

        })
		->editColumn('salary', function ($data) {
            return '₱ '.number_format($data->salary, 2, '.', ',');
        })
        ->editColumn('bonus', function ($data) {
            return '₱ '.number_format($data->bonus, 2, '.', ',');
        })
         ->editColumn('released_by', function ($data) {
            if($data->released_by==""){
                return 'None';
            }else{
                return $data->released_by;
            }

        })
        ->make(true);
       // echo json_encode($dtr_view);
    }

     public function employee_view_ca(Request $request){
         
        $id = $request->input('id');
        $cash_advance = DB::table('employee_cas')
            ->join('employee', 'employee.id', '=', 'employee_cas.employee_id')
            ->select('employee_cas.id','employee_cas.employee_id', 'employee.fname', 'employee.mname', 'employee.lname', 'employee_cas.reason', 'employee_cas.amount', 'employee_cas.created_at','employee_cas.balance','employee_cas.status','employee_cas.released_by')
            ->where('employee_cas.employee_id', $id)
            ->latest();
        return \DataTables::of($cash_advance)
         ->addColumn('action', function($cash_advance){
            $userid= Auth::user()->id;
            $permit = UserPermission::where('user_id',$userid)->where('permit',1)->where('permission_id',5)->get();   
            if($userid!=1){
                $delete=$permit[0]->permit_delete;  
                $edit = $permit[0]->permit_edit;  
           }
            if($cash_advance->status=="On-Hand" && isAdmin()==1){
                 return '<button class="btn btn-xs btn-success release_ca waves-effect" id="'.$cash_advance->id.'"><i class="material-icons">eject</i></button>&nbsp&nbsp<button class="btn btn-xs btn-warning update_ca waves-effect" id="'.$cash_advance->id.'" ><i class="material-icons">mode_edit</i></button>&nbsp&nbsp<button class="btn btn-xs btn-danger delete_ca waves-effect" id="'.$cash_advance->id.'" ><i class="material-icons">delete</i></button>';
            }if($cash_advance->status=="On-Hand" && isAdmin()!=1 && $delete==1 && $edit==1){
                 return '<button class="btn btn-xs btn-success release_ca waves-effect" id="'.$cash_advance->id.'"><i class="material-icons">eject</i></button>&nbsp&nbsp<button class="btn btn-xs btn-warning update_ca waves-effect" id="'.$cash_advance->id.'" ><i class="material-icons">mode_edit</i></button>&nbsp&nbsp<button class="btn btn-xs btn-danger delete_ca waves-effect" id="'.$cash_advance->id.'" ><i class="material-icons">delete</i></button>';
            }if($cash_advance->status=="On-Hand" && isAdmin()!=1 && $delete==1 && $edit==0){
                 return '<button class="btn btn-xs btn-success release_ca waves-effect" id="'.$cash_advance->id.'"><i class="material-icons">eject</i></button>&nbsp&nbsp<button class="btn btn-xs btn-danger delete_ca waves-effect" id="'.$cash_advance->id.'" ><i class="material-icons">delete</i></button>';
            }if($cash_advance->status=="On-Hand" && isAdmin()!=1 && $delete==0 && $edit==1){
                 return '<button class="btn btn-xs btn-success release_ca waves-effect" id="'.$cash_advance->id.'"><i class="material-icons">eject</i></button>&nbsp&nbsp<button class="btn btn-xs btn-warning update_ca waves-effect" id="'.$cash_advance->id.'" ><i class="material-icons">mode_edit</i></button>';
            }else if($cash_advance->status=="On-Hand" && isAdmin()!=1 && $delete==0 && $edit==0){
                 return '<button class="btn btn-xs btn-success release_ca waves-effect" id="'.$cash_advance->id.'"><i class="material-icons">eject</i></button>';
            }
            else{
                 return '<button class="btn btn-xs btn-danger waves-effect" id="'.$cash_advance->id.'"><i class="material-icons">done_all</i></button>';
            }
           
        })
         ->editColumn('released_by', function ($data) {
            if($data->released_by==""){
                return 'None';
            }else{
                return $data->released_by;
            }
             
        })
        ->editColumn('balance', function ($data) {
           return '₱'.number_format($data->balance, 2, '.', ',');
        })
        ->editColumn('amount', function ($data) { 
            return '₱'.number_format($data->amount, 2, '.', ',');
        })
         ->editColumn('created_at', function ($data) {
            return date('F d, Y g:i a', strtotime($data->created_at));
        })

        ->make(true);

        echo json_encode($cash_advance);
    }

    public function check_employee(Request $request){

        $employee_details = DB::table('employee')
        ->join('roles', 'employee.role_id', '=', 'roles.id')
        ->select('employee.*', 'roles.role','roles.rate')
        ->where('employee.id', $request->id)
        ->get();
        echo json_encode($employee_details);
    }

	public function refresh_total(Request $request){
		 $total = DB::table('dtr')
		 ->where('employee_id', '=', $request->id)
		 ->where('status',"=", "On-Hand")
		 ->sum('salary');

        echo json_encode($total);
    }
}
