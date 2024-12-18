<?php

namespace App\View\Components;

use Illuminate\View\Component;

class Button extends Component
{
    public $type;
    public $color;
    public $text;
    public $width;
    public $disabled;

    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct($type = 'button', $color = 'blue', $text = 'Button', $width = 'full', $disabled = false)
    {
        $this->type = $type;
        $this->color = $color;
        $this->text = $text;
        $this->width = $width;
        $this->disabled = $disabled;
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