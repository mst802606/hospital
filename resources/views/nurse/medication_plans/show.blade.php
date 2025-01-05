@extends('layouts.nurse')

@section('page')
				<div class="container mt-5">
								<h1 class="mb-4">Medication Plan Details</h1>
								<div class="card">
												<div class="card-body">
																<h5 class="card-title">{{ $plan->name }}</h5>
																<p class="card-text"><strong>Description:</strong> {{ $plan->description }}</p>
																<p class="card-text"><strong>Start Date:</strong> {{ $plan->start_date }}</p>
																<p class="card-text"><strong>Start Time:</strong> {{ $plan->start_time }}</p>
																<p class="card-text"><strong>Active:</strong> {{ $plan->is_active ? 'Yes' : 'No' }}</p>
																<a href="{{ route('nurse.medication_plans.index') }}" class="btn btn-secondary">Back to List</a>
												</div>
								</div>
								<div class="card">
												<div class="card-header">
																<h4>Medications</h4>
												</div>
												<div class="card-body">
																<div class="table-responsive">
																				<table class="table table-striped table-hover">
																								<thead>
																												<tr>
																																<th>Name</th>
																																<th>Active Ingredient</th>
																																<th>Trade Name</th>
																																<th>Strength</th>
																																<th>Form</th>
																																<th>Morning Dose</th>
																																<th>Noon Dose</th>
																																<th>Evening Dose</th>
																																<th>Night Dose</th>
																																<th>Max Daily Dose</th>
																																<th>Unit</th>
																																<th>Duration</th>
																																<th>Notes</th>
																																<th>Reason</th>
																																<th>Actions</th>
																												</tr>
																								</thead>
																								<tbody>
																												@foreach ($medications as $medication)
																																<tr>
																																				<td>{{ $medication->name }}</td>
																																				<td>{{ $medication->active_ingredient }}</td>
																																				<td>{{ $medication->trade_name }}</td>
																																				<td>{{ $medication->strength }}</td>
																																				<td>{{ ucfirst($medication->form) }}</td>
																																				<td>{{ $medication->amount_taken_morning }}</td>
																																				<td>{{ $medication->amount_taken_noon }}</td>
																																				<td>{{ $medication->amount_taken_evening }}</td>
																																				<td>{{ $medication->amount_taken_night }}</td>
																																				<td>{{ $medication->maximum_amount_per_day ?? 'N/A' }}</td>
																																				<td>{{ $medication->unit }}</td>
																																				<td>{{ $medication->duration ?? 'N/A' }}</td>
																																				<td>{{ $medication->notes }}</td>
																																				<td>{{ $medication->reason }}</td>
																																				<td>
																																								<a href="{{ route('doctor.medications.show', $medication) }}"
																																												class="btn btn-info btn-sm">View</a>
																																								<a href="{{ route('doctor.medications.edit', $medication) }}"
																																												class="btn btn-warning btn-sm">Edit</a>
																																								<form action="{{ route('doctor.medications.destroy', $medication) }}"
																																												method="POST" class="d-inline">
																																												@csrf
																																												@method('DELETE')
																																												<button type="submit" class="btn btn-danger btn-sm"
																																																onclick="return confirm('Are you sure you want to delete this medication?')">Delete</button>
																																								</form>
																																				</td>
																																</tr>
																												@endforeach
																								</tbody>
																				</table>
																</div>
												</div>
								</div>
				</div>
@endsection
