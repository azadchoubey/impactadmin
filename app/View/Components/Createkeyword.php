<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;
use App\Models\Picklist;

class Createkeyword extends Component
{
    public $keywordtypes ,$keywordcategories=[];

    public function __construct()
    {
        $this->keywordtypes = Picklist::where('type','keyword Type')->orderBy('Name')->get();
        $this->keywordcategories = Picklist::where('type','keyword category')->orderBy('Name')->get();
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.createkeyword');
    }
}
