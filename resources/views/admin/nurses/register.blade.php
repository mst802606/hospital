@extends('layouts.admin')
@section('page')
				<section class="material-half-bg">
								<div class="cover"></div>
				</section>
				<section class="login-content ">
								@include('inc.messages')

								<!--register box -->
								<div class="register-box p-3 m-2">
												<!--user register form-->
												<form class="register-form" method="POST" action="{{ route('admin.nurses.register') }}"
																enctype="application/x-www-form-urlencoded" id="user-registration-form">
																@csrf
																<div class="row">
																				<div class="col">
																								<h4 class="text-uppercase mb-5 login-head"><i class="fa fa-lg fa-fw fa fa-user-circle-o"></i>Create
																												Nurse account</h4>
																				</div>
																</div>
																<div class="form-outline mb-2 ">
																				<div class="row">
																								<div class="col-md-6 col-xl ">
																												<label class="form-label" for="firstname">Nurse first name</label>
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
																												<label class="form-label" for="lastname">Nurse Surname</label>

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
																				<label class="form-label" for="role">Nurse role </label>
																				<input type="role" id="second-role"
																								class="form-control form-control-lg  @error('role') is-invalid @enderror" name="role"
																								value="3" required autocomplete="role" />
																				@error('role')
																								<span class="invalid-feedback" role="alert">
																												<strong>{{ $message }}</strong>
																								</span>
																				@enderror
																</div>
																<div class="form-outline mb-2">
																				<label class="form-label" for="email">Nurse Email</label>
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
																												<label class="form-label" for="phoneno">Nurse Phone Number</label>
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

																<!--office days-->
																<div class="form-group">
																				<label for="nurseselect">Nurse Working days</label>
																				<select class="form-control form-control @error('office_days') is-invalid @enderror" id="nurseselect"
																								name="office_days" required>
																								<option value="8:00 am to 5:30 pm">Monday to Sarturday 8:00 am to 5:30 pm
																								</option>
																				</select>

																				@error('office_days')
																								<span class="invalid-feedback" role="alert">
																												<strong>{{ $message }}</strong>
																								</span>
																				@enderror
																</div>

																<!--office hours-->
																<div class="form-group">
																				<label for="office_hours">Office hours </label>
																				<select class="form-control form-control @error('office_hours') is-invalid @enderror" id="nurseselect"
																								name="office_hours" required>
																								<option value="8:00 am to 5:30 pm">Day 8:00 am to 5:30 pm
																								</option>
																								<option value="5:00 pm to 8:00 pm">Night 5:00 pm to 8:00 pm
																								</option>
																				</select>
																				@error('office_hours')
																								<span class="invalid-feedback" role="alert">
																												<strong>{{ $message }}</strong>
																								</span>
																				@enderror
																</div>
																<div class="form-group">
																				<label for="available">Availability</label>
																				<select class="form-control form-control @error('available') is-invalid @enderror" id="available"
																								name="available" required>
																								<option value="1">Available
																								</option>
																								<option value="0">Not Available
																								</option>
																				</select>

																				@error('available')
																								<span class="invalid-feedback" role="alert">
																												<strong>{{ $message }}</strong>
																								</span>
																				@enderror
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
																				<label class="form-label" for="password-confirm" minlength="8">Repeat Nurse password</label>

																				<input type="password" id="user-password-confirm" class="form-control form-control-lg"
																								name="password_confirmation" required autocomplete="new-password" />


																</div>

																<div class="form-check d-none">
																				<input class="form-check-input me-2 @error('terms_and_conditions') is-invalid @enderror"
																								type="checkbox" value="Accepted" name="terms_and_conditions" checked />
																				<label class="form-check-label mt-1" for="form2Example3g">
																								I agree all statements in <a href="/terms_and_conditions" class="text-body"><u>Terms of
																																service</u></a>
																				</label>

																				@error('terms_and_conditions')
																								<span class="invalid-feedback" role="alert">
																												<strong>{{ $message }}</strong>
																								</span>
																				@enderror

																</div>

																<div class="d-flex justify-content-center m-4">
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
