<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Notification;

class NotificationController extends Controller
{
    public function __construct() {
        $this->middleware('auth');
    }

    public function get($page = null) {
        if($page) {

        } else {
            $data = Notification::orderBy('id', 'DESC')
                    ->with('admin', 'cash_advance')
                    ->get();     
            $notification = array();

            foreach ($data as $datum) {
                $notification[] = array(
                    'notifications' => $datum,
                    'customer' => $datum->cash_advance->customer,
                    'time' => time_elapsed_string($datum->updated_at), 
                );
            }

            if($notification) 
                echo json_encode($notification);
            else echo json_encode(null);
        }
    }
}
