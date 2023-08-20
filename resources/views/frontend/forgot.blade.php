@extends('frontend.layouts.main')

@section('main-container')

@if (session('efalse'))
<div class="alert alert-danger fade in" id="alert">
    <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
    <strong>Error!</strong> {{session('efalse')}}
</div>
{{Session::forget('efalse');}}
@endif





<div class="container">
    <div class="row" id="loginform">
		<div class="col-md-4 col-md-offset-4">
    		<div class="panel panel-default">
			  	<div class="panel-heading">
			    	<h3 class="panel-title">Forgot Password</h3>
			 	</div>
			  	<div class="panel-body">
			    	<form method="POST" action="/forgot/sendemail" role="form" id="forget" >
                        @csrf
                    <fieldset>
			    	  	<div class="form-group">
			    		    <input class="form-control" placeholder="Your Email" name="fusername" type="text" required data-parsley-required-message="Please enter email address" data-parsley-type="email" data-parsley-type-message="Please enter valid email address "  data-parsley-trigger="keyup">
			    		</div>
			    		<input class="btn btn-lg btn-success btn-block" type="submit" value="Forgot">
                        <div class="form-group" style="margin-top: 1rem;margin-left:12rem;">
                            <a href="/login"><i class="fa fa-arrow-circle-left" aria-hidden="true" style="margin-right: 1rem;"></i>Back</a>
			    		</div>
			    	</fieldset>

			      	</form>
			    </div>
			</div>
		</div>
	</div>
</div>
@endsection
