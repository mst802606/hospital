<?php

namespace App\Http\Controllers\Nurse;

use App\Http\Controllers\BaseController;
use App\Http\Requests\StoreWardRequest;
use App\Http\Requests\UpdateWardRequest;
use App\Models\Ward;

class WardController extends BaseController
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //

        $wards = $this->nurse()->wards()->get();

        return view('nurse.wards.index', compact('wards'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
        return view('nurse.wards.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreWardRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Ward $ward)
    {
        //

        $ward = Ward::where('id', $ward->id)->with('patients')->first();

        return view('nurse.wards.show', compact('ward'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Ward $ward)
    {
        //

        $ward = Ward::where('id', $ward->id)->with('patients')->first();

        return view('nurse.wards.create', compact('ward'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateWardRequest $request, Ward $ward)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Ward $ward)
    {
        //
    }
}
