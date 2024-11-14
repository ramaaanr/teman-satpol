<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class PenugasanAllResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id_penugasan' => $this->id,
            'durasi' => $this->durasi,
            'detail' => $this->detail,
            'dokumen_lapangan' => $this->dokumen_lapangan,
            'status' => $this->status,
            'id_giat' => $this->id_giat,
            'id_user' => $this->id_user,
            'deleted_at' => $this->deleted_at,
            'giats' => $this->whenLoaded('giats', function () {
                return [
                    'id_giat' => $this->giats->id,
                    'kegiatan' => $this->giats->kegiatan,
                    'detail_kegiatan' => $this->giats->detail_kegiatan,
                    'tempat' => $this->giats->tempat,
                    'kendaraan' => $this->giats->kendaraan,
                    'beban_biaya' => $this->giats->beban_biaya,
                    'tanggal_mulai' => $this->giats->tanggal_mulai,
                    'tanggal_selesai' => $this->giats->tanggal_selesai,
                    'akses_mulai' => $this->giats->akses_mulai,
                    'akses_selesai' => $this->giats->akses_selesai,
                    'deleted_at' => $this->giats->deleted_at,
                    'jumlah_petugas' => $this->giats->jumlah_petugas, // Menampilkan jumlah petugas
                ];
            }),
        ];
    }
}
