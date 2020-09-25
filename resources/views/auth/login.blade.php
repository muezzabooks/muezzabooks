@extends('auth.layoutauth')

@section('content')
<div class="container full-height">
    <div class="row justify-content-center p-5">
        <div class="col-md-8">
            <div class="card border-0">
                <div class="card-body">
					<div class="row">
						<div class="col-5 img-login">
							<img class="img-fluid" src="{{ ('assets/images/login.svg') }}" >
						</div>
						<div class="col-md-7 col-sm-12">
							<h4 class="text-center">LOGIN</h4>
							<form method="POST" action="{{ route('login') }}">
								@csrf							
								<div class="form-group">
									<div class="col-md-12">
									@if (count($errors) > 0)
									<div class="alert alert-danger">
											@foreach ($errors->all() as $error)
												{{ $error }}
											@endforeach
									</div>
									@endif
									<label for="email" class="col-md-12 col-form-label">{{ __('E-Mail Address') }}</label>

									
										<input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>

										@error('email')
											<span class="invalid-feedback" role="alert">
												<strong>{{ $message }}</strong>
											</span>
										@enderror
									</div>
								</div>

								<div class="form-group">
									<label for="password" class="col-md-12 col-form-label">{{ __('Password') }}</label>

									<div class="col-md-12">
										<input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="current-password">

										@error('password')
											<span class="invalid-feedback" role="alert">
												<strong>{{ $message }}</strong>
											</span>
										@enderror
									</div>
								</div>

								<div class="form-group">
									<div class="col-md-6 offset-md-0">
										<div class="form-check">
											<input class="form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>

											<label class="form-check-label" for="remember">
												{{ __('Remember Me') }}
											</label>
										</div>
									</div>
								</div>

								<div class="form-group">
									<div class="col-md-12 offset-md-0">
										<button type="submit" class="btn btn-primary">
											{{ __('Login') }}
										</button>

										@if (Route::has('password.request'))
											<a class="btn btn-link" href="{{ route('password.request') }}">
												{{ __('Forgot Your Password?') }}
											</a>
										@endif
									</div>
								</div>
							</form>
						</div>
					</div>
                    
                </div>
            </div>
        </div>
    </div>
</div>

@endsection
