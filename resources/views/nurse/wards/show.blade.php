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
																																																<td> <a href="{{ route('nurse.patients.index') }}"><span
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
