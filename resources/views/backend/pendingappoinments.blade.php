@extends('backend.layouts.main')

@section('doctor-container')
    @if (session('atrue'))
        <div class="alert alert-success fade in" id="alert">
            <a href="#" class="close" data-dismiss="alert" aria-label="close"></a>
            <strong>Success!</strong> {{ session('atrue') }}
        </div>
        {{ Session::forget('atrue') }}
    @endif


    @if (session('afalse'))
        <div class="alert alert-danger fade in" id="alert">
            <a href="#" class="close" data-dismiss="alert" aria-label="close"></a>
            <strong>Error!</strong> {{ session('afalse') }}
        </div>
        {{ Session::forget('afalse') }}
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


    <div class="container-xxl pt-4 ">

        <div class="container p-0">
            <div class="empadd">
                <fieldset class="form-control" style="background-color:aliceblue;">
                    <legend>Action Tab</legend>

                    <span class="btn btn-warning"><i class="fas fa-arrow-alt-circle-up"></i><a href="/doctor/allappoinments" class="text-dark ms-2">Visited Appoinments</a>
                </span>

                    {{-- <span class="btn btn-info"><i class="fas fa-notes-medical"></i><a href="" class="text-dark ms-2" data-bs-toggle="modal"
                            data-bs-target="#addclinic">Change Prescription</a>
                    </span> --}}

                </fieldset>
            </div>
            <div class="main">

                <div class="container-inq">
                    <div class="title">
                        <h2>All Pending Appoinements</h2>
                    </div>

                    <div class="d-flex">
                        <div class="row header" style="text-align: center;">
                            <table id="example" class="table table-striped table-bordered"
                                style="border: 1px solid #dadada;">
                                <thead>
                                    <tr>
                                        <th>APNO</th>
                                        <th>Patient Name</th>
                                        <th>Appoinment Date</th>
                                        <th>Status</th>
                                        <th>Payment</th>
                                        <th>Associated<br> Doctor</th>
                                        <th>View</th>
                                        <th>Change</th>
                                        <th>Confirm<br>Cancel</th>
                                        <th class="w-50">Prescription</th>
                                    </tr>
                                </thead>
                        </div>
                        <tbody>
                                @foreach ($data as $item)
                                    <tr>
                                        <td>{{$item->apno}}</td>
                                        <td>{{$item->pname}}</td>
                                        <td>{{date('d-m-Y', strtotime($item->apdate))}}</td>

                                        @if ($item->apstatus=='')
                                            <td>Pending</td>
                                        @endif
                                        <td>{{$item->paymode}}</td>
                                        <td>{{$item->dname}}</td>
                                        <td>
                                            <button type="button" title="View Appoinment" class="btn btn-warning" onclick="window.open('allappoinments/pdf/{{$item->apno}}', '_blank', 'width=800, height=500');"><i class="fas fa-eye"></i></button>
                                        </td>

                                        <td>
                                            <button type="button" title="Change Appoinment details" class="btn btn-danger text-white"  value="{{$item->apno}}" onclick="checkfordatemodify(this.value)"><i class="fas fa-edit"></i></button>
                                        </td>
                                        <td>
                                            <button type="button" title="Confirm/Cancel Appoinment" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#confirm"  value="{{$item->apno}}" onclick="setapno(this.value);"><i class="fas fa-check-circle me-2"></i> <i class="fas fa-window-close"></i></button>
                                        </td>

                                            <td>
                                                <button type="button" title="Add Prescription" class="btn btn-info me-1" onclick="checkforprescription(this.value)"  value="{{$item->apno}}"><i class="fas fa-notes-medical"></i></button>
                                                <button type="button" title="View Prescription" class="btn btn-info me-1" onclick="checkforprespdf(this.value)"  value="{{$item->apno}}"><i class="fas fa-eye"></i></button>
                                                <button type="button" title="Update Prescription" class="btn btn-info " onclick="window.open('pendappoinments/getpresc/{{$item->apno}}', '_blank', 'width=800, height=500');"  value="{{$item->apno}}"><i class="fas fa-pen-square"></i></button>
                                        </td>

                                    </tr>
                                @endforeach
                        </tbody>

                        </table>
                    </div>
                </div>
                <div class="empadd">
                    <span><i class="fa fa-arrow-left" aria-hidden="true"></i><a href="{{ url('doctor/dashboard') }}"
                            style="margin-left: 1rem;" type="button">Go Back</a></span>
                </div>
            </div>
        </div>

        {{-- appoinment confirm model --}}

        <div class="modal fade" id="confirm" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Update Appoinment Status</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <form action="{{ url('pendappoinments/uapstatus') }}" method="POST">
                            @csrf
                            <div class="row h-100 align-items-center justify-content-center">
                                <div class="col-12 col-sm-12 col-md-12 col-lg-12 col-xl-12">
                                    <input type="hidden" class="capno" name="upapno" value="">
                                    <div class="form-floating mb-3">
                                        <input type="text" class="form-control capno" name="upapno" disabled>
                                        <label>Appoinment No</label>
                                    </div>
                                </div>
                            </div>
                            <div class="row h-100 align-items-center justify-content-center">
                                <div class="col-12 col-sm-12 col-md-12 col-lg-12 col-xl-12">
                                    <div class="mb-3">
                                        <fieldset class="form-control gender bg-white" required>
                                            <legend style="font-size: 15px;">Select Status</legend>
                                            <input type="radio" class="" name="upast" id="confirm"
                                                value="1">
                                            <label for="confirm">Visited</label>
                                            <input type="radio" class="" name="upast" id="cancel"
                                                value="0">
                                            <label for="cancel">Cancel</label>
                                            <input type="radio" class="" name="upast" id="pending"
                                            value="">
                                        <label for="cancel">Pending</label>
                                        </fieldset>
                                    </div>
                                    <p class="text-danger">Once You have tick Visited Appointment after you are not be able to modify Prescription Details.</p>
                                </div>
                            </div>
                            <button type="submit" class="btn btn-primary">Save Changes</button>
                        </form>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    </div>
                </div>
            </div>
        </div>
        </div>


         {{-- Change model --}}

         <div class="modal fade" id="modifydata" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Update Appoinement Details</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <form action="{{ url('pendappoinments/uapdata') }}" method="POST" id="updateapp">
                            @csrf
                            <div class="row h-100 align-items-center justify-content-center">
                                <div class="col-12 col-sm-12 col-md-12 col-lg-12 col-xl-12">
                                    <input type="hidden" class="uapno" name="apno" value="">
                                    <div class="form-floating mb-3">
                                        <input type="text" class="form-control uapno" name="apno" disabled>
                                        <label class="form-check-label">Appoinment No</label>
                                    </div>
                                </div>
                            </div>
                            <div class="row h-100 align-items-center justify-content-center">
                                <div class="col-12 col-sm-12 col-md-12 col-lg-12 col-xl-12">
                                    <div class="form-floating mb-3">
                                        <input type="date" name="uapdate"  class="form-control mydate" onchange="getday(this.value)" required data-parsley-required-message="Please select appointment date">
                                        <label class="form-check-label labels">Select appoinment date</label>
                                    </div>
                                </div>
                            </div>
                            <div class="row h-100 align-items-center justify-content-center">
                                <div class="col-12 col-sm-12 col-md-12 col-lg-12 col-xl-12">
                                    <div class="form-floating mb-3">
                                        <select class="form-control mytime" name="uaptime" id="aptime" onchange="timeslot()" required data-parsley-required-message="Please select time slot">
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
                                        <label class="form-check-label">Select time slot</label>
                                        <span id="smsg"></span>
                                    </div>
                                </div>
                            </div>
                            <button type="submit" class="btn btn-primary">Save Changes</button>
                        </form>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    </div>
                </div>
            </div>
        </div>
        </div>


        {{-- add prescriptioin model --}}
        <div class="modal fade" id="prescreption" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Add Prescreption</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <form action="{{ url('pendappoinments/addprescription') }}" method="POST" id="addprescription">
                            @csrf

                            <div class="row h-100 align-items-center justify-content-center">
                                <div class="col-12 col-sm-12 col-md-12 col-lg-12 col-xl-12">
                                    <div class="form-floating mb-3">
                                        <input type="hidden" class="upapno" name="apno" value="">
                                        <input type="text" class="form-control upapno" disabled>
                                        <label class="form-check-label">Appoinment No</label>
                                    </div>
                                </div>
                            </div>


                            <div class="row h-100 align-items-center justify-content-center">
                                <div class="col-12 col-sm-12 col-md-12 col-lg-12 col-xl-12">

                                    <div class="table-responsive">
                                        <p class="text-danger">First Add medicine entry and then try to submit</p>
                                        <table class="table table-primary" border="1" id="prescribe">
                                            <thead>
                                                <tr>
                                                    <th scope="col">Select Medicine</th>
                                                    <th scope="col">Morning</th>
                                                    <th scope="col">Afternoon</th>
                                                    <th scope="col">Evening</th>
                                                    <th scope="col">Night</th>
                                                    <th scope="col">Remarks</th>
                                                    <th>Add/Remove</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <tr>
                                                    <td scope="row"><select id="medcnid" required data-parsley-required-message="Please select medicine name"></select></td>
                                                    <td>
                                                        <select id="mrng">
                                                            <option value="">--Select--</option>
                                                    <option value="AB">AB-After Breakfast</option>
                                                    <option value="BB">BB-Before Breakfast</option>
                                                    </select>
                                                  </td>
                                                    <td>
                                                        <select id="afrn">
                                                            <option value="">--Select--</option>
                                                        <option value="AL">AL-After Lunch</option>
                                                        <option value="BL">BL-Before Lunch</option>
                                                        </select>
                                                    </td>
                                                    <td>
                                                        <select id="evng">
                                                            <option value="">--Select--</option>
                                                        <option value="AD">AD-After Dinner</option>
                                                        <option value="BD">BD-Before Dinner</option>
                                                        </select>
                                                    </td>
                                                    <td>
                                                        <select id="nght">
                                                            <option value="">--Select--</option>
                                                        <option value="N">N-At Night</option>
                                                        </select>
                                                    </td>
                                                    <td>
                                                        <input type="text" id="remark"  placeholder="Remarks">
                                                    </td>
                                                    <td><button type="button" class="btn btn-primary" id="add">Add</button></td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>


                                </div>
                            </div>

                            <button type="submit" class="btn btn-primary">Add Prescription</button>
                        </form>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    </div>
                </div>
            </div>
        </div>
        </div>





        {{-- Error modal --}}
        <div class="modal" tabindex="-1" id="error">
            <div class="modal-dialog">
              <div class="modal-content">
                <div class="modal-header">
                  <h5 class="modal-title">#__Alert__#</h5>
                  <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <ol>
                        <li class="text-danger">"!!..After add prescription if you want to Add/Update Prescription then please use change prescription button..!!"</li>
                        <li class="text-danger">"!!..After add prescription you are not be able to do any kind of modification with appoinment details..!!"</li>
                        <li class="text-danger">"!!..Without added prescription you are not be able to view/Update..!!"</li>
                        <li class="text-success">"!!..Now you can do confirm particular appoinment..!!"</li>
                    </ol>

                </div>
              </div>
            </div>
          </div>


        <script>

            function setapno(apno){
                $('.capno').val(apno);
            }

            // for add prescription
                function checkforprescription(apno){
                $('.upapno').val(apno);
                $.ajax({
                url: '/getpresdata',
                type: 'post',
                data: 'apno=' + apno + '&_token={{ csrf_token() }}',
                success: function(res) {

                        if(res>=1){
                            $('#error').modal('show');
                        }
                        else
                        {
                            $('#prescreption').modal('show');
                        }
                    }
                });

            }

            // prescription view pdf
            function checkforprespdf(apno){
                $.ajax({
                url: '/getpresdata',
                type: 'post',
                data: 'apno=' + apno + '&_token={{ csrf_token() }}',
                success: function(res) {

                        if(res>=1){
                            window.open('pendappoinments/prescription/pdf/'+apno, '_blank', 'width=800, height=500');
                        }
                        else
                        {
                            $('#error').modal('show');
                        }
                    }
                });
            }

            // for appoinment date change
            function checkfordatemodify(apno){
                $('.uapno').val(apno);
                $.ajax({
                url: '/getpresdata',
                type: 'post',
                data: 'apno=' + apno + '&_token={{ csrf_token() }}',
                success: function(res) {

                        if(res>=1){
                            $('#error').modal('show');
                        }
                        else
                        {
                            $('#modifydata').modal('show');
                        }
                    }
                });

            }

            // prescription update
            function checkpresupdate(apno){

                $('.chngapno').val(apno);
                $.ajax({
                url: '/checkpresupdate',
                type: 'post',
                data: 'apno=' + apno + '&_token={{ csrf_token() }}',
                success: function(res) {
                        if(res){
                            $('#chngprescribe').append(res);
                            $('#changeprescription').modal('show');
                        }
                        else
                        {
                            $('#error').modal('show');
                        }
                    }
                    // $('#newdata').html(' ');
                });
            }

            // for load all medicine name
             $(document).ready(function() {

                $.ajax({
                url: '/getmedicine',
                type: 'get',
                success: function(res) {
                    $('#medcnid').html(res);
                    $('#chngmedid').html(res);

                }
            });


            $("#add").click(function () {

            var mid = document.getElementById("medcnid");
            var mno = mid.options[mid.selectedIndex].value;
            var mname=mid.options[mid.selectedIndex].text;

            var d1 = document.getElementById("mrng");
            var mrng = d1.options[d1.selectedIndex].value;

            var d2 = document.getElementById("afrn");
            var afrn = d2.options[d2.selectedIndex].value;

            var d3 = document.getElementById("evng");
            var evng = d3.options[d3.selectedIndex].value;

            var d4 = document.getElementById("nght");
            var nght = d4.options[d4.selectedIndex].value;

            var remark = document.getElementById("remark").value;

            var html='<tr><td><input type="text" name="mid[]" value="'+mname+'" disabled><input type="hidden" name="mid[]" value="'+mno+'"></td><td><input type="text" name="mrng[]" value="'+mrng+'" disabled><input type="hidden" name="mrng[]" value="'+mrng+'"></td><td><input type="text" name="afrn[]" value="'+afrn+'" disabled><input type="hidden" name="afrn[]" value="'+afrn+'"></td><td><input type="text" name="evng[]" value="'+evng+'" disabled><input type="hidden" name="evng[]" value="'+evng+'"></td><td><input type="text" name="nght[]" value="'+nght+'" disabled><input type="hidden" name="nght[]" value="'+nght+'"></td><td><input type="text" name="remark[]" value="'+remark+'" disabled><input type="hidden" name="remark[]" value="'+remark+'"></td><td><button type="button" id="remove" style="color:red;text-color:white;">Cancel</button></td></tr>';
            $("#prescribe").append(html);
            });

            $("#prescribe").on('click', '#remove', function () {
            $(this).closest('tr').remove();
            });
        });



            function getday(day) {
                var tdate = new Date();
        var today = new Date().toJSON().slice(0, 10);
        var a = new Date(day).toJSON().slice(0, 10);
        var b = new Date(day)
        if (a >=today) {
            var days = new Array(7);
            days[0] = "Sunday";
            days[1] = "Monday";
            days[2] = "Tuesday";
            days[3] = "Wednesday";
            days[4] = "Thursday";
            days[5] = "Friday";
            days[6] = "Saturday";
            var r = days[b.getDay()];
            if (r == "Sunday") {
                disable();
            } else if (r != "Sunday") {
                enable();
            } else {
                return;
            }

            tdate.setDate(tdate.getDate()+30);

            if(b > tdate)
            {
                alert("You can't book advance appoinment more then 30 days..!!");
                $('input[type=date]').val('');
            }
        }
        else
         {
            alert("Please Select date greter than todays date..!!");
            $('input[type=date]').val('');

        }
    }

    function disable() {
        var a, i, options;
        a = document.getElementById("aptime");
        for (i = 4; i <= a.length - 1; i++) {
            a.options[i].disabled = true;
        }

    }

    function enable() {
        var a, i, options;
        a = document.getElementById("aptime");
        for (i = 4; i <= a.length - 1; i++) {
            a.options[i].disabled = false;
        }

    }


    function timeslot(){
        var a = $('input[type=date]').val();
        var b=$('.mytime').val();
        if(a=='')
        {
            alert('please Choose Date..!!');
            $('.mytime').val('');
        }
        else
        {
            $.ajax({
            url: '/checkforpasttime',
            type: 'post',
            data: {date: a,time: b, _token: '{{csrf_token()}}' },
            success: function(res) {
                if(res=='true')
                {
                    $.ajax({
                            url: '/checkslot',
                            type: 'post',
                            data: {date: a, _token: '{{csrf_token()}}' },
                            success: function(res) {
                                if(res=='true')
                                {
                                    $('#smsg').html('<p style="color:green;">Slot Is Available..!!</p>');
                                }
                                else
                                {
                                    $('#smsg').html('<p style="color:red;">Slot is Full Choose another slot..!!</p>');
                                    $('.mytime').val('');
                                }
                            }
                        });
                }
                else
                {
                    $('#smsg').html('<p style="color:red;">Time Is Passed..!!</p>');
                    $('.mytime').val('');
                }
            }
        });



      }

    }


</script>
@endsection
