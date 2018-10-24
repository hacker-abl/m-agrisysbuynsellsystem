@extends(isAdmin() ? 'layouts.admin' : 'layouts.user')

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
                        <ul class="header-dropdown m-r--5">
                            <li class="dropdown">
                                <button id="print_dtr" type="button" class="btn bg-grey btn-xs waves-effect m-r-20" ><i class="material-icons">print</i></button>
                            </li>
                            <li class="dropdown">
                                <form method="POST" id="printForm" name="printForm" target="_blank" action="{{ route('print_dtr') }}">
                                <input type="hidden" id="employee_id_clone" name="employee_id_clone">
                                <input type="hidden" id="role_clone" name="role_clone">
                                <input type="hidden" id="overtime_clone" name="overtime_clone">
                                <input type="hidden" id="rate_clone" name="rate_clone">
                                <input type="hidden" id="num_hours_clone" name="num_hours_clone">
                                <input type="hidden" id="salary_clone" name="salary_clone">
                                <button class="btn btn-sm btn-icon print-icon" type="submit" name="print_form" id="print_form" title="PRINT ONLY"><i class="glyphicon glyphicon-print"></i></button>
                                </form>
                            </li>
                        </ul>
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
                 
                    <div class="card">
                        <div class="header">
                            <h2> Daily Time Records History - <span class="modal_title_dtr"></span></h2>
                        </div>
                        <div class="body">
                            <div class="table-responsive">
                            <br>
                                <table id="view_dtr_table" class="table table-bordered table-striped table-hover" style="width: 100%;">
                                    <thead>
                                        <tr>
                                            <th>Overtime</th>
                                            <th>Number of Hours</th>
                                            <th>Date/Time</th>
                                            <th>Salary</th>
                                            <th>Status</th>
                                            <th>Released By</th>
                                            <th>Releasing</th>
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
                            <div class="modal-footer">
                                    <button type="button" class="btn btn-link waves-effect" data-dismiss="modal">CLOSE</button>
                            </div>
                        </div>
                    </div>
             
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
                                @if(isAdmin())
								<button type="button" class="btn bg-grey btn-xs waves-effect m-r-20 open_dtr_modal"><i class="material-icons">library_add</i></button>
                                @endif
                            </li>
						</ul>
					</div>
					<div class="body">
						<div class="table-responsive">
                        <br>
							<table id="dtr_table" class="table table-bordered table-striped table-hover" style="width: 100%;">
								<thead>
									<tr>
										<th width="100" style="text-align:center;">Name</th>
                                        <th width="100" style="text-align:center;">mname</th>
                                        <th width="100" style="text-align:center;">lname</th>
										<th width="100" style="text-align:center;">Role</th>
										<th width="100" style="text-align:center;">Overtime</th>
										<th width="100" style="text-align:center;">No. of Hours</th>
                                        <th width="100" style="text-align:center;">Date/Time</th>
                                        <th width="100" style="text-align:center;">Salary</th>
                                        <th width="100" style="text-align:center;">Status</th>
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
                                        </tr>
                                    </tfoot>
							</table>
						</div>
					</div>
				</div>
			</div>
		</div>
        <div class="modal fade" id="release_modal_dtr" tabindex="-1" role="dialog">
        <div class="modal-dialog" role="document">
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                <div class="card">
                    <div class="header">
                        <h2>Are You Sure?</h2>
                    </div>
                    <div class="body">
                        <div class="row clearfix">
                            <div class="modal-footer">
                                <button type="button" id="release_money_dtr" class="btn btn-success waves-effect">CONTINUE</button>
                                <button type="button" class="btn btn-link waves-effect" data-dismiss="modal">CLOSE</button>
                            </div>
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
    var overtime;
    var salary;
    var id;
    var dtr_info;
    var person_id;
	var fname;
	var lname;
	var mname;
	var idmain
	var total;
	var role;
        $(document).on("click","#link",function(){
            $("#bod").toggleClass('overlay-open');
        });

        $(document).ready(function() {

            document.title = "M-Agri - Daily Time Record";

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

            function number_format(number, decimals, dec_point, thousands_sep) {
                // Strip all characters but numerical ones.
                number = (number + '').replace(/[^0-9+\-Ee.]/g, '');
                var n = !isFinite(+number) ? 0 : +number,
                    prec = !isFinite(+decimals) ? 0 : Math.abs(decimals),
                    sep = (typeof thousands_sep === 'undefined') ? ',' : thousands_sep,
                    dec = (typeof dec_point === 'undefined') ? '.' : dec_point,
                    s = '',
                    toFixedFix = function (n, prec) {
                        var k = Math.pow(10, prec);
                        return '' + Math.round(n * k) / k;
                    };
                // Fix for IE parseFloat(0.55).toFixed(0) = 0;
                s = (prec ? toFixedFix(n, prec) : '' + Math.round(n)).split('.');
                if (s[0].length > 3) {
                    s[0] = s[0].replace(/\B(?=(?:\d{3})+(?!\d))/g, sep);
                }
                if ((s[1] || '').length < prec) {
                    s[1] = s[1] || '';
                    s[1] += new Array(prec - s[1].length + 1).join('0');
                }
                return s.join(dec);
            }

            var dtr = $('#dtr_table').DataTable({
                "footerCallback": function ( row, data, start, end, display ) {
                    var api = this.api(), data;
         
                    // Remove the formatting to get integer data for summation
                    var intVal = function ( i ) {
                        return typeof i === 'string' ?
                            i.replace(/[\₱,]/g, '')*1 :
                            typeof i === 'number' ?
                                i : 0;
                    };
         
                    // Total over all pages
                    total = api
                        .column( 7 )
                        .data()
                        .reduce( function (a, b) {
                            return intVal(a) + intVal(b);
                        }, 0 );
         
                    // Total over this page
                    pageTotal = api
                        .column( 7, { page: 'current'} )
                        .data()
                        .reduce( function (a, b) {
                            return intVal(a) + intVal(b);
                        }, 0 );
         
                    // Update footer
                    $( api.column( 7 ).footer() ).html(
                        'Total: <br>₱' + number_format(pageTotal,2)
                    );
                },
				dom: 'Bfrtip',
				buttons: [
                    {
                        extend: 'print',
                        exportOptions: {
                            columns: [ 0, 1, 2, 3, 4, 5, 6 ]
                        },
                        customize: function ( win ) {
                            $(win.document.body)
                                .css( 'font-size', '10pt' );
         
                            $(win.document.body).find( 'table' )
                                .addClass( 'compact' )
                                .css( 'font-size', 'inherit' );
                        },
                        footer: true
                    }
                ],
				processing: true,
                columnDefs: [
  				{
    			  	"targets": "_all", // your case first column
     				"className": "text-center",

 				}
				],
			
				ajax: "{{ route('refresh_dtr') }}",
				columns: [
					{data:'wholename', name: 'employee.fname'},
                    {data:'mname', name: 'employee.mname',visible:false  },
                    {data:'lname', name: 'employee.lname',visible:false  },
					{data: 'role', name: 'role'},
                    {data: 'overtime', name: 'overtime'},
                    {data: 'num_hours', name: 'num_hours'},
					{data: 'created_at', name: 'created_at',
				   type: "date",
					 render:function (value) {
						   var ts = new Date(value);

						  return ts.toDateString()+" "+ts.toLocaleTimeString()}
					},
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
            });
            
            $('#num_hours').change(function(){

                overtime=parseFloat($('#overtime').val())+parseFloat($('#num_hours').val());

                $('#salary').val(overtime*salary);
            });

            $(document).on('click', '.release_expense_dtr', function(event){
                event.preventDefault();
                id = $(this).attr("id");
                $.ajax({
                    url:"{{ route('check_balance5') }}",
                    method: 'POST',
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    data:{id:id},
                    dataType:'json',
                    success:function(data){
                        if(data == 0){
                            swal("Insufficient Balance!", "Contact Boss", "warning")
                            return;
                        }
                        else{
                            $.ajax({
                                url:"{{ route('release_update_dtr') }}",
                                method: 'POST',
                                headers: {
                                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                                },
                                data:{id:id},
                                dataType:'json',
                                success:function(data){
                                    var total="";
                                    $.ajax({
                                        url: "/refresh_view_total",
                                        method: 'get',
                                        data:{id:idmain},
                                        dataType: 'json',
                                        success:function(data){
                                            total = addCommas(data);
                                            $('.modal_title_dtr').text(fname + " " + mname + " " + lname + " ("+role + ") Pending Salary: ₱"+total);

                                        }
                                    });
                                    $.ajax({
                                        url: "{{ route('refresh_view_dtr') }}",
                                        method: 'get',
                                        data:{id:person_id},
                                        dataType: 'json',
                                        success:function(data){
                                            dtr_info= $('#view_dtr_table').DataTable({
                                                "footerCallback": function ( row, data, start, end, display ) {
                                                    var api = this.api(), data;
                                         
                                                    // Remove the formatting to get integer data for summation
                                                    var intVal = function ( i ) {
                                                        return typeof i === 'string' ?
                                                            i.replace(/[\₱,]/g, '')*1 :
                                                            typeof i === 'number' ?
                                                                i : 0;
                                                    };
                                         
                                                    // Total over all pages
                                                    total = api
                                                        .column( 3 )
                                                        .data()
                                                        .reduce( function (a, b) {
                                                            return intVal(a) + intVal(b);
                                                        }, 0 );
                                         
                                                    // Total over this page
                                                    pageTotal = api
                                                        .column( 3, { page: 'current'} )
                                                        .data()
                                                        .reduce( function (a, b) {
                                                            return intVal(a) + intVal(b);
                                                        }, 0 );
                                         
                                                    // Update footer
                                                    $( api.column( 3 ).footer() ).html(
                                                        'Total: <br>₱' + number_format(pageTotal,2)
                                                    );
                                                },
                                                dom: 'Bfrtip',
                                                bDestroy: true,
                                                buttons: [
                                                    {
                                                        extend: 'print',
                                                        exportOptions: {
                                                            columns: [ 0, 1, 2, 3, 4, 5 ]
                                                        },
                                                        customize: function ( win ) {
                                                            $(win.document.body)
                                                                .css( 'font-size', '10pt' );
                                         
                                                            $(win.document.body).find( 'table' )
                                                                .addClass( 'compact' )
                                                                .css( 'font-size', 'inherit' );
                                                        },
                                                        footer: true
                                                    }
                                                ],
                                                columnDefs: [
                                                {
                                                    "targets": "_all", // your case first column
                                                    "className": "text-center",

                                                }
                                                ],
                                                data: data.data,
                                                columns:[
                                                    {data: 'overtime', name: 'overtime'},
                                                    {data: 'num_hours', name: 'num_hours'},
                                                    {data: 'created_at', name: 'created_at',
                                                        type: "date",
                                                        render:function (value) {
                                                            var ts = new Date(value);

                                                            return ts.toDateString()+" "+ts.toLocaleTimeString()}
                                                    },
                                                    {data: 'salary', name: 'salary'},
                                                    {data: 'status', name: 'status'},
                                                    {data: 'released_by', name: 'released_by'},
                                                    {data: "action", orderable:false,searchable:false}
                                                ]
                                            });

                                            dtr.ajax.reload();
                                        }
                                        });
                                        swal("Cash Released!", "Remaining Balance: ₱"+data.cashOnHand.toFixed(2)+" | Transaction ID: "+data.cashHistory, "success")
                                        $('#curCashOnHand').html(data.cashOnHand.toFixed(2));
                                    }
                            });
                        }
                    }
                })
                
            });
            $("#add_dtr").click(function(event){
                var input = $(this);
                var button =this;
                button.disabled = true;
                input.html('SAVING...');    
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
                         if(dataparsed.updated=="updated"){
                                        $('#dtr_view_modal').modal('show');
                                    }
                        $("#id").val(dataparsed.details[0].id);
                        $('#dtr_modal').modal('hide');
                        $.ajax({
                                        url: "{{ route('refresh_view_dtr') }}",
                                        method: 'get',
                                        data:{id:person_id},
                                        dataType: 'json',
                                        success:function(data){
                                        dtr_info= $('#view_dtr_table').DataTable({
                                                "footerCallback": function ( row, data, start, end, display ) {
                                                    var api = this.api(), data;
                                         
                                                    // Remove the formatting to get integer data for summation
                                                    var intVal = function ( i ) {
                                                        return typeof i === 'string' ?
                                                            i.replace(/[\₱,]/g, '')*1 :
                                                            typeof i === 'number' ?
                                                                i : 0;
                                                    };
                                         
                                                    // Total over all pages
                                                    total = api
                                                        .column( 3 )
                                                        .data()
                                                        .reduce( function (a, b) {
                                                            return intVal(a) + intVal(b);
                                                        }, 0 );
                                         
                                                    // Total over this page
                                                    pageTotal = api
                                                        .column( 3, { page: 'current'} )
                                                        .data()
                                                        .reduce( function (a, b) {
                                                            return intVal(a) + intVal(b);
                                                        }, 0 );
                                         
                                                    // Update footer
                                                    $( api.column( 3 ).footer() ).html(
                                                        'Total: <br>₱' + number_format(pageTotal,2)
                                                    );
                                                },
                                                dom: 'Bfrtip',
                                                bDestroy: true,
                                                buttons: [
                                                    {
                                                        extend: 'print',
                                                        exportOptions: {
                                                            columns: [ 0, 1, 2, 3, 4, 5 ]
                                                        },
                                                        customize: function ( win ) {
                                                            $(win.document.body)
                                                                .css( 'font-size', '10pt' );
                                         
                                                            $(win.document.body).find( 'table' )
                                                                .addClass( 'compact' )
                                                                .css( 'font-size', 'inherit' );
                                                        },
                                                        footer: true
                                                    }
                                                ],
                                                columnDefs: [
                                            {
                                                "targets": "_all", // your case first column
                                                "className": "text-center",

                                            }
                                            ],
                                                data: data.data,
                                                columns:[
                                                    {data: 'overtime', name: 'overtime'},
                                                    {data: 'num_hours', name: 'num_hours'},
                                                    {data: 'created_at', name: 'created_at',
                                                type: "date",
                                                    render:function (value) {
                                                        var ts = new Date(value);

                                                        return ts.toDateString()+" "+ts.toLocaleTimeString()}
                                                    },
                                                    {data: 'salary', name: 'salary'},
                                                    {data: 'status', name: 'status'},
                                                    {data: 'released_by', name: 'released_by'},
                                                    {data: "action", orderable:false,searchable:false}
                                                ]
                                            });
                                            dtr.ajax.reload();
                                        }
                                    });
                               
                                  
                        swal("Success!", "Record has been added to database", "success");
                        button.disabled = false;
						refresh_dtr_table();
                    },
                    error: function(data){
						swal("Oh no!", "Something went wrong, try again.", "error");
                        button.disabled = false;
                        input.html('SAVE CHANGES');
					}
                });
            });

            $(document).on('click', '.update_dtr', function(event){
                 $('#dtr_view_modal').modal('hide'); 
                event.preventDefault();
                var id = $(this).attr("id");
                $.ajax({
                    url:"{{ route('update_dtr') }}",
                    method: 'get',
                    data:{id:id},
                    dataType:'json',
                    success:function(data){
                        $('#button_action').val('update');
                        $('#id').val(id);
                        $("#employee_id").val(data.employee_id).trigger('change');
                        $("#role").val(data.role).trigger('change');
                        $("#overtime").val(data.overtime).trigger('change');
                        $("#num_hours").val(data.num_hours).trigger('change');
                        $('#salary').val(data.salary).trigger('change');
                        $('#dtr_modal').modal('show');
                        $('.modal_title').text('Update DTR');
                        //refresh_expense_table();
                    }
                })
            });

            $(document).on('click', '.delete_dtr', function(event){
                event.preventDefault();
                var id = $(this).attr('id');
                swal({
                    title: "Are you sure?",
                    text: "Delete this record?",
                    type: "warning",
                    showCancelButton: true,
                    confirmButtonClass: "btn-danger",
                    confirmButtonText: "Yes, delete it!",
                    closeOnConfirm: false
                },
                function(){
                    $.ajax({
                        url:"{{ route('delete_dtr') }}",
                        method: "get",
                        data:{id:id},
                        success:function(data){
                             $.ajax({
                                        url: "{{ route('refresh_view_dtr') }}",
                                        method: 'get',
                                        data:{id:person_id},
                                        dataType: 'json',
                                        success:function(data){
                                        dtr_info= $('#view_dtr_table').DataTable({
                                                "footerCallback": function ( row, data, start, end, display ) {
                                                    var api = this.api(), data;
                                         
                                                    // Remove the formatting to get integer data for summation
                                                    var intVal = function ( i ) {
                                                        return typeof i === 'string' ?
                                                            i.replace(/[\₱,]/g, '')*1 :
                                                            typeof i === 'number' ?
                                                                i : 0;
                                                    };
                                         
                                                    // Total over all pages
                                                    total = api
                                                        .column( 3 )
                                                        .data()
                                                        .reduce( function (a, b) {
                                                            return intVal(a) + intVal(b);
                                                        }, 0 );
                                         
                                                    // Total over this page
                                                    pageTotal = api
                                                        .column( 3, { page: 'current'} )
                                                        .data()
                                                        .reduce( function (a, b) {
                                                            return intVal(a) + intVal(b);
                                                        }, 0 );
                                         
                                                    // Update footer
                                                    $( api.column( 3 ).footer() ).html(
                                                        'Total: <br>₱' + number_format(pageTotal,2)
                                                    );
                                                },
                                                dom: 'Bfrtip',
                                                bDestroy: true,
                                                buttons: [
                                                    {
                                                        extend: 'print',
                                                        exportOptions: {
                                                            columns: [ 0, 1, 2, 3, 4, 5 ]
                                                        },
                                                        customize: function ( win ) {
                                                            $(win.document.body)
                                                                .css( 'font-size', '10pt' );
                                         
                                                            $(win.document.body).find( 'table' )
                                                                .addClass( 'compact' )
                                                                .css( 'font-size', 'inherit' );
                                                        },
                                                        footer: true
                                                    }
                                                ],
                                                columnDefs: [
                                            {
                                                "targets": "_all", // your case first column
                                                "className": "text-center",

                                            }
                                            ],
                                                data: data.data,
                                                columns:[
                                                    {data: 'overtime', name: 'overtime'},
                                                    {data: 'num_hours', name: 'num_hours'},
                                                    {data: 'created_at', name: 'created_at',
                                                type: "date",
                                                    render:function (value) {
                                                        var ts = new Date(value);

                                                        return ts.toDateString()+" "+ts.toLocaleTimeString()}
                                                    },
                                                    {data: 'salary', name: 'salary'},
                                                    {data: 'status', name: 'status'},
                                                    {data: 'released_by', name: 'released_by'},
                                                    {data: "action", orderable:false,searchable:false}
                                                ]
                                            });
                                            dtr.ajax.reload();
                                        }
                                    });
                                refresh_dtr_table();
                                swal("Deleted!", "The record has been deleted.", "success");
                        }
                    })
                   
                });
            });

            $("#print_dtr").click(function(event) {
                event.preventDefault();
                $("#add_dtr").trigger("click");
                $("#print_form").trigger("click");
            });

            $("#print_form").click(function(event) {
                $("#employee_id_clone").val($("#employee_id option:selected").text());
                $("#role_clone").val($("#role").val());
                $("#overtime_clone").val($("#overtime").val());
                $("#rate_clone").val($("#rate").val());
                $("#num_hours_clone").val($("#num_hours").val());
                $("#salary_clone").val($("#salary").val());
            });
			function addCommas(nStr) {
    		nStr += '';
		    x = nStr.split('.');
		    x1 = x[0];
		    x2 = x.length > 1 ? '.' + x[1] : '';
		    var rgx = /(\d+)(\d{3})/;
    		while (rgx.test(x1)) {
        	x1 = x1.replace(rgx, '$1' + ',' + '$2');
    		}
		    return x1 + x2;
			}


            $(document).on('click', '.view_dtr', function(event){
                event.preventDefault(); 
                var id = $(this).attr("id");
				idmain = id;
                person_id=id;

				$.ajax({
					url: "/refresh_view_total",
					method: 'get',
					data:{id:id},
					dataType: 'json',
					success:function(data){
					    total =	addCommas(data);
					}
				});
                $.ajax({
                    url: "{{ route('refresh_view_dtr') }}",
                    method: 'get',
                    data:{id:id},
                    dataType: 'json',
                    success:function(data){
						fname = data.data[0].fname;
						mname = data.data[0].mname;
						lname = data.data[0].lname;
						role =  data.data[0].role;
                        $('.modal_title_dtr').text(data.data[0].fname + " " + data.data[0].mname + " " + data.data[0].lname + " ("+ data.data[0].role + ")  Pending Salary: ₱"+total);

                    dtr_info= $('#view_dtr_table').DataTable({
                            "footerCallback": function ( row, data, start, end, display ) {
                                var api = this.api(), data;
                     
                                // Remove the formatting to get integer data for summation
                                var intVal = function ( i ) {
                                    return typeof i === 'string' ?
                                        i.replace(/[\₱,]/g, '')*1 :
                                        typeof i === 'number' ?
                                            i : 0;
                                };
                     
                                // Total over all pages
                                total = api
                                    .column( 3 )
                                    .data()
                                    .reduce( function (a, b) {
                                        return intVal(a) + intVal(b);
                                    }, 0 );
                     
                                // Total over this page
                                pageTotal = api
                                    .column( 3, { page: 'current'} )
                                    .data()
                                    .reduce( function (a, b) {
                                        return intVal(a) + intVal(b);
                                    }, 0 );
                     
                                // Update footer
                                $( api.column( 3 ).footer() ).html(
                                    'Total: <br>₱' + number_format(pageTotal,2)
                                );
                            },
                            dom: 'Bfrtip',
                            bDestroy: true,
                            buttons: [
                                {
                                    extend: 'print',
                                    exportOptions: {
                                        columns: [ 0, 1, 2, 3, 4, 5 ]
                                    },
                                    customize: function ( win ) {
                                        $(win.document.body)
                                            .css( 'font-size', '10pt' );
                     
                                        $(win.document.body).find( 'table' )
                                            .addClass( 'compact' )
                                            .css( 'font-size', 'inherit' );
                                    },
                                    footer: true
                                }
                            ],
							columnDefs: [
						   {
							   "targets": "_all", // your case first column
							   "className": "text-center",

						   }
						   ],
                            data: data.data,
                            columns:[
                                {data: 'overtime', name: 'overtime'},
                                {data: 'num_hours', name: 'num_hours'},
								{data: 'created_at', name: 'created_at',
							   type: "date",
								 render:function (value) {
									   var ts = new Date(value);

									  return ts.toDateString()+" "+ts.toLocaleTimeString()}
								},
                                {data: 'salary', name: 'salary'},
                                {data: 'status', name: 'status'},
                                {data: 'released_by', name: 'released_by'},
                                {data: "action", orderable:false,searchable:false}
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
