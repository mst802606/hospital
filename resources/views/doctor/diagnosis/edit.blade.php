@extends('layouts.doctor')
@section('page')
@php
$diagnosis = $diagnosisdata['diagnosis']
@endphp
<div class="container-fluid bg-light">
    <section>
        <!--diagnosis header-->
        <div class="container-fluid mt-5">
            <a href="{{ route('doctor.diagnoses.index') }}" class="btn btn-warning m-2">View Upcoming</a>
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
                <p class="display-5"> Edit Patient Diagnosis Forms</p>
            </div>
            <div class="row tile">
                <div class="row mx-auto justify-content-center">
                    <h3 class="display-6">Fill the diagnosis form to edit it</h3>
                </div>
                <form action="{{ route('doctor.diagnoses.update',['diagnosis'=>$diagnosis->id]) }}" method="POST">
                    @method('PUT')
                    @csrf
                    <div class="form-group">
                        <label for="diagnosis">Doctor diagnosis </label>
                        <textarea name="diagnosis" id="diagnosis" class="form-control @error('diagnosis') is-invalid @enderror" placeholder="Enter doctors diagnosis here">{{ $diagnosis->diagnosis}}</textarea>
                        @error('diagnosis')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="prescription">Doctor prescription </label>
                        <textarea name="prescription" id="prescription" class="form-control @error('prescription') is-invalid @enderror" placeholder="Enter doctors prescription here">{{ $diagnosis->prescription}}</textarea>
                        @error('prescription')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="regulation">Doctor regulation </label>
                        <textarea name="regulation" id="regulation" class="form-control @error('regulation') is-invalid @enderror" placeholder="Enter doctors regulation here">{{ $diagnosis->regulation}}</textarea>
                        @error('regulation')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="message">Doctor message </label>
                        <textarea name="message" id="message" class="form-control @error('message') is-invalid @enderror" placeholder="Enter doctors message here">{{ $diagnosis->message}}</textarea>
                        @error('message')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>
                    <!--status-->
                    <div class="form-group">
                        <label for="status">Status</label>
                        <select class="form-control form-control @error('status') is-invalid @enderror" id="status" name="status" required>
                            <option value="{{ $diagnosis->status}}" selected disabled>
                                @if ( $diagnosis->status)
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
