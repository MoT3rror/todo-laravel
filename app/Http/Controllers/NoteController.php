<?php

namespace App\Http\Controllers;

use App\Models\Note;
use Illuminate\Http\Request;

class NoteController extends Controller
{
    /**
     * Store a newly created note in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
        ]);

        $note = new Note();
        $note->title = $request->title;
        $note->user_id = $request->user()->id; // Associate the note with the authenticated user
        $note->save();

        return redirect()->route('dashboard')->with('success', 'Note created successfully!');
    }
}
