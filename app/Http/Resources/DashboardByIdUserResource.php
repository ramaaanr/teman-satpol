<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Http\Resources\Json\JsonResource;

class DashboardByIdUserResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'user_id' => Crypt::encrypt($this->resource['user_id']) ?? null,
            'nama' => $this->resource['nama'] ?? 'Tidak Ditemukan',
            'jabatan' => $this->resource['jabatan'] ?? 'Tidak Ditemukan',
            'role' => $this->resource['role'] ?? 'Tidak Ditemukan',
            'penugasan' => [
                'ditugaskan' => $this->resource['penugasan']->ditugaskan ?? 0,
                'bertugas' => $this->resource['penugasan']->bertugas ?? 0,
                'disetujui' => $this->resource['penugasan']->disetujui ?? 0,
                'ditolak' => $this->resource['penugasan']->ditolak ?? 0,
            ],
            'durasi_item' => $this->resource['durasi_item']->map(function ($item) {
                return [
                    'id_item' => Crypt::encrypt($item->id_item),
                    'deskripsi' => $item->deskripsi,
                    'total_durasi' => round($item->total_durasi, 2),
                ];
            }),
        ];
    }
}
