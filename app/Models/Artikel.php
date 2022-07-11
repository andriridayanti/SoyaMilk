<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Artikel extends Model
{
    use HasFactory;
    protected $table = 'mitra';
    protected $fillable = [
        'mitra_id',
        'judul',
        'penulis',
        'penerbit',
        'isi',
        'gambar'
    ];
}
