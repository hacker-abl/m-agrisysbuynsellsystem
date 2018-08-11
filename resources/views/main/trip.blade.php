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
            <li class="active">
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
            <li >
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
                    <span>Sales</span>
                </a>
            </li>
        </ul>
    </div>
@endsection

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
                                            <option value="{{ $a->id }}">{{ $a->name }} Price: {{ $a->price }}({{ $a->suki_price }})</option>
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
                                    <th  style="text-align:center;" width="50">Action</th>
                                </tr>
                            </thead>
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
                                        '<option value="{{ $a->id }}">{{ $a->name }} Price: {{ $a->price }}({{ $a->suki_price }})</option>'+
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
                    placeholder: '--Select a truck--'
                });

                $('#driver_id'+item+'').select2({
                    dropdownParent: $('#trip_form'+item),
                    placeholder: '--Select a driver--'
                });

                $('#commodity'+item+'').select2({
                    dropdownParent: $('#trip_form'+item),
                    placeholder: '--Select an item--'
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
                            e= stringticket.substr(7, 7);
                        }
                        var a = parseInt(e);
                        var b = a + 1;
                        var c = new Date();
                        var twoDigitMonth = ((c.getMonth().length+1) === 1)? (c.getMonth()+1) : '0' + (c.getMonth()+1);
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
                $.ajax({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    url:"{{ route('update_trip')}}",
                    method: 'POST',
                    dataType:'text',
                    data: $('#trip_form_update').serialize(),
                    success:function(data){
                        swal("Success!", "Update Success", "success")

                        $('#pickup_modal_update').modal('hide');
                       refresh_pickup();
                    },
                    error: function(data){
                        console.log($('#trip_form_update').serialize())
                        swal("Oh no!", "Something went wrong, try again.", "error")
                    }
                })
            });

            $(document).on('click', '.delete_pickup', function(){
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
                        url:"{{ route('delete_trip') }}",
                        method: "get",
                        data:{id:id},
                        success:function(data){
                           refresh_pickup();
                        }
                    })
                    swal("Deleted!", "The record has been deleted.", "success");
                });
            });

            $("#add_trip").click(function(){
                var  datasend="";
                var count_length = $('.trip_form').length;
                $('.trip_form').each(function(){
                    valuesToSend = $(this).serialize();
                    console.log(valuesToSend);

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
                            console.log(datasend);


                            $("#id").val(dataparsed.driver_id);

                            swal("Success!", "Record has been added to database", "success")
                            $('#pickup_modal').modal('hide');
                            refresh_pickup();
                            $('.delete').toggle(false);

                        },
                        error: function(data){
                            swal("Oh no!", "Something went wrong, try again.", "error")
                        }

                    })
                });
            });

            // $("#print_trip").click(function(event) {
            //     event.preventDefault();
            //     print_indicator = true;
            //     $("#add_trip").trigger("click");
            // });

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



            var pickuptable = $('#triptable').DataTable({
                dom: 'Bfrtip',
                buttons: [
                ],
                processing: true,
                serverSide: true,
                ajax: "{{ route('refresh_pickup') }}",
                columns: [
                    {data: 'trip_ticket', name: 'trip_ticket'},
                    {data: 'commodity_name', name: 'commodity_name'},
                    {data: 'expense', name: 'expense'},
                    {data: 'destination', name: 'destination'},
                    {data: 'name', name: 'name'},
                    {data:'fname',
                        render: function(data, type, full, meta){
                            return full.fname +" "+ full.mname+" "+full.lname;
                        }
                    },
                    {data: 'plateno', name: 'plateno'},
                    {data: 'num_liters', name: 'num_liters'},
                    {data: 'created_at', name: 'created_at'},
                    {data: "action", orderable:false,searchable:false}
                ]
            });

            $("#plateno").select2({
                dropdownParent: $('#pickup_modal_update'),
                placeholder: '--Select a truck--'
            });

            $("#driver_id").select2({
                dropdownParent: $('#pickup_modal_update'),
                placeholder: '--Select a driver--'
            });

            $("#commodity").select2({
                dropdownParent: $('#pickup_modal_update'),
                placeholder: '--Select an item--'
            });
        });//END DOCUMENT READY
    </script>
@endsection
