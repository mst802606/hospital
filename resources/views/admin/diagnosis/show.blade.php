@extends('layouts.admin')
@section('page')
				@php
								$diagnosis = $diagnosisdata['diagnosis'];
				@endphp
				<div class="container-fluid bg-light">
								<section>
												<!--diagnosis header-->
												<div class="container-fluid d-flex justify-content-between mt-5">
																<div>
																				<a href="{{ route('admin.diagnoses.index') }}" class="btn btn-primary m-2">Back</a>
																				<a href="{{ route('admin.diagnoses.edit', ['diagnosis' => $diagnosis->id]) }}"
																								class="btn btn-info m-2">Edit</a>
																				@if ($diagnosis->patient->status == true)
																								<a href="{{ route('admin.allocations.patients.create', ['patient' => $diagnosis->patient]) }}"
																												class="btn btn-info m-2">Place patient on medication
																												Plan</a>
																				@endif


																</div>
																<div>
																				<a onclick="document.getElementById('diagnosis-delete-form').submit()" class="btn btn-danger m-2">Delete
																								this item</a>
																				<form id="diagnosis-delete-form"
																								action="{{ route('admin.diagnoses.destroy', ['diagnosis' => $diagnosis->id]) }}" class="d-none"
																								method="POST">
																								@method('DELETE')
																								@csrf
																				</form>
																</div>
												</div>
												<!--diagnosis item-->
												<section>
																<div class="container-fluid mt-4">
																				<!--diagnosis item-->
																				<div class="col-md-6 col-xl-12 item">
																								<div class="row">
																												<p scope="col">id : {{ $diagnosis->id }}</p>
																												<p scope="col">Doctor : {{ $diagnosis->doctor->user->username }}</p>
																												<p scope="col">Diagnosis : {{ $diagnosis->diagnosis }}</p>
																												<p scope="col">Prescription : {{ $diagnosis->prescription }}</p>
																												<p scope="col">Regulation : {{ $diagnosis->regulation ?? 'N/A' }}</p>
																												<p scope="col">Status: @if ($diagnosis->status)
																																				<span class="badge badge-info">Open</span>
																																@else
																																				<span class="badge badge-success">Closed</span>
																																@endif
																												</p>
																												@if ($diagnosis->message)
																																<p scope="col">Doctor message : {{ $diagnosis->message ?? 'N/A' }}</p>
																												@endif
																												@if ($diagnosis->patient_comment)
																																<p scope="col">Patient comment: {{ $diagnosis->patient_comment ?? 'N/A' }}</p>
																												@endif
																												@if ($diagnosis->patient_rating)
																																<p scope="col">Patient rating: {{ $diagnosis->patient_rating ?? 'N/A' }}</p>
																												@endif
																												</tbody>
																												</table>
																								</div>
																				</div>
																</div>
												</section>
								</section>
				</div>
@endsection
