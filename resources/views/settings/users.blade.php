@extends(isAdmin() ? 'layouts.admin' : 'layouts.user')

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
                        <h2 class="modal_title">Add User</h2>
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
                                            @foreach($employee as $key => $emp)
                                                @if(strcasecmp($employee[$key]->cashier->role, 'cashier') == 0 || strcasecmp($employee[$key]->cashier->role, 'manager') == 0 || strcasecmp($employee[$key]->cashier->role, 'secretary') == 0 || strcasecmp($employee[$key]->cashier->role, 'purchaser') == 0)
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
    <div class="modal fade" id="add_cash_modal" tabindex="-1" role="dialog">
        <div class="modal-dialog" role="document">
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                <div class="card">
                    <div class="header">
                        <h2 class="modal_title">Add Cash</h2>
                    </div>
                    <div class="body">
                        <form class="form-horizontal" id="cash_form">
                            <input type="hidden" id="add_cash_id" name="add_cash_id" value="">
                            <input type="hidden" id="add_cash_access_id" name="add_cash_access_id" value="">

                            <div class="row clearfix">
                                <div class="col-lg-2 col-md-2 col-sm-4 col-xs-5 form-control-label">
                                    <label for="trans_no">Transaction Number</label>
                                </div>
                                <div class="col-lg-10 col-md-10 col-sm-8 col-xs-7">
                                    <div class="form-group">
                                        <div class="form-line">
                                            <input type="text" id="trans_no" name="trans_no" class="form-control" required readonly>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="row clearfix">
                                <div class="col-lg-2 col-md-2 col-sm-4 col-xs-5 form-control-label">
                                    <label for="add_cash_username">Username</label>
                                </div>
                                <div class="col-lg-10 col-md-10 col-sm-8 col-xs-7">
                                    <div class="form-group">
                                        <div class="form-line">
                                            <input type="text" id="add_cash_username" name="add_cash_username" class="form-control" required readonly>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="row clearfix">
                                <div class="col-lg-2 col-md-2 col-sm-4 col-xs-5 form-control-label">
                                    <label for="current_cash">Current Cash</label>
                                </div>
                                <div class="col-lg-10 col-md-10 col-sm-8 col-xs-7">
                                    <div class="form-group">
                                        <div class="form-line">
                                            <input type="number" id="current_cash" name="current_cash" class="form-control" required readonly>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="row clearfix">
                                <div class="col-lg-2 col-md-2 col-sm-4 col-xs-5 form-control-label">
                                    <label for="add_cash">Add Cash</label>
                                </div>
                                <div class="col-lg-10 col-md-10 col-sm-8 col-xs-7">
                                    <div class="form-group">
                                        <div class="form-line">
                                            <input type="number" onkeyup="addTotal(this)" id="add_cash" name="add_cash" class="form-control" placeholder="Enter cash amount to be added" required>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="row clearfix">
                                <div class="col-lg-2 col-md-2 col-sm-4 col-xs-5 form-control-label">
                                    <label for="total_cash">Total Cash</label>
                                </div>
                                <div class="col-lg-10 col-md-10 col-sm-8 col-xs-7">
                                    <div class="form-group">
                                        <div class="form-line">
                                            <input type="number" id="total_cash" name="total_cash" class="form-control" required readonly>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="row clearfix">
                                <div class="modal-footer">
                                    <button type="submit" id="add_cash_submit" class="btn btn-link waves-effect">SAVE CHANGES</button>
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
                            <h2 class="modal_title">Permissions</h2>
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
                                    <div class="container-fluid">Default</div>
                                    <div class="container-fluid">
                                        <div class="col-md-12">
                                              
                                            @foreach($permissions as $key=>$permission)
                                           
                                                @if (strpos($permission->middleware, 'manage') === false)
                                               <div class="col-sm" id="checkbox_group">
                                                    <input type="checkbox" id="permission{{$permission->id}}" class="chk-col-red" name="permission[]" value="{{$permission->id}}">
                                                    <label style="font-weight: bold;" for="permission{{$permission->id}}">{{$permission->name}}</label>
                                                    <input type="checkbox" id="edit_permission{{$permission->id}}" class="chk-col-red" name="edit_permission[]" value="{{$permission->id}}" disabled="">
                                                    <label style="font-style: italic;" for="edit_permission{{$permission->id}}">Edit</label>
                                                    <input type="checkbox" id="delete_permission{{$permission->id}}" class="chk-col-red" name="delete_permission[]" value="{{$permission->id}}" disabled="">
                                                    <label style="font-style: italic;" for="delete_permission{{$permission->id}}">Delete</label>
                                                </div>
                                                @endif 
                                                
                                            @endforeach
                                           
                                        </div>     
                                    </div>
                                    <div class="container-fluid">Manage</div> 
                                    <div class="container-fluid">
                                        <div class="col-md-12">
                                            @foreach($permissions as $key=>$permission)
                                                @if (strpos($permission->middleware, 'manage') !== false)
                                                 <div class="col-sm" id="checkbox_group_manage">
                                                    <input type="checkbox" id="permission{{$permission->id}}" class="chk-col-red" name="permission[]" value="{{$permission->id}}">
                                                    <label style="font-weight: bold;" for="permission{{$permission->id}}">{{$permission->name}}</label>
                                                    <input type="checkbox" id="edit_permission{{$permission->id}}" class="chk-col-red" name="edit_permission[]" value="{{$permission->id}}" disabled="">
                                                    <label style="font-style: italic;" for="edit_permission{{$permission->id}}">Edit</label>
                                                    <input type="checkbox" id="delete_permission{{$permission->id}}" class="chk-col-red" name="delete_permission[]" value="{{$permission->id}}" disabled="">
                                                    <label style="font-style: italic;" for="delete_permission{{$permission->id}}">Delete</label>
                                                </div>
                                                @endif
                                            @endforeach
                                        </div>
                                    </div>
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
                            <button type="button" class="btn bg-grey btn-xs waves-effect m-r-20 view_cash_history" id="{{ auth::user()->id }}" data-toggle="modal" data-target="#cash_view_modal"><i class="material-icons">visibility</i></button>
                            <button type="button" class="btn bg-grey btn-xs waves-effect m-r-20 open_add_cash_modal" id="{{ auth::user()->id }}" data-toggle="modal" data-target="#add_cash_modal"><i class="material-icons">account_balance_wallet</i></button>
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
                                    <th width="180">Action</th>
                                </tr>
                            </thead>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="cash_view_modal" tabindex="-1" role="dialog">
        <div class="modal-dialog modal-lg" role="document">
            <div class="row">            
                <div class="card">
                    <div class="header">
                        <h2>Cash History - <span class="modal_title_cash"></span> as of {{ date('Y-m-d ') }}</h2>
                    </div>
                    <div class="body">
                        <div class="table-responsive">
                        <br>
                            <table id="cash_history_table" class="table table-bordered table-striped table-hover" style="width: 100%;">
                               <thead>
                                    <tr>
                                        <th>Transaction ID</th>
                                        <th>Previous Amount</th>
                                        <th>Change in Cash</th>
                                        <th>Total Cash</th>
                                        <th>Type</th>
                                        <th>Date/Time</th>
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
    <!-- #END# Exportable Table -->
@endsection

@section('script')
    <script>
        $(document).on("click","#link",function(){
            $("#bod").toggleClass('overlay-open');
        });

         $(":checkbox").change(function(){
            var suffix = this.id.match(/\d+/); // 123456
            if ($("#permission"+suffix).is(':checked')){
                            $("#delete_permission"+suffix).removeAttr("disabled");
                            $("#edit_permission"+suffix).removeAttr("disabled");
            }else{
                 $("#delete_permission"+suffix).attr('disabled', 'disabled');
                 $("#edit_permission"+suffix).attr('disabled', 'disabled');
                 $("#delete_permission"+suffix).prop('checked', false);
                 $("#edit_permission"+suffix).prop('checked', false);
            }
          });


        $(document).ready(function() {

            document.title = "M-Agri - Users";


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
            $('#add_cash_modal').on('hidden.bs.modal', function (e) {
                $(this)
                .find("input,textarea,select")
                    .val('')
                    .end()
            })
            var usertable = $('#usertable').DataTable({
                dom: 'Bfrtip',
                buttons: [
                    {
                        extend: 'print',
                        exportOptions: {
                            columns: [ 0, 1, 2, 3]
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

            //Open Cash Modal
            $(document).on('click', '.open_add_cash_modal', function(event){
                event.preventDefault();
                var id = $(this).attr("id");
                $.ajax({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    url:"{{ route('get_balance') }}",
                    data:{id:id},
                    method: 'POST',
                    dataType:'json',
                    success:function(data){
                        $('#trans_no').val(data.trans_no);
                        $('#add_cash_id').val(data.id);
                        $('#add_cash_access_id').val(data.access_id);
                        $('#add_cash_username').val(data.username);
                        $('#current_cash').val(data.cashOnHand);
                        $('#add_cash').val("");
                        $('#total_cash').val($('#current_cash').val());
                    },
                    error: function(data){
                        swal("Oh no!", "Something went wrong, try again.", "error")
                    }
                })
            });

            //Add Cash
            $(document).on('click', '#add_cash_submit', function(event){
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
                    dataType:'json',
                    data: $('#cash_form').serialize(),
                    success:function(data){
                        button.disabled = false;
                        input.html('SAVE CHANGES');
                        swal("Cash Added!", "Remaining Balance: ₱"+parseFloat(data.cashOnHand).toFixed(2)+" | Transaction ID: "+data.cashHistory, "success");
                        $('#add_cash_modal').modal('hide');
                        if($('#add_cash_access_id').val() == 1){
                            $('#curCashOnHand').html(parseFloat(data.cashOnHand).toFixed(2));
                        }
                        else{
                            refresh_user_table();
                        }
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
                        $('.update_user .modal_title').text('Update User');
                        $('#user_modal').modal('show');
                        refresh_user_table();
                    }
                })
            });

            $(document).on('click', '.delete_user', function(){
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
                        url:"{{ route('delete_user') }}",
                        method: "get",
                        data:{id:id},
                        success:function(data){
                            refresh_user_table();
                        }
                    })
				swal("Deleted!", "The record has been deleted.", "success");
                    }
			    })
            });
            //USER Datatable ends here

            //CASH History Daatatable starts here
            $(document).on('click', '.view_cash_history', function(){
                var id = $(this).attr('id');
                
                $.ajax({
                    url: "{{ route('view_cash_history') }}",
                    method: 'get',
                    data: {id:id},
                    dataType: 'json',
                    success:function(data){
                        $('.modal_title_cash').text(data.data[0].user.username);

                        $('#cash_history_table').DataTable({
                            dom: 'Bfrtip',
                            destroy: true,
                            buttons: [
                                {
                                    extend: 'print',
                                    exportOptions: {
                                        columns: [ 0, 1, 2, 3, 4, 5]
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
                            data:data.data,
                            processing: true,
                            columnDefs: [{
                                "targets": "_all", // your case first column
                                "className": "text-center",
                            }],
                            order: [ 0 ],
                            columns: [
                                {data: 'trans_no', name: 'trans_no'},
                                {data: 'previous_cash', name: 'previous_cash'},
                                {data: 'cash_change', name: 'cash_change'},
                                {data: 'total_cash', name: 'total_cash'},
                                {data: 'type', name: 'type'},
                                {data: 'created_at', name: 'created_at'}
                            ]
                        });
                    }
                })
            });

            //CASH History Datatable ends here
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
                    console.log(data);
                    $.each(data.userpermission, function(i, val){
                        
                        if(val.permit != 0)
                        $('#user-permission form#user-permission-form input[id="permission'+val.permission_id+'"]').prop('checked', true);
                        if ($("#permission"+val.permission_id).is(':checked')){
                            $("#delete_permission"+val.permission_id).removeAttr("disabled");
                            $("#edit_permission"+val.permission_id).removeAttr("disabled");
                        }
                        if(val.permit_delete != 0)
                        $('#user-permission form#user-permission-form input[id="delete_permission'+val.permission_id+'"]').prop('checked', true);
                        if(val.permit_edit != 0)
                        $('#user-permission form#user-permission-form input[id="edit_permission'+val.permission_id+'"]').prop('checked', true);
                    });
                    
                    $('#user-permission form#user-permission-form .preloader').addClass('hidden');
                    $('#user-permission form#user-permission-form .demo-checkbox').removeClass('hidden');
                }
            })
            
            $('#user-permission form#user-permission-form input[name="id"]').val(id);
        });

        $("#user-permission").on('hidden.bs.modal', function(e) {
            $('#user-permission form#user-permission-form input[type="checkbox"]').prop('checked', false);
            for (var i =1; i <= 12; i++) {
              $('#user-permission form#user-permission-form input[id="edit_permission'+i+'"]').attr('disabled', 'disabled');
              $('#user-permission form#user-permission-form input[id="delete_permission'+i+'"]').attr('disabled', 'disabled');
            }
            
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
                    console.log(data);
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

        function addTotal(tempAdd){
            var total_cash = $('#total_cash');
            var current_cash = $('#current_cash');

            if($(tempAdd).val() == "" || $(tempAdd).val().includes("e")){
                $('#total_cash').val($('#current_cash').val());
            }
            else{
                total_cash.val(parseFloat(current_cash.val()) + parseFloat($(tempAdd).val()));
            }
        }
    </script>
@endsection