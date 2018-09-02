@extends(isAdmin() ? 'layouts.admin' : 'layouts.user')

@section('content')

<div class="modal fade" id="balancemodal" tabindex="-1" role="dialog">
   <div class="modal-dialog" role="document">
         <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
             <div class="card">
                  <div class="header">
                       <h2 class="modal_title">Add Payment</h2>
                   <ul class="header-dropdown m-r--5">
                        <li class="dropdown">
                            <button id="print_balance_payment" type="button" class="btn bg-grey btn-xs waves-effect m-r-20" ><i class="material-icons">print</i></button>
                       </li>
                       <li class="dropdown">
                            <form method="POST" id="printBalanceForm" name="printBalanceForm" target="_blank" action="{{ route('print_balance_payment') }}">
                            <input type="hidden" id="customer_id1_clone" name="customer_id1_clone">
                            <input type="hidden" id="paymentmethod_clone" name="paymentmethod_clone">
                            <input type="hidden" id="checknumber_clone" name="checknumber_clone">
                            <input type="hidden" id="amount1_clone" name="amount1_clone">
                            <input type="hidden" id="balance2_clone" name="balance2_clone">
                            <button class="btn btn-sm btn-icon print-icon" type="submit" name="print_balance_form" id="print_balance_form" title="PRINT ONLY"><i class="glyphicon glyphicon-print"></i></button>
                            </form>
                       </li>
                   </ul>
                  </div>
                  <div class="body">
                       <form class="form-horizontal " id="balanceform">
                            <input type="hidden" name="id" id="id" value="">
                            <input type="hidden" name="button_action" id="button_action" value="">

                            <div class="row clearfix">
                                  <div class="col-lg-2 col-md-2 col-sm-4 col-xs-5 form-control-label">
                                       <label for="name">Name</label>
                                  </div>
                                  <div class="col-lg-10 col-md-10 col-sm-8 col-xs-7">
                                       <div class="form-group">
                                            <div id="c1" class="form-line">
                                                 <select type="text" id="customer_id1" name="customer_id1" class="form-control" required style="width: 100%;">
                                            @foreach($customer as $a)

                                            <option value="{{ $a->id }}">{{ $a->lname.", ".$a->fname." ".$a->mname}}</option>
                                            @endforeach
                                        </select>
                                            </div>
                                       </div>
                                  </div>
                            </div>

                            <div class="row clearfix">
                                <div class="col-lg-2 col-md-2 col-sm-4 col-xs-5 form-control-label">
                                     <label for="name">Payment Method</label>
                                </div>
                                <div class="col-lg-10 col-md-10 col-sm-8 col-xs-7">
                                     <div class="form-group">
                                          <div id="pm" class="form-line">
                                               <select type="text" id="paymentmethod" name="paymentmethod" class="form-control" required style="width: 100%;">

                                          <option value="Cash">Cash</option>
                                           <option value="Check">Check</option>
                                       </select>
                                          </div>
                                     </div>
                                </div>
                          </div>

                          <div id="cn" class="row clearfix hidden">
                                    <div class="col-lg-2 col-md-2 col-sm-4 col-xs-5 form-control-label">
                                         <label for="name">Check Number</label>
                                    </div>
                                    <div class="col-lg-10 col-md-10 col-sm-8 col-xs-7">
                                         <div class="form-group">
                                              <div class="form-line">
                                                   <input type="text" id="checknumber"  name="checknumber" class="form-control" >
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
                                                 <input type="number" id="amount1" min="0" name="amount1" class="form-control" required>
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
                                                 <input type="number" id="balance2" name="balance2" readonly="readonly" class="form-control" readonly>
                                            </div>
                                       </div>
                                  </div>
                            </div>

                            <div class="row clearfix">
                                  <div class="modal-footer">
                                       <button type="submit" id="add_balance" class="btn btn-link waves-effect">SAVE CHANGES</button>
                                       <button type="button" class="btn btn-link waves-effect" data-dismiss="modal">CLOSE</button>
                                  </div>
                            </div>
                       </form>
                  </div>
             </div>
         </div>
   </div>
</div>

<div class="modal fade" id="ca_modal" tabindex="-1" role="dialog">
      <div class="modal-dialog" role="document">
          <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
               <div class="card">
                     <div class="header">
                          <h2 class="modal_title">Add Cash Advance</h2>
                   <ul class="header-dropdown m-r--5">
                       <li class="dropdown">
                            <button id="print_ca" type="button" class="btn bg-grey btn-xs waves-effect m-r-20" ><i class="material-icons">print</i></button>
                       </li>
                       <li class="dropdown">
                            <form method="POST" id="printForm" name="printForm" target="_blank" action="{{ route('print_ca') }}">
                            <input type="hidden" id="customer_id_clone" name="customer_id_clone">
                            <input type="hidden" id="reason_clone" name="reason_clone">
                            <input type="hidden" id="amount_clone" name="amount_clone">
                            <input type="hidden" id="balance_clone" name="balance_clone">
                            <button class="btn btn-sm btn-icon print-icon" type="submit" name="print_form" id="print_form" title="PRINT ONLY"><i class="glyphicon glyphicon-print"></i></button>
                            </form>
                       </li>
                   </ul>
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
                                              <div id="c" class="form-line">
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


<div class="modal fade" id="ca_view_modal" tabindex="-1" role="dialog">
      <div class="modal-dialog modal-lg" role="document">
        <div class="row">            
              <div class="card">
                   <div class="header">
                       <h2> Cash Advance - <span class="modal_title_ca"></span> as of {{ date('Y-m-d ') }}</h2>
                   </div>
                   <div class="body">
                       <div class="table-responsive">
                       <br>
                            <table id="view_cash_advancetable" class="table table-bordered table-striped table-hover" style="width: 100%;">
                               <thead>
                                    <tr>
                                        <th>Reason</th>
                                        <th>Amount</th>
                                        <th>Date/Time</th>
                                        <th>Balance</th>
                                        <th>Status</th>
                                        <th>Released By</th>
                                        <th>Releasing</th>
                                    </tr>
                               </thead>
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

 <div class="modal fade" id="balance_view_modal" tabindex="-1" role="dialog">
       <div class="modal-dialog modal-lg" role="document">
         <div class="row">
             <form class="form-horizontal " id="ca_view_form">
                <div class="card">
                    <div class="header">
                        <h2> Payment History <span class="modal_title_balance"></span> as of {{ date('Y-m-d ') }}</h2>
                    </div>
                    <div class="body">
                        <div class="table-responsive">
                        <br>
                             <table id="view_balancetable" class="table table-bordered table-striped table-hover" style="width: 100%;">
                                <thead>
                                     <tr>
                                          <th>Date</th>
                                         <th>Amount</th>
                                         <th>Payment Method</th>
                                          <th>Check Number</th>
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
    <div class="container-fluid">
         <ul class="nav nav-tabs">
           <li id="ca1" class="active"><a id="cahref"  data-toggle="tab"  href="#cashadvance1"><div class="block-header">
               <h2>Cash Advance</h2>
           </div></a> </li>
           <li id="bal1"><a id="balancehref"  data-toggle="tab"  href="#balance1"><div class="block-header">
               <h2>Balances</h2>
           </div></a></li>
         </ul>



<div class="tab-content">
    <!-- Add Cash Advance Modal -->
    <div id="cashadvance1"  class="tab-pane fade in active">
    <!-- View Person Cash Advances Modal -->
    <div class="row clearfix">
		<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
			<div class="card">
				<div class="header">
					<h2>List of cash advances as of {{ date('Y-m-d ') }}</h2>
						<ul class="header-dropdown m-r--5">
							<li class="dropdown">
								@if(isAdmin())
                                <button type="button" class="btn bg-grey btn-xs waves-effect m-r-20 open_ca_modal"><i class="material-icons">library_add</i></button>
                                @endif()
                            </li>
						</ul>
					</div>
					<div class="body">
						<div class="table-responsive">
                        <br>
							<table id="cash_advancetable" class="table table-bordered table-striped table-hover" style="width: 100%;">
								<thead>
									<tr>
                                        <th>Name</th>
                                        <th>Recent Amount</th>
                                        <th>Latest Date/Time</th>
                                        <th>Total Balance</th>
                                        <th width="90">View History</th>
									</tr>
								</thead>
							</table>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>

     <div id="balance1" class="tab-pane fade in">


     <div class="row clearfix">
         <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
              <div class="card">
                   <div class="header">
                        <h2>List of Customer Balance as of {{ date('Y-m-d ') }}</h2>
                             <ul class="header-dropdown m-r--5">
                                  <li class="dropdown">
                                       <button type="button" id="balancebutton" class="btn bg-grey btn-xs waves-effect m-r-20 open_balancemodal"><i class="material-icons">chrome_reader_mode</i></button>
                                  </li>
                             </ul>
                        </div>
                        <div class="body">
                             <div class="table-responsive">
                             <br>
                                  <table id="balancetable" class="table table-bordered table-striped table-hover" style="width: 100%;">
                                       <thead>
                                            <tr>
                                                <th>Name</th>
                                                <th>Total Balance</th>
                                                <th width="90">Action</th>
                                            </tr>
                                       </thead>
                                  </table>
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
        $(document).on("click","#link",function(){
            $("#bod").toggleClass('overlay-open');
        });

        $(document).ready(function() {

        document.title = "M-Agri - Cash Advance";

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
                    'print'
				],
				processing: true,
				serverSide: true,
                columnDefs: [
  				{
    			  	"targets": "_all", // your case first column
     				"className": "text-center",
      				
 				}
				],
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

               var balancetable = $('#balancetable').DataTable({
                       dom: 'Bfrtip',
                       buttons: [
                            'print'
                       ],
                       processing: true,
                       serverSide: true,
                       columnDefs: [
                  				{
                    			  	"targets": "_all", // your case first column
                     				"className": "text-center",
                      				
                 				}
                				],
                       ajax: "{{ route('refresh_balancedt') }}",
                       columns: [
                            {data:'fname',
                                render: function(data, type, full, meta){
                                     return full.fname +" "+ full.mname+" "+full.lname;
                                }
                           },
                            {data: 'balance', name: 'balance'},
                            {data: "action", orderable:false,searchable:false}
                       ]
                  });

            function refresh_cash_advance_table(){
				cash_advancetable.ajax.reload(); //reload datatable ajax
			}
               function refresh_balance_table(){
   				balancetable.ajax.reload(); //reload datatable ajax
   			}
               $("#balancehref").on('click', function() {
                    refresh_balance_table();
               });
               $("#cahref").on('click', function() {
                    refresh_cash_advance_table();
               });

            $(document).on('click','.open_ca_modal', function(){
                 $('#c').removeClass('focused');
                $("#customer_id").val('').trigger('change');
                $("#reason").val('').trigger('change');
                $("#amount").val('').trigger('change');
                $("#balance").val('').trigger('change');
                $('#ca_modal').modal('show');
			});

               $(document).on('click','.open_balancemodal', function(){
                    $('#pm').removeClass('focused');
                    $('#c1').removeClass('focused');
                   $("#customer_id1").val('').trigger('change');
                   $("#paymentmethod").val('').trigger('change');
                   $("#reason").val('').trigger('change');
                   $("#amount").val('').trigger('change');
                   $("#balance").val('').trigger('change');
                   $('#balancemodal').modal('show');
   			});


               //check balance of customer
               $('#customer_id1').change(function(){
                   var id = $(this).val();
                   $.ajax({
                       url:"{{ route('check_balance') }}",
                       method: 'get',
                       data:{id:id},
                       dataType:'json',
                       success:function(data){
                           console.log(data);
                           if(!$.trim(data)){
                              $('#balance2').val(0.00);
                           }
                           else{
                              $('#balance2').val(data[0].balance);
                           }
                       }
                   })
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
            var x ;
            $('#paymentmethod').change(function(){
              x = $("#paymentmethod").val();
              if(x=="Check"){
                  $('#cn').removeClass('hidden');
              }
              else{
                   $('#cn').val('');
                    $('#cn').addClass('hidden');
              }
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

            $("#add_balance").click(function(event){
               event.preventDefault();
               $.ajax({
                   headers: {
                       'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                   },
                   url: "{{ route('add_payment') }}",
                   method: 'POST',
                   dataType: 'text',
                   data: $('#balanceform').serialize(),
                   success:function(data){
                       $("#customer_id1").val('').trigger('change');
                        $("#paymentmethod").val('').trigger('change');
                       $("#amount1").val('');
                        $("#checknumber").val('');
                       $("#balance2").val('');
                       swal("Success!", "Record has been added to database", "success");
                            $('#balancemodal').modal('hide');
                            refresh_balance_table();
                   },
                   error: function(data){
                            swal("Oh no!", "Something went wrong, try again.", "error");
                       }
               });
           });

            $("#print_ca").click(function(event) {
                event.preventDefault();
                $("#add_cash_advance").trigger("click");
                $("#print_form").trigger("click");
            });

            $("#print_form").click(function(event) {
                $("#customer_id_clone").val($("#customer_id option:selected").text());
                $("#reason_clone").val($("#reason").val());
                $("#amount_clone").val($("#amount").val());
                $("#balance_clone").val($("#balance").val());
            });

            $("#print_balance_payment").click(function(event) {
                event.preventDefault();
                $("#add_balance").trigger("click");
                $("#print_balance_form").trigger("click");
            });

            $("#print_balance_form").click(function(event) {
                $("#customer_id1_clone").val($("#customer_id1 option:selected").text());
                $("#paymentmethod_clone").val($("#paymentmethod option:selected").text());
                $("#checknumber_clone").val($("#checknumber").val());
                $("#amount1_clone").val($("#amount1").val());
                $("#balance2_clone").val($("#balance2").val());
            });

            $(document).on('click', '.view_balance', function(){

               var id = $(this).attr("id");

               //Datatable for each person
               $.ajax({
                   url: "{{ route('balancelogs') }}",
                   method: 'get',
                   data:{id:id},
                   dataType: 'json',
                   success:function(data){
                        $('#view_balancetable').DataTable({
                           dom: 'Bfrtip',
                           order: [[ 0, "desc" ]],
                           bDestroy: true,
                           buttons: [
                                'print'
                           ],
                           data: data.data,
                           columns:[
                              {data: 'created_at', name: 'created_at'},
                              {data: 'paymentamount', name: 'paymentamount'},
                              {data: 'paymentmethod', name: 'paymentmethod'},
                              {data: 'checknumber', name: 'checknumber'},
                           ]
                       });
                       $('#balance_view_modal').modal('show');
                   }
               });
           });
            var person_id;
            var id;
            var cash_advance_release;
            $(document).on('click', '.view_cash_advance', function(){
                 person_id = $(this).attr("id");

                //Datatable for each person
                $.ajax({
                    url: "{{ route('refresh_view_cashadvance') }}",
                    method: 'get',
                    data:{id:person_id},
                    dataType: 'json',
                    success:function(data){
                      console.log(data);
                        $('.modal_title_ca').text(data.data[0].fname + " " + data.data[0].mname + " " + data.data[0].lname);

                       cash_advance_release =  $('#view_cash_advancetable').DataTable({
                            dom: 'Bfrtip',
                              order: [[ 2, "desc" ]],
                            bDestroy: true,
                            buttons: [
                                'print'
                            ],
                            data: data.data,
                            columns:[
                                {data: 'reason', name: 'reason'},
                                {data: 'amount', name: 'amount'},
                                {data: 'created_at', name: 'created_at'},
                                {data: 'balance', name: 'balance'},
                                {data: 'status', name: 'status'},
                                {data: 'released_by', name: 'released_by'},
                                {data: "action", orderable:false,searchable:false}
                            ]
                        }); 
                        $('#ca_view_modal').modal('show');
                    }
                });
            });
            //CASH ADVANCE datatable ends here

            $(document).on('click', '.release_ca', function(event){
                event.preventDefault();
                id = $(this).attr("id");
                $.ajax({
                    url:"{{ route('check_balance4') }}",
                    method: 'POST',
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    data:{id:id},
                    dataType:'json',
                    success:function(data){
                        console.log(data);
                        if(data == 0){
                            swal("Insufficient Balance!", "Contact Boss", "warning")
                            return;
                        }
                        else{
                            $.ajax({
                                url:"{{ route('release_ca') }}",
                                method: 'POST',
                                headers: {
                                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                                },
                                data:{id:id},
                                dataType:'json',
                                success:function(data){
                                    $.ajax({
                                        url: "{{ route('refresh_view_dtr') }}",
                                        method: 'get',
                                        data:{id:id},
                                        dataType: 'json',
                                        success:function(data){
                                            $('#view_cash_advancetable').DataTable().destroy();
                                            $.ajax({
                                                url: "{{ route('refresh_view_cashadvance') }}",
                                                method: 'get',
                                                data:{id:person_id},
                                                dataType: 'json',
                                                success:function(data){
                                                
                                                    $('.modal_title_ca').text(data.data[0].fname + " " + data.data[0].mname + " " + data.data[0].lname);

                                                    cash_advance_release =  $('#view_cash_advancetable').DataTable({
                                                        dom: 'Bfrtip',
                                                            order: [[ 2, "desc" ]],
                                                        bDestroy: true,

                                                        buttons: [
                                                            'print'
                                                        ],
                                                        columnDefs: [
                                                            {
                                                                "targets": "_all", // your case first column
                                                            "className": "text-left",
                                                                
                                                        }
                                                        ],
                                                        data: data.data,
                                                        columns:[
                                                            {data: 'reason', name: 'reason'},
                                                            {data: 'amount', name: 'amount'},
                                                            {data: 'created_at', name: 'created_at'},
                                                            {data: 'balance', name: 'balance'},
                                                            {data: 'status', name: 'status'},
                                                            {data: 'released_by', name: 'released_by'},
                                                            {data: "action", orderable:false,searchable:false}
                                                        ]
                                                    }); 
                                                }
                                            });    
                                        }
                                    });
                                    swal("Cash Released!", "Remaining Balance: ₱"+data.toFixed(2), "success");
                                    $('#curCashOnHand').html(data.toFixed(2));
                                }
                            })
                        }
                    }
                })
                
            });

            $('#customer_id').select2({
               dropdownParent: $('#ca_modal'),
               placeholder: 'Select a customer'
            });

            $('#customer_id1').select2({
              dropdownParent: $('#balancemodal'),
              placeholder: 'Select a customer'
          });
          $('#paymentmethod').select2({
          dropdownParent: $('#balancemodal'),
          placeholder: 'Select a type of payment'
       });
        });
    </script>
@endsection
