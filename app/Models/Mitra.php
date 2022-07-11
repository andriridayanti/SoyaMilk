<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Mitra extends Model
{
    use HasFactory;
    protected $table = 'mitra';
    protected $fillable = [
        'user_id',
        'nama',
        'email',
        'password',
        'no_telp',
        'jenis_kelamin',
        'alamat',
        'desa',
        'kecamatan'
    ];
}
