<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ClinetContacts extends Model
{
    use HasFactory;
    protected $table = "clientcontacts";
    protected $primaryKey = 'contactid';
    public $timestamps = false;

    public function clients(){
        return $this->belongsTo(Clinetprofile::class,'contactid','ClientID');
    }
    public function delivery(){
        return $this->hasMany(Deliverymethod1::class,'contactid','contactid');
    }
    public function regularDigestPrint(){
        return $this->belongsTo(Picklist::class,'DeliveryID','ID');
    }
    public function regularDigestWeb(){
        return $this->hasMany(Wmwebdeliverymethod::class,'contactid','contactid');
    }
    public function deliveryweekend(){
        return $this->hasMany(CustomDigestWeekend::class,'contactid','contactid');
    }
}
