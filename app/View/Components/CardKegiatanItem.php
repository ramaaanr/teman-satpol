<?php

namespace App\View\Components;

use Illuminate\View\Component;

class CardKegiatanItem extends Component
{
    public $id;
    public $kegiatan;
    public $detail;
    public $tempat;
    public $tanggal;
    public $petugas;
    public $kendaraan;

    /**
     * Create a new component instance.
     *
     * @param string $kegiatan
     * @param string $detail
     * @param string $tempat
     * @param string $tanggal
     * @param int $petugas
     * @param string $kendaraan
     */
    public function __construct($id, $kegiatan, $detail, $tempat, $tanggal, $petugas, $kendaraan)
    {
        $this->id = $id;
        $this->kegiatan = $kegiatan;
        $this->detail = $detail;
        $this->tempat = $tempat;
        $this->tanggal = $tanggal;
        $this->petugas = $petugas;
        $this->kendaraan = $kendaraan;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\View\View|string
     */
    public function render()
    {
        return view('components.card-kegiatan-item');
    }
}