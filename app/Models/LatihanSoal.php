<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LatihanSoal extends Model
{
    use HasFactory;

    protected $table = 'latihan_soals';

    protected $fillable = [
        'question',
        'options',
        'correct_answer',
        'paket_soal_id',
    ];
}
