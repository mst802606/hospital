@extends('layouts.admin')
@section('page')
				<div class="container-fluid bg-light">
								<section>
												<div class="card mt-5">
																<div class="card-header">
																				<!--ward header-->
																				<div class="container-fluid d-flex justify-content-between mt-5">
																								<h4>Registered Wards </h4>
																								<a href="{{ route('admin.wards.create') }}" class="btn btn-info m-2">Add a ward</a>
																				</div>
																</div>
																<div class="card-body ">

																				<!--ward history-->
																				<section>
																								<div class="container-fluid mt-4">
																												<!--ward table-->
																												<div class="col-md-6 col-xl-12">
																																<div class="row">
																																				<table class="tile table table-bordered p-4 m-3 ">
																																								<thead>
																																												<tr>
																																																<th scope="col">#</th>
																																																<th scope="col">Ward ID</th>
																																																<th scope="col">Name</th>
																																																<th scope="col">Patients</th>
																																																<th scope="col">Nurses</th>
																																																<th scope="col">View</th>
																																												</tr>
																																								</thead>
																																								<tbody>
																																												@foreach ($wards as $ward)
																																																<tr>
																																																				<th scope="row">{{ $ward->id }}</th>
																																																				<td>{{ $ward->id ?? 'N/A' }}</td>
																																																				<td>{{ $ward->name ?? 'N/A' }}</td>
																																																				<td>{{ count($ward->patients) ?? 0 }}</td>
																																																				<td>{{ count($ward->nurses) ?? 0 }}</td>
																																																				<td><a href="{{ route('admin.wards.show', ['ward' => $ward->id]) }}"><span
																																																																class="badge badge-dark"><i class="fa fa-file"></i> View
																																																												</span></a></td>
																																																</tr>
																																												@endforeach
																																								</tbody>
																																				</table>
																																</div>
																												</div>
																								</div>
																				</section>
																</div>
												</div>
								</section>
				</div>
@endsection
