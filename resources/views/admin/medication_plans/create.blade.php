@extends('layouts.admin')

@section('page')
				<div class="container mt-5">
								<h1 class="mb-4">Add Medication Plan</h1>
								<form method="POST" action="{{ route('admin.medication_plans.store') }}">
												@csrf
												<div class="mb-3">
																<label for="name" class="form-label">Name:</label>
																<input type="text" class="form-control" id="name" name="name" required>
												</div>
												<div class="mb-3">
																<label for="description" class="form-label">Description:</label>
																<textarea class="form-control" id="description" name="description" rows="3"></textarea>
												</div>
												<div class="row">
																<div class="col-3">
																				<div class="form-group">
																								<label for="time">Start Date</label>
																								<div class="flatpickr @error('start_date') is-invalid @enderror">
																												<input name="start_date" value="{{ old('start_date') }}" type="date-local" class="form-control"
																																placeholder="Select Date.." data-input>
																												<!-- input is mandatory -->
																												<a class="input-button" title="toggle" data-toggle>
																																<i class="icon-calendar"></i>
																																<i class="icon-time"></i>
																												</a>

																												<a class="input-button" title="clear" data-clear>
																																<i class="icon-close"></i>
																												</a>
																								</div>
																								@error('date')
																												<span class="invalid-feedback" role="alert">
																																<strong>{{ $message }}</strong>
																												</span>
																								@enderror
																				</div>
																</div>
																<div class="col-3">
																				<div class="form-group">
																								<label for="time">Start Time</label>
																								<div class="flatpickr  @error('start_time') is-invalid @enderror">
																												<input name="start_time" type="time-local" value="{{ old('start_time') }}" class="form-control"
																																placeholder="Select time.." data-input>
																												<!-- input is mandatory -->
																												<a class="input-button" title="toggle" data-toggle>
																																<i class="icon-calendar"></i>
																																<i class="icon-time"></i>
																												</a>

																												<a class="input-button" title="clear" data-clear>
																																<i class="icon-close"></i>
																												</a>
																								</div>
																								@error('start_time')
																												<span class="invalid-feedback" role="alert">
																																<strong>{{ $message }}</strong>
																												</span>
																								@enderror
																				</div>
																</div>
																<div class="form-group ">
																				<p class="@error('start_date') is-invalid @enderror"> {{ old('start_date') }}</p>
																				@error('start_date')
																								<span class="invalid-feedback" role="alert">
																												<strong>{{ $message }}</strong>
																								</span>
																				@enderror
																</div>
												</div>
												<button type="submit" class="btn btn-primary">Save</button>
								</form>
				</div>
@endsection
