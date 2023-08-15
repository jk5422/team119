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



    <div class="container-xxl pt-4 ">

        <div class="container p-0">

            <div class="empadd">
                <fieldset class="form-control" style="background-color:aliceblue;">
                    <legend>Action Tab</legend>

                    <span class="btn btn-warning"><i class="fas fa-arrow-alt-circle-up"></i><a href="/doctor/pendappoinments" class="text-dark ms-2" >Pending Appoinments</a>
                </span>

                    {{-- <span class="btn btn-info"><i class="fas fa-notes-medical"></i><a href="" class="text-dark ms-2" data-bs-toggle="modal"
                            data-bs-target="#addclinic">Add Prescription</a>
                    </span> --}}


                </fieldset>
            </div>


            <div class="main">

                <div class="container-inq">
                    <div class="title">
                        <h2>All Visited Appoinements</h2>
                    </div>

                    <div class="d-flex">
                        <div class="row header" style="text-align: center;">
                            <table id="example" class="table table-striped table-bordered"
                                style="border: 1px solid #dadada;">
                                <thead>
                                    <tr>
                                        <th>Appoinment No</th>
                                        <th>Patient Name</th>
                                        <th>Appoinment Date</th>
                                        <th>Appoinment Status</th>
                                        <th>Payment Mode</th>
                                        <th>Associated Clinic</th>
                                        <th>Appoinment</th>
                                        <th>Prescription</th>
                                        <th>Cancellation</th>
                                    </tr>
                                </thead>
                        </div>
                        <tbody>
                                @foreach ($data as $item)
                                    <tr>
                                        <td>{{$item->apno}}</td>
                                        <td>{{$item->pname}}</td>
                                        <td>{{date('d-m-Y', strtotime($item->apdate))}}</td>

                                        @if ($item->apstatus=='0')
                                            <td class="text-danger">Cancelled</td>
                                        @elseif ($item->apstatus=='1')
                                            <td class="text-success">Visited</td>
                                        @elseif ($item->apstatus=='2')
                                            <td class="text-primary">Request For Cancellation</td>
                                        @endif
                                        <td>{{$item->paymode}}</td>
                                        <td>{{$item->cname}}</td>
                                        <td><a href="" type="button" class="btn btn-warning" onclick=" window.open('allappoinments/pdf/{{$item->apno}}', '_blank', 'width=800, height=500');">A-View</a></td>

                                        @if ($item->apstatus=='1')
                                        <td><a href="" type="button" class="btn btn-warning" onclick=" window.open('prescription/pdf/{{$item->apno}}', '_blank', 'width=800, height=500');">P-View</a></td>
                                         @else
                                         <td>N/A</td>
                                         @endif

                                         @if ($item->apstatus=='2')
                                         <td><button type="button" class="btn btn-danger" value="{{$item->apno}}" onclick="setapno(this.value);" data-bs-toggle="modal" data-bs-target="#confirm">Cancellation</button></td>
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
                        <h5 class="modal-title" id="exampleModalLabel">Cancel Appoinment</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <form action="{{ url('pendappoinments/uapstatus') }}" method="POST">
                            @csrf
                            <div class="row h-100 align-items-center justify-content-center">
                                <div class="col-12 col-sm-12 col-md-12 col-lg-12 col-xl-12">
                                    <input type="hidden" class="uhapno" name="upapno" value="">
                                    <div class="form-floating mb-3">
                                        <input type="text" class="form-control uapno" name="upapno" disabled>
                                        <label>Appoinment No</label>
                                    </div>
                                </div>
                            </div>
                            <div class="row h-100 align-items-center justify-content-center">
                                <div class="col-12 col-sm-12 col-md-12 col-lg-12 col-xl-12">
                                    <div class="mb-3">
                                        <fieldset class="form-control gender bg-white">
                                            <legend style="font-size: 15px;">Select Status</legend>
                                            <input type="radio" class="" name="upast" id="pending"
                                            value="0">
                                        <label for="cancel">Cancel</label>
                                        </fieldset>
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

        <script>
            function setapno(apno){
                $('.uhapno').val(apno);
                $('.uapno').val(apno);
            }
        </script>
@endsection
