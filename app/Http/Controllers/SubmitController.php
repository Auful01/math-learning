<?php

namespace App\Http\Controllers;

use App\Models\LatihanSoal;
use App\Models\PaketSoal;
use App\Models\Submit;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class SubmitController extends Controller
{
    //
    public function index()
    {
        $user = auth()->user();
        $pakets = PaketSoal::get();

        if ($user->role == 'admin' || $user->role == 'guru') {
            $submits = Submit::with('paketSoal','user')->paginate(10);
        } else {
            $submits = Submit::where('user_id', $user->id)->with('paketSoal')->paginate(10);
        }
        return view('siswa.submit.index', compact('submits', 'pakets'));
    }



    public function start(Request $request){
        $user = auth()->user();
        $paketSoal = PaketSoal::find($request->paket_soal_id);

        $submit = Submit::create([
            'user_id' => $user->id,
            'paket_soal_id' => $paketSoal->id,
            'waktu_mulai' => now(),
            'waktu_selesai' => now()->addMinutes($paketSoal->duration),
        ]);

        return response()->json(['message' => 'Start successful',
            'submit' => $submit,
        ], 201);
    }

    public function submit(Request $request)
    {
        // Validate the request

        // Grading Score
        $score = 0;
        $totalSoal = LatihanSoal::where('paket_soal_id', $request['paket_soal_id'])->count();
        $answers = json_decode($request->input('answers'), true);
        foreach ($answers as $key => $value) {
            // dd($value->soalId);
            $soal = LatihanSoal::find($value['soalId']);
            if ($soal && $soal->correct_answer == $value['answer']) {
                $score++;
            }
        }
        if ($score != 0) {
            # code...
            $score = ($score / $totalSoal) * 100;
        }
        $request['score'] = round($score, 2);

        Submit::find($request->submit_id)->update([
            'score' => $request['score'],
            'waktu_selesai' => now()
        ]);

        return response()->json(['message' => 'Submit successful'], 201);
    }
}
