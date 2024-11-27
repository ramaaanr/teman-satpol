<?php

namespace App\Services;

use App\Http\Resources\ItemResource;
use App\Models\Item;

class ItemServices {
    public function getAll(){
        $item = Item::All();
        return ItemResource::collection($item);
    }
}