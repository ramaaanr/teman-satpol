<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class DetailItemByPenugasanResource extends JsonResource
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
            'item' => $this->whenLoaded('item', function () {
                return [
                    'id_item' => $this->item->id,
                    'deskripsi' => $this->item->deskripsi
                ];
            }),
            'penugasan' => $this->whenLoaded('penugasan', function (){
                return [
                    'id_penugasan' => $this->penugasan->id
                ];
            })
        ];
    }
}
