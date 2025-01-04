<?php

namespace App\Http\Controllers\Doctor;

use App\Http\Controllers\BaseController;
use App\Http\Controllers\Controller;
use App\Models\Donation;
use App\Models\Patient;
use Illuminate\Http\Request;

class DonationController extends BaseController
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
        $donations =  Donation::with('patients.user')->with('hospital')->with('doctor.user')->orderBy('created_at',"DESC")->get();
        $donationsdata['donations'] = $donations;
        return view('doctor.donation.index', compact('donationsdata'));
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
        return view('doctor.donation.create', compact('createdata'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
        $request['time'] =  $request->date . " " . $request->time . ":00";
        $validation =   $request->validate([
            'organ' => 'required',
            'time' => 'required',
            'date' => 'required',
            'patient_id' => 'required',
            'terms_and_conditions' => 'required',
        ]);
        $this->doctor()->donations()->create(
            request()->except(['date', 'terms_and_conditions'])
        );
        return redirect(route('doctor.donations.index'))->with('success', 'Donation appointment added successfully');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
        $donation = Donation::where('id', $id)->first();

        $donationdata['donation'] = $donation;
        return view('doctor.donation.show', compact('donationdata'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
        $donation = Donation::where('id', $id)->first();
        $donationdata['donation'] = $donation;
        return view('doctor.donation.edit', compact('donationdata'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
        $donation = Donation::where('id', $id)->first();

        $request['time'] =  $request->date . " " . $request->time . ":00";
        $validation =   $request->validate([
            'time' => 'required',
            'date' => 'required',
            'donor_message' => 'required',
            'organ' =>  'unique:donations'
        ]);
        $result =  $donation->update(
            request()->except(['_method', '_token', 'date',])
        );

        if (!$result)
            return back()->with('error', 'This item could not be updated');
        return redirect(route('doctor.donations.show', ['donation' => $id]))->with('success', 'This item has been updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
        $result =  Donation::destroy($id);
        if (!$result)
            return back()->with('error', 'This item could not be deleted');
        return redirect(route('doctor.donations.index'))->with('success', 'This item has been deleted successfully');
    }
}
