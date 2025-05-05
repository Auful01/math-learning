<?php

namespace App\Http\Controllers;

use App\Models\Tugas;
use Illuminate\Http\Request;

class TugasController extends Controller
{
    public function index()
    {
        $tugas = Tugas::where('user_id', auth()->id())->get();
        return view('tugas.index', compact('tugas'));
    }

    public function create()
    {
        return view('tugas.create');
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'title' => 'required',
            'file_path' => 'required|file|mimes:pdf,doc,docx,jpg,jpeg,png|max:10240',
        ]);

        $data['file_path'] = $request->file('file_path')->store('tugas', 'public');
        $data['user_id'] = auth()->id();

        Tugas::create($data);

        return redirect()->route('tugas.index')->with('success', 'Tugas berhasil dikumpulkan.');
    }
}
