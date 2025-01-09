@extends('layouts.admin')
@section('page')
				<section>
								<!--Services-->
								<div class="row mx-auto justify-content-center mt-4 p-3">
												<div class="welcome">
																<div class="row justify-content-center">
																				<div class="col-md-6 col-xl-6 d-flex justify-content-center">
																								<h3>Welcome <name>{{ auth()->user()->username }}</name>
																								</h3>
																				</div>
																</div>

												</div>
												<div class="col col-md-4 col-xl-3  m-3 tile item">
																<a href="{{ route('admin.wards.index') }} ">
																				<div class="m-4 p-3">
																								<div class="item-title">
																												<p>Wards</p>
																								</div>
																								<div class="item-body">
																												<p>Registered Wards</p>
																								</div>
																				</div>
																</a>
												</div>

												<div class="col col-md-4 col-xl-3  m-3 tile item">
																<a href="{{ route('admin.appointments.index') }} ">
																				<div class="m-4 p-3">
																								<div class="item-title">
																												<p>Appointments</p>
																								</div>
																								<div class="item-body">
																												<p>Patient Appointments</p>
																								</div>
																				</div>
																</a>
												</div>
												<div class="col col-md-4 col-xl-3  m-3 tile item">
																<a href="{{ route('admin.hospitals.index') }} ">
																				<div class="m-4 p-3">
																								<div class="item-title">
																												<p>Hospital</p>
																								</div>
																								<div class="item-body">
																												<p>Hospital Data</p>
																								</div>
																				</div>
																</a>
												</div>

												<div class="col col-md-4 col-xl-3  m-3 tile item">
																<a href="{{ route('admin.diagnoses.index') }} ">
																				<div class="m-4 p-3">
																								<div class="item-title">
																												<p>Diagnoses</p>
																								</div>
																								<div class="item-body">
																												<p>
																																Patient diagnosis made
																												</p>
																								</div>
																				</div>
																</a>
												</div>


								</div>
				</section>s
@endsection
