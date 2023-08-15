@extends('backend.layouts.main')

@section('doctor-container')
    @if (session('ctrue'))
        <div class="alert alert-success fade in" id="alert">
            <a href="#" class="close" data-dismiss="alert" aria-label="close"></a>
            <strong>Success!</strong> {{ session('ctrue') }}
        </div>
        {{ Session::forget('ctrue') }}
    @endif


    @if (session('cfalse'))
        <div class="alert alert-danger fade in" id="alert">
            <a href="#" class="close" data-dismiss="alert" aria-label="close"></a>
            <strong>Error!</strong> {{ session('cfalse') }}
        </div>
        {{ Session::forget('cfalse') }}
    @endif


    <div class="container-xxl pt-4 ">

        <div class="container p-0">

            <div class="empadd">
                <fieldset class="form-control" style="background-color:aliceblue;">
                    <legend>Action Tab</legend>

                    <span class="btn btn-success"><i class='fas fa-clinic-medical'></i><a href="" class="text-white ms-2" data-bs-toggle="modal"
                            data-bs-target="#addclinic">Add Clinic</a>
                    </span>

                    <span class="btn btn-warning"><i class='fas fa-pen-square'></i><a href="" class="text-dark ms-2" data-bs-toggle="modal"
                            data-bs-target="#updateclinic">Update Clinic</a>
                    </span>

                    <span class="btn btn-danger"><i class='fas fa-trash'></i>
                        <a href="" class="text-dark ms-2" data-bs-toggle="modal" data-bs-target="#deleteclinic">Delete
                            Clinic</a>
                    </span>
                </fieldset>
            </div>


            <div class="main">

                <div class="container-inq">
                    <div class="title">
                        <h2>All Clinics</h2>
                    </div>

                    <div class="d-flex">
                        <div class="row header" style="text-align: center;">
                            <table id="example" class="table table-striped table-bordered"
                                style="border: 1px solid #dadada;">
                                <thead>
                                    <tr>
                                        <th>Clinic Id</th>
                                        <th>Clinic Name</th>
                                        <th>Clinic Email</th>
                                        <th>Clinic Mobile</th>
                                        <th>Clinic Address</th>
                                    </tr>
                                </thead>
                        </div>
                        <tbody>
                            @foreach ($data as $item)
                                <tr>
                                    <td>{{ $item->cid }}</td>
                                    <td>{{ $item->cname }}</td>
                                    <td>{{ $item->cemail }}</td>
                                    <td>{{ $item->cmobile }}</td>
                                    <td>{{ $item->caddress }}</td>
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


        {{-- update clinic Modal  --}}
        <div class="modal fade" id="updateclinic" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Update Clinic Details</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <form action="{{ url('allclinics/cupdate') }}" method="POST" id="updatecli">
                            @csrf
                            <div class="row h-100 align-items-center justify-content-center">
                                <div class="col-12 col-sm-12 col-md-12 col-lg-12 col-xl-12">
                                    <div class="form-floating mb-3">
                                        <select name="cid" id="nclnc" class="form-control bg-white"
                                            onchange="getclinicdata(this.value)" required data-parsley-required-message="Please select clinic name">
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="row h-100 align-items-center justify-content-center">
                                <div class="col-12 col-sm-6 col-md-6 col-lg-6 col-xl-6">
                                    <div class="form-floating mb-3">
                                        <input type="text" class="form-control cname" name="cname" placeholder="Clinic Name">
                                        <label>Clinic Name</label>
                                    </div>
                                </div>
                                <div class="col-12 col-sm-6 col-md-6 col-lg-6 col-xl-6">
                                    <div class="form-floating mb-3">
                                        <input type="email" class="form-control cemail" name="cemail"
                                            placeholder="Clinic Email">
                                        <label>Clinic Email</label>
                                    </div>
                                </div>
                            </div>
                            <div class="row h-100 align-items-center">
                                <div class="col-12 col-sm-6 col-md-6 col-lg-6 col-xl-6">
                                    <div class="form-floating mb-3">
                                        <input type="tel" class="form-control cmobile" name="cmobile" maxlength="10"
                                            placeholder="Clinic Mobile">
                                        <label>Clinic Mobile</label>
                                    </div>
                                </div>
                                <div class="col-12 col-sm-6 col-md-6 col-lg-6 col-xl-6">
                                    <div class="form-floating mb-3">
                                       <textarea class="form-control caddress" name="caddress" cols="30" rows="3"></textarea>
                                        <label>Clinic Address</label>
                                    </div>
                                </div>
                            </div>

                            <div class="row h-100 align-items-center">
                            <div class="col-12 col-sm-12 col-md-12 col-lg-12 col-xl-12">
                                <button type="submit" class="btn btn-primary py-3 w-50 mb-4">Save Changes</button>
                            </div>
                            </div>
                        </form>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    </div>
                </div>
            </div>
        </div>
        </div>

    {{-- add clinic modal --}}

    <div class="modal fade" id="addclinic" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Add New Clinic</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="{{ url('allclinic/cadd') }}" method="POST" id="addcli">
                        @csrf
                        <div class="row h-100 align-items-center justify-content-center">
                            <div class="col-12 col-sm-6 col-md-6 col-lg-6 col-xl-6">
                                <div class="form-floating mb-3">
                                    <input type="text" class="form-control" name="cname" placeholder="Clinic Name" required data-parsley-required-message="Please enter clinic name" data-parsley-pattern="^([a-zA-Z&-]+\s)*[a-zA-Z]+$" data-parsley-pattern-message="please enter only characters" data-parsley-minlength="3" data-parsley-minlength-message="Name should be minimum 3 character" >
                                    <label>Clinic Name</label>
                                </div>
                            </div>
                            <div class="col-12 col-sm-6 col-md-6 col-lg-6 col-xl-6">
                                <div class="form-floating mb-3">
                                    <input type="email" class="form-control" name="cemail"
                                        placeholder="Clinic Email" required data-parsley-required-message="Please enter email address" data-parsley-type="email" data-parsley-type-message="Please enter valid email address "  data-parsley-trigger="keyup">
                                    <label>Clinic Email</label>
                                </div>
                            </div>
                        </div>
                        <div class="row h-100 align-items-center">
                            <div class="col-12 col-sm-6 col-md-6 col-lg-6 col-xl-6">
                                <div class="form-floating mb-3">
                                    <input type="tel" class="form-control" name="cmobile" maxlength="10"
                                        placeholder="Clinic Mobile" required data-parsley-required-message="Please enter mobile number" data-parsley-type="number" data-parsley-type-message="Please enter valid mobile number"  data-parsley-pattern="^[1-9]{1}[0-9]{9}$" data-parsley-pattern-message="Please enter valid mobile number" data-parsley-maxlength="10" data-parsley-maxlength-message="Mobile number should be exactly 10 digit" data-parsley-minlength="10" data-parsley-minlength-message="Mobile number should be exactly 10 digit" data-parsley-trigger="keyup">
                                    <label>Clinic Mobile</label>
                                </div>
                            </div>
                            <div class="col-12 col-sm-6 col-md-6 col-lg-6 col-xl-6">
                                <div class="form-floating mb-3">
                                   <textarea class="form-control" name="caddress" cols="30" rows="3" required data-parsley-required-message="Please enter address" data-parsley-minlength="15" data-parsley-minlength-message="Address should be minimum 15 character"  data-parsley-trigger="keyup"></textarea>
                                    <label>Clinic Address</label>
                                </div>
                            </div>
                        </div>

                        <div class="col-12 col-sm-6 col-md-6 col-lg-6 col-xl-6">
                            <button type="submit" class="btn btn-primary py-3 w-50 mb-4">Add Clinic</button>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>
    </div>

    {{-- delete doctor modal --}}
   <div class="modal fade" id="deleteclinic" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Delete Clinic</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <form action="{{ url('allclinics/delclinic') }}" method="POST" id="dclinic">
                            @csrf
                            <div class="row h-100 align-items-center justify-content-center">
                                <div class="col-12 col-sm-12 col-md-12 col-lg-12 col-xl-12">
                                    <div class="form-floating mb-3">
                                        <select name="cid" id="dclnc" class="form-control bg-white"
                                            onchange="getclinicdata(this.value)" required data-parsley-required-message="Please select clinic name">
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="row h-100 align-items-center justify-content-center">
                                <div class="col-12 col-sm-12 col-md-12 col-lg-12 col-xl-12">
                                    <div class="form-floating mb-3">
                                        <input type="text" class="form-control cname" name="cname" placeholder="Clinic Name" disabled>
                                        <label>Clinic Name</label>
                                    </div>
                                </div>
                            </div>
                            <div class="row h-100 align-items-center">
                            <div class="col-12 col-sm-12 col-md-12 col-lg-12 col-xl-12">
                                <button type="submit" class="btn btn-primary py-3 w-50 mb-4">Delete</button>
                            </div>
                            </div>
                        </form>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    </div>
                </div>
            </div>
        </div>
        </div>





    <script>
        $(document).ready(function() {
            $.ajax({
                url: '/getclinic',
                type: 'get',
                success: function(res) {
                    $('#nclnc').html(res);
                }
            });

            $.ajax({
                url: '/getclinic',
                type: 'get',
                success: function(res) {
                    $('#dclnc').html(res);
                }
            });
        });




        function getclinicdata(cid) {
            $.ajax({
                url: '/getclinicdetails',
                type: 'post',
                data: 'cid=' + cid + '&_token={{ csrf_token() }}',
                success: function(res) {
                    if (res) {
                        // alert(res['data']['dname']);
                        $('.cname').val(res['data']['cname']);
                        $('.cemail').val(res['data']['cemail']);
                        $('.cmobile').val(res['data']['cmobile']);
                        $('.caddress').val(res['data']['caddress']);

                    }
                }
            });
        }
    </script>
@endsection
