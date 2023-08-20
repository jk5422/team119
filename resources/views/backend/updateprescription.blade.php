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


    <!-- register doctor Start -->
    <div class="container-fluid pt-4 px-4">
        <div class="bg-light rounded p-4 p-sm-5 my-4 mx-3">
            <div class="d-flex align-items-center justify-content-between mb-3">
                {{-- <a href="index.html" class=""> --}}
                <h3 class="text-primary"><i class="fa fa-hashtag me-2"></i>Update Prescription</h3>
                <div class="empadd">
                    <span><i class="fa fa-arrow-left" aria-hidden="true"></i><a
                            href="{{ url('doctor/pendappoinments') }}" style="margin-left: 1rem;" type="button">Pending
                            Appoinments</a></span>
                </div>
            </div>

            <div class="row h-100 align-items-center justify-content-center">
                <div class="col-12 col-sm-12 col-md-12 col-lg-12 col-xl-12">

                    <form action="{{url('pendappoinments/updateprescription')}}" method="POST" id="updatepre">
                        @csrf
                    <div class="table-responsive">
                        <table class="table table-primary" border="1" id="chngprescribe">
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
                            <tbody id="newdata">
                                <tr>
                                    <td scope="row">
                                        <select id="chngmedid"  required data-parsley-required-message="Please select medicine name"></select></td>
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
                                        <input type="text" id="remark" placeholder="Remarks">
                                    </td>
                                    <td><button type="button" class="btn btn-primary" id="add">Add More</button></td>
                                </tr>
                                <input type="hidden" name="apno" value="{{$data[0]->appoinments_apno}}">
                                @foreach ($data as $item)
                                <tr><td><input type="text" name="mid[]" value="{{$item->medicinename}}" disabled><input type="hidden" name="mid[]" value="{{$item->medicines_medid}}"></td><td><input type="text" name="mrng[]" value="{{$item->morning}}" disabled><input type="hidden" name="mrng[]" value="{{$item->morning}}"></td><td><input type="text" name="afrn[]" value="{{$item->afternoon}}" disabled><input type="hidden" name="afrn[]" value="{{$item->afternoon}}"></td><td><input type="text" name="evng[]" value="{{$item->evening}}" disabled><input type="hidden" name="evng[]" value="{{$item->evening}}"></td><td><input type="text" name="nght[]" value="{{$item->night}}" disabled><input type="hidden" name="nght[]" value="{{$item->night}}"></td><td><input type="text" name="remark[]" value="{{$item->remarks}}" disabled><input type="hidden" name="remark[]" value="{{$item->remarks}}"></td><td><button type="button" id="remove" style="color:red;text-color:white;">Cancel</button></td></tr>
                                @endforeach
                            </tbody>
                        </table>
                        <button type="submit" class="btn btn-primary">Update Prescription</button>
                    </form>

                    </div>
                </div>
            </div>


            <script>
                $(document).ready(function() {

                    $.ajax({
                        url: '/getmedicine',
                        type: 'get',
                        success: function(res) {
                            $('#chngmedid').html(res);

                        }
                    });

                    $("#add").click(function() {

                        var mid = document.getElementById("chngmedid");
                        var mno = mid.options[mid.selectedIndex].value;
                        var mname = mid.options[mid.selectedIndex].text;

                        var d1 = document.getElementById("mrng");
                        var mrng = d1.options[d1.selectedIndex].value;

                        var d2 = document.getElementById("afrn");
                        var afrn = d2.options[d2.selectedIndex].value;

                        var d3 = document.getElementById("evng");
                        var evng = d3.options[d3.selectedIndex].value;

                        var d4 = document.getElementById("nght");
                        var nght = d4.options[d4.selectedIndex].value;

                        var remark = document.getElementById("remark").value;

                        var html = '<tr><td><input type="text" name="mid[]" value="' + mname +
                            '" disabled><input type="hidden" name="mid[]" value="' + mno +
                            '"></td><td><input type="text" name="mrng[]" value="' + mrng +
                            '" disabled><input type="hidden" name="mrng[]" value="' + mrng +
                            '"></td><td><input type="text" name="afrn[]" value="' + afrn +
                            '" disabled><input type="hidden" name="afrn[]" value="' + afrn +
                            '"></td><td><input type="text" name="evng[]" value="' + evng +
                            '" disabled><input type="hidden" name="evng[]" value="' + evng +
                            '"></td><td><input type="text" name="nght[]" value="' + nght +
                            '" disabled><input type="hidden" name="nght[]" value="' + nght +
                            '"></td><td><input type="text" name="remark[]" value="' + remark +
                            '" disabled><input type="hidden" name="remark[]" value="' + remark +
                            '"></td><td><button type="button" id="remove" style="color:red;text-color:white;">Cancel</button></td></tr>';
                        $("#chngprescribe").append(html);
                    });

                    $("#chngprescribe").on('click', '#remove', function() {
                        $(this).closest('tr').remove();
                    });
                });
            </script>
        @endsection
