<?php
namespace App\Http\Controllers\Nurse;

use App\Http\Controllers\BaseController;
use App\Http\Requests\StoreNoteRequest;
use App\Http\Requests\UpdateNoteRequest;
use App\Models\Note;
use App\Models\Patient;

class NoteController extends BaseController
{
    /**
     * Display a listing of the resource.
     */
    public function index($patient = null)
    {
        //

        $ward_ids = $this->nurse()->wards()->pluck('wards.id');
        $patients = Patient::whereIn('ward_id', $ward_ids)->get();

        $notes = Note::whereIn('ward_id', $ward_ids)->orderBy('created_at', 'DESC')->get();

        if ($patient) {
            $patient = Patient::where('id', $patient)->first();
            $notes   = $patient->notes;
        }
        return view('nurse.notes.index', compact('notes'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create($patient = null)
    {
        //

        $wards = $this->nurse()->wards;

        $ward_ids = $this->nurse()->wards()->pluck('wards.id');
        $patients = Patient::whereIn('ward_id', $ward_ids)->get();
        if ($patient) {
            $patients = Patient::where('id', $patient)->get();
        }

        return view('nurse.notes.create', compact('wards', 'patients'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreNoteRequest $request)
    {
        //
        $request->validate([
            'patient_id' => 'nullable|exists:wards,id',
            // 'ward_id'    => 'nullable|exists:wards,id',
            'note'       => 'required|string',
            'is_active'  => 'required|boolean',
        ]);

        $patient = Patient::where('id', $request->patient_id)->first();
        $ward_id = $patient->ward_id;
        $result  = $this->nurse()->notes()->create([
            "patient_id" => $request->patient_id,
            "ward_id"    => $ward_id,
            "note"       => $request->note,
            "is_active"  => $request->is_active,
        ]);

        if (! $result) {
            return back()->with('error', 'Failed to create note');
        }
        return redirect()->route('nurse.notes.index')->with('success', 'Note created successfully.');

    }

    /**
     * Display the specified resource.
     */
    public function show(Note $note)
    {
        //

        return view('nurse.notes.show', compact('note'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Note $note)
    {
                                        //
        $wards = $this->nurse()->wards; // Retrieve all wards for the dropdown
        return view('nurse.notes.edit', compact('note', 'wards'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateNoteRequest $request, Note $note)
    {
        //
        $request->validate([
            'ward_id'   => 'nullable|exists:wards,id',
            'note'      => 'required|string',
            'is_active' => 'required|boolean',
        ]);

        $result = $note->update($request->all());
        if (! $result) {
            return back()->with('error', 'Failed to delete the note');
        }

        return redirect()->route('nurse.notes.index')->with('success', 'Note updated successfully.');

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Note $note)
    {
        //

        $result = Note::destroy($note->id);

        if (! $result) {
            return back()->with('error', 'Failed to delete the note');
        }
        return redirect()->route('nurse.notes.index')->with('success', 'Note deleted successfully.');
    }
}
