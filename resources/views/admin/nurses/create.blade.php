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
																												<label for="nurseselect">Nurse Name</label>
																												<select class="form-control form-control @error('user_id') is-invalid @enderror"
																																id="nurseselect" name="user_id" required>
																																@if ($users)
																																				@foreach ($users as $user)
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
																												<label>Or create new nurse account</label>
																												<a href="{{ route('admin.nurses.register') }}" class="btn btn-info">Create a nurse account</a>
																								</div>
																								<div class="form-group">
																												<label for="ward">Allocate Ward</label>
																												<select class="form-control form-control @error('ward') is-invalid @enderror" id="ward"
																																name="ward" required>

																																@forelse ($wards as  $ward)
																																				<option value="{{ $ward->id }}"> {{ $ward->name }}
																																				</option>
																																@empty
																																				<option disabled>No wards available</option>
																																@endforelse
																												</select>

																												@error('ward')
																																<span class="invalid-feedback" role="alert">
																																				<strong>{{ $message }}</strong>
																																</span>
																												@enderror
																								</div>

																								<!--office days-->
																								<div class="form-group">
																												<label for="doctorselect">Nurse availability</label>
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
