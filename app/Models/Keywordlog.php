<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Keywordlog extends Model
{
    use HasFactory;
    protected $table = "keywordlog";
    protected $primaryKey = 'keyid';

    public function clients(){
        return $this->belongsTo(Clinetprofile::class,'clientid','ClientID');
    }
    public function keywordname(){
        return $this->belongsTo(Keywordmaster::class,'keyid','keyID');
    }

}
