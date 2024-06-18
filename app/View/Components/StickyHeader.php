<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class StickyHeader extends Component
{
    /**
     * Create a new component instance.
     */
    public $title,$subtitle,$name;
    public function __construct($title,$name,$subtitle)
    {
        $this->title = $title;
        $this->name = $name;
        $this->subtitle = $subtitle;
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.sticky-header');
    }
}
