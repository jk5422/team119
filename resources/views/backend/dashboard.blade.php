@extends('backend.layouts.main')

@section('doctor-container')

            <!-- Sale & Revenue Start -->
            <div class="container-fluid pt-4 px-4">
                <div class="row g-4">
                    <div class="col-sm-6 col-xl-3">
                        <div class="bg-light h-100 rounded d-flex align-items-center justify-content-between p-4">
                            <i class="fas fa-calendar-check" style="color: #045ffb;font-size:40px;"></i>
                            <div class="ms-3">
                                <p class="mb-2">Confirmed Appoinments</p>
                                <h6 class="mb-0 apcount"></h6>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-6 col-xl-3">
                        <div class="bg-light h-100 rounded d-flex align-items-center justify-content-between p-4">
                            <i class="fas fa-book-medical" style="color: #045ffb;font-size:40px;"></i>
                            <div class="ms-3">
                                <p class="mb-2">Pending Appoinements</p>
                                <h6 class="mb-0 appcount"></h6>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-6 col-xl-3">
                        <div class="bg-light h-100 rounded d-flex align-items-center justify-content-between p-4">
                            <i class="fas fa-user-check" style="color: #045ffb;font-size:40px;"></i>
                            <div class="ms-3">
                                <p class="mb-2">Patients</p>
                                <h6 class="mb-0 patients"></h6>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-6 col-xl-3">
                        <div class="bg-light h-100 rounded d-flex align-items-center justify-content-between p-4">
                            <i class="fas fa-ban fa-lg" style="color: #005eff;"></i>
                            <div class="ms-3">
                                <p class="mb-2">Cancellation Request</p>
                                <h6 class="mb-0 contact"></h6>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Sale & Revenue End -->




            <!-- Recent Sales Start -->
            <div class="container-fluid pt-4 px-4">
                <div class="text-center rounded p-4" style="background-color: aliceblue;">
                    <div class="d-flex align-items-center justify-content-between mb-4">
                        <h6 class="mb-0">Recent Appoinments</h6>
                        <a href="{{url('/doctor/pendappoinments')}}">Show All</a>
                    </div>
                    <div class="table-responsive">
                        <table  id="recent" class="table text-start align-middle table-bordered table-hover mb-0">
                            <thead>
                                <tr class="text-dark">
                                    <th scope="col">ApNO</th>
                                    <th scope="col">Date</th>
                                    <th scope="col">Time</th>
                                    <th scope="col">Patient</th>
                                    <th scope="col">ApStatus</th>
                                    <th scope="col">Payment</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>

                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <!-- Recent Sales End -->


            <!-- Widgets Start -->
            <div class="container-fluid pt-4 px-4 mb-5">
                <div class="row g-4">
                    <div class="col-sm-12 col-md-6 col-xl-6">
                        <div class="h-100 bg-light rounded p-4">
                            <div class="d-flex align-items-center justify-content-between mb-2">
                                <h6 class="mb-0">Recent Payments</h6>
                                <a href="/doctor/allpayments">Show All</a>
                            </div>
                            <div class="d-flex align-items-center border-bottom py-3">
                                {{-- <img class="rounded-circle flex-shrink-0" src="img/user.jpg" alt="" style="width: 40px; height: 40px;">
                                <div class="w-100 ms-3">
                                    <div class="d-flex w-100 justify-content-between">
                                        <h6 class="mb-0">Jhon Doe</h6>
                                        <small>15 minutes ago</small>
                                    </div>
                                    <span>Short message goes here...</span>
                                </div> --}}

                                <div class="table-responsive">
                                    <table  id="payment" class="table text-start align-middle table-bordered table-hover mb-0">
                                        <thead>
                                            <tr class="text-dark">
                                                <th scope="col">ApNO</th>
                                                <th scope="col">PayDate</th>
                                                <th scope="col">PayID</th>
                                            </tr>
                                        </thead>
                                        <tbody>

                                        </tbody>
                                    </table>
                                </div>

                            </div>



                        </div>
                    </div>
                    <div class="col-sm-12 col-md-6 col-xl-6">
                        <div class="h-100 bg-light rounded p-4">
                            <div class="d-flex align-items-center justify-content-between mb-4">
                                <h6 class="mb-0">Calender</h6>
                                <a href="">Show All</a>
                            </div>
                            <div id="calender"></div>
                        </div>
                    </div>

                </div>
            </div>
            <!-- Widgets End -->

            <script>
                $(document).ready(function() {
                    $.ajax({
                            url: '/getrecentapp',
                            type: 'get',
                            success: function(res) {
                                if(res)
                                {
                                    $('#recent').append(res);
                                }
                                else
                                {
                                    $('#recent').html(' ');
                                }
                            }
                    });

                    $.ajax({
                            url: '/getpayments',
                            type: 'get',
                            success: function(res) {
                                if(res)
                                {
                                    $('#payment').append(res);
                                }
                                else
                                {
                                    $('#payment').html(' ');
                                }
                            }
                    });


                    $.ajax({
                            url: '/getcounts',
                            type: 'get',
                            success: function(res) {
                                if(res){
                                    // alert(res.apcount);
                                    $('.apcount').html(res.apccount);
                                    $('.appcount').html(res.appcount);
                                    $('.patients').html(res.patients);
                                    $('.contact').html(res.contact);
                                }
                                else
                                {
                                    $('.apcount').html('0');
                                    $('.appcount').html('0');
                                    $('.patients').html('0');
                                    $('.contact').html('0');
                                }
                            }
                        });

                });

                var myInterval = setInterval(everyTime, 60000);

                    function everyTime() {
                            $.ajax({
                            url: '/getcounts',
                            type: 'get',
                            success: function(res) {
                                if(res){
                                    // alert(res.apcount);
                                    $('.apcount').html(res.apccount);
                                    $('.appcount').html(res.appcount);
                                    $('.patients').html(res.patients);
                                    $('.contact').html(res.contact);
                                }
                                else
                                {
                                    $('.apcount').html('0');
                                    $('.appcount').html('0');
                                    $('.patients').html('0');
                                    $('.contact').html('0');
                                }
                            }
                        });
                    }


 </script>

@endsection
