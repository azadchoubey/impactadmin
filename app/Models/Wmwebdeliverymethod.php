<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Wmwebdeliverymethod extends Model
{
    use HasFactory;
    protected $table = "wm_webdeliverymethod";
    protected $primaryKey = 'id';
    public function delivery(){
        return $this->belongsTo(Wmwebdeliverymethodmaster::class,'deliveryid','id');
    }
}
