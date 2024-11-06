<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Note;

class NoteController
{
    public function index()
    {
        $notes = Note::all();
        return view('notes.index', ['notes' => $notes]);
    }


    public function create()
    {
        return view('notes.create');
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'title' => 'required|max:255',
            'description' => 'required|max:255',
            'content' => 'required|max:10000',
        ]);

        $newNote = Note::create($data);

        return redirect()->route('note.index')->with('success', 'Note created successfully!');
    }

    public function edit(Note $note)
    {
        return view('notes.edit', ['note' => $note]);
    }

    public function update(Note $note, Request $request)
    {
        $data = $request->validate([
            'title' => 'required | string | max: 255',
            'description' => 'required | string | max: 255',
            'content' => 'required | string | max: 100000',
        ]);

        $note->update($data);

        return redirect(route('note.index'))->with('success', 'Note has been successfully updated!');
    }

    public function destroy($id)
    {
        $note = Note::findOrFail($id);
        $note->delete();

        // Set a flash message
        session()->flash('success', 'Note deleted successfully');

        // Redirect back to the notes page
        return redirect()->back();
    }
}
