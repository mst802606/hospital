<?php
namespace App\Http\Controllers\Nurse;

use App\Http\Controllers\BaseController;
use App\Models\Patient;
use Illuminate\Http\Request;

class PatientController extends BaseController
{
    /**
     * Display a listing of the resource.
     */

    public function search(Request $request)
    {
        $search = $request->input('search');

        $ward_ids = $this->nurse()->wards()->pluck('wards.id');

        // Perform the search query based on name or ID
        $patients = Patient::where('id', 'like', '%' . $search . '%')
            ->orWhereHas('user', function ($query) use ($search) {
                $query->where('username', 'like', '%' . $search . '%');
            })
            ->whereIn('ward_id', $ward_ids)
            ->with(['user', 'hospital', 'ward'])
            ->get();

        $patients = $patients->where('status', true);

        return view('nurse.patients.index', compact('patients'));
    }

    public function index()
    {
        //

        $ward_ids = $this->nurse()->wards()->pluck('wards.id');

        $patients = Patient::whereIn('ward_id', $ward_ids)->where('status', true)->get();
        return view('nurse.patients.index', compact('patients'));
    }

    /**s
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
        $patient = Patient::where('id', $id)->first();
        return view('nurse.patients.show', compact('patient'));
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
