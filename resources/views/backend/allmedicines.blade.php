@extends('backend.layouts.main')

@section('doctor-container')
    @if (session('mtrue'))
        <div class="alert alert-success fade in" id="alert">
            <a href="#" class="close" data-dismiss="alert" aria-label="close"></a>
            <strong>Success!</strong> {{ session('mtrue') }}
        </div>
        {{ Session::forget('mtrue') }}
    @endif


    @if (session('mfalse'))
        <div class="alert alert-danger fade in" id="alert">
            <a href="#" class="close" data-dismiss="alert" aria-label="close"></a>
            <strong>Error!</strong> {{ session('mfalse') }}
        </div>
        {{ Session::forget('mfalse') }}
    @endif


    <div class="container-xxl pt-4 ">

        <div class="container p-0">

            <div class="empadd">
                <fieldset class="form-control" style="background-color: aliceblue;">
                    <legend>Action Tab</legend>

                    <span class="btn btn-success"><i class='fas fa-pills'></i><a href="" class="text-white ms-2" data-bs-toggle="modal"
                            data-bs-target="#addmedcine">Add Medicines</a>
                    </span>

                    <span class="btn btn-warning"><i class='fas fa-pen-square'></i><a href="" class="text-dark ms-2" data-bs-toggle="modal"
                            data-bs-target="#updatemedcine">Update Medicines</a>
                    </span>

                    <span class="btn btn-danger"><i class='fas fa-tablets'></i>
                        <a href="" class="text-dark ms-2" data-bs-toggle="modal" data-bs-target="#deletemedcine">Delete
                            Medicines</a>
                    </span>


                </fieldset>
            </div>


            <div class="main">

                <div class="container-inq">
                    <div class="title">
                        <h2>All Medicines</h2>
                    </div>

                    <div class="d-flex">
                        <div class="row header" style="text-align: center;">
                            <table id="example" class="table table-striped table-bordered"
                                style="border: 1px solid #dadada;">
                                <thead>
                                    <tr>
                                        <th>Med.Id</th>
                                        <th>Medcine Name</th>
                                        <th>Med.Added By</th>
                                    </tr>
                                </thead>
                        </div>
                        <tbody>
                            @foreach ($data as $item)
                                <tr>
                                    <td>{{ $item->medicineid }}</td>
                                    <td>{{ $item->medicinename }}</td>
                                    <td>{{ $item->dname }}({{$item->dqualification}})</td>
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
        <div class="modal fade" id="updatemedcine" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Update Medicine Details</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <form action="{{ url('allmedicines/mupdate') }}" method="POST" id="updatemed">
                            @csrf
                            <div class="row h-100 align-items-center justify-content-center">
                                <div class="col-12 col-sm-12 col-md-12 col-lg-12 col-xl-12">
                                    <div class="form-floating mb-3">
                                        <select name="umedid" id="umedid" class="form-control bg-white"
                                            onchange="getmedicinedata(this.value)" required data-parsley-required-message="Please select medicine name">
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="row h-100 align-items-center justify-content-center">
                                <div class="col-12 col-sm-12 col-md-12 col-lg-12 col-xl-12">
                                    <div class="form-floating mb-3">
                                        <input type="text" class="form-control mdname" name="umedname" placeholder="Clinic Name">
                                        <label>Medicine Name</label>
                                    </div>
                                </div>
                            </div>
                            <div class="row h-100 align-items-center justify-content-center">
                                <div class="col-12 col-sm-12 col-md-12 col-lg-12 col-xl-12">
                                    <div class="form-floating mb-3">
                                        <select name="umedaddr" id="umedaddr" class="form-control mddrnm">

                                        </select>
                                        <label>Medicine Added By</label>
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

    <div class="modal fade" id="addmedcine" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Add New Medicine</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="{{ url('allmedicines/madd') }}" method="POST" id="addmed">
                        @csrf
                        <div class="row h-100 align-items-center justify-content-center">
                            <div class="col-12 col-sm-12 col-md-12 col-lg-12 col-xl-12">
                                <div class="form-floating mb-3">
                                    <input type="text" class="form-control" name="medname" placeholder="Medicine Name" required data-parsley-required-message="Please enter medicine name" data-parsley-pattern="^([a-zA-Z0-9]+\s)*[a-zA-Z0-9]+$" data-parsley-pattern-message="please enter only characters" data-parsley-minlength="3" data-parsley-minlength-message="Name should be minimum 3 character" data-parsley-trigger="keyup">
                                    <label>Medicine Name</label>
                                </div>
                            </div>
                        </div>
                        <div class="row h-100 align-items-center justify-content-center">
                            <div class="col-12 col-sm-12 col-md-12 col-lg-12 col-xl-12">
                                <div class="form-floating mb-3">
                                    <select name="medaddr" id="medaddr" class="form-control" required data-parsley-required-message="Please select doctor name">

                                    </select>
                                    <label>Medicine Added By</label>
                                </div>
                            </div>
                        </div>


                        <div class="col-12 col-sm-12 col-md-12 col-lg-12 col-xl-12">
                            <button type="submit" class="btn btn-primary py-3 w-50 mb-4">Add Medicine</button>
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
   <div class="modal fade" id="deletemedcine" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Delete Medicine</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <form action="{{ url('allmedicines/mdel') }}" method="POST" id="dmedicine">
                            @csrf
                            <div class="row h-100 align-items-center justify-content-center">
                                <div class="col-12 col-sm-12 col-md-12 col-lg-12 col-xl-12">
                                    <div class="form-floating mb-3">
                                        <select name="dmedid" id="dmedid" class="form-control bg-white"
                                            onchange="getmedicinedata(this.value)"required data-parsley-required-message="Please select medicine name">
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="row h-100 align-items-center justify-content-center">
                                <div class="col-12 col-sm-12 col-md-12 col-lg-12 col-xl-12">
                                    <div class="form-floating mb-3">
                                        <input type="text" class="form-control mdname" name="dmedname" placeholder="Clinic Name" disabled>
                                        <label>Medicine Name</label>
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
                url: '/getdoctor',
                type: 'get',
                success: function(res) {
                    $('#medaddr').html(res);
                }
            });

            $.ajax({
                url: '/getdoctor',
                type: 'get',
                success: function(res) {
                    $('#umedaddr').html(res);
                }
            });

            $.ajax({
                url: '/getmedicine',
                type: 'get',
                success: function(res) {
                    $('#umedid').html(res);
                }
            });
            $.ajax({
                url: '/getmedicine',
                type: 'get',
                success: function(res) {
                    $('#dmedid').html(res);
                }
            });

        });




        function getmedicinedata(mid) {
            $.ajax({
                url: '/getmedicinedetails',
                type: 'post',
                data: 'mid=' + mid + '&_token={{ csrf_token() }}',
                success: function(res) {
                    if (res) {
                        $('.mdname').val(res['data'][0]['medicinename']);
                        $('.mddrnm').val(res['data'][0]['dname']).prop('selectedIndex', res['data'][0]['did']);
                    }
                }
            });
        }
    </script>
@endsection
