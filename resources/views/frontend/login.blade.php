@extends('frontend.layouts.main')

@section('main-container')
@if (session('ptreg'))
<div class="alert alert-success fade in" id="alert">
    <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
    <strong>Success!</strong> {{session('ptreg')}}
</div>
{{Session::forget('ptreg');}}
@endif

@if (session('ptlog'))
<div class="alert alert-danger fade in" id="alert">
    <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
    <strong>Error!</strong> {{session('ptlog')}}
</div>
{{Session::forget('ptlog');}}
@endif
{{-- change password alert --}}
@if (session('passtrue'))
        <div class="alert alert-success fade in" id="alert">
            <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
            <strong>Success!</strong> {{ session('passtrue') }}
        </div>
        {{ Session::forget('passtrue') }}
    @endif


<div class="container">
    <div class="row" id="loginform">
		<div class="col-md-4 col-md-offset-4">
    		<div class="panel panel-default">
			  	<div class="panel-heading">
			    	<h3 class="panel-title">Sign In</h3>
			 	</div>
			  	<div class="panel-body">
			    	<form method="POST" action="login" role="form" id="login">
                        @csrf
                    <fieldset>
			    	  	<div class="form-group">
			    		    <input class="form-control" placeholder="Your Email or Mobile" name="ptlgnm" type="text" required data-parsley-required-message="Please enter email or mobile no."   data-parsley-trigger="keyup">
			    		</div>
			    		<div class="form-group">
			    			<input class="form-control" placeholder="Your Password" name="ptlgpass" type="password" id="password" required data-parsley-required-message="Please enter password"   data-parsley-trigger="keyup">
			    		</div>
			    		<div class="checkbox">
			    	    	<label>
			    	    		<input  type="checkbox" onclick="logfrmpass()"> Show Password
			    	    	</label>

                            <label style="margin-left: 4rem;">
			    	    		<a href="/forgot">Forgot password ?</a>
			    	    	</label>
			    	    </div>
			    		<input class="btn btn-lg btn-success btn-block" type="submit" value="Login">
			    	</fieldset>

                    <div class="form-group">
                        <label style="margin-top: 2rem;">
                            Don't have an account ?
                            <a href="{{url('/register')}}">Signup Here</a>
                        </label>
                    </div>

			      	</form>
			    </div>
			</div>
		</div>
	</div>
</div>
@endsection
