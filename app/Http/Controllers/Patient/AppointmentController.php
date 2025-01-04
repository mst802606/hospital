<?php

namespace App\Http\Controllers\Patient;

use App\Http\Controllers\BaseController;
use App\Http\Controllers\Controller;
use App\Models\Appointments;
use App\Models\Doctor;
use App\Repositories\Schedule;
use Illuminate\Database\Query\Builder;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AppointmentController extends BaseController
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
        $appointments = $this->patient()->appointments()->with('doctor.user')->orderBy('status', 'DESC')->orderBy('created_at', 'DESC')->get();
        $appointmentdata['appointments'] = $appointments;
        return view("patient.appointment.index", compact('appointmentdata'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
        $doctors = Doctor::with('user')
            ->with('appointments')
            ->get();
        $createdata['doctors'] = $doctors;
        return view("patient.appointment.create", compact('createdata'));
    }

    /**
     * Store a newly created resource in storage.
     */

    public function store(Request $request)
    {
        //
        $request['time'] =  $request->date . " " . $request->time_hour . ":00";

        $validator = Validator::make($request->input(), [
            'title' => 'required',
            'purpose' => 'required',
            'date' => 'required',
            'time_hour' => 'required',
            'doctor_id' => 'required',
            'time' => [
                'required',
                Rule::unique('appointments', 'time')->where(function (Builder $query) {
                    return $query->where('doctor_id', request()->doctor_id);
                })
            ],
        ]);

        if ($validator->fails()) {
            return back()
                ->withErrors($validator)
                ->withInput();
        }



        $validated = $validator->safe()->except(['date', 'time_hour', 'terms_and_conditions']);
        $this->patient()->appointments()->create(
            $validated
        );
        return redirect(route('patient.appointments.index'))->with('success', 'Appointment added successfully');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //

        $appointment = $this->patient()->appointments()->where('id', $id)->with('doctor.user')->first();
        $appointmentdata['appointment'] = $appointment;
        return view("patient.appointment.show", compact('appointmentdata'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
        $appointment = $this->patient()->appointments()->where('id', $id)->with('doctor.user')->first();
        $appointmentdata['appointment'] = $appointment;
        return view("patient.appointment.edit", compact('appointmentdata'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
        //2023-02-26 05:37:09

        $request['time'] =  $request->date . " " . $request->time . ":00";
        $validation =   $request->validate([
            'title' => 'required',
            'purpose' => 'required',
            'time' => 'required',
            'date' => 'required',
            'doctor_id' => 'required',
            'time' =>  'unique:appointments'
        ]);
        $this->patient()->appointments()->update(
            request()->except(['_method', '_token', 'date', 'terms_and_conditions'])
        );
        return redirect(route('patient.appointments.show', ['appointment' => $id]))->with('success', 'Appointment updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
       $result = Appointments::destroy($id);

       if(!$result)
       return back()->with('error', 'Could not delete this item');

       return redirect(route('patient.appointments.index'))->with('success', 'Appointment deleted successfully');

    }
}
