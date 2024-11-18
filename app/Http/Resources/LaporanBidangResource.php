<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class LaporanBidangResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray($request)
    {
        return [
            'total_users' => $this->resource['total_users'],
            'total_giat' => $this->resource['total_giat'],
            'total_kegiatan' => $this->resource['total_kegiatan'],
            'statistik_item' => $this->processStatistikItem($this->resource['statistik_item']),
        ];
    }

    private function processStatistikItem($items)
    {
        return $items->map(function ($item) {
            $totalDurasi = $item->detailItems
                ->reduce(function ($carry, $detailItem) {
                    return $carry + $this->parseDurationToHours($detailItem->penugasan->durasi ?? '00:00:00');
                }, 0);

            return [
                'id' => $item->id,
                'deskripsi' => $item->deskripsi,
                'total_durasi' => $totalDurasi,
            ];
        })->toArray();
    }

    private function parseDurationToHours($time)
    {
        if (!$time) {
            return 0;
        }

        sscanf($time, "%d:%d:%d", $hours, $minutes, $seconds);
        return $hours + ($minutes / 60) + ($seconds / 3600);
    }
}
