<?php

namespace App\Http\Controllers;

use App\Models\Materi;
use App\Models\Penugasan;
use Illuminate\Http\Request;

class MateriController extends Controller
{
    public function index()
    {
        $materis = Materi::latest()->get();
        return view('siswa.materi.index', compact('materis'));
    }

    public function create()
    {
        return view('materi.create');
    }

    public function store(Request $request)
    {
        try {
            //code...
            $data = $request->validate([
                'title' => 'required',
                'content' => 'nullable',
                'type' => 'required|in:text,video',
                'file_url' => 'nullable|file|mimes:mp4|max:10240', // max 10MB
                'batas_waktu' => 'nullable|date',
                'is_penugasan' => 'nullable|boolean',
                'is_archived' => 'nullable|boolean',
            ]);

            if ($request->hasFile('file_url')) {
                $data['file_url'] = $request->file('file_url')->store('materi', 'public');
            }

            Materi::create($data);

            return redirect()->route('materi.index')->with('success', 'Materi berhasil ditambahkan.');
        } catch (\Throwable $th) {
            //throw $th;
            return redirect()->back()->with('error', $th->getMessage());
        }
    }

    public function show(Materi $materi)
    {
        $penugasan = Penugasan::where('materi_id', $materi->id)->where('user_id', auth()->id())->first();
        // dd($penugasan);
        return view('siswa.materi.show', compact('materi', 'penugasan'));
    }

    public function edit(Materi $materi)
    {
        return view('materi.edit', compact('materi'));
    }

    public function update(Request $request, Materi $materi)
    {
        $data = $request->validate([
            'title' => 'required',
            'content' => 'nullable',
            'type' => 'required|in:text,video',
            'file_url' => 'nullable|file|mimes:mp4|max:10240',
        ]);

        if ($request->hasFile('file_url')) {
            $data['file_url'] = $request->file('file_url')->store('materi', 'public');
        }

        $materi->update($data);

        return redirect()->route('materi.index')->with('success', 'Materi berhasil diupdate.');
    }




    public function destroy(Materi $materi)
    {
        $materi->update([
            'is_archived' => true,
        ]);
        return redirect()->route('materi.index')->with('success', 'Materi berhasil dihapus.');
    }

    public function submitTugas(Request $request, Materi $materi)
    {
        try {
            //code...
            $request->validate([
                'file' => 'required|file|mimes:pdf|max:10240', // max 10MB
            ]);

            $file = $request->file('file')->store('penugasan', 'public');

            // Simpan file ke database
            Penugasan::create([
                'user_id' => auth()->id(),
                'materi_id' => $materi->id,
                'file' => $file,
                'status' => 'dikumpulkan',
            ]);

            return redirect()->back()->with('success', 'Tugas berhasil dikumpulkan.');
        } catch (\Throwable $th) {
            //throw $th;
            return redirect()->back()->with('error', $th->getMessage());
        }
    }
}
