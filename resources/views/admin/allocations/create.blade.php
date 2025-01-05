@extends('layouts.admin')

@section('page')
				<h1>Allocate Medication Plan</h1>
				<form method="POST" action="{{ route('admin.allocations.store') }}" class="form-group">
								@csrf

								<div class="mb-3">
												<label for="patient_id" class="form-label">Patient:</label>
												<select name="patient_id" id="patient_id" class="form-select">
																@foreach ($patients as $patient)
																				<option value="{{ $patient->id }}">{{ $patient->user->username }}</option>
																@endforeach
												</select>
								</div>

								<div class="mb-3">
												<label for="doctor_id" class="form-label">Doctor:</label>
												<select name="doctor_id" id="doctor_id" class="form-select">
																@foreach ($doctors as $doctor)
																				<option value="{{ $doctor->id }}">{{ $doctor->tag }} {{ $doctor->user->username }}</option>
																@endforeach
												</select>
								</div>

								<div class="mb-3">
												<label for="plan_id" class="form-label">Medication Plan:</label>
												<select name="plan_id" id="plan_id" class="form-select">
																@foreach ($plans as $plan)
																				<option value="{{ $plan->id }}">{{ $plan->name }}</option>
																@endforeach
												</select>
								</div>

								<div class="mb-3">
												<label for="recommendation_notes" class="form-label">Notes:</label>
												<textarea name="recommendation_notes" id="recommendation_notes" class="form-control" rows="4"></textarea>
								</div>

								<button type="submit" class="btn btn-primary">Allocate Plan</button>
				</form>
@endsection
