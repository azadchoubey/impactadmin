<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Keywordmaster extends Model
{
    use HasFactory;
    protected $table = "keyword_master";
    protected $primaryKey = 'keyID';
    public $timestamps = false;
    protected $fillable = [
        'KeyWord',
        'Filter',
        'PrimaryKeyID',
        'Filter_String',
        'base_id',
        'CreateDateTime',
        'EditDateTime',
        'MediaUniverse',
        'visible'
    ];
    public function clientskeywords(){
        return $this->hasMany(Clientkeyword::class,'KeywordID','keyID');
    }
}
