<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class PatientController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //

        return view('admin.patients.create')
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //

        $request->validate([
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
        try {
            $result = $this->createUserAccounts($user);
        } catch (Exception $e) {
            info($e->getMessage());
            return back()->with('error', "Failed to create associated accounts");
        }

        return $user;
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }

    public function createUserAccounts(User $user)
    {
        # code...
        try {
            $this->createProfile($user);
            if ($user->role == 0) {
            } else if ($user->role == 1) {
                $this->patientCreation($user);
            } else if ($user->role == 2) {
                $this->doctorCreation($user);
            }

            return true;
        } catch (Exception $e) {
            info(["registration_error" => $e->getMessage()]);
            return $e->getMessage();
        }
    }

    public function createProfile(User $user)
    {
        # code...
        $result = $user->profile()->create([
            "user_id" => $user->id,
            "profile_image" => "",
        ]);

        return $result;
    }

    public function doctorCreation(User $user)
    {
        # code...
        return redirect('admin.doctors.create', ['user' => $user->id]);
    }

    public function patientCreation(User $user)
    {
        # code...
        $result = $user->patient()->create(
            [
                'hospital_id' => 1,
            ]
        );
        return $result;
    }
}
