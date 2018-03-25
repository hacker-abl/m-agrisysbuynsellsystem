<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Expense;
use App\Employee;
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
      $temp = DB::select('select MAX(id) as "temp" FROM deliveries');


        return view('main.expense')->with(compact('temp'));

    }

    public function store(Request $request)
    {

        $expense = new Expense;
        $expense->description = $request->expense;
        $expense->type = $request->type;
        $expense->amount = $request->amount;
        $expense->save();
    }

    public function refresh()
    {
        $expense = Expense::all();
        return \DataTables::of(Expense::query())
        ->editColumn('amount', function ($data) {
                return '₱'.number_format($data->amount, 2, '.', ',');
            })
        ->make(true);

    }

    public function autoComplete(Request $request){
        $query = $request->get('term','');

        $products=Employee::where('fname','LIKE','%'.$query.'%')->orWhere('mname','LIKE','%'.$query.'%')->orWhere('lname','LIKE','%'.$query.'%')->get();

        $data=array();
        foreach ($products as $product) {
                $data[]=array('value'=>$product->fname.' '.$product->mname.' '.$product->lname,'id'=>$product->id);
        }
        if(count($data))
        return $data;
    }


}
