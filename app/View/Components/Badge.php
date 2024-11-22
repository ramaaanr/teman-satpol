<?php

namespace App\View\Components;

use Illuminate\View\Component;

class Badge extends Component
{
    public $color;
    public $size;

    public function __construct($color = 'blue', $size = 'xs')
    {
        $this->color = $color;
        $this->size = $size;
    }

    public function render()
    {
        return view('components.badge');
    }
}