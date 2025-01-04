<?php

namespace App\Http\Controllers\Patient;

use App\Http\Controllers\BaseController;
use App\Http\Controllers\Controller;
use App\Models\Visits;
use Illuminate\Http\Request;

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
        $visits = $this->patient()->visits()
            ->whereHas('appointment')
            ->with('doctor.user')
            ->with('diagnosis')
            ->with('hospital')
            ->get();


        $visitsdata['visits'] = $visits;
        return view('patient.visits.index', compact('visitsdata'));
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
        $visit = $this->patient()->visits()
            ->where('id', $id)
            ->whereHas('appointment')
            ->with('doctor.user')
            ->with('diagnosis')
            ->with('hospital')
            ->first();
        $visitdata['visit'] = $visit;
        return view('patient.visits.show', compact('visitdata'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //s
        $visit = $this->patient()->visits()->where('id', $id)->first();
        $visitdata['visit'] = $visit;
        return view('patient.visits.edit', compact('visitdata'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
        $visit = $this->patient()->visits()->where('id', $id)->first();

        $result = $visit->update(
            $request->except(['_method', '_token'])
        );
        if (!$result)
            return back()->with('error', 'This item could not be updated');
        return redirect(route('patient.visits.show', ['visit' => $id]))->with('success', 'This item has been updated successfully');
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
        return redirect(route('patient.visits.index'))->with('success', 'This item has been deleted successfully');
    }
}
