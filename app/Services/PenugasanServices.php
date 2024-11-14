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
            $query = Penugasan::with([
                'giats' => function ($query) {
                    $query->select([
                        'id',
                        'kegiatan',
                        'detail_kegiatan',
                        'tempat',
                        'kendaraan',
                        'beban_biaya',
                        'tanggal_mulai',
                        'tanggal_selesai',
                        'akses_mulai',
                        'akses_selesai',
                        'deleted_at',
                    ]);
                }
            ]);
        
            // Filter berdasarkan $idGiat dan $idUser jika ada
            if ($idGiat) {
                $query->where('id_giat', $idGiat);
            }
            if ($idUser) {
                $query->where('id_user', $idUser);
            }
        
            $penugasan = $query->get();
            if ($penugasan->isNotEmpty()){
                $totalUsers = Penugasan::where('id_giat', $idGiat)->distinct('id_user')->count();
                return ([
                    'status' => true,
                    'message' => 'Berhasil Mengambil Data',
                    'total_petugas' => $totalUsers,
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
            $penugasan = Penugasan::with([
                'giats' => function ($query) {
                    $query->select([
                        'id',
                        'kegiatan',
                        'detail_kegiatan',
                        'tempat',
                        'kendaraan',
                        'beban_biaya',
                        'tanggal_mulai',
                        'tanggal_selesai',
                        'akses_mulai',
                        'akses_selesai',
                        'deleted_at',
                    ]);
                }
            ])->findOrFail($id);
            if ($penugasan) {
                return ([
                    'status' => true,
                    'message' => 'Detail Data Giat',
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
    public function doAdd($id, $userId){
        $dataPenugasan = [
            'id_giat' => $id,
            'id_user' => $userId,
            'status' => 'Ditugaskan',
            'created_at' => now(),
        ];
        $penugasan = Penugasan::create($dataPenugasan);
        if ($penugasan){
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
    // public function doStore($data, $file)
    // {
    //     $fileName = Str::random(16) . '.' . $file->getClientOriginalExtension();
    //     $destinationPath = public_path() . '/storage/images/';
    //     $file->move($destinationPath, $fileName);
    //     $insertData = $data;
    //     $insertData['dokumen_lapangan'] = 'public/storage/images/' . $fileName;
    //     $penugasan = Penugasan::create($insertData);
    //     if ($penugasan) {
    //         return ([
    //             'status' => true,
    //             'message' => 'Data Berhasil Ditambahkan!'
    //         ]);
    //     }
    //     return ([
    //         'status' => false,
    //         'message' => 'Data Gagal Ditambahkan!'
    //     ]);
    // }

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
