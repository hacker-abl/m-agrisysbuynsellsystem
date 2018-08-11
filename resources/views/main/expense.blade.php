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
            <li class="active">
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
                <li>
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
     <ul class="nav nav-tabs">
        <li class="active"><a href="#expense_tab"><div class="block-header">
            <h2>Expense Dashboard</h2>
        </div></a></li>
        <li><a href="#trip_expense_tab"><div class="block-header">
            <h2>Trip Expenses Dashboard</h2>
        </div></a></li>
        <!--  <li><a href="#DTR_expense"><div class="block-header">
            <h2>DTR Expenses Dashboard</h2>
        </div></a></li> -->
      </ul>

   <div class="tab-content">
    <div id="expense_tab" class="tab-pane fade in active">
    <div class="modal fade" id="expense_modal" tabindex="-1" role="dialog">
        <div class="modal-dialog" role="document">
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                <div class="card">
                    <div class="header">
                        <h2>Add Expense</h2>
                        <ul class="header-dropdown m-r--5">
                            <li class="dropdown">
                                <button id="print_expense" type="button" class="btn bg-grey btn-xs waves-effect m-r-20" title="PRINT AND SAVE" ><i class="material-icons">print</i></button>
                            </li>
                            <li class="dropdown">
                                <form method="POST" id="printForm" name="printForm" target="_blank" action="{{ route('print_expense') }}">
                                <input type="hidden" id="expense_clone" name="expense_clone">
                                <input type="hidden" id="type_clone" name="type_clone">
                                <input type="hidden" id="amount_clone" name="amount_clone">
                                <button class="btn btn-sm btn-icon print-icon" type="submit" name="print_form" id="print_form" title="PRINT ONLY"><i class="glyphicon glyphicon-print"></i></button>
                                </form>
                            </li>
                        </ul>
                    </div>
                    <div class="body">
                        <form action="#" class="form-horizontal " id="expense_form">

                            <div class="row clearfix">
                                <div class="col-lg-2 col-md-2 col-sm-4 col-xs-5 form-control-label">
                                    <label for="expense">Name</label>
                                </div>
                                <div class="col-lg-10 col-md-10 col-sm-8 col-xs-7">
                                    <div class="form-group">
                                        <div class="form-line">
                                            <input type="text" id="expense" name="expense" class="form-control" placeholder="Enter your expense description"  required>
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
                                            <input type="number" id="amount" name="amount" class="form-control" placeholder="Enter amount"  required>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="row clearfix">
                                <div class="modal-footer">
                                    <button type="button" id="add_expense" class="btn btn-link waves-effect">SAVE CHANGES</button>
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
                    <h2>List of expenses as of {{ date('Y-m-d ') }}</h2>
                    <ul class="header-dropdown m-r--5">
                        <li class="dropdown">
                            <button type="button" class="btn bg-grey btn-xs waves-effect m-r-20" data-toggle="modal" data-target="#expense_modal"><i class="material-icons">library_add</i></button>
                        </li>
                    </ul>
                </div>
                <div class="body">
                    <div class="table-responsive">
                        <table id ="expensetable" class="table table-bordered table-striped table-hover  ">
                            <thead>
                                <tr>
                                    <th  width="100" style="text-align:center;">Name</th>
                                    <th  width="100" style="text-align:center;">Type</th>
                                    <th  width="100" style="text-align:center;">Amount</th>
                                    <th  width="100" style="text-align:center;">Status</th>
                                    <th  width="100" style="text-align:center;">Date</th>
                                    <th  width="100" style="text-align:center;">Released By</th>
                                    <th  width="100" style="text-align:center;">Releasing</th>
                                </tr>
                            </thead>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>


<div id="trip_expense_tab" class="tab-pane fade">
     <div class="row clearfix">
        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
            <div class="card">
                <div class="header">
                    <h2>List of Trip Expenses as of {{ date('Y-m-d ') }}</h2>

                </div>
                <div class="body">
                    <div class="table-responsive">
                        <table id="trip_expensetable" class="table table-bordered table-striped table-hover">
                            <thead>
                                <tr>
                                    <th  width="100" style="text-align:center;">Trip ID</th>
                                    <th  width="100" style="text-align:center;">Destination</th>
                                    <th  width="100" style="text-align:center;">Type</th>
                                    <th  width="100" style="text-align:center;">Amount</th>
                                    <th  width="100" style="text-align:center;">Status</th>
                                    <th  width="100" style="text-align:center;">Date</th>
                                    <th  width="100" style="text-align:center;">Released By</th>
                                    <th  width="100" style="text-align:center;">Releasing</th>
                                </tr>
                            </thead>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
    </div>
    <!-- <div id="DTR_expense" class="tab-pane fade">


     <div class="row clearfix">
        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
            <div class="card">
                <div class="header">
                    <h2>List of DTR Expenses as of {{ date('Y-m-d ') }}</h2>

                </div>
                <div class="body">
                    <div class="table-responsive">
                        <table id="DTR_expensetable" class="table table-bordered table-striped table-hover">
                            <thead>
                                <tr>
                                    <th>Trip ID</th>
                                    <th>Destination</th>
                                    <th>Type</th>
                                    <th>Amount</th>
                                    <th>Status</th>
                                    <th>Date</th>
                                    <th>Released By</th>
                                    <th>Releasing</th>
                                </tr>
                            </thead>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
    </div> -->

</div>
</div>
 <div class="modal fade" id="release_modal" tabindex="-1" role="dialog">
        <div class="modal-dialog" role="document">
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                <div class="card">
                    <div class="header">
                        <h2>Are You Sure?</h2>
                    </div>
                    <div class="body">
                        <form action="#" class="form-horizontal " id="expense_form">


                            <div class="row clearfix">
                                <div class="modal-footer">
                                    <button type="button" id="release_money" class="btn btn-success waves-effect">CONTINUE</button>
                                    <button type="button" class="btn btn-link waves-effect" data-dismiss="modal">CLOSE</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="modal fade" id="release_modal_normal" tabindex="-1" role="dialog">
        <div class="modal-dialog" role="document">
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                <div class="card">
                    <div class="header">
                        <h2>Are You Sure?</h2>
                    </div>
                    <div class="body">
                        <form action="#" class="form-horizontal " id="expense_form">


                            <div class="row clearfix">
                                <div class="modal-footer">
                                    <button type="button" id="release_money_normal" class="btn btn-success waves-effect">CONTINUE</button>
                                    <button type="button" class="btn btn-link waves-effect" data-dismiss="modal">CLOSE</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- #END# Exportable Table -->
@endsection

@section('script')
    <script>
        var id;
        $(document).on("click","#link",function(){
            $("#bod").toggleClass('overlay-open');
        });

        $(document).ready(function() {
            $(".nav-tabs a").click(function(){
        $(this).tab('show');
    });

            $.extend( $.fn.dataTable.defaults, {
                "language": {
                    processing: 'Loading.. Please wait'
                }
            });

            //EXPENSE Datatable starts here
            $('#expense_modal').on('hidden.bs.modal', function (e) {
                $(this)
                .find("input,textarea,select")
                    .val('')
                    .end()
                .find("input[type=checkbox], input[type=radio]")
                    .prop("checked", "")
                    .end();
            });

            var expensetable = $('#expensetable').DataTable({
                dom: 'Bfrtip',
                    buttons: [

                ],
                processing: true,
                serverSide: true,
                ajax: "{{ route('refresh_expense') }}",
                columns: [
                    {data: 'description', name: 'description'},
                    {data: 'type', name: 'type'},
                    {data: 'amount', name: 'amount'},
                    {data: 'status', name: 'status'},
                    {data: 'created_at', name: 'created_at'},
                    {data: 'released_by', name: 'released_by'},
                    {data: "action", orderable:false,searchable:false}
                ]
            });
            var trip_expensetable = $('#trip_expensetable').DataTable({
                dom: 'Bfrtip',
                    buttons: [

                ],
                processing: true,
                serverSide: true,
                ajax: "{{ route('trip_expense_view') }}",
                columns: [
                    {data: 'trip_id', name: 'trip_id'},
                    {data: 'description', name: 'description'},
                    {data: 'type', name: 'type'},
                    {data: 'amount', name: 'amount'},
                    {data: 'status', name: 'status'},
                    {data: 'created_at', name: 'created_at'},
                    {data: 'released_by', name: 'released_by'},
                    {data: "action", orderable:false,searchable:false}
                ]
            });

             $(document).on('click', '.release_expense', function(){
                 id = $(this).attr("id");
               // alert(id);
               // $('#release_expense').modal('show');
                // $.ajax({
                //     url:"{{ route('release_update') }}",
                //     method: 'post',
                //     data:{id:id},
                //     dataType:'json',
                //     success:function(data){
                //        console.log(data);
                //     }
                // })
            });
             $(document).on('click', '.release_expense_normal', function(){
                 id = $(this).attr("id");
            });
            $(document).on('click', '#release_money', function(){
                           console.log(id);

                            $.ajax({
                                url:"{{ route('release_update') }}",
                                method: 'POST',
                                headers: {
                                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                                },
                                data:{id:id},
                                dataType:'json',
                                success:function(data){
                                   console.log(data);
                                   $('#release_modal').modal('hide');

                                        trip_expensetable.ajax.reload(); //reload datatable ajax

                                }
                            })
                        });
             $(document).on('click', '#release_money_normal', function(){
                           console.log(id);

                            $.ajax({
                                url:"{{ route('release_update_normal') }}",
                                method: 'POST',
                                headers: {
                                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                                },
                                data:{id:id},
                                dataType:'json',
                                success:function(data){
                                   console.log(data);
                                   $('#release_modal_normal').modal('hide');

                                       expensetable.ajax.reload(); //reload datatable ajax

                                }
                            })
                        });

            function refresh_expense_table(){
                expensetable.ajax.reload(); //reload datatable ajax
            }

            $("#add_expense").click(function(event) {
                event.preventDefault();
                $.ajax({
                    method: "POST",
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    url: "{{ route('add_expense') }}",
                    dataType: "text",
                    data: $('#expense_form').serialize(),
                    success: function(data){
                        swal("Success!", "Record has been added to database", "success")
                        $('#expense_modal').modal('hide');
                        refresh_expense_table();
                    },
                    error: function(data){
                        swal("Oh no!", "Something went wrong, try again.", "error")
                    }
                });
            });

            $("#print_expense").click(function(event) {
                event.preventDefault();
                $("#add_expense").trigger("click");
                $("#print_form").trigger("click");
            });

            $("#print_form").click(function(event) {
                $("#expense_clone").val($("#expense").val());
                $("#type_clone").val($("#type").val());
                $("#amount_clone").val($("#amount").val());
            });
            //EXPENSE Datatable ends here

            src = "{{ route('autocomplete_name') }}";

            $("#expense").autocomplete({
                source: function(request, response) {
                    $.ajax({
                        url: src,
                        dataType: "json",
                        data: {
                            term : request.term
                        },
                        success: function(data) {
                            response(data);
                        }
                    });
                },
            });
        });
    </script>
@endsection
