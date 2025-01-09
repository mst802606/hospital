@extends('layouts.admin')
@section('page')
				<div class="container-fluid bg-light">
								<section>
												<div class="card mt-5">
																<div class="card-header">
																				<!--ward header-->
																				<div class="container-fluid ">
																								<a href="{{ route('admin.wards.index') }}" class="btn btn-primary m-2">Back</a>
																				</div>
																</div>
																<div class="card-body">
																				<!--ward item-->
																				<section>
																								<div class="container-fluid mt-4">
																												<!--ward item-->
																												<div class="col-md-6 col-xl-12">
																																<div class="card-header">
																																				<h4>Ward {{ $ward->name }}</h4>
																																</div>
																																<div class="card-body">
																																				<p scope="col">id : {{ $ward->id }}</p>
																																				<p scope="col">Name : {{ $ward->name }}</p>
																																				<p scope="col">Capacity : {{ $ward->capacity }}</p>
																																				<p scope="col">Description : {{ $ward->description }}</p>
																																</div>
																																<div class="card my-2">
																																				<div class="card-body">
																																								<div class="container d-flex justify-content-between">
																																												<h4>Nurses</h4>
																																												<a href="{{ route('admin.allocate_wards.create') }}"
																																																class="btn btn-outline-info rounded">
																																																Allocate Nurses
																																												</a>
																																								</div>

																																				</div>
																																				<div class="card-body">

																																								<table class="tile table table-bordered p-4 m-3 ">
																																												<thead>
																																																<tr>
																																																				<th scope="col">Tag ID</th>
																																																				<th scope="col">Name</th>
																																																				<th scope="col">Ward</th>
																																																</tr>
																																												</thead>
																																												<tbody>
																																																@forelse ($ward->nurses  as $nurse)
																																																				<tr>
																																																								<th scope="row">{{ $nurse->tag }}</th>
																																																								<td>{{ $nurse->user->username ?? 'N/A' }}</td>
																																																								<td>{{ $ward->name ?? 'N/A' }}</td>
																																																				</tr>
																																																@empty
																																																				<p>There are no nurses allocated to this ward</p>
																																																@endforelse
																																												</tbody>
																																								</table>



																																				</div>

																																</div>
																																<div class="card my-2">
																																				<div class="card-body">
																																								<div class="container d-flex justify-content-between">
																																												<h4>Patients</h4>
																																												<a href="{{ route('admin.admit_to_wards.create') }}"
																																																class="btn btn-outline-info rounded">
																																																Admit Patients
																																												</a>
																																								</div>

																																				</div>
																																				<div class="card-body">

																																								<table class="tile table table-bordered p-4 m-3 ">
																																												<thead>
																																																<tr>
																																																				<th scope="col">ID</th>
																																																				<th scope="col">Name</th>
																																																				<th scope="col">Ward</th>
																																																</tr>
																																												</thead>
																																												<tbody>
																																																@forelse ($ward->patients  as $patient)
																																																				<tr>
																																																								<th scope="row">{{ $patient->id }}</th>
																																																								<td>{{ $patient->user->username ?? 'N/A' }}</td>
																																																								<td>{{ $ward->name ?? 'N/A' }}</td>
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
																</div>
												</div>


								</section>
				</div>
@endsection
