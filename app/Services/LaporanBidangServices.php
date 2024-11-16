<?php

namespace App\Services;

use App\Http\Resources\LaporanBidangResource;
use App\Models\Giat;
use App\Models\Item;
use App\Models\User;
use App\Models\Penugasan;

class LaporanBidangServices
{
    public function doShow($tahun = null, $bulan = null)
    {
        $filterPenugasan = function ($query) use ($tahun, $bulan) {
            if ($tahun) {
                $query->whereYear('created_at', $tahun);
            }
            if ($bulan) {
                $query->whereMonth('created_at', $bulan);
            }
        };

        $data = [
            'total_users' => User::count(),
            'total_giat' => Giat::count(),
            'total_kegiatan' => Penugasan::count(),
            'statistik_item' => Item::query()
                ->with(['detailItems.penugasan' => $filterPenugasan])
                ->get(),
        ];

        return ([
            'status' => true,
            'message' => "Data Berhasil Ditampilkan!",
            'data' => new LaporanBidangResource($data)
        ]);
    }
}
