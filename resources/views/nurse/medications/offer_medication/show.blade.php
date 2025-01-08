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
																<p><strong>Ward:</strong> {{ $patient->ward->name ?? 'N/A' }}</p>
												</div>
								</div>

								<div class="card mt-4">
												<div class="card-header">
																<h4>Patient Medications</h4>
												</div>
												@foreach($patient->medicationPlans as $medication_plan)
												<div class="card-body">
																<h5 class="card-title">{{ $medication_plan->name }}</h5>
																<p class="card-text"><strong>Description:</strong> {{ $medication_plan->description }}</p>

																<div class="table-responsive">
																				<table class="table table-striped table-hover">
																								<thead>
																												<tr>
																																<th>Name</th>
																																<th>Active Ingredient</th>
																																<th>Strength</th>
																																<th>Morning Dose</th>
																																<th>Noon Dose</th>
																																<th>Evening Dose</th>
																																<th>Night Dose</th>
																																<th>Actions</th>
																												</tr>
																								</thead>
																								<tbody>
																									{{$medication_plan}}
																												@foreach ($medication_plan->medications as $medication)
																																<tr>
																																				<td>{{ $medication->name }}</td>
																																				<td>{{ $medication->active_ingredient }}</td>
																																				<td>{{ $medication->strength }}</td>
																																				<td>{{ $medication->amount_taken_morning }}</td>
																																				<td>{{ $medication->amount_taken_noon }}</td>
																																				<td>{{ $medication->amount_taken_evening }}</td>
																																				<td>{{ $medication->amount_taken_night }}</td>
																																				<td>
																																								<!-- Edit Button triggers unique modal -->
																																								<button class="btn btn-warning btn-sm" data-toggle="modal"
																																												data-target="#editMedicationModal-{{ $medication->id }}">
																																												Update Medication
																																								</button>
																																				</td>
																																</tr>

																																<!-- Medication Modal for Each Medication -->
																																<div class="modal fade" id="editMedicationModal-{{ $medication->id }}" tabindex="-1"
																																				role="dialog" aria-labelledby="editMedicationModalLabel-{{ $medication->id }}"
																																				aria-hidden="true">
																																				<div class="modal-dialog" role="document">
																																								<div class="modal-content">
																																												<div class="modal-header">
																																																<h5 class="modal-title">Edit Medication for {{ $medication->name }}</h5>
																																																<button type="button" class="close" data-dismiss="modal"
																																																				aria-label="Close">
																																																				<span aria-hidden="true">&times;</span>
																																																</button>
																																												</div>
																																												<form
																																																action="{{ route('nurse.patients.offer-medications', ['patient_id' => $patient->id, 'medication_id' => $medication->id]) }}"
																																																method="POST">
																																																@csrf
																																																@method('PUT')
																																																<div class="modal-body">
																																																				<input type="hidden" name="id" value="{{ $medication->id }}">

																																																				<div class="form-group d-none">
																																																								<input type="text" class="form-control"
																																																												value="{{ $medication->id }}" name="medication_id" readonly>
																																																				</div>

																																																				<div class="form-group">
																																																								<label>Medication Name</label>
																																																								<input type="text" class="form-control"
																																																												value="{{ $medication->name }}" name="name" readonly>
																																																				</div>

																																																				<div class="form-group">
																																																								<label>Medication Time</label>
																																																								<select name="dosage_time" class="form-control">
																																																												@foreach ($medication_amounts as $key => $medication_time)
																																																																<option value="{{ $key }}"
																																																																				{{ $key == 'morning' ? 'selected' : '' }}>
																																																																				{{ $medication_time }}
																																																																</option>
																																																												@endforeach
																																																								</select>
																																																				</div>

																																																				<div class="form-group">
																																																								<label>Dosage Amount</label>
																																																								<input type="number" class="form-control" name="dosage_amount"
																																																												value="{{ $medication->amount_taken_morning }}">
																																																				</div>
																																																</div>
																																																<div class="modal-footer">
																																																				<button type="button" class="btn btn-secondary"
																																																								data-dismiss="modal">Close</button>
																																																				<button type="submit" class="btn btn-primary">Save Changes</button>
																																																</div>
																																												</form>
																																								</div>
																																				</div>
																																</div>
																												@endforeach

																								</tbody>
																				</table>
																</div>
												</div>
												@endforeach
												<hr>
								</div>

								<div class="mt-4">
												<a href="{{ route('nurse.patients.index') }}" class="btn btn-secondary">Back to List</a>
								</div>
				</div>
@endsection
