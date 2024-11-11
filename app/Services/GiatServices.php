<?php

namespace App\Services;

use Carbon\Carbon;
use App\Models\Giat;

class GiatServices
{
    public function getAll()
    {
        $giat = Giat::all();
        return $giat;
    }

    public function doShow($id)
    {
        $giat = Giat::findOrFail($id);
        if ($giat) {
            return response([
                'Status' => true,
                'Message' => 'Detail Data Giat',
                'Data' => $giat
            ]);
        }
        return response([
            'Status' => false,
            'Message' => "Data Gagal Ditampilkan!"
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
            return response()->json([
                'Status' => true,
                'Message' => "Data Berhasil Disimpan"
            ]);
        }
        return response()->json([
            'Status' => false,
            'Message' => "Data Gagal Disimpan!"
        ]);
    }

    public function doUpdate($data, $id) {
        $giat = Giat::findOrFail($id);
        if ($giat){
            $data['tanggal_mulai'] = Carbon::createFromFormat('d-m-Y H:i:s', $data['tanggal_mulai'])->format('Y-m-d H:i:s');
            $data['tanggal_selesai'] = Carbon::createFromFormat('d-m-Y H:i:s', $data['tanggal_selesai'])->format('Y-m-d H:i:s');
            $data['akses_mulai'] = Carbon::createFromFormat('d-m-Y H:i:s', $data['akses_mulai'])->format('Y-m-d H:i:s');
            $data['akses_selesai'] = Carbon::createFromFormat('d-m-Y H:i:s', $data['akses_selesai'])->format('Y-m-d H:i:s');
            $giat->update($data);
            return response()->json([
                'Status' => true,
                'Message' => "Data Berhasil Disimpan"
            ]);
        }
        return response()->json([
            'Status' => false,
            'Message' => "Data Gagal Disimpan!"
        ]);
    }

    public function doDestroy($id){
        $giat = Giat::findOrFail($id);
        if ($giat){
            $giat->destroy($id);
            return response()->json([
                'Status' => true,
                'Message' => "Data Berhasil Dihapus"
            ]);
        }
        return response()->json([
            'Status' => false,
            'Message' => "Data Gagal Dihapus!"
        ]);
    }
}
