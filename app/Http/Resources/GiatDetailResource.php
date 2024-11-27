<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Http\Resources\Json\JsonResource;

class GiatDetailResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => Crypt::encrypt($this->id),
            'kegiatan' => $this->kegiatan,
            'detail_kegiatan' => $this->detail_kegiatan,
            'tempat' => $this->tempat,
            'kendaraan' => $this->kendaraan,
            'beban_biaya' => $this->beban_biaya,
            'tanggal_mulai' => $this->tanggal_mulai ? \Carbon\Carbon::parse($this->tanggal_mulai)->locale('id')->translatedFormat('d F Y H:i') . ' WITA' : null,
            'tanggal_selesai' => $this->tanggal_selesai ? \Carbon\Carbon::parse($this->tanggal_selesai)->locale('id')->translatedFormat('d F Y H:i') . ' WITA' : null,
            'akses_mulai' => $this->akses_mulai ? \Carbon\Carbon::parse($this->akses_mulai)->locale('id')->translatedFormat('d F Y H:i') . ' WITA' : null,
            'akses_selesai' => $this->akses_selesai ? \Carbon\Carbon::parse($this->akses_selesai)->locale('id')->translatedFormat('d F Y H:i') . ' WITA' : null,
            'tanggal_mulai_raw' => $this->tanggal_mulai ? \Carbon\Carbon::parse($this->tanggal_mulai)->format('Y-m-d\TH:i') : null,
            'tanggal_selesai_raw' => $this->tanggal_selesai ? \Carbon\Carbon::parse($this->tanggal_selesai)->format('Y-m-d\TH:i') : null,
            'akses_mulai_raw' => $this->akses_mulai ? \Carbon\Carbon::parse($this->akses_mulai)->format('Y-m-d\TH:i') : null,
            'akses_selesai_raw' => $this->akses_selesai ? \Carbon\Carbon::parse($this->akses_selesai)->format('Y-m-d\TH:i') : null,
            'deleted_at' => $this->deleted_at,
            'jumlah_ditugaskan' => $this->jumlah_ditugaskan,
            'jumlah_selesai' => $this->jumlah_selesai,
            'jumlah_bertugas' => $this->jumlah_bertugas,
            'jumlah_ditolak' => $this->jumlah_ditolak,
            'penugasans' => $this->penugasans->map(function ($penugasan) {
                return [
                    'id' => Crypt::encrypt($penugasan->id),
                    'status' => $penugasan->status,
                    'detail' => $penugasan->detail,
                    'user' => $penugasan->user ? [
                        'id' => Crypt::encrypt($penugasan->user->id),
                        'nama' => $penugasan->user->nama,
                        'NIP' => $penugasan->user->NIP,
                        'jabatan' => $penugasan->user->jabatan
                    ] : null,
                ];
            }),
        ];
    }
}
