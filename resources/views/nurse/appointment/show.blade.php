@extends('layouts.doctor')
@section('page')
@php
$appointment = $appointmentdata['appointment']
@endphp
<div class="container-fluid bg-light">
    <section>
        <!--appointment header-->
        <div class="container-fluid mt-5">
            <a href="{{ route('doctor.appointments.index') }}" class="btn btn-danger m-2">Back</a>
            <a href="{{ route('doctor.appointments.edit',['appointment'=>$appointment->id]) }}" class="btn btn-info m-2">Edit</a>
            <a href="{{ route('doctor.visits.create',['appointment'=>$appointment->id]) }}" class="btn btn-dark m-2"><i class="fa fa-file"></i> Make Visit</a>
        </div>
        <!--appointment history-->
        <section>
            <div class="container-fluid mt-4">
                <!--appointment item-->
                <div class="col-md-6 col-xl-12 item">
                    <div class="row">
                        <p scope="col">id : {{ $appointment->id }}</p>
                        <p scope="col">Title : {{ $appointment->title }}</p>
                        <p scope="col">Purpose : {{ $appointment->purpose }}</p>
                        <p scope="col">Time : {{ date('H:i D d-m-Y', strtotime($appointment->time)) }}</p>
                        <p scope="col">Place : {{ $appointment->place }}</p>
                        <p scope="col">Doctor : {{ $appointment->doctor->user->username ?? "N/A" }}</p>
                        <p scope="col">Status: @if ($appointment->status)
                            <span class="badge badge-info">Open</span>

                            @else
                            <span class="badge badge-success">Closed</span>
                            @endif</p>
                        </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </section>
    </section>
</div>
@endsection
