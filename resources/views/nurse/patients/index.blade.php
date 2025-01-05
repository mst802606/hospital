@extends('layouts.nurse')

@section('page')
				<div class="container">
								<h1 class="mb-4">Patients List</h1>

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
																												<th>Hospital</th>
																												<th>Ward</th>
																												<th>Admitted</th>
																												<th>Status</th>
																												<th>Actions</th>
																								</tr>
																				</thead>
																				<tbody>
																								@forelse($patients as $patient)
																												<tr>
																																<td>{{ $patient->id }}</td>
																																<td>{{ $patient->user->username ?? 'N/A' }}</td>
																																<td>{{ $patient->hospital->name ?? 'N/A' }}</td>
																																<td>{{ $patient->ward->name ?? 'N/A' }}</td>
																																<td>{{ $patient->admitted ? 'Yes' : 'No' }}</td>
																																<td>{{ $patient->status ? 'Active' : 'Inactive' }}</td>
																																<td>
																																				<a href="{{ route('nurse.patients.show', $patient->id) }}"
																																								class="btn btn-primary btn-sm">View</a>
																																				<a href="{{ route('nurse.patients.edit', $patient->id) }}"
																																								class="btn btn-warning btn-sm">Edit</a>
																																				<form action="{{ route('nurse.patients.destroy', $patient->id) }}" method="POST"
																																								style="display:inline;">
																																								@csrf
																																								@method('DELETE')
																																								<button type="submit" class="btn btn-danger btn-sm"
																																												onclick="return confirm('Are you sure?')">Delete</button>
																																				</form>
																																</td>
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
