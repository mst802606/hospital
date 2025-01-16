@extends('layouts.admin')
@section('page')
				<div class="container-fluid bg-light">
								<section>
												<!--nurse header-->
												<div class="container-fluid d-flex justify-content-between mt-5">
																<div>
																				<a href="{{ route('admin.nurses.index') }}" class="btn btn-primary m-2">Back</a>
																				{{--  <a href="{{ route('admin.nurses.edit', ['nurse' => $nurse->id]) }}" class="btn btn-info m-2">Edit</a>  --}}
																				<a href="{{ route('admin.allocate_wards.create', ['nurse' => $nurse->id]) }}"
																								class="btn btn-outline-primary m-2">Allocate Wards</a>
																</div>
																<div>
																				<a onclick="document.getElementById('nurse-delete-form').submit()" class="btn btn-danger m-2"><i
																												class="fa fa-trash"></i>Delete
																				</a>
																				<form id="nurse-delete-form" action="{{ route('admin.nurses.destroy', ['nurse' => $nurse->id]) }}"
																								class="d-none" method="POST">
																								@method('DELETE')
																								@csrf
																				</form>
																</div>
												</div>
												<!--nurse item-->
												<section>
																<div class="container-fluid mt-4">
																				<!--nurse item-->
																				<div class="col-md-6 col-xl-12 item">
																								<div class="row">
																												<p scope="col">User :# {{ $nurse->user_id }} </p>
																												<p scope="col">User : {{ $nurse->user->username }}</p>
																												<p scope="col">Email : {{ $nurse->user->email }}</p>
																												<p scope="col">Hospital : {{ $nurse->hospital_id }} </p>
																												<p scope="col">Tag : {{ $nurse->tag }} </p>
																												<p scope="col">Department {{ $nurse->department }} </p>
																												<p scope="col">Role : {{ $nurse->role }} </p>
																												<p scope="col">Office : {{ $nurse->office }} </p>
																												<p scope="col">OfficeDays : {{ $nurse->office_days }} </p>
																												<p scope="col">OfficeHours: {{ $nurse->office_hours }} </p>
																												<p scope="col">Available : {{ $nurse->available }} </p>
																												</tbody>
																												</table>
																								</div>
																				</div>
																</div>
												</section>

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
																																				@foreach ($nurse->wards as $ward)
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
								</section>
				</div>
@endsection
