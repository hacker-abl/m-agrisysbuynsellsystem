@extends('layouts.admin')

@section('content')
<div class="container-fluid" id="update">
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

</div>
@endsection

