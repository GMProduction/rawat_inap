<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Perawatan extends Model
{
    use HasFactory;

    protected $fillable = [
        'id_rawat',
        'id_dokter',
        'id_perawat',
        'id_obat',
        'id_tindakan',
        'tanggal',
        'tensi_darah',
        'suhu_badan',
        'biaya',
    ];

    protected $with = ['dokter','perawat','obat','tindakan'];

    public function dokter(){
        return $this->belongsTo(Dokter::class, 'id_dokter');
    }

    public function perawat(){
        return $this->belongsTo(Perawat::class,'id_perawat');
    }

    public function obat(){
        return $this->belongsTo(Obat::class, 'id_obat');
    }

    public function tindakan(){
        return $this->belongsTo(Tindakan::class, 'id_tindakan');
    }

}
