@extends('backend.layouts.main')

@section('doctor-container')
    @if (session('strue'))
        <div class="alert alert-success fade in" id="alert">
            <a href="#" class="close" data-dismiss="alert" aria-label="close"></a>
            <strong>Success!</strong> {{ session('strue') }}
        </div>
        {{ Session::forget('strue') }}
    @endif


    @if (session('sfalse'))
        <div class="alert alert-danger fade in" id="alert">
            <a href="#" class="close" data-dismiss="alert" aria-label="close"></a>
            <strong>Error!</strong> {{ session('sfalse') }}
        </div>
        {{ Session::forget('sfalse') }}
    @endif

    <div class="container-xxl pt-4 ">

        <div class="container p-0">

            <div class="empadd">
                <fieldset class="form-control" style="background-color: aliceblue;">
                    <legend>Action Tab</legend>

                    <span class="btn btn-success"><i class='fas fa-pills'></i><a href="" class="text-white ms-2" data-bs-toggle="modal"
                            data-bs-target="#addservice">Add Service</a>
                    </span>

                    <span class="btn btn-warning"><i class='fas fa-pen-square'></i><a href="" class="text-dark ms-2" data-bs-toggle="modal"
                            data-bs-target="#updateservice">Update Service</a>
                    </span>

                    <span class="btn btn-danger"><i class='fas fa-tablets'></i>
                        <a href="" class="text-dark ms-2" data-bs-toggle="modal" data-bs-target="#deleteservice">Delete
                            Service</a>
                    </span>


                </fieldset>
            </div>


            <div class="main">

                <div class="container-inq">
                    <div class="title">
                        <h2>All Services</h2>
                    </div>

                    <div class="d-flex">
                        <div class="row header" style="text-align: center;">
                            <table id="example" class="table table-striped table-bordered"
                                style="border: 1px solid #dadada;">
                                <thead>
                                    <tr>
                                        <th>Service.Id</th>
                                        <th>Service Name</th>
                                        <th>Med.Added By</th>
                                        <th>Associated Clinic</th>
                                    </tr>
                                </thead>
                        </div>
                        <tbody>
                            @foreach ($data as $item)
                                <tr>
                                    <td>{{ $item->sid }}</td>
                                    <td>{{ $item->sname }}</td>
                                    <td>{{ $item->dname }}({{$item->dqualification}})</td>
                                    <td>{{ $item->cname }}</td>
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
        <div class="modal fade" id="updateservice" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Update Services Details</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <form action="{{ url('allservices/supdate') }}" method="POST" id="updateser">
                            @csrf
                            <div class="row h-100 align-items-center justify-content-center">
                                <div class="col-12 col-sm-12 col-md-12 col-lg-12 col-xl-12">
                                    <div class="form-floating mb-3">
                                        <select name="usid" id="usid" class="form-control bg-white"
                                            onchange="getservices(this.value)" required data-parsley-required-message="Please select service name">
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="row h-100 align-items-center justify-content-center">
                                <div class="col-12 col-sm-12 col-md-12 col-lg-12 col-xl-12">
                                    <div class="form-floating mb-3">
                                        <input type="text" class="form-control srname" name="usrnm" placeholder="Service Name">
                                        <label>Service Name</label>
                                    </div>
                                </div>
                            </div>
                            <div class="row h-100 align-items-center justify-content-center">
                                <div class="col-12 col-sm-12 col-md-12 col-lg-12 col-xl-12">
                                    <div class="form-floating mb-3">
                                        <select name="usrdr" id="usrdr" class="form-control srdrnm">

                                        </select>
                                        <label>Service Added By</label>
                                    </div>
                                </div>
                            </div>

                            <div class="row h-100 align-items-center justify-content-center">
                                <div class="col-12 col-sm-12 col-md-12 col-lg-12 col-xl-12">
                                    <div class="form-floating mb-3">
                                        <select name="usrcl" id="usrcl" class="form-control srcln">

                                        </select>
                                        <label>Associated Clinic</label>
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

    <div class="modal fade" id="addservice" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Add New Service</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="{{ url('allservices/sadd') }}" method="POST" id="addnservice">
                        @csrf
                        <div class="row h-100 align-items-center justify-content-center">
                            <div class="col-12 col-sm-12 col-md-12 col-lg-12 col-xl-12">
                                <div class="form-floating mb-3">
                                    <input type="text" class="form-control" name="sname" placeholder="Service Name" required data-parsley-required-message="Please enter  service name" data-parsley-pattern="^([a-zA-Z]+\s)*[a-zA-Z]+$" data-parsley-pattern-message="please enter only characters" data-parsley-minlength="3" data-parsley-minlength-message="Name should be minimum 3 character" data-parsley-trigger="keyup">
                                    <label>Service Name</label>
                                </div>
                            </div>
                        </div>
                        <div class="row h-100 align-items-center justify-content-center">
                            <div class="col-12 col-sm-12 col-md-12 col-lg-12 col-xl-12">
                                <div class="form-floating mb-3">
                                    <select name="sadddr" id="sadddr" class="form-control" onchange="assoclinic(this.value)" required data-parsley-required-message="Please select doctor name">

                                    </select>
                                    <label>Service Add By</label>
                                </div>
                            </div>
                        </div>

                        <div class="row h-100 align-items-center justify-content-center">
                            <div class="col-12 col-sm-12 col-md-12 col-lg-12 col-xl-12">
                                <div class="form-floating mb-3">
                                    <select name="sadclnc" id="sadclnc" class="form-control">

                                    </select>
                                    <label>Associated Clinic</label>
                                </div>
                            </div>
                        </div>


                        <div class="col-12 col-sm-12 col-md-12 col-lg-12 col-xl-12">
                            <button type="submit" class="btn btn-primary py-3 w-50 mb-4">Add Service</button>
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
   <div class="modal fade" id="deleteservice" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Delete Medicine</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <form action="{{ url('allservices/sdel') }}" method="POST" id="dservice">
                            @csrf
                            <div class="row h-100 align-items-center justify-content-center">
                                <div class="col-12 col-sm-12 col-md-12 col-lg-12 col-xl-12">
                                    <div class="form-floating mb-3">
                                        <select name="dsrid" id="dsrid" class="form-control bg-white"
                                            onchange="getservices(this.value)"required data-parsley-required-message="Please select service name">
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="row h-100 align-items-center justify-content-center">
                                <div class="col-12 col-sm-12 col-md-12 col-lg-12 col-xl-12">
                                    <div class="form-floating mb-3">
                                        <input type="text" class="form-control srname" name="dmedname" placeholder="service Name" disabled>
                                        <label>Service Name</label>
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
                    $('#usrcl').html(res);
                }
            });

            $.ajax({
                url: '/getdoctor',
                type: 'get',
                success: function(res) {
                    $('#usrdr').html(res);
                }
            });


            $.ajax({
                url: '/getdoctor',
                type: 'get',
                success: function(res) {
                    $('#sadddr').html(res);
                }
            });

            $.ajax({
                url: '/getservices',
                type: 'get',
                success: function(res) {
                    $('#usid').html(res);
                }
            });

            $.ajax({
                url: '/getservices',
                type: 'get',
                success: function(res) {
                    $('#dsrid').html(res);
                }
            });

        });




        function assoclinic(did){
            $.ajax({
                url: '/getassoclinic',
                type: 'post',
                data: 'did=' + did + '&_token={{ csrf_token() }}',
                success: function(res) {
                    if (res) {
                        $('#sadclnc').html(res);
                    }
                }
            });
        }

        function getservices(sid) {
            $.ajax({
                url: '/getservicelistdetail',
                type: 'post',
                data: 'sid=' + sid + '&_token={{ csrf_token() }}',
                success: function(res) {
                    if (res) {
                        $('.srname').val(res['data'][0]['sname']);
                        $('.srdrnm').val(res['data'][0]['dname']).prop('selectedIndex', res['data'][0]['did']);
                        $('.srcln').val(res['data'][0]['cname']).prop('selectedIndex', res['data'][0]['cid']);
                    }
                }
            });
        }
    </script>
@endsection
