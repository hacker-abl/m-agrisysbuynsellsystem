@extends(isAdmin() ? 'layouts.admin' : 'layouts.user')

@section('content')
    <div class="container-fluid">
        <div class="block-header">
            <h2>TRIPS (PICK UP)</h2>
        </div>
    </div>

    <!-- Add Pickup Modal -->
    <div class="modal fade pickup_modal" id="pickup_modal" tabindex="-1" role="dialog">
        <div class="modal-dialog" role="document">
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                <div class="card">
                    <div class="header">
                        <h2 class="modal_title">Add Trip(Pick Up)</h2>
                        <ul class="header-dropdown m-r--5">
                            <li class="dropdown">
                                <button id="print_trip" type="button" class="btn bg-grey btn-xs waves-effect m-r-20" ><i class="material-icons">print</i></button>
                            </li>
                            <li class="dropdown">
                                <form method="POST" id="printForm" name="printForm" target="_blank" action="{{ route('print_trip') }}">
                                <input type="hidden" id="item_num" name="item_num">
                                <input type="hidden" id="ticket_clone" name="ticket_clone">
                                <input type="hidden" id="expense_clone" name="expense_clone">
                                <input type="hidden" id="commodity_clone" name="commodity_clone">
                                <input type="hidden" id="driver_id_clone" name="driver_id_clone">
                                <input type="hidden" id="plateno_clone" name="plateno_clone">
                                <input type="hidden" id="destination_clone" name="destination_clone">
                                <input type="hidden" id="num_liters_clone" name="num_liters_clone">
                                </form>
                            </li>
                            <li class="dropdown">
                                <button class="btn btn-sm btn-icon print-icon" name="print_form" id="print_form" title="PRINT ONLY"><i class="glyphicon glyphicon-print"></i></button>
                            </li> 
                        </ul>
                    </div>
                    <div class="body">
                        <div class="form-group dynamic-element"></div>
                        <button type="button" class="btn btn-danger delete">Delete Trip</button>
                        <div class="form-group">
                            <div class="row">
                                <div class="col-md-12" align="center" style="cursor: pointer;">
                                    <p class="add-one">+ADD TRIP</p>
                                </div>
                            </div>
                        </div>

                        <div class="row clearfix">
                            <div class="modal-footer">
                                <button type="submit" id="add_trip" class="btn btn-link waves-effect" ng-disable="trip_form.$invalid">SAVE CHANGES</button>
                                <button type="button" class="btn btn-link waves-effect" data-dismiss="modal">CLOSE</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Update Pickup Modal -->
    <div class="modal fade pickup_modal_update" id="pickup_modal_update" tabindex="-1" role="dialog">
        <div class="modal-dialog" role="document">
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                <div class="card">
                    <div class="header">
                        <h2 class="modal_title">Update Trip(Pick Up)</h2>
                        <ul class="header-dropdown m-r--5">
                            <li class="dropdown">
                                <button id="print_trip1" type="button" class="btn bg-grey btn-xs waves-effect m-r-20" ><i class="material-icons">print</i></button>
                            </li>
                            <li class="dropdown">
                                <button class="btn btn-sm btn-icon print-icon" name="print_form1" id="print_form1" title="PRINT ONLY"><i class="glyphicon glyphicon-print"></i></button>
                            </li>
                        </ul>
                    </div>
                    <div class="body">
                        <form class="form-horizontal trip_form_update" id="trip_form_update">
                            <input type="hidden" name="id" id="id" value="">

                            <div class="row clearfix">
                                <div class="col-lg-2 col-md-2 col-sm-4 col-xs-5 form-control-label">
                                    <label for="name">TripTicket</label>
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
                                    <label for="name">Expense</label>
                                </div>
                                <div class="col-lg-10 col-md-10 col-sm-8 col-xs-7">
                                    <div class="form-group">
                                        <div class="form-line">
                                            <input type="number" id="expense" name="expense" class="form-control" required>
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
                                        <select type="text" id="commodity" name="commodity" class="form-control"value="" placeholder="Select item" required style="width:100%;">
                                            @foreach($commodity as $a)
                                            <option value="{{ $a->id }}">{{ $a->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                            </div>

                            <div class="row clearfix">
                                <div class="col-lg-2 col-md-2 col-sm-4 col-xs-5 form-control-label">
                                    <label for="type">Driver</label>
                                </div>
                                <div class="col-lg-10 col-md-10 col-sm-8 col-xs-7">
                                    <div class="form-group">
                                        <select type="text" id="driver_id" name="driver_id" class="form-control"value="" placeholder="Select driver" required style="width:100%;">
                                            @foreach($driver as $a)
                                            <option value="{{ $a->emp_id }}">{{ $a->lname }}, {{ $a->fname }} {{ $a->mname }}</option>
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
                                        <select type="text" id="plateno" name="plateno" class="form-control" value=""placeholder="Select truck" required style="width:100%;">
                                            @foreach($trucks as $a)
                                            <option value="{{ $a->id }}">{{ $a->name }} ({{ $a->plate_no }})</option>
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
                                            <input type="text" id="destination" name="destination" class="form-control" required>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="row clearfix">
                                <div class="col-lg-2 col-md-2 col-sm-4 col-xs-5 form-control-label">
                                    <label for="name"># of Liters</label>
                                </div>
                                <div class="col-lg-10 col-md-10 col-sm-8 col-xs-7">
                                    <div class="form-group">
                                        <div class="form-line">
                                            <input type="number" id="num_liters" name="num_liters" class="form-control" required>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="row clearfix">
                                <div class="modal-footer">
                                    <button type="submit" id="update_trip" class="btn btn-link waves-effect" ng-disable="trip_form_update.$invalid">SAVE CHANGES</button>
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
                    <h2>List of Pick Ups as of {{ date('Y-m-d ') }}</h2>
                        <ul class="header-dropdown m-r--5">
                            <li class="dropdown">
                                <button type="button" class="btn bg-grey btn-xs waves-effect m-r-20 open_pickup_modal"><i class="material-icons">library_add</i></button>
                            </li>
                        </ul>
                </div>
                <div class="body">
                    <div class="table-responsive">
                        <p id="date_filter">
                            <h5>Date Range Filter</h5>
                            <span id="date-label-from" class="date-label">From: </span><input class="date_range_filter date" type="text" id="trip_datepicker_from" />
                            <span id="date-label-to" class="date-label">To:<input class="date_range_filter date" type="text" id="trip_datepicker_to" />
                        </p>
                        <br>
                        <table id="triptable" class="table table-bordered table-striped table-hover  ">
                            <thead>
                                <tr>
                                    <th  style="text-align:center;">Ticket</th>
                                    <th  style="text-align:center;">Commodity</th>
                                    <th  style="text-align:center;">Expense</th>
                                    <th  style="text-align:center;">Destination</th>
                                    <th  style="text-align:center;">Truck</th>
                                    <th  style="text-align:center;">Driver</th>
                                    <th  style="text-align:center;">Plate No.</th>
                                    <th  style="text-align:center;">Liters</th>
                                    <th  style="text-align:center;">Date</th>
                                    <th  style="text-align:center;" width="100">Action</th>
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
@endsection

@section('script')
    <script>
        $(document).on("click","#link",function(){
            $("#bod").toggleClass('overlay-open');
        });

        $(document).ready(function() {
            $('.delete').hide();
            $.extend( $.fn.dataTable.defaults, {
                "language": {
                    processing: 'Loading.. Please wait'
                }
            });
            var trip_counter = 1;
            var print_indicator = false;

            var num_elements=0;

            var item=1;
            var num=0;
            var div;
            var pickuptable;
            var trip_date_from;
            var trip_date_to;

            document.title = "M-Agri - Trips";

            //Date Range Filter
            $("#trip_datepicker_from").datepicker({
                showOn: "button",
                buttonImage: 'assets/images/calendar2.png',
                buttonImageOnly: false,
                "onSelect": function(date) {
                   
                minDateFilter = new Date(date).getTime();
                var df= new Date(date);
                trip_date_from= df.getFullYear() + "-" + (df.getMonth() + 1) + "-" + df.getDate();
                $('#triptable').dataTable().fnDestroy();
                pickuptable = $('#triptable').DataTable({
                "footerCallback": function ( row, data, start, end, display ) {
                    var api = this.api(), data;
         
                    // Remove the formatting to get integer data for summation
                    var intVal = function ( i ) {
                        return typeof i == 'string' ?
                            i.replace(/[\₱,]/g, '')*1 :
                            typeof i == 'number' ?
                                i : 0;
                    };
         
                    // Total over all pages
                    total = api
                        .column( 2 )
                        .data()
                        .reduce( function (a, b) {
                            return intVal(a) + intVal(b);
                        }, 0 );
         
                    // Total over this page
                    pageTotal = api
                        .column( 2, { page: 'current'} )
                        .data()
                        .reduce( function (a, b) {
                            return intVal(a) + intVal(b);
                        }, 0 );
         
                    // Update footer
                    $( api.column( 2 ).footer() ).html(
                        'Total: <br>₱' + number_format(pageTotal,2)
                    );
                },
                dom: 'Blfrtip', "lengthMenu": [[10, 25, 50, -1], [10, 25, 50, "All"]],
                buttons: [
                    {
                        extend: 'print',
                        exportOptions: {
                            columns: [ 0, 1, 2, 3, 4, 5, 6, 7, 8 ]
                        },
                        customize: function ( win ) {
                            $(win.document.body)
                                .css( 'font-size', '10pt' );
         
                            $(win.document.body).find( 'table' )
                                .addClass( 'compact' )
                                .css( 'font-size', 'inherit' );
                        },
                        footer: true
                    },
					{ 
						extend: 'pdfHtml5', 
						footer: true,
						exportOptions: { 
							columns: [ 0, 1, 2, 3, 4, 5, 6, 7, 8 ]
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
                order:[],
                ajax:{
                   
                        url: "{{ route('refresh_pickup') }}",
                        // dataType: 'text',
                        type: 'post',
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                          },
                        data: {
                            date_from: trip_date_from,
                            date_to: trip_date_to,
                        },
                       
                  
                },
                columns: [
                    {data: 'trip_ticket'},
                    {data: 'commodity_name'},
                    {data: 'expense'},
                    {data: 'destination'},
                    {data: 'name'},
                    {data:'fname',
                        render: function(data, type, full, meta){
                            return full.fname +" "+ full.mname+" "+full.lname;
                        }
                    },
                    {data: 'plateno'},
                    {data: 'num_liters'},
                    {data: 'created_at'},
                    {data: "action", orderable:false,searchable:false}
                ]
            });

                }
              }).keyup(function() {
                trip_date_from="";
                $('#triptable').dataTable().fnDestroy();
                pickuptable = $('#triptable').DataTable({
                "footerCallback": function ( row, data, start, end, display ) {
                    var api = this.api(), data;
         
                    // Remove the formatting to get integer data for summation
                    var intVal = function ( i ) {
                        return typeof i == 'string' ?
                            i.replace(/[\₱,]/g, '')*1 :
                            typeof i == 'number' ?
                                i : 0;
                    };
         
                    // Total over all pages
                    total = api
                        .column( 2 )
                        .data()
                        .reduce( function (a, b) {
                            return intVal(a) + intVal(b);
                        }, 0 );
         
                    // Total over this page
                    pageTotal = api
                        .column( 2, { page: 'current'} )
                        .data()
                        .reduce( function (a, b) {
                            return intVal(a) + intVal(b);
                        }, 0 );
         
                    // Update footer
                    $( api.column( 2 ).footer() ).html(
                        'Total: <br>₱' + number_format(pageTotal,2)
                    );
                },
                dom: 'Blfrtip', "lengthMenu": [[10, 25, 50, -1], [10, 25, 50, "All"]],
                buttons: [
                    {
                        extend: 'print',
                        exportOptions: {
                            columns: [ 0, 1, 2, 3, 4, 5, 6, 7, 8 ]
                        },
                        customize: function ( win ) {
                            $(win.document.body)
                                .css( 'font-size', '10pt' );
         
                            $(win.document.body).find( 'table' )
                                .addClass( 'compact' )
                                .css( 'font-size', 'inherit' );
                        },
                        footer: true
                    },
					{ 
						extend: 'pdfHtml5', 
						footer: true,
						exportOptions: { 
							columns: [ 0, 1, 2, 3, 4, 5, 6, 7, 8 ]
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
                order:[],
                ajax:{
                   
                        url: "{{ route('refresh_pickup') }}",
                        // dataType: 'text',
                        type: 'post',
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                          },
                        data: {
                            date_from: trip_date_from,
                            date_to: trip_date_to,
                        },
                       
                  
                },
                columns: [
                    {data: 'trip_ticket'},
                    {data: 'commodity_name'},
                    {data: 'expense'},
                    {data: 'destination'},
                    {data: 'name'},
                    {data:'fname',
                        render: function(data, type, full, meta){
                            return full.fname +" "+ full.mname+" "+full.lname;
                        }
                    },
                    {data: 'plateno'},
                    {data: 'num_liters'},
                    {data: 'created_at'},
                    {data: "action", orderable:false,searchable:false}
                ]
            });
              });

              $("#trip_datepicker_to").datepicker({
                showOn: "button",
                buttonImage: 'assets/images/calendar2.png',
                buttonImageOnly: false,
                "onSelect": function(date) {
                maxDateFilter = new Date(date).getTime();
                //oTable.fnDraw();
                var dt= new Date(date);
                trip_date_to =dt.getFullYear() + "-" + (dt.getMonth() + 1) + "-" + dt.getDate();
                $('#triptable').dataTable().fnDestroy();
                pickuptable = $('#triptable').DataTable({
                "footerCallback": function ( row, data, start, end, display ) {
                    var api = this.api(), data;
         
                    // Remove the formatting to get integer data for summation
                    var intVal = function ( i ) {
                        return typeof i == 'string' ?
                            i.replace(/[\₱,]/g, '')*1 :
                            typeof i == 'number' ?
                                i : 0;
                    };
         
                    // Total over all pages
                    total = api
                        .column( 2 )
                        .data()
                        .reduce( function (a, b) {
                            return intVal(a) + intVal(b);
                        }, 0 );
         
                    // Total over this page
                    pageTotal = api
                        .column( 2, { page: 'current'} )
                        .data()
                        .reduce( function (a, b) {
                            return intVal(a) + intVal(b);
                        }, 0 );
         
                    // Update footer
                    $( api.column( 2 ).footer() ).html(
                        'Total: <br>₱' + number_format(pageTotal,2)
                    );
                },
                dom: 'Blfrtip', "lengthMenu": [[10, 25, 50, -1], [10, 25, 50, "All"]],
                buttons: [
                    {
                        extend: 'print',
                        exportOptions: {
                            columns: [ 0, 1, 2, 3, 4, 5, 6, 7, 8 ]
                        },
                        customize: function ( win ) {
                            $(win.document.body)
                                .css( 'font-size', '10pt' );
         
                            $(win.document.body).find( 'table' )
                                .addClass( 'compact' )
                                .css( 'font-size', 'inherit' );
                        },
                        footer: true
                    },
					{ 
						extend: 'pdfHtml5', 
						footer: true,
						exportOptions: { 
							columns: [ 0, 1, 2, 3, 4, 5, 6, 7, 8 ]
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
                order:[],
                ajax:{
                   
                        url: "{{ route('refresh_pickup') }}",
                        // dataType: 'text',
                        type: 'post',
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                          },
                        data: {
                            date_from: trip_date_from,
                            date_to: trip_date_to,
                        },
                       
                  
                },
                columns: [
                    {data: 'trip_ticket'},
                    {data: 'commodity_name'},
                    {data: 'expense'},
                    {data: 'destination'},
                    {data: 'name'},
                    {data:'fname',
                        render: function(data, type, full, meta){
                            return full.fname +" "+ full.mname+" "+full.lname;
                        }
                    },
                    {data: 'plateno'},
                    {data: 'num_liters'},
                    {data: 'created_at'},
                    {data: "action", orderable:false,searchable:false}
                ]
            });
                }
              }).keyup(function() {
                trip_date_to="";
                $('#triptable').dataTable().fnDestroy();
                pickuptable = $('#triptable').DataTable({
                "footerCallback": function ( row, data, start, end, display ) {
                    var api = this.api(), data;
         
                    // Remove the formatting to get integer data for summation
                    var intVal = function ( i ) {
                        return typeof i == 'string' ?
                            i.replace(/[\₱,]/g, '')*1 :
                            typeof i == 'number' ?
                                i : 0;
                    };
         
                    // Total over all pages
                    total = api
                        .column( 2 )
                        .data()
                        .reduce( function (a, b) {
                            return intVal(a) + intVal(b);
                        }, 0 );
         
                    // Total over this page
                    pageTotal = api
                        .column( 2, { page: 'current'} )
                        .data()
                        .reduce( function (a, b) {
                            return intVal(a) + intVal(b);
                        }, 0 );
         
                    // Update footer
                    $( api.column( 2 ).footer() ).html(
                        'Total: <br>₱' + number_format(pageTotal,2)
                    );
                },
                dom: 'Blfrtip', "lengthMenu": [[10, 25, 50, -1], [10, 25, 50, "All"]],
                buttons: [
                    {
                        extend: 'print',
                        exportOptions: {
                            columns: [ 0, 1, 2, 3, 4, 5, 6, 7, 8 ]
                        },
                        customize: function ( win ) {
                            $(win.document.body)
                                .css( 'font-size', '10pt' );
         
                            $(win.document.body).find( 'table' )
                                .addClass( 'compact' )
                                .css( 'font-size', 'inherit' );
                        },
                        footer: true
                    },
					{ 
						extend: 'pdfHtml5', 
						footer: true,
						exportOptions: { 
							columns: [ 0, 1, 2, 3, 4, 5, 6, 7, 8 ]
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
                order:[],
                ajax:{
                   
                        url: "{{ route('refresh_pickup') }}",
                        // dataType: 'text',
                        type: 'post',
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                          },
                        data: {
                            date_from: trip_date_from,
                            date_to: trip_date_to,
                        },
                       
                  
                },
                columns: [
                    {data: 'trip_ticket'},
                    {data: 'commodity_name'},
                    {data: 'expense'},
                    {data: 'destination'},
                    {data: 'name'},
                    {data:'fname',
                        render: function(data, type, full, meta){
                            return full.fname +" "+ full.mname+" "+full.lname;
                        }
                    },
                    {data: 'plateno'},
                    {data: 'num_liters'},
                    {data: 'created_at'},
                    {data: "action", orderable:false,searchable:false}
                ]
            });
              });

            //END OF DATE RANGE FILTER
            $('.delete').click(function(event){
                event.preventDefault();
                div= $('.dynamic-element form').last().attr('id');
                item = (div.match(/\d+/g));

                $('#trip_form'+(item)+'').detach();
                if(item==1){
                    $('.delete').hide();
                }
            });

            $(".pickup_modal").on("hidden.bs.modal", function(){
                $(".trip_form").detach();
                $('.delete').hide();
                item=1;
            });

            $('#pickup_modal_update').on('hidden.bs.modal', function (e) {
                $(this)
                .find("input,textarea,select")
                    .val('')
                    .end()
                .find("input[type=checkbox], input[type=radio]")
                    .prop("checked", "")
                    .end();
            })

            $(".pickup_modal").on("shown.bs.modal", function(){
                $('.delete').hide();
            });

            $('.add-one').click(function(){

                $(".dynamic-element").append(
                    '<form class="form-horizontal trip_form" id="trip_form'+item+'">'+
                        '<h4 align="center">Pick Up '+item+'</h4>'+
                        '<input type="hidden" name="id" id="id" value="">'+

                        '<div class="row clearfix">'+
                            '<div class="col-lg-2 col-md-2 col-sm-4 col-xs-5 form-control-label">'+
                                '<label for="name">TripTicket</label>'+
                            '</div>'+
                            '<div class="col-lg-10 col-md-10 col-sm-8 col-xs-7">'+
                                '<div class="form-group">'+
                                    '<div class="form-line">'+
                                        '<input type="text" id="ticket'+item+'" name="ticket" readonly="readonly" value="" class="form-control" required>'+
                                    '</div>'+
                                '</div>'+
                            '</div>'+
                        '</div>'+

                        '<div class="row clearfix">'+
                            '<div class="col-lg-2 col-md-2 col-sm-4 col-xs-5 form-control-label">'+
                                '<label for="name">Expense</label>'+
                            '</div>'+
                            '<div class="col-lg-10 col-md-10 col-sm-8 col-xs-7">'+
                                '<div class="form-group">'+
                                    '<div class="form-line">'+
                                        '<input type="number" id="expense'+item+'" name="expense" min="0" class="form-control" required>'+
                                    '</div>'+
                                '</div>'+
                            '</div>'+
                        '</div>'+

                        '<div class="row clearfix">'+
                            '<div class="col-lg-2 col-md-2 col-sm-4 col-xs-5 form-control-label">'+
                                '<label for="type">Commodity</label>'+
                            '</div>'+
                            '<div class="col-lg-10 col-md-10 col-sm-8 col-xs-7">'+
                                '<div class="form-group">'+
                                    '<select type="text" id="commodity'+item+'" name="commodity" class="form-control" placeholder="Select item" required style="width:100%;">'+
                                        '@foreach($commodity as $a)'+
                                        '<option value="{{ $a->id }}">{{ $a->name }}</option>'+
                                        '@endforeach'+
                                    '</select>'+
                                '</div>'+
                            '</div>'+
                        '</div>'+

                        '<div class="row clearfix">'+
                            '<div class="col-lg-2 col-md-2 col-sm-4 col-xs-5 form-control-label">'+
                                '<label for="type">Driver</label>'+
                            '</div>'+
                            '<div class="col-lg-10 col-md-10 col-sm-8 col-xs-7">'+
                                '<div class="form-group">'+
                                    '<select type="text" id="driver_id'+item+'" name="driver_id" class="form-control" placeholder="Select driver" required style="width:100%;">'+
                                        '@foreach($driver as $a)'+
                                        '<option value="{{ $a->emp_id }}">{{ $a->lname }}, {{ $a->fname }} {{ $a->mname }}</option>'+
                                        '@endforeach'+
                                    '</select>'+
                                '</div>'+
                            '</div>'+
                        '</div>'+

                        '<div class="row clearfix">'+
                            '<div class="col-lg-2 col-md-2 col-sm-4 col-xs-5 form-control-label">'+
                                '<label for="name">Plate #</label>'+
                            '</div>'+
                            '<div class="col-lg-10 col-md-10 col-sm-8 col-xs-7">'+
                                '<div class="form-group">'+
                                    '<select type="text" id="plateno'+item+'" name="plateno" class="form-control" placeholder="Select truck" required style="width:100%;">'+
                                        '@foreach($trucks as $a)'+
                                        '<option value="{{ $a->id }}">{{ $a->name }} ({{ $a->plate_no }})</option>'+
                                        '@endforeach'+
                                    '</select>'+
                                '</div>'+
                            '</div>'+
                        '</div>'+

                        '<div class="row clearfix">'+
                            '<div class="col-lg-2 col-md-2 col-sm-4 col-xs-5 form-control-label">'+
                                '<label for="name">Destination</label>'+
                            '</div>'+
                            '<div class="col-lg-10 col-md-10 col-sm-8 col-xs-7">'+
                                '<div class="form-group">'+
                                    '<div class="form-line">'+
                                        '<input type="text" id="destination'+item+'" name="destination" class="form-control" required>'+
                                    '</div>'+
                                '</div>'+
                            '</div>'+
                        '</div>'+

                        '<div class="row clearfix">'+
                            '<div class="col-lg-2 col-md-2 col-sm-4 col-xs-5 form-control-label">'+
                                '<label for="name"># of Liters</label>'+
                            '</div>'+
                            '<div class="col-lg-10 col-md-10 col-sm-8 col-xs-7">'+
                                '<div class="form-group">'+
                                    '<div class="form-line">'+
                                        '<input type="number" id="num_liters'+item+'" min="0" name="num_liters" class="form-control" required>'+
                                    '</div>'+
                                '</div>'+
                            '</div>'+
                        '</div>'+

                        '<hr noshade width="100%" >'+
                    '</form>'
                )

                $('#plateno'+item+'').select2({
                    dropdownParent: $('#trip_form'+item),
                    placeholder: 'Select Truck'
                });

                $('#driver_id'+item+'').select2({
                    dropdownParent: $('#trip_form'+item),
                    placeholder: 'Select Driver'
                });

                $('#commodity'+item+'').select2({
                    dropdownParent: $('#trip_form'+item),
                    placeholder: 'Select Commodity'
                });

                $('#commodity'+item+'').val('').trigger('change');
                $('#driver_id'+item+'').val('').trigger('change');
                $('#plateno'+item+'').val('').trigger('change');

                $.ajax({
                    url:"{{ route('get_pickup') }}",
                    method: 'get',
                    data: { temp: 'temp' },
                    dataType:'json',
                    success:function(data){
                        var t=0;
                        if(data[0].temp!=null){
                             t = data[0].temp;
                        }
                        var stringticket= t.toString();

                        var e=stringticket; 
                        if(stringticket!="0"){
                            e = stringticket.substr(stringticket.length-1);
                        }
                        var a = parseInt(e);
                        var b = a + 1;
                        var c = new Date();
                        var twoDigitMonth = ((c.getMonth().length+1) == 1)? (c.getMonth()+1) : '0' + (c.getMonth()+1);
                        var currentDate = c.getFullYear()+ twoDigitMonth + c.getDate();
                        $("input[id=ticket"+(item)+"]").val(currentDate+b);
                        if(item>=1){
                            div= $('.dynamic-element form').last().attr('id');
                            item = (parseInt( div.match(/\d+/g), 10 ) +1);
                            $('.delete').show();
                        }
                    }
                })
            });

            function refresh_pickup(){
                pickuptable.ajax.reload(); //reload datatable ajax
            }

            $(document).on('click','.open_pickup_modal', function(){
                $('#pickup_modal').modal('show');
            });

            //Open Update Modal
            $(document).on('click', '.update_pickup', function(){
                var id = $(this).attr("id");

                $.ajax({
                    url:"{{ route('update_pickup') }}",
                    method: 'get',
                    data:{id:id},
                    dataType:'json',
                    success:function(data){
                        $('#id').val(id);
                        $("#ticket").val(data[0].trip_ticket);
                        $("#expense").val(data[0].expense);
                        $("#commodity").val(data[0].commodity_id).trigger('change');
                        $("#driver_id").val(data[0].driver_id).trigger('change');
                        $("#plateno").val(data[0].truck_id).trigger('change');
                        $('#destination').val(data[0].destination);
                        $('#num_liters').val(data[0].num_liters);
                        $('#pickup_modal_update').modal('show');
                    }
                })
            });

            //Clicked Update Button
            $("#update_trip").click(function(event){
                event.preventDefault();
                var input = $(this);
                var button =this;
                button.disabled = true;
                input.html('SAVING...'); 
                $.ajax({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    url:"{{ route('update_trip')}}",
                    method: 'POST',
                    dataType:'text',
                    data: $('#trip_form_update').serialize(),
                    success:function(data){
                        button.disabled = false;
                        input.html('SAVE CHANGES');
                        swal("Success!", "Update Success", "success")

                        $('#pickup_modal_update').modal('hide');
                       refresh_pickup();
                    },
                    error: function(data){
                        button.disabled = false;
                        input.html('SAVE CHANGES');
                        swal("Oh no!", "Something went wrong, try again.", "error")
                    }
                })
            });

            $(document).on('click', '.delete_pickup', function(){
                var id = $(this).attr('id');
               swal({
                    title: "Are you sure?",
                    text: "Delete this record?",
                    icon: "warning",
                    buttons: true,
                    dangerMode: true,
                }).then((willDelete) => {
                if (willDelete) {
                    $.ajax({
                        url:"{{ route('delete_trip') }}",
                        method: "get",
                        data:{id:id},
                        success:function(data){
                           refresh_pickup();
                        }
                    })
                    swal("Deleted!", "The record has been deleted.", "success");
                }
                })
            });

            $("#add_trip").click(function(){
                var input = $(this);
                var button =this;
                button.disabled = true;
                input.html('SAVING...');
                var  datasend="";
                var count_length = $('.trip_form').length;
                $('.trip_form').each(function(){
                    valuesToSend = $(this).serialize();
                    $.ajax({
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        },
                        url:"{{ route('add_pickup')}}",
                        method: 'POST',
                        dataType:'text',
                        data: valuesToSend,
                        success:function(data){
                            dataparsed = $.parseJSON(data);
                            $("#id").val(dataparsed.driver_id);
                            button.disabled = false;
                            input.html('SAVE CHANGES');
                            swal("Success!", "Record has been added to database", "success")
                            $('#pickup_modal').modal('hide');
                            refresh_pickup();
                            $('.delete').toggle(false);

                        },
                        error: function(data){
                            swal("Oh no!", "Something went wrong, try again.", "error")
                            button.disabled = false;
                            input.html('SAVE CHANGES');
                        }

                    })
                });
            });

            // $("#print_trip").click(function(event) {
            //     event.preventDefault();
            //     print_indicator = true;
            //     $("#add_trip").trigger("click");
            // });
                
            $("#print_trip1").click(function(event) {
                event.preventDefault();
                $("#print_form1").trigger("click");
                $("#update_trip").trigger("click");
            });

            $("#print_form1").click(function(event) {
                print_loop1();
            });

            $("#print_trip").click(function(event) {
                event.preventDefault();
                $("#print_form").trigger("click");
                $("#add_trip").trigger("click");
            });

            $("#print_form").click(function(event) {
                print_loop();
            });

            function print_loop () {

            var count_length = $('.trip_form').length;

            setTimeout(function () {

                $("#ticket_clone").val($("#ticket"+trip_counter).val());
                $("#expense_clone").val($("#expense"+trip_counter).val());
                $("#commodity_clone").val($("#commodity"+trip_counter+" option:selected").text());
                $("#driver_id_clone").val($("#driver_id"+trip_counter+" option:selected").text());
                $("#plateno_clone").val($("#plateno"+trip_counter+" option:selected").text());
                $("#destination_clone").val($("#destination"+trip_counter).val());
                $("#num_liters_clone").val($("#num_liters"+trip_counter).val());

                $("#printForm").submit();

                trip_counter++;
                if (trip_counter <= count_length) {
                    print_loop();
                }else{
                    trip_counter=1;
                }
            }, 100)

            }

            function print_loop1 () {

                $("#ticket_clone").val($("#ticket").val());
                $("#expense_clone").val($("#expense").val());
                $("#commodity_clone").val($("#commodity option:selected").text());
                $("#driver_id_clone").val($("#driver_id option:selected").text());
                $("#plateno_clone").val($("#plateno option:selected").text());
                $("#destination_clone").val($("#destination").val());
                $("#num_liters_clone").val($("#num_liters").val());

                $("#printForm").submit();

            }


            function number_format(number, decimals, dec_point, thousands_sep) {
                // Strip all characters but numerical ones.
                number = (number + '').replace(/[^0-9+\-Ee.]/g, '');
                var n = !isFinite(+number) ? 0 : +number,
                    prec = !isFinite(+decimals) ? 0 : Math.abs(decimals),
                    sep = (typeof thousands_sep == 'undefined') ? ',' : thousands_sep,
                    dec = (typeof dec_point == 'undefined') ? '.' : dec_point,
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

            pickuptable = $('#triptable').DataTable({
                "footerCallback": function ( row, data, start, end, display ) {
                    var api = this.api(), data;
         
                    // Remove the formatting to get integer data for summation
                    var intVal = function ( i ) {
                        return typeof i == 'string' ?
                            i.replace(/[\₱,]/g, '')*1 :
                            typeof i == 'number' ?
                                i : 0;
                    };
         
                    // Total over all pages
                    total = api
                        .column( 2 )
                        .data()
                        .reduce( function (a, b) {
                            return intVal(a) + intVal(b);
                        }, 0 );
         
                    // Total over this page
                    pageTotal = api
                        .column( 2, { page: 'current'} )
                        .data()
                        .reduce( function (a, b) {
                            return intVal(a) + intVal(b);
                        }, 0 );
         
                    // Update footer
                    $( api.column( 2 ).footer() ).html(
                        'Total: <br>₱' + number_format(pageTotal,2)
                    );
                },
                dom: 'Blfrtip', "lengthMenu": [[10, 25, 50, -1], [10, 25, 50, "All"]],
                buttons: [
                    {
                        extend: 'print',
                        exportOptions: {
                            columns: [ 0, 1, 2, 3, 4, 5, 6, 7, 8 ]
                        },
                        customize: function ( win ) {
                            $(win.document.body)
                                .css( 'font-size', '10pt' );
         
                            $(win.document.body).find( 'table' )
                                .addClass( 'compact' )
                                .css( 'font-size', 'inherit' );
                        },
                        footer: true
                    },
					{ 
						extend: 'pdfHtml5', 
						footer: true,
						exportOptions: { 
							columns: [ 0, 1, 2, 3, 4, 5, 6, 7, 8 ]
						},
						customize: function(doc) {
							doc.styles.tableHeader.fontSize = 8;  
							doc.styles.tableFooter.fontSize = 8;   
							doc.defaultStyle.fontSize = 8; 
                            
						}  
					}
                ],
                paging: true,
                columnDefs: [
  				{
    			  	"targets": "_all", // your case first column
     				"className": "text-center",
      				
 				}
				],
                pageLength: 10,
                order:[],
                ajax:{
                   
                        url: "{{ route('refresh_pickup') }}",
                        // dataType: 'text',
                        type: 'post',
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                          },
                        data: {
                            date_from: trip_date_from,
                            date_to: trip_date_to,
                        },
                       
                  
                },
                columns: [
                    {data: 'trip_ticket'},
                    {data: 'commodity_name'},
                    {data: 'expense'},
                    {data: 'destination'},
                    {data: 'name'},
                    {data:'fname',
                        render: function(data, type, full, meta){
                            return full.fname +" "+ full.mname+" "+full.lname;
                        }
                    },
                    {data: 'plateno'},
                    {data: 'num_liters'},
                    {data: 'created_at'},
                    {data: "action", orderable:false,searchable:false}
                ]
            });

            $("#plateno").select2({
                dropdownParent: $('#pickup_modal_update'),
                placeholder: 'Select Truck'
            });

            $("#driver_id").select2({
                dropdownParent: $('#pickup_modal_update'),
                placeholder: 'Select Driver'
            });

            $("#commodity").select2({
                dropdownParent: $('#pickup_modal_update'),
                placeholder: 'Select Commodity'
            });
        });//END DOCUMENT READY

            
    </script>
@endsection
