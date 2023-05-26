<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\View\Component;

class OptionSelector extends Component
{
    /**
     * Create a new component instance.
     */
    public function __construct(
        public string $url,
        public string $parameterName,
        public Collection $options,
        public string $displayingProperty,
        public string $passingProperty,
        public string $allOptionsSelector
    ) {}

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.option-selector');
    }
}
