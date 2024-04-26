<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class digestpopup extends Component
{
    public $digest;
    public function __construct($digest)
    {
        $this->digest = $digest;
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.digestpopup');
    }
}
