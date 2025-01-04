@extends('layouts.patient')
@section('page')
<div class="container-fluid bg-light">
    <section>
        <!--donation header-->
        <div class="container-fluid mt-5">
            <a href="{{ route('patient.donations.create') }}" class="btn btn-info m-2">Make a Donation</a>
            <a href="" class="btn btn-warning m-2">View Upcoming</a>
        </div>
        <!--donation history-->
        <section>
            <div class="container-fluid mt-4">
                <!--donation table-->
                <div class="col-md-6 col-xl-12">
                    <div class="row">
                        <table class="tile table table-bordered p-4 m-3 ">
                            <thead>
                                <tr>
                                    <th scope="col">#</th>
                                    <th scope="col">Donor</th>
                                    <th scope="col">Hospital</th>
                                    <th scope="col">Doctor</th>
                                    <th scope="col">Organ</th>
                                    <th scope="col">Message</th>
                                    <th scope="col">Tested</th>
                                    <th scope="col">Accepted</th>
                                    <th scope="col">Status</th>
                                    <th scope="col">View</th>

                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($donationsdata['donations'] as $donation)
                                <tr>
                                    <th scope="row">{{ $donation->id }}</th>
                                    <td>{{ $donation->patients->user->username  ?? "N/A" }}</td>
                                    <td>{{ $donation->hospital->name  ?? "N/A" }}</td>
                                    <td>{{ $donation->doctor->user->username ?? "N/A" }}</td>
                                    <td>{{ $donation->organ ?? "N/A" }}</td>
                                    <td>{{ $donation->message }}</td>
                                    <td>
                                        @if ($donation->tested)
                                        <span class="badge badge-success">Test succes</span>
                                        @else
                                        <span class="badge badge-danger">Test Failed</span>
                                        @endif
                                    </td>
                                    <td>
                                        @if ($donation->accepted)
                                        <span class="badge badge-success">Donation Accepted</span>
                                        @else
                                        <span class="badge badge-danger">Process rejected</span>
                                        @endif
                                    </td>
                                    <td>
                                        @if ($donation->status)
                                        <span class="badge badge-success">Donation Processed</span>
                                        @else
                                        <span class="badge badge-danger">Donation rejected</span>
                                        @endif
                                    </td>
                                    <td><a href="{{ route('patient.donations.show',['donation'=>$donation->id]) }}"><i class="fa fa-eye"></i> View</a></td>
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
