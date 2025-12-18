<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\Auth;
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
        $user = Auth::user();

        return view('components.sidebar', [
            'menuItems' => $this->getMenuItemsByRole($user->role),
            'currentRole' => $user->role,
        ]);
    }

    /**
     * Get menu items by role.
     */
    private function getMenuItemsByRole(string $role): array
    {
        return match ($role) {
            'admin' => $this->getAdminMenuItems(),
            'user' => $this->getUserMenuItems(),
            'owner' => $this->getOwnerMenuItems(),
            default => [],
        };
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
                'icon' => 'gauge',
                'url' => route('admin.dashboard'),
            ],
            [
                'name' => 'Users',
                'route' => 'admin.users.index',
                'icon' => 'users',
                'url' => route('admin.users.index'),
            ],
            [
                'name' => 'Alternatives',
                'route' => 'admin.alternative.index',
                'icon' => 'motorbike',
                'url' => route('admin.alternative.index'),
            ],
            [
                'name' => 'Alternative Values',
                'route' => 'admin.alternative-value.index',
                'icon' => 'target',
                'url' => route('admin.alternative-value.index'),
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
            [
                'name' => 'MOORA Results',
                'route' => 'admin.moora.index',
                'icon' => 'calculator',
                'url' => route('admin.moora.index'),
            ],
        ];
    }

    /**
     * Get user menu items.
     */
    public function getUserMenuItems(): array
    {
        return [
            [
                'name' => 'Dashboard',
                'route' => 'user.dashboard',
                'icon' => 'gauge',
                'url' => route('user.dashboard'),
            ],
            [
                'name' => 'Motorcycle Analysis',
                'route' => 'user.moora.create',
                'icon' => 'calculator',
                'url' => route('user.moora.create'),
            ],
            [
                'name' => 'Profile',
                'route' => 'profile.edit',
                'icon' => 'user',
                'url' => route('profile.edit'),
            ],
        ];
    }

    /**
     * Get owner menu items.
     */
    public function getOwnerMenuItems(): array
    {
        return [
            [
                'name' => 'Dashboard',
                'route' => 'owner.dashboard',
                'icon' => 'gauge',
                'url' => route('owner.dashboard'),
            ],
            [
                'name' => 'Profile',
                'route' => 'profile.edit',
                'icon' => 'user',
                'url' => route('profile.edit'),
            ],
        ];
    }

    /**
     * Check if menu item is active.
     */
    public function isActive(string $route): bool
    {
        return request()->routeIs($route);
    }
}
