<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class StatsCard extends Component
{
    public string $title;

    public string $subtitle;

    public ?string $value;


    public string $icon;

    public string $color;

    public ?string $route;

    /**
     * Create a new component instance.
     */
    public function __construct(
        string $title,
        string $subtitle,
        ?string $value = null,
        ?string $route = null,
        string $icon = 'lucide-trending-up',
        string $color = 'primary'
    ) {
        $this->title = $title;
        $this->subtitle = $subtitle;
        $this->value = $value;
        $this->icon = $icon;
        $this->color = $color;
        $this->route = $route;
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.stats-card');
    }
}
