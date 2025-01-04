@extends('layouts.admin')
@section('page')
<div class="container-fluid bg-light">
    <section>
        <!--appointment header-->
        <div class="container-fluid mt-5">
            <a href="{{ route('admin.visits.index') }}" class="btn btn-warning m-2">View Upcoming</a>
        </div>
        <!--appointment form-->
        <section class=" m-5" id="appointment-form">
            <div class="row justify-content-center text-center">
                <p class="display-5">Enter the visits details here</p>
            </div>
            <div class="row tile mt-3">
                <div class="row mx-auto justify-content-center">
                    <h3 class="display-6">Fill the Visits form</h3>
                </div>
                <form action="{{ route('admin.visits.store') }}" method="POST">
                    @csrf
                    <!-- select doctor-->
                    <div class="form-group">
                        <label for="doctorselect">Doctor</label>
                        <select class="form-control form-control @error('doctor_id') is-invalid @enderror"
                            id="doctorselect" name="doctor_id" required>
                            @if ($createdata['doctors'])
                            @foreach ( $createdata['doctors'] as $doctor)
                            @if ($doctor->user)
                            <option value="{{ $doctor->id }}">{{ " ID ".$doctor->tag." ". $doctor->user->username ??""}}
                            </option>
                            @endif
                            @endforeach
                            @endif
                        </select>
                        @error('doctor_id')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="doctor_comment">Doctor comment </label>
                        <textarea name="doctor_comment" id="doctor_comment"
                            class="form-control @error('doctor_comment') is-invalid @enderror"
                            placeholder="Enter doctors comment here"></textarea>
                        @error('doctor_comment')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>

                    <div class="form-group d-none">
                        <label for="appointment_id">Appointmet </label>
                        <input name="appointment_id" type="appointment_id" value="{{  $createdata['appointment']->id}}"
                            class="form-control @error('appointment_id') is-invalid @enderror" id="appointment_id"
                            aria-describedby="appointment_id" placeholder="Enter appointment_id" required>
                        @error('appointment_id')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>
                    <!--patient-->
                    <div class="form-group">
                        <label for="status">Status</label>
                        <select class="form-control form-control @error('status') is-invalid @enderror" id="status"
                            name="status" required>
                            <option value="1">Open</option>
                            <option value="0">Closed</option>
                        </select>
                        @error('status')
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
