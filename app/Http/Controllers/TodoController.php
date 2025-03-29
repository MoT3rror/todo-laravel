<?php

namespace App\Http\Controllers;

use App\Models\Todo;
use Illuminate\Http\Request;

class TodoController extends Controller
{
    /**
     * Store a newly created todo in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
        ]);

        $todo = new Todo();
        $todo->title = $request->title;
        $todo->user_id = $request->user()->id; // Associate the todo with the authenticated user
        $todo->save();

        return redirect()->route('dashboard')->with('success', 'Todo created successfully!');
    }
}
