@extends('frontend.layouts.main')

@section('main-container')

@if (session('otrue'))
<div class="alert alert-success fade in" id="alert">
    <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
    <strong>Success!</strong> {{session('otrue')}}
</div>
{{Session::forget('otrue');}}
@endif

@if (session('ofalse'))
<div class="alert alert-danger fade in" id="alert">
    <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
    <strong>Error!</strong> {{session('ofalse')}}
</div>
{{Session::forget('ofalse');}}
@endif

<div class="container">
    <div class="row" id="loginform">
		<div class="col-md-4 col-md-offset-4">
    		<div class="panel panel-default">
			  	<div class="panel-heading">
			    	<h3 class="panel-title">OTP Verify & Set New Password</h3>
			 	</div>
			  	<div class="panel-body">
			    	<form  role="form" id="otp">
                    <fieldset>
			    	  	<div class="form-group">
			    		    <input class="form-control otp" placeholder="Enter Otp received on email" maxlength="6" name="fusername" type="tel" required onkeypress="return event.charCode >= 48 && event.charCode <= 57" data-parsley-type="number" data-parsley-required-message="Please enter OTP">
                            <input type="hidden" class="pemail" name="fusername" value="{{$email}}">
			    		</div>
			    	  	<div class="form-group">
                            <button type="button" class="btn btn-primary resend" onclick="resendotp()" style="font-size: 10px;">Resend OTP</button>
                            <p style="color: green;" class="success"></p>
                            <p style="color: red;" class="error"></p>
                        </div>
			    		<input class="btn btn-lg btn-success btn-block validate" type="button" onclick="getotp()" value="validate">
			    	</fieldset>
                    <div class="form-group" style="margin-top: 1rem;margin-left:12rem;">
                        <a href="/forgot"><i class="fa fa-arrow-circle-left" aria-hidden="true" style="margin-right: 1rem;"></i>Back</a>
                    </div>
			      	</form>

                    <form class="newcred" style="display: none;">
                        <div class="form-group">
                            <input type="hidden" class="npemail" name="npemail" value="{{$email}}">
			    		    <input class="form-control" placeholder="Enter New Password" name="npass" type="password" id="password" required data-parsley-required-message="Please enter password" data-parsley-pattern="/^(?=.*\d)(?=.*[a-z])(?=.*[A-Z])(?=.*[^a-zA-Z0-9])(?!.*\s).{8,15}$/" data-parsley-pattern-message=" a password must be 8 character including one uppercase letter, one special character and one number"  data-parsley-trigger="keyup">

                            <input class="form-control" placeholder="Enter Confirm Password" name="ncpass" id="cpassword" type="password" style="margin-top: 1rem;" required
                            data-parsley-required-message="Please enter confirm password" data-parsley-equalto="#password" data-parsley-equalto-message="Password are not matching"  data-parsley-trigger="keyup">

                            <div class="checkbox">
                                <label>
                                    <input  type="checkbox" onclick="showlog()"> Show Password
                                </label>
                                <p style="color: green;" class="pass"></p>
                                <p style="color: red;" class="fail"></p>
                            </div>
                            <input class="btn btn-lg btn-success btn-block" type="button" onclick="setnewcred()" value="Submit">
			    		</div>
                    </form>
			    </div>
			</div>
		</div>
	</div>
</div>


<script>

   function getotp() {
        var otp=$('.otp').val();

        if(otp!=""){
        $.ajax({
            url: 'getotp',
            type: 'POST',
            data: 'otp=' + otp + '&_token={{ csrf_token() }}',
            success: function(res) {
               if(res=='true'){
                $('.validate').prop('disabled',true);
                $('.otp').prop('disabled',true);
                $('.resend').prop('disabled',true);
                $('.success').html('OTP IS VALID SET NEW CREDENTIALS..!!');
                $('.newcred').show();
               }
               else
               {
                alert('wrong otp please check Otherwise Resend again..!!');
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
        var pemail=$('.pemail').val();
        $('.error').html('Please Wait We are resending OTP...');
        $('.resend').prop('disabled',true);

        $.ajax({
            url: '/forgot/resendemail',
            type: 'POST',
            data: 'pemail=' + pemail + '&_token={{ csrf_token() }}',
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
        var npemail=$('.npemail').val();

        if(pass1!=pass2)
        {
            $('.fail').html('Password and Confirm Password Mismatch..!!');
        }
        else
        {
            var info=[];
            info[0]=pass1;
            info[1]=pass2;
            info[2]=npemail;

            $.ajax({
            url: '/forgot/setnewcred',
            type: 'POST',
            data: 'info=' + info + '&_token={{ csrf_token() }}',
            success: function(res) {
               if(res=='true'){
                $('.fail').html(' ');
                $('.pass').html('New Password Set Successfully..!!');
                setTimeout(()=> {
                    window.location.href='/login';
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
@endsection
