<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class LaporanBidangByIdItemResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
{
    return [
        'id_item' => $this->resource['id_item'] ?? null,
        'deskripsi' => $this->resource['deskripsi'] ?? 'Tidak Ditemukan',
        'total_durasi_pengguna' => $this->resource['total_durasi_pengguna']->map(function ($durasi) {
            return [
                'id_user' => $durasi->userId,
                'nama' => $durasi->nama,
                'total_durasi' => round($durasi->total_durasi / 3600, 2), // Mengubah durasi ke jam
            ];
        }),
    ];
}
}
