<?php

use App\Http\Controllers\AdminMateriController;
use App\Http\Controllers\DiskusiController;
use App\Http\Controllers\LatihanController;
use App\Http\Controllers\LeaderboardController;
use App\Http\Controllers\MateriController;
use App\Http\Controllers\PaketSoalController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\SubmitController;
use App\Http\Controllers\TugasController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    // return view('welcome');
    return redirect()->route('dashboard');
});

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});
Route::group(['middleware' => ['auth', 'role:guru,admin,siswa']], function () {

    Route::get('/dashboard', function () {
        return view('dashboard');
    })->middleware(['auth', 'verified'])->name('dashboard');

    Route::resource('materi', MateriController::class);
    Route::post('materi/{materi}/submit', [MateriController::class, 'submitTugas'])->name('materi.submit');
    Route::resource('latihan', LatihanController::class);
    Route::resource('tugas', TugasController::class);
    Route::resource('diskusi', DiskusiController::class);
    Route::resource('paket', PaketSoalController::class);
    Route::get('leaderboard', [LeaderboardController::class, 'index'])->name('leaderboard.index');
});

Route::group(['middleware' => ['auth', 'role:admin,guru']], function () {
    Route::resource('admin/materi', AdminMateriController::class)->names('admin.materi');
});

Route::middleware(['auth'])->group(function () {
    Route::get('/diskusi', [DiskusiController::class, 'index'])->name('diskusi.index');
    Route::get('/diskusi/create', [DiskusiController::class, 'create'])->name('diskusi.create');
    Route::post('/diskusi', [DiskusiController::class, 'store'])->name('diskusi.store');
    Route::get('/diskusi/{diskusi}', [DiskusiController::class, 'show'])->name('diskusi.show');
    Route::post('/diskusi/{diskusi}/comment', [DiskusiController::class, 'comment'])->name('diskusi.comment');

    Route::get('submit', [SubmitController::class, 'index'])->name('submit.index');
    Route::post('submit', [SubmitController::class, 'submit'])->name('submit.submit');
    Route::post('submit/start', [SubmitController::class, 'start'])->name('submit.start');
});


require __DIR__.'/auth.php';
