@extends('layouts.doctor')
@section('page')
@php
$visit = $visitdata['visit'];
$rating = $visit->patient_rating;
@endphp
<div class="container-fluid bg-light">
    <section>
        <!--visit header-->
        <div class="container-fluid mt-5">
            <a href="{{ route('doctor.visits.index') }}" class="btn btn-warning m-2">View Upcoming</a>
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
                        <p scope="col">Doctor : {{ $visit->doctor->user->username?? "N/A" }}</p>
                        <p scope="col">Status: @if ($visit->status)
                            <span class="badge badge-info">Open</span>

                            @else
                            <span class="badge badge-success">Closed</span>
                            @endif</p>
                        @if ($visit->doctor_comment)
                        <p scope="col">Doctor comment : {{ $visit->doctor_comment?? "N/A" }}</p>
                        @endif
                        @if ($visit->doctor_comment)
                        <p scope="col">Patient comment: {{ $visit->doctor_comment?? "N/A" }}</p>
                        @endif
                        @if ($visit->patient_rating)
                        <p scope="col">
                        </p>
                        @endif
                        <p class="rate">
                            Patient rating: @include('inc.rating')
                        </p>

                        </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </section>
        <!--visit form-->
        <section class=" m-5" id="visit-form">
            <div class="row justify-content-center text-center">
                <p class="display-5"> Patient Visits Form
            </div>
            <div class="row tile">
                <div class="row mx-auto justify-content-center">
                    <h3 class="display-6">Fill the visit form to edit it</h3>
                </div>
                <form action="{{ route('doctor.visits.update',['visit'=>$visit->id]) }}" method="POST">
                    @method('PUT')
                    @csrf
                    <div class="form-group">
                        <label for="doctor_comment">Doctor comment </label>
                        <textarea class="form-control" name="doctor_comment" id="doctor_comment" placeholder="Leave your comment here">{{ $visit->doctor_comment }}</textarea>
                        @error('doctor_comment')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                        <small id="doctor_comment" class="d-none form-text text-muted">Well never share your visit doctor comment with anyone else.</small>
                    </div>
                    <!--status-->
                    <div class="form-group">
                        <label for="status">Status</label>
                        <select class="form-control form-control @error('status') is-invalid @enderror" id="status" name="status" required>
                            <option value="{{ $visit->status}}" selected disabled>
                                @if ( $visit->status)
                                Open
                                @else
                                Closed
                                @endif
                            </option>
                            <option value="1">Open</option>
                            <option value="0">Closed</option>
                        </select>
                        @error('status')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>

                    <div class="form-group">
                        <input name="patient_rating" type="patient_rating" value="{{ $visit->patient_rating }}" class="form-control @error('patient_rating') is-invalid @enderror d-none" id="rating" aria-describedby="patient_rating" placeholder="Enter patient_rating" required>
                        <p class="rate">
                            Patient rating: @include('inc.rating_edit')
                        </p>
                        @error('patient_rating')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                        <small name="patient_rating" id="patient_rating" class="form-text text-muted">Well never share your visit patient_rating with anyone else.</small>
                    </div>
                    <br>
                    <button type="submit" class="btn btn-primary">Submit</button>
                </form>
            </div>
        </section>
    </section>
</div>
@endsection
