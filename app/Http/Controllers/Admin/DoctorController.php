<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\BaseController;
use App\Models\Doctor;
use App\Models\User;
use Illuminate\Http\Request;

class DoctorController extends BaseController
{

    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('admin');
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        $doctor = Doctor::orderBy('created_at', 'DESC')->orderBy('available', 'DESC')->get();
        $doctorsdata['doctors'] = $doctor;
        return view('admin.doctor.index', compact('doctorsdata'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return redirect(route('admin.doctors.register'));
    }

    /**
     * Store a newly created resource in storage.
     */

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //

        $doctor = Doctor::where('id', $id)->first();
        $doctordata['doctor'] = $doctor;
        return view('admin.doctor.show', compact('doctordata'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //

        $doctor = Doctor::where('id', $id)->with('user')->first();
        $doctordata['doctor'] = $doctor;
        $doctordata['doctors'] = User::where('role', 2)->whereDoesntHave('doctor')->get();

        //  dd($doctordata['doctor']);

        return view('admin.doctor.edit', compact('doctordata'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //;

        $doctor = Doctor::where('id', $id)->with('user')->first();

        $result = $doctor->update($request->all());
        if (!$result) {
            return back()->with('error', 'Could not create doctor account');
        }

        return redirect(route('admin.doctors.show', ['doctor' => $id]))->with('success', 'Update success');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
        $result = Doctor::destroy($id);
        if (!$result) {
            return back()->with('error', 'Could not delete doctor account');
        }

        return redirect(route('admin.doctors.index'))->with('success', 'Deletion success');
    }
}
