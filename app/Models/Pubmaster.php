<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pubmaster extends Model
{
    use HasFactory;
    protected $table = "pub_master";
    protected $primaryKey = 'PubId';

    public function Type(){
        return $this->belongsTo(Picklist::class,'Type','ID')->select('ID','Name','Type');
    }
    public function City(){
        return $this->belongsTo(Picklist::class,'CityID','ID')->select('ID','Name');  
    }
    public function Country(){
        return $this->belongsTo(Picklist::class,'countryID','ID')->select('ID','Name');   
    }
    public function State(){
        return $this->belongsTo(Picklist::class,'stateID','ID')->select('ID','Name');
    }
    public function Lang(){
        return $this->belongsTo(Picklist::class,'Language','ID')->select('ID','Name');
    }
    public function Cat(){
        return $this->belongsTo(Picklist::class,'Category','ID')->select('ID','Name','Type');
    }
    public function edition(){
        return $this->belongsTo(Picklist::class,'Place','ID')->select('ID','Name','Type');
    }
    public function pub_pages(){
        return $this->hasMany(PubPageName::class,'PubId','PubId');
    }
    public function region(){
        return $this->belongsTo(Picklist::class,'Region','ID')->select('ID','Name');
    }

}
