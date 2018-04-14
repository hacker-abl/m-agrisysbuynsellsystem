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
<div class="modal fade" id="od_modal" tabindex="-1" role="dialog">
						<div class="modal-dialog" role="document">

												<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
								<div class="card">
										<div class="header">
												<h2 class="modal_title">
													 Add User
												</h2>
										</div>
										<div class="body">
												<form class="form-horizontal " id="od_form">
														<input type="hidden" name="id" id="id" value="">
														<input type="hidden" name="button_action" id="button_action" value="">
														<div class="row clearfix">
																<div class="col-lg-2 col-md-2 col-sm-4 col-xs-5 form-control-label">
																		<label for="name">Outbound Ticket</label>
																</div>
																<div class="col-lg-10 col-md-10 col-sm-8 col-xs-7">
																		<div class="form-group">
																				<div class="form-line">
																						<input type="text" id="ticket" name="ticket" readonly="readonly" value="" class="form-control"   required>
																				</div>
																		</div>
																</div>
														</div>

														<div class="row clearfix">
																<div class="col-lg-2 col-md-2 col-sm-4 col-xs-5 form-control-label">
																		<label for="type">Commodity</label>
																</div>
																<div class="col-lg-10 col-md-10 col-sm-8 col-xs-7">
																		<div class="form-group">
																						<select type="text" id="commodity" name="commodity" class="form-control" placeholder="Select item" required style="width:100%;">
																							@foreach($commodity as $a)
																							<option value="{{ $a->id }}">{{ $a->name }} Price: {{ $a->price }}({{ $a->suki_price }})</option>
																							@endforeach
																						</select>
																		</div>
																</div>
														</div>

														<div class="row clearfix">
																<div class="col-lg-2 col-md-2 col-sm-4 col-xs-5 form-control-label">
																		<label for="name">Destination</label>
																</div>
																<div class="col-lg-10 col-md-10 col-sm-8 col-xs-7">
																		<div class="form-group">
																				<div class="form-line">
																						<input type="text" id="destination" name="destination" class="form-control"   required>
																				</div>
																		</div>
																</div>
														</div>

														<div class="row clearfix">
																<div class="col-lg-2 col-md-2 col-sm-4 col-xs-5 form-control-label">
																		<label for="type">Driver</label>
																</div>
																<div class="col-lg-10 col-md-10 col-sm-8 col-xs-7">
																		<div class="form-group">
																						<select type="text" id="driver_id" name="driver_id" class="form-control" placeholder="Select driver" required style="width:100%;">
																							@foreach($driver as $a)
																							<option value="{{ $a->emp_id }}">{{ $a->lname }}, {{ $a->fname }} {{ $a->mname }}</option>
																							@endforeach
																						</select>
																		</div>
																</div>
														</div>

														<div class="row clearfix">
																<div class="col-lg-2 col-md-2 col-sm-4 col-xs-5 form-control-label">
																		<label for="type">Company</label>
																</div>
																<div class="col-lg-10 col-md-10 col-sm-8 col-xs-7">
																		<div class="form-group">
																						<select type="text" id="company" name="company" class="form-control" placeholder="Select company" required style="width:100%;">
																							@foreach($company as $a)
																							<option value="{{ $a->id }}">{{ $a->name }}</option>
																							@endforeach
																						</select>
																		</div>
																</div>
														</div>

														<div class="row clearfix">
																<div class="col-lg-2 col-md-2 col-sm-4 col-xs-5 form-control-label">
																		<label for="name">Plate #</label>
																</div>
																<div class="col-lg-10 col-md-10 col-sm-8 col-xs-7">
																		<div class="form-group">
																						<select type="text" id="plateno" name="plateno" class="form-control" placeholder="Select truck" required style="width:100%;">
																							@foreach($trucks as $a)
																							<option value="{{ $a->id }}">{{ $a->name }} ({{ $a->plate_no }})</option>
																							@endforeach
																						</select>
																		</div>
																</div>
														</div>
														<div class="row clearfix">
																<div class="col-lg-2 col-md-2 col-sm-4 col-xs-5 form-control-label">
																		<label for="name">No. of Liters</label>
																</div>
																<div class="col-lg-10 col-md-10 col-sm-8 col-xs-7">
																		<div class="form-group">
																				<div class="form-line">
																						<input type="number" id="liter" name="liter" class="form-control"   required>
																				</div>
																		</div>
																</div>
														</div>

														<div class="row clearfix">
							 <div class="modal-footer">
												<button type="submit" id="add_delivery" class="btn btn-link waves-effect">SAVE CHANGES</button>
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
														List of users as of {{ date('Y-m-d ') }}
												</h2>
												<ul class="header-dropdown m-r--5">
														<li class="dropdown">
																 <button type="button" class="btn bg-grey btn-xs waves-effect m-r-20 open_od_modal"><i class="material-icons">library_add</i></button>
														</li>
												</ul>
										</div>
										<div class="body">
												<div class="table-responsive">
														<table id="deliverytable" class="table table-bordered table-striped table-hover  ">
																<thead>
																		<tr>
																				<th>Ticket No</th>
																				<th>Commodity</th>
																				<th>Destination</th>
																				<th>Company</th>
																				<th>Driver</th>

																				<th>Plate No.</th>
																				<th>Liters</th>
																				<th width="50">Action</th>
																		</tr>
																</thead>
														</table>
												</div>
										</div>
								</div>
						</div>
				</div>
@endsection
