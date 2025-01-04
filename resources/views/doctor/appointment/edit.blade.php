@extends('layouts.doctor')
@section('page')
@php
$appointment = $appointmentdata['appointment'];
$patients = $appointmentdata['patients'];
@endphp
<div class="container-fluid bg-light">
    <section>
        <!--appointment header-->
        <div class="container-fluid mt-5">
            <a href="{{ route('doctor.appointments.index') }}" class="btn btn-warning m-2">View Upcoming</a>
        </div>
        <!--appointment form-->
        <section class=" m-5" id="appointment-form">
            <div class="row justify-content-center text-center">
                <p class="display-5">Edit your appointment with a patient</p>
            </div>
            <div class="row tile mt-3">
                <div class="row mx-auto justify-content-center">
                    <h3 class="display-6">Fill the appointment form to edit it</h3>
                </div>
                <form action="{{ route('doctor.appointments.update',['appointment'=>$appointment->id]) }}" method="POST">
                    @method('PUT')
                    @csrf
                    <div class="form-group">
                        <label for="title">Title </label>
                        <input name="title" type="title" class="form-control @error('title') is-invalid @enderror" value="{{ $appointment->title }}" id="title" aria-describedby="title" placeholder="Enter title">
                        @error('title')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                        <small id="title" class="form-text text-muted">Well never share your appointment title with anyone else.</small>
                    </div>

                    <div class="form-group">
                        <label for="purpose">Purpose </label>
                        <input name="purpose" type="purpose" value="{{ $appointment->purpose }}" class="form-control @error('purpose') is-invalid @enderror" id="purpose" aria-describedby="purpose" placeholder="Enter purpose" required>
                        @error('purpose')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                        <small name="purpose" id="purpose" class="form-text text-muted">Well never share your appointment purpose with anyone else.</small>
                    </div>
                    <!--patient-->
                    <div class="form-group">
                        <label for="patientselect">Patient</label>
                        <select class="form-control form-control @error('patient_id') is-invalid @enderror" id="patientselect" name="patient_id" required>
                            <option value="{{ $appointment->patient_id }}" selected>{{ $appointment->patient->user->username }}</option>
                            @foreach ( $patients as $patient)
                            <option value="{{ $patient->id }}">{{ $patient->user->username}}</option>
                            @endforeach
                        </select>
                        @error('patient_id')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>
                    <!--time-->
                    <div class="row">
                        <div class="col-3">
                            <div class="form-group">
                                <label for="time">Date</label>
                                <div class="flatpickr @error('date') is-invalid @enderror">
                                    <input name="date" value="{{ date('Y-m-d', strtotime($appointment->time))}}" type="date-local" class="form-control" placeholder="Select Date.." data-input>
                                    <!-- input is mandatory -->
                                    <a class="input-button" title="toggle" data-toggle>
                                        <i class="icon-calendar"></i>
                                        <i class="icon-time"></i>
                                    </a>

                                    <a class="input-button" title="clear" data-clear>
                                        <i class="icon-close"></i>
                                    </a>
                                </div>
                                @error('date')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>
                        <div class="col-3">

                            <div class="form-group">
                                <label for="time">Time</label>
                                <div class="flatpickr  @error('time_hour') is-invalid @enderror">
                                    <input name="time_hour" type="time-local" value="{{date('H:i', strtotime($appointment->time)) }}" class="form-control" placeholder="Select time.." data-input>
                                    <!-- input is mandatory -->
                                    <a class="input-button" title="toggle" data-toggle>
                                        <i class="icon-calendar"></i>
                                        <i class="icon-time"></i>
                                    </a>

                                    <a class="input-button" title="clear" data-clear>
                                        <i class="icon-close"></i>
                                    </a>
                                </div>
                                @error('time_hour')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>
                    </div>
                    <div class="form-group ">
                        <p class="@error('time') is-invalid @enderror"> {{ old('time') }}</p>
                        @error('time')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>
                    <div class="form-group">
                        <br>
                        <button type="submit" class="btn btn-primary">Submit</button>
                    </div>
                </form>
            </div>
        </section>
    </section>
</div>
@endsection
