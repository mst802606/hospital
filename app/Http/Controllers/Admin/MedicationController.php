<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\BaseController;
use App\Http\Requests\StoreMedicationRequest;
use App\Http\Requests\UpdateMedicationRequest;
use App\Models\Medication;
use App\Models\MedicationPlan;

class MedicationController extends BaseController
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // Fetch all medications
        $medications = Medication::all();

        // Return the index view with the medications
        return view('admin.medications.index', compact('medications'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create($medication_plan_id = null)
    {
        // Fetch all medication plans for the dropdown
        $medication_plans = MedicationPlan::all();

        if ($medication_plan_id) {
            $medication_plans = MedicationPlan::where('id', $medication_plan_id)->get();

        }

        return view('admin.medications.create', compact('medication_plans'));

    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreMedicationRequest $request)
    {
        // Validate and create the medication
        $result = Medication::create($request->except('medication_plan_id'));

        if (!$result) {
            return back()->with('error', 'Medication could not be added.');
        }

        if ($request->medication_plan_id) {
            $medicationPlan = MedicationPlan::find($request->medication_plan_id);

            // dd($medicationPlan);
            $result = $medicationPlan->medications()->syncWithoutDetaching([$result->id =>
             ["status"=> "active"]]);

            return redirect()->route('admin.medication_plans.show', ['medication_plan' => $medicationPlan])
                ->with('success', 'Medication created successfully.');
        }

        return redirect()->route('admin.medications.index')
            ->with('success', 'Medication created successfully.');

    }

    /**
     * Display the specified resource.
     */
    public function show(Medication $medication)
    {
        // Return the show view with the medication details
        return view('admin.medications.show', compact('medication'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Medication $medication)
    {
        // Fetch all medication plans for the dropdown
        $plans = MedicationPlan::all();

        // Return the edit view with the medication details
        return view('admin.medications.edit', compact('medication', 'plans'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateMedicationRequest $request, Medication $medication)
    {
        // Validate and update the medication
        $medication->update($request->all());

        // Redirect with success message
        return redirect()->route('admin.medications.index')
            ->with('success', 'Medication updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Medication $medication)
    {
        // Delete the medication
        $medication->delete();

        // Redirect with success message
        return redirect()->route('admin.medications.index')
            ->with('success', 'Medication deleted successfully.');
    }
}
