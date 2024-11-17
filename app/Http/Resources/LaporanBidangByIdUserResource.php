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
    public function toArray($request)
    {
        $items = $this->resource['statistik_item'];
        $durasiByUser = $this->resource['durasi_by_user'];

        return [
            $items->map(function ($item) use ($durasiByUser) {
                return [
                    'id_item' => $item->id,
                    'deskripsi' => $item->deskripsi,
                    'total_durasi_pengguna' => $durasiByUser->where('id_item', $item->id)->map(function ($durasi) {
                        return [
                            'userId' => $durasi->userId, // Gunakan userId
                            'nama' => $durasi->nama,
                            'total_durasi' => round($durasi->total_durasi / 3600, 2), // Konversi ke jam
                        ];
                    })->values(),
                ];
            }),
        ];
    }
}