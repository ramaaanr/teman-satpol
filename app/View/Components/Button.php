<?php

namespace App\View\Components;

use Illuminate\View\Component;

class Button extends Component
{
    public $type;
    public $color;
    public $text;
    public $width;

    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct($type = 'button', $color = 'blue', $text = 'Button', $width = "full")
    {
        $this->type = $type;
        $this->color = $color;
        $this->text = $text;
        $this->width = $width;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\View\View|string
     */
    public function render()
    {
        return view('components.button');
    }
}