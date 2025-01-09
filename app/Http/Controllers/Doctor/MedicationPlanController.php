<?php

namespace App\Http\Controllers\Doctor;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreMedicationPlanRequest;
use App\Http\Requests\UpdateMedicationPlanRequest;
use App\Models\Medication;
use App\Models\MedicationPlan;

class MedicationPlanController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // Fetch all medication plans
        $plans = MedicationPlan::all();
        return view('doctor.medication_plans.index', compact('plans'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('doctor.medication_plans.create');
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
        return redirect()->route('doctor.medication_plans.show', ['medication_plan' => $result->id])
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
        return view('doctor.medication_plans.show', compact('plan', 'medications'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(MedicationPlan $medicationPlan)
    {
        //

        $medications = Medication::all();
        $plan = MedicationPlan::with('medications')->findOrFail($medicationPlan->id);
        return view('doctor.medication_plans.edit', compact('plan', 'medications'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateMedicationPlanRequest $request, MedicationPlan $medicationPlan)
    {
        $medicationPlan->update([
            'name' => $request->name,
            'description' => $request->description,
            "start_date" => $request->start_date,
            "start_time" => $request->start_time,
            "is_active" => true,
        ]);

        $medicationPlan = MedicationPlan::where('id', $medicationPlan->id)->first();

        $result = $medicationPlan->medications()->toggle($request->medications);

        if (!$result) {
            return back()->with('error', 'Medication plan could not be updated');
        }

        // Redirect to the index page with a success message
        return redirect()->route('doctor.medication_plans.show', ['medication_plan' => $medicationPlan->id])
            ->with('success', 'Medication Plan updated successfully.');

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(MedicationPlan $medicationPlan)
    {
        //

        MedicationPlan::destroy($medicationPlan->id);
        return redirect()->route('doctor.medication_plans.index');
    }
}
