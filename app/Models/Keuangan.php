<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Keuangan extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $table = 'keuangan';
    protected $fillable = [
        'pemesanan_produk_id',
        'keterangan',
        'transaksi',
        'harga_satuan',
        'jumlah_transaksi',
        'total_transaksi',
        'deleted_at'
    ];
}
