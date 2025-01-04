@extends('layouts.doctor')
@section('page')
				@php
								$doctor = $doctordata['doctor'];
				@endphp
				<div class="container-fluid bg-light">
								<section>
												<!--doctor header-->
												<div class="container-fluid mt-5">
																<a href="{{ route('doctor.doctors.index') }}" class="btn btn-primary m-2">Back</a>
																<a href="{{ route('doctor.doctors.edit', ['doctor' => $doctor->id]) }}" class="btn btn-info m-2">Edit</a>
																<a onclick="document.getElementById('doctor-delete-form').submit()" class="btn btn-danger m-2">Delete this
																				account</a>
																<form id="doctor-delete-form" action="{{ route('doctor.doctors.destroy', ['doctor' => $doctor->id]) }}"
																				class="d-none" method="POST">
																				@method('DELETE')
																				@csrf
																</form>
												</div>
												<!--doctor item-->
												<section>
																<div class="container-fluid mt-4">
																				<!--doctor item-->
																				<div class="col-md-6 col-xl-12 item">
																								<div class="row">
																												<p scope="col">User :# {{ $doctor->user_id }} </p>
																												<p scope="col">User : {{ $doctor->user->username }}</p>
																												<p scope="col">Email : {{ $doctor->user->email }}</p>
																												<p scope="col">Hospital : {{ $doctor->hospital_id }} </p>
																												<p scope="col">Tag : {{ $doctor->tag }} </p>
																												<p scope="col">Department {{ $doctor->department }} </p>
																												<p scope="col">Role : {{ $doctor->role }} </p>
																												<p scope="col">Office : {{ $doctor->office }} </p>
																												<p scope="col">OfficeDays : {{ $doctor->office_days }} </p>
																												<p scope="col">OfficeHours: {{ $doctor->office_hours }} </p>
																												<p scope="col">Available : {{ $doctor->available }} </p>
																												</tbody>
																												</table>
																								</div>
																				</div>
																</div>
												</section>
								</section>
				</div>
@endsection
