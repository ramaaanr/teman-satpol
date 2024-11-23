<?php

namespace App\Services;

use App\Models\Giat;
use App\Models\Item;
use App\Models\User;
use App\Models\Penugasan;
use Illuminate\Support\Facades\DB;
use App\Http\Resources\LaporanBidangResource;
use App\Http\Resources\LaporanBidangByIdItemResource;
use App\Http\Resources\LaporanBidangByIdUserResource;
use App\Exports\LaporanBidangExport;
use Maatwebsite\Excel\Facades\Excel;

class LaporanBidangServices
{
    public function doShow($tahun = null, $bulan = null, $userId = null, $itemId = null)
    {
        $filterPenugasan = function ($query) use ($tahun, $bulan, $userId, $itemId) {
            if ($tahun) {
                $query->whereYear('created_at', $tahun);
            }
            if ($bulan) {
                $query->whereMonth('created_at', $bulan);
            }
            if ($userId) {
                $query->where('id_user', $userId);
            }
            if ($itemId) {
                $query->whereHas('detailItems', function ($q) use ($itemId) {
                    $q->where('detail_items.id_item', $itemId); // Filter berdasarkan kolom di `detail_items`
                });
            }
        };

        $statistikItem = Item::query()
            ->with(['detailItems.penugasan' => $filterPenugasan])
            ->get();

        if ($tahun || $bulan) {
            // Hitung total users berdasarkan tahun dan bulan
            $totalUsers = User::count();

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
            $userInfo = User::select('id', 'nama', 'jabatan', 'role')->find($userId);

            $userData = User::with([
                'penugasans' => function ($query) use ($filterPenugasan) {
                    $query->with(['detailItems' => function ($q) {
                        $q->select('id_item', 'id_penugasan');
                    }]);
                    $query->whereHas('detailItems');
                },
            ])->find($userId);

            $durasiByUser = Item::query()
                ->leftJoin('detail_items', 'items.id', '=', 'detail_items.id_item')
                ->leftJoin('penugasans', function ($join) use ($userId) {
                    $join->on('detail_items.id_penugasan', '=', 'penugasans.id')
                        ->where('penugasans.id_user', $userId); // Replace with your user ID
                })
                ->leftJoin('users', 'penugasans.id_user', '=', 'users.id')
                ->select(
                    'items.id as id_item',
                    'items.deskripsi',
                    DB::raw('COALESCE(COUNT(penugasans.durasi), 0) as volume'),
                    DB::raw('COALESCE(SUM(TIME_TO_SEC(penugasans.durasi)), 0) as total_durasi'),
                    DB::raw('COALESCE(MAX(penugasans.durasi), "00:00:00") as penugasans_durasi')
                )
                ->groupBy('items.id', 'items.deskripsi')

                ->get();



            $riwayatGiat = Penugasan::whereHas('giats', function ($query) {
                $query->whereNull('deleted_at');
            })
                ->with(['giats'])
                ->where('id_user', $userId)
                ->where('status', 'disetujui')
                ->get()
                ->map(function ($penugasan) {
                    return [
                        'id_giat' => $penugasan->giats->id,
                        'kegiatan' => $penugasan->giats->kegiatan,
                        'tanggal' => $penugasan->created_at->format('d F Y, H:i') . ' WITA',
                        'durasi' => gmdate("H:i", strtotime($penugasan->durasi)),
                    ];
                });

            $dataByUserId = [
                'user_info' => $userInfo, // Tambahkan informasi user
                'durasi_by_user' => $durasiByUser,
                'riwayat_giat' => $riwayatGiat,
            ];

            return [
                'status' => true,
                'message' => "Data Berhasil Ditampilkan!",
                'data' => new LaporanBidangByIdUserResource($dataByUserId),
            ];
        } elseif ($itemId) {
            $durasiByItem = Penugasan::query()
                ->join('detail_items', 'penugasans.id', '=', 'detail_items.id_penugasan') // Relasi ke detail_items
                ->join('users', 'penugasans.id_user', '=', 'users.id') // Relasi ke users
                ->select(
                    'detail_items.id_item as itemId',
                    'users.id as userId',
                    'users.nama as nama',
                    DB::raw('SUM(TIME_TO_SEC(penugasans.durasi)) as total_durasi')
                )
                ->where('detail_items.id_item', $itemId) // Filter pada tabel detail_items
                ->when($tahun, function ($query) use ($tahun) {
                    $query->whereYear('penugasans.created_at', $tahun);
                })
                ->when($bulan, function ($query) use ($bulan) {
                    $query->whereMonth('penugasans.created_at', $bulan);
                })
                ->when($userId, function ($query) use ($userId) {
                    $query->where('penugasans.id_user', $userId);
                })
                ->groupBy('detail_items.id_item', 'users.id', 'users.nama');

            $dataByItemId = [
                'id_item' => $itemId,
                'deskripsi' => Item::find($itemId)->deskripsi ?? 'Tidak Ditemukan',
                'total_durasi_pengguna' => $durasiByItem->get(),
            ];
            return [
                'status' => true,
                'message' => "Data Berhasil Ditampilkan!",
                'data' => new LaporanBidangByIdItemResource($dataByItemId),
            ];
        }
    }

    // public function exportLaporanBidang($tahun, $bulan)
    // {
    //     $filterTahunDanBulan = function ($query) use ($tahun, $bulan) {
    //         if ($tahun) {
    //             $query->whereYear('created_at', $tahun);
    //         }
    //         if ($bulan) {
    //             $query->whereMonth('created_at', $bulan);
    //         }
    //     };

    //     $statistikItem = Item::query()
    //         ->with(['detailItems.penugasan' => $filterTahunDanBulan])
    //         ->get();

    //     $data = $statistikItem->map(function ($item) {
    //         $totalDurasi = $item->detailItems->reduce(function ($carry, $detailItem) {
    //             return $carry + $this->parseDurationToHours($detailItem->penugasan->durasi ?? '00:00:00');
    //         }, 0);

    //         return [
    //             $item->id, //column : nomor
    //             $item->deskripsi ?? 'Tidak Ditemukan', // Column : Butir Kegiatan
    //             $totalDurasi ?: 0,  // Column : Volume Kegiatan (jika kosong, isi dengan 0)
    //         ];
    //     })->toArray();

    //     $export = new LaporanBidangExport($data);

    //     // Simpan ke folder
    //     $results =  $export->exportToFile();
    //     if ($results){
    //         return ([
    //             'status' => true,
    //             'message' => "Data Berhasil Diexport!",
    //             'file_path' => $results
    //         ]);
    //     }
    // }

    private function parseDurationToHours($time)
    {
        if (!$time) {
            return 0;
        }

        sscanf($time, "%d:%d:%d", $hours, $minutes, $seconds);
        return $hours + ($minutes / 60) + ($seconds / 3600);
    }
}