@extends('layouts.patient')
@section('page')
<div class="container-fluid bg-light">
    <section>
        <!--diagnosis header-->
        <div class="container-fluid mt-5">
            <a href="" class="btn btn-warning m-2">Refresh</a>
        </div>
        <!--diagnosis history-->
        <section>
            <div class="container-fluid mt-4">
                <!--diagnosis table-->
                <div class="col-md-6 col-xl-12">
                    <div class="row">
                        <table class="tile table table-bordered p-4 m-3 ">
                            <thead>
                                <tr>
                                    <th scope="col">#</th>
                                    <th scope="col">Doctor</th>
                                    <th scope="col">Visit</th>
                                    <th scope="col">Diagnosis</th>
                                    <th scope="col">Prescription</th>
                                    <th scope="col">Regulation</th>
                                    <th scope="col">Message</th>
                                    <th scope="col">status</th>
                                    <th scope="col">View</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach (  $diagnosesdata['diagnoses'] as $diagnosis)
                                <tr>
                                    <th scope="row">{{ $diagnosis->id }}</th>
                                    <td>{{ $diagnosis->doctor->user->username ?? "N/A" }}</td>
                                    <td>{{ $diagnosis->visit->appointment->title ?? "N/A" }} <span class="badge badge-info">on {{ $diagnosis->visit->created_at->format('d m Y') ?? "N/A" }}</span></td>
                                    <td>{{ $diagnosis->disease ?? "office"}}</td>
                                    <td>{{ $diagnosis->prescription }}</td>
                                    <td>{{ $diagnosis->regulation ?? "N/A" }}</td>
                                    <td>{{ $diagnosis->message ?? "N/A" }}</td>
                                    <td>
                                        @if ($diagnosis->status)
                                        <span class="badge badge-info">Open</span>

                                        @else
                                        <span class="badge badge-success">Closed</span>
                                        @endif
                                    </td>
                                    <td><a href="{{ route('patient.diagnoses.show',['diagnosis'=>$diagnosis->id]) }}"><i class="fa fa-eye"></i> View</a></td>
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
