@extends('layouts.doctor')
@section('page')
				@php
								$visit = $visitdata['visit'];
				@endphp
				<div class="container-fluid bg-light">
								<section>
												<!--visit header-->
												<div class="container-fluid d-flex justify-content-between mt-5">
																<div>
																				<a href="{{ route('doctor.visits.index') }}" class="btn btn-primary m-2">Back</a>
																				<a href="{{ route('doctor.visits.edit', ['visit' => $visit->id]) }}" class="btn btn-info m-2">Edit</a>

																				<a href="{{ route('doctor.diagnoses.create', ['visit' => $visit->id]) }}" class="btn btn-dark m-2"><i
																												class="fa fa-file"></i> Make Diagnosis</a>

																</div>
																<div>
																				<a onclick="document.getElementById('visit-delete-form').submit()" class="btn btn-outline-danger m-2"><i
																												class="fa fa-trash"></i> Delete</a>
																				<form id="visit-delete-form" action="{{ route('doctor.visits.destroy', ['visit' => $visit->id]) }}"
																								class="d-none" method="POST">
																								@method('DELETE')
																								@csrf
																				</form>
																</div>
												</div>
												<!--visit item-->
												<section>
																<div class="container-fluid mt-4">
																				<!--visit item-->
																				<div class="col-md-6 col-xl-12 item">
																								<div class="row">
																												<p scope="col">id : {{ $visit->id }}</p>
																												<p scope="col">Title : {{ $visit->appointment->title }}</p>
																												<p scope="col">Purpose : {{ $visit->appointment->purpose }}</p>
																												<p scope="col">Time : {{ date('H:i D d-m-Y', strtotime($visit->appointment->time)) }}</p>
																												<p scope="col">Place : {{ $visit->appointment->place }}</p>
																												<p scope="col">Doctor : {{ $visit->doctor->user->username ?? 'N/A' }}</p>
																												<p scope="col">Diagnoses : @forelse($visit->diagnosis as $diagnosis)
																																				<a href="{{ route('doctor.diagnoses.show', ['diagnosis' => $diagnosis]) }}">
																																								@if ($diagnosis->status)
																																												<span class="badge badge-success">{{ $diagnosis->created_at->format('d m y') }}
																																																Processed </span>
																																								@else
																																												<span class="badge badge-warning">{{ $diagnosis->created_at->format('d m y') }}
																																																Pending </span>
																																								@endif
																																				</a>
																																@empty
																																				No Diagnosis made <a
																																								href="{{ route('doctor.diagnoses.create', ['visit' => $visit->id]) }}"><i
																																												class="fa fa-file"></i> Make Diagnosis</a>
																																@endforelse
																												</p>
																												<p scope="col">Status: @if ($visit->status)
																																				<span class="badge badge-info">Open</span>
																																@else
																																				<span class="badge badge-success">Closed</span>
																																@endif
																												</p>
																												@if ($visit->doctor_comment)
																																<p scope="col">Doctor comment : {{ $visit->doctor_comment ?? 'N/A' }}</p>
																												@endif
																												@if ($visit->patient_comment)
																																<p scope="col">Patient comment: {{ $visit->patient_comment ?? 'N/A' }}</p>
																												@endif
																												@if ($visit->patient_rating)
																																<p scope="col">
																																</p>
																												@endif
																												{{--  <p class="rate">
																																Patient rating: @for ($i = 1; $i < $visit->patient_rating; $i++)
																																				<span class="rate-item fa fa-2x fa-star checked"></span>
																																@endfor
																																@for ($i = $visit->patient_rating; $i < 8; $i++)
																																				<span class="rate-item fa fa-2x fa-star"></span>
																																@endfor
																												</p>  --}}
																												</tbody>
																												</table>
																								</div>
																				</div>
																</div>
												</section>
								</section>
				</div>
@endsection
