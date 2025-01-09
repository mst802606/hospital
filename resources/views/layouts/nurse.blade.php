@extends('layouts.welcome')
@section('content')
				<div class="d-flex" id="wrapper">
								<!-- Sidebar-->
								<div class="border-end sidebar-opt-doctor" id="sidebar-wrapper">
												<div class="sidebar-heading border-bottom">Nurse Account</div>
												<div class="list-group list-group-flush">
																<a class="list-group-item list-group-item-action list-group-item-dark p-3"
																				href="{{ route('nurse.home') }}">Home</a>
																<hr>
																<a class="list-group-item list-group-item-action list-group-item-dark p-3"
																				href="{{ route('nurse.patients.index') }}">Patients</a>
																<a class="list-group-item list-group-item-action list-group-item-dark p-3"
																				href="{{ route('nurse.wards.index') }}">Wards</a>
																<a class="list-group-item list-group-item-action list-group-item-dark p-3"
																				href="{{ route('nurse.hospitals.index') }}">Hospital</a>
																<a class="list-group-item list-group-item-action list-group-item-dark p-3"
																				href="{{ route('nurse.medication_plans.index') }}">Medication Plans</a>
																<a class="list-group-item list-group-item-action list-group-item-dark p-3"
																				href="{{ route('nurse.medications.index') }}">Medication</a>
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
																				<h6>Welcome Nurse {{ auth()->user()->username }}</h6>
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
