@extends('layouts.admin')

@section('content')
<div class="container-fluid" id="request">
    <div class="block-header">
        <h2>DASHBOARD</h2>
    </div>

    <!-- Widgets -->
    <div class="row clearfix">
        <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
            <div class="card">
                <div class="header text-center">
                    <h2>PURCHASES TODAY</h2>
                </div>
                <div class="body" style="max-height:500px;">
                    <section class="totalPurchases">
                    <total-purchases-today-table></total-purchases-today-table>
                    </section>
                </div>
            </div>
        </div>
        <!-- <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
            <div class="card">
                <div class="header text-center">
                    <h2>PURCHASES TODAY</h2>
                </div>
                <div class="body" style="max-height:500px;">
                    <section class="totalPurchases">
                    @include('home_content.total_purchases_today')
                    </section>
                </div>
            </div>
        </div> -->

        <!-- <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
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
        </div> -->
    </div>
    <!-- #END# Widgets -->

    <div class="row clearfix">

        <!-- Commodity List -->
        <div class="col-xs-12 col-sm-12 col-md-6 col-lg-6">
            <div class="card">
                <div class="header text-center">
                    <h2>COMMODITY PRICE LIST</h2>
                </div>
                <div class="body" style="min-height:150px; max-height:400px;">
                    <section class="commodityList">
                    @include('home_content.commodity_list')
                    </section>
                </div>
            </div>
        </div>
        <!-- #END# Commodity List -->

        <!-- Cashier List -->
        <div class="col-xs-12 col-sm-12 col-md-6 col-lg-6">
            <div class="card">
                <div class="header text-center">
                    <h2>CASHIER LIST</h2>
                </div>
                <div class="body" style="min-height:150px; max-height:400px;">
                    <cash-on-hand></cash-on-hand>
                </div>
            </div>
        </div>
        <!-- #END# Cashier List -->
    </div>

    <div class="row clearfix">
        <!-- Cash Advance -->
        <div class="col-xs-12 col-sm-12 col-md-6 col-lg-6">
            <div class="card">
                <div class="header text-center">
                    <h2>CASH ADVANCE TODAY</h2>
                </div>
                <div class="body" style="min-height:150px; max-height:400px;">
                    <section class="paymentLogs">
                        @include('home_content.cash_advance_today_table')
                    </section>
                </div>
            </div>
        </div>
        <!-- #END# Cash Advance -->

        <!-- Payment Logs -->
        <div class="col-xs-12 col-sm-12 col-md-6 col-lg-6">
            <div class="card">
                <div class="header text-center">
                    <h2>PAYMENT LOGS</h2>
                </div>
                <div class="body" style="min-height:150px; max-height:400px;">
                    <section class="paymentLogs">
                        @include('home_content.payment_logs_table')
                    </section>
                </div>
            </div>
        </div>
        <!-- #END# Payment Logs -->
    </div>

    <div class="row clearfix">
        <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
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

        <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
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
    </div>

    <div class="row clearfix">
            <div class="col-md-6">
            <div class="row clearfix">
                <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
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
                <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
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
            </div>
            <div class="row clearfix">
                <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
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
                <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
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
            </div>
        </div>

        <div class="col-md-6">
            <div class="row clearfix">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <div class="info-box bg-light-green hover-expand-effect" style="min-height:190px; max-height:400px;">
                        <div class="icon">
                            <i class="material-icons">bookmark_border</i>
                        </div>
                        <div class="content" style="width:100%;">
                            <h3>PURCHASES - MONTH</h3>
                            <br>
                            <h4>WEIGHT (KG) <span class="pull-right">{{ $totalPurchasesMonth[0]->total_kilos }}</span></h4>
                            <h4>AMOUNT <span class="pull-right">&#8369; {{ number_format( $totalPurchasesMonth[0]->total_purchases , 2, '.', ',') }}</span></h4>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

</div>
@endsection
