<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

class Penugasan extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'durasi',
        'detail',
        'dokumen_lapangan',
        'status',
        'id_giat',
        'id_user'
    ];

    public function users(): BelongsTo {
        return $this->belongsTo(User::class, 'id_user', 'id');
    }
    public function giats(): BelongsTo {
        return $this->belongsTo(Giat::class, 'id_giat', 'id');
    }
}
