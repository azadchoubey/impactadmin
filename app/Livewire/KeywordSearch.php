<?php

namespace App\Livewire;

use App\Models\Keywordmaster;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\KeywordsExport;

use Livewire\Component;

class KeywordSearch extends Component
{
    public $keyword,$keywords=[];

    public function render()
    {
     
        return view('livewire.keyword-search');
    }
    public function search(){
        $this->keywords =  Keywordmaster::with('clientskeywords.clients')->where('KeyWord',$this->keyword)
            ->orderBy('KeyWord')
            ->get();
    
    //dd($this->keywords[0]);
    }
    public function exportToExcel()
    {
        return Excel::download(new KeywordsExport($this->keywords), rand(0000,99999).'.Xlsx',\Maatwebsite\Excel\Excel::XLSX);
    }
}
