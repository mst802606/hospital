@extends('layouts.nurse')

@section('page')
				<div class="container">

								<h1 class="mb-4">Patient Details</h1>

								<div class="card">
												<div class="card-header">
																<h5>Patient Information</h5>
																@if (count($patient->medicationPlans) > 0)
																				<a class="btn btn-outline-info rounded float-right"
																								href="/nurse/offer-medication/show/{{ $patient->id }}">Offer medication</a>
																@endif
												</div>
												<div class="card-body">
																<div class="row">
																				<div class="col-md col-xl col-lg">
																								<p><strong>Patient ID:</strong> {{ $patient->id }}</p>
																								<p><strong>User Name:</strong> {{ $patient->user->username ?? 'N/A' }}</p>
																								<p><strong>Hospital:</strong> {{ $patient->hospital->name ?? 'N/A' }}</p>
																								<p><strong>Date of Birth:</strong> {{ $patient->date_of_birth ?? 'N/A' }}</p>
																								<p><strong>Admitted:</strong> {{ $patient->admitted ? 'Yes' : 'No' }}</p>
																								<p><strong>Ward:</strong> {{ $patient->ward->name ?? 'N/A' }}</p>
																								<p><strong>Status:</strong> {{ $patient->status ? 'Active' : 'Inactive' }}</p>
																				</div>
																				<div class="col-md col-xl col-lg">
																								<h4>Medication History</h4>
																								<div class="col-md col-xl col-lg">
																												@if (count($patient->medications) > 0)
																																@foreach ($patient->medications as $medication)
																																				@if (!$medication->pivot->is_patient_served)
																																								<p>Medication not given because of
																																												{{ $medication->pivot->medication_reason ?? $medication->pivot->other_reason }}
																																								</p>
																																				@else
																																								<p>Patient served at
																																												{{ $medication->pivot->last_given ?? $medication->pivot->updated_at }}
																																								</p>
																																				@endif
																																@endforeach
																												@else
																																N/A
																												@endif
																								</div>

																				</div>

																</div>
												</div>


								</div>
								<div class="card">
												<div class="card-header">
																Patient Notes
												</div>
												<div class="card-body">
																@foreach ($patient->notes as $note)
																				<h5 class="card-title">Notable Type: {{ $note->notable_type }}</h5>
																				<p><strong>Notable ID:</strong> {{ $note->notable_id }}</p>
																				<p><strong>Ward:</strong> {{ $note->ward ? $note->ward->name : 'N/A' }}</p>
																				<p><strong>Note:</strong></p>
																				<p>{{ $note->note }}</p>
																				<p><strong>Status:</strong> {{ $note->is_active ? 'Active' : 'Inactive' }}</p>
																				<p><strong>Created At:</strong> {{ $note->created_at->format('Y-m-d H:i') }}</p>
																				<p><strong>Updated At:</strong> {{ $note->updated_at->format('Y-m-d H:i') }}</p>

																				<a href="{{ route('nurse.notes.index') }}" class="btn btn-primary">Back to Notes</a>
																				<a href="{{ route('nurse.notes.edit', $note->id) }}" class="btn btn-warning">Edit Note</a>
																@endforeach
												</div>
								</div>

								<div class="mt-4">
												<a href="{{ route('nurse.patients.index') }}" class="btn btn-secondary">Back to List</a>
								</div>
				</div>
@endsection
