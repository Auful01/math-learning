<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class KomentarDiskusi extends Model
{
    use HasFactory;

    protected $fillable = ['diskusi_id', 'user_id', 'comment'];

    public function diskusi()
    {
        return $this->belongsTo(Diskusi::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
