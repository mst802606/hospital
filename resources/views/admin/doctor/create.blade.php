@extends('layouts.admin')
@section('page')
				<div class="container-fluid bg-light">
								<section>
												<!--doctor header-->
												<div class="container-fluid mt-5">
																<a href="{{ route('admin.doctors.index') }}" class="btn btn-warning m-2">View Doctors</a>
												</div>
												<!--doctor form-->
												<section class=" m-5" id="doctor-form">
																<div class="row justify-content-center text-center">
																				<p class="display-5"> Create a doctor account</p>
																</div>
																<div class="row tile mt-3">
																				<div class="row mx-auto justify-content-center">
																								<h3 class="display-6">Fill the doctor form</h3>
																				</div>
																				<form action="{{ route('admin.doctors.store') }}" method="POST">
																								@csrf

																								<!--office days-->
																								<div class="form-group">
																												<label for="doctorselect">Doctor</label>
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
																								{{--  availability  --}}
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
