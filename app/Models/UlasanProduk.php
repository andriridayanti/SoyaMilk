<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UlasanProduk extends Model
{
    use HasFactory;
    protected $table = 'ulasan_produk';
    protected $fillable = [
        'produk_id',
        'customer_id',
        'deskripspi',
        'gambar'
    ];
}
