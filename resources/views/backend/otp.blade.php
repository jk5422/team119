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

    <script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>

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

    @if (session('drtrue'))
        <div class="alert alert-success fade in" id="alert">
            <a href="#" class="close" data-dismiss="alert" aria-label="close"></a>
            <strong>Error!</strong> {{ session('drtrue') }}
        </div>
        {{ Session::forget('drtrue') }}
    @endif

        <!-- Sign In Start -->
        <div class="container bg-white">
            <div class="row h-100 align-items-center justify-content-center" style="min-height: 100vh;">
                <div class="col-12 col-sm-8 col-md-6 col-lg-5 col-xl-4">
                    <div class="bg-light rounded p-4 p-sm-5 my-4 mx-3">
                        <div class="d-flex align-items-center justify-content-between mb-3">
                            {{-- <a href="index.html" class=""> --}}
                                <h3 class="text-primary"><i class="fa fa-hashtag me-2"></i>OTP VERIFY</h3>
                            {{-- </a> --}}
                            {{-- <h3>back</h3> --}}
                        </div>
                        <form >
                            <input type="hidden" class="demail" name="demail" value="{{$demail}}">
                            <div class="form-floating mb-3">
                                <input type="tel" name="" class="otp form-control" id="floatingInput"
                                    placeholder="Enter OTP" maxlength="6">
                                <label for="floatingInput">Enter OTP sended on email</label>
                            </div>
                            <div class="form-floating mb-3">
                                <button type="button" class="resend btn btn-primary" onclick="resendotp()" style="font-size: 10px;">Resend</button>
                                <p style="color: green;" class="success"></p>
                            <p style="color: red;" class="error"></p>
                            </div>
                            <button type="button" onclick="getotp()" class="validate btn btn-primary py-3 w-100 mb-4">validate</button>

                            <div class="form-floating mb-4 mt-3">
                                <a href="/doctor/forgot"><i class="fas fa-arrow-circle-left me-2"></i>Back</a>
                            </div>
                        </form>

                        <form class="drnewcred" style="display: none;">
                            <input type="hidden" class="demail" name="demail" value="{{$demail}}">
                            <div class="form-floating mb-3">
                                <input type="password" name="dnpass" class="form-control" id="password"
                                    placeholder="Enter new password">
                                <label for="password">Enter New Password</label>
                            </div>
                            <div class="form-floating mb-3">
                                <input type="password" name="dcpass" class="form-control" id="cpassword"
                                    placeholder="Enter new password">
                                <label for="cpassword">Enter Confirm Password</label>
                            </div>
                            <div class="form-check">
                                <input type="checkbox" class="form-check-input" id="exampleCheck1"
                                    onclick="showlog();">
                                <label class="form-check-label" for="exampleCheck1">Show Password</label>
                            </div>
                            <div class="form-floating mb-3">
                                <p style="color: green;" class="pass"></p>
                                <p style="color: red;" class="fail"></p>
                            </div>
                            <button type="button" onclick="setnewcred()" class="btn btn-primary py-3 w-100 mb-4">submit</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <!-- Sign In End -->
    </div>

    <!-- JavaScript Libraries -->
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
    <script>
    $(".alert").fadeTo(2000, 500).fadeOut(500, function() {
        $(".alert").fadeOut(500);
    });
    </script>

<script>

function showlog() {
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


    function getotp() {
         var otp=$('.otp').val();

         if(otp!=""){
         $.ajax({
             url: 'fpass/drgetotp',
             type: 'POST',
             data: 'otp=' + otp + '&_token={{ csrf_token() }}',
             success: function(res) {
                if(res=='true'){
                 $('.validate').prop('disabled',true);
                 $('.otp').prop('disabled',true);
                 $('.resend').prop('disabled',true);
                 $('.success').html('OTP IS VALID SET NEW CREDENTIALS..!!');
                 $('.drnewcred').show();
                }
                else
                {
                 alert('wrong otp please check Otherwise Resend Again..!!');
                }
             }
         });

     }
     else
     {
         alert('Enter OTP..!!');
     }
   }

     function resendotp(){
         var demail=$('.demail').val();
         $('.error').html('Please Wait We are resending OTP...');
         $('.resend').prop('disabled',true);

         $.ajax({
             url: 'fpass/drresendemail',
             type: 'POST',
             data: 'demail=' + demail + '&_token={{ csrf_token() }}',
             success: function(res) {
                if(res=='true'){
                 $('.error').html(' ');
                 $('.success').html('Resend otp successfully..!!');
                 $('.resend').prop('disabled',false);

                }
                else
                {
                 $('.error').html('Failed to resend otp..!!');
                }
             }
         });
     }

     function setnewcred()
     {
         var pass1=$('#password').val();
         var pass2=$('#cpassword').val();
         var demail=$('.demail').val();

         if(pass1!=pass2)
         {
             $('.fail').html('Password and Confirm Password Mismatch..!!');
         }
         else
         {
             var info=[];
             info[0]=pass1;
             info[1]=pass2;
             info[2]=demail;

             $.ajax({
             url: 'fpass/drsetnewcred',
             type: 'POST',
             data: 'info=' + info + '&_token={{ csrf_token() }}',
             success: function(res) {
                if(res=='true'){
                 $('.fail').html(' ');
                 $('.pass').html('New Password Set Successfully..!!');
                 setTimeout(()=> {
                     window.location.href='/doctor';
                 }
                 ,2000);
             }
                else
                {
                 $('.fail').html('Failed to Set New Password..!!');
                }
             }
         });
         }
     }
 </script>
</body>

</html>
