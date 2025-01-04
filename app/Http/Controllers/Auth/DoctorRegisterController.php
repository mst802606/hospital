<?php

namespace App\Http\Controllers\Auth;

use App\Models\CountriesList;
use App\Http\Controllers\BaseController;
use App\Http\Controllers\Controller;
use App\Models\Doctor;
use App\Models\User;
use App\Profiles\profiles;
use App\Providers\RouteServiceProvider;
use App\Repositories\AppRepository;
use Exception;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;

class DoctorRegisterController extends BaseController
{
    use RegistersUsers;

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected $redirectTo = RouteServiceProvider::HOME;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('admin');
    }

    public function create()
    {

        return view('admin.doctor.register');
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $request
     * @return \App\User
     */

    //web registrations
    protected function store(Request $request)
    {
        request()->validate([
            'firstname' => ['required', 'string', 'max:255'],
            'lastname' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
            'phoneno' => 'required',
            'terms_and_conditions' => 'required',
            'role' => 'required',
        ]);

        $user = User::firstOrCreate(
            [
                'username' => $request['firstname'] . " " . $request['lastname'],
                'email' => $request['email'],
            ],
            [
                'role' => $request['role'],
                'phoneno' => $request['phoneno'],
                'password' => Hash::make($request['password']),
                'terms_and_conditions' => true,
            ]
        );

        if (!$user)
            return back()->with('error', "Registration Failed!!");

        $user = User::where('email', $user->email)->first();

        return redirect(route('admin.doctors.create'));
    }

}
