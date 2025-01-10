<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\BaseController;
use App\Http\Controllers\Controller;
use App\Models\User;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class NurseRegisterController extends BaseController
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

        return view('admin.nurses.register');
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

        if (!$user) {
            return back()->with('error', "Registration Failed!!");
        }

        $user = User::where('email', $user->email)->first();

        $nurse = $this->createNurse($request, $user);

        if (!$nurse) {
            return back()->with('error', "Nurse account could not be registerd");
        }

        return redirect(route('admin.nurses.index'));
    }

    public function createNurse($request, User $user)
    {

        $hospital_id = 1;
        $tag = rand(57777, 888888);

        $request['hospital_id'] = $hospital_id;
        $request['tag'] = $tag;

        $result = $user->nurse()->create(
            ["office_days" => $request['office_days'],
                "office_hours" => $request['office_hours'],
                "available" => $request['available'],
                "tag" => $request['tag'],
                "hospital_id" => $request['hospital_id'],
            ]
        );
        if (!$result) {
            return false;
        }

        return $result;
    }

}
