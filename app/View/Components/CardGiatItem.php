<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class CardGiatItem extends Component
{
    /**
     * Create a new component instance.
     */

    public function __construct(
        public string $id,
        public string $kegiatan,
        public string $detailKegiatan,
        public string $tempat,
        public string $kendaraan,
        public string $tanggalMulai,
        public string $tanggalSelesai,
        public string $aksesMulai,
        public string $aksesSelesai,
        public string $jumlahDitugaskan,
        public string $jumlahSelesai,
    ) {
        //
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.card-giat-item');
    }
}