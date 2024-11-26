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
use Illuminate\Support\Facades\Crypt;

class PenugasanServices
{
    public function getAll($idGiat = null, $idUser = null, $status = null)
    {
        $currentDateTime = now()->setTimezone('Asia/Makassar');
        $query = Penugasan::with(['giats' => function ($query) {
            $query->withCount(['penugasans as jumlah_petugas' => function ($q) {
                $q->where('status', 'ditugaskan');
            }]);
        }]);

        // Filter berdasarkan $idGiat
        if ($idGiat) {
            $idGiat = Crypt::decrypt($idGiat);
            $query->where('id_giat', $idGiat);
        }
        // Filter berdasarkan $idUser
        if ($idUser && !$status) {
            $idUser = Crypt::decrypt($idUser);
            $query->where('id_user', $idUser)
                ->whereHas('giats', function ($query) use ($currentDateTime) {
                    $query->where('akses_mulai', '<=', $currentDateTime)
                        ->where('akses_selesai', '>=', $currentDateTime);
                });
        }

        // Filter berdasarkan status
        if ($idUser && $status === 'selesai') {
            $idUser = Crypt::decrypt($idUser);
            // Penugasan selesai jika waktu sekarang melebihi akses_selesai
            $query->where('id_user', $idUser)->whereHas('giats', function ($query) use ($currentDateTime) {
                $query->where('akses_selesai', '<', $currentDateTime);
            });
        } elseif ($idUser && $status === 'dibatalkan') {
            $idUser = Crypt::decrypt($idUser);
            $query->withTrashed()->where('id_user', $idUser) // Sertakan penugasan yang sudah dihapus
                ->where(function ($query) {
                    $query->whereNotNull('deleted_at') // Penugasan dihapus
                        ->orWhereHas('giats', function ($query) {
                            $query->onlyTrashed(); // Giat dihapus
                        });
                })
                ->with(['giats' => function ($query) {
                    $query->withTrashed(); // Sertakan giats yang sudah dihapus
                }]);
        }

        $penugasan = $query->get();

        if ($penugasan->isNotEmpty()) {
            return [
                'status' => true,
                'message' => 'Berhasil Mengambil Data',
                'data' => PenugasanAllResource::collection($penugasan),
            ];
        }

        return [
            'status' => false,
            'message' => 'Data Tidak Ditemukan',
        ];
    }

    public function doShow($id)
    {
        try {
            $id = Crypt::decrypt($id);
            // Mendapatkan waktu saat ini di zona waktu Asia/Makassar (WITA)
            $currentDateTime = now()->setTimezone('Asia/Makassar');

            // Ambil penugasan berdasarkan ID
            $penugasan = Penugasan::with([
                'giats' => function ($query) use ($currentDateTime) {
                    $query->withCount(['penugasans as jumlah_petugas' => function ($q) {
                        $q->where('status', 'ditugaskan');
                    }]);
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
            $id = Crypt::decrypt($id);
            $penugasan = Penugasan::findOrFail($id);
            if ($penugasan) {
                $insertData = $data;
                if ($file) {
                    $fileName = Str::random(16) . '.' . $file->getClientOriginalExtension();
                    $destinationPath = public_path() . '/storage/images/';
                    $file->move($destinationPath, $fileName);
                    $insertData['dokumen_lapangan'] = 'public/storage/images/' . $fileName;
                }
                $penugasan->update($insertData);
                return $penugasan;
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