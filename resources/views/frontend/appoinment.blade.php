@extends('frontend.layouts.main')

@section('main-container')
    @if (session('apflse'))
        <div class="alert alert-danger fade in" id="alert">
            <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
            <strong>Error!</strong> {{ session('apflse') }}
        </div>
        {{ Session::forget('apflse') }}
    @endif


    @if($message = Session::get('success'))
    <div class="alert alert-success alert-dismissible fade {{ Session::has('success') ? 'show' : 'in' }}" role="alert">
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">×</span>
        </button>
        <strong>Success!</strong> {{ $message }}
    </div>
@endif

    <div class="container mt-5 mb-5" id="appoinment">
        <div class="row">
            <div class="col-md-3 border-right">
                <img class="rounded-circle mt-5"
                        width="150px" src="{{ url('frontend/images/appoinment_symbol.png') }}">
                    <p class="font-weight-bold"><b>{{$data['pname']}}</b></p>

            </div>
            <div class="col-md-5 border-right" id="prdetail">
                <div class="p-3 py-5">
                    <div>
                        <hr>
                        <h3 class="text-center">Take an appoinment</h3>
                    </div>
                    <form action="/appoinment-done" method="POST" id="apnt">
                        @csrf
                        <div class="row ">
                            <div class="col-md-6">
                                <input type="hidden" class="pid" name="pid" value="{{$data['pid']}}">
                                <input type="hidden" name="payid" class="payid">

                                <label class="labels">Name</label>
                                <input type="text" class="form-control" value="{{$data['pname']}}" placeholder="full name" disabled>
                            </div>
                            <div class="col-md-6">
                                <label class="labels">Mobile</label>
                                <input type="tel" class="form-control" value="{{$data['pmobile']}}" placeholder="Mobile" maxlength="10" disabled>
                            </div>
                        </div>
                        <div class="row ">
                            <div class="col-md-6">
                                <label class="labels">Email</label>
                                <input type="email" class="form-control" value="{{$data['pemail']}}" placeholder="email" disabled>
                            </div>
                            <div class="col-md-6">
                                <label class="labels">Age</label>
                                <input type="text" class="form-control" value="{{$data['page']}}"  placeholder="Age"  value="" disabled>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <label class="labels">Gender</label>
                                <select class="form-control" disabled>
                                    <option @if ($data['pgender']=='M')
                                        selected
                                    @endif>Male</option>
                                    <option @if ($data['pgender']=='F')
                                        selected
                                    @endif>Female</option>
                                </select>
                            </div>
                            <div class="col-md-6">
                                <label class="labels">Select appoinment date</label>
                                <input type="date" name="apdate" class="form-control mydate" onchange="getday(this.value)" required data-parsley-required-message="Please select appointment date">
                                <span id="msg"></span>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <label class="labels">Select time slot</label>
                                <select class="form-control mytime" name="aptime" id="aptime" onchange="timeslot()" required data-parsley-required-message="Please select time slot">
                                    <option value="">--Select Time Slot--</option>
                                    <option value="09:00AM - 10:00AM">09:00AM - 10:00AM</option>
                                    <option value="10:00AM - 11:00AM">10:00AM - 11:00AM</option>
                                    <option value="11:00AM - 12:00PM">11:00AM - 12:00PM</option>
                                    <option value="12:00PM - 01:00PM">12:00PM - 01:00PM</option>
                                    <option value="01:00PM - 02:00PM">01:00PM - 02:00PM</option>
                                    <option value="02:00PM - 03:00PM">02:00PM - 03:00PM</option>
                                    <option value="03:00PM - 04:00PM">03:00PM - 04:00PM</option>
                                    <option value="04:00PM - 05:00PM">04:00PM - 05:00PM</option>
                                    <option value="05:00PM - 06:00PM">05:00PM - 06:00PM</option>
                                    <option value="06:00PM - 07:00PM">06:00PM - 07:00PM</option>
                                    <option value="07:00PM - 08:00PM">07:00PM - 08:00PM</option>
                                </select>
                                <span id="smsg"></span>
                            </div>

                            <div class="col-md-6">
                                <label class="labels">Select Doctor</label>
                                <select class="form-control mydctr" name="apdctr" id="apdctr" onchange="getclinic(this.value)" required data-parsley-required-message="Please select doctor">
                                    <option value="">--Select Doctor--</option>
                                    @foreach ($doctor as $doct)
                                    <option value="{{$doct['did']}}">{{$doct['dname']}}</option>
                                    @endforeach
                                </select>
                            </div>


                        </div>

                        <div class="row">

                            <div class="col-md-6">
                                <label class="labels">Select Clinic</label>
                                <select class="form-control myclnc" name="apclnc" id="apclnc" required data-parsley-required-message="Please select clinic">
                                    <option value="">Select Clinic</option>
                                </select>
                            </div>

                            <div class="col-md-6">
                                <label class="labels">Select Services</label>
                                <select class="form-control mysrvc" name="apsrvc" id="apsrvc" required data-parsley-required-message="Please select service" >
                                    <option value="">--Select Services-- </option>
                                </select>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-12">

                                <legend >--Select Payment Mode--</legend>
                                <input type="radio"  id="cash" name="payment" value="Cash" onclick="paycash()">
                                <label for="cash">Cash On Counter</label>
                                <input type="radio" id="rzp-button1" name="payment" value="Online">
                                <label for="online">Razorpay(UPI/Cards/QR)</label>

                            </div>
                        </div>

                        <div class="row " id="prbtn">
                            <div class="col-md-6">
                                <div class="text-center">
                                    <a href="/dashboard" class="btn btn-primary profile-button" type="button">Back</a>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="text-center">
                                    <button class="btn btn-primary profile-button onlinepay" value="{{$data['pid']}}"  type="button" onclick="return submitform(this.value);">Take appoinment</button>
                                </div>
                            </div>
                        </div>

                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
