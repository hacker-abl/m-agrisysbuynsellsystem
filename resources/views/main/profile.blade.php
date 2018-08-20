@extends(isAdmin() ? 'layouts.admin' : 'layouts.user')

@section('content')

    <div class="container-fluid">
        <div class="block-header">
            <h1>Profile</h1>
        </div>
    </div>
    <div class="row clearfix">
        <div class="col-lg-12 col-sm-12 col-xs-12">
            <div class="col-lg-5" >
                <div class="propic" style="text-align: center; padding: 4px;">
                    <img src="assets/images/user1.png">
                </div>

                <div class="col-md-12">
                    <div class="col-lg-1"></div>
                    <div class="col-lg-3 col-md-5 col-sm-5 col-xs-5 form-control-label">
                        <label for="name">Role</label>
                    </div>
                    <div class="col-lg-5 col-md-4 col-sm-5 col-xs-7">
                        <div class="form-group">
                            <div class="form-line">
                                <input type="" class="form-control" id="role" readonly>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <br>

            <div class="col-lg-7">
                <form class="form-horizontal" id="profile_form" style="text-align: center; display: block;">
                
                    <h3>Basic Information</h3>
                    <div class="row clearfix">
                        <div class="col-md-12">
                            <div class="col-lg-2"></div>
                            <div class="col-lg-3 col-md-5 col-sm-5 col-xs-5 form-control-label">
                                <label for="name">First Name</label>
                            </div>
                            <div class="col-lg-5 col-md-4 col-sm-5 col-xs-7">
                                <div class="form-group">
                                    <div class="form-line">
                                        <input type="" class="form-control" placeholder="{{ $user->name }}" readonly>
                                    </div>
                                </div>
                            </div>
                        </div>
                        
                        <div class="col-md-12">
                            <div class="col-lg-2"></div>
                            <div class="col-lg-3 col-md-5 col-sm-5 col-xs-5 form-control-label">
                                <label for="name">Middle Name</label>
                            </div>
                            <div class="col-lg-5 col-md-4 col-sm-5 col-xs-7">
                                <div class="form-group">
                                    <div class="form-line">
                                        <input type="" class="form-control" placeholder="{{ $user->name }}" readonly>
                                    </div>
                                </div>
                            </div>
                        </div>
                        
                        <div class="col-md-12">
                            <div class="col-lg-2"></div>
                            <div class="col-lg-3 col-md-5 col-sm-5 col-xs-5 form-control-label">
                                <label for="name">Last Name</label>
                            </div>
                            <div class="col-lg-5 col-md-4 col-sm-5 col-xs-7">
                                <div class="form-group">
                                    <div class="form-line">
                                        <input type="" class="form-control" placeholder="{{ $user->name }}" readonly>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <hr style="color: black; display: block; height: 10px">

                    <div class="row clearfix">

                        <h3>Edit Credentials</h3>
                        <input type="hidden" name="id" class="form-control" value="{{ $user->id }}">
                        <div class="col-md-12">
                            <div class="col-lg-2"></div>
                            <div class="col-lg-3 col-md-5 col-sm-5 col-xs-5 form-control-label">
                                <label for="name">Username</label>
                            </div>
                            <div class="col-lg-5 col-md-4 col-sm-5 col-xs-7">
                                <div class="form-group">
                                    <div class="form-line">
                                        <input type="" name="username" class="form-control" value="{{ $user->name }}" readonly>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-12">
                            <div class="col-lg-2"></div>
                            <div class="col-lg-3 col-md-5 col-sm-5 col-xs-5 form-control-label">
                                <label for="name">Old Password</label>
                            </div>
                            <div class="col-lg-5 col-md-4 col-sm-5 col-xs-7">
                                <div class="form-group">
                                    <div class="form-line">
                                        <input type="password" name="opassword" id="opassword" class="form-control" required>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-12">
                            <div class="col-lg-2"></div>
                            <div class="col-lg-3 col-md-5 col-sm-5 col-xs-5 form-control-label">
                                <label for="name">New Password</label>
                            </div>
                            <div class="col-lg-5 col-md-4 col-sm-5 col-xs-7">
                                <div class="form-group">
                                    <div class="form-line">
                                        <input type="password" name="npassword" id="npassword" class="form-control" required>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-12">
                            <div class="col-lg-2"></div>
                            <div class="col-lg-3 col-md-5 col-sm-5 col-xs-5 form-control-label">
                                <label for="name">Confirm New Password</label>
                            </div>
                            <div class="col-lg-5 col-md-4 col-sm-5 col-xs-7">
                                <div class="form-group">
                                    <div class="form-line">
                                        <input type="password" name="cnpassword" id="cnpassword" class="form-control" required>
                                    </div>
                                </div>
                            </div>
                        </div>
                        
                        <div class="col-md-12 col-sm-12">
                            <p id="notMatch" style="color: red; display: none; text-align: center;">New Password fields do not match</p>
                        </div>

                        <div class="col-md-12 col-sm-12">
                            <button type="submit" id="changePass" class="btn btn-link waves-effect">SAVE CHANGES</button>
                        </div>
                        
                    </div>
                </form>
            </div>
            <br>
        </div>
    </div>
@endsection

@section('script')
    <script>
        var role = {{$user->access_id}};

        if(role == 1){
            role = "admin";
        }
        else if(role == 2){
            role = "cashier";
        }

        $('#role').attr("placeholder", role);
    </script>
@endsection