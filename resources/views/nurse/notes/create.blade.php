<!-- resources/views/notes/create.blade.php -->

@extends('layouts.nurse')

@section('page')
				<h1>Create New Note</h1>
				<form action="{{ route('nurse.notes.store') }}" method="POST">
								@csrf


								{{--  <div class="form-group">
												<label for="ward_id">Ward</label>
												<select name="ward_id" id="ward_id" class="form-control">
																<option value="">Select Ward</option>
																@foreach ($wards as $ward)
																				<option value="{{ $ward->id }}">{{ $ward->name }}</option>
																@endforeach
												</select>
								</div>  --}}

								<div class="form-group">
												<label for="patient_id">Patient</label>
												<select name="patient_id" id="patient_id" class="form-control">
																<option value="" disabled>Select Patient</option>
																@foreach ($patients as $patient)
																				<option value="{{ $patient->id }}">{{ $patient->user->username }}</option>
																@endforeach
												</select>
								</div>

								<div class="form-group">
												<label for="note">Note</label>
												<textarea name="note" class="form-control" id="note" rows="5" required></textarea>
								</div>

								<div class="form-group">
												<label for="is_active">Active</label>
												<input type="checkbox" name="is_active" id="is_active" value="1" checked>
								</div>

								<button type="submit" class="btn btn-success">Save Note</button>
				</form>
@endsection
