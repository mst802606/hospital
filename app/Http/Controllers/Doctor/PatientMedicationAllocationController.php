<?php

namespace App\Http\Controllers\Doctor;

use App\Http\Controllers\Controller;
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
        $plans = MedicationPlan::all();

        return view('doctor.allocations.create', compact('patients', 'plans'));
    }
    public function store(Request $request)
    {
        // Validate the request data
        $validated = $request->validate([
            'patient_id' => 'required|exists:patients,id',
            'plan_id' => 'required|exists:medication_plans,id',
            'recommendation_notes' => 'nullable|string',
            "nurse_id" => ['sometimes', 'required|exists:nurses,id'],
            "doctor_id" => ['sometimes', 'required|exists:doctors,id'],
        ]);

        // Create a new PatientMedicationPlan

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

        return redirect()->route('doctor.medication_plans.index')->with('success', 'Medication plan successfully allocated to the patient.');

    }

    public function destroy(Request $request)
    {
        $validated = $request->validate([
            'patient_id' => 'required|exists:patients,id',
            'plan_id' => 'required|exists:medication_plans,id',
        ]);

        $patient = Patient::where('id', $validated['patient_id'])->first();

        $result = $patient->medicationPlans()->detach($validated['plan_id']);

        if (!$result) {
            return back()->with('error', "The patient cannot be removed from the medicaton plan.");
        }

        return redirect()->route('doctor.medication_plans.index')->with('success', "The patient has been removed from the medicaton plan.");

    }
}
