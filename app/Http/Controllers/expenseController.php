<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Expense;
use App\User;
use App\Employee;
use App\trip_expense;
use Auth;
use App\Events\ExpensesUpdated;
use DB;

class expenseController extends Controller
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

        return view('main.expense');

    }

    public function store(Request $request)
    {
        $expense = new Expense;
        $expense->description = $request->expense;
        $expense->type = $request->type;
        $expense->amount = $request->amount;
        $expense->status = "On-Hand";
        $expense->released_by = '';
        $expense->save();

        
        event(new ExpensesUpdated($expense));
    }

    public function release_update_normal(Request $request){
        $check_admin =Auth::user()->access_id;
        if($check_admin==1){
            $logged_id = Auth::user()->name;
            $user = User::find(Auth::user()->id);
            $released = expense::find($request->id);
            $released->status = "Released";
            $released->released_by = $logged_id;
            $released->save();
        }else{
            $logged_id = Auth::user()->emp_id;
            $name= Employee::find($logged_id);
            $user = User::find(Auth::user()->id);
            $released = expense::find($request->id);
            $released->status = "Released";
            $released->released_by = $name->fname." ".$name->mname." ".$name->lname;
            $released->save();
        }

        $user->cashOnHand -= $released->amount;
        $user->save();
        
        return $user->cashOnHand;
    }

    public function check_balance(Request $request){
        $user = User::find(Auth::user()->id);
        $expense = Expense::find($request->id);

        if($user->cashOnHand < $expense->amount){
            return 0;
        }
        else{
            return 1;
        }
    }

    public function check_balance2(Request $request){
        $user = User::find(Auth::user()->id);
        $expense = trip_expense::find($request->id);

        if($user->cashOnHand < $expense->amount){
            return 0;
        }
        else{
            return 1;
        }
    }

    public function refresh(Request $request){  

      $from = $request->date_from;
      $to = $request->date_to;    
        if($to==""){
         //$expense =Expense::all()
                    //->latest();
        $expense = DB::table('expenses')->latest();
        }else{
           
             $expense =Expense::where('created_at', '>=', date('Y-m-d', strtotime($from))." 00:00:00")
                ->where('created_at','<=',date('Y-m-d', strtotime($to)) ." 23:59:59")
                ->latest();
        }
          
       return \DataTables::of($expense)
       ->addColumn('action', function($expense){
            if($expense->status=="On-Hand"){
                 return '<button class="btn btn-xs btn-success release_expense_normal waves-effect" id="'.$expense->id.'"><i class="material-icons">eject</i></button>';
            }else{
                 return '<button class="btn btn-xs btn-danger released waves-effect" id="'.$expense->id.'"><i class="material-icons">done_all</i></button>';
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

    public function autoComplete(Request $request){
        $query = $request->get('term','');

        $products=Employee::where('fname','LIKE','%'.$query.'%')->orWhere('mname','LIKE','%'.$query.'%')->orWhere('lname','LIKE','%'.$query.'%')->get();

        $data=array();
        foreach ($products as $product){
            $data[]=array('value'=>$product->fname.' '.$product->mname.' '.$product->lname,'id'=>$product->id);
        }
        if(count($data))
        return $data;
    }


}
