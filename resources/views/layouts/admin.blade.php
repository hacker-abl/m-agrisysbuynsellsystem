<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <!--<title>{{ config('app.name', 'Laravel') }}</title>-->
    <title>M-Agri</title>
    <!-- Favicon-->
    <link rel="icon" href="../../favicon.ico" type="image/x-icon">

    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Roboto:400,700&subset=latin,cyrillic-ext" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet" type="text/css">


    <!-- Styles -->
    @if (App::isLocal())
        <!-- Sweet Alert Css -->
        <link href="{{ asset('assets/plugins/sweetalert/sweetalert.css') }}" rel="stylesheet" />

        <!-- Select2 Css -->
        <link href="{{ asset('assets/plugins/select2/dist/css/select2.min.css') }}" rel="stylesheet" />

        <!-- Jquery-ui Css -->
        <link href="{{ asset('assets/plugins/jquery-ui/jquery-ui.min.css') }}" rel="stylesheet" />

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

        <!-- Select2 Css -->
        <link href="{{ asset('assets/plugins/select2/dist/css/select2.min.css') }}" rel="stylesheet" />

        <!-- Jquery-ui Css -->
        <link href="{{ asset('assets/plugins/jquery-ui/jquery-ui.min.css') }}" rel="stylesheet" />

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

        <!-- Select2 Css -->
        <link href="{{ asset('assets/plugins/select2/dist/css/select2.min.css') }}" rel="stylesheet" />

        <!-- Jquery-ui Css -->
        <link href="{{ asset('assets/plugins/jquery-ui/jquery-ui.min.css') }}" rel="stylesheet" />

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
<body id="b" class="theme-grey">
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
    <nav class="navbar ">
        <div class="container-fluid">
            <div class="navbar-header">
                <a href="javascript:void(0)"></a>
                <a href="javascript:void(0)" class="bars" id="l"  ></a>

                <a class="navbar-brand" href="{{ route('home') }}"><span> <img src="{{ asset('assets/images/logo.png') }}" width="50" height="50" class="logo"/></span> <span class="title">M-Agri Buy & Sell System</span></a>

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

    </section>
    <section class="content">
        @yield('content')
    </section >

    <!-- Javascript -->
    @if (App::isLocal())
        <!-- Scripts -->
        <script src="{{ asset('assets/plugins/jquery/jquery.min.js') }}"></script>

        @yield('script')

        <!-- Bootstrap Core Js -->
        <script src="{{ asset('assets/plugins/bootstrap/js/bootstrap.js') }}"></script>

        <!-- Waves Effect Plugin Js -->
        <script src="{{ asset('assets/plugins/node-waves/waves.js') }}"></script>

        <!-- Custom Js -->
        <script src="{{ asset('assets/js/admin.js') }}"></script>

          <!-- Sweet Alert Plugin Js -->
        <script src="{{ asset('assets/plugins/sweetalert/sweetalert.min.js') }}"></script>

        <!-- Select2 Plugin Js -->
        <script src="{{ asset('assets/plugins/select2/dist/js/select2.full.min.js') }}"></script>

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

        <!-- Jquery-ui Js -->
        <script src="{{ asset('assets/plugins/jquery-ui/jquery-ui.min.js') }}"></script>
        <script>
        $('#l').click(function(){
        //alert('hey')
        if($('#b').hasClass('overlay-open') )
        {

            $('#b').removeClass('overlay-open');
        }
        else{
           // $('#b').removeClass('ls-closed');
           $('#b').addClass('overlay-open');
        }

    });
        </script>
    @else
        @if (Request::server('HTTP_X_FORWARDED_PROTO') == 'http')
        <!-- Scripts -->
        <script src="{{ asset('assets/plugins/jquery/jquery.min.js') }}"></script>

        @yield('script')

        <!-- Bootstrap Core Js -->
        <script src="{{ asset('assets/plugins/bootstrap/js/bootstrap.js') }}"></script>

        <!-- Waves Effect Plugin Js -->
        <script src="{{ asset('assets/plugins/node-waves/waves.js') }}"></script>

        <!-- Sweet Alert Plugin Js -->
        <script src="{{ asset('assets/plugins/sweetalert/sweetalert.min.js') }}"></script>

        <!-- Select2 Plugin Js -->
        <script src="{{ asset('assets/plugins/select2/dist/js/select2.full.min.js') }}"></script>

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

        <!-- Jquery-ui Js -->
        <script src="{{ asset('assets/plugins/jquery-ui/jquery-ui.min.js') }}"></script>
        @else
        <!-- Scripts -->
        <script src="{{ secure_asset('assets/plugins/jquery/jquery.min.js') }}"></script>

        @yield('script')

        <!-- Bootstrap Core Js -->
        <script src="{{ secure_asset('assets/plugins/bootstrap/js/bootstrap.js') }}"></script>

        <!-- Waves Effect Plugin Js -->
        <script src="{{ secure_asset('assets/plugins/node-waves/waves.js') }}"></script>

        <!-- Custom Js -->
        <script src="{{ secure_asset('assets/js/admin.js') }}"></script>

          <!-- Sweet Alert Plugin Js -->
        <script src="{{ secure_asset('assets/plugins/sweetalert/sweetalert.min.js') }}"></script>

        <!-- Select2 Plugin Js -->
        <script src="{{ asset('assets/plugins/select2/dist/js/select2.full.min.js') }}"></script>


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

        <!-- Jquery-ui Js -->
        <script src="{{ asset('assets/plugins/jquery-ui/jquery-ui.min.js') }}"></script>
        @endif
    @endif

</body>
</html>
