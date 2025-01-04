@extends('layouts.admin')
@section('page')
				<div class="container-fluid bg-light">
								<section>
												<!--appointment header-->
												<div class="container-fluid mt-5">
																<a href="{{ route('admin.wards.index') }}" class="btn btn-warning m-2">View Upcoming</a>
												</div>
												<!--appointment form-->
												<section class=" m-5" id="appointment-form">
																<div class="row justify-content-center text-center">
																				<p class="display-5">Enter the wards details here</p>
																</div>
																<div class="row tile mt-3">
																				<div class="row mx-auto justify-content-center">
																								<h3 class="display-6">Fill the wards form</h3>
																				</div>
																				<form action="{{ route('admin.wards.store') }}" method="POST">
																								@csrf
																								<div class="form-group">
																												<label for="name">Ward Name </label>
																												<input name="name" type="text" value="{{ old('name') }}"
																																class="form-control @error('name') is-invalid @enderror" id="name"
																																aria-describedby="name" placeholder="Enter name" required>
																												@error('name')
																																<span class="invalid-feedback" role="alert">
																																				<strong>{{ $message }}</strong>
																																</span>
																												@enderror
																								</div>
																								<div class="form-group">
																												<label for="name">Ward capacity </label>
																												<input name="capacity" type="number" value="{{ old('capacity') }}"
																																class="form-control @error('capacity') is-invalid @enderror" id="capacity"
																																aria-describedby="capacity" placeholder="Enter capacity" required>
																												@error('capacity')
																																<span class="invalid-feedback" role="alert">
																																				<strong>{{ $message }}</strong>
																																</span>
																												@enderror
																								</div>


																								<div class="form-group">
																												<label for="description">Ward description </label>
																												<textarea name="description" id="description" class="form-control @error('description') is-invalid @enderror"
																												    placeholder="Enter description here">{{ old('description') }}</textarea>
																												@error('description')
																																<span class="invalid-feedback" role="alert">
																																				<strong>{{ $message }}</strong>
																																</span>
																												@enderror
																								</div>



																								<button type="submit" class="btn btn-primary">Submit</button>
																				</form>
																</div>
												</section>
								</section>
				</div>
@endsection
