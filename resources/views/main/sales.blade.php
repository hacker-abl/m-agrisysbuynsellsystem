@extends(isAdmin() ? 'layouts.admin' : 'layouts.user')

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
            <li >
                <a href="{{ route('od') }}">
                    <i class="material-icons">arrow_upward</i>
                    <span>Outbound Deliveries</span>
                </a>
            </li>
            <li >
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
            <li class="active">
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
			<h2>Sales Dashboard</h2>
		</div>
	</div>
	<div class="modal fade" id="sales_modal" tabindex="-1" role="dialog">
		<div class="modal-dialog" role="document">
			<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
				<div class="card">
					<div class="header">
						<h2 class="modal_title">Add Sales</h2>
						<ul class="header-dropdown m-r--5">
                            <li class="dropdown">
                                <button id="print_sales" type="button" class="btn bg-grey btn-xs waves-effect m-r-20" ><i class="material-icons">print</i></button>
                            </li>
                            <li class="dropdown">
                                <form method="POST" id="printForm" name="printForm" target="_blank" action="{{ route('print_sales') }}">
                                <input type="hidden" id="commodity_clone" name="commodity_clone">
                                <input type="hidden" id="company_clone" name="company_clone">
                                <input type="hidden" id="kilos_clone" name="kilos_clone">
                                <input type="hidden" id="amount_clone" name="amount_clone">
                                <button class="btn btn-sm btn-icon print-icon" type="submit" name="print_form" id="print_form" title="PRINT ONLY"><i class="glyphicon glyphicon-print"></i></button>
                                </form>
                            </li>
                        </ul>
					</div>
					<div class="body">
						<form class="form-horizontal " id="sales_form">
							<input type="hidden" name="id" id="id" value="">
							<input type="hidden" name="button_action" id="button_action" value="">

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
									<label for="name">Kilos</label>
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
									<label for="name">Amount</label>
								</div>
								<div class="col-lg-10 col-md-10 col-sm-8 col-xs-7">
									<div class="form-group">
										<div class="form-line">
											<input type="number" id="amount" name="amount" class="form-control"   required>
										</div>
									</div>
								</div>
							</div>

							<div class="row clearfix">
							 	<div class="modal-footer">
									<button type="submit" id="add_sales" class="btn btn-link waves-effect">SAVE CHANGES</button>
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
					<h2>List of Sales as of {{ date('Y-m-d ') }}</h2>
						<ul class="header-dropdown m-r--5">
							<li class="dropdown">
								<button type="button" class="btn bg-grey btn-xs waves-effect m-r-20 open_sales_modal"><i class="material-icons">library_add</i></button>
							</li>
						</ul>
					</div>
					<div class="body">
						<div class="table-responsive">
							 <p id="date_filter">
                                <h5>Date Range Filter</h5>
                                <span id="date-label-from" class="date-label">From: </span><input class="date_range_filter date" type="text" id="sales_datepicker_from" />
                                <span id="date-label-to" class="date-label">To:<input class="date_range_filter date" type="text" id="sales_datepicker_to" />
                            </p>
							<table id="salestable" class="table table-bordered table-striped table-hover  ">
								<thead>
									<tr>
										<th width="100" style="text-align:center;">Date</th>
										<th width="100" style="text-align:center;">Commodity</th>
										<th width="100" style="text-align:center;">Company</th>
										<th width="100" style="text-align:center;">No. Of Kilos</th>
										<th width="100" style="text-align:center;">Amount</th>
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
    	var salestable;
    	var sales_date_from;
    	var sales_date_to;
        $(document).on("click","#link",function(){
            $("#bod").toggleClass('overlay-open');
        });

        $(document).ready(function() {

            $.extend( $.fn.dataTable.defaults, {
                "language": {
                    processing: 'Loading.. Please wait'
                }
            });

			//OUTBOUND DELIVERIES datatable starts here
			$('#sales_modal').on('hidden.bs.modal', function (e) {
				$(this)
				.find("input,textarea,select")
					.val('')
					.end()
				.find("input[type=checkbox], input[type=radio]")
					.prop("checked", "")
					.end();
			})

		 salestable = $('#salestable').DataTable({
				dom: 'Bfrtip',
				buttons: [
				],
				processing: true,
				serverSide: true,
				columnDefs: [
  				{
    			  	"targets": "_all", // your case first column
     				"className": "text-center",
      				
 				}
				],
				order:[],
                ajax:{
                 
                      url: "{{ route('refresh_sales') }}",
                      // dataType: 'text',
                      type: 'post',
                      headers: {
                          'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        },
                      data: {
                          date_from: sales_date_from,
                          date_to: sales_date_to,
                      },
                     
                
                },
				columns: [
                    {data: 'created_at'},
					{data: 'commodity_name'},
					{data: 'name'},
                    {data: 'kilos'},
					{data: 'amount'},
					{data: "action", orderable:false,searchable:false}
				]
			});
		 	//Start of Date Range Filter
				$("#sales_datepicker_from").datepicker({
                showOn: "button",
                buttonImage: 'assets/images/calendar2.png',
                buttonImageOnly: false,
                "onSelect": function(date) {
                   
                  minDateFilter = new Date(date).getTime();
                  var df= new Date(date);
                  sales_date_from= df.getFullYear() + "-" + (df.getMonth() + 1) + "-" + df.getDate();
                  $('#salestable').dataTable().fnDestroy();
                  salestable = $('#salestable').DataTable({
					dom: 'Bfrtip',
					buttons: [
					],
					processing: true,
					serverSide: true,
					order:[],
	                ajax:{
	                 
	                      url: "{{ route('refresh_sales') }}",
	                      // dataType: 'text',
	                      type: 'post',
	                      headers: {
	                          'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
	                        },
	                      data: {
	                          date_from: sales_date_from,
	                          date_to: sales_date_to,
	                      },
	                     
	                
	                },
					columns: [
	                    {data: 'created_at'},
						{data: 'commodity_name'},
						{data: 'name'},
	                    {data: 'kilos'},
						{data: 'amount'},
						{data: "action", orderable:false,searchable:false}
					]
				});

                }
              }).keyup(function() {
              	sales_date_from="";
               $('#salestable').dataTable().fnDestroy();
                 salestable = $('#salestable').DataTable({
					dom: 'Bfrtip',
					buttons: [
					],
					processing: true,
					serverSide: true,
					order:[],
	                ajax:{
	                 
	                      url: "{{ route('refresh_sales') }}",
	                      // dataType: 'text',
	                      type: 'post',
	                      headers: {
	                          'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
	                        },
	                      data: {
	                          date_from: sales_date_from,
	                          date_to: sales_date_to,
	                      },
	                     
	                
	                },
					columns: [
	                    {data: 'created_at'},
						{data: 'commodity_name'},
						{data: 'name'},
	                    {data: 'kilos'},
						{data: 'amount'},
						{data: "action", orderable:false,searchable:false}
					]
				});

              });

              $("#sales_datepicker_to").datepicker({
                showOn: "button",
                buttonImage: 'assets/images/calendar2.png',
                buttonImageOnly: false,
                "onSelect": function(date) {
                  maxDateFilter = new Date(date).getTime();
                  //oTable.fnDraw();
                 var dt= new Date(date);
                   sales_date_to =dt.getFullYear() + "-" + (dt.getMonth() + 1) + "-" + dt.getDate();
                  $('#salestable').dataTable().fnDestroy();
                 salestable = $('#salestable').DataTable({
					dom: 'Bfrtip',
					buttons: [
					],
					processing: true,
					serverSide: true,
					order:[],
	                ajax:{
	                 
	                      url: "{{ route('refresh_sales') }}",
	                      // dataType: 'text',
	                      type: 'post',
	                      headers: {
	                          'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
	                        },
	                      data: {
	                          date_from: sales_date_from,
	                          date_to: sales_date_to,
	                      },
	                     
	                
	                },
					columns: [
	                    {data: 'created_at'},
						{data: 'commodity_name'},
						{data: 'name'},
	                    {data: 'kilos'},
						{data: 'amount'},
						{data: "action", orderable:false,searchable:false}
					]
				});

                }
              }).keyup(function() {
              	sales_date_to="";
                $('#salestable').dataTable().fnDestroy();
                 salestable = $('#salestable').DataTable({
					dom: 'Bfrtip',
					buttons: [
					],
					processing: true,
					serverSide: true,
					order:[],
	                ajax:{
	                 
	                      url: "{{ route('refresh_sales') }}",
	                      // dataType: 'text',
	                      type: 'post',
	                      headers: {
	                          'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
	                        },
	                      data: {
	                          date_from: sales_date_from,
	                          date_to: sales_date_to,
	                      },
	                     
	                
	                },
					columns: [
	                    {data: 'created_at'},
						{data: 'commodity_name'},
						{data: 'name'},
	                    {data: 'kilos'},
						{data: 'amount'},
						{data: "action", orderable:false,searchable:false}
					]
				});

              });		 	
		 	//End of Date Range Filter


			function refresh_sales_table(){
				salestable.ajax.reload(); //reload datatable ajax
			}

			$(document).on('click','.open_sales_modal', function(){
				$('.modal_title').text('Add Sales');
				$('#button_action').val('add');
                    $("#company").val('').trigger('change');
                    $("#commodity").val('').trigger('change');
                    $('#sales_modal').modal('show');
			});

			$(document).on('click', '#add_sales', function(event){
				event.preventDefault();
				$.ajax({
					headers: {
						'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
					},
					url:"{{ route('add_sales') }}",
					method: 'POST',
					dataType:'text',
					data: $('#sales_form').serialize(),
					success:function(data){
						$("#company").val('').trigger('change');
						$("#commodity").val('').trigger('change');
						swal("Success!", "Record has been added to database", "success")
						$('#sales_modal').modal('hide');
						refresh_sales_table();
					},
					error: function(data){
						swal("Oh no!", "Something went wrong, try again.", "error")
					}
				})
			});

			$("#print_sales").click(function(event) {
                event.preventDefault();
                $("#add_sales").trigger("click");
                $("#print_form").trigger("click");
            });

            $("#print_form").click(function(event) {
                $("#commodity_clone").val($("#commodity option:selected").text());
                $("#company_clone").val($("#company option:selected").text());
                $("#kilos_clone").val($("#kilos").val());
                $("#amount_clone").val($("#amount").val());
            });

			$(document).on('click', '.update_sales', function(){
				var id = $(this).attr("id");
				$.ajax({
					url:"{{ route('update_sales') }}",
					method: 'get',
					data:{id:id},
					dataType:'json',
					success:function(data){
						$('#button_action').val('update');
						$('#id').val(id);
						$("#company").val(data.company_id).trigger('change');
						$("#commodity").val(data.commodity_id).trigger('change');
						$('#kilos').val(data.kilos);
                              $('#amount').val(data.amount);
						$('#sales_modal').modal('show');
						$('.modal_title').text('Update Sales');
						refresh_sales_table();
					}
				})
			});

			$(document).on('click', '.delete_sales', function(){
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
						url:"{{ route('delete_sales') }}",
						method: "get",
						data:{id:id},
						success:function(data){
							refresh_sales_table();
						}
					})
					swal("Deleted!", "The record has been deleted.", "success");
				});
			});
			//OUTBOUND DELIVERIES Datatable ends here




            $('#commodity').select2({
                dropdownParent: $('#sales_modal'),
                 placeholder: 'Select an item'
            });
            $('#company').select2({
                dropdownParent: $('#sales_modal'),
                 placeholder: 'Select a company'
            });
        });
    </script>
@endsection
