<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CustomDigestWeekend extends Model
{
    public $timestamps = false;

    use HasFactory;
    protected $table = "custom_digest_weekend";
    protected $primaryKey = 'id';

    public function deliveryformats(){
        return $this->belongsTo(Deliverymethodmaster::class,'deliveryid','id');
    }
}
