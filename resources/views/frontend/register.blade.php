@extends('frontend.layouts.main')

@section('main-container')
@if (session('ptreg'))
<div class="alert alert-danger fade in" id="alert">
    <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
    <strong>Error!</strong> {{session('ptreg')}}
</div>
{{Session::forget('ptreg');}}
@endif
<div class="container">
    <div class="row" id="loginform">
		<div class="col-md-4 col-md-offset-4">
    		<div class="panel panel-default">
			  	<div class="panel-heading">
			    	<h3 class="panel-title">Sign Up </h3>
			 	</div>
			  	<div class="panel-body">
			    	<form method="POST" action="register" role="form" id="register"  >
                        @csrf
                    <fieldset>
			    	  	<div class="form-group">
			    		    <input class="form-control" placeholder="Your Full Name" name="pname" type="text" required data-parsley-required-message="Please enter name" data-parsley-pattern="^([a-zA-Z]+\s)*[a-zA-Z]+$" data-parsley-pattern-message="please enter only characters" data-parsley-minlength="3" data-parsley-minlength-message="Name should be minimum 3 character" data-parsley-trigger="keyup">
			    		</div>
                        <div class="form-group">
			    		    <input class="form-control" placeholder="Your Mobile" name="pmobile" maxlength="10" type="tel"
							required data-parsley-required-message="Please enter mobile number" data-parsley-type="number" data-parsley-type-message="Please enter valid mobile number"  data-parsley-pattern="^[1-9]{1}[0-9]{9}$" data-parsley-pattern-message="Please enter valid mobile number" data-parsley-maxlength="10" data-parsley-maxlength-message="Mobile number should be exactly 10 digit" data-parsley-minlength="10" data-parsley-minlength-message="Mobile number should be exactly 10 digit" data-parsley-trigger="keyup">
			    		</div>
                        <div class="form-group">
			    		    <input class="form-control" placeholder="Your Email" name="pemail" type="email" required data-parsley-required-message="Please enter email address" data-parsley-type="email" data-parsley-type-message="Please enter valid email address "  data-parsley-trigger="keyup">
			    		</div>

                        <div class="form-group">
			    		    <input class="form-control" placeholder="Your Age" name="page" type="text" required data-parsley-required-message="Please enter age"
							data-parsley-type="number" min="1" max="120"
							data-parsley-type-message="Please enter only number" data-parsley-min-message="Age must be greater than 1"
							data-parsley-range-message="Please enter valid age"   data-parsley-trigger="keyup">
			    		</div>

                        <div class="form-group">
			    		   <select name="pgen" class="form-control">
                            <option value="M">Male</option>
                            <option value="F">Female</option>
                           </select>
			    		</div>

                        <div class="form-group">
			    		    <textarea class="form-control" name="paddress" cols="45" rows="2" placeholder="Your Address" required data-parsley-required-message="Please enter address" data-parsley-minlength="15" data-parsley-minlength-message="Address should be minimum 15 character"  data-parsley-trigger="keyup"></textarea>
			    		</div>

			    		<div class="form-group">
			    			<input class="form-control" placeholder="Password" name="ppass" type="password" id="password" required data-parsley-required-message="Please enter password" data-parsley-pattern="/^(?=.*\d)(?=.*[a-z])(?=.*[A-Z])(?=.*[^a-zA-Z0-9])(?!.*\s).{8,15}$/" data-parsley-pattern-message=" a password must be 8 character including one uppercase letter, one special character and one number"  data-parsley-trigger="keyup">
			    		</div>
                        <div class="form-group">
			    			<input class="form-control" type="password" placeholder="Confirm Password" name="cpassword" type="pcpass" id="cpassword" required data-parsley-required-message="Please enter confirm password" data-parsley-equalto="#password" data-parsley-equalto-message="Password are not matching"  data-parsley-trigger="keyup">
			    		</div>
			    		<div class="checkbox">
			    	    	<label>
			    	    		<input  type="checkbox" onclick="newpass()"> Show Password
			    	    	</label>

			    	    </div>
			    		<input class="btn btn-lg btn-success btn-block" type="submit" value="SignUp">
			    	</fieldset>

                    <div class="form-group">
                        <label style="margin-top: 2rem;">
                            Already have an account ?
                            <a href="{{url('/login')}}">SignIn Here</a>
                        </label>
                    </div>

			      	</form>
			    </div>
			</div>
		</div>
	</div>
</div>
@endsection
