@extends('layouts.admin')

@section('sidenav')
	<div class="menu">
     	<ul class="list">
			<li class="header">MAIN NAVIGATION</li>
			<li>
				<a href="{{ route('home') }}">
					<i class="material-icons">home</i>
					<span>Home</span>
				</a>
			</li>
			<li>
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
			<li>
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
			<li>
				<a href="{{ route('purchases') }}">
					<i class="material-icons">bookmark_border</i>
					<span>Purchases</span>
				</a>
			</li>
			<li>
				<a href="{{ route('sales') }}">
					<i class="material-icons">shopping_cart</i>
					<span>Sales</span>
				</a>
			</li>
		</ul>
	</div>
@endsection

@section('content')
	<div class="container-fluid">
		<div class="block-header">
			<h2>Outbound Deliveries Dashboard</h2>
		</div>
	</div>
	<div class="modal fade" id="od_modal" tabindex="-1" role="dialog">
		<div class="modal-dialog" role="document">
			<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
				<div class="card">
					<div class="header">
						<h2 class="modal_title">Add Delivery</h2>
						<ul class="header-dropdown m-r--5">
                            <li class="dropdown">
                                <button id="print_od" type="button" class="btn bg-grey btn-xs waves-effect m-r-20" ><i class="material-icons">print</i></button>
                            </li>
                            <li class="dropdown">
                                <form method="POST" id="printForm" name="printForm" target="_blank" action="{{ route('print_od') }}">
                                <input type="hidden" id="ticket_clone" name="ticket_clone">
                                <input type="hidden" id="commodity_clone" name="commodity_clone">
                                <input type="hidden" id="destination_clone" name="destination_clone">
                                <input type="hidden" id="driver_id_clone" name="driver_id_clone">
                                <input type="hidden" id="company_clone" name="company_clone">
                                <input type="hidden" id="plateno_clone" name="plateno_clone">
                                <input type="hidden" id="liter_clone" name="liter_clone">
                                <button class="btn btn-sm btn-icon print-icon" type="submit" name="print_form" id="print_form" title="PRINT ONLY"><i class="glyphicon glyphicon-print"></i></button>
                                </form>
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
					<h2>List of Outbound Deliveries as of {{ date('Y-m-d ') }}</h2>
						<ul class="header-dropdown m-r--5">
							<li class="dropdown">
								<button type="button" class="btn bg-grey btn-xs waves-effect m-r-20 open_od_modal"><i class="material-icons">library_add</i></button>
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
										<th width="100" style="text-align:center;">Allowance</th>
										<th width="100" style="text-align:center;">Date</th>
										<th width="100" style="text-align:center;">Action</th>
									</tr>
								</thead>
							</table>
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
        $(document).on("click","#link",function(){
            $("#bod").toggleClass('overlay-open');
        });

        $(document).ready(function() {
			$($.fn.dataTable.tables( true ) ).css('width', '100%');
        $($.fn.dataTable.tables( true ) ).DataTable().columns.adjust().draw();

            $.extend( $.fn.dataTable.defaults, {
                "language": {
                    processing: 'Loading.. Please wait'
                }
            });

			//OUTBOUND DELIVERIES datatable starts here
			$('#od_modal').on('hidden.bs.modal', function (e) {
				$(this)
				.find("input,textarea,select")
					.val('')
					.end()
				.find("input[type=checkbox], input[type=radio]")
					.prop("checked", "")
					.end();
			})
                    
			deliveriestable = $('#deliverytable').DataTable({
				 dom: 'Bfrtip',
                    buttons: [

                ],
                paging: true,
                pageLength: 10,
                order:[],
                ajax:{
                   
                        url: "{{ route('refresh_deliveries') }}",
                        // dataType: 'text',
                        type: 'post',
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                          },
                        data: {
                            date_from: od_date_from,
                            date_to: od_date_to,
                        },
                       
                  
                },
                processing:true,
                serverSide:true,
				columns: [
					{data: 'outboundTicket'},
					{data: 'commodity_name'},
					{data: 'destination'},
					{data: 'name'},
					{data:'fname',
						render: function(data, type, full, meta){
							return full.fname +" "+ full.mname+" "+full.lname;
						}
					},
					{data: 'plateno'},
					{data: 'fuel_liters'},
					{data: 'created_at'},
					{data: "action", orderable:false,searchable:false}
				]
			});
			//START OF DATE RANGE FILTER
			$("#od_datepicker_from").datepicker({
                showOn: "button",
                buttonImage: 'assets/images/calendar2.png',
                buttonImageOnly: false,
                "onSelect": function(date) {
                   
                  minDateFilter = new Date(date).getTime();
                  var df= new Date(date);
                  od_date_from= df.getFullYear() + "-" + (df.getMonth() + 1) + "-" + df.getDate();
                  $('#deliverytable').dataTable().fnDestroy();
                  deliveriestable = $('#deliverytable').DataTable({
				 dom: 'Bfrtip',
                    buttons: [

                ],
                paging: true,
                pageLength: 10,
                order:[],
                ajax:{
                   
                        url: "{{ route('refresh_deliveries') }}",
                        // dataType: 'text',
                        type: 'post',
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                          },
                        data: {
                            date_from: od_date_from,
                            date_to: od_date_to,
                        },
                       
                  
                },
                processing:true,
                serverSide:true,
				columns: [
					{data: 'outboundTicket'},
					{data: 'commodity_name'},
					{data: 'destination'},
					{data: 'name'},
					{data:'fname',
						render: function(data, type, full, meta){
							return full.fname +" "+ full.mname+" "+full.lname;
						}
					},
					{data: 'plateno'},
					{data: 'fuel_liters'},
					{data: 'created_at'},
					{data: "action", orderable:false,searchable:false}
				]
			});

                }
              }).keyup(function() {
              	od_datepicker_from="";
                $('#deliverytable').dataTable().fnDestroy();
                  deliveriestable = $('#deliverytable').DataTable({
				 dom: 'Bfrtip',
                    buttons: [

                ],
                paging: true,
                pageLength: 10,
                order:[],
                ajax:{
                   
                        url: "{{ route('refresh_deliveries') }}",
                        // dataType: 'text',
                        type: 'post',
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                          },
                        data: {
                            date_from: od_date_from,
                            date_to: od_date_to,
                        },
                       
                  
                },
                processing:true,
                serverSide:true,
				columns: [
					{data: 'outboundTicket'},
					{data: 'commodity_name'},
					{data: 'destination'},
					{data: 'name'},
					{data:'fname',
						render: function(data, type, full, meta){
							return full.fname +" "+ full.mname+" "+full.lname;
						}
					},
					{data: 'plateno'},
					{data: 'fuel_liters'},
					{data: 'created_at'},
					{data: "action", orderable:false,searchable:false}
				]
			});
              });

              $("#od_datepicker_to").datepicker({
                showOn: "button",
                buttonImage: 'assets/images/calendar2.png',
                buttonImageOnly: false,
                "onSelect": function(date) {
                  maxDateFilter = new Date(date).getTime();
                  //oTable.fnDraw();
                 var dt= new Date(date);
                   od_date_to =dt.getFullYear() + "-" + (dt.getMonth() + 1) + "-" + dt.getDate();
                  $('#deliverytable').dataTable().fnDestroy();
                 deliveriestable = $('#deliverytable').DataTable({
				 dom: 'Bfrtip',
                    buttons: [

                ],
                paging: true,
                pageLength: 10,
                order:[],
                ajax:{
                   
                        url: "{{ route('refresh_deliveries') }}",
                        // dataType: 'text',
                        type: 'post',
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                          },
                        data: {
                            date_from: od_date_from,
                            date_to: od_date_to,
                        },
                       
                  
                },
                processing:true,
                serverSide:true,
				columns: [
					{data: 'outboundTicket'},
					{data: 'commodity_name'},
					{data: 'destination'},
					{data: 'name'},
					{data:'fname',
						render: function(data, type, full, meta){
							return full.fname +" "+ full.mname+" "+full.lname;
						}
					},
					{data: 'plateno', name: 'plateno'},
					{data: 'fuel_liters', name: 'fuel_liters'},
					{data: 'allowance', name: 'allowance'},
					{data: 'created_at', name: 'created_at'},
					{data: "action", orderable:false,searchable:false}
				]
			});
                }
              }).keyup(function() {
              	od_date_to="";
              	console.log(od_date_to);
                $('#deliverytable').dataTable().fnDestroy();
                  deliveriestable = $('#deliverytable').DataTable({
				 dom: 'Bfrtip',
                    buttons: [

                ],
                paging: true,
                pageLength: 10,
                order:[],
                ajax:{
                   
                        url: "{{ route('refresh_deliveries') }}",
                        // dataType: 'text',
                        type: 'post',
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                          },
                        data: {
                            date_from: od_date_from,
                            date_to: od_date_to,
                        },
                       
                  
                },
                processing:true,
                serverSide:true,
				columns: [
					{data: 'outboundTicket'},
					{data: 'commodity_name'},
					{data: 'destination'},
					{data: 'name'},
					{data:'fname',
						render: function(data, type, full, meta){
							return full.fname +" "+ full.mname+" "+full.lname;
						}
					},
					{data: 'plateno'},
					{data: 'fuel_liters'},
					{data: 'created_at'},
					{data: "action", orderable:false,searchable:false}
				]
			});
              });
			//END OF DATE RANGE FILTER
			function refresh_delivery_table(){
				deliveriestable.ajax.reload(); //reload datatable ajax
			}

			$(document).on('click','.open_od_modal', function(){
				$('.modal_title').text('Add Delivery');
				$('#button_action').val('add');
				$.ajax({
					url:"{{ route('refresh_id') }}",
					method: 'get',
					data: { temp: 'temp' },
					dataType:'json',
					success:function(data){
						var t=0;
						if(data[0].temp!=null){
							t = data[0].temp;
						}
						$("#driver_id").val('').trigger('change');
						$("#company").val('').trigger('change');
						$("#commodity").val('').trigger('change');
						$("#plateno").val('').trigger('change');
						var a = parseInt(t);
						var b = a + 1;
						var c = new Date();
						var twoDigitMonth = ((c.getMonth().length+1) === 1)? (c.getMonth()+1) : '0' + (c.getMonth()+1);
						var currentDate = c.getFullYear()+ twoDigitMonth + c.getDate();
						$('#ticket').val(currentDate+b);
						console.log( $('#ticket').val());
						$('#od_modal').modal('show');
					}
				})
			});

			$(document).on('click', '#add_delivery', function(event){
				event.preventDefault();
				$.ajax({
					headers: {
						'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
					},
					url:"{{ route('add_delivery') }}",
					method: 'POST',
					dataType:'text',
					data: $('#od_form').serialize(),
					success:function(data){
						$("#driver_id").val('').trigger('change');
						$("#company").val('').trigger('change');
						$("#commodity").val('').trigger('change');
						swal("Success!", "Record has been added to database", "success")
						$('#od_modal').modal('hide');
						refresh_delivery_table();
					},
					error: function(data){
						swal("Oh no!", "Something went wrong, try again.", "error")
					}
				})
			});

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
            });


			$(document).on('click', '.update_delivery', function(){
				var id = $(this).attr("id");
				$.ajax({
					url:"{{ route('update_delivery') }}",
					method: 'get',
					data:{id:id},
					dataType:'json',
					success:function(data){
						$('#button_action').val('update');
						$('#id').val(id);
						$('#ticket').val(data.outboundTicket);
						$('#destination').val(data.destination);
						$("#driver_id").val(data.driver_id).trigger('change');
						$("#company").val(data.company_id).trigger('change');
						$("#commodity").val(data.commodity_id).trigger('change');
						$("#plateno").val(data.plateno).trigger('change');
						$('#liter').val(data.fuel_liters);
						$('#allowance').val(data.allowance);
						$('#od_modal').modal('show');
						$('.modal_title').text('Update Role');
						refresh_delivery_table();
					}
				})
			});

			$(document).on('click', '.delete_delivery', function(){
				var id = $(this).attr('id');
				swal({
					title: "Are you sure?",
					text: "Delete this record!",
					type: "warning",
					showCancelButton: true,
					confirmButtonClass: "btn-danger",
					confirmButtonText: "Yes, delete it!",
					closeOnConfirm: false
				},
				function(){
					$.ajax({
						url:"{{ route('delete_delivery') }}",
						method: "get",
						data:{id:id},
						success:function(data){
							refresh_delivery_table();
						}
					})
					swal("Deleted!", "The record has been deleted.", "success");
				});
			});
			//OUTBOUND DELIVERIES Datatable ends here

			$('#plateno').select2({
               dropdownParent: $('#od_modal'),
               placeholder: 'Select a truck'
            });

            $('#driver_id').select2({
                dropdownParent: $('#od_modal'),
                 placeholder: 'Select a driver'
            });
            $('#commodity').select2({
                dropdownParent: $('#od_modal'),
                 placeholder: 'Select an item'
            });
            $('#company').select2({
                dropdownParent: $('#od_modal'),
                 placeholder: 'Select a company'
            });
        });
    </script>
@endsection