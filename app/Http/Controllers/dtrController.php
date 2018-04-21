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
        $dtr->save();

        $details = dtr_expense::all();

        echo json_encode($details);
    }

    public function refresh(){
        $dtr = DB::select('
            SELECT p1.*, p3.fname, p3.mname, p3.lname 
            FROM dtr p1
            INNER JOIN(
                SELECT MAX(created_at) maxdate, employee_id
                FROM dtr
                GROUP BY employee_id
            ) p2
            ON p1.employee_id = p2.employee_id
            AND p1.created_at = p2.maxdate
            LEFT JOIN employee as p3 ON p1.employee_id = p3.id
            ORDER BY p1.created_at desc
        ');
        return \DataTables::of($dtr)
        ->addColumn('action', function($dtr){
            return '<button class="btn btn-xs btn-info view_dtr" id="'.$dtr->employee_id.'"><i class="material-icons" style="width: 25px;">visibility</i></button>';//info/visibility
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
