<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
// reference the Dompdf namespace
use Dompdf\Dompdf;
use Picqer\Barcode\BarcodeGeneratorPNG;
use Mike42\Escpos\PrintConnectors\WindowsPrintConnector;
use Mike42\Escpos\Printer;
use Carbon\Carbon;

class pdfController extends Controller
{
	function getLength($var){
		$tmp = explode('.', $var);
		if(count($tmp)>1){
			return strlen($tmp[1]);
		}
	}

	function generate_pdf($pdf, $name){

		// instantiate and use the dompdf class
		$dompdf = new Dompdf();
		$dompdf->loadHtml($pdf);

		if($name == "trips"){
			// (Optional) Setup the paper size and orientation
			$customPaper = array(0,0,240,330);
			$dompdf->set_paper($customPaper);
		}else if($name == "expense"){
			// (Optional) Setup the paper size and orientation
			$customPaper = array(0,0,240,300);
			$dompdf->set_paper($customPaper);
		}else if($name == "ca"){
			// (Optional) Setup the paper size and orientation
			$customPaper = array(0,0,240,200);
			$dompdf->set_paper($customPaper);
		}else if($name == "od"){
			// (Optional) Setup the paper size and orientation
			$customPaper = array(0,0,240,350);
			$dompdf->set_paper($customPaper);
		}else if($name == "dtr"){
			// (Optional) Setup the paper size and orientation
			$customPaper = array(0,0,240,220);
			$dompdf->set_paper($customPaper);
		}else if($name == "sales"){
			// (Optional) Setup the paper size and orientation
			$customPaper = array(0,0,240,350);
			$dompdf->set_paper($customPaper);
		}else if($name == "purchases"){
			// (Optional) Setup the paper size and orientation
			$customPaper = array(0,0,240,475);
			$dompdf->set_paper($customPaper);
		}else if($name == "balance_payment"){
			// (Optional) Setup the paper size and orientation
			$customPaper = array(0,0,240,200);
			$dompdf->set_paper($customPaper);
		}
		

		// Render the HTML as PDF
		$dompdf->render();

		// Output the generated PDF to Browser
		$dompdf->stream($name, array("Attachment" => false));

		// $connector = new WindowsPrintConnector("COM1");
	 //    $printer = new Printer($connector);
	 //    try {
	 //      $printer->text("WAWEX\n");
	 //      $printer->text("-----------------------\n");
	 //      $printer->text("YOW YOW\n");
	 //      $printer->cut();
	 //    } finally {
	 //      $printer -> close();
	 //    }
	}

    public function trips(Request $request){

    	$generator = new BarcodeGeneratorPNG();

	    $pdf = "<html>
		<head>
		<title>Trips PDF</title>
		<style>
		@page { margin-top: 20px; margin-bottom: 0px; margin-left: 10px; margin-right: 10px; }
		body {
			font-family: DejaVu Sans Mono, Times, serif;
		    font-style: normal;
		    font-size: 13px;
		}

		td, th {
			border: 1px solid black;
		}

		table {
			border-collapse: collapse;
		}
		</style>
		</head>
		<body>
		<basefont size='4'>
		<h2 align='center'>TRIPS</h2>
		<p align='center'><b>P-1B Sto. Niño Carmen<br>
		Davao del Norte</b> <br> ".Carbon::now()->toDayDateTimeString()."</p>
		";
		$pdf .= "<div>
				<table style='width:100%'>
				<tr>
				<td width='50%'><span>Trip Ticket: </span></td>
				<td width='50%' align='right'><span>".$request->ticket_clone."</span></td>
				</tr>
				<tr>
				<td><span>Expense: </span></td>
				<td align='right'><span>₱ ".number_format($request->expense_clone, 2, '.', ',')."</span></td>
				</tr>
				<tr>
				<td><span>Commodity: </span></td>
				<td align='right'><span>".$request->commodity_clone."</span></td>
				</tr>
				<tr>
				<td><span>Driver: </span></td>
				<td align='right'><span>".$request->driver_id_clone."</span></td>
				</tr>
				<tr>
				<td><span>Plate No.: </span></td>
				<td align='right'><span>".$request->plateno_clone."</span></td>
				</tr>
				<tr>
				<td><span>Destination: </span></td>
				<td align='right'><span>".$request->destination_clone."</span></td>
				</tr>
				<tr>
				<td><span>No. of Liters: </span></td>
				<td align='right'><span>".$request->num_liters_clone."</span></td>
				</tr>
				</table>
				<br>
				<br>
				
				<img style='width:100%;' src='data:image/png;base64,".base64_encode($generator->getBarcode($request->ticket_clone, $generator::TYPE_CODE_39, 1, 35))."'>

				</div>";

		self::generate_pdf($pdf,'trips');
    }

    public function expenses(Request $request){

    	$generator = new BarcodeGeneratorPNG();

	    $pdf = "<html>
		<head>
		<title>Expense PDF</title>
		<style>
		@page { margin-top: 20px; margin-bottom: 0px; margin-left: 10px; margin-right: 10px; }
		body {
			font-family: DejaVu Sans Mono, Times, serif;
		    font-style: normal;
		    font-size: 13px;
		}

		td, th {
			border: 1px solid black;
		}

		table {
			border-collapse: collapse;
		}
		</style>
		</head>
		<body>
		<basefont size='4'>
		<h2 align='center'>EXPENSE</h2>
		<p align='center'><b>P-1B Sto. Niño Carmen<br>
		Davao del Norte</b> <br> ".Carbon::now()->toDayDateTimeString()."</p>
		";
		$pdf .= "<div>
				<table style='width:100%'>
				<tr>
				<td width='40%'><span>Transaction No.: </span></td>
				<td width='60%' align='right'><span>".$request->trans_clone."</span></td>
				</tr>
				<tr>
				<td width='40%'><span>Name: </span></td>
				<td width='60%' align='right'><span>".$request->expense_clone."</span></td>
				</tr>
				<tr>
				<td><span>Type: </span></td>
				<td align='right'><span>".$request->type_clone."</span></td>
				</tr>
				<tr>
				<td><span>Amount: </span></td>
				<td align='right'><span>₱ ".number_format($request->amount_clone, 2, '.', ',')."</span></td>
				</tr>
				</table>

				<br>
				<br>
				
				<img style='width:100%;' src='data:image/png;base64,".base64_encode($generator->getBarcode($request->trans_clone, $generator::TYPE_CODE_39, 1, 35))."'>

		        </div>";

		self::generate_pdf($pdf,'expense');
    }

    public function dtr(Request $request){

    	$generator = new BarcodeGeneratorPNG();

	    $pdf = "<html>
		<head>
		<title>DTR PDF</title>
		<style>
		@page { margin-top: 20px; margin-bottom: 0px; margin-left: 10px; margin-right: 10px; }
		body {
			font-family: DejaVu Sans Mono, Times, serif;
		    font-style: normal;
		    font-size: 13px;
		}

		td, th {
			border: 1px solid black;
		}

		table {
			border-collapse: collapse;
		}
		</style>
		</head>
		<body>
		<basefont size='4'>
		<h2 align='center'>DAILY TIME RECORD</h2>
		<p align='center'><b>P-1B Sto. Niño Carmen<br>
		Davao del Norte</b> <br> ".Carbon::now()->toDayDateTimeString()."</p>
		";
		$pdf .= "<div>
				<table style='width:100%'>
				<tr>
				<td width='40%'><span>Name: </span></td>
				<td width='60%' align='right'><span>".$request->employee_id_clone."</span></td>
				</tr>
				<tr>
				<td><span>Role: </span></td>
				<td align='right'><span>".$request->role_clone."</span></td>
				</tr>
				<tr>
				<td><span>Overtime: </span></td>
				<td align='right'><span>".$request->overtime_clone."</span></td>
				</tr>
				<tr>
				<td><span>Rate: </span></td>
				<td align='right'><span>₱ ".number_format($request->rate_clone, 2, '.', ',')."</span></td>
				</tr>
				<tr>
				<td><span>No. of hours: </span></td>
				<td align='right'><span>".$request->num_hours_clone."</span></td>
				</tr>
				<tr>
				<td><span>Salary: </span></td>
				<td align='right'><span>₱ ".number_format($request->salary_clone, 2, '.', ',')."</span></td>
				</tr>
				</table>

		        </div>";

		self::generate_pdf($pdf,'dtr');
    }

    public function od(Request $request){

    	$generator = new BarcodeGeneratorPNG();

	    $pdf = "<html>
		<head>
		<title>Outbound Deliveries PDF</title>
		<style>
		@page { margin-top: 20px; margin-bottom: 0px; margin-left: 10px; margin-right: 10px; }
		body {
			font-family: DejaVu Sans Mono, Times, serif;
		    font-style: normal;
		    font-size: 13px;
		}

		td, th {
			border: 1px solid black;
		}

		table {
			border-collapse: collapse;
		}
		</style>
		</head>
		<body>
		<basefont size='4'>
		<h2 align='center'>OUTBOUND DELIVERIES</h2>
		<p align='center'><b>P-1B Sto. Niño Carmen<br>
		Davao del Norte</b> <br> ".Carbon::now()->toDayDateTimeString()."</p>
		";
		$pdf .= "<div>
				<table style='width:100%'>
				<tr>
				<td width='45%'><span>Outbound ticket: </span></td>
				<td width='55%' align='right'><span>".$request->ticket_clone."</span></td>
				</tr>
				<tr>
				<td><span>Commodity: </span></td>
				<td align='right'><span>".$request->commodity_clone."</span></td>
				</tr>
				<tr>
				<td><span>Destination: </span></td>
				<td align='right'><span>".$request->destination_clone."</span></td>
				</tr>
				<tr>
				<td><span>Driver: </span></td>
				<td align='right'><span>".$request->driver_id_clone."</span></td>
				</tr>
				<tr>
				<td><span>Company: </span></td>
				<td align='right'><span>".$request->company_clone."</span></td>
				</tr>
				<tr>
				<td><span>Plate No.: </span></td>
				<td align='right'><span>".$request->plateno_clone."</span></td>
				</tr>
				<tr>
				<td><span>No. of liters: </span></td>
				<td align='right'><span>".$request->liter_clone."</span></td>
				</tr>
				<tr>
				<td><span>No. of kilos: </span></td>
				<td align='right'><span>".$request->kilos_clone."</span></td>
				</tr>
				<tr>
				<td><span>Allowance: </span></td>
				<td align='right'><span>₱ ".number_format($request->allowance_clone, 2, '.', ',')."</span></td>
				</tr>
				</table>
				<br>
				<br>
				
				<img style='width:100%;' src='data:image/png;base64,".base64_encode($generator->getBarcode($request->ticket_clone, $generator::TYPE_CODE_39, 1, 35))."'>

		        </div>";

		self::generate_pdf($pdf,'od');
    }

    public function ca(Request $request){

    	$generator = new BarcodeGeneratorPNG();

	    $pdf = "<html>
		<head>
		<title>Cash Advance PDF</title>
		<style>
		@page { margin-top: 20px; margin-bottom: 0px; margin-left: 10px; margin-right: 10px; }
		body {
			font-family: DejaVu Sans Mono, Times, serif;
		    font-style: normal;
		    font-size: 13px;
		}

		td, th {
			border: 1px solid black;
		}

		table {
			border-collapse: collapse;
		}
		</style>
		</head>
		<body>
		<basefont size='4'>
		<h2 align='center'>CASH ADVANCE</h2>
		<p align='center'><b>P-1B Sto. Niño Carmen<br>
		Davao del Norte</b> <br> ".Carbon::now()->toDayDateTimeString()."</p>
		";
		$pdf .= "<div>
				<table style='width:100%'>
				<tr>
				<td width='40%'><span>Name: </span></td>
				<td width='60%' align='right'><span>".$request->customer_id_clone."</span></td>
				</tr>
				<tr>
				<td><span>Reason: </span></td>
				<td align='right'><span>".$request->reason_clone."</span></td>
				</tr>
				<tr>
				<td><span>Amount: </span></td>
				<td align='right'><span>₱ ".number_format($request->amount_clone, 2, '.', ',')."</span></td>
				</tr>
				<tr>
				<td><span>Balance: </span></td>
				<td align='right'><span>₱ ".number_format($request->balance_clone, 2, '.', ',')."</span></td>
				</tr>
				</table>
		        </div>";

		self::generate_pdf($pdf,'ca');
    }

    public function purchases(Request $request){

    	$generator = new BarcodeGeneratorPNG();

	    $pdf = "<html>
		<head>
		<title>Purchases PDF</title>
		<style>
		@page { margin-top: 20px; margin-bottom: 0px; margin-left: 10px; margin-right: 10px; }
		body {
			font-family: DejaVu Sans Mono, Times, serif;
		    font-style: normal;
		    font-size: 13px;
		}

		td, th {
			border: 1px solid black;
		}

		table {
			border-collapse: collapse;
		}
		</style>
		</head>
		<body>
		<basefont size='4'>
		<h2 align='center'>PURCHASE</h2>
		<p align='center'><b>P-1B Sto. Niño Carmen<br>
		Davao del Norte</b> <br> ".Carbon::now()->toDayDateTimeString()."</p>
		";
		$pdf .= "<div>
				<table style='width:100%;'>
				<tr>
				<td width='50%'><span>Transaction No.: </span></td>
				<td width='50%' align='right'><span>".$request->ticket_clone."</span></td>
				</tr>
				<tr>
				<td><span>Customer: </span></td>
				<td align='right'><span>".$request->customer_clone."</span></td>
				</tr>
				<tr>
				<td><span>Commodity: </span></td>
				<td align='right'><span>".$request->commodity_clone."</span></td>
				</tr>
				<tr>
				<td><span>Wet/Dry: </span></td>
				<td align='right'><span>".$request->type_clone."</span></td>
				</tr>
				<tr>
				<td><span>Sacks: </span></td>
				<td align='right'><span>".$request->sacks_clone."</span></td>
				</tr>
				<tr>
				<td><span>No. of kilos: </span></td>
				<td align='right'><span>".number_format($request->kilos_clone, $this->getLength($request->kilos_clone), '.', ',')." kg</span></td>
				</tr>
				<tr>
				<td><span>Tare: </span></td>
				<td align='right'><span>".number_format($request->tare_clone, $this->getLength($request->tare_clone), '.', ',')." kg</span></td>
				</tr>
				<tr>
				<td><span>Moist: </span></td>
				<td align='right'><span>".$request->moist_clone." %</span></td>
				</tr>
				<tr>
				<td><span>Net KG: </span></td>
				<td align='right'><span>".number_format($request->net_clone, $this->getLength($request->net_clone), '.', ',')." kg</span></td>
				</tr>
				<tr>
				<td><span>Price: </span></td>
				<td align='right'><span>₱ ".number_format($request->price_clone, 2, '.', ',')."</span></td>
				</tr>
				<tr>
				<td><span>Cash Advance: </span></td>
				<td align='right'><span>₱ ".number_format($request->ca_clone, 2, '.', ',')."</span></td>
				</tr>
				<tr>
				<td><span>Balance: </span></td>
				<td align='right'><span>₱ ".number_format($request->balance_clone, 2, '.', ',')."</span></td>
				</tr>
				<tr>
				<td><span>Partial payment: </span></td>
				<td align='right'><span>₱ ".number_format($request->partial_clone, 2, '.', ',')."</span></td>
				</tr>
				<tr>
				<td><span>Total: </span></td>
				<td align='right'><span>₱ ".number_format($request->total_clone, 2, '.', ',')."</span></td>
				</tr>
				<tr>
				<td><span>Deducted: </span></td>
				<td align='right'><span>₱ ".number_format($request->amount_clone, 2, '.', ',')."</span></td>
				</tr>
				<tr>
				<td><span>Remarks: </span></td>
				<td align='right'><span>".$request->remarks_clone."</span></td>
				</tr>
				</table>
				<br><br>

				<img style='width:100%;' src='data:image/png;base64,".base64_encode($generator->getBarcode($request->ticket_clone, $generator::TYPE_CODE_39, 1, 35))."'>

		        </div>";

		self::generate_pdf($pdf,'purchases');
    }

    public function sales(Request $request){

    	$generator = new BarcodeGeneratorPNG();

	    $pdf = "<html>
		<head>
		<title>Sales PDF</title>
		<style>
		@page { margin-top: 20px; margin-bottom: 0px; margin-left: 10px; margin-right: 10px; }
		body {
			font-family: DejaVu Sans Mono, Times, serif;
		    font-style: normal;
		    font-size: 13px;
		}

		td, th {
			border: 1px solid black;
		}

		table {
			border-collapse: collapse;
		}
		</style>
		</head>
		<body>
		<basefont size='4'>
		<h2 align='center'>SALES</h2>
		<p align='center'><b>P-1B Sto. Niño Carmen<br>
		Davao del Norte</b> <br> ".Carbon::now()->toDayDateTimeString()."</p>
		";
		$pdf .= "<div>
				<table style='width:100%'>
				<tr>
				<td width='40%'><span>Transaction No.: </span></td>
				<td width='60%' align='right'><span>".$request->transaction_clone."</span></td>
				</tr>
				<tr>
				<td><span>Company: </span></td>
				<td align='right'><span>".$request->company_clone."</span></td>
				</tr>
				<tr>
				<td><span>Commodity: </span></td>
				<td align='right'><span>".$request->commodity_clone."</span></td>
				</tr>
				<tr>
				<td><span>Price: </span></td>
				<td align='right'><span>₱ ".number_format($request->price_clone, 2, '.', ',')."</span></td>
				</tr>
				<tr>
				<td><span>Kilos: </span></td>
				<td align='right'><span>".number_format($request->kilos_clone, $this->getLength($request->kilos_clone), '.', ',')."</span></td>
				</tr>";

				if($request->payment_method_clone == "Check"){
					$pdf .= "
						<tr>
						<td width='40%'><span>Check No.: </span></td>
						<td width='60%' align='right'><span>".$request->check_number_clone."</span></td>
						</tr>";
				}

		$pdf .= "<tr>
				<td><span>Amount: </span></td>
				<td align='right'><span>₱ ".number_format($request->amount_clone, 2, '.', ',')."</span></td>
				</tr>
				</table>
				
				<br><br>

				<img style='width:100%;' src='data:image/png;base64,".base64_encode($generator->getBarcode($request->transaction_clone, $generator::TYPE_CODE_39, 1, 35))."'>


		        </div>";

		self::generate_pdf($pdf,'sales');
    }

    public function balance_payment(Request $request){

    	$generator = new BarcodeGeneratorPNG();

	    $pdf = "<html>
		<head>
		<title>Balance Payment PDF</title>
		<style>
		@page { margin-top: 20px; margin-bottom: 0px; margin-left: 10px; margin-right: 10px; }
		body {
			font-family: DejaVu Sans Mono, Times, serif;
		    font-style: normal;
		    font-size: 13px;
		}

		td, th {
			border: 1px solid black;
		}

		table {
			border-collapse: collapse;
		}
		</style>
		</head>
		<body>
		<basefont size='4'>
		<h2 align='center'>BALANCE PAYMENT</h2>
		<p align='center'><b>P-1B Sto. Niño Carmen<br>
		Davao del Norte</b> <br> ".Carbon::now()->toDayDateTimeString()."</p>
		";
		$pdf .= "<div>
				<table style='width:100%'>
				<tr>
				<td width='40%'><span>Name: </span></td>
				<td width='60%' align='right'><span>".$request->customer_id1_clone."</span></td>
				</tr>";

		if($request->paymentmethod_clone == "Check"){
			$pdf .= "
				<tr>
				<td width='40%'><span>Check No.: </span></td>
				<td width='60%' align='right'><span>".$request->checknumber_clone."</span></td>
				</tr>";
		}
		$pdf .= "
				<tr>
				<td><span>Amount: </span></td>
				<td align='right'><span>₱ ".number_format($request->amount1_clone, 2, '.', ',')."</span></td>
				</tr>
				<tr>
				<td><span>Balance: </span></td>
				<td align='right'><span>₱ ".number_format($request->balance2_clone, 2, '.', ',')."</span></td>
				</tr>
				</table>
		        </div>";

		self::generate_pdf($pdf,'balance_payment');
	}
}
