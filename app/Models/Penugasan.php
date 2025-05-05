<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Penugasan extends Model
{
    use HasFactory;

    protected $table = 'penugasan';


    protected $fillable = [
        'user_id',
        'materi_id',
        'file',
        'status',
        'nilai',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function materi()
    {
        return $this->belongsTo(Materi::class);
    }

    public function getFileAttribute($value)
    {
        return $value ? asset('storage/' . $value) : null;
    }

}
