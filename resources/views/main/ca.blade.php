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
            <li>
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
            <li class="active">
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
            <h2>Cash Advance Dashboard</h2>
        </div>
    </div>

    <!-- Add Cash Advance Modal -->
    <div class="modal fade" id="ca_modal" tabindex="-1" role="dialog">
		<div class="modal-dialog" role="document">
			<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
				<div class="card">
					<div class="header">
						<h2 class="modal_title">Add Cash Advance</h2>
					</div>
					<div class="body">
						<form class="form-horizontal " id="ca_form">
							<input type="hidden" name="id" id="id" value="">
							<input type="hidden" name="button_action" id="button_action" value="">

							<div class="row clearfix">
								<div class="col-lg-2 col-md-2 col-sm-4 col-xs-5 form-control-label">
									<label for="name">Name</label>
								</div>
								<div class="col-lg-10 col-md-10 col-sm-8 col-xs-7">
									<div class="form-group">
										<div class="form-line">
											<select type="text" id="customer_id" name="customer_id" class="form-control" required style="width: 100%;">
                                                @foreach($customer as $a)
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
									<label for="name">Reason</label>
								</div>
								<div class="col-lg-10 col-md-10 col-sm-8 col-xs-7">
									<div class="form-group">
										<div class="form-line">
											<input type="text" id="reason" name="reason" class="form-control" required>
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
											<input type="number" id="amount" min="0" name="amount" class="form-control" required>
										</div>
									</div>
								</div>
							</div>

                            <div class="row clearfix">
								<div class="col-lg-2 col-md-2 col-sm-4 col-xs-5 form-control-label">
									<label for="name">Balance</label>
								</div>
								<div class="col-lg-10 col-md-10 col-sm-8 col-xs-7">
									<div class="form-group">
										<div class="form-line">
											<input type="number" id="balance" name="balance" class="form-control" readonly>
										</div>
									</div>
								</div>
							</div>

							<div class="row clearfix">
							 	<div class="modal-footer">
									<button type="submit" id="add_cash_advance" class="btn btn-link waves-effect">SAVE CHANGES</button>
									<button type="button" class="btn btn-link waves-effect" data-dismiss="modal">CLOSE</button>
								</div>
							</div>
						</form>
					</div>
				</div>
			</div>
		</div>
	</div>

    <!-- View Person Cash Advances Modal -->
    <div class="modal fade" id="ca_view_modal" tabindex="-1" role="dialog">
		<div class="modal-dialog modal-lg" role="document">


                            <div class="row">
                                 <form class="form-horizontal " id="ca_view_form">

                                    <div class="card">
                                        <div class="header">
                                            <h2> Cash Advance - <span class="modal_title_ca"></span> as of {{ date('Y-m-d ') }}</h2>
                                        </div>
                                        <div class="body">
                                            <div class="table-responsive">
                                                <table id="view_cash_advancetable" class="table table-bordered table-striped table-hover" style="width: 100%;">
                                                    <thead>
                                                        <tr>
                                                            <th>Reason</th>
                                                            <th>Amount</th>
                                                            <th>Date/Time</th>
                                                            <th>Balance</th>
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
					<h2>List of cash advances as of {{ date('Y-m-d ') }}</h2>
						<ul class="header-dropdown m-r--5">
							<li class="dropdown">
								<button type="button" class="btn bg-grey btn-xs waves-effect m-r-20 open_ca_modal"><i class="material-icons">library_add</i></button>
							</li>
						</ul>
					</div>
					<div class="body">
						<div class="table-responsive">
							<table id="cash_advancetable" class="table table-bordered table-striped table-hover" style="width: 100%;">
								<thead>
									<tr>
										<th>Name</th>
										<th>Recent Amount</th>
										<th>Latest Date/Time</th>
										<th>Total Balance</th>
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
        $(document).on("click","#link",function(){
            $("#bod").toggleClass('overlay-open');
        });

        $(document).ready(function() {

            $.extend( $.fn.dataTable.defaults, {
                "language": {
                    processing: 'Loading.. Please wait'
                }
            });

            //CASH ADVANCE datatable starts here
            $('#ca_modal').on('hidden.bs.modal', function (e) {
				$(this)
				.find("input,textarea,select")
					.val('')
					.end()
				.find("input[type=checkbox], input[type=radio]")
					.prop("checked", "")
					.end();
			})

            var cash_advancetable = $('#cash_advancetable').DataTable({
				dom: 'Bfrtip',
				buttons: [
				],
				processing: true,
				serverSide: true,
				ajax: "{{ route('refresh_cashadvance') }}",
				columns: [
					{render: function(data, type, full, meta){
                        return full.fname +" "+full.mname+" "+full.lname;
                    }},
					{data: 'amount', name: 'amount'},
					{data: 'created_at', name: 'created_at'},
					{data: 'balance', name: 'balance'},
					{data: "action", orderable:false,searchable:false}
				]
			});

            function refresh_cash_advance_table(){
				cash_advancetable.ajax.reload(); //reload datatable ajax
			}

            $(document).on('click','.open_ca_modal', function(){
                $("#customer_id").val('').trigger('change');
                $("#reason").val('').trigger('change');
                $("#amount").val('').trigger('change');
                $("#balance").val('').trigger('change');
                $('#ca_modal').modal('show');
			});

            //check balance of customer
            $('#customer_id').change(function(){
                var id = $(this).val();
                $.ajax({
                    url:"{{ route('check_balance') }}",
                    method: 'get',
                    data:{id:id},
                    dataType:'json',
                    success:function(data){
                        console.log(data);
                        if(!$.trim(data)){
                            $('#balance').val(0.00);
                        }
                        else{
                            $('#balance').val(data[0].balance);
                        }
                    }
                })
            });

            $("#add_cash_advance").click(function(event){
                event.preventDefault();
                $.ajax({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    url: "{{ route('add_cashadvance') }}",
                    method: 'POST',
                    dataType: 'text',
                    data: $('#ca_form').serialize(),
                    success:function(data){
                        $("#customer_id").val('').trigger('change');
                        $("#reason").val('').trigger('change');
                        $("#amount").val('').trigger('change');
                        $("#balance").val('').trigger('change');
                        swal("Success!", "Record has been added to database", "success");
						$('#ca_modal').modal('hide');
						refresh_cash_advance_table();
                    },
                    error: function(data){
						swal("Oh no!", "Something went wrong, try again.", "error");
					}
                });
            });

            $(document).on('click', '.view_cash_advance', function(){
                var id = $(this).attr("id");

                //Datatable for each person
                $.ajax({
                    url: "{{ route('refresh_view_cashadvance') }}",
                    method: 'get',
                    data:{id:id},
                    dataType: 'json',
                    success:function(data){
                        $('.modal_title_ca').text(data.data[0].fname + " " + data.data[0].mname + " " + data.data[0].lname);

                        $('#view_cash_advancetable').DataTable({
                            dom: 'Bfrtip',
                            bDestroy: true,
                            buttons: [
                            ],
                            data: data.data,
                            columns:[
                                {data: 'reason', name: 'reason'},
                                {data: 'amount', name: 'amount'},
                                {data: 'created_at', name: 'created_at'},
                                {data: 'balance', name: 'balance'},
                            ]
                        });
                        $('#ca_view_modal').modal('show');
                    }
                });
            });
            //CASH ADVANCE datatable ends here

            $('#customer_id').select2({
               dropdownParent: $('#ca_modal'),
               placeholder: 'Select a customer'
            });
        });
    </script>
@endsection
