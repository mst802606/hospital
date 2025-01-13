@extends('layouts.doctor')

@section('page')
				<section class="material-half-bg">
								<div class="cover"></div>
				</section>

				<section class="login-content">
								@include('inc.messages')
								<div class="register-box p-3 m-2">
												<form class="register-form" method="POST" action="{{ route('doctor.patients.update', $patient->id) }}"
																enctype="application/x-www-form-urlencoded" id="user-registration-form">
																@csrf
																@method('PUT')
																<div class="row">
																				<div class="col">
																								<h4 class="text-uppercase mb-5 login-head"><i class="fa fa-lg fa-fw fa-user-circle-o"></i>Edit
																												Patient Information</h4>
																				</div>
																</div>

																<div class="form-outline mb-2">
																				<div class="row">
																								<div class="col-md-6 col-xl">
																												<label class="form-label" for="firstname">First Name</label>
																												<input type="text" id="user-firstname"
																																class="form-control form-control-lg @error('firstname') is-invalid @enderror"
																																name="firstname" value="{{ old('firstname', $patient->firstname) }}" required
																																autocomplete="firstname" autofocus />
																												@error('firstname')
																																<span class="invalid-feedback" role="alert">
																																				<strong>{{ $message }}</strong>
																																</span>
																												@enderror
																								</div>
																								<div class="col-md-6 col-xl">
																												<label class="form-label" for="lastname">Last Name</label>
																												<input type="text" id="user-lastname"
																																class="form-control form-control-lg @error('lastname') is-invalid @enderror" name="lastname"
																																value="{{ old('lastname', $patient->lastname) }}" required autocomplete="lastname" />
																												@error('lastname')
																																<span class="invalid-feedback" role="alert">
																																				<strong>{{ $message }}</strong>
																																</span>
																												@enderror
																								</div>
																				</div>
																</div>

																<div class="form-outline mb-2">
																				<label class="form-label" for="email">Email</label>
																				<input type="email" id="user-email"
																								class="form-control form-control-lg @error('email') is-invalid @enderror" name="email"
																								value="{{ old('email', $patient->email) }}" required autocomplete="email" />
																				@error('email')
																								<span class="invalid-feedback" role="alert">
																												<strong>{{ $message }}</strong>
																								</span>
																				@enderror
																</div>

																<div class="form-outline mb-2">
																				<label class="form-label" for="phoneno">Phone Number</label>
																				<input type="text" id="user-phoneno"
																								class="form-control form-control-lg @error('phoneno') is-invalid @enderror" name="phoneno"
																								value="{{ old('phoneno', $patient->phoneno) }}" required autocomplete="phoneno" maxlength="10" />
																				@error('phoneno')
																								<span class="invalid-feedback" role="alert">
																												<strong>{{ $message }}</strong>
																								</span>
																				@enderror
																</div>

																<div class="form-outline mb-2">
																				<label class="form-label" for="password">Password (Leave blank to keep current)</label>
																				<input type="password" id="user-password"
																								class="form-control form-control-lg @error('password') is-invalid @enderror" name="password"
																								autocomplete="new-password" />
																				@error('password')
																								<span class="invalid-feedback" role="alert">
																												<strong>{{ $message }}</strong>
																								</span>
																				@enderror
																</div>

																<div class="form-outline mb-2">
																				<label class="form-label" for="password-confirm">Confirm Password</label>
																				<input type="password" id="user-password-confirm" class="form-control form-control-lg"
																								name="password_confirmation" autocomplete="new-password" />
																</div>

																<div class="d-flex justify-content-center mt-2">
																				<button type="submit" class="btn btn-outline-dark btn-block btn-lg gradient-custom-4">Update
																								Patient</button>
																</div>

												</form>
								</div>
				</section>
@endsection
