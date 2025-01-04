@extends('layouts.admin')
@section('page')
<div class="container-fluid bg-light">
    <section>
        <!--doctor header-->
        <div class="container-fluid mt-5">
            <a href="{{ route('admin.doctors.create') }}" class="btn btn-info m-2">Create a doctor account</a>
        </div>
        <!--doctor history-->
        <section>
            <div class="container-fluid mt-4">
                <!--doctor table-->
                <div class="col-md-6 col-xl-12">
                    <div class="row">
                        <table class="tile table table-bordered p-4 m-3 ">
                            <thead>
                                <tr>
                                    <th scope="col"> #</th>
                                    <th scope="col"> UserId</th>
                                    <th scope="col"> User Name</th>
                                    <th scope="col"> Tag</th>
                                    <th scope="col"> Department</th>
                                    <th scope="col"> Role</th>
                                    <th scope="col"> Office</th>
                                    <th scope="col"> OfficeDays</th>
                                    <th scope="col"> OfficeHours</th>
                                    <th scope="col"> Available</th>
                                    <th scope="col"> View</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($doctorsdata['doctors'] as $doctor)
                                <tr>
                                    <td scope="col"> #{{ $doctor->id }}</td>
                                    <td scope="col"> {{ $doctor->user_id }}</td>
                                    <td scope="col"> {{ $doctor->user->username }}</td>
                                    <td scope="col"> {{ $doctor->tag }}</td>
                                    <td scope="col"> {{ $doctor->department }}</td>
                                    <td scope="col"> {{ $doctor->role }}</td>
                                    <td scope="col"> {{ $doctor->office }}</td>
                                    <td scope="col"> {{ $doctor->office_days }}</td>
                                    <td scope="col"> {{ $doctor->office_hours }}</td>
                                    <td scope="col">
                                        @if ( $doctor->available)
                                        Available
                                        @else
                                        Not Available
                                        @endif
                                    </td>
                                    <td><a href="{{ route('admin.doctors.show',['doctor'=>$doctor->id]) }}"><i
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
