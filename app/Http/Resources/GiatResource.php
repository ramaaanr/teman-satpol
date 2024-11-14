<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class GiatResource extends JsonResource
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
            'tanggal_mulai' => $this->tanggal_mulai ? \Carbon\Carbon::parse($this->tanggal_mulai)->format("d-m-Y H:i:s") : null,
            'tanggal_selesai' => $this->tanggal_selesai ? \Carbon\Carbon::parse($this->tanggal_selesai)->format("d-m-Y H:i:s") : null,
            'akses_mulai' => $this->akses_mulai ? \Carbon\Carbon::parse($this->akses_mulai)->format("d-m-Y H:i:s") : null,
            'akses_selesai' => $this->akses_selesai ? \Carbon\Carbon::parse($this->akses_selesai)->format("d-m-Y H:i:s") : null,
            'deleted_at' => $this->deleted_at,
            'jumlah_ditugaskan' => $this->jumlah_ditugaskan,
            'jumlah_selesai' => $this->jumlah_selesai
        ];
    }
}
