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
        $userInfo = $this->resource['user_info'];

        return [
            'nama' => $userInfo->nama ?? 'Tidak Ditemukan',
            'jabatan' => $userInfo->jabatan ?? 'Tidak Ditemukan',
            'role' => $userInfo->role ?? 'Tidak Ditemukan',

            'data_item' => $this->resource['durasi_by_user']->map(function ($durasi) {
                return [
                    'id_item' => $durasi->id_item,
                    'volume' => $durasi->volume,
                    'deskripsi' => $durasi->deskripsi ?? 'Tidak Ditemukan',
                    'total_durasi' => $durasi->total_durasi > 0
                        ? round($durasi->total_durasi / 3600, 2)
                        : 0, // Durasi dalam jam atau default 0
                ];
            }),


            'riwayat_giat' => isset($this->resource['riwayat_giat']) ?
                $this->resource['riwayat_giat'] : [],
        ];
    }
}