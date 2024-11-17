<?php

namespace App\Services;

use App\Http\Resources\LaporanBidangByIdUserResource;
use App\Models\Giat;
use App\Models\Item;
use App\Models\User;
use App\Models\Penugasan;
use Illuminate\Support\Facades\DB;
use App\Http\Resources\LaporanBidangResource;

class LaporanBidangServices
{
    public function doShow($tahun = null, $bulan = null, $userId = null)
    {
        $filterPenugasan = function ($query) use ($tahun, $bulan, $userId) {
            if ($tahun) {
                $query->whereYear('created_at', $tahun);
            }
            if ($bulan) {
                $query->whereMonth('created_at', $bulan);
            }
            if ($userId) {
                $query->where('id_user', $userId);
            }
        };

        $statistikItem = Item::query()
            ->with(['detailItems.penugasan' => $filterPenugasan])
            ->get();

        if ($tahun || $bulan) {
            // Hitung total users berdasarkan tahun dan bulan
            $totalUsers = User::whereHas('penugasans', $filterPenugasan)->count();

            // Hitung total giat (kegiatan) berdasarkan tahun dan bulan
            $totalGiat = Giat::whereHas('penugasans', $filterPenugasan)->count();

            // Hitung total kegiatan (penugasan) berdasarkan tahun dan bulan
            $totalKegiatan = Penugasan::where($filterPenugasan)->count();
            
            $dataByYearAndMonths = [
                'total_users' => $totalUsers,
                'total_giat' => $totalGiat,
                'total_kegiatan' => $totalKegiatan,
                'statistik_item' => $statistikItem
            ];
            return ([
                'status' => true,
                'message' => "Data Berhasil Ditampilkan!",
                'data' => new LaporanBidangResource($dataByYearAndMonths),
            ]);
        } elseif ($userId) {
            $durasiByUser = Penugasan::query()
                ->join('detail_items', 'penugasans.id', '=', 'detail_items.id_penugasan') // Join ke detail_items
                ->join('users', 'penugasans.id_user', '=', 'users.id') // Join ke users
                ->select(
                    'penugasans.id_user as userId', // Alias userId
                    'detail_items.id_item', // Ambil id_item
                    'users.nama as nama', // Nama user
                    DB::raw('SUM(TIME_TO_SEC(penugasans.durasi)) as total_durasi') // Total durasi dalam detik
                )
                ->when($userId, function ($query) use ($userId) {
                    $query->where('penugasans.id_user', $userId); // Tambahkan filter userId
                })
                ->groupBy('userId', 'detail_items.id_item', 'users.nama'); // Grouping data

            $dataByUserId = [
                'statistik_item' => $statistikItem,
                'durasi_by_user' => $durasiByUser->get(),
            ];

            return ([
                'status' => true,
                'message' => "Data Berhasil Ditampilkan!",
                'data' => new LaporanBidangByIdUserResource($dataByUserId),
            ]);
        }
    }
}
