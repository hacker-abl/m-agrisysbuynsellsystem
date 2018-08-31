<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Database\Query\Builder;
use App\dtr;
use App\dtr_expense;
use App\employee;
use Auth;
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
    public function index(){
        $employee = employee::all();

        return view('main.dtr', compact('employee'));
    }

    public function store(Request $request){
        $dtr = new dtr;
        $dtr->employee_id = $request->employee_id;
        $dtr->role = $request->role;
        $dtr->overtime = $request->overtime;
        $dtr->num_hours = $request->num_hours;
        $dtr->rate = $request->rate;
        $dtr->salary = $request->salary;
        $dtr->status = "On-Hand";
        $dtr->save();

        $details = dtr::where('employee_id', $request->employee_id)->orderBy('employee_id', 'desc')->latest()->get();

        echo json_encode($details);
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

        $details = dtr_expense::all();

        echo json_encode($details);
    }
     public function release_update_dtr(Request $request){
        $check_admin =Auth::user()->access_id;
        if($check_admin==1){
            $logged_id = Auth::user()->name;
            $user = User::find(Auth::user()->id);
            $released = expense::find($request->id);
            $released->status = "Released";
            $released->released_by = $logged_id;
            $released->save();
            //$user->cashOnHand -= $released->amount;
            //$user->save();
        }else{
            $logged_id = Auth::user()->emp_id;
            $name= Employee::find($logged_id);
            $released=dtr::find($request->id);
            $released->status = "Released";
            $released->released_by = $name->fname." ".$name->mname." ".$name->lname;
            $released->save();
            echo json_encode("released");

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
            ->orderBy('dtr1.created_at', 'desc')
            ->get();
        return \DataTables::of($dtr)
        ->addColumn('action', function($dtr){
            return '<button class="btn btn-xs btn-info view_dtr waves-effect" id="'.$dtr->employee_id.'"><i class="material-icons" style="width: 25px;">visibility</i></button>';//info/visibility
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
            ->select('dtr.*', 'employee.fname', 'employee.mname', 'employee.lname')
            ->where('dtr.employee_id', $id)
            ->get();
        return \DataTables::of($dtr_view)
        ->addColumn('action', function($dtr_view){
            if($dtr_view->status=="On-Hand"){
                 return '<button class="btn btn-xs btn-success release_expense_dtr waves-effect" id="'.$dtr_view->id.'" ><i class="material-icons">eject</i></button>';
            }else{
                 return '<button class="btn btn-xs btn-danger released waves-effect" id="'.$dtr_view->id.'"><i class="material-icons">done_all</i></button>';
            }
           
        })
         ->editColumn('released_by', function ($data) {
            if($data->released_by==""){
                return 'None';
            }else{
                return $data->released_by;
            }
            
        })
        ->make(true);
        echo json_encode($dtr_view);
    }

    public function check_employee(Request $request){

        $employee_details = DB::table('employee')
        ->join('roles', 'employee.role_id', '=', 'roles.id')
        ->select('employee.*', 'roles.role','roles.rate')
        ->where('employee.id', $request->id)
        ->get();
        echo json_encode($employee_details);
    }
}
