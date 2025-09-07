@extends('layouts.app')

@section('content')
	<body class="img js-fullheight">
	<section class="ftco-section">
       
		<div class="container">
			<div class="row justify-content-center">
				<div class="col-md-6 text-center mb-5">
					<h2 class="heading-section">Reset Password </h2>
				</div>
			</div>
			<div class="row justify-content-center">
				<div class="col-md-6 col-lg-4">
					<div class="login-wrap p-0">
		      	<form method="POST" action="{{ route('password.email') }}" class="signin-form">
                      @csrf
		      		<div class="form-group">
		      		<input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>	
                      @error('email')
                                    <span class="invalid-feedback-black" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
		      		</div>
	            <div class="form-group">
	            	<button type="submit" class="form-control btn btn-primary submit px-3">Send Password Reset Link</button>
	            </div>
	            
	          </form>
	        
		      </div>
				</div>
			</div>
		</div>
	</section>



	</body>

@endsection
