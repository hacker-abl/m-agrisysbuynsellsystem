@extends('layouts.admin')

@section('content')
    <div class="container-fluid">
        <div class="block-header">
            <h2>Commodity Dashboard</h2>
        </div>
    </div>
    <div class="modal fade" id="commodity_modal" tabindex="-1" role="dialog">
        <div class="modal-dialog" role="document">
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                <div class="card">
                    <div class="header">
                        <h2 class="modal_title">
                            Add Commodity
                        </h2>
                    </div>
                    <div class="body">
                        <form class="form-horizontal " id="commodity_form">
                            <input type="hidden" name="id" id="id" value="">
                            <input type="hidden" name="button_action" id="button_action" value="">
                            
                            <div class="row clearfix">
                                <div class="col-lg-2 col-md-2 col-sm-4 col-xs-5 form-control-label">
                                    <label for="name">Commodity</label>
                                </div>
                                <div class="col-lg-10 col-md-10 col-sm-8 col-xs-7">
                                    <div class="form-group">
                                        <div class="form-line">
                                            <input type="text" id="name" name="name" class="form-control" placeholder="Enter commodity name" required>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="row clearfix">
                                <div class="col-lg-2 col-md-2 col-sm-4 col-xs-5 form-control-label">
                                    <label for="price">Price</label>
                                </div>
                                <div class="col-lg-10 col-md-10 col-sm-8 col-xs-7">
                                    <div class="form-group">
                                        <div class="form-line">
                                            <input type="number" id="price" name="price" class="form-control" placeholder="Enter price" required>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="row clearfix">
                                <div class="col-lg-2 col-md-2 col-sm-4 col-xs-5 form-control-label">
                                    <label for="suki_price">Suki Price</label>
                                </div>
                                <div class="col-lg-10 col-md-10 col-sm-8 col-xs-7">
                                    <div class="form-group">
                                        <div class="form-line">
                                            <input type="number" id="suki_price" name="suki_price" class="form-control" placeholder="Enter suki price" required>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="row clearfix">
                                <div class="modal-footer">
                                    <button type="submit" id="add_commodity"class="btn btn-link waves-effect">SAVE CHANGES</button>
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
                    <h2>List of commodities as of {{ date('Y-m-d ') }}</h2>
                    <ul class="header-dropdown m-r--5">
                        <li class="dropdown">
                            <button type="button" class="btn bg-grey btn-xs waves-effect m-r-20 open_commodity_modal" data-toggle="modal" data-target="#commodity_modal"><i class="material-icons">library_add</i></button>
                        </li>
                    </ul>
                </div>
                <div class="body">
                    <div class="table-responsive">
                        <table id ="commoditytable" class="table table-bordered table-striped table-hover">
                            <thead>
                                <tr>
                                    <th>Name</th>
                                    <th>Price</th>
                                    <th>Suki Price</th>
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

            $.extend( $.fn.dataTable.defaults, {
                "language": {
                    processing: 'Loading.. Please wait'
                }
            });

            //COMMODITY Datatable starts here
            $('#commodity_modal').on('hidden.bs.modal', function (e) {
                $(this)
                .find("input,textarea,select")
                    .val('')
                    .end()
                .find("input[type=checkbox], input[type=radio]")
                    .prop("checked", "")
                    .end();
            });

            var commoditytable = $('#commoditytable').DataTable({
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
                ajax: "{{ route('refresh_commodity') }}",
                columns: [
                    {data: 'name', name: 'name'},
                    {data: 'price', name: 'price'},
                    {data: 'suki_price', name: 'suki_price'},
                    {data: "action", orderable:false,searchable:false}
                ]
            });

            function refresh_commodity_table(){
                commoditytable.ajax.reload(); //reload datatable ajax
            }

            //Open Commodity Modal
            $(document).on('click','.open_commodity_modal', function(){
                $('.modal_title').text('Add Commodity');
                $('#button_action').val('add');
            });
            
            //Add Commodity
            $(document).on('click', '#add_commodity', function(event){
                event.preventDefault();
                var input = $(this);
                var button =this;
                button.disabled = true;
                input.html('SAVING...'); 
                $.ajax({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    url:"{{ route('add_commodity') }}",
                    method: 'POST',
                    dataType:'text',
                    data: $('#commodity_form').serialize(),
                    success:function(data){
                        swal("Success!", "Record has been added to database", "success")
                        $('#commodity_modal').modal('hide');
                        button.disabled = false;
                        input.html('SAVE CHANGES');
                        refresh_commodity_table();
                    },
                    error: function(data){
                        swal("Oh no!", "Something went wrong, try again.", "error")
                        button.disabled = false;
                        input.html('SAVE CHANGES');
                    }
                })
            });
            
            //Update Commodity
            $(document).on('click', '.update_commodity', function(){
                var id = $(this).attr("id");
                $.ajax({
                    url:"{{ route('update_commodity') }}",
                    method: 'get',
                    data:{id:id},
                    dataType:'json',
                    success:function(data){

                        $('#button_action').val('update');
                        $('#id').val(id);
                        $('#name').val(data.name);
                        $('#price').val(data.price);
                        $('#suki_price').val(data.suki_price);
                        $('#commodity_modal').modal('show');
                        $('.modal_title').text('Update Commodity');
                        refresh_commodity_table();
                    }
                })
            });
            
            //Delete Commodity
            $(document).on('click', '.delete_commodity', function(){
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
                        url:"{{ route('delete_commodity') }}",
                        method: "get",
                        data:{id:id},
                        success:function(data){
                            refresh_commodity_table();
                        }
                    })
				    swal("Deleted!", "The record has been deleted.", "success");
			    });
            });
            //COMMODITY Datatable ends here
        });
    </script>
@endsection