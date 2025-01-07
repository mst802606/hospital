<?php

namespace App\Http\Controllers\Nurse;

use App\Http\Controllers\BaseController;
use App\Http\Requests\StoreMedicationPlanRequest;
use App\Http\Requests\UpdateMedicationPlanRequest;
use App\Models\Medication;
use App\Models\MedicationPlan;

class MedicationPlanController extends BaseController
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // Fetch all medication plans
        $plans = MedicationPlan::all();
        return view('nurse.medication_plans.index', compact('plans'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('nurse.medication_plans.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreMedicationPlanRequest $request)
    {
        //

        // Validate and create the medication plan

        $result = MedicationPlan::create([
            'name' => $request->name,
            'description' => $request->description,
            "start_date" => $request->start_date,
            "start_time" => $request->start_time,
            "is_active" => true,
        ]);

        // Redirect to the index page with a success message
        return redirect()->route('admin.medication_plans.show', ['medication_plan' => $result->id])
            ->with('success', 'Medication Plan created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(MedicationPlan $medicationPlan)
    {
        //
        $medications = Medication::all();

        $plan = MedicationPlan::where('id', $medicationPlan->id)->with('medications')->firstOrFail();
        return view('nurse.medication_plans.show', compact('plan', 'medications'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(MedicationPlan $medicationPlan)
    {
        //

        $medications = Medication::all();
        $plan = MedicationPlan::with('medications')->findOrFail($medicationPlan->id);
        return view('nurse.medication_plans.edit', compact('plan', 'medications'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateMedicationPlanRequest $request, MedicationPlan $medicationPlan)
    {
        $result = $medicationPlan->update(
            $request->all());
        if (!$result) {
            return back()->with('error', 'Failed to update medication plan');
        }

        // Redirect to the index page with a success message
        return redirect()->route('nurse.medication_plans.show', ['medication_plan' => $medicationPlan->id])
            ->with('success', 'Medication Plan updated successfully.');

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(MedicationPlan $medicationPlan)
    {
        //

        MedicationPlan::destroy($medicationPlan->id);
        return redirect()->route('admin.medication_plans.index');
    }
}
