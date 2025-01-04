@extends('layouts.patient')
@section('page')
@php
$appointment = $appointmentdata['appointment']
@endphp
<div class="container-fluid bg-light">
    <section>
        <!--appointment header-->
        <div class="container-fluid mt-5">
            <a href="{{ route('patient.appointments.index') }}" class="btn btn-warning m-2">View Upcoming</a>
        </div>
        <!--appointment form-->
        <section class=" m-5" id="appointment-form">
            <div class="row justify-content-center text-center">
                <p class="display-5"> Thousands of highly rated,
                    verified Nurses</p>
                <p> Specialties include: All Nurse, Symptoms, Diagnosis, Treatment, Medication, Prevention, Other Health and more.</p>
            </div>
            <div class="row tile">
                <div class="row mx-auto justify-content-center">
                    <h3 class="display-6">Fill the appointment form to edit it</h3>
                </div>
                <form action="{{ route('patient.appointments.update',['appointment'=>$appointment->id]) }}" method="POST">
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
                    <div class="row">
                        <div class="col-3">
                            <div class="form-group">
                                <label for="time">Date </label>
                                <input name="date" value="{{ date('Y-m-d', strtotime($appointment->time)) }}" onforminput="alert(this.value)" type="date" class="form-control @error('date') is-invalid @enderror" id="date" placeholder="date" required>
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
                                <input name="time" type="time" value="{{ date('H:i', strtotime($appointment->time)) }}" class="form-control @error('time') is-invalid @enderror" id="time" placeholder="{{ date('H:i D d-m-Y', strtotime(now()))}}" required>
                                @error('time')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="doctorselect">Doctor</label>
                        <select class="form-control form-control @error('doctor_id') is-invalid @enderror" id="doctorselect" name="doctor_id" required>
                            <option value="1">{{ $appointment->doctor_id }}</option>
                        </select>
                        @error('doctor_id')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                        <br>
                        <button type="submit" class="btn btn-primary">Submit</button>
                </form>
            </div>
        </section>
    </section>
</div>
@endsection
