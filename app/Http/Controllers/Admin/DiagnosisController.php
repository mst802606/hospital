<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\BaseController;
use App\Http\Controllers\Controller;
use App\Models\Diagnosis;
use App\Models\Doctor;
use App\Models\Visits;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class DiagnosisController extends BaseController
{
    public function __construct()
    {

        $this->middleware('auth');
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        $diagnoses =  Diagnosis::with('patients.user')->with('doctor.user')->whereHas('visit.appointment')->orderBy('status','DESC')->orderBy('created_at','DESC')->get();
        $diagnosesdata['diagnoses'] = $diagnoses;
        return view('admin.diagnosis.index', compact('diagnosesdata'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create($visit)
    {
        //
        $visit = Visits::where('id', $visit)->with('patient.user')->whereHas('appointment')->first();
        $createdata['visit'] = $visit;
        $doctors = Doctor::with('user')
            ->get();
        $createdata['doctors'] = $doctors;
        return view('admin.diagnosis.create', compact('createdata'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
        // dd( $request->all());
        $validator = Validator::make($request->input(), [
            'visit_id' => 'required',
            'diagnosis' => 'required',
            'prescription' => 'required',
            'regulation' => 'required',
            'message' => 'required',
            'status' => 'required',
            'doctor_id' => 'required',
        ]);


        if ($validator->fails()) {
            return back()
                ->withErrors($validator)
                ->withInput();
        }

        $visit = Visits::where('id', $request->visit_id)->with('patient.user')->first();

        $patient = $visit->patient;
        $validated = $validator->safe();
        $validated['patient_comment'] = "";
        $validated['patient_rating'] = 0;

        $patient->diagnosis()->create(
            $validated->all(),
        );
        return redirect(route('admin.diagnoses.index'))->with('success', 'Diagnosis added successfully');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
        $diagnosis = Diagnosis::where('id', $id)->with('patients.user')->with('visit.diagnosis')->first();
        $diagnosisdata['diagnosis'] = $diagnosis;
        return view('admin.diagnosis.show', compact('diagnosisdata'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //

        $diagnosis = Diagnosis::where('id', $id)->first();
        $diagnosisdata['diagnosis'] = $diagnosis;
        $doctors = Doctor::with('user')
            ->get();
        $diagnosisdata['doctors'] = $doctors;
        return view('admin.diagnosis.edit', compact('diagnosisdata'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
        $diagnosis = Diagnosis::where('id', $id)->first();

        $result = $diagnosis->update(
            $request->except(['_method', '_token'])
        );
        if (!$result)
            return back()->with('error', 'This item could not be updated');
        return redirect(route('admin.diagnoses.show', ['diagnosis' => $id]))->with('success', 'This item has been updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
        $result =  Diagnosis::destroy($id);
        if (!$result)
            return back()->with('error', 'This item could not be deleted');
        return redirect(route('admin.diagnoses.index'))->with('success', 'This item has been deleted successfully');
    }
}
