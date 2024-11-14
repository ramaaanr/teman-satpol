<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class CardReviewKegiatanItem extends Component
{
    /**
     * Create a new component instance.
     */
    public function __construct(
        public string $id,
        public string $kegiatan,
        public string $detailKegiatan,
        public string $tanggal,
        public string $tempat,
    ) {
        //
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.card-review-kegiatan-item');
    }
}