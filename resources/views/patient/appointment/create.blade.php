@extends('layouts.patient')
@section('page')
@php
$doctors = $createdata['doctors'];
@endphp
<div class="container-fluid bg-light">
    <section>
        <!--appointment header-->
        <div class="container-fluid mt-5">
            <a href="{{ route('patient.appointments.index') }}" class="btn btn-warning m-2">View Upcoming</a>
        </div>
        <!--appointment form-->
        <section class=" m-5" id="appointment-form">
            <section class="title">
                <div class="row tile justify-content-center text-center">
                    <p> Thousands of highly rated,
                        verified Nurses</p>
                    <p> Specialties include: All Nurse, Symptoms, Diagnosis, Treatment, Medication, Prevention, Other Health and more.</p>
                </div>
            </section>
            <div class="row tile">
                <div class="row mx-auto justify-content-center">
                    <h3 class="display-6">Fill the appointment form</h3>
                </div>
                <form action="{{ route('patient.appointments.store') }}" method="POST">
                    @csrf
                    <div class="form-group">
                        <label for="title">Title </label>
                        <input name="title" type="title" class="form-control @error('title') is-invalid @enderror" value="{{ old('title') }}" id="title" aria-describedby="title" placeholder="Enter title">
                        @error('title')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                        <small id="title" class="form-text text-muted">Well never share your appointment title with anyone else.</small>
                    </div>

                    <div class="form-group">
                        <label for="purpose">Purpose </label>
                        <input name="purpose" type="purpose" value="{{ old('purpose') }}" class="form-control @error('purpose') is-invalid @enderror" id="purpose" aria-describedby="purpose" placeholder="Enter purpose">
                        @error('purpose')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                        <small name="purpose" id="purpose" class="form-text text-muted">Well never share your appointment purpose with anyone else.</small>
                    </div>

                    <div class="form-group">
                        <label for="doctorselect">Doctor</label>
                        <select class="form-control form-control @error('doctor_id') is-invalid @enderror" id="doctorselect" name="doctor_id" required>
                            @foreach ( $createdata['doctors'] as $doctor)
                            <option value="{{ $doctor->id }}">{{ " ID ".$doctor->tag." ". $doctor->user->username}}</option>
                            @endforeach

                        </select>
                        @error('doctor_id')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>

                    <div class="row">
                        <div class="col-3">
                            <div class="form-group">
                                <label for="time">Date</label>
                                <div class="flatpickr @error('date') is-invalid @enderror">
                                    <input name="date" value="{{ old('date') }}" type="date-local" class="form-control" placeholder="Select Date.." data-input>
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
                                    <input name="time_hour" type="time-local" value="{{ old('time_hour') }}" class="form-control" placeholder="Select time.." data-input>
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
                        <div class="form-check">
                            <input name="terms_and_conditions" type="checkbox" class="form-check-input" id="terms_and_conditions" required>
                            <label class="form-check-label" for="terms_and_conditions">Accept the terms and conditions relating to online appointments </label>
                        </div>
                        <br>
                        <button type="submit" class="btn btn-primary">Submit</button>
                    </div>
                </form>
            </div>
        </section>
    </section>
</div>
<script>
    let time = null;
    let selectdoctor = null;
    let appointments = null;
    $("#doctorselect").change(function(e) {
        selectdoctor = $("#doctorselect").find(":selected").val();
        getDoctorAppointment();
    });

    function getDoctorAppointment() {

        const doctors = @json($createdata['doctors']);
        doctors.forEach(doctorFunc);
        console.log(appointments);
    }

    function doctorFunc(doctor, index) {
        console.log(selectdoctor);
        if (doctor.id == selectdoctor) {
            console.log(doctor);
            return appointments = index + ": " + doctor.appointments;
        }
    }

    disable_time_config = {
        disable: ["10:30", "11:30", "12:30", ]
    , }

    flatpickr("input[type=time-local]", disable_time_config);

</script>
@endsection
