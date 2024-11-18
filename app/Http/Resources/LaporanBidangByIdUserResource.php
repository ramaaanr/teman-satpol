<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class LaporanBidangByIdUserResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'nama' => $this->resource['durasi_by_user']->first()->nama ?? 'Tidak Ditemukan',
            'jabatan' => $this->resource['durasi_by_user']->first()->jabatan ?? 'Tidak Ditemukan',
            'role' => $this->resource['durasi_by_user']->first()->role ?? 'Tidak Ditemukan',
    
            'data_item' => isset($this->resource['durasi_by_user']) ? 
                $this->resource['durasi_by_user']->map(function ($durasi) {
                    return [
                        'id_item' => $durasi->id_item,
                        'deskripsi' => $durasi->deskripsi ?? 'Tidak Ditemukan', // Pastikan deskripsi diambil
                        'total_durasi' => round($durasi->total_durasi / 3600, 2), // Durasi dalam jam
                    ];
                }) : [],
    
            'riwayat_giat' => isset($this->resource['riwayat_giat']) ? 
                $this->resource['riwayat_giat'] : [],
        ];
    }
}
