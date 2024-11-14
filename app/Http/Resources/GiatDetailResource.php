<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class GiatDetailResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'kegiatan' => $this->kegiatan,
            'detail_kegiatan' => $this->detail_kegiatan,
            'tempat' => $this->tempat,
            'kendaraan' => $this->kendaraan,
            'beban_biaya' => $this->beban_biaya,
            'tanggal_mulai' => $this->tanggal_mulai,
            'tanggal_selesai' => $this->tanggal_selesai,
            'akses_mulai' => $this->akses_mulai,
            'akses_selesai' => $this->akses_selesai,
            'deleted_at' => $this->deleted_at,
            'jumlah_ditugaskan' => $this->jumlah_ditugaskan,
            'jumlah_selesai' => $this->jumlah_selesai,
            'penugasans' => $this->penugasans->map(function ($penugasan) {
                return [
                    'id' => $penugasan->id,
                    'status' => $penugasan->status,
                    'detail' => $penugasan->detail,
                    'user' => $penugasan->user ? [
                        'id' => $penugasan->user->id,
                        'nama' => $penugasan->user->nama,
                        'NIP' => $penugasan->user->NIP,
                        'jabatan' => $penugasan->user->jabatan
                    ] : null,
                ];
            }),
        ];
    }
}
