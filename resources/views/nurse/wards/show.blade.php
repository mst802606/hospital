@extends('layouts.nurse')
@section('page')
				<div class="container-fluid bg-light">
								<section>
												<!--ward header-->
												<div class="container-fluid mt-5">
																<a href="{{ route('nurse.wards.index') }}" class="btn btn-primary m-2">Back</a>
												</div>
												<!--ward item-->
												<section>
																<div class="container-fluid mt-4">
																				<!--ward item-->
																				<div class="col-md-6 col-xl-12 item">
																								<div class="row">
																												<p scope="col">id : {{ $ward->id }}</p>
																												<p scope="col">Name : {{ $ward->name }}</p>
																												<p scope="col">Capacity : {{ $ward->capacity }}</p>
																												<p scope="col">Description : {{ $ward->description }}</p>
																								</div>
																								<div class="card">
																												<div class="card-header">
																																<h4>Notes</h4>
																												</div>
																												<div class="card-body">
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
																																								@foreach ($ward->notes as $note)
																																												<tr>
																																																<td>{{ $note->id }}</td>
																																																<td>{{ $note->patient->user->username ?? 'N/A' }}</td>
																																																<td>{{ $note->ward->name ?? 'N/A' }}</td>
																																																<td>{{ Str::limit($note->note, 50) }}</td>
																																																<td>{{ $note->is_active ? 'Yes' : 'No' }}</td>
																																																<td>{{ $note->created_at->diffForHumans() }}</td>
																																																<td>
																																																				<a href="{{ route('nurse.notes.show', $note->id) }}"
																																																								class="btn btn-info">Show</a>
																																																				<a href="{{ route('nurse.notes.edit', $note->id) }}"
																																																								class="btn btn-warning">Edit</a>

																																																				<!-- Delete Button -->
																																																				<form action="{{ route('nurse.notes.destroy', $note->id) }}"
																																																								method="POST" style="display: inline;">
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
																												</div>
																												<div class="card-header">
																																<div class="container d-flex justify-content-between">
																																				<h4>Patients</h4>
																																</div>

																												</div>
																												<div class="card-body">

																																<table class="tile table table-bordered p-4 m-3 ">
																																				<thead>
																																								<tr>
																																												<th scope="col">ID</th>
																																												<th scope="col">Name</th>
																																												<th scope="col">Ward</th>
																																												<th scope="col">Action</th>
																																								</tr>
																																				</thead>
																																				<tbody>
																																								@forelse ($ward->patients  as $patient)
																																												<tr>
																																																<th scope="row">{{ $patient->id }}</th>
																																																<td>{{ $patient->user->username ?? 'N/A' }}</td>
																																																<td>{{ $ward->name ?? 'N/A' }}</td>
																																																<td> <a href="{{ route('nurse.patients.show', ['patient' => $patient]) }}"><span
																																																												class="badge badge-success">View</span></a></td>
																																												</tr>
																																								@empty
																																												<p>There are no patients admitted in this ward</p>
																																								@endforelse
																																				</tbody>
																																</table>
																												</div>

																								</div>

																				</div>
																</div>
												</section>
								</section>
				</div>
@endsection
