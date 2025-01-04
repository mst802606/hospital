<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\BaseController;
use App\Http\Controllers\Controller;
use App\Models\Appointments;
use App\Models\Doctor;
use App\Models\Visits;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class VisitController extends BaseController
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
        $visits = Visits::with('appointment')
            ->with('doctor.user')
            ->with('diagnosis')
            ->with('hospital')
            ->orderBy('status','DESC')
            ->orderBy('created_at','DESC')
            ->get();


        $visitsdata['visits'] = $visits;
        return view('admin.visits.index', compact('visitsdata'));
    }


    /**
     * Show the form for creating a new resource.
     */
    public function create($appointment)
    {
        //
        $appointment = Appointments::where('id', $appointment)->with('patient.user')->first();
        $createdata['appointment'] = $appointment;
        $doctors = Doctor::with('user')
            ->get();
        $createdata['doctors'] = $doctors;
        return view('admin.visits.create', compact('createdata'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
        $validator = Validator::make($request->input(), [
            'doctor_id' => 'required',
            'appointment_id' => 'required',
            'doctor_comment' => 'required',
            'status' => 'required',
        ]);

        if ($validator->fails()) {
            return back()
                ->withErrors($validator)
                ->withInput();
        }
        $appointment = Appointments::where('id', $request->appointment_id)->with('patient.user')->first();

        $validated = $validator->safe();
        $validated['patient_comment'] = "";
        $validated['patient_rating'] = 0;
        $validated['patient_id'] = $appointment->patient_id;

        Visits::create(
            $validated->all(),
        );
        return redirect(route('admin.visits.index'))->with('success', 'Visit added successfully');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
        $visit = Visits::where('id', $id)
            ->whereHas('appointment')
            ->with('doctor.user')
            ->with('diagnosis')
            ->with('hospital')
            ->first();
        $visitdata['visit'] = $visit;
        return view('admin.visits.show', compact('visitdata'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //s
        $visit = Visits::where('id', $id)->first();
        $visitdata['visit'] = $visit;
        $doctors = Doctor::with('user')
            ->get();
        $visitdata['doctors'] = $doctors;
        return view('admin.visits.edit', compact('visitdata'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
        $visit = Visits::where('id', $id)->first();

        $result = $visit->update(
            $request->except(['_method', '_token'])
        );
        if (!$result)
            return back()->with('error', 'This item could not be updated');
        return redirect(route('admin.visits.show', ['visit' => $id]))->with('success', 'This item has been updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //

        $result =  Visits::destroy($id);

        if (!$result)
            return back()->with('error', 'This item could not be deleted');
        return redirect(route('admin.visits.index'))->with('success', 'This item has been deleted successfully');
    }
}
