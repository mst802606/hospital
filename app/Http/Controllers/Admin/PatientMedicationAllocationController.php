<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Doctor;
use App\Models\MedicationPlan;
use App\Models\Patient;
use Illuminate\Http\Request;

class PatientMedicationAllocationController extends Controller
{
    //

    public function create()
    {

        // Fetch all patients and medication plans
        $patients = Patient::with('user')->get();
        $doctors = Doctor::with('user')->get();
        $plans = MedicationPlan::all();

        return view('admin.allocations.create', compact('patients', 'doctors', 'plans'));
    }

    public function placePatientOnMedicatonPlan($patient_id)
    {

        // Fetch all patients and medication plans
        $patients = Patient::where('id', $patient_id)->with('user')->get();
        $doctors = Doctor::with('user')->get();
        $plans = MedicationPlan::all();

        return view('admin.allocations.create', compact('patients', 'doctors', 'plans'));
    }

    public function store(Request $request)
    {
        // Validate the request data
        $validated = $request->validate([
            'patient_id' => ['required', 'exists:patients,id'],
            'plan_id' => ['required', 'exists:medication_plans,id'],
            'recommendation_notes' => 'nullable|string',
            "nurse_id" => ['sometimes', 'required', 'exists:nurses,id'],
            "doctor_id" => ['sometimes', 'required', 'exists:doctors,id'],
        ]);

        $patient = Patient::where('id', $validated['patient_id'])->first();

        $result = $patient->medicationPlans()->syncWithoutDetaching($validated['plan_id'], [
            'nurse_id' => $request->nurse_id,
            "doctor_id" => $request->doctor_id,
            'recommendation_notes' => $validated['recommendation_notes'],
            'status' => 'active',
        ]);

        if (!$result) {
            return back()->with('error', "The patient could not be placed on this medicaton plan.");
        }

        return redirect()->route('admin.medication_plans.index')->with('success', 'Medication plan successfully allocated to the patient.');

    }
}
