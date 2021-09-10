<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pasien extends Model
{
    use HasFactory;

    protected $fillable = [
        'no_rm',
        'nama',
        'no_ktp',
        'tanggal_lahir',
        'pendidikan',
        'pekerjaan',
        'alamat',
        'status_perkawinan',
        'jenis_kelamin',
        'agama',
    ];
}
