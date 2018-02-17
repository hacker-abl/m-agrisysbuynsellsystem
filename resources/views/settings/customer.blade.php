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
                       </ul>
                       </div>
@endsection
@section('content')
    <div class="container-fluid">
           <div class="block-header">
                <h2>
                    Customer Dashboard
                </h2>
            </div>
        </div>
		<div class="modal fade" id="defaultModal" tabindex="-1" role="dialog">
                <div class="modal-dialog" role="document">
                 
                            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <div class="card">
                        <div class="header">
                            <h2>
                               Add Customer
                            </h2>
                        </div>
                        <div class="body">
                            <form class="form-horizontal " id="form_validation" method="POST">
                                <div class="row clearfix">
                                    <div class="col-lg-2 col-md-2 col-sm-4 col-xs-5 form-control-label">
                                        <label for="Customer">Customer</label>
                                    </div>
                                    <div class="col-lg-10 col-md-10 col-sm-8 col-xs-7">
                                        <div class="form-group">
                                            <div class="form-line">
                                                <input type="text" id="Customer" name="Customer" class="form-control" placeholder="Enter customer name"  required>
                                            </div>
                                        </div>
                                    </div>
                                </div>
								
                                <div class="row clearfix">
									 <div class="modal-footer">
                            <button type="submit" class="btn btn-link waves-effect">SAVE CHANGES</button>
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
                            <h2>
                                List of customers as of {{ date('Y-m-d ') }}
                            </h2>
                            <ul class="header-dropdown m-r--5">
                                <li class="dropdown">
                                     <button type="button" class="btn bg-grey btn-xs waves-effect m-r-20" data-toggle="modal" data-target="#defaultModal"><i class="material-icons">library_add</i></button>
                                </li>
                            </ul>
                        </div>
                        <div class="body">
                            <div class="table-responsive">
                                <table id ="Customer_table" class="table table-bordered table-striped table-hover  ">
                                    <thead>
                                        <tr>
                                            <th>No</th>
                                            <th>Name</th>
                                            <th>Suki</th>
                                            <th width="45">Action</th>
                                        </tr>
                                    </thead>

                                    <tbody>
                                        <tr>
                                            <td>1</td>
                                            <td>Michael Jandayan</td>
                                            <td>Yes</td>
                                            <td>
                                            <button class="btn btn-xs btn-warning"><i class="material-icons">mode_edit</i></button>
                                            <button class="btn btn-xs btn-danger"><i class="material-icons">delete</i></button>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>2</td>
                                            <td>Michael Jandayan</td>
                                            <td>No</td>
                                            <td>
                                            <button class="btn btn-xs btn-warning"><i class="material-icons">mode_edit</i></button>
                                            <button class="btn btn-xs btn-danger"><i class="material-icons">delete</i></button>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>3</td>
                                            <td>Michael Jandayan</td>
                                            <td>No</td>
                                            <td>
                                            <button class="btn btn-xs btn-warning"><i class="material-icons">mode_edit</i></button>
                                            <button class="btn btn-xs btn-danger"><i class="material-icons">delete</i></button>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>4</td>
                                            <td>Michael Jandayan</td>
                                            <td>Yes</td>
                                            <td>
                                            <button class="btn btn-xs btn-warning"><i class="material-icons">mode_edit</i></button>
                                            <button class="btn btn-xs btn-danger"><i class="material-icons">delete</i></button>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- #END# Exportable Table -->
        
@endsection