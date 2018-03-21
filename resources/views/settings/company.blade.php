@extends('layouts.admin')
			@section('sidenav')
				    <div class="menu">
     <ul class="list">
                    <li class="header">MANAGE SETTINGS</li>
                    <li class="active">
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
					<li >
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
										<li >
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
                <h2>
                    Company Dashboard
                </h2>
            </div>
        </div>
		<div class="modal fade" id="company_modal" tabindex="-1" role="dialog">
                <div class="modal-dialog" role="document">

                            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <div class="card">
                        <div class="header">
                            <h2 class="modal_title">
                               Add Company
                            </h2>
                        </div>
                        <div class="body">
                            <form class="form-horizontal " id="company_form">
                                <input type="hidden" name="id" id="id" value="">
                                <input type="hidden" name="button_action" id="button_action" value="">
                                <div class="row clearfix">
                                    <div class="col-lg-2 col-md-2 col-sm-4 col-xs-5 form-control-label">
                                        <label for="name">Company</label>
                                    </div>
                                    <div class="col-lg-10 col-md-10 col-sm-8 col-xs-7">
                                        <div class="form-group">
                                            <div class="form-line">
                                                <input type="text" id="name" name="name" class="form-control" placeholder="Enter company name"  required>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="row clearfix">
                                    <div class="modal-footer">
                                    <button type="submit" id="add_company" class="btn btn-link waves-effect">SAVE CHANGES</button>
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
                                List of companies as of {{ date('Y-m-d ') }}
                            </h2>
                            <ul class="header-dropdown m-r--5">
                                <li class="dropdown">
                                     <button type="button" class="btn bg-grey btn-xs waves-effect m-r-20 open_company_modal" data-toggle="modal" data-target="#company_modal"><i class="material-icons">library_add</i></button>
                                </li>
                            </ul>
                        </div>
                        <div class="body">
                            <div class="table-responsive">
                                <table id="companytable" class="table table-bordered table-striped table-hover  ">
                                    <thead>
                                        <tr>
                                            <th>No</th>
                                            <th>Name</th>
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
