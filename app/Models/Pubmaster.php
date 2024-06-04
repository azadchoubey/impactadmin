<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pubmaster extends Model
{
    use HasFactory;
    protected $table = "pub_master";
    protected $primaryKey = 'PubId';
    protected $fillable = [
        'Title', 'address1', 'address2', 'address3', 'CityID', 'stateID', 'countryID',
        'IsDomestic', 'phone', 'PrimaryPubID', 'RatePC', 'RatePB', 'RateNC', 'RateNB',
        'Type', 'Category', 'Language', 'Region', 'Periodicity', 'Size', 'MastHead',
        'Circulation', 'WebSite', 'Issn_Num', 'Place', 'baseid', 'OldName', 'deleted',
        'oldname2', 'CreateDateTime', 'EditDateTime', 'wm_website', 'IsMain', 'cspec',
        'priority', 'tier'
    ];
    public $timestamps = false;

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
    public function frequency(){
        return $this->belongsTo(Picklist::class,'Periodicity','ID')->select('ID','Name','Type');
    }
    public function pub_pages(){
        return $this->hasMany(PubPageName::class,'PubId','PubId');
    }
    public function region(){
        return $this->belongsTo(Picklist::class,'Region','ID')->select('ID','Name');
    }
 

}
