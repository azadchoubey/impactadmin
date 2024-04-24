<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Clinetprofile extends Model
{
    use HasFactory;
    protected $table = "clientprofile";
    protected $primaryKey = 'ClientID';
    public $incrementing = false;
    protected $keyType = 'string';
    public $timestamps = false;

    public function contacts(){
        return $this->hasMany(ClinetContacts::class,'ClientID','ClientID');
    }
    public function Country(){
        return $this->belongsTo(Picklist::class,'CountryID','ID')->select('ID','Name');   
    }
    public function region(){
        return $this->belongsTo(Picklist::class,'Region','ID')->select('ID','Name');
    }
    public function Type(){
        return $this->belongsTo(Picklist::class,'Type','ID')->select('ID','Name');
    }
    public function billingcycle(){
        return $this->belongsTo(Picklist::class,'Bill Cycle','ID')->select('ID','Name');
    }
    public function keywords(){
        return $this->hasManyThrough(
            Keywordmaster::class,
            Clientkeyword::class,
            'ClientID', 
            'keyID',
            'ClientID', 
            'KeywordID'
     )->select('*');
    }
    public function sector(){
        return $this->belongsTo(Picklist::class,'SectorPid','ID')->select('ID','Name');   
    }
}
