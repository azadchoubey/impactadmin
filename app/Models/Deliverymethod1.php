<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Deliverymethod1 extends Model
{
    use HasFactory;
    protected $table = "deliverymethod1";
    protected $primaryKey = 'id';

    public function deliveryformats(){
        return $this->belongsTo(Deliverymethodmaster::class,'deliveryid','id');
    }
}
