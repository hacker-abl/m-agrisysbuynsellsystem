@extends('layouts.admin')

@section('content')
    <div class="container-fluid">
        <div class="block-header">
            <h2>Users Dashboard</h2>
        </div>
    </div>
    <div class="modal fade" id="user_modal" tabindex="-1" role="dialog">
        <div class="modal-dialog" role="document">
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                <div class="card">
                    <div class="header">
                        <h2 class="modal_title">Add User </h2>
                    </div>
                    <div class="body">
                        <form class="form-horizontal " id="user_form">
                            <input type="hidden" name="id" id="id" value="">
                            <input type="hidden" name="button_action" id="button_action" value="">
                            
                            <div class="row clearfix">
                                <div class="col-lg-2 col-md-2 col-sm-4 col-xs-5 form-control-label">
                                    <label for="type">Employee</label>
                                </div>
                                <div class="col-lg-10 col-md-10 col-sm-8 col-xs-7">
                                    <div class="form-group">
                                        <select id="emp_id" name="emp_id" class="form-control" placeholder="Enter employee" required style="width:100%;">
                                            @foreach($employee as $emp)
                                                @if($employee[$emp->id-1]->cashier->role == 'cashier'||$employee[$emp->id-1]->cashier->role == 'CASHIER')
                                                <option value="{{ $emp->id }}">{{ $emp->lname.", ".$emp->fname." ".$emp->mname }}</option>
                                                @endif
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                            </div>

                            <div class="row clearfix in_password">
                                <div class="col-lg-2 col-md-2 col-sm-4 col-xs-5 form-control-label">
                                    <label for="username">Username</label>
                                </div>
                                <div class="col-lg-10 col-md-10 col-sm-8 col-xs-7">
                                    <div class="form-group">
                                        <div class="form-line">
                                            <input type="text" id="username" name="username" class="form-control" placeholder="Enter user's username"  required>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="row clearfix password_input">
                                <div class="col-lg-2 col-md-2 col-sm-4 col-xs-5 form-control-label">
                                    <label for="password">Password</label>
                                </div>
                                <div class="col-lg-10 col-md-10 col-sm-8 col-xs-7">
                                    <div class="form-group">
                                        <div class="form-line">
                                            <input type="password" id="password" name="password" class="form-control" placeholder="Enter user password"  required>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="row clearfix">
                                <div class="col-lg-2 col-md-2 col-sm-4 col-xs-5 form-control-label">
                                    <label for="password">Cash</label>
                                </div>
                                <div class="col-lg-10 col-md-10 col-sm-8 col-xs-7">
                                    <div class="form-group">
                                        <div class="form-line">
                                            <input type="number" id="cashOnHand" name="cashOnHand" class="form-control" placeholder="Enter user Cash on Hand"  required>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="row clearfix">
                                <div class="modal-footer">
                                    <button type="submit" id="add_user" class="btn btn-link waves-effect">SAVE CHANGES</button>
                                    <button type="button" class="btn btn-link waves-effect" data-dismiss="modal">CLOSE</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="modal fade" id="admin_cash_modal" tabindex="-1" role="dialog">
        <div class="modal-dialog" role="document">
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                <div class="card">
                    <div class="header">
                        <h2 class="modal_title">Add Admin Cash</h2>
                    </div>
                    <div class="body">
                        <form class="form-horizontal " id="admin_cash_form">
                            <input type="hidden" name="id" id="id" value="">

                            <div class="row clearfix">
                                <div class="col-lg-2 col-md-2 col-sm-4 col-xs-5 form-control-label">
                                    <label for="fund">Cash</label>
                                </div>
                                <div class="col-lg-10 col-md-10 col-sm-8 col-xs-7">
                                    <div class="form-group">
                                        <div class="form-line">
                                            <input type="add_admin_cash" id="add_admin_cash" name="add_admin_cash" class="form-control" placeholder="Enter admin Cash on Hand" required>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="row clearfix">
                                <div class="modal-footer">
                                    <button type="submit" id="add_cash" class="btn btn-link waves-effect">SAVE CHANGES</button>
                                    <button type="button" class="btn btn-link waves-effect" data-dismiss="modal">CLOSE</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="modal fade" id="user-permission" tabindex="-1" role="dialog">
        <div class="modal-dialog" role="document">
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                <div class="card">
                    <form class="form-horizontal " id="user-permission-form">
                        @csrf
                        <input type="hidden" name="id" value="">
                        <div class="header">
                            <h2 class="modal_title">Permissions </h2>
                        </div>
                        <div class="body">
                            <div class="col-md-12 text-center">
                                <div class="preloader pl-size-xl">
                                    <div class="spinner-layer">
                                        <div class="circle-clipper left">
                                            <div class="circle"></div>
                                        </div>
                                        <div class="circle-clipper right">
                                            <div class="circle"></div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="demo-checkbox hidden">
                                @if($permissions)
                                    @foreach($permissions as $key=>$permission)
                                    <input type="checkbox" id="permission{{$permission->id}}" class="chk-col-red" name="permission[]" value="{{$permission->id}}">
                                    <label for="permission{{$permission->id}}">{{$permission->name}}</label>
                                    @endforeach
                                @endif
                            </div>
                        </div>
                        <div class="modal-footer">
                        <button type="submit" class="btn btn-link waves-effect">SAVE CHANGES</button>
                            <button type="button" class="btn btn-link waves-effect" data-dismiss="modal">CLOSE</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <div class="row clearfix">
        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
            <div class="card">
                <div class="header">
                    <h2>List of users as of {{ date('Y-m-d ') }}</h2>
                    <ul class="header-dropdown m-r--5">
                        <li class="dropdown">
                            <button type="button" class="btn bg-grey btn-xs waves-effect m-r-20 open_admin_modal" data-toggle="modal" data-target="#admin_cash_modal"><i class="material-icons">account_balance_wallet</i></button>
                            <button type="button" class="btn bg-grey btn-xs waves-effect m-r-20 open_user_modal" data-toggle="modal" data-target="#user_modal"><i class="material-icons">library_add</i></button>
                        </li>
                    </ul>
                </div>
                <div class="body">
                    <div class="table-responsive">
                        <table id="usertable" class="table table-bordered table-striped table-hover" width="100%">
                            <thead>
                                <tr>
                                    <th>Name</th>
                                    <th>Username</th>
                                    <th>Access Level</th>
                                    <th>Cash On Hand</th>
                                    <th width="100">Action</th>
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
            $('#emp_id').select2({
            dropdownParent: $('#user_modal'),
            placeholder: 'Select an option'
        });
            $.extend( $.fn.dataTable.defaults, {
                "language": {
                    processing: 'Loading.. Please wait'
                }
            });
            
            //USER Datatable starts here
            $('#user_modal').on('hidden.bs.modal', function (e) {
                $(this)
                .find("input,textarea,select")
                    .val('')
                    .end()
                .find("input[type=checkbox], input[type=radio]")
                    .prop("checked", "")
                    .end();
            })
            var usertable = $('#usertable').DataTable({
                dom: 'Bfrtip',
                buttons: [
                ],
                processing: true,
                columnDefs: [
  				{
    			  	"targets": "_all", // your case first column
     				"className": "text-center",
 				}
				],
                serverSide: true,
                ajax: "{{ route('refresh_user') }}",
                columns: [
                    {data: 'emp_id', name: 'emp_id'},
                    {data: 'username', name: 'username'},
                    {data: 'access_id', name: 'access_id'},
                    {data: 'cashOnHand', name: 'cashOnHand'},
                    {data: "action", orderable:false,searchable:false}
                ]
            });

            function refresh_user_table(){
                usertable.ajax.reload(); //reload datatable ajax
            }

            //Open User Modal
            $(document).on('click','.open_user_modal', function(){
                $("#emp_id").val('').trigger('change');
                $('.open_user_modal .modal_title').text('Add User');
                $('#button_action').val('add');
                //Generate input for password when adding User
                if(!$(".password_input")[0]){
                    $('<div class="row clearfix password_input">'+
                        '<div class="col-lg-2 col-md-2 col-sm-4 col-xs-5 form-control-label">'+
                            '<label for="password">Password</label>'+
                        '</div>'+
                        '<div class="col-lg-10 col-md-10 col-sm-8 col-xs-7">'+
                            '<div class="form-group">'+
                                '<div class="form-line">'+
                                    '<input type="password" id="password" name="password" class="form-control" placeholder="Enter user password"  required>'+
                                '</div>'+
                            '</div>'+
                        '</div>'+
                    '</div>'
                    ).insertAfter(".in_password");
                }
            });

            //Open Admin Cash Modal
            $(document).on('click', '.open_admin_modal', function(event){
                event.preventDefault();
                $.ajax({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    url:"{{ route('get_balance') }}",
                    method: 'POST',
                    dataType:'text',
                    success:function(data){
                        $('#add_admin_cash').val(data);
                    },
                    error: function(data){
                        swal("Oh no!", "Something went wrong, try again.", "error")
                    }
                })
            });

            //Add Admin Cash Modal
            $(document).on('click', '#add_cash', function(event){
                event.preventDefault();
                var input = $(this);
                var button =this;
                button.disabled = true;
                input.html('SAVING...'); 
                $.ajax({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    url:"{{ route('add_cash') }}",
                    method: 'POST',
                    dataType:'text',
                    data: $('#admin_cash_form').serialize(),
                    success:function(data){
                        button.disabled = false;
                        input.html('SAVE CHANGES');
                        swal("Cash Added!", "Remaining Balance: ₱"+parseFloat(data).toFixed(2), "success")
                        $('#admin_cash_modal').modal('hide');
                        $('#curCashOnHand').html(parseFloat(data).toFixed(2));
                    },
                    error: function(data){
                        swal("Oh no!", "Something went wrong, try again.", "error")
                        button.disabled = false;
                        input.html('SAVE CHANGES');
                    }
                })
            });

            //Add User
            $(document).on('click', '#add_user', function(event){
                event.preventDefault();
                var input = $(this);
                var button =this;
                button.disabled = true;
                input.html('SAVING...'); 
                $.ajax({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    url:"{{ route('add_user') }}",
                    method: 'POST',
                    dataType:'text',
                    data: $('#user_form').serialize(),
                    success:function(data){
                        button.disabled = false;
                        input.html('SAVE CHANGES');
                        swal("Success!", "Record has been added to database", "success")
                        $('#user_modal').modal('hide');
                        refresh_user_table();
                    },
                    error: function(data){
                        swal("Oh no!", "Something went wrong, try again.", "error")
                        button.disabled = false;
                        input.html('SAVE CHANGES');
                    }
                })
            });

            //Update User
            $(document).on('click', '.update_user', function(){
                var id = $(this).attr("id");
                $.ajax({
                    url:"{{ route('update_user') }}",
                    method: 'get',
                    data:{id:id},
                    dataType:'json',
                    success:function(data){
                        
                        //Remove password input when updating User
                        if($(".password_input")[0]){
                            $(".password_input").remove();
                        }
                        $('#button_action').val('update');
                        $('#id').val(id);
                        $('#emp_id').val(data.emp_id);
                        $("#emp_id").change();
                        $('#username').val(data.username);
                        $('#cashOnHand').val(data.cashOnHand);
                        $('.update_user .modal_title').text('Update User');
                        $('#user_modal').modal('show');
                        refresh_user_table();
                        console.log($('#user_form').serialize());
                    }
                })
            });

            $(document).on('click', '.delete_user', function(){
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
                        url:"{{ route('delete_user') }}",
                        method: "get",
                        data:{id:id},
                        success:function(data){
                            refresh_user_table();
                        }
                    })
				swal("Deleted!", "The record has been deleted.", "success");
			    });
            });
            //USER Datatable ends here
        });

        $("#user-permission").on('shown.bs.modal', function(e) {
            var id = $(e.relatedTarget).data('id');
            
            $.ajax({
                url: '/get/permission',
                method: 'GET',
                data: {id: id},
                dataType: 'json',
                beforeSend: function() {
                    $('#user-permission form#user-permission-form .preloader').removeClass('hidden');
                    $('#user-permission form#user-permission-form .demo-checkbox').addClass('hidden');
                },
                success: function(data) {
                    $.each(data.userpermission, function(i, val){
                        if(val.permit != 0)
                        $('#user-permission form#user-permission-form input[id="permission'+val.permission_id+'"]').prop('checked', true);
                    });
                    
                    $('#user-permission form#user-permission-form .preloader').addClass('hidden');
                    $('#user-permission form#user-permission-form .demo-checkbox').removeClass('hidden');
                }
            })
            
            $('#user-permission form#user-permission-form input[name="id"]').val(id);
        });

        $("#user-permission").on('hidden.bs.modal', function(e) {
            $('#user-permission form#user-permission-form input[type="checkbox"]').prop('checked', false);
            $('#user-permission form#user-permission-form .demo-checkbox').addClass('hidden');
        });

        $('form#user-permission-form').submit(function(e) {
            e.preventDefault();
            var data = $(this).serialize();

            $.ajax({
                url: '{{route("permission", "update")}}',
                method:'POST',
                data: data,
                dataType: 'json',
                success: function(data) {
                    if(data) {
                        swal("Success!", "Permission has been updated!", "success");
                        $('#user-permission').modal('hide');
                    }
                },
                error: function(err) {
                    swal("Error!", "Something went wrong! Please try again.", "error");
                }
            });
        });
    </script>
@endsection