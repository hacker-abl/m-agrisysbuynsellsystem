@extends('layouts.user')

@section('sidenav')
<div class="menu">
    <ul class="list">
        <li class="header">MAIN NAVIGATION</li>
        <li class="active">
            <a href="{{ route('home') }}">
               <i class="material-icons">home</i>
               <span>Home</span>
            </a>
        </li>
        @if($permissions[0]->permission->middleware === "expenses")
        <li>
            <a href="{{ route('expense') }}">
                <i class="material-icons">show_chart</i>
                <span>Expenses</span>
            </a>
        </li>
        @endif
        @if($permissions[1]->permission->middleware === "trips")
        <li>
            <a href="{{ route('trips') }}">
                <i class="material-icons">directions_bus</i>
                <span>Trips</span>
            </a>
        </li>
        @endif
        @if($permissions[2]->permission->middleware === "dtr")
        <li>
            <a href="{{ route('dtr') }}">
                <i class="material-icons">access_time</i>
                <span>Daily Time Record</span>
            </a>
        </li>
        @endif
        @if($permissions[3]->permission->middleware === "od")
        <li>
            <a href="{{ route('od') }}">
                <i class="material-icons">arrow_upward</i>
                <span>Outbound Deliveries</span>
            </a>
        </li>
        @endif
        @if($permissions[4]->permission->middleware === "ca")
        <li>
            <a href="{{ route('ca') }}">
                <i class="material-icons">monetization_on</i>
                <span>Cash Advance</span>
            </a>
        </li>
        @endif
        @if($permissions[5]->permission->middleware === "purchases")
        <li>
            <a href="{{ route('purchases') }}">
                <i class="material-icons">bookmark_border</i>
                <span>Purchases</span>
            </a>
        </li>
        @endif
        @if($permissions[6]->permission->middleware === "sales")
        <li>
            <a href="{{ route('sales') }}">
                <i class="material-icons">shopping_cart</i>
                <span>Sales</span>
            </a>
        </li>
        @endif
    </ul>
</div>
@endsection

@section('content')
    <div class="container-fluid">
        <div class="block-header">
            <h2>DASHBOARD</h2>
        </div>

        <!-- Widgets -->
        <div class="row clearfix">
            <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
                <div class="info-box bg-pink hover-expand-effect">
                    <div class="icon">
                        <i class="material-icons">playlist_add_check</i>
                    </div>
                    <div class="content">
                        <div class="text">EMPLOYEES</div>
                        <div class="number count-to" data-from="0" data-to="125" data-speed="15" data-fresh-interval="20"></div>
                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
                <div class="info-box bg-cyan hover-expand-effect">
                    <div class="icon">
                        <i class="material-icons">help</i>
                    </div>
                    <div class="content">
                        <div class="text">CLIENTS</div>
                        <div class="number count-to" data-from="0" data-to="257" data-speed="1000" data-fresh-interval="20"></div>
                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
                <div class="info-box bg-light-green hover-expand-effect">
                    <div class="icon">
                        <i class="material-icons">forum</i>
                    </div>
                    <div class="content">
                        <div class="text">REQUESTS</div>
                        <div class="number count-to" data-from="0" data-to="243" data-speed="1000" data-fresh-interval="20"></div>
                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
                <div class="info-box bg-orange hover-expand-effect">
                    <div class="icon">
                        <i class="material-icons">person_add</i>
                    </div>
                    <div class="content">
                        <div class="text">NEW VISITORS</div>
                        <div class="number count-to" data-from="0" data-to="1225" data-speed="1000" data-fresh-interval="20"></div>
                    </div>
                </div>
            </div>
        </div>
        <!-- #END# Widgets -->
    </div>
@endsection
