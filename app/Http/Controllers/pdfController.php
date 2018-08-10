<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
// reference the Dompdf namespace
use Dompdf\Dompdf;
use Picqer\Barcode\BarcodeGeneratorHTML;
use Mike42\Escpos\PrintConnectors\WindowsPrintConnector;
use Mike42\Escpos\Printer;

class pdfController extends Controller
{

	function generate_pdf($pdf, $name){

		// instantiate and use the dompdf class
		$dompdf = new Dompdf();
		$dompdf->loadHtml($pdf);

		if($name == "trips"){
			// (Optional) Setup the paper size and orientation
			$customPaper = array(0,0,204,280);
			$dompdf->set_paper($customPaper);
		}else if($name == "expense"){
			// (Optional) Setup the paper size and orientation
			$customPaper = array(0,0,204,200);
			$dompdf->set_paper($customPaper);
		}else if($name == "ca"){
			// (Optional) Setup the paper size and orientation
			$customPaper = array(0,0,204,200);
			$dompdf->set_paper($customPaper);
		}else if($name == "od"){
			// (Optional) Setup the paper size and orientation
			$customPaper = array(0,0,204,280);
			$dompdf->set_paper($customPaper);
		}else if($name == "dtr"){
			// (Optional) Setup the paper size and orientation
			$customPaper = array(0,0,204,220);
			$dompdf->set_paper($customPaper);
		}else if($name == "sales"){
			// (Optional) Setup the paper size and orientation
			$customPaper = array(0,0,204,200);
			$dompdf->set_paper($customPaper);
		}else if($name == "purchases"){
			// (Optional) Setup the paper size and orientation
			$customPaper = array(0,0,204,350);
			$dompdf->set_paper($customPaper);
		}else if($name == "balance_payment"){
			// (Optional) Setup the paper size and orientation
			$customPaper = array(0,0,204,200);
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

    	$generator = new BarcodeGeneratorHTML();

	    $pdf = "<html>
		<head>
		<title>Trips PDF</title>
		<style>
		@page { margin-top: 20px; margin-bottom: 0px; margin-left: 10px; margin-right: 10px; }
		body {
			font-family: sans-serif;
		    font-style: normal;
		    font-size: 12px;
		}
		</style>
		</head>
		<body>
		<basefont size='4'>
		<h3 align='center'>M-AGRI - TRIPS</h3>
		<br>";
		$pdf .= "<div>
				<table style='width:100%'>
				<tr>
				<td width='40%'><span>Trip Ticket: </span></td>
				<td width='60%' align='right'><span><b>".$request->ticket_clone."</b></span></td>
				</tr>
				<tr>
				<td><span>Expense: </span></td>
				<td align='right'><span><b><span style='font-family: DejaVu Sans; sans-serif;'>&#8369;</span> ".number_format($request->expense_clone, 2, '.', ',')."</b></span></td>
				</tr>
				<tr>
				<td><span>Commodity: </span></td>
				<td align='right'><span><b>".$request->commodity_clone."</b></span></td>
				</tr>
				<tr>
				<td><span>Driver: </span></td>
				<td align='right'><span><b>".$request->driver_id_clone."</b></span></td>
				</tr>
				<tr>
				<td><span>Plate #: </span></td>
				<td align='right'><span><b>".$request->plateno_clone."</b></span></td>
				</tr>
				<tr>
				<td><span>Destination: </span></td>
				<td align='right'><span><b>".$request->destination_clone."</b></span></td>
				</tr>
				<tr>
				<td><span># of Liters: </span></td>
				<td align='right'><span><b>".$request->num_liters_clone."</b></span></td>
				</tr>
				</table>
				<br>
				<br>
				<div style='margin:0 auto; width:160px;'>
				".$generator->getBarcode($request->ticket_clone, $generator::TYPE_CODE_39, 1)."
				</div>
		         </div>";

		self::generate_pdf($pdf,'trips');
    }

    public function expenses(Request $request){

    	$generator = new BarcodeGeneratorHTML();

	    $pdf = "<html>
		<head>
		<title>Expense PDF</title>
		<style>
		@page { margin-top: 20px; margin-bottom: 0px; margin-left: 10px; margin-right: 10px; }
		body {
			font-family: sans-serif;
		    font-style: normal;
		    font-size: 12px;
		}
		</style>
		</head>
		<body>
		<basefont size='4'>
		<h3 align='center'>M-AGRI - EXPENSE</h3>
		<br>";
		$pdf .= "<div>
				<table style='width:100%'>
				<tr>
				<td width='40%'><span>Name: </span></td>
				<td width='60%' align='right'><span><b>".$request->expense_clone."</b></span></td>
				</tr>
				<tr>
				<td><span>Type: </span></td>
				<td align='right'><span><b>".$request->type_clone."</b></span></td>
				</tr>
				<tr>
				<td><span>Amount: </span></td>
				<td align='right'><span><b><span style='font-family: DejaVu Sans; sans-serif;'>&#8369;</span> ".number_format($request->amount_clone, 2, '.', ',')."</b></span></td>
				</tr>
				</table>

		        </div>";

		self::generate_pdf($pdf,'expense');
    }

    public function dtr(Request $request){

    	$generator = new BarcodeGeneratorHTML();

	    $pdf = "<html>
		<head>
		<title>DTR PDF</title>
		<style>
		@page { margin-top: 20px; margin-bottom: 0px; margin-left: 10px; margin-right: 10px; }
		body {
			font-family: sans-serif;
		    font-style: normal;
		    font-size: 12px;
		}
		</style>
		</head>
		<body>
		<basefont size='4'>
		<h3 align='center'>M-AGRI - DAILY TIME RECORD</h3>
		<br>";
		$pdf .= "<div>
				<table style='width:100%'>
				<tr>
				<td width='40%'><span>Name: </span></td>
				<td width='60%' align='right'><span><b>".$request->employee_id_clone."</b></span></td>
				</tr>
				<tr>
				<td><span>Role: </span></td>
				<td align='right'><span><b>".$request->role_clone."</b></span></td>
				</tr>
				<tr>
				<td><span>Overtime: </span></td>
				<td align='right'><span><b>".$request->overtime_clone."</b></span></td>
				</tr>
				<tr>
				<td><span>Rate: </span></td>
				<td align='right'><span><b><span style='font-family: DejaVu Sans; sans-serif;'>&#8369;</span> ".number_format($request->rate_clone, 2, '.', ',')."</b></span></td>
				</tr>
				<tr>
				<td><span># of hours: </span></td>
				<td align='right'><span><b>".$request->num_hours_clone."</b></span></td>
				</tr>
				<tr>
				<td><span>Salary: </span></td>
				<td align='right'><span><b><span style='font-family: DejaVu Sans; sans-serif;'>&#8369;</span> ".number_format($request->salary_clone, 2, '.', ',')."</b></span></td>
				</tr>
				</table>

		        </div>";

		self::generate_pdf($pdf,'dtr');
    }

    public function od(Request $request){

    	$generator = new BarcodeGeneratorHTML();

	    $pdf = "<html>
		<head>
		<title>Outbound Deliveries PDF</title>
		<style>
		@page { margin-top: 20px; margin-bottom: 0px; margin-left: 10px; margin-right: 10px; }
		body {
			font-family: sans-serif;
		    font-style: normal;
		    font-size: 12px;
		}
		</style>
		</head>
		<body>
		<basefont size='4'>
		<h3 align='center'>M-AGRI - OUTBOUND DELIVERIES</h3>
		<br>";
		$pdf .= "<div>
				<table style='width:100%'>
				<tr>
				<td width='40%'><span>Outbound ticket: </span></td>
				<td width='60%' align='right'><span><b>".$request->ticket_clone."</b></span></td>
				</tr>
				<tr>
				<td><span>Commodity: </span></td>
				<td align='right'><span><b>".$request->commodity_clone."</b></span></td>
				</tr>
				<tr>
				<td><span>Destination: </span></td>
				<td align='right'><span><b>".$request->destination_clone."</b></span></td>
				</tr>
				<tr>
				<td><span>Driver: </span></td>
				<td align='right'><span><b>".$request->driver_id_clone."</b></span></td>
				</tr>
				<tr>
				<td><span>Company: </span></td>
				<td align='right'><span><b>".$request->company_clone."</b></span></td>
				</tr>
				<tr>
				<td><span>Plate #: </span></td>
				<td align='right'><span><b>".$request->plateno_clone."</b></span></td>
				</tr>
				<tr>
				<td><span># of liters: </span></td>
				<td align='right'><span><b>".$request->liter_clone."</b></span></td>
				</tr>
				</table>
				<br>
				<br>
				<div style='margin:0 auto; width:160px;'>
				".$generator->getBarcode($request->ticket_clone, $generator::TYPE_CODE_39, 1)."
				</div>

		        </div>";

		self::generate_pdf($pdf,'od');
    }

    public function ca(Request $request){

    	$generator = new BarcodeGeneratorHTML();

	    $pdf = "<html>
		<head>
		<title>Cash Advance PDF</title>
		<style>
		@page { margin-top: 20px; margin-bottom: 0px; margin-left: 10px; margin-right: 10px; }
		body {
			font-family: sans-serif;
		    font-style: normal;
		    font-size: 12px;
		}
		</style>
		</head>
		<body>
		<basefont size='4'>
		<h3 align='center'>M-AGRI - CASH ADVANCE</h3>
		<br>";
		$pdf .= "<div>
				<table style='width:100%'>
				<tr>
				<td width='40%'><span>Name: </span></td>
				<td width='60%' align='right'><span><b>".$request->customer_id_clone."</b></span></td>
				</tr>
				<tr>
				<td><span>Reason: </span></td>
				<td align='right'><span><b>".$request->reason_clone."</b></span></td>
				</tr>
				<tr>
				<td><span>Amount: </span></td>
				<td align='right'><span><b><span style='font-family: DejaVu Sans; sans-serif;'>&#8369;</span> ".number_format($request->amount_clone, 2, '.', ',')."</b></span></td>
				</tr>
				<tr>
				<td><span>Balance: </span></td>
				<td align='right'><span><b><span style='font-family: DejaVu Sans; sans-serif;'>&#8369;</span> ".number_format($request->balance_clone, 2, '.', ',')."</b></span></td>
				</tr>
				</table>
		        </div>";

		self::generate_pdf($pdf,'ca');
    }

    public function purchases(Request $request){

    	$generator = new BarcodeGeneratorHTML();

    	$generator = new BarcodeGeneratorHTML();

	    $pdf = "<html>
		<head>
		<title>Purchases PDF</title>
		<style>
		@page { margin-top: 20px; margin-bottom: 0px; margin-left: 10px; margin-right: 10px; }
		body {
			font-family: sans-serif;
		    font-style: normal;
		    font-size: 12px;
		}
		</style>
		</head>
		<body>
		<basefont size='4'>
		<h3 align='center'>M-AGRI - PURCHASE</h3>
		<br>";
		$pdf .= "<div>
				<table style='width:100%'>
				<tr>
				<td width='40%'><span>Transaction No.: </span></td>
				<td width='60%' align='right'><span><b>".$request->ticket_clone."</b></span></td>
				</tr>
				<tr>
				<td><span>Customer: </span></td>
				<td align='right'><span><b>".$request->customer_clone."</b></span></td>
				</tr>
				<tr>
				<td><span>Commodity: </span></td>
				<td align='right'><span><b>".$request->commodity_clone."</b></span></td>
				</tr>
				<tr>
				<td><span>Sacks: </span></td>
				<td align='right'><span><b>".$request->sacks_clone."</b></span></td>
				</tr>
				<tr>
				<td><span>Cash Advance: </span></td>
				<td align='right'><span><b><span style='font-family: DejaVu Sans; sans-serif;'>&#8369;</span> ".number_format($request->ca_clone, 2, '.', ',')."</b></span></td>
				</tr>
				<tr>
				<td><span>Balance: </span></td>
				<td align='right'><span><b><span style='font-family: DejaVu Sans; sans-serif;'>&#8369;</span> ".number_format($request->balance_clone, 2, '.', ',')."</b></span></td>
				</tr>
				<tr>
				<td><span>Partial payment: </span></td>
				<td align='right'><span><b><span style='font-family: DejaVu Sans; sans-serif;'>&#8369;</span> ".number_format($request->partial_clone, 2, '.', ',')."</b></span></td>
				</tr>
				<tr>
				<td><span>No. of kilos: </span></td>
				<td align='right'><span><b>".$request->kilos_clone."</b></span></td>
				</tr>
				<tr>
				<td><span>Price: </span></td>
				<td align='right'><span><b><span style='font-family: DejaVu Sans; sans-serif;'>&#8369;</span> ".number_format($request->price_clone, 2, '.', ',')."</b></span></td>
				</tr>
				<tr>
				<td><span>Total: </span></td>
				<td align='right'><span><b><span style='font-family: DejaVu Sans; sans-serif;'>&#8369;</span> ".number_format($request->total_clone, 2, '.', ',')."</b></span></td>
				</tr>
				<tr>
				<td><span>Deducted: </span></td>
				<td align='right'><span><b><span style='font-family: DejaVu Sans; sans-serif;'>&#8369;</span> ".number_format($request->amount_clone, 2, '.', ',')."</b></span></td>
				</tr>
				<tr>
				<td><span>Remarks: </span></td>
				<td align='right'><span><b>".$request->remarks_clone."</b></span></td>
				</tr>
				</table>
				<br>
				
				<div style='margin:0 auto; width:160px;'>
				".$generator->getBarcode($request->ticket_clone, $generator::TYPE_CODE_39, 1)."
				</div>
		        </div>";

		self::generate_pdf($pdf,'purchases');
    }

    public function sales(Request $request){

    	$generator = new BarcodeGeneratorHTML();

	    $pdf = "<html>
		<head>
		<title>Sales PDF</title>
		<style>
		@page { margin-top: 20px; margin-bottom: 0px; margin-left: 10px; margin-right: 10px; }
		body {
			font-family: sans-serif;
		    font-style: normal;
		    font-size: 12px;
		}
		</style>
		</head>
		<body>
		<basefont size='4'>
		<h3 align='center'>M-AGRI - SALES</h3>
		<br>";
		$pdf .= "<div>
				<table style='width:100%'>
				<tr>
				<td width='40%'><span>Commodity: </span></td>
				<td width='60%' align='right'><span><b>".$request->commodity_clone."</b></span></td>
				</tr>
				<tr>
				<td><span>Company: </span></td>
				<td align='right'><span><b>".$request->company_clone."</b></span></td>
				</tr>
				<tr>
				<td><span>Kilos: </span></td>
				<td align='right'><span><b>".$request->kilos_clone."</b></span></td>
				</tr>
				<tr>
				<td><span>Amount: </span></td>
				<td align='right'><span><b><span style='font-family: DejaVu Sans; sans-serif;'>&#8369;</span> ".number_format($request->amount_clone, 2, '.', ',')."</b></span></td>
				</tr>
				</table>

		        </div>";

		self::generate_pdf($pdf,'sales');
    }

    public function balance_payment(Request $request){

    	$generator = new BarcodeGeneratorHTML();

	    $pdf = "<html>
		<head>
		<title>Cash Advance PDF</title>
		<style>
		@page { margin-top: 20px; margin-bottom: 0px; margin-left: 10px; margin-right: 10px; }
		body {
			font-family: sans-serif;
		    font-style: normal;
		    font-size: 12px;
		}
		</style>
		</head>
		<body>
		<basefont size='4'>
		<h3 align='center'>M-AGRI - BALANCE PAYMENT</h3>
		<br>";
		$pdf .= "<div>
				<table style='width:100%'>
				<tr>
				<td width='40%'><span>Name: </span></td>
				<td width='60%' align='right'><span><b>".$request->customer_id1_clone."</b></span></td>
				</tr>";

		if($request->paymentmethod_clone == "Check"){
			$pdf .= "
				<tr>
				<td width='40%'><span>Check #: </span></td>
				<td width='60%' align='right'><span><b>".$request->checknumber_clone."</b></span></td>
				</tr>";
		}
		$pdf .= "
				<tr>
				<td><span>Amount: </span></td>
				<td align='right'><span><b><span style='font-family: DejaVu Sans; sans-serif;'>&#8369;</span> ".number_format($request->amount1_clone, 2, '.', ',')."</b></span></td>
				</tr>
				<tr>
				<td><span>Balance: </span></td>
				<td align='right'><span><b><span style='font-family: DejaVu Sans; sans-serif;'>&#8369;</span> ".number_format($request->balance2_clone, 2, '.', ',')."</b></span></td>
				</tr>
				</table>
		        </div>";

		self::generate_pdf($pdf,'balance_payment');
	}
}
