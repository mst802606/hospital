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
																												<th>Medication Update</th>
																												<th>Medication</th>
																												{{--  <th>Medication</th>  --}}
																												{{--  <th>History</th>  --}}
																												<th>Notes</th>
																												{{--  <th>Actions</th>  --}}
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
																																{{--  <td>
																																				@if (count($patient->medicationPlans) > 0)
																																								<div class="card-body">
																																												<a class="btn btn-outline-info btn-sm rounded"
																																																href="/nurse/offer-medication/show/{{ $patient->id }}">Offer mediation</a>
																																								</div>
																																				@else
																																								N/A
																																				@endif
																																</td>  --}}

																																<td>
																																				@if (count($patient->medications) > 0)
																																								@foreach ($patient->medications as $medication)																																												@if (!$medication->pivot->is_patient_served)
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
																																				@if (count($patient->medicationPlans) > 0)
																																								@if (!$patient->medication_given)
																																												<div class="col-md col-xl col-lg">
																																																<form
																																																				action="{{ route('nurse.medication_plans.offer-medications', ['patient' => $patient->id]) }}"
																																																				method="POST">
																																																				@csrf
																																																				@method('PUT')
																																																				<div class="card-body">
																																																								<div class="col-md col-xl col-lg">
																																																												<div class="form-row">
																																																																<h5>Has patient been offered medication?</h5>
																																																												</div>
																																																												<div class="form-row">
																																																																<div class="card-body">
																																																																				<label for="is_patient_served"
																																																																								class="form-label mx-2">Yes.</label>
																																																																				<input type="checkbox" value="1"
																																																																								id="is_patient_served"
																																																																								class="checkbox form-checkbox"
																																																																								name="is_patient_served">
																																																																</div>
																																																																<div class="card-body"><label for="is_patient_not_served"
																																																																								class="form-label mx-2">No.</label>
																																																																				<input checked type="checkbox" value="0"
																																																																								id="is_patient_not_served"
																																																																								class="checkbox form-checkbox"
																																																																								name="is_patient_served">
																																																																</div>
																																																																@error('is_patient_served')
																																																																				<div class="text-danger">{{ $message }}</div>
																																																																@enderror
																																																												</div>

																																																												<!-- This section will be shown when the medication is not offered -->
																																																												<div id="reason-section"
																																																																class="{{ old('is_patient_served') ? 'd-none' : '' }} mt-3">
																																																																<label class="form-label">If not, please specify the
																																																																				reason:</label>

																																																																<!-- Radio buttons to specify the reason -->
																																																																<div class="form-check">
																																																																				<input class="form-check-input" type="radio"
																																																																								name="medication_reason" id="reason_surgery"
																																																																								value="surgery"
																																																																								{{ old('medication_reason') == 'surgery' ? 'checked' : '' }}>
																																																																				<label class="form-check-label"
																																																																								for="reason_surgery">Surgery</label>
																																																																</div>

																																																																<div class="form-check">
																																																																				<input class="form-check-input" type="radio"
																																																																								name="medication_reason" id="reason_nausea"
																																																																								value="nausea"
																																																																								{{ old('medication_reason') == 'nausea' ? 'checked' : '' }}>
																																																																				<label class="form-check-label"
																																																																								for="reason_nausea">Nausea</label>
																																																																</div>

																																																																<div class="form-check">
																																																																				<input class="form-check-input" type="radio"
																																																																								name="medication_reason" id="reason_refusal"
																																																																								value="refusal"
																																																																								{{ old('medication_reason') == 'refusal' ? 'checked' : '' }}>
																																																																				<label class="form-check-label"
																																																																								for="reason_refusal">Refusal</label>
																																																																</div>

																																																																<!-- Free-text input area for any other reason -->
																																																																<div class="form-check">
																																																																				<input class="form-check-input" type="radio"
																																																																								name="medication_reason" id="reason_other"
																																																																								value="other"
																																																																								{{ old('medication_reason') == 'other' ? 'checked' : '' }}>
																																																																				<label class="form-check-label"
																																																																								for="reason_other">Other</label>
																																																																</div>

																																																																<textarea class="form-control mt-2" name="other_reason" id="other_reason" placeholder="Please specify..."
																																																																    rows="3">{{ old('other_reason') }}</textarea>

																																																																@error('medication_reason')
																																																																				<div class="text-danger">{{ $message }}</div>
																																																																@enderror
																																																																@error('other_reason')
																																																																				<div class="text-danger">{{ $message }}</div>
																																																																@enderror
																																																												</div>
																																																								</div>
																																																				</div>
																																																				<div class="modal-footer">
																																																								<button type="button" class="btn btn-secondary"
																																																												data-dismiss="modal">Close</button>
																																																								<button type="submit" class="btn btn-primary">Save
																																																				</div>

																																																				<script>
																																																								// JavaScript to toggle the reason section based on the checkbox state
																																																								document.getElementById('is_patient_served').addEventListener('change', function() {
																																																												const reasonSection = document.getElementById('reason-section');
																																																												const medicationOfferedSection = document.getElementById('medication-offered-section');

																																																												document.getElementById('is_patient_not_served').checked = false;
																																																												if (this.checked) {
																																																																reasonSection.classList.add('d-none'); // Hide reason section
																																																																// medicationOfferedSection.classList.remove('d-none');

																																																												} else {

																																																																// medicationOfferedSection.classList.add('d-none');
																																																																reasonSection.classList.remove('d-none'); // Show reason section
																																																												}
																																																								});

																																																								// JavaScript to toggle the reason section based on the checkbox state
																																																								document.getElementById('is_patient_not_served').addEventListener('change', function() {
																																																												const reasonSection = document.getElementById('reason-section');
																																																												const medicationOfferedSection = document.getElementById('medication-offered-section');
																																																												document.getElementById('is_patient_served').checked = false;
																																																												if (this.checked) {

																																																																// medicationOfferedSection.classList.add('d-none');
																																																																reasonSection.classList.remove('d-none'); // Show reason section

																																																												} else {
																																																																//  medicationOfferedSection.classList.remove('d-none');
																																																																reasonSection.classList.add('d-none'); // Hide reason section
																																																												}
																																																								});
																																																				</script>
																																																</form>

																																												</div>
																																								@else
																																												Patient served
																																								@endif
																																				@else
																																								Patient is not under medication
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
																																{{--  <td>
																																				<a href="{{ route('nurse.patients.show', $patient->id) }}"
																																								class="btn btn-primary btn-sm">View</a>

																																</td>  --}}
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
