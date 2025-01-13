<!-- resources/views/notes/show.blade.php -->

@extends('layouts.nurse')

@section('page')
				<h1>Note Details</h1>

				<div class="card">
								<div class="card-header">
												Note #{{ $note->id }}
								</div>
								<div class="card-body">
												<h5 class="card-title">Notable Type: {{ $note->notable_type }}</h5>
												<p><strong>Notable ID:</strong> {{ $note->notable_id }}</p>
												<p><strong>Ward:</strong> {{ $note->ward ? $note->ward->name : 'N/A' }}</p>
												<p><strong>Note:</strong></p>
												<p>{{ $note->note }}</p>
												<p><strong>Status:</strong> {{ $note->is_active ? 'Active' : 'Inactive' }}</p>
												<p><strong>Created At:</strong> {{ $note->created_at->format('Y-m-d H:i') }}</p>
												<p><strong>Updated At:</strong> {{ $note->updated_at->format('Y-m-d H:i') }}</p>

												<a href="{{ route('nurse.notes.index') }}" class="btn btn-primary">Back to Notes</a>
												<a href="{{ route('nurse.notes.edit', $note->id) }}" class="btn btn-warning">Edit Note</a>
								</div>
				</div>
@endsection
