<?php

namespace App\Http\Controllers\Nurse;

use App\Http\Controllers\BaseController;
use App\Models\Medication;
use App\Models\MedicationPlan;
use App\Models\Patient;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class OfferPatientMedication extends BaseController
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //

        $ward_ids = $this->nurse()->wards()->pluck('wards.id');

        $patients = Patient::whereIn('ward_id', $ward_ids)
            ->whereHas('medicationPlans')
            ->get();

        return view('nurse.medications.offer_medication.index', compact('patients'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //

        $ward_ids = $this->nurse()->wards()->pluck('wards.id');

        $patient = Patient::where('id', $id)
            ->whereHas('medicationPlans')
            ->get();

        return view('nurse.medications.offer_medication.show', compact('patient'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $patient_id, $medication_plan_id)
    {
        //
        $patient = Patient::where('id', $patient_id)->with('medicationPlans.medications')->first();
        $medication_plan = MedicationPlan::where('id', $medication_plan_id)->first();
        $medication_amounts = array(
            'amount_taken_morning' => "amount taken morning",
            'amount_taken_noon' => "amount taken noon",
            'amount_taken_evening' => "amount taken evening",
            'amount_taken_night' => "amount taken night",

        );
        return view('nurse.medications.offer_medication.edit', compact('patient', "medication_plan", "medication_amounts"));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $patient_id, string $medication_id)
    {

        $request->validate(
            [
                'dosage_time' => "required",
                "dosage_amount" => "required",
            ]
        );
        $patient = Patient::where('id', $patient_id)->first();

// Retrieve today's medications
        $medication = Medication::where('id', $medication_id)->first();
        $patient_medication = $patient->medications()
            ->where('medications.id', $medication_id)
            ->whereDate('medications_patients.created_at', today())
            ->first();

        $result = null;

        if ($patient_medication) {

            $pivotRecord = DB::table('medications_patients')
                ->where('patient_id', $patient->id)
                ->where('medication_id', $medication->id)
                ->whereDate('created_at', today())
                ->first();

            // ✅ Update ONLY today's pivot record
            $result = DB::table('medications_patients')
                ->where('medications_patients.id', $pivotRecord->id) // Use the specific pivot row ID
                ->update([
                    "last_given" => now(),
                    $request->dosage_time => $request->dosage_amount,
                    "total_amount_given" => $pivotRecord->total_amount_given += $request->dosage_amount,
                    'updated_at' => now(),
                ]);
        } else {
            $result = $patient->medications()->attach($medication->id, [
                "last_given" => now(),
                $request->dosage_time => $request->dosage_amount,
                "total_amount_given" => $request->dosage_amount,
                'medications_patients.created_at' => now(),
                'medications_patients.updated_at' => now(),
            ]);

            $result = $patient->medications()
                ->where('medications.id', $medication_id)
                ->whereDate('medications_patients.created_at', today())
                ->first();
        }

        if (!$result) {
            return back()->with('error', "The patient's medication could not be updated");
        }

        return back()->with('success', "The patient's medication record has been updated");

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
