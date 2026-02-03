<?php

namespace App\Http\Controllers;

use App\Models\Note;
use App\Http\Requests\StoreNoteRequest;
use App\Http\Requests\UpdateNoteRequest;
use Illuminate\Http\Request;

class NoteController extends Controller
{
    /** Display a listing of notes. */
    public function index(Request $request)
    {
        $q = $request->query('q');

        $query = Note::query();

        if ($q) {
            $query->where(function ($sub) use ($q) {
                $sub->where('title', 'like', "%{$q}%")
                    ->orWhere('body', 'like', "%{$q}%");
            });
        }

        $notes = $query->latest()->paginate(10)->withQueryString();

        return view('notes.index', compact('notes', 'q'));
    }

    /** Show form to create a note. */
    public function create()
    {
        return view('notes.create');
    }

    /** Store a new note. */
    public function store(StoreNoteRequest $request)
    {
        $data = $request->validated();

        $note = Note::create($data);

        return redirect()->route('notes.show', $note)->with('success', 'Note created.');
    }

    /** Display a specific note. */
    public function show(Note $note)
    {
        return view('notes.show', compact('note'));
    }

    /** Show form to edit a note. */
    public function edit(Note $note)
    {
        return view('notes.edit', compact('note'));
    }

    /** Update an existing note. */
    public function update(UpdateNoteRequest $request, Note $note)
    {
        $data = $request->validated();

        $note->update($data);

        return redirect()->route('notes.show', $note)->with('success', 'Note updated.');
    }

    /** Delete a note. */
    public function destroy(Note $note)
    {
        $note->delete();

        return redirect()->route('notes.index')->with('success', 'Note deleted.');
    }
}
