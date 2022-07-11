<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Produk extends Model
{
    use HasFactory;
    protected $table = 'produk';
    protected $fillable = [
        'mitra_id',
        'nama_produk',
        'stok',
        'harga',
        'berat',
        'gambar'
    ];
}
