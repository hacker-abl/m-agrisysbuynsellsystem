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

    public function trips(Request $request){

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
				<span><b>".$request->ticket_clone."</b></span>
				<br>
				<span>Expense: </span>
				<span><b>PhP ".$request->expense_clone."</b></span>
				<br>
				<span>Commodity: </span>
				<span><b>".$request->commodity_clone."</b></span>
				<br>
				<span>Driver: </span>
				<span><b>".$request->driver_id_clone."</b></span>
				<br>
				<span>Plate #: </span>
				<span><b>".$request->plateno_clone."</b></span>
				<br>
				<span>Destination: </span>
				<span><b>".$request->destination_clone."</b></span>
				<br>
				<span># of Liters: </span>
				<span><b>".$request->num_liters_clone."</b></span>
				<br>

		         </div>";

		self::generate_pdf($pdf,'trips');
    }

    public function expenses(Request $request){

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
				<span><b>".$request->expense_clone."</b></span>
				<br>
				<span>Type: </span>
				<span><b>".$request->type_clone."</b></span>
				<br>
				<span>Amount: </span>
				<span><b>PhP ".$request->amount_clone."</b></span>
				<br>

		        </div>";

		self::generate_pdf($pdf,'expense');
    }

    public function dtr(Request $request){

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
				<span><b>".$request->employee_id_clone."</b></span>
				<br>
				<span>Role: </span>
				<span><b>".$request->role_clone."</b></span>
				<br>
				<span>Overtime: </span>
				<span><b>".$request->overtime_clone."</b></span>
				<br>
				<span>Rate: </span>
				<span><b>PhP ".$request->rate_clone."</b></span>
				<br>
				<span>Number of hours: </span>
				<span><b>".$request->num_hours_clone."</b></span>
				<br>
				<span>Salary: </span>
				<span><b>PhP ".$request->salary_clone."</b></span>
				<br>

		        </div>";

		self::generate_pdf($pdf,'dtr');
    }

    public function od(Request $request){

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
				<span><b>".$request->ticket_clone."</b></span>
				<br>
				<span>Commodity: </span>
				<span><b>".$request->commodity_clone."</b></span>
				<br>
				<span>Destination: </span>
				<span><b>".$request->destination_clone."</b></span>
				<br>
				<span>Driver: </span>
				<span><b>".$request->driver_id_clone."</b></span>
				<br>
				<span>Company: </span>
				<span><b>".$request->company_clone."</b></span>
				<br>
				<span>Plate #: </span>
				<span><b>".$request->plateno_clone."</b></span>
				<br>
				<span>No. of liters: </span>
				<span><b>".$request->liter_clone."</b></span>
				<br>

		        </div>";

		self::generate_pdf($pdf,'od');
    }

    public function ca(Request $request){

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
				<span><b>".$request->customer_id_clone."</b></span>
				<br>
				<span>Reason: </span>
				<span><b>".$request->reason_clone."</b></span>
				<br>
				<span>Amount: </span>
				<span><b>".$request->amount_clone."</b></span>
				<br>
				<span>Balance: </span>
				<span><b>".$request->balance_clone."</b></span>


		        </div>";

		self::generate_pdf($pdf,'ca');
    }

    public function purchases(Request $request){

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
				<span><b>".$request->ticket_clone."</b></span>
				<br>
				<span>Customer: </span>
				<span><b>".$request->customer_clone."</b></span>
				<br>
				<span>Commodity: </span>
				<span><b>".$request->commodity_clone."</b></span>
				<br>
				<span>Sacks: </span>
				<span><b>".$request->sacks_clone."</b></span>
				<br>
				<span>Cash Advance: </span>
				<span><b>PhP ".$request->ca_clone."</b></span>
				<br>
				<span>Balance: </span>
				<span><b>PhP ".$request->balance_clone."</b></span>
				<br>
				<span>Partial payment: </span>
				<span><b>PhP ".$request->partial_clone."</b></span>
				<br>
				<span>No. of kilos: </span>
				<span><b>".$request->kilos_clone."</b></span>
				<br>
				<span>Price: </span>
				<span><b>PhP ".$request->price_clone."</b></span>
				<br>
				<span>Total: </span>
				<span><b>PhP ".$request->total_clone."</b></span>
				<br>
				<span>Deducted: </span>
				<span><b>PhP ".$request->amount_clone."</b></span>
				<br>
				<span>Remarks: </span>
				<span><b>".$request->remarks_clone."</b></span>
				<br>

		        </div>";

		self::generate_pdf($pdf,'purchases');
    }

    public function sales(Request $request){

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
				<span><b>".$request->commodity_clone."</b></span>
				<br>
				<span>Company: </span>
				<span><b>".$request->company_clone."</b></span>
				<br>
				<span>Kilos: </span>
				<span><b>".$request->kilos_clone."</b></span>
				<br>
				<span>Amount: </span>
				<span><b>PhP ".$request->amount_clone."</b></span>
				<br>

		        </div>";

		self::generate_pdf($pdf,'sales');
    }
}
