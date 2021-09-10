<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pembayaran extends Model
{
    use HasFactory;

    protected $fillable = [
        'id_rawat',
        'biaya_kamar',
        'jumlah_hari',
        'total_biaya_kamar',
        'biaya_perawatan',
        'total_biaya',
        'status',
    ];
}
