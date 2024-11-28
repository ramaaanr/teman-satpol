<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Giat extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'kegiatan',
        'detail_kegiatan',
        'tempat',
        'kendaraan',
        'beban_biaya',
        'tanggal_mulai',
        'tanggal_selesai', 
        'akses_mulai',
        'akses_selesai' 
    ];

    public function penugasans()
    {
        return $this->hasMany(Penugasan::class, 'id_giat');
    }
}
