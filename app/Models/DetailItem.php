<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DetailItem extends Model
{
    use HasFactory;

    protected $fillable = [
        'id_item',
        'id_penugasan'
    ];

    public function penugasan()
    {
        return $this->belongsTo(Penugasan::class, 'id_penugasan', 'id');
    }

    public function item()
    {
        return $this->belongsTo(Item::class, 'id_item', 'id');
    }
}
