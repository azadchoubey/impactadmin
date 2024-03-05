<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Article extends Model
{
    use HasFactory;

    protected $table = "article";
    protected $primaryKey = 'id';
    public function publication(){
        return $this->belongsTo(Pubmaster::class,'PubID','PubId');
    }
    public function keywords(){
        return $this->hasMany(Keywordlog::class,'articleid','ArticleID');
    }
    public function articleimage(){
        return $this->belongsTo(ArticleImage::class,'ArticleID','ArticleID');
    }
    public function type(){
        return $this->belongsTo(Picklist::class,'TypePid','ID')->select('ID','Name');
    }
    public function sector(){
        return $this->belongsTo(Picklist::class,'SectorPid','ID')->select('ID','Name');   
    }
    public function subsector(){
        return $this->belongsTo(Picklist::class,'Subsector','ID')->select('ID','Name');   
    }

}
