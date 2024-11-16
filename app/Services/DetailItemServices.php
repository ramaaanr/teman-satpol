<?php

namespace App\Services;
use App\Models\DetailItem;
use App\Http\Resources\DetailItemByPenugasanResource;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class DetailItemServices {
    public function getAll($idPenugasan){
        $detailItem = DetailItem::with(['penugasan', 'item'])
        ->where('id_penugasan', $idPenugasan)
        ->get();
        if ($detailItem->isNotEmpty()){
            return ([
                'status' => true,
                'message' => "Data Berhasil Ditampilkan!",
                'data' => DetailItemByPenugasanResource::collection($detailItem)
            ]);
        }
        return ([
            'status' => true,
            'message' => "Data Kosong!"
        ]);
    }

    public function doAdd($idPenugasan, $itemId){
        $dataDetailItem = [
            'id_item' => $itemId,
            'id_penugasan' => $idPenugasan
        ];
        $detailItem = DetailItem::create($dataDetailItem);

        if ($detailItem){
            return ([
                'status' => true,
                'message' => "Data Berhasil Disimpan!"
            ]);
        }
    }

    public function doDelete($penugasanId, $itemId){
        try {
            $detailItem = DetailItem::where('id_penugasan', $penugasanId)
            ->where('id_item', $itemId)
            ->first();
            if ($detailItem){
                $detailItem->delete($itemId);
                return ([
                    'status' => true,
                    'message' => "Data Berhasil Dihapus!"
                ]);
            }
            return ([
                'status' => false,
                'message' => "Data Gagal Dihapus!"
            ]);
        } catch (ModelNotFoundException $th) {
            return ([
                'status' => false,
                'message' => "Data Tidak Ditemukan!"
            ]);
        }
    }
}