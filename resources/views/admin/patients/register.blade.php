@extends('layouts.login')
@section('content')
				<section class="material-half-bg">
								<div class="cover"></div>
				</section>
				<section class="login-content ">
								@include('inc.messages')
								<div class="logo">
												<h1><strong>Welcome to {{ env('APP_NAME') }}</strong></h1>
								</div>
								<!--register box -->
								<div class="register-box p-3 m-2">
												<!--user register form-->
												<form class="register-form" method="POST" action="{{ route('admin.register') }}"
																enctype="application/x-www-form-urlencoded" id="user-registration-form">
																@csrf
																<div class="row">
																				<div class="col">
																								<h4 class="text-uppercase mb-5 login-head"><i class="fa fa-lg fa-fw fa fa-user-circle-o"></i>Create
																												user account</h4>
																				</div>
																</div>
																<div class="form-outline mb-2 ">
																				<div class="row">
																								<div class="col-md-6 col-xl ">
																												<label class="form-label" for="firstname">Your first name</label>
																												<input type="text" id="user-firstname"
																																class="form-control form-control-lg  @error('firstname') is-invalid @enderror"
																																name="firstname" value="{{ old('firstname') }}" required autocomplete="firstname"
																																autofocus />
																												@error('firstname')
																																<span class="invalid-feedback" role="alert">
																																				<strong>{{ $message }}</strong>
																																</span>
																												@enderror
																								</div>
																								<div class="col-md-6 col-xl">
																												<label class="form-label" for="lastname">Your Surname</label>

																												<input type="text" id="user-lastname"
																																class="form-control form-control-lg  @error('lastname') is-invalid @enderror"
																																name="lastname" value="{{ old('lastname') }}" required autocomplete="lastname" />
																												@error('lastname')
																																<span class="invalid-feedback" role="alert">
																																				<strong>{{ $message }}</strong>
																																</span>
																												@enderror

																								</div>
																				</div>
																</div>
																<div class="form-outline mb-2 d-none">
																				<label class="form-label" for="role">Your role</label>
																				<input type="role" id="user-role"
																								class="form-control form-control-lg  @error('role') is-invalid @enderror" name="role"
																								value="1" required autocomplete="role" />
																				@error('role')
																								<span class="invalid-feedback" role="alert">
																												<strong>{{ $message }}</strong>
																								</span>
																				@enderror
																</div>
																<div class="form-outline mb-2">
																				<label class="form-label" for="email">Your Email</label>
																				<input type="email" id="user-email"
																								class="form-control form-control-lg  @error('email') is-invalid @enderror" name="email"
																								value="{{ old('email') }}" required autocomplete="email" />
																				@error('email')
																								<span class="invalid-feedback" role="alert">
																												<strong>{{ $message }}</strong>
																								</span>
																				@enderror
																</div>
																<div class="form-outline mb-2">
																				<div class="row">
																								<div class="col-xl col-md-6 col-sm">
																												<label class="form-label" for="phoneno">Your Phone Number</label>
																												<input id="user-phoneno" type="number"
																																class="form-control form-control-lg  @error('phoneno') is-invalid @enderror" name="phoneno"
																																value="{{ old('phoneno') }}" required autocomplete="phoneno" maxlength="10" />
																												@error('phoneno')
																																<span class="invalid-feedback" role="alert">
																																				<strong>{{ $message }}</strong>
																																</span>
																												@enderror
																								</div>
																				</div>
																</div>

																<div class="form-outline mb-2">
																				<label class="form-label" for="password">Password</label>

																				<input type="password" id="user-password"
																								class="form-control form-control-lg @error('password') is-invalid @enderror" name="password"
																								required autocomplete="new-password" minlength="8" />

																				@error('password')
																								<span class="invalid-feedback" role="alert">
																												<strong>{{ $message }}</strong>
																								</span>
																				@enderror
																</div>

																<div class="form-outline mb-2">
																				<label class="form-label" for="password-confirm" minlength="8">Repeat your password</label>

																				<input type="password" id="user-password-confirm" class="form-control form-control-lg"
																								name="password_confirmation" required autocomplete="new-password" />


																</div>
																<div class="d-flex justify-content-center mt-2">
																				<button type="submit"
																								class="btn btn-outline-dark btn-block btn-lg gradient-custom-4 ">{{ __('Register') }}</button>
																</div>



												</form>
								</div>
								</div>
								<script>
												function submitRegistrationForm() {
																document.getElementById("registration-form").submit();

												}
								</script>
				</section>
@endsection
