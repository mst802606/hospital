@extends('layouts.admin')
@section('page')
				<div class="container-fluid bg-light">
								<section>
												<!--nurse header-->
												<div class="container-fluid mt-5">
																<a href="{{ route('admin.allocate_wards.index') }}" class="btn btn-warning m-2">View Allocations</a>
												</div>
												<!--nurse form-->
												<section class=" m-5" id="nurse-form">
																<div class="row justify-content-center text-center">
																				<p class="display-5"> Admit patient to a ward</p>
																</div>
																<div class="row tile mt-3">
																				<div class="row mx-auto justify-content-center">
																								<h3 class="display-6">Fill the form to admit a patient to a ward</h3>
																				</div>
																				<form action="{{ route('admin.admit_to_wards.store') }}" method="POST">
																								@csrf
																								<!-- select user-->
																								<div class="form-group">
																												<label for="patientselect">Patient Name</label>
																												<select class="form-control form-control @error('user_id') is-invalid @enderror"
																																id="patientselect" name="patient_id" required>
																																@foreach ($patients as $patient)
																																				<option value="{{ $patient->id }}">{{ $patient->user->username }}
																																				</option>
																																@endforeach
																												</select>

																												@error('user_id')
																																<span class="invalid-feedback" role="alert">
																																				<strong>{{ $message }}</strong>
																																</span>
																												@enderror
																								</div>

																								{{--  <!-- Create new user-->
																								<div class="form-group">
																												<label for="createpatient">Or create new nurse account</label>
																												<a href="{{ route('admin.nurses.register') }}" class="btn btn-info">Create a nurse account</a>
																								</div>  --}}

																								<!-- ward-->
																								<div class="form-group">
																												<label for="ward">Ward</label>
																												<select class="form-control form-control @error('ward') is-invalid @enderror" id="ward"
																																name="ward_id" required>
																																@foreach ($wards as $ward)
																																				<option value="{{ $ward->id }}">{{ $ward->name }}
																																				</option>
																																@endforeach
																												</select>

																												@error('ward')
																																<span class="invalid-feedback" role="alert">
																																				<strong>{{ $message }}</strong>
																																</span>
																												@enderror
																								</div>
																								<button type="submit" class="btn btn-primary">Admit to this ward</button>
																				</form>
																</div>
												</section>
								</section>
				</div>
@endsection
