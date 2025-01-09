<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
				<meta charset="utf-8">
				<meta name="viewport" content="width=device-width, initial-scale=1">

				<!-- CSRF Token -->
				<meta name="csrf-token" content="{{ csrf_token() }}">

				<title>{{ config('app.name', 'DPS App') }}</title>

				<!--jquery-->
				<script src="https://code.jquery.com/jquery-3.6.3.js"></script>
				<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"
								integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous">
				</script>


				@vite(['resources/sass/app.scss', 'resources/js/app.js'])
				{{-- @vite(['resources/css/app.css', 'resources/js/app.js'])  --}}
				<!-- Styles -->

				<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.2.3/css/bootstrap.min.css" />
				<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet"
								integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
				<link rel="stylesheet" href="{{ asset('css/main.css') }}" />
				<link href="{{ asset('sidebar/css/styles.css') }}" rel="stylesheet" />
				<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
				<!-- Icon Font Stylesheet -->
				<link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.4.1/font/bootstrap-icons.css" rel="stylesheet">

				<!-- Fonts -->
				<link rel="dns-prefetch" href="//fonts.gstatic.com">

				<!-- Google Web Fonts -->


				<!-- Template Stylesheet -->
				<!-- Font-icon css-->
				<link rel="stylesheet" type="text/css"
								href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
				<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta2/css/all.min.css"
								integrity="sha512-YWzhKL2whUzgiheMoBFwW8CKV4qpHQAEuvilg9FAn5VJUDwKZZxkJNuGM4XkWuk94WCrrwslk8yWNGmY1EduTA=="
								crossorigin="anonymous" referrerpolicy="no-referrer" />

</head>

<body>
				<div>
								<nav class="navbar navbar-expand-md navbar-inverse shadow-sm sticky-top navbar-dark bg-dark p-2">
												<div class="container-fluid ">
																<a class="navbar-brand d-flex" href="{{ url('/home') }}">
																				<div class="p-2"><img src="{{ url('images/logo.png') }}"
																												style="height:35px;border-right:1px solid #000 " class="pr-3"></div>
																				<div class="pl-1">
																								<h3><strong><a class="text-warning"
																																				href="{{ route('welcome') }}">{{ config('app.name') }}</a></strong></h3>
																								<h6><small>Your online doctor</small></h6>
																				</div>
																</a>
																<button class="navbar-toggler" type="button" data-bs-toggle="collapse"
																				data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent"
																				aria-expanded="false" aria-label="Toggle navigation">
																				<span class="navbar-toggler-icon"></span>
																</button>

																<div class="collapse navbar-collapse" id="navbarSupportedContent">
																				<!-- Right Side Of Navbar -->
																				<ul class="navbar-nav ml-auto ">
																								<!-- Authentication Links -->
																								@guest
																												@if (Route::has('login'))
																																<div class=" fixed top-0 right-0 px-6 py-4 sm:block">
																																				@auth
																																				@else
																																								<a href="{{ route('login') }}"
																																												class="btn btn-info text-sm text-gray-300 dark:text-gray-900 ">Login <i
																																																class="fa-solid fa-right-to-bracket"></i></a>
																																								{{--  @if (Route::has('register'))
																																												<a href="{{ route('register') }}"
																																																class="btn btn-primary ml-4 text-sm  text-gray-300 dark:text-gray-900 underline">Register
																																																<i class="fa-regular fa-file"></i></a>
																																								@endif  --}}
																																				@endauth
																																</div>
																												@endif
																								@else
																												<li class="nav-item dropdown">
																																<a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button"
																																				data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
																																				<i class="fa-solid fa-bell"></i><small><span class="caret text-danger"><strong>
																																																{{ count(auth()->user()->unreadNotifications) }}</strong></span></small>
																																</a>
																																<div class="dropdown-menu dropdown-menu-right " aria-labelledby="navbarDropdown">
																																				<ul class="list-group mt-2">
																																								<li class="list-group-item disabled text-danger">Recent notifications</li>
																																								@foreach (auth()->user()->unreadNotifications->take(4) as $notification)
																																												<li class="list-group-item"><a
																																																				href="{{ route('notifications.show', ['notification' => $notification->id]) }}">{{ $notification->data['message'] }}</a>
																																												</li>
																																								@endforeach
																																				</ul </div>
																												</li>
																												<li class="nav-item dropdown">
																																<a id="navbarDropdown" class="nav-link dropdown-toggle " href="#" role="button"
																																				data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
																																				{{ Auth::user()->username ?? 'Guest' }} <span class="caret"></span>
																																</a>

																																<div class="dropdown-menu dropdown-menu-right " aria-labelledby="navbarDropdown">
																																				<a class="dropdown-item" href="{{ route('logout') }}"
																																								onclick="event.preventDefault();
																																																																									document.getElementById('logout-form').submit();">
																																								{{ __('Logout') }}
																																				</a>

																																				<form id="logout-form" action="{{ route('logout') }}" method="POST"
																																								style="display: none;">
																																								@csrf
																																				</form>
																																</div>
																												</li>
																								@endguest
																				</ul>
																</div>
												</div>
								</nav>

								<main>
												@yield('content')
								</main>
				</div>
				<!-- Remove the container if you want to extend the Footer to full width. -->
				<!-- Footer -->
				<footer class="text-center text-lg-start mt-3 text-white" style="background-color: #1c2331" id="footer">
								<!-- Section: Social media -->
								<section class="d-flex justify-content-between p-4  bg-secondary">
												<!-- Left -->
												<div class="mx-auto p-2">
																<span>Get connected with us on social networks:</span>
												</div>
												<!-- Left -->

												<!-- Right -->
												<div>
																<a href="" class="me-4">
																				<i class="fa-brands fa-2x fa-facebook"></i>
																</a>
																<a href="" class="me-4">
																				<i class="fa-brands fa-2x fa-twitter"></i>
																</a>
																<a href="" class="me-4">
																				<i class="fa-brands fa-2x  fa-google"></i>
																</a>
																<a href="" class="me-4">
																				<i class="fa-brands fa-2x  fa-instagram"></i>
																</a>
																<a href="" class="me-4">
																				<i class="fa-brands fa-2x  fa-linkedin"></i>
																</a>
																<a href="" class="me-4">
																				<i class="fa-brands fa-2x  fa-github"></i>
																</a>
												</div>
												<!-- Right -->
								</section>
								<!-- Section: Social media -->

								<!-- Section: Links  -->
								<section class="">
												<div class="container text-center text-md-start mt-5">
																<!-- Grid row -->
																<div class="row mt-3">
																				<!-- Grid column -->
																				<div class="col-md-3 col-lg-4 col-xl-3 mx-auto mb-4">
																								<!-- Content -->
																								<h6 class="text-uppercase fw-bold">{{ config('app.name') }}</h6>
																								<hr class="mb-4 mt-0 d-inline-block mx-auto"
																												style="width: 60px; background-color: #7c4dff; height: 2px" />
																								<p>
																												{{ config('app.name') }} is a digital application that helps to conect patients to their
																												personal doctors with ease and efficiency without them leaving for the hospital unless
																												required. It makes the booking of appointments easier asn seemless for the patient
																								</p>
																				</div>
																				<!-- Grid column -->

																				<!-- Grid column -->
																				<div class="col-md-2 col-lg-2 col-xl-2 mx-auto mb-4">
																								<!-- Links -->
																								<h6 class="text-uppercase fw-bold">Products</h6>
																								<hr class="mb-4 mt-0 d-inline-block mx-auto"
																												style="width: 60px; background-color: #7c4dff; height: 2px" />
																								<p>
																												<a href="#!">Journal Posting</a>
																								</p>
																								<p>
																												<a href="#!">Mertanity</a>
																								</p>
																								<p>
																												<a href="#!">consultancy</a>
																								</p>
																								<p>
																												<a href="#!">Treatment and consultancy</a>
																								</p>
																								<p>
																												<a href="#!">Ambulances </a>
																								</p>
																				</div>
																				<!-- Grid column -->
																				<div class="col-md-3 col-lg-2 col-xl-2 mx-auto mb-4">
																								<!-- Links -->
																								<h6 class="text-uppercase fw-bold">Useful links</h6>
																								<hr class="mb-4 mt-0 d-inline-block mx-auto"
																												style="width: 60px; background-color: #7c4dff; height: 2px" />

																								<p>
																												<a href="{{ route('welcome') }}">Welcome</a>
																								</p>
																				</div>
																				<!-- Grid column -->

																				<!-- Grid column -->
																				<div class="col-md-4 col-lg-3 col-xl-3 mx-auto mb-md-0 mb-4">
																								<!-- Links -->
																								<h6 class="text-uppercase fw-bold">Contact</h6>
																								<hr class="mb-4 mt-0 d-inline-block mx-auto"
																												style="width: 60px; background-color: #7c4dff; height: 2px" />
																								<p><i class="fas fa-location-dot mr-3"></i> Berlin, Germany , Berlin</p>
																								<p><i class="fas fa-envelope mr-3"></i>{{ config('app.name') }}@gmail.com</p>
																								<p><i class="fas fa-phone mr-3"></i> +49 012 345678</p>
																								<p><i class="fas fa-print mr-3"></i> +49 012 345678</p>
																				</div>
																				<!-- Grid column -->
																</div>
																<!-- Grid row -->
												</div>
								</section>
								<!-- Section: Links  -->

								<!-- Copyright -->
								<div class="text-center p-3" style="background-color: rgba(0, 0, 0, 0.2)">
												© 2020 Copyright:
												<a href="https://mdbootstrap.com/">All Rights Reserved By @Blackhat Softs ©2022</a>

												<!-- Copyright -->
								</div>
				</footer>
				<!--End Footer -->

				<!--Scripts-->

				<!-- Scripts -->
				<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
				<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"
								integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN" crossorigin="anonymous">
				</script>
				<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
				<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.bundle.min.js"
								integrity="sha384-ho+j7jyWK8fNQe+A12Hb8AhRq26LrZ/JpcUGGOn+Y7RsweNrtN/tE3MoK7ZeZDyx" crossorigin="anonymous">
				</script>

				<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"
								integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN" crossorigin="anonymous">
				</script>
				<script src="{{ asset('sidebar/js/scripts.js') }}"></script>
				<script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
				<!-- datepicker config -->
				<script>
								date_config = {
												altFormat: "F j, Y, w",
												dateFormat: 'Y-m-d ',
												minuteIncrement: 30,
												minDate: "today",
												maxDate: new Date().fp_incr(14),
												"disable": [
																function(date) {
																				// return true to disable
																				return (date.getDay() === 0 || date.getDay() === 6);

																}
												],
												"locale": {
																"firstDayOfWeek": 1 // start week on Monday
												}

												,
								}
								time_config = {
												altFormat: "F j, Y, w",
												enableTime: true,
												noCalendar: true,
												dateFormat: "H:i",
												minTime: "07:00",
												maxTime: "17:30",
												minuteIncrement: 30,
												disable: [new Date("10:30")],
								}
								flatpickr("input[type=date-local]", date_config);
								flatpickr("input[type=time-local]", time_config);
				</script>

				{{-- Zoom scripts  --}}

				<!-- Back to Top -->
				<a href="#" class="back-to-top"><i class="fa fa-angle-double-up"></i></a>
</body>

</html>
