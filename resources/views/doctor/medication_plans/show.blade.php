@extends('layouts.doctor')

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
																<a href="{{ route('doctor.medication_plans.edit', $plan->id) }}" class="btn btn-primary">Edit</a>
																<a href="{{ route('doctor.medication_plans.index') }}" class="btn btn-secondary">Back to List</a>
												</div>
								</div>
				</div>
@endsection
