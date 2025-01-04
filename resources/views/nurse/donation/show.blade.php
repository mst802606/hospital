@extends('layouts.doctor')
@section('page')
@php
$donation = $donationdata['donation']
@endphp
<div class="container-fluid bg-light">
    <section>
        <!--donation header-->
        <div class="container-fluid mt-5">
            <a href="{{ route('doctor.donations.index') }}" class="btn btn-primary m-2">Back</a>
            <a href="{{ route('doctor.donations.edit',['donation'=>$donation->id]) }}" class="btn btn-info m-2">Edit</a>
            <a onclick="document.getElementById('donation-delete-form').submit()" class="btn btn-danger m-2">Delete this item</a>
            <form id="donation-delete-form" action="{{ route('doctor.donations.destroy',['donation'=>$donation->id]) }}" class="d-none" method="POST">
                @method("DELETE")
                @csrf
            </form>
        </div>
        <!--donation item-->
        <section>
            <div class="container-fluid mt-4">
                <!--donation item-->
                <div class="col-md-6 col-xl-12 item">
                    <div class="row">
                        <p scope="col">id :#{{ $donation->id }}</p>
                        <p scope="col">Donor : {{ $donation->patients->user->username  ?? "N/A" }}</p>
                        <p scope="col">Hospital :{{ $donation->hospital->name  ?? "N/A" }}</p>
                        <p scope="col">Doctor :{{ $donation->doctor->user->username ?? "N/A" }}</p>
                        <p scope="col">Time {{ date('H:i D d-m-Y', strtotime($donation->time)) }}</p>
                        <p scope="col">Organ : {{ $donation->organ  }}</p>
                        <p scope="col">Donor message : {{ $donation->donor_message?? "N/A" }}</p>
                        <p scope="col">Message : {{ $donation->message?? "N/A" }}</p>
                        <p scope="col">Tested : @if ($donation->tested)
                            <span class="badge badge-success">Test succes</span>
                            @elseif ($donation->tested == null)
                            <span class="badge badge-info">N/A</span>
                            @else
                            <span class="badge badge-danger">Test Failed</span>
                            @endif
                        </p>
                        <p scope="col">Acceptance :
                            @if ($donation->accepted)
                            <span class="badge badge-success">Donation Accepted</span>
                            @elseif ($donation->accepted == null)
                            <span class="badge badge-info">N/A</span>
                            @else
                            <span class="badge badge-danger">Test Failed</span>
                            @endif

                        </p>
                        <p scope="col">Status :
                            @if ($donation->status)
                            <span class="badge badge-success">Donation Processed</span>
                            @elseif ($donation->status == null)
                            <span class="badge badge-info">N/A</span>
                            @else
                            <span class="badge badge-danger">Donation rejected</span>
                            @endif

                        </p>
                        @if ($donation->message)
                        <p scope="col">Doctor message : {{ $donation->message?? "N/A" }}</p>
                        @endif
                        @if ($donation->patient_comment)
                        <p scope="col">Donor comment: {{ $donation->patient_comment?? "N/A" }}</p>
                        @endif
                        @if ($donation->patient_rating)
                        <p scope="col">Donor rating: @include('inc.rating')</p>
                        @endif
                        </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </section>
    </section>
</div>
@endsection
