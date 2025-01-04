@extends('layouts.admin')

@section('page')
				<div class="container mt-5">
								<h1 class="mb-4">Edit Medication Plan</h1>
								<form method="POST" action="{{ route('admin.medication_plans.update', $plan->id) }}">
												@csrf
												@method('PUT')
												<div class="mb-3">
																<label for="name" class="form-label">Name:</label>
																<input type="text" class="form-control" id="name" name="name" value="{{ old('name', $plan->name) }}"
																				required>
												</div>
												<div class="mb-3">
																<label for="description" class="form-label">Description:</label>
																<textarea class="form-control" id="description" name="description" rows="3">{{ old('description', $plan->description) }}</textarea>
												</div>
												<div class="row">
																<div class="col-3">
																				<div class="form-group">
																								<label for="start_date">Start Date</label>
																								<input name="start_date" type="date"
																												class="form-control @error('start_date') is-invalid @enderror"
																												value="{{ old('start_date', $plan->start_date) }}">
																								@error('start_date')
																												<span class="invalid-feedback" role="alert">
																																<strong>{{ $message }}</strong>
																												</span>
																								@enderror
																				</div>
																</div>
																<div class="col-3">
																				<div class="form-group">
																								<label for="start_time">Start Time</label>
																								<input name="start_time" type="time"
																												class="form-control @error('start_time') is-invalid @enderror"
																												value="{{ old('start_time', $plan->start_time) }}">
																								@error('start_time')
																												<span class="invalid-feedback" role="alert">
																																<strong>{{ $message }}</strong>
																												</span>
																								@enderror
																				</div>
																</div>
												</div>
												<div class="mb-3">
																<label for="form" class="form-label">Select Medication</label>

																<a href="/admin/medications/create" class="form-label">Or Add medication</a>
																<select multiple class="form-select" id="form" name="form" required>
																				@foreach ($medications as $medication)
																								<option value="tabl" {{ old('form', $medication->name) == 'tabl' ? 'selected' : '' }}>
																												{{ $medication->name }}</option>
																				@endforeach

																</select>
												</div>
												<div class="form-group form-check mt-3">
																<input type="checkbox" class="form-check-input" id="is_active" name="is_active"
																				{{ old('is_active', $plan->is_active) ? 'checked' : '' }}>
																<label class="form-check-label" for="is_active">Is Active</label>
												</div>
												<button type="submit" class="btn btn-primary mt-3">Update</button>
								</form>
				</div>
@endsection
