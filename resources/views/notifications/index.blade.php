@extends('layouts.user')

@section('content')
<div class="container-fluid">
    <div class="row clearfix">
        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
            <div class="card">
                <div class="body" id="notification-list">
                    <notification-list-all></notification-list-all>
                </div>
            </div>
        </div>
    </div>

<!-- </div> -->
@endsection