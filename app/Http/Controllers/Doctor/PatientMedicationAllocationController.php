<?php

namespace App\Http\Controllers\Doctor;

use App\Http\Controllers\Controller;
use App\Models\MedicationPlan;
use App\Models\Patient;
use App\Models\PatientMedicationPlan;
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
        $result = PatientMedicationPlan::create([
            'patient_id' => $validated['patient_id'],
            'medication_plan_id' => $validated['plan_id'],
            'nurse_id' => $request->nurse_id,
            "doctor_id" => $request->doctor_id,
            'recommendation_notes' => $validated['recommendation_notes'],
            'status' => 'active',
        ]);

        dd($result);

        return redirect()->route('doctor.medication_plans.index')->with('success', 'Medication plan successfully allocated to the patient.');

    }
}
