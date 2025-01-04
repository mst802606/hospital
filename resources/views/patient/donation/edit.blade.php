@extends('layouts.patient')
@section('page')
@php
$donation = $donationdata['donation']
@endphp
<div class="container-fluid bg-light">
    <section>
        <!--donation header-->
        <div class="container-fluid mt-5">
            <a href="{{ route('patient.donations.index') }}" class="btn btn-warning m-2">View Upcoming</a>
        </div>
        <!--donation item-->
        <section>
            <div class="container-fluid mt-4">
                <!--donation item-->
                <div class="col-md-6 col-xl-12 item">
                    <div class="row">
                        <p scope="col">id : {{ $donation->id }}</p>
                        <p scope="col">Patient : {{ $donation->patient_id }}</p>
                        <p scope="col">Hospital : {{ $donation->hospital_id }}</p>
                        <p scope="col">Doctor : {{ $donation->doctor_id }}</p>
                        <p scope="col">Time {{ date('H:i D d-m-Y', strtotime($donation->time)) }}</p>
                        <p scope="col">Organ : {{ $donation->organ  }}</p>
                        <p scope="col">Donor message : {{ $donation->donor_message?? "N/A" }}</p>
                        <p scope="col">Message : {{ $donation->message?? "N/A" }}</p>
                        <p scope="col">Tested : {{ $donation->tested?? "N/A" }}</p>
                        <p scope="col">Acceptance : {{ $donation->accepted?? "N/A" }}</p>
                        <p scope="col">Status : @if ($donation->status)
                            <span class="badge badge-info">Open</span>

                            @else
                            <span class="badge badge-success">Closed</span>
                            @endif</p>
                        @if ($donation->message)
                        <p scope="col">Doctor message : {{ $donation->message?? "N/A" }}</p>
                        @endif
                        @if ($donation->patient_comment)
                        <p scope="col">Patient comment: {{ $donation->patient_comment?? "N/A" }}</p>
                        @endif
                        @if ($donation->patient_rating)
                        <p scope="col">Patient rating: @include('inc.rating')</p>
                        @endif
                        </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </section>
        <!--donation form-->
        <section class=" m-5" id="donation-form">
            <div class="row justify-content-center text-center">
                <p class="display-5"> Thousands of highly rated,
                    verified Nurses</p>
                <p> Specialties include: All Nurse, Symptoms, Diagnosis, Treatment, Medication, Prevention, Other Health and more.</p>
            </div>
            <div class="row tile">
                <div class="d-flex justify-content-center mb-4">
                    <h3 class="display-6">Fill the donation form to edit it</h3>
                </div>
                <form action="{{ route('patient.donations.update',['donation'=>$donation->id]) }}" method="POST">
                    @method('PUT')
                    @csrf
                    <label for="date">Choose a date and time you are comfortable with</label>
                    <div class="row">

                        <div class="col-3">
                            <div class="form-group">
                                <label for="date">Date</label>
                                <input name="date" value="{{ date('Y-m-d', strtotime($donation->time)) }}" type="date" class="form-control" id="date" placeholder="date" required>
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
                                <input name="time" type="time" value="{{  date('H:i', strtotime($donation->time)) }}" class="form-control @error('time') is-invalid @enderror" id="time" placeholder="{{ date('H:i D d-m-Y', strtotime(now()))}}" required>
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
                        <textarea class="form-control @error('donor_message') is-invalid @enderror" name="donor_message" id="donor_message" placeholder="Leave your comment here">{{ $donation->donor_message }}</textarea>
                        @error('donor_message')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                        <small id="donor_message" class="form-text text-muted">Well never share your donation patient comment with anyone else.</small>
                    </div>

                    <div class="form-group">
                        <label for="organselect">Organ to donate</label>
                        <select class="form-control @error('organ') is-invalid @enderror" id="organselect" name="organ" required>
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
                    <br>
                    <button type="submit" class="btn btn-primary">Submit</button>
                </form>
            </div>
        </section>
    </section>
</div>
@endsection
