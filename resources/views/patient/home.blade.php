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
                    <p>With the assistance of cutting-edge technology, Afya Bora is bringing healthcare services at the comfort of your home with your mobile phone. We enable patient’s especially pregnant mothers and women to access reliable and instant online healthcare services</p>
                </div>
            </div>
        </div>
        <div class="col col-md-4 col-xl-3  m-3 tile item">
            <a href="{{ route('patient.appointments.index') }} ">
                <div class="m-4 p-3">
                    <div class="item-title">
                        <p>Appointments</p>
                    </div>
                    <div class="item-body">
                        <p>Book an appointment with a doctor/physician right away</p>
                    </div>
                </div>
            </a>
        </div>
        <div class="col col-md-4 col-xl-3  m-3 tile item">
            <a href="{{ route('patient.hospitals.index') }} ">
                <div class="m-4 p-3">
                    <div class="item-title">
                        <p>Hospital</p>
                    </div>
                    <div class="item-body">
                        <p> We provide our patients with online follow-up services for common and chronic diseases through devices connected to the internet..</p>
                    </div>
                </div>
            </a>
        </div>
        <div class="col col-md-4 col-xl-3  m-3 tile item">
            <a href="{{ route('patient.visits.index') }} ">
                <div class="m-4 p-3">
                    <div class="item-title">
                        <p>Visits</p>
                    </div>
                    <div class="item-body">
                        <p>Have a look at your visit history records and track your doctor-ptient relationship.
                            We make this very easy for you.
                        </p>
                    </div>
                </div>
            </a>
        </div>
        <div class="col col-md-4 col-xl-3  m-3 tile item">
            <a href="{{ route('patient.diagnoses.index') }} ">
                <div class="m-4 p-3">
                    <div class="item-title">
                        <p>Diagnoses</p>
                    </div>
                    <div class="item-body">
                        <p>Take a look at your past health records at your descretion. We have a non-disclosure policy with our patients
                            Only you can access your past health records.
                        </p>
                    </div>
                </div>
            </a>
        </div>
        <div class="col col-md-4 col-xl-3  m-3 tile item">
            <a href="{{ route('patient.donations.index') }} ">
                <div class="m-4 p-3">
                    <div class="item-title">
                        <p>Donation</p>
                    </div>
                    <div class="item-body">
                        <p>Become a living donor of a kidney, blood or part of your liver.
                            Save a life today (!
                        </p>
                    </div>
                </div>
            </a>
        </div>
        <div class="col col-md-4 col-xl-3 m-3 tile item">
            <a href="{{ route('patient.appointments.index') }} ">
                <div class="m-4 p-3">
                    <div class="item-title">
                        <p>Gynaecologist</p>
                    </div>
                    <div class="item-body">
                        <p>Get access to one of our many qualified OBGYNs with years of experience and get your health checked.</p>
                    </div>
                </div>
            </a>
        </div>
        <div class="col col-md-4 col-xl-3 m-3 tile item">
            <a href="{{ route('patient.appointments.index') }} ">
                <div class="m-4 p-3">
                    <div class="item-title">
                        <p>Dermatologist</p>
                    </div>
                    <div class="item-body">
                        <p>Dont let skin and hair conditions stop you from enjoying your daily life, find your doctor today.</p>
                    </div>

                </div>
            </a>
        </div>
        <div class="tile col col-md-4 col-xl-3 m-3 item">
            <a href="{{ route('patient.appointments.index') }} ">
                <div class="m-4 p-3">
                    <div class="item-title">
                        <p>Cardiology</p>
                    </div>
                    <div class="item-body">
                        <p>Talk to a cardiologist today about your heart and how to take better care of your circulatory system.</p>
                    </div>
                </div>
            </a>
        </div>
        <div class="col col-md-4 col-xl-3  m-3 tile item">
            <a href="{{ route('patient.messages.index') }} ">
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
            <a href="{{ route('patient.appointments.index') }} "></a>
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
                @include('patient.messages.index')</div>
        </div>
    </div>
    </div>
</section>
@endsection
