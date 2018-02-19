<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>
  <meta charset="UTF-8">
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <title>Sign In | Bootstrap Based Admin Template - Material Design</title>
    <!-- Favicon-->
    <link rel="icon" href="../../favicon.ico" type="image/x-icon">

    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Roboto:400,700&subset=latin,cyrillic-ext" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet" type="text/css">


    <!-- Styles -->
    @if (App::isLocal())    
        <!-- Sweet Alert Css -->
        <link href="{{ asset('assets/plugins/sweetalert/sweetalert.css') }}" rel="stylesheet" />
        
        <!-- Bootstrap Core Css -->
        <link href="{{ asset('assets/plugins/bootstrap/css/bootstrap.css') }}" rel="stylesheet">

        <!-- Waves Effect Css -->
        <link href="{{ asset('assets/plugins/node-waves/waves.css') }}" rel="stylesheet" />

        <!-- Animation Css -->
        <link href="{{ asset('assets/plugins/animate-css/animate.css') }}" rel="stylesheet" />
      
        <!-- Morris Chart Css-->
        <link href="{{ asset('assets/plugins/morrisjs/morris.css') }}" rel="stylesheet" />
        <link href="{{ asset('assets/css/themes/all-themes.css') }}" rel="stylesheet" />
        
        <!-- JQuery DataTable Css -->
        <link href="{{ asset('assets/plugins/jquery-datatable/skin/bootstrap/css/dataTables.bootstrap.css') }}" rel="stylesheet">
        
        <!-- Custom Css -->
        <link href="{{ asset('assets/css/style.css') }}" rel="stylesheet">
    @else
        @if (Request::server('HTTP_X_FORWARDED_PROTO') == 'http')
        <!-- Sweet Alert Css -->
        <link href="{{ asset('assets/plugins/sweetalert/sweetalert.css') }}" rel="stylesheet" />
        
        <!-- Bootstrap Core Css -->
        <link href="{{ asset('assets/plugins/bootstrap/css/bootstrap.css') }}" rel="stylesheet">

        <!-- Waves Effect Css -->
        <link href="{{ asset('assets/plugins/node-waves/waves.css') }}" rel="stylesheet" />

        <!-- Animation Css -->
        <link href="{{ asset('assets/plugins/animate-css/animate.css') }}" rel="stylesheet" />
      
        <!-- Morris Chart Css-->
        <link href="{{ asset('assets/plugins/morrisjs/morris.css') }}" rel="stylesheet" />
        <link href="{{ asset('assets/css/themes/all-themes.css') }}" rel="stylesheet" />
        
        <!-- JQuery DataTable Css -->
        <link href="{{ asset('assets/plugins/jquery-datatable/skin/bootstrap/css/dataTables.bootstrap.css') }}" rel="stylesheet">
        
        <!-- Custom Css -->
        <link href="{{ asset('assets/css/style.css') }}" rel="stylesheet">
        @else
        <!-- Sweet Alert Css -->
        <link href="{{ secure_asset('assets/plugins/sweetalert/sweetalert.css') }}" rel="stylesheet" />
        
        <!-- Bootstrap Core Css -->
        <link href="{{ secure_asset('assets/plugins/bootstrap/css/bootstrap.css') }}" rel="stylesheet">

        <!-- Waves Effect Css -->
        <link href="{{ secure_asset('assets/plugins/node-waves/waves.css') }}" rel="stylesheet" />

        <!-- Animation Css -->
        <link href="{{ secure_asset('assets/plugins/animate-css/animate.css') }}" rel="stylesheet" />
      
        <!-- Morris Chart Css-->
        <link href="{{ secure_asset('assets/plugins/morrisjs/morris.css') }}" rel="stylesheet" />
        <link href="{{ secure_asset('assets/css/themes/all-themes.css') }}" rel="stylesheet" />
        
        <!-- JQuery DataTable Css -->
        <link href="{{ secure_asset('assets/plugins/jquery-datatable/skin/bootstrap/css/dataTables.bootstrap.css') }}" rel="stylesheet">
        
        <!-- Custom Css -->
        <link href="{{ secure_asset('assets/css/style.css') }}" rel="stylesheet">
        @endif
    @endif
    
</head>
<body class="theme-grey">
    <!-- Page Loader -->
    <div class="page-loader-wrapper">
        <div class="loader">
            <div class="preloader">
                <div class="spinner-layer pl-grey">
                    <div class="circle-clipper left">
                        <div class="circle"></div>
                    </div>
                    <div class="circle-clipper right">
                        <div class="circle"></div>
                    </div>
                </div>
            </div>
            <p>Initializing...</p>
        </div>
    </div>
    <!-- #END# Page Loader -->
    <!-- Overlay For Sidebars -->
    <div class="overlay"></div>
    <!-- #END# Overlay For Sidebars -->
    <!-- Search Bar -->
    <div class="search-bar">
        <div class="search-icon">
            <i class="material-icons">search</i>
        </div>
        <input type="text" placeholder="START TYPING...">
        <div class="close-search">
            <i class="material-icons">close</i>
        </div>
    </div>
    <!-- #END# Search Bar -->
    <!-- Top Bar -->
    <nav class="navbar">
        <div class="container-fluid">
            <div class="navbar-header">
                <a href="javascript:void(0);" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar-collapse" aria-expanded="false"></a>
                <a href="javascript:void(0);" class="bars"></a>
                <a class="navbar-brand" href="index.html">*INSERT LOGO* M-AGRI Buy and Sell	</a>
            </div>
            <div class="collapse navbar-collapse" id="navbar-collapse">
                <ul class="nav navbar-nav navbar-right">
                    <!-- Call Search -->
                    <li><a href="javascript:void(0);" class="js-search" data-close="true"><i class="material-icons">search</i></a></li>
                    <!-- #END# Call Search -->
                    <!-- Notifications -->
                    <li class="dropdown">
                        <a href="javascript:void(0);" class="dropdown-toggle" data-toggle="dropdown" role="button">
                            <i class="material-icons">notifications</i>
                            <span class="label-count">7</span>
                        </a>
                        <ul class="dropdown-menu">
                            <li class="header">NOTIFICATIONS</li>
                            <li class="body">
                                <ul class="menu">
                                    <li>
                                        <a href="javascript:void(0);">
                                            <div class="icon-circle bg-light-green">
                                                <i class="material-icons">person_add</i>
                                            </div>
                                            <div class="menu-info">
                                                <h4>12 new members joined</h4>
                                                <p>
                                                    <i class="material-icons">access_time</i> 14 mins ago
                                                </p>
                                            </div>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="javascript:void(0);">
                                            <div class="icon-circle bg-cyan">
                                                <i class="material-icons">add_shopping_cart</i>
                                            </div>
                                            <div class="menu-info">
                                                <h4>4 sales made</h4>
                                                <p>
                                                    <i class="material-icons">access_time</i> 22 mins ago
                                                </p>
                                            </div>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="javascript:void(0);">
                                            <div class="icon-circle bg-red">
                                                <i class="material-icons">delete_forever</i>
                                            </div>
                                            <div class="menu-info">
                                                <h4><b>Nancy Doe</b> deleted account</h4>
                                                <p>
                                                    <i class="material-icons">access_time</i> 3 hours ago
                                                </p>
                                            </div>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="javascript:void(0);">
                                            <div class="icon-circle bg-orange">
                                                <i class="material-icons">mode_edit</i>
                                            </div>
                                            <div class="menu-info">
                                                <h4><b>Nancy</b> changed name</h4>
                                                <p>
                                                    <i class="material-icons">access_time</i> 2 hours ago
                                                </p>
                                            </div>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="javascript:void(0);">
                                            <div class="icon-circle bg-blue-grey">
                                                <i class="material-icons">comment</i>
                                            </div>
                                            <div class="menu-info">
                                                <h4><b>John</b> commented your post</h4>
                                                <p>
                                                    <i class="material-icons">access_time</i> 4 hours ago
                                                </p>
                                            </div>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="javascript:void(0);">
                                            <div class="icon-circle bg-light-green">
                                                <i class="material-icons">cached</i>
                                            </div>
                                            <div class="menu-info">
                                                <h4><b>John</b> updated status</h4>
                                                <p>
                                                    <i class="material-icons">access_time</i> 3 hours ago
                                                </p>
                                            </div>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="javascript:void(0);">
                                            <div class="icon-circle bg-purple">
                                                <i class="material-icons">settings</i>
                                            </div>
                                            <div class="menu-info">
                                                <h4>Settings updated</h4>
                                                <p>
                                                    <i class="material-icons">access_time</i> Yesterday
                                                </p>
                                            </div>
                                        </a>
                                    </li>
                                </ul>
                            </li>
                            <li class="footer">
                                <a href="javascript:void(0);">View All Notifications</a>
                            </li>
                        </ul>
                    </li>
                    <!-- #END# Notifications -->
                    <!-- Tasks -->
                    <li class="dropdown">
                        <a href="javascript:void(0);" class="dropdown-toggle" data-toggle="dropdown" role="button">
                            <i class="material-icons">flag</i>
                            <span class="label-count">9</span>
                        </a>
                        <ul class="dropdown-menu">
                            <li class="header">TASKS</li>
                            <li class="body">
                                <ul class="menu tasks">
                                    <li>
                                        <a href="javascript:void(0);">
                                            <h4>
                                                Footer display issue
                                                <small>32%</small>
                                            </h4>
                                            <div class="progress">
                                                <div class="progress-bar bg-pink" role="progressbar" aria-valuenow="85" aria-valuemin="0" aria-valuemax="100" style="width: 32%">
                                                </div>
                                            </div>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="javascript:void(0);">
                                            <h4>
                                                Make new buttons
                                                <small>45%</small>
                                            </h4>
                                            <div class="progress">
                                                <div class="progress-bar bg-cyan" role="progressbar" aria-valuenow="85" aria-valuemin="0" aria-valuemax="100" style="width: 45%">
                                                </div>
                                            </div>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="javascript:void(0);">
                                            <h4>
                                                Create new dashboard
                                                <small>54%</small>
                                            </h4>
                                            <div class="progress">
                                                <div class="progress-bar bg-teal" role="progressbar" aria-valuenow="85" aria-valuemin="0" aria-valuemax="100" style="width: 54%">
                                                </div>
                                            </div>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="javascript:void(0);">
                                            <h4>
                                                Solve transition issue
                                                <small>65%</small>
                                            </h4>
                                            <div class="progress">
                                                <div class="progress-bar bg-orange" role="progressbar" aria-valuenow="85" aria-valuemin="0" aria-valuemax="100" style="width: 65%">
                                                </div>
                                            </div>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="javascript:void(0);">
                                            <h4>
                                                Answer GitHub questions
                                                <small>92%</small>
                                            </h4>
                                            <div class="progress">
                                                <div class="progress-bar bg-purple" role="progressbar" aria-valuenow="85" aria-valuemin="0" aria-valuemax="100" style="width: 92%">
                                                </div>
                                            </div>
                                        </a>
                                    </li>
                                </ul>
                            </li>
                            <li class="footer">
                                <a href="javascript:void(0);">View All Tasks</a>
                            </li>
                        </ul>
                    </li>
                    <!-- #END# Tasks -->
                    <li class="pull-right"><a href="javascript:void(0);" class="js-right-sidebar" data-close="true"><i class="material-icons">more_vert</i></a></li>
                </ul>
            </div>
        </div>
    </nav>
    <!-- #Top Bar -->
    <section>
        <!-- Left Sidebar -->
        <aside id="leftsidebar" class="sidebar">
            <!-- User Info -->
            <div class="user-info">
                <div class="image">
                    <img src="{{ asset('assets/images/user1.png') }}" width="50" height="50" alt="User" />
                </div>
                <div class="info-container">
                    <div class="name" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">{{ Auth::user()->name }}</div>
                    <div class="email">{{ Auth::user()->username }}</div>
                    <div class="btn-group user-helper-dropdown">
                        <i class="material-icons" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">keyboard_arrow_down</i>
                        <ul class="dropdown-menu pull-right">
                            <li><a href="javascript:void(0);"><i class="material-icons">person</i>Profile</a></li>
                            <li role="seperator" class="divider"></li>
                            <li><a href="{{ route('home') }}"><i class="material-icons">group</i>Main Navigation</a></li>
                            <li><a href="{{ route('company') }}"><i class="material-icons">group</i>Manage</a></li>
                            <li role="seperator" class="divider"></li>
   
							<li>
							 <a href="{{ route('logout') }}"
                                            onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                           Sign Out
                                        </a>

                                        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                            {{ csrf_field() }}
                                        </form>
										</li>
                        </ul>
                    </div>
                </div>
            </div>
            <!-- #User Info -->
            <!-- Menu -->
            @yield('sidenav')
            <!-- #Menu -->
            <!-- Footer -->
            <div class="legal">
                <div class="copyright">
                    &copy; 2018 <a href="javascript:void(0);">OrbWeaver Web and Mobile Apps Development</a>.
                </div>
              
            </div>
            <!-- #Footer -->
        </aside>
        <!-- #END# Left Sidebar -->
        <!-- Right Sidebar -->
        <aside id="rightsidebar" class="right-sidebar">
            <ul class="nav nav-tabs tab-nav-right" role="tablist">
                <li role="presentation" class="active"><a href="#skins" data-toggle="tab">SKINS</a></li>
                <li role="presentation"><a href="#settings" data-toggle="tab">SETTINGS</a></li>
            </ul>
            <div class="tab-content">
                <div role="tabpanel" class="tab-pane fade in active in active" id="skins">
                    <ul class="demo-choose-skin">
                        <li data-theme="red" class="active">
                            <div class="red"></div>
                            <span>Red</span>
                        </li>
                        <li data-theme="pink">
                            <div class="pink"></div>
                            <span>Pink</span>
                        </li>
                        <li data-theme="purple">
                            <div class="purple"></div>
                            <span>Purple</span>
                        </li>
                        <li data-theme="deep-purple">
                            <div class="deep-purple"></div>
                            <span>Deep Purple</span>
                        </li>
                        <li data-theme="indigo">
                            <div class="indigo"></div>
                            <span>Indigo</span>
                        </li>
                        <li data-theme="blue">
                            <div class="blue"></div>
                            <span>Blue</span>
                        </li>
                        <li data-theme="light-blue">
                            <div class="light-blue"></div>
                            <span>Light Blue</span>
                        </li>
                        <li data-theme="cyan">
                            <div class="cyan"></div>
                            <span>Cyan</span>
                        </li>
                        <li data-theme="teal">
                            <div class="teal"></div>
                            <span>Teal</span>
                        </li>
                        <li data-theme="green">
                            <div class="green"></div>
                            <span>Green</span>
                        </li>
                        <li data-theme="light-green">
                            <div class="light-green"></div>
                            <span>Light Green</span>
                        </li>
                        <li data-theme="lime">
                            <div class="lime"></div>
                            <span>Lime</span>
                        </li>
                        <li data-theme="yellow">
                            <div class="yellow"></div>
                            <span>Yellow</span>
                        </li>
                        <li data-theme="amber">
                            <div class="amber"></div>
                            <span>Amber</span>
                        </li>
                        <li data-theme="orange">
                            <div class="orange"></div>
                            <span>Orange</span>
                        </li>
                        <li data-theme="deep-orange">
                            <div class="deep-orange"></div>
                            <span>Deep Orange</span>
                        </li>
                        <li data-theme="brown">
                            <div class="brown"></div>
                            <span>Brown</span>
                        </li>
                        <li data-theme="grey">
                            <div class="grey"></div>
                            <span>Grey</span>
                        </li>
                        <li data-theme="blue-grey">
                            <div class="blue-grey"></div>
                            <span>Blue Grey</span>
                        </li>
                        <li data-theme="black">
                            <div class="black"></div>
                            <span>Black</span>
                        </li>
                    </ul>
                </div>
                <div role="tabpanel" class="tab-pane fade" id="settings">
                    <div class="demo-settings">
                        <p>GENERAL SETTINGS</p>
                        <ul class="setting-list">
                            <li>
                                <span>Report Panel Usage</span>
                                <div class="switch">
                                    <label><input type="checkbox" checked><span class="lever"></span></label>
                                </div>
                            </li>
                            <li>
                                <span>Email Redirect</span>
                                <div class="switch">
                                    <label><input type="checkbox"><span class="lever"></span></label>
                                </div>
                            </li>
                        </ul>
                        <p>SYSTEM SETTINGS</p>
                        <ul class="setting-list">
                            <li>
                                <span>Notifications</span>
                                <div class="switch">
                                    <label><input type="checkbox" checked><span class="lever"></span></label>
                                </div>
                            </li>
                            <li>
                                <span>Auto Updates</span>
                                <div class="switch">
                                    <label><input type="checkbox" checked><span class="lever"></span></label>
                                </div>
                            </li>
                        </ul>
                        <p>ACCOUNT SETTINGS</p>
                        <ul class="setting-list">
                            <li>
                                <span>Offline</span>
                                <div class="switch">
                                    <label><input type="checkbox"><span class="lever"></span></label>
                                </div>
                            </li>
                            <li>
                                <span>Location Permission</span>
                                <div class="switch">
                                    <label><input type="checkbox" checked><span class="lever"></span></label>
                                </div>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </aside>
        <!-- #END# Right Sidebar -->
    </section>
    <section class="content">
        @yield('content')
    </section >

    <!-- Javascript -->
    @if (App::isLocal())
        <!-- Scripts -->
        <script src="{{ asset('assets/plugins/jquery/jquery.min.js') }}"></script>

        <script>
            $(document).ready(function() {

                //EXPENSE Datatable starts here
            $('#expense_modal').on('hidden.bs.modal', function (e) {
                $(this)
                  .find("input,textarea,select")
                     .val('')
                     .end()
                  .find("input[type=checkbox], input[type=radio]")
                     .prop("checked", "")
                     .end();
              })
  
              var expensetable = $('#expensetable').DataTable({
                    dom: 'Bfrtip',
                      buttons: [
      
                  ],
                  processing: true,
                  serverSide: true,
                  ajax: "{{ route('refresh_expense') }}",
                  columns: [
                  {data: 'id', name: 'id'},
                  {data: 'description', name: 'description'},
                  {data: 'type', name: 'type'},
                  {data: 'amount', name: 'amount'},
                  {data: 'created_at', name: 'created_at'},
                  ]
              });
  
              function refresh_expense_table()
              {
                  expensetable.ajax.reload(); //reload datatable ajax 
              }
  
              $("#add_expense").click(function(event) {
              event.preventDefault();
  
                  $.ajax({
                      type: "POST",
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
  
              //EXPENSE Datatable ends here
  
              //COMPANY Datatable starts here
              $('#company_modal').on('hidden.bs.modal', function (e) {
                $(this)
                  .find("input,textarea,select")
                     .val('')
                     .end()
                  .find("input[type=checkbox], input[type=radio]")
                     .prop("checked", "")
                     .end();
              })
              var companytable = $('#companytable').DataTable({
                  dom: 'Bfrtip',
                  buttons: [
                  ],
                  processing: true,
                  serverSide: true,
                  ajax: "{{ route('refresh_company') }}",
                  columns: [
                  {data: 'id', name: 'id'},
                  {data: 'name', name: 'name'},
                  {data: "action", orderable:false,searchable:false}
                  ]
              });
  
              function refresh_company_table()
              {
                  companytable.ajax.reload(); //reload datatable ajax 
              }
  
              $(document).on('click','.open_company_modal', function(){
                  $('.modal_title').text('Add Company');
                  $('#button_action').val('add');
              });
  
              $(document).on('click', '#add_company', function(){
                  event.preventDefault();
                  $.ajax({
                      headers: {
                          'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                      },
                      url:"{{ route('add_company') }}",
                      method: 'POST',
                      dataType:'text',
                      data: $('#company_form').serialize(),
                      success:function(data){
                          swal("Success!", "Record has been added to database", "success")
                            $('#company_modal').modal('hide');
                            refresh_company_table();
                      },
                      error: function(data){
                          swal("Oh no!", "Something went wrong, try again.", "error")
                      }
                  })
                  });
  
              $(document).on('click', '.update_company', function(){
                  var id = $(this).attr("id");
                  $.ajax({
                      url:"{{ route('update_company') }}",
                      method: 'get',
                      data:{id:id},
                      dataType:'json',
                      success:function(data){
                          $('#button_action').val('update');
                          $('#id').val(id);
                          $('#name').val(data.name);
                          $('#company_modal').modal('show');
                          $('.modal_title').text('Update Company');
                          refresh_company_table();
                      }
                  })
              });
  
              $(document).on('click', '.delete_company', function(){
                  var id = $(this).attr('id');
                  if(confirm("Are you sure you want to delete this data?")){
                      $.ajax({
                          url:"{{ route('delete_company') }}",
                          method: "get",
                          data:{id:id},
                          success:function(data){
                              refresh_company_table();
                          }
                      })
                  }
                  else{
                      return false;
                  }
              });
              //COMPANY Datatable ends here
  
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
                  {data: 'suki_type', name: 'suki_type'},
                  {data: "action", orderable:false,searchable:false}
                  ]
              });
  
              function refresh_customer_table()
              {
                  customertable.ajax.reload(); //reload datatable ajax 
              }
  
              $(document).on('click','.open_customer_modal', function(){
                  $('.modal_title').text('Add Customer');
                  $('#button_action').val('add');
                  if($(".suki_type_input")[0]){
                      $(".suki_type_input").remove();
                  }
              });
  
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
                          $(".input_suki_type").remove();
                          swal("Success!", "Record has been added to database", "success")
                            $('#customer_modal').modal('hide');
                            refresh_customer_table();
                      },
                      error: function(data){
                          swal("Oh no!", "Something went wrong, try again.", "error")
                      }
                  });
              });
  
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
                          if($(".suki_type_input")[0]){
                              
                          } else {
                              $('<div class="row clearfix suki_type_input">'+
                                  '<div class="col-lg-2 col-md-2 col-sm-4 col-xs-5 form-control-label">'+
                                      '<label for="suki_type">Suki</label>'+
                                  '</div>'+
                                  '<div class="col-lg-10 col-md-10 col-sm-8 col-xs-7">'+
                                      '<div class="form-group">'+
                                          '<div class="form-line">'+
                                              '<input type="text" id="suki_type" name="suki_type" class="form-control" placeholder="Enter if customer is Suki"  required>'+
                                          '</div>'+
                                      '</div>'+
                                  '</div>'+
                              '</div>'
                              ).insertAfter(".in_suki_type");
                          }
                          
                          $('#suki_type').val(data.suki_type);
                      }
                  })
              });
  
              $(document).on('click', '.delete_customer', function(){
                  var id = $(this).attr('id');
                  if(confirm("Are you sure you want to delete this data?")){
                      $.ajax({
                          url:"{{ route('delete_customer') }}",
                          method: "get",
                          data:{id:id},
                          success:function(data){
                              refresh_customer_table();
                          }
                      })
                  }
                  else{
                      return false;
                  }
              });
              //CUSTOMER Datatable ends here
  
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
                  {data: 'type', name: 'type'},
                  {data: "action", orderable:false,searchable:false}
                  ]
              });
  
              function refresh_employee_table()
              {
                  employeetable.ajax.reload(); //reload datatable ajax 
              }
  
              $(document).on('click','.open_employee_modal', function(){
                  $('.modal_title').text('Add Employee');
                  $('#button_action').val('add');
              });
  
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
                          $('#type').val(data.type);
                          $('#employee_modal').modal('show');
                          $('.modal_title').text('Update Employee');
                          refresh_employee_table();
                      }
                  })
              });
  
              $(document).on('click', '.delete_employee', function(){
                  var id = $(this).attr('id');
                  if(confirm("Are you sure you want to delete this data?")){
                      $.ajax({
                          url:"{{ route('delete_employee') }}",
                          method: "get",
                          data:{id:id},
                          success:function(data){
                              refresh_employee_table();
                          }
                      })
                  }
                  else{
                      return false;
                  }
              });
              //EMPLOYEE Datatable ends here
  
              //TRUCKS Datatable starts here
              $('#trucks_modal').on('hidden.bs.modal', function (e) {
                  $(this)
                  .find("input,textarea,select")
                      .val('')
                      .end()
                  .find("input[type=checkbox], input[type=radio]")
                      .prop("checked", "")
                      .end();
              })
              var truckstable = $('#truckstable').DataTable({
                  dom: 'Bfrtip',
                  buttons: [
                  ],
                  processing: true,
                  serverSide: true,
                  ajax: "{{ route('refresh_trucks') }}",
                  columns: [
                  {data: 'id', name: 'id'},
                  {data: 'name', name: 'name'},
                  {data: 'plate_no', name: 'plate_no'},
                  {data: "action", orderable:false,searchable:false}
                  ]
              });
  
              function refresh_trucks_table()
              {
                  truckstable.ajax.reload(); //reload datatable ajax 
              }
  
              $(document).on('click','.open_trucks_modal', function(){
                  $('.modal_title').text('Add Truck');
                  $('#button_action').val('add');
              });
  
              $(document).on('click', '#add_trucks', function(){
              event.preventDefault();
  
                  $.ajax({
                      headers: {
                          'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                      },
                      url:"{{ route('add_trucks') }}",
                      method: 'POST',
                      dataType:'text',
                      data: $('#trucks_form').serialize(),
                      success:function(data){
                          swal("Success!", "Record has been added to database", "success")
                          $('#trucks_modal').modal('hide');
                          refresh_trucks_table();
                      },
                      error: function(data){
                          swal("Oh no!", "Something went wrong, try again.", "error")
                      }
                  })
              });
  
              $(document).on('click', '.update_trucks', function(){
                  var id = $(this).attr("id");
                  $.ajax({
                      url:"{{ route('update_trucks') }}",
                      method: 'get',
                      data:{id:id},
                      dataType:'json',
                      success:function(data){
                          $('#button_action').val('update');
                          $('#id').val(id);
                          $('#name').val(data.name);
                          $('#plate_no').val(data.plate_no);
                          $('#trucks_modal').modal('show');
                          $('.modal_title').text('Update Update');
                          refresh_trucks_table();
                      }
                  })
                  });
  
              $(document).on('click', '.delete_trucks', function(){
                  var id = $(this).attr('id');
                  if(confirm("Are you sure you want to delete this data?")){
                      $.ajax({
                          url:"{{ route('delete_trucks') }}",
                          method: "get",
                          data:{id:id},
                          success:function(data){
                              refresh_trucks_table();
                          }
                      })
                  }
                  else{
                      return false;
                  }
              });
              //TRUCKS Datatable ends here
  
              //COMMODITY Datatable starts here
              $('#commodity_modal').on('hidden.bs.modal', function (e) {
                  $(this)
                  .find("input,textarea,select")
                      .val('')
                      .end()
                  .find("input[type=checkbox], input[type=radio]")
                      .prop("checked", "")
                      .end();
              })
              var commoditytable = $('#commoditytable').DataTable({
                  dom: 'Bfrtip',
                  buttons: [
                  ],
                  processing: true,
                  serverSide: true,
                  ajax: "{{ route('refresh_commodity') }}",
                  columns: [
                  {data: 'id', name: 'id'},
                  {data: 'name', name: 'name'},
                  {data: 'price', name: 'price'},
                  {data: 'suki_price', name: 'suki_price'},
                  {data: "action", orderable:false,searchable:false}
                  ]
              });
  
              function refresh_commodity_table()
              {
                  commoditytable.ajax.reload(); //reload datatable ajax 
              }
  
              $(document).on('click','.open_commodity_modal', function(){
                  $('.modal_title').text('Add Commodity');
                  $('#button_action').val('add');
              });
  
              $(document).on('click', '#add_commodity', function(){
                  event.preventDefault();
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
                          refresh_commodity_table();
                      },
                      error: function(data){
                          swal("Oh no!", "Something went wrong, try again.", "error")
                      }
                  })
              });
  
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
  
              $(document).on('click', '.delete_commodity', function(){
                  var id = $(this).attr('id');
                  if(confirm("Are you sure you want to delete this data?")){
                      $.ajax({
                          url:"{{ route('delete_commodity') }}",
                          method: "get",
                          data:{id:id},
                          success:function(data){
                              refresh_commodity_table();
                          }
                      })
                  }
                  else{
                      return false;
                  }
              });
              //COMMODITY Datatable ends here
  
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
                  serverSide: true,
                  ajax: "{{ route('refresh_user') }}",
                  columns: [
                  {data: 'id', name: 'id'},
                  {data: 'name', name: 'name'},
                  {data: 'username', name: 'username'},
                  {data: 'access_id', name: 'access_id'},
                  {data: "action", orderable:false,searchable:false}
                  ]
              });
  
              function refresh_user_table()
              {
                  usertable.ajax.reload(); //reload datatable ajax 
              }
  
              $(document).on('click','.open_user_modal', function(){
                  $('.modal_title').text('Add User');
                  $('#button_action').val('add');
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
  
              $(document).on('click', '#add_user', function(){
                  event.preventDefault();
                  $.ajax({
                      headers: {
                          'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                      },
                      url:"{{ route('add_user') }}",
                      method: 'POST',
                      dataType:'text',
                      data: $('#user_form').serialize(),
                      success:function(data){
                          swal("Success!", "Record has been added to database", "success")
                          $('#user_modal').modal('hide');
                          refresh_user_table();
                      },
                      error: function(data){
                          swal("Oh no!", "Something went wrong, try again.", "error")
                      }
                  })
              });
  
              $(document).on('click', '.update_user', function(){
                  var id = $(this).attr("id");
                  $.ajax({
                      url:"{{ route('update_user') }}",
                      method: 'get',
                      data:{id:id},
                      dataType:'json',
                      success:function(data){
                          if($(".password_input")[0]){
                              $(".password_input").remove();
                          }
                          $('#button_action').val('update');
                          $('#id').val(id);
                          $('#name').val(data.name);
                          $('#username').val(data.username);
                          $('#user_modal').modal('show');
                          $('.modal_title').text('Update User');
                          refresh_user_table();
                      }
                  })
              });
  
              $(document).on('click', '.delete_user', function(){
                  var id = $(this).attr('id');
                  if(confirm("Are you sure you want to delete this data?")){
                      $.ajax({
                          url:"{{ route('delete_user') }}",
                          method: "get",
                          data:{id:id},
                          success:function(data){
                              refresh_user_table();
                          }
                      })
                  }
                  else{
                      return false;
                  }
              });
              //USER Datatable ends here

            });

        </script>

        <!-- Bootstrap Core Js -->
        <script src="{{ asset('assets/plugins/bootstrap/js/bootstrap.js') }}"></script>

        <!-- Waves Effect Plugin Js -->
        <script src="{{ asset('assets/plugins/node-waves/waves.js') }}"></script>
        
        <!-- Custom Js -->
        <script src="{{ asset('assets/js/admin.js') }}"></script>

          <!-- Sweet Alert Plugin Js -->
        <script src="{{ asset('assets/plugins/sweetalert/sweetalert.min.js') }}"></script>


        <!-- Select Plugin Js -->
        <script src="{{ asset('assets/plugins/bootstrap-select/js/bootstrap-select.js') }}"></script>

        <!-- Slimscroll Plugin Js -->
        <script src="{{ asset('assets/plugins/jquery-slimscroll/jquery.slimscroll.js') }}"></script>

        <!-- Jquery CountTo Plugin Js -->
        <script src="{{ asset('assets/plugins/jquery-countto/jquery.countTo.js') }}"></script>

        <!-- Morris Plugin Js -->
        <script src="{{ asset('assets/plugins/raphael/raphael.min.js') }}"></script>
        <script src="{{ asset('assets/plugins/morrisjs/morris.js') }}"></script>

        <!-- ChartJs -->
        <script src="{{ asset('assets/plugins/chartjs/Chart.bundle.js') }}"></script>

        <!-- Flot Charts Plugin Js -->
        <script src="{{ asset('assets/plugins/flot-charts/jquery.flot.js') }}"></script>
        <script src="{{ asset('assets/plugins/flot-charts/jquery.flot.resize.js') }}"></script>
        <script src="{{ asset('assets/plugins/flot-charts/jquery.flot.pie.js') }}"></script>
        <script src="{{ asset('assets/plugins/flot-charts/jquery.flot.categories.js') }}"></script>
        <script src="{{ asset('assets/plugins/flot-charts/jquery.flot.time.js') }}"></script>

        <!-- Sparkline Chart Plugin Js -->
        <script src="{{ asset('assets/plugins/jquery-sparkline/jquery.sparkline.js') }}"></script>

         <!-- Jquery DataTable Plugin Js -->
        <script src="{{ asset('assets/plugins/jquery-datatable/jquery.dataTables.js') }}"></script>
        <script src="{{ asset('assets/plugins/jquery-datatable/skin/bootstrap/js/dataTables.bootstrap.js') }}"></script>
        <script src="{{ asset('assets/plugins/jquery-datatable/extensions/export/dataTables.buttons.min.js') }}"></script>
        <script src="{{ asset('assets/plugins/jquery-datatable/extensions/export/buttons.flash.min.js') }}"></script>
        <script src="{{ asset('assets/plugins/jquery-datatable/extensions/export/jszip.min.js') }}"></script>
        <script src="{{ asset('assets/plugins/jquery-datatable/extensions/export/pdfmake.min.js') }}"></script>
        <script src="{{ asset('assets/plugins/jquery-datatable/extensions/export/vfs_fonts.js') }}"></script>
        <script src="{{ asset('assets/plugins/jquery-datatable/extensions/export/buttons.html5.min.js') }}"></script>
        <script src="{{ asset('assets/plugins/jquery-datatable/extensions/export/buttons.print.min.js') }}"></script>

        <!-- Jquery Validation Plugin Css -->
        <script src="{{ asset('assets/plugins/jquery-validation/jquery.validate.js') }}"></script>

        <!-- Custom Js -->
        <script src="{{ asset('assets/js/admin.js') }}"></script>
        <script src="{{ asset('assets/js/pages/index.js') }}"></script>
        <script src="{{ asset('assets/js/pages/tables/jquery-datatable.js') }}"></script>
        <script src="{{ asset('assets/js/pages/ui/modals.js') }}"></script>
        <script src="{{ asset('assets/js/pages/forms/form-validation.js') }}"></script>

        <!-- Demo Js -->
        <script src="{{ asset('assets/js/demo.js') }}"></script>
    @else
        @if (Request::server('HTTP_X_FORWARDED_PROTO') == 'http')
        <!-- Scripts -->
        <script src="{{ asset('assets/plugins/jquery/jquery.min.js') }}"></script>

        <script>
            $(document).ready(function() {

                //EXPENSE Datatable starts here
            $('#expense_modal').on('hidden.bs.modal', function (e) {
                $(this)
                  .find("input,textarea,select")
                     .val('')
                     .end()
                  .find("input[type=checkbox], input[type=radio]")
                     .prop("checked", "")
                     .end();
              })
  
              var expensetable = $('#expensetable').DataTable({
                    dom: 'Bfrtip',
                      buttons: [
      
                  ],
                  processing: true,
                  serverSide: true,
                  ajax: "{{ route('refresh_expense') }}",
                  columns: [
                  {data: 'id', name: 'id'},
                  {data: 'description', name: 'description'},
                  {data: 'type', name: 'type'},
                  {data: 'amount', name: 'amount'},
                  {data: 'created_at', name: 'created_at'},
                  ]
              });
  
              function refresh_expense_table()
              {
                  expensetable.ajax.reload(); //reload datatable ajax 
              }
  
              $("#add_expense").click(function(event) {
              event.preventDefault();
  
                  $.ajax({
                      type: "POST",
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
  
              //EXPENSE Datatable ends here
  
              //COMPANY Datatable starts here
              $('#company_modal').on('hidden.bs.modal', function (e) {
                $(this)
                  .find("input,textarea,select")
                     .val('')
                     .end()
                  .find("input[type=checkbox], input[type=radio]")
                     .prop("checked", "")
                     .end();
              })
              var companytable = $('#companytable').DataTable({
                  dom: 'Bfrtip',
                  buttons: [
                  ],
                  processing: true,
                  serverSide: true,
                  ajax: "{{ route('refresh_company') }}",
                  columns: [
                  {data: 'id', name: 'id'},
                  {data: 'name', name: 'name'},
                  {data: "action", orderable:false,searchable:false}
                  ]
              });
  
              function refresh_company_table()
              {
                  companytable.ajax.reload(); //reload datatable ajax 
              }
  
              $(document).on('click','.open_company_modal', function(){
                  $('.modal_title').text('Add Company');
                  $('#button_action').val('add');
              });
  
              $(document).on('click', '#add_company', function(){
                  event.preventDefault();
                  $.ajax({
                      headers: {
                          'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                      },
                      url:"{{ route('add_company') }}",
                      method: 'POST',
                      dataType:'text',
                      data: $('#company_form').serialize(),
                      success:function(data){
                          swal("Success!", "Record has been added to database", "success")
                            $('#company_modal').modal('hide');
                            refresh_company_table();
                      },
                      error: function(data){
                          swal("Oh no!", "Something went wrong, try again.", "error")
                      }
                  })
                  });
  
              $(document).on('click', '.update_company', function(){
                  var id = $(this).attr("id");
                  $.ajax({
                      url:"{{ route('update_company') }}",
                      method: 'get',
                      data:{id:id},
                      dataType:'json',
                      success:function(data){
                          $('#button_action').val('update');
                          $('#id').val(id);
                          $('#name').val(data.name);
                          $('#company_modal').modal('show');
                          $('.modal_title').text('Update Company');
                          refresh_company_table();
                      }
                  })
              });
  
              $(document).on('click', '.delete_company', function(){
                  var id = $(this).attr('id');
                  if(confirm("Are you sure you want to delete this data?")){
                      $.ajax({
                          url:"{{ route('delete_company') }}",
                          method: "get",
                          data:{id:id},
                          success:function(data){
                              refresh_company_table();
                          }
                      })
                  }
                  else{
                      return false;
                  }
              });
              //COMPANY Datatable ends here
  
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
                  {data: 'suki_type', name: 'suki_type'},
                  {data: "action", orderable:false,searchable:false}
                  ]
              });
  
              function refresh_customer_table()
              {
                  customertable.ajax.reload(); //reload datatable ajax 
              }
  
              $(document).on('click','.open_customer_modal', function(){
                  $('.modal_title').text('Add Customer');
                  $('#button_action').val('add');
                  if($(".suki_type_input")[0]){
                      $(".suki_type_input").remove();
                  }
              });
  
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
                          $(".input_suki_type").remove();
                          swal("Success!", "Record has been added to database", "success")
                            $('#customer_modal').modal('hide');
                            refresh_customer_table();
                      },
                      error: function(data){
                          swal("Oh no!", "Something went wrong, try again.", "error")
                      }
                  });
              });
  
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
                          if($(".suki_type_input")[0]){
                              
                          } else {
                              $('<div class="row clearfix suki_type_input">'+
                                  '<div class="col-lg-2 col-md-2 col-sm-4 col-xs-5 form-control-label">'+
                                      '<label for="suki_type">Suki</label>'+
                                  '</div>'+
                                  '<div class="col-lg-10 col-md-10 col-sm-8 col-xs-7">'+
                                      '<div class="form-group">'+
                                          '<div class="form-line">'+
                                              '<input type="text" id="suki_type" name="suki_type" class="form-control" placeholder="Enter if customer is Suki"  required>'+
                                          '</div>'+
                                      '</div>'+
                                  '</div>'+
                              '</div>'
                              ).insertAfter(".in_suki_type");
                          }
                          
                          $('#suki_type').val(data.suki_type);
                      }
                  })
              });
  
              $(document).on('click', '.delete_customer', function(){
                  var id = $(this).attr('id');
                  if(confirm("Are you sure you want to delete this data?")){
                      $.ajax({
                          url:"{{ route('delete_customer') }}",
                          method: "get",
                          data:{id:id},
                          success:function(data){
                              refresh_customer_table();
                          }
                      })
                  }
                  else{
                      return false;
                  }
              });
              //CUSTOMER Datatable ends here
  
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
                  {data: 'type', name: 'type'},
                  {data: "action", orderable:false,searchable:false}
                  ]
              });
  
              function refresh_employee_table()
              {
                  employeetable.ajax.reload(); //reload datatable ajax 
              }
  
              $(document).on('click','.open_employee_modal', function(){
                  $('.modal_title').text('Add Employee');
                  $('#button_action').val('add');
              });
  
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
                          $('#type').val(data.type);
                          $('#employee_modal').modal('show');
                          $('.modal_title').text('Update Employee');
                          refresh_employee_table();
                      }
                  })
              });
  
              $(document).on('click', '.delete_employee', function(){
                  var id = $(this).attr('id');
                  if(confirm("Are you sure you want to delete this data?")){
                      $.ajax({
                          url:"{{ route('delete_employee') }}",
                          method: "get",
                          data:{id:id},
                          success:function(data){
                              refresh_employee_table();
                          }
                      })
                  }
                  else{
                      return false;
                  }
              });
              //EMPLOYEE Datatable ends here
  
              //TRUCKS Datatable starts here
              $('#trucks_modal').on('hidden.bs.modal', function (e) {
                  $(this)
                  .find("input,textarea,select")
                      .val('')
                      .end()
                  .find("input[type=checkbox], input[type=radio]")
                      .prop("checked", "")
                      .end();
              })
              var truckstable = $('#truckstable').DataTable({
                  dom: 'Bfrtip',
                  buttons: [
                  ],
                  processing: true,
                  serverSide: true,
                  ajax: "{{ route('refresh_trucks') }}",
                  columns: [
                  {data: 'id', name: 'id'},
                  {data: 'name', name: 'name'},
                  {data: 'plate_no', name: 'plate_no'},
                  {data: "action", orderable:false,searchable:false}
                  ]
              });
  
              function refresh_trucks_table()
              {
                  truckstable.ajax.reload(); //reload datatable ajax 
              }
  
              $(document).on('click','.open_trucks_modal', function(){
                  $('.modal_title').text('Add Truck');
                  $('#button_action').val('add');
              });
  
              $(document).on('click', '#add_trucks', function(){
              event.preventDefault();
  
                  $.ajax({
                      headers: {
                          'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                      },
                      url:"{{ route('add_trucks') }}",
                      method: 'POST',
                      dataType:'text',
                      data: $('#trucks_form').serialize(),
                      success:function(data){
                          swal("Success!", "Record has been added to database", "success")
                          $('#trucks_modal').modal('hide');
                          refresh_trucks_table();
                      },
                      error: function(data){
                          swal("Oh no!", "Something went wrong, try again.", "error")
                      }
                  })
              });
  
              $(document).on('click', '.update_trucks', function(){
                  var id = $(this).attr("id");
                  $.ajax({
                      url:"{{ route('update_trucks') }}",
                      method: 'get',
                      data:{id:id},
                      dataType:'json',
                      success:function(data){
                          $('#button_action').val('update');
                          $('#id').val(id);
                          $('#name').val(data.name);
                          $('#plate_no').val(data.plate_no);
                          $('#trucks_modal').modal('show');
                          $('.modal_title').text('Update Update');
                          refresh_trucks_table();
                      }
                  })
                  });
  
              $(document).on('click', '.delete_trucks', function(){
                  var id = $(this).attr('id');
                  if(confirm("Are you sure you want to delete this data?")){
                      $.ajax({
                          url:"{{ route('delete_trucks') }}",
                          method: "get",
                          data:{id:id},
                          success:function(data){
                              refresh_trucks_table();
                          }
                      })
                  }
                  else{
                      return false;
                  }
              });
              //TRUCKS Datatable ends here
  
              //COMMODITY Datatable starts here
              $('#commodity_modal').on('hidden.bs.modal', function (e) {
                  $(this)
                  .find("input,textarea,select")
                      .val('')
                      .end()
                  .find("input[type=checkbox], input[type=radio]")
                      .prop("checked", "")
                      .end();
              })
              var commoditytable = $('#commoditytable').DataTable({
                  dom: 'Bfrtip',
                  buttons: [
                  ],
                  processing: true,
                  serverSide: true,
                  ajax: "{{ route('refresh_commodity') }}",
                  columns: [
                  {data: 'id', name: 'id'},
                  {data: 'name', name: 'name'},
                  {data: 'price', name: 'price'},
                  {data: 'suki_price', name: 'suki_price'},
                  {data: "action", orderable:false,searchable:false}
                  ]
              });
  
              function refresh_commodity_table()
              {
                  commoditytable.ajax.reload(); //reload datatable ajax 
              }
  
              $(document).on('click','.open_commodity_modal', function(){
                  $('.modal_title').text('Add Commodity');
                  $('#button_action').val('add');
              });
  
              $(document).on('click', '#add_commodity', function(){
                  event.preventDefault();
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
                          refresh_commodity_table();
                      },
                      error: function(data){
                          swal("Oh no!", "Something went wrong, try again.", "error")
                      }
                  })
              });
  
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
  
              $(document).on('click', '.delete_commodity', function(){
                  var id = $(this).attr('id');
                  if(confirm("Are you sure you want to delete this data?")){
                      $.ajax({
                          url:"{{ route('delete_commodity') }}",
                          method: "get",
                          data:{id:id},
                          success:function(data){
                              refresh_commodity_table();
                          }
                      })
                  }
                  else{
                      return false;
                  }
              });
              //COMMODITY Datatable ends here
  
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
                  serverSide: true,
                  ajax: "{{ route('refresh_user') }}",
                  columns: [
                  {data: 'id', name: 'id'},
                  {data: 'name', name: 'name'},
                  {data: 'username', name: 'username'},
                  {data: 'access_id', name: 'access_id'},
                  {data: "action", orderable:false,searchable:false}
                  ]
              });
  
              function refresh_user_table()
              {
                  usertable.ajax.reload(); //reload datatable ajax 
              }
  
              $(document).on('click','.open_user_modal', function(){
                  $('.modal_title').text('Add User');
                  $('#button_action').val('add');
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
  
              $(document).on('click', '#add_user', function(){
                  event.preventDefault();
                  $.ajax({
                      headers: {
                          'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                      },
                      url:"{{ route('add_user') }}",
                      method: 'POST',
                      dataType:'text',
                      data: $('#user_form').serialize(),
                      success:function(data){
                          swal("Success!", "Record has been added to database", "success")
                          $('#user_modal').modal('hide');
                          refresh_user_table();
                      },
                      error: function(data){
                          swal("Oh no!", "Something went wrong, try again.", "error")
                      }
                  })
              });
  
              $(document).on('click', '.update_user', function(){
                  var id = $(this).attr("id");
                  $.ajax({
                      url:"{{ route('update_user') }}",
                      method: 'get',
                      data:{id:id},
                      dataType:'json',
                      success:function(data){
                          if($(".password_input")[0]){
                              $(".password_input").remove();
                          }
                          $('#button_action').val('update');
                          $('#id').val(id);
                          $('#name').val(data.name);
                          $('#username').val(data.username);
                          $('#user_modal').modal('show');
                          $('.modal_title').text('Update User');
                          refresh_user_table();
                      }
                  })
              });
  
              $(document).on('click', '.delete_user', function(){
                  var id = $(this).attr('id');
                  if(confirm("Are you sure you want to delete this data?")){
                      $.ajax({
                          url:"{{ route('delete_user') }}",
                          method: "get",
                          data:{id:id},
                          success:function(data){
                              refresh_user_table();
                          }
                      })
                  }
                  else{
                      return false;
                  }
              });
              //USER Datatable ends here

            });

        </script>

        <!-- Bootstrap Core Js -->
        <script src="{{ asset('assets/plugins/bootstrap/js/bootstrap.js') }}"></script>

        <!-- Waves Effect Plugin Js -->
        <script src="{{ asset('assets/plugins/node-waves/waves.js') }}"></script>
        
        <!-- Custom Js -->
        <script src="{{ asset('assets/js/admin.js') }}"></script>

        <!-- Sweet Alert Plugin Js -->
        <script src="{{ asset('assets/plugins/sweetalert/sweetalert.min.js') }}"></script>

        <!-- Select Plugin Js -->
        <script src="{{ asset('assets/plugins/bootstrap-select/js/bootstrap-select.js') }}"></script>

        <!-- Slimscroll Plugin Js -->
        <script src="{{ asset('assets/plugins/jquery-slimscroll/jquery.slimscroll.js') }}"></script>

        <!-- Jquery CountTo Plugin Js -->
        <script src="{{ asset('assets/plugins/jquery-countto/jquery.countTo.js') }}"></script>

        <!-- Morris Plugin Js -->
        <script src="{{ asset('assets/plugins/raphael/raphael.min.js') }}"></script>
        <script src="{{ asset('assets/plugins/morrisjs/morris.js') }}"></script>

        <!-- ChartJs -->
        <script src="{{ asset('assets/plugins/chartjs/Chart.bundle.js') }}"></script>

        <!-- Flot Charts Plugin Js -->
        <script src="{{ asset('assets/plugins/flot-charts/jquery.flot.js') }}"></script>
        <script src="{{ asset('assets/plugins/flot-charts/jquery.flot.resize.js') }}"></script>
        <script src="{{ asset('assets/plugins/flot-charts/jquery.flot.pie.js') }}"></script>
        <script src="{{ asset('assets/plugins/flot-charts/jquery.flot.categories.js') }}"></script>
        <script src="{{ asset('assets/plugins/flot-charts/jquery.flot.time.js') }}"></script>

        <!-- Sparkline Chart Plugin Js -->
        <script src="{{ asset('assets/plugins/jquery-sparkline/jquery.sparkline.js') }}"></script>

         <!-- Jquery DataTable Plugin Js -->
        <script src="{{ asset('assets/plugins/jquery-datatable/jquery.dataTables.js') }}"></script>
        <script src="{{ asset('assets/plugins/jquery-datatable/skin/bootstrap/js/dataTables.bootstrap.js') }}"></script>
        <script src="{{ asset('assets/plugins/jquery-datatable/extensions/export/dataTables.buttons.min.js') }}"></script>
        <script src="{{ asset('assets/plugins/jquery-datatable/extensions/export/buttons.flash.min.js') }}"></script>
        <script src="{{ asset('assets/plugins/jquery-datatable/extensions/export/jszip.min.js') }}"></script>
        <script src="{{ asset('assets/plugins/jquery-datatable/extensions/export/pdfmake.min.js') }}"></script>
        <script src="{{ asset('assets/plugins/jquery-datatable/extensions/export/vfs_fonts.js') }}"></script>
        <script src="{{ asset('assets/plugins/jquery-datatable/extensions/export/buttons.html5.min.js') }}"></script>
        <script src="{{ asset('assets/plugins/jquery-datatable/extensions/export/buttons.print.min.js') }}"></script>

        <!-- Jquery Validation Plugin Css -->
        <script src="{{ asset('assets/plugins/jquery-validation/jquery.validate.js') }}"></script>

        <!-- Custom Js -->
        <script src="{{ asset('assets/js/admin.js') }}"></script>
        <script src="{{ asset('assets/js/pages/index.js') }}"></script>
        <script src="{{ asset('assets/js/pages/tables/jquery-datatable.js') }}"></script>
        <script src="{{ asset('assets/js/pages/ui/modals.js') }}"></script>
        <script src="{{ asset('assets/js/pages/forms/form-validation.js') }}"></script>

        <!-- Demo Js -->
        <script src="{{ asset('assets/js/demo.js') }}"></script>
        @else
        <!-- Scripts -->
        <script src="{{ secure_asset('assets/plugins/jquery/jquery.min.js') }}"></script>

        <script>
            $(document).ready(function() {

                //EXPENSE Datatable starts here
            $('#expense_modal').on('hidden.bs.modal', function (e) {
                $(this)
                  .find("input,textarea,select")
                     .val('')
                     .end()
                  .find("input[type=checkbox], input[type=radio]")
                     .prop("checked", "")
                     .end();
              })
  
              var expensetable = $('#expensetable').DataTable({
                    dom: 'Bfrtip',
                      buttons: [
      
                  ],
                  processing: true,
                  serverSide: true,
                  ajax: "{{ route('refresh_expense') }}",
                  columns: [
                  {data: 'id', name: 'id'},
                  {data: 'description', name: 'description'},
                  {data: 'type', name: 'type'},
                  {data: 'amount', name: 'amount'},
                  {data: 'created_at', name: 'created_at'},
                  ]
              });
  
              function refresh_expense_table()
              {
                  expensetable.ajax.reload(); //reload datatable ajax 
              }
  
              $("#add_expense").click(function(event) {
              event.preventDefault();
  
                  $.ajax({
                      type: "POST",
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
  
              //EXPENSE Datatable ends here
  
              //COMPANY Datatable starts here
              $('#company_modal').on('hidden.bs.modal', function (e) {
                $(this)
                  .find("input,textarea,select")
                     .val('')
                     .end()
                  .find("input[type=checkbox], input[type=radio]")
                     .prop("checked", "")
                     .end();
              })
              var companytable = $('#companytable').DataTable({
                  dom: 'Bfrtip',
                  buttons: [
                  ],
                  processing: true,
                  serverSide: true,
                  ajax: "{{ route('refresh_company') }}",
                  columns: [
                  {data: 'id', name: 'id'},
                  {data: 'name', name: 'name'},
                  {data: "action", orderable:false,searchable:false}
                  ]
              });
  
              function refresh_company_table()
              {
                  companytable.ajax.reload(); //reload datatable ajax 
              }
  
              $(document).on('click','.open_company_modal', function(){
                  $('.modal_title').text('Add Company');
                  $('#button_action').val('add');
              });
  
              $(document).on('click', '#add_company', function(){
                  event.preventDefault();
                  $.ajax({
                      headers: {
                          'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                      },
                      url:"{{ route('add_company') }}",
                      method: 'POST',
                      dataType:'text',
                      data: $('#company_form').serialize(),
                      success:function(data){
                          swal("Success!", "Record has been added to database", "success")
                            $('#company_modal').modal('hide');
                            refresh_company_table();
                      },
                      error: function(data){
                          swal("Oh no!", "Something went wrong, try again.", "error")
                      }
                  })
                  });
  
              $(document).on('click', '.update_company', function(){
                  var id = $(this).attr("id");
                  $.ajax({
                      url:"{{ route('update_company') }}",
                      method: 'get',
                      data:{id:id},
                      dataType:'json',
                      success:function(data){
                          $('#button_action').val('update');
                          $('#id').val(id);
                          $('#name').val(data.name);
                          $('#company_modal').modal('show');
                          $('.modal_title').text('Update Company');
                          refresh_company_table();
                      }
                  })
              });
  
              $(document).on('click', '.delete_company', function(){
                  var id = $(this).attr('id');
                  if(confirm("Are you sure you want to delete this data?")){
                      $.ajax({
                          url:"{{ route('delete_company') }}",
                          method: "get",
                          data:{id:id},
                          success:function(data){
                              refresh_company_table();
                          }
                      })
                  }
                  else{
                      return false;
                  }
              });
              //COMPANY Datatable ends here
  
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
                  {data: 'suki_type', name: 'suki_type'},
                  {data: "action", orderable:false,searchable:false}
                  ]
              });
  
              function refresh_customer_table()
              {
                  customertable.ajax.reload(); //reload datatable ajax 
              }
  
              $(document).on('click','.open_customer_modal', function(){
                  $('.modal_title').text('Add Customer');
                  $('#button_action').val('add');
                  if($(".suki_type_input")[0]){
                      $(".suki_type_input").remove();
                  }
              });
  
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
                          $(".input_suki_type").remove();
                          swal("Success!", "Record has been added to database", "success")
                            $('#customer_modal').modal('hide');
                            refresh_customer_table();
                      },
                      error: function(data){
                          swal("Oh no!", "Something went wrong, try again.", "error")
                      }
                  });
              });
  
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
                          if($(".suki_type_input")[0]){
                              
                          } else {
                              $('<div class="row clearfix suki_type_input">'+
                                  '<div class="col-lg-2 col-md-2 col-sm-4 col-xs-5 form-control-label">'+
                                      '<label for="suki_type">Suki</label>'+
                                  '</div>'+
                                  '<div class="col-lg-10 col-md-10 col-sm-8 col-xs-7">'+
                                      '<div class="form-group">'+
                                          '<div class="form-line">'+
                                              '<input type="text" id="suki_type" name="suki_type" class="form-control" placeholder="Enter if customer is Suki"  required>'+
                                          '</div>'+
                                      '</div>'+
                                  '</div>'+
                              '</div>'
                              ).insertAfter(".in_suki_type");
                          }
                          
                          $('#suki_type').val(data.suki_type);
                      }
                  })
              });
  
              $(document).on('click', '.delete_customer', function(){
                  var id = $(this).attr('id');
                  if(confirm("Are you sure you want to delete this data?")){
                      $.ajax({
                          url:"{{ route('delete_customer') }}",
                          method: "get",
                          data:{id:id},
                          success:function(data){
                              refresh_customer_table();
                          }
                      })
                  }
                  else{
                      return false;
                  }
              });
              //CUSTOMER Datatable ends here
  
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
                  {data: 'type', name: 'type'},
                  {data: "action", orderable:false,searchable:false}
                  ]
              });
  
              function refresh_employee_table()
              {
                  employeetable.ajax.reload(); //reload datatable ajax 
              }
  
              $(document).on('click','.open_employee_modal', function(){
                  $('.modal_title').text('Add Employee');
                  $('#button_action').val('add');
              });
  
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
                          $('#type').val(data.type);
                          $('#employee_modal').modal('show');
                          $('.modal_title').text('Update Employee');
                          refresh_employee_table();
                      }
                  })
              });
  
              $(document).on('click', '.delete_employee', function(){
                  var id = $(this).attr('id');
                  if(confirm("Are you sure you want to delete this data?")){
                      $.ajax({
                          url:"{{ route('delete_employee') }}",
                          method: "get",
                          data:{id:id},
                          success:function(data){
                              refresh_employee_table();
                          }
                      })
                  }
                  else{
                      return false;
                  }
              });
              //EMPLOYEE Datatable ends here
  
              //TRUCKS Datatable starts here
              $('#trucks_modal').on('hidden.bs.modal', function (e) {
                  $(this)
                  .find("input,textarea,select")
                      .val('')
                      .end()
                  .find("input[type=checkbox], input[type=radio]")
                      .prop("checked", "")
                      .end();
              })
              var truckstable = $('#truckstable').DataTable({
                  dom: 'Bfrtip',
                  buttons: [
                  ],
                  processing: true,
                  serverSide: true,
                  ajax: "{{ route('refresh_trucks') }}",
                  columns: [
                  {data: 'id', name: 'id'},
                  {data: 'name', name: 'name'},
                  {data: 'plate_no', name: 'plate_no'},
                  {data: "action", orderable:false,searchable:false}
                  ]
              });
  
              function refresh_trucks_table()
              {
                  truckstable.ajax.reload(); //reload datatable ajax 
              }
  
              $(document).on('click','.open_trucks_modal', function(){
                  $('.modal_title').text('Add Truck');
                  $('#button_action').val('add');
              });
  
              $(document).on('click', '#add_trucks', function(){
              event.preventDefault();
  
                  $.ajax({
                      headers: {
                          'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                      },
                      url:"{{ route('add_trucks') }}",
                      method: 'POST',
                      dataType:'text',
                      data: $('#trucks_form').serialize(),
                      success:function(data){
                          swal("Success!", "Record has been added to database", "success")
                          $('#trucks_modal').modal('hide');
                          refresh_trucks_table();
                      },
                      error: function(data){
                          swal("Oh no!", "Something went wrong, try again.", "error")
                      }
                  })
              });
  
              $(document).on('click', '.update_trucks', function(){
                  var id = $(this).attr("id");
                  $.ajax({
                      url:"{{ route('update_trucks') }}",
                      method: 'get',
                      data:{id:id},
                      dataType:'json',
                      success:function(data){
                          $('#button_action').val('update');
                          $('#id').val(id);
                          $('#name').val(data.name);
                          $('#plate_no').val(data.plate_no);
                          $('#trucks_modal').modal('show');
                          $('.modal_title').text('Update Update');
                          refresh_trucks_table();
                      }
                  })
                  });
  
              $(document).on('click', '.delete_trucks', function(){
                  var id = $(this).attr('id');
                  if(confirm("Are you sure you want to delete this data?")){
                      $.ajax({
                          url:"{{ route('delete_trucks') }}",
                          method: "get",
                          data:{id:id},
                          success:function(data){
                              refresh_trucks_table();
                          }
                      })
                  }
                  else{
                      return false;
                  }
              });
              //TRUCKS Datatable ends here
  
              //COMMODITY Datatable starts here
              $('#commodity_modal').on('hidden.bs.modal', function (e) {
                  $(this)
                  .find("input,textarea,select")
                      .val('')
                      .end()
                  .find("input[type=checkbox], input[type=radio]")
                      .prop("checked", "")
                      .end();
              })
              var commoditytable = $('#commoditytable').DataTable({
                  dom: 'Bfrtip',
                  buttons: [
                  ],
                  processing: true,
                  serverSide: true,
                  ajax: "{{ route('refresh_commodity') }}",
                  columns: [
                  {data: 'id', name: 'id'},
                  {data: 'name', name: 'name'},
                  {data: 'price', name: 'price'},
                  {data: 'suki_price', name: 'suki_price'},
                  {data: "action", orderable:false,searchable:false}
                  ]
              });
  
              function refresh_commodity_table()
              {
                  commoditytable.ajax.reload(); //reload datatable ajax 
              }
  
              $(document).on('click','.open_commodity_modal', function(){
                  $('.modal_title').text('Add Commodity');
                  $('#button_action').val('add');
              });
  
              $(document).on('click', '#add_commodity', function(){
                  event.preventDefault();
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
                          refresh_commodity_table();
                      },
                      error: function(data){
                          swal("Oh no!", "Something went wrong, try again.", "error")
                      }
                  })
              });
  
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
  
              $(document).on('click', '.delete_commodity', function(){
                  var id = $(this).attr('id');
                  if(confirm("Are you sure you want to delete this data?")){
                      $.ajax({
                          url:"{{ route('delete_commodity') }}",
                          method: "get",
                          data:{id:id},
                          success:function(data){
                              refresh_commodity_table();
                          }
                      })
                  }
                  else{
                      return false;
                  }
              });
              //COMMODITY Datatable ends here
  
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
                  serverSide: true,
                  ajax: "{{ route('refresh_user') }}",
                  columns: [
                  {data: 'id', name: 'id'},
                  {data: 'name', name: 'name'},
                  {data: 'username', name: 'username'},
                  {data: 'access_id', name: 'access_id'},
                  {data: "action", orderable:false,searchable:false}
                  ]
              });
  
              function refresh_user_table()
              {
                  usertable.ajax.reload(); //reload datatable ajax 
              }
  
              $(document).on('click','.open_user_modal', function(){
                  $('.modal_title').text('Add User');
                  $('#button_action').val('add');
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
  
              $(document).on('click', '#add_user', function(){
                  event.preventDefault();
                  $.ajax({
                      headers: {
                          'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                      },
                      url:"{{ route('add_user') }}",
                      method: 'POST',
                      dataType:'text',
                      data: $('#user_form').serialize(),
                      success:function(data){
                          swal("Success!", "Record has been added to database", "success")
                          $('#user_modal').modal('hide');
                          refresh_user_table();
                      },
                      error: function(data){
                          swal("Oh no!", "Something went wrong, try again.", "error")
                      }
                  })
              });
  
              $(document).on('click', '.update_user', function(){
                  var id = $(this).attr("id");
                  $.ajax({
                      url:"{{ route('update_user') }}",
                      method: 'get',
                      data:{id:id},
                      dataType:'json',
                      success:function(data){
                          if($(".password_input")[0]){
                              $(".password_input").remove();
                          }
                          $('#button_action').val('update');
                          $('#id').val(id);
                          $('#name').val(data.name);
                          $('#username').val(data.username);
                          $('#user_modal').modal('show');
                          $('.modal_title').text('Update User');
                          refresh_user_table();
                      }
                  })
              });
  
              $(document).on('click', '.delete_user', function(){
                  var id = $(this).attr('id');
                  if(confirm("Are you sure you want to delete this data?")){
                      $.ajax({
                          url:"{{ route('delete_user') }}",
                          method: "get",
                          data:{id:id},
                          success:function(data){
                              refresh_user_table();
                          }
                      })
                  }
                  else{
                      return false;
                  }
              });
              //USER Datatable ends here

            });

        </script>

        <!-- Bootstrap Core Js -->        
        <script src="{{ secure_asset('assets/plugins/bootstrap/js/bootstrap.js') }}"></script>

        <!-- Waves Effect Plugin Js -->
        <script src="{{ secure_asset('assets/plugins/node-waves/waves.js') }}"></script>
        
        <!-- Custom Js -->
        <script src="{{ secure_asset('assets/js/admin.js') }}"></script>

          <!-- Sweet Alert Plugin Js -->
        <script src="{{ secure_asset('assets/plugins/sweetalert/sweetalert.min.js') }}"></script>


        <!-- Select Plugin Js -->
        <script src="{{ secure_asset('assets/plugins/bootstrap-select/js/bootstrap-select.js') }}"></script>

        <!-- Slimscroll Plugin Js -->
        <script src="{{ secure_asset('assets/plugins/jquery-slimscroll/jquery.slimscroll.js') }}"></script>

        <!-- Jquery CountTo Plugin Js -->
        <script src="{{ secure_asset('assets/plugins/jquery-countto/jquery.countTo.js') }}"></script>

        <!-- Morris Plugin Js -->
        <script src="{{ secure_asset('assets/plugins/raphael/raphael.min.js') }}"></script>
        <script src="{{ secure_asset('assets/plugins/morrisjs/morris.js') }}"></script>

        <!-- ChartJs -->
        <script src="{{ secure_asset('assets/plugins/chartjs/Chart.bundle.js') }}"></script>

        <!-- Flot Charts Plugin Js -->
        <script src="{{ secure_asset('assets/plugins/flot-charts/jquery.flot.js') }}"></script>
        <script src="{{ secure_asset('assets/plugins/flot-charts/jquery.flot.resize.js') }}"></script>
        <script src="{{ secure_asset('assets/plugins/flot-charts/jquery.flot.pie.js') }}"></script>
        <script src="{{ secure_asset('assets/plugins/flot-charts/jquery.flot.categories.js') }}"></script>
        <script src="{{ secure_asset('assets/plugins/flot-charts/jquery.flot.time.js') }}"></script>

        <!-- Sparkline Chart Plugin Js -->
        <script src="{{ secure_asset('assets/plugins/jquery-sparkline/jquery.sparkline.js') }}"></script>

         <!-- Jquery DataTable Plugin Js -->
        <script src="{{ secure_asset('assets/plugins/jquery-datatable/jquery.dataTables.js') }}"></script>
        <script src="{{ secure_asset('assets/plugins/jquery-datatable/skin/bootstrap/js/dataTables.bootstrap.js') }}"></script>
        <script src="{{ secure_asset('assets/plugins/jquery-datatable/extensions/export/dataTables.buttons.min.js') }}"></script>
        <script src="{{ secure_asset('assets/plugins/jquery-datatable/extensions/export/buttons.flash.min.js') }}"></script>
        <script src="{{ secure_asset('assets/plugins/jquery-datatable/extensions/export/jszip.min.js') }}"></script>
        <script src="{{ secure_asset('assets/plugins/jquery-datatable/extensions/export/pdfmake.min.js') }}"></script>
        <script src="{{ secure_asset('assets/plugins/jquery-datatable/extensions/export/vfs_fonts.js') }}"></script>
        <script src="{{ secure_asset('assets/plugins/jquery-datatable/extensions/export/buttons.html5.min.js') }}"></script>
        <script src="{{ secure_asset('assets/plugins/jquery-datatable/extensions/export/buttons.print.min.js') }}"></script>

        <!-- Jquery Validation Plugin Css -->
        <script src="{{ secure_asset('assets/plugins/jquery-validation/jquery.validate.js') }}"></script>

        <!-- Custom Js -->
        <script src="{{ secure_asset('assets/js/admin.js') }}"></script>
        <script src="{{ secure_asset('assets/js/pages/index.js') }}"></script>
        <script src="{{ secure_asset('assets/js/pages/tables/jquery-datatable.js') }}"></script>
        <script src="{{ secure_asset('assets/js/pages/ui/modals.js') }}"></script>
        <script src="{{ secure_asset('assets/js/pages/forms/form-validation.js') }}"></script>

        <!-- Demo Js -->
        <script src="{{ secure_asset('assets/js/demo.js') }}"></script>
        @endif
    @endif
    
</body>
</html>
