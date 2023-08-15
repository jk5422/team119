@extends('backend.layouts.main')

@section('doctor-container')


    <div class="container-xxl pt-4 ">

        <div class="container p-0">

            <div class="main">

                <div class="container-inq">
                    <div class="title">
                        <h2>All Patients Details</h2>
                    </div>

                    <div class="d-flex">
                        <div class="row header" style="text-align: center;">
                            <table id="example" class="table table-striped table-bordered"
                                style="border: 1px solid #dadada;">
                                <thead>
                                    <tr>
                                        <th>PId</th>
                                        <th>Patient Name</th>
                                        <th>Patient Age</th>
                                        <th>Patient Gender</th>
                                        <th>Patient Mobile</th>
                                        <th>Patient Email</th>
                                        <th>Patient Address</th>
                                    </tr>
                                </thead>
                        </div>
                        <tbody>
                            @foreach ($data as $item)
                                <tr>
                                    <td>{{ $item->pid }}</td>
                                    <td>{{ $item->pname }}</td>
                                    <td>{{ $item->page }}</td>
                                    <td>{{ $item->pgender }}</td>
                                    <td>{{ $item->pmobile }}</td>
                                    <td>{{ $item->pemail }}</td>
                                    <td>{{ $item->paddress }}</td>
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

@endsection
