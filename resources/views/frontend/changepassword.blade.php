@extends('frontend.layouts.main')

@section('main-container')

    @if (session('passflse'))
        <div class="alert alert-danger fade in" id="alert">
            <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
            <strong>Error!</strong> {{ session('passflse') }}
        </div>
        {{ Session::forget('passflse') }}
    @endif

    <div class="container mt-5 mb-5" id="profile">
        <div class="row">
            <div class="col-md-3 border-right">
                <div ><img class="rounded-circle mt-5"
                        width="150px" src="{{ url('frontend/images/change_pass.png') }}">
                    <p class="font-weight-bold"><b>{{$data->pname}}</b></p>
                </div>
            </div>
            <div class="col-md-5 border-right" id="prdetail">
                <div class="p-3 py-5">
                    <div>
                        <hr>
                        <h3 class="text-center">Change Password</h3>
                    </div>
                    <form action="/password-update" method="POST" id="changepass">
                        @csrf
                        <div class="row mt-2">
                            <div class="col-md-12">
                                <input type="hidden" name="pid" value="{{ $data->pid}}">
                                <label class="labels">Old Password</label>
                                <input type="password" class="form-control" id="password" placeholder="old password" name="opass" required data-parsley-required-message="Please enter password">
                            </div>

                        </div>
                        <div class="row mt-3">
                            <div class="col-md-12">
                                <label class="labels">New Password</label>
                                <input type="password" class="form-control" id="npassword" placeholder="New Password" name="npass" required data-parsley-required-message="Please enter new password" data-parsley-pattern="/^(?=.*\d)(?=.*[a-z])(?=.*[A-Z])(?=.*[^a-zA-Z0-9])(?!.*\s).{8,15}$/" data-parsley-pattern-message=" a password must be 8 character including one uppercase letter, one special character and one number"  data-parsley-trigger="keyup">
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-12">
                                <label class="labels">Confirm Password</label>
                                <input type="password" class="form-control" id="cpassword" name="cnpass" placeholder="Confirm New Password" required data-parsley-required-message="Please enter confirm password" data-parsley-equalto="#npassword" data-parsley-equalto-message="Password are not matching"  data-parsley-trigger="keyup">
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-12">
                                <input type="checkbox" onclick="showpass()">
                                <label class="labels">Show Password</label>
                            </div>
                        </div>

                        <div class="row " id="prbtn">
                            <div class="col-md-6 col-sm-6 col-12">

                                    <a href="/dashboard" class="btn btn-primary profile-button" type="button">Back</a>

                            </div>
                            <div class="col-md-6 col-sm-6 col-12">
                                <button class="btn btn-primary profile-button" type="submit">Change Password</button>
                            </div>
                        </div>


                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
