@extends('layouts.nurse')

@section('page')
				<div class="container">
								<h1 class="mb-4">Patient Details</h1>

								<div class="card">
												<div class="card-header">
																<h5>Patient Information</h5>
												</div>
												<div class="card-body">
																<p><strong>Patient ID:</strong> {{ $patient->id }}</p>
																<p><strong>User Name:</strong> {{ $patient->user->username ?? 'N/A' }}</p>
																<p><strong>Hospital:</strong> {{ $patient->hospital->name ?? 'N/A' }}</p>
																<p><strong>Date of Birth:</strong> {{ $patient->date_of_birth ?? 'N/A' }}</p>
																<p><strong>Admitted:</strong> {{ $patient->admitted ? 'Yes' : 'No' }}</p>
																<p><strong>Ward:</strong> {{ $patient->ward->name ?? 'N/A' }}</p>
																<p><strong>Status:</strong> {{ $patient->status ? 'Active' : 'Inactive' }}</p>
												</div>
												<div class="card">
																<div class="card-header">
																				<h4>Patient medications</h4>
																</div>
																<div class="card-body">
																				<div class="table-responsive">
																								<table class="table table-bordered table-striped">
																												<thead class="table-dark">
																																<tr>
																																				<th>Name</th>
																																				<th>Description</th>
																																				<th>Start Date</th>
																																				<th>Start Time</th>
																																				<th>Is Active</th>
																																				<th>Actions</th>
																																</tr>
																												</thead>
																												<tbody>
																																@foreach ($patient->medicationPlans as $plan)
																																				<tr>
																																								<td>{{ $plan->name }}</td>
																																								<td>{{ $plan->description }}</td>
																																								<td>{{ $plan->start_date }}</td>
																																								<td>{{ $plan->start_time }}</td>
																																								<td>{{ $plan->is_active ? 'Yes' : 'No' }}</td>
																																								<td>
																																												<a href="{{ route('nurse.medication_plans.show', $plan) }}"
																																																class="btn btn-info btn-sm">View</a>
																																												<a href="{{ route('nurse.medication_plans.edit', $plan) }}"
																																																class="btn btn-warning btn-sm">Edit</a>
																																								</td>
																																				</tr>
																																@endforeach
																												</tbody>
																								</table>
																				</div>
																</div>
												</div>
								</div>

								<div class="mt-4">
												<a href="{{ route('nurse.patients.index') }}" class="btn btn-secondary">Back to List</a>
								</div>
				</div>
@endsection
