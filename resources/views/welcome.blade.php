@extends('layouts.welcome')
@section('content')
				<section class="web">
								<div class="container-fluid">
												<div id="carouselExampleIndicators p-5" class="carousel slide" data-bs-ride="carousel">
																<div class="carousel-indicators">
																				<button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="0" class="active"
																								aria-current="true" aria-label="Slide 1"></button>
																				<button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="1"
																								aria-label="Slide 2"></button>
																				<button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="2"
																								aria-label="Slide 3"></button>
																</div>
																<div class="carousel-inner">
																				<!-- first corousel-->
																				<div class="carousel-item active p-5"
																								style="background-image:url({{ url('images/doctor.jpg') }}); background-repeat: no-repeat;  background-size: cover;">
																								<div class="col-md col-xl p-5">
																												<div class="d-flex justify-content-between">
																																<div class="row mx-auto justify-content-center">
																																				<div class="tile col-md col-xl m-3 item">
																																								<div class="m-4 p-1">
																																												<div class="item-title">
																																																<p>Doctors</p>
																																												</div>

																																								</div>
																																				</div>
																																</div>
																												</div>
																								</div>
																				</div>
																				<!-- second corousel-->
																				<div class="carousel-item p-5"
																								style="background-image:url({{ url('images/doctor2.jpeg') }}); background-repeat: no-repeat;  background-size: cover;">
																								<div class="col-md col-xl p-5">
																												<div class="d-flex justify-content-between">
																																<div class="row mx-auto justify-content-center">
																																				<div class="tile col-md col-x m-3 item">
																																								<div class="m-4 p-3">
																																												<div class="item-title">
																																																<p>Nurses</p>
																																												</div>

																																								</div>
																																				</div>

																																</div>
																												</div>
																								</div>
																				</div>
																				<!-- third corousel-->
																				<div class="carousel-item p-5 v-50"
																								style="background-image:url({{ url('images/doctor3.jpeg') }}); background-repeat: no-repeat;  background-size: cover;">
																								<div class="col-md col-xl p-5">
																												<div class="d-flex justify-content-between">
																																<div class="row mx-auto justify-content-center">
																																				<div class="tile col-md col-xl m-3 item">
																																								<div class="m-4 p-3">
																																												<div class="item-title">
																																																<p>Medication Plans</p>
																																												</div>
																																								</div>
																																				</div>

																																</div>
																												</div>
																								</div>
																				</div>
																</div>
																<button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleIndicators"
																				data-bs-slide="prev">
																				<span class="carousel-control-prev-icon" aria-hidden="true"></span>
																				<span class="visually-hidden">Previous</span>
																</button>
																<button class="carousel-control-next" type="button" data-bs-target="#carouselExampleIndicators"
																				data-bs-slide="next">
																				<span class="carousel-control-next-icon" aria-hidden="true"></span>
																				<span class="visually-hidden">Next</span>
																</button>
												</div>
								</div>
								<!--Services-->
								<div class="row tile mt-5 ml-3 mr-5 ">
												<div class="d-flex justify-content-center">
																<div class="web mr-4">
																				<h3 class="display-4">Get Started now</h3>
																</div>
												</div>
												<div class="d-flex justify-content-center">
																<div class="web ml-3">
																				<div class="web">
																								<a href="{{ route('home') }}" class="btn btn-outline-dark" hr>Get Started</a>
																				</div>
																</div>
												</div>
								</div>
								<!--Services-->
								<div class="row mx-auto justify-content-center mt-4 p-3">
												<div class="row justify-content-center">
																<div class="col-md-6 col-xl-6 d-flex justify-content-center">
																				<h3 class="display-4">Our Services</h3>
																</div>
												</div>
												<div class="row justify-content-center">
																<div class=" col-md-6 col-xl-6 web">
																				<div class="web">
																								<p>With the assistance of technology, {{ config('app.name') }} is bringing reliable and
																												digital hospital management service</p>
																				</div>
																</div>
												</div>
												<div class="tile col col-md-4 col-xl-3 m-3 item">
																<div class="m-4 p-3">
																				<div class="item-title">
																								<p>Healthcare</p>
																				</div>
																				<div class="item-body">
																								<p>This app helps to provide healthcare of the highest degree.</p>
																				</div>
																</div>
												</div>
												<div class="col col-md-4 col-xl-3 m-3 tile item">
																<div class="m-4 p-3">
																				<div class="item-title">
																								<p>Doctors</p>
																				</div>
																				<div class="item-body">
																								<p>Enable doctors to prescribe treatment to patients
																								</p>
																				</div>
																</div>
												</div>
												<div class="col col-md-4 col-xl-3 m-3 tile item">
																<div class="m-4 p-3">
																				<div class="item-title">
																								<p>Nurses</p>
																				</div>
																				<div class="item-body">
																								<p>Allocate roles to nurses and manage accounts.
																								</p>
																				</div>
																</div>
												</div>
												<div class="col col-md-4 col-xl-3 m-3 tile item">
																<div class="m-4 p-3">
																				<div class="item-title">
																								<p>Medications</p>
																				</div>
																				<div class="item-body">
																								<p>Manage medication plans and medications given to the patients</p>
																				</div>
																</div>
												</div>



												<div class="tile col col-md-4 col-xl-3 m-3 item">
																<div class="m-4 p-3">
																				<div class="item-title">
																								<p>History</p>
																				</div>
																				<div class="item-body">
																								<p>Manage health and medical records in a safe secure environment </p>
																				</div>
																</div>
												</div>
								</div>
								<!--about-->
								<section>
												<div class="row m-5">
																<div class="d-flex justify-content-center m-3">
																				<h4 class="display-4">About us</h4>
																</div>
																<div class="col-md-6 col-xl-6">
																				<div class="item">
																								<img class="img-fluid" src="{{ url('images/doctor.jpg') }}"
																												style="background: cover; overflow:hidden;" alt="doctor">
																				</div>
																</div>
																<div class="col-md-6 col-xl lead">
																				<h2>Our Objective</h2>
																				<br>
																				<p>
																								Our main objective is to ensure quality healthcare management service that is easy and intuitive to
																								the user.
																				</p>
																				<strong> {{ config('app.name') }}</strong> is an Online Hospital Management App.
																				<br>
																				<br>
																				<!--philosophy-->
																				<h2>Our Philosophy</h2>
																				<br>
																				<p>
																								Health matters! <strong>{{ config('app.name') }}</strong> is built on the philosophy that people
																								should live a happier, healthier and more productive life.
																								<!--Our Beliefs-->
																				<h2>Our Beliefs</h2>
																				<br>
																				<p>
																								Our beliefs extend to mutual respect, gender equity, work place transparency and openness, data
																								privacy and strong and positive user experience that would make your day to day activities seemless
																								and enjoyable.
																				</p>
																</div>
												</div>
								</section>
				</section>
@endsection
