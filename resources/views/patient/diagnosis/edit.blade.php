@extends('layouts.patient')
@section('page')
@php
$diagnosis = $diagnosisdata['diagnosis']
@endphp
<div class="container-fluid bg-light">
    <section>
        <!--diagnosis header-->
        <div class="container-fluid mt-5">
            <a href="{{ route('patient.diagnoses.index') }}" class="btn btn-warning m-2">View Upcoming</a>
        </div>
        <!--diagnosis item-->
        <section>
            <div class="container-fluid mt-4">
                <!--diagnosis item-->
                <div class="col-md-6 col-xl-12 item">
                    <div class="row">
                        <p scope="col">id : {{ $diagnosis->id }}</p>
                        <p scope="col">Doctor : {{ $diagnosis->doctor_id }}</p>
                        <p scope="col">Visit : {{ $diagnosis->visit_id }}</p>
                        <p scope="col">Diagnosis : {{ $diagnosis->diagnosis }}</p>
                        <p scope="col">Prescription : {{ $diagnosis->prescription }}</p>
                        <p scope="col">Regulation : {{ $diagnosis->regulation?? "N/A" }}</p>
                        <p scope="col">Status: @if ($diagnosis->status)
                            <span class="badge badge-info">Open</span>

                            @else
                            <span class="badge badge-success">Closed</span>
                            @endif</p>
                        @if ($diagnosis->message)
                        <p scope="col">Doctor message : {{ $diagnosis->message?? "N/A" }}</p>
                        @endif
                        </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </section>
        <!--diagnosis form-->
        <section class=" m-5" id="diagnosis-form">
            <div class="row justify-content-center text-center">
                <p class="display-5"> Thousands of highly rated,
                    verified Nurses</p>
                <p> Specialties include: All Nurse, Symptoms, Diagnosis, Treatment, Medication, Prevention, Other Health and more.</p>
            </div>
            <div class="row tile">
                <div class="row mx-auto justify-content-center">
                    <h3 class="display-6">Fill the diagnosis form to edit it</h3>
                </div>
                <form action="{{ route('patient.diagnoses.update',['diagnosis'=>$diagnosis->id]) }}" method="POST">
                    @method('PUT')
                    @csrf
                    <div class="form-group">
                        <label for="patient_comment">Patient comment </label>
                        <textarea class="form-control" name="patient_comment" id="patient_comment" placeholder="Leave your comment here">{{ $diagnosis->patient_comment }}</textarea>
                        @error('patient_comment')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                        <small id="patient_comment" class="form-text text-muted">Well never share your diagnosis patient comment with anyone else.</small>
                    </div>

                    <div class="form-group">
                        <label for="patient_rating">Patient Rating </label>
                        <input name="patient_rating" type="patient_rating" value="{{ $diagnosis->patient_rating }}" class="form-control @error('patient_rating') is-invalid @enderror" id="patient_rating" aria-describedby="patient_rating" placeholder="Enter patient_rating" required>
                        @error('patient_rating')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                        <small name="patient_rating" id="patient_rating" class="form-text text-muted">Well never share your diagnosis patient_rating with anyone else.</small>
                    </div>
                    <br>
                    <button type="submit" class="btn btn-primary">Submit</button>
                </form>
            </div>
        </section>
    </section>
</div>
@endsection
