<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class Sidebar extends Component
{
    public $menu;

    /**
     * Create a new component instance.
     */
    public function __construct()
    {
        $this->menu = collect(config('sidebar'))->map(function ($block) {
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
