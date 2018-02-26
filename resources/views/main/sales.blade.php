@extends('layouts.admin')
		@section('sidenav')
				    <div class="menu">
     <ul class="list">
                    <li class="header">MAIN NAVIGATION</li>
                    <li >
                        <a href="{{ route('home') }}">
                            <i class="material-icons">home</i>
                            <span>Home</span>
                        </a>
                    </li>
                    <li >
                        <a href="{{ route('expense') }}">
                            <i class="material-icons">show_chart</i>
                            <span>Expenses</span>
                        </a>
                    </li> 
					<li >
                        <a href="{{ route('trips') }}">
                            <i class="material-icons">directions_bus</i>
                            <span>Trips</span>
                        </a>
                    </li>
					<li >
                        <a href="{{ route('dtr') }}">
                            <i class="material-icons">access_time</i>
                            <span>Daily Time Record</span>
                        </a>
                    </li>
					<li >
                        <a href="{{ route('od') }}">
                            <i class="material-icons">arrow_upward</i>
                            <span>Outbound Deliveries</span>
                        </a>
                    </li>
					<li >
                        <a href="{{ route('ca') }}">
                            <i class="material-icons">monetization_on</i>
                            <span>Cash Advance</span>
                        </a>
                    </li>
					<li >
                        <a href="{{ route('purchases') }}">
                            <i class="material-icons">bookmark_border</i>
                            <span>Purchases</span>
                        </a>
                    </li>
					<li class="active">
                        <a href="{{ route('sales') }}">
                            <i class="material-icons">shopping_cart</i>
                            <span>Purchases</span>
                        </a>
                    </li>
                 
  
                </ul>
				</div>
@endsection

@section('content')
    <div class="container-fluid">
           <div class="block-header">
                <h2>
                    Sales Dashboard
                </h2>
            </div>

        </div>
		 
@endsection
