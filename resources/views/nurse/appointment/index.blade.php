@extends('layouts.doctor')
@section('page')
<div class="container-fluid bg-light">
    <section>
        <!--appointment header-->
        <div class="container-fluid mt-5">
            <a href="{{ route('doctor.appointments.create') }}" class="btn btn-info m-2">Create Appointment</a>
            <a href="" class="btn btn-warning m-2">View Upcoming</a>
        </div>
        <!--appointment history-->
        <section>
            <div class="container-fluid mt-4">
                <!--appointment table-->
                <div class="col-md-6 col-xl-12">
                    <div class="row">
                        <table class="tile table table-bordered p-4 m-3 ">
                            <thead>
                                <tr>
                                    <th scope="col">#</th>
                                    <th scope="col">Title</th>
                                    <th scope="col">Purpose</th>
                                    <th scope="col">Time</th>
                                    <th scope="col">Place</th>
                                    <th scope="col">Patient</th>
                                    <th scope="col">Status</th>
                                    <th scope="col">Visit</th>
                                    <th scope="col">View</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($appointmentdata['appointments'] as $appointment)
                                <tr>
                                    <th scope="row">{{ $appointment->id }}</th>
                                    <td>{{ $appointment->title }}</td>
                                    <td>{{ $appointment->purpose }}</td>
                                    <td>{{ date('H:i D d-m-Y', strtotime($appointment->time)) }}</td>
                                    <td>{{ $appointment->place }}</td>
                                    <td>{{ $appointment->patient->user->username  }}</td>
                                    <td>
                                        @if ($appointment->status)
                                        <span class="badge badge-info">Open</span>

                                        @else
                                        <span class="badge badge-success">Closed</span>
                                        @endif
                                    </td>
                                    <td><a href="{{ route('doctor.visits.create',['appointment'=>$appointment->id]) }}"><span class="badge badge-dark"><i class="fa fa-file"></i> Make Visit</span></a></td>
                                    <td><a href="{{ route('doctor.appointments.show',['appointment'=>$appointment->id]) }}"><i class="fa fa-eye"></i> View</a></td>
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
