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
            'giats' => $this->whenLoaded('giats'),
        ];
    }
}
