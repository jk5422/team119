
            <!-- Footer Start -->
            {{-- <div class="container-fluid pt-4 px-4">
                <div class="bg-light rounded-top p-4">
                    <div class="row">
                        <div class="col-12 col-sm-6 text-center text-sm-start">
                            &copy; <a href="#">Your Site Name</a>, All Right Reserved.
                        </div>
                        <div class="col-12 col-sm-6 text-center text-sm-end">

                            Designed By <a href="https://htmlcodex.com">HTML Codex</a>
                        </br>
                        Distributed By <a class="border-bottom" href="https://themewagon.com" target="_blank">ThemeWagon</a>
                        </div>
                    </div>
                </div>
            </div> --}}
            <!-- Footer End -->
        </div>
        <!-- Content End -->


        <!-- Back to Top -->
        <a href="#" class="btn btn-lg btn-primary btn-lg-square back-to-top"><i class="bi bi-arrow-up"></i></a>
    </div>

    <!-- JavaScript Libraries -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="{{url('backend/js/datatable.js')}}"></script>
    <script src="{{url('backend/lib/easing/easing.min.js')}}"></script>
    <script src="{{url('backend/lib/waypoints/waypoints.min.js')}}"></script>
    <script src="{{url('backend/lib/owlcarousel/owl.carousel.min.js')}}"></script>
    <script src="{{url('backend/lib/tempusdominus/js/moment.min.js')}}"></script>
    <script src="{{url('backend/lib/tempusdominus/js/moment-timezone.min.js')}}"></script>
    <script src="{{url('backend/lib/tempusdominus/js/tempusdominus-bootstrap-4.min.js')}}"></script>


    <!-- Template Javascript -->
    <script src="{{url('backend/js/main.js')}}"></script>
    <script>
         function showpass() {
        var x = document.getElementById("password");
        var y = document.getElementById("cpassword");

        if (x.type === "password" || y.type === "password") {
            x.type = "text";
            y.type = "text";
        } else {
            x.type = "password";
            y.type = "password";
        }
    }

    function showdpass(){
        var x = document.getElementById("dopass");
        var y = document.getElementById("dnpass");
        var z = document.getElementById("dcpass");

        if (x.type === "password" || y.type === "password" || z.type === "password") {
            x.type = "text";
            y.type = "text";
            z.type = "text";
        } else {
            x.type = "password";
            y.type = "password";
            z.type = "password";
        }
    }

    $(".alert").fadeTo(2000, 500).fadeOut(3000, function() {
        $(".alert").fadeOut(10000);
    });

    $(document).ready(function() {
        $('#example').DataTable();
        $('#adddoc').parsley();
        $('#updatedoc').parsley();
        $('#changedpass').parsley();
        $('#ddoctor').parsley();
        $('#addnservice').parsley();
        $('#updateser').parsley();
        $('#dservice').parsley();
        $('#updateapp').parsley();
        $('#addmed').parsley();
        $('#updatemed').parsley();
        $('#dmedicine').parsley();
        $('#addcli').parsley();
        $('#updatecli').parsley();
        $('#dclinic').parsley();
        $('#addprescription').parsley();
        $('#updatepre').parsley();
    });
    </script>
</body>

</html>
