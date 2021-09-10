<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RawatInap extends Model
{
    use HasFactory;

    protected $fillable = [
        'no_reg',
        'id_pasien',
        'id_kamar',
        'tanggal_masuk',
        'tanggal_keluar',
        'penanggung_jawab',
        'hubungan_penanggung_jawab',
        'diagnosa_awal',
        'penerimaan',
    ];

    protected $with = ['pasien','kamar'];

    public function pasien(){
        return $this->belongsTo(Pasien::class,'id_pasien');
    }

    public function kamar(){
        return $this->belongsTo(Kamar::class, 'id_kamar');
    }

    public function perawatan(){
        return $this->hasMany(Perawatan::class, 'id_rawat');
    }
}
