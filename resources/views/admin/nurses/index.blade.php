@extends('layouts.admin')
@section('page')
				<div class="container-fluid bg-light">
								<section>
												<!--nurse header-->
												<div class="container-fluid mt-5">
																<a href="{{ route('admin.nurses.create') }}" class="btn btn-info m-2">Create a nurse account</a>
												</div>
												<!--nurse history-->
												<section>
																<div class="container-fluid mt-4">
																				<!--nurse table-->
																				<div class="col-md-6 col-xl-12">
																								<div class="row">
																												<table class="tile table table-bordered p-4 m-3 ">
																																<thead>
																																				<tr>
																																								<th scope="col"> #</th>
																																								<th scope="col"> UserId</th>
																																								<th scope="col"> User Name</th>
																																								<th scope="col"> Tag</th>
																																								<th scope="col"> OfficeDays</th>
																																								<th scope="col"> Available</th>
																																								<th scope="col"> View</th>
																																				</tr>
																																</thead>
																																<tbody>
																																				@foreach ($nursesdata['nurses'] as $nurse)
																																								<tr>
																																												<td scope="col"> #{{ $nurse->id }}</td>
																																												<td scope="col"> {{ $nurse->user_id }}</td>
																																												<td scope="col"> {{ $nurse->user->username }}</td>
																																												<td scope="col"> {{ $nurse->tag }}</td>
																																												<td scope="col"> {{ $nurse->office_days }}</td>
																																												<td scope="col">
																																																@if ($nurse->available)
																																																				Available
																																																@else
																																																				Not Available
																																																@endif
																																												</td>
																																												<td><a href="{{ route('admin.nurses.show', ['nurse' => $nurse->id]) }}"><i
																																																								class="fa fa-eye"></i> View</a></td>
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
