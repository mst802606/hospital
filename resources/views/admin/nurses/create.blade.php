@extends('layouts.admin')
@section('page')

				<div class="container-fluid bg-light">
								<section>
												<!--nurse header-->
												<div class="container-fluid mt-5">
																<a href="{{ route('admin.nurses.index') }}" class="btn btn-warning m-2">View Nurses</a>
												</div>
												<!--nurse form-->
												<section class=" m-5" id="nurse-form">
																<div class="row justify-content-center text-center">
																				<p class="display-5"> Create a nurse account</p>
																</div>
																<div class="row tile mt-3">
																				<div class="row mx-auto justify-content-center">
																								<h3 class="display-6">Fill the nurse form</h3>
																				</div>
																				<form action="{{ route('admin.nurses.store') }}" method="POST">
																								@csrf
																								<!-- select user-->
																								<div class="form-group">
																												<label for="doctorselect">Nurse Name</label>
																												<select class="form-control form-control @error('user_id') is-invalid @enderror"
																																id="doctorselect" name="user_id" required>
																																@if ($createdata['users'])
																																				@foreach ($createdata['users'] as $user)
																																								<option value="{{ $user->id }}">{{ $user->username }}
																																								</option>
																																				@endforeach
																																@endif
																												</select>

																												@error('user_id')
																																<span class="invalid-feedback" role="alert">
																																				<strong>{{ $message }}</strong>
																																</span>
																												@enderror
																								</div>

																								<!-- Create new user-->
																								<div class="form-group">
																												<label for="doctorselect">Or create new nurse account</label>
																												<a href="{{ route('admin.nurses.register') }}" class="btn btn-info">Create a nurse account</a>
																								</div>

																								<!-- department-->
																								<div class="form-group">
																												<label for="department">Department</label>
																												<select class="form-control form-control @error('department') is-invalid @enderror"
																																id="department" name="department" required>
																																<option value="Lab Tech">Lab Tech
																																</option>
																																<option value="Cardiology">Cardiology
																																</option>
																																<option value="General">General
																																</option>
																												</select>

																												@error('department')
																																<span class="invalid-feedback" role="alert">
																																				<strong>{{ $message }}</strong>
																																</span>
																												@enderror
																								</div>

																								<!--role-->
																								<div class="form-group">
																												<label for="role">Role</label>
																												<select class="form-control form-control @error('role') is-invalid @enderror" id="role"
																																name="role" required>
																																<option value="Lab Tech">Lab Tech
																																</option>
																																<option value="Cardiology">Cardiology
																																</option>
																																<option value="General">General
																																</option>
																												</select>

																												@error('role')
																																<span class="invalid-feedback" role="alert">
																																				<strong>{{ $message }}</strong>
																																</span>
																												@enderror
																								</div>

																								<div class="form-group">
																												<label for="office">Office</label>
																												<select class="form-control form-control @error('office') is-invalid @enderror" id="office"
																																name="office" required>

																																<option value="Hr Office 1">Hr Office 1
																																</option>
																																<option value="Hr Office 1">Hr Office 1
																																</option>
																																<option value="Lab Office 1">Lab Office
																																</option>
																																<option value="Lab Office 1">Lab Office 1
																																</option>
																																<option value="Customer Care Office">Customer Care Office
																																</option>
																																<option value="Reception">Reception
																																</option>
																												</select>

																												@error('office')
																																<span class="invalid-feedback" role="alert">
																																				<strong>{{ $message }}</strong>
																																</span>
																												@enderror
																								</div>

																								<!--office days-->
																								<div class="form-group">
																												<label for="doctorselect">Nurse</label>
																												<select class="form-control form-control @error('office_days') is-invalid @enderror"
																																id="doctorselect" name="office_days" required>
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
																												<label for="office_hours">office_hours </label>
																												<select class="form-control form-control @error('office_hours') is-invalid @enderror"
																																id="doctorselect" name="office_hours" required>
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
																												<select class="form-control form-control @error('available') is-invalid @enderror"
																																id="available" name="available" required>
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
																								<button type="submit" class="btn btn-primary">Submit</button>
																				</form>
																</div>
												</section>
								</section>
				</div>
@endsection
