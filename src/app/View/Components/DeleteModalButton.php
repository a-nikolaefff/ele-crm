<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class DeleteModalButton extends Component
{
    /**
     * Create a new component instance.
     */
    public function __construct(
        public string $route,
        public string $question,
    ) {}

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.delete-modal-button');
    }
}
