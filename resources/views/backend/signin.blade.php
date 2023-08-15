<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title>{{ $title }}</title>
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <meta content="" name="keywords">
    <meta content="" name="description">

    <!-- Favicon -->
    <link href="img/favicon.ico" rel="icon">

    <!-- Google Web Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Heebo:wght@400;500;600;700&display=swap" rel="stylesheet">

    <!-- Icon Font Stylesheet -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.10.0/css/all.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.4.1/font/bootstrap-icons.css" rel="stylesheet">

    <!-- Libraries Stylesheet -->
    <link href="{{ url('backend/lib/owlcarousel/assets/owl.carousel.min.css') }}" rel="stylesheet">
    <link href="{{ url('backend/lib/tempusdominus/css/tempusdominus-bootstrap-4.min.css') }}" rel="stylesheet" />

    <!-- Customized Bootstrap Stylesheet -->
    <link href="{{ url('backend/css/bootstrap.min.css') }}" rel="stylesheet">

    <!-- Template Stylesheet -->
    <link href="{{ url('backend/css/style.css') }}" rel="stylesheet">
</head>

<body>
    <div class="container-xxl position-relative bg-white d-flex p-0">
        <!-- Spinner Start -->
        {{-- <div id="spinner" class="show bg-white position-fixed translate-middle w-100 vh-100 top-50 start-50 d-flex align-items-center justify-content-center">
            <div class="spinner-border text-primary" style="width: 3rem; height: 3rem;" role="status">
                <span class="sr-only">Loading...</span>
            </div>
        </div> --}}
        <!-- Spinner End -->
        @if (session('dtrue'))
        <div class="alert alert-success fade in" id="alert">
            <a href="#" class="close" data-dismiss="alert" aria-label="close"></a>
            <strong>Success!</strong> {{ session('dtrue') }}
        </div>
        {{ Session::forget('dtrue') }}
        @endif

        @if (session('dpasschng'))
        <div class="alert alert-success fade in" id="alert">
            <a href="#" class="close" data-dismiss="alert" aria-label="close"></a>
            <strong>Success!</strong> {{ session('dpasschng') }}
        </div>
        {{ Session::forget('dpasschng') }}
        @endif

        @if (session('dlgfls'))
        <div class="alert alert-danger fade in" id="alert">
            <a href="#" class="close" data-dismiss="alert" aria-label="close"></a>
            <strong>Error!</strong> {{ session('dlgfls') }}
        </div>
        {{ Session::forget('dlgfls') }}
        @endif

        <!-- Sign In Start -->
        <div class="container bg-white">
            <div class="row h-100 align-items-center justify-content-center" style="min-height: 100vh;">
                <div class="col-12 col-sm-8 col-md-6 col-lg-5 col-xl-4">
                    <div class="bg-light rounded p-4 p-sm-5 my-4 mx-3">
                        <div class="d-flex align-items-center justify-content-between mb-3">
                            {{-- <a href="index.html" class=""> --}}
                                <h3 class="text-primary"><i class="fa fa-hashtag me-2"></i>DOCTOR LOGIN</h3>
                            {{-- </a> --}}
                            {{-- <h3>Sign In</h3> --}}
                        </div>
                        <form action="{{url('/doctor/dlog')}}" method="POST" id="doclogin">
                            @csrf
                            <div class="form-floating mb-3">
                                <input type="text" name="username" class="form-control" id="floatingInput"
                                    placeholder="name@example.com" required data-parsley-required-message="Please enter mobile no or email">
                                <label for="floatingInput">Email Or Mobile</label>
                            </div>
                            <div class="form-floating mb-4">
                                <input type="password" name="password" class="form-control" id="password"
                                    placeholder="Password"  required data-parsley-required-message="Please enter password">
                                <label >Password</label>
                            </div>
                            <div class="d-flex align-items-center justify-content-between mb-4">
                                <div class="form-check">
                                    <input type="checkbox" class="form-check-input" id="exampleCheck1"
                                        onclick="showlog();">
                                    <label class="form-check-label" for="exampleCheck1">Show Password</label>
                                </div>
                                <a href="/doctor/forgot">Forgot Password ?</a>
                            </div>
                            <button type="submit" class="btn btn-primary py-3 w-100 mb-4">Sign In</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <!-- Sign In End -->
    </div>

    <!-- JavaScript Libraries -->
    <script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="{{ url('backend/lib/chart/chart.min.js') }}"></script>
    <script src="{{ url('backend/lib/easing/easing.min.js') }}"></script>
    <script src="{{ url('backend/lib/waypoints/waypoints.min.js') }}"></script>
    <script src="{{ url('backend/lib/owlcarousel/owl.carousel.min.js') }}"></script>
    <script src="{{ url('backend/lib/tempusdominus/js/moment.min.js') }}"></script>
    <script src="{{ url('backend/lib/tempusdominus/js/moment-timezone.min.js') }}"></script>
    <script src="{{ url('backend/lib/tempusdominus/js/tempusdominus-bootstrap-4.min.js') }}"></script>

    <!-- Template Javascript -->
    <script src="{{ url('backend/js/main.js') }}"></script>
    <script src="{{ url('backend/js/parsley.js') }}"></script>
    <script>
        function showlog() {
        var x = document.getElementById("password");
        if (x.type === "password") {
            x.type = "text";
        } else {
            x.type = "password";
        }
    }


    $(".alert").fadeTo(2000, 500).fadeOut(500, function() {
        $(".alert").fadeOut(500);
    });
    $(document).ready(function() {
        $('#doclogin').parsley();
    });
    </script>
</body>

</html>
