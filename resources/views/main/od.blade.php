@extends(isAdmin() ? 'layouts.admin' : 'layouts.user')

@section('content')
  <!-- OD MODAL -- START --> 
	<div class="modal fade" id="od_modal" tabindex="-1" role="dialog">
		<div class="modal-dialog" role="document">
			<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
				<div class="card">
					<div class="header">
						<h2 class="modal_title">Add Delivery</h2>
						<ul class="header-dropdown m-r--5">
              <li class="dropdown">
                  <button id="print_od" type="button" class="btn btn-sm btn-icon print-icon" ><i class="glyphicon glyphicon-print"></i></button>
              </li>
              <li class="dropdown">
              </li>
            </ul>
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
											<input type="text" id="ticket" name="ticket" readonly="readonly" value="" class="form-control" required>
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
										<select type="text" id="commodity" name="commodity" class="form-control" placeholder="Select Commodity" required style="width:100%;">
											@foreach($commodity as $a)
											<option value="{{ $a->id }}">{{ $a->name }}</option>
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
								<div class="col-lg-2 col-md-2 col-sm-4 col-xs-5 form-control-label">
									<label for="name">No. of Kilos</label>
								</div>
								<div class="col-lg-10 col-md-10 col-sm-8 col-xs-7">
									<div class="form-group">
										<div class="form-line">
											<input type="number" id="kilos" name="kilos" class="form-control"   required>
										</div>
									</div>
								</div>
							</div>

							<div class="row clearfix">
								<div class="col-lg-2 col-md-2 col-sm-4 col-xs-5 form-control-label">
									<label for="name">Allowance</label>
								</div>
								<div class="col-lg-10 col-md-10 col-sm-8 col-xs-7">
									<div class="form-group">
										<div class="form-line">
											<input type="number" id="allowance" name="allowance" class="form-control"   required>
										</div>
									</div>
								</div>
							</div>

						</form>
						<div class="row clearfix">
							<div class="modal-footer">
								<div>
									<form method="POST" id="printForm" name="printForm" target="_blank" action="{{ route('print_od') }}">
										<input type="hidden" id="ticket_clone" name="ticket_clone">
										<input type="hidden" id="commodity_clone" name="commodity_clone">
										<input type="hidden" id="destination_clone" name="destination_clone">
										<input type="hidden" id="driver_id_clone" name="driver_id_clone">
										<input type="hidden" id="company_clone" name="company_clone">
										<input type="hidden" id="plateno_clone" name="plateno_clone">
										<input type="hidden" id="liter_clone" name="liter_clone">
										<input type="hidden" id="kilos_clone" name="kilos_clone">
										<input type="hidden" id="allowance_clone" name="allowance_clone">
										<button class="btn btn-sm btn-icon print-icon print-only" type="submit" name="print_form" id="print_form" title="PRINT ONLY">PRINT ONLY</button> 
									</form>
								</div>
								<button type="submit" id="add_delivery" class="btn btn-link waves-effect">SAVE CHANGES</button>
								<button type="button" class="btn btn-link waves-effect" data-dismiss="modal">CLOSE</button>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
  <!-- OD MODAL -- END --> 

  <!-- COPRA MODALS -- START -->
  <div class="modal fade" id="copra_modal" tabindex="-1" role="dialog">
      <div class="modal-dialog modal-lg" role="document">
          <div class="row">
              <div class="card">
                  <div class="header">
                      <h2> Copra Delivery & Breakdown - <span class="ticket_title"></span></h2>
                      <div class="header-dropdown m-r-5">
                        <button type="button" class="btn bg-grey btn-xs waves-effect m-r-20 float-right add_copra_delivery"><i class="material-icons">library_add</i></button>
                        <button type="button" class="btn bg-grey btn-xs waves-effect m-r-20 float-right edit_copra_delivery"><i class="material-icons">mode_edit</i></button>
                      </div>
                  </div>
                  <div class="body">
                    <table id="view_copra_modal_delivery" class="table table-bordered table-striped table-hover"
                        style="width: 100%;">
                        <thead>
                            <tr>
                                <th>W.R. No.</th>
                                <th>Net Weight</th>
                                <th>Dust</th>
                                <th>Moisture</th>
                                <th>Resicada Weight</th>
                            </tr>
                        </thead>
                    </table>

                    <div>
                      <span style="font-size: 24px;">Breakdown</span>
                      <button type="button" class="btn bg-grey btn-xs waves-effect m-r-20 pull-right add_breakdown"><i class="material-icons">library_add</i></button>
                    </div>

                    <table id="view_copra_breakdown" class="table table-bordered table-striped table-hover"
                        style="width: 100%;">
                        <thead>
                          <tr>
                            <th>Resicada Weight</th>
                            <th>Price</th>
                            <th>Amount</th>
                            <th>Action</th>
                          </tr>
                        </thead>
                        <tfoot>
                          <tr>
                            <th></th>
                            <th></th>
                            <th></th>
                            <th></th>
                          </tr>
                        </tfoot>
                    </table>
                  </div>
                  <div class="modal-footer">
                    <button type="button" class="btn btn-link waves-effect" data-dismiss="modal">CLOSE</button>
                  </div>
              </div>
          </div>
      </div>
  </div>

  <div class="modal fade" id="copra_add_edit_modal" tabIndex="-1" role="dialog">
    <div class="modal-dialog" role="document">
      <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
        <div class="card">
          <div class="header">
            <h2 class="modal_title">COPRA DELIVERY - <span class="ticket_title"></span></h2>
          </div>
          <form class="form-horizontal" id="copra_form">
            @csrf

            <div class="body">
              <input type="hidden" id="copra_id" name="copra_id">
              <input type="hidden" id="copra_add_edit" name="copra_add_edit">

              <div class="row clearfix">
                <div class="col-lg-3 col-md-3 col-sm-4 col-xs-5 form-control-label">
                  <label for="cop_wr">W.R. No.</label>
                </div>
                <div class="col-lg-9 col-md-9 col-sm-8 col-xs-7">
                  <div class="form-group">
                    <div class="form-line">
                      <input type="text" id="cop_wr" name="cop_wr" class="form-control" required>
                    </div>
                  </div>
                </div>
              </div>
              
              <div class="row clearfix">
                <div class="col-lg-3 col-md-3 col-sm-4 col-xs-5 form-control-label">
                  <label for="cop_nw">Net Weight</label>
                </div>
                <div class="col-lg-9 col-md-9 col-sm-8 col-xs-7">
                  <div class="form-group">
                    <div class="form-line">
                      <input type="number" step=".01" id="cop_nw" name="cop_nw" class="form-control" required>
                    </div>
                  </div>
                </div>
              </div>
              
              <div class="row clearfix">
                <div class="col-lg-3 col-md-3 col-sm-4 col-xs-5 form-control-label">
                  <label for="cop_dust">Dust %</label>
                </div>
                <div class="col-lg-4 col-md-4 col-sm-8 col-xs-7">
                  <div class="form-group">
                    <div class="form-line">
                      <input type="number" step=".01" id="cop_dust" name="cop_dust" class="form-control">
                    </div>
                  </div>
                </div>
                <div class="col-lg-5 col-md-5 col-sm-8 col-xs-7">
                  <div class="form-group">
                    <div class="form-line">
                      <input type="number" step=".01" id="cop_dust_w" name="cop_dust_w" class="form-control" placeholder="dust (kg)" readonly>
                    </div>
                  </div>
                </div>
              </div>
              
              <div class="row clearfix">
                <div class="col-lg-3 col-md-3 col-sm-4 col-xs-5 form-control-label">
                  <label for="cop_moist">Moisture %</label>
                </div>
                <div class="col-lg-4 col-md-4 col-sm-8 col-xs-7">
                  <div class="form-group">
                    <div class="form-line">
                      <input type="number" step=".01" id="cop_moist" name="cop_moist" class="form-control">
                    </div>
                  </div>
                </div>
                <div class="col-lg-5 col-md-5 col-sm-8 col-xs-7">
                  <div class="form-group">
                    <div class="form-line">
                      <input type="number" step=".01" id="cop_moist_w" name="cop_moist_w" class="form-control" placeholder="moist (kg)" readonly>
                    </div>
                  </div>
                </div>
              </div>
              
              <div class="row clearfix">
                <div class="col-lg-3 col-md-3 col-sm-4 col-xs-5 form-control-label">
                  <label for="cop_rw">Resicada Weight</label>
                </div>
                <div class="col-lg-9 col-md-9 col-sm-8 col-xs-7">
                  <div class="form-group">
                    <div class="form-line">
                      <input type="number" step=".01" id="cop_rw" name="cop_rw" class="form-control" required readonly>
                    </div>
                  </div>
                </div>
              </div>

            </div>
            <div class="modal-footer">
              <button type="submit" id="add_copra" class="btn btn-link waves-effect">SAVE CHANGES</button>
              <button type="button" class="btn btn-link waves-effect" data-dismiss="modal">CLOSE</button>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>

  <div class="modal fade" id="copra_add_edit_breakdown_modal" tabIndex="-1" role="dialog">
    <div class="modal-dialog" role="document">
      <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
        <div class="card">
          <div class="header">
            <h2 class="modal_title">COPRA BREAKDOWN - <span class="wr_title"></span></h2>
          </div>
          <form class="form-horizontal" id="copra_breakdown_form">
            @csrf

            <div class="body">
              <input type="hidden" id="copra_breakdown_id" name="copra_breakdown_id">
              <input type="hidden" id="copra_delivery_id" name="copra_delivery_id">
              <input type="hidden" id="copra_breakdown_add_edit" name="copra_breakdown_add_edit">

              <div class="row clearfix">
                <div class="col-lg-3 col-md-3 col-sm-4 col-xs-5 form-control-label">
                  <label for="cop_rw">Resicada Weight</label>
                </div>
                <div class="col-lg-9 col-md-9 col-sm-8 col-xs-7">
                  <div class="form-group">
                    <div class="form-line">
                      <input type="number" step=".01" id="cop_bd_rw" name="cop_bd_rw" class="form-control" required>
                    </div>
                  </div>
                </div>
              </div>
              
              <div class="row clearfix">
                <div class="col-lg-3 col-md-3 col-sm-4 col-xs-5 form-control-label">
                  <label for="cop_nw">Price</label>
                </div>
                <div class="col-lg-9 col-md-9 col-sm-8 col-xs-7">
                  <div class="form-group">
                    <div class="form-line">
                      <input type="number" step=".01" id="cop_bd_price" name="cop_bd_price" class="form-control" required>
                    </div>
                  </div>
                </div>
              </div>
              
              <div class="row clearfix">
                <div class="col-lg-3 col-md-3 col-sm-4 col-xs-5 form-control-label">
                  <label for="cop_nw">Amount</label>
                </div>
                <div class="col-lg-9 col-md-9 col-sm-8 col-xs-7">
                  <div class="form-group">
                    <div class="form-line">
                      <input type="number" step=".01" id="cop_bd_amount" name="cop_bd_amount" class="form-control" required readonly>
                    </div>
                  </div>
                </div>
              </div>

              <div class="row clearfix">
                <div class="col-lg-3 col-md-3 col-sm-4 col-xs-5 form-control-label">
                  <label for="cop_rw">Unpriced Weight</label>
                </div>
                <div class="col-lg-9 col-md-9 col-sm-8 col-xs-7">
                  <div class="form-group">
                    <div class="form-line">
                      <input type="hidden" step=".01" id="bd_unpriced_weight_hidden" class="form-control" required readonly>
                      <input type="number" step=".01" id="bd_unpriced_weight" name="bd_unpriced_weight" class="form-control" required readonly>
                    </div>
                  </div>
                </div>
              </div>

            </div>
            <div class="modal-footer">
              <button type="submit" id="add_copra_breakdown" class="btn btn-link waves-effect">SAVE CHANGES</button>
              <button type="button" class="btn btn-link waves-effect" data-dismiss="modal">CLOSE</button>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>
  <!-- COPRA MODALS -- END -->

  <!-- COCONUT MODALS -- START -->
  <div class="modal fade" id="coconut_modal" tabindex="-1" role="dialog">
    <div class="modal-dialog modal-lg" role="document" style="width: 1300px;">
      <div class="row">
        <div class="card">
          <div class="header">
            <h2> Coconut Delivery & Nuts Reject - <span class="ticket_title"></span></h2>
            <div class="header-dropdown m-r-5">
              <button type="button" class="btn bg-grey btn-xs waves-effect m-r-20 float-right add_coconut_delivery"><i class="material-icons">library_add</i></button>
              <button type="button" class="btn bg-grey btn-xs waves-effect m-r-20 float-right edit_coconut_delivery"><i class="material-icons">mode_edit</i></button>
            </div>
          </div>
          <div class="body">
            <input type="hidden" id="coconut_od_id" value="">

            <table id="view_coconut_modal_delivery" class="table table-bordered table-striped table-hover"
                style="width: 100%;">
                <thead>
                  <tr>
                    <th>W.R. #</th>
                    <th>Gross</th>
                    <th>Moisture</th>
                    <th>Net Weight</th>
                    <th>Price</th>
                    <th>Total Amount</th>
                    <th>Withholding Tax</th>
                    <th>Unloading Fee</th>
                    <th>Total Amount Due</th>
                  </tr>
                </thead>
            </table>

            <div>
              <span style="font-size: 24px;">Nuts Reject</span>
            </div>

            <div>
              <span>Nuts Reject (KG): <span id="nuts_reject"></span></span>
              <br>
              <span>Copra (KG): <span id="nuts_copra"></span></span>
            </div>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-link waves-effect" data-dismiss="modal">CLOSE</button>
          </div>
        </div>
      </div>
    </div>
  </div>

  <div class="modal fade" id="coconut_add_edit_modal" tabIndex="-1" role="dialog">
    <div class="modal-dialog" role="document">
      <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
        <div class="card">
          <div class="header">
            <h2 class="modal_title">COCONUT DELIVERY - <span class="ticket_title"></span></h2>
          </div>
          <form class="form-horizontal" id="coconut_form">
            @csrf

            <div class="body">
              <input type="hidden" id="coconut_id" name="coconut_id">
              <input type="hidden" id="coconut_add_edit" name="coconut_add_edit">

              <div class="row clearfix">
                <div class="col-lg-3 col-md-3 col-sm-4 col-xs-5 form-control-label">
                  <label for="coco_weight">Coconut Weight</label>
                </div>
                <div class="col-lg-9 col-md-9 col-sm-8 col-xs-7">
                  <div class="form-group">
                    <div class="form-line">
                      <input type="text" id="coco_weight" name="coco_weight" class="form-control" required readonly>
                    </div>
                  </div>
                </div>
              </div>

              <div class="row clearfix">
                <div class="col-lg-3 col-md-3 col-sm-4 col-xs-5 form-control-label">
                  <label for="coco_wr">W.R. No.</label>
                </div>
                <div class="col-lg-9 col-md-9 col-sm-8 col-xs-7">
                  <div class="form-group">
                    <div class="form-line">
                      <input type="text" id="coco_wr" name="coco_wr" class="form-control" required>
                    </div>
                  </div>
                </div>
              </div>
              
              <div class="row clearfix">
                <div class="col-lg-3 col-md-3 col-sm-4 col-xs-5 form-control-label">
                  <label for="coco_gw">Gross Weight</label>
                </div>
                <div class="col-lg-9 col-md-9 col-sm-8 col-xs-7">
                  <div class="form-group">
                    <div class="form-line">
                      <input type="number" step=".01" id="coco_gw" name="coco_gw" class="form-control" required>
                    </div>
                  </div>
                </div>
              </div>
              
              <div class="row clearfix">
                <div class="col-lg-3 col-md-3 col-sm-4 col-xs-5 form-control-label">
                  <label for="coco_moist">Moisture %</label>
                </div>
                <div class="col-lg-4 col-md-4 col-sm-8 col-xs-7">
                  <div class="form-group">
                    <div class="form-line">
                      <input type="number" step=".01" id="coco_moist" name="coco_moist" class="form-control">
                    </div>
                  </div>
                </div>
                <div class="col-lg-5 col-md-5 col-sm-8 col-xs-7">
                  <div class="form-group">
                    <div class="form-line">
                      <input type="number" step=".01" id="coco_moist_w" name="coco_moist_w" class="form-control" placeholder="moist (kg)" readonly>
                    </div>
                  </div>
                </div>
              </div>
              
              <div class="row clearfix">
                <div class="col-lg-3 col-md-3 col-sm-4 col-xs-5 form-control-label">
                  <label for="coco_nw">Net Weight</label>
                </div>
                <div class="col-lg-9 col-md-9 col-sm-8 col-xs-7">
                  <div class="form-group">
                    <div class="form-line">
                      <input type="number" step=".01" id="coco_nw" name="coco_nw" class="form-control" required readonly>
                    </div>
                  </div>
                </div>
              </div>
              
              <div class="row clearfix">
                <div class="col-lg-3 col-md-3 col-sm-4 col-xs-5 form-control-label">
                  <label for="coco_price">Price</label>
                </div>
                <div class="col-lg-9 col-md-9 col-sm-8 col-xs-7">
                  <div class="form-group">
                    <div class="form-line">
                      <input type="number" step=".01" id="coco_price" name="coco_price" class="form-control" required>
                    </div>
                  </div>
                </div>
              </div>
              
              <div class="row clearfix">
                <div class="col-lg-3 col-md-3 col-sm-4 col-xs-5 form-control-label">
                  <label for="coco_amount">Total Amount</label>
                </div>
                <div class="col-lg-9 col-md-9 col-sm-8 col-xs-7">
                  <div class="form-group">
                    <div class="form-line">
                      <input type="number" step=".01" id="coco_amount" name="coco_amount" class="form-control" required readonly>
                    </div>
                  </div>
                </div>
              </div>
              
              <div class="row clearfix">
                <div class="col-lg-3 col-md-3 col-sm-4 col-xs-5 form-control-label">
                  <label for="coco_tax">Withholding Tax</label>
                </div>
                <div class="col-lg-9 col-md-9 col-sm-8 col-xs-7">
                  <div class="form-group">
                    <div class="form-line">
                      <input type="number" step=".01" id="coco_tax" name="coco_tax" class="form-control" required>
                    </div>
                  </div>
                </div>
              </div>
              
              <div class="row clearfix">
                <div class="col-lg-3 col-md-3 col-sm-4 col-xs-5 form-control-label">
                  <label for="coco_tax">Unloading Fee</label>
                </div>
                <div class="col-lg-9 col-md-9 col-sm-8 col-xs-7">
                  <div class="form-group">
                    <div class="form-line">
                      <input type="number" step=".01" id="coco_unloading" name="coco_unloading" class="form-control" required>
                    </div>
                  </div>
                </div>
              </div>
              
              <div class="row clearfix">
                <div class="col-lg-3 col-md-3 col-sm-4 col-xs-5 form-control-label">
                  <label for="coco_total_amount">Total Amount Due</label>
                </div>
                <div class="col-lg-9 col-md-9 col-sm-8 col-xs-7">
                  <div class="form-group">
                    <div class="form-line">
                      <input type="number" step=".01" id="coco_total_amount" name="coco_total_amount" class="form-control" required readonly>
                    </div>
                  </div>
                </div>
              </div>

              <br><br>
              
              <div class="row clearfix">
                <div class="col-lg-3 col-md-3 col-sm-4 col-xs-5 form-control-label">
                  <label for="coco_nuts_reject">Nuts Reject</label>
                </div>
                <div class="col-lg-9 col-md-9 col-sm-8 col-xs-7">
                  <div class="form-group">
                    <div class="form-line">
                      <input type="number" step=".01" id="coco_nuts_reject" name="coco_nuts_reject" class="form-control" required readonly>
                    </div>
                  </div>
                </div>
              </div>
              <div class="row clearfix">
                <div class="col-lg-3 col-md-3 col-sm-4 col-xs-5 form-control-label">
                  <label for="coco_copra">Copra</label>
                </div>
                <div class="col-lg-9 col-md-9 col-sm-8 col-xs-7">
                  <div class="form-group">
                    <div class="form-line">
                      <input type="number" step=".01" id="coco_copra" name="coco_copra" class="form-control" required readonly>
                    </div>
                  </div>
                </div>
              </div>

            </div>
            <div class="modal-footer">
              <button type="submit" id="add_coconut" class="btn btn-link waves-effect">SAVE CHANGES</button>
              <button type="button" class="btn btn-link waves-effect" data-dismiss="modal">CLOSE</button>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>
  <!-- COCONUT MODALS -- END -->

  <!-- PAYMENT MODALS -- START -->

  <div class="modal fade" id="payment_modal" tabindex="-1" role="dialog">
    <div class="modal-dialog modal-lg" role="document" style="width: 1300px;">
      <div class="row">
        <div class="card">
          <div class="header">
            <h2> Payment - <span class="ticket_title"></span></h2>
            <div class="header-dropdown m-r-5">
              <button type="button" class="btn bg-grey btn-xs waves-effect m-r-20 float-right add_coconut_delivery"><i class="material-icons">library_add</i></button>
              <button type="button" class="btn bg-grey btn-xs waves-effect m-r-20 float-right edit_coconut_delivery"><i class="material-icons">mode_edit</i></button>
            </div>
          </div>
          <div class="body">
            <input type="hidden" id="coconut_od_id" value="">

            <table id="view_coconut_modal_delivery" class="table table-bordered table-striped table-hover"
                style="width: 100%;">
                <thead>
                  <tr>
                    <th>W.R. #</th>
                    <th>Gross</th>
                    <th>Moisture</th>
                    <th>Net Weight</th>
                    <th>Price</th>
                    <th>Total Amount</th>
                    <th>Withholding Tax</th>
                    <th>Unloading Fee</th>
                    <th>Total Amount Due</th>
                  </tr>
                </thead>
            </table>

            <div>
              <span style="font-size: 24px;">Nuts Reject</span>
            </div>

            <div>
              <span>Nuts Reject (KG): <span id="nuts_reject"></span></span>
              <br>
              <span>Copra (KG): <span id="nuts_copra"></span></span>
            </div>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-link waves-effect" data-dismiss="modal">CLOSE</button>
          </div>
        </div>
      </div>
    </div>
  </div>
  
  <div class="modal fade" id="add_edit_payment_modal" tabIndex="-1" role="dialog">
    <div class="modal-dialog" role="document">
      <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
        <div class="card">
          <div class="header">
            <h2 class="modal_title">PAYMENT - <span class="ticket_title"></span></h2>
          </div>
          <form class="form-horizontal" id="copra_form">
            @csrf

            <div class="body">
              <input type="hidden" id="copra_id" name="copra_id">
              <input type="hidden" id="copra_add_edit" name="copra_add_edit">

              <div class="row clearfix">
                <div class="col-lg-3 col-md-3 col-sm-4 col-xs-5 form-control-label">
                  <label for="cop_wr">W.R. No.</label>
                </div>
                <div class="col-lg-9 col-md-9 col-sm-8 col-xs-7">
                  <div class="form-group">
                    <div class="form-line">
                      <input type="text" id="cop_wr" name="cop_wr" class="form-control" required>
                    </div>
                  </div>
                </div>
              </div>
              
              <div class="row clearfix">
                <div class="col-lg-3 col-md-3 col-sm-4 col-xs-5 form-control-label">
                  <label for="cop_nw">Date</label>
                </div>
                <div class="col-lg-9 col-md-9 col-sm-8 col-xs-7">
                  <div class="form-group">
                    <div class="form-line">
                      <input type="date" id="cop_nw" name="cop_nw" class="form-control" required>
                    </div>
                  </div>
                </div>
              </div>
              
              <div class="row clearfix">
                <div class="col-lg-3 col-md-3 col-sm-4 col-xs-5 form-control-label">
                  <label for="cop_rw">Amount</label>
                </div>
                <div class="col-lg-9 col-md-9 col-sm-8 col-xs-7">
                  <div class="form-group">
                    <div class="form-line">
                      <input type="number" step=".01" id="cop_rw" name="cop_rw" class="form-control" required readonly>
                    </div>
                  </div>
                </div>
              </div>

            </div>
            <div class="modal-footer">
              <button type="submit" id="add_copra" class="btn btn-link waves-effect">SAVE CHANGES</button>
              <button type="button" class="btn btn-link waves-effect" data-dismiss="modal">CLOSE</button>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>

  <!-- PAYMENT MODALS -- END -->















  <div class="container-fluid">
     <ul class="nav nav-tabs">
        <li ><a href="#outbound_tab" data-toggle="tab"><div class="block-header">
            <h2>Outbound Dashboard</h2>
        </div></a></li>
        <li class="active"><a href="#copra_tab" data-toggle="tab" id="render"><div class="block-header">
            <h2>Copra Deliveries</h2>
        </div></a></li>
        <li><a href="#coconut_tab" data-toggle="tab" id="render"><div class="block-header">
            <h2>Coconut Deliveries</h2>
        </div></a></li>
      </ul>
  </div> 

  <div class="tab-content">
    <div class="tab-pane fade" id="outbound_tab">
      <div class="row clearfix">
        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
          <div class="card">
            <div class="header">
              <h2>List of Outbound Deliveries as of {{ date('Y-m-d ') }}</h2>
              <ul class="header-dropdown m-r--5">
                <li class="dropdown">
                  @if(isAdmin() || isPurchaser())
                  <button type="button" class="btn bg-grey btn-xs waves-effect m-r-20 open_od_modal"><i class="material-icons">library_add</i></button>
                  @endif
                </li>
              </ul>
            </div>
            <div class="body">
              <div class="table-responsive">
                <p id="date_filter">
                  <h5>Date Range Filter</h5>
                  <span id="date-label-from" class="date-label">From: </span><input class="date_range_filter date" type="text" id="od_datepicker_from" />
                  <span id="date-label-to" class="date-label">To:<input class="date_range_filter date" type="text" id="od_datepicker_to" />
                </p>
                
                <br>

                <table id="deliverytable" class="table table-bordered table-striped table-hover  ">
                  <thead>
                    <tr>
                      <th width="20" style="text-align:center;">Ticket No</th>
                      <th width="100" style="text-align:center;">Commodity</th>
                      <th width="100" style="text-align:center;">Destination</th>
                      <th width="100" style="text-align:center;">Company</th>
                      <th width="100" style="text-align:center;">Driver</th>
                      <th width="100" style="text-align:center;">Plate No.</th>
                      <th width="100" style="text-align:center;">Liters</th>
                      <th width="100" style="text-align:center;">Kilos</th>
                      <th width="100" style="text-align:center;">Allowance</th>
                      <th width="100" style="text-align:center;">Date</th>
                      <th width="100" style="text-align:center;">Release Status</th>
                      <th width="100" style="text-align:center;">Action</th>
                    </tr>
                  </thead>
                  <tfoot>
                    <tr>
                      <th></th>
                      <th></th>
                      <th></th>
                      <th></th>
                      <th></th>
                      <th></th>
                      <th></th>
                      <th></th>
                      <th></th>
                      <th></th>
                      <th></th>
                      <th></th>	
                    </tr>
                  </tfoot>
                </table>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>

    <div class="tab-pane fade in active" id="copra_tab">
      <div class="row clearfix">
        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
          <div class="card">
            <div class="header">
              <h2>List of Copra Deliveries as of {{ date('Y-m-d ') }}</h2>
              <ul class="header-dropdown m-r--5">
                <li class="dropdown">
                  @if(isAdmin() || isPurchaser())
                  <button type="button" class="btn bg-grey btn-xs waves-effect m-r-20 open_od_modal"><i class="material-icons">library_add</i></button>
                  @endif
                </li>
              </ul>
            </div>
            <div class="body">
              <div class="table-responsive">
                <!--<p id="date_filter">
                  <h5>Date Range Filter</h5>
                  <span id="date-label-from" class="date-label">From: </span><input class="date_range_filter date" type="text" id="od_datepicker_from" />
                  <span id="date-label-to" class="date-label">To:<input class="date_range_filter date" type="text" id="od_datepicker_to" />
                </p>-->
                
                <br>

                <table id="copratable" class="table table-bordered table-striped table-hover">
                  <thead>
                    <tr>
                      <th width="20" style="text-align:center;">Ticket No</th>
                      <th width="100" style="text-align:center;">WR</th>
                      <th width="100" style="text-align:center;">Net Weight</th>
                      <th width="100" style="text-align:center;">Amount</th>
                      <th width="100" style="text-align:center;">Paid</th>
                      <th width="100" style="text-align:center;">Balance</th>
                      <th width="100" style="text-align:center;">Action</th>
                    </tr>
                  </thead>
                  <tfoot>
                    <tr>
                      <th></th>
                      <th></th>
                      <th></th>
                      <th></th>
                      <th></th>
                      <th></th>
                      <th></th>	
                    </tr>
                  </tfoot>
                </table>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
@endsection

@section('script')
<script>
var deliveriestable;
var od_date_from;
var od_date_to;
var od_id;

$(document).on("click", "#link", function() {
  $("#bod").toggleClass("overlay-open");
});

$(document).ready(function() {
  
  $(".nav-tabs a").click(function() {
    $(this).tab("show");
  });

  document.title = "M-Agri - Outbound Deliveries";

  $($.fn.dataTable.tables(true)).css("width", "100%");
  $($.fn.dataTable.tables(true))
    .DataTable()
    .columns.adjust()
    .draw();

  $.extend($.fn.dataTable.defaults, {
    language: {
      processing: "Loading.. Please wait"
    }
  });

  //OUTBOUND DELIVERIES datatable starts here
  $("#od_modal").on("hidden.bs.modal", function(e) {
    $(this)
      .find("input,textarea,select")
      .val("")
      .end()
      .find("input[type=checkbox], input[type=radio]")
      .prop("checked", "")
      .end();
  });

  function number_format(number, decimals, dec_point, thousands_sep) {
    // Strip all characters but numerical ones.
    number = (number + "").replace(/[^0-9+\-Ee.]/g, "");
    var n = !isFinite(+number) ? 0 : +number,
      prec = !isFinite(+decimals) ? 0 : Math.abs(decimals),
      sep = typeof thousands_sep == "undefined" ? "," : thousands_sep,
      dec = typeof dec_point == "undefined" ? "." : dec_point,
      s = "",
      toFixedFix = function(n, prec) {
        var k = Math.pow(10, prec);
        return "" + Math.round(n * k) / k;
      };
    // Fix for IE parseFloat(0.55).toFixed(0) = 0;
    s = (prec ? toFixedFix(n, prec) : "" + Math.round(n)).split(".");
    if (s[0].length > 3) {
      s[0] = s[0].replace(/\B(?=(?:\d{3})+(?!\d))/g, sep);
    }
    if ((s[1] || "").length < prec) {
      s[1] = s[1] || "";
      s[1] += new Array(prec - s[1].length + 1).join("0");
    }
    return s.join(dec);
  }

  // Initiate datatable here
  $('#deliverytable').dataTable();
  refresh_delivery_table();

  //START OF DATE RANGE FILTER
  $("#od_datepicker_from")
    .datepicker({
      showOn: "button",
      buttonImage: "assets/images/calendar2.png",
      buttonImageOnly: false,
      onSelect: function(date) {
        minDateFilter = new Date(date).getTime();
        var df = new Date(date);
        od_date_from =
        df.getFullYear() + "-" + (df.getMonth() + 1) + "-" + df.getDate();
        
        refresh_delivery_table();
      }
    })
    .keyup(function() {
      od_datepicker_from = "";
      
      refresh_delivery_table();
    });

  $("#od_datepicker_to")
    .datepicker({
      showOn: "button",
      buttonImage: "assets/images/calendar2.png",
      buttonImageOnly: false,
      onSelect: function(date) {
        maxDateFilter = new Date(date).getTime();
        //oTable.fnDraw();
        var dt = new Date(date);
        od_date_to =
        dt.getFullYear() + "-" + (dt.getMonth() + 1) + "-" + dt.getDate();
        
        refresh_delivery_table();
      }
    })
    .keyup(function() {
      od_date_to = "";

      refresh_delivery_table();
    });
  //END OF DATE RANGE FILTER
  function refresh_delivery_table() {
    $("#deliverytable").dataTable().fnDestroy();
    deliveriestable = $("#deliverytable").DataTable({
      footerCallback: function(row, data, start, end, display) {
        var api = this.api(),
          data;

        // Remove the formatting to get integer data for summation
        var intVal = function(i) {
          return typeof i == "string"
            ? i.replace(/[\₱,]/g, "") * 1
            : typeof i == "number"
            ? i
            : 0;
        };

        // Total over all pages
        total = api
          .column(8)
          .data()
          .reduce(function(a, b) {
            return intVal(a) + intVal(b);
          }, 0);

        // Total over this page
        pageTotal = api
          .column(8, { page: "current" })
          .data()
          .reduce(function(a, b) {
            return intVal(a) + intVal(b);
          }, 0);

        // Update footer
        $(api.column(8).footer()).html(
          "Total: <br>₱" + number_format(pageTotal, 2)
        );

        // Total over this page
        pageTotal1 = api
          .column(7, { page: "current" })
          .data()
          .reduce(function(a, b) {
            return intVal(a) + intVal(b);
          }, 0);

        // Update footer
        $(api.column(7).footer()).html(
          "Total: <br>" + number_format(pageTotal1, 2) + " kg"
        );

        // Total over this page
        pageTotal1 = api
          .column(6, { page: "current" })
          .data()
          .reduce(function(a, b) {
            return intVal(a) + intVal(b);
          }, 0);

        // Update footer
        $(api.column(6).footer()).html(
          "Total: <br>" + number_format(pageTotal1, 2) + " L"
        );
      },
      dom: "Blfrtip",
      lengthMenu: [
        [10, 25, 50, -1],
        [10, 25, 50, "All"]
      ],
      buttons: [
        {
          extend: "print",
          exportOptions: {
            columns: [0, 1, 2, 3, 4, 5, 6, 7, 8, 9],
            modifier: {
              page: "current"
            }
          },
          customize: function(win) {
            $(win.document.body).css("font-size", "10pt");

            $(win.document.body)
              .find("table")
              .addClass("compact")
              .css("font-size", "inherit");
          },
          footer: true
        },
        {
          extend: "pdfHtml5",
          footer: true,
          exportOptions: {
            columns: [0, 1, 2, 3, 4, 5, 6, 7, 8, 9],
            modifier: {
              page: "current"
            }
          },
          customize: function(doc) {
            doc.styles.tableHeader.fontSize = 8;
            doc.styles.tableFooter.fontSize = 8;
            doc.defaultStyle.fontSize = 8;
          }
        }
      ],
      paging: true,
      pageLength: 10,
      order: [],
      ajax: {
        url: "{{ route('refresh_deliveries') }}",
        // dataType: 'text',
        type: "post",
        headers: {
          "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content")
        },
        data: {
          date_from: od_date_from,
          date_to: od_date_to
        }
      },
      processing: true,
      columns: [
        { data: "outboundTicket" },
        { data: "commodity.name" },
        { data: "destination" },
        { data: "company.name" },
        { data: "employee" },
        { data: "trucks.name" },
        { data: "fuel_liters" },
        { data: "kilos" },
        { data: "allowance" },
        { data: "created_at" },
        { data: "od_expense.status" },
        { data: "action", orderable: false, searchable: false }
      ]
    });
  }

  $(document).on("click", ".open_od_modal", function() {
    $(".modal_title").text("Add Delivery");
    $("#button_action").val("add");
    $.ajax({
      url: "{{ route('refresh_id') }}",
      method: "get",
      data: { temp: "temp" },
      dataType: "json",
      success: function(data) {
        var t = 0;
        if (data[0].temp != null) {
          t = data[0].temp;
        }
        $("#driver_id")
          .val("")
          .trigger("change");
        $("#company")
          .val("")
          .trigger("change");
        $("#commodity")
          .val("")
          .trigger("change");
        $("#plateno")
          .val("")
          .trigger("change");
        var a = parseInt(t);
        var b = a + 1;
        var c = new Date();
        var twoDigitMonth =
          c.getMonth().length + 1 == 1
            ? c.getMonth() + 1
            : "0" + (c.getMonth() + 1);
        var currentDate = c.getFullYear() + twoDigitMonth + c.getDate();
        $("#ticket").val(currentDate + b);
        $("#od_modal").modal("show");
      }
    });
  });
  mainMouseDownOne();
  function mainMouseDownOne() {
    $("#add_delivery").one("click", function(event) {
      var input = $(this);
      var button = this;
      button.disabled = true;
      input.html("SAVING...");
      event.preventDefault();
      $.ajax({
        headers: {
          "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content")
        },
        url: "{{ route('add_delivery') }}",
        method: "POST",
        dataType: "text",
        data: $("#od_form").serialize(),
        success: function(data) {
          dataparsed = $.parseJSON(data);
          button.disabled = false;
          input.html("SAVE CHANGES");
          mainMouseDownOne();
          $("#driver_id")
            .val("")
            .trigger("change");
          $("#company")
            .val("")
            .trigger("change");
          $("#commodity")
            .val("")
            .trigger("change");
          if (dataparsed != "Success" && dataparsed != "Add") {
            swal(
              "Cash Reverted!",
              "Cash On Hand: ₱" + dataparsed.cashOnHand.toFixed(2),
              "success"
            );
            $("#curCashOnHand").html(dataparsed.cashOnHand.toFixed(2));
          }
          if (dataparsed == "Add") {
            swal("Success!", "Record has been added", "success");
          }
          if (dataparsed == "Success") {
            swal("Success!", "Record has been updated", "success");
          }
          $("#od_modal").modal("hide");
          refresh_delivery_table();
        },
        error: function(data) {
          mainMouseDownOne();
          button.disabled = false;
          input.html("SAVE CHANGES");
          swal("Oh no!", "Something went wrong, try again.", "error");
        }
      });
    });
  }

  $("#print_od").click(function(event) {
    event.preventDefault();
    $("#add_delivery").trigger("click");
    $("#print_form").trigger("click");
  });

  $("#print_form").click(function(event) {
    $("#ticket_clone").val($("#ticket").val());
    $("#commodity_clone").val($("#commodity option:selected").text());
    $("#destination_clone").val($("#destination").val());
    $("#driver_id_clone").val($("#driver_id option:selected").text());
    $("#company_clone").val($("#company option:selected").text());
    $("#plateno_clone").val($("#plateno option:selected").text());
    $("#liter_clone").val($("#liter").val());
    $("#kilos_clone").val($("#kilos").val());
    $("#allowance_clone").val($("#allowance").val());
  });

  $(document).on("click", ".update_delivery", function() {
    var id = $(this).attr("id");
    $.ajax({
      url: "{{ route('update_delivery') }}",
      method: "get",
      data: { id: id },
      dataType: "json",
      success: function(data) {
        $("#button_action").val("update");
        $("#id").val(id);
        $("#ticket").val(data.outboundTicket);
        $("#destination").val(data.destination);
        $("#driver_id")
          .val(data.driver_id)
          .trigger("change");
        $("#company")
          .val(data.company_id)
          .trigger("change");
        $("#commodity")
          .val(data.commodity_id)
          .trigger("change");
        $("#plateno")
          .val(data.plateno)
          .trigger("change");
        $("#liter").val(data.fuel_liters);
        $("#kilos").val(data.kilos);
        $("#allowance").val(data.allowance);
        $("#od_modal").modal("show");
        $(".modal_title").text("Update Delivery");
        refresh_delivery_table();
      }
    });
  });

  $(document).on("click", ".delete_delivery", function() {
    var id = $(this).attr("id");
    swal({
      title: "Are you sure?",
      text: "Delete this record?",
      icon: "warning",
      buttons: true,
      dangerMode: true
    }).then(willDelete => {
      if (willDelete) {
        $.ajax({
          url: "{{ route('delete_delivery') }}",
          method: "get",
          data: { id: id },
          success: function(data) {
            dataparsed = $.parseJSON(data);
            if (dataparsed != "success") {
              swal(
                "Cash Reverted!",
                "Cash On Hand: ₱" + dataparsed.cashOnHand.toFixed(2),
                "success"
              );
              $("#curCashOnHand").html(dataparsed.cashOnHand.toFixed(2));
            } else {
              swal("Success!", "Record has been Deleted", "success");
            }
            refresh_delivery_table();
          }
        });
      }
    });
  });
  //OUTBOUND DELIVERIES Datatable ends here







  // COPRA DELIVERY -- START

  // Initialize
  $(".add_copra_delivery, .edit_copra_delivery, .add_breakdown").hide();
  $('#copratable').dataTable();
  refresh_copra_table();

  //Table
  function refresh_copra_table() {
    $("#copratable").dataTable().fnDestroy();
    $("#copratable").DataTable({
      autoWidth: false,
      paging: true,
      pageLength: 10,
      ajax: {
        url: "/refresh_copra",
        type: "post",
        headers: {
          "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content")
        },
      },
      processing: true,
      columns: [
        { data: "od.outboundTicket" },
        { data: "wr" },
        { data: "net_weight" },
        { data: "amount" },
        { data: "paid" },
        { data: "balance" },
        { data: "action", orderable: false, searchable: false }
      ]
    });
  }

  $(document).on('hidden.bs.modal', '#copra_add_edit_modal, #copra_add_edit_breakdown_modal', function(){
    $(this).find('input').val('').end();
    copra_modal_data();
    setTimeout(function(){ $("#copra_modal").modal("show"); }, 500);
  });

  $(document).on('click', '.copra_delivery', function(){
    od_id = $(this).attr("id");

    copra_modal_data();
    $("#copra_modal").modal("show");
  });

  function copra_modal_data() {
    $.ajax({
      url: "/copra_modal_data/"+od_id,
      method: "get",
      dataType: "json",
      success: function(data) {
        $('.ticket_title').text(data.ticket);

        $('#copra_id').val(od_id);

        if (data.copra_id) {
          $(".edit_copra_delivery, .add_breakdown").show();
          $(".add_copra_delivery").hide();
        }
        else {
          $(".add_copra_delivery").show();
          $(".edit_copra_delivery").hide();
        }

        refresh_copra_modal_tables();
      }
    });
  }

  function refresh_copra_modal_tables() {
    $("#view_copra_modal_delivery").dataTable().fnDestroy();
    $("#view_copra_modal_delivery").DataTable({
      searching: false,
      paging: false,
      info: false,
      ajax: {
        url: "/refresh_copra_delivery/"+od_id,
        type: "post",
        headers: {
          "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content")
        },
      },
      processing: true,
      columns: [
        { data: "wr" },
        { data: "net_weight" },
        { data: "dust" },
        { data: "moist" },
        { data: "resicada" }
      ]
    });
    
    $("#view_copra_breakdown").dataTable().fnDestroy();
    $("#view_copra_breakdown").DataTable({
      searching: false,
      paging: false,
      info: false,
      ajax: {
        url: "/refresh_copra_breakdown/"+od_id,
        type: "post",
        headers: {
          "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content")
        },
      },
      processing: true,
      columns: [
        { data: "resicada" },
        { data: "price" },
        { data: "amount" },
        { data: "action", orderable: false, searchable: false }
      ],
      footerCallback: function(row, data, start, end, display) {
        var api = this.api(), data;
        // Remove the formatting to get integer data for summation
        var intVal = function(i) {
          return typeof i == "string"
            ? i.replace(/[\₱,]/g, "") * 1
            : typeof i == "number"
            ? i
            : 0;
        };
        for(let x = 0; x < 3; x++){
          total = api
          .column(x)
          .data()
          .reduce(function(a, b) {
            return intVal(a) + intVal(b);
          }, 0);
          
          $(api.column(x).footer()).html(
            number_format(total, 2)
          );
        }
      },
    })
  }

  $(document).on('click', '.add_copra_delivery', function() {
    $('#copra_add_edit').val('add');
    $("#copra_modal").modal("hide");
    setTimeout(function(){ $("#copra_add_edit_modal").modal("show"); }, 500);
  });
  
  $(document).on('click', '.edit_copra_delivery', function(){
    $.ajax({
      url: "/get_copra_delivery/"+od_id,
      method: "get",
      dataType: "json",
      success: function(data){
        $('#copra_add_edit').val('edit');
        $('#cop_wr').val(data.wr);
        $('#cop_nw').val(data.net_weight);
        $('#cop_dust').val(data.dust);
        $('#cop_moist').val(data.moist);
        copra_compute();
        $("#copra_modal").modal("hide");
        setTimeout(function(){ $("#copra_add_edit_modal").modal("show"); }, 500);
      }
    });
  });

  $(document).on('submit', '#copra_form', function(e){
    e.preventDefault();
    $('#add_copra').attr('disabled', true).text('SAVING...');
    $.ajax({
      headers: {
        "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content")
      },
      url: "/save_copra",
      method: 'POST',
      dataType: 'text',
      data: $(this).serialize(),
      success: function(data){
        copra_modal_data();
        $('#add_copra').attr('disabled', false).text('SAVE CHANGES');
        $("#copra_add_edit_modal").modal("hide");
      }
    })
  });

  
  $(document).on('click', '.add_breakdown', function(){
    $.ajax({
      url: "/get_copra_breakdown/"+od_id,
      data: { add_edit: 'add' },
      method: "get",
      dataType: "json",
      success: function(data){
        $('.wr_title').text(data.wr);
        $('#copra_delivery_id').val(data.copra_delivery_id);
        $('#copra_breakdown_add_edit').val('add');
        $('#bd_unpriced_weight, #bd_unpriced_weight_hidden').val(data.unpriced);
        $("#copra_modal").modal("hide");
        setTimeout(function(){ $("#copra_add_edit_breakdown_modal").modal("show"); }, 500);
      }
    });
  })

  $(document).on('click', '.update_breakdown', function(){
    let breakdown_id = $(this).attr('id');

    $.ajax({
      url: "/get_copra_breakdown/"+breakdown_id,
      data: { add_edit: 'update' },
      method: "get",
      dataType: "json",
      success: function(data){
        $('#copra_breakdown_add_edit').val('edit');
        $('.wr_title').text(data.wr);
        $('#copra_breakdown_id').val(data.id);
        $('#copra_delivery_id').val(data.copra_id);
        $('#cop_bd_rw').val(data.resicada);
        $('#cop_bd_price').val(data.price);
        $('#cop_bd_amount').val(data.amount);
        $('#bd_unpriced_weight, #bd_unpriced_weight_hidden').val(data.unpriced);
        copra_breakdown_compute();
        $("#copra_modal").modal("hide");
        setTimeout(function(){ $("#copra_add_edit_breakdown_modal").modal("show"); }, 500);
      }
    })
  })

  $(document).on('submit', '#copra_breakdown_form', function(e){
    e.preventDefault();
    $('#add_copra_breakdown').attr('disabled', true).text('SAVING...');
    $.ajax({
      headers: {
        "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content")
      },
      url: "/save_copra_breakdown",
      method: 'POST',
      dataType: 'text',
      data: $(this).serialize(),
      success: function(data){
        $('#add_copra_breakdown').attr('disabled', false).text('SAVE CHANGES');
        $("#copra_add_edit_breakdown_modal").modal("hide");
      }
    })
  });

  $(document).on('click', '.delete_breakdown', function(){
    let id = $(this).attr('id');
    
    swal({
      title: "Are you sure?",
      text: "Delete this record?",
      icon: "warning",
      buttons: true,
      dangerMode: true
    }).then(willDelete => {
      if (willDelete) {
        $.ajax({
          url: "/delete_breakdown/"+id,
          method: "get",
          success: function(data) {
            swal("Success!", "Record has been deleted", "success");
            refresh_copra_modal_tables();
          }
        });
      }
    });
  })

  $(document).on('keyup', '#cop_nw, #cop_dust, #cop_moist', function(){
    copra_compute();
  })

  function copra_compute(){
    let net = ($('#cop_nw').val()) ? parseFloat($('#cop_nw').val()) : 0;
    let dust = ($('#cop_dust').val()) ? parseFloat($('#cop_dust').val()) : 0;
    let moist = ($('#cop_moist').val()) ? parseFloat($('#cop_moist').val()) : 0;
    let dust_w = $('#cop_dust_w');
    let moist_w = $('#cop_moist_w');
    let cop_rw = $('#cop_rw');
    
    dust_w.val((net * (dust/100)).toFixed(2));
    moist_w.val((net * (moist/100)).toFixed(2));
    dust_w = parseFloat(dust_w.val());
    moist_w = parseFloat(moist_w.val());
    cop_rw.val((net - (dust_w + moist_w)).toFixed(2));
  }
  
  $(document).on('keyup', '#cop_bd_rw, #cop_bd_price', function(){
    copra_breakdown_compute();
  })

  function copra_breakdown_compute(){
    let resicada = ($('#cop_bd_rw').val()) ? parseFloat($('#cop_bd_rw').val()) : 0;
    let price = ($('#cop_bd_price').val()) ? parseFloat($('#cop_bd_price').val()) : 0;
    let amount = $('#cop_bd_amount');
    let unpriced_hidden = ($('#bd_unpriced_weight_hidden').val()) ? parseFloat($('#bd_unpriced_weight_hidden').val()) : 0;
    let unpriced = $('#bd_unpriced_weight');
    amount.val((resicada * price).toFixed(2));
    unpriced.val(unpriced_hidden - resicada);
  }

  // COPRA DELIVERY -- END































  // COCONUT DELIVERY -- START
  
  // Initialize
  $(".add_cococonut_delivery, .edit_cococonut_delivery").hide();

  $(document).on('hidden.bs.modal', '#coconut_add_edit_modal', function(){
    $(this).find('input').val('').end();
    coconut_modal_data();
    setTimeout(function(){ $("#coconut_modal").modal("show"); }, 500);
  });

  $(document).on('click', '.coconut_delivery', function(){
    od_id = $(this).attr("id");

    coconut_modal_data();
    $("#coconut_modal").modal("show");
  });

  function coconut_modal_data() {
    $.ajax({
      url: "/coconut_modal_data/"+od_id,
      method: "get",
      dataType: "json",
      success: function(data) {
        $('.ticket_title').text(data.ticket);

        $('.add_cococonut_delivery, .edit_cococonut_delivery');

        $('#coconut_id').val(od_id);
        $('#coco_weight').val(data.coco_weight);

        if (data.nuts_reject) {
          $('#nuts_reject').text(data.nuts_reject.reject);
          $('#nuts_copra').text(data.nuts_reject.copra);
        }

        if (data.coconut_id) {
          $(".edit_coconut_delivery").show();
          $(".add_coconut_delivery").hide();
        }
        else {
          $(".add_coconut_delivery").show();
          $(".edit_coconut_delivery").hide();
        }

        refresh_coconut_tables();
      }
    });
  }

  function refresh_coconut_tables() {
    $("#view_coconut_modal_delivery").dataTable().fnDestroy();
    $("#view_coconut_modal_delivery").DataTable({
      searching: false,
      paging: false,
      info: false,
      ajax: {
        url: "/refresh_coconut_delivery/"+od_id,
        type: "post",
        headers: {
          "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content")
        },
      },
      processing: true,
      columns: [
        { data: "wr" },
        { data: "gross_weight" },
        { data: "moisture" },
        { data: "net_weight" },
        { data: "price" },
        { data: "amount" },
        { data: "tax" },
        { data: "unloading" },
        { data: "total_amount" },
      ]
    });
  }

  $(document).on('click', '.add_coconut_delivery', function(){
    $('#coconut_add_edit').val('add');
    $("#coconut_modal").modal("hide");
    setTimeout(function(){ $("#coconut_add_edit_modal").modal("show"); }, 500);
  });
  
  $(document).on('click', '.edit_coconut_delivery', function(){
    $.ajax({
      url: "/get_coconut_delivery/"+od_id,
      method: "get",
      dataType: "json",
      success: function(data){
        $('#coconut_add_edit').val('edit');
        $('#coco_wr').val(data.wr);
        $('#coco_gw').val(data.gross_weight);
        $('#coco_moist').val(data.moisture);
        $('#coco_nw').val(data.net_weight);
        $('#coco_price').val(data.price);
        $('#coco_amount').val(data.amount);
        $('#coco_tax').val(data.tax);
        $('#coco_unloading').val(data.unloading);
        $('#coco_total_amount').val(data.total_amount);
        $('#coco_nuts_reject').val(data.reject);
        $('#coco_copra').val(data.copra);
        coconut_compute();
        $("#coconut_modal").modal("hide");
        setTimeout(function(){ $("#coconut_add_edit_modal").modal("show"); }, 500);
      }
    });
  });

  $(document).on('submit', '#coconut_form', function(e){
    e.preventDefault();
    $('#add_coconut').attr('disabled', true).text('SAVING...');
    $.ajax({
      headers: {
        "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content")
      },
      url: "/save_coconut",
      method: 'POST',
      dataType: 'text',
      data: $(this).serialize(),
      success: function(data){
        $('#add_coconut').attr('disabled', false).text('SAVE CHANGES');
        $("#coconut_add_edit_modal").modal("hide");
      }
    })
  });




  
  $(document).on('keyup', '#coco_gw, #coco_moist, #coco_price, #coco_nw, #coco_tax, #coco_tax, #coco_unloading', function(){
    coconut_compute();
  });

  function coconut_compute(){
    let weight = parseFloat($('#coco_weight').val());
    let gross_weight = ($('#coco_gw').val()) ? parseFloat($('#coco_gw').val()) : 0;
    let moist = ($('#coco_moist').val()) ? parseFloat($('#coco_moist').val()) : 0;
    let moist_w = $('#coco_moist_w');
    let net_weight = $('#coco_nw');
    let price = ($('#coco_price').val()) ? parseFloat($('#coco_price').val()) : 0;
    let amount = $('#coco_amount');
    let tax = ($('#coco_tax').val()) ? parseFloat($('#coco_tax').val()) : 0;
    let unloading = ($('#coco_unloading').val()) ? parseFloat($('#coco_unloading').val()) : 0;
    let total_amount = $('#coco_total_amount');
    let reject = $('#coco_nuts_reject');
    let copra = $('#coco_copra');
    moist_w.val((gross_weight * (moist/100)).toFixed(2));
    moist_w = parseFloat(moist_w.val());
    net_weight.val(gross_weight - moist_w);
    net_weight = parseFloat(net_weight.val());
    amount.val((net_weight * price).toFixed(2));
    amount = parseFloat(amount.val());
    
    total_amount.val((amount - (tax + unloading)).toFixed(2));
    reject.val((weight - gross_weight).toFixed());
    copra.val((reject.val() * 0.22).toFixed(2));
  }





  // COCONUT DELIVERY -- END

































  $("#plateno").select2({
    dropdownParent: $("#od_modal"),
    placeholder: "Select a truck"
  });

  $("#driver_id").select2({
    dropdownParent: $("#od_modal"),
    placeholder: "Select a driver"
  });
  $("#commodity").select2({
    dropdownParent: $("#od_modal"),
    placeholder: "Select Commodity"
  });
  $("#company").select2({
    dropdownParent: $("#od_modal"),
    placeholder: "Select a company"
  });
  
  if (window.location.hash) {
    $('.nav-tabs li a[href="' + window.location.hash + '"]').tab("show");
  }
});

</script>
@endsection