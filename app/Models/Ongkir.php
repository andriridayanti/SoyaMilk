<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ongkir extends Model
{
    use HasFactory;
    protected $table = 'ongkir';
    protected $fillable = [
        'kecamatan_id',
        'harga_ongkir'
    ];
}
