<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\BaseController;
use App\Models\Nurse;
use App\Models\User;
use Illuminate\Http\Request;

class NurseController extends BaseController
{

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        $nurse = Nurse::orderBy('created_at', 'DESC')->orderBy('available', 'DESC')->get();
        $nursesdata['nurses'] = $nurse;
        return view('admin.nurses.index', compact('nursesdata'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return redirect(route('admin.nurses.register'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {

        request()->validate([
            "user_id" => "required",
            "office_days" => "required",
            "available" => "required",
            "ward" => "required|integer",
        ]);

        $hospital_id = 1;
        $tag = rand(57777, 888888);

        $request['hospital_id'] = $hospital_id;
        $request['tag'] = $tag;

        $user = User::where('id', $request->user_id)->first();

        $nurse = $user->nurse()->create($request->except('ward'));

        if (!$nurse) {
            return back() > with('error', 'Could not create nurse account');
        }

        $nurse->wards()->syncWithoutDetaching([$request->ward]);

        return redirect(route('admin.nurses.index'))->with('success', 'Account created successfully');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //

        $nurse = Nurse::where('id', $id)->first();
        return view('admin.nurses.show', compact('nurse'));
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

        return view('admin.nurses.edit', compact('nursedata'));
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

        return redirect(route('admin.nurses.show', ['nurse' => $id]))->with('success', 'Update success');
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

        return redirect(route('admin.nurses.index'))->with('success', 'Deletion success');
    }
}
