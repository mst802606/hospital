<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\BaseController;
use App\Models\Nurse;
use App\Models\Ward;
use Illuminate\Http\Request;

class AllocateNursesToWardController extends BaseController
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //

        $wards = $this->hospital()->wards;
        $nurses = $this->hospital()->nurses()->with('user')->get();

        return view('admin.wards.allocate_nurses.index', compact('wards', 'nurses'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
        $wards = $this->hospital()->wards;
        $nurses = $this->hospital()->nurses()->with('user')->get();

        return view('admin.wards.allocate_nurses.create', compact('wards', 'nurses'));

    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //

        $request->validate(
            [
                'nurse_id' => ['required', 'integer'],
                'ward_id' => ['required', 'integer'],
            ]
        );

        $nurse = Nurse::where('id', $request->nurse_id)->first();

        $ward = Ward::where('id', $request->ward_id)->first();

        $nurse->wards()->syncWithoutDetaching([$ward->id]);
        $result = $nurse->wards()->where('wards.id', $ward->id)->first();
        if (!$result) {
            return back()->with('error', "The nurse could not be allocated to the ward.");
        }

        return redirect(route('admin.wards.show', ['ward' => $ward]))->with('success', "Nurse allocated to the ward");
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
