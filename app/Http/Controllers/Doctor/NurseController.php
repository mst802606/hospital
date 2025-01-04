<?php

namespace App\Http\Controllers\Doctor;

use App\Http\Controllers\Controller;
use App\Models\Nurse;
use App\Models\User;
use Illuminate\Http\Request;

class NurseController extends Controller
{

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        $nurse = Nurse::orderBy('created_at', 'DESC')->orderBy('available', 'DESC')->get();
        $nursessdata['nurses'] = $nurse;
        return view('doctor.nurse.index', compact('nursessdata'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $createdata['users'] = User::where('role', 2)->whereDoesntHave('nurse')->get();
        return view('doctor.nurse.create', compact('createdata'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {

        request()->validate([
            "user_id" => "required",
            "department" => "required",
            "role" => "required",
            "office" => "required",
            "office_days" => "required",
            "office_hours" => "required",
            "available" => "required",
        ]);

        $hospital_id = 1;
        $tag = rand(57777, 888888);

        $request['hospital_id'] = $hospital_id;
        $request['tag'] = $tag;

        $user = User::where('id', $request->user_id)->first();

        $result = $user->nurse()->create($request->all());
        if (!$result) {
            return back() > with('error', 'Could not create nurse account');
        }

        return redirect(route('doctor.nurses.index'))->with('success', 'Account created successfully');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //

        $nurse = Nurse::where('id', $id)->first();
        $nursedata['nurse'] = $nurse;
        return view('doctor.nurse.show', compact('nursedata'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //

        $nurse = Nurse::where('id', $id)->with('user')->first();
        $nursedata['nurse'] = $nurse;
        $nursedata['nurses'] = User::where('role', 2)->whereDoesntHave('nurse')->get();

        //  dd($nursedata['nurse']);

        return view('doctor.nurse.edit', compact('nursedata'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //;

        $nurse = Nurse::where('id', $id)->with('user')->first();

        $result = $nurse->update($request->all());
        if (!$result) {
            return back()->with('error', 'Could not create nurse account');
        }

        return redirect(route('doctor.nurses.show', ['nurse' => $id]))->with('success', 'Update success');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
        $result = Nurse::destroy($id);
        if (!$result) {
            return back()->with('error', 'Could not delete nurse account');
        }

        return redirect(route('doctor.nurses.index'))->with('success', 'Deletion success');
    }
}
