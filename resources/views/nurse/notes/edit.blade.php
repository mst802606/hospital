<!-- resources/views/notes/edit.blade.php -->

@extends('layouts.nurse')

@section('page')
				<h1>Edit Note</h1>
				<form action="{{ route('nurse.notes.update', $note->id) }}" method="POST">
								@csrf
								@method('PUT')

								<div class="form-group">
												<label for="ward_id">Ward</label>
												<select name="ward_id" id="ward_id" class="form-control">
																<option value="">Select Ward</option>
																@foreach ($wards as $ward)
																				<option value="{{ $ward->id }}" {{ $note->ward_id == $ward->id ? 'selected' : '' }}>
																								{{ $ward->name }}</option>
																@endforeach
												</select>
								</div>

								<div class="form-group">
												<label for="note">Note</label>
												<textarea name="note" class="form-control" id="note" rows="5" required>{{ $note->note }}</textarea>
								</div>

								<div class="form-group">
												<label for="is_active">Active</label>
												<input type="checkbox" name="is_active" id="is_active" value="1" {{ $note->is_active ? 'checked' : '' }}>
								</div>

								<button type="submit" class="btn btn-success">Update Note</button>
				</form>
@endsection
