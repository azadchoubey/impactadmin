<?php

namespace App\Livewire;

use App\Models\Mongo\Article;
use App\Models\Pubmaster;
use Livewire\Component;

class Articles extends Component
{
    public $title = '';
    public $searchResults = [],$date;
    public $_id ;
    private $Results = [];
    public function render()
    {
      
        return view(
            'livewire.articles' );
    }
    public function updateTitle()
    {

        if(strlen($this->title) >= 2){ 
            $this->searchResults = Pubmaster::where('Title','LIKE','%'.$this->title.'%')->where('deleted',0)
            ->with('edition')
            ->get();
        } else {
            $this->searchResults = [];
        }
    }
    public function fetchAll($id, $title)
    {
        $this->searchResults = [];
        $this->title = $title;
        $this->_id = $id;

    }
    public function getarticle(){

        if($this->_id){
            $this->Results = Article::where(['pubid'=>$this->id,'pubdate'=>$this->date])->groupBy('articleid','headline','publication','pubid','city','pubdate')->get();
        }
    }
}
