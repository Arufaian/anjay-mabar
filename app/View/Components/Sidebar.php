<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class Sidebar extends Component
{
    /**
     * Create a new component instance.
     */
    public function __construct()
    {
        //
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.sidebar', [
            'adminMenuItems' => $this->getAdminMenuItems(),
        ]);
    }

    /**
     * Get admin menu items.
     */
    public function getAdminMenuItems(): array
    {
        return [
            [
                'name' => 'Dashboard',
                'route' => 'admin.dashboard',
                'icon' => 'layout-dashboard',
                'url' => route('admin.dashboard'),
            ],
            [
                'name' => 'Users',
                'route' => 'admin.users.index',
                'icon' => 'users',
                'url' => route('admin.users.index'),
            ],
            [
                'name' => 'Criteria',
                'route' => 'admin.criteria.index',
                'icon' => 'list-checks',
                'url' => route('admin.criteria.index'),
            ],
            [
                'name' => 'Weights',
                'route' => 'admin.weights.index',
                'icon' => 'scale',
                'url' => route('admin.weights.index'),
            ],
        ];
    }

    /**
     * Check if menu item is active.
     */
}
