@extends('layouts.doctor')

@section('page')
				<h1>Allocate Medication Plan</h1>
				<form method="POST" action="{{ route('doctor.allocations.store') }}" class="form-group">
								@csrf

								<div class="mb-3">
												<label for="patient_id" class="form-label">Patient:</label>
												<select name="patient_id" id="patient_id" class="form-select">
																@foreach ($patients as $patient)
																				<option value="{{ $patient->id }}">{{ $patient->user->username }}</option>
																@endforeach
												</select>
												@error('patient_id')
																<span class="invalid-feedback" role="alert">
																				<strong>{{ $message }}</strong>
																</span>
												@enderror
								</div>

								<div class="mb-3">
												<label for="plan_id" class="form-label">Medication Plan: <a
																				href="{{ route('doctor.medication_plans.create') }}">Or create
																				one</a></label>
												<select name="plan_id" id="plan_id" class="form-select">
																@foreach ($plans as $plan)
																				<option value="{{ $plan->id }}">{{ $plan->name }}</option>
																@endforeach
												</select>
												@error('plan_id')
																<span class="invalid-feedback" role="alert">
																				<strong>{{ $message }}</strong>
																</span>
												@enderror
								</div>

								<div class="mb-3">
												<label for="recommendation_notes" class="form-label">Notes:</label>
												<textarea name="recommendation_notes" id="recommendation_notes" class="form-control" rows="4"></textarea>
												@error('recommendation_notes')
																<span class="invalid-feedback" role="alert">
																				<strong>{{ $message }}</strong>
																</span>
												@enderror
								</div>


								@error('nurse_id')
												<span class="invalid-feedback" role="alert">
																<strong>{{ $message }}</strong>
												</span>
								@enderror

								@error('doctor_id')
												<span class="invalid-feedback" role="alert">
																<strong>{{ $message }}</strong>
												</span>
								@enderror

								<button type="submit" class="btn btn-primary">Allocate Plan</button>
				</form>
@endsection
