<div class="container row footer mx-auto">
    {{-- about  --}}
    <div class="col col-md-6 col-xl col-lg m-5">
        <h4> About</h4>
        <ul>
            <li>
                <a href="#"> About Us</a>
            </li>
            <li>
                <a href="#">Terms & Conditions</a>
            </li>
            <li class="nav-item">
                <a href="#">Privacy Policy</a>
            </li>
            <li>
                <a href="#">Billing Policy</a>
            </li>
            <li>
                <a href="#">Copyright Infringement Policy</a>
            </li>
        </ul>
    </div>

    {{-- support  --}}
    <div class="col-md-6 col-xl col-lg m-5">
        <h4> Support</h4>
        <ul>
            <li>
                <a href="#"> support@hospitals.co.ke</a>
            </li>

            <li>
                <a href="#"> Safety tips</a>
            </li>
            <li>
                <a href="#"> Contact Us</a>

            </li>
            <li>
                <a href="#"> FAQ</a>
            </li>
        </ul>
    </div>

    {{-- Rescources  --}}
    <div class="col-md-6 col-xl col-lg m-5">
        <h4>Doctor Links</h4>

        <ul>
            <li>
                <a href="{{ url('/doctor/RequestforRegistration') }}">Get Registered</a>
            </li>
            <li>
                <a href="{{ url('/doctor/login') }}">Doctor Login</a>
            </li>
            <li>
                <a href="{{ url('/doctor/bloodonors') }}">Blood Donors</a>

            </li>
            <li>
                <a href="{{ url('/doctor/organdonors') }}">Organ Donors</a>
            </li>
        </ul>
    </div>


    {{-- Important links  --}}
    <div class="col-md-6 col-xl col-lg m-5">
        <ul>
            <li>
                <h4> Patient Links</h4>
            </li>
            <li>
                <a href="{{url('/patient/register')}}">Patient Register</a>
            </li>
            <li>
                <a href="{{url('/patient/login')}}">Patient Login</a>
            </li>
            <li>
                <a href="{{url('/patient/Bloodonation')}}">Donate Blood</a>
            </li>
            <li>
                <a href="{{ url('/patient/appointment') }}">Book A Doctor</a>
            </li>
            <li>
                <a href="{{ url('/patient/Donateorgan') }}">Donate Organ</a>

            </li>
        </ul>
    </div>

</div>
