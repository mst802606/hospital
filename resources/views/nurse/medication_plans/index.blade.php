@extends('layouts.nurse')

@section('page')
				<div class="container mt-5">
								<h1 class="mb-4">Medication Plans</h1>
								<a href="{{ route('doctor.medication_plans.create') }}" class="btn btn-primary mb-3">Add Plan</a>
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
																				@foreach ($plans as $plan)
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
@endsection
