<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Clientkeyword extends Model
{
    use HasFactory;
    protected $table = "clientkeyword";
    protected $primaryKey = 'KeywordID';

    public function keywords(){
        return $this->belongsTo(Keywordmaster::class,'KeywordID','keyID');
    }
}
