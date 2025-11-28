<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class Badge extends Component
{
    /**
     * Create a new component instance.
     */
    public string $color;

    public string $size;

    public bool $outlined;

    public function __construct(string $color = 'primary',
        string $size = 'md',
        bool $outlined = false)
    {
        $this->color = $color;
        $this->size = $size;
        $this->outlined = $outlined;
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.badge');
    }
}
