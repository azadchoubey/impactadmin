<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Bmdeliverymethod extends Model
{
    use HasFactory;
    protected $table = "bm_deliverymethod";
    protected $primaryKey = 'id';

    public function contacts(){
        return $this->belongsTo(ClinetContacts::class,'contactid','contactid');
    }
}
