@extends('layouts.admin')
@section('page')
				@php
								$nurse = $nursedata['nurse'];
				@endphp
				<div class="container-fluid bg-light">
								<section>
												<!--nurse header-->
												<div class="container-fluid mt-5">
																<a href="{{ route('admin.nurses.index') }}" class="btn btn-primary m-2">Back</a>
																<a href="{{ route('admin.nurses.edit', ['nurse' => $nurse->id]) }}" class="btn btn-info m-2">Edit</a>
																<a onclick="document.getElementById('nurse-delete-form').submit()" class="btn btn-danger m-2">Delete this
																				account</a>
																<form id="nurse-delete-form" action="{{ route('admin.nurses.destroy', ['nurse' => $nurse->id]) }}"
																				class="d-none" method="POST">
																				@method('DELETE')
																				@csrf
																</form>
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
								</section>
				</div>
@endsection
