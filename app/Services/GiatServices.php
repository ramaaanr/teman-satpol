<?php

namespace App\Services;

use Carbon\Carbon;
use App\Models\Giat;
use App\Services\PenugasanServices;
use App\Http\Resources\GiatResource;
use Illuminate\Support\Facades\Crypt;
use App\Http\Resources\GiatDetailResource;

class GiatServices
{
    public function getAll($status = null)
    {
        $giatQuery = Giat::withCount([
            'penugasans as jumlah_ditugaskan' => function ($query) {
                $query->where('status', 'ditugaskan');
            },
            'penugasans as jumlah_selesai' => function ($query) {
                $query->where('status', 'disetujui');
            },
            'penugasans as jumlah_bertugas' => function ($query) {
                $query->where('status', 'bertugas');
            },
            'penugasans as jumlah_ditolak' => function ($query) {
                $query->where('status', 'ditolak');
            }
        ])
            ->with('penugasans') // Include relasi penugasans
            ->orderBy('tanggal_mulai', 'desc'); // Sorting berdasarkan tanggal_mulai terbaru


        // Jika query params `status` diberikan, tambahkan filter
        if ($status === 'selesai') {
            $giatQuery = $giatQuery->whereHas('penugasans', function ($query) {
                $query->where('status', 'disetujui');
            }, '=', function ($query) {
                $query->selectRaw('count(*)')
                    ->from('penugasans')
                    ->whereColumn('penugasans.id_giat', 'giats.id');
            })->orderBy('tanggal_mulai', 'desc');;
        } elseif ($status === 'dibatalkan') {
            $giatQuery = $giatQuery->onlyTrashed()->orderBy('tanggal_mulai', 'desc');; // Mengambil giat yang memiliki `deleted_at` tidak null
        } else {
            $giatQuery = $giatQuery->whereHas('penugasans', function ($query) {
                $query->where('status', 'disetujui');
            }, '!=', function ($query) {
                $query->selectRaw('count(*)')
                    ->from('penugasans')
                    ->whereColumn('penugasans.id_giat', 'giats.id');
            });
        }

        $giat = $giatQuery->get();

        return [
            'status' => true,
            'message' => "Berhasil Mengambil Data",
            'data' => GiatResource::collection($giat),
        ];
    }

    public function doShow($id)
    {
        $id = Crypt::decrypt($id);
        $giat = Giat::with(['penugasans.user'])
            ->withCount([
                // Menghitung jumlah penugasan dengan status "mengajukan"
                'penugasans as jumlah_ditugaskan' => function ($query) {
                    $query->where('status', 'ditugaskan');
                },
                // Menghitung jumlah penugasan dengan status "selesai"
                'penugasans as jumlah_selesai' => function ($query) {
                    $query->where('status', 'disetujui');
                },
                'penugasans as jumlah_bertugas' => function ($query) {
                    $query->where('status', 'bertugas');
                },
                'penugasans as jumlah_ditolak' => function ($query) {
                    $query->where('status', 'ditolak');
                }
            ])->findOrFail($id);
        if ($giat) {
            return response([
                'status' => true,
                'message' => 'Berhasil Mengambil Data',
                'Data' => new GiatDetailResource($giat)
            ]);
        }
        return response([
            'status' => false,
            'message' => "Data Gagal Ditampilkan!"
        ]);
    }

    public function doStore($data)
    {
        $data['tanggal_mulai'] = Carbon::parse($data['tanggal_mulai'])->format('Y-m-d H:i:s');
        $data['tanggal_selesai'] = Carbon::parse($data['tanggal_selesai'])->format('Y-m-d H:i:s');
        $data['akses_mulai'] = Carbon::parse($data['akses_mulai'])->format('Y-m-d H:i:s');
        $data['akses_selesai'] = Carbon::parse($data['akses_selesai'])->format('Y-m-d H:i:s');
        $giat = Giat::create($data);
        if ($giat) {
            return $giat;
        }
        return ([
            'status' => false,
            'message' => "Data Gagal Disimpan!"
        ]);
    }

    public function doUpdate($data, $id)
    {
        $id = Crypt::decrypt($id);
        $giat = Giat::findOrFail($id);
        if ($giat) {
            $data['tanggal_mulai'] = Carbon::parse($data['tanggal_mulai'])->format('Y-m-d H:i:s');
            $data['tanggal_selesai'] = Carbon::parse($data['tanggal_selesai'])->format('Y-m-d H:i:s');
            $data['akses_mulai'] = Carbon::parse($data['akses_mulai'])->format('Y-m-d H:i:s');
            $data['akses_selesai'] = Carbon::parse($data['akses_selesai'])->format('Y-m-d H:i:s');
            $results = $giat->update($data);
            return $giat;
        }
        return ([
            'status' => false,
            'message' => "Data Gagal Disimpan!"
        ]);
    }

    public function doDestroy($id)
    {
        $id = Crypt::decrypt($id);
        $giat = Giat::findOrFail($id);
        if ($giat) {
            $giat->destroy($id);
            return response()->json([
                'status' => true,
                'message' => "Data Berhasil Dihapus"
            ]);
        }
        return response()->json([
            'status' => false,
            'message' => "Data Gagal Dihapus!"
        ]);
    }
}