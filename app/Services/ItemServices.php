<?php

namespace App\Services;
use App\Models\Item;

class ItemServices {
    public function getAll(){
        $item = Item::All();
        return $item;
    }
}