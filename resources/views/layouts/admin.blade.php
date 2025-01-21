@extends('layouts.welcome')
@section('content')
				<div class="d-flex" id="wrapper">
								<!-- Sidebar-->
								<div class="border-end sidebar-opt-doctor" id="sidebar-wrapper">
												<div class="sidebar-heading border-bottom">Admin Account</div>
												<div class="list-group list-group-flush">
																<a class="list-group-item list-group-item-action list-group-item-dark p-3"
																				href="{{ route('admin.home') }}">Home</a>
																<hr>
																<a class="list-group-item list-group-item-action list-group-item-dark p-3"
																				href="{{ route('admin.wards.index') }}">Wards</a>
																{{--  <a class="list-group-item list-group-item-action list-group-item-dark p-3"
																				href="{{ route('admin.appointments.index') }}">Appointments</a>  --}}
																<a class="list-group-item list-group-item-action list-group-item-dark p-3"
																				href="{{ route('admin.hospitals.index') }}">Hospital</a>
																{{--  <a class="list-group-item list-group-item-action list-group-item-dark p-3"
																				href="{{ route('admin.visits.index') }}">Visits</a>  --}}
																{{--  <a class="list-group-item list-group-item-action list-group-item-dark p-3"
																				href="{{ route('admin.diagnoses.index') }}">Diagnoses</a>  --}}
																<a class="list-group-item list-group-item-action list-group-item-dark p-3"
																				href="{{ route('admin.patients.index') }}">Patients</a>
																<a class="list-group-item list-group-item-action list-group-item-dark p-3"
																				href="{{ route('admin.doctors.index') }}">Doctors</a>
																<a class="list-group-item list-group-item-action list-group-item-dark p-3"
																				href="{{ route('admin.nurses.index') }}">Nurses</a>
																<a class="list-group-item list-group-item-action list-group-item-dark p-3"
																				href="{{ route('admin.medications.index') }}">Medications</a>
																<a class="list-group-item list-group-item-action list-group-item-dark p-3"
																				href="{{ route('admin.medication_plans.index') }}">Medication Plans</a>
												</div>

								</div>
								<!-- Page content wrapper-->
								<div id="page-content-wrapper">
												<!-- Top navigation-->
												<nav class="navbar navbar-expand-lg navbar-light bg-light border-bottom">
																<div class="container-fluid">
																				<button class="navbar-btn btn-outline-info rounded-pill" type="button" id="sidebarToggle"><span
																												class="navbar-toggler-icon"></span></button>
																</div>
																<div class="container-fluid">
																				<h6>Welcome {{ auth()->user()->username }}</h6>
																</div>
																<div class="container-fluid">
																</div>
												</nav>
												<!-- Page content-->
												<div class="container-fluid">
																<div class="row">
																				@include('inc.messages')
																</div>
																@yield('page')
												</div>
								</div>
				</div>
@endsection
