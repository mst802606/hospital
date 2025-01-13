<?php

namespace App\Http\Controllers\Doctor;

use App\Http\Controllers\BaseController;
use App\Models\Patient;
use App\Models\User;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class PatientController extends BaseController
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //

        // $ward_ids = $this->nurse()->wards()->pluck('wards.id');

        $patients = Patient::all();
        return view('doctor.patients.index', compact('patients'));

    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //

        return view('doctor.patients.create');
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

        return redirect(route('doctor.patients.index'));
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //

        $patient = Patient::where('id', $id)->first();
        return view('doctor.patients.show', compact('patient'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $patient = Patient::findOrFail($id);
        return view('doctor.patients.edit', compact('patient'));
    }
    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $patient = Patient::findOrFail($id);

        // Validate the incoming request
        $validatedData = $request->validate([
            'username' => 'required|string|max:255',
            'email' => 'required|email',
            'phoneno' => 'required|numeric|digits:10',
        ]);

        // Update patient data
        $patient->user->update(
            ["username" => $request->username,
                "email" => $request->email,
                "phoneno" => $request->phoneno,
                "password" => $request->password ? Hash::make($request->password) : $patient->user->password,
            ]
        );

        // Redirect back with success message
        return redirect()->route('doctor.patients.index')->with('success', 'Patient information updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //

        $patient = Patient::where('id', $id)->first();
        $user = $patient->first();
        Patient::destroy($id);

        User::destroy($user->id);
        return redirect()->route('doctor.patients.index')->with('success', 'Patient information updated successfully');
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
