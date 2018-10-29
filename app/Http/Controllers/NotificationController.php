<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Notification;

class NotificationController extends Controller
{
    public function __construct() {
        $this->middleware('auth');
    }

    public function update(Request $request, $option) {
        if($option === 'seen') {
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

    public function get($page = null) {
        if($page) {

        } else {
            $data = Notification::orderBy('id', 'DESC')
                    ->with('admin', 'cash_advance', 'expense', 'dtr.dtrId.employee', 'trip.tripId.employee', 'od.odId.driver')
                    ->get();
            $count = Notification::where('status', 'Pending')->count();
            
            $notification = array();

            foreach ($data as $datum) {
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

            if($notification) 
                echo json_encode($notification);
            else echo json_encode(null);
        }
    }
}
