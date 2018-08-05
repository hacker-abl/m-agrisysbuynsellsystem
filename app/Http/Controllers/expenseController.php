<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Expense;
use App\Employee;
use Auth;
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
    }
     public function release_update_normal(Request $request){
        $logged_id = Auth::user()->name;
         
        $released=expense::find($request->id);
        $released->status = "Released";
        $released->released_by = $logged_id;
        $released->save();
        echo json_encode("released");
    }

    public function refresh()
    {
        $expense = Expense::all();
       return \DataTables::of($expense)
       ->addColumn('action', function($expense){
            if($expense->status=="On-Hand"){
                 return '<button class="btn btn-xs btn-success release_expense_normal waves-effect" id="'.$expense->id.'" data-toggle="modal" data-target="#release_modal_normal"><i class="material-icons">eject</i></button>';
            }else{
                 return '<button class="btn btn-xs btn-danger released waves-effect" id="'.$expense->id.'"><i class="material-icons">done_all</i></button>';
            }
           
        })
        ->editColumn('amount', function ($data) {
            return '₱'.number_format($data->amount, 2, '.', ',');
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
