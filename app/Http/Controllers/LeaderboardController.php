<?php

namespace App\Http\Controllers;

use App\Models\Leaderboard;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class LeaderboardController extends Controller
{
    public function index()
    {
        $data = DB::select('
            SELECT users.name AS name, AVG(score) AS avg_score
            FROM submit
            JOIN users ON submit.user_id = users.id
            GROUP BY submit.user_id
        ');

        return view('leaderboard', compact('data'));
    }

}
