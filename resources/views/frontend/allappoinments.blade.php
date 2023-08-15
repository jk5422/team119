@extends('frontend.layouts.main')

@section('main-container')
    @if (session('aptrue'))
        <div class="alert alert-success fade in" id="alert">
            <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
            <strong>Success!</strong> {{ session('aptrue') }}
        </div>
        {{ Session::forget('aptrue') }}
    @endif

    @if (session('apupdt'))
    <div class="alert alert-success fade in" id="alert">
        <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
        <strong>Success!</strong> {{ session('apupdt') }}
    </div>
    {{ Session::forget('apupdt') }}
@endif

@if (session('apupfls'))
<div class="alert alert-danger fade in" id="alert">
    <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
    <strong>Success!</strong> {{ session('apupfls') }}
</div>
{{ Session::forget('apupfls') }}
@endif


        <div class="container-fluid ">

            <div class="container-inq">
                <div class="title">
                    <h2>All Appoinments</h2>
                </div>

                <div class="d-flex">
                    <div class="row header" >
                        <table id="example" class="table table-striped table-bordered">
                            <thead>
                                <tr>
                                    <th>App.No</th>
                                    <th>Name</th>
                                    <th>App.Date</th>
                                    <th>Appo.Time</th>
                                    <th>Payment Mode</th>
                                    <th>App.Status</th>
                                    <th>Update(Date/time)</th>
                                    <th>Download/View</th>
                                    <th>View Prescription</th>
                                    <th>Cancellation</th>
                                </tr>
                            </thead>
                    </div>
                    <input type="hidden" class="pid" name="pid" value="{{Session('pid')}}">
                    <tbody>


                        @foreach ($result as $item)
                        <tr>
                            <td>{{ $item->apno }}</td>
                            <td>{{ $item->pname }}</td>
                            <td>{{ date('d-m-Y', strtotime($item->apdate)) }}</td>
                            <td>{{ $item->aptimeslot }}</td>
                            <td>{{ $item->paymode }}</td>

                                @if ($item->apstatus == '')
                                <td style="color: purple;"> Pending Visit </td>
                                @elseif ($item->apstatus == '0')
                                    <td style="color: red;">Cancelled</td>
                                @elseif ($item->apstatus == '2')
                                   <td style="color: blue;">Request For Cancellation</td>
                                @else
                                    <td style="color: green;">Visited</td>
                                @endif

                            @if ($item->apstatus == '')
                            <td>

                                <button value="{{ $item->apno }}" onclick="upapno(this.value)" title="Update details" style="font-size: 20px;" data-toggle="modal"
                                    data-target="#flipFlop"><i class="fa fa-pencil-square" aria-hidden="true"></i>
                                </button></td>

                            @else
                                  <td>N/A</td>
                            @endif

                            @if ($item->apstatus == '' || $item->apstatus == '1')
                            <td><a href="" title="Download pdf" onclick=" window.open('/pdf/{{$item->apno}}', '_blank', 'width=800, height=500');"
                                style="font-size: 20px;"><i class="fa fa-download" aria-hidden="true"></i></a></td>

                            @else
                                   <td>N/A</td>
                            @endif



                            @if ($item->apstatus == '')
                                <td style="color: blue;">Pending</td>
                            @elseif ($item->apstatus == '0' || $item->apstatus == '2')
                                <td>N/A</td>
                            @else
                                <td><a href="" title="View Prescription" onclick=" window.open('/prescription/{{$item->apno}}', '_blank', 'width=800, height=500');"
                                        style="font-size: 22px;"><i class="fa fa-eye" aria-hidden="true"></i></a></td>
                            @endif

                            @if ($item->apstatus == '')
                            <td>

                                <button value="{{ $item->apno }}" onclick="cancelapp(this.value)" title="Cancellation Request" style="font-size: 20px;" data-toggle="modal"
                                    data-target="#cancelapp"><i class="fa fa-ban" aria-hidden="true"></i>
                                </button></td>

                            @else
                                  <td>N/A</td>
                            @endif

                        </tr>
                    @endforeach





                    </tbody>

                    </table>
                </div>
            </div>
            <div class="empadd">
                <span><i class="fa fa-arrow-left" aria-hidden="true"></i><a href="/dashboard" style="margin-left: 1rem;"
                        type="button">Go Back</a></span>
            </div>
        </div>





{{-- update appoinment modal --}}

    <div class="modal fade" id="flipFlop" tabindex="-1" role="dialog" aria-labelledby="modalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                    <h4 class="modal-title" id="modalLabel">Update Appoinment Details</h4>
                </div>
                <div class="modal-body">
                    <form action="{{ url('updateappoinment') }}" method="POST" id=updateapp>
                        @csrf
                        <div class="form-group">
                            <input type="hidden" name="apno" id="uapno" value="">
                            <input type="hidden" name="pid" value="{{session('pid')}}">


                            <label class="labels">Select appoinment date</label>
                            <input type="date" name="uapdate"  class="form-control mydate" onchange="upgetday(this.value)" required data-parsley-required-message="Please select date">
                            <span id="msg"></span>
                        </div>
                        <div class="form-group">
                            <label class="labels">Select time slot</label>
                            <select class="form-control mytime" name="uaptime" id="aptime" onchange="timeslot()"  required data-parsley-required-message="Please select time slot">
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
                        <button type="submit" class="btn btn-success">Update</button>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>

    {{-- cancellation appoinment modal --}}
    <div class="modal fade" id="cancelapp" tabindex="-1" role="dialog" aria-labelledby="modalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                    <h4 class="modal-title" id="modalLabel">Cancel Appoinment</h4>
                </div>
                <div class="modal-body">
                    <form action="{{ url('/cancelappoinment') }}" method="POST">
                        @csrf
                        <div class="form-group">
                            <input type="hidden" name="upapno" id="upapno" value="">
                            <input type="hidden" name="pid" value="{{session('pid')}}">
                            <input type="hidden" name="upast" value="2">

                            <p style="color:red;">Are You Sure to cancel appoinment..???</p>

                        </div>

                        <button type="submit" class="btn btn-success">Cancel</button>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>
@endsection
