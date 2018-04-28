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
            <li>
                <a href="{{ route('expense') }}">
                    <i class="material-icons">show_chart</i>
                    <span>Expenses</span>
                </a>
            </li> 
            <li>
                <a href="{{ route('trips') }}">
                    <i class="material-icons">directions_bus</i>
                    <span>Trips</span>
                </a>
            </li>
            <li class="active">
                <a href="{{ route('dtr') }}">
                    <i class="material-icons">access_time</i>
                    <span>Daily Time Record</span>
                </a>
            </li>
            <li>
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
            <h2>Daily Time Record</h2>
        </div>
    </div>

    <!-- Add DTR Modal -->
    <div class="modal fade" id="dtr_modal" tabindex="-1" role="dialog">
		<div class="modal-dialog" role="document">
			<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
				<div class="card">
					<div class="header">
						<h2 class="modal_title">Add DTR</h2>
					</div>
					<div class="body">
						<form class="form-horizontal " id="dtr_form">
							<input type="hidden" name="id" id="id" value="">
							<input type="hidden" name="button_action" id="button_action" value="">

							<div class="row clearfix">
								<div class="col-lg-2 col-md-2 col-sm-4 col-xs-5 form-control-label">
									<label for="name">Name</label>
								</div>
								<div class="col-lg-10 col-md-10 col-sm-8 col-xs-7">
									<div class="form-group">
										<div class="form-line">
											<select type="text" id="employee_id" name="employee_id" class="form-control" required style="width: 100%;">
                                                @foreach($employee as $a)
                                                <option></option>
                                                <option value="{{ $a->id }}">{{ $a->lname.", ".$a->fname." ".$a->mname}}</option>
                                                @endforeach
                                            </select>
										</div>
									</div>
								</div>
							</div>

                            <div class="row clearfix">
								<div class="col-lg-2 col-md-2 col-sm-4 col-xs-5 form-control-label">
									<label for="name">Role</label>
								</div>
								<div class="col-lg-10 col-md-10 col-sm-8 col-xs-7">
									<div class="form-group">
										<div class="form-line">
											<input type="text" id="role" name="role" class="form-control" readonly>
										</div>
									</div>
								</div>
							</div>

                            <div class="row clearfix">
								<div class="col-lg-2 col-md-2 col-sm-4 col-xs-5 form-control-label">
									<label for="name">Overtime</label>
								</div>
								<div class="col-lg-10 col-md-10 col-sm-8 col-xs-7">
									<div class="form-group">
										<div class="form-line">
											<input type="" id="overtime" min="0" name="overtime" class="form-control" required>
										</div>
									</div>
								</div>
							</div>

                            <div class="row clearfix">
								<div class="col-lg-2 col-md-2 col-sm-4 col-xs-5 form-control-label">
									<label for="name">Rate</label>
								</div>
								<div class="col-lg-10 col-md-10 col-sm-8 col-xs-7">
									<div class="form-group">
										<div class="form-line">
											<input type="number" id="rate" name="rate" class="form-control" readonly>
										</div>
									</div>
								</div>
							</div>

                            <div class="row clearfix">
								<div class="col-lg-2 col-md-2 col-sm-4 col-xs-5 form-control-label">
									<label for="name">Number Of Hours</label>
								</div>
								<div class="col-lg-10 col-md-10 col-sm-8 col-xs-7">
									<div class="form-group">
										<div class="form-line">
											<input type="" id="num_hours" min="0" name="num_hours" class="form-control" required>
										</div>
									</div>
								</div>
							</div>

                             <div class="row clearfix">
								<div class="col-lg-2 col-md-2 col-sm-4 col-xs-5 form-control-label">
									<label for="name">Salary</label>
								</div>
								<div class="col-lg-10 col-md-10 col-sm-8 col-xs-7">
									<div class="form-group">
										<div class="form-line">
											<input type="number" id="salary" min="0" name="salary" class="form-control" readonly>
										</div>
									</div>
								</div>
							</div>

							<div class="row clearfix">
							 	<div class="modal-footer">
									<button type="submit" id="add_dtr" class="btn btn-link waves-effect">SAVE CHANGES</button>
									<button type="button" class="btn btn-link waves-effect" data-dismiss="modal">CLOSE</button>
								</div>
							</div>
						</form>
					</div>
				</div>
			</div>
		</div>
	</div>

    <!-- View Person DTR Modal -->
    <div class="modal fade" id="dtr_view_modal" tabindex="-1" role="dialog">
		<div class="modal-dialog modal-lg" role="document">
            <div class="row">
                <form class="form-horizontal " id="dtr_view_form">
                    <div class="card">
                        <div class="header">
                            <h2> Daily Time Records History - <span class="modal_title_dtr"></span></h2>
                        </div>
                        <div class="body">
                            <div class="table-responsive">
                                <table id="view_dtr_table" class="table table-bordered table-striped table-hover" style="width: 100%;">
                                    <thead>
                                        <tr>
                                        <th>Overtime</th>
                                        <th>Number of Hours</th>
                                        <th>Date/Time</th>
                                        <th>Salary</th>
                                        <th>Status</th>
                                        </tr>
                                    </thead>
                                </table>
                            </div>
                            <div class="modal-footer">
                                    <button type="button" class="btn btn-link waves-effect" data-dismiss="modal">CLOSE</button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
		</div>
	</div>

    <div class="row clearfix">
		<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
			<div class="card">
				<div class="header">
					<h2>Daily Time Records as of {{ date('Y-m-d ') }}</h2>
						<ul class="header-dropdown m-r--5">
							<li class="dropdown">
								<button type="button" class="btn bg-grey btn-xs waves-effect m-r-20 open_dtr_modal"><i class="material-icons">library_add</i></button>
							</li>
						</ul>
					</div>
					<div class="body">
						<div class="table-responsive">
							<table id="dtr_table" class="table table-bordered table-striped table-hover" style="width: 100%;">
								<thead>
									<tr>
										<th>Name</th>
										<th>Role</th>
										<th>Overtime</th>
										<th>Number of Hours</th>
                                        <th>Date/Time</th>
                                        <th>Salary</th>
                                        <th>Status</th>
										<th width="50">Action</th>
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
    var overtime;
    var salary;
        $(document).on("click","#link",function(){
            $("#bod").toggleClass('overlay-open');
        });

        $(document).ready(function() {

            $.extend( $.fn.dataTable.defaults, {
                "language": {
                    processing: 'Loading.. Please wait'
                }
            });

            //DTR datatable starts here
            $('#dtr_modal').on('hidden.bs.modal', function (e) {
				$(this)
				.find("input,textarea,select")
					.val('')
					.end()
				.find("input[type=checkbox], input[type=radio]")
					.prop("checked", "")
					.end();
			})

            var dtr = $('#dtr_table').DataTable({
				dom: 'Bfrtip',
				buttons: [
				],
				processing: true,
				serverSide: true,
				ajax: "{{ route('refresh_dtr') }}",
				columns: [
					{render: function(data, type, full, meta){
                        return full.fname +" "+full.mname+" "+full.lname;
                    }},
					{data: 'role', name: 'role'},
                    {data: 'overtime', name: 'overtime'},
                    {data: 'num_hours', name: 'num_hours'},
					{data: 'created_at', name: 'created_at'},
					{data: 'salary', name: 'salary'},
                    {data: 'status', name: 'status'},
					{data: "action", orderable:false,searchable:false}
				]
			});

            function refresh_dtr_table(){
				dtr.ajax.reload(); //reload datatable ajax
			}

            $(document).on('click','.open_dtr_modal', function(){
                $("#employee_id").val('').trigger('change');
                $("#role").val('').trigger('change');
                $("#overtime").val('').trigger('change');
                $("#num_hours").val('').trigger('change');
                $('#dtr_modal').modal('show');
			});

            //check employee details
            $('#employee_id').change(function(){
                var id = $(this).val();
                $.ajax({
                    url:"{{ route('check_employee') }}",
                    method: 'get',
                    data:{id:id},
                    dataType:'json',
                    success:function(data){
                        $('#role').val(data[0].role);
                        $('#rate').val(data[0].rate);
                        
                        salary=data[0].rate;
                        $('#salary').val(overtime*salary);
                    }
                })
            });

            $('#overtime').change(function(){
                overtime=parseFloat($('#overtime').val())+parseFloat($('#num_hours').val());
                    
                 $('#salary').val(overtime*salary);
            })
            $('#num_hours').change(function(){
               
                overtime=parseFloat($('#overtime').val())+parseFloat($('#num_hours').val());

                $('#salary').val(overtime*salary);
            })


            $("#add_dtr").click(function(event){
                event.preventDefault();
                $.ajax({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    url: "{{ route('add_dtr') }}",
                    method: 'POST',
                    dataType: 'text',
                    data: $('#dtr_form').serialize(),
                    success:function(data){
                        dataparsed = $.parseJSON(data);
                        $("#id").val(dataparsed[0].id);
                $.ajax({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    url: "{{ route('add_dtr_expense') }}",
                    method: 'POST',
                    dataType: 'text',
                    data: $('#dtr_form').serialize(),
                    success:function(data){
                       $('#dtr_modal').modal('hide');
                    },
                    error: function(data){
						swal("Oh no!", "Something went wrong on dtr expense, try again.", "error");
					}
                });

                        swal("Success!", "Record has been added to database", "success");
						refresh_dtr_table();
                    },
                    error: function(data){
						swal("Oh no!", "Something went wrong, try again.", "error");
					}
                });
            });

            $(document).on('click', '.view_dtr', function(){
                var id = $(this).attr("id");

                //Datatable for each person
                $.ajax({
                    url: "{{ route('refresh_view_dtr') }}",
                    method: 'get',
                    data:{id:id},
                    dataType: 'json',
                    success:function(data){
                        $('.modal_title_dtr').text(data.data[0].fname + " " + data.data[0].mname + " " + data.data[0].lname + " ("+ data.data[0].role + ")");

                        $('#view_dtr_table').DataTable({
                            dom: 'Bfrtip',
                            bDestroy: true,
                            buttons: [
                            ],
                            data: data.data,
                            columns:[
                                {data: 'overtime', name: 'overtime'},
                                {data: 'num_hours', name: 'num_hours'},
                                {data: 'created_at', name: 'created_at'},
                                {data: 'salary', name: 'salary'},
                                {data: 'status', name: 'status'},
                            ]
                        });
                        $('#dtr_view_modal').modal('show');
                    }
                });
            });
            //CASH ADVANCE datatable ends here

            $('#employee_id').select2({
               dropdownParent: $('#dtr_modal'),
               placeholder: 'Select an employee'
            });
        });
    </script>
@endsection
