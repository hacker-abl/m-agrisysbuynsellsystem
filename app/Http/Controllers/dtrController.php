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
use App\emp_payment;
use App\employee;
use App\User;
use App\Notification;
use App\Cash_History;
use App\employee_ca;
use Carbon\Carbon;
use Auth;
use App\employee_bal;
use App\UserPermission;
use App\Events\CashierCashUpdated;
use App\Events\BalanceUpdated;
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
            $dtr->dtr_balance = $request->emp_balance;
            $dtr->r_balance = $request->emp_rbalance;
            $dtr->p_payment = $request->p_payment;
            $dtr->salary = $request->salary;
            $dtr->status = "On-Hand";
            $dtr->save();
            $dtr_id = dtr::where('employee_id', '=', $request->employee_id)->latest()->first();
            $paymentlogs = new emp_payment;
            $paymentlogs->logs_id = $request->employee_id;
            $paymentlogs->dtr_id = $dtr_id->id;
            $paymentlogs->paymentmethod = "From ADD DTR Form";
            $balance = employee_ca::where('employee_id', '=', $request->employee_id)->latest()->first();
            $empbalance = employee_bal::where('employee_id', '=', $request->employee_id)->first();
            if($balance!=null){
                $paymentlogs->r_balance=$balance->balance-$request->p_payment;
                $paymentlogs->remarks = "Partial Payment";
                $balance->balance = $balance->balance-$request->p_payment;
                $empbalance->balance = $balance->balance;
                
                $paymentlogs->checknumber = "Not Specified";
                $paymentlogs->paymentamount = $request->p_payment;
                if($request->p_payment!=0){
                    $paymentlogs->save();
                    $balance->save();  
                    $empbalance->save();     
                }
                }
                if($request->p_payment>0){
                    //
                    $user = User::find(1);
                    $user_current =  $user->cashOnHand;
                    $user->cashOnHand += $request->p_payment;
                    $user->save();
 
                    $userGet = User::where('id', '=', 1)->first();
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
                    $employeeName= employee::where('id', '=', $request->employee_id)->first();
                    $cash_history->trans_no = $dateTime;
                    $cash_history->previous_cash = $user_current;
                    $cash_history->cash_change = $request->p_payment;
                    $cash_history->total_cash = $user->cashOnHand;
                    $cash_history->type = "Employee CA Payment (".$employeeName->fname." ".$employeeName->lname.")";
                    $cash_history->save();

                    $output = array(
                        'cashOnHand' => $user->cashOnHand,
                        'cashHistory'=> $dateTime,
                        'user'       => Auth::user()->id,
                    );
                    
                   return json_encode($output);    
 
                }
                 $output = array(
                        'cashOnHand' => 0,
                 );
           return  json_encode($output);           
        
        
         
        }
        if($request->get('button_action') == 'update'){
            $dtr = dtr::find($request->add_id);
            $user = User::find(1);
            $user->cashOnHand -= $dtr->p_payment;
            $user->save();
            $dtr->role = $request->role;
            $dtr->overtime = $request->overtime;
            $dtr->num_hours = $request->num_hours;
            $dtr->rate = $request->rate;
            $dtr->bonus = $request->bonus;
            $dtr->dtr_balance = $request->emp_balance;
            $dtr->r_balance = $request->emp_rbalance;
            $dtr->p_payment = $request->p_payment;
            $dtr->salary = $request->salary; 
            $checkpayment = emp_payment::all();
            if($checkpayment!==null){                      
                $paymentlogs = emp_payment::firstOrFail()->where('dtr_id',$request->add_id)->count();
            if($paymentlogs>0){
                $user1 = User::find(1);
                $user_current =  $user1->cashOnHand;
                $user1->cashOnHand += $request->p_payment;
                $user1->save();

                $userGet = User::where('id', '=', 1)->first();
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
                $employeeName= employee::where('id', '=', $request->employee_ni)->first();
                $cash_history->trans_no = $dateTime;
                $cash_history->previous_cash = $user_current;
                $cash_history->cash_change = $request->p_payment;
                $cash_history->total_cash = $user->cashOnHand;
                $cash_history->type = "Edit DTR CA Payment (".$employeeName->fname." ".$employeeName->lname.")";
                $cash_history->save();

                $output = array(
                    'cashOnHand' => $user->cashOnHand,
                    'cashHistory'=> $dateTime,
                    'user'       => Auth::user()->id,
                );
                




                $recent = emp_payment::where('dtr_id', '=', $request->add_id)->latest()->first();
                $new_payment = new emp_payment;
                $new_payment->logs_id = $recent->logs_id;
                $new_payment->dtr_id = $recent->dtr_id;
                $new_payment->paymentmethod = "From ADD DTR Form";
                $balance = employee_ca::where('employee_id', '=', $recent->logs_id)->latest()->first();
                $r_balance = emp_payment::where('logs_id', '=', $recent->logs_id)->latest()->first(); 
                $empbalance = employee_bal::where('employee_id', '=', $recent->logs_id)->first();
            
            
                $r_balance->r_balance = $request->last_payment+$empbalance->balance; 
                $new_payment->r_balance=$r_balance->r_balance-$request->p_payment;
                $new_payment->remarks = "Edited Partial Payment from DTR FORM";
                $balance->balance = $new_payment->r_balance;
                $empbalance->balance = $balance->balance;
                $new_payment->checknumber = "Not Specified";
                $new_payment->paymentamount = $request->p_payment;
                if($request->p_payment!=0){                   
                    $new_payment->save();                                     
                }
                $balance->save();  
                $empbalance->save();   
                $dtr->save(); 
                return json_encode($output);       
                 }
            }  
                $dtr->save();
                return json_encode($checkpayment);         
             
            
            
            
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
            if($expense->status == 'Released'){
                return 2;
            }
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
            $check_ca= employee_bal::where('employee_id', '=', $request->employee_id)->first();

            if($check_ca!=null){
                $balance = employee_bal::where('employee_id', '=', $request->employee_id)->first();
                $balance->balance = $request->balance + $request->amount;
                $balance->save();     
            }else{
                $balance = new employee_bal;
                $balance->employee_id=$request->employee_id;
                $balance->logs_id=$request->employee_id;
                $balance->balance = $request->balance + $request->amount;
                $balance->save();   
            }
            $ca->save();

        return json_encode($balance);
    }

    public function emp_payment(Request $request){
        $paymentlogs = new emp_payment;
        $paymentlogs->logs_id = $request->employee_payment_id;
        $paymentlogs->paymentmethod = $request->paymentmethod;
        if($request->balance <= 0){
             $output = array(
            'cashOnHand' => 0
        );
            echo json_encode($output);
        }else{
        $balance = employee_ca::where('employee_id', '=', $request->employee_payment_id)->latest()->first();
        $paymentlogs->r_balance=$balance->balance-$request->amount;
        $paymentlogs->remarks = $request->remarks;
        $balance->balance = $balance->balance-$request->amount;
        if( $request->checknumber!=""){
            $paymentlogs->checknumber = $request->checknumber;
        }
        else{
            $paymentlogs->checknumber = "Not Specified";
        }
        $paymentlogs->paymentamount = $request->amount;
        $paymentlogs->remarks = $request->remarks;
        $empbalance = employee_bal::where('employee_id', '=', $request->employee_payment_id)->latest()->first();
        $empbalance->balance = $request->balance - $request->amount;
        $empbalance->save();
        $paymentlogs->save();
        $balance->save();
        //
        //
        $user = User::find(1);
        $user_current =  $user->cashOnHand;
        $user->cashOnHand += $request->amount;
        $user->save();

        $userGet = User::where('id', '=', 1)->first();
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
        $employeeName= employee::where('id', '=', $request->employee_payment_id)->first();
        $cash_history->trans_no = $dateTime;
        $cash_history->previous_cash = $user_current;
        $cash_history->cash_change = $request->amount;
        $cash_history->total_cash = $user->cashOnHand;
        $cash_history->type = "Employee CA Payment (".$employeeName->fname." ".$employeeName->lname.")";
        $cash_history->save();

        $output = array(
            'cashOnHand' => $user->cashOnHand,
            'cashHistory'=> $dateTime,
            'user'       => Auth::user()->id,
        );
        
        echo json_encode($output);    
        }
        
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
            'p_payment' => $dtr_view[0]->p_payment,
            'r_balance' => $dtr_view[0]->r_balance,
            'dtr_balance' => $dtr_view[0]->dtr_balance,
            'num_hours' => $dtr_view[0]->num_hours,
            'salary' => $dtr_view[0]->salary,
        );
        echo json_encode($output);
    }

    function deletedata(Request $request){
        $dtr = dtr::find($request->input('id'));
        if($dtr->status == "Released"){
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

            $paymentlogs = emp_payment::where('dtr_id',$request->id)->count();
            $delete_dtr = emp_payment::where('dtr_id',$request->id);
            if($paymentlogs>0){
                 $recent = emp_payment::where('dtr_id', '=', $request->id)->latest()->first();
                 $recent_balance = emp_payment::where('logs_id', '=', $recent->logs_id)->latest()->first();
                $balance = employee_ca::where('employee_id', '=', $recent->logs_id)->latest()->first();
                   $balance->balance = $recent->paymentamount+$balance->balance;
                   $balance->save();  
                }
            $delete_dtr->delete();   
            echo json_encode($output);
        }else{
            $paymentlogs = emp_payment::where('dtr_id',$request->id)->count();
            $delete_dtr = emp_payment::where('dtr_id',$request->id);
            if($paymentlogs>0){
                $recent = emp_payment::where('dtr_id', '=', $request->id)->latest()->first();
                $recent_balance = emp_payment::where('logs_id', '=', $recent->logs_id)->latest()->first();
                $empbalance = employee_bal::where('employee_id', '=', $recent->logs_id)->first();
                $balance = employee_ca::where('employee_id', '=', $recent->logs_id)->latest()->first();
                $balance->balance = $recent->paymentamount+$balance->balance;
                $empbalance->balance = $balance->balance;
                $empbalance->save();  
                $balance->save();  
            }
            $delete_dtr->delete();
            $dtr->delete();
            echo  json_encode("deleted"); 
        }
        
    }
    

    function delete_ca_employee(Request $request){
        $ca = employee_ca::where('id',$request->id)->first();
        
            $check_balance= employee_ca::where('employee_id',$ca->employee_id)->latest()->first();
            if($check_balance->balance<$check_balance->amount){
                return json_encode("No");
            }else{
            if($ca->status=="Released"){
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
            $amount_ca = $ca->amount;
            
            $recent_ca= employee_ca::where('employee_id',$ca->employee_id)->latest()->first();
            $recent_ca->balance = $recent_ca->balance-$amount_ca;
            $empbalance = employee_bal::where('employee_id', '=', $ca->employee_id)->first();
            $empbalance->balance =$recent_ca->balance;
            $empbalance->save();  
            $recent_ca->save();
            $ca->delete();
            $cash_history->trans_no = $dateTime;
            $cash_history->previous_cash = $user->cashOnHand;
            $cash_history->cash_change = $ca->amount;
            $cash_history->total_cash = $user->cashOnHand + $ca->amount;
            $cash_history->type = "Released CA of Employee Deleted";
            $cash_history->save();

            $user->cashOnHand += $ca->amount;
            $user->save();
             $output = array(
                'cashOnHand' => $user->cashOnHand,
                'cashHistory' => $dateTime,
                'balance' => $recent_ca->balance,
                'username' => $user->username
            );
            return  json_encode($output);
        }
        else{
            $amount_ca = $ca->amount;
            $recent_ca= employee_ca::where('employee_id',$ca->employee_id)->latest()->first();
            $recent_ca->balance = $recent_ca->balance-$amount_ca;
            $empbalance = employee_bal::where('employee_id', '=', $ca->employee_id)->first();
            $empbalance->balance = $recent_ca->balance;
            $empbalance->save();  
            $recent_ca->save();
            $ca->delete();
            return json_encode("deleted");
        }   
            }
        
        
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
                return '<button class="btn btn-xs btn-success release_expense_dtr waves-effect" id="'.$dtr_view->id.'" ><i class="material-icons">eject</i></button>&nbsp&nbsp<button class="btn btn-xs btn-warning update_dtr waves-effect" id="'.$dtr_view->id.'" ><i class="material-icons">mode_edit</i></button>';    
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
                 return '<button class="btn btn-xs btn-success release_ca waves-effect" id="'.$cash_advance->id.'"><i class="material-icons">eject</i></button>&nbsp&nbsp<button class="btn btn-xs btn-danger delete_ca waves-effect" id="'.$cash_advance->id.'" ><i class="material-icons">delete</i></button>';
            }if($cash_advance->status=="On-Hand" && isAdmin()!=1 && $delete==1 && $edit==1){
                 return '<button class="btn btn-xs btn-success release_ca waves-effect" id="'.$cash_advance->id.'"><i class="material-icons">eject</i></button>&nbsp&nbsp<button class="btn btn-xs btn-danger delete_ca waves-effect" id="'.$cash_advance->id.'" ><i class="material-icons">delete</i></button>';
            }if($cash_advance->status=="On-Hand" && isAdmin()!=1 && $delete==1 && $edit==0){
                 return '<button class="btn btn-xs btn-success release_ca waves-effect" id="'.$cash_advance->id.'"><i class="material-icons">eject</i></button>&nbsp&nbsp<button class="btn btn-xs btn-danger delete_ca waves-effect" id="'.$cash_advance->id.'" ><i class="material-icons">delete</i></button>';
            }if($cash_advance->status=="On-Hand" && isAdmin()!=1 && $delete==0 && $edit==1){
                 return '<button class="btn btn-xs btn-success release_ca waves-effect" id="'.$cash_advance->id.'"><i class="material-icons">eject</i></button>';
            }else if($cash_advance->status=="On-Hand" && isAdmin()!=1 && $delete==0 && $edit==0){
                 return '<button class="btn btn-xs btn-success release_ca waves-effect" id="'.$cash_advance->id.'"><i class="material-icons">eject</i></button>';
            }
             else if($cash_advance->status=="Released" && isAdmin()==1){
                 return '<button class="btn btn-xs btn-danger released waves-effect" id="'.$cash_advance->id.'"><i class="material-icons">done_all</i></button>&nbsp&nbsp<button class="btn btn-xs btn-danger delete_ca waves-effect" id="'.$cash_advance->id.'" ><i class="material-icons">delete</i></button>';
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
        ->editColumn('amount', function ($data) { 
            return '₱'.number_format($data->amount, 2, '.', ',');
        })
        //  ->editColumn('created_at', function ($data) {
        //     return date('F d, Y g:i a', strtotime($data->created_at));
        // })

        ->make(true);

        echo json_encode($cash_advance);
    }


        public function employee_view_payment(Request $request){
         
        $id = $request->input('id');
        $payments = DB::table('emp_payments')
            ->join('employee', 'employee.id', '=', 'emp_payments.logs_id')
            ->select('emp_payments.id','emp_payments.logs_id', 'employee.fname', 'employee.mname', 'employee.lname', 'emp_payments.paymentmethod', 'emp_payments.paymentamount', 'emp_payments.created_at','emp_payments.checknumber','emp_payments.remarks','emp_payments.r_balance')
            ->where('emp_payments.logs_id', $id)
            ->get()->sortByDesc('created_at');
        return \DataTables::of($payments)
        //  ->addColumn('action', function($cash_advance){
        //     $userid= Auth::user()->id;
        //     $permit = UserPermission::where('user_id',$userid)->where('permit',1)->where('permission_id',5)->get();   
        //     if($userid!=1){
        //         $delete=$permit[0]->permit_delete;  
        //         $edit = $permit[0]->permit_edit;  
        //    }
        //     if($cash_advance->status=="On-Hand" && isAdmin()==1){
        //          return '<button class="btn btn-xs btn-success release_ca waves-effect" id="'.$cash_advance->id.'"><i class="material-icons">eject</i></button>&nbsp&nbsp<button class="btn btn-xs btn-warning update_ca waves-effect" id="'.$cash_advance->id.'" ><i class="material-icons">mode_edit</i></button>&nbsp&nbsp<button class="btn btn-xs btn-danger delete_ca waves-effect" id="'.$cash_advance->id.'" ><i class="material-icons">delete</i></button>';
        //     }if($cash_advance->status=="On-Hand" && isAdmin()!=1 && $delete==1 && $edit==1){
        //          return '<button class="btn btn-xs btn-success release_ca waves-effect" id="'.$cash_advance->id.'"><i class="material-icons">eject</i></button>&nbsp&nbsp<button class="btn btn-xs btn-warning update_ca waves-effect" id="'.$cash_advance->id.'" ><i class="material-icons">mode_edit</i></button>&nbsp&nbsp<button class="btn btn-xs btn-danger delete_ca waves-effect" id="'.$cash_advance->id.'" ><i class="material-icons">delete</i></button>';
        //     }if($cash_advance->status=="On-Hand" && isAdmin()!=1 && $delete==1 && $edit==0){
        //          return '<button class="btn btn-xs btn-success release_ca waves-effect" id="'.$cash_advance->id.'"><i class="material-icons">eject</i></button>&nbsp&nbsp<button class="btn btn-xs btn-danger delete_ca waves-effect" id="'.$cash_advance->id.'" ><i class="material-icons">delete</i></button>';
        //     }if($cash_advance->status=="On-Hand" && isAdmin()!=1 && $delete==0 && $edit==1){
        //          return '<button class="btn btn-xs btn-success release_ca waves-effect" id="'.$cash_advance->id.'"><i class="material-icons">eject</i></button>&nbsp&nbsp<button class="btn btn-xs btn-warning update_ca waves-effect" id="'.$cash_advance->id.'" ><i class="material-icons">mode_edit</i></button>';
        //     }else if($cash_advance->status=="On-Hand" && isAdmin()!=1 && $delete==0 && $edit==0){
        //          return '<button class="btn btn-xs btn-success release_ca waves-effect" id="'.$cash_advance->id.'"><i class="material-icons">eject</i></button>';
        //     }
        //     else{
        //          return '<button class="btn btn-xs btn-danger waves-effect" id="'.$cash_advance->id.'"><i class="material-icons">done_all</i></button>';
        //     }
           
        // })
        ->editColumn('paymentamount', function ($data) {
           return '₱'.number_format($data->paymentamount, 2, '.', ',');
        })
        ->editColumn('r_balance', function ($data) { 
            return '₱'.number_format($data->r_balance, 2, '.', ',');
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
        ->select('employee.*', 'roles.role','roles.rate','employee_cas.balance')
        ->leftJoin('employee_cas', function($query) {
                     $query->on('employee.id','=','employee_cas.employee_id')
                        ->whereRaw('employee_cas.id IN (select MAX(a2.id) from employee_cas as a2 join employee as u2 on u2.id = a2.employee_id group by u2.id)');
            })
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

    public function check_balance_user(Request $request){
        $user = User::find(Auth::user()->id);
        $expense = employee_ca::find($request->id);

        if($user->cashOnHand < $expense->amount){
            return 0;
        }
        else{
            return 1;
        }
    }


    public function release_ca_employee(Request $request){
        $check_admin =Auth::user()->id;
        if($check_admin==1){
            $logged_id = Auth::user()->name;
            $user = User::find(Auth::user()->id);
            $released = employee_ca::find($request->id);
            $released->status = "Released";
            $released->released_by = $logged_id;
            $released->save();
            event(new BalanceUpdated($released));
        }else{
            $logged_id = Auth::user()->emp_id;
            $name= Employee::find($logged_id);
            $user = User::find(Auth::user()->id);
            $released = employee_ca::find($request->id);
            $released->status = "Released";
            $released->released_by = $name->fname." ".$name->mname." ".$name->lname;
            $released->save();
            event(new BalanceUpdated($released));
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
        $cash_history->cash_change = $released->amount;
        $cash_history->total_cash = $user->cashOnHand - $released->amount;
        $cash_history->type = "Release Cash - Employee Cash Advance";
        $cash_history->save();

        $user->cashOnHand -= $released->amount;
        $user->save();
        
        event(new CashierCashUpdated());
        
        $output = array(
            'cashOnHand' => $user->cashOnHand,
            'cashHistory' => $dateTime
        );
        
        echo json_encode($output);
        //return $user->cashOnHand;
    }

    public function employee_balance(){
          
        $dtr_view = DB::table('employee_bal')
            ->join('employee', 'employee.id', '=', 'employee_bal.employee_id')
            ->join('dtr', 'employee.id', '=', 'dtr.employee_id')
            ->select('employee_bal.balance','dtr.role','employee.fname','employee.lname')
            ->where('employee_bal.balance','>',0)
            ->groupBy('employee_bal.employee_id')
            ->get();
             
        return \DataTables::of($dtr_view)
        ->editColumn('balance', function ($data) {
            return '₱ '.number_format($data->balance, 2, '.', ',');
        })
        ->editColumn('name', function ($data) {
            return $data->fname." ".$data->lname;
        })
         ->editColumn('role', function ($data) {
            return $data->role; 

        })
        ->make(true);
     return json_encode($dtr_view);
    }
}
