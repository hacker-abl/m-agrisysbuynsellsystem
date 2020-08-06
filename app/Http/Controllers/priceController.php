<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use DB;
use App\Commodity;
use App\price;
use App\Company;
use Carbon\Carbon;
use App\Events\SalesUpdated;
use Auth;
use App\UserPermission;
class priceController extends Controller
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

        // $driver= DB::table('employee')
          //  ->join('roles', 'roles.id', '=', 'employee.role_id')
          //  ->select('employee.*','employee.id AS emp_id',  'roles.id','roles.role')
          //  ->where('roles.role','LIKE','%driver%')
          //  ->get();

        $commodity = Commodity::all();
        $company = Company::all();

        return view('main.price')->with(compact('commodity','company'));
    }

    public function store(Request $request) 
    {
        
        if($request->get('button_action') == 'update'){
          $price= new price;
          $price= price::find($request->get('id'));
          $price->trans_number = $request->trans_num;
          $price->commodity_id = $request->commodity;
          $price->company_id = $request->company;
          $price->kilos = $request->kilos;
          $price->price = $request->price;
          $price->amount = $request->amount;
          $price->receiver_id = Auth::user()->id;
            if( $request->checknumber!=""){
                $price->check_number = $request->checknumber;
            }
            if( $request->checknumber==""){
                $price->check_number = "Not Specified";
            }
          $price->save();
        }else{
            $price= new price;
            $price->commodity_id = $request->commodity_id;
            $price->company_id = $request->company_id;
            $price->price = $request->price;
            $price->date = $request->date." ".rtrim($request->time, " APMapm");
            $price->save();
        }

        //$totalSalesToday = sales::whereDate('created_at', Carbon::today())->get([DB::raw('SUM(amount) AS total_sales')]);
        
        // event(new SalesUpdated($sales));
    }
     function getPrice(Request $request){
        // $latest = price::select('commodity_id','company_id', 'price', 'date', DB::raw('MAX(created_at) as created_at'))
        // ->groupBy('commodity_id', 'company_id');
        // $salesLatest = DB::table('prices')
        // ->joinSub($latest, 'latest_price', function ($join) {
        //     $join->on('prices.commodity_id', '=', 'latest_price.commodity_id')
        //          ->on('prices.company_id', '=', 'latest_price.company_id')
        //          ->on('prices.price', '=', 'latest_price.price')
        //          ->on('prices.date', '=', 'latest_price.date')
        //           ->on('prices.created_at', '=', 'latest_posts. created_at');
        // })->get();

        $items = price::whereRaw('id IN (select MAX(id) FROM prices GROUP BY commodity_id,company_id)')->get();

         return \DataTables::of($items)
         ->editColumn('price', function ($data) {
            
            return $data->price;
        })
        ->editColumn('commodity', function ($data) {
            return $data->commodity;
        })
        ->editColumn('company', function ($data) {
           
                return $data->company;
        })
        ->editColumn('date', function ($data) {
           
            return date('F d, Y g:i a', strtotime($data->date));
    })
         ->make(true);
     }
     function getPriceList(Request $request){
        
         $allData=[];
     
         $labels=[];
         $lab=[];
        foreach ($request->company_id as $key => $value) {
        $rand = array('0', '1', '2', '3', '4', '5', '6', '7', '8', '9', 'a', 'b', 'c', 'd', 'e', 'f');
        $color = '#'.$rand[rand(0,15)].$rand[rand(0,15)].$rand[rand(0,15)].$rand[rand(0,15)].$rand[rand(0,15)].$rand[rand(0,15)];
        $items = price::orderBy('date')->where([['commodity_id',$request->commodity_id],['company_id',$value]])->get();
        $dataset=[];
        if(count($items)>0){
            $pricepluck=$items->pluck('price');
            $datepluck=$items->pluck('date');
            // var_dump($datepluck);
            $datedata=[];
            foreach ($pricepluck as $key => $value) {
                array_push($datedata,(object) ['x' => $datepluck[$key],'y'=>$value]);
            }
            $object = (object) ['label' => $items[0]->commodities->name."(".$items[0]->companies->name.")",'data'=>$datedata, 'fill'=>false,
            'borderColor'=>$color,
            'lineTension'=>0.1];
            array_push($dataset, $object);
            array_push($labels,$items->pluck('date'));
            array_unique($labels);
            foreach ($labels as $key => $val) {
                array_push($lab, $val);
            }
            
            array_push($allData,$dataset);
        }
       
        
        }  

        // $flatlabels=array_flatten($labels);
       
        $result=[
            'dataset'=>array_flatten($allData),
            'labels'=>array_flatten($labels)
        ]; 

       
        
        return $result;
     }
    function updatedata(Request $request){
        $id = $request->input('id');
        $sales = sales::find($id);
        $output = array(
            'trans_number' => $sales->trans_number,
            'commodity_id' => $sales->commodity_id,
            'company_id' => $sales->company_id,
            'kilos' => $sales->kilos,
            'amount' => $sales->amount,
            'price' => $sales->price,
            'check_number' => $sales->check_number ,
        );
        echo json_encode($output);
    }

    function deletedata(Request $request){
        $sales = sales::find($request->input('id'));
        $sales->delete();
    }

    public function refresh(Request $request)
    {
        $from = $request->date_from;
        $to = $request->date_to; 

        if($to==""){
         $ultimatesickquery= DB::table('sales')
            ->join('commodity', 'commodity.id', '=', 'sales.commodity_id')
            ->join('company', 'company.id', '=', 'sales.company_id')
            ->join('users', 'users.id', '=', 'sales.receiver_id')
            ->select('sales.id','sales.created_at','commodity.name AS commodity_name','sales.kilos','sales.amount','company.name','users.name as uname','sales.check_number','sales.price as price','sales.trans_number as trans_number')
            ->latest();
        }else{
           $ultimatesickquery= DB::table('sales')
            ->join('commodity', 'commodity.id', '=', 'sales.commodity_id')
            ->join('company', 'company.id', '=', 'sales.company_id')
            ->join('users', 'users.id', '=', 'sales.receiver_id')
            ->select('sales.id','sales.created_at','commodity.name AS commodity_name','sales.kilos','sales.amount','company.name','users.name as uname','sales.check_number','sales.price as price','sales.trans_number as trans_number')
            ->where('sales.created_at', '>=', date('Y-m-d', strtotime($from))." 00:00:00")
            ->where('sales.created_at','<=',date('Y-m-d', strtotime($to)) ." 23:59:59")
            ->latest();
               
                      
        }   
        
        return \DataTables::of($ultimatesickquery)
        ->addColumn('action', function(  $ultimatesickquery){
            $userid= Auth::user()->id;
            $permit = UserPermission::where('user_id',$userid)->where('permit',1)->where('permission_id',7)->get();
            if($userid!=1){
              $delete=$permit[0]->permit_delete;  
              $edit = $permit[0]->permit_edit;
            }   
            
            if($userid==1){
               return '<div class="btn-group"><button class="btn btn-xs btn-warning update_sales  waves-effect" id="'.$ultimatesickquery->id.'"><i class="material-icons">mode_edit</i></button>&nbsp;
                <button class="btn btn-xs btn-danger delete_sales  waves-effect" id="'.$ultimatesickquery->id.'"><i class="material-icons">delete</i></button></div>';
            }
            if($userid!=1 && $delete==1 && $edit==1){
               return '<div class="btn-group"><button class="btn btn-xs btn-warning update_sales  waves-effect" id="'.$ultimatesickquery->id.'"><i class="material-icons">mode_edit</i></button>&nbsp;
                <button class="btn btn-xs btn-danger delete_sales  waves-effect" id="'.$ultimatesickquery->id.'"><i class="material-icons">delete</i></button></div>';
            }  
            if($userid!=1 && $delete==0 && $edit==1){
               return '<div class="btn-group"><button class="btn btn-xs btn-warning update_sales  waves-effect" id="'.$ultimatesickquery->id.'"><i class="material-icons">mode_edit</i></button>
                </div>';
            }if($userid!=1 && $delete==1 && $edit==0){
               return '<div class="btn-group">
                <button class="btn btn-xs btn-danger delete_sales  waves-effect" id="'.$ultimatesickquery->id.'"><i class="material-icons">delete</i></button></div>';
            }if($userid!=1 && $delete==0 && $edit==0){
               return 'No Action Permitted';
            }        
           
        })
        ->editColumn('amount', function ($data) {
            return '₱'.number_format($data->amount, 2, '.', ',');
        })
        ->editColumn('amount', function ($data) {
            return '₱ '.number_format($data->amount, 2, '.', ',');
        })
        ->editColumn('price', function ($data) {
            return '₱ '.number_format($data->price, 2, '.', ',');
        })
         ->editColumn('created_at', function ($data) {
            return date('F d, Y g:i a', strtotime($data->created_at));
        })
        ->make(true);

        var_dump($ultimatesickquery);
    }
}
