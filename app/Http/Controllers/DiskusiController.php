<?php
namespace App\Http\Controllers;

use App\Models\Diskusi;
use App\Models\KomentarDiskusi;
use Illuminate\Http\Request;

class DiskusiController extends Controller
{
    public function index()
    {
        $diskusis = Diskusi::latest()->paginate(10);
        return view('diskusi.index', compact('diskusis'));
    }

    public function create()
    {
        return view('diskusi.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'content' => 'required',
        ]);

        Diskusi::create([
            'content' => $request->content,
            'user_id' => auth()->id(),
        ]);

        return redirect()->route('diskusi.index')->with('success', 'Diskusi berhasil dibuat!');
    }

    public function show(Diskusi $diskusi)
    {
        $diskusi->load('comments.user');
        return view('diskusi.show', compact('diskusi'));
    }

    public function comment(Request $request, Diskusi $diskusi)
    {
        $request->validate([
            'comment' => 'required',
        ]);

        KomentarDiskusi::create([
            'diskusi_id' => $diskusi->id,
            'user_id' => auth()->id(),
            'comment' => $request->comment,
        ]);

        return back()->with('success', 'Komentar ditambahkan!');
    }
}
