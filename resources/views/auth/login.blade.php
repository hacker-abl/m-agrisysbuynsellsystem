@extends('layouts.app')

@section('content')

    <div class="login-box">
        <div class="logo">
            <a href="javascript:void(0);"><b>M-Agri Buy & Sell</b></a>
            
        </div>
        <div class="card">
            <div class="body">
                <form id="sign_in" method="POST" action="{{ route('login') }}" >
				@csrf
                    <div class="msg">Log In</div>
                    <div class="input-group">
                        <span class="input-group-addon">
                            <i class="material-icons">person</i>
                        </span>
                        <div class="form-line">
                            <input type="text" class="form-control{{ $errors->has('username') ? ' is-invalid' : '' }}" name="username" id="username" value="{{ old('username') }}" placeholder="Username" required autofocus>
                        @if ($errors->has('username'))
                                    <span class="invalid-feedback">
                                        <strong>{{ $errors->first('username') }}</strong>
                                    </span>
                                @endif
						</div>
                    </div>
                    <div class="input-group">
                        <span class="input-group-addon">
                            <i class="material-icons">lock</i>
                        </span>
                        <div class="form-line">
                            <input class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}" type="password" id="password" name="password" placeholder="Password" required>
                        @if ($errors->has('password'))
                                    <span class="invalid-feedback">
                                        <strong>{{ $errors->first('password') }}</strong>
                                    </span>
                                @endif
						</div>
                    </div>
                    <div class="row">
                        <div class="col-xs-8 p-t-5">
                            <input type="checkbox" name="rememberme" id="rememberme" class="filled-in chk-col-grey">
                            <label for="rememberme">Remember Me</label>
                        </div>
                        <div class="col-xs-4">
                            <button class="btn btn-block bg-grey waves-effect" type="submit">Log In</button>
                        </div>
                    </div>
                    <div class="row m-t-15 m-b--20">
                         
                        <div class="col-xs-6 ">
                            <a href="forgot-password.html">Forgot Password?</a>
                    </div>
                    <div>
                        <small>Powered By: ScriptedScript </small>
                    </div>
                        </div>

                </form>

            </div>

        </div>
    </div>

@endsection
