@extends('layouts.nurse')

@section('page')
				<div class="container">
								<h1 class="mb-4">Patients List</h1>
								<!-- Search Form -->
								<div class="mb-4">
												<form action="{{ route('nurse.patients.search') }}" method="GET" class="form-inline">
																<input type="text" name="search" class="form-control mr-2" placeholder="Search by Name or ID"
																				value="{{ request('search') }}">
																<button type="submit" class="btn btn-primary">Search</button>
												</form>
								</div>
								<div class="card">
												<div class="card-header">
																<h5>All Patients</h5>
												</div>
												<div class="card-body">
																<table class="table table-bordered table-striped">
																				<thead>
																								<tr>
																												<th>#</th>
																												<th>Name</th>
																												<th>Ward</th>
																												<th>Plans</th>
																												<th>Medication due at</th>
																												<th>Medication</th>
																												<th>History</th>
																												<th>Notes</th>
																												<th>Actions</th>
																								</tr>
																				</thead>
																				<tbody>
																								@forelse($patients as $patient)
																												<tr>
																																<td>{{ $patient->id }}</td>
																																<td>{{ $patient->user->username ?? 'N/A' }}</td>
																																<td>{{ $patient->ward->name ?? 'N/A' }}</td>
																																<td>
																																				@forelse ($patient->medicationPlans as $plan)
																																								<ax
																																												href="{{ route('nurse.medication_plans.show', ['medication_plan' => $plan->id]) }}">
																																												<span class="badge badge-success">
																																																{{ $plan->name }}
																																												</span>
																																												</a>
																																								@empty
																																												N/A
																																				@endforelse
																																</td>
																																<td>{{ $patient->medication_required_at ?? 'N/A' }}</td>
																																<td>
																																				@if (count($patient->medicationPlans) > 0)
																																								<div class="card-body">
																																												<a class="btn btn-outline-info btn-sm rounded"
																																																href="/nurse/offer-medication/show/{{ $patient->id }}">Offer mediation</a>
																																								</div>
																																				@else
																																								N/A
																																				@endif
																																</td>
																																<td>
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

																																</td>
																																<td>

																																				@if (count($patient->notes) > 0)
																																								<a class="btn btn-outline-info rounded"
																																												href="{{ route('nurse.notes.patient-notes', ['patient' => $patient]) }}">
																																												<i class="fa fa-eye"></i>View {{ count($patient->notes) }} Notes
																																								</a>
																																				@else
																																								N/A
																																				@endif

																																</td>
																																<td>
																																				<a href="{{ route('nurse.patients.show', $patient->id) }}"
																																								class="btn btn-primary btn-sm">View</a>

																																</td>
																												</tr>
																								@empty
																												<tr>
																																<td colspan="7" class="text-center">No patients found</td>
																												</tr>
																								@endforelse
																				</tbody>
																</table>
												</div>
								</div>
				</div>
@endsection
