<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Mahasiswa extends Model
{
    use HasFactory;

    protected $fillable = [
        'nim',
        'nama_mahasiswa',
        'email',
        'jurusan',
        'dosen_id',
    ];
    public function dosen()
    {
        return $this->belongsTo(Dosen::class); // Mahasiswa dimiliki oleh satu Dosen
    }
}
