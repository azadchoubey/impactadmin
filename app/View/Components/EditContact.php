<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class EditContact extends Component
{
    public $contact,$picklist,$deliverymaster,$webdeliverymaster,$client,$formats;
    /**
     * Create a new component instance.
     */
    public function __construct($contact,$picklist,$deliverymaster,$webdeliverymaster,$client,$formats)
    {
       $this->contact= $contact;  
       $this->picklist= $picklist;  
       $this->deliverymaster= $deliverymaster;  
       $this->webdeliverymaster= $webdeliverymaster;  
       $this->client = $client;
       $this->formats = $formats;  

    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.edit-contact');
    }
}
