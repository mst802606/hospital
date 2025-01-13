<?php

namespace App\Http\Controllers\Nurse;

use App\Http\Controllers\BaseController;
use App\Http\Requests\StoreNoteRequest;
use App\Http\Requests\UpdateNoteRequest;
use App\Models\Note;

class NoteController extends BaseController
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //

        $ward_ids = $this->nurse()->wards()->pluck('wards.id');
        $notes = Note::whereIn('ward_id', $ward_ids)->orderBy('created_at', 'DESC')->get(); // Retrieve all notes (you may want to paginate or filter)
        return view('nurse.notes.index', compact('notes'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //

        $wards = $this->nurse()->wards; // Retrieve all wards (assuming you have this model)
        return view('nurse.notes.create', compact('wards'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreNoteRequest $request)
    {
        //
        $request->validate([
            'ward_id' => 'nullable|exists:wards,id',
            'note' => 'required|string',
            'is_active' => 'required|boolean',
        ]);

        $result = $this->nurse()->notes()->create($request->all());

        if (!$result) {
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
            'ward_id' => 'nullable|exists:wards,id',
            'note' => 'required|string',
            'is_active' => 'required|boolean',
        ]);

        $result = $note->update($request->all());
        if (!$result) {
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

        if (!$result) {
            return back()->with('error', 'Failed to delete the note');
        }
        return redirect()->route('nurse.notes.index')->with('success', 'Note deleted successfully.');
    }
}
