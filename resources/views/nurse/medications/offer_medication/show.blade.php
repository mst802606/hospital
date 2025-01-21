@extends('layouts.nurse')

@section('page')
				<div class="container">
								<h1 class="mb-4">Patient Details</h1>

								<div class="card">
												<div class="card-header">
																<h5>Patient Information</h5>
												</div>
												<div class="card-body">
																<div class="row">
																				<div class="col-md col-xl col-lg">
																								<p><strong>Patient ID:</strong> {{ $patient->id }}</p>
																								<p><strong>User Name:</strong> {{ $patient->user->username ?? 'N/A' }}</p>
																								<p><strong>Hospital:</strong> {{ $patient->hospital->name ?? 'N/A' }}</p>
																								<p><strong>Date of Birth:</strong> {{ $patient->date_of_birth ?? 'N/A' }}</p>
																								<p><strong>Ward:</strong> {{ $patient->ward->name ?? 'N/A' }}</p>
																				</div>
																				<div class="col-md col-xl col-lg">
																								<h4>Medication History</h4>
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

								<div class="card mt-4">
												<div class="card-header">
																<h4>Patient Medications</h4>
												</div>
												@foreach ($patient->medicationPlans as $medication_plan)
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
																																																				<h5 class="modal-title">Edit Medication for {{ $medication->name }}
																																																				</h5>
																																																				<button type="button" class="close" data-dismiss="modal"
																																																								aria-label="Close">
																																																								<span aria-hidden="true">&times;</span>
																																																				</button>
																																																</div>
																																																<div class="row modal-body">
																																																				<div class="col-md col-xl col-lg">
																																																								<h4>Medication confirmation form</h4>

																																																								<form
																																																												action="{{ route('nurse.patients.offer-medications', ['patient_id' => $patient->id, 'medication_id' => $medication->id]) }}"
																																																												method="POST">
																																																												@csrf
																																																												@method('PUT')

																																																												<div class="modal-body">
																																																																<div class="d-none" id="medication-offered-section">
																																																																				<input type="hidden" name="id"
																																																																								value="{{ $medication->id }}">

																																																																				<div class="form-group d-none">
																																																																								<input type="text" class="form-control"
																																																																												value="{{ $medication->id }}"
																																																																												name="medication_id" readonly>
																																																																				</div>

																																																																				<div class="form-group">
																																																																								<label>Medication Name</label>
																																																																								<input type="text" class="form-control"
																																																																												value="{{ $medication->name }}" name="name"
																																																																												readonly>
																																																																				</div>
																																																																				<div class="form-group">
																																																																								<label>Medication Time</label>
																																																																								@php
																																																																												$selected_dosage_time = 'amount_taken_noon'; // default value
																																																																								@endphp
																																																																								<select name="dosage_time" class="form-control"
																																																																												id="dosage_time_select">
																																																																												@foreach ($medication_amounts as $key => $medication_time)
																																																																																<option value="{{ $key }}"
																																																																																				{{ $key == $selected_dosage_time ? 'selected' : '' }}>
																																																																																				{{ $medication_time }}
																																																																																</option>
																																																																												@endforeach
																																																																								</select>
																																																																				</div>

																																																																				<div class="form-group">
																																																																								<label>Dosage Amount</label>
																																																																								<input type="number" class="form-control"
																																																																												name="dosage_amount" id="dosage_amount"
																																																																												value="{{ $medication[$selected_dosage_time] }}">
																																																																				</div>
																																																																</div>
																																																												</div>


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
																																																																																name="is_patient_served"
																																																																																{{ old('is_patient_served') ? 'checked' : '' }}>
																																																																								</div>
																																																																								<div class="card-body"><label
																																																																																for="is_patient_not_served"
																																																																																class="form-label mx-2">No.</label>
																																																																												<input type="checkbox" value="0"
																																																																																id="is_patient_not_served"
																																																																																class="checkbox form-checkbox"
																																																																																name="is_patient_served"
																																																																																{{ old('is_patient_served') ? 'checked' : '' }}>
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
																																																																																name="medication_reason"
																																																																																id="reason_nausea" value="nausea"
																																																																																{{ old('medication_reason') == 'nausea' ? 'checked' : '' }}>
																																																																												<label class="form-check-label"
																																																																																for="reason_nausea">Nausea</label>
																																																																								</div>

																																																																								<div class="form-check">
																																																																												<input class="form-check-input" type="radio"
																																																																																name="medication_reason"
																																																																																id="reason_refusal" value="refusal"
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
																																																																								medicationOfferedSection.classList.remove('d-none');

																																																																				} else {

																																																																								medicationOfferedSection.classList.add('d-none');
																																																																								reasonSection.classList.remove('d-none'); // Show reason section
																																																																				}
																																																																});

																																																																// JavaScript to toggle the reason section based on the checkbox state
																																																																document.getElementById('is_patient_not_served').addEventListener('change', function() {
																																																																				const reasonSection = document.getElementById('reason-section');
																																																																				const medicationOfferedSection = document.getElementById('medication-offered-section');
																																																																				document.getElementById('is_patient_served').checked = false;
																																																																				if (this.checked) {

																																																																								medicationOfferedSection.classList.add('d-none');
																																																																								reasonSection.classList.remove('d-none'); // Show reason section

																																																																				} else {
																																																																								medicationOfferedSection.classList.remove('d-none');
																																																																								reasonSection.classList.add('d-none'); // Hide reason section
																																																																				}
																																																																});
																																																												</script>
																																																								</form>

																																																				</div>
																																																</div>
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
				<script>
								// Event listener for the change event on the dosage_time dropdown
								document.getElementById('dosage_time_select').addEventListener('change', function() {
												var selectedDosageTime = this.value; // Get selected value (key)

												if (selectedDosageTime) {

																// Update the dosage amount based on the selected dosage time
																// Example: Assuming $medication is a PHP array where the key is the dosage time
																var dosageAmount = null
																dosageAmount = @json($medication) ?? null; // Converting PHP array to JavaScript object

																// If the selected dosage time exists in the $medication array, update the input value
																if (dosageAmount[selectedDosageTime]) {
																				document.getElementById('dosage_amount').value = dosageAmount[selectedDosageTime];
																}
												}

								});
				</script>
@endsection
