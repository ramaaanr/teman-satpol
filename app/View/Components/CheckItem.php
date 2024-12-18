<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class CheckItem extends Component
{
    /**
     * Create a new component instance.
     */
    public function __construct(
        public string $id,
        public string $checked,
        public string $deskripsi,
        public bool $disabled = false // Tambahkan parameter disabled
    ) {
        //
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.check-item');
    }
}