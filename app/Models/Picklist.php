<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Picklist extends Model
{
    use HasFactory;
    protected $table = "picklist";
    protected $primaryKey = 'ID';

    public function publication(){
        return $this->hasMany(Pubmaster::class,'ID','Type');
    }
    
}
