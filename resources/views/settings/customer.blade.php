@extends('layouts.admin')

@section('sidenav')
    <div class="menu">
        <ul class="list">
            <li class="header">MANAGE SETTINGS</li>
            <li>
                <a href="{{ route('company') }}">
                    <i class="material-icons">business</i>
                    <span>Company</span>
                </a>
            </li>
            <li>
                <a href="{{ route('employee') }}">
                    <i class="material-icons">supervisor_account</i>
                    <span>Employee</span>
                </a>
            </li>
            <li class="active">
                <a href="{{ route('customer') }}">
                    <i class="material-icons">tag_faces</i>
                    <span>Customer</span>
                </a>
            </li>
                <li>
                <a href="{{ route('trucks') }}">
                    <i class="material-icons">local_shipping</i>
                    <span>Trucks</span>
                </a>
            </li>
            <li >
                <a href="{{ route('commodity') }}">
                    <i class="material-icons">receipt</i>
                    <span>Commodity</span>
                </a>
            </li>
            <li>
                <a href="{{ route('users') }}">
                    <i class="material-icons">person</i>
                    <span>Users</span>
                </a>
            </li>
            <li>
                <a href="{{ route('roles') }}">
                    <i class="material-icons">assignment</i>
                    <span>Roles</span>
                </a>
            </li>
        </ul>
    </div>
@endsection

@section('content')
    <div class="container-fluid">
        <div class="block-header">
            <h2>Customer Dashboard</h2>
        </div>
    </div>
    <div class="modal fade" id="customer_modal" tabindex="-1" role="dialog">
        <div class="modal-dialog" role="document">
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                <div class="card">
                    <div class="header">
                        <h2 class="modal_title">Add Customer</h2>
                    </div>
                    <div class="body">
                        <form class="form-horizontal " id="customer_form">
                            <input type="hidden" name="id" id="id" value="">
                            <input type="hidden" name="balance_id" id="balance_id" value="">
                            <input type="hidden" name="button_action" id="button_action" value="">

                            <div class="row clearfix">
                                <div class="col-lg-2 col-md-2 col-sm-4 col-xs-5 form-control-label">
                                    <label for="fname">First Name</label>
                                </div>
                                <div class="col-lg-10 col-md-10 col-sm-8 col-xs-7">
                                    <div class="form-group">
                                        <div class="form-line">
                                            <input type="text" id="fname" name="fname" class="form-control" placeholder="Enter customer's first name"  required>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="row clearfix">
                                <div class="col-lg-2 col-md-2 col-sm-4 col-xs-5 form-control-label">
                                    <label for="mname">Middle Name</label>
                                </div>
                                <div class="col-lg-10 col-md-10 col-sm-8 col-xs-7">
                                    <div class="form-group">
                                        <div class="form-line">
                                            <input type="text" id="mname" name="mname" class="form-control" placeholder="Enter customer's middle name"  required>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="row clearfix">
                                <div class="col-lg-2 col-md-2 col-sm-4 col-xs-5 form-control-label">
                                    <label for="lname">Last Name</label>
                                </div>
                                <div class="col-lg-10 col-md-10 col-sm-8 col-xs-7">
                                    <div class="form-group">
                                        <div class="form-line">
                                            <input type="text" id="lname" name="lname" class="form-control" placeholder="Enter customer's last name"  required>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="row clearfix suki_type_input">
                                <div class="col-lg-2 col-md-2 col-sm-4 col-xs-5 form-control-label">
                                    <label for="suki_type">Suki</label>
                                </div>
                                <div class="col-lg-10 col-md-10 col-sm-8 col-xs-7">
                                    <div class="form-group">
                                        <div class="form-line">
                                            <select type="text" id="suki_type" name="suki_type" class="form-control" placeholder="Select Suki Type" style="width:100%;">
                                                <option value="YES">YES</option>
                                                <option value="NO">NO</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="row clearfix">
                                    <div class="modal-footer">
                                        <button type="submit" id="add_customer" class="btn btn-link waves-effect">SAVE CHANGES</button>
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
                    <h2>List of customers as of {{ date('Y-m-d ') }}</h2>
                    <ul class="header-dropdown m-r--5">
                        <li class="dropdown">
                            <button type="button" class="btn bg-grey btn-xs waves-effect m-r-20 open_customer_modal" data-toggle="modal" data-target="#customer_modal"><i class="material-icons">library_add</i></button>
                        </li>
                    </ul>
                </div>
                <div class="body">
                    <div class="table-responsive">
                        <table id="customertable" class="table table-bordered table-striped table-hover  ">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Name</th>
                                    <th>Suki</th>
                                    <th width="50">Action</th>
                                </tr>
                            </thead>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- #END# Exportable Table -->
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

            //CUSTOMER Datatable starts here
            $('#customer_modal').on('hidden.bs.modal', function (e) {
                $(this)
                .find("input,textarea,select")
                    .val('')
                    .end()
                .find("input[type=checkbox], input[type=radio]")
                    .prop("checked", "")
                    .end();
            })



            var customertable = $('#customertable').DataTable({
                dom: 'Bfrtip',
                buttons: [
                ],
                processing: true,
                serverSide: true,
                ajax: "{{ route('refresh_customer') }}",
                columns: [
                    {data: 'id', name: 'id'},
                    {render:function(data, type, full, meta){
                        return full.fname + " " + full.mname + " " + full.lname;
                    }},
                    {render:function(data, type, row){
                        return row.suki_type == 1 ? 'YES' : 'NO'
                    }},
                    {data: "action", orderable:false,searchable:false}
                ]
            });

            function refresh_customer_table()
            {
                customertable.ajax.reload(); //reload datatable ajax
            }

            //Open Customer Modal
            $(document).on('click','.open_customer_modal', function(){
                 $.ajax({
                     url:"{{ route('refresh_balance') }}",
                     method: 'get',
                     data: { temp: 'temp' },
                     dataType:'json',
                     success:function(data){
                          var t=0;
                          if(data[0].temp!=null){
                               t = data[0].temp;
                          }
                          var a = parseInt(t);
                          var x = a+1;
                            $('#balance_id').val(x);
                           $('#customer_modal').modal('show');
                     }
                })

                $('.modal_title').text('Add Customer');
                $('#button_action').val('add');
                if($(".suki_type_input:visible")){
                    $(".suki_type_input").hide();
                }
            });

            //Add Customer
            $("#add_customer").click(function(event) {
                event.preventDefault();
                $.ajax({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    type: "POST",
                    url: "{{ route('add_customer') }}",
                    dataType: "text",
                    data: $('#customer_form').serialize(),
                    success: function(data){
                        $(".suki_type_input").hide();
                        swal("Success!", "Record has been added to database", "success")
                        $('#customer_modal').modal('hide');
                        refresh_customer_table();
                    },
                    error: function(data){
                        swal("Oh no!", "Something went wrong, try again.", "error")
                    }
                });
            });

            //Update Customer
            $(document).on('click', '.update_customer', function(){
                var id = $(this).attr("id");
                $.ajax({
                    url:"{{ route('update_customer') }}",
                    method: 'get',
                    data:{id:id},
                    dataType:'json',
                    success:function(data){
                        $('#button_action').val('update');
                        $('.modal_title').text('Update Customer');
                        $('#customer_modal').modal('show');
                        $('#id').val(id);
                        $('#fname').val(data.fname);
                        $('#mname').val(data.mname);
                        $('#lname').val(data.lname);
                        //Make input for suki type visible when updating customer
                        if($(".suki_type_input:hidden")){
                            $(".suki_type_input").show();
                        }
                        if(data.suki_type == 1){
                            $('#suki_type').val('YES').trigger('change');
                        }
                        else if(data.suki_type == 0){
                            $('#suki_type').val('NO').trigger('change');
                        }
                    }
                })
            });

            $(document).on('click', '.delete_customer', function(){
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
                        url:"{{ route('delete_customer') }}",
                        method: "get",
                        data:{id:id},
                        success:function(data){
                            refresh_customer_table();
                        }
                    })
                    swal("Deleted!", "The record has been deleted.", "success");
                });
            });
            //CUSTOMER Datatable ends here

            $('#suki_type').select2({
                dropdownParent: $('#customer_modal'),
                placeholder: 'Select suki type'
            });
        });
    </script>
@endsection
