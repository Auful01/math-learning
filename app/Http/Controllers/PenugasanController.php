<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PenugasanController extends Controller
{
    //

    public function index()
    {
        // Logic to display the list of assignments
        return view('penugasan.index');
    }

    public function submit(Request $request)
    {
        // Logic to handle assignment submission
        $request->validate([
            'file' => 'required|file|mimes:pdf,doc,docx|max:2048',
        ]);

        // Store the file and save the assignment details in the database
        // ...

        return redirect()->route('penugasan.index')->with('success', 'Assignment submitted successfully.');
    }

    public function show($id)
    {
        // Logic to display a specific assignment
        return view('penugasan.show', compact('id'));
    }
}
