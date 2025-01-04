@extends('layouts.doctor')
@section('page')
<div class="container-fluid bg-light">
    <section>
        <!--visit header-->
        <div class="container-fluid mt-5">
            <a href="" class="btn btn-warning m-2">View Upcoming visits</a>
            <a href="{{ route('doctor.appointments.index') }}" class="btn btn-info m-2"> Create a visit</a>
        </div>
        <!--visit history-->
        <section>
            <div class="container-fluid mt-4">
                <!--visit table-->
                <div class="col-md-6 col-xl-12">
                    <div class="row">
                        <table class="tile table table-bordered p-4 m-3 ">
                            <thead>
                                <tr>
                                    <th scope="col">#</th>
                                    <th scope="col">Appointment ID</th>
                                    <th scope="col">Title</th>
                                    <th scope="col">Place</th>
                                    <th scope="col">Doctor</th>
                                    <th scope="col">Patient</th>
                                    <th scope="col">Diagnosis</th>
                                    <th scope="col">Status</th>
                                    <th scope="col">Diagnosis Action</th>
                                    <th scope="col">View</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ( $visitsdata['visits'] as $visit)
                                <tr>
                                    <th scope="row">{{ $visit->id }}</th>
                                    <td>{{ $visit->appointment->id ?? "N/A" }}</td>
                                    <td>{{ $visit->appointment->title ?? "N/A" }}</td>
                                    <td>{{ $visit->appointment->place ?? "office"}}</td>
                                    <td>{{ $visit->doctor->user->username ?? "N/A"}}</td>
                                    <td>{{ $visit->patient->user->username ?? "N/A" }}</td>
                                    <td>
                                        @forelse ($visit->diagnosis as $diagnosis)
                                        @if ($diagnosis->status)
                                        <span class="badge badge-success">{{ $diagnosis->created_at->format('d m y') }}
                                            Processed </span>
                                        @else
                                        <span class="badge badge-warning">{{ $diagnosis->created_at->format('d m y') }}
                                            Pending </span>
                                        @endif
                                        @empty
                                        <span class="badge badge-info">No diagniosis made</span>
                                        @endforelse

                                    </td>
                                    <td>
                                        @if ($visit->status)
                                        <span class="badge badge-info">Open</span>

                                        @else
                                        <span class="badge badge-success">Closed</span>
                                        @endif
                                    </td>
                                    <td><a href="{{ route('doctor.diagnoses.create',['visit'=>$visit->id]) }}"><span
                                                class="badge badge-dark"><i class="fa fa-file"></i> Make
                                                Diagnosis</span></a></td>
                                    <td><a href="{{ route('doctor.visits.show',['visit'=>$visit->id]) }}"><i
                                                class="fa fa-eye"></i> View</a></td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </section>
    </section>
</div>
@endsection
