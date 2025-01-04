@extends('layouts.doctor')
@section('page')
<div class="container-fluid bg-light">
    <section>
        <!--appointment header-->
        <div class="container-fluid mt-5">
            <a href="{{ route('doctor.visits.index') }}" class="btn btn-warning m-2">View Upcoming</a>
        </div>
        <!--appointment form-->
        <section class=" m-5" id="appointment-form">
            <div class="row justify-content-center text-center">
                <p class="display-5">Enter the Diagnosis details here</p>
            </div>
            <div class="row tile mt-3">
                <div class="row mx-auto justify-content-center">
                    <h3 class="display-6">Fill the Diagnosis form</h3>
                </div>
                <form action="{{ route('doctor.diagnoses.store') }}" method="POST">
                    @csrf
                    <div class="form-group">
                        <label for="diagnosis">Doctor diagnosis </label>
                        <textarea name="diagnosis" id="diagnosis" class="form-control @error('diagnosis') is-invalid @enderror" placeholder="Enter doctors diagnosis here">{{ old('diagnosis')}}</textarea>
                        @error('diagnosis')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="prescription">Doctor prescription </label>
                        <textarea name="prescription" id="prescription" class="form-control @error('prescription') is-invalid @enderror" placeholder="Enter doctors prescription here">{{ old('prescription')}}</textarea>
                        @error('prescription')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="regulation">Doctor regulation </label>
                        <textarea name="regulation" id="regulation" class="form-control @error('regulation') is-invalid @enderror" placeholder="Enter doctors regulation here">{{ old('regulation')}}</textarea>
                        @error('regulation')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="message">Doctor message </label>
                        <textarea name="message" id="message" class="form-control @error('message') is-invalid @enderror" placeholder="Enter doctors message here">{{ old('message')}}</textarea>
                        @error('message')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>
                    <div class="form-group d-none" >
                        <label for="visit_id">Visit Id </label>
                        <input name="visit_id" type="visit_id" value="{{  $createdata['visit']->id}}" class="form-control @error('visit_id') is-invalid @enderror" id="visit_id" aria-describedby="visit_id" placeholder="Enter visit_id" required>
                        @error('visit_id')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>
                    <!--patient-->
                    <div class="form-group">
                        <label for="status">Status</label>
                        <select class="form-control form-control @error('status') is-invalid @enderror" id="status" name="status" required>
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
