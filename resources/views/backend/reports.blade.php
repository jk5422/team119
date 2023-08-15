@extends('backend.layouts.main')

@section('doctor-container')
@if (session('rtrue'))
<div class="alert alert-success fade in" id="alert">
    <a href="#" class="close" data-dismiss="alert" aria-label="close"></a>
    <strong>Success!</strong> {{ session('rtrue') }}
</div>
{{ Session::forget('rtrue') }}
@endif


@if (session('rfalse'))
<div class="alert alert-danger fade in" id="alert">
    <a href="#" class="close" data-dismiss="alert" aria-label="close"></a>
    <strong>Error!</strong> {{ session('rfalse') }}
</div>
{{ Session::forget('rfalse') }}
@endif
            <!-- Form Start -->
            <div class="container-fluid pt-4 px-4">
                <div class="row g-4">
                    <div class="col-sm-12 col-xl-6">
                        <div class="bg-light rounded h-100 p-4">
                            <h6 class="mb-4">Appoinment Reports By Date</h6>
                            <form action="{{url('/doctor/Allreports/appreport')}}" method="POST">
                                @csrf
                                <div class="mb-3">
                                    <label for="exampleInputEmail1" class="form-label">FROM</label>
                                    <input type="date" name="fdate" class="form-control" id="exampleInputEmail1"
                                        aria-describedby="emailHelp">
                                </div>
                                <div class="mb-3">
                                    <label for="exampleInputPassword1" class="form-label">TO</label>
                                    <input type="date" name="tdate" class="form-control" id="exampleInputPassword1">
                                </div>
                                <button type="submit" class="btn btn-primary">Generate</button>
                            </form>
                        </div>
                    </div>

                    <div class="col-sm-12 col-xl-6">
                        <div class="bg-light rounded h-100 p-4">
                            <h6 class="mb-4">Appoinment Reports By Doctors</h6>
                            <form action="{{url('/doctor/Allreports/appdoc')}}" method="POST">
                                @csrf
                                <div class="mb-3">
                                    <label for="exampleInputEmail1" class="form-label">Select Doctor Name</label>
                                    <select name="did" class="form-control did">
                                    </select>
                                </div>
                                <button type="submit" class="btn btn-primary">Generate</button>
                            </form>
                        </div>
                    </div>

                    <div class="col-sm-12 col-xl-12">
                        <div class="bg-light rounded h-100 p-4">
                            <h6 class="mb-4">Payments Report</h6>
                            <form action="{{url('/doctor/Allreports/payment')}}" method="POST">
                                @csrf
                                <div class="mb-3">
                                    <div class="mb-3">
                                        <label for="exampleInputEmail1" class="form-label">FROM</label>
                                        <input type="date" name="pfdt" class="form-control" id="exampleInputEmail1"
                                            aria-describedby="emailHelp">
                                    </div>
                                    <div class="mb-3">
                                        <label for="exampleInputPassword1" class="form-label">TO</label>
                                        <input type="date" name="ptdt" class="form-control" id="exampleInputPassword1">
                                    </div>
                                </div>
                                <button type="submit" class="btn btn-primary">Generate</button>
                            </form>
                        </div>
                    </div>

                </div>
            </div>
            <!-- Form End -->




        <script>
            $(document).ready(function() {
            $.ajax({
                url: '/getdoctor',
                type: 'get',
                success: function(res) {
                    $('.did').html(res);
                }
            });
        });
        </script>

@endsection
