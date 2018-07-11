<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
// reference the Dompdf namespace
use Dompdf\Dompdf;

class pdfController extends Controller
{

	function generate_pdf($pdf, $name){
		// instantiate and use the dompdf class
		$dompdf = new Dompdf();
		$dompdf->loadHtml($pdf);

		// (Optional) Setup the paper size and orientation
		$customPaper = array(0,0,300,360);
		$dompdf->set_paper($customPaper);

		// Render the HTML as PDF
		$dompdf->render();

		// Output the generated PDF to Browser
		$dompdf->stream($name, array("Attachment" => false));
	}

    public function trips($skip_count){

	    $details =  DB::table('trips')->orderBy('id', 'desc')->skip($skip_count)->first();

	    $commodity =  DB::table('commodity')->where('id', $details->commodity_id)->first();
	    $driver =  DB::table('employee')->where('id', $details->driver_id)->first();
	    $truck =  DB::table('trucks')->where('id', $details->truck_id)->first();

	    $pdf = "<html>
		<head>
		<title>Trips PDF</title>
		<style>
		body {
			font-family: sans-serif;
		    font-style: normal;
		}
		</style>
		</head>
		<body>
		<basefont size='4'>
		<h2>RECENT TRANSACTION</h2>";
		$pdf .= "<div>
				<span>Trip Ticket: </span>
				<span><b>".$details->trip_ticket."</b></span>
				<br>
				<span>Expense: </span>
				<span><b>PhP ".$details->expense."</b></span>
				<br>
				<span>Commodity: </span>
				<span><b>".$commodity->name."</b></span>
				<br>
				<span>Driver: </span>
				<span><b>".$driver->fname." ".$driver->mname." ".$driver->lname."</b></span>
				<br>
				<span>Plate #: </span>
				<span><b>".$truck->name."  ".$truck->plate_no."</b></span>
				<br>
				<span>Destination: </span>
				<span><b>".$details->destination."</b></span>
				<br>
				<span># of Liters: </span>
				<span><b>".$details->num_liters."</b></span>
				<br>

		         </div>";

		self::generate_pdf($pdf,'trips');
    }

    public function expenses(){

	    $details =  DB::table('expenses')->latest()->first();


	    $pdf = "<html>
		<head>
		<title>Expense PDF</title>
		<style>
		body {
			font-family: sans-serif;
		    font-style: normal;
		}
		</style>
		</head>
		<body>
		<basefont size='4'>
		<h2>RECENT TRANSACTION</h2>";
		$pdf .= "<div>
				<span>Name: </span>
				<span><b>".$details->description."</b></span>
				<br>
				<span>Type: </span>
				<span><b>".$details->type."</b></span>
				<br>
				<span>Amount: </span>
				<span><b>PhP ".$details->amount."</b></span>
				<br>

		        </div>";

		self::generate_pdf($pdf,'expense');
    }

    public function dtr(){

	    $details =  DB::table('dtr')->latest()->first();

	    $employee =  DB::table('employee')->where('id', $details->employee_id)->first();

	    $pdf = "<html>
		<head>
		<title>DTR PDF</title>
		<style>
		body {
			font-family: sans-serif;
		    font-style: normal;
		}
		</style>
		</head>
		<body>
		<basefont size='4'>
		<h2>RECENT TRANSACTION</h2>";
		$pdf .= "<div>
				<span>Name: </span>
				<span><b>".$employee->fname." ".$employee->mname." ".$employee->lname."</b></span>
				<br>
				<span>Role: </span>
				<span><b>".$details->role."</b></span>
				<br>
				<span>Overtime: </span>
				<span><b>".$details->overtime."</b></span>
				<br>
				<span>Rate: </span>
				<span><b>PhP ".$details->rate."</b></span>
				<br>
				<span>Number of hours: </span>
				<span><b>".$details->num_hours."</b></span>
				<br>
				<span>Salary: </span>
				<span><b>PhP ".$details->salary."</b></span>
				<br>

		        </div>";

		self::generate_pdf($pdf,'dtr');
    }

    public function od(){

	    $details =  DB::table('deliveries')->latest()->first();

	    $commodity =  DB::table('commodity')->where('id', $details->commodity_id)->first();
	    $driver =  DB::table('employee')->where('id', $details->driver_id)->first();
	    $company =  DB::table('company')->where('id', $details->company_id)->first();
	    $truck =  DB::table('trucks')->where('id', $details->plateno)->first();

	    $pdf = "<html>
		<head>
		<title>Outbound Deliveries PDF</title>
		<style>
		body {
			font-family: sans-serif;
		    font-style: normal;
		}
		</style>
		</head>
		<body>
		<basefont size='4'>
		<h2>RECENT TRANSACTION</h2>";
		$pdf .= "<div>
				<span>Outbound ticket: </span>
				<span><b>".$details->outboundTicket."</b></span>
				<br>
				<span>Commodity: </span>
				<span><b>".$commodity->name."</b></span>
				<br>
				<span>Destination: </span>
				<span><b>".$details->destination."</b></span>
				<br>
				<span>Driver: </span>
				<span><b>".$driver->fname." ".$driver->mname." ".$driver->lname."</b></span>
				<br>
				<span>Company: </span>
				<span><b>".$company->name."</b></span>
				<br>
				<span>Plate #: </span>
				<span><b>".$truck->plate_no."</b></span>
				<br>
				<span>No. of liters: </span>
				<span><b>PhP ".$details->fuel_liters."</b></span>
				<br>

		        </div>";

		self::generate_pdf($pdf,'od');
    }

    public function ca(){

	    $details =  DB::table('cash_advance')->latest()->first();

	    $customer =  DB::table('customer')->where('id', $details->customer_id)->first();

	    $pdf = "<html>
		<head>
		<title>Cash Advance PDF</title>
		<style>
		body {
			font-family: sans-serif;
		    font-style: normal;
		}
		</style>
		</head>
		<body>
		<basefont size='4'>
		<h2>RECENT TRANSACTION</h2>";
		$pdf .= "<div>
				<span>Name: </span>
				<span><b>".$customer->fname." ".$customer->mname." ".$customer->lname."</b></span>
				<br>
				<span>Reason: </span>
				<span><b>".$details->reason."</b></span>
				<br>
				<span>Amount: </span>
				<span><b>".$details->amount."</b></span>
				<br>
				<span>Balance: </span>
				<span><b>".$details->balance."</b></span>


		        </div>";

		self::generate_pdf($pdf,'ca');
    }

    public function purchases(){

	    $details =  DB::table('purchases')->latest()->first();

	    $customer =  DB::table('customer')->where('id', $details->customer_id)->first();
	    $commodity =  DB::table('commodity')->where('id', $details->commodity_id)->first();
	    $cash_advance =  DB::table('balance')->where('id', $details->ca_id)->first();

	    $pdf = "<html>
		<head>
		<title>Purchases PDF</title>
		<style>
		body {
			font-family: sans-serif;
		    font-style: normal;
		}
		</style>
		</head>
		<body>
		<basefont size='4'>
		<h2>RECENT TRANSACTION</h2>";
		$pdf .= "<div>
				<span>Transaction No.: </span>
				<span><b>".$details->trans_no."</b></span>
				<br>
				<span>Customer: </span>
				<span><b>".$customer->fname." ".$customer->mname." ".$customer->lname."</b></span>
				<br>
				<span>Commodity: </span>
				<span><b>".$commodity->name."</b></span>
				<br>
				<span>Sacks: </span>
				<span><b>".$details->sacks."</b></span>
				<br>
				<span>Cash Advance: </span>
				<span><b>PhP ".$cash_advance->balance."</b></span>
				<br>
				<span>Balance: </span>
				<span><b>PhP ".$details->balance_id."</b></span>
				<br>
				<span>Partial payment: </span>
				<span><b>PhP ".$details->partial."</b></span>
				<br>
				<span>No. of kilos: </span>
				<span><b>".$details->kilo."</b></span>
				<br>
				<span>Price: </span>
				<span><b>PhP ".$details->price."</b></span>
				<br>
				<span>Total: </span>
				<span><b>PhP ".$details->total."</b></span>
				<br>
				<span>Deducted: </span>
				<span><b>PhP ".$details->amtpay."</b></span>
				<br>
				<span>Remarks: </span>
				<span><b>".$details->remarks."</b></span>
				<br>

		        </div>";

		self::generate_pdf($pdf,'purchases');
    }

    public function sales(){

	    $details =  DB::table('sales')->latest()->first();

	    $commodity =  DB::table('commodity')->where('id', $details->commodity_id)->first();
	    $company =  DB::table('company')->where('id', $details->company_id)->first();

	    $pdf = "<html>
		<head>
		<title>Sales PDF</title>
		<style>
		body {
			font-family: sans-serif;
		    font-style: normal;
		}
		</style>
		</head>
		<body>
		<basefont size='4'>
		<h2>RECENT TRANSACTION</h2>";
		$pdf .= "<div>
				<span>Commodity: </span>
				<span><b>".$commodity->name."</b></span>
				<br>
				<span>Company: </span>
				<span><b>".$company->name."</b></span>
				<br>
				<span>Kilos: </span>
				<span><b>".$details->kilos."</b></span>
				<br>
				<span>Amount: </span>
				<span><b>PhP ".$details->amount."</b></span>
				<br>

		        </div>";

		self::generate_pdf($pdf,'sales');
    }
}
