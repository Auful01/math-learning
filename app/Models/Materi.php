<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Materi extends Model
{
    use HasFactory;

    protected $fillable = ['title', 'content', 'type', 'file_url', 'batas_waktu', 'is_penugasan', 'is_archived', 'file_type', 'file_size'];
}
