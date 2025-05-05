<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PaketSoal extends Model
{
    use HasFactory;

    protected $table = 'paket_soals';

    protected $fillable = [
        'title',
        'description',
        'duration',
    ];

    public function latihanSoals()
    {
        return $this->hasMany(LatihanSoal::class);
    }
}
