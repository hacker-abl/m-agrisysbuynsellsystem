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
            <li class="active">
                <a href="{{ route('employee') }}">
                    <i class="material-icons">supervisor_account</i>
                    <span>Employee</span>
                </a>
            </li>
            <li>
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
            <h2>Employee Dashboard</h2>
        </div>
    </div>
    <div class="modal fade" id="employee_modal" tabindex="-1" role="dialog">
        <div class="modal-dialog" role="document">
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                <div class="card">
                    <div class="header">
                        <h2 class="modal_title">Add Employee</h2>
                    </div>
                    <div class="body">
                        <form class="form-horizontal " id="employee_form">
                            <input type="hidden" name="id" id="id" value="">
                            <input type="hidden" name="button_action" id="button_action" value="">
                            
                            <div class="row clearfix">
                                <div class="col-lg-2 col-md-2 col-sm-4 col-xs-5 form-control-label">
                                    <label for="fname">First Name</label>
                                </div>
                                <div class="col-lg-10 col-md-10 col-sm-8 col-xs-7">
                                    <div class="form-group">
                                        <div class="form-line">
                                            <input type="text" id="fname" name="fname" class="form-control" placeholder="Enter employee's first name"  required>
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
                                            <input type="text" id="mname" name="mname" class="form-control" placeholder="Enter employee's middle name"  required>
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
                                            <input type="text" id="lname" name="lname" class="form-control" placeholder="Enter employee's last name"  required>
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
                                        <select type="text" id="role_id" name="role_id" class="form-control" placeholder="Enter employee type" required style="width:100%;">
                                            @foreach($roles as $key => $role)
                                            <option value="{{ $key }}">{{ $role }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                            </div>

                            <div class="row clearfix">
                                <div class="modal-footer">
                                    <button type="submit" id="add_employee" class="btn btn-link waves-effect">SAVE CHANGES</button>
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
                    <h2>List of employees as of {{ date('Y-m-d ') }}</h2>
                    <ul class="header-dropdown m-r--5">
                        <li class="dropdown">
                            <button type="button" class="btn bg-grey btn-xs waves-effect m-r-20 open_employee_modal" data-toggle="modal" data-target="#employee_modal"><i class="material-icons">library_add</i></button>
                        </li>
                    </ul>
                </div>
                <div class="body">
                    <div class="table-responsive">
                        <table id="employeetable" class="table table-bordered table-striped table-hover">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Name</th>
                                    <th>Type</th>
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
            
            //EMPLOYEE Datatable starts here
            $('#employee_modal').on('hidden.bs.modal', function (e) {
                $(this)
                .find("input,textarea,select")
                    .val('')
                    .end()
                .find("input[type=checkbox], input[type=radio]")
                    .prop("checked", "")
                    .end();
            })

            var employeetable = $('#employeetable').DataTable({
                dom: 'Bfrtip',
                buttons: [
                ],
                processing: true,
                serverSide: true,
                ajax: "{{ route('refresh_employee') }}",
                columns: [
                    {data: 'id', name: 'id'},
                    {render:function(data, type, full, meta){
                        return full.fname + " " + full.mname + " " + full.lname;
                    }},
                    {data: 'role_id', name: 'role_id'},
                    {data: "action", orderable:false,searchable:false}
                ]
            });

            function refresh_employee_table(){
                employeetable.ajax.reload(); //reload datatable ajax
            }

            //Open Employee Modal
            $(document).on('click','.open_employee_modal', function(){
                $('.modal_title').text('Add Employee');
                $('#button_action').val('add');
            });

            //Add Employee
            $(document).on('click', '#add_employee', function(){
                event.preventDefault();
                $.ajax({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    url:"{{ route('add_employee') }}",
                    method: 'POST',
                    dataType:'text',
                    data: $('#employee_form').serialize(),
                    success:function(data){
                        swal("Success!", "Record has been added to database", "success")
                        $('#employee_modal').modal('hide');
                        refresh_employee_table();
                    },
                    error: function(data){
                        swal("Oh no!", "Something went wrong, try again.", "error")
                    }
                })
            });

            //Update Employee
            $(document).on('click', '.update_employee', function(){
                var id = $(this).attr("id");
                $.ajax({
                    url:"{{ route('update_employee') }}",
                    method: 'get',
                    data:{id:id},
                    dataType:'json',
                    success:function(data){
                        $('#button_action').val('update');
                        $('#id').val(id);
                        $('#fname').val(data.fname);
                        $('#mname').val(data.mname);
                        $('#lname').val(data.lname);
                        $('#role_id').val(data.role_id);
                        $('#employee_modal').modal('show');
                        $('.modal_title').text('Update Employee');
                        refresh_employee_table();
                    }
                })
            });

            //Delete Employee
            $(document).on('click', '.delete_employee', function(){
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
                        url:"{{ route('delete_employee') }}",
                        method: "get",
                        data:{id:id},
                        success:function(data){
                            refresh_employee_table();
                        }
                    })
				    swal("Deleted!", "The record has been deleted.", "success");
			    });
            });
            //EMPLOYEE Datatable ends here

            $('#role_id').select2({
                dropdownParent: $('#employee_modal'),
                placeholder: 'Select an option'
            });
        });
    </script>
@endsection