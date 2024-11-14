<?php

namespace App\Services;
use App\Models\DetailItem;

class DetailItemServices {
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
}