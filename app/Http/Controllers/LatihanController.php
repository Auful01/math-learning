<?php

namespace App\Http\Controllers;

use App\Models\LatihanSoal;
use App\Models\PaketSoal;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LatihanController extends Controller
{
    public function index(Request $request)
    {
        $soals = LatihanSoal::latest()->paginate(10);
        $paket = PaketSoal::find($request->paket);
        if ($paket) {
            $soals = LatihanSoal::where('paket_soal_id', $request->paket)->latest()->paginate(10);
        }
        if(Auth::user()->role == 'admin' || Auth::user()->role == 'guru') {
            return view('admin.latihan_soal.index', compact('soals', 'paket'));
        }else{
            return view('siswa.latihan_soal.index', compact('soals', 'paket'));
        }
    }

    public function create()
    {
        $paket= PaketSoal::all();
        return view('admin.latihan_soal.create',compact('paket'));
    }

    public function store(Request $request)
    {
        try {
            $request->validate([
                'question' => 'required|string',
                'options' => 'required|array',
                'correct_answer' => 'required|string|in:A,B,C,D',
                'paket_soal_id' => 'required',
            ]);

            $request['options'] = json_encode($request->options);
            LatihanSoal::create([
                'question' => $request->question,
                'options' => $request->options,
                'correct_answer' => $request->correct_answer,
                'paket_soal_id' => $request->paket_soal_id,
            ]);

            return redirect()->route('latihan.index', 'paket=' . $request->paket_soal_id)->with('success', 'Soal berhasil dibuat.');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', $e->getMessage());
        }
    }

    public function edit(LatihanSoal $latihan)
    {
        return view('admin.latihan_soal.edit', compact('latihan'));
    }

    public function update(Request $request, LatihanSoal $latihan)
    {
        $request->validate([
            'question' => 'required|string',
            'options' => 'required|array',
            'correct_answer' => 'required|string|in:A,B,C,D',
        ]);

        $latihan->update([
            'question' => $request->question,
            'options' => $request->options,
            'correct_answer' => $request->correct_answer,
        ]);


        return redirect()->route('latihan.index','paket='.$latihan->paket_soal_id)->with('success', 'Soal berhasil diperbarui.');
    }

    public function destroy(LatihanSoal $latihan)
    {
        $latihan->delete();
        return redirect()->route('latihan.index','paket='.$latihan->paket_soal_id)->with('success', 'Soal berhasil dihapus.');
    }
}
