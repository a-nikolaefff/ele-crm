<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Collection;
use Illuminate\View\Component;

class Sidebar extends Component
{
    const CONTENT
        = [
            'userBlock' => [
                [
                    'title' => 'Монитор',
                    'route' => 'dashboard',
                    'boxIconClass' => 'bxs-dashboard',
                ],
                [
                    'title' => 'Заявки',
                    'route' => 'requests.index',
                    'boxIconClass' => 'bx-file',
                ],
                [
                    'title' => 'Заказчики',
                    'route' => 'customers.index',
                    'boxIconClass' => 'bxs-business',
                ],
            ],
            'adminBlock' => [
                [
                    'title' => 'Пользователи',
                    'route' => 'users.index',
                    'boxIconClass' => 'bx-user',
                ],
            ],
        ];

    public Collection $menu;

    /**
     * Create a new component instance.
     */
    public function __construct()
    {
        $this->menu = collect(self::CONTENT)->map(function ($block) {
            foreach ($block as &$item) {
                $item['active'] = request()->routeIs($item['route']);
            }
            return $block;
        });
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.sidebar');
    }
}
