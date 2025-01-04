@extends('layouts.doctor')

@section('page')
				<div class="container mt-5">
								<h1 class="mb-4">Add Medication</h1>
								<form method="POST" action="{{ route('doctor.medications.store') }}">
												@csrf
												<div class="mb-3">
																<label for="name" class="form-label">Medication Name:</label>
																<input type="text" class="form-control" id="name" name="name" required>
												</div>
												<div class="mb-3">
																<label for="active_ingredient" class="form-label">Active Ingredient:</label>
																<input type="text" class="form-control" id="active_ingredient" name="active_ingredient" required>
												</div>
												<div class="mb-3">
																<label for="trade_name" class="form-label">Trade Name:</label>
																<input type="text" class="form-control" id="trade_name" name="trade_name" required>
												</div>
												<div class="mb-3">
																<label for="strength" class="form-label">Strength:</label>
																<input type="text" class="form-control" id="strength" name="strength" required>
												</div>
												<div class="mb-3">
																<label for="form" class="form-label">Form:</label>
																<select class="form-select" id="form" name="form" required>
																				<option value="tabl">Tablet</option>
																				<option value="ampulle">Ampoule</option>
																				<option value="kapsel">Capsule</option>
																</select>
												</div>
												<div class="mb-3">
																<label for="amount_taken_morning" class="form-label">Amount Taken in the Morning:</label>
																<input type="number" class="form-control" id="amount_taken_morning" name="amount_taken_morning"
																				value="0" min="0" required>
												</div>
												<div class="mb-3">
																<label for="amount_taken_noon" class="form-label">Amount Taken at Noon:</label>
																<input type="number" class="form-control" id="amount_taken_noon" name="amount_taken_noon" value="0"
																				min="0" required>
												</div>
												<div class="mb-3">
																<label for="amount_taken_evening" class="form-label">Amount Taken in the Evening:</label>
																<input type="number" class="form-control" id="amount_taken_evening" name="amount_taken_evening"
																				value="0" min="0" required>
												</div>
												<div class="mb-3">
																<label for="amount_taken_night" class="form-label">Amount Taken at Night:</label>
																<input type="number" class="form-control" id="amount_taken_night" name="amount_taken_night" value="0"
																				min="0" required>
												</div>
												<div class="mb-3">
																<label for="maximum_amount_per_day" class="form-label">Maximum Amount Per Day:</label>
																<input type="number" class="form-control" id="maximum_amount_per_day" name="maximum_amount_per_day"
																				min="0">
												</div>
												<div class="mb-3">
																<label for="unit" class="form-label">Unit:</label>
																<input type="text" class="form-control" id="unit" name="unit" value="stuck" required>
												</div>
												<div class="mb-3">
																<label for="notes" class="form-label">Notes:</label>
																<textarea class="form-control" id="notes" name="notes" rows="3">During the meal</textarea>
												</div>
												<div class="mb-3">
																<label for="reason" class="form-label">Reason for Medication:</label>
																<textarea class="form-control" id="reason" name="reason" rows="3" required></textarea>
												</div>
												<button type="submit" class="btn btn-primary">Save</button>
								</form>
				</div>
@endsection
