<?php

namespace App\Http\Controllers\Admin;

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

        $wards = $this->hospital()->wards()->get();

        return view('admin.wards.index', compact('wards'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
        return view('admin.wards.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreWardRequest $request)
    {
        //
        $result = $this->hospital()->wards()->create($request->validated());

        if (!$result) {
            return back()->with('error', " Bad request, could not create the ward");
        }
        return redirect(route('admin.wards.index'))->with('success', 'Ward added successfully');
    }

    /**
     * Display the specified resource.
     */
    public function show(Ward $ward)
    {
        //

        $ward = Ward::where('id', $ward->id)->with('patients')->first();

        return view('admin.wards.show', compact('ward'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Ward $ward)
    {
        //

        $ward = Ward::where('id', $ward->id)->with('patients')->first();

        return view('admin.wards.create', compact('ward'));
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
