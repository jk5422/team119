@extends('backend.layouts.main')

@section('doctor-container')


@if (session('cntrue'))
<div class="alert alert-success fade in" id="alert">
    <a href="#" class="close" data-dismiss="alert" aria-label="close"></a>
    <strong>Success!</strong> {{ session('cntrue') }}
</div>
{{ Session::forget('cntrue') }}
@endif


@if (session('cnfalse'))
<div class="alert alert-danger fade in" id="alert">
    <a href="#" class="close" data-dismiss="alert" aria-label="close"></a>
    <strong>Error!</strong> {{ session('cnfalse') }}
</div>
{{ Session::forget('cnfalse') }}
@endif


    <!-- register doctor Start -->
    <div class="container-xxl pt-4 ">

        <div class="container p-0">
            <div class="empadd">
                <fieldset class="form-control" style="background-color:aliceblue;">
                    <legend>Action Tab</legend>

                    <span class="btn btn-danger"><i class='fas fa-trash'></i>
                        <a href="" class="text-dark ms-2" data-bs-toggle="modal" data-bs-target="#deldata">Delete
                            data</a>
                    </span>
                </fieldset>
            </div>

            <div class="main">

                <div class="container-inq">
                    <div class="title">
                        <h2>ContactUs Details</h2>
                    </div>

                    <div class="d-flex">
                        <div class="row header" style="text-align: center;">
                            <table id="example" class="table table-striped table-bordered"
                                style="border: 1px solid #dadada;">
                                <thead>
                                    <tr>
                                        <th>ContactId</th>
                                        <th>Contact Person</th>
                                        <th>Mobile</th>
                                        <th>Email</th>
                                        <th>Subject</th>
                                        <th>Message</th>
                                        <th>Form Submitted</th>
                                    </tr>
                                </thead>
                        </div>
                        <tbody>
                            @foreach ($data as $item)
                                <tr>
                                    <td>{{ $item->idcontact }}</td>
                                    <td>{{ $item->name }}</td>
                                    <td>{{ $item->mobile }}</td>
                                    <td>{{ $item->email }}</td>
                                    <td>{{ $item->subject }}</td>
                                    <td><button type="button" class="btn btn-warning" value="{{$item->idcontact}}" data-bs-toggle="modal" onclick="getmsg(this.value)" data-bs-target="#message">View</button></td>
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
    </div>

    {{-- modal message --}}
        <div class="modal fade" id="message" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Message </h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <p id="msg"></p>
                    </div>

                </div>
            </div>
        </div>

        {{-- delete data modal --}}
        <div class="modal fade" id="deldata" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Delete Message</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <form action="{{ url('contactus/ciddel') }}" method="POST">
                            @csrf
                            <div class="row h-100 align-items-center justify-content-center">
                                <div class="col-12 col-sm-12 col-md-12 col-lg-12 col-xl-12">
                                    <div class="form-floating mb-3">
                                        <select name="cnid" id="cnid" class="form-control bg-white">
                                        </select>
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

                </div>
            </div>
        </div>

        <script>
            $(document).ready(function() {
                        $.ajax({
                            url: '/getcnid',
                            type: 'get',
                            success: function(res) {
                                $('#cnid').html(res);
                            }
                        });
            });

            function getmsg(cid) {
            $.ajax({
                url: '/getmsg',
                type: 'post',
                data: 'cid=' + cid + '&_token={{ csrf_token() }}',
                success: function(res) {
                    if (res) {
                        $('#msg').html(res);
                    }
                }
            });
        }
        </script>





@endsection



