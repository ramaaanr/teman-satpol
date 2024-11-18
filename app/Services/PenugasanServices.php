<?php

namespace App\Services;

use App\Http\Resources\PenugasanAllResource;
use Carbon\Carbon;
use App\Models\Penugasan;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;
use App\Http\Resources\PenugasanDetailResource;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class PenugasanServices
{
    public function getAll($idGiat = null, $idUser = null)
    {
        $currentDateTime = now()->setTimezone('Asia/Makassar');
        $query = Penugasan::with(['giats' => function ($query) {
            $query->withCount(['penugasans as jumlah_petugas' => function ($q) {
                $q->where('status', 'ditugaskan');
            }]);
        }]);

        // Filter berdasarkan $idGiat dan $idUser jika ada
        if ($idGiat) {
            $query->where('id_giat', $idGiat);
        }
        if ($idUser) {
            $query->where('id_user', $idUser)
                ->whereHas('giats', function ($query) use ($currentDateTime) {
                    $query->where('akses_mulai', '<=', $currentDateTime)
                        ->where('akses_selesai', '>=', $currentDateTime);
                });
        }
        $penugasan = $query->get();

        if ($penugasan->isNotEmpty()) {
            return ([
                'status' => true,
                'message' => 'Berhasil Mengambil Data',
                'data' => PenugasanAllResource::collection($penugasan)
            ]);
        }
        return ([
            'status' => false,
            'message' => 'Data Tidak Ditemukan'
        ]);
    }

    public function doShow($id)
    {
        try {
            // Mendapatkan waktu saat ini di zona waktu Asia/Makassar (WITA)
            $currentDateTime = now()->setTimezone('Asia/Makassar');

            // Ambil penugasan berdasarkan ID
            $penugasan = Penugasan::with([
                'giats' => function ($query) use ($currentDateTime) {
                    $query->withCount(['penugasans as jumlah_petugas' => function ($q) {
                        $q->where('status', 'ditugaskan');
                    }])
                        // Tambahkan pengecekan berdasarkan akses_mulai dan akses_selesai
                        ->where('akses_mulai', '<=', $currentDateTime)
                        ->where('akses_selesai', '>=', $currentDateTime);
                }
            ])->findOrFail($id);
            if ($penugasan) {
                return ([
                    'status' => true,
                    'message' => 'Detail Data Penugasan',
                    'data' => new PenugasanDetailResource($penugasan)
                ]);
            }
        } catch (ModelNotFoundException $th) {
            return ([
                'status' => false,
                'message' => 'Data Gagal Ditemukan'
            ]);
        }
    }

    public function doDestroy($id)
    {
        try {
            $penugasan = Penugasan::findOrFail($id);
            if ($penugasan) {
                $penugasan->destroy($id);
                $relativePath = str_replace('public/storage/', '', $penugasan['dokumen_lapangan']);
                $fullPath = public_path("storage/{$relativePath}");
                File::delete($fullPath);
                return ([
                    'status' => true,
                    'message' => "Data Berhasil Dihapus!"
                ]);
            }
        } catch (ModelNotFoundException $th) {
            return ([
                'status' => false,
                'message' => 'Data Tidak Ditemukan!'
            ]);
        }
        return ([
            'status' => false,
            'message' => "Data Gagal Dihapus!"
        ]);
    }

    public function doAdd($id, $userId)
    {
        $dataPenugasan = [
            'id_giat' => $id,
            'id_user' => $userId,
            'status' => 'Ditugaskan',
            'created_at' =>  now()->setTimezone('Asia/Makassar')
        ];
        $penugasan = Penugasan::create($dataPenugasan);
        if ($penugasan) {
            return ([
                'status' => true,
                'message' => "Data Berhasil Disimpan!"
            ]);
        }
        return ([
            'status' => false,
            'message' => "Data Gagal Disimpan!"
        ]);
    }
    public function doUpdate($data, $id, $file)
    {
        try {
            $penugasan = Penugasan::findOrFail($id);
            if ($penugasan) {
                $fileName = Str::random(16) . '.' . $file->getClientOriginalExtension();
                $destinationPath = public_path() . '/storage/images/';
                $file->move($destinationPath, $fileName);
                $insertData = $data;
                $insertData['dokumen_lapangan'] = 'public/storage/images/' . $fileName;
                $results = $penugasan->update($insertData);
                if ($results) {
                    return ([
                        'status' => true,
                        'message' => 'Data Berhasil Diubah'
                    ]);
                }
            }
            return ([
                'status' => false,
                'message' => 'Data Gagal Ditambahkan!'
            ]);
        } catch (ModelNotFoundException $th) {
            return ([
                'status' => false,
                'message' => 'Data Tidak Ditemukan!'
            ]);
        }
    }

    public function doDelete($giatId, $userId)
    {
        try {
            $penugasan = Penugasan::where('id_giat', $giatId)
                ->where('id_user', $userId)
                ->first();
            if ($penugasan) {
                // $relativePath = str_replace('public/storage/', '', $penugasan['dokumen_lapangan']);
                // $fullPath = public_path("storage/{$relativePath}");
                // File::delete($fullPath);
                $penugasan->delete();
                return ([
                    'status' => true,
                    'message' => 'Data Berhasil Dihapus!'
                ]);
            }
        } catch (ModelNotFoundException $th) {
            return ([
                'status' => false,
                'message' => 'Data Tidak Ditemukan!'
            ]);
        }
        return ([
            'status' => false,
            'message' => 'Data Gagal Dihapus!'
        ]);
    }
}
