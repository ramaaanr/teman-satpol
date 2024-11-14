<?php

namespace App\Services;

use Carbon\Carbon;
use App\Models\Giat;
use App\Services\PenugasanServices;
use App\Http\Resources\GiatResource;
use App\Http\Resources\GiatDetailResource;

class GiatServices
{
    public function getAll()
    {
        $giat = Giat::withCount([
            // Menghitung jumlah penugasan dengan status "mengajukan"
            'penugasans as jumlah_ditugaskan' => function ($query) {
                $query->where('status', 'ditugaskan');
            },
            // Menghitung jumlah penugasan dengan status "selesai"
            'penugasans as jumlah_selesai' => function ($query) {
                $query->where('status', 'selesai');
            }
        ])->get();
        return ([
            'status' => true,
            'message' => "Berhasil Mengambil Data",
            'data' => GiatResource::collection($giat)
        ]);
    }

    public function doShow($id)
    {
        $giat = Giat::with(['penugasans.user'])
            ->withCount([
                // Menghitung jumlah penugasan dengan status "mengajukan"
                'penugasans as jumlah_ditugaskan' => function ($query) {
                    $query->where('status', 'ditugaskan');
                },
                // Menghitung jumlah penugasan dengan status "selesai"
                'penugasans as jumlah_selesai' => function ($query) {
                    $query->where('status', 'selesai');
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
        $data['tanggal_mulai'] = Carbon::createFromFormat('d-m-Y H:i:s', $data['tanggal_mulai'])->format('Y-m-d H:i:s');
        $data['tanggal_selesai'] = Carbon::createFromFormat('d-m-Y H:i:s', $data['tanggal_selesai'])->format('Y-m-d H:i:s');
        $data['akses_mulai'] = Carbon::createFromFormat('d-m-Y H:i:s', $data['akses_mulai'])->format('Y-m-d H:i:s');
        $data['akses_selesai'] = Carbon::createFromFormat('d-m-Y H:i:s', $data['akses_selesai'])->format('Y-m-d H:i:s');
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
        $giat = Giat::findOrFail($id);
        if ($giat) {
            $data['tanggal_mulai'] = Carbon::createFromFormat('d-m-Y H:i:s', $data['tanggal_mulai'])->format('Y-m-d H:i:s');
            $data['tanggal_selesai'] = Carbon::createFromFormat('d-m-Y H:i:s', $data['tanggal_selesai'])->format('Y-m-d H:i:s');
            $data['akses_mulai'] = Carbon::createFromFormat('d-m-Y H:i:s', $data['akses_mulai'])->format('Y-m-d H:i:s');
            $data['akses_selesai'] = Carbon::createFromFormat('d-m-Y H:i:s', $data['akses_selesai'])->format('Y-m-d H:i:s');
            $giat->update($data);
            return $giat;
        }
        return response()->json([
            'status' => false,
            'message' => "Data Gagal Disimpan!"
        ]);
    }

    public function doDestroy($id)
    {
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
