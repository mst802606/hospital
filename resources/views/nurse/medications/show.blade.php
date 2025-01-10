@extends('layouts.nurse')

@section('page')
				<div class="container mt-5">
								<h1 class="mb-4">Medication Details</h1>
								<div class="card">
												<div class="card-header">
																<h2>{{ $medication->name }}</h2>
												</div>
												<div class="card-body">
																<p><strong>Active Ingredient:</strong> {{ $medication->active_ingredient }}</p>
																<p><strong>Trade Name:</strong> {{ $medication->trade_name }}</p>
																<p><strong>Strength:</strong> {{ $medication->strength }}</p>
																<p><strong>Form:</strong> {{ ucfirst($medication->form) }}</p>
																<p><strong>Amount Taken - Morning:</strong> {{ $medication->amount_taken_morning }}</p>
																<p><strong>Amount Taken - Noon:</strong> {{ $medication->amount_taken_noon }}</p>
																<p><strong>Amount Taken - Evening:</strong> {{ $medication->amount_taken_evening }}</p>
																<p><strong>Amount Taken - Night:</strong> {{ $medication->amount_taken_night }}</p>
																<p><strong>Maximum Amount Per Day:</strong> {{ $medication->maximum_amount_per_day ?? 'N/A' }}</p>
																<p><strong>Unit:</strong> {{ $medication->unit }}</p>
																<p><strong>Duration:</strong> {{ $medication->duration ?? 'N/A' }}</p>
																<p><strong>Notes:</strong> {{ $medication->notes }}</p>
																<p><strong>Reason:</strong> {{ $medication->reason }}</p>
												</div>
												<div class="card-footer">
																{{--  <a href="{{ route('nurse.medications.edit', $medication) }}" class="btn btn-warning">Edit</a>  --}}
																<a href="{{ route('nurse.medications.index') }}" class="btn btn-secondary">Back to List</a>
												</div>
								</div>
				</div>
@endsection
