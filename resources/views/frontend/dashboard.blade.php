@extends('frontend.layouts.main')

@section('main-container')
    <!-- dash Start -->
    <div class="container py-5">
        <div class="container">
            <div class="text-center wow fadeInUp" data-wow-delay="0.1s">
                <h2 class="mb-5">Patient <span class="text-primary text-uppercase">Dashboard</span></h2>
            </div>

            <div class="row g-4" id="dashdetails">
                <div class="col-lg-3 col-md-4 col-sm-6 col-12 wow fadeInUp" data-wow-delay="0.2s">
                    <a class="dash-item rounded" href="{{url('/profile-view')}}/{{Session::get('pid')}}">
                        <div class="dash-icon bg-transparent border rounded ">

                                <img src="{{url('frontend/images/profile_symbol.png')}}" alt="#" height="80px" width="60px">

                        </div>
                        <h5 class="mb-3">Profile</h5>
                        <p class="text-body mb-0"></p>
                    </a>
                </div>

                <div class="col-lg-3 col-md-4 col-sm-6 col-12 wow fadeInUp" data-wow-delay="0.2s">
                    <a class="dash-item rounded" href="{{url('/appoinments-take')}}/{{Session::get('pid')}}">
                        <div class="dash-icon bg-transparent border rounded ">

                                <img src="{{url('frontend/images/appoinment_symbol.png')}}" alt="#" height="80px" width="60px">

                        </div>
                        <h5 class="mb-3">Make an appoinments</h5>
                        <p class="text-body mb-0"></p>
                    </a>
                </div>

                <div class="col-lg-3 col-md-4 col-sm-6 col-12 wow fadeInUp" data-wow-delay="0.2s">
                    <a class="dash-item rounded" href="{{url('/appoinments-view')}}/{{Session::get('pid')}}">
                        <div class="dash-icon bg-transparent border rounded ">

                                <img src="{{url('frontend/images/view_appoinment.png')}}" alt="#" height="80px" width="60px">

                        </div>
                        <h5 class="mb-3">View appoinments</h5>
                        <p class="text-body mb-0"></p>
                    </a>
                </div>

                <div class="col-lg-3 col-md-4 col-sm-6 col-12 wow fadeInUp" data-wow-delay="0.2s">
                    <a class="dash-item rounded" href="{{url('/change-pass')}}/{{Session::get('pid')}}">
                        <div class="dash-icon bg-transparent border rounded ">

                                <img src="{{url('frontend/images/change_pass.png')}}" alt="#" height="80px" width="60px">

                        </div>
                        <h5 class="mb-3">Change Password</h5>
                        <p class="text-body mb-0"></p>
                    </a>
                </div>
            </div>
        </div>
    </div>
    <!-- dash End -->
@endsection
