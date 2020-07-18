<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Notification;

class NotificationController extends Controller
{
    public function __construct() {
        $this->middleware('auth');
    }

    public function index() {
        return view('notifications.index');
    }

    public function update(Request $request, $option) {
        if($option == 'seen') {
            $validatedData = $request->validate([
                'notification' => 'required',
            ]);
    
            $notification = Notification::find($validatedData['notification']);
    
            $notification->status = 'Seen';
    
            $notification->save();

            if($notification->notification_type == "cash advance") {
                return route('ca');
            } else if($notification->notification_type == "expense") {
                return route('expense');
            } else if($notification->notification_type == "daily time record") {
                return route('dtr');
            } else if($notification->notification_type == "trips expense") {
                return route('trips');
            } else if($notification->notification_type == "outbound expense") {
                return route('expense')."#od_expense_tab";
            }

            return 'false';
        }
    }

    public function get(Request $request, $page = null) {
        if($page) {

        } else {
            if(isset($request->id) && isset($request->per_page)){
                $data = Notification::orderBy('id', 'DESC')
                        ->with('admin', 'cash_advance', 'expense', 'dtr.dtrId.employee', 'trip.tripId.employee', 'od.odId.driver')
                        ->where('id', '<', $request->id)
                        ->limit($request->per_page)
                        ->get();
            } else {
                $data = Notification::orderBy('id', 'DESC')
                ->with('admin', 'cash_advance', 'expense', 'dtr.dtrId.employee', 'trip.tripId.employee', 'od.odId.driver')
                ->limit(20)
                ->get();
            }

            $count = Notification::where('status', 'Pending')->count();
            $next = 0;
            
            $notification = array();

            foreach ($data as $key => $datum) {
                if($key + 1 === count($data)) {
                    $next = Notification::where('id', '<', $datum->id)->count();
                }

                if(!empty($datum->cash_advance)) {
                    $notification['notification'][] = array(
                        'notifications' => $datum,
                        'customer' => $datum->cash_advance->customer,
                        'time' => time_elapsed_string($datum->updated_at), 
                    );
                }else if(!empty($datum->expense)) {
                    $notification['notification'][] = array(
                        'notifications' => $datum,
                        'customer' => array('lname' => 'Misc.','fname' => 'Expense','mname' => ''),
                        'time' => time_elapsed_string($datum->updated_at), 
                    );
                }else if(!empty($datum->dtr)) {
                    $notification['notification'][] = array(
                        'notifications' => $datum,
                        'customer' => $datum->dtr->dtrId->employee,
                        'time' => time_elapsed_string($datum->updated_at), 
                    );
                }else if(!empty($datum->trip)) {
                    $notification['notification'][] = array(
                        'notifications' => $datum,
                        'customer' => $datum->trip->tripId->employee,
                        'time' => time_elapsed_string($datum->updated_at), 
                    );
                }else if(!empty($datum->od)) {
                    $notification['notification'][] = array(
                        'notifications' => $datum,
                        'customer' => $datum->od->odId->driver,
                        'time' => time_elapsed_string($datum->updated_at), 
                    );
                }
            }
            
            $notification['count'] = $count;
            $notification['next'] = $next;

            if($notification) 
                echo json_encode($notification);
            else echo json_encode(null);
        }
    }
}
