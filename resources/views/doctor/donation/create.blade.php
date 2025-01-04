@extends('layouts.doctor')
@section('page')
@php
$patients = $createdata['patients'];
@endphp
<div class="container-fluid bg-light">
    <section>
        <!--donations header-->
        <div class="container-fluid mt-5">
            <a href="{{ route('doctor.donations.index') }}" class="btn btn-warning m-2">View Upcoming</a>
        </div>
        <!--donations form-->
        <section class=" m-5" id="donations-form">
            <div class="row justify-content-center text-center">
                <p class="display-5">Fill the form to register a donor</p>
            </div>
            <div class="row tile">
                <div class="row mx-auto justify-content-center">
                    <h3 class="display-6">Fill the donations form</h3>
                </div>
                <form action="{{ route('doctor.donations.store') }}" method="POST">
                    @csrf
                    <div class="form-group">
                        <label for="donor_message">Donor Message</label>
                        <textarea name="donor_message" class="form-control @error('donor_message') is-invalid @enderror" value="{{ old('donor_message') }}" id="donor_message" placeholder="Enter donor's message"></textarea>
                        @error('donor_message')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                        <small id="message" class="form-text text-muted">Well never share your donations message with anyone else.</small>
                    </div>

                    <div class="row">
                        <div class="col-3">
                            <div class="form-group">
                                <label for="date">Date</label>
                                <input name="date" value="{{ old('date') }}" type="date" class="form-control" id="date" placeholder="date" required>
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
                                <input name="time" type="time" value="{{ old('time') }}" class="form-control @error('time') is-invalid @enderror" id="time" placeholder="{{ date('H:i D d-m-Y', strtotime(now()))}}" required>
                                @error('time')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="organselect">Organ to donate</label>
                        <select class="form-control @error('organ') is-invalid @enderror" id="organselect" name="organ" required>
                            <optgroup label="Select one">
                                <option></option>
                                <option value="Blood">Blood</option>
                                <option value="Kidney">Kidney</option>
                                <option value="Eye">Eye</option>
                                <option value="Ear">Ear</option>
                            </optgroup>
                        </select>
                        @error('organ')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                        <br>
                    </div>
                    <!--patient-->
                    <div class="form-group">
                        <label for="patientselect">Patient</label>
                        <select class="form-control form-control @error('patient_id') is-invalid @enderror" id="patientselect" name="patient_id" required>
                            @foreach ( $createdata['patients'] as $patient)
                            <option value="{{ $patient->id }}">{{ $patient->user->username}}</option>
                            @endforeach
                        </select>
                        @error('patient_id')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>
                    <div class="form-check">
                        <input name="terms_and_conditions" type="checkbox" class="@error('terms_and_conditions') is-invalid @enderror form-check-input" id="terms_and_conditions" required>
                        <label class="form-check-label" for="terms_and_conditions">Accept the terms and conditions relating to donations </label>
                        @error('terms_and_conditions')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>
                    <br>
                    <button type="submit" class="btn btn-primary">Submit</button>
                </form>
            </div>
        </section>
    </section>
</div>
@endsection
