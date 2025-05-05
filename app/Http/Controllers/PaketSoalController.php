<?php

namespace App\Http\Controllers;

use App\Models\PaketSoal;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PaketSoalController extends Controller
{
    public function index()
    {
        // dd($pakets);
        if (Auth::user()->role == 'admin' || Auth::user()->role == 'guru' ) {
            $pakets = PaketSoal::withCount('latihanSoals')->latest()->paginate(10);
            # code...
            return view('admin.paket_soal.index', compact('pakets'));
        }else{
            $pakets = PaketSoal::where('is_archived', false)->withCount('latihanSoals')->latest()->paginate(10);
            return view('siswa.paket_soal.index', compact('pakets'));
        }
    }

    public function create()
    {
        return view('admin.paket_soal.create');
    }

    public function store(Request $request)
    {
        try {
            //code...
            $request->validate([
                'title' => 'required|string',
                'duration' => 'required',
            ]);

            $paket = PaketSoal::create($request->only('title', 'duration', 'description'));

            // return dengan title dan paket ini
            return redirect()->route('latihan.index', 'paket='. $paket->id)->with('success', 'Paket soal dibuat. Silakan tambahkan soal ke dalam paket ini.')->with('paket', $paket->id);
        } catch (\Throwable $th) {
            //throw $th;
            return redirect()->back()->with('error', $th->getMessage());
        }
    }

    public function edit(PaketSoal $paket)
    {
        return view('admin.paket_soal.edit', compact('paket'));
    }

    public function update(Request $request, PaketSoal $paket)
    {
        try {
            $validated = $request->validate([
                'title' => 'required|string',
                'duration' => 'required|integer',
                'description' => 'nullable|string',
            ]);

            // Ubah duration ke string
            $validated['duration'] = (string) $validated['duration'];

            $paket->update($validated);
            return redirect()->route('paket.index')->with('success', 'Paket soal diperbarui.');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', $e->getMessage());
        }
    }



    public function destroy(PaketSoal $paket)
    {
        $paket->update([
            'is_archived' => true,
        ]);
        return redirect()->route('paket.index')->with('success', 'Paket soal dihapus.');
    }
}
