@extends('layouts.nurse')
@section('page')
				<div class="container-fluid bg-light">
								<section>
												<!--ward header-->
												<div class="container-fluid mt-5">
																<a href="{{ route('doctor.wards.index') }}" class="btn btn-primary m-2">Back</a>
												</div>
												<!--ward item-->
												<section>
																<div class="container-fluid mt-4">
																				<!--ward item-->
																				<div class="col-md-6 col-xl-12 item">
																								<div class="row">
																												<p scope="col">id : {{ $ward->id }}</p>
																												<p scope="col">Title : {{ $ward->appointment->title }}</p>
																												<p scope="col">Purpose : {{ $ward->appointment->purpose }}</p>
																												<p scope="col">Time : {{ date('H:i D d-m-Y', strtotime($ward->appointment->time)) }}</p>
																												<p scope="col">Place : {{ $ward->appointment->place }}</p>
																												<p scope="col">Doctor : {{ $ward->doctor->user->username ?? 'N/A' }}</p>
																												<p scope="col">Diagnoses : @foreach ($ward->diagnosis as $diagnosis)
																																				@if ($diagnosis->status)
																																								<span class="badge badge-success">{{ $diagnosis->created_at->format('d m y') }}
																																												Processed </span>
																																				@else
																																								<span class="badge badge-warning">{{ $diagnosis->created_at->format('d m y') }}
																																												Pending </span>
																																				@endif
																																@endforeach
																												</p>
																												<p scope="col">Status: @if ($ward->status)
																																				<span class="badge badge-info">Open</span>
																																@else
																																				<span class="badge badge-success">Closed</span>
																																@endif
																												</p>
																												@if ($ward->doctor_comment)
																																<p scope="col">Doctor comment : {{ $ward->doctor_comment ?? 'N/A' }}</p>
																												@endif
																												@if ($ward->patient_comment)
																																<p scope="col">Patient comment: {{ $ward->patient_comment ?? 'N/A' }}</p>
																												@endif
																												@if ($ward->patient_rating)
																																<p scope="col">
																																</p>
																												@endif
																												<p class="rate">
																																Patient rating: @for ($i = 1; $i < $ward->patient_rating; $i++)
																																				<span class="rate-item fa fa-2x fa-star checked"></span>
																																@endfor
																																@for ($i = $ward->patient_rating; $i < 8; $i++)
																																				<span class="rate-item fa fa-2x fa-star"></span>
																																@endfor
																												</p>
																												</tbody>
																												</table>
																								</div>
																				</div>
																</div>
												</section>
								</section>
				</div>
@endsection
