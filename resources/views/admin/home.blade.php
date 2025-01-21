@extends('layouts.admin')
@section('page')
				<section>
								<!--Services-->
								<div class="row">
												<div class="col-md col-xl  m-3 tile item">
																<a href="{{ route('admin.hospitals.index') }} ">
																				<div class="m-4 p-3">
																								<div class="item-title d-flex justify-content-center">
																												<p>{{ $hospital->name }} Hospital</p>
																								</div>
																				</div>
																</a>
												</div>
								</div>
								<div class="row mx-auto justify-content-center mt-4 p-3">

												<div class=" col-md col-xl-5  m-3 tile item">
																<a href="{{ route('admin.wards.index') }} ">
																				<div class="m-4 p-3">
																								<div class="item-title">
																												<p>Wards</p>
																								</div>
																								<div class="item-body">
																												<p>{{ $hospital->wards()->count() }} registered Wards</p>
																								</div>
																				</div>
																</a>
												</div>

												<div class="col-md col-xl-5  m-3 tile item">
																<a href="{{ route('admin.doctors.index') }} ">
																				<div class="m-4 p-3">
																								<div class="item-title">
																												<p>Doctors</p>
																								</div>
																								<div class="item-body">
																												<p>{{ $hospital->doctors()->count() }} doctors registered</p>
																								</div>
																				</div>
																</a>
												</div>
												<div class="col-md col-xl-5  m-3 tile item">
																<a href="{{ route('admin.nurses.index') }} ">
																				<div class="m-4 p-3">
																								<div class="item-title">
																												<p>Nurses</p>
																								</div>
																								<div class="item-body">
																												<p>{{ $hospital->nurses()->count() }} nurses registered</p>
																								</div>
																				</div>
																</a>
												</div>


												<div class="col-md col-xl-5  m-3 tile item">
																<a href="{{ route('admin.patients.index') }} ">
																				<div class="m-4 p-3">
																								<div class="item-title">
																												<p>Patients</p>
																								</div>
																								<div class="item-body">
																												<p>
																																{{ $hospital->patients()->count() }} Patients served
																												</p>
																								</div>
																				</div>
																</a>
												</div>


								</div>
				</section>
@endsection
