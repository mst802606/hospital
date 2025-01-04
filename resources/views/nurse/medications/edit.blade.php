@extends('layouts.doctor')

@section('page')
				<div class="container mt-5">
								<h1 class="mb-4">Edit Medication</h1>
								<form method="POST" action="{{ route('doctor.medications.update', $medication) }}">
												@csrf
												@method('PUT')
												<div class="mb-3">
																<label for="name" class="form-label">Name:</label>
																<input type="text" class="form-control" id="name" name="name"
																				value="{{ old('name', $medication->name) }}" required>
												</div>
												<div class="mb-3">
																<label for="active_ingredient" class="form-label">Active Ingredient:</label>
																<input type="text" class="form-control" id="active_ingredient" name="active_ingredient"
																				value="{{ old('active_ingredient', $medication->active_ingredient) }}" required>
												</div>
												<div class="mb-3">
																<label for="trade_name" class="form-label">Trade Name:</label>
																<input type="text" class="form-control" id="trade_name" name="trade_name"
																				value="{{ old('trade_name', $medication->trade_name) }}" required>
												</div>
												<div class="mb-3">
																<label for="strength" class="form-label">Strength:</label>
																<input type="text" class="form-control" id="strength" name="strength"
																				value="{{ old('strength', $medication->strength) }}" required>
												</div>
												<div class="mb-3">
																<label for="form" class="form-label">Form:</label>
																<select class="form-select" id="form" name="form" required>
																				<option value="tabl" {{ old('form', $medication->form) == 'tabl' ? 'selected' : '' }}>Tablet</option>
																				<option value="ampulle" {{ old('form', $medication->form) == 'ampulle' ? 'selected' : '' }}>Ampoule
																				</option>
																				<option value="kapsel" {{ old('form', $medication->form) == 'kapsel' ? 'selected' : '' }}>Capsule
																				</option>
																</select>
												</div>
												<div class="mb-3">
																<label for="amount_taken_morning" class="form-label">Amount Taken - Morning:</label>
																<input type="number" class="form-control" id="amount_taken_morning" name="amount_taken_morning"
																				value="{{ old('amount_taken_morning', $medication->amount_taken_morning) }}" required>
												</div>
												<div class="mb-3">
																<label for="amount_taken_noon" class="form-label">Amount Taken - Noon:</label>
																<input type="number" class="form-control" id="amount_taken_noon" name="amount_taken_noon"
																				value="{{ old('amount_taken_noon', $medication->amount_taken_noon) }}" required>
												</div>
												<div class="mb-3">
																<label for="amount_taken_evening" class="form-label">Amount Taken - Evening:</label>
																<input type="number" class="form-control" id="amount_taken_evening" name="amount_taken_evening"
																				value="{{ old('amount_taken_evening', $medication->amount_taken_evening) }}" required>
												</div>
												<div class="mb-3">
																<label for="amount_taken_night" class="form-label">Amount Taken - Night:</label>
																<input type="number" class="form-control" id="amount_taken_night" name="amount_taken_night"
																				value="{{ old('amount_taken_night', $medication->amount_taken_night) }}" required>
												</div>
												<div class="mb-3">
																<label for="maximum_amount_per_day" class="form-label">Maximum Amount Per Day:</label>
																<input type="number" class="form-control" id="maximum_amount_per_day" name="maximum_amount_per_day"
																				value="{{ old('maximum_amount_per_day', $medication->maximum_amount_per_day) }}">
												</div>
												<div class="mb-3">
																<label for="unit" class="form-label">Unit:</label>
																<input type="text" class="form-control" id="unit" name="unit"
																				value="{{ old('unit', $medication->unit) }}" required>
												</div>
												<div class="mb-3">
																<label for="duration" class="form-label">Duration:</label>
																<input type="text" class="form-control" id="duration" name="duration"
																				value="{{ old('duration', $medication->duration) }}">
												</div>
												<div class="mb-3">
																<label for="notes" class="form-label">Notes:</label>
																<textarea class="form-control" id="notes" name="notes" rows="3">{{ old('notes', $medication->notes) }}</textarea>
												</div>
												<div class="mb-3">
																<label for="reason" class="form-label">Reason:</label>
																<textarea class="form-control" id="reason" name="reason" rows="3" required>{{ old('reason', $medication->reason) }}</textarea>
												</div>
												<button type="submit" class="btn btn-primary">Update</button>
												<a href="{{ route('doctor.medications.index') }}" class="btn btn-secondary">Cancel</a>
								</form>
				</div>
@endsection
