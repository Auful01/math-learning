<?php

namespace App\Http\Controllers;

use App\Models\Materi;
use Illuminate\Http\Request;

class AdminMateriController extends Controller
{
    public function index()
    {
        $materis = Materi::all();
        return view('admin.materi.index', compact('materis'));
    }

    public function create()
    {
        return view('admin.materi.create');
    }

    public function store(Request $request)
    {
        try {
            if ($request->hasFile('file')) {
                $request['file_url'] = $request->file('file')->store('materi', 'public');
            }
            // dd($request->all());
            $request->validate([
                'title' => 'required|string|max:255',
                'content' => 'required',
                'type' => 'required|in:text,video',
                'file_url' => 'required',
            ]);

            Materi::create($request->all());

            return redirect()->route('admin.materi.index')->with('success', 'Materi berhasil ditambahkan.');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', $e->getMessage());
        }
    }

    public function edit(Materi $materi)
    {
        return view('admin.materi.edit', compact('materi'));
    }

    public function update(Request $request, Materi $materi)
    {
        try {
            $request['is_penugasan'] = $request['is_penugasan'] == 'on' ? true : false;
            if ($request->hasFile('file')) {
                $request['file_url'] = $request->file('file')->store('materi', 'public');
            }else{
                $request['file_url'] = $materi->file_url;
            }

            $request->validate([
                'title' => 'required|string|max:255',
                'content' => 'required',
                'type' => 'required|in:text,video',
                'file_url' => 'required',
            ]);

            $materi->update($request->all());

            return redirect()->route('admin.materi.index')->with('success', 'Materi berhasil ditambahkan.');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', $e->getMessage());
        }
    }

    public function destroy(Materi $materi)
    {
        $materi->delete();

        return redirect()->route('admin.materi.index')->with('success', 'Materi berhasil dihapus.');
    }
}
