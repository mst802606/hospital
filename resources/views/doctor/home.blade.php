@extends('layouts.welcome')
@section('content')
<section>
    <!--Services-->
    <div class="row mx-auto justify-content-center mt-4 p-3">
        <div class="welcome">
            <div class="row justify-content-center">
                <div class="col-md-6 col-xl-6 d-flex justify-content-center">
                    <h3>Welcome <name>{{ auth()->user()->username }}</name>
                    </h3>
                </div>
            </div>
            <div class="row justify-content-center">
                <div class="col-md-6 col-xl-6">
                    <p>With the assistance of cutting-edge technology, Afya Bora is bringing healthcare services at the comfort of your home with your mobile phone. We enable doctor’s especially pregnant mothers and women to access reliable and instant online healthcare services</p>
                </div>
            </div>
        </div>
        <div class="col col-md-4 col-xl-3  m-3 tile item">
            <a href="{{ route('doctor.appointments.index') }} ">
                <div class="m-4 p-3">
                    <div class="item-title">
                        <p>Appointments</p>
                    </div>
                    <div class="item-body">
                        <p>Patient Appointments</p>
                    </div>
                </div>
            </a>
        </div>
        <div class="col col-md-4 col-xl-3  m-3 tile item">
            <a href="{{ route('doctor.hospitals.index') }} ">
                <div class="m-4 p-3">
                    <div class="item-title">
                        <p>Hospital</p>
                    </div>
                    <div class="item-body">
                        <p>Hospital Data</p>
                    </div>
                </div>
            </a>
        </div>
        <div class="col col-md-4 col-xl-3  m-3 tile item">
            <a href="{{ route('doctor.visits.index') }} ">
                <div class="m-4 p-3">
                    <div class="item-title">
                        <p>Visits</p>
                    </div>
                    <div class="item-body">
                        <p>
                            Patient Visits
                        </p>
                    </div>
                </div>
            </a>
        </div>
        <div class="col col-md-4 col-xl-3  m-3 tile item">
            <a href="{{ route('doctor.diagnoses.index') }} ">
                <div class="m-4 p-3">
                    <div class="item-title">
                        <p>Diagnoses</p>
                    </div>
                    <div class="item-body">
                        <p>
                            Patient diagnosis made
                        </p>
                    </div>
                </div>
            </a>
        </div>
        <div class="col col-md-4 col-xl-3  m-3 tile item">
            <a href="{{ route('doctor.donations.index') }} ">
                <div class="m-4 p-3">
                    <div class="item-title">
                        <p>Donation</p>
                    </div>
                    <div class="item-body">
                        <p>Donation requests made
                        </p>
                    </div>
                </div>
            </a>
        </div>
        <div class="col col-md-4 col-xl-3  m-3 tile item">
            <a href="{{ route('doctor.messages.index') }} ">
                <div class="m-4 p-3">
                    <div class="item-title">
                        <p>Messages</p>
                    </div>
                    <div class="item-body">
                        <p>Patient messages
                        </p>
                    </div>
                </div>
            </a>
        </div>
        {{-- <div class="tile col col-md-4 col-xl-3 m-3 item">
            <a href="{{ route('doctor.appointments.index') }} "></a>
        <div class="m-4 p-3">
            <div class="item-title">
                <p>Profile</p>
            </div>
            <div class="item-body">
                <p>My profile</p>
            </div>
        </div>
    </div> --}}
    <div class="row">
        <div class="col-md-6 float-right">
            <div class="float-right">
                @include('doctor.messages.index')</div>
        </div>
    </div>
    </div>
</section>
@endsection
