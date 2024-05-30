<?php

namespace App\View\Components;

use App\Models\Picklist;
use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class EditKeyword extends Component
{
    public $keywordtypes ,$keywordcategories=[],$keyword;
    public function __construct($keyword)
    {
        $this->keywordtypes = Picklist::where('type','keyword Type')->orderBy('Name')->get();
        $this->keywordcategories = Picklist::where('type','keyword category')->orderBy('Name')->get();
        $this->keyword = $keyword;
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.edit-keyword');
    }
}
