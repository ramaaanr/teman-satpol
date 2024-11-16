<?php

namespace App\View\Components;

use Illuminate\View\Component;

class CardKegiatanItem extends Component
{
    public $id;
    public $kegiatan;
    public $detail;
    public $tempat;
    public $status;
    public $tanggal;
    public $petugas;
    public $kendaraan;

    public function __construct($id, $kegiatan, $detail, $tempat, $tanggal, $status, $petugas, $kendaraan)
    {
        $this->id = $id;
        $this->kegiatan = $kegiatan;
        $this->status = $status;
        $this->detail = $detail;
        $this->tempat = $tempat;
        $this->tanggal = $tanggal;
        $this->petugas = $petugas;
        $this->kendaraan = $kendaraan;
    }

    public function render()
    {
        return view('components.card-kegiatan-item');
    }
}