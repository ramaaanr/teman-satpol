<?php
namespace App\Services;

use App\Models\User;
use App\Models\Penugasan;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Crypt;
use App\Http\Resources\DashboardByIdUserResource;

class DashboardServices {
    public function doShowByIdUser ($userId){
        $userId = Crypt::decrypt($userId);
        // Ambil data user
        $user = User::find($userId);

        if (!$user) {
            return [
                'status' => false,
                'message' => 'User tidak ditemukan',
                'data' => null,
            ];
        }

        // Statistik penugasan
        $penugasanStats = Penugasan::query()
            ->selectRaw("
                COUNT(CASE WHEN status = 'ditugaskan' THEN 1 END) AS ditugaskan,
                COUNT(CASE WHEN status = 'bertugas' THEN 1 END) AS bertugas,
                COUNT(CASE WHEN status = 'disetujui' THEN 1 END) AS disetujui,
                COUNT(CASE WHEN status = 'ditolak' THEN 1 END) AS ditolak
            ")
            ->where('id_user', $userId)
            ->first();

        // Durasi per item
        $durasiItem = Penugasan::query()
            ->join('detail_items', 'penugasans.id', '=', 'detail_items.id_penugasan')
            ->join('items', 'detail_items.id_item', '=', 'items.id')
            ->select(
                'items.id as id_item',
                'items.deskripsi',
                DB::raw('SUM(TIME_TO_SEC(penugasans.durasi)) / 3600 as total_durasi') // Total durasi dalam jam
            )
            ->where('penugasans.id_user', $userId)
            ->groupBy('items.id', 'items.deskripsi')
            ->get();

        // Format hasil untuk resource
        $data = [
            'user_id' => $user->id,
            'nama' => $user->nama,
            'jabatan' => $user->jabatan,
            'role' => $user->role,
            'penugasan' => $penugasanStats,
            'durasi_item' => $durasiItem,
        ];

        return [
            'status' => true,
            'message' => 'Data Berhasil Diambil',
            'data' => new DashboardByIdUserResource($data),
        ];
    }
}