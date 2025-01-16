<!-- resources/views/notes/index.blade.php -->

@extends('layouts.nurse')

@section('page')
				<h1>Notes</h1>
				<a href="{{ route('nurse.notes.create') }}" class="btn btn-primary">Create New Note</a>
				<table class="table mt-3">
								<thead>
												<tr>
																<th>#</th>
																<th>Patient</th>
																<th>Ward</th>
																<th>Note</th>
																<th>Active</th>
																<th>Created</th>
																<th>Actions</th>
												</tr>
								</thead>
								<tbody>
												@foreach ($notes as $note)
																<tr>
																				<td>{{ $note->id }}</td>
																				<td>{{ $note->patient->user->username ?? 'N/A' }}</td>
																				<td>{{ $note->ward->name ?? 'N/A' }}</td>
																				<td>{{ Str::limit($note->note, 50) }}</td>
																				<td>{{ $note->is_active ? 'Yes' : 'No' }}</td>
																				<td>{{ $note->created_at->diffForHumans() }}</td>
																				<td>
																								<a href="{{ route('nurse.notes.show', $note->id) }}" class="btn btn-info">Show</a>
																								<a href="{{ route('nurse.notes.edit', $note->id) }}" class="btn btn-warning">Edit</a>

																								<!-- Delete Button -->
																								<form action="{{ route('nurse.notes.destroy', $note->id) }}" method="POST" style="display: inline;">
																												@csrf
																												@method('DELETE')
																												<button type="submit" class="btn btn-danger"
																																onclick="return confirm('Are you sure you want to delete this note?')">Delete</button>
																								</form>
																				</td>
																</tr>
												@endforeach
								</tbody>
				</table>
@endsection
