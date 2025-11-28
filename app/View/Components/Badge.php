<?php

namespace App\View\Components;

use Illuminate\View\Component;

class Badge extends Component
{
    public string $color;

    public string $size;

    public bool $outlined;

    public function __construct(
        string $color = 'primary',
        string $size = 'md',
        bool $outlined = false
    ) {
        $this->color = $color;
        $this->size = $size;
        $this->outlined = $outlined;
    }

    public function render()
    {
        return view('components.badge');
    }
}
