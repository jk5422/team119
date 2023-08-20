@extends('backend.layouts.main')

@section('doctor-container')



    <div class="container-xxl pt-4 ">

        <div class="container p-0">

            <div class="main">

                <div class="container-inq">
                    <div class="title">
                        <h2>All Payment Details</h2>
                    </div>

                    <div class="d-flex">
                        <div class="row header" style="text-align: center;">
                            <table id="example" class="table table-striped table-bordered"
                                style="border: 1px solid #dadada;">
                                <thead>
                                    <tr>
                                        <th>PayNo</th>
                                        <th>Payment ID</th>
                                        <th>Payment Mode</th>
                                        <th>Appoinment No</th>
                                        <th>Patient Name</th>
                                        <th>Payment Date</th>
                                    </tr>
                                </thead>
                        </div>
                        <tbody>
                            @foreach ($data as $item)
                                <tr>
                                    <td>{{ $item->payid }}</td>
                                    @if ($item->paymentid=="")
                                        <td>Cash On Counter</td>
                                    @else
                                    <td>{{ $item->paymentid }}</td>
                                    @endif
                                    <td>{{ $item->paymode }}</td>
                                    <td>{{ $item->app_apno }}</td>
                                    <td>{{ $item->pname }}</td>
                                    <td>{{date('d-m-Y H:i:s a', strtotime( $item->created_at)) }}</td>
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
