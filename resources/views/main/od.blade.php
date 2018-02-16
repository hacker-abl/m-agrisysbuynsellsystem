@extends('layouts.admin')
		@section('sidenav')
				    <div class="menu">
     <ul class="list">
                    <li class="header">MAIN NAVIGATION</li>
                    <li >
                        <a href="{{ route('home') }}">
                            <i class="material-icons">home</i>
                            <span>Home</span>
                        </a>
                    </li>
                    <li >
                        <a href="{{ route('expense') }}">
                            <i class="material-icons">show_chart</i>
                            <span>Expenses</span>
                        </a>
                    </li> 
					<li >
                        <a href="{{ route('trips') }}">
                            <i class="material-icons">directions_bus</i>
                            <span>Trips</span>
                        </a>
                    </li>
					<li >
                        <a href="{{ route('dtr') }}">
                            <i class="material-icons">access_time</i>
                            <span>Daily Time Record</span>
                        </a>
                    </li>
					<li class="active">
                        <a href="{{ route('od') }}">
                            <i class="material-icons">arrow_upward</i>
                            <span>Outbound Deliveries</span>
                        </a>
                    </li>
					<li>
                        <a href="{{ route('ca') }}">
                            <i class="material-icons">monetization_on</i>
                            <span>Cash Advance</span>
                        </a>
                    </li>
					<li >
                        <a href="{{ route('purchases') }}">
                            <i class="material-icons">bookmark_border</i>
                            <span>Purchases</span>
                        </a>
                    </li>
					<li >
                        <a href="{{ route('sales') }}">
                            <i class="material-icons">shopping_cart</i>
                            <span>Purchases</span>
                        </a>
                    </li>
                  
  
                </ul>
				</div>
@endsection

@section('content')
    <div class="container-fluid">
           <div class="block-header">
                  <h2>
                    Outbound Deliveries Dashboard
                </h2>
            </div>

        </div>
		<div class="modal fade" id="defaultModal" tabindex="-1" role="dialog">
                <div class="modal-dialog" role="document">
                 
                            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <div class="card">
                        <div class="header">
                            <h2>
                               Add expense
                            </h2>
                             <ul class="header-dropdown m-r--5">
                                <li class="dropdown">
                                     <button type="button" class="btn bg-grey btn-xs waves-effect m-r-20" ><i class="material-icons">print</i></button>
                                </li>
                            </ul>
                        </div>
                        <div class="body">
                            <form class="form-horizontal " id="form_validation" method="POST">
                                <div class="row clearfix">
                                    <div class="col-lg-2 col-md-2 col-sm-4 col-xs-5 form-control-label">
                                        <label for="Expense">Expense</label>
                                    </div>
                                    <div class="col-lg-10 col-md-10 col-sm-8 col-xs-7">
                                        <div class="form-group">
                                            <div class="form-line">
                                                <input type="text" id="Expense" name="Expense"class="form-control" placeholder="Enter your expense description"  required>
                                            </div>
                                        </div>
                                    </div>
                                </div>
								<div class="row clearfix">
                                    <div class="col-lg-2 col-md-2 col-sm-4 col-xs-5 form-control-label">
                                        <label for="type">Type</label>
                                    </div>
                                    <div class="col-lg-10 col-md-10 col-sm-8 col-xs-7">
                                        <div class="form-group">
                                            <div class="form-line">
                                                <input type="text" id="type" name="type" class="form-control" placeholder="Enter type of expense"  required>
                                            </div>
                                        </div>
                                    </div>
                                </div>
								
								<div class="row clearfix">
                                    <div class="col-lg-2 col-md-2 col-sm-4 col-xs-5 form-control-label">
                                        <label for="amount">Amount</label>
                                    </div>
                                    <div class="col-lg-10 col-md-10 col-sm-8 col-xs-7">
                                        <div class="form-group">
                                            <div class="form-line">
                                                <input type="text" id="amount" name="amount" class="form-control" placeholder="Enter amount"  required>
                                            </div>
                                        </div>
                                    </div>
                                </div>
								
                                <div class="row clearfix">
									 <div class="modal-footer">
                            <button type="submit" class="btn btn-link waves-effect">SAVE CHANGES</button>
                            <button type="button" class="btn btn-link waves-effect" data-dismiss="modal">CLOSE</button>
                        </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
         
                        
                       
                   
                </div>
            </div>
  <div class="row clearfix">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <div class="card">
                        <div class="header">
                            <h2>
                                List of Outbound Deliveries as of {{ date('Y-m-d ') }}
                            </h2>
                            <ul class="header-dropdown m-r--5">
                                <li class="dropdown">
                                     <button type="button" class="btn bg-grey btn-xs waves-effect m-r-20" data-toggle="modal" data-target="#defaultModal"><i class="material-icons">library_add</i></button>
                                </li>
                            </ul>
                        </div>
                        <div class="body">
                            <div class="table-responsive">
                                <table id ="expensetable" class="table table-bordered table-striped table-hover  ">
                                    <thead>
                                        <tr>
                                            <th>Name</th>
                                            <th>Position</th>
                                            <th>Office</th>
                                            <th>Age</th>
                                            <th>Start date</th>
                                            <th>Salary</th>
                                        </tr>
                                    </thead>

                                    <tbody>
                                        <tr>
                                            <td>Tiger Nixon</td>
                                            <td>System Architect</td>
                                            <td>Edinburgh</td>
                                            <td>61</td>
                                            <td>2011/04/25</td>
                                            <td>$320,800</td>
                                        </tr>
                                        <tr>
                                            <td>Garrett Winters</td>
                                            <td>Accountant</td>
                                            <td>Tokyo</td>
                                            <td>63</td>
                                            <td>2011/07/25</td>
                                            <td>$170,750</td>
                                        </tr>
                                        <tr>
                                            <td>Ashton Cox</td>
                                            <td>Junior Technical Author</td>
                                            <td>San Francisco</td>
                                            <td>66</td>
                                            <td>2009/01/12</td>
                                            <td>$86,000</td>
                                        </tr>
                                        <tr>
                                            <td>Ashton Cox</td>
                                            <td>Junior Technical Author</td>
                                            <td>San Francisco</td>
                                            <td>66</td>
                                            <td>2009/01/12</td>
                                            <td>$86,000</td>
                                        </tr>
                                        <tr>
                                            <td>Ashton Cox</td>
                                            <td>Junior Technical Author</td>
                                            <td>San Francisco</td>
                                            <td>66</td>
                                            <td>2009/01/12</td>
                                            <td>$86,000</td>
                                        </tr>
                                        <tr>
                                            <td>Ashton Cox</td>
                                            <td>Junior Technical Author</td>
                                            <td>San Francisco</td>
                                            <td>66</td>
                                            <td>2009/01/12</td>
                                            <td>$86,000</td>
                                        </tr>
                                        <tr>
                                            <td>Ashton Cox</td>
                                            <td>Junior Technical Author</td>
                                            <td>San Francisco</td>
                                            <td>66</td>
                                            <td>2009/01/12</td>
                                            <td>$86,000</td>
                                        </tr>
                                        <tr>
                                            <td>Ashton Cox</td>
                                            <td>Junior Technical Author</td>
                                            <td>San Francisco</td>
                                            <td>66</td>
                                            <td>2009/01/12</td>
                                            <td>$86,000</td>
                                        </tr>
                                        <tr>
                                            <td>Ashton Cox</td>
                                            <td>Junior Technical Author</td>
                                            <td>San Francisco</td>
                                            <td>66</td>
                                            <td>2009/01/12</td>
                                            <td>$86,000</td>
                                        </tr>
                                        
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- #END# Exportable Table -->
        
@endsection
