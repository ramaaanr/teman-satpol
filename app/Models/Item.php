<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Item extends Model
{
    use HasFactory;

    public function detailItems()
    {
        return $this->hasMany(DetailItem::class, 'id_item', 'id');
    }
}
