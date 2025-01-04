<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\BaseController;
use App\Models\Patient;
use App\Models\Ward;
use Illuminate\Http\Request;

class AdmitPatientsToWardController extends BaseController
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        $wards = $this->hospital()->wards;
        $patients = Patient::with('user')->get();

        return view('admin.wards.admit_patients.index', compact('wards', 'patients'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
        $wards = $this->hospital()->wards;
        $patients = Patient::with('user')->get();

        return view('admin.wards.admit_patients.create', compact('wards', 'patients'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //

        $request->validate(
            [
                'patient_id' => ['required', 'integer'],
                'ward_id' => ['required', 'integer'],
            ]
        );

        $patient = Patient::where('id', $request->patient_id)->first();

        $ward = Ward::where('id', $request->ward_id)->first();

        $result = $patient->update(
            ['ward_id' => $ward->id]
        );

        if (!$result) {
            return back()->with('error', "The patient could not be admitted to the ward.");
        }

        return redirect(route('admin.wards.index'))->with('success', "Patient admitted to the ward");

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
}
