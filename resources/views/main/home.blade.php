@extends('layouts.admin')

@section('content')
<div class="container-fluid" id="request">
    <div class="block-header">
        <h2>DASHBOARD</h2>
    </div>

    <!-- Widgets -->
    <div class="row clearfix">
        <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
            <div class="info-box bg-pink hover-expand-effect">
                <div class="icon">
                    <i class="material-icons">show_chart</i>
                </div>
                <div class="content">
                    <div class="text">EXPENSES - TODAY</div>
                    <total-expenses-today></total-expenses-today>
                </div>
            </div>
        </div>
        <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
            <div class="info-box bg-cyan hover-expand-effect">
                <div class="icon">
                    <i class="material-icons">shopping_cart</i>
                </div>
                <div class="content">
                    <div class="text">SALES - TODAY</div>
                    <total-sales-today></total-sales-today>
                </div>
            </div>
        </div>
        <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
            <div class="info-box bg-light-green hover-expand-effect">
                <div class="icon">
                    <i class="material-icons">bookmark_border</i>
                </div>
                <div class="content">
                    <div class="text">PURCHASES - TODAY</div>
                    <total-purchases-today></total-purchases-today>
                </div>
            </div>
        </div>
        <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
            <div class="info-box bg-orange hover-expand-effect">
                <div class="icon">
                    <i class="material-icons">money_off</i>
                </div>
                <div class="content">
                    <div class="text">BALANCE - TODAY</div>
                    <total-balance-today></total-balance-today>
                </div>
            </div>
        </div>
    </div>
    <!-- #END# Widgets -->

    <div class="row clearfix">
        <!-- Visitors -->
        <div class="col-xs-12 col-sm-12 col-md-4 col-lg-4">
            <div class="card">
                <div class="body bg-pink" style="height:291px;">
                    <div class="font-bold m-b--35">TOTAL PURCHASES</div>
                    <section class="totalPurchases">
                    @include('home_content.total_purchases')
                    </section>
                </div>
            </div>
        </div>
        <!-- #END# Visitors -->
        
        <!-- Commodity List -->
        <div class="col-xs-12 col-sm-12 col-md-4 col-lg-4">
            <div class="card">
                <div class="body bg-cyan" style="height:291px;">
                    <div class="font-bold m-b--35">COMMODITY LIST</div>
                    <section class="commodityList">
                    @include('home_content.commodity_list')
                    </section>
                </div>
            </div>
        </div>
        <!-- #END# Commodity List -->

        <!-- Latest Social Trends -->
        <div class="col-xs-12 col-sm-12 col-md-4 col-lg-4">
            <div class="card">
                <div class="body bg-teal" style="height:291px;">
                    <div class="font-bold m-b--35">TRUCK LIST</div>
                    <section class="truckList">
                    @include('home_content.truck_list')
                    </section>
                </div>
            </div>
        </div>
        <!-- #END# Latest Social Trends -->

    </div>

    <div class="row clearfix">
        <!-- Task Info -->
        <div class="col-xs-12 col-sm-12 col-md-8 col-lg-8">
            <div class="card">
                <div class="header">
                    <h2>PAYMENT LOGS</h2>
                    <ul class="header-dropdown m-r--5">
                        <li class="dropdown">
                            <a href="javascript:void(0);" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">
                                <i class="material-icons">more_vert</i>
                            </a>
                            <ul class="dropdown-menu pull-right">
                                <li><a href="javascript:void(0);">Action</a></li>
                                <li><a href="javascript:void(0);">Another action</a></li>
                                <li><a href="javascript:void(0);">Something else here</a></li>
                            </ul>
                        </li>
                    </ul>
                </div>
                <section class="paymentLogs">
                    @include('home_content.payment_logs_table')
                </section>
            </div>
        </div>
        <!-- #END# Task Info -->
        <!-- Browser Usage -->
        <div class="col-xs-12 col-sm-12 col-md-4 col-lg-4">
            <div class="card">
                <div class="header">
                    <h2>CASHIER LIST</h2>
                </div>
                <div class="body">
                    <cash-on-hand></cash-on-hand>
                </div>
            </div>
        </div>
        <!-- #END# Browser Usage -->
    </div>

    <!-- Widgets -->
    <div class="row clearfix">
        <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
            <div class="info-box bg-pink hover-expand-effect">
                <div class="icon">
                    <i class="material-icons">show_chart</i>
                </div>
                <div class="content">
                    <div class="text">EXPENSES - MONTH</div>
                    <h4 id="totalExpensesMonth">&#8369; {{ number_format( $finalTotalExpenseMonth , 2, '.', ',') }}</h4>
                </div>
            </div>
        </div>
        <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
            <div class="info-box bg-cyan hover-expand-effect">
                <div class="icon">
                    <i class="material-icons">shopping_cart</i>
                </div>
                <div class="content">
                    <div class="text">SALES - MONTH</div>
                    <h4 id="totalSalesMonth">&#8369; {{ number_format( $totalSalesMonth[0]->total_sales , 2, '.', ',') }}</h4>
                </div>
            </div>
        </div>
        <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
            <div class="info-box bg-light-green hover-expand-effect">
                <div class="icon">
                    <i class="material-icons">bookmark_border</i>
                </div>
                <div class="content">
                    <div class="text">PURCHASES - MONTH</div>
                    <h4 id="totalPurchasesMonth">&#8369; {{ number_format( $totalPurchasesMonth[0]->total_purchases , 2, '.', ',') }}</h4>
                </div>
            </div>
        </div>
        <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
            <div class="info-box bg-orange hover-expand-effect">
                <div class="icon">
                    <i class="material-icons">money_off</i>
                </div>
                <div class="content">
                    <div class="text">BALANCE - MONTH</div>
                    <h4 id="totalBalanceMonth">&#8369; {{ number_format( $totalBalanceMonth , 2, '.', ',') }}</h4>
                </div>
            </div>
        </div>
    </div>
    <!-- #END# Widgets -->

    <!-- Widgets -->
    <div class="row clearfix">
                <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
                    <div class="info-box bg-pink hover-expand-effect">
                        <div class="icon">
                            <i class="material-icons">show_chart</i>
                        </div>
                        <div class="content">
                            <div class="text">EXPENSES - YEAR</div>
                            <h4 id="totalExpensesYear">&#8369; {{ number_format( $finalTotalExpenseYear , 2, '.', ',') }}</h4>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
                    <div class="info-box bg-cyan hover-expand-effect">
                        <div class="icon">
                            <i class="material-icons">shopping_cart</i>
                        </div>
                        <div class="content">
                            <div class="text">SALES - YEAR</div>
                            <h4 id="totalSalesYear">&#8369; {{ number_format( $totalSalesYear[0]->total_sales , 2, '.', ',') }}</h4>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
                    <div class="info-box bg-light-green hover-expand-effect">
                        <div class="icon">
                            <i class="material-icons">bookmark_border</i>
                        </div>
                        <div class="content">
                            <div class="text">PURCHASES - YEAR</div>
                            <h4 id="totalPurchasesYear">&#8369; {{ number_format( $totalPurchasesYear[0]->total_purchases , 2, '.', ',') }}</h4>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
                    <div class="info-box bg-orange hover-expand-effect">
                        <div class="icon">
                            <i class="material-icons">money_off</i>
                        </div>
                        <div class="content">
                            <div class="text">BALANCE - YEAR</div>
                            <h4 id="totalBalanceYear">&#8369; {{ number_format( $totalBalanceYear , 2, '.', ',') }}</h4>
                        </div>
                    </div>
                </div>
            </div>
            <!-- #END# Widgets -->

</div>
@endsection

