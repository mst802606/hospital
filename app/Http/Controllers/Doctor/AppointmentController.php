<?php

namespace App\Http\Controllers\Doctor;

use App\Http\Controllers\BaseController;
use App\Models\Appointments;
use App\Models\Patient;
use Illuminate\Database\Query\Builder;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;

class AppointmentController extends BaseController
{
    protected $id = null;
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        //  $appointments = $this->doctor()->appointments()->with('doctor.user')->get();
        $appointments = $this->doctor()->appointments()->with('doctor.user')->orderBy('status', 'DESC')->orderBy('created_at', 'DESC')->get();
        $appointmentdata['appointments'] = $appointments;
        return view("doctor.appointment.index", compact('appointmentdata'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
        $patients = Patient::with('user')
            ->with('appointments')
            ->get();
        $createdata['patients'] = $patients;
        return view("doctor.appointment.create", compact('createdata'));
    }

    /**
     * Store a newly created resource in storage.
     */

    public function store(Request $request)
    {
        $request['time'] = $request->date . " " . $request->time_hour . ":00";

        $validator = Validator::make($request->input(), [
            'title' => 'required',
            'purpose' => 'required',
            'date' => 'required',
            'time_hour' => 'required',
            'patient_id' => 'required',
            'time' => [
                'required',
                Rule::unique('appointments', 'time')->where(function (Builder $query) {
                    return $query->where('doctor_id', $this->doctor()->id);
                }),
            ],
        ]);

        if ($validator->fails()) {
            return back()
                ->withErrors($validator)
                ->withInput();
        }

        $validated = $validator->safe()->except(['date', 'time_hour', 'terms_and_conditions']);
        $this->doctor()->appointments()->create(
            $validated
        );
        return redirect(route('doctor.appointments.index'))->with('success', 'Appointment added successfully');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //

        $appointment = $this->doctor()->appointments()->where('id', $id)->with('doctor.user')->first();
        $appointmentdata['appointment'] = $appointment;
        return view("doctor.appointment.show", compact('appointmentdata'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //

        $appointment = $this->doctor()->appointments()->where('id', $id)->with('patient.user')->first();

        $patients = Patient::with('user')
            ->with('appointments')
            ->get();
        $appointmentdata['patients'] = $patients;
        $appointmentdata['appointment'] = $appointment;
        return view("doctor.appointment.edit", compact('appointmentdata'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
        //2023-02-26 05:37:09

        $appointment = $this->doctor()->appointments()->where('id', $id)->first();
        $this->id = $id;

        $request['time'] = $request->date . " " . $request->time_hour . ":00";

        $validator = Validator::make($request->input(), [
            'title' => 'required',
            'purpose' => 'required',
            'date' => 'required',
            'time_hour' => 'required',
            'patient_id' => 'required',
            'time' => [
                'required',
                Rule::unique('appointments', 'time')
                    ->where(function (Builder $query) {
                        return $query
                            ->where($this->id, '!=', $this->id)
                            ->where('doctor_id', $this->doctor()->id);
                    }),
            ],
        ]);

        if ($validator->fails()) {
            return back()
                ->withErrors($validator)
                ->withInput();
        }

        $validated = $validator->safe()->except(['date', 'time_hour', 'terms_and_conditions']);
        $this->doctor()->appointments()->where('id', $id)->update(
            $validated
        );
        return redirect(route('doctor.appointments.show', ['appointment' => $id]))->with('success', 'Appointment updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
        //
        $result = Appointments::destroy($id);

        if (!$result) {
            return back()->with('error', 'Could not delete this item');
        }

        return redirect(route('doctor.appointments.index'))->with('success', 'Appointment deleted successfully');
    }
}
