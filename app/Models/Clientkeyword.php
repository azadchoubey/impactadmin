<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Clientkeyword extends Model
{
    use HasFactory;
    protected $table = "clientkeyword";
    protected $primaryKey = 'KeywordID';
    public $timestamps = false;
    protected $fillable = [
        'ClientID',
        'KeywordID',
        'Filter',
        'Type',
        'CompanyS',
        'Category',
        'CreateDateTime',
        'EditDateTime',
        'BrandS',
    ];
    public function keywords(){
        return $this->belongsTo(Keywordmaster::class,'KeywordID','keyID');
    }
    public function clients(){
        return $this->belongsTo(Clinetprofile::class,'ClientID','ClientID');
    }
}
