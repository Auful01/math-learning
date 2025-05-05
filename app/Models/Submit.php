<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Submit extends Model
{
    use HasFactory;

    protected $table = 'submit';
    public $timestamps = false;

    protected $fillable = [
        'user_id',
        'paket_soal_id',
        'score',
        'waktu_mulai',
        'waktu_selesai',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
    public function paketSoal()
    {
        return $this->belongsTo(PaketSoal::class);
    }
    public function latihanSoal()
    {
        return $this->hasMany(LatihanSoal::class);
    }

}
