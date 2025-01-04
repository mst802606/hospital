@extends('layouts.doctor')
@section('page')
@php
$donation = $donationdata['donation']
@endphp
<div class="container-fluid bg-light">
    <section>
        <!--donation header-->
        <div class="container-fluid mt-5">
            <a href="{{ route('doctor.donations.index') }}" class="btn btn-warning m-2">View Upcoming</a>
        </div>
        <!--donation form-->
        <section class=" m-5" id="donation-form">
            <div class="row justify-content-center text-center">
                <p class="display-5"> Edit Donor Form</p>
            </div>
            <div class="row tile">
                <div class="d-flex justify-content-center mb-4">
                    <h3 class="display-6">Fill the donation form to edit it</h3>
                </div>
                <form action="{{ route('doctor.donations.update',['donation'=>$donation->id]) }}" method="POST">
                    @method('PUT')
                    @csrf
                    <label for="date">Choose a date and time the donor is comfortable with</label>
                    <div class="row">

                        <div class="col-3">
                            <div class="form-group">
                                <label for="date">Date</label>
                                <input name="date" value="{{ date('Y-m-d', strtotime($donation->time)) }}" type="date"
                                    class="form-control" id="date" placeholder="date" required>
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
                                <input name="time" type="time" value="{{  date('H:i', strtotime($donation->time)) }}"
                                    class="form-control @error('time') is-invalid @enderror" id="time"
                                    placeholder="{{ date('H:i D d-m-Y', strtotime(now()))}}" required>
                                @error('time')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="donor_message">Patient comment </label>
                        <textarea class="form-control @error('donor_message') is-invalid @enderror" name="donor_message"
                            id="donor_message"
                            placeholder="Leave your comment here">{{ $donation->donor_message }}</textarea>
                        @error('donor_message')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                        <small id="donor_message" class="form-text text-muted">Well never share your donation doctor
                            comment with anyone else.</small>
                    </div>

                    <div class="form-group">
                        <label for="organselect">Organ to donate</label>
                        <select class="form-control @error('organ') is-invalid @enderror" id="organselect" name="organ"
                            required>
                            <optgroup label="Select one">
                                <option value="{{ $donation->organ }}">{{ $donation->organ }}</option>
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
                    <!--tested-->
                    <div class="form-group">
                        <label for="tested">Status</label>
                        <select class="form-control form-control @error('tested') is-invalid @enderror" id="tested"
                            name="tested" required>
                            <option value="{{ $donation->tested}}" selected disabled>
                                @if ( $donation->tested)
                                Open
                                @else
                                Closed
                                @endif
                            </option>
                            <option value="1">Open</option>
                            <option value="0">Closed</option>
                        </select>
                        @error('tested')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>
                    <!--accepted-->
                    <div class="form-group">
                        <label for="accepted">Status</label>
                        <select class="form-control form-control @error('accepted') is-invalid @enderror" id="accepted"
                            name="accepted" required>
                            <option value="{{ $donation->accepted}}" selected disabled>
                                @if ( $donation->accepted)
                                Open
                                @else
                                Closed
                                @endif
                            </option>
                            <option value="1">Open</option>
                            <option value="0">Closed</option>
                        </select>
                        @error('accepted')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>
                    <!--status-->
                    <div class="form-group">
                        <label for="status">Status</label>
                        <select class="form-control form-control @error('status') is-invalid @enderror" id="status"
                            name="status" required>
                            <option value="{{ $donation->status}}" selected disabled>
                                @if ( $donation->status)
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
                    <br>
                    <button type="submit" class="btn btn-primary">Submit</button>
                </form>
            </div>
        </section>
    </section>
</div>
@endsection
