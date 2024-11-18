<?php

namespace App\Services;

use App\Models\Penugasan;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class ReviewKegiatanServices
{
    public function doUpdate($status, $id)
    {
        try {
            $penugasan = Penugasan::findOrFail($id);
            if ($penugasan) {
                $penugasan->update(['status' => $status]);
                return ([
                    'status' => true,
                    'message' => "Data Berhasil Disimpan!"
                ]);
            }
            return ([
                'status' => false,
                'message' => "Data Gagal Disimpan!"
            ]);
        } catch (ModelNotFoundException $th) {
            return ([
                'status' => false,
                'message' => "ID Tidak Ditemukan!"
            ]);
        }
    }
}
